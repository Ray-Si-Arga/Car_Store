@extends('layouts.sidebar')

@section('title', 'Notifikasi')

@section('content')

    <style>
        :root {
            --saas-primary: #2f4b7c;
            --saas-primary-dark: #1f3a60;
            --saas-primary-light: #eef2ff;
            --saas-accent: #2ecc71;
            --saas-accent-dark: #27ae60;
            --saas-warning: #f59e0b;
            --saas-info: #3b82f6;
            --saas-danger: #ef4444;
            --saas-cream: #f6f1d1;
            --saas-white: #ffffff;
            --saas-gray-50: #f8fafc;
            --saas-gray-100: #f1f5f9;
            --saas-gray-200: #e2e8f0;
            --saas-gray-300: #cbd5e1;
            --saas-gray-400: #94a3b8;
            --saas-gray-600: #5b6e8c;
            --saas-gray-700: #334155;
            --saas-gray-800: #1e293b;
            --saas-gray-900: #0f172a;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--saas-cream) 0%, #f0ecd5 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* Container */
        .notifikasi-container {
            margin: 0 auto;
        }

        /* Card Wrapper */
        .card-wrapper {
            background: transparent;
            position: relative;
        }

        .card-wrapper::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--saas-primary) 0%, var(--saas-accent) 100%);
            border-radius: 30px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .card-wrapper:hover::before {
            opacity: 0.15;
        }

        /* Card Styles */
        .card-saas {
            background: var(--saas-white);
            border-radius: 24px;
            border: 1px solid rgba(47, 75, 124, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .card-saas:hover {
            box-shadow: var(--shadow-xl);
        }

        /* Notification List */
        .notification-list {
            max-height: 550px;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .notification-list::-webkit-scrollbar {
            width: 6px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: var(--saas-gray-100);
            border-radius: 10px;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: var(--saas-gray-300);
            border-radius: 10px;
        }

        .notification-list::-webkit-scrollbar-thumb:hover {
            background: var(--saas-gray-400);
        }

        /* Notification Item */
        .notif-item {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--saas-gray-200);
            transition: all 0.2s ease;
            position: relative;
            cursor: pointer;
        }

        .notif-item:hover {
            background: var(--saas-gray-50);
        }

        /* Category Colors */
        .notif-item.info {
            border-left: 4px solid var(--saas-info);
        }

        .notif-item.success {
            border-left: 4px solid var(--saas-accent);
        }

        .notif-item.warning {
            border-left: 4px solid var(--saas-warning);
        }

        .notif-item.danger {
            border-left: 4px solid var(--saas-danger);
        }

        .notif-item.primary {
            border-left: 4px solid var(--saas-primary);
        }

        /* Notification Content */
        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .notif-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notif-title i {
            font-size: 1.1rem;
        }

        .notif-title h6 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--saas-gray-800);
            margin: 0;
        }

        .notif-time {
            font-size: 0.7rem;
            color: var(--saas-gray-400);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .notif-message {
            font-size: 0.8rem;
            color: var(--saas-gray-600);
            margin-bottom: 0;
            line-height: 1.5;
        }

        .notif-delete {
            color: var(--saas-white);
            background: var(--saas-danger);
            border: none;
            display: inline-flex;
            text-align: center;
            margin-top: 12px;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        /* Category Icon Colors */
        .notif-item.info .notif-title i {
            color: var(--saas-info);
        }

        .notif-item.success .notif-title i {
            color: var(--saas-accent);
        }

        .notif-item.warning .notif-title i {
            color: var(--saas-warning);
        }

        .notif-item.danger .notif-title i {
            color: var(--saas-danger);
        }

        .notif-item.primary .notif-title i {
            color: var(--saas-primary);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--saas-gray-300);
            margin-bottom: 1rem;
        }

        .empty-icon i {
            font-size: 4rem;
        }

        .empty-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--saas-gray-800);
            margin-bottom: 0.5rem;
        }

        .empty-text {
            font-size: 0.8rem;
            color: var(--saas-gray-600);
        }

        /* Mark as Read Indicator */
        .notif-item.unread {
            background: linear-gradient(90deg, var(--saas-gray-50) 0%, transparent 100%);
        }

        .notif-item.unread::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: var(--saas-primary);
            border-radius: 50%;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .notifikasi-container {
                padding: 1rem;
            }

            .notif-item {
                padding: 1rem;
            }

            .notif-header {
                flex-direction: column;
                gap: 0.25rem;
            }

            .notif-title h6 {
                font-size: 0.85rem;
            }

            .notif-message {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .notif-item.unread::after {
                right: 0.75rem;
                width: 6px;
                height: 6px;
            }
        }
    </style>

    <x-page-header>
        <x-slot:title>Notifikasi</x-slot:title>
        <x-slot:subtitle>Kelola Notifikasi</x-slot:subtitle>
    </x-page-header>

    <div class="notifikasi-container">

        <!-- Card Wrapper -->
        <div class="card-wrapper">
            <div class="card-saas">

                <!-- Notification List -->
                <div class="notification-list" id="notification-list">
                    @forelse($notifications as $notif)
                        <div class="notif-item {{ $notif->category ?? 'info' }}">
                            <div class="notif-header">
                                <div class="notif-title">
                                    @php
                                        $iconMap = [
                                            'info' => 'bx-info-circle',
                                            'success' => 'bx-check-circle',
                                            'warning' => 'bx-error-circle',
                                            'danger' => 'bx-x-circle',
                                            'primary' => 'bx-bell',
                                        ];
                                        $icon = $iconMap[$notif->category] ?? 'bx-bell';
                                    @endphp
                                    <i class='bx {{ $icon }}'></i>
                                    <h6 class="mb-0"><strong>{{ $notif->title }}</strong></h6>
                                </div>
                                <div class="notif-time">
                                    <i class='bx bx-time-five'></i>
                                    <span>{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p class="notif-message">{{ $notif->message }}</p>

                            <form action="{{ route('admin.notification.delete', $notif->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm notif-delete">
                                    <i class="bx bx-x"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class='bx bx-bell-off'></i>
                            </div>
                            <h5 class="empty-title">Tidak Ada Notifikasi</h5>
                            <p class="empty-text">Belum ada notifikasi untuk saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Optional: Auto scroll to bottom when new notifications arrive
            document.addEventListener('DOMContentLoaded', function () {
                const notifList = document.getElementById('notification-list');
                if (notifList && notifList.children.length > 0) {
                    // Scroll to top instead of bottom (most recent on top)
                    notifList.scrollTop = 0;
                }
            });
        </script>
    @endpush

@endsection