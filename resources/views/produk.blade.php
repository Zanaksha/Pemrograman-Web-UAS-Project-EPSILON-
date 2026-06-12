<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Otomotif</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #0d0d0d; color: #fff; padding: 30px 20px; min-height: 100vh; }

        .header { text-align: center; margin-bottom: 36px; }
        .header h1 { font-size: 34px; letter-spacing: 6px; text-transform: uppercase; font-weight: 700; }
        .header p { color: #666; font-size: 12px; letter-spacing: 2px; margin-top: 6px; text-transform: uppercase; }

        .filter-bar {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .filter-btn {
            padding: 8px 22px;
            border-radius: 30px;
            border: 1px solid #333;
            background: transparent;
            color: #aaa;
            font-size: 13px;
            cursor: pointer;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.2s;
        }
        .filter-btn:hover { border-color: #0066cc; color: #fff; }
        .filter-btn.active { background: #0066cc; border-color: #0066cc; color: #fff; }

        #loading {
            text-align: center;
            padding: 60px 20px;
        }
        .spinner {
            border: 3px solid #222;
            border-top: 3px solid #0066cc;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 14px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        #loading p { color: #555; font-size: 13px; letter-spacing: 1px; }

        .info-bar {
            text-align: center;
            color: #444;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        #model-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 14px;
        }

        .card {
            background: #161616;
            border: 1px solid #222;
            border-radius: 12px;
            padding: 22px 16px;
            text-align: center;
            transition: border-color 0.2s, transform 0.2s;
            cursor: default;
        }
        .card:hover { border-color: #0066cc; transform: translateY(-3px); }

        .card-icon {
            width: 48px;
            height: 48px;
            background: #0d1f33;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 22px;
        }
        .card .model-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .card .make-badge {
            display: inline-block;
            background: #0d1f33;
            color: #4d9fff;
            font-size: 10px;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            border: 1px solid #1a3a66;
        }

        .no-data {
            text-align: center;
            color: #444;
            padding: 60px 20px;
            font-size: 14px;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Auto Katalog</h1>
    <p>Data kendaraan via NHTSA — National Highway Traffic Safety Administration</p>
</div>

{{-- Filter merk --}}
<div class="filter-bar">
    <button class="filter-btn active" onclick="loadModels('BMW', this)">BMW</button>
    <button class="filter-btn" onclick="loadModels('Toyota', this)">Toyota</button>
    <button class="filter-btn" onclick="loadModels('Honda', this)">Honda</button>
    <button class="filter-btn" onclick="loadModels('Mercedes-Benz', this)">Mercedes</button>
    <button class="filter-btn" onclick="loadModels('Audi', this)">Audi</button>
</div>

{{-- Info jumlah data --}}
<p class="info-bar" id="info-bar"></p>

{{-- Loading --}}
<div id="loading">
    <div class="spinner"></div>
    <p>Mengambil data...</p>
</div>

{{-- Grid model --}}
<div id="model-list" style="display:none;"></div>

<script>
    const icons = { 'BMW': '🔵', 'Toyota': '🔴', 'Honda': '⚪', 'Mercedes-Benz': '⭐', 'Audi': '⚙️' };

    function loadModels(merk, btn) {
        // Update tombol aktif
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Tampilkan loading
        const loading = document.getElementById('loading');
        const list = document.getElementById('model-list');
        const infoBar = document.getElementById('info-bar');

        loading.style.display = 'block';
        list.style.display = 'none';
        list.innerHTML = '';
        infoBar.textContent = '';

        axios.get(`https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformake/${merk}?format=json`)
            .then(function (response) {
                const semua = response.data.Results;
                const models = semua.slice(0, 10);

                if (models.length === 0) {
                    list.innerHTML = '<p class="no-data">Tidak ada data ditemukan.</p>';
                } else {
                    const icon = icons[merk] || '🚗';
                    models.forEach(function (item) {
                        list.innerHTML += `
                            <div class="card">
                                <div class="card-icon">${icon}</div>
                                <p class="model-name">${item.Model_Name}</p>
                                <span class="make-badge">${item.Make_Name}</span>
                            </div>
                        `;
                    });
                }

                infoBar.textContent = `Menampilkan 10 dari ${semua.length} model ${merk}`;
                loading.style.display = 'none';
                list.style.display = 'grid';
            })
            .catch(function () {
                loading.innerHTML = '<p style="color:#cc3333;">Gagal mengambil data. Cek koneksi internet!</p>';
            });
    }

    // Load BMW saat halaman pertama dibuka
    loadModels('BMW', document.querySelector('.filter-btn.active'));
</script>

</body>
</html>