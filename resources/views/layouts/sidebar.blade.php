<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">

    {{-- Judul Title --}}
    <title>@yield('title')</title>
    @stack('styles')
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    /* ========== SIDEBAR DEFAULT (DESKTOP) ========== */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        width: 78px;
        background: #FfFFFf;
        border-right: 1px solid #e5e7eb;
        padding: 6px 14px;
        z-index: 100;
        transition: all 0.5s ease;
    }

    /* Efek Blur saat Modal Terbuka */
    body.modal-open .sidebar {
        filter: blur(10px) brightness(0.7);
        pointer-events: none;
        user-select: none;
    }

    body.modal-open .home-section {
        background: rgba(0, 0, 0, 0.1);
    }

    .sidebar.open {
        width: 250px;
    }

    .sidebar .logo-details {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }

    .sidebar .logo-details .logo_name {
        color: #000003;
        font-size: 20px;
        font-weight: 600;
        opacity: 0;
        transition: all 0.5s ease;
    }

    .sidebar.open .logo-details,
    .sidebar.open .logo-details .logo_name {
        opacity: 1;
    }

    .sidebar .logo-details #btn {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        font-size: 22px;
        text-align: center;
        cursor: pointer;
        transition: all 0.5s ease;
    }

    .sidebar.open .logo-details #btn {
        text-align: center;
    }

    .sidebar i {
        color: #475569;
        height: 60px;
        min-width: 50px;
        font-size: 28px;
        text-align: center;
        line-height: 60px;
    }

    .sidebar .nav-list {
        margin-top: 20px;
        height: 100%;
    }

    .sidebar li {
        position: relative;
        margin: 8px 0;
        list-style: none;
    }

    .sidebar li i {
        height: 50px;
        line-height: 50px;
        font-size: 18px;
        border-radius: 12px;
    }

    .sidebar li a {
        display: flex;
        height: 100%;
        width: 100%;
        border-radius: 12px;
        align-items: center;
        text-decoration: none;
        transition: all 0.4s ease;
        background: transparent;
    }

    .sidebar li a:hover {
        background: #d6e6ef;
        outline: none;
    }

    .sidebar li a .links_name {
        color: #334155;
        font-size: 15px;
        font-weight: 400;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: 0.4s;
    }

    .sidebar.open li a .links_name {
        opacity: 1;
        pointer-events: auto;
    }

    .sidebar li a:hover .links_name,
    .sidebar li a:hover i {
        transition: all 0.5s ease;
        color: #2a3e4b;
    }

    .sidebar li .tooltip {
        position: absolute;
        top: -20px;
        left: calc(100% + 15px);
        background: #fff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 15px;
        font-weight: 400;
        opacity: 0;
        white-space: nowrap;
        pointer-events: none;
        transition: 0s;
    }

    .sidebar li:hover .tooltip {
        opacity: 1;
        pointer-events: auto;
        transition: all 0.4s ease;
        top: 50%;
        transform: translateY(-50%);
    }

    .sidebar.open li .tooltip {
        display: none;
    }

    .sidebar li.profile {
        position: fixed;
        height: 60px;
        width: 78px;
        left: 0;
        bottom: -8px;
        padding: 10px 14px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        transition: all 0.5s ease;
        overflow: hidden;
    }

    .sidebar.open li.profile {
        width: 250px;
    }

    .sidebar li .profile-details {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
    }

    .sidebar li img {
        height: 45px;
        width: 45px;
        object-fit: contain;
        border-radius: 6px;
        margin-right: 10px;
    }

    .sidebar li.profile .name,
    .sidebar li.profile .job {
        font-size: 15px;
        font-weight: 400;
        color: #334155;
        white-space: nowrap;
    }

    .sidebar li.profile .job {
        font-size: 12px;
    }

    .sidebar .profile #log_out {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        background: #FfFFFf;
        color: #64748b;
        width: 100%;
        height: 60px;
        line-height: 60px;
        transition: all 0.5s ease;
    }

    .sidebar.open .profile #log_out {
        width: 50px;
        background: none;
    }

    .home-section {
        position: fixed;
        background: linear-gradient(to bottom, #f7fbfd, #d6e6ef 50%);
        height: 100vh;
        overflow: hidden;
        top: 0;
        bottom: 0;
        left: 78px;
        right: 0;
        width: calc(100% - 78px);
        transition: all 0.5s ease;
        overflow-y: auto;
    }

    .sidebar.open~.home-section {
        left: 250px;
        width: calc(100% - 250px);
    }

    .main {
        width: 100%;
        height: 100%;
        padding: 20px;
        box-sizing: border-box;
    }

    .home-section .main {
        display: block;
        color: #2a3e4b;
        font-size: 25px;
        font-weight: 500;
        margin: 12px;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    html {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    /* Style untuk Badge Notifikasi */
    .sidebar li a {
        position: relative;
    }

    .sidebar li a .badge-notif {
        position: absolute;
        top: 8px;
        left: 28px;
        background: #ef4444;
        color: white;
        font-size: 10px;
        font-weight: 700;
        min-width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 2px solid #fff;
        transition: all 0.5s ease;
        z-index: 10;
    }

    .sidebar.open li a .badge-notif {
        left: 32px;
    }

    #container {
        height: 100% !important;
        display: block;
    }

    /* ========== MOBILE HAMBURGER MENU (TOGGLE) ========== */
    .mobile-header {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: white;
        border-bottom: 1px solid #e5e7eb;
        z-index: 101;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
    }

    .mobile-logo {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mobile-logo img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .mobile-logo span {
        font-weight: 700;
        font-size: 16px;
        color: var(--saas-primary, #2f4b7c);
    }

    .hamburger-btn {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #2f4b7c;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        transition: 0.2s;
    }

    .hamburger-btn:hover {
        background: #f1f5f9;
    }

    /* Mobile Sidebar Overlay */
    .mobile-sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 200;
        transition: 0.3s ease;
    }

    /* Mobile Sidebar */
    .mobile-sidebar {
        position: fixed;
        top: 0;
        left: -280px;
        width: 280px;
        height: 100%;
        background: white;
        z-index: 201;
        transition: left 0.3s ease;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .mobile-sidebar.open {
        left: 0;
    }

    .mobile-sidebar .mobile-sidebar-header {
        padding: 20px 16px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mobile-sidebar .mobile-sidebar-header h3 {
        font-size: 18px;
        font-weight: 700;
        color: #2f4b7c;
    }

    .close-sidebar-btn {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #64748b;
    }

    .mobile-nav-list {
        list-style: none;
        padding: 16px 0;
    }

    .mobile-nav-list li {
        margin: 4px 0;
    }

    .mobile-nav-list li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        text-decoration: none;
        color: #334155;
        font-size: 15px;
        font-weight: 500;
        transition: 0.2s;
    }

    .mobile-nav-list li a:hover {
        background: #d6e6ef;
    }

    .mobile-nav-list li a i {
        font-size: 20px;
        width: 28px;
        color: #475569;
    }

    .mobile-nav-list .badge-notif-mobile {
        background: #ef4444;
        color: white;
        font-size: 10px;
        font-weight: 700;
        min-width: 18px;
        height: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-left: auto;
    }

    .mobile-profile {
        border-top: 1px solid #e5e7eb;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 20px;
    }

    .mobile-profile img {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        object-fit: cover;
    }

    .mobile-profile-info .name {
        font-weight: 700;
        font-size: 14px;
        color: #1e293b;
    }

    .mobile-profile-info .role {
        font-size: 12px;
        color: #64748b;
    }

    .mobile-logout {
        margin-top: 16px;
        padding: 12px 20px;
        border-top: 1px solid #e5e7eb;
    }

    .mobile-logout button {
        display: flex;
        align-items: center;
        gap: 12px;
        background: none;
        border: none;
        width: 100%;
        padding: 12px;
        font-size: 15px;
        font-weight: 500;
        color: #ef4444;
        cursor: pointer;
        border-radius: 12px;
    }

    .mobile-logout button:hover {
        background: #fee2e2;
    }

    /* ========== VERSI MOBILE - RESPONSIVE ========== */
    @media (max-width: 768px) {

        /* Sembunyikan sidebar default */
        .sidebar {
            display: none;
        }

        /* Tampilkan mobile header */
        .mobile-header {
            display: flex;
        }

        /* Home section menyesuaikan */
        .home-section {
            left: 0 !important;
            width: 100% !important;
            top: 60px;
            height: calc(100vh - 60px);
        }

        .sidebar.open~.home-section {
            left: 0 !important;
            width: 100% !important;
        }

        .main {
            padding: 16px;
        }

        .home-section .main {
            margin: 0;
            font-size: 18px;
        }
    }

    /* Landscape mode */
    @media (max-width: 768px) and (orientation: landscape) {
        .mobile-sidebar {
            width: 260px;
        }

        .home-section {
            top: 55px;
            height: calc(100vh - 55px);
        }

        .mobile-header {
            height: 55px;
        }
    }
</style>

<body>
    <!-- ================== Sidebar (Desktop) ================== -->
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">Halo {{ Auth::user()->name }}</div>
            <i class='bx bx-menu' id="btn" style="color: #000003"></i>
        </div>
        <ul class="nav-list">
            @if (Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bx bx-dashboard"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                {{-- <li>
                    <a href="{{ route('admin.notification') }}">
                        <i class="bx bx-message-bubble-notification bx-flashing"></i>
                        <span class="links_name">Notification</span>
                    </a>
                    <span class="tooltip">Notification</span>
                </li> --}}
                <li>
                    <a href="{{ route('admin.car') }}">
                        <i class='bx bx-car'></i>
                        <span class="links_name">Daftar Mobil</span>
                    </a>
                    <span class="tooltip">Daftar Mobil</span>
                </li>
                <li>
                    <a href="{{ route('admin.bookings') }}">
                        <i class="bx bx-list-ul"></i>
                        @if(isset($pendingCount) && $pendingCount > 0)
                            <span class="badge-notif">{{ $pendingCount }}</span>
                        @endif
                        <span class="links_name">Daftar Booking</span>
                    </a>
                    <span class="tooltip">Daftar Booking</span>
                </li>
                <li>
                    <a href="{{ route('admin.user') }}">
                        <i class='bx bx-user'></i>
                        <span class="links_name">User</span>
                    </a>
                    <span class="tooltip">User</span>
                </li>
            @else
                <li>
                    <a href="{{ route('customer.dashboard') }}">
                        <i class="bx bx-dashboard"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="{{ route('customer.car') }}">
                        <i class="bx bx-car"></i>
                        <span class="links_name">Sewa Mobil</span>
                    </a>
                    <span class="tooltip">Sewa Mobil</span>
                </li>
                <li>
                    <a href="{{ route('customer.riwayat') }}">
                        <i class="bx bx-history"></i>
                        <span class="links_name">Riwayat Pesanan</span>
                    </a>
                    <span class="tooltip">Riwayat Pesanan</span>
                </li>
            @endif

            <li class="profile">
                <div class="profile-details">
                    <img src="{{ Auth::user()->avatar ?? asset('images/profile.webp')}}" alt="profileImg">
                    <div class="name_job">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="job">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="cursor: pointer;">
                        <i class='bx bx-arrow-out-left-square-half' id="log_out"></i>
                    </button>
                    <span>Logout</span>
                </form>
            </li>
        </ul>
    </div>


    {{-- =========================== Batas =========================== --}}


    <!-- Mobile Header dengan Hamburger -->
    <div class="mobile-header">
        <button class="hamburger-btn" id="hamburgerBtn">
            <i class='bx bx-menu'></i>
        </button>
    </div>

    <!-- ================== Mobile Sidebar ================== -->
    <div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>
    <div class="mobile-sidebar" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <h3>Menu</h3>
            <button class="close-sidebar-btn" id="closeSidebarBtn">
                <i class='bx bx-x'></i>
            </button>
        </div>

        <ul class="mobile-nav-list">
            @if (Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bx bx-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('admin.notification') }}">
                        <i class="bx bx-message-bubble-notification"></i>
                        <span>Notification</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('admin.car') }}">
                        <i class='bx bx-car'></i>
                        <span>Daftar Mobil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings') }}">
                        <i class="bx bx-list-ul"></i>
                        <span>Daftar Booking</span>
                        @if(isset($pendingCount) && $pendingCount > 0)
                            <span class="badge-notif-mobile">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.user') }}">
                        <i class='bx bx-user'></i>
                        <span>User</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('customer.dashboard') }}">
                        <i class="bx bx-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.car') }}">
                        <i class="bx bx-car"></i>
                        <span>Sewa Mobil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.riwayat') }}">
                        <i class="bx bx-history"></i>
                        <span>Riwayat Pesanan</span>
                    </a>
                </li>
            @endif
        </ul>

        <!-- Profile Section Mobile -->
        <div class="mobile-profile">
            <img src="{{ Auth::user()->avatar ?? asset('images/profile.webp') }}" alt="profileImg">
            <div class="mobile-profile-info">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
        </div>

        <!-- Logout Mobile -->
        <div class="mobile-logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class='bx bx-log-out'></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <section class="home-section">
        <div class="main" style="padding: 20px;">
            @yield('content')
        </div>
    </section>

    {{-- Alert / Toast Global --}}
    @include('components.alert')

    {{-- Sidebar dan Chart --}}
    <script>
        // ========== DESKTOP SIDEBAR TOGGLE ==========
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");

        if (closeBtn) {
            closeBtn.addEventListener("click", () => {
                sidebar.classList.toggle("open");
                menuBtnChange();

                setTimeout(() => {
                    if (typeof highcharts !== 'undefined') {
                        Highcharts.charts.forEach(chart => {
                            if (chart) {
                                chart.reflow();
                            }
                        });
                    }
                }, 500);
            });
        }

        function menuBtnChange() {
            if (sidebar && closeBtn) {
                if (sidebar.classList.contains("open")) {
                    closeBtn.classList.replace("bx-menu", "bx-menu-right");
                } else {
                    closeBtn.classList.replace("bx-menu-right", "bx-menu");
                }
            }
        }

        if (sidebar && closeBtn) {
            menuBtnChange();
        }

        // ========== MOBILE SIDEBAR TOGGLE ==========
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const mobileOverlay = document.getElementById('mobileSidebarOverlay');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');

        function openMobileSidebar() {
            mobileSidebar.classList.add('open');
            mobileOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            mobileSidebar.classList.remove('open');
            mobileOverlay.style.display = 'none';
            document.body.style.overflow = '';
        }

        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', openMobileSidebar);
        }

        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener('click', closeMobileSidebar);
        }

        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', closeMobileSidebar);
        }

        // Tutup sidebar saat layar di-resize ke desktop
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                if (mobileSidebar && mobileSidebar.classList.contains('open')) {
                    closeMobileSidebar();
                }
            }
        });
    </script>
    @stack('scripts')
</body>

</html>