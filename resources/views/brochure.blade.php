<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; color: #111; }

        .header {
            background: #000;
            color: white;
            padding: 30px 40px;
        }
        .header h1 { font-size: 36px; letter-spacing: 4px; }
        .header p { font-size: 12px; letter-spacing: 2px; color: #aaa; margin-top: 4px; }
        .header-right { float: right; text-align: right; font-size: 12px; color: #aaa; }

        .model-name {
            font-size: 52px;
            font-weight: bold;
            text-align: center;
            padding: 30px 40px 6px;
            letter-spacing: 2px;
        }
        .model-sub {
            text-align: center;
            color: #888;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding-bottom: 10px;
        }
        .model-desc {
            text-align: center;
            color: #555;
            font-size: 13px;
            padding: 0 40px 20px;
        }

        .divider { border: none; border-top: 1px solid #eee; margin: 0 40px; }

        /* Specs */
        .specs { padding: 24px 40px; }
        .specs h2 {
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #0066cc;
            margin-bottom: 16px;
        }

        .spec-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }
        .spec-row .label { color: #888; }
        .spec-row .value { font-weight: bold; color: #111; }

        /* Features */
        .features { padding: 24px 40px; }
        .features h2 {
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #0066cc;
            margin-bottom: 16px;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .feature-item {
            background: #f8f8f8;
            padding: 14px 16px;
            border-radius: 6px;
        }
        .feature-item h3 { font-size: 13px; font-weight: bold; margin-bottom: 4px; }
        .feature-item p { font-size: 12px; color: #666; }

        .footer {
            background: #000;
            color: #aaa;
            text-align: center;
            padding: 16px;
            font-size: 11px;
            letter-spacing: 1px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <span class="header-right">Official Brochure<br>{{ date('Y') }}</span>
        <h1>BMW</h1>
        <p>THE ULTIMATE DRIVING MACHINE</p>
    </div>

    {{-- Gambar Mobil --}}
    @php
        $imageData = '';
        $imageExt = 'jpg';

        if ($model->image) {
            if (str_starts_with($model->image, 'http')) {
                // URL eksternal → cURL
                try {
                    $ch = curl_init($model->image);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    $raw = curl_exec($ch);
                    curl_close($ch);
                    if ($raw) {
                        $imageData = base64_encode($raw);
                        $imageExt = pathinfo(parse_url($model->image, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                    }
                } catch (\Exception $e) {}
            } else {
                // Coba beberapa kemungkinan path
                $candidates = [
                    public_path($model->image),                        // images/cars/file.png
                    public_path('images/cars/' . $model->image),       // file lama tanpa folder
                    public_path('images/' . $model->image),            // images/file.png
                ];
                foreach ($candidates as $path) {
                    if (file_exists($path)) {
                        $imageData = base64_encode(file_get_contents($path));
                        $imageExt = pathinfo($path, PATHINFO_EXTENSION);
                        break;
                    }
                }
            }
        }
    @endphp

    {{-- DEBUG sementara --}}
    <p>Image field: {{ $model->image }}</p>
    <p>Image data length: {{ strlen($imageData) }}</p>

    <div style="background:#f5f5f5; text-align:center; padding:30px 40px;">
        <div style="font-size:36px; font-weight:bold; color:#ddd;">BMW {{ $model->name }}</div>
    </div>

    {{-- Model Name --}}
    <div class="model-name">BMW {{ $model->name }}</div>
    <div class="model-sub">{{ $model->category }} — {{ $model->drivetrain }}</div>

    @if($model->slug === 'm3')
    <div class="model-desc">High-performance coupe dengan desain agresif dan tenaga besar.</div>
    @endif

    <hr class="divider">

    {{-- Specifications --}}
    <div class="specs">
    <h2>Specifications</h2>
    <div class="spec-row"><span class="label">Model</span><span class="value">BMW {{ $model->name }}</span></div>
    <div class="spec-row"><span class="label">Category</span><span class="value">{{ $model->category }}</span></div>
    <div class="spec-row"><span class="label">Series</span><span class="value">{{ $model->series }} Series</span></div>
    <div class="spec-row"><span class="label">Drivetrain</span><span class="value">{{ $model->drivetrain }}</span></div>
    @if($model->engine)
    <div class="spec-row"><span class="label">Engine</span><span class="value">{{ $model->engine }}</span></div>
    @endif
    @if($model->transmission)
    <div class="spec-row"><span class="label">Transmission</span><span class="value">{{ $model->transmission }}</span></div>
    @endif
    @if($model->power)
    <div class="spec-row"><span class="label">Power</span><span class="value">{{ $model->power }}</span></div>
    @endif
    @if($model->torque)
    <div class="spec-row"><span class="label">Torque</span><span class="value">{{ $model->torque }}</span></div>
    @endif
    @if($model->acceleration)
    <div class="spec-row"><span class="label">0-100 km/h</span><span class="value">{{ $model->acceleration }}</span></div>
    @endif
    @if($model->top_speed)
    <div class="spec-row"><span class="label">Top Speed</span><span class="value">{{ $model->top_speed }}</span></div>
    @endif
    @if($model->fuel_consumption)
    <div class="spec-row"><span class="label">Fuel Consumption</span><span class="value">{{ $model->fuel_consumption }}</span></div>
    @endif
    @if($model->price)
    <div class="spec-row"><span class="label">Price</span><span class="value">Rp {{ number_format($model->price, 0, ',', '.') }}</span></div>
    @endif
</div>

    <hr class="divider">

    {{-- Key Features --}}
<div class="features">
    <h2>Key Features</h2>
    <div class="feature-grid">

        @if(in_array($model->slug, ['ix', 'ix1', 'i7', 'i5', 'i4']))
        <div class="feature-item"><h3>&#9889; 100% Electric</h3><p>Zero emission driving with instant torque delivery.</p></div>
        <div class="feature-item"><h3>&#128187; BMW iDrive</h3><p>Advanced infotainment system with curved display.</p></div>
        <div class="feature-item"><h3>&#128737; Driving Assistant Pro</h3><p>Advanced safety and driver assistance systems.</p></div>
        <div class="feature-item"><h3>&#128267; Fast Charging</h3><p>DC fast charging up to 200 kW for quick recharge.</p></div>

        @elseif(in_array($model->slug, ['m3', 'm4']))
        <div class="feature-item"><h3>&#127955; M Sport Design</h3><p>Aggressive exterior with aerodynamic enhancements.</p></div>
        <div class="feature-item"><h3>&#127358; M Carbon Roof</h3><p>Lightweight carbon roof for lower center of gravity.</p></div>
        <div class="feature-item"><h3>&#128186; M Sport Seats</h3><p>Premium sport seats with perfect support and comfort.</p></div>
        <div class="feature-item"><h3>&#128737; Driving Assistant</h3><p>Advanced safety and driver assistance systems.</p></div>

        @elseif(in_array($model->slug, ['x5', 'x3', 'xm']))
        <div class="feature-item"><h3>&#9881; xDrive AWD</h3><p>Intelligent all-wheel drive for maximum traction.</p></div>
        <div class="feature-item"><h3>&#9728; Panoramic Roof</h3><p>Large panoramic glass roof for open-air feeling.</p></div>
        <div class="feature-item"><h3>&#128663; Air Suspension</h3><p>Adaptive air suspension for comfort and performance.</p></div>
        <div class="feature-item"><h3>&#128737; Driving Assistant Pro</h3><p>Advanced safety and driver assistance systems.</p></div>

        @else
        <div class="feature-item"><h3>&#128187; BMW Live Cockpit</h3><p>Digital instrument cluster with navigation display.</p></div>
        <div class="feature-item"><h3>&#128273; Comfort Access</h3><p>Keyless entry and start for maximum convenience.</p></div>
        <div class="feature-item"><h3>&#128737; Driving Assistant</h3><p>Advanced safety and driver assistance systems.</p></div>
        <div class="feature-item"><h3>&#127925; Harman Kardon Audio</h3><p>Premium sound system for ultimate audio experience.</p></div>
        @endif

    </div>
</div>

    {{-- Footer --}}
    <div class="footer">
        © {{ date('Y') }} BMW AG. All rights reserved. &nbsp;|&nbsp; www.bmw.co.id
    </div>

</body>
</html>