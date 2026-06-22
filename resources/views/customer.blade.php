@extends('layouts.mainlayout')

@section('title','Customer Support')

@section('content')

<style> 

  .search-box {
    position: relative;
    display: flex;
    flex-direction: column;
  margin-left: 75px
    margin-top: 24px;
  }

  .search-field-wrap {
    position: relative;
    width: 100%;
    max-width: 580px;
    display: flex;
    align-items: center;
  }

  .search-field-wrap input {
    width: 100%;
    padding: 14px 44px 14px 48px;
    font-size: 15px;
    border-radius: 50px;
    border: 1.5px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    outline: none;
    transition: border 0.2s, background 0.2s;
  }

  .search-field-wrap input::placeholder {
    color: rgba(255, 255, 255, 0.55);
  }

  .search-field-wrap input:focus {
    border-color: rgba(255, 255, 255, 0.7);
    background: rgba(255, 255, 255, 0.22);
  }

  .search-icon {
    position: absolute;
    left: 1px;
    font-style: normal;
    font-size: 16px;
    color: rgba(255, 255, 255, 0.6);
    pointer-events: none;
  }

  .search-clear {
    position: absolute;
    right: 14px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: rgba(255, 255, 255, 0.8);
    width: 24px;
    height: 24px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 12px;
    display: none;
    align-items: center;
    justify-content: center;
  }

  .search-field-wrap input:not(:placeholder-shown) ~ .search-clear {
    display: flex;
  }


  .search-suggestions {
    width: 100%;
    max-width: 580px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    overflow: hidden;
    display: none;
    margin-top: 8px;
    z-index: 100;
    position: absolute;
    top: 100%;
  }

  .search-suggestions.active {
    display: block;
  }

  .suggestion-item {
    padding: 11px 18px;
    font-size: 14px;
    color: #333;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.15s;
  }

  .suggestion-item:last-child {
    border-bottom: none;
  }

  .suggestion-item:hover {
    background: #f7f7f7;
  }

  .suggestion-tag {
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 20px;
    margin-left: auto;
    background: #e8f0fe;
    color: #1a56db;
    white-space: nowrap;
  }

  .suggestion-empty {
    padding: 14px 18px;
    font-size: 14px;
    color: #888;
  }

</style>

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
      <input type="text" id="searchInput" placeholder="Cari bantuan, layanan, atau pertanyaan..." autocomplete="off">
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

 
  const input       = document.getElementById('searchInput');
  const suggestions = document.getElementById('searchSuggestions');
  const clearBtn    = document.getElementById('searchClear');

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