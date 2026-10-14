<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    
    <title>GAMEPAD • Ultimate Gaming Hardware & Gear</title>
    <meta name="keywords" content="gaming, controllers, video games, playstation, xbox, console, gaming gear">
    <meta name="description" content="Next-generation gaming hardware, high-performance pro controllers, and immersive gaming experiences.">
    <meta name="author" content="Gaming CMS">
    <link rel="icon" href="/assets/images/fevicon.png" type="image/gif" />

    <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <!-- Font Awesome Free Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Toastr Notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        /* ==========================================================================
           Modern Gaming Frontend Core Design System
           ========================================================================== */
        :root {
            --game-bg-main: #070a12;
            --game-bg-surface: #0e1424;
            --game-bg-card: rgba(17, 24, 43, 0.75);
            --game-border: rgba(255, 255, 255, 0.08);
            --game-border-glow: rgba(99, 102, 241, 0.45);
            --game-primary: #6366f1;
            --game-primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            --game-cyan: #06b6d4;
            --game-cyan-gradient: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
            --game-emerald: #10b981;
            --game-text-primary: #f8fafc;
            --game-text-secondary: #94a3b8;
            --game-text-dim: #64748b;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--game-bg-main);
            color: var(--game-text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.02em;
            color: #ffffff;
        }

        /* Ambient Glow Helpers */
        .text-gradient-cyan {
            background: linear-gradient(135deg, #38bdf8 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text-gradient-primary {
            background: var(--game-primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glassmorphism Card Utility */
        .game-card-glass {
            background: var(--game-bg-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--game-border);
            border-radius: 20px;
            box-shadow: 0 16px 36px -12px rgba(0, 0, 0, 0.65);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .game-card-glass:hover {
            border-color: var(--game-border-glow);
            transform: translateY(-6px);
            box-shadow: 0 24px 45px -12px rgba(99, 102, 241, 0.3);
        }

        /* Glowing Pill Badge */
        .game-pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            background: rgba(99, 102, 241, 0.15);
            color: #a5b4fc;
            border: 1px solid rgba(99, 102, 241, 0.35);
        }

        /* Action Buttons */
        .btn-game-primary {
            background: var(--game-primary-gradient);
            color: #ffffff !important;
            font-weight: 700;
            padding: 0.75rem 1.85rem;
            border-radius: 9999px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 25px -6px rgba(99, 102, 241, 0.65);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none !important;
            cursor: pointer;
        }

        .btn-game-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 14px 30px -4px rgba(99, 102, 241, 0.85);
            color: #ffffff !important;
        }

        .btn-game-outline {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff !important;
            font-weight: 600;
            padding: 0.75rem 1.65rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
            text-decoration: none !important;
        }

        .btn-game-outline:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
        }

        /* Keyframe Floating Animation for Hardware Preview */
        @keyframes gameHardwareFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-12px) rotate(1.2deg);
            }
        }

        .hardware-floating {
            animation: gameHardwareFloat 6s ease-in-out infinite;
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            .hardware-floating {
                animation: none !important;
            }
            html {
                scroll-behavior: auto;
            }
        }
    </style>
</head>
<body class="game-body">
