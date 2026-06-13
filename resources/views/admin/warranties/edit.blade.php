<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Warranty</title>
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
    <a href="/admin/warranties" class="active"><i class="bi bi-shield-check me-2"></i> Warranties</a>
    <a href="/admin/messages"><i class="bi bi-envelope me-2"></i> Messages</a>
    <hr style="border-color:#222; margin:10px 24px;">
    <a href="/"><i class="bi bi-house me-2"></i> Back to Website</a>
</div>

<div class="main">
    <div class="top-bar">
        <h5 class="mb-0 fw-bold">Edit Warranty — {{ $warranty->vin }}</h5>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="row g-4">

        {{-- Edit Form --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Warranty Details</h6>
                <form method="POST" action="{{ route('admin.warranties.update', $warranty->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">VIN Number</label>
                            <input type="text" name="vin" class="form-control" value="{{ $warranty->vin }}" required style="text-transform:uppercase; letter-spacing:2px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Owner Name</label>
                            <input type="text" name="owner_name" class="form-control" value="{{ $warranty->owner_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Owner Email</label>
                            <input type="email" name="owner_email" class="form-control" value="{{ $warranty->owner_email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Car Model</label>
                            <select name="car_model" class="form-select">
                                @foreach(['BMW iX','BMW iX1','BMW i7','BMW i5','BMW i4','BMW M3','BMW M4','BMW X5','BMW X3','BMW XM','BMW 7 Series','BMW 4 Series','BMW 3 Series'] as $model)
                                <option {{ $warranty->car_model == $model ? 'selected' : '' }}>{{ $model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Car Year</label>
                            <select name="car_year" class="form-select">
                                @for($y = date('Y'); $y >= 2018; $y--)
                                <option {{ $warranty->car_year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Purchase Date</label>
                            <input type="date" name="purchase_date" class="form-control" value="{{ $warranty->purchase_date }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Warranty Start</label>
                            <input type="date" name="warranty_start" class="form-control" value="{{ $warranty->warranty_start }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Warranty End</label>
                            <input type="date" name="warranty_end" class="form-control" value="{{ $warranty->warranty_end }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $warranty->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ $warranty->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                <option value="void" {{ $warranty->status == 'void' ? 'selected' : '' }}>Void</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $warranty->notes }}</textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-4">Update Warranty</button>
                            <a href="/admin/warranties" class="btn btn-secondary px-4 ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Service History --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h6 class="fw-bold mb-3">Add Service History</h6>
                <form method="POST" action="{{ route('admin.service.store', $warranty->id) }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col-12">
                            <label class="form-label small">Service Date</label>
                            <input type="date" name="service_date" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small">Service Type</label>
                            <select name="service_type" class="form-select form-select-sm">
                                <option>Routine Maintenance</option>
                                <option>Oil Change</option>
                                <option>Brake Service</option>
                                <option>Tire Rotation</option>
                                <option>Engine Repair</option>
                                <option>Electrical Service</option>
                                <option>AC Service</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small">Description</label>
                            <textarea name="description" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Technician</label>
                            <input type="text" name="technician" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Cost (Rp)</label>
                            <input type="number" name="cost" class="form-control form-control-sm" value="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label small">Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-success btn-sm w-100">+ Add Service Record</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Service History List --}}
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Service History ({{ $warranty->serviceHistories->count() }})</h6>
                @forelse($warranty->serviceHistories->sortByDesc('service_date') as $history)
                <div style="border-left:3px solid #0066cc; padding:10px 14px; margin-bottom:12px; background:#f8f8f8; border-radius:0 8px 8px 0;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <strong style="font-size:13px;">{{ $history->service_type }}</strong>
                        <span class="badge {{ $history->status === 'completed' ? 'bg-success' : ($history->status === 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}" style="font-size:11px;">
                            {{ ucfirst($history->status) }}
                        </span>
                    </div>
                    <div style="font-size:12px; color:#888; margin-top:4px;">
                        {{ \Carbon\Carbon::parse($history->service_date)->format('d M Y') }}
                        @if($history->technician) · {{ $history->technician }} @endif
                    </div>
                    @if($history->description)
                    <div style="font-size:12px; color:#555; margin-top:4px;">{{ $history->description }}</div>
                    @endif
                    <div style="font-size:12px; color:#0066cc; margin-top:4px; font-weight:600;">
                        Rp {{ number_format($history->cost, 0, ',', '.') }}
                    </div>
                </div>
                @empty
                <p class="text-muted small text-center">No service records yet.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>