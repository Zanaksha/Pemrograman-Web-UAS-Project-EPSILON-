@extends('layouts.mainlayout')

@section('title','Buy Car')

@section('content')
 
  <style>
    body{
      background: #f5f5f5;
    }

    .sidebar{
      background: white;
      padding: 20px;
      border-right: 1px solid #ddd;
      height: 100vh;
    }

    .filter-btn{
      border: 1px solid #ccc;
      padding: 15px;
      text-align: center;
      border-radius: 6px;
      background: white;
      transition: 0.3s;
      cursor: pointer;
    }

    .filter-btn:hover{
      background: #f0f0f0;
    }

    .car-card{
      background: white;
      padding: 20px;
      border-radius: 4px;
      transition: 0.3s;
      height: 100%;
    }

    .car-card:hover{
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .car-card img{
      width: 100%;
      height: 180px;
      object-fit: contain;
    }

    .badge-type{
      background: #e5e5e5;
      padding: 3px 8px;
      font-size: 12px;
      border-radius: 3px;
      display: inline-block;
      margin-bottom: 10px;
    }

    .electric{
      color: #007bff;
      font-size: 14px;
      margin-top: 10px;
    }

    .sidebar {
        margin-top: 110px;
        height: 805px;
    }
    
    .link{
       color: #007bff;
       font-size: 14px;
       margin-top: 10px;
    }

    .buy-btn{
    background: white;
    color: black;
    border: none;
    padding: 8px 20px;
    border-radius: 30px;
    font-weight: 600;
    transition: 0.3s;
}

.buy-btn:hover{
    background: #0d6efd;
    color: white;
}

  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

 <!-- Sidebar -->
<div class="col-md-3 sidebar">

  <h4 class="mb-4">Categories</h4>

  <!-- CATEGORY -->
  <div class="row g-2">

    <div class="col-6">
      <div class="filter-btn">SUV</div>
    </div>

    <div class="col-6">
      <div class="filter-btn">Touring</div>
    </div>

    <div class="col-6">
      <div class="filter-btn">Sedan</div>
    </div>

    <div class="col-6">
      <div class="filter-btn">Coupe</div>
    </div>

    <div class="col-6">
      <div class="filter-btn">Convertible</div>
    </div>

  </div>

  <hr class="my-4">

  <!-- SERIES -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Series</h4>
  
  </div>

  <div class="row g-2">

    <div class="col-4">
      <div class="filter-btn">X</div>
    </div>

    <div class="col-4">
      <div class="filter-btn">2</div>
    </div>

    <div class="col-4">
      <div class="filter-btn">3</div>
    </div>

    <div class="col-4">
      <div class="filter-btn">4</div>
    </div>

    <div class="col-4">
      <div class="filter-btn">5</div>
    </div>

    <div class="col-4">
      <div class="filter-btn">7</div>
    </div>

    <div class="col-4">
      <div class="filter-btn">Z</div>
    </div>

  </div>

  <hr class="my-4">

  <!-- DRIVETRAIN -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Drivetrain variants</h4>
  
  </div>

  <div class="row g-2">

    <div class="col-6">
      <div class="filter-btn">
        100% Electric
      </div>
    </div>

    <div class="col-6">
      <div class="filter-btn">
        Plug-in Hybrid
      </div>
    </div>

    <div class="col-6">
      <div class="filter-btn">
        Petrol
      </div>
    </div>

  </div>

</div>

    <!-- Content -->
    <div class="col-md-9 p-4">
        
      <h2 class="mb-4 text-white opacity-0">Full Electric</h2>

      <div class="row g-4 mt-4" >
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="car-card" onclick="window.location.href='/shop'">
            <span class="badge-type">SUV</span>
            <h1>iX</h1>
            <p>Model</p>
            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-7331pKAuhFqIbVBIHS91Zys8%25P6EaURyfNwOTjHADv6Ojd%25p12aKkiH0scCuHVsaAb0%25lR2oubWTkFKqvLB9oeWF5Ga2ysId4e%257SxfBzAF3aJQbAFKdqf62lKwLVM%258w0KETayVqTbhBHHS9WZFSrCWcFtTjO3GgiTQdjcjTW3azDx4o1dnkq8cF4zOALUxKPkIFJG8WkABKupC9PFeWS6ldbKMPVYXzsWhbNmQFnPo90yW7NbHi4TPYR9%25wc3bKHiftxd9WDw178ziZqtECUkw5z7slGAtadCrXpF7sDlZQ6KCrrXRaYWlH8Q5nmPX%25QagOybQB7nvIT9FoZO2B3iKHvIjedwWChBDMztPuzeqhk7bSEMLoAC9VLhJHFlievou%25KXwD6HSfWQrgu%25V1PaZcMfNEbnRx310s9O5z6E4riIgkAscZwBvg7rxRte2yzZ857MjgRRUgChDS35Gvlovsggp2XH2yyv6jQ%25j1t2YDafD6xjmBjVwsoH0%25l05zxO4WsyZOvdImvhjVB5xbZP%25F6Y8snGXMESk%25CaDi2aKSAmxscCEI5s%25rt3Xe" alt="" >
            <div class="electric">Electric</div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4" onclick="window.location.href='/shop2'">
          <div class="car-card" onclick="window.location.href='/shop2'">

            <span class="badge-type">SUV</span>

            <h1>iX1</h1>
            <p>Model</p>

            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgM0dpRUQoFSr9VJdoMXOBeypTjHPDDiUi5Bo0aVo7UwFyjmBjVwsoH0%25l0YxxO4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQWly%25V1PaXGmfNEbnQrX10s9OaZ9E4riInRdscZwBO5xrxRteJOGZ857Mu1vRUgChSU75GvloVm3gp2XHNaMv6jQ%25gJq2YDafvR6jmqn12mUDyLOEjy5qTJIsDRXL3uBrq76JdSeZLU2uzVMRJf0SkNh5ucQVA0ogSkwNF4HvVmP0Kc%252Nye4Wxfj0UucP81D5PAxbUEqgmP89GsLvS6UiprJ2CrGw6ZujlaptYRSDUW67m5VdH9YCygNzaUmlTv0knfyX324AETTQdjcFAq3azDxKiodnkq8h4CzOALUoZkkIFJGH85ABKupK3FFeWS6WBQKMPVYoedWhbNmHMiPox9syh3b4gZqmazOSCmXz4RjayVFbYCja1%25P4fFSr9VSxbZG7NgXA2Jf3KuvQnOlZyrU1OIXYuaq4y9%25UnpqyBLayV3WJY" alt="">

            <div class="electric">Electric</div>
          </div>
        </div>
      </div>
         <div class="row g-4 mt-3">
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="car-card" onclick="window.location.href='/shop3'">
            <span class="badge-type">SUV</span>
            <h1>i7</h1>
            <p>Model</p>
            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgMyDkRUQoFSr9VJdoMXOBeypTjH1sD3Ui5Bo0aVo7UwFyjmBjVwsoH0%25l0gfHR4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQWcm%25V1PaXlsfNEbnQpy10s9OaZQE4riInRiscZwBO5MrxRteIgrZ857MBvuRUgChSD25GvloVeYgp2XHNrDv6jQ%250Zk2YDaf4iujmqn1cvfDyLOEx2UqTJIsDNOL3uBrq1kJdSeZLjbuzVMRJDdSkNh5ukxVA0ogSjwNF4HvVDd0Kc%252Nd44Wxfj0zacP81D4wGxbUEqc7F89GsLxCUUiprJ8lLGw6ZuU2eptYRSGTL67m5VptIYCygN67QmlTv0YCgyX324mllTQdjcy9O3azDxTi5dnkq83wdzOALUdKmkIFJG49OABKupcmPFeWS6xHSKMPVY8%257WhbNmUfhPo90yGKDbHi4TpeZ9%25wc3lsKiftxdXrLw178zQuvtECUkaSV7slGAngbCrXpFOvWlZQ6KI2lXRaYWBIyQ5nmPeJNagOybMfunvIT9h1yO2B3iuzvIjedwS73BDMztMaeeqhk7hSSMLoACoq4hJHFlHLgou%25KXVMKHSfWQqSr%25Vi18aSOfbYGdQ2BDFRQgBbpT2aKhfXRT2c0%25b4hFU1KFifG7ZWYgMyk4OoAmvjD5GaUtcDqgXA2dba10tjCdaLz2aKOHkX" alt="">
            <div class="electric">Electric</div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="car-card" onclick="window.location.href='/shop4'">

            <span class="badge-type">Touring</span>

            <h1>i5</h1>
            <p>Model</p>

            <img src="{{ asset('images/i5thumb.png') }}" alt="">

            <div class="electric">Electric</div>
          </div>
        </div>

         <div class="col-md-4">
          <div class="car-card " onclick="window.location.href='/shop5'">

            <span class="badge-type">SUV</span>

            <h1>i4</h1>
            <p>Model</p>

            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgM0dpRUQoFSr9VJdoMXOBeypTjHPs7MUi5Bo0aVo7UwFyjmBjVwsoH0%25l0CzrH4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQlO%25%25V1PaXGmfNEbnQrX10s9ODQxE4riIqHRscZwBLGxrxRteJ68Z857MulIRUgChZE85GvloRG4gp2XH5psv6jQ%25gFx2YDafvKAjmqn12WGDyLOEjztqTJIsDFiL3uBrqUQJdSeZLGJuzVMRJ0jSkNh5EkTVA0ogsU3NF4HvrbH0Kc%252Z9E4WxfjRiWcP81D5w4xbUEqg4O89GsLvcAUiprJyVWGw6ZuTkiptYRS3XR67m5VdQ8YCygNzaHmlTv0knXyX324AO1TQdjcFs73azDxKrZdnkq8WTdzOALUPWukIFJGb7fABNK%25pIYFSr1vGCyXqiGtySE5CpLdFUi5CoMAShdqfKLqNF1c9Jrt3RjhYzDZ7lXw1pf4oXQtUDCvSpKM4lxvpa2CpLYkjU" alt="">

            <div class="electric">Electric</div>
          </div>
        </div>
        

    
  
         <div class="col-md-4">
          <div class="car-card" onclick="window.location.href='/shop6'">

            <span class="badge-type">SUV</span>

            <h1>XM</h1>
            <p>M Model</p>

            <img src="{{ asset('images/xm1.png') }}" alt="">

            <div class="electric">Electric</div>
          </div>
        </div>

         <div class="col-md-4">
          <div class="car-card" onclick="window.location.href='/shop7'">

            <span class="badge-type">SUV</span>

            <h1>X5</h1>
            <p>Model</p>

            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73317K9wt0u4fXBI1EL3hTxVN0JeivOm0GM%25K9ZG10tfnZ1oEiyCIbH8wlD7Z9cvt3OleifGruLBkJnTNM3TFe0SwJeiUS%25JxvQy2sC4v6jQ%25Q9Z2YDafai2jmqn1nvHDyLOEOK%25qTJIs1fSL3uBrE5TJdSeZs05uzVMRr97SkNh5ZzrVA0ogRcZNF4Hv5xj0Kc%252yG84WxfjTSUcP81D3VlxbUEqdNP89GsLz9EUiprJkCQGw6ZuA8JptYRSFUW67m5VKuIYCygNW2umlTv0YkgyX324mVvTQdjcyNX3azDxTYodnkq83mazOALUdbskIFJGzYfABKupkmhFeWS6AHbKMPVYFf7WhbNmK8gPo90yWU6bHi4TP7y9%25wc3bCBiftxd9Iww178ziBwtECUkyn17slGAT5GCrXpF3gBlZQ6KdvZXRaYWzC4Q5nmPeSUagOybMDCnvIT9hqxO2B3io3cIjedwHGNBDMzt%25p6eqhk7fVaMLoAC1fKhJHFlExpou%25KXsg8HSfWQxCD%25V1Pa8lffNEbnU3c10s9OsoEE4riIruoscZwBZRmrxRteRcSZ857M5xSRUQvmEO30BHtuc%25IdkATQLi19mUiOgZ22YI2SiEhoNHCNen060KEQIJ7qIb0W3GRUQunKeNWJeihsPIgpnG7xqLvQFjz9nE47rpI0eswTYAOqhJPX65e3gZ8XVf0ZOKic1QgD" alt="">

            <div class="electric">Electric</div>
          </div>
        </div>

       <div class="col-md-4">
          <div class="car-card"  onclick="window.location.href='/shop8'">

            <span class="badge-type">SUV</span>

            <h1>X3</h1>
            <p>Model</p>

            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-7331pKAuhFqIbVBIHS9amvhz25GaNKVZfNYt9CCrmu09DP05CZHOdnuiVrc7Z9cv8yR0kIVKoT4fXx6qtaYc1sr%25ViPRKVZlPxK73DIdpvw3azDxDrYdnkq8qZdzOALUL3ckIFJG8xWABKupU31FeWS6GERKMPVYpezWhbNm6ipPo90yYw0bHi4TmtX9%25wc3OK7iftxdIWUw178zB1xtECUkeiV7slGAMytCrXpFhY9lZQ6KomkXRaYWlBOQ5nmPXFYagOybQC5nvIT9av8O2B3in76IjedwOEXBDMztIS1eqhk7BZeMLoAC9L2hJHFlisLou%25KXwn1HSfWQt4S%25V1Pa7o3fNEbnR2V10s9O58oE4riIg5tscZwBvmdrxRte25ZZ857MjuTRUgChyB05GvloTWggp2XH3h0v6jQ%25jZ22YDafD8Zjmqn1qddDyLOELA1qTJIsJyGL3uBruTWJdSeZS3puzVMRAdjSkNh5Fz4VA0ogKklNF1TLdNZnMkJEcGqTMDESqvLB9orO2keH8hSId4MwVUxBDFjTgH%25ekxh06FXRTZhOIBQmSwpsB%25yzDuP%25ABNK%25pIYFSr1vGCyXqjs5v279CpL96aDPoxPCD3p6XYuXhwQy" alt="">

            <div class="electric">Electric</div>
          </div>
        </div>
  
          <div class="col-md-4">
          <div class="car-card"  onclick="window.location.href='/shop9'">

            <span class="badge-type">Sedan</span>

            <h1>7</h1>
            <p>Model</p>

            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-7331pKAuhFqIbVBIHS9amvhz25GaNKVZfNYt9CCrmu09DP05CZHOdnuiVrc7Z9cv8yR0kIVKoT4fXx6qtaYc1sr%25ViPRKVZlPxK73DIdpvw3azDxDr3dnkq8qMgzOALUx%25skIFJG8OxABKupUP8FeWS6GbSKMPVYp9yWhbNmQtiPo90ya6fbHi4TnFt9%25wc3OK5iftxdIfcw178zBartECUkeSa7slGAMwkCrXpFhtHlZQ6KomiXRaYWlB6Q5nmPXF2agOybQCunvIT9algO2B3in7VIjedwOC5BDMztI5eeqhk7BgUMLoACeV%25hJHFlM0jou%25KXh4HHSfWQocX%25V1PaHtmfNEbn%25Vc10s9OfNNE4riI1qEscZwBQ24rxRteaogZ857Mn67RUgChOYU5GvloIZ0gp2XHLb9v6jQ%25J312YDafuJOjmqn1ScFDyLOEVxnqTJIsFfpL3uBrK5YJdSeZWCAuzVMRPoeSkNh5FzDVA0ogKkcNF1TLdNZnMkJEcGqTMDESqvLB9orO2keH8hSId4Mw54LBDFjTgH%25ekxh06FXRTZhOIBQmSwpsB%25yzDuP%25ABNK%25pIYFSr1vGCyXqd5fYA52QBzc6tif5EqOVAfHnehodmzL1HJJN6726z%250LJAusAUfIN" alt="">

            <div class="electric">Petrol</div>
          </div>
        </div>

        </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>


@endsection