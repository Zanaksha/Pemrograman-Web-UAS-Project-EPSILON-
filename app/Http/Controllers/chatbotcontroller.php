<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotResponse;
use App\Models\CarModel;
use App\Models\Product;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request)
    {
        $message = strtolower(trim($request->message));

        $cars = CarModel::all();
        $sides = Product::all();

        foreach ($cars as $car) {
            $model = strtolower($car->name);

            if (str_contains($message, 'spec') && str_contains($message, $model)) {
                return response()->json([
                    'reply' =>
                        "EPSILON {$car->name} — Full Specifications\n" .
                        "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                        "Engine        : {$car->engine}\n" .
                        "Transmission  : {$car->transmission}\n" .
                        "Drivetrain    : {$car->drivetrain}\n" .
                        "Power         : {$car->power}\n" .
                        "Torque        : {$car->torque}\n" .
                        "0–100 km/h   : {$car->acceleration}\n" .
                        "Top Speed     : {$car->top_speed}\n" .
                        "Fuel Economy  : {$car->fuel_consumption}"
                ]);
            }

            if (str_contains($message, 'price') && str_contains($message, $model)) {
                return response()->json([
                    'reply' =>
                        "EPSILON {$car->name}\n" .
                        "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                        "Price: {$car->price}"
                ]);
            }

            if (str_contains($message, $model)) {
                return response()->json([
                    'reply' =>
                        "EPSILON {$car->name}\n" .
                        "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                        "Category   : {$car->category}\n" .
                        "Series     : {$car->series}\n" .
                        "Drivetrain : {$car->drivetrain}"
                ]);
            }
        }

        foreach ($sides as $side) {
            $barang = strtolower($side->name);

            if (str_contains($message, 'stock') && str_contains($message, $barang)) {
                return response()->json([
                    'reply' =>
                        "Stock Information\n" .
                        "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                        "Item  : {$side->name}\n" .
                        "Stock : {$side->stock} units"
                ]);
            }

            if (str_contains($message, 'price') && str_contains($message, $barang)) {
                return response()->json([
                    'reply' =>
                        "Product Price\n" .
                        "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                        "Item  : {$side->name}\n" .
                        "Price : {$side->price}"
                ]);
            }
        }

        if (str_contains($message, 'suv')) {
            $suvModels = CarModel::where('category', 'SUV')->pluck('name');

            return response()->json([
                'reply' =>
                    "EPSILON SUV Lineup\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    $suvModels->map(fn($name) => "• {$name}")->implode("\n")
            ]);
        }

        if (str_contains($message, 'sedan')) {
            $sedanModels = CarModel::where('category', 'Sedan')->pluck('name');

            return response()->json([
                'reply' =>
                    "EPSILON Sedan Lineup\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    $sedanModels->map(fn($name) => "• {$name}")->implode("\n")
            ]);
        }

        if (str_contains($message, 'category') || str_contains($message, 'categories')) {
            $categories = CarModel::distinct()->pluck('category');

            return response()->json([
                'reply' =>
                    "EPSILON Car Categories\n" .
                    "━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
                    $categories->map(fn($cat) => "• {$cat}")->implode("\n")
            ]);
        }

        $chat = ChatbotResponse::whereRaw(
            'LOWER(?) LIKE CONCAT("%", LOWER(keyword), "%")',
            [$message]
        )->first();

        return response()->json([
            'reply' => $chat
                ? $chat->response
                : "Sorry, I couldn't find an answer to your question.\nTry asking about a car model, specs, price, or category!"
        ]);
    }
}