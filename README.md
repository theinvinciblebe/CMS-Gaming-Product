# 🎮 Gaming CMS & E-Commerce Platform V2

[![Laravel 11](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind Dark Mode](https://img.shields.io/badge/Dark%20Mode-Tailwind--Style%20Toggle-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

A modern, high-performance Content Management System (CMS) and E-Commerce Storefront tailored for gaming peripherals, hardware, and accessories. Features a futuristic **Gaming HUD Admin Dashboard**, **Tailwind-style Light/Dark mode**, a complete **Add-to-Cart & Checkout Engine**, and an integrated **Sales History & Order Fulfillment System**.

---

## 🌟 Key Highlights & What's New in V2

### 1. 🛍️ End-to-End E-Commerce Cart & Checkout Engine
- **Slide-Over Gaming Cart Drawer (`#cartDrawer`)**:
  - Accessible via the navigation bar cart button or the mobile floating action button.
  - Persistent state management backed by browser `localStorage`.
  - Interactive quantity controls (`+` / `-`), remove actions, and empty cart states.
  - Live animated badge counter with bounce effects.
- **Promo Code Engine**:
  - Integrated coupons (e.g. `GAMER10` for 10% OFF, `VIP20` for 20% OFF) with real-time total recalculations.
  - Automatic free shipping threshold on orders over **$99.00** (flat $9.99 fallback).
- **Multi-Step Checkout Modal (`#checkoutModal`)**:
  - **Step 1 - Shipping & Contact**: Semantic HTML5 autofill compliant (`autocomplete="shipping address-line1"`, `autocomplete="tel"`, etc.).
  - **Step 2 - Payment Methods**: Credit / Debit Card (continuous card format with `inputmode="numeric"`), PayPal Express, and Cash on Delivery (COD).
  - **Step 3 - Order Review**: Detailed line-item summary and order review before charge confirmation.
- **Digital Receipt & Printable Invoices (`#receiptModal`)**:
  - Generates a unique tracking ID (`#GM-XXXXXX`).
  - Print-ready invoice view triggered via `@media print`.

---

### 2. 📊 Sales & Order History Management (`/sales-management`)
- **Dedicated Orders Ledger**: Persistent records stored in the `sales_orders` MySQL table.
- **Glowing HUD Analytics Cards**:
  - **Total Gross Revenue** (Live ledger, excludes cancelled orders).
  - **Total Orders Count** (All-time storefront checkouts).
  - **Average Order Value (AOV)** (Per completed basket).
  - **Fulfillment Rate** (Delivered orders vs. active in-transit orders).
- **Control & Filter Panel**:
  - Search by Order ID, Customer Name, Email, or Phone number.
  - Filter by Order Status (`Processing`, `Shipped`, `Delivered`, `Pending`, `Cancelled`).
  - Filter by Payment Status (`Paid`, `Pending`, `Refunded`).
  - Timeframe filter (`All Time`, `Today`, `This Week`, `This Month`) & Sorting.
- **Order Breakdown Modal**:
  - Inspect purchased line items, quantities, unit prices, delivery destination, and customer contact notes.
  - In-modal **"Print Invoice"** button.
  - Single-click **Fulfillment Status Updater** (`Pending` ➔ `Processing` ➔ `Shipped` ➔ `Delivered`).
- **CSV Data Export**: One-click download of all transaction history via `/sales-management/export-csv`.

---

### 3. 🌓 Tailwind-Style 1-Toggle Light / Dark Mode
- Single toggle button with a smooth sliding thumb switch and sun/moon icons.
- **Zero-FOUC (Flash of Unstyled Content)**: Pre-render theme injection script checks `localStorage` and OS preference before the DOM paints.
- Unified CSS variable theme architecture (`--cms-bg-card`, `--cms-text-primary`, `--cms-border-color`).
- Cross-tab synchronization via `window.addEventListener('storage', ...)`.

---

### 4. 🎛️ Modern Gaming Dashboard & CMS Studio (`/dashboard`)
- **Cyberpunk HUD Aesthetics**: Glassmorphic panels, glowing border gradients, and responsive layout.
- **Hero Slider Simulator**: Visual real-time simulator for all 3 hero carousel banners synchronized with dynamic CMS fields in `tblmenubar`.
- **Top Navbar Controller**: Real-time management of brand logos and 8 navigation anchors.
- **Store Revenue KPI Card**: Direct view of gross sales and quick-access jump to Sales History.

---

### 5. 👥 User Management Overhaul (`/user-management`)
- Modern data table featuring user avatars, role badges, and status pills.
- High-contrast modal forms supporting both Light and Dark modes.
- Real-time client-side instant search filter.
- Password generator and admin credential safety checks.

---

## 🛠️ Tech Stack

| Layer | Technologies |
|---|---|
| **Backend Framework** | Laravel 11.x (PHP 8.2+) |
| **Database** | MySQL 8.0+ |
| **Frontend Styling** | Vanilla CSS3 Design System with HSL Tokens, Glassmorphism, CSS Custom Properties |
| **Typography** | Google Fonts (`Outfit` & `Plus Jakarta Sans`, `JetBrains Mono`) |
| **Icons & Alerts** | FontAwesome 6, Toastr.js |
| **State & Interactivity**| Native Vanilla JavaScript (ES6+), `localStorage`, Bootstrap 4 Modals |

---

## 📁 Database Architecture

### Key Tables

- **`sales_orders`** *(New in V2)*:
  - `id` (Primary Key)
  - `order_id` (Unique gaming tracking identifier, e.g. `GM-9A4B12`)
  - `customer_name`, `customer_email`, `customer_phone`
  - `shipping_address`, `city`, `postal_code`
  - `payment_method`, `payment_status` (`Paid`, `Pending`, `Refunded`)
  - `order_status` (`Pending`, `Processing`, `Shipped`, `Delivered`, `Cancelled`)
  - `subtotal`, `discount`, `shipping_fee`, `total_amount`, `promo_code`
  - `items_json` (Stores product names, unit prices, quantities, and image references)
  - `notes`, `created_at`, `updated_at`

- **`users`**:
  - `id`, `name`, `email`, `role`, `password`, `created_at`, `updated_at`

- **`tblmenubar`**:
  - Navigation anchors (`nav1` through `nav8`)
  - Brand identity (`name`, `logo`)
  - Hero slider carousel content across 3 slides (`whiteTitle`, `blueTitle`, `description`, `sliderImage`, `btnTitle`)

- **System Tables**: `sessions`, `cache`, `cache_locks`, `jobs`, `migrations`

---

## 🚀 Getting Started

### Prerequisites
- **PHP** >= 8.2
- **Composer** >= 2.x
- **MySQL** >= 8.0 or MariaDB
- **Node.js** >= 18.x & NPM

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/theinvinciblebe/CMS-Gaming-Product.git
   cd CMS-Gaming-Product/Home_app
   ```

2. **Install PHP and Node dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Ensure your `.env` contains the correct database configuration:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gaming_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```
   *This automatically sets up the admin account and sample sales orders.*

5. **Start Application Servers**
   ```bash
   # Terminal 1 - Backend Server
   php artisan serve

   # Terminal 2 - Frontend Asset Compiler
   npm run dev
   ```

6. **Access URLs**:
   - **Storefront**: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
   - **Admin Dashboard**: [http://127.0.0.1:8000/dashboard](http://127.0.0.1:8000/dashboard)
   - **Sales Management**: [http://127.0.0.1:8000/sales-management](http://127.0.0.1:8000/sales-management)
   - **User Management**: [http://127.0.0.1:8000/user-management](http://127.0.0.1:8000/user-management)

---

## 🔑 Default Credentials

| Role | Username / Email | Password |
|---|---|---|
| **Administrator** | `admin` | `123` |

---

## 🗺️ Application Routes

### Public Web & API Routes
| Method | Route | Description |
|---|---|---|
| `GET` | `/` | Storefront landing page & gaming gear catalog |
| `POST` | `/api/checkout` | Process storefront cart checkout & creates sale order |
| `GET` | `/login` | Admin login page |
| `POST` | `/do_login` | Authenticate user credentials |
| `GET` | `/logout` | Log out and invalidate session |

### Authenticated Admin Routes (`auth` middleware)
| Method | Route | Description |
|---|---|---|
| `GET` | `/dashboard` | Main CMS control studio & slider simulator |
| `GET` | `/sales-management` | Sales history ledger, KPI metrics, and filters |
| `GET` | `/sales-management/export-csv` | Download CSV report of all sales records |
| `GET` | `/sales-management/{id}` | Fetch JSON details of a single sale order |
| `POST`| `/sales-management/update-status/{id}` | Update fulfillment & payment status |
| `DELETE`| `/sales-management/delete/{id}` | Delete sale order record |
| `GET` | `/user-management` | User account management view |
| `POST`| `/user-management/store` | Create new user account |
| `PUT` | `/user-management/update` | Update existing user details |
| `DELETE`| `/user-management/delete/{id}` | Delete user account |
| `GET` | `/menubar-edit/{id}` | Edit navigation anchors and logo |
| `GET` | `/menubar-editSlider/{id}` | Edit Carousel Slide 1 |
| `GET` | `/menubar-editSlider2/{id}` | Edit Carousel Slide 2 |
| `GET` | `/menubar-editSlider3/{id}` | Edit Carousel Slide 3 |

---

## 🏷️ Test Promo Codes

When purchasing items in the storefront cart, test the promotional discount system using:
- **`GAMER10`** - Unlocks **10% OFF** subtotal discount.
- **`VIP20`** - Unlocks **20% OFF** VIP discount.

---

## 📄 License

This project is licensed under the **MIT License** - see the LICENSE file for details.

---

**Author**: Theng Sothea ([@theinvinciblebe](https://github.com/theinvinciblebe))  
**Version**: 2.0.0  
**Updated**: October 2026
