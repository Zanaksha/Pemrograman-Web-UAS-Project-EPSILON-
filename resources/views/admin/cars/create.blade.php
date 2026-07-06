<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #111; color: white; padding: 20px 0; width: 250px; position: fixed; }
        .sidebar .brand { padding: 20px 24px; font-size: 20px; font-weight: 700; letter-spacing: 3px; border-bottom: 1px solid #222; margin-bottom: 10px; }
        .sidebar a { display: block; padding: 12px 24px; color: #aaa; text-decoration: none; font-size: 14px; }
        .sidebar a:hover { background: #1a1a1a; color: #fff; }
        .main { margin-left: 250px; padding: 30px; }
        .top-bar { background: white; padding: 16px 30px; margin: -30px -30px 30px; border-bottom: 1px solid #eee; }
        .img-group { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 14px; margin-bottom: 4px; }
        .img-group label { font-weight: 600; font-size: 13px; color: #444; margin-bottom: 8px; display: block; }
        .or-divider { text-align: center; color: #aaa; font-size: 12px; margin: 6px 0; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">BMW ADMIN</div>
    <a href="/admin">Dashboard</a>
    <a href="/admin/cars" style="color:#fff; border-left:3px solid #0066cc;">Manage Cars</a>
    <a href="/admin/products">Manage Products</a>
    <a href="/admin/orders">Orders</a>
    <a href="/admin/warranties">Warranties</a>
    <a href="/admin/reports">Sales Report</a>
    <a href="/admin/spareparts">SpareParts</a>
    <a href="/admin/messages">Messages</a>
    <hr style="border-color:#222; margin:10px 24px;">
    <a href="/">Back to Website</a>
</div>

<div class="main">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Add New Car</h5>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card border-0 shadow-sm p-4" style="max-width:760px;">
        <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required placeholder="contoh: ix, m3, x5">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category" class="form-select" required>
                        @foreach(['SUV','Sedan','Touring','Coupe','Convertible'] as $cat)
                        <option {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Series <span class="text-danger">*</span></label>
                    <input type="text" name="series" class="form-control" value="{{ old('series') }}" placeholder="contoh: i, X, M, 3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Drivetrain <span class="text-danger">*</span></label>
                    <select name="drivetrain" class="form-select" required>
                        @foreach(['Electric','Plug-in Hybrid','Petrol'] as $dt)
                        <option {{ old('drivetrain') == $dt ? 'selected' : '' }}>{{ $dt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                </div>

                {{-- GAMBAR 1 --}}
                <div class="col-12">
                    <div class="img-group">
                        <label>🖼️ Gambar Utama</label>
                        <label class="form-label small text-muted mb-1">Paste URL gambar:</label>
                        <input type="text" name="image" class="form-control form-control-sm mb-1" value="{{ old('image') }}" placeholder="https://...">
                        <div class="or-divider">— atau upload dari device —</div>
                        <input type="file" name="image_file" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted">Upload akan menggantikan URL di atas</small>
                    </div>
                </div>

                {{-- GAMBAR 2 --}}
                <div class="col-12">
                    <div class="img-group">
                        <label>🖼️ Gambar ke-2 <span class="text-muted fw-normal">(opsional)</span></label>
                        <label class="form-label small text-muted mb-1">Paste URL gambar:</label>
                        <input type="text" name="image2" class="form-control form-control-sm mb-1" value="{{ old('image2') }}" placeholder="https://...">
                        <div class="or-divider">— atau upload dari device —</div>
                        <input type="file" name="image2_file" class="form-control form-control-sm" accept="image/*">
                    </div>
                </div>

                {{-- GAMBAR 3 --}}
                <div class="col-12">
                    <div class="img-group">
                        <label>🖼️ Gambar ke-3 <span class="text-muted fw-normal">(opsional)</span></label>
                        <label class="form-label small text-muted mb-1">Paste URL gambar:</label>
                        <input type="text" name="image3" class="form-control form-control-sm mb-1" value="{{ old('image3') }}" placeholder="https://...">
                        <div class="or-divider">— atau upload dari device —</div>
                        <input type="file" name="image3_file" class="form-control form-control-sm" accept="image/*">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Engine</label>
                    <input type="text" name="engine" class="form-control" value="{{ old('engine') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Power</label>
                    <input type="text" name="power" class="form-control" value="{{ old('power') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Torque</label>
                    <input type="text" name="torque" class="form-control" value="{{ old('torque') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Acceleration</label>
                    <input type="text" name="acceleration" class="form-control" value="{{ old('acceleration') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Top Speed</label>
                    <input type="text" name="top_speed" class="form-control" value="{{ old('top_speed') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fuel Consumption</label>
                    <input type="text" name="fuel_consumption" class="form-control" value="{{ old('fuel_consumption') }}">
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary px-4">Add Car</button>
                    <a href="/admin/cars" class="btn btn-secondary px-4 ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>