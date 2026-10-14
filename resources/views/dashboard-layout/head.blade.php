<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- FOUC Prevention Script (Immediate Theme Check) -->
    <script>
        (function() {
            try {
                const storedTheme = localStorage.getItem('cms_theme');
                const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = storedTheme ? storedTheme : (systemPrefersDark ? 'dark' : 'dark');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                }
            } catch(e) {}
        })();
    </script>

    <!-- Google Fonts: Plus Jakarta Sans & Outfit for modern gaming aesthetics -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <style>
        /* Smooth color transitions between modes */
        html, body, .content-wrapper, .main-header, .main-sidebar, .cms-glass-card, .cms-hero-banner {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* ---------------- Light Mode Defaults ---------------- */
        :root {
            --cms-primary: #6366f1;
            --cms-primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            --cms-cyan: #0284c7;
            --cms-cyan-gradient: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            --cms-emerald: #059669;
            --cms-emerald-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --cms-amber: #d97706;

            --cms-page-bg: #f8fafc;
            --cms-card-bg: rgba(255, 255, 255, 0.92);
            --cms-card-hover: rgba(255, 255, 255, 1);
            --cms-border: rgba(226, 232, 240, 0.9);
            --cms-border-glow: rgba(99, 102, 241, 0.25);
            --cms-text-primary: #0f172a;
            --cms-text-secondary: #334155;
            --cms-text-muted: #64748b;
            --cms-hero-bg: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            --cms-hero-border: rgba(226, 232, 240, 0.95);
            --cms-sim-bg: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            --cms-nav-chip-bg: rgba(241, 245, 249, 0.95);
            --cms-nav-chip-border: rgba(203, 213, 225, 0.8);
            --cms-nav-chip-text: #1e293b;
        }

        /* ---------------- Dark Mode (html.dark) ---------------- */
        html.dark {
            --cms-page-bg: #0b0f19;
            --cms-card-bg: rgba(15, 23, 42, 0.78);
            --cms-card-hover: rgba(24, 34, 60, 0.9);
            --cms-border: rgba(255, 255, 255, 0.08);
            --cms-border-glow: rgba(99, 102, 241, 0.4);
            --cms-text-primary: #f8fafc;
            --cms-text-secondary: #e2e8f0;
            --cms-text-muted: #94a3b8;
            --cms-hero-bg: linear-gradient(135deg, rgba(26, 33, 62, 0.85) 0%, rgba(15, 23, 42, 0.95) 100%);
            --cms-hero-border: rgba(255, 255, 255, 0.1);
            --cms-sim-bg: radial-gradient(circle at 80% 20%, rgba(99, 102, 241, 0.25) 0%, transparent 50%),
                          radial-gradient(circle at 20% 80%, rgba(6, 182, 212, 0.15) 0%, transparent 50%),
                          #0e1628;
            --cms-nav-chip-bg: rgba(30, 41, 59, 0.7);
            --cms-nav-chip-border: rgba(255, 255, 255, 0.08);
            --cms-nav-chip-text: #e2e8f0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
            background-color: var(--cms-page-bg);
            color: var(--cms-text-primary);
        }
        h1, h2, h3, h4, h5, h6, .brand-text {
            font-family: 'Outfit', sans-serif !important;
            letter-spacing: -0.02em;
        }

        /* Content wrapper */
        .content-wrapper {
            background: var(--cms-page-bg) !important;
            min-height: 100vh;
        }

        /* Top Navbar */
        .main-header.navbar {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.85) !important;
        }
        html.dark .main-header.navbar {
            background: rgba(13, 19, 31, 0.88) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
        }
        .main-header .nav-link {
            color: var(--cms-text-muted) !important;
            transition: color 0.2s ease, transform 0.2s ease;
        }
        .main-header .nav-link:hover {
            color: var(--cms-primary) !important;
            transform: translateY(-1px);
        }

        /* Main Sidebar */
        .main-sidebar {
            background: #ffffff !important;
            border-right: 1px solid rgba(226, 232, 240, 0.85) !important;
            box-shadow: 2px 0 16px rgba(0, 0, 0, 0.04) !important;
        }
        html.dark .main-sidebar {
            background: linear-gradient(180deg, #0d131f 0%, #080c14 100%) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.06) !important;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.4) !important;
        }

        .sidebar {
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .nav-sidebar .nav-item > .nav-link {
            border-radius: 10px;
            margin: 4px 8px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--cms-text-muted) !important;
            font-weight: 500;
        }
        .nav-sidebar .nav-item > .nav-link:hover {
            background: rgba(99, 102, 241, 0.08) !important;
            color: var(--cms-primary) !important;
            transform: translateX(4px);
        }
        html.dark .nav-sidebar .nav-item > .nav-link:hover {
            background: rgba(99, 102, 241, 0.15) !important;
            color: #c7d2fe !important;
        }
        .nav-sidebar .nav-item > .nav-link.active {
            background: linear-gradient(135deg, #6366f1, #4f46e5) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.4);
            font-weight: 600;
        }

        /* ==========================================================================
           TAILWIND-STYLE THEME TOGGLE BUTTON
           ========================================================================== */
        .tailwind-theme-toggle {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.08);
            padding: 4px 10px 4px 6px;
            cursor: pointer;
            outline: none !important;
            border-radius: 9999px;
            transition: all 0.25s ease;
        }
        html.dark .tailwind-theme-toggle {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
        }
        .tailwind-theme-toggle:hover {
            transform: scale(1.03);
            border-color: var(--cms-primary);
        }

        .tailwind-theme-toggle .toggle-track {
            position: relative;
            width: 52px;
            height: 28px;
            border-radius: 9999px;
            background-color: #e2e8f0;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            transition: background-color 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.06);
        }

        html.dark .tailwind-theme-toggle .toggle-track {
            background-color: #1e1b4b;
            border-color: #6366f1;
            box-shadow: 0 0 12px rgba(99, 102, 241, 0.35), inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .tailwind-theme-toggle .toggle-thumb {
            position: absolute;
            left: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), background-color 0.3s ease;
            transform: translateX(0);
        }

        html.dark .tailwind-theme-toggle .toggle-thumb {
            transform: translateX(24px);
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 0 8px rgba(139, 92, 246, 0.6);
        }

        .tailwind-theme-toggle .icon-sun {
            font-size: 10px;
            color: #f59e0b;
            display: block;
        }

        .tailwind-theme-toggle .icon-moon {
            font-size: 10px;
            color: #ffffff;
            display: none;
        }

        html.dark .tailwind-theme-toggle .icon-sun {
            display: none;
        }

        html.dark .tailwind-theme-toggle .icon-moon {
            display: block;
            transform: rotate(-15deg);
        }

        .tailwind-theme-toggle .toggle-label {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--cms-text-muted);
            user-select: none;
        }
        html.dark .tailwind-theme-toggle .toggle-label {
            color: #c7d2fe;
        }

        /* Global AdminLTE / Bootstrap Dark Mode Overrides */
        html.dark .card {
            background-color: var(--cms-card-bg) !important;
            border-color: var(--cms-border) !important;
            color: var(--cms-text-primary) !important;
        }
        html.dark .card-header, html.dark .card-footer {
            border-color: var(--cms-border) !important;
        }
        html.dark .list-group-item {
            background-color: transparent !important;
            border-color: var(--cms-border) !important;
            color: var(--cms-text-primary) !important;
        }
        html.dark .table {
            color: var(--cms-text-primary) !important;
            border-color: var(--cms-border) !important;
        }
        html.dark .table th, html.dark .table td {
            border-color: var(--cms-border) !important;
        }
        html.dark .modal-content {
            background-color: #111827 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #f8fafc !important;
        }
        html.dark .modal-header, html.dark .modal-footer {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        html.dark .form-control {
            background-color: rgba(15, 23, 42, 0.85) !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
        }
        html.dark .form-control:focus {
            background-color: rgba(15, 23, 42, 0.95) !important;
            color: #ffffff !important;
            border-color: var(--cms-primary) !important;
        }
    </style>
</head>
