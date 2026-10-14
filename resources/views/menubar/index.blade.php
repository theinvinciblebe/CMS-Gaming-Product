@extends('dashboard-layout.main')

@section('content')
<style>
    /* ==========================================================================
       Gaming CMS Dashboard Styles (Light & Dark Mode Support)
       ========================================================================== */
    .cms-dashboard-container {
        padding: 1.75rem 2rem 3rem 2rem;
        background: radial-gradient(circle at 15% 10%, rgba(99, 102, 241, 0.08) 0%, transparent 40%),
                    radial-gradient(circle at 85% 30%, rgba(6, 182, 212, 0.07) 0%, transparent 40%),
                    radial-gradient(circle at 50% 90%, rgba(139, 92, 246, 0.05) 0%, transparent 50%),
                    var(--cms-page-bg);
        min-height: calc(100vh - 57px);
        color: var(--cms-text-primary);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Keyframe Animations */
    @keyframes cmsFadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes cmsFloat {
        0%, 100% {
            transform: translateY(0) scale(1);
        }
        50% {
            transform: translateY(-8px) scale(1.02);
        }
    }

    @keyframes cmsPulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.55;
            transform: scale(0.92);
        }
    }

    @keyframes cmsGlowBar {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .animate-entry {
        animation: cmsFadeInUp 0.65s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .delay-1 { animation-delay: 0.08s; }
    .delay-2 { animation-delay: 0.16s; }
    .delay-3 { animation-delay: 0.24s; }
    .delay-4 { animation-delay: 0.32s; }

    /* Frosted Glass Cards */
    .cms-glass-card {
        background: var(--cms-card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--cms-border);
        border-radius: 18px;
        box-shadow: 0 10px 30px -8px rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
    }
    html.dark .cms-glass-card {
        box-shadow: 0 12px 32px -10px rgba(0, 0, 0, 0.55);
    }
    .cms-glass-card:hover {
        border-color: var(--cms-border-glow);
        transform: translateY(-3px);
        box-shadow: 0 16px 36px -10px rgba(99, 102, 241, 0.18);
    }

    /* Hero HUD Welcome Banner */
    .cms-hero-banner {
        position: relative;
        border-radius: 20px;
        padding: 2rem 2.25rem;
        background: var(--cms-hero-bg);
        border: 1px solid var(--cms-hero-border);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(24px);
        overflow: hidden;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }
    html.dark .cms-hero-banner {
        box-shadow: 0 20px 45px -15px rgba(0, 0, 0, 0.7);
    }
    .cms-hero-banner::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #06b6d4, #10b981, #d946ef, #6366f1);
        background-size: 300% 100%;
        animation: cmsGlowBar 8s ease infinite;
    }

    .cms-badge-pulse {
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
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .cms-pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #10b981;
        box-shadow: 0 0 10px #10b981;
        animation: cmsPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Metric HUD Cards */
    .cms-stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2.25rem;
    }

    .cms-stat-card {
        padding: 1.5rem 1.4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cms-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.3);
    }

    /* Action Buttons */
    .btn-cms-primary {
        background: var(--cms-primary-gradient);
        border: none;
        color: #ffffff !important;
        font-weight: 600;
        padding: 0.65rem 1.4rem;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.55);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
        cursor: pointer;
    }
    .btn-cms-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 26px -6px rgba(99, 102, 241, 0.8);
        color: #ffffff !important;
    }

    .btn-cms-outline {
        background: rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.12);
        color: var(--cms-text-secondary) !important;
        font-weight: 600;
        padding: 0.65rem 1.25rem;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
        text-decoration: none !important;
    }
    html.dark .btn-cms-outline {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.12);
        color: #e2e8f0 !important;
    }
    .btn-cms-outline:hover {
        background: rgba(99, 102, 241, 0.1);
        border-color: var(--cms-primary);
        color: var(--cms-primary) !important;
        transform: translateY(-2px);
    }
    html.dark .btn-cms-outline:hover {
        color: #ffffff !important;
    }

    /* Live Simulator Showcase Frame (Always rich gaming dark stage for maximum contrast) */
    .cms-simulator-frame {
        background: radial-gradient(circle at 80% 20%, rgba(99, 102, 241, 0.28) 0%, transparent 50%),
                    radial-gradient(circle at 20% 80%, rgba(6, 182, 212, 0.2) 0%, transparent 50%),
                    #0e1628;
        border: 1px solid rgba(99, 102, 241, 0.3);
        border-radius: 20px;
        padding: 2.25rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: 0 16px 40px -10px rgba(0, 0, 0, 0.4);
    }

    .cms-sim-item {
        display: none;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .cms-sim-item.active {
        display: flex;
        opacity: 1;
        animation: cmsFadeInUp 0.4s ease both;
    }

    .cms-hero-img-box {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .cms-hero-img-box::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.45) 0%, transparent 70%);
        border-radius: 50%;
        filter: blur(40px);
        z-index: 1;
    }

    .cms-hero-img-preview {
        position: relative;
        z-index: 2;
        max-height: 280px;
        max-width: 100%;
        object-fit: contain;
        filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.7));
        animation: cmsFloat 6s ease-in-out infinite;
    }

    /* Slider Selector Tabs */
    .cms-tab-pills {
        display: inline-flex;
        background: rgba(0, 0, 0, 0.06);
        border: 1px solid var(--cms-border);
        border-radius: 14px;
        padding: 4px;
        gap: 6px;
    }
    html.dark .cms-tab-pills {
        background: rgba(15, 23, 42, 0.8);
    }

    .cms-tab-btn {
        background: transparent;
        border: none;
        color: var(--cms-text-muted);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.55rem 1.15rem;
        border-radius: 10px;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }
    .cms-tab-btn:hover {
        color: var(--cms-text-primary);
        background: rgba(0, 0, 0, 0.05);
    }
    html.dark .cms-tab-btn:hover {
        background: rgba(255, 255, 255, 0.06);
    }
    .cms-tab-btn.active {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.45);
    }

    /* Slider Grid Cards */
    .cms-slider-card {
        border-radius: 18px;
        background: var(--cms-card-bg);
        border: 1px solid var(--cms-border);
        padding: 1.5rem;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .cms-slider-card:hover {
        transform: translateY(-6px);
        border-color: var(--cms-border-glow);
        box-shadow: 0 18px 40px -10px rgba(0, 0, 0, 0.2);
    }
    html.dark .cms-slider-card:hover {
        box-shadow: 0 18px 40px -10px rgba(0, 0, 0, 0.6);
    }

    .cms-slider-img-wrap {
        height: 160px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-radius: 14px;
        border: 1px solid var(--cms-border);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 1.25rem;
        position: relative;
    }
    html.dark .cms-slider-img-wrap {
        background: linear-gradient(135deg, rgba(30, 41, 59, 0.6), rgba(15, 23, 42, 0.9));
        border-color: rgba(255, 255, 255, 0.06);
    }
    .cms-slider-img-wrap img {
        max-height: 120px;
        max-width: 85%;
        object-fit: contain;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.3));
    }
    .cms-slider-card:hover .cms-slider-img-wrap img {
        transform: scale(1.1) translateY(-4px);
    }

    /* Nav Item Chips */
    .cms-nav-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--cms-nav-chip-bg);
        border: 1px solid var(--cms-nav-chip-border);
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--cms-nav-chip-text);
        transition: all 0.2s ease;
    }
    .cms-nav-chip:hover {
        background: rgba(99, 102, 241, 0.12);
        border-color: var(--cms-primary);
        color: var(--cms-primary);
        transform: translateY(-2px);
    }
    html.dark .cms-nav-chip:hover {
        color: #c7d2fe;
    }

    .cms-nav-num {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: rgba(99, 102, 241, 0.2);
        color: var(--cms-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
    }
    html.dark .cms-nav-num {
        background: rgba(99, 102, 241, 0.25);
        color: #a5b4fc;
    }

    /* Typography Helper Classes */
    .cms-title-text {
        color: var(--cms-text-primary);
        font-weight: 800;
    }
    .cms-muted-text {
        color: var(--cms-text-muted);
    }

    /* Reduced Motion Preference Compliance */
    @media (prefers-reduced-motion: reduce) {
        .animate-entry,
        .cms-hero-img-preview,
        .cms-pulse-dot {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<div class="cms-dashboard-container">
    @foreach($tbl as $item)

    <!-- =========================================================================
         1. HERO HUD WELCOME BANNER
         ========================================================================= -->
    <div class="cms-hero-banner animate-entry">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-7 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3 mb-2" style="gap: 12px;">
                    <span class="cms-badge-pulse">
                        <span class="cms-pulse-dot"></span> CMS Engine Live
                    </span>
                    <span class="cms-muted-text" style="font-size: 0.8rem; font-family: 'JetBrains Mono', monospace;">
                        <i class="fas fa-server mr-1"></i> PHP 8.3 • Laravel 11 • MySQL
                    </span>
                </div>
                <h1 style="font-size: 2.25rem; font-weight: 800; margin-bottom: 0.5rem;" class="cms-title-text">
                    Welcome back, <span style="background: linear-gradient(135deg, #6366f1, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ Auth::user()->name ?? 'Administrator' }}</span> 👋
                </h1>
                <p class="cms-muted-text" style="font-size: 1rem; max-width: 620px; line-height: 1.5; margin-bottom: 0;">
                    Manage your gaming hero sliders, top navbar navigation items, and brand assets in real-time with instant frontend synchronization.
                </p>
            </div>
            <div class="col-lg-5 col-md-5 text-md-right">
                <div class="d-flex flex-wrap justify-content-md-end gap-2" style="gap: 10px;">
                    <a href="/" target="_blank" class="btn-cms-outline">
                        <i class="fas fa-external-link-alt"></i> Live Site
                    </a>
                    <a href="{{ route('sales.index') }}" class="btn-cms-primary" style="background: linear-gradient(135deg, #10b981, #059669); border: none;">
                        <i class="fas fa-shopping-bag"></i> Sales History
                    </a>
                    <a href="{{ route('user.index') }}" class="btn-cms-outline">
                        <i class="fas fa-users-cog"></i> Users
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================================================================
         2. KPI HUD STAT METRICS
         ========================================================================= -->
    <div class="cms-stat-grid animate-entry delay-1">
        <!-- Stat 1: Active Sliders -->
        <div class="cms-glass-card cms-stat-card">
            <div>
                <span class="cms-muted-text" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; display: block; margin-bottom: 4px;">
                    Hero Carousel
                </span>
                <div class="cms-title-text" style="font-size: 1.85rem; line-height: 1.1;">
                    3 <span style="font-size: 0.95rem; font-weight: 600; color: #6366f1;">Slides Active</span>
                </div>
                <div style="font-size: 0.75rem; color: #10b981; margin-top: 6px; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                    <i class="fas fa-check-circle"></i> Broadcasted to Home
                </div>
            </div>
            <div class="cms-stat-icon" style="background: var(--cms-primary-gradient);">
                <i class="fas fa-images"></i>
            </div>
        </div>

        <!-- Stat 2: Navigation Links -->
        <div class="cms-glass-card cms-stat-card">
            <div>
                <span class="cms-muted-text" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; display: block; margin-bottom: 4px;">
                    Navbar Items
                </span>
                <div class="cms-title-text" style="font-size: 1.85rem; line-height: 1.1;">
                    8 <span style="font-size: 0.95rem; font-weight: 600; color: #0284c7;">Links Synced</span>
                </div>
                <div style="font-size: 0.75rem; color: #0284c7; margin-top: 6px; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                    <i class="fas fa-link"></i> Header Navigation
                </div>
            </div>
            <div class="cms-stat-icon" style="background: var(--cms-cyan-gradient);">
                <i class="fas fa-compass"></i>
            </div>
        </div>

        <!-- Stat 3: Registered Users -->
        <div class="cms-glass-card cms-stat-card">
            <div>
                <span class="cms-muted-text" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; display: block; margin-bottom: 4px;">
                    Total Accounts
                </span>
                <div class="cms-title-text" style="font-size: 1.85rem; line-height: 1.1;">
                    {{ \App\Models\User::count() }} <span style="font-size: 0.95rem; font-weight: 600; color: #059669;">Users</span>
                </div>
                <div style="font-size: 0.75rem; color: #059669; margin-top: 6px; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                    <i class="fas fa-shield-alt"></i> Auth Guard Active
                </div>
            </div>
            <div class="cms-stat-icon" style="background: var(--cms-emerald-gradient);">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>

        <!-- Stat 4: System Status -->
        <div class="cms-glass-card cms-stat-card">
            <div>
                <span class="cms-muted-text" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; display: block; margin-bottom: 4px;">
                    CMS Health
                </span>
                <div class="cms-title-text" style="font-size: 1.85rem; line-height: 1.1;">
                    100% <span style="font-size: 0.95rem; font-weight: 600; color: #d97706;">Online</span>
                </div>
                <div style="font-size: 0.75rem; color: #d97706; margin-top: 6px; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                    <i class="fas fa-bolt"></i> Low Latency Server
                </div>
            </div>
            <div class="cms-stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <i class="fas fa-tachometer-alt"></i>
            </div>
        </div>

        <!-- Stat 5: Storefront Sales & Orders -->
        <div class="cms-glass-card cms-stat-card">
            <div>
                <span class="cms-muted-text" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; display: block; margin-bottom: 4px;">
                    Store Revenue
                </span>
                <div class="cms-title-text" style="font-size: 1.85rem; line-height: 1.1;">
                    ${{ number_format(\App\Models\SaleOrder::where('order_status', '!=', 'Cancelled')->sum('total_amount'), 2) }}
                </div>
                <div style="font-size: 0.75rem; color: #10b981; margin-top: 6px; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                    <a href="{{ route('sales.index') }}" style="color: #10b981; text-decoration: none;">
                        <i class="fas fa-shopping-bag"></i> {{ \App\Models\SaleOrder::count() }} Orders Placed &rarr;
                    </a>
                </div>
            </div>
            <div class="cms-stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>

    <!-- =========================================================================
         3. HERO SLIDERS STUDIO SECTION
         ========================================================================= -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 animate-entry delay-2" style="gap: 12px;">
        <div>
            <h2 class="cms-title-text" style="font-size: 1.5rem; margin-bottom: 2px;">
                <i class="fas fa-photo-video mr-2" style="color: #6366f1;"></i> Hero Sliders Studio
            </h2>
            <p class="cms-muted-text" style="font-size: 0.875rem; margin-bottom: 0;">
                Live visual preview and editing studio for each carousel hero banner.
            </p>
        </div>

        <!-- Controls / View Switcher -->
        <div class="d-flex align-items-center gap-2" style="gap: 10px;">
            <div class="cms-tab-pills" id="sliderTabs">
                <button type="button" class="cms-tab-btn active" onclick="cmsSwitchSlide(1)" id="tabBtn1">
                    <i class="fas fa-play-circle"></i> Slide 01
                </button>
                <button type="button" class="cms-tab-btn" onclick="cmsSwitchSlide(2)" id="tabBtn2">
                    <i class="fas fa-play-circle"></i> Slide 02
                </button>
                <button type="button" class="cms-tab-btn" onclick="cmsSwitchSlide(3)" id="tabBtn3">
                    <i class="fas fa-play-circle"></i> Slide 03
                </button>
            </div>
        </div>
    </div>

    <!-- Interactive Live Simulator Frame -->
    <div class="cms-simulator-frame animate-entry delay-2">
        <!-- Slide 1 Simulation -->
        <div class="cms-sim-item active row align-items-center" id="simSlide1">
            <div class="col-lg-7 col-md-6 mb-4 mb-md-0">
                <div class="d-flex align-items-center gap-2 mb-3" style="gap: 10px;">
                    <span style="background: rgba(99, 102, 241, 0.2); color: #a5b4fc; border: 1px solid rgba(99, 102, 241, 0.4); padding: 4px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                        SLIDE #01 • PRIMARY HERO
                    </span>
                    <span style="color: #94a3b8; font-size: 0.8rem;">Current Home Banner</span>
                </div>
                <h1 style="font-size: 2.75rem; font-weight: 900; line-height: 1.1; margin-bottom: 0.2rem; color: #ffffff;">
                    {{ $item->whiteTitle }}
                </h1>
                <h2 style="font-size: 2.5rem; font-weight: 900; line-height: 1.1; color: #38bdf8; margin-bottom: 1rem; text-transform: uppercase;">
                    {{ $item->blueTitle }}
                </h2>
                <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; max-width: 580px; margin-bottom: 1.5rem; background: rgba(0,0,0,0.3); padding: 1rem 1.25rem; border-radius: 12px; border-left: 3px solid #6366f1;">
                    {{ $item->description }}
                </p>
                <div class="d-flex align-items-center gap-3 flex-wrap" style="gap: 14px;">
                    <span style="background: #e2e8f0; color: #0f172a; font-weight: 700; padding: 0.6rem 1.5rem; border-radius: 30px; font-size: 0.9rem; box-shadow: 0 4px 14px rgba(255,255,255,0.2);">
                        {{ $item->btnTitle ?: 'Button Action' }}
                    </span>
                    <a href="/menubar-editSlider/{{ $item->navid }}" class="btn-cms-primary">
                        <i class="fas fa-edit"></i> Edit Slide 01 Content
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="cms-hero-img-box">
                    <img src="/image/{{ $item->sliderImage }}" alt="Slide 1 Preview" class="cms-hero-img-preview" onerror="this.src='/assets/images/img-1.png'">
                </div>
            </div>
        </div>

        <!-- Slide 2 Simulation -->
        <div class="cms-sim-item row align-items-center" id="simSlide2">
            <div class="col-lg-7 col-md-6 mb-4 mb-md-0">
                <div class="d-flex align-items-center gap-2 mb-3" style="gap: 10px;">
                    <span style="background: rgba(6, 182, 212, 0.2); color: #67e8f9; border: 1px solid rgba(6, 182, 212, 0.4); padding: 4px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                        SLIDE #02 • SECONDARY FEATURE
                    </span>
                    <span style="color: #94a3b8; font-size: 0.8rem;">Carousel Step 2</span>
                </div>
                <h1 style="font-size: 2.75rem; font-weight: 900; line-height: 1.1; margin-bottom: 0.2rem; color: #ffffff;">
                    {{ $item->whiteTitle2 }}
                </h1>
                <h2 style="font-size: 2.5rem; font-weight: 900; line-height: 1.1; color: #38bdf8; margin-bottom: 1rem; text-transform: uppercase;">
                    {{ $item->blueTitle2 }}
                </h2>
                <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; max-width: 580px; margin-bottom: 1.5rem; background: rgba(0,0,0,0.3); padding: 1rem 1.25rem; border-radius: 12px; border-left: 3px solid #06b6d4;">
                    {{ $item->description2 }}
                </p>
                <div class="d-flex align-items-center gap-3 flex-wrap" style="gap: 14px;">
                    <span style="background: #e2e8f0; color: #0f172a; font-weight: 700; padding: 0.6rem 1.5rem; border-radius: 30px; font-size: 0.9rem; box-shadow: 0 4px 14px rgba(255,255,255,0.2);">
                        {{ $item->btnTitle2 ?: 'Button Action' }}
                    </span>
                    <a href="/menubar-editSlider2/{{ $item->navid }}" class="btn-cms-primary" style="background: var(--cms-cyan-gradient);">
                        <i class="fas fa-edit"></i> Edit Slide 02 Content
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="cms-hero-img-box">
                    <img src="/image/{{ $item->sliderImage2 }}" alt="Slide 2 Preview" class="cms-hero-img-preview" onerror="this.src='/assets/images/img-2.png'">
                </div>
            </div>
        </div>

        <!-- Slide 3 Simulation -->
        <div class="cms-sim-item row align-items-center" id="simSlide3">
            <div class="col-lg-7 col-md-6 mb-4 mb-md-0">
                <div class="d-flex align-items-center gap-2 mb-3" style="gap: 10px;">
                    <span style="background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid rgba(16, 185, 129, 0.4); padding: 4px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                        SLIDE #03 • EXCLUSIVE GEAR
                    </span>
                    <span style="color: #94a3b8; font-size: 0.8rem;">Carousel Step 3</span>
                </div>
                <h1 style="font-size: 2.75rem; font-weight: 900; line-height: 1.1; margin-bottom: 0.2rem; color: #ffffff;">
                    {{ $item->whiteTitle3 }}
                </h1>
                <h2 style="font-size: 2.5rem; font-weight: 900; line-height: 1.1; color: #38bdf8; margin-bottom: 1rem; text-transform: uppercase;">
                    {{ $item->blueTitle3 }}
                </h2>
                <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; max-width: 580px; margin-bottom: 1.5rem; background: rgba(0,0,0,0.3); padding: 1rem 1.25rem; border-radius: 12px; border-left: 3px solid #10b981;">
                    {{ $item->description3 }}
                </p>
                <div class="d-flex align-items-center gap-3 flex-wrap" style="gap: 14px;">
                    <span style="background: #e2e8f0; color: #0f172a; font-weight: 700; padding: 0.6rem 1.5rem; border-radius: 30px; font-size: 0.9rem; box-shadow: 0 4px 14px rgba(255,255,255,0.2);">
                        {{ $item->btnTitle3 ?: 'Button Action' }}
                    </span>
                    <a href="/menubar-editSlider3/{{ $item->navid }}" class="btn-cms-primary" style="background: var(--cms-emerald-gradient);">
                        <i class="fas fa-edit"></i> Edit Slide 03 Content
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="cms-hero-img-box">
                    <img src="/image/{{ $item->sliderImage3 }}" alt="Slide 3 Preview" class="cms-hero-img-preview" onerror="this.src='/assets/images/img-3.png'">
                </div>
            </div>
        </div>
    </div>

    <!-- All 3 Slides Grid Deck -->
    <div class="row mb-4 animate-entry delay-3">
        <!-- Card Slide 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="cms-slider-card">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span style="background: rgba(99, 102, 241, 0.15); color: #6366f1; border: 1px solid rgba(99, 102, 241, 0.3); padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; font-weight: 700;">
                            SLIDE 01
                        </span>
                        <span style="font-size: 0.8rem; color: #10b981; font-weight: 600;"><i class="fas fa-circle" style="font-size: 8px;"></i> Live</span>
                    </div>

                    <div class="cms-slider-img-wrap">
                        <img src="/image/{{ $item->sliderImage }}" alt="Slide 1 Thumbnail" onerror="this.src='/assets/images/img-1.png'">
                    </div>

                    <h4 class="cms-title-text" style="font-size: 1.25rem; margin-bottom: 2px;">
                        {{ $item->whiteTitle }}
                    </h4>
                    <h5 style="font-weight: 700; font-size: 1.05rem; color: #0284c7; margin-bottom: 10px;">
                        {{ $item->blueTitle }}
                    </h5>
                    <p class="cms-muted-text" style="font-size: 0.85rem; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 1.25rem;">
                        {{ $item->description }}
                    </p>
                </div>
                <div>
                    <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid var(--cms-border);">
                        <span style="font-size: 0.8rem; color: var(--cms-text-secondary); font-weight: 600;">
                            <i class="fas fa-mouse-pointer mr-1 text-primary"></i> "{{ $item->btnTitle }}"
                        </span>
                        <a href="/menubar-editSlider/{{ $item->navid }}" class="btn-cms-outline" style="padding: 0.45rem 1rem; font-size: 0.85rem;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Slide 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="cms-slider-card">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span style="background: rgba(6, 182, 212, 0.15); color: #0284c7; border: 1px solid rgba(6, 182, 212, 0.3); padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; font-weight: 700;">
                            SLIDE 02
                        </span>
                        <span style="font-size: 0.8rem; color: #10b981; font-weight: 600;"><i class="fas fa-circle" style="font-size: 8px;"></i> Live</span>
                    </div>

                    <div class="cms-slider-img-wrap">
                        <img src="/image/{{ $item->sliderImage2 }}" alt="Slide 2 Thumbnail" onerror="this.src='/assets/images/img-2.png'">
                    </div>

                    <h4 class="cms-title-text" style="font-size: 1.25rem; margin-bottom: 2px;">
                        {{ $item->whiteTitle2 }}
                    </h4>
                    <h5 style="font-weight: 700; font-size: 1.05rem; color: #0284c7; margin-bottom: 10px;">
                        {{ $item->blueTitle2 }}
                    </h5>
                    <p class="cms-muted-text" style="font-size: 0.85rem; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 1.25rem;">
                        {{ $item->description2 }}
                    </p>
                </div>
                <div>
                    <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid var(--cms-border);">
                        <span style="font-size: 0.8rem; color: var(--cms-text-secondary); font-weight: 600;">
                            <i class="fas fa-mouse-pointer mr-1 text-info"></i> "{{ $item->btnTitle2 }}"
                        </span>
                        <a href="/menubar-editSlider2/{{ $item->navid }}" class="btn-cms-outline" style="padding: 0.45rem 1rem; font-size: 0.85rem;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Slide 3 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="cms-slider-card">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span style="background: rgba(16, 185, 129, 0.15); color: #059669; border: 1px solid rgba(16, 185, 129, 0.3); padding: 4px 10px; border-radius: 8px; font-size: 0.75rem; font-weight: 700;">
                            SLIDE 03
                        </span>
                        <span style="font-size: 0.8rem; color: #10b981; font-weight: 600;"><i class="fas fa-circle" style="font-size: 8px;"></i> Live</span>
                    </div>

                    <div class="cms-slider-img-wrap">
                        <img src="/image/{{ $item->sliderImage3 }}" alt="Slide 3 Thumbnail" onerror="this.src='/assets/images/img-3.png'">
                    </div>

                    <h4 class="cms-title-text" style="font-size: 1.25rem; margin-bottom: 2px;">
                        {{ $item->whiteTitle3 }}
                    </h4>
                    <h5 style="font-weight: 700; font-size: 1.05rem; color: #0284c7; margin-bottom: 10px;">
                        {{ $item->blueTitle3 }}
                    </h5>
                    <p class="cms-muted-text" style="font-size: 0.85rem; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 1.25rem;">
                        {{ $item->description3 }}
                    </p>
                </div>
                <div>
                    <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid var(--cms-border);">
                        <span style="font-size: 0.8rem; color: var(--cms-text-secondary); font-weight: 600;">
                            <i class="fas fa-mouse-pointer mr-1 text-success"></i> "{{ $item->btnTitle3 }}"
                        </span>
                        <a href="/menubar-editSlider3/{{ $item->navid }}" class="btn-cms-outline" style="padding: 0.45rem 1rem; font-size: 0.85rem;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================================================================
         4. NAVBAR & BRAND IDENTITY CONTROL CENTER
         ========================================================================= -->
    <div class="cms-glass-card p-4 animate-entry delay-4 mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-3" style="border-bottom: 1px solid var(--cms-border); gap: 12px;">
            <div>
                <h3 class="cms-title-text" style="font-size: 1.35rem; margin-bottom: 2px;">
                    <i class="fas fa-bars mr-2" style="color: #0284c7;"></i> Navigation Bar & Brand Identity
                </h3>
                <p class="cms-muted-text" style="font-size: 0.875rem; margin-bottom: 0;">
                    Brand logo and header navigation items displayed across the entire public storefront.
                </p>
            </div>
            <div>
                <a href="/menubar-edit/{{ $item->navid }}" class="btn-cms-primary">
                    <i class="fas fa-sliders-h"></i> Edit Navbar & Brand Logo
                </a>
            </div>
        </div>

        <div class="row align-items-center">
            <!-- Brand Logo Box -->
            <div class="col-lg-3 col-md-4 mb-4 mb-md-0 text-center text-md-left">
                <span class="cms-muted-text" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; display: block; margin-bottom: 8px;">
                    Navbar Brand Logo
                </span>
                <div style="background: rgba(0, 0, 0, 0.04); border: 1px dashed var(--cms-border); border-radius: 14px; padding: 1.25rem; display: flex; align-items: center; justify-content: center; min-height: 100px;">
                    <img src="/image/{{ $item->logo }}" alt="Brand Logo" style="max-height: 65px; max-width: 100%; object-fit: contain; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.25));" onerror="this.src='/assets/images/logo.png'">
                </div>
                <div class="mt-2 text-center" style="font-size: 0.75rem; color: #10b981; font-weight: 600;">
                    <i class="fas fa-check-circle mr-1"></i> Live on Main Header
                </div>
            </div>

            <!-- Nav Items List -->
            <div class="col-lg-9 col-md-8">
                <span class="cms-muted-text" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; display: block; margin-bottom: 10px;">
                    Configured Menu Navigation Routes (8 Items)
                </span>
                <div class="d-flex flex-wrap gap-2" style="gap: 10px;">
                    <div class="cms-nav-chip">
                        <span class="cms-nav-num">1</span>
                        <span>{{ $item->nav1 ?: 'HOME' }}</span>
                    </div>
                    <div class="cms-nav-chip">
                        <span class="cms-nav-num">2</span>
                        <span>{{ $item->nav2 ?: 'ABOUT' }}</span>
                    </div>
                    <div class="cms-nav-chip">
                        <span class="cms-nav-num">3</span>
                        <span>{{ $item->nav3 ?: 'OUR PRODUCTS' }}</span>
                    </div>
                    <div class="cms-nav-chip">
                        <span class="cms-nav-num">4</span>
                        <span>{{ $item->nav4 ?: 'VIDEO GAMES' }}</span>
                    </div>
                    <div class="cms-nav-chip">
                        <span class="cms-nav-num">5</span>
                        <span>{{ $item->nav5 ?: 'REMOT CONTROL' }}</span>
                    </div>
                    <div class="cms-nav-chip">
                        <span class="cms-nav-num">6</span>
                        <span>{{ $item->nav6 ?: 'CONTACT US' }}</span>
                    </div>
                    <div class="cms-nav-chip" style="border-color: rgba(99, 102, 241, 0.4); background: rgba(99, 102, 241, 0.1);">
                        <span class="cms-nav-num" style="background: #6366f1; color: white;">7</span>
                        <span>{{ $item->nav7 ?: 'SIGN IN' }}</span>
                    </div>
                    <div class="cms-nav-chip" style="border-color: rgba(6, 182, 212, 0.4); background: rgba(6, 182, 212, 0.1);">
                        <span class="cms-nav-num" style="background: #06b6d4; color: white;">8</span>
                        <span>{{ $item->nav8 ?: 'REGISTER' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>

<script>
    /**
     * Interactive Hero Slider Live Simulator Switcher
     */
    function cmsSwitchSlide(slideIndex) {
        document.querySelectorAll('.cms-tab-btn').forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.getElementById('tabBtn' + slideIndex);
        if (activeBtn) activeBtn.classList.add('active');

        document.querySelectorAll('.cms-sim-item').forEach(item => item.classList.remove('active'));
        const activeSim = document.getElementById('simSlide' + slideIndex);
        if (activeSim) activeSim.classList.add('active');
    }
</script>
@endsection
