<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #111;
            color: white;
            padding: 20px 0;
            width: 250px;
            position: fixed;
        }
        .sidebar .brand {
            padding: 20px 24px;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 3px;
            border-bottom: 1px solid #222;
            margin-bottom: 10px;
        }
        .sidebar a {
            display: block;
            padding: 12px 24px;
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }
        .sidebar a:hover, .sidebar a.active { background: #1a1a1a; color: #fff; border-left: 3px solid #0066cc; }
        .main { margin-left: 250px; padding: 30px; }
        .top-bar { background: white; padding: 16px 30px; margin: -30px -30px 30px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">BMW ADMIN</div>
    <a href="/admin"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="/admin/cars"><i class="bi bi-car-front me-2"></i> Manage Cars</a>
    <a href="/admin/products"><i class="bi bi-bag me-2"></i> Manage Products</a>
    <a href="/admin/warranties"><i class="bi bi-shield-check me-2"></i> Warranties</a>
    <a href="/admin/messages"><i class="bi bi-envelope me-2"></i> Messages</a>
    <a href="/admin/orders" class="active"><i class="bi bi-cart-check me-2"></i> Orders</a>
    <hr style="border-color:#222; margin:10px 24px;">
    <a href="/"><i class="bi bi-house me-2"></i> Back to Website</a>
    <form method="POST" action="{{ route('logout') }}" style="padding:0 24px; margin-top:10px;">
        @csrf
        <button type="submit" style="width:100%; padding:10px; background:#cc0000; color:white; border:none; border-radius:6px; cursor:pointer;">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</div>

<div class="main">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Orders</h5>
        <span style="font-size:13px; color:#666;">Welcome, {{ Auth::user()->name }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Model</th>
                <th>Warna</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->nama }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->model }}</td>
                <td>{{ $order->warna }}</td>
                <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                <td>
                    <span class="badge 
                        {{ $order->status == 'pending' ? 'bg-warning text-dark' : '' }}
                        {{ $order->status == 'confirmed' ? 'bg-success' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-danger' : '' }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td>
                    <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm d-inline w-auto">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary ms-1">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Belum ada pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>