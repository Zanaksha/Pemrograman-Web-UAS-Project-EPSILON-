<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use Barryvdh\DomPDF\Facade\Pdf;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = CarModel::query();

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->series) {
            $query->where('series', $request->series);
        }

        if ($request->drivetrain) {
            $query->where('drivetrain', $request->drivetrain);
        }

        $models = $query->get();

        return view('models', compact('models'));
    }

        public function buycar(Request $request)
    {
        $query = CarModel::query();

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->series) {
            $query->where('series', $request->series);
        }

        if ($request->drivetrain) {
            $query->where('drivetrain', $request->drivetrain);
        }

        $models = $query->get();

        return view('buycar', compact('models'));
    }

    

        public function brochure($slug)
    {
        $model = CarModel::where('slug', $slug)->firstOrFail();

        $pdf = Pdf::loadView('brochure', compact('model'))
                ->setOptions([
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                    'defaultFont' => 'sans-serif',
                    'chroot' => public_path(),
                ]);

        return $pdf->download('BMW-' . $model->name . '-Brochure.pdf');
    }
}