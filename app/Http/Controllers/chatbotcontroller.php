<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotResponse;
<<<<<<< HEAD
=======
use App\Models\CarModel;
>>>>>>> a312fddf1c54c060e6fe6f65d67bf1c7575797a3

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request)
    {
<<<<<<< HEAD
        $message = strtolower($request->message);
=======
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
                    "BMW {$car->name}\n\n" .
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
                    "Harga BMW {$car->name}: {$car->price}"
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
                'reply' => 'BMW SUV Models: ' . $cars->implode(', ')
            ]);
        }

        if (str_contains($message, 'sedan'))
        {
            $cars = CarModel::where('category', 'Sedan')->pluck('name');

            return response()->json([
                'reply' => 'BMW Sedan Models: ' . $cars->implode(', ')
            ]);
        }
>>>>>>> a312fddf1c54c060e6fe6f65d67bf1c7575797a3

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