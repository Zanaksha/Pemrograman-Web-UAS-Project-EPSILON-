<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
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
        .stat-card { border-radius: 12px; padding: 22px; color: white; }
        .filter-card { background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; }
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
        <h5 class="mb-0 fw-bold">Sales Report</h5>
        <button onclick="window.print()" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-printer"></i> Print Report
        </button>
    </div>

    {{-- Filter Tanggal --}}
    <div class="filter-card">
        <form method="GET" action="{{ route('admin.reports') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold">From Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">To Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-filter"></i> Apply Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="background:#0066cc;">
                <div style="font-size:12px; opacity:0.8;">Total Revenue</div>
                <div style="font-size:24px; font-weight:700;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:#1D9E75;">
                <div style="font-size:12px; opacity:0.8;">Total Orders</div>
                <div style="font-size:24px; font-weight:700;">{{ $totalOrders }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:#f57f17;">
                <div style="font-size:12px; opacity:0.8;">Pending</div>
                <div style="font-size:24px; font-weight:700;">{{ $pendingOrders }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:#6c757d;">
                <div style="font-size:12px; opacity:0.8;">Delivered</div>
                <div style="font-size:24px; font-weight:700;">{{ $deliveredOrders }}</div>
            </div>
        </div>
    </div>

    {{-- Chart + Top Models --}}
    <div class="row g-4 mb-4">
        <!-- <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Sales Trend</h6>
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Top Selling Models</h6>
                @forelse($topModels as $model => $count)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small">{{ $model }}</span>
                    <span class="badge bg-primary">{{ $count }}</span>
                </div>
                @empty
                <p class="text-muted small text-center">No data available</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Table Detail --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead style="background:#f5f5f5;">
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Model</th>
                        <th>Payment</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $i => $order)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><code>{{ $order->order_id }}</code></td>
                        <td>{{ $order->nama }}</td>
                        <td>{{ $order->model }}</td>
                        <td>{{ $order->pembayaran }}</td>
                        <td>{{ $order->harga }}</td>
                        <td>
                            <span class="badge {{ $order->status === 'delivered' ? 'bg-success' : ($order->status === 'confirmed' ? 'bg-primary' : 'bg-warning text-dark') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No orders in this period.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const chartData = @json($chartData);
    const labels = Object.keys(chartData);
    const revenues = labels.map(d => chartData[d].revenue);
    const counts = labels.map(d => chartData[d].count);

    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Revenue (Rp)',
                    data: revenues,
                    borderColor: '#0066cc',
                    backgroundColor: 'rgba(0,102,204,0.1)',
                    yAxisID: 'y',
                    tension: 0.3,
                    fill: true,
                },
                {
                    label: 'Orders Count',
                    data: counts,
                    borderColor: '#1D9E75',
                    backgroundColor: 'rgba(29,158,117,0.1)',
                    yAxisID: 'y1',
                    tension: 0.3,
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { type: 'linear', position: 'left', title: { display: true, text: 'Revenue' } },
                y1: { type: 'linear', position: 'right', title: { display: true, text: 'Orders' }, grid: { drawOnChartArea: false } }
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>