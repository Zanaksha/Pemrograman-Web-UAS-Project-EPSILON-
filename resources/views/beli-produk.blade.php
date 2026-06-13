@extends('layouts.mainlayout')
@section('title', 'Beli Produk')
@section('content')

<div style="height: 80px;"></div>

<style>
    .buy-wrap { max-width: 700px; margin: 0 auto; padding: 40px 20px 80px; }
    .summary-box { background: #f8f8f8; border-radius: 12px; padding: 20px 24px; margin-bottom: 24px; }
    .summary-row { display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px; border-bottom: 1px solid #eee; }
    .summary-row:last-child { border-bottom: none; font-weight: 700; font-size: 15px; }
    .summary-row span:last-child { color: #0066cc; }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .form-group label { font-size: 13px; color: #666; }
    .form-group input { height: 42px; border: 1.5px solid #ddd; border-radius: 8px; padding: 0 12px; font-size: 14px; outline: none; }
    .form-group input:focus { border-color: #0066cc; }
    .btn-next { background: #0066cc; color: #fff; border: none; border-radius: 8px; padding: 0 28px; height: 42px; font-size: 14px; cursor: pointer; font-weight: 600; width: 100%; margin-top: 10px; }
    .btn-next:hover { background: #0055aa; }
    .success-box { text-align: center; padding: 40px 20px; display: none; }
    .success-icon { width: 72px; height: 72px; border-radius: 50%; background: #e8f5e9; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 32px; }
</style>

<div class="buy-wrap">
    <h2 class="fw-bold mb-4">Checkout Produk</h2>

    <div id="formSection">
        <div class="summary-box">
            <div class="summary-row"><span>Produk</span><span id="produkNama"></span></div>
            <div class="summary-row"><span>Total Harga</span><span id="produkHarga"></span></div>
            <div class="summary-row"><span>Ukuran</span><span id="produkSize"></span></div>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" id="f_nama" placeholder="Nama kamu">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" id="f_email" placeholder="Email kamu">
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" id="f_telp" placeholder="08xxxxxxxxxx">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" id="f_alamat" placeholder="Alamat pengiriman">
        </div>

        <p style="font-size:13px; color:#666; margin-top:16px;">
            💳 Transfer ke rekening: <strong>BCA 1234567890 a/n EPSILON BMW</strong>
        </p>

        <button class="btn-next" onclick="submitOrder()">Konfirmasi Pesanan ✓</button>
    </div>

    <div class="success-box" id="successBox">
        <div class="success-icon">✅</div>
        <h2>Pesanan Berhasil!</h2>
        <p>Terima kasih telah berbelanja di EPSILON.</p>
        <p>Tim kami akan menghubungi kamu dalam 1x24 jam.</p>
        <p id="successDetail" style="font-weight:600; color:#0066cc; margin-top:10px;"></p>
        <div style="background:#f0f0f0; border-radius:8px; padding:8px 20px; display:inline-block; margin-top:12px; font-family:monospace;" id="orderId"></div>
        <div style="margin-top:30px;">
            <a href="/choosebuy" class="btn-next" style="display:inline-block; text-decoration:none; padding: 12px 28px; width:auto;">Belanja Lagi</a>
        </div>
    </div>
</div>

<script>
const params = new URLSearchParams(window.location.search);
const produk = params.get('produk') || '';
const harga = params.get('harga') || 0;
const size = params.get('size') || '';

document.getElementById('produkNama').textContent = produk;
document.getElementById('produkHarga').textContent = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
document.getElementById('produkSize').textContent = size || '-';

function submitOrder() {
    const nama = document.getElementById('f_nama').value.trim();
    const email = document.getElementById('f_email').value.trim();
    const telp = document.getElementById('f_telp').value.trim();
    const alamat = document.getElementById('f_alamat').value.trim();

    if (!nama || !email || !telp || !alamat) {
        alert('Lengkapi semua data terlebih dahulu!');
        return;
    }

    fetch('/order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            nama: nama,
            email: email,
            phone: telp,
            kota: alamat,
            model: produk,
            warna: '-',
            size: size,
            harga: parseInt(harga),
            type: 'product'
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('formSection').style.display = 'none';
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('orderId').textContent = 'Order ID: ' + data.order_id;
            document.getElementById('successDetail').textContent = produk + ' — Rp ' + parseInt(harga).toLocaleString('id-ID');
        }
    })
    .catch(err => alert('Terjadi kesalahan, coba lagi.'));
}
</script>

@endsection