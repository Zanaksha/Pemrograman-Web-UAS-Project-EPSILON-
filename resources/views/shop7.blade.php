@extends('layouts.mainlayout')

@section('title','X5')

@section('content')

<section class="booking-section">

    <!-- LEFT -->
    <div class="booking-left">

        <h1 class="mt-5">X5</h1>
        <h2>Gran Coupe M Sport</h2>

        <h3>Rp 935.000.000</h3>

        <p class="desc">
            The actual car specifications may vary from the image shown.
            Please consult BMW Authorized Dealers for complete details.
        </p>

        <!-- IMAGE SLIDER -->
        <div class="car-viewer">

            <button class="slide-btn prev" onclick="prevImage()">
                &#10094;
            </button>

            <img id="mainCar" src="{{ asset('images/x5white1.png') }}" alt="">

            <button class="slide-btn next" onclick="nextImage()">
                &#10095;
            </button>

        </div>

        <!-- THUMBNAIL -->
        <div class="thumb-gallery">
            <img class="thumb active"src="{{ asset('images/x5white1.png') }}"onclick="changeImage(0)">
            <img class="thumb"src="{{ asset('images/x5white2.png') }}"onclick="changeImage(1)">
            <img class="thumb"src="{{ asset('images/x5white3.png') }}"onclick="changeImage(2)">
            <img class="thumb"src="{{ asset('https://images.netdirector.auto/eyJrZXkiOiJuZHN0b2NrL2ltYWdlcy9zdG9jay85OTY0NzBhMTBmZDY4OTBiYTk5ZmUyMTU4Yzg4N2IyODZiNGMzMzgyLzU5RUpfXzMucG5nIiwiYnVja2V0Ijoic3RvY2stdGl0YW4iLCJsYXN0X21vZGlmaWVkIjoiMTc1MzM1OTM3MyIsImVkaXRzIjp7InJlc2l6ZSI6eyJ3aWR0aCI6MTI4MCwiaGVpZ2h0Ijo4NTMsImZpdCI6ImNvbnRhaW4iLCJiYWNrZ3JvdW5kIjp7InIiOjI1NSwiZyI6MjU1LCJiIjoyNTUsImFscGhhIjoxfX19fQ==') }}"onclick="changeImage(3)">
        </div>
        

    </div>



    <!-- RIGHT -->
    <div class="booking-right">

        <h2>Your BMW journey starts here</h2>

        <p>
            You are one step away from owning the ultimate driving machine.
            Complete your booking and connect with BMW Consultant.
        </p>

        <a href="#" class="book-btn" onclick="window.location.href='/beli?model=BMW+x5&harga=Rp+935.000.000'">
            Buy Now
        </a>



        <div class="contact-box">
            <h2>Stay in touch</h2>
            <p> Stay informed on our exclusive news and offers.</p>
            <h3>Contact Us</h3>
            <div class="contact-item">📞 1500269</div>
            <div class="contact-item">💬 085288886269</div>
            <div class="contact-item">✉️ contact.id@bmw.co.id</div>
        </div>
    </div>
</section>



<style>

.booking-section{
    display: flex;
    min-height: 100vh;
    background: #f5f5f5;
}

/* LEFT */
.booking-left{
    width: 60%;
    padding: 60px;
    background: white;
}

.booking-left h1{
    font-size: 60px;
    font-weight: 700;
    margin-bottom: 0;
}

.booking-left h2{
    font-size: 50px;
    font-weight: 300;
    margin-bottom: 20px;
}

.booking-left h3{
    color: #1c69d4;
    font-size: 45px;
    font-weight: bold;
    margin-bottom: 20px;
}

.desc{
    color: #666;
    max-width: 700px;
    margin-bottom: 30px;
}

/* IMAGE */
.car-viewer{
    position: relative;
    width: 100%;
    height: 500px;
    background: #eee;
    overflow: hidden;
}

.car-viewer img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* BUTTON */
.slide-btn{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    border: none;
    background: rgba(0,0,0,0.5);
    color: white;
    font-size: 24px;
    cursor: pointer;
    z-index: 2;
}

.prev{
    left: 20px;
}

.next{
    right: 20px;
}

/* THUMB */
.thumb-gallery{
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.thumb{
    width: 120px;
    height: 80px;
    object-fit: cover;
    cursor: pointer;
    border: 3px solid transparent;
}

.thumb.active{
    border-color: #1c69d4;
}

/* RIGHT */
.booking-right{
    width: 40%;
    background: #ededed;
    padding: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.booking-right h2{
    font-size: 45px;
    margin-bottom: 20px;
}

.booking-right p{
    color: #555;
    line-height: 1.8;
}

.book-btn{
    display: block;
    width: 100%;
    padding: 18px;
    background: #555;
    color: white;
    text-align: center;
    text-decoration: none;
    font-size: 20px;
    margin: 40px 0;
    transition: 0.3s;
}

.book-btn:hover{
    background: black;
}

.contact-box h3{
    color: #1c69d4;
    font-size: 40px;
    margin-top: 40px;
}

.contact-item{
    margin-top: 15px;
    font-size: 20px;
    color: #333;
}

/* RESPONSIVE */
@media(max-width:1000px){

    .booking-section{
        flex-direction: column;
    }

    .booking-left,
    .booking-right{
        width: 100%;
    }

    .booking-left h1{
        font-size: 40px;
    }

    .booking-left h2{
        font-size: 35px;
    }

    .booking-right h2{
        font-size: 35px;
    }

}

</style>




<script>

const images = [
    "{{ asset('images/x5white1.png') }}",
    "{{ asset('images/x5white2.png') }}",
    "{{ asset('images/x5white3.png') }}",
    "{{ asset('https://images.netdirector.auto/eyJrZXkiOiJuZHN0b2NrL2ltYWdlcy9zdG9jay85OTY0NzBhMTBmZDY4OTBiYTk5ZmUyMTU4Yzg4N2IyODZiNGMzMzgyLzU5RUpfXzMucG5nIiwiYnVja2V0Ijoic3RvY2stdGl0YW4iLCJsYXN0X21vZGlmaWVkIjoiMTc1MzM1OTM3MyIsImVkaXRzIjp7InJlc2l6ZSI6eyJ3aWR0aCI6MTI4MCwiaGVpZ2h0Ijo4NTMsImZpdCI6ImNvbnRhaW4iLCJiYWNrZ3JvdW5kIjp7InIiOjI1NSwiZyI6MjU1LCJiIjoyNTUsImFscGhhIjoxfX19fQ==') }}",
  
];

let current = 0;

const mainCar = document.getElementById("mainCar");
const thumbs = document.querySelectorAll(".thumb");

function updateSlider(){

    mainCar.src = images[current];

    thumbs.forEach((thumb, i)=>{
        thumb.classList.toggle("active", i === current);
    });

}

function nextImage(){

    current = (current + 1) % images.length;
    updateSlider();

}

function prevImage(){

    current = (current - 1 + images.length) % images.length;
    updateSlider();

}

function changeImage(index){

    current = index;
    updateSlider();

}

</script>

@endsection