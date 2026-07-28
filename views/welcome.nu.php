<?php $this->extend('layout/glass.nu.php'); ?>

@section('content')
<style>
    /* Hero Banner */
    .hero-section {
        text-align: center;
        padding: 60px 20px 40px;
        max-width: 900px;
        margin: 0 auto;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(0, 242, 254, 0.1);
        border: 1px solid rgba(0, 242, 254, 0.3);
        color: var(--accent-cyan);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 24px;
        box-shadow: 0 0 20px rgba(0, 242, 254, 0.15);
    }

    .hero-title {
        font-size: 54px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -1.5px;
        margin-bottom: 20px;
    }

    .hero-subtitle {
        font-size: 18px;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 36px;
        font-weight: 400;
    }

    .hero-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary-glass {
        background: linear-gradient(135deg, var(--accent-cyan), var(--accent-blue));
        color: #090d16;
        font-weight: 700;
        padding: 14px 32px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        box-shadow: 0 10px 25px rgba(0, 242, 254, 0.3);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
    }

    .btn-primary-glass:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 35px rgba(0, 242, 254, 0.5);
    }

    .btn-secondary-glass {
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        font-weight: 600;
        padding: 14px 32px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        transition: all 0.3s;
    }

    .btn-secondary-glass:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-3px);
    }

    /* System Status Bar */
    .system-status-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin: 48px 0;
    }

    .status-card {
        padding: 20px;
        text-align: center;
    }

    .status-label {
        font-size: 12px;
        text-transform: uppercase;
        color: var(--text-muted);
        letter-spacing: 1px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .status-val {
        font-size: 18px;
        font-weight: 700;
        color: #fff;
    }

    /* Feature Grid */
    .section-header {
        margin: 60px 0 32px;
        text-align: center;
    }

    .section-title {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }

    .feature-card {
        padding: 32px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .feature-icon-box {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 4px;
    }

    .icon-cyan {
        background: rgba(0, 242, 254, 0.15);
        color: var(--accent-cyan);
        border: 1px solid rgba(0, 242, 254, 0.3);
    }

    .icon-purple {
        background: rgba(159, 26, 226, 0.15);
        color: #d946ef;
        border: 1px solid rgba(159, 26, 226, 0.3);
    }

    .icon-pink {
        background: rgba(255, 0, 127, 0.15);
        color: var(--accent-pink);
        border: 1px solid rgba(255, 0, 127, 0.3);
    }

    .icon-blue {
        background: rgba(79, 172, 254, 0.15);
        color: var(--accent-blue);
        border: 1px solid rgba(79, 172, 254, 0.3);
    }

    .feature-title {
        font-size: 20px;
        font-weight: 700;
    }

    .feature-desc {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    /* CLI Terminal Section */
    .cli-box {
        margin-top: 60px;
        padding: 32px;
    }

    .cli-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .code-terminal {
        background: rgba(5, 7, 13, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 24px;
        font-family: 'Fira Code', monospace;
        font-size: 14px;
        color: #00ff87;
        line-height: 1.8;
        overflow-x: auto;
    }

    .code-comment {
        color: #6272a4;
    }

    .code-cmd {
        color: #f1fa8c;
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 38px; }
        .hero-subtitle { font-size: 16px; }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-badge">
        <i class="fa-solid fa-sparkles"></i> High Performance PHP Framework
    </div>
    
    <h1 class="hero-title">
        Bangun Aplikasi Web Cepat & Elegat dengan <span class="gradient-text">nuPHP v<?= NUPHP; ?></span>
    </h1>
    
    <p class="hero-subtitle">
        Framework PHP ringan berarsitektur modern dengan dukungan multi-ORM (Eloquent & Medoo), Blade/Nutemplete engine, dan perkakas CLI serba otomatis.
    </p>

    <div class="hero-actions">
        <a href="#cli-guide" class="btn-primary-glass">
            <i class="fa-solid fa-terminal"></i> Mulai Penggunaan CLI
        </a>
        <a href="https://github.com/nufatID/nuPHP" target="_blank" class="btn-secondary-glass">
            <i class="fa-brands fa-github"></i> Repository GitHub
        </a>
    </div>
</div>

<!-- System Live Status Cards -->
<div class="system-status-grid">
    <div class="glass-card status-card">
        <div class="status-label"><i class="fa-brands fa-php"></i> Versi PHP</div>
        <div class="status-val gradient-text"><?= PHP_VERSION; ?></div>
    </div>
    <div class="glass-card status-card">
        <div class="status-label"><i class="fa-solid fa-layer-group"></i> Framework</div>
        <div class="status-val" style="color: #00ff87;">nuPHP v<?= NUPHP; ?></div>
    </div>
    <div class="glass-card status-card">
        <div class="status-label"><i class="fa-solid fa-globe"></i> Environment</div>
        <div class="status-val" style="color: var(--accent-cyan);"><?= APP_ENV; ?></div>
    </div>
    <div class="glass-card status-card">
        <div class="status-label"><i class="fa-solid fa-database"></i> Database Driver</div>
        <div class="status-val" style="color: var(--accent-blue);"><?= strtoupper(DB_DRIVER); ?></div>
    </div>
</div>

<!-- Features Section -->
<div class="section-header">
    <h2 class="section-title">Kenapa Memilih <span class="gradient-text">nuPHP</span>?</h2>
    <p style="color: var(--text-secondary);">Fitur modern untuk produktivitas pengembangan tanpa hambatan.</p>
</div>

<div class="feature-grid">
    <div class="glass-card feature-card">
        <div class="feature-icon-box icon-cyan">
            <i class="fa-solid fa-bolt-lightning"></i>
        </div>
        <h3 class="feature-title">Ultra Fast Runtime</h3>
        <p class="feature-desc">Performa tinggi dengan jejak memori (*memory footprint*) yang sangat kecil sehingga mampu menangani request dengan sangat cepat.</p>
    </div>

    <div class="glass-card feature-card">
        <div class="feature-icon-box icon-purple">
            <i class="fa-solid fa-cubes"></i>
        </div>
        <h3 class="feature-title">Multi View Engine</h3>
        <p class="feature-desc">Dukungan ganda untuk **Nutemplete** (PHP Native + Tag Component) dan **Blade Engine** (Laravel Directive) yang fleksibel.</p>
    </div>

    <div class="glass-card feature-card">
        <div class="feature-icon-box icon-pink">
            <i class="fa-solid fa-database"></i>
        </div>
        <h3 class="feature-title">Multi-ORM Integrated</h3>
        <p class="feature-desc">Bebas memilih antara kecanggihan **Illuminate Eloquent ORM** atau kesederhanaan **Medoo Database Wrapper**.</p>
    </div>

    <div class="glass-card feature-card">
        <div class="feature-icon-box icon-blue">
            <i class="fa-solid fa-terminal"></i>
        </div>
        <h3 class="feature-title">Perkakas CLI Smart</h3>
        <p class="feature-desc">Otomatisasi pembuatan Controller, Model, REST API JSON, Migration, Seeder, dan Middleware hanya dengan perintah `php nu`.</p>
    </div>
</div>

<!-- Interactive CLI Commands Section -->
<div id="cli-guide" class="glass-card cli-box">
    <div class="cli-header">
        <div>
            <h3 style="font-size: 22px; font-weight: 700;"><i class="fa-solid fa-terminal"></i> Panduan Perintah CLI nuPHP</h3>
            <p style="font-size: 14px; color: var(--text-secondary); margin-top: 4px;">Jalankan perintah berikut di terminal Anda untuk mulai membuat komponen:</p>
        </div>
        <div class="glass-pill">
            <i class="fa-solid fa-code"></i> php nu
        </div>
    </div>

    <div class="code-terminal">
        <p class="code-comment"># 1. Jalankan Local Development Server (default port 8000)</p>
        <p class="code-cmd">php nu serve</p>

        <p class="code-comment" style="margin-top: 14px;"># 2. Buat Controller, Model & View sekaligus</p>
        <p class="code-cmd">php nu buat c User m v</p>

        <p class="code-comment" style="margin-top: 14px;"># 3. Buat REST API Controller (Lengkap dengan CRUD JSON response)</p>
        <p class="code-cmd">php nu buat api Product</p>

        <p class="code-comment" style="margin-top: 14px;"># 4. Generate App Key & Jalankan Migrasi Database</p>
        <p class="code-cmd">php nu key:generate</p>
        <p class="code-cmd">php nu migrate</p>
    </div>
</div>
@endsection
