@extends('layouts.mainlayout')

@section('title','About')

@section('content')
  <style>

    body{
      background: #f5f5f5;
      font-family: Arial, sans-serif;
    }

    /* HERO */
    .hero{
      height: 70vh;
      background: url('https://images.unsplash.com/photo-1753183515001-7f0a9690b72c?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center/cover;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero::before{
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.5);
    }

    .hero-content{
      position: relative;
      color: white;
      text-align: center;
      z-index: 2;
    }

    .hero-content h1{
     font-size: 70px;
     font-weight: bold;
     animation: slideUp 1.5s ease;
    }

    .hero-content p{
      font-size: 18px;
    }

    @keyframes slideUp{
    from{
        opacity: 0;
        transform: translateY(80px);
    }

    to{
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn{
    from{
        opacity: 0;
    }

    to{
        opacity: 1;
    }
}

    /* STORY CARD */
    .story-section{
      padding: 80px 0;
      animation: fadeIn 2s ease;
    }

    .story-card{
      background: white;
      border-radius: 15px;
      overflow: hidden;
      transition: 0.4s;
      height: 100%;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .story-card:hover{
      transform: translateY(-10px);
    }

    .story-card img{
      width: 100%;
      height: 250px;
      object-fit: cover;
      transition: 0.4s;
    }

    .story-card:hover img{
      transform: scale(1.05);
    }

    .story-content{
      padding: 25px;
    }

    .story-content h3{
      font-weight: bold;
      margin-bottom: 15px;
    }

    .story-content p{
      color: #666;
      font-size: 14px;
    }

    .read-more{
      text-decoration: none;
      color: black;
      font-weight: bold;
    }
    .finance-section{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 80px;
    padding: 100px 80px;
    background: #f5f5f5;
    flex-wrap: wrap;
}

.finance-image img{
    width: 650px;
    max-width: 100%;
    border-radius: 5px;
}

.finance-content{
    max-width: 500px;
}

.finance-content h1{
    font-size: 55px;
    font-weight: 300;
    line-height: 1.2;
    margin-bottom: 30px;
    color: #111;
}

.finance-content p{
    font-size: 28px;
    color: #333;
    margin-bottom: 35px;
}

.finance-btn{
    text-decoration: none;
    color: black;
    font-size: 22px;
    font-weight: 600;
    transition: 0.3s;
}

.finance-btn:hover{
    color: #007bff;
}

.why-bmw{
    padding:100px 0;
    background:white;
    text-align:center;
}

.why-bmw h2{
    font-size:50px;
    margin-bottom:60px;
}

.why-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:30px;
}

.why-card{
    background:#f8f8f8;
    padding:40px;
    border-radius:15px;
    transition:.3s;
}

.why-card:hover{
    transform:translateY(-10px);
}

.why-card h3{
    margin-bottom:15px;
}

.stats-section{
    background:#111;
    color:white;
    padding:100px 50px;
    display:flex;
    justify-content:space-around;
    text-align:center;
    flex-wrap:wrap;
}

.stat-box h1{
    font-size:60px;
    color:#007bff;
}

.stat-box p{
    font-size:18px;
}

.future-section{
    height:70vh;
    background:url('https://images.unsplash.com/photo-1568123168425-c89c109431a2?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDgxfHxibXd8ZW58MHx8MHx8fDA%3D') center/cover;
    position:relative;
}

.future-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.55);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    color:white;
    text-align:center;
}

.future-overlay h1{
    font-size:60px;
    margin-bottom:20px;
}

.future-overlay p{
    max-width:700px;
    font-size:20px;
}

  </style>



<section class="hero">
  <div class="hero-content">
    <h1>OUR STORY</h1>
  </div>
</section>

<section class="why-bmw">
    <div class="container">
        <h2>Why Choose EPSILON</h2>
        <div class="why-grid">
            <div class="why-card">
                <h3>Luxury</h3>
                <p>Premium materials and sophisticated craftsmanship in every detail.</p>
            </div>
            <div class="why-card">
                <h3>Performance</h3>
                <p>Engineered for driving pleasure with powerful and efficient technology.</p>
            </div>
            <div class="why-card">
                <h3>Innovation</h3>
                <p>Cutting-edge digital features designed for the future of mobility.</p>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
   <div class="stat-box">
    <h1 class="counter" data-target="100">0</h1>
    <p>Years of Innovation</p>
</div>

<div class="stat-box">
    <h1 class="counter" data-target="150">0</h1>
    <p>Countries Worldwide</p>
</div>

<div class="stat-box">
    <h1 class="counter" data-target="2000000">0</h1>
    <p>Vehicles Delivered Annually</p>
</div>

<div class="stat-box">
    <h1 class="counter" data-target="50">0</h1>
    <p>EPSILON Models</p>
</div>
</section>

<section class="future-section">
    <div class="future-overlay">
        <h1>The Future of Mobility</h1>
        <p>
            Sustainable, digital, and connected. BMW is shaping
            the next generation of driving experiences.
        </p>
    </div>
</section>

<script>
const counters = document.querySelectorAll('.counter');

const observer = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        const counter = entry.target;

        if(entry.isIntersecting){

            let start = 0;
            const target = +counter.dataset.target;

            const timer = setInterval(()=>{

                start += Math.ceil(target/80);

                if(start >= target){
                    start = target;
                    clearInterval(timer);
                }

                if(target >= 1000000){
                    counter.innerText =
                        (start/1000000).toFixed(1).replace('.0','') + 'M+';
                }else{
                    counter.innerText = start + '+';
                }

            },20);
        }

    });

},{
    threshold:0.6
});

counters.forEach(counter=>{
    observer.observe(counter);
});
</script>

@endsection