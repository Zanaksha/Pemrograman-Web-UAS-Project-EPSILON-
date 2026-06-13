<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotResponse;
use App\Models\CarModel;

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

        foreach ($cars as $car)
        {
            $model = strtolower($car->name);

            if (
                str_contains($message, 'spesifikasi') &&
                str_contains($message, $model)
            )
            {
                return response()->json([
                    'reply' =>
                    "EPSILON {$car->name}\n\n" .
                    "Engine: {$car->engine}\n" .
                    "Transmission: {$car->transmission}\n" .
                    "Drivetrain: {$car->drivetrain}\n" .
                    "Power: {$car->power}\n" .
                    "Torque: {$car->torque}\n" .
                    "0-100 km/h: {$car->acceleration}\n" .
                    "Top Speed: {$car->top_speed}\n" .
                    "Fuel Consumption: {$car->fuel_consumption}"
                ]);
            }

            if (
                str_contains($message, 'harga') &&
                str_contains($message, $model)
            )
            {
                return response()->json([
                    'reply' =>
                    "Harga EPSILON {$car->name}: {$car->price}"
                ]);
            }

            if (str_contains($message, $model))
            {
                return response()->json([
                    'reply' =>
                    "BMW {$car->name}\n" .
                    "Category: {$car->category}\n" .
                    "Series: {$car->series}\n" .
                    "Drivetrain: {$car->drivetrain}"
                ]);
            }
        }

        if (str_contains($message, 'suv'))
        {
            $cars = CarModel::where('category', 'SUV')->pluck('name');

            return response()->json([
                'reply' => 'EPSILON SUV Models : ' . $cars->implode(', ')
            ]);
        }

        if (str_contains($message, 'sedan'))
        {
            $cars = CarModel::where('category', 'Sedan')->pluck('name');

            return response()->json([
                'reply' => 'EPSILON Sedan Models : ' . $cars->implode(', ')
            ]);
        }

        if (str_contains($message, 'category'))
        {
            $categories = CarModel::distinct()->pluck('category');

            return response()->json([
                'reply' => 'EPSILON Car Categories: ' . $categories->implode(', ')
            ]);
        }

        $chat = ChatbotResponse::whereRaw(
            'LOWER(?) LIKE CONCAT("%", LOWER(keyword), "%")',
            [$message]
        )->first();

        return response()->json([
            'reply' => $chat
                ? $chat->response
                : 'Maaf, saya belum menemukan jawaban.'
        ]);
    }
}