<style>
    /* ============================
                    PAGE HEADER 
            ===============================*/
    .page-header {
        position: relative;
        border-radius: 24px;
        padding: 32px 38px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 15px 35px -5px rgba(22, 33, 62, 0.2);
        overflow: visible;
    }

    .header-bg-decoration {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #010310 15%, #16213e 50%, #0f172a 100%);
        border-radius: 24px;
        overflow: hidden;
        z-index: 1;
    }

    .header-bg-decoration::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(177, 0, 0, .2) 0%, transparent 70%);
    }

    .header-bg-decoration::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: 20%;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .03);
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-title {
        font-weight: 800;
        font-size: 1.8rem;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
        color: #ffffff;
    }

    .header-subtitle {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 0;
    }

    .header-actions {
        position: relative;
        z-index: 10;
        /* Pastikan di atas dekorasi dan konten lainnya */
    }
</style>

<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <!-- Layer Dekorasi Background -->
    <div class="header-bg-decoration"></div>

    <!-- Konten Utama -->
    <div class="header-content">
        <h1 class="header-title">{{ $title }}</h1>
        <p class="header-subtitle">{{ $subtitle ?? ''}}</p>
    </div>

    <!-- Aksi / Filter -->
    <div class="header-actions">
        {{ $actions ?? '' }}
    </div>
</div>