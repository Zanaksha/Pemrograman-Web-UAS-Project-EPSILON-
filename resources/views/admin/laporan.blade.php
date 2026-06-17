<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #111; color: white; padding: 20px 0; width: 250px; position: fixed; }
        .sidebar .brand { padding: 20px 24px; font-size: 20px; font-weight: 700; letter-spacing: 3px; border-bottom: 1px solid #222; margin-bottom: 10px; }
        .sidebar a { display: block; padding: 12px 24px; color: #aaa; text-decoration: none; font-size: 14px; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: #1a1a1a; color: #fff; border-left: 3px solid #0066cc; }
        .main { margin-left: 250px; padding: 30px; }
        .top-bar { background: white; padding: 16px 30px; margin: -30px -30px 30px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .stat-card { border-radius: 12px; padding: 24px; color: white; }
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
    <a href="/admin/orders"><i class="bi bi-cart-check me-2"></i> Orders</a>
    <a href="/admin/laporan" class="active"><i class="bi bi-bar-chart me-2"></i> Laporan</a>
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
        <h5 class="mb-0 fw-bold">Laporan Penjualan</h5>
        <span style="font-size:13px; color:#666;">Welcome, {{ Auth::user()->name }}</span>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="background:#0066cc;">
                <div style="font-size:13px; opacity:0.8;">Total Pendapatan</div>
                <div style="font-size:24px; font-weight:700;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div style="font-size:12px; opacity:0.7;">Dari order confirmed</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:#1D9E75;">
                <div style="font-size:13px; opacity:0.8;">Total Order</div>
                <div style="font-size:24px; font-weight:700;">{{ $totalOrder }}</div>
                <div style="font-size:12px; opacity:0.7;">Semua status</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:#28a745;">
                <div style="font-size:13px; opacity:0.8;">Order Confirmed</div>
                <div style="font-size:24px; font-weight:700;">{{ $orderConfirmed }}</div>
                <div style="font-size:12px; opacity:0.7;">Berhasil</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:#dc3545;">
                <div style="font-size:13px; opacity:0.8;">Order Cancelled</div>
                <div style="font-size:24px; font-weight:700;">{{ $orderCancelled }}</div>
                <div style="font-size:12px; opacity:0.7;">Dibatalkan</div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Status Order</h6>
                <canvas id="statusChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Order Per Bulan</h6>
                <canvas id="bulanChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Terlaris --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">🚗 Mobil Terlaris</h6>
                <table class="table table-hover">
                    <thead><tr><th>Model</th><th>Total Order</th></tr></thead>
                    <tbody>
                        @forelse($mobilTerlaris as $m)
                        <tr>
                            <td>{{ $m->model }}</td>
                            <td><span class="badge bg-primary">{{ $m->total }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="text-center text-muted">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">🛍️ Produk Terlaris</h6>
                <table class="table table-hover">
                    <thead><tr><th>Produk</th><th>Total Order</th></tr></thead>
                    <tbody>
                        @forelse($produkTerlaris as $p)
                        <tr>
                            <td>{{ $p->model }}</td>
                            <td><span class="badge bg-success">{{ $p->total }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="text-center text-muted">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Order Per Bulan Table --}}
    <div class="card border-0 shadow-sm p-4">
        <h6 class="fw-bold mb-3">📅 Rincian Per Bulan</h6>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr><th>Bulan</th><th>Total Order</th><th>Pendapatan</th></tr>
            </thead>
            <tbody>
                @foreach($orderPerBulan as $o)
                <tr>
                    <td>{{ \Carbon\Carbon::create($o->tahun, $o->bulan)->format('F Y') }}</td>
                    <td>{{ $o->total }}</td>
                    <td>Rp {{ number_format($o->pendapatan, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
// Status Chart
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Confirmed', 'Pending', 'Cancelled'],
        datasets: [{
            data: [{{ $orderConfirmed }}, {{ $orderPending }}, {{ $orderCancelled }}],
            backgroundColor: ['#28a745', '#ffc107', '#dc3545']
        }]
    }
});

// Bulan Chart
new Chart(document.getElementById('bulanChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($orderPerBulan->map(fn($o) => \Carbon\Carbon::create($o->tahun, $o->bulan)->format('M Y'))->toArray()) !!},
        datasets: [{
            label: 'Total Order',
            data: {!! json_encode($orderPerBulan->pluck('total')->toArray()) !!},
            backgroundColor: '#0066cc'
        }]
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>