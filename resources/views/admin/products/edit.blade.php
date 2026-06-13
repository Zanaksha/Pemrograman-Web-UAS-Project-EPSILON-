<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
    <a href="/admin">Dashboard</a>
    <a href="/admin/cars">Manage Cars</a>
    <a href="/admin/products" style="color:#fff; border-left:3px solid #0066cc;">Manage Products</a>
    <a href="/admin/messages">Messages</a>
    <hr style="border-color:#222; margin:10px 24px;">
    <a href="/">Back to Website</a>
</div>

<div class="main">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Edit Product — {{ $product->name }}</h5>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card border-0 shadow-sm p-4" style="max-width:600px;">
       <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        @foreach(['Footwear','Clothing','Accessories'] as $cat)
                        <option {{ $product->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Sizes <small class="text-muted">(pisah dengan koma, contoh: S,M,L,XL atau 38,39,40)</small></label>
                    <input type="text" name="sizes" class="form-control" value="{{ $product->sizes }}" placeholder="Kosongkan jika tidak ada ukuran">
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                </div>
                 <div class="col-12">
            <label class="form-label">Image</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset($product->image) }}" width="100" height="70" style="object-fit:cover; border-radius:6px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
        </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary px-4">Update Product</button>
                    <a href="/admin/products" class="btn btn-secondary px-4 ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>