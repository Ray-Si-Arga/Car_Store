<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">

    {{-- Judul Title --}}
    <title>@yield('title')</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

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

    /* Pewarnaan pada sidebar yang harus diperbaiki */

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

    #container {
        height: 100% !important;
        display: block;
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">Halo {{ Auth::user()->name }}</div>
            <i class='bx bx-menu' id="btn" style="color: #000003"></i>
        </div>
        <ul class="nav-list">
            @if (Auth::user()->role == 'admin')

                {{-- Dashboard Admin --}}
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bx bx-dashboard"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>

                {{-- User Admin --}}
                <li>
                    <a href="{{ route('admin.user') }}">
                        <i class='bx bx-user'></i>
                        <span class="links_name">User</span>
                    </a>
                    <span class="tooltip">User</span>
                </li>

                {{-- Notification Admin --}}
                <li>
                    <a href="{{ route('admin.notification') }}">
                        <i class="bx bx-message-bubble-notification bx-flashing"></i>
                        <span class="links_name">Notification</span>
                    </a>
                    <span class="tooltip">Notification</span>
                </li>

                {{-- Mobil Admin --}}
                <li>
                    <a href="{{ route('admin.car') }}">
                        <i class='bx bx-car'></i>
                        <span class="links_name">Daftar Mobil</span>
                    </a>
                    <span class="tooltip">Daftar Mobil</span>
                </li>

                {{-- Booking Admin --}}
                <li>
                    <a href="{{ route('admin.bookings') }}">
                        <i class="bx bx-list-ul"></i>
                        <span class="links_name">Daftar Booking</span>
                    </a>
                    <span class="tooltip">Daftar Booking</span>
                </li>
            @else

                {{-- Dashboard Customer --}}
                <li>
                    <a href="{{ route('customer.dashboard') }}">
                        <i class="bx bx-dashboard"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>

                {{-- Sewa Mobil --}}
                <li>
                    <a href="{{ route('customer.car') }}">
                        <i class="bx bx-car"></i>
                        <span class="links_name">Sewa Mobil</span>
                    </a>
                    <span class="tooltip">Sewa Mobil</span>
                </li>

                {{-- Riwayat Pesanan --}}
                <li>
                    <a href="{{ route('customer.riwayat') }}">
                        <i class="bx bx-history"></i>
                        <span class="links_name">Riwayat Pesanan</span>
                    </a>
                    <span class="tooltip">Riwayat Pesanan</span>
                </li>
            @endif

            {{-- Profile User --}}
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

    <section class="home-section">
        <div class="main" style="padding: 20px;">
            @yield('content')
        </div>
    </section>

    {{-- Alert / Toast Global --}}
    @include('components.alert')

    {{-- Sidebar dan Chart--}}
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        // let searchBtn = document.querySelector(".bx-search");

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

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-right");
            } else {
                closeBtn.classList.replace("bx-menu-right", "bx-menu");
            }
        }

        menuBtnChange();
    </script>
</body>

</html>