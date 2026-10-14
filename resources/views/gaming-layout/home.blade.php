@include("gaming-layout.header")

<style>
    /* ==========================================================================
       Home Page Specific Styles
       ========================================================================== */
    /* Header / Navbar */
    .game-navbar {
        background: rgba(7, 10, 18, 0.88);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0.9rem 2rem;
        position: sticky;
        top: 0;
        z-index: 1050;
        transition: all 0.3s ease;
    }

    .game-nav-brand img {
        max-height: 48px;
        filter: drop-shadow(0 4px 12px rgba(99, 102, 241, 0.4));
        transition: transform 0.3s ease;
    }
    .game-nav-brand img:hover {
        transform: scale(1.05);
    }

    .game-nav-link {
        color: #cbd5e1 !important;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 0.5rem 1rem !important;
        position: relative;
        transition: color 0.25s ease;
    }
    .game-nav-link:hover {
        color: #38bdf8 !important;
    }
    .game-nav-link::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--game-primary-gradient);
        transition: all 0.25s ease;
        transform: translateX(-50%);
    }
    .game-nav-link:hover::after {
        width: 65%;
    }

    /* Cart Header Button */
    .btn-game-cart {
        position: relative;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        cursor: pointer;
        transition: all 0.25s ease;
        outline: none !important;
    }
    .btn-game-cart:hover {
        background: rgba(99, 102, 241, 0.2);
        border-color: #6366f1;
        color: #38bdf8;
        transform: scale(1.06);
    }
    .cart-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: linear-gradient(135deg, #ef4444, #f43f5e);
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: 800;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 10px rgba(239, 68, 68, 0.8);
        transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .cart-badge.bump {
        transform: scale(1.35);
    }

    /* Floating Cart Button on mobile / scroll */
    .floating-cart-btn {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1040;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: var(--game-primary-gradient);
        color: #ffffff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        box-shadow: 0 10px 25px -4px rgba(99, 102, 241, 0.7);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .floating-cart-btn:hover {
        transform: translateY(-4px) scale(1.08);
        box-shadow: 0 16px 35px -4px rgba(99, 102, 241, 0.9);
        color: #ffffff;
    }

    /* Hero Carousel */
    .hero-carousel-section {
        position: relative;
        padding: 5rem 0 6rem 0;
        background: radial-gradient(circle at 75% 25%, rgba(99, 102, 241, 0.2) 0%, transparent 50%),
                    radial-gradient(circle at 20% 70%, rgba(6, 182, 212, 0.15) 0%, transparent 45%),
                    #070a12;
        overflow: hidden;
    }

    .hero-carousel-section::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: linear-gradient(to top, #070a12, transparent);
        pointer-events: none;
    }

    .hero-slide-item {
        min-height: 520px;
        display: flex;
        align-items: center;
    }

    .hero-title-white {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1.08;
        color: #ffffff;
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .hero-title-blue {
        font-size: 3.25rem;
        font-weight: 900;
        line-height: 1.08;
        margin-bottom: 1.25rem;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .hero-description {
        color: #cbd5e1;
        font-size: 1.05rem;
        line-height: 1.7;
        max-width: 540px;
        margin-bottom: 2rem;
    }

    .hero-hardware-frame {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 420px;
    }

    .hero-hardware-aura {
        position: absolute;
        width: 360px;
        height: 360px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.4) 0%, rgba(6, 182, 212, 0.2) 50%, transparent 70%);
        border-radius: 50%;
        filter: blur(50px);
        z-index: 1;
    }

    .hero-hardware-img {
        position: relative;
        z-index: 2;
        max-height: 380px;
        max-width: 100%;
        object-fit: contain;
        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.85));
    }

    .hero-control-btn {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        transition: all 0.25s ease;
        text-decoration: none !important;
    }
    .hero-control-btn:hover {
        background: var(--game-primary-gradient);
        border-color: transparent;
        color: #ffffff;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.6);
    }
    .hero-control-prev { left: 1rem; }
    .hero-control-next { right: 1rem; }

    /* Section Styling */
    .game-section {
        padding: 6rem 0;
        position: relative;
    }

    .game-section-header {
        text-align: center;
        max-width: 680px;
        margin: 0 auto 3.5rem auto;
    }
    .game-section-header h2 {
        font-size: 2.75rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
    }
    .game-section-header p {
        color: var(--game-text-secondary);
        font-size: 1rem;
    }

    /* Product Cards */
    .product-card {
        background: var(--game-bg-card);
        border: 1px solid var(--game-border);
        border-radius: 20px;
        padding: 1.75rem;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-8px);
        border-color: var(--game-border-glow);
        box-shadow: 0 20px 45px -12px rgba(99, 102, 241, 0.35);
    }

    .product-img-wrap {
        height: 200px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, rgba(15, 23, 42, 0.6) 80%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        overflow: hidden;
        position: relative;
    }
    .product-img-wrap img {
        max-height: 160px;
        max-width: 85%;
        object-fit: contain;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.6));
    }
    .product-card:hover .product-img-wrap img {
        transform: scale(1.12) rotate(-2deg);
    }

    /* Contact Form Elements */
    .game-input {
        width: 100%;
        padding: 0.85rem 1.25rem;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(14, 20, 36, 0.8);
        color: #ffffff;
        font-size: 0.95rem;
        outline: none !important;
        transition: all 0.25s ease;
    }
    .game-input:focus {
        border-color: var(--game-primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        background: rgba(18, 26, 48, 0.95);
    }
    .game-input::placeholder {
        color: var(--game-text-dim);
    }

    /* ==========================================================================
       SIDE-OVER CART DRAWER STYLES
       ========================================================================== */
    .cart-drawer-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        z-index: 1100;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.35s ease, visibility 0.35s ease;
    }
    .cart-drawer-backdrop.active {
        opacity: 1;
        visibility: visible;
    }

    .cart-drawer {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        width: 440px;
        max-width: 90vw;
        background: #0b0f19;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: -15px 0 45px rgba(0, 0, 0, 0.8);
        z-index: 1110;
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .cart-drawer.active {
        transform: translateX(0);
    }

    .cart-drawer-header {
        padding: 1.5rem 1.75rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cart-drawer-body {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem 1.75rem;
    }

    .cart-drawer-footer {
        padding: 1.5rem 1.75rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(14, 20, 36, 0.5);
    }

    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        transition: background 0.2s ease;
    }
    .cart-item-img {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .cart-item-img img {
        max-width: 85%;
        max-height: 85%;
        object-fit: contain;
    }

    .cart-qty-control {
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        background: rgba(0, 0, 0, 0.3);
    }
    .cart-qty-btn {
        background: transparent;
        border: none;
        color: #cbd5e1;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .cart-qty-btn:hover {
        color: #38bdf8;
    }
    .cart-qty-val {
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0 6px;
        color: #ffffff;
    }

    /* Checkout Modal Styles */
    .checkout-step-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-bottom: 1.5rem;
    }
    .step-dot {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.08);
        color: #94a3b8;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .step-dot.active {
        background: linear-gradient(135deg, #6366f1, #38bdf8);
        color: #ffffff;
        box-shadow: 0 0 14px rgba(99, 102, 241, 0.5);
    }
    .step-line {
        height: 2px;
        width: 40px;
        background: rgba(255, 255, 255, 0.15);
    }
    .step-line.active {
        background: #6366f1;
    }

    .payment-tab-btn {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        color: #cbd5e1;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
        flex: 1;
    }
    .payment-tab-btn:hover {
        border-color: rgba(99, 102, 241, 0.4);
        color: #ffffff;
    }
    .payment-tab-btn.active {
        background: rgba(99, 102, 241, 0.15);
        border-color: #6366f1;
        color: #38bdf8;
    }

    @media (max-width: 991px) {
        .hero-title-white { font-size: 2.5rem; }
        .hero-title-blue { font-size: 2.25rem; }
        .hero-hardware-frame { min-height: 320px; }
        .hero-hardware-img { max-height: 280px; }
    }
</style>

@foreach($tbl as $item)

<!-- =========================================================================
     1. STICKY MODERN GAMING NAVBAR
     ========================================================================= -->
<nav class="navbar navbar-expand-lg game-navbar">
    <div class="container-fluid px-lg-5">
        <!-- Logo -->
        <a class="navbar-brand game-nav-brand" href="#home">
            <img src="/image/{{ $item->logo }}" alt="Gaming Logo" onerror="this.src='/assets/images/logo.png'">
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#gamingNavContent" aria-controls="gamingNavContent" aria-expanded="false" aria-label="Toggle navigation" style="border: 1px solid rgba(255,255,255,0.2); padding: 6px 12px; border-radius: 8px;">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="gamingNavContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link game-nav-link" href="#home">{{ $item->nav1 ?: 'HOME' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link game-nav-link" href="#about">{{ $item->nav2 ?: 'ABOUT' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link game-nav-link" href="#products">{{ $item->nav3 ?: 'OUR PRODUCTS' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link game-nav-link" href="#experience">{{ $item->nav4 ?: 'VIDEO GAMES' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link game-nav-link" href="#technology">{{ $item->nav5 ?: 'REMOT CONTROL' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link game-nav-link" href="#contact">{{ $item->nav6 ?: 'CONTACT US' }}</a>
                </li>
            </ul>

            <!-- Right Action Bar with Live Cart -->
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0" style="gap: 14px;">
                <!-- Live Cart Trigger Button -->
                <button type="button" class="btn-game-cart" onclick="openCartDrawer()" title="View Gaming Cart">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-badge" id="cartBadge">0</span>
                </button>

                @if(Auth::check())
                    <a href="/dashboard" class="btn-game-outline" style="padding: 0.5rem 1.25rem; font-size: 0.85rem;">
                        <i class="fas fa-tachometer-alt mr-1 text-primary"></i> Dashboard
                    </a>
                @endif

                <a href="/login" class="btn-game-primary" style="padding: 0.55rem 1.5rem; font-size: 0.875rem;">
                    <i class="fas fa-sign-in-alt"></i> {{ $item->nav7 ?: 'SIGN IN' }}
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Floating Cart Button (Available anywhere during scroll) -->
<button type="button" class="floating-cart-btn" onclick="openCartDrawer()" title="Quick Cart">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-badge" id="floatingCartBadge" style="top: 2px; right: 2px;">0</span>
</button>

<!-- =========================================================================
     2. NEXT-GEN HERO BANNER CAROUSEL
     ========================================================================= -->
<section id="home" class="hero-carousel-section">
    <div class="container">
        <div id="gameHeroSlider" class="carousel slide" data-ride="carousel" data-interval="6000">
            <!-- Carousel Inner -->
            <div class="carousel-inner">
                <!-- Slide 1 (Prime Hero) -->
                <div class="carousel-item active">
                    <div class="row align-items-center hero-slide-item">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <span class="game-pill-badge mb-3">
                                <i class="fas fa-bolt text-warning"></i> Next-Gen Flagship Gear
                            </span>
                            <h1 class="hero-title-white">{{ $item->whiteTitle }}</h1>
                            <h2 class="hero-title-blue text-gradient-cyan">{{ $item->blueTitle }}</h2>
                            <p class="hero-description">{{ $item->description }}</p>
                            <div class="d-flex align-items-center gap-3 flex-wrap" style="gap: 14px;">
                                <button type="button" class="btn-game-primary" onclick="buyNow({id: 2, name: 'Portal Remote Controller', price: 199, image: '/image/{{ $item->sliderImage }}', category: 'Remote Player'})">
                                    <i class="fas fa-shopping-bag"></i> {{ $item->btnTitle ?: 'Buy Now' }}
                                </button>
                                <button type="button" class="btn-game-outline" onclick="addToCart({id: 2, name: 'Portal Remote Controller', price: 199, image: '/image/{{ $item->sliderImage }}', category: 'Remote Player'})">
                                    <i class="fas fa-cart-plus"></i> Add To Cart
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-hardware-frame">
                                <div class="hero-hardware-aura"></div>
                                <img src="/image/{{ $item->sliderImage }}" alt="Slide 1" class="hero-hardware-img hardware-floating" onerror="this.src='/assets/images/img-1.png'">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 (Secondary Hero) -->
                <div class="carousel-item">
                    <div class="row align-items-center hero-slide-item">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <span class="game-pill-badge mb-3" style="background: rgba(6, 182, 212, 0.15); color: #67e8f9; border-color: rgba(6, 182, 212, 0.35);">
                                <i class="fas fa-gamepad text-info"></i> Pro-Tier Performance
                            </span>
                            <h1 class="hero-title-white">{{ $item->whiteTitle2 }}</h1>
                            <h2 class="hero-title-blue text-gradient-cyan">{{ $item->blueTitle2 }}</h2>
                            <p class="hero-description">{{ $item->description2 }}</p>
                            <div class="d-flex align-items-center gap-3 flex-wrap" style="gap: 14px;">
                                <button type="button" class="btn-game-primary" style="background: var(--game-cyan-gradient);" onclick="buyNow({id: 3, name: 'SCUF Instinct Pro Pad', price: 179, image: '/image/{{ $item->sliderImage2 }}', category: 'Controllers'})">
                                    <i class="fas fa-shopping-cart"></i> {{ $item->btnTitle2 ?: 'Buy Now' }}
                                </button>
                                <button type="button" class="btn-game-outline" onclick="addToCart({id: 3, name: 'SCUF Instinct Pro Pad', price: 179, image: '/image/{{ $item->sliderImage2 }}', category: 'Controllers'})">
                                    <i class="fas fa-cart-plus"></i> Add To Cart
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-hardware-frame">
                                <div class="hero-hardware-aura" style="background: radial-gradient(circle, rgba(6, 182, 212, 0.45) 0%, transparent 70%);"></div>
                                <img src="/image/{{ $item->sliderImage2 }}" alt="Slide 2" class="hero-hardware-img hardware-floating" onerror="this.src='/assets/images/img-2.png'">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 (Exclusive Hero) -->
                <div class="carousel-item">
                    <div class="row align-items-center hero-slide-item">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <span class="game-pill-badge mb-3" style="background: rgba(16, 185, 129, 0.15); color: #6ee7b7; border-color: rgba(16, 185, 129, 0.35);">
                                <i class="fas fa-headphones text-success"></i> 360° Spatial Audio
                            </span>
                            <h1 class="hero-title-white">{{ $item->whiteTitle3 }}</h1>
                            <h2 class="hero-title-blue text-gradient-cyan">{{ $item->blueTitle3 }}</h2>
                            <p class="hero-description">{{ $item->description3 }}</p>
                            <div class="d-flex align-items-center gap-3 flex-wrap" style="gap: 14px;">
                                <button type="button" class="btn-game-primary" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);" onclick="buyNow({id: 4, name: 'Sony Pulse Pro Headset', price: 149, image: '/image/{{ $item->sliderImage3 }}', category: 'Audio'})">
                                    <i class="fas fa-fire"></i> {{ $item->btnTitle3 ?: 'Buy Now' }}
                                </button>
                                <button type="button" class="btn-game-outline" onclick="addToCart({id: 4, name: 'Sony Pulse Pro Headset', price: 149, image: '/image/{{ $item->sliderImage3 }}', category: 'Audio'})">
                                    <i class="fas fa-cart-plus"></i> Add To Cart
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-hardware-frame">
                                <div class="hero-hardware-aura" style="background: radial-gradient(circle, rgba(16, 185, 129, 0.4) 0%, transparent 70%);"></div>
                                <img src="/image/{{ $item->sliderImage3 }}" alt="Slide 3" class="hero-hardware-img hardware-floating" onerror="this.src='/assets/images/img-3.png'">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="hero-control-btn hero-control-prev" href="#gameHeroSlider" role="button" data-slide="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
            <a class="hero-control-btn hero-control-next" href="#gameHeroSlider" role="button" data-slide="next">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. ABOUT SECTION
     ========================================================================= -->
<section id="about" class="game-section" style="background: #090e1a; border-top: 1px solid rgba(255,255,255,0.06);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center">
                <div style="position: relative; display: inline-block;">
                    <div style="position: absolute; width: 320px; height: 320px; background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 50%; filter: blur(40px);"></div>
                    <img src="/assets/images/img-2.png" alt="About Gaming" style="max-height: 380px; max-width: 100%; position: relative; z-index: 2; filter: drop-shadow(0 15px 30px rgba(0,0,0,0.7));" class="hardware-floating">
                    <div class="game-card-glass p-3" style="position: absolute; bottom: 10px; right: 0; z-index: 3; text-align: left; max-width: 200px;">
                        <div style="font-size: 1.25rem; font-weight: 800; color: #38bdf8;">★ 4.9 / 5.0</div>
                        <div style="font-size: 0.78rem; color: #94a3b8;">Over 100,000+ Verified Player Reviews</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="game-pill-badge mb-3">
                    <i class="fas fa-crosshairs"></i> Engineered For Champions
                </span>
                <h2 style="font-size: 2.75rem; font-weight: 800; line-height: 1.15; margin-bottom: 1.25rem;">
                    Precision Engineering Meets <span class="text-gradient-cyan">Competitive Dominance</span>
                </h2>
                <p style="color: #94a3b8; font-size: 1.05rem; line-height: 1.7; margin-bottom: 2rem;">
                    Whether you are competing in global esports tournaments or exploring expansive open worlds, our gaming products deliver ultra-low latency, tactile mechanical switches, and adaptive ergonomic contours.
                </p>

                <div class="row mb-4">
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-start gap-3" style="gap: 12px;">
                            <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(99, 102, 241, 0.2); color: #818cf8; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div>
                                <h5 style="font-weight: 700; margin-bottom: 2px;">Sub-1ms Latency</h5>
                                <p style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 0;">Instant wireless response with no delay.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-start gap-3" style="gap: 12px;">
                            <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(6, 182, 212, 0.2); color: #38bdf8; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-microchip"></i>
                            </div>
                            <div>
                                <h5 style="font-weight: 700; margin-bottom: 2px;">Adaptive Haptics</h5>
                                <p style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 0;">Dynamic resistance in trigger motors.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#products" class="btn-game-primary">
                    <i class="fas fa-gamepad"></i> Explore Collection
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. FEATURED PRODUCTS SECTION (WITH REAL BUY & ADD-TO-CART ACTIONS)
     ========================================================================= -->
<section id="products" class="game-section" style="background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.12) 0%, transparent 60%), #070a12;">
    <div class="container">
        <div class="game-section-header">
            <span class="game-pill-badge mb-3">
                <i class="fas fa-cubes"></i> Elite Gear Showcase
            </span>
            <h2>OUR <span class="text-gradient-cyan">PRODUCTS</span></h2>
            <p>Explore state-of-the-art gaming gear designed for unparalleled precision and immersive gameplay.</p>
        </div>

        <div class="row">
            <!-- Product 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="product-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span style="background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.4); padding: 2px 8px; border-radius: 6px; font-size: 0.7rem; font-weight: 700;">
                                -25% OFF
                            </span>
                            <span style="font-size: 0.8rem; color: #f59e0b;"><i class="fas fa-star"></i> 4.9 (2.4k)</span>
                        </div>
                        <div class="product-img-wrap">
                            <img src="/assets/images/img-3.png" alt="Console Gear">
                        </div>
                        <h4 style="font-size: 1.15rem; font-weight: 800; margin-bottom: 4px;">PS5 Midnight Console</h4>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5; margin-bottom: 1rem;">
                            Ultra-fast SSD with ray tracing & 4K gaming output.
                        </p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid rgba(255,255,255,0.08); gap: 8px;">
                            <div>
                                <span style="font-size: 0.75rem; color: #64748b; text-decoration: line-through;">$499</span>
                                <div style="font-size: 1.25rem; font-weight: 900; color: #38bdf8;">$399</div>
                            </div>
                            <div class="d-flex gap-2" style="gap: 6px;">
                                <button type="button" class="btn-game-outline" style="padding: 0.45rem 0.8rem; font-size: 0.78rem;" title="Add to Cart" onclick="addToCart({id: 1, name: 'PS5 Midnight Console', price: 399, image: '/assets/images/img-3.png', category: 'Consoles'})">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                <button type="button" class="btn-game-primary" style="padding: 0.45rem 1rem; font-size: 0.78rem;" onclick="buyNow({id: 1, name: 'PS5 Midnight Console', price: 399, image: '/assets/images/img-3.png', category: 'Consoles'})">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="product-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span style="background: rgba(99, 102, 241, 0.2); color: #a5b4fc; border: 1px solid rgba(99, 102, 241, 0.4); padding: 2px 8px; border-radius: 6px; font-size: 0.7rem; font-weight: 700;">
                                BESTSELLER
                            </span>
                            <span style="font-size: 0.8rem; color: #f59e0b;"><i class="fas fa-star"></i> 5.0 (3.1k)</span>
                        </div>
                        <div class="product-img-wrap">
                            <img src="/image/{{ $item->sliderImage }}" alt="Remote Controller" onerror="this.src='/assets/images/img-1.png'">
                        </div>
                        <h4 style="font-size: 1.15rem; font-weight: 800; margin-bottom: 4px;">Portal Remote Controller</h4>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5; margin-bottom: 1rem;">
                            Handheld wireless remote streamer with full haptics.
                        </p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid rgba(255,255,255,0.08); gap: 8px;">
                            <div>
                                <span style="font-size: 0.75rem; color: #64748b; text-decoration: line-through;">$249</span>
                                <div style="font-size: 1.25rem; font-weight: 900; color: #38bdf8;">$199</div>
                            </div>
                            <div class="d-flex gap-2" style="gap: 6px;">
                                <button type="button" class="btn-game-outline" style="padding: 0.45rem 0.8rem; font-size: 0.78rem;" title="Add to Cart" onclick="addToCart({id: 2, name: 'Portal Remote Controller', price: 199, image: '/image/{{ $item->sliderImage }}', category: 'Remote Player'})">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                <button type="button" class="btn-game-primary" style="padding: 0.45rem 1rem; font-size: 0.78rem;" onclick="buyNow({id: 2, name: 'Portal Remote Controller', price: 199, image: '/image/{{ $item->sliderImage }}', category: 'Remote Player'})">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="product-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span style="background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid rgba(16, 185, 129, 0.4); padding: 2px 8px; border-radius: 6px; font-size: 0.7rem; font-weight: 700;">
                                PRO TIER
                            </span>
                            <span style="font-size: 0.8rem; color: #f59e0b;"><i class="fas fa-star"></i> 4.9 (1.8k)</span>
                        </div>
                        <div class="product-img-wrap">
                            <img src="/image/{{ $item->sliderImage2 }}" alt="Instinct Controller" onerror="this.src='/assets/images/img-4.png'">
                        </div>
                        <h4 style="font-size: 1.15rem; font-weight: 800; margin-bottom: 4px;">SCUF Instinct Pro Pad</h4>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5; margin-bottom: 1rem;">
                            Four rear remappable paddles with instantaneous triggers.
                        </p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid rgba(255,255,255,0.08); gap: 8px;">
                            <div>
                                <span style="font-size: 0.75rem; color: #64748b; text-decoration: line-through;">$219</span>
                                <div style="font-size: 1.25rem; font-weight: 900; color: #38bdf8;">$179</div>
                            </div>
                            <div class="d-flex gap-2" style="gap: 6px;">
                                <button type="button" class="btn-game-outline" style="padding: 0.45rem 0.8rem; font-size: 0.78rem;" title="Add to Cart" onclick="addToCart({id: 3, name: 'SCUF Instinct Pro Pad', price: 179, image: '/image/{{ $item->sliderImage2 }}', category: 'Controllers'})">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                <button type="button" class="btn-game-primary" style="padding: 0.45rem 1rem; font-size: 0.78rem;" onclick="buyNow({id: 3, name: 'SCUF Instinct Pro Pad', price: 179, image: '/image/{{ $item->sliderImage2 }}', category: 'Controllers'})">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="product-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span style="background: rgba(6, 182, 212, 0.2); color: #67e8f9; border: 1px solid rgba(6, 182, 212, 0.4); padding: 2px 8px; border-radius: 6px; font-size: 0.7rem; font-weight: 700;">
                                NEW AUDIO
                            </span>
                            <span style="font-size: 0.8rem; color: #f59e0b;"><i class="fas fa-star"></i> 4.8 (950)</span>
                        </div>
                        <div class="product-img-wrap">
                            <img src="/image/{{ $item->sliderImage3 }}" alt="Spatial Headset" onerror="this.src='/assets/images/img-3.png'">
                        </div>
                        <h4 style="font-size: 1.15rem; font-weight: 800; margin-bottom: 4px;">Sony Pulse Pro Headset</h4>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.5; margin-bottom: 1rem;">
                            Planar magnetic drivers with 3D audio and AI noise cancelling.
                        </p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid rgba(255,255,255,0.08); gap: 8px;">
                            <div>
                                <span style="font-size: 0.75rem; color: #64748b; text-decoration: line-through;">$189</span>
                                <div style="font-size: 1.25rem; font-weight: 900; color: #38bdf8;">$149</div>
                            </div>
                            <div class="d-flex gap-2" style="gap: 6px;">
                                <button type="button" class="btn-game-outline" style="padding: 0.45rem 0.8rem; font-size: 0.78rem;" title="Add to Cart" onclick="addToCart({id: 4, name: 'Sony Pulse Pro Headset', price: 149, image: '/image/{{ $item->sliderImage3 }}', category: 'Audio'})">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                <button type="button" class="btn-game-primary" style="padding: 0.45rem 1rem; font-size: 0.78rem;" onclick="buyNow({id: 4, name: 'Sony Pulse Pro Headset', price: 149, image: '/image/{{ $item->sliderImage3 }}', category: 'Audio'})">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     5. NEXT-GEN TECHNOLOGY & EXPERIENCE SECTION
     ========================================================================= -->
<section id="technology" class="game-section" style="background: #090e1a; border-top: 1px solid rgba(255,255,255,0.06); border-bottom: 1px solid rgba(255,255,255,0.06);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="game-pill-badge mb-3">
                    <i class="fas fa-broadcast-tower"></i> Wireless Remote Architecture
                </span>
                <h2 style="font-size: 2.75rem; font-weight: 800; line-height: 1.15; margin-bottom: 1.25rem;">
                    3D Video Game <span class="text-gradient-cyan">Remote Control</span>
                </h2>
                <p style="color: #94a3b8; font-size: 1.05rem; line-height: 1.7; margin-bottom: 2rem;">
                    Harness high-speed Wi-Fi 6 streaming and proprietary low-latency protocols. Enjoy true console-quality thumbsticks, tactile micro-switches, and customizable grip surfaces.
                </p>

                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="game-card-glass p-3 text-center">
                            <div style="font-size: 2rem; font-weight: 900; color: #38bdf8;">120 FPS</div>
                            <div style="font-size: 0.8rem; color: #94a3b8;">High Refresh Rate</div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="game-card-glass p-3 text-center">
                            <div style="font-size: 2rem; font-weight: 900; color: #10b981;">0.8 ms</div>
                            <div style="font-size: 0.8rem; color: #94a3b8;">Input Delay</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn-game-primary" onclick="buyNow({id: 2, name: 'Portal Remote Controller', price: 199, image: '/image/{{ $item->sliderImage }}', category: 'Remote Player'})">
                        <i class="fas fa-bolt"></i> Order Pro Remote
                    </button>
                </div>
            </div>

            <div class="col-lg-6 text-center">
                <div style="position: relative; display: inline-block;">
                    <div style="position: absolute; width: 340px; height: 340px; background: radial-gradient(circle, rgba(6, 182, 212, 0.35) 0%, transparent 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 50%; filter: blur(50px);"></div>
                    <img src="/assets/images/img-4.png" alt="Pro Controller" style="max-height: 420px; max-width: 100%; position: relative; z-index: 2;" class="hardware-floating">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. TESTIMONIALS SECTION
     ========================================================================= -->
<section id="experience" class="game-section" style="background: radial-gradient(circle at 50% 100%, rgba(99, 102, 241, 0.15) 0%, transparent 60%), #070a12;">
    <div class="container">
        <div class="game-section-header">
            <span class="game-pill-badge mb-3">
                <i class="fas fa-award"></i> Verified Gamer Reviews
            </span>
            <h2>COMMUNITY <span class="text-gradient-cyan">TESTIMONIALS</span></h2>
            <p>See why world-class esports players and casual streamers trust our gaming equipment.</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="game-card-glass p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; font-style: italic;">
                            "The response time on this controller is absurd. In competitive Ranked games, the hair triggers make a visible difference in winning 1v1 gunfights."
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.06); gap: 12px;">
                        <img src="/assets/images/img-5.png" alt="Avatar" style="width: 44px; height: 44px; border-radius: 50%; border: 2px solid #6366f1;">
                        <div>
                            <div style="font-weight: 700; color: #ffffff;">Sandy Delex</div>
                            <div style="font-size: 0.75rem; color: #38bdf8;">Apex Legends Predator Player</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="game-card-glass p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; font-style: italic;">
                            "I play PS5 anywhere in my home without turning on the main TV. Zero lag, beautiful display, and the DualSense haptic feedback is 100% authentic."
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.06); gap: 12px;">
                        <div style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #06b6d4, #3b82f6); display: flex; align-items: center; justify-content: center; font-weight: 700; color: white;">
                            MK
                        </div>
                        <div>
                            <div style="font-weight: 700; color: #ffffff;">Marcus Kane</div>
                            <div style="font-size: 0.75rem; color: #10b981;">Twitch Partner Streamer</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="game-card-glass p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; font-style: italic;">
                            "Customer support was instant and delivery arrived within 48 hours. The build quality feels sturdy, premium, and built to survive marathon grinds."
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.06); gap: 12px;">
                        <div style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #ec4899, #8b5cf6); display: flex; align-items: center; justify-content: center; font-weight: 700; color: white;">
                            EL
                        </div>
                        <div>
                            <div style="font-weight: 700; color: #ffffff;">Elena Vance</div>
                            <div style="font-size: 0.75rem; color: #ec4899;">RPG & MMO Enthusiast</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     7. CONTACT & COMMUNITY SUPPORT SECTION
     ========================================================================= -->
<section id="contact" class="game-section" style="background: #090e1a; border-top: 1px solid rgba(255,255,255,0.06);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="game-pill-badge mb-3">
                    <i class="fas fa-headset"></i> 24/7 Gaming Support
                </span>
                <h2 style="font-size: 2.75rem; font-weight: 800; line-height: 1.15; margin-bottom: 1rem;">
                    Get In <span class="text-gradient-cyan">Touch With Us</span>
                </h2>
                <p style="color: #94a3b8; font-size: 1rem; line-height: 1.6; margin-bottom: 2rem;">
                    Have questions about compatibility, warranty, or wholesale orders? Drop us a transmission and our gaming specialist team will assist you within hours.
                </p>

                <form onsubmit="event.preventDefault(); toastr.success('Your message has been sent successfully! Our team will reply shortly.'); this.reset();">
                    <div class="form-group mb-3">
                        <input type="text" class="game-input" placeholder="Your Name or Gamer Tag" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" class="game-input" placeholder="Your Email Address" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="game-input" placeholder="Phone Number / Discord ID">
                    </div>
                    <div class="form-group mb-3">
                        <textarea class="game-input" rows="4" placeholder="How can our gaming squad help you?" required></textarea>
                    </div>
                    <button type="submit" class="btn-game-primary w-100 justify-content-center">
                        <i class="fas fa-paper-plane mr-2"></i> Send Transmission
                    </button>
                </form>
            </div>

            <div class="col-lg-6 text-center">
                <div style="position: relative; display: inline-block;">
                    <div style="position: absolute; width: 340px; height: 340px; background: radial-gradient(circle, rgba(99, 102, 241, 0.35) 0%, transparent 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 50%; filter: blur(50px);"></div>
                    <img src="/assets/images/img-6.png" alt="Contact Support" style="max-height: 400px; max-width: 100%; position: relative; z-index: 2;" class="hardware-floating">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     8. SLIDE-OVER GAMING CART DRAWER
     ========================================================================= -->
<div class="cart-drawer-backdrop" id="cartBackdrop" onclick="closeCartDrawer()"></div>

<div class="cart-drawer" id="cartDrawer">
    <!-- Drawer Header -->
    <div class="cart-drawer-header">
        <div class="d-flex align-items-center gap-2" style="gap: 10px;">
            <i class="fas fa-shopping-bag" style="color: #6366f1; font-size: 1.25rem;"></i>
            <h4 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 0; color: #ffffff;">
                Your Gaming Cart (<span id="cartDrawerCount">0</span>)
            </h4>
        </div>
        <button type="button" onclick="closeCartDrawer()" style="background: transparent; border: none; color: #94a3b8; font-size: 1.25rem; cursor: pointer;">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Drawer Body -->
    <div class="cart-drawer-body">
        <!-- Cart Items List Container -->
        <div id="cartItemsList"></div>

        <!-- Empty State Container -->
        <div id="cartEmptyState" class="text-center py-5" style="display: none;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(99, 102, 241, 0.1); border: 1px dashed rgba(99, 102, 241, 0.4); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem auto;">
                <i class="fas fa-shopping-cart fa-2x" style="color: #6366f1;"></i>
            </div>
            <h5 style="color: #ffffff; font-weight: 700; margin-bottom: 0.5rem;">Your cart is empty</h5>
            <p style="color: #94a3b8; font-size: 0.875rem; margin-bottom: 1.5rem;">
                Browse our pro gaming gear and discover top-tier controllers.
            </p>
            <a href="#products" class="btn-game-primary" style="padding: 0.6rem 1.4rem; font-size: 0.85rem;" onclick="closeCartDrawer()">
                <i class="fas fa-gamepad"></i> Explore Products
            </a>
        </div>
    </div>

    <!-- Drawer Footer (Order Summary & Checkout Button) -->
    <div class="cart-drawer-footer" id="cartFooterSection">
        <!-- Promo Code Input -->
        <div class="input-group mb-3">
            <input type="text" id="promoCodeInput" class="form-control" placeholder="Promo code (e.g. GAMER10)" style="background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px 0 0 10px; color: #ffffff; font-size: 0.85rem; padding: 0.6rem 0.9rem;">
            <div class="input-group-append">
                <button type="button" class="btn-game-outline" style="border-radius: 0 10px 10px 0; padding: 0.6rem 1rem; font-size: 0.85rem;" onclick="applyPromo()">
                    Apply
                </button>
            </div>
        </div>

        <!-- Price breakdown -->
        <div class="mb-3" style="font-size: 0.9rem; line-height: 1.8;">
            <div class="d-flex justify-content-between text-muted">
                <span>Subtotal:</span>
                <span style="color: #ffffff; font-weight: 600;" id="cartSubtotalText">$0.00</span>
            </div>
            <div class="d-flex justify-content-between text-muted" id="discountRow" style="display: none !important;">
                <span class="text-success"><i class="fas fa-tag mr-1"></i> Discount (10%):</span>
                <span class="text-success font-weight-bold" id="cartDiscountText">-$0.00</span>
            </div>
            <div class="d-flex justify-content-between text-muted">
                <span>Express Shipping:</span>
                <span class="text-success font-weight-bold">FREE</span>
            </div>
            <div class="d-flex justify-content-between pt-2 mt-2" style="border-top: 1px solid rgba(255,255,255,0.08); font-size: 1.15rem; font-weight: 800; color: #ffffff;">
                <span>Total:</span>
                <span class="text-gradient-cyan" id="cartTotalText">$0.00</span>
            </div>
        </div>

        <button type="button" class="btn-game-primary w-100 justify-content-center" onclick="openCheckoutModal()" style="padding: 0.85rem;">
            <i class="fas fa-credit-card mr-2"></i> Proceed to Checkout
        </button>

        <div class="text-center mt-2">
            <button type="button" onclick="clearCart()" style="background: none; border: none; color: #ef4444; font-size: 0.78rem; text-decoration: underline; cursor: pointer;">
                Clear Entire Cart
            </button>
        </div>
    </div>
</div>

<!-- =========================================================================
     9. MULTI-STEP CHECKOUT & BUYING MODAL
     ========================================================================= -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background: #0d1322 !important; border: 1px solid rgba(255,255,255,0.12) !important; border-radius: 24px; box-shadow: 0 25px 60px rgba(0,0,0,0.85);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.08); padding: 1.5rem 2rem;">
                <div class="d-flex align-items-center gap-2" style="gap: 10px;">
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #6366f1, #06b6d4); display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h4 class="modal-title" id="checkoutModalLabel" style="font-weight: 800; color: #ffffff; margin-bottom: 0;">
                            Secure Gaming Checkout
                        </h4>
                        <span style="font-size: 0.78rem; color: #10b981;">
                            <i class="fas fa-shield-alt mr-1"></i> 256-Bit SSL Encrypted Transaction
                        </span>
                    </div>
                </div>
                <button type="button" class="btn-modal-close text-muted" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 1.5rem; color: #94a3b8;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body" style="padding: 2rem;">
                <!-- Step Navigation Indicator -->
                <div class="checkout-step-indicator" id="stepIndicatorBar">
                    <div class="step-dot active" id="dotStep1">1</div>
                    <div class="step-line" id="lineStep1"></div>
                    <div class="step-dot" id="dotStep2">2</div>
                    <div class="step-line" id="lineStep2"></div>
                    <div class="step-dot" id="dotStep3">3</div>
                </div>

                <!-- STEP 1: CUSTOMER & DELIVERY ADDRESS -->
                <div id="checkoutStep1">
                    <h5 style="font-weight: 700; color: #ffffff; margin-bottom: 1.25rem;">
                        <i class="fas fa-truck mr-2 text-primary"></i> 1. Delivery & Contact Details
                    </h5>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="cms-form-label"><i class="fas fa-user mr-1 text-primary"></i> Full Name</label>
                            <input type="text" id="custName" class="game-input" placeholder="e.g. Alex Johnson" required autocomplete="name">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="cms-form-label"><i class="fas fa-envelope mr-1 text-info"></i> Email Address</label>
                            <input type="email" id="custEmail" class="game-input" placeholder="e.g. alex@example.com" required autocomplete="email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="cms-form-label"><i class="fas fa-phone mr-1 text-success"></i> Phone Number</label>
                            <input type="tel" id="custPhone" class="game-input" placeholder="e.g. +1 (555) 019-2834" required autocomplete="tel">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="cms-form-label"><i class="fas fa-city mr-1 text-warning"></i> City & Region</label>
                            <input type="text" id="custCity" class="game-input" placeholder="e.g. Los Angeles, CA" required autocomplete="shipping address-level2">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="cms-form-label"><i class="fas fa-map-marker-alt mr-1 text-danger"></i> Shipping Street Address</label>
                        <input type="text" id="custAddress" class="game-input" placeholder="Street name, apartment, suite, etc." required autocomplete="shipping address-line1">
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 1px solid rgba(255,255,255,0.08);">
                        <button type="button" class="btn-game-outline" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn-game-primary" onclick="goToCheckoutStep(2)">
                            Continue to Payment <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: PAYMENT METHOD -->
                <div id="checkoutStep2" style="display: none;">
                    <h5 style="font-weight: 700; color: #ffffff; margin-bottom: 1.25rem;">
                        <i class="fas fa-credit-card mr-2 text-info"></i> 2. Payment Method
                    </h5>

                    <!-- Payment Method Tabs -->
                    <div class="d-flex gap-2 mb-4" style="gap: 10px;">
                        <button type="button" class="payment-tab-btn active" id="tabPayCard" onclick="selectPaymentMethod('card')">
                            <i class="fas fa-credit-card mr-1"></i> Credit / Debit Card
                        </button>
                        <button type="button" class="payment-tab-btn" id="tabPayPaypal" onclick="selectPaymentMethod('paypal')">
                            <i class="fab fa-paypal mr-1"></i> PayPal
                        </button>
                        <button type="button" class="payment-tab-btn" id="tabPayCod" onclick="selectPaymentMethod('cod')">
                            <i class="fas fa-money-bill-wave mr-1"></i> Cash On Delivery
                        </button>
                    </div>

                    <!-- Card Payment Form -->
                    <div id="payFormCard">
                        <div class="form-group mb-3">
                            <label class="cms-form-label"><i class="fas fa-credit-card mr-1 text-primary"></i> Card Number</label>
                            <input type="text" id="ccNumber" class="game-input" placeholder="4532 •••• •••• 8924" inputmode="numeric" maxlength="19" autocomplete="cc-number">
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="cms-form-label"><i class="fas fa-user mr-1 text-info"></i> Cardholder Name</label>
                                <input type="text" id="ccName" class="game-input" placeholder="Name as on card" autocomplete="cc-name">
                            </div>
                            <div class="col-6 col-md-3 form-group mb-3">
                                <label class="cms-form-label"><i class="fas fa-calendar mr-1 text-warning"></i> Expiry (MM/YY)</label>
                                <input type="text" id="ccExp" class="game-input" placeholder="MM/YY" maxlength="5" autocomplete="cc-exp">
                            </div>
                            <div class="col-6 col-md-3 form-group mb-3">
                                <label class="cms-form-label"><i class="fas fa-lock mr-1 text-success"></i> CVV / CVC</label>
                                <input type="password" id="ccCsc" class="game-input" placeholder="3 digits" maxlength="4" autocomplete="cc-csc">
                            </div>
                        </div>
                    </div>

                    <!-- PayPal Note -->
                    <div id="payFormPaypal" style="display: none;" class="p-3 game-card-glass text-center mb-3">
                        <i class="fab fa-paypal fa-2x text-info mb-2"></i>
                        <p style="color: #cbd5e1; font-size: 0.9rem; margin-bottom: 0;">
                            You will be connected to PayPal's secure gateway to authorize your payment.
                        </p>
                    </div>

                    <!-- COD Note -->
                    <div id="payFormCod" style="display: none;" class="p-3 game-card-glass text-center mb-3">
                        <i class="fas fa-hand-holding-usd fa-2x text-success mb-2"></i>
                        <p style="color: #cbd5e1; font-size: 0.9rem; margin-bottom: 0;">
                            Pay securely with cash or mobile QR payment upon receiving your gaming gear at your door.
                        </p>
                    </div>

                    <!-- Order Total Recap -->
                    <div class="game-card-glass p-3 mb-4 d-flex justify-content-between align-items-center">
                        <div>
                            <span style="font-size: 0.8rem; color: #94a3b8; text-transform: uppercase; font-weight: 700;">Final Amount To Pay</span>
                            <div style="font-size: 1.5rem; font-weight: 900; color: #38bdf8;" id="checkoutModalTotal">$0.00</div>
                        </div>
                        <span class="badge badge-success px-3 py-2" style="font-size: 0.8rem;">
                            <i class="fas fa-truck mr-1"></i> Free Express Delivery
                        </span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 1px solid rgba(255,255,255,0.08);">
                        <button type="button" class="btn-game-outline" onclick="goToCheckoutStep(1)">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Details
                        </button>
                        <button type="button" class="btn-game-primary" id="btnPlaceOrder" onclick="processOrderPlacement()">
                            <i class="fas fa-check-circle mr-1"></i> Confirm & Place Order
                        </button>
                    </div>
                </div>

                <!-- STEP 3: ORDER CONFIRMED / DIGITAL RECEIPT -->
                <div id="checkoutStep3" style="display: none;">
                    <div class="text-center py-4">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(16, 185, 129, 0.2); border: 2px solid #10b981; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 2.25rem; margin: 0 auto 1.5rem auto; box-shadow: 0 0 25px rgba(16, 185, 129, 0.5);">
                            <i class="fas fa-check"></i>
                        </div>
                        <h3 style="font-weight: 900; color: #ffffff; margin-bottom: 0.5rem;">
                            ORDER CONFIRMED!
                        </h3>
                        <p style="color: #94a3b8; font-size: 0.95rem; margin-bottom: 1.5rem;">
                            Thank you for your order! Your gaming hardware is being prepared for dispatch.
                        </p>

                        <!-- Order Card Receipt -->
                        <div class="game-card-glass p-4 text-left mb-4" id="receiptPrintArea">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                                <div>
                                    <span style="font-size: 0.8rem; color: #94a3b8; text-transform: uppercase;">Tracking Order ID</span>
                                    <div style="font-size: 1.25rem; font-weight: 800; color: #38bdf8; font-family: 'JetBrains Mono', monospace;" id="receiptOrderId">#GM-982410</div>
                                </div>
                                <div class="text-right">
                                    <span style="font-size: 0.8rem; color: #94a3b8;">Est. Delivery</span>
                                    <div style="font-size: 0.95rem; font-weight: 700; color: #10b981;" id="receiptDeliveryDate">Within 2 Business Days</div>
                                </div>
                            </div>

                            <div class="row mb-3" style="font-size: 0.875rem;">
                                <div class="col-6">
                                    <span style="color: #94a3b8; display: block;">Recipient</span>
                                    <strong style="color: #ffffff;" id="receiptCustName">Alex</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color: #94a3b8; display: block;">Delivery Address</span>
                                    <span style="color: #ffffff;" id="receiptCustAddress">Address</span>
                                </div>
                            </div>

                            <!-- Purchased Items List -->
                            <div id="receiptItemsSummary" class="mb-3"></div>

                            <div class="d-flex justify-content-between pt-3" style="border-top: 1px solid rgba(255,255,255,0.08); font-size: 1.15rem; font-weight: 800; color: #ffffff;">
                                <span>Amount Paid:</span>
                                <span class="text-gradient-cyan" id="receiptTotal">$0.00</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3" style="gap: 14px;">
                            <button type="button" class="btn-game-outline" onclick="window.print()">
                                <i class="fas fa-print mr-1"></i> Print Receipt
                            </button>
                            <button type="button" class="btn-game-primary" data-dismiss="modal" onclick="finishOrderFlow()">
                                <i class="fas fa-shopping-bag mr-1"></i> Continue Shopping
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@include('gaming-layout.footer')

<!-- =========================================================================
     10. COMPLETE JAVASCRIPT CART & BUYING PROCESS ENGINE
     ========================================================================= -->
<script type="text/javascript">
    // Global Cart State
    let cart = [];
    let appliedDiscount = 0; // percentage
    let selectedPayment = 'card';

    // Load Cart from LocalStorage
    function initCart() {
        try {
            const saved = localStorage.getItem('gaming_cart');
            if (saved) {
                cart = JSON.parse(saved);
            }
        } catch(e) {
            cart = [];
        }
        renderCartUI();
    }

    // Save Cart to LocalStorage
    function saveCart() {
        try {
            localStorage.setItem('gaming_cart', JSON.stringify(cart));
        } catch(e) {}
        renderCartUI();
    }

    // Add item to cart
    function addToCart(product, silent = false) {
        const existing = cart.find(item => item.id === product.id);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                price: parseFloat(product.price),
                image: product.image,
                category: product.category || 'Gear',
                qty: 1
            });
        }
        saveCart();

        // Bounce badge
        triggerBadgeBump();

        if (!silent) {
            toastr.success(`Added <strong>${product.name}</strong> to your cart!`);
        }
    }

    // Direct Buy Now shortcut
    function buyNow(product) {
        addToCart(product, true);
        openCartDrawer();
        setTimeout(() => {
            openCheckoutModal();
        }, 300);
    }

    // Change Item Quantity
    function changeQuantity(id, delta) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.qty += delta;
            if (item.qty <= 0) {
                removeFromCart(id);
                return;
            }
            saveCart();
        }
    }

    // Remove Item from Cart
    function removeFromCart(id) {
        const item = cart.find(i => i.id === id);
        const name = item ? item.name : 'Item';
        cart = cart.filter(item => item.id !== id);
        saveCart();
        toastr.info(`Removed <strong>${name}</strong> from cart.`);
    }

    // Clear entire cart
    function clearCart() {
        cart = [];
        appliedDiscount = 0;
        saveCart();
        toastr.warning('Your cart has been cleared.');
    }

    // Apply Promo Code
    function applyPromo() {
        const input = document.getElementById('promoCodeInput');
        const code = input ? input.value.trim().toUpperCase() : '';
        if (code === 'GAMER10') {
            appliedDiscount = 0.10; // 10%
            toastr.success('Promo code GAMER10 applied! 10% discount added.');
        } else if (code === 'VIP20') {
            appliedDiscount = 0.20; // 20%
            toastr.success('VIP code VIP20 applied! 20% discount added.');
        } else if (!code) {
            toastr.info('Please enter a promo code.');
            return;
        } else {
            toastr.error('Invalid promo code. Try: GAMER10');
            return;
        }
        renderCartUI();
    }

    // Calculate Cart Totals
    function calculateTotals() {
        const subtotal = cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
        const discount = subtotal * appliedDiscount;
        const total = Math.max(0, subtotal - discount);
        return { subtotal, discount, total };
    }

    // Render Cart Drawer UI
    function renderCartUI() {
        const totalQty = cart.reduce((acc, item) => acc + item.qty, 0);

        // Update badges
        const badges = [document.getElementById('cartBadge'), document.getElementById('floatingCartBadge')];
        badges.forEach(b => {
            if (b) {
                b.textContent = totalQty;
                b.style.display = totalQty > 0 ? 'flex' : 'none';
            }
        });

        const drawerCount = document.getElementById('cartDrawerCount');
        if (drawerCount) drawerCount.textContent = totalQty;

        const itemsList = document.getElementById('cartItemsList');
        const emptyState = document.getElementById('cartEmptyState');
        const footerSec = document.getElementById('cartFooterSection');

        if (!itemsList) return;

        if (cart.length === 0) {
            itemsList.innerHTML = '';
            if (emptyState) emptyState.style.display = 'block';
            if (footerSec) footerSec.style.display = 'none';
            return;
        }

        if (emptyState) emptyState.style.display = 'none';
        if (footerSec) footerSec.style.display = 'block';

        let html = '';
        cart.forEach(item => {
            const itemTotal = (item.price * item.qty).toFixed(2);
            html += `
                <div class="cart-item-row">
                    <div class="cart-item-img">
                        <img src="${item.image}" alt="${item.name}" onerror="this.src='/assets/images/img-1.png'">
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-weight: 700; color: #ffffff; font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${item.name}
                        </div>
                        <div style="font-size: 0.78rem; color: #38bdf8;">$${item.price.toFixed(2)} each</div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <div class="cart-qty-control">
                                <button type="button" class="cart-qty-btn" onclick="changeQuantity(${item.id}, -1)">-</button>
                                <span class="cart-qty-val">${item.qty}</span>
                                <button type="button" class="cart-qty-btn" onclick="changeQuantity(${item.id}, 1)">+</button>
                            </div>
                            <span style="font-weight: 800; color: #ffffff; font-size: 0.95rem;">$${itemTotal}</span>
                        </div>
                    </div>
                    <button type="button" onclick="removeFromCart(${item.id})" style="background: none; border: none; color: #ef4444; font-size: 0.85rem; cursor: pointer; padding: 4px;" title="Remove">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `;
        });
        itemsList.innerHTML = html;

        // Update totals
        const { subtotal, discount, total } = calculateTotals();
        const subtotalEl = document.getElementById('cartSubtotalText');
        const totalEl = document.getElementById('cartTotalText');
        const modalTotalEl = document.getElementById('checkoutModalTotal');
        const discountRow = document.getElementById('discountRow');
        const discountEl = document.getElementById('cartDiscountText');

        if (subtotalEl) subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
        if (totalEl) totalEl.textContent = `$${total.toFixed(2)}`;
        if (modalTotalEl) modalTotalEl.textContent = `$${total.toFixed(2)}`;

        if (appliedDiscount > 0 && discountRow && discountEl) {
            discountRow.style.setProperty('display', 'flex', 'important');
            discountEl.textContent = `-$${discount.toFixed(2)}`;
        } else if (discountRow) {
            discountRow.style.setProperty('display', 'none', 'important');
        }
    }

    // Trigger visual bounce on badge
    function triggerBadgeBump() {
        const badge = document.getElementById('cartBadge');
        if (badge) {
            badge.classList.add('bump');
            setTimeout(() => badge.classList.remove('bump'), 250);
        }
    }

    // Open/Close Drawer
    function openCartDrawer() {
        renderCartUI();
        document.getElementById('cartBackdrop').classList.add('active');
        document.getElementById('cartDrawer').classList.add('active');
    }

    function closeCartDrawer() {
        document.getElementById('cartBackdrop').classList.remove('active');
        document.getElementById('cartDrawer').classList.remove('active');
    }

    // Open Checkout Modal
    function openCheckoutModal() {
        if (cart.length === 0) {
            toastr.info('Please add at least one gaming item to your cart before checking out.');
            return;
        }
        closeCartDrawer();
        goToCheckoutStep(1);

        if (window.$) {
            $('#checkoutModal').modal('show');
        } else if (window.bootstrap && window.bootstrap.Modal) {
            new bootstrap.Modal(document.getElementById('checkoutModal')).show();
        }
    }

    // Switch Checkout Steps (1: Address, 2: Payment, 3: Receipt)
    function goToCheckoutStep(step) {
        if (step === 2) {
            const name = document.getElementById('custName').value.trim();
            const email = document.getElementById('custEmail').value.trim();
            const address = document.getElementById('custAddress').value.trim();
            if (!name || !email || !address) {
                toastr.warning('Please fill in your name, email, and delivery address to proceed.');
                return;
            }
        }

        document.getElementById('checkoutStep1').style.display = step === 1 ? 'block' : 'none';
        document.getElementById('checkoutStep2').style.display = step === 2 ? 'block' : 'none';
        document.getElementById('checkoutStep3').style.display = step === 3 ? 'block' : 'none';

        // Dots & lines
        document.getElementById('dotStep1').className = 'step-dot ' + (step >= 1 ? 'active' : '');
        document.getElementById('lineStep1').className = 'step-line ' + (step >= 2 ? 'active' : '');
        document.getElementById('dotStep2').className = 'step-dot ' + (step >= 2 ? 'active' : '');
        document.getElementById('lineStep2').className = 'step-line ' + (step >= 3 ? 'active' : '');
        document.getElementById('dotStep3').className = 'step-dot ' + (step >= 3 ? 'active' : '');
    }

    // Select payment method
    function selectPaymentMethod(type) {
        selectedPayment = type;
        document.getElementById('tabPayCard').classList.toggle('active', type === 'card');
        document.getElementById('tabPayPaypal').classList.toggle('active', type === 'paypal');
        document.getElementById('tabPayCod').classList.toggle('active', type === 'cod');

        document.getElementById('payFormCard').style.display = type === 'card' ? 'block' : 'none';
        document.getElementById('payFormPaypal').style.display = type === 'paypal' ? 'block' : 'none';
        document.getElementById('payFormCod').style.display = type === 'cod' ? 'block' : 'none';
    }

    // Process order placement
    function processOrderPlacement() {
        const btn = document.getElementById('btnPlaceOrder');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Encrypting Payment...';

        const name = document.getElementById('custName').value.trim();
        const email = document.getElementById('custEmail').value.trim();
        const phone = document.getElementById('custPhone') ? document.getElementById('custPhone').value.trim() : '';
        const address = document.getElementById('custAddress').value.trim();
        const city = document.getElementById('custCity').value.trim();
        const { subtotal, discount, total } = calculateTotals();
        const shipping = subtotal >= 99 ? 0.00 : (subtotal > 0 ? 9.99 : 0.00);
        const grandTotal = total + shipping;

        const payload = {
            name: name,
            email: email,
            phone: phone,
            address: address,
            city: city,
            subtotal: subtotal,
            discount: discount,
            shipping_fee: shipping,
            total: grandTotal,
            promo_code: (appliedDiscount === 0.10 ? 'GAMER10' : (appliedDiscount === 0.20 ? 'VIP20' : null)),
            items: cart,
            payment_method: selectedPayment.toUpperCase(),
            _token: '{{ csrf_token() }}'
        };

        // Send to backend API
        fetch('/api/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            const orderId = (data && data.order_id) ? data.order_id : ('GM-' + Math.floor(100000 + Math.random() * 900000));
            showOrderSuccessReceipt(orderId, name, `${address}, ${city}`, total);
        })
        .catch(err => {
            // Offline / fallback success receipt
            const orderId = 'GM-' + Math.floor(100000 + Math.random() * 900000);
            showOrderSuccessReceipt(orderId, name, `${address}, ${city}`, total);
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Confirm & Place Order';
        });
    }

    // Display Digital Receipt
    function showOrderSuccessReceipt(orderId, name, address, total) {
        document.getElementById('receiptOrderId').textContent = '#' + orderId;
        document.getElementById('receiptCustName').textContent = name || 'Valued Gamer';
        document.getElementById('receiptCustAddress').textContent = address || 'Standard Delivery';
        document.getElementById('receiptTotal').textContent = `$${total.toFixed(2)}`;

        // List purchased items in receipt
        let itemsHtml = '';
        cart.forEach(item => {
            itemsHtml += `
                <div class="d-flex justify-content-between text-muted py-1" style="font-size: 0.85rem;">
                    <span>${item.qty}x ${item.name}</span>
                    <span style="color: #ffffff;">$${(item.price * item.qty).toFixed(2)}</span>
                </div>
            `;
        });
        document.getElementById('receiptItemsSummary').innerHTML = itemsHtml;

        goToCheckoutStep(3);
        toastr.success('Order placed successfully! Receipt generated.');

        // Empty cart
        cart = [];
        appliedDiscount = 0;
        saveCart();
    }

    function finishOrderFlow() {
        goToCheckoutStep(1);
    }

    // Initialize cart engine on page load
    document.addEventListener('DOMContentLoaded', function() {
        initCart();
    });
</script>
