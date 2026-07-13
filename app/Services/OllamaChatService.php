<?php

namespace App\Services;

use App\Models\CarModel;
use App\Models\Product;
use App\Models\Faq;
use App\Models\Sparepart;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class OllamaChatService
{
    protected string $url;
    protected string $model;
    protected ?TfIdfMatcher $faqMatcher = null;

   
    protected const SORTABLE_CAR_COLUMNS = ['price'];
    protected const SORTABLE_SPAREPART_COLUMNS = ['price'];

    public function __construct()
    {
        $this->url = config('services.ollama.url');
        $this->model = config('services.ollama.model');
    }

    /**
     * @param  array 
     * @param  string  
     * @return array
     */
    public function chat(array $history, string $userMessage): array
    {
        set_time_limit(120); 

        $messages = $history;

        if (empty($messages)) {
            $messages[] = ['role' => 'system', 'content' => $this->systemPrompt()];
        }

        $messages[] = ['role' => 'user', 'content' => $userMessage];

        for ($i = 0; $i < 3; $i++) {
            try {
                $httpResponse = Http::timeout(90)->post("{$this->url}/api/chat", [
                    'model' => $this->model,
                    'messages' => $messages,
                    'tools' => $this->toolDefinitions(),
                    'stream' => false,
                ]);
            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                Log::error('Ollama connection failed', ['error' => $e->getMessage()]);
                return [$this->trimHistory($messages), "Maaf, tidak bisa terhubung ke server AI saat ini. Coba lagi sebentar lagi."];
            }

            if (!$httpResponse->successful()) {
                Log::error('Ollama returned error status', [
                    'status' => $httpResponse->status(),
                    'body' => $httpResponse->body(),
                ]);
                return [$this->trimHistory($messages), "Sorry, something went wrong while contacting the model."];
            }

            $message = $httpResponse->json('message');

            if (!$message) {
                Log::error('Ollama response missing message field', [
                    'status' => $httpResponse->status(),
                    'full_body' => $httpResponse->body(),
                ]);
                return [$this->trimHistory($messages), "Sorry, something went wrong while contacting the model."];
            }

            if (empty($message['tool_calls'])) {
                $messages[] = $message;
                return [$this->trimHistory($messages), $message['content'] ?? "Sorry, I couldn't answer that."];
            }

            $messages[] = $message;

            foreach ($message['tool_calls'] as $call) {
                $messages[] = [
                    'role' => 'tool',
                    'content' => json_encode(
                        $this->executeTool($call['function']['name'], $call['function']['arguments'] ?? [])
                    ),
                ];
            }
        }

        return [$this->trimHistory($messages), "Sorry, I had trouble processing this request."];
    }

    protected function systemPrompt(): string
    {
        return "You are a chatbot assistant for EPSILON, a car dealership. " .
            "Answer ONLY based on data returned by tools — never invent prices, specifications, stock numbers, or sparepart details. " .
            "\n\n" .
            "You have flexible tools available: query_cars can filter by category AND sort by price " .
            "(use it for questions like 'mobil termahal', 'mobil termurah', 'urutkan berdasarkan harga', " .
            "'SUV termurah', or general listing questions like 'ada mobil apa saja'). " .
            "query_spareparts works the same way for sparepart ranking questions like 'sparepart termahal', " .
            "'sparepart termurah', or listing spareparts by category/compatible model. " .
            "Combine parameters as needed — e.g. category + sort together for questions like 'SUV termahal apa'. " .
            "\n\n" .
            "If a question needs information no tool can provide (e.g. comparing two very different things, " .
            "or something outside cars/products/spareparts/FAQ), don't just apologize — briefly explain what " .
            "you *can* help with instead (car specs/prices/rankings, products, spareparts, or dealership FAQ). " .
            "\n\n" .
            "If a tool returns no data, say so clearly and suggest the user rephrase or check the name, " .
            "rather than giving up entirely. " .
            "Reply in a friendly, concise tone, in the same language the user used.";
    }

    protected function trimHistory(array $messages, int $maxTurns = 5): array
    {
        $system = null;
        $rest = [];

        foreach ($messages as $msg) {
            if ($msg['role'] === 'system' && $system === null) {
                $system = $msg;
            } else {
                $rest[] = $msg;
            }
        }

        $turns = [];
        $currentTurn = [];

        foreach (array_reverse($rest) as $msg) {
            $currentTurn[] = $msg;
            if ($msg['role'] === 'user') {
                $turns[] = array_reverse($currentTurn);
                $currentTurn = [];
            }
        }

        $keptTurns = array_slice(array_reverse($turns), -$maxTurns);

        return array_merge($system ? [$system] : [], ...$keptTurns);
    }

    protected function toolDefinitions(): array
    {
        return [
            $this->toolDef('get_car_spec', 'Get full specifications for a car by model name', 'model_name', 'Car model name, e.g. "Alpha" or "Zeta"'),
            $this->toolDef('get_car_price', 'Get the price of a car by model name', 'model_name'),
            [
                'type' => 'function',
                'function' => [
                    'name' => 'query_cars',
                    'description' =>
                        'Flexible car search: filter by category and/or sort by price. Use this for ' .
                        '"most expensive"/"termahal", "cheapest"/"termurah", ranking questions, or listing ' .
                        'cars by category. Leave parameters empty to list all cars.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'category' => [
                                'type' => 'string',
                                'description' => 'Optional category filter, e.g. "SUV" or "Sedan". Leave empty for all categories.',
                            ],
                            'sort_by' => [
                                'type' => 'string',
                                'enum' => ['price'],
                                'description' => 'Optional field to sort by. Currently only "price" is supported.',
                            ],
                            'order' => [
                                'type' => 'string',
                                'enum' => ['asc', 'desc'],
                                'description' => '"desc" for highest first (termahal), "asc" for lowest first (termurah). Required if sort_by is set.',
                            ],
                            'limit' => [
                                'type' => 'integer',
                                'description' => 'Optional max number of results to return. Use 1 for "the most/cheapest" questions.',
                            ],
                        ],
                        'required' => [],
                    ],
                ],
            ],
            $this->toolDef('get_product_info', 'Get product/accessory info (stock, price, description) by name', 'product_name'),
            $this->toolDef('get_sparepart_info', 'Get sparepart info (price, stock, category, compatible car model, description) by name or part number', 'query', 'Sparepart name or part number, e.g. "brake pad" or "BP-2201"'),
            [
                'type' => 'function',
                'function' => [
                    'name' => 'query_spareparts',
                    'description' =>
                        'Flexible sparepart search: filter by category or compatible car model, and/or sort by ' .
                        'price. Use this for "most expensive"/"termahal", "cheapest"/"termurah" sparepart ' .
                        'questions, or general listing. Leave parameters empty to list all spareparts.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'category' => [
                                'type' => 'string',
                                'description' => 'Optional category filter, e.g. "Brake" or "Filter". Leave empty for all categories.',
                            ],
                            'compatible_model' => [
                                'type' => 'string',
                                'description' => 'Optional car model filter, e.g. "Alpha". Leave empty for all models.',
                            ],
                            'sort_by' => [
                                'type' => 'string',
                                'enum' => ['price'],
                                'description' => 'Optional field to sort by. Currently only "price" is supported.',
                            ],
                            'order' => [
                                'type' => 'string',
                                'enum' => ['asc', 'desc'],
                                'description' => '"desc" for highest first (termahal), "asc" for lowest first (termurah).',
                            ],
                            'limit' => [
                                'type' => 'integer',
                                'description' => 'Optional max number of results to return. Use 1 for "the most/cheapest" questions.',
                            ],
                        ],
                        'required' => [],
                    ],
                ],
            ],
            $this->toolDef('list_spareparts_by_compatible_model', 'List all spareparts compatible with a specific car model', 'model_name', 'Car model name, e.g. "Alpha" or "Zeta"'),
            $this->toolDef('search_faq', 'Search FAQ for an answer to the user question', 'query'),
        ];
    }

    protected function toolDef(string $name, string $description, string $paramName, ?string $paramDescription = null, bool $required = true): array
    {
        $property = ['type' => 'string'];
        if ($paramDescription) {
            $property['description'] = $paramDescription;
        }

        return [
            'type' => 'function',
            'function' => [
                'name' => $name,
                'description' => $description,
                'parameters' => [
                    'type' => 'object',
                    'properties' => [$paramName => $property],
                    'required' => $required ? [$paramName] : [],
                ],
            ],
        ];
    }

    protected function executeTool(string $name, array $args): mixed
    {
        return match ($name) {
            'get_car_spec' => $this->getCarSpec($args['model_name'] ?? ''),
            'get_car_price' => $this->getCarPrice($args['model_name'] ?? ''),
            'query_cars' => $this->queryCars(
                $args['category'] ?? null,
                $args['sort_by'] ?? null,
                $args['order'] ?? null,
                $args['limit'] ?? null,
            ),
            'get_product_info' => $this->getProductInfo($args['product_name'] ?? ''),
            'search_faq' => $this->searchFaq($args['query'] ?? ''),
            'get_sparepart_info' => $this->getSparepartInfo($args['query'] ?? ''),
            'query_spareparts' => $this->querySpareparts(
                $args['category'] ?? null,
                $args['compatible_model'] ?? null,
                $args['sort_by'] ?? null,
                $args['order'] ?? null,
                $args['limit'] ?? null,
            ),
            'list_spareparts_by_compatible_model' => $this->listSparepartsByCompatibleModel($args['model_name'] ?? ''),
            default => ['error' => "Unknown tool: {$name}"],
        };
    }


    protected function findOneByLike(string $modelClass, string $column, string $value): ?Model
    {
        return $modelClass::whereRaw("LOWER({$column}) LIKE ?", ['%' . strtolower($value) . '%'])->first();
    }

    protected function getCarSpec(string $modelName): array
    {
        $car = $this->findOneByLike(CarModel::class, 'name', $modelName);

        if (!$car) {
            return ['found' => false, 'message' => "Car '{$modelName}' not found"];
        }

        return [
            'found' => true,
            'name' => $car->name,
            'engine' => $car->engine,
            'transmission' => $car->transmission,
            'drivetrain' => $car->drivetrain,
            'power' => $car->power,
            'torque' => $car->torque,
            'acceleration' => $car->acceleration,
            'top_speed' => $car->top_speed,
            'fuel_consumption' => $car->fuel_consumption,
        ];
    }

    protected function getCarPrice(string $modelName): array
    {
        $car = $this->findOneByLike(CarModel::class, 'name', $modelName);

        return $car
            ? ['found' => true, 'name' => $car->name, 'price' => $car->price]
            : ['found' => false, 'message' => "Car '{$modelName}' not found"];
    }


    protected function queryCars(?string $category, ?string $sortBy, ?string $order, ?int $limit): array
    {
        $query = CarModel::query();

        if ($category) {
            $query->whereRaw('LOWER(category) = ?', [strtolower($category)]);
        }

        if ($sortBy && in_array($sortBy, self::SORTABLE_CAR_COLUMNS, true)) {
            $query->orderBy($sortBy, $order === 'asc' ? 'asc' : 'desc');
        }

        if ($limit && $limit > 0) {
            $query->limit($limit);
        }

        $cars = $query->get(['name', 'category', 'price']);

        return [
            'found' => $cars->isNotEmpty(),
            'cars' => $cars->toArray(),
        ];
    }

    protected function getProductInfo(string $productName): array
    {
        $product = $this->findOneByLike(Product::class, 'name', $productName);

        if (!$product) {
            return ['found' => false, 'message' => "Product '{$productName}' not found"];
        }

        return [
            'found' => true,
            'name' => $product->name,
            'stock' => $product->stock,
            'price' => $product->price,
            'description' => $product->description,
        ];
    }

    protected function searchFaq(string $query): array
    {

        if ($this->faqMatcher === null) {
            $this->faqMatcher = (new TfIdfMatcher())->buildIndex(
                Faq::all(),
                fn($faq) => $faq->question
            );
        }

        $match = $this->faqMatcher->findBestMatch($query, threshold: 0.15);

        return $match
            ? ['found' => true, 'answer' => $match['document']->answer]
            : ['found' => false, 'message' => 'FAQ not found'];
    }

    protected function getSparepartInfo(string $query): array
    {
        $part = Sparepart::where(function ($q) use ($query) {
            $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(part_number) LIKE ?', ['%' . strtolower($query) . '%']);
        })->first();

        if (!$part) {
            return ['found' => false, 'message' => "Sparepart '{$query}' not found"];
        }

        return [
            'found' => true,
            'name' => $part->name,
            'part_number' => $part->part_number,
            'category' => $part->category,
            'compatible_model' => $part->compatible_model,
            'description' => $part->description,
            'price' => $part->price,
            'stock' => $part->stock,
        ];
    }


    protected function querySpareparts(?string $category, ?string $compatibleModel, ?string $sortBy, ?string $order, ?int $limit): array
    {
        $query = Sparepart::query();

        if ($category) {
            $query->whereRaw('LOWER(category) = ?', [strtolower($category)]);
        }

        if ($compatibleModel) {
            $query->whereRaw('LOWER(compatible_model) LIKE ?', ['%' . strtolower($compatibleModel) . '%']);
        }

        if ($sortBy && in_array($sortBy, self::SORTABLE_SPAREPART_COLUMNS, true)) {
            $query->orderBy($sortBy, $order === 'asc' ? 'asc' : 'desc');
        }

        if ($limit && $limit > 0) {
            $query->limit($limit);
        }

        $parts = $query->get(['name', 'part_number', 'category', 'compatible_model', 'price']);

        return [
            'found' => $parts->isNotEmpty(),
            'spareparts' => $parts->toArray(),
        ];
    }

    protected function listSparepartsByCompatibleModel(string $modelName): array
    {
        $parts = Sparepart::whereRaw('LOWER(compatible_model) LIKE ?', ['%' . strtolower($modelName) . '%'])
            ->get(['name', 'part_number', 'price', 'stock']);

        return [
            'found' => $parts->isNotEmpty(),
            'spareparts' => $parts->toArray(),
        ];
    }
}