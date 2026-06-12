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
    .btn-wishlist { display: block; width: 100%; padding: 14px; background: transparent; color: #333; text-align: center; font-size: 15px; font-weight: 500; border-radius: 10px; text-decoration: none; border: 1.5px solid #ddd; cursor: pointer; transition: all 0.2s; }
    .btn-wishlist:hover { border-color: #333; background: #f5f5f5; }
    .breadcrumb-wrap { font-size: 13px; color: #999; margin-bottom: 30px; }
    .breadcrumb-wrap a { color: #999; text-decoration: none; }
    .breadcrumb-wrap a:hover { color: #111; }

    @media (max-width: 768px) {
        .detail-grid { grid-template-columns: 1fr; gap: 30px; }
        .prod-name { font-size: 28px; }
    }
</style>

<div class="detail-wrap">

    {{-- Breadcrumb --}}
    <div class="breadcrumb-wrap">
        <a href="/">Home</a> &rsaquo;
        <a href="/choosebuy">Shop</a> &rsaquo;
        <span id="breadName">Sneakers</span>
    </div>

    <div class="detail-grid">

        {{-- Kiri: Gambar --}}
        <div>
            <img id="mainImg" class="img-main" src="" alt="Produk">
            <div class="thumb-row" id="thumbRow"></div>
        </div>

        {{-- Kanan: Info --}}
        <div>
            <span class="badge-cat" id="prodKategori">Footwear</span>
            <h1 class="prod-name" id="prodNama">Sneakers</h1>
            <p class="prod-desc" id="prodDeskripsi">Deskripsi produk akan tampil di sini.</p>
            <div class="prod-price" id="prodHarga">1.200.000</div>

            {{-- Spesifikasi --}}
            <div class="spec-box">
                <div class="spec-row"><span>Brand</span><span id="specBrand">-</span></div>
                <div class="spec-row"><span>Material</span><span id="specMaterial">-</span></div>
                <div class="spec-row"><span>Kondisi</span><span>Baru</span></div>
                <div class="spec-row"><span>Garansi</span><span id="specGaransi">-</span></div>
            </div>

            {{-- Pilih Ukuran --}}
            <div id="sizeSection">
                <p class="size-label">Pilih Ukuran:</p>
                <div class="size-opts" id="sizeOpts"></div>
            </div>

            {{-- Tombol --}}
            <a href="#" class="btn-beli" id="btnBeli">Beli Sekarang</a>
          
        </div>

    </div>
</div>

<script>
    const produkData = {
        'sneakers': {
            nama: 'Sneakers',
            kategori: 'Footwear',
            deskripsi: 'Sepatu sneakers modern dengan desain stylish dan nyaman dipakai sehari-hari. Cocok untuk aktivitas casual maupun olahraga ringan.',
            harga: '1.200.000',
            hargaBeli: '1200000',
            brand: 'Nike',
            material: 'Mesh & Rubber',
            garansi: '6 Bulan',
            ukuran: ['38','39','40','41','42','43'],
            gambar: [
                'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
                'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=600',
                'https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=600',
            ]
        },
        'hoodie': {
            nama: 'Hoodie',
            kategori: 'Clothing',
            deskripsi: 'Hoodie casual dengan bahan premium yang lembut dan hangat. Desain minimalis cocok untuk berbagai gaya berpakaian.',
            harga: '90.000',
            hargaBeli: '90000',
            brand: 'BMW Lifestyle',
            material: 'Cotton Fleece',
            garansi: '3 Bulan',
            ukuran: ['S','M','L','XL','XXL'],
            gambar: [
                'https://images.unsplash.com/photo-1556821840-3a63f15732ce?w=600',
                'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?w=600',
            ]
        },
        'watch': {
            nama: 'Watch',
            kategori: 'Accessories',
            deskripsi: 'Jam tangan premium dengan desain elegan dan mekanisme presisi tinggi. Cocok untuk tampilan formal maupun casual.',
            harga: '$250',
            hargaBeli: '250',
            brand: 'BMW Collection',
            material: 'Stainless Steel',
            garansi: '2 Tahun',
            ukuran: [],
            gambar: [
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600',
                'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=600',
            ]
        },
        'tshirt': {
            nama: 'T-Shirt',
            kategori: 'Clothing',
            deskripsi: 'Kaos oversized modern dengan bahan cotton premium yang nyaman dan breathable. Pilihan warna yang stylish.',
            harga: '$50',
            hargaBeli: '50',
            brand: 'BMW Lifestyle',
            material: '100% Cotton',
            garansi: '3 Bulan',
            ukuran: ['S','M','L','XL','XXL'],
            gambar: [
                'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600',
                'https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=600',
            ]
        },
        'jacket': {
            nama: 'Jacket',
            kategori: 'Clothing',
            deskripsi: 'Jaket winter fashion premium dengan bahan tebal dan hangat. Desain modern yang cocok untuk musim dingin.',
            harga: '$180',
            hargaBeli: '180',
            brand: 'BMW Lifestyle',
            material: 'Wool Blend',
            garansi: '6 Bulan',
            ukuran: ['S','M','L','XL'],
            gambar: [
                'https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?w=600',
                'https://images.unsplash.com/photo-1548126032-079a0fb0099d?w=600',
            ]
        },
        'running-shoes': {
            nama: 'Running Shoes',
            kategori: 'Footwear',
            deskripsi: 'Sepatu lari performa tinggi dengan teknologi cushioning terbaru. Ringan dan responsif untuk mendukung aktivitas olahraga.',
            harga: '$150',
            hargaBeli: '150',
            brand: 'BMW Sport',
            material: 'Knit & EVA Foam',
            garansi: '6 Bulan',
            ukuran: ['38','39','40','41','42','43','44'],
            gambar: [
                'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600',
            ]
        },
    };

    // Ambil parameter dari URL
    const params = new URLSearchParams(window.location.search);
    const produkKey = params.get('produk') || 'sneakers';
    const data = produkData[produkKey] || produkData['sneakers'];

    // Isi data
    document.getElementById('breadName').textContent = data.nama;
    document.getElementById('prodNama').textContent = data.nama;
    document.getElementById('prodKategori').textContent = data.kategori;
    document.getElementById('prodDeskripsi').textContent = data.deskripsi;
    document.getElementById('prodHarga').textContent = data.harga;
    document.getElementById('specBrand').textContent = data.brand;
    document.getElementById('specMaterial').textContent = data.material;
    document.getElementById('specGaransi').textContent = data.garansi;

    // Gambar utama
    document.getElementById('mainImg').src = data.gambar[0];

    // Thumbnail
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

    // Ukuran
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

    // Tombol beli
    document.getElementById('btnBeli').href = `/beli?model=${encodeURIComponent(data.nama)}&harga=${encodeURIComponent(data.harga)}&skip=1`;

    document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const model = params.get('model');
    const harga = params.get('harga');
    const skip = params.get('skip');

    if (model && harga) {
        state.car = model;
        state.price = harga;

        if (skip === '1') {
            // Langsung loncat ke step 2
            showStep(2);
        }
    }
});
</script>

@endsection