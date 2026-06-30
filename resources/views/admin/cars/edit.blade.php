<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #111; color: white; padding: 20px 0; width: 250px; position: fixed; }
        .sidebar .brand { padding: 20px 24px; font-size: 20px; font-weight: 700; letter-spacing: 3px; border-bottom: 1px solid #222; margin-bottom: 10px; }
        .sidebar a { display: block; padding: 12px 24px; color: #aaa; text-decoration: none; font-size: 14px; }
        .sidebar a:hover { background: #1a1a1a; color: #fff; }
        .main { margin-left: 250px; padding: 30px; }
        .top-bar { background: white; padding: 16px 30px; margin: -30px -30px 30px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">BMW ADMIN</div>
    <a href="/admin"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="/admin/cars" class="active"><i class="bi bi-car-front me-2"></i> Manage Cars</a>
    <a href="/admin/products"><i class="bi bi-bag me-2"></i> Manage Products</a>
    <a href="/admin/orders"><i class="bi bi-receipt me-2"></i> Orders</a>
    <a href="/admin/warranties"><i class="bi bi-shield-check me-2"></i> Warranties</a>
    <a href="/admin/reports"><i class="bi bi-graph-up me-2"></i> Sales Report</a>
    <a href="/admin/spareparts"><i class="bi bi-wrench me-2"></i> SpareParts</a>
    <a href="/admin/messages"><i class="bi bi-envelope me-2"></i> Messages</a>
    <hr style="border-color:#222; margin:10px 24px;">
    <a href="/"><i class="bi bi-house me-2"></i> Back to Website</a>
    <form method="POST" action="{{ route('logout') }}" style="padding:0 24px; margin-top:10px;">
        @csrf
        <button type="submit" style="width:100%; padding:10px; background:#cc0000; color:white; border:none; border-radius:6px; cursor:pointer;">Logout</button>
    </form>
</div>

<div class="main">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Edit Car — {{ $car->name }}</h5>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card border-0 shadow-sm p-4" style="max-width:700px;">
        <form method="POST" action="{{ route('admin.cars.update', $car->id) }}">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $car->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ $car->slug }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        @foreach(['SUV','Sedan','Touring','Coupe','Convertible'] as $cat)
                        <option {{ $car->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Series</label>
                    <input type="text" name="series" class="form-control" value="{{ $car->series }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Drivetrain</label>
                    <select name="drivetrain" class="form-select">
                        @foreach(['Electric','Plug-in Hybrid','Petrol'] as $dt)
                        <option {{ $car->drivetrain == $dt ? 'selected' : '' }}>{{ $dt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ $car->price }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Image URL</label>
                    <input type="text" name="image" class="form-control" value="{{ $car->image }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Engine</label>
                    <input type="text" name="engine" class="form-control" value="{{ $car->engine }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Power</label>
                    <input type="text" name="power" class="form-control" value="{{ $car->power }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Torque</label>
                    <input type="text" name="torque" class="form-control" value="{{ $car->torque }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Acceleration</label>
                    <input type="text" name="acceleration" class="form-control" value="{{ $car->acceleration }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Top Speed</label>
                    <input type="text" name="top_speed" class="form-control" value="{{ $car->top_speed }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fuel Consumption</label>
                    <input type="text" name="fuel_consumption" class="form-control" value="{{ $car->fuel_consumption }}">
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary px-4">Update Car</button>
                    <a href="/admin/cars" class="btn btn-secondary px-4 ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>