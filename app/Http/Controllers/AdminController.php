<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use App\Models\Product;
use App\Models\Message;
use App\Models\Warranty;
use App\Models\ServiceHistory;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCars = CarModel::count();
        $totalProducts = Product::count();
        $totalMessages = Message::count();
        return view('admin.dashboard', compact('totalCars', 'totalProducts', 'totalMessages'));
    }

    public function cars()
    {
        $cars = CarModel::all();
        return view('admin.cars.index', compact('cars'));
    }

    public function carCreate()
    {
        return view('admin.cars.create');
    }

    public function carStore(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'slug'     => 'required|unique:cars',
            'category' => 'required',
            'series'   => 'required',
            'drivetrain' => 'required',
        ]);
        CarModel::create($request->all());
        return redirect()->route('admin.cars')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function carEdit($id)
    {
        $car = CarModel::findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    public function carUpdate(Request $request, $id)
    {
        $car = CarModel::findOrFail($id);
        $car->update($request->all());
        return redirect()->route('admin.cars')->with('success', 'Mobil berhasil diupdate!');
    }

    public function carDestroy($id)
    {
        CarModel::findOrFail($id)->delete();
        return redirect()->route('admin.cars')->with('success', 'Mobil berhasil dihapus!');
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function productCreate()
    {
        return view('admin.products.create');
    }

        public function productStore(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required|numeric',
            'stock'    => 'required|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $data['image'] = 'images/products/' . $filename;
        }

        Product::create($data);
        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $data['image'] = 'images/products/' . $filename;
        }

        $product->update($data);
        return redirect()->route('admin.products')->with('success', 'Produk berhasil diupdate!');
    }

    public function productDestroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }

    public function messages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function messageDestroy($id)
    {
        Message::findOrFail($id)->delete();
        return redirect()->route('admin.messages')->with('success', 'Pesan berhasil dihapus!');
    }

    public function shop()
    {
        $products = Product::all();
        return view('choosebuy', compact('products'));
    }

        public function warranties()
    {
        $warranties = Warranty::with('serviceHistories')->get();
        return view('admin.warranties.index', compact('warranties'));
    }

    public function warrantyCreate()
    {
        return view('admin.warranties.create');
    }

    public function warrantyStore(Request $request)
    {
        $request->validate([
            'vin'            => 'required|unique:warranties',
            'owner_name'     => 'required',
            'owner_email'    => 'required|email',
            'car_model'      => 'required',
            'car_year'       => 'required',
            'purchase_date'  => 'required|date',
            'warranty_start' => 'required|date',
            'warranty_end'   => 'required|date',
        ]);
        Warranty::create($request->all());
        return redirect()->route('admin.warranties')->with('success', 'Warranty berhasil ditambahkan!');
    }

    public function warrantyEdit($id)
    {
        $warranty = Warranty::with('serviceHistories')->findOrFail($id);
        return view('admin.warranties.edit', compact('warranty'));
    }

    public function warrantyUpdate(Request $request, $id)
    {
        $warranty = Warranty::findOrFail($id);
        $warranty->update($request->all());
        return redirect()->route('admin.warranties')->with('success', 'Warranty berhasil diupdate!');
    }

    public function warrantyDestroy($id)
    {
        Warranty::findOrFail($id)->delete();
        return redirect()->route('admin.warranties')->with('success', 'Warranty berhasil dihapus!');
    }

    public function serviceStore(Request $request, $id)
    {
        $request->validate([
            'service_date' => 'required|date',
            'service_type' => 'required',
            'status'       => 'required',
        ]);
        ServiceHistory::create([
            'warranty_id'  => $id,
            'service_date' => $request->service_date,
            'service_type' => $request->service_type,
            'description'  => $request->description,
            'technician'   => $request->technician,
            'cost'         => $request->cost ?? 0,
            'status'       => $request->status,
        ]);
        return redirect()->route('admin.warranties.edit', $id)->with('success', 'Service history berhasil ditambahkan!');
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function orderConfirm($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'confirmed']);
        return redirect()->route('admin.orders')->with('success', 'Order berhasil dikonfirmasi!');
    }

    public function generateWarranty(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $vin = 'WBA' . strtoupper(substr(md5($order->order_id), 0, 14));

        $warranty = Warranty::create([
            'vin'            => $vin,
            'owner_name'     => $order->nama,
            'owner_email'    => $order->email,
            'car_model'      => $order->model,
            'car_year'       => date('Y'),
            'purchase_date'  => $order->created_at->format('Y-m-d'),
            'warranty_start' => $order->created_at->format('Y-m-d'),
            'warranty_end'   => $order->created_at->addYears(4)->format('Y-m-d'),
            'status'         => 'active',
            'notes'          => 'Auto-generated from Order ' . $order->order_id,
        ]);

        $order->update(['vin' => $vin, 'status' => 'delivered']);

        return redirect()->route('admin.orders')->with('success', 'Warranty berhasil digenerate! VIN: ' . $vin);
    }
    
    public function orderDestroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Order berhasil dihapus!');
    }
    
}