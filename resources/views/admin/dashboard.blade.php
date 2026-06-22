<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
        .stat-card { border-radius: 12px; padding: 24px; color: white; }
        .top-bar { background: white; padding: 16px 30px; margin: -30px -30px 30px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">BMW ADMIN</div>
    <a href="/admin"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="/admin/cars"><i class="bi bi-car-front me-2"></i> Manage Cars</a>
    <a href="/admin/products"><i class="bi bi-bag me-2"></i> Manage Products</a>
    <a href="/admin/orders"><i class="bi bi-receipt me-2"></i> Orders</a>
    <a href="/admin/warranties"><i class="bi bi-shield-check me-2"></i> Warranties</a>
    <a href="/admin/reports" class="active"><i class="bi bi-graph-up me-2"></i> Sales Report</a>
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
        <h5 class="mb-0 fw-bold">Dashboard</h5>
        <span style="font-size:13px; color:#666;">Welcome, {{ Auth::user()->name }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card" style="background:#0066cc;">
                <div style="font-size:13px; opacity:0.8;">Total Cars</div>
                <div style="font-size:42px; font-weight:700;">{{ $totalCars }}</div>
                <a href="/admin/cars" style="color:rgba(255,255,255,0.7); font-size:13px;">Manage Cars →</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="background:#1D9E75;">
                <div style="font-size:13px; opacity:0.8;">Total Products</div>
                <div style="font-size:42px; font-weight:700;">{{ $totalProducts }}</div>
                <a href="/admin/products" style="color:rgba(255,255,255,0.7); font-size:13px;">Manage Products →</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="background:#cc6600;">
                <div style="font-size:13px; opacity:0.8;">Total Messages</div>
                <div style="font-size:42px; font-weight:700;">{{ $totalMessages }}</div>
                <a href="/admin/messages" style="color:rgba(255,255,255,0.7); font-size:13px;">View Messages →</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>