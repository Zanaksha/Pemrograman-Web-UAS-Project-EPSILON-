<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Warranties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #111; color: white; padding: 20px 0; width: 250px; position: fixed; }
        .sidebar .brand { padding: 20px 24px; font-size: 20px; font-weight: 700; letter-spacing: 3px; border-bottom: 1px solid #222; margin-bottom: 10px; }
        .sidebar a { display: block; padding: 12px 24px; color: #aaa; text-decoration: none; font-size: 14px; transition: 0.2s; }
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
<<<<<<< HEAD
    <a href="/admin/warranties"><i class="bi bi-shield-check me-2"></i> Warranties</a>
    <a href="/admin/messages"><i class="bi bi-envelope me-2"></i> Messages</a>
    <a href="/admin/orders" class="active"><i class="bi bi-cart-check me-2"></i> Orders</a>
=======
    <a href="/admin/warranties" class="active"><i class="bi bi-shield-check me-2"></i> Warranties</a>
    <a href="/admin/messages"><i class="bi bi-envelope me-2"></i> Messages</a>
>>>>>>> a312fddf1c54c060e6fe6f65d67bf1c7575797a3
    <hr style="border-color:#222; margin:10px 24px;">
    <a href="/"><i class="bi bi-house me-2"></i> Back to Website</a>
    <form method="POST" action="{{ route('logout') }}" style="padding:0 24px; margin-top:10px;">
        @csrf
<<<<<<< HEAD
        <button type="submit" style="width:100%; padding:10px; background:#cc0000; color:white; border:none; border-radius:6px; cursor:pointer;">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
=======
        <button type="submit" style="width:100%; padding:10px; background:#cc0000; color:white; border:none; border-radius:6px; cursor:pointer;">Logout</button>
>>>>>>> a312fddf1c54c060e6fe6f65d67bf1c7575797a3
    </form>
</div>

<div class="main">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Manage Warranties</h5>
        <a href="/admin/warranties/create" class="btn btn-primary btn-sm">+ Add Warranty</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead style="background:#f5f5f5;">
                    <tr>
                        <th>No</th>
                        <th>VIN</th>
                        <th>Owner</th>
                        <th>Car Model</th>
                        <th>Year</th>
                        <th>Warranty End</th>
                        <th>Status</th>
                        <th>Service</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($warranties as $i => $w)
                    @php
                        $badge = $w->status_badge;
                        $badgeClass = match($badge) {
                            'active' => 'bg-success',
                            'expired' => 'bg-danger',
                            'expiring_soon' => 'bg-warning text-dark',
                            default => 'bg-secondary'
                        };
                        $badgeText = match($badge) {
                            'active' => 'Active',
                            'expired' => 'Expired',
                            'expiring_soon' => 'Expiring Soon',
                            default => 'Void'
                        };
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><code>{{ $w->vin }}</code></td>
                        <td>{{ $w->owner_name }}</td>
                        <td>{{ $w->car_model }}</td>
                        <td>{{ $w->car_year }}</td>
                        <td>{{ \Carbon\Carbon::parse($w->warranty_end)->format('d M Y') }}</td>
                        <td><span class="badge {{ $badgeClass }}">{{ $badgeText }}</span></td>
                        <td><span class="badge bg-secondary">{{ $w->serviceHistories->count() }} records</span></td>
                        <td>
                            <a href="/admin/warranties/{{ $w->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="/admin/warranties/{{ $w->id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Belum ada data warranty.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>