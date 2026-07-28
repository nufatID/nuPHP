<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Selamat Datang di nuPHP Framework v2.0'; ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #090d16;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.12);
            --glass-hover: rgba(255, 255, 255, 0.1);
            --accent-cyan: #00f2fe;
            --accent-blue: #4facfe;
            --accent-purple: #9f1ae2;
            --accent-pink: #ff007f;
            --text-primary: #ffffff;
            --text-secondary: #a0aec0;
            --text-muted: #718096;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Glowing Orbs Background */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.5;
            z-index: 0;
            animation: floatOrb 18s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--accent-purple), var(--accent-pink));
            top: -100px;
            left: -100px;
        }

        .orb-2 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-blue), var(--accent-cyan));
            bottom: -150px;
            right: -100px;
            animation-delay: -9s;
        }

        .orb-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #7928CA, #FF0080);
            top: 40%;
            left: 40%;
            transform: translate(-50%, -50%);
            animation-delay: -5s;
        }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, -40px) scale(1.1); }
            100% { transform: translate(-40px, 60px) scale(0.95); }
        }

        /* Container Layout */
        .app-layout {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Glass Utility Classes */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 16px 40px 0 rgba(0, 0, 0, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            border-color: rgba(255, 255, 255, 0.25);
            background: var(--glass-hover);
            transform: translateY(-4px);
            box-shadow: 0 24px 48px 0 rgba(0, 0, 0, 0.5), 0 0 20px rgba(79, 172, 254, 0.2);
        }

        .glass-pill {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            padding: 8px 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Header Navbar */
        .navbar {
            padding: 24px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(9, 13, 22, 0.6);
            backdrop-filter: blur(16px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-purple));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #fff;
            box-shadow: 0 8px 20px rgba(0, 242, 254, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Main Body Content */
        .content-body {
            flex: 1;
            padding: 48px 24px;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 32px;
            font-size: 14px;
            color: var(--text-muted);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(9, 13, 22, 0.4);
            backdrop-filter: blur(10px);
        }

        .footer a {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: var(--accent-cyan);
            text-decoration: underline;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Background Glow Orbs -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-orb orb-3"></div>

    <div class="app-layout">
        <!-- Navbar -->
        <header class="navbar">
            <a href="<?= getBaseUrl(); ?>" class="brand-logo">
                <div class="brand-icon">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <span>nu<span class="gradient-text">PHP</span></span>
            </a>

            <div class="glass-pill">
                <span class="status-dot" style="width: 8px; height: 8px; background: #00ff87; border-radius: 50%; display: inline-block; box-shadow: 0 0 10px #00ff87;"></span>
                <span>Framework v<?= NUPHP; ?></span>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="content-body">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; <?= date('Y'); ?> <strong>nuPHP Framework v<?= NUPHP; ?></strong>. Developed with ❤️ by <a href="https://webdev.nufat.id" target="_blank">Nufat.id</a> for aa Baim.</p>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>
