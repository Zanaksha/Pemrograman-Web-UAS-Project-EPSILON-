<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Sparepart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #111; color: white; padding: 20px 0; width: 250px; position: fixed; }
        .sidebar .brand { padding: 20px 24px; font-size: 20px; font-weight: 700; letter-spacing: 3px; border-bottom: 1px solid #222; margin-bottom: 10px; }
        .sidebar a { display: block; padding: 12px 24px; color: #aaa; text-decoration: none; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: #1a1a1a; color: #fff; border-left: 3px solid #0066cc; }
        .main { margin-left: 250px; padding: 30px; }
        .top-bar { background: white; padding: 16px 30px; margin: -30px -30px 30px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">BMW ADMIN</div>
    <a href="/admin"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="/admin/cars"><i class="bi bi-car-front me-2"></i> Manage Cars</a>
    <a href="/admin/products"><i class="bi bi-bag me-2"></i> Manage Products</a>
    <a href="/admin/spareparts" class="active"><i class="bi bi-gear me-2"></i> Spareparts</a>
    <a href="/admin/orders"><i class="bi bi-receipt me-2"></i> Orders</a>
    <a href="/admin/warranties"><i class="bi bi-shield-check me-2"></i> Warranties</a>
    <a href="/admin/reports"><i class="bi bi-graph-up me-2"></i> Sales Report</a>
    <a href="/admin/messages"><i class="bi bi-envelope me-2"></i> Messages</a>
    <hr style="border-color:#222; margin:10px 24px;">
    <a href="/"><i class="bi bi-house me-2"></i> Back to Website</a>
</div>

<div class="main">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Add New Sparepart</h5>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card border-0 shadow-sm p-4" style="max-width:700px;">
        <form method="POST" action="{{ route('admin.spareparts.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Part Number</label>
                    <input type="text" name="part_number" class="form-control" value="{{ old('part_number') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        <option>Engine</option>
                        <option>Brake</option>
                        <option>Filter</option>
                        <option>Electrical</option>
                        <option>Suspension</option>
                        <option>Body</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Compatible Model</label>
                    <input type="text" name="compatible_model" class="form-control" placeholder="e.g. 3 Series, X5" value="{{ old('compatible_model') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Image URL</label>
                    <input type="text" name="image" class="form-control" value="{{ old('image') }}">
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary px-4">Save Sparepart</button>
                    <a href="/admin/spareparts" class="btn btn-secondary px-4 ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>