@extends('layouts.mainlayout')
@section('title','Models')
@section('content')

<style>
    body { background: #f5f5f5; }

    .sidebar {
        background: white;
        padding: 20px;
        border-right: 1px solid #ddd;
        margin-top: 110px;
        height: 805px;
    }

    .filter-btn {
        border: 1px solid #ccc;
        padding: 15px;
        text-align: center;
        border-radius: 6px;
        background: white;
        transition: 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: #000;
        display: block;
    }

    .filter-btn:hover { background: #f0f0f0; color: #000; }

    .filter-btn.active {
        background: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .car-card {
        background: white;
        padding: 20px;
        border-radius: 4px;
        transition: 0.3s;
        height: 100%;
    }

    .car-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .car-card img {
        width: 100%;
        height: 180px;
        object-fit: contain;
    }

    .badge-type {
        background: #e5e5e5;
        padding: 3px 8px;
        font-size: 12px;
        border-radius: 3px;
        display: inline-block;
        margin-bottom: 10px;
    }

    .electric { color: #007bff; font-size: 14px; margin-top: 10px; }
</style>

      <div class="container-fluid">
          <div class="row">

              <!-- Sidebar -->
              <div class="col-md-3 sidebar">

              <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="mb-0">Categories</h4>
          <a  href="/models" style="font-size:12px; color:#dc3545; text-decoration:none;">✕ Reset</a>
      </div>

      <div class="row g-2">
          <div class="col-6">
            <a href="/models?category=SUV" class="filter-btn {{ request('category') == 'SUV' ? 'active' : '' }}">SUV</a>
          </div>
            
          <div class="col-6">
            <a href="/models?category=Sedan" class="filter-btn {{ request('category') == 'Sedan' ? 'active' : '' }}">Sedan</a>
          </div>

          <div class="col-6">
              <a href="/models?category=Touring" class="filter-btn {{ request('category') == 'Touring' ? 'active' : '' }}">Touring</a>
          </div>

          <div class="col-6">
              <a href="/models?category=Coupe" class="filter-btn {{ request('category') == 'Coupe' ? 'active' : '' }}">Coupe</a>
          </div>

          <div class="col-6">
              <a href="/models?category=Convertible" class="filter-btn {{ request('category') == 'Convertible' ? 'active' : '' }}">Convertible</a>
          </div>
        </div>

          <hr class="my-4">
              <h4 class="mb-3">Series</h4>
                  <div class="row g-2">
                    @foreach(['i','X','3','4','5','7','Z'] as $s)
                    <div class="col-4">
                        <a href="/models?series={{ $s }}" class="filter-btn {{ request('series') == $s ? 'active' : '' }}">{{ $s }}</a>
                    </div>
                    @endforeach
                  </div>

          <hr class="my-4">
            <h4 class="mb-3">Drivetrain variants</h4>
              <div class="row g-2">
                <div class="col-6">
                    <a href="/models?drivetrain=Electric" class="filter-btn {{ request('drivetrain') == 'Electric' ? 'active' : '' }}">100% Electric</a>
                </div>

                <div class="col-6">
                    <a href="/models?drivetrain=Plug-in Hybrid" class="filter-btn {{ request('drivetrain') == 'Plug-in Hybrid' ? 'active' : '' }}">Plug-in Hybrid</a>
                </div>

                <div class="col-6">
                    <a href="/models?drivetrain=Petrol" class="filter-btn {{ request('drivetrain') == 'Petrol' ? 'active' : '' }}">Petrol</a>
                </div>

            </div>
        </div>

        <!-- Content -->
        <div class="col-md-9 p-4 mt-4">

            <!-- {{-- Info filter aktif --}}
            @if(request('category') || request('series') || request('drivetrain'))
                <div style="margin-bottom:16px; font-size:13px; color:#666;">
                    Filter aktif:
                    @if(request('category')) <span style="background:#e0e7ff; padding:3px 10px; border-radius:20px; margin-right:6px;">{{ request('category') }}</span> @endif
                    @if(request('series')) <span style="background:#e0e7ff; padding:3px 10px; border-radius:20px; margin-right:6px;">Series {{ request('series') }}</span> @endif
                    @if(request('drivetrain')) <span style="background:#e0e7ff; padding:3px 10px; border-radius:20px;">{{ request('drivetrain') }}</span> @endif
                    <a href="/models" style="color:#dc3545; margin-left:10px; font-size:12px;">✕ Reset</a>
                </div>
            @endif -->
<br/>
            <div class="row g-4 mt-2">
                @forelse($models as $model)
                <div class="col-md-4">
                    <div class="car-card" onclick="window.location.href='/{{ $model->slug }}'">
                        <span class="badge-type">{{ $model->category }}</span>
                        <h1>{{ $model->name }}</h1>
                        <p>Model</p>

                        @php $image = $model->image; @endphp
                        @if(str_starts_with($image, 'http'))
                            <img src="{{ $image }}" alt="{{ $model->name }}">
                        @else
                            <img src="{{ asset('images/' . basename($image)) }}" alt="{{ $model->name }}">
                        @endif

                        <div class="electric">{{ $model->drivetrain }}</div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p style="color:#999; font-size:16px;">Tidak ada model yang ditemukan.</p>
                    <a href="/models" style="color:#0d6efd;">Lihat semua model</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection