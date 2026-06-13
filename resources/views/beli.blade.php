@extends('layouts.mainlayout')
@section('title', 'Beli Online')
@section('content')

<div style="height: 80px;"></div>

<style>
    .buy-wrap { max-width: 900px; margin: 0 auto; padding: 40px 20px 80px; }

    .steps { display: flex; align-items: center; margin-bottom: 40px; }
    .step-item { display: flex; align-items: center; gap: 8px; flex: 1; }
    .step-num {
        width: 30px; height: 30px; border-radius: 50%;
        border: 2px solid #333; display: flex; align-items: center;
        justify-content: center; font-size: 13px; font-weight: 600;
        color: #666; background: #fff; flex-shrink: 0; transition: all 0.3s;
    }
    .step-num.active { background: #0066cc; border-color: #0066cc; color: #fff; }
    .step-num.done { background: #1D9E75; border-color: #1D9E75; color: #fff; }
    .step-label { font-size: 13px; color: #999; }
    .step-label.active { color: #111; font-weight: 600; }
    .step-line { flex: 1; height: 1px; background: #e0e0e0; margin: 0 8px; }
    .step-line.done { background: #1D9E75; }

    .panel { display: none; }
    .panel.active { display: block; }

    .section-title { font-size: 15px; color: #666; margin-bottom: 20px; }

    .cars { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 10px; }
    .car-card {
        border: 2px solid #e0e0e0; border-radius: 12px;
        padding: 16px; cursor: pointer; transition: border-color 0.2s, background 0.2s;
        text-align: center;
    }
    .car-card:hover { border-color: #0066cc; }
    .car-card.selected { border-color: #0066cc; background: #f0f7ff; }
    .car-card .car-emoji { font-size: 32px; margin-bottom: 8px; }
    .car-card .car-name { font-size: 14px; font-weight: 600; color: #111; margin-bottom: 4px; }
    .car-card .car-price { font-size: 13px; color: #0066cc; }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group label { font-size: 13px; color: #666; }
    .form-group input, .form-group select {
        height: 42px; border: 1.5px solid #ddd; border-radius: 8px;
        padding: 0 12px; font-size: 14px; color: #111;
        outline: none; transition: border-color 0.2s; width: 100%;
    }
    .form-group input:focus, .form-group select:focus { border-color: #0066cc; }

    .pay-opts { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 10px; }
    .pay-opt {
        border: 2px solid #e0e0e0; border-radius: 12px;
        padding: 20px 10px; text-align: center; cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
    }
    .pay-opt:hover { border-color: #0066cc; }
    .pay-opt.selected { border-color: #0066cc; background: #f0f7ff; }
    .pay-opt .pay-emoji { font-size: 28px; margin-bottom: 8px; }
    .pay-opt .pay-name { font-size: 14px; font-weight: 600; color: #111; }
    .pay-opt .pay-desc { font-size: 12px; color: #999; margin-top: 4px; }

    .summary-box {
        background: #f8f8f8; border-radius: 12px;
        padding: 20px 24px; margin-bottom: 20px;
    }
    .summary-row {
        display: flex; justify-content: space-between;
        padding: 10px 0; font-size: 14px;
        border-bottom: 1px solid #eee;
    }
    .summary-row:last-child { border-bottom: none; font-weight: 700; font-size: 15px; }
    .summary-row span:last-child { color: #0066cc; }

    .nav-btns { display: flex; justify-content: space-between; margin-top: 24px; }
    .btn-next {
        background: #0066cc; color: #fff; border: none;
        border-radius: 8px; padding: 0 28px; height: 42px;
        font-size: 14px; cursor: pointer; transition: background 0.2s; font-weight: 600;
    }
    .btn-next:hover { background: #0055aa; }
    .btn-back {
        background: transparent; color: #666;
        border: 1.5px solid #ddd; border-radius: 8px;
        padding: 0 22px; height: 42px; font-size: 14px; cursor: pointer;
    }
    .btn-back:hover { background: #f5f5f5; }

    .err { font-size: 12px; color: #cc0000; margin-top: 8px; display: none; }

    .success-box { text-align: center; padding: 40px 20px; }
    .success-icon {
        width: 72px; height: 72px; border-radius: 50%;
        background: #e8f5e9; display: flex; align-items: center;
        justify-content: center; margin: 0 auto 20px; font-size: 32px;
    }
    .success-box h2 { font-size: 24px; font-weight: 700; color: #111; margin-bottom: 10px; }
    .success-box p { font-size: 14px; color: #666; margin-bottom: 6px; }
    .order-id {
        display: inline-block; margin-top: 12px;
        background: #f0f0f0; border-radius: 8px;
        padding: 8px 20px; font-family: monospace;
        font-size: 13px; color: #444;
    }

    @media (max-width: 768px) {
        .cars { grid-template-columns: repeat(2, 1fr); }
        .pay-opts { grid-template-columns: 1fr; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>

<div class="buy-wrap">

    {{-- Step bar --}}
    <div class="steps" id="stepsBar">
        <div class="step-item">
            <div class="step-num active" id="sn1">1</div>
            <span class="step-label active" id="sl1">Pilih Mobil</span>
        </div>
        <div class="step-line" id="line1"></div>
        <div class="step-item">
            <div class="step-num" id="sn2">2</div>
            <span class="step-label" id="sl2">Data Pembeli</span>
        </div>
        <div class="step-line" id="line2"></div>
        <div class="step-item">
            <div class="step-num" id="sn3">3</div>
            <span class="step-label" id="sl3">Pembayaran</span>
        </div>
        <div class="step-line" id="line3"></div>
        <div class="step-item">
            <div class="step-num" id="sn4">4</div>
            <span class="step-label" id="sl4">Konfirmasi</span>
        </div>
    </div>

    {{-- Step 1: Pilih Mobil --}}
    <div class="panel active" id="panel1">
        <p class="section-title">Pilih model BMW yang ingin dibeli:</p>
        <div class="cars">
            <div class="car-card" onclick="selectCar(this,'BMW 3 Series','Rp 750.000.000')">
                <div class="car-emoji">🚗</div>
                <div class="car-name">BMW 3 Series</div>
                <div class="car-price">Rp 750.000.000</div>
            </div>
            <div class="car-card" onclick="selectCar(this,'BMW 5 Series','Rp 1.100.000.000')">
                <div class="car-emoji">🚙</div>
                <div class="car-name">BMW 5 Series</div>
                <div class="car-price">Rp 1.100.000.000</div>
            </div>
            <div class="car-card" onclick="selectCar(this,'BMW X5','Rp 1.450.000.000')">
                <div class="car-emoji">🚕</div>
                <div class="car-name">BMW X5</div>
                <div class="car-price">Rp 1.450.000.000</div>
            </div>
            <div class="car-card" onclick="selectCar(this,'BMW M3','Rp 1.850.000.000')">
                <div class="car-emoji">🏎️</div>
                <div class="car-name">BMW M3</div>
                <div class="car-price">Rp 1.850.000.000</div>
            </div>
            <div class="car-card" onclick="selectCar(this,'BMW iX','Rp 1.950.000.000')">
                <div class="car-emoji">⚡</div>
                <div class="car-name">BMW iX</div>
                <div class="car-price">Rp 1.950.000.000</div>
            </div>
            <div class="car-card" onclick="selectCar(this,'BMW 7 Series','Rp 2.350.000.000')">
                <div class="car-emoji">👑</div>
                <div class="car-name">BMW 7 Series</div>
                <div class="car-price">Rp 2.350.000.000</div>
            </div>
        </div>
        <p class="err" id="err1">Pilih model mobil terlebih dahulu.</p>
        <div class="nav-btns">
            <span></span>
            <button class="btn-next" onclick="goStep(2)">Lanjut &rarr;</button>
        </div>
    </div>

    {{-- Step 2: Data Pembeli --}}
    <div class="panel" id="panel2">
        <p class="section-title">Isi data diri pembeli:</p>
        <div class="form-row">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" id="f_nama" placeholder="">
            </div>
            <div class="form-group">
                <label>No. KTP</label>
                <input type="text" id="f_ktp" placeholder="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="f_email" placeholder="">
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" id="f_telp" placeholder="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Kota</label>
                <input type="text" id="f_kota" placeholder="">
            </div>
            <div class="form-group">
                <label>Warna Mobil</label>
                <select id="f_warna">
                    <option value="">Pilih warna</option>
                    <option>Alpine White</option>
                    <option>Black Sapphire</option>
                    <option>Mineral Grey</option>
                    <option>Portimao Blue</option>
                    <option>Melbourne Red</option>
                </select>
            </div>
        </div>
        <p class="err" id="err2">Lengkapi semua data terlebih dahulu.</p>
        <div class="nav-btns">
            <button class="btn-back" onclick="goStep(1)">&larr; Kembali</button>
            <button class="btn-next" onclick="goStep(3)">Lanjut &rarr;</button>
        </div>
    </div>

   {{-- Step 3: Pembayaran --}}
<div class="panel" id="panel3">
    <p class="section-title">Pilih metode pembayaran:</p>
    <div class="pay-opts">
        <div class="pay-opt" onclick="selectPay(this,'Midtrans')">
            <div class="pay-emoji">💳</div>
            <div class="pay-name">Bayar Online</div>
            <div class="pay-desc">Via Midtrans (Transfer, QRIS, dll)</div>
        </div>
        <div class="pay-opt" onclick="selectPay(this,'Kredit / Cicilan')">
            <div class="pay-emoji">📋</div>
            <div class="pay-name">Kredit</div>
            <div class="pay-desc">Cicilan bulanan</div>
        </div>
        <div class="pay-opt" onclick="selectPay(this,'Leasing BMW')">
            <div class="pay-emoji">🏦</div>
            <div class="pay-name">Leasing</div>
            <div class="pay-desc">BMW Financial Services</div>
        </div>
    </div>
    <p class="err" id="err3">Pilih metode pembayaran.</p>
    <div class="nav-btns">
        <button class="btn-back" onclick="goStep(2)">&larr; Kembali</button>
        <button class="btn-next" onclick="goStep(4)">Lanjut &rarr;</button>
    </div>
</div>

    {{-- Step 4: Konfirmasi --}}
    <div class="panel" id="panel4">
        <p class="section-title">Ringkasan pesanan kamu:</p>
        <div class="summary-box" id="summaryBox"></div>
        <div class="nav-btns">
            <button class="btn-back" onclick="goStep(3)">&larr; Kembali</button>
            <button class="btn-next" onclick="submitOrder()">Konfirmasi Pesanan ✓</button>
        </div>
    </div>

    {{-- Step 5: Sukses --}}
    <div class="panel" id="panel5">
        <div class="success-box">
            <div class="success-icon">✅</div>
            <h2>Pesanan Berhasil!</h2>
            <p>Terima kasih telah memesan BMW.</p>
            <p>Tim kami akan menghubungi kamu dalam 1x24 jam.</p>
            <p id="successDetail" style="margin-top:10px; font-weight:600; color:#0066cc;"></p>
            <div class="order-id" id="orderId"></div>
            <div style="margin-top:30px;">
                <button class="btn-next" onclick="resetAll()">Pesan Lagi</button>
            </div>
        </div>
    </div>

</div>

<script>
    let state = { step: 1, car: '', price: '', pay: '' };

    function selectCar(el, name, price) {
        document.querySelectorAll('.car-card').forEach(c => c.classList.remove('selected'));
        el.classList.add('selected');
        state.car = name;
        state.price = price;
        document.getElementById('err1').style.display = 'none';
    }

    function selectPay(el, name) {
        document.querySelectorAll('.pay-opt').forEach(p => p.classList.remove('selected'));
        el.classList.add('selected');
        state.pay = name;
        document.getElementById('err3').style.display = 'none';
    }

    function goStep(n) {
        if (n === 2 && !state.car) {
            document.getElementById('err1').style.display = 'block';
            return;
        }
        if (n === 3) {
            const fields = ['f_nama','f_ktp','f_email','f_telp','f_kota','f_warna'];
            const empty = fields.some(id => !document.getElementById(id).value.trim());
            if (empty) {
                document.getElementById('err2').style.display = 'block';
                return;
            }
        }
        if (n === 4) {
            if (!state.pay) {
                document.getElementById('err3').style.display = 'block';
                return;
            }
            buildSummary();
        }
        showStep(n);
    }

    function buildSummary() {
        const nama  = document.getElementById('f_nama').value;
        const kota  = document.getElementById('f_kota').value;
        const warna = document.getElementById('f_warna').value;
        const email = document.getElementById('f_email').value;
        document.getElementById('summaryBox').innerHTML = `
            <div class="summary-row"><span>Model</span><span>${state.car}</span></div>
            <div class="summary-row"><span>Warna</span><span>${warna}</span></div>
            <div class="summary-row"><span>Pembeli</span><span>${nama}</span></div>
            <div class="summary-row"><span>Email</span><span>${email}</span></div>
            <div class="summary-row"><span>Kota</span><span>${kota}</span></div>
            <div class="summary-row"><span>Pembayaran</span><span>${state.pay}</span></div>
            <div class="summary-row"><span>Total Harga</span><span>${state.price}</span></div>
        `;
    }

    function showStep(n) {
        for (let i = 1; i <= 5; i++) {
            document.getElementById('panel' + i).classList.toggle('active', i === n);
        }
        for (let i = 1; i <= 4; i++) {
            const num = document.getElementById('sn' + i);
            const lbl = document.getElementById('sl' + i);
            num.className = 'step-num' + (i < n ? ' done' : i === n ? ' active' : '');
            lbl.className = 'step-label' + (i === n ? ' active' : '');
            if (i < 4) {
                document.getElementById('line' + i).className = 'step-line' + (i < n ? ' done' : '');
            }
            num.textContent = i < n ? '✓' : i;
        }
        state.step = n;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function submitOrder() {
        const nama  = document.getElementById('f_nama').value;
        const email = document.getElementById('f_email').value;
        const telp  = document.getElementById('f_telp').value;
        const kota  = document.getElementById('f_kota').value;
        const warna = document.getElementById('f_warna').value;
        const hargaAngka = parseInt(state.price.replace(/[^0-9]/g, ''));

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
                kota: kota,
                model: state.car,
                warna: warna,
                harga: hargaAngka,
                type: 'car'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('orderId').textContent = 'Order ID: ' + data.order_id;
                document.getElementById('successDetail').textContent = state.car + ' — ' + state.price;
                showStep(5);
            }
        })
        .catch(err => alert('Terjadi kesalahan, coba lagi.'));
    }
function resetAll() {
    window.location.href = '/buycar';
}

  document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const model = params.get('model');
    const harga = params.get('harga');

    if (model && harga) {
        const container = document.querySelector('.cars');
        container.innerHTML = '';

        const newCard = document.createElement('div');
        newCard.className = 'car-card selected';
        newCard.style.borderColor = '#0066cc';
        newCard.style.background = '#f0f7ff';
        newCard.innerHTML = `
            <div class="car-emoji">🚗</div>
            <div class="car-name">${model}</div>
            <div class="car-price">${harga}</div>
        `;
        container.appendChild(newCard);

        state.car = model;
        state.price = harga;
    }

    function submitOrder() {
    const nama  = document.getElementById('f_nama').value;
    const ktp   = document.getElementById('f_ktp').value;
    const email = document.getElementById('f_email').value;
    const telp  = document.getElementById('f_telp').value;
    const kota  = document.getElementById('f_kota').value;
    const warna = document.getElementById('f_warna').value;

    fetch('/order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            nama, ktp, email, telp, kota, warna,
            model: state.car,
            harga: state.price,
            pembayaran: state.pay
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('orderId').textContent = 'Order ID: ' + data.order_id;
            document.getElementById('successDetail').textContent = state.car + ' — ' + state.price;
            showStep(5);
        }
    })
    .catch(err => {
        alert('Gagal membuat order. Coba lagi!');
    });
}
});
</script>

@endsection