# CMS Gaming Product

A comprehensive Content Management System (CMS) designed for gaming products, built with modern web technologies.

## 📋 Project Overview

This project is a full-featured CMS platform tailored for managing gaming products, including video games, gaming peripherals, and gaming accessories. It provides an intuitive admin interface for managing product catalogs, user sessions, and dynamic content through a customizable menu bar system.

## 🛠️ Tech Stack

| Technology | Usage |
|------------|-------|
| **JavaScript** | 87.7% - Core application logic and interactivity |
| **CSS** | 9.4% - Styling and layout |
| **SCSS** | 1.6% - Advanced styling with variables and mixins |
| **Other** | 1.3% - Configuration and misc files |

## 📦 Features

- **Product Management** - Manage gaming products including video games, remotes, and accessories
- **User Authentication** - Secure login system with password reset functionality
- **Session Management** - Track user sessions with IP and user agent logging
- **Dynamic Menu System** - Customizable navigation with support for multiple menu items and branding
- **Content Caching** - High-performance caching system with cache locks
- **Job Queue System** - Background job processing with batch support and failure tracking
- **Admin Panel** - Comprehensive dashboard for content management

## 📁 Database Schema

### Core Tables

- **users** - User authentication and profile information
- **sessions** - User session tracking and management
- **password_reset_tokens** - Password reset token storage

### Product Management

- **tblmenubar** - Navigation menu and homepage content management
  - Multiple product sections with titles, descriptions, and images
  - Button customization for each section
  - Logo and branding assets

### System Tables

- **cache** - Cache storage with expiration
- **cache_locks** - Cache lock management for concurrency control
- **jobs** - Job queue for background processing
- **job_batches** - Batch job tracking and management
- **failed_jobs** - Failed job logging and error tracking
- **migrations** - Database migration history

## 🚀 Getting Started

### Prerequisites

- PHP 8.0 or higher
- MySQL 10.4.32 or higher
- Node.js (for JavaScript dependencies)
- Composer (PHP package manager)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/theinvinciblebe/CMS-Gaming-Product.git
   cd CMS-Gaming-Product
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   - Update `.env` with your database credentials
   - Run migrations:
     ```bash
     php artisan migrate
     ```

5. **Start Development Server**
   ```bash
   php artisan serve
   npm run dev
   ```

## 📊 Database Setup

The project includes pre-configured database tables ready for Laravel migrations. To set up the database:

```bash
# Run all migrations
php artisan migrate

# Seed the database (if seeders are available)
php artisan db:seed
```

## 🔧 Configuration

### Menu Bar Configuration

The `tblmenubar` table allows configuration of:
- Navigation menu items (up to 8 items)
- Product sliders with images and descriptions
- Button labels and CTAs
- Logo and branding assets

Example menu structure:
- HOME
- ABOUT
- OUR PRODUCTS
- VIDEO GAMES
- REMOTE CONTROL
- CONTACT US
- SIGN IN
- REGISTER

### Admin Credentials

Default admin user:
- **Email**: admin
- **Password**: (configured during setup)

## 📝 API Endpoints

Key endpoints for content management:

- `GET /admin` - Admin dashboard
- `POST /menubar-edit` - Update menu bar content
- `GET /menubar-edit/{id}` - View menu bar content

## 🔐 Security Features

- Password hashing with bcrypt
- Email verification support
- Session management with IP tracking
- CSRF protection
- Secure password reset tokens

## 📦 Caching System

- Multi-level caching with expiration
- Distributed cache locks for concurrency
- Cache invalidation on content updates

## 🎮 Product Categories

The CMS supports management of:
- Video Games (PlayStation, Xbox, etc.)
- Gaming Accessories
- Remote Controls
- Gaming Peripherals
- Featured Products

## 🔄 Job Queue System

- Background job processing
- Batch job support
- Failed job tracking and logging
- Retry mechanisms
- Job status monitoring

## 📄 File Structure

```
CMS-Gaming-Product/
├── app/                      # Application logic
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript files
├── routes/                  # API and web routes
├── public/                  # Public assets
├── config/                  # Configuration files
└── storage/                 # Uploads and logs
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👨‍💻 Author

**Theng Sothea**
- GitHub: [@theinvinciblebe](https://github.com/theinvinciblebe)

## 📞 Support

For support, please open an issue on the GitHub repository.

## 🗺️ Roadmap

- [ ] Enhanced product filtering and search
- [ ] User review and rating system
- [ ] Advanced analytics dashboard
- [ ] Email notification system
- [ ] Mobile app integration
- [ ] Multi-language support
- [ ] Payment gateway integration
- [ ] Inventory management

## 🐛 Known Issues

- None currently reported

## 📈 Performance

- Optimized database queries with proper indexing
- Caching enabled for frequently accessed data
- Lazy loading for product images
- Minified assets for faster load times

---

**Last Updated**: June 2, 2026

For more information, visit the [GitHub repository](https://github.com/theinvinciblebe/CMS-Gaming-Product).
