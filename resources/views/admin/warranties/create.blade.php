<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Warranty</title>
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
        <h5 class="mb-0 fw-bold">Add New Warranty</h5>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card border-0 shadow-sm p-4" style="max-width:700px;">
        <form method="POST" action="{{ route('admin.warranties.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                     <label class="form-label fw-semibold">VIN Number</label>
                        <div class="input-group">
                            <input type="text" name="vin" id="vinInput" class="form-control" placeholder="e.g. WBA12345678901234" value="{{ old('vin') }}" required style="text-transform:uppercase; letter-spacing:2px;">
                            <button type="button" class="btn btn-secondary" onclick="generateVIN()">Generate VIN</button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Pilih dari Order</label>
                        <select class="form-select" onchange="fillOwner(this)">
                            <option value="">-- Pilih Pemesan --</option>
                            @foreach($orders as $order)
                            <option value="{{ $order->nama }}|{{ $order->email }}|{{ $order->model }}">
                                {{ $order->nama }} - {{ $order->model }} ({{ $order->order_id }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Owner Name</label>
                        <input type="text" name="owner_name" id="ownerName" class="form-control" value="{{ old('owner_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Owner Email</label>
                        <input type="email" name="owner_email" id="ownerEmail" class="form-control" value="{{ old('owner_email') }}" required>
                    </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Car Model</label>
                    <select name="car_model" class="form-select">
                        @foreach(['BMW iX','BMW iX1','BMW i7','BMW i5','BMW i4','BMW M3','BMW M4','BMW X5','BMW X3','BMW XM','BMW 7 Series','BMW 4 Series','BMW 3 Series'] as $model)
                        <option>{{ $model }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Car Year</label>
                    <select name="car_year" class="form-select">
                        @for($y = date('Y'); $y >= 2018; $y--)
                        <option>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Purchase Date</label>
                    <input type="date" name="purchase_date" class="form-control" value="{{ old('purchase_date') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Warranty Start</label>
                    <input type="date" name="warranty_start" class="form-control" value="{{ old('warranty_start') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Warranty End</label>
                    <input type="date" name="warranty_end" class="form-control" value="{{ old('warranty_end') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="void">Void</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Notes</label>
                    <textarea name="notes" class="form-control" rows="3" placeholder="Optional notes...">{{ old('notes') }}</textarea>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary px-4">Save Warranty</button>
                    <a href="/admin/warranties" class="btn btn-secondary px-4 ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function generateVIN() {
        const chars = 'ABCDEFGHJKLMNPRSTUVWXYZ0123456789';
        let vin = 'WBA';
        for (let i = 0; i < 14; i++) {
            vin += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('vinInput').value = vin;
    }

    function fillOwner(select) {
        const val = select.value;
        if (!val) return;
        const parts = val.split('|');
        document.getElementById('ownerName').value = parts[0];
        document.getElementById('ownerEmail').value = parts[1];
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>