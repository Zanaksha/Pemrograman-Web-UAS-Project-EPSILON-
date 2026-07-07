<?php

namespace App\Services;

use App\Models\CarModel;
use App\Models\Product;
use App\Models\Faq;
use Illuminate\Support\Facades\Http;

class OllamaChatService
{
    protected string $url;
    protected string $model;

    public function __construct()
    {
        $this->url = config('services.ollama.url');
        $this->model = config('services.ollama.model');
    }

    /**
     * @param  array  $history  riwayat percakapan sebelumnya (dari session)
     * @param  string  $userMessage  pesan baru dari user
     * @return array{0: array, 1: string}  [history yang sudah diupdate & di-trim, jawaban bot]
     */
    public function chat(array $history, string $userMessage): array
    {
        $messages = $history;

        // system prompt cuma ditaruh sekali di awal percakapan
        if (empty($messages)) {
            $messages[] = [
                'role' => 'system',
                'content' =>
                    "You are a chatbot assistant for EPSILON, a car dealership. " .
                    "Answer ONLY based on data returned by tools. " .
                    "Never make up prices, specifications, or stock numbers. " .
                    "If a tool returns no data, say clearly that you don't know. " .
                    "ALWAYS use the appropriate tool for questions about cars, products, or FAQs; never answer from your own memory. " .
                    "Reply in a friendly, concise tone, in the same language the user used."
            ];
        }

        $messages[] = ['role' => 'user', 'content' => $userMessage];

        // loop up to 3 times to avoid infinite tool-calling loops
        for ($i = 0; $i < 3; $i++) {
            $response = Http::timeout(60)->post("{$this->url}/api/chat", [
                'model' => $this->model,
                'messages' => $messages,
                'tools' => $this->toolDefinitions(),
                'stream' => false,
            ])->json();

            $message = $response['message'] ?? null;

            if (!$message) {
                return [$this->trimHistory($messages), "Sorry, something went wrong while contacting the model."];
            }

            // no tool call requested -> this is the final answer
            if (empty($message['tool_calls'])) {
                $messages[] = $message;
                return [$this->trimHistory($messages), $message['content'] ?? "Sorry, I couldn't answer that."];
            }

            // append assistant's tool_call message, then execute each tool
            $messages[] = $message;

            foreach ($message['tool_calls'] as $call) {
                $name = $call['function']['name'];
                $args = $call['function']['arguments'] ?? [];

                $result = $this->executeTool($name, $args);

                $messages[] = [
                    'role' => 'tool',
                    'content' => json_encode($result),
                ];
            }
        }

        return [$this->trimHistory($messages), "Sorry, I had trouble processing this request."];
    }

    /**
     * Batasi history maksimal N "turn" (1 turn = 1 pesan user beserta
     * tool_calls, tool response, dan jawaban assistant yang menyertainya).
     * System prompt selalu dipertahankan di awal.
     */
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

        $turns = array_reverse($turns);
        $keptTurns = array_slice($turns, -$maxTurns);

        $trimmed = $system ? [$system] : [];
        foreach ($keptTurns as $turn) {
            $trimmed = array_merge($trimmed, $turn);
        }

        return $trimmed;
    }

    protected function toolDefinitions(): array
    {
        return [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'get_car_spec',
                    'description' => 'Get full specifications for a car by model name',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'model_name' => ['type' => 'string', 'description' => 'Car model name, e.g. "Alpha" or "Zeta"'],
                        ],
                        'required' => ['model_name'],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'get_car_price',
                    'description' => 'Get the price of a car by model name',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'model_name' => ['type' => 'string'],
                        ],
                        'required' => ['model_name'],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'list_cars_by_category',
                    'description' => 'List cars by category (SUV, Sedan, etc), or leave empty for all categories',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'category' => ['type' => 'string', 'description' => 'Category name, e.g. "SUV" or "Sedan"'],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'get_product_info',
                    'description' => 'Get product/accessory info (stock, price, description) by name',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'product_name' => ['type' => 'string'],
                        ],
                        'required' => ['product_name'],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'search_faq',
                    'description' => 'Search FAQ for an answer to the user question',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'query' => ['type' => 'string'],
                        ],
                        'required' => ['query'],
                    ],
                ],
            ],
        ];
    }

    protected function executeTool(string $name, array $args): mixed
    {
        return match ($name) {
            'get_car_spec' => $this->getCarSpec($args['model_name'] ?? ''),
            'get_car_price' => $this->getCarPrice($args['model_name'] ?? ''),
            'list_cars_by_category' => $this->listCarsByCategory($args['category'] ?? null),
            'get_product_info' => $this->getProductInfo($args['product_name'] ?? ''),
            'search_faq' => $this->searchFaq($args['query'] ?? ''),
            default => ['error' => "Unknown tool: {$name}"],
        };
    }

    protected function getCarSpec(string $modelName): array
    {
        $car = CarModel::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($modelName) . '%'])->first();

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
        $car = CarModel::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($modelName) . '%'])->first();

        return $car
            ? ['found' => true, 'name' => $car->name, 'price' => $car->price]
            : ['found' => false, 'message' => "Car '{$modelName}' not found"];
    }

    protected function listCarsByCategory(?string $category): array
    {
        $query = CarModel::query();

        if ($category) {
            $query->whereRaw('LOWER(category) = ?', [strtolower($category)]);
        }

        $cars = $query->pluck('name', 'category');

        return ['found' => $cars->isNotEmpty(), 'cars' => $cars->toArray()];
    }

    protected function getProductInfo(string $productName): array
    {
        $product = Product::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($productName) . '%'])->first();

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
        $matcher = new TfIdfMatcher();
        $matcher->buildIndex(Faq::all(), fn($faq) => $faq->question);

        $match = $matcher->findBestMatch($query, threshold: 0.15);

        return $match
            ? ['found' => true, 'answer' => $match['document']->answer]
            : ['found' => false, 'message' => 'FAQ not found'];
    }
}