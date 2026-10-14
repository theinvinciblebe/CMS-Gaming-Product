<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login &bull; Gaming CMS Live Demo</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.4);
            --cyan: #06b6d4;
            --emerald: #10b981;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            background: #090d16;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f8fafc;
            position: relative;
            overflow-x: hidden;
            margin: 0;
            padding: 1.5rem;
        }

        /* Ambient Cyber Gaming Glows */
        .ambient-glow-1 {
            position: fixed;
            top: -150px;
            right: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        .ambient-glow-2 {
            position: fixed;
            bottom: -150px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .login-card {
            background: rgba(18, 24, 38, 0.88);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 2.75rem 2.5rem;
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 10;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 20px;
            right: 20px;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #06b6d4, #10b981, #6366f1);
            background-size: 200% 100%;
            animation: glowLine 4s linear infinite;
        }

        @keyframes glowLine {
            0% { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }

        .brand-logo-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #ffffff;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.45);
            margin: 0 auto 1.25rem;
        }

        .live-demo-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 9999px;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }

        .pulse-beacon {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 10px #10b981;
            animation: pulseGlow 2s infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        .input-wrap {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .game-login-input {
            width: 100%;
            background: rgba(10, 14, 23, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 0.85rem 1rem 0.85rem 2.85rem;
            color: #ffffff;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            outline: none;
        }

        .game-login-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
            background: rgba(15, 23, 42, 0.9);
        }

        .game-login-input:focus + .input-icon {
            color: #818cf8;
        }

        .btn-game-submit {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            border-radius: 14px;
            padding: 0.9rem;
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.3px;
            width: 100%;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-game-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.5);
        }

        /* 1-Click Demo Profiles */
        .demo-accounts-panel {
            background: rgba(10, 14, 23, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 1.15rem;
            margin-top: 1.75rem;
        }

        .demo-chip {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .demo-chip:last-child {
            margin-bottom: 0;
        }
        .demo-chip:hover {
            background: rgba(99, 102, 241, 0.15);
            border-color: rgba(99, 102, 241, 0.4);
            transform: translateX(3px);
        }

        .demo-chip-name {
            font-weight: 700;
            font-size: 0.85rem;
            color: #f1f5f9;
        }
        .demo-chip-role {
            font-size: 0.72rem;
            color: #94a3b8;
        }
        .demo-chip-btn {
            font-size: 0.72rem;
            font-weight: 700;
            color: #38bdf8;
            background: rgba(56, 189, 248, 0.1);
            padding: 2px 8px;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <!-- Ambient Lighting Elements -->
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="login-card text-center">
        <!-- Logo -->
        <div class="brand-logo-icon">
            <i class="fas fa-gamepad"></i>
        </div>

        <!-- Live Demo Badge -->
        <div>
            <span class="live-demo-badge">
                <span class="pulse-beacon"></span> Live Demo Environment
            </span>
        </div>

        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.65rem; margin-bottom: 4px; color: #ffffff;">
            Gaming CMS Studio
        </h3>
        <p class="text-muted mb-4" style="font-size: 0.875rem;">
            Sign in to manage gaming sliders, orders, & catalog
        </p>

        <!-- Session Status Alert -->
        @if(session('status'))
            <div class="alert alert-danger text-left py-2 px-3 mb-3" style="border-radius: 12px; font-size: 0.85rem; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5;">
                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('do_login') }}" id="loginForm">
            @csrf
            
            <div class="input-wrap text-left">
                <input
                    name="name"
                    id="name"
                    type="text"
                    value="admin"
                    placeholder="Username or Email"
                    required
                    autofocus
                    class="game-login-input"
                >
                <i class="fas fa-user input-icon"></i>
            </div>

            <div class="input-wrap text-left">
                <input
                    id="password"
                    name="password"
                    type="password"
                    value="123"
                    placeholder="Password"
                    required
                    class="game-login-input"
                >
                <i class="fas fa-lock input-icon"></i>
            </div>

            <button type="submit" class="btn-game-submit">
                <span>Access Dashboard</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <!-- 1-Click Quick Demo Login Shortcuts -->
        <div class="demo-accounts-panel text-left">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px; font-weight: 700; color: #94a3b8;">
                    <i class="fas fa-bolt text-warning mr-1"></i> 1-Click Quick Demo Login
                </span>
                <span class="text-muted" style="font-size: 0.72rem;">Pass: <code>123</code></span>
            </div>

            <!-- Profile 1: Admin -->
            <div class="demo-chip" onclick="quickFill('admin', '123')">
                <div>
                    <div class="demo-chip-name"><i class="fas fa-shield-alt text-primary mr-1"></i> admin</div>
                    <div class="demo-chip-role">Root Administrator</div>
                </div>
                <span class="demo-chip-btn">Auto-Fill &rarr;</span>
            </div>

            <!-- Profile 2: Sarah Chen -->
            <div class="demo-chip" onclick="quickFill('sarah.chen', '123')">
                <div>
                    <div class="demo-chip-name"><i class="fas fa-edit text-info mr-1"></i> sarah.chen</div>
                    <div class="demo-chip-role">Content & Sliders Lead</div>
                </div>
                <span class="demo-chip-btn">Auto-Fill &rarr;</span>
            </div>

            <!-- Profile 3: Alex Rivera -->
            <div class="demo-chip" onclick="quickFill('alex.rivera', '123')">
                <div>
                    <div class="demo-chip-name"><i class="fas fa-shopping-bag text-success mr-1"></i> alex.rivera</div>
                    <div class="demo-chip-role">Store & Sales Moderator</div>
                </div>
                <span class="demo-chip-btn">Auto-Fill &rarr;</span>
            </div>
        </div>

        <!-- Back to Storefront Link -->
        <div class="mt-4 pt-2">
            <a href="/" style="color: #94a3b8; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fas fa-arrow-left"></i> Return to Live Gaming Storefront
            </a>
        </div>
    </div>

    <script>
        function quickFill(user, pw) {
            document.getElementById('name').value = user;
            document.getElementById('password').value = pw;
            
            // Visual feedback
            const submitBtn = document.querySelector('.btn-game-submit');
            submitBtn.style.transform = 'scale(0.98)';
            setTimeout(() => {
                submitBtn.style.transform = 'none';
                document.getElementById('loginForm').submit();
            }, 180);
        }
    </script>
</body>
</html>
