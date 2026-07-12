<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bank Sampah Lestari — Setor Sampah, Panen Manfaat</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

<header id="siteHeader">
  <nav class="wrap">
    <div class="logo">
      <div class="logo-mark">
        <svg viewBox="0 0 32 32" fill="none">
          <path d="M10 18C10 13 13 10 16 10C19 10 22 13 22 18" stroke="#EAFBF1" stroke-width="2.4" stroke-linecap="round"/>
          <path d="M16 10V22" stroke="#B9FBDE" stroke-width="2.4" stroke-linecap="round"/>
        </svg>
      </div>
      <div class="logo-text">
        Bank Sampah Lestari
        <small>Dikelola warga</small>
      </div>
    </div>
    <div class="navlinks">
      <a href="#tentang">Tentang</a>
      <a href="#cara-kerja">Cara Kerja</a>
      <a href="#harga">Harga Sampah</a>
      <a href="#tukar-poin">Tukar Poin</a>
      <a href="#galeri">Galeri</a>
      <a href="#lokasi">Lokasi</a>
    </div>
    <div class="nav-right">
      <a href="{{ route('login') }}" class="nav-cta">Login</a>
      <button class="burger" id="burgerBtn" aria-label="Buka menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
    <div class="mobile-panel" id="mobilePanel">
      <a href="#tentang">Tentang</a>
      <a href="#cara-kerja">Cara Kerja</a>
      <a href="#harga">Harga Sampah</a>
      <a href="#tukar-poin">Tukar Poin</a>
      <a href="#galeri">Galeri</a>
      <a href="#lokasi">Lokasi</a>
      <a href="{{ route('login') }}" class="nav-cta" style="text-align:center;margin-top:8px;">Login</a>
      
    </div>
  </nav>
</header>

<section class="hero">
  <svg class="hero-bg" viewBox="0 0 1200 700" preserveAspectRatio="xMidYMax slice" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <radialGradient id="g1" cx="30%" cy="20%" r="70%">
        <stop offset="0%" stop-color="#3EE39B" stop-opacity="0.5"/>
        <stop offset="100%" stop-color="#3EE39B" stop-opacity="0"/>
      </radialGradient>
      <radialGradient id="g2" cx="85%" cy="60%" r="60%">
        <stop offset="0%" stop-color="#2AACC9" stop-opacity="0.55"/>
        <stop offset="100%" stop-color="#2AACC9" stop-opacity="0"/>
      </radialGradient>
    </defs>
    <rect width="1200" height="700" fill="url(#g1)"/>
    <rect width="1200" height="700" fill="url(#g2)"/>
    <path d="M0 520C180 470 340 560 520 500C700 440 820 540 1000 480C1120 440 1160 470 1200 460V700H0V520Z" fill="#1B8F4C" fill-opacity="0.35"/>
    <path d="M0 580C220 620 380 540 560 590C740 640 900 560 1080 610C1140 628 1170 615 1200 600V700H0V580Z" fill="#15703C" fill-opacity="0.55"/>
    <g fill="#B9FBDE" fill-opacity="0.3">
      <circle cx="140" cy="120" r="4"/><circle cx="260" cy="90" r="3"/><circle cx="1000" cy="150" r="4"/>
      <circle cx="920" cy="230" r="3"/><circle cx="500" cy="80" r="3"/><circle cx="700" cy="180" r="4"/>
    </g>
  </svg>
  <div class="wrap">
    <span class="eyebrow">Bank Sampah Digital &amp; Komunitas</span>
    <h1>Setor sampahmu hari ini,<br>jadi <em>poin</em> untuk banyak hadiah.</h1>
    <p class="lead">Bank Sampah Lestari membantu warga menabung dari sampah rumah tangga — dipilah, ditimbang, dan dikonversi jadi poin yang bisa ditukar ke berbagai kebutuhan.</p>
    <div class="hero-actions">
      <a href="{{ route('register') }}" class="btn btn-primary">Daftar Jadi Nasabah</a>
      <a href="#harga" class="btn btn-ghost">Lihat Harga Sampah</a>
    </div>
    <div class="hero-stats">
      <div>
        <div class="num">3.240+</div>
        <div class="lbl">Nasabah aktif</div>
      </div>
      <div>
        <div class="num">58 ton</div>
        <div class="lbl">Sampah terkumpul / tahun</div>
      </div>
      <div>
        <div class="num">2,1 juta</div>
        <div class="lbl">Poin ditukar ke hadiah</div>
      </div>
    </div>
  </div>
</section>

<section class="tentang" id="tentang">
  <div class="wrap">
    <div class="tentang-grid">
      <div class="tentang-copy">
        <span class="tag">Tentang Kami</span>
        <h2 style="color:var(--forest);font-size:2rem;font-weight:700;margin-bottom:18px;">Sampah dikelola, warga yang untung</h2>
        <p>Bank Sampah Lestari adalah unit pengelolaan sampah berbasis warga. Sampah anorganik yang biasanya dibuang, di sini ditimbang dan dikonversi menjadi poin — bisa ditukar ke voucher, sembako, hingga perlengkapan rumah tangga.</p>
        <p>Setiap kilogram yang disetor mengurangi beban tempat pembuangan akhir dan menambah poin di buku tabunganmu. Sederhana, terukur, dan berkelanjutan.</p>
      </div>
      <div>
        <div class="stat-card">
          <div class="stat-row"><span class="num">12</span><span class="unit">titik setor</span></div>
          <div class="lbl">Tersebar di seluruh kelurahan, buka setiap minggu</div>
        </div>
        <div class="stat-card">
          <div class="stat-row"><span class="num">94%</span><span class="unit">sampah terpilah</span></div>
          <div class="lbl">Langsung disalurkan ke mitra daur ulang</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="cara-kerja">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">Cara Kerja</span>
      <h2>Semudah menabung di bank</h2>
      <p>Empat langkah dari kantong sampah di rumah sampai poin bertambah dan siap ditukar.</p>
    </div>
    <div class="steps">
      <div class="step"><div class="idx">01</div><h3>Pilah di Rumah</h3><p>Pisahkan sampah anorganik seperti plastik, kertas, dan logam dari sampah organik.</p><span class="step-arrow">→</span></div>
      <div class="step"><div class="idx">02</div><h3>Setor ke Titik Terdekat</h3><p>Bawa ke titik setor sesuai jadwal mingguan di kelurahanmu.</p><span class="step-arrow">→</span></div>
      <div class="step"><div class="idx">03</div><h3>Ditimbang &amp; Dapat Poin</h3><p>Petugas menimbang per kategori dan poinnya langsung masuk ke buku tabungan.</p><span class="step-arrow">→</span></div>
      <div class="step"><div class="idx">04</div><h3>Tukar ke Hadiah</h3><p>Pakai poin kapan saja untuk voucher, sembako, atau kebutuhan lainnya.</p></div>
    </div>
  </div>
</section>

<section class="passbook-section" id="harga">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">Harga Sampah</span>
      <h2>Setiap kategori punya nilainya sendiri</h2>
      <p>Harga dapat berubah mengikuti harga pasar daur ulang, diperbarui setiap bulan.</p>
    </div>
    <div class="passbook-wrap">
      <div class="passbook">
        <div class="passbook-top">
          <div class="brand">Buku Tabungan<span>Bank Sampah Lestari</span></div>
          <div class="no">No. Rek<br>0042-3391</div>
        </div>
        <div class="ledger-row">
          <div class="item">Botol Plastik (PET)<small>2.4 kg disetor</small></div>
          <div class="price">+48 poin</div>
        </div>
        <div class="ledger-row">
          <div class="item">Kardus &amp; Kertas<small>3.1 kg disetor</small></div>
          <div class="price">+31 poin</div>
        </div>
        <div class="ledger-row">
          <div class="item">Kaleng Aluminium<small>0.6 kg disetor</small></div>
          <div class="price">+60 poin</div>
        </div>
        <div class="passbook-total">
          <span class="lbl">Poin Terkumpul Bulan Ini</span>
          <span class="val">1.385 pts</span>
        </div>
      </div>
      <div class="harga-list">
        <div class="harga-item"><div class="name">Plastik PET<small>Botol minuman bening</small></div><div class="price">20 poin / kg</div></div>
        <div class="harga-item"><div class="name">Kertas &amp; Kardus<small>Koran, HVS, kardus bersih</small></div><div class="price">10 poin / kg</div></div>
        <div class="harga-item"><div class="name">Kaleng Aluminium<small>Kaleng minuman</small></div><div class="price">100 poin / kg</div></div>
        <div class="harga-item"><div class="name">Botol Kaca<small>Botol &amp; pecahan kaca bersih</small></div><div class="price">5 poin / kg</div></div>
        <div class="harga-item"><div class="name">Plastik Keras<small>Ember &amp; wadah plastik lain</small></div><div class="price">15 poin / kg</div></div>
      </div>
    </div>
  </div>
</section>

<section id="tukar-poin">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">Tukar Poin</span>
      <h2>Satu poin, banyak pilihan hadiah</h2>
      <p>Poin dari setiap setoran bisa ditukar kapan saja ke berbagai kebutuhan sehari-hari — tanpa perlu ditarik tunai.</p>
    </div>
    <div class="reward-grid">
      <div class="reward-card">
        <div class="reward-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="6" y="2" width="12" height="20" rx="2.4" stroke="currentColor" stroke-width="1.8"/>
            <path d="M9 5.5h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M11 18.5h2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
        </div>
        <h3>Voucher Pulsa 10rb</h3>
        <p class="reward-desc">Semua operator, langsung masuk otomatis</p>
        <div class="reward-price">500 poin</div>
      </div>
      <div class="reward-card">
        <div class="reward-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 8.5c0-2 1.8-3.5 4-3.5s4 1.5 4 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M6.5 8.5h11l1.2 11.2a1.5 1.5 0 01-1.5 1.8H6.8a1.5 1.5 0 01-1.5-1.8L6.5 8.5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M9 12.5h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
        </div>
        <h3>Beras 5 kg</h3>
        <p class="reward-desc">Beras premium, ambil di titik setor</p>
        <div class="reward-price">1.200 poin</div>
      </div>
      <div class="reward-card">
        <div class="reward-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 4l-1 2.4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M8 8c-2 1.5-3 3.4-3 5.6C5 17.6 8.1 20.5 12 20.5s7-2.9 7-6.9c0-2.2-1-4.1-3-5.6-.6 1.4-1.8 2.1-2.7 1.3-.7-.6-.5-1.6.1-2.4" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round"/>
            <path d="M12 10.5v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
        </div>
        <h3>Paket Sabun &amp; Deterjen</h3>
        <p class="reward-desc">Kebutuhan rumah tangga bulanan</p>
        <div class="reward-price">350 poin</div>
      </div>
      <div class="reward-card">
        <div class="reward-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 21c0-4.5 2-6 4.5-7.5C19 12 20 9.8 19.3 7.2c-2.6.4-4.4 1.7-5.6 3.9C13 8.4 11 6.7 8 6.2c-1 3-.2 5.4 2.3 7 2 1.3 1.7 3.7 1.7 7.8z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round"/>
          </svg>
        </div>
        <h3>Bibit Tanaman</h3>
        <p class="reward-desc">Cabai, tomat, atau sayuran pilihan</p>
        <div class="reward-price">150 poin</div>
      </div>
      <div class="reward-card">
        <div class="reward-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 2.5L5.5 13.5h5L9 21.5l8.5-12h-5.2L13 2.5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round"/>
          </svg>
        </div>
        <h3>Token Listrik 20rb</h3>
        <p class="reward-desc">Token PLN, terkirim ke nomor meteran</p>
        <div class="reward-price">900 poin</div>
      </div>
      <div class="reward-card">
        <div class="reward-icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.5 7.5c0-2.2 1.6-4 3.5-4s3.5 1.8 3.5 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M5.8 7.5h12.4l1.1 11.3a2 2 0 01-2 2.2H6.7a2 2 0 01-2-2.2L5.8 7.5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
          </svg>
        </div>
        <h3>Tas Belanja Ramah Lingkungan</h3>
        <p class="reward-desc">Produk daur ulang mitra bank sampah</p>
        <div class="reward-price">400 poin</div>
      </div>
    </div>
  </div>
</section>

<section class="galeri" id="galeri">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">Galeri Kegiatan</span>
      <h2>Cerita dari titik setor tiap minggu</h2>
      <p>Sekilas kegiatan penimbangan, edukasi, dan penukaran hadiah bersama warga.</p>
    </div>

    <div class="carousel" id="galeriCarousel">
      <div class="carousel-viewport">
        <div class="carousel-track" id="carouselTrack">

          <div class="carousel-slide">
            <div class="carousel-visual" style="background:linear-gradient(160deg,#1FAE64,#15703C);">
              <svg viewBox="0 0 400 340" xmlns="http://www.w3.org/2000/svg">
                <circle cx="330" cy="60" r="90" fill="#ffffff" fill-opacity="0.08"/>
                <circle cx="40" cy="290" r="70" fill="#ffffff" fill-opacity="0.08"/>
                <rect x="100" y="150" width="200" height="110" rx="10" fill="#EAFBF1"/>
                <rect x="120" y="130" width="160" height="24" rx="6" fill="#B9FBDE"/>
                <rect x="140" y="170" width="120" height="12" rx="6" fill="#1B8F4C" fill-opacity="0.35"/>
                <rect x="140" y="192" width="90" height="12" rx="6" fill="#1B8F4C" fill-opacity="0.35"/>
                <rect x="140" y="214" width="60" height="12" rx="6" fill="#1B8F4C" fill-opacity="0.35"/>
                <circle cx="200" cy="100" r="30" fill="#B9FBDE"/>
                <path d="M188 100l9 9 16-18" stroke="#15703C" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
            <div class="carousel-copy">
              <span class="tag">RW 04 · Sabtu Pagi</span>
              <h3>Penimbangan Rutin Mingguan</h3>
              <p>Warga membawa sampah pilahan dari rumah untuk ditimbang langsung oleh petugas, poin masuk otomatis ke buku tabungan.</p>
              <div class="carousel-meta">
                <div>212 kg tertimbang</div>
                <div>38 nasabah hadir</div>
              </div>
            </div>
          </div>

          <div class="carousel-slide">
            <div class="carousel-visual" style="background:linear-gradient(160deg,#2AACC9,#1B8F4C);">
              <svg viewBox="0 0 400 340" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="70" r="80" fill="#ffffff" fill-opacity="0.08"/>
                <circle cx="340" cy="270" r="100" fill="#ffffff" fill-opacity="0.08"/>
                <rect x="90" y="120" width="220" height="150" rx="14" fill="#EAFBF1"/>
                <circle cx="150" cy="180" r="26" fill="#2AACC9" fill-opacity="0.5"/>
                <circle cx="210" cy="200" r="20" fill="#1FAE64" fill-opacity="0.6"/>
                <circle cx="260" cy="170" r="16" fill="#15703C" fill-opacity="0.5"/>
                <path d="M120 235h180" stroke="#1B8F4C" stroke-width="6" stroke-linecap="round" stroke-dasharray="2 14"/>
              </svg>
            </div>
            <div class="carousel-copy">
              <span class="tag">Balai Warga RW 07</span>
              <h3>Edukasi Pilah Sampah Anak-anak</h3>
              <p>Sesi bermain sambil belajar memilah sampah anorganik, membangun kebiasaan sejak dini bersama orang tua.</p>
              <div class="carousel-meta">
                <div>54 anak ikut serta</div>
                <div>3 sesi / bulan</div>
              </div>
            </div>
          </div>

          <div class="carousel-slide">
            <div class="carousel-visual" style="background:linear-gradient(160deg,#15703C,#2AACC9);">
              <svg viewBox="0 0 400 340" xmlns="http://www.w3.org/2000/svg">
                <circle cx="330" cy="90" r="90" fill="#ffffff" fill-opacity="0.08"/>
                <rect x="80" y="140" width="240" height="24" rx="12" fill="#EAFBF1"/>
                <rect x="80" y="140" width="150" height="24" rx="12" fill="#3EE39B"/>
                <rect x="80" y="180" width="240" height="24" rx="12" fill="#EAFBF1"/>
                <rect x="80" y="180" width="90" height="24" rx="12" fill="#2AACC9"/>
                <rect x="80" y="220" width="240" height="24" rx="12" fill="#EAFBF1"/>
                <rect x="80" y="220" width="190" height="24" rx="12" fill="#1FAE64"/>
              </svg>
            </div>
            <div class="carousel-copy">
              <span class="tag">Gudang Pusat</span>
              <h3>Penyaluran ke Mitra Daur Ulang</h3>
              <p>Sampah terpilah dikirim tiap dua minggu ke mitra pengolahan, memastikan siklus daur ulang berjalan penuh.</p>
              <div class="carousel-meta">
                <div>4,8 ton / periode</div>
                <div>6 mitra aktif</div>
              </div>
            </div>
          </div>

          <div class="carousel-slide">
            <div class="carousel-visual" style="background:linear-gradient(160deg,#1B8F4C,#0F5C34);">
              <svg viewBox="0 0 400 340" xmlns="http://www.w3.org/2000/svg">
                <circle cx="70" cy="260" r="90" fill="#ffffff" fill-opacity="0.08"/>
                <rect x="110" y="110" width="180" height="160" rx="16" fill="#EAFBF1"/>
                <path d="M150 190l30 30 70-70" stroke="#1FAE64" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <circle cx="200" cy="190" r="70" stroke="#B9FBDE" stroke-width="6" fill="none" stroke-dasharray="8 10"/>
              </svg>
            </div>
            <div class="carousel-copy">
              <span class="tag">Kantor Pusat</span>
              <h3>Hari Penukaran Poin</h3>
              <p>Nasabah menukar poin ke sembako, voucher, dan kebutuhan rumah tangga langsung di titik setor utama.</p>
              <div class="carousel-meta">
                <div>860 penukaran</div>
                <div>Setiap akhir bulan</div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="carousel-controls">
        <div class="carousel-dots" id="carouselDots"></div>
        <div class="carousel-arrows">
          <button id="carouselPrev" aria-label="Sebelumnya">
            <svg viewBox="0 0 24 24" fill="none"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <button id="carouselNext" aria-label="Berikutnya">
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="lokasi">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">Lokasi &amp; Jadwal</span>
      <h2>Titik setor terdekat dari rumahmu</h2>
      <p>Datang langsung dengan sampah yang sudah dipilah, atau ajukan penjemputan untuk volume besar.</p>
    </div>
    <div class="lokasi-grid">
      <div class="info-card">
        <h3>Jadwal Operasional</h3>
        <div class="row"><span>Senin – Jumat</span><span>08.00 – 15.00</span></div>
        <div class="row"><span>Sabtu</span><span>08.00 – 12.00</span></div>
        <div class="row"><span>Minggu &amp; libur</span><span>Tutup</span></div>
      </div>
      <div class="info-card">
        <h3>Titik Setor Utama</h3>
        <div class="row"><span>Kantor Bank Sampah Lestari</span><span>Jl. Melati No. 12</span></div>
        <div class="row"><span>Pos RW 04</span><span>Jl. Kenanga Blok C</span></div>
        <div class="row"><span>Balai Warga RW 07</span><span>Jl. Anggrek No. 5</span></div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <span class="tag">Kata Nasabah</span>
      <h2>Dipercaya warga sekitar</h2>
    </div>
    <div class="testi-grid">
      <div class="testi">
        <p>"Sampah rumah yang dulu cuma dibuang, sekarang jadi tabungan bulanan buat kebutuhan dapur."</p>
        <div class="who"><div class="avatar">RS</div><div><div class="name">Rina S.</div><div class="role">Nasabah sejak 2023</div></div></div>
      </div>
      <div class="testi">
        <p>"Prosesnya cepat, timbangan transparan, dan saldo langsung tercatat di buku tabungan saya."</p>
        <div class="who"><div class="avatar">AH</div><div><div class="name">Ahmad H.</div><div class="role">Nasabah RW 04</div></div></div>
      </div>
      <div class="testi">
        <p>"Anak-anak sekarang lebih semangat memilah sampah karena tahu ujungnya jadi uang jajan."</p>
        <div class="who"><div class="avatar">DP</div><div><div class="name">Dewi P.</div><div class="role">Nasabah RW 07</div></div></div>
      </div>
    </div>
  </div>
</section>

<section id="daftar" style="padding-top:0;padding-bottom:90px;">
  <div class="cta-final">
    <div>
      <h2>Mulai menabung dari sampah hari ini.</h2>
      <p>Pendaftaran nasabah gratis, cukup bawa KTP dan sampah pilahan pertamamu.</p>
    </div>
    <a href="#" class="btn btn-primary">Daftar Sekarang</a>
  </div>
</section>

<footer>
  <div class="wrap">
    <div class="footer-grid">
      <div class="fnote">© 2026 Bank Sampah Lestari. Dikelola oleh warga, untuk warga.</div>
      <div class="flinks">
        <a href="#tentang">Tentang</a>
        <a href="#cara-kerja">Cara Kerja</a>
        <a href="#harga">Harga Sampah</a>
        <a href="#tukar-poin">Tukar Poin</a>
        <a href="#galeri">Galeri</a>
        <a href="#lokasi">Lokasi</a>
      </div>
    </div>
  </div>
</footer>

<script>
  // Header scroll effect
  const header = document.getElementById('siteHeader');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 12);
  });

  // Mobile menu toggle
  const burgerBtn = document.getElementById('burgerBtn');
  const mobilePanel = document.getElementById('mobilePanel');
  burgerBtn.addEventListener('click', () => {
    const isOpen = mobilePanel.classList.toggle('open');
    burgerBtn.classList.toggle('open', isOpen);
    burgerBtn.setAttribute('aria-expanded', isOpen);
  });
  mobilePanel.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => {
      mobilePanel.classList.remove('open');
      burgerBtn.classList.remove('open');
      burgerBtn.setAttribute('aria-expanded', 'false');
    });
  });

  // Active nav link on scroll
  const sections = ['tentang','cara-kerja','harga','tukar-poin','galeri','lokasi'].map(id => document.getElementById(id));
  const navAnchors = document.querySelectorAll('.navlinks a');
  const setActive = () => {
    let current = null;
    sections.forEach(sec => {
      if (sec && window.scrollY >= sec.offsetTop - 140) current = sec.id;
    });
    navAnchors.forEach(a => {
      a.classList.toggle('active', a.getAttribute('href') === '#' + current);
    });
  };
  window.addEventListener('scroll', setActive);
  setActive();

  // Carousel
  (function(){
    const track = document.getElementById('carouselTrack');
    const slides = Array.from(track.children);
    const dotsWrap = document.getElementById('carouselDots');
    const prevBtn = document.getElementById('carouselPrev');
    const nextBtn = document.getElementById('carouselNext');
    const carouselEl = document.getElementById('galeriCarousel');
    let index = 0;
    let autoplayTimer;

    slides.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.setAttribute('aria-label', 'Slide ' + (i + 1));
      if (i === 0) dot.classList.add('active');
      dot.addEventListener('click', () => goTo(i));
      dotsWrap.appendChild(dot);
    });
    const dots = Array.from(dotsWrap.children);

    function update(){
      track.style.transform = 'translateX(-' + (index * 100) + '%)';
      dots.forEach((d, i) => d.classList.toggle('active', i === index));
    }
    function goTo(i){
      index = (i + slides.length) % slides.length;
      update();
      restartAutoplay();
    }
    function next(){ goTo(index + 1); }
    function prev(){ goTo(index - 1); }

    nextBtn.addEventListener('click', next);
    prevBtn.addEventListener('click', prev);

    function startAutoplay(){ autoplayTimer = setInterval(next, 5000); }
    function restartAutoplay(){ clearInterval(autoplayTimer); startAutoplay(); }
    startAutoplay();

    carouselEl.addEventListener('mouseenter', () => clearInterval(autoplayTimer));
    carouselEl.addEventListener('mouseleave', startAutoplay);

    // Touch swipe
    let startX = 0;
    track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, {passive:true});
    track.addEventListener('touchend', e => {
      const diff = e.changedTouches[0].clientX - startX;
      if (Math.abs(diff) > 40) { diff < 0 ? next() : prev(); }
    }, {passive:true});
  })();
</script>

</body>
</html>