@extends('layouts.landing_page')
@section('title', 'Landing Page')
@section('content.landing')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta name="description" content="Sewa mobil berkualitas dengan harga terjangkau">

    <style>
        :root {
            --blue: #3B82F6;
            --blue-dk: #2563EB;
            --blue-lt: #EFF6FF;
            --blue-mid: #DBEAFE;
            --text: #1E293B;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --bg: #F8FAFF;
            --white: #ffffff;
            --radius-xl: 20px;
            --radius-lg: 14px;
            /* Shadow natural: satu layer, opacity rendah */
            --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 28px rgba(0, 0, 0, 0.10);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background: var(--bg);
        }

        /* ===== Layout wrapper ===== */
        .page-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* ===== Section card ===== */
        .section-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border);
            padding: 2.5rem 2rem;
            box-shadow: var(--shadow-md);
        }

        .section-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
        }

        .section-title p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 0.35rem;
        }

        /* Chip — biru & putih saja */
        .chip {
            display: inline-block;
            background: var(--blue-mid);
            color: var(--blue-dk);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 99px;
            margin-bottom: 0.65rem;
            border: 1px solid #BFDBFE;
        }

        /* ===== Blur Text ===== */
        .blur-text-container {
            text-align: center;
            padding: 1.5rem 1rem 0.5rem;
        }

        .blur-text {
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--text);
            display: inline-flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            letter-spacing: -0.4px;
        }

        .blur-text span {
            display: inline-block;
            opacity: 0;
            filter: blur(10px);
            transform: translateY(14px);
            animation: blurIn 1s forwards;
        }

        .blur-text span.accent {
            color: var(--blue);
        }

        .blur-text span.accent2 {
            color: var(--blue-dk);
        }

        .blur-text span:nth-child(1) {
            animation-delay: 0.10s;
        }

        .blur-text span:nth-child(2) {
            animation-delay: 0.28s;
        }

        .blur-text span:nth-child(3) {
            animation-delay: 0.46s;
        }

        .blur-text span:nth-child(4) {
            animation-delay: 0.64s;
        }

        @keyframes blurIn {
            to {
                opacity: 1;
                filter: blur(0);
                transform: translateY(0);
            }
        }

        /* ===== Banner Card ===== */
        .banner-inner {
            display: flex;
            align-items: stretch;
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-lg);
            min-height: 400px;
        }

        /* Kolom kiri — biru solid */
        .banner-text-col {
            flex: 0 0 42%;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.1rem;
            background: linear-gradient(to bottom right, var(--text), var(--blue-dk), var(--text));
        }

        .banner-text-col h1 {
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.25;
        }

        .banner-text-col h1 .accent {
            color: #93C5FD;
            /* biru muda */
        }

        .banner-text-col>p {
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.7;
        }

        .hero-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
            font-size: 0.77rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 99px;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--white);
            color: var(--blue-dk);
            padding: 11px 26px;
            border-radius: var(--radius-lg);
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: var(--shadow-sm);
            width: fit-content;
        }

        .cta-button:hover {
            background: var(--blue-mid);
            box-shadow: var(--shadow-md);
        }

        /* Kolom kanan gambar */
        .banner-img-col {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .banner-car-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        /* Glassmorphism pojok kanan bawah */
        .banner-glass {
            position: absolute;
            bottom: 1.8rem;
            right: 1.8rem;
            z-index: 10;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: var(--radius-lg);
            padding: 1.4rem 1.6rem;
            max-width: 280px;
            box-shadow: var(--shadow-lg);
        }

        .banner-glass h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .banner-glass p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 0.9rem;
        }

        .banner-glass-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--blue);
            color: var(--white);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 99px;
        }

        /* ===== Keunggulan ===== */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.2rem;
        }

        .feature-item {
            text-align: center;
            padding: 1.8rem 1.2rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            background: var(--white);
            transition: box-shadow 0.25s, transform 0.25s;
        }

        .feature-item:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: var(--blue-lt);
            color: var(--blue);
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.9rem;
            transition: background 0.25s, color 0.25s;
        }

        .feature-item:hover .feature-icon {
            background: var(--blue);
            color: var(--white);
        }

        .feature-item h3 {
            font-size: 0.93rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.35rem;
        }

        .feature-item p {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ===== Cars ===== */
        .cars-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.2rem;
        }

        .car-card {
            flex: 1 1 260px;
            max-width: 320px;
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.25s, transform 0.25s;
        }

        .car-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
        }

        .car-image-wrap {
            height: 180px;
            overflow: hidden;
        }

        .car-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .car-card:hover .car-image {
            transform: scale(1.05);
        }

        .car-info {
            padding: 1.1rem 1.3rem 1.3rem;
        }

        .car-info h3 {
            font-size: 0.97rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.25rem;
        }

        .car-info .price {
            font-size: 0.97rem;
            font-weight: 700;
            color: var(--blue);
            margin-bottom: 0.5rem;
        }

        .car-info p {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 3px;
        }

        /* ===== Steps ===== */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 1.2rem;
        }

        .step-item {
            text-align: center;
            padding: 1.8rem 1.2rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            background: var(--white);
            transition: box-shadow 0.25s, transform 0.25s;
        }

        .step-item:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        .step-number {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: var(--blue);
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.9rem;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
        }

        .step-item h3 {
            font-size: 0.93rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.35rem;
        }

        .step-item p {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ===== Testimonial ===== */
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.2rem;
        }

        .testimonial-card {
            padding: 1.6rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            background: var(--white);
            box-shadow: var(--shadow-sm);
            transition: box-shadow 0.25s, transform 0.25s;
        }

        .testimonial-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .stars {
            color: #F59E0B;
            font-size: 1rem;
            margin-bottom: 0.7rem;
        }

        .testimonial-card p {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 1.1rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--blue);
            color: var(--white);
            font-weight: 700;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .author-info h4 {
            font-size: 0.87rem;
            font-weight: 700;
            color: var(--text);
        }

        .author-info span {
            font-size: 0.76rem;
            color: var(--text-muted);
        }

        /* ===== Contact Box ===== */
        .box-container {
            text-align: center;
            background: var(--blue-dk);
            border-radius: var(--radius-xl);
            border: 1px solid #1D4ED8;
            padding: 3rem 2rem;
            box-shadow: var(--shadow-lg);
        }

        .box-container .chip {
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
            border-color: rgba(255, 255, 255, 0.25);
        }

        .box-container h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 0.6rem;
        }

        .box-container>p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.9rem;
            margin-bottom: 1.8rem;
        }

        .button-group {
            display: flex;
            gap: 0.8rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: var(--radius-lg);
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }

        .contact-btn:hover {
            background: var(--white);
            color: var(--blue-dk);
            border-color: var(--white);
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .banner-inner {
                flex-direction: column;
                min-height: auto;
            }

            .banner-text-col {
                flex: none;
                padding: 2rem 1.5rem;
            }

            .banner-img-col {
                height: 240px;
            }

            .banner-glass {
                bottom: 1rem;
                right: 1rem;
                max-width: 200px;
                padding: 1rem 1.1rem;
            }

            .banner-glass h2 {
                font-size: 0.95rem;
            }

            .blur-text {
                font-size: 1.5rem;
            }

            .banner-text-col h1 {
                font-size: 1.6rem;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
            }

            .contact-btn {
                width: 200px;
                justify-content: center;
            }
        }
    </style>

    <body>
        <main class="page-wrap" id="home">

            {{-- Blur Text --}}
            <div class="blur-text-container">
                <div class="blur-text">
                    <span>Sewa</span>
                    <span class="accent">Mobil</span>
                    <span>Berkualitas</span>
                    <span class="accent2">Terbaik</span>
                </div>
            </div>

            {{-- Banner Card --}}
            <div data-aos="fade-up">
                <div class="banner-inner">

                    {{-- Kolom kiri: teks --}}
                    <div class="banner-text-col">
                        <h1>
                            Sewa Mobil <span class="accent">Mudah</span>,<br>
                            Harga Terjangkau
                        </h1>
                        <p>Nikmati perjalanan nyaman dengan armada mobil terbaik kami. Proses sewa cepat,
                            harga transparan, dan layanan 24 jam siap membantu Anda.</p>
                        <div class="hero-badges">
                            <span class="hero-badge"><i class="fa-solid fa-shield-halved"></i> Terpercaya</span>
                            <span class="hero-badge"><i class="fa-solid fa-clock"></i> 24 Jam</span>
                            <span class="hero-badge"><i class="fa-solid fa-tag"></i> Transparan</span>
                        </div>
                        <a href="/cars" class="cta-button">
                            <i class="fa-solid fa-car"></i> Lihat Mobil Kami
                        </a>
                    </div>

                    {{-- Kolom kanan: gambar + glassmorphism --}}
                    <div class="banner-img-col">
                        <img src="{{ asset('images/mobil.avif') }}" alt="Armada Mobil Kami" class="banner-car-img">
                        <div class="banner-glass">
                            <h2>Terpercaya &amp; Terjangkau</h2>
                            <p>Jangan lewatkan kesempatan untuk sewa mobil dengan fasilitas lengkap dan harga terbaik !!</p>
                            <span class="banner-glass-badge">
                                <i class="fa-solid fa-star"></i> Pilihan Terbaik
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Keunggulan --}}
            <div class="section-card" data-aos="fade-up" id="tentang">
                <div class="section-title" id='tentang'>
                    <span class="chip">Kenapa Kami?</span>
                    <h2>Keunggulan Layanan Kami</h2>
                    <p>Kami hadir untuk memberikan pengalaman sewa mobil yang menyenangkan dan bebas khawatir</p>
                </div>
                <div class="features-grid">
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-icon"><i class="fa-solid fa-car-side"></i></div>
                        <h3>Armada Terawat</h3>
                        <p>Seluruh armada kami dirawat rutin dan dalam kondisi prima siap jalan.</p>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon"><i class="fa-solid fa-wallet"></i></div>
                        <h3>Harga Terbaik</h3>
                        <p>Harga kompetitif tanpa biaya tersembunyi. Transparan dari awal hingga akhir.</p>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon"><i class="fa-solid fa-headset"></i></div>
                        <h3>Dukungan 24 Jam</h3>
                        <p>Tim kami siap membantu kapanpun Anda membutuhkan bantuan di jalan.</p>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-icon"><i class="fa-solid fa-file-contract"></i></div>
                        <h3>Proses Mudah</h3>
                        <p>Proses pemesanan simpel, cepat, dan bisa dilakukan kapan saja dan di mana saja.</p>
                    </div>
                </div>
            </div>

            {{-- Cars --}}
            <div class="section-card" data-aos="fade-up">
                <div class="section-title">
                    <span class="chip">Armada Kami</span>
                    <h2>Pilihan Mobil Terbaik</h2>
                    <p>Berbagai pilihan kendaraan untuk setiap kebutuhan perjalanan Anda</p>
                </div>
                <div class="cars-grid">
                    <div class="car-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="car-image-wrap">
                            <img src="{{ asset('images/pajero.png') }}" alt="Pajero" class="car-image">
                        </div>
                        <div class="car-info">
                            <h3>Pajero Sport</h3>
                            <p class="price">Rp 400.000 / hari</p>
                            <p><img src="{{ asset('images/orang.png') }}" width='16' height='16' alt="Passenger"> 7 Orang
                            </p>
                            <p><img src="{{ asset('images/mobil_tanda.png') }}" width='16' height='16' alt="Transmission">
                                Gear</p>
                        </div>
                    </div>
                    <div class="car-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="car-image-wrap">
                            <img src="{{ asset('images/avanza.png') }}" alt="Toyota Avanza" class="car-image">
                        </div>
                        <div class="car-info">
                            <h3>Toyota Avanza</h3>
                            <p class="price">Rp 250.000 / hari</p>
                            <p><img src="{{ asset('images/orang.png') }}" width='16' height='16' alt="Passenger"> 7 Orang
                            </p>
                            <p><img src="{{ asset('images/mobil_tanda.png') }}" width='16' height='16' alt="Transmission">
                                Gear</p>
                        </div>
                    </div>
                    <div class="car-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="car-image-wrap">
                            <img src="{{ asset('images/brio.png') }}" alt="Honda Brio" class="car-image">
                        </div>
                        <div class="car-info">
                            <h3>Honda Brio</h3>
                            <p class="price">Rp 90.000 / hari</p>
                            <p><img src="{{ asset('images/orang.png') }}" width='16' height='16' alt="Passenger"> 4 Orang
                            </p>
                            <p><img src="{{ asset('images/mobil_tanda.png') }}" width='16' height='16' alt="Transmission">
                                Gear</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cara Sewa --}}
            <div class="section-card" data-aos="fade-up">
                <div class="section-title">
                    <span class="chip">📋 Panduan</span>
                    <h2>Cara Sewa Mobil</h2>
                    <p>Hanya 4 langkah mudah untuk mulai perjalanan Anda bersama kami</p>
                </div>
                <div class="steps-grid">
                    <div class="step-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="step-number">1</div>
                        <h3>Pilih Mobil</h3>
                        <p>Browsing koleksi mobil kami dan pilih yang sesuai kebutuhan & budget Anda.</p>
                    </div>
                    <div class="step-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="step-number">2</div>
                        <h3>Isi Formulir</h3>
                        <p>Lengkapi data diri dan tentukan tanggal sewa sesuai rencana perjalanan Anda.</p>
                    </div>
                    <div class="step-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="step-number">3</div>
                        <h3>Konfirmasi & Bayar</h3>
                        <p>Lakukan pembayaran melalui metode yang tersedia. Proses cepat dan aman.</p>
                    </div>
                    <div class="step-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="step-number">4</div>
                        <h3>Ambil Mobil</h3>
                        <p>Datang ke lokasi kami atau kami antar ke tempat Anda. Siap berangkat!</p>
                    </div>
                </div>
            </div>

            {{-- Maps --}}
            <div class="section-card" data-aos="fade-up" id="lokasi">
                <div class="section-title">
                    <span class="chip">Lokasi</span>
                    <h2>Temukan Kami</h2>
                </div>
                <section id="lokasi" style="border-radius: 16px; overflow: hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3951.598200590583!2d112.7565150738663!3d-7.936963679045677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwNTYnMTMuMSJTIDExMsKwNDUnMzIuNyJF!5e0!3m2!1sid!2sid!4v1775310203909!5m2!1sid!2sid"
                        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </section>
            </div>

            {{-- Contact --}}
            <div class="box-container" data-aos="fade-up" id="hubungi-kami">
                <span class="chip">Kontak</span>
                <h2>Hubungi Kami</h2>
                <p>Ada pertanyaan atau kendala? Tim kami siap membantu Anda kapanpun dibutuhkan.</p>
                <div class="button-group">
                    <a href="mailto:argaa3093@gmail.com" class="contact-btn" data-aos="fade-up" data-aos-delay="100">
                        <i class="fa-solid fa-envelope"></i> Email
                    </a>
                    <a href="https://maps.app.goo.gl/rfzayVaD3ZGBUnNR9" target="_blank" rel="noopener noreferrer"
                        class="contact-btn" data-aos="fade-up" data-aos-delay="200">
                        <i class="fa-solid fa-location-dot"></i> Lokasi
                    </a>
                    <a href="https://wa.me/+6282132104063" target="_blank" rel="noopener noreferrer" class="contact-btn"
                        data-aos="fade-up" data-aos-delay="300">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </main>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true, offset: 60 });
            });
        </script>
    </body>

@endsection