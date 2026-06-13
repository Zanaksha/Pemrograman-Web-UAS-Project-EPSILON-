@extends('layouts.mainlayout')
@section('title', 'Detail Produk')
@section('content')

<div style="height: 80px;"></div>

<style>
    .detail-wrap { max-width: 1100px; margin: 0 auto; padding: 40px 20px 80px; }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start; }
    .img-main { width: 100%; border-radius: 12px; object-fit: cover; height: 480px; background: #f5f5f5; }
    .thumb-row { display: flex; gap: 10px; margin-top: 14px; }
    .thumb-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid transparent; transition: border-color 0.2s; }
    .thumb-img.active { border-color: #0066cc; }
    .thumb-img:hover { border-color: #0066cc; }
    .badge-cat { display: inline-block; background: #f0f0f0; color: #555; font-size: 11px; letter-spacing: 2px; text-transform: uppercase; padding: 4px 12px; border-radius: 20px; margin-bottom: 14px; }
    .prod-name { font-size: 36px; font-weight: 700; color: #111; margin-bottom: 6px; }
    .prod-desc { font-size: 15px; color: #666; line-height: 1.7; margin-bottom: 24px; }
    .prod-price { font-size: 32px; font-weight: 700; color: #0066cc; margin-bottom: 28px; }
    .spec-box { background: #f8f8f8; border-radius: 12px; padding: 20px 24px; margin-bottom: 28px; }
    .spec-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; border-bottom: 1px solid #eee; }
    .spec-row:last-child { border-bottom: none; }
    .spec-row span:first-child { color: #888; }
    .spec-row span:last-child { font-weight: 500; color: #111; }
    .size-label { font-size: 13px; color: #666; margin-bottom: 10px; }
    .size-opts { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 24px; }
    .size-btn { width: 44px; height: 44px; border: 1.5px solid #ddd; border-radius: 8px; background: #fff; font-size: 13px; cursor: pointer; transition: all 0.2s; }
    .size-btn:hover { border-color: #0066cc; color: #0066cc; }
    .size-btn.active { border-color: #0066cc; background: #0066cc; color: #fff; }
    .btn-beli { display: block; width: 100%; padding: 16px; background: #0066cc; color: #fff; text-align: center; font-size: 15px; font-weight: 700; border-radius: 10px; text-decoration: none; border: none; cursor: pointer; transition: background 0.2s; margin-bottom: 12px; }
    .btn-beli:hover { background: #0055aa; color: #fff; }
    .breadcrumb-wrap { font-size: 13px; color: #999; margin-bottom: 30px; }
    .breadcrumb-wrap a { color: #999; text-decoration: none; }
    .breadcrumb-wrap a:hover { color: #111; }
    @media (max-width: 768px) {
        .detail-grid { grid-template-columns: 1fr; gap: 30px; }
        .prod-name { font-size: 28px; }
    }
</style>

<div class="detail-wrap">
    <div class="breadcrumb-wrap">
        <a href="/">Home</a> &rsaquo;
        <a href="/choosebuy">Shop</a> &rsaquo;
        <span id="breadName"></span>
    </div>

    <div class="detail-grid">
        <div>
            <img id="mainImg" class="img-main" src="" alt="Produk">
            <div class="thumb-row" id="thumbRow"></div>
        </div>

        <div>
            <span class="badge-cat" id="prodKategori"></span>
            <h1 class="prod-name" id="prodNama"></h1>
            <p class="prod-desc" id="prodDeskripsi"></p>
            <div class="prod-price" id="prodHarga"></div>

            <div class="spec-box">
                <div class="spec-row"><span>Brand</span><span id="specBrand"></span></div>
                <div class="spec-row"><span>Material</span><span id="specMaterial"></span></div>
                <div class="spec-row"><span>Kondisi</span><span>Baru</span></div>
                <div class="spec-row"><span>Garansi</span><span id="specGaransi"></span></div>
            </div>

            <div id="sizeSection">
                <p class="size-label">Pilih Ukuran:</p>
                <div class="size-opts" id="sizeOpts"></div>
            </div>

            <button class="btn-beli" id="btnBeli">Beli Sekarang</button>
        </div>
    </div>
</div>

    <script>
    const data = {
        nama: "{{ $produk->name ?? 'Produk' }}",
        kategori: "{{ $produk->category ?? '' }}",
        deskripsi: "{{ $produk->description ?? '' }}",
        harga: "Rp {{ number_format($produk->price ?? 0, 0, ',', '.') }}",
        hargaBeli: {{ $produk->price ?? 0 }},
        brand: 'BMW Lifestyle',
        material: '-',
        garansi: '-',
        ukuran: {!! $produk && $produk->sizes ? json_encode(explode(',', $produk->sizes)) : '[]' !!},
        gambar: ["{{ $produk->image ?? '' }}"]
    };

    document.getElementById('breadName').textContent = data.nama;
    document.getElementById('prodNama').textContent = data.nama;
    document.getElementById('prodKategori').textContent = data.kategori;
    document.getElementById('prodDeskripsi').textContent = data.deskripsi;
    document.getElementById('prodHarga').textContent = data.harga;
    document.getElementById('specBrand').textContent = data.brand;
    document.getElementById('specMaterial').textContent = data.material;
    document.getElementById('specGaransi').textContent = data.garansi;
    document.getElementById('mainImg').src = data.gambar[0];

    const thumbRow = document.getElementById('thumbRow');
    data.gambar.forEach((src, i) => {
        const img = document.createElement('img');
        img.src = src;
        img.className = 'thumb-img' + (i === 0 ? ' active' : '');
        img.onclick = function () {
            document.getElementById('mainImg').src = src;
            document.querySelectorAll('.thumb-img').forEach(t => t.classList.remove('active'));
            img.classList.add('active');
        };
        thumbRow.appendChild(img);
    });

   const sizeOpts = document.getElementById('sizeOpts');
    const sizeSection = document.getElementById('sizeSection');
    if (data.ukuran.length === 0) {
        sizeSection.style.display = 'none';
    } else {
        data.ukuran.forEach(uk => {
            const btn = document.createElement('button');
            btn.className = 'size-btn';
            btn.textContent = uk;
            btn.onclick = function () {
                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            };
            sizeOpts.appendChild(btn);
        });
    }

    document.getElementById('btnBeli').addEventListener('click', function() {
        @auth
        const activeSize = document.querySelector('.size-btn.active');
        const size = activeSize ? activeSize.textContent : '';
        window.location.href = `/beli-produk?produk=${encodeURIComponent(data.nama)}&harga=${data.hargaBeli}&size=${encodeURIComponent(size)}`;
        @else
        window.location.href = '/login';
        @endauth
    });
    </script>

@endsection