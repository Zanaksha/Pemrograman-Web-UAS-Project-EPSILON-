@extends('layouts.mainlayout')

@section('title','Find a Dealer')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #0d0d0d; color: #fff; }

        .header {
            text-align: center;
            padding: 36px 20px 24px;
            border-bottom: 1px solid #1a1a1a;
        }
        .header h1 { font-size: 30px; letter-spacing: 6px; text-transform: uppercase; }
        .header p { color: #555; font-size: 12px; letter-spacing: 2px; margin-top: 6px; text-transform: uppercase; }

        .layout {
            display: flex;
            height: calc(100vh - 110px);
        }

        .sidebar {
            width: 320px;
            min-width: 320px;
            background: #111;
            border-right: 1px solid #1a1a1a;
            overflow-y: auto;
        }

        #loading {
            text-align: center;
            padding: 40px 20px;
        }
        #loading p {
            color: #555;
            font-size: 12px;
            letter-spacing: 1px;
            margin-top: 12px;
        }
        .bmw-spinner {
            width: 60px;
            height: 60px;
            margin: 0 auto;
            animation: spin 1.2s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .dealer-item {
            padding: 16px 18px;
            border-bottom: 1px solid #1a1a1a;
            cursor: pointer;
            transition: background 0.2s;
        }
        .dealer-item:hover { background: #161f2e; }
        .dealer-item.active { background: #0d1f33; border-left: 3px solid #0066cc; }
        .dealer-item h3 { font-size: 13px; font-weight: 600; color: #fff; margin-bottom: 4px; }
        .dealer-item p { font-size: 11px; color: #555; line-height: 1.5; }
        .dealer-item .telp { color: #4d9fff; font-size: 11px; margin-top: 4px; }

        .map-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .map-info {
            background: #111;
            padding: 12px 20px;
            border-bottom: 1px solid #1a1a1a;
            font-size: 12px;
            color: #555;
            letter-spacing: 1px;
        }
        .map-info span { color: #4d9fff; }

        iframe {
            flex: 1;
            border: none;
            width: 100%;
        }
        
    </style>
</head>
<body>

<div class="header">
    <h1>Find a Dealer</h1>
    <p>10 Official Dealer Locations — Click to view on the map</p>
</div>

<div class="layout">

    <div class="sidebar">
        <div id="loading">
            <svg class="bmw-spinner" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="48" fill="none" stroke="#222" stroke-width="3"/>
                <circle cx="50" cy="50" r="48" fill="none" stroke="#0066cc" stroke-width="3"
                    stroke-dasharray="80 220" stroke-linecap="round" transform="rotate(-90 50 50)"/>
                <circle cx="50" cy="50" r="35" fill="#1a1a1a" stroke="#333" stroke-width="1"/>
                <path d="M50,15 A35,35 0 0,1 85,50 L50,50 Z" fill="#fff"/>
                <path d="M50,50 L85,50 A35,35 0 0,1 50,85 Z" fill="#0066cc"/>
                <path d="M50,85 A35,35 0 0,1 15,50 L50,50 Z" fill="#fff"/>
                <path d="M50,50 L15,50 A35,35 0 0,1 50,15 Z" fill="#0066cc"/>
                <circle cx="50" cy="50" r="10" fill="#1a1a1a" stroke="#333" stroke-width="1"/>
                <text x="50" y="54" text-anchor="middle" fill="#fff" font-size="7" font-weight="bold" letter-spacing="1">BMW</text>
            </svg>
            <p>retrieving dealer data...</p>
        </div>
        <div id="dealer-list"></div>
    </div>

    <div class="map-area">
        <div class="map-info">Lokasi: <span id="map-label">Pilih dealer di sebelah kiri</span></div>
        <iframe id="map-frame"
            src="https://www.google.com/maps?q=-6.2297,106.8201&z=15&output=embed"
            allowfullscreen>
        </iframe>
    </div>

</div>

<script>
    axios.get('/data/dealer-bmw.json')
        .then(function (response) {
            const dealers = response.data;

            setTimeout(function () {
                const list = document.getElementById('dealer-list');
                document.getElementById('loading').style.display = 'none';

                dealers.forEach(function (dealer, index) {
                    const item = document.createElement('div');
                    item.className = 'dealer-item' + (index === 0 ? ' active' : '');
                    item.innerHTML = `
                        <h3>${dealer.nama}</h3>
                        <p>${dealer.alamat}</p>
                        <p class="telp">${dealer.telepon}</p>
                    `;
                    item.onclick = function () {
                        document.querySelectorAll('.dealer-item').forEach(d => d.classList.remove('active'));
                        item.classList.add('active');
                        document.getElementById('map-frame').src =
                            `https://www.google.com/maps?q=${dealer.lat},${dealer.lng}&z=16&output=embed`;
                        document.getElementById('map-label').textContent = dealer.nama;
                    };
                    list.appendChild(item);
                });

            }, 2000);
        })
        .catch(function () {
            document.getElementById('loading').innerHTML =
                '<p style="color:#cc3333; padding:20px;">Gagal memuat data dealer!</p>';
        });
</script>

@endsection