@extends('layouts.mainlayout')

@section('title','Customer Support')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/cs.css') }}">

<section id="CustomerSupport" class="first">
  <div class="gambar">
    <img src="{{ asset('images/bg.jpeg') }}" alt="">
  </div>

  <div class="head">
    <h1>Customer Support</h1>
  </div>

  <div class="para">
    <p>We're here to help. Find answers, get support, and connect with our team.</p>
  </div>

  <div class="search-box">
    <input type="text" placeholder="Search for help and service....">
  </div>

  <div></div>
</section>

<section id="helpSection" class="help-section">
  <h2>How can we help you?</h2>

  <div class="help-grid">
    <div class="help-card">
      <img width="80" height="80" src="https://img.icons8.com/dotty/80/shield.png" alt="shield"/>
      <h3>Warranty</h3>
      <p>Information about warranty coverage and claims.</p>
    </div>

    <div class="help-card">
      <img width="64" height="64" src="https://img.icons8.com/wired/64/wrench.png" alt="wrench"/>
      <h3>Service & Maintenance</h3>
      <p>Book a service or find maintenance information.</p>
    </div>

    <div class="help-card">
      <img width="100" height="100" src="https://img.icons8.com/carbon-copy/100/clipboard.png" alt="clipboard"/>
      <h3>Order Status</h3>
      <p>Track your order and check delivery updates.</p>
    </div>

    <div class="help-card">
      <img width="50" height="50" src="https://img.icons8.com/ios/50/bank-card-back-side--v1.png" alt="bank-card-back-side--v1"/>
      <h3>Payment</h3>
      <p>Payment methods, invoices, and refunds.</p>
    </div>

    <div class="help-card">
      <img width="50" height="50" src="https://img.icons8.com/ios/50/technical-support.png" alt="technical-support"/>
      <h3>Technical Help</h3>
      <p>Get technical support for your vehicle.</p>
    </div>

    <div class="help-card">
      <img width="50" height="50" src="https://img.icons8.com/ios/50/search--v1.png" alt="search--v1"/>
      <h3>Find a Dealer</h3>
      <p>Locate your nearest dealer or service center.</p>
    </div>
  </div>
</section>

<section id="FAQ" class="faq-section">
  <h2>Frequently Asked Questions</h2>

  <div class="faq-box">
    <div class="faq-item active">
      <button class="faq-question">
        <span>How do I book a service?</span>
        <span class="faq-icon">−</span>
      </button>
      <div class="faq-answer">
        <p>
          You can book a service through our website, mobile app, or by contacting your nearest dealer.
          Simply choose your preferred date and time, and we’ll take care of the rest.
        </p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        <span>How can I check my warranty status?</span>
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">
        <p>
          You can check your warranty status by entering your VIN on the warranty page or by contacting support.
        </p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        <span>How do I track my order?</span>
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">
        <p>
          Track your order from your account dashboard or use the order tracking page.
        </p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        <span>What payment methods are accepted?</span>
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">
        <p>
          We accept bank transfer, credit card, and other supported payment methods.
        </p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">
        <span>How can I contact customer support?</span>
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">
        <p>
          You can contact customer support through live chat, email, or phone.
        </p>
      </div>
    </div>
  </div>
</section>

<script>
  const items = document.querySelectorAll('.faq-item');

  items.forEach(item => {
    const btn = item.querySelector('.faq-question');

    btn.addEventListener('click', () => {
      items.forEach(other => {
        if (other !== item) {
          other.classList.remove('active');
          other.querySelector('.faq-icon').textContent = '+';
          other.querySelector('.faq-answer').style.maxHeight = '0';
        }
      });

      const answer = item.querySelector('.faq-answer');
      const icon = item.querySelector('.faq-icon');
      const isActive = item.classList.contains('active');

      if (isActive) {
        item.classList.remove('active');
        icon.textContent = '+';
        answer.style.maxHeight = '0';
      } else {
        item.classList.add('active');
        icon.textContent = '−';
        answer.style.maxHeight = answer.scrollHeight + 'px';
      }
    });
  });

  // buka item pertama
  const first = document.querySelector('.faq-item');
  if (first) {
    first.querySelector('.faq-answer').style.maxHeight =
      first.querySelector('.faq-answer').scrollHeight + 'px';
  }
</script>


@endsection 