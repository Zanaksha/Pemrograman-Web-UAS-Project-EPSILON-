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
    <div class="search-field-wrap">
      <i class="search-icon">&#128269;</i>
      <input type="text" id="csSearchInput" placeholder="Cari bantuan, layanan, atau pertanyaan..." autocomplete="off">
      <button class="search-clear" id="searchClear" aria-label="Hapus">&#x2715;</button>
    </div>
    <div class="search-suggestions" id="searchSuggestions"></div>
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
    @foreach($faqs as $faq)
    <div class="faq-item">
      <button class="faq-question">
        <span>{{ $faq->question }}</span>
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">
        <p>{{ $faq->answer }}</p>
      </div>
    </div>
    @endforeach
  </div>
</section>

<script>

  const items = document.querySelectorAll('.faq-item');
  items.forEach(item => {
    item.querySelector('.faq-question').addEventListener('click', () => {
      const isActive = item.classList.contains('active');


      items.forEach(i => {
        i.classList.remove('active');
        i.querySelector('.faq-icon').textContent = '+';
        i.querySelector('.faq-answer').style.maxHeight = null;
      });

      if (!isActive) {
        item.classList.add('active');
        item.querySelector('.faq-icon').textContent = '−';
        item.querySelector('.faq-answer').style.maxHeight =
          item.querySelector('.faq-answer').scrollHeight + 'px';
      }
    });
  });


  const first = document.querySelector('.faq-item');
  if (first) {
    first.classList.add('active');
    first.querySelector('.faq-icon').textContent = '−';
    first.querySelector('.faq-answer').style.maxHeight =
      first.querySelector('.faq-answer').scrollHeight + 'px';
  }

 
  const input       = document.getElementById('csSearchInput');
  const suggestions = document.getElementById('searchSuggestions');
  const clearBtn    = document.getElementById('csSearchClear');

  let debounceTimer;

  input.addEventListener('input', () => {
    const q = input.value.trim();
    clearTimeout(debounceTimer);
    if (!q) { suggestions.classList.remove('active'); return; }
    debounceTimer = setTimeout(() => fetchSuggestions(q), 300);
  });

  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        const q = input.value.trim();
        if (q) fetchSuggestions(q);
    }
});

  async function fetchSuggestions(q) {
    suggestions.innerHTML = '<div class="suggestion-empty">Mencari...</div>';
    suggestions.classList.add('active');

    try {
      const res  = await fetch(`/support/search?q=${encodeURIComponent(q)}`);
      const data = await res.json();

      suggestions.innerHTML = '';

      if (data.length === 0) {
        suggestions.innerHTML = `<div class="suggestion-empty">Tidak ditemukan hasil untuk "<strong>${q}</strong>"</div>`;
        return;
      }

      data.forEach(item => {
        const el = document.createElement('div');
        el.className = 'suggestion-item';
        el.innerHTML = `<span>→</span> ${item.question} <span class="suggestion-tag">${item.tag ?? ''}</span>`;
        el.addEventListener('click', () => {
          input.value = item.question;
          suggestions.classList.remove('active');
          document.querySelector('#FAQ')?.scrollIntoView({ behavior: 'smooth' });
        });
        suggestions.appendChild(el);
      });
    } catch (err) {
      suggestions.innerHTML = '<div class="suggestion-empty">Gagal memuat hasil.</div>';
    }
  }

  clearBtn.addEventListener('click', () => {
    input.value = '';
    suggestions.classList.remove('active');
    input.focus();
  });

  document.addEventListener('click', e => {
    if (!e.target.closest('.search-box')) suggestions.classList.remove('active');
  });
</script>


@endsection