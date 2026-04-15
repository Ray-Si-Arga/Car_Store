<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>@yield('title')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">

</head>

<style>
    .font-poppins {
        font-family: "Poppins", sans-serif;
        font-weight: 500;
    }

    :root {
        --primary-color: #111111;
        --hover-color: #555555;
        --text-color: #111111;
        --bg-color: #ffffff;
        --shadow: 0 1px 0 rgba(0, 0, 0, 0.08);
        --mobile-padding: 16px;
        --mobile-gap: 12px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        padding-top: 70px;
        background-color: #E5EEEA;
        line-height: 1.6;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    /* ===== Dekorasi Background ===== */
    body::before,
    body::after {
        content: '';
        position: fixed;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    /* Lingkaran biru kiri atas */
    body::before {
        width: 520px;
        height: 520px;
        top: -160px;
        left: -160px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.13) 0%, transparent 70%);
        filter: blur(30px);
        animation: floatA 10s ease-in-out infinite alternate;
    }

    /* Lingkaran tosca kanan bawah */
    body::after {
        width: 480px;
        height: 480px;
        bottom: -120px;
        right: -120px;
        background: radial-gradient(circle, rgba(20, 184, 166, 0.13) 0%, transparent 70%);
        filter: blur(30px);
        animation: floatB 12s ease-in-out infinite alternate;
    }

    /* Lingkaran tambahan tengah */
    .main::before {
        content: '';
        position: fixed;
        width: 360px;
        height: 360px;
        top: 40%;
        left: 55%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.07) 0%, transparent 70%);
        filter: blur(40px);
        pointer-events: none;
        z-index: 0;
        animation: floatC 14s ease-in-out infinite alternate;
    }

    @keyframes floatA {
        0% {
            transform: translate(0, 0) scale(1);
        }

        100% {
            transform: translate(30px, 30px) scale(1.08);
        }
    }

    @keyframes floatB {
        0% {
            transform: translate(0, 0) scale(1);
        }

        100% {
            transform: translate(-25px, -25px) scale(1.06);
        }
    }

    @keyframes floatC {
        0% {
            transform: translate(0, 0) scale(1);
        }

        100% {
            transform: translate(20px, -20px) scale(1.05);
        }
    }

    /* Pastikan konten di atas dekorasi */
    .main,
    header,
    footer {
        position: relative;
        z-index: 1;
    }

    /* ===== Dot Pattern Texture ===== */
    .bg-dots {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background-image: radial-gradient(circle, rgba(59, 130, 246, 0.08) 1px, transparent 1px);
        background-size: 32px 32px;
        mask-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.15) 0%, transparent 75%);
        -webkit-mask-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.15) 0%, transparent 75%);
    }

    /* ===== Header ===== */
    .header {
        background-color: #ffffff;
        padding: 0;
        height: 70px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #e8e8e8;
        box-shadow: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    /* Efek Blur saat Modal Terbuka */
    body.modal-open .header,
    body.modal-open .bg-dots,
    body.modal-open footer {
        filter: blur(10px) brightness(0.7);
        pointer-events: none;
        user-select: none;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 28px;
        width: 100%;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #111111;
        font-weight: 700;
        font-size: 1.15rem;
        letter-spacing: -0.2px;
        transition: transform 0.3s;
    }

    .logo img {
        width: 75px;
        height: auto;
    }

    .nav-menu {
        display: flex;
        list-style: none;
        gap: 4px;
        align-items: center;
    }

    .nav-menu a {
        color: black;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.88rem;
        padding: 7px 14px;
        border-radius: 6px;
        transition: all 0.2s;
        position: relative;
    }

    .nav-menu a:hover {
        color: #1C3AFF;
        background-color: #E8EBFF;
    }

    .nav-menu a::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 50%;
        width: 0;
        height: 1.5px;
        background: #1C3AFF;
        transition: all 0.25s;
    }

    .nav-menu a:hover::after {
        width: calc(100% - 28px);
        left: 14px;
    }

    .login-btn {
        background-color: #3B82F6 !important;
        color: #ffffff !important;
        padding: 8px 20px !important;
        border-radius: 7px !important;
        font-weight: 600 !important;
        font-size: 0.87rem !important;
        transition: all 0.25s !important;
        box-shadow: none !important;
    }

    .login-btn::after {
        display: none !important;
    }

    .login-btn:hover {
        background-color: #2054a7 !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    }

    html {
        scroll-behavior: smooth;
    }

    /* Main Content */
    main {
        padding: 2rem;
        min-height: calc(100vh - 80px);
    }

    /* ===== Footer ===== */
    footer {
        background-color: #ffffff;
        padding: 2rem;
        text-align: center;
        border-top: 1px solid #e8e8e8;
        margin-top: 2rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-content p {
        color: #999999;
        font-size: 0.82rem;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        letter-spacing: 0.2px;
    }

    /* ========== VERSI MOBILE - RESPONSIVE DESIGN ========== */
    @media (max-width: 768px) {
        body {
            padding-top: 60px;
        }

        .header {
            height: 60px;
        }

        .header-container {
            padding: 0 var(--mobile-padding);
        }

        .logo p {
            display: none;
        }

        .logo img {
            width: 45px;
        }

        /* Mobile Navigation - Horizontal Scroll */
        .nav-menu {
            gap: 0;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            padding: 4px 0;
        }

        .nav-menu::-webkit-scrollbar {
            height: 3px;
        }

        .nav-menu::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .nav-menu a {
            font-size: 0.75rem;
            padding: 6px 12px;
            white-space: nowrap;
        }

        .login-btn {
            padding: 6px 14px !important;
            font-size: 0.75rem !important;
        }

        /* Main Content */
        main {
            padding: 1rem;
            min-height: calc(100vh - 60px);
        }

        /* Footer */
        footer {
            padding: 1.25rem;
            margin-top: 1.5rem;
        }

        .footer-content p {
            font-size: 0.7rem;
        }

        /* Dekorasi Background Mobile - Lebih Kecil */
        body::before {
            width: 280px;
            height: 280px;
            top: -100px;
            left: -100px;
            filter: blur(20px);
        }

        body::after {
            width: 250px;
            height: 250px;
            bottom: -80px;
            right: -80px;
            filter: blur(20px);
        }

        .main::before {
            width: 200px;
            height: 200px;
            top: 30%;
            left: 70%;
            filter: blur(30px);
        }

        /* Dot Pattern lebih kecil */
        .bg-dots {
            background-size: 20px 20px;
        }
    }

    /* Untuk layar sangat kecil (max 480px) */
    @media (max-width: 480px) {
        .nav-menu {
            gap: 0;
        }

        .nav-menu a {
            font-size: 0.7rem;
            padding: 5px 10px;
        }

        .login-btn {
            padding: 5px 12px !important;
            font-size: 0.7rem !important;
        }

        .logo img {
            width: 40px;
        }

        main {
            padding: 0.75rem;
        }
    }

    /* Landscape mode untuk mobile */
    @media (max-width: 768px) and (orientation: landscape) {
        body {
            padding-top: 55px;
        }

        .header {
            height: 55px;
        }

        .nav-menu {
            gap: 2px;
        }

        .nav-menu a {
            font-size: 0.7rem;
            padding: 4px 10px;
        }

        main {
            min-height: calc(100vh - 55px);
        }
    }
</style>

<body>
    <div class="bg-dots"></div>

    <header class="header">
        <div class="header-container">
            <a href="/" class="logo">
                <img src="{{ asset('images/logo.png') }}" width="35" height="35" alt="Rental Car Logo">
                <p>Rental Mobilku</p>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}#home">Home</a></li>
                <li><a href="{{ route('cars') }}">Mobil</a></li>
                <li><a href="{{ url('/') }}#tentang">Tentang</a></li>
                <li><a href="{{ url('/') }}#lokasi">Lokasi</a></li>
                <li><a href="{{ url('/') }}#hubungi-kami">Hubungi Kami</a></li>
                <li><a href="{{ route('login') }}" class="login-btn">Login</a></li>
            </ul>
        </div>
    </header>

    <div class="main">
        @yield('content.landing')
    </div>

    <footer>
        <div class="footer-content">
            <p class="font-poppins">&copy; 2023 Rental Mobilku. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>