-- =================================================================
-- Supabase (PostgreSQL) Initial Schema & Seed Data for Gaming CMS
-- You can copy-paste and run this entire file in Supabase SQL Editor
-- =================================================================

-- 1. Create Users Table
CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT NOW(),
    updated_at TIMESTAMP NULL DEFAULT NOW()
);

-- 2. Create Navigation & Banners Table (tblmenubar)
-- Dropped if already created with old VARCHAR(255) to ensure TEXT columns
DROP TABLE IF EXISTS tblmenubar CASCADE;

CREATE TABLE tblmenubar (
    navid INT NOT NULL,
    name VARCHAR(255) NULL,
    nav1 VARCHAR(255) NULL,
    nav2 VARCHAR(255) NULL,
    nav3 VARCHAR(255) NULL,
    nav4 VARCHAR(255) NULL,
    nav5 VARCHAR(255) NULL,
    nav6 VARCHAR(255) NULL,
    nav7 VARCHAR(255) NULL,
    nav8 VARCHAR(255) NULL,
    logo TEXT NULL,
    create_at TIMESTAMP NULL,
    update_at TIMESTAMP NULL,
    whiteTitle VARCHAR(255) NULL,
    blueTitle VARCHAR(255) NULL,
    description TEXT NULL,
    sliderImage TEXT NULL,
    btnTitle VARCHAR(255) NOT NULL,
    whiteTitle2 VARCHAR(255) NULL,
    blueTitle2 VARCHAR(255) NULL,
    description2 TEXT NULL,
    sliderImage2 TEXT NULL,
    btnTitle2 VARCHAR(255) NULL,
    whiteTitle3 VARCHAR(255) NULL,
    blueTitle3 VARCHAR(255) NULL,
    description3 TEXT NULL,
    sliderImage3 TEXT NULL,
    btnTitle3 VARCHAR(255) NULL,
    PRIMARY KEY (navid, btnTitle)
);

-- 3. Create Sales Orders Table
CREATE TABLE IF NOT EXISTS sales_orders (
    id BIGSERIAL PRIMARY KEY,
    order_id VARCHAR(255) UNIQUE NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(255) NULL,
    shipping_address TEXT NULL,
    city VARCHAR(255) NULL,
    postal_code VARCHAR(255) NULL,
    payment_method VARCHAR(255) DEFAULT 'Credit Card',
    payment_status VARCHAR(255) DEFAULT 'Paid',
    order_status VARCHAR(255) DEFAULT 'Processing',
    subtotal NUMERIC(10, 2) DEFAULT 0.00,
    discount NUMERIC(10, 2) DEFAULT 0.00,
    shipping_fee NUMERIC(10, 2) DEFAULT 0.00,
    total_amount NUMERIC(10, 2) DEFAULT 0.00,
    promo_code VARCHAR(255) NULL,
    items_json TEXT NULL,
    notes TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NOW(),
    updated_at TIMESTAMP NULL DEFAULT NOW()
);

-- 4. Create Laravel Sessions & Cache Tables
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INT NOT NULL
);

CREATE TABLE IF NOT EXISTS cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration INT NOT NULL
);

CREATE TABLE IF NOT EXISTS cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL
);

-- 5. Seed Default Admin User (Username: admin, Password: 123)
INSERT INTO users (id, name, email, password, created_at, updated_at)
VALUES (
    1,
    'admin',
    'admin@mail.com',
    '$2y$12$ne6NB5HBVg6CthjMLqs4vOK9Xqrc9.VzUpqOYliYwpUEM97Tr/5aG',
    NOW(),
    NOW()
)
ON CONFLICT (id) DO NOTHING;

-- 6. Seed Default Hero Banner & Menu Configuration
INSERT INTO tblmenubar (
    navid, name, nav1, nav2, nav3, nav4, nav5, nav6, nav7, nav8, logo, create_at, update_at,
    whiteTitle, blueTitle, description, sliderImage, btnTitle,
    whiteTitle2, blueTitle2, description2, sliderImage2, btnTitle2,
    whiteTitle3, blueTitle3, description3, sliderImage3, btnTitle3
) VALUES (
    1, '', 'HOME', 'ABOUT', 'OUR PRODUCTS', 'VIDEO GAMES', 'REMOT CONTROL', 'CONTACT US', 'SIGN IN', 'REGISTER', '1718100713.png', NOW(), NOW(),
    'Dai GAMES', 'BLACK', 'PlayStation Portal Remote Player. Play your PS5 console over your home Wi-Fi with console quality controls using PlayStation Portal Remote Player. Experience the incredible immersion of DualSense wireless controller features like haptic feedback and adaptive triggers.', '1718264138.png', 'Books',
    'Sabay', 'Digital', 'Sony - PlayStation Portal Remote Player - White. High performance gaming gear and accessories.', '1718162489.png', 'Shop',
    'Sony', 'Headphone', 'Engineered for high fidelity audio performance and ultra-low latency responsiveness.', '1718264152.png', 'GO To'
)
ON CONFLICT (navid, btnTitle) DO NOTHING;

-- 7. Seed Initial Sample Orders
INSERT INTO sales_orders (
    order_id, customer_name, customer_email, customer_phone, shipping_address,
    city, postal_code, payment_method, payment_status, order_status,
    subtotal, discount, shipping_fee, total_amount, promo_code, items_json, notes, created_at, updated_at
) VALUES 
(
    'GM-9A4B12', 'Alex Rivera', 'alex.rivera@esports.gg', '+1 (555) 349-8120',
    '742 Evergreen Terrace, Apt 4B', 'Neo Seattle', '98101', 'Credit Card', 'Paid', 'Delivered',
    389.98, 38.99, 0.00, 350.99, 'GAMER10',
    '[{"id":"prod-1","name":"CyberStrike Mech Keyboard","price":149.99,"qty":1},{"id":"prod-2","name":"AeroPulse 7.1 Headset","price":199.99,"qty":1}]',
    'Leave at front door.', NOW() - INTERVAL '2 days', NOW() - INTERVAL '2 days'
),
(
    'GM-7F2C84', 'Elena Rostova', 'elena.rostova@twitch.tv', '+1 (555) 782-9011',
    '1204 Sunset Boulevard, Suite 80', 'Los Angeles', '90028', 'Credit Card', 'Paid', 'Processing',
    499.99, 0.00, 0.00, 499.99, NULL,
    '[{"id":"prod-3","name":"Phantom Pro Wireless Controller","price":499.99,"qty":1}]',
    'Express delivery requested.', NOW() - INTERVAL '1 hour', NOW() - INTERVAL '1 hour'
)
ON CONFLICT (order_id) DO NOTHING;
