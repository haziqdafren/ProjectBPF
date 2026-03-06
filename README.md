# SURPA — Package & Mail Tracking System
**Sistem Pendataan Surat dan Paket Politeknik Caltex Riau**

A comprehensive package and mail tracking system built for university coursework at Politeknik Caltex Riau (TA 2024/2025). This web application enables security personnel to efficiently manage, track, and notify recipients about incoming packages and mail deliveries on campus.

## 🎯 Live Demo

Try the live demo with read-only access:

**Demo Credentials:**
- Email: `demo@surpa.com`
- Password: `demo123`

**Demo Features:**
- Full access to view all pages and data
- Interactive forms (can be filled but not submitted)
- Read-only mode with professional notifications
- Perfect for portfolio showcase and testing

## Background

With the increasing volume of online shopping and mail deliveries to campus, Politeknik Caltex Riau needed an efficient system to track and manage incoming packages. Without proper documentation and tracking, the distribution process became disorganized and packages were at risk of being lost or delayed.

**Surpa** (Surat dan Paket) solves this problem by providing a centralized, web-based platform where security personnel can:
- Record all incoming packages and mail
- Track package locations (Security Post / Housekeeping)
- Send automated WhatsApp notifications to recipients
- Maintain a complete history of all deliveries
- Upload proof of delivery photos

## Features

### Core Functionality
- **Package Data Management** — Complete CRUD operations for package records
- **Real-time Package Tracking** — Track package status and location by receipt number or owner name
- **History Tracking** — Comprehensive delivery history with search functionality
- **WhatsApp Integration** — Automated notifications sent via WhatsApp Click-to-Chat API
- **Photo Upload** — Upload and store proof of delivery photos
- **Demo Mode** — Portfolio-ready demonstration with read-only access
- **Expedition Management** — Manage courier/expedition companies (JNE, TIKI, J&T, etc.)

### User Roles
- **Security Personnel** — Full access to create, read, update, and delete package records
- **Demo User** — Read-only access to explore all features without modifying data
- **Package Recipients** — Limited access to track their packages using receipt numbers

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend Framework** | Laravel 11 (PHP 8.1+) |
| **Authentication** | Laravel Sanctum |
| **Database (Production)** | PostgreSQL |
| **Database (Development)** | SQLite |
| **Frontend** | Blade Templates, Bootstrap 5, JavaScript |
| **UI Components** | SweetAlert2, FontAwesome Icons |
| **Styling** | Custom CSS with modern animations |
| **Notifications** | WhatsApp Click-to-Chat API |
| **File Storage** | Local Storage (public disk) |
| **Development** | Composer, NPM |

## Database Evolution

### Development Phase (SQLite)
Initially used SQLite for rapid local development:
- Quick setup without external database server
- Perfect for testing and prototyping
- Lightweight and portable

### Production Migration (PostgreSQL)
Migrated to PostgreSQL for production deployment:
- Better performance with concurrent users
- Advanced indexing and query optimization
- Support for complex relationships and joins
- Better handling of foreign keys and constraints
- Deployed on Render.com with PostgreSQL addon

### Migration Process
The database schema remained consistent between SQLite and PostgreSQL, requiring only:
1. Environment configuration changes
2. Foreign key constraint adjustments
3. Data type compatibility checks (especially for `bigInteger` columns)

## Project Structure

```
surpa/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DataPaketController.php      → Package CRUD operations
│   │   │   ├── HistoriController.php        → History management
│   │   │   ├── LacakPaketController.php     → Package tracking
│   │   │   ├── EkspedisiController.php      → Expedition management
│   │   │   ├── SessionsController.php       → Authentication
│   │   │   ├── RegisterController.php       → User registration
│   │   │   └── InfoUserController.php       → User profile management
│   │   ├── Middleware/
│   │   └── Policies/
│   │       └── DataPaketPolicy.php          → Authorization policies
│   └── Models/
│       ├── User.php                         → User model with demo flag
│       ├── DataPaket.php                    → Package model
│       ├── Histori.php                      → History model
│       ├── LacakPaket.php                   → Tracking model
│       └── Ekspedisi.php                    → Expedition model
│
├── database/
│   ├── migrations/
│   │   └── 2026_03_05_add_is_demo_to_users_table.php  → Demo user support
│   └── seeders/
│       ├── DatabaseSeeder.php               → Main seeder
│       ├── DemoUserSeeder.php              → Demo account creation
│       └── HistoriSeeder.php               → Sample history data
│
├── resources/
│   └── views/
│       ├── session/
│       │   ├── login-session.blade.php      → Login with demo credentials
│       │   ├── register.blade.php           → Registration (disabled in demo)
│       │   └── lacakpaket.blade.php         → Package tracking with examples
│       ├── dataPaket.blade.php              → Package list view
│       ├── paket.blade.php                  → Add package form
│       ├── editPaket.blade.php              → Edit package form
│       ├── laravel-examples/
│       │   ├── histori.blade.php            → History view
│       │   └── user-profile.blade.php       → User profile
│       ├── bantuan.blade.php                → Help/Contact page
│       └── layouts/                         → Layout templates
│
├── public/
│   └── assets/
│       ├── css/
│       │   └── custom.css                   → 800+ lines of custom styles
│       └── js/
│           └── demo-mode.js                 → Demo restrictions handler
│
├── routes/
│   └── web.php                              → Application routes
│
├── .env.example                             → Environment configuration template
├── composer.json                            → PHP dependencies
├── package.json                             → NPM dependencies
└── README.md
```

## Database Schema

The application uses a relational database design with the following main tables:

### Core Tables
- **users** — Security personnel accounts with demo flag
- **data_paket** — Main package records table
- **histori** — Complete delivery history
- **lacak_paket** — Package tracking data
- **ekspedisi** — Courier/expedition companies

### Key Relationships
- `DataPaket` hasMany `Histori` (1:N)
- `DataPaket` belongsTo `Ekspedisi` (N:1)
- `DataPaket` belongsTo `User` (N:1)
- `Histori` belongsTo `Ekspedisi` (N:1)

### Foreign Key Constraints
Properly configured foreign keys ensure data integrity:
- `data_paket.user_id` → `users.id`
- `data_paket.ekspedisi_id` → `ekspedisi.Id_ekpedisi`
- `histori.ekspedisi_id` → `ekspedisi.Id_ekpedisi`

## Installation & Setup

### Prerequisites
- PHP >= 8.1
- Composer
- PostgreSQL (production) or SQLite (development)
- Node.js & NPM
- Web server (Apache/Nginx) or Laravel development server

### Step 1: Clone the Repository
```bash
git clone https://github.com/yourusername/surpa.git
cd surpa
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure Database

#### For Development (SQLite):
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

#### For Production (PostgreSQL):
```env
DB_CONNECTION=pgsql
DB_HOST=your-postgres-host
DB_PORT=5432
DB_DATABASE=surpa_db
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Step 5: Run Migrations and Seeders
```bash
# Create database tables
php artisan migrate

# Seed database with demo user and sample data
php artisan db:seed

# Or seed specific seeders
php artisan db:seed --class=DemoUserSeeder
php artisan db:seed --class=HistoriSeeder
```

### Step 6: Create Storage Link
```bash
# Link storage for file uploads
php artisan storage:link
```

### Step 7: Compile Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### Step 8: Run the Application
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Usage

### Demo Mode

The application includes a comprehensive demo mode for portfolio showcase:

**Login Page Features:**
- Clickable demo credentials card for instant autofill
- Visual feedback when credentials are filled
- Responsive design for all screen sizes

**Demo User Capabilities:**
- ✅ View all pages and data
- ✅ Navigate through the entire system
- ✅ Click edit/create buttons (access forms)
- ✅ Fill out forms and interact with UI
- ❌ Cannot save, edit, or delete data
- Professional SweetAlert popups explain restrictions

**Registration:**
- Disabled in demo mode
- Shows helpful popup directing users to demo login

**Package Tracking:**
- Accessible without login
- Example tracking numbers provided for testing
- Click any example to autofill search field

### For Security Personnel

1. **Login** — Sign in using email/password
2. **Add New Package**
   - Navigate to "Tambah Data Paket"
   - Fill in: Receipt number, product name, owner name, phone number, expedition, arrival date
   - Upload proof of receipt photo
   - System automatically sets location to "Pos Security" and status to "Belum Diterima"
   - Click "Simpan" — system redirects to WhatsApp to send notification
3. **View All Packages** — Browse all packages in "Data Paket" with pagination
4. **Edit Package** — Update package information via edit button
5. **Update History** — Upload proof of delivery photo when package is claimed
6. **Search Packages** — Search by receipt number, owner name, or phone number
7. **Manage Expeditions** — Add/edit/delete courier companies

### For Package Recipients

1. Visit the tracking page (accessible without login)
2. Enter receipt number (received via WhatsApp) or click example numbers
3. View package status, location, and expedition details

## Key Features Explained

### Demo Mode Implementation

**Backend:**
- `is_demo` boolean flag in users table
- Policy-based authorization allowing demo users to view but not modify
- Blade conditionals for conditional UI elements

**Frontend:**
- `demo-mode.js` intercepts form submissions
- SweetAlert2 popups provide professional user feedback
- Demo banner visible on all authenticated pages
- Welcome popup on first login

### WhatsApp Notifications
When a package is registered, the system:
1. Formats the phone number (converts 08xx to +628xx)
2. Generates a Click-to-Chat URL with pre-filled message
3. Redirects security personnel to WhatsApp to confirm sending
4. Message includes package location and tracking instructions

### Package Lifecycle
1. **Package Arrives** → Security registers in system (Status: "Belum Diterima", Location: "Pos Security")
2. **Notification Sent** → Recipient receives WhatsApp message
3. **Package Claimed** → Security updates status to "Sudah Diterima" and uploads proof photo
4. **History Recorded** → All changes saved in history table

### UI/UX Enhancements
- Modern animations and transitions throughout
- Responsive design for mobile, tablet, and desktop
- Consistent table layouts across all pages
- Click-to-fill demo credentials and tracking examples
- Professional SweetAlert popups instead of browser alerts
- Smooth visual feedback on user interactions

## Security Features

- CSRF protection on all forms
- Password hashing with bcrypt
- Session-based authentication
- Authorization policies for resource access
- Demo mode restrictions (client and server-side)
- File upload validation (max 2MB, jpeg/png/jpg/gif only)
- SQL injection protection via Eloquent ORM
- XSS protection via Blade escaping

## Development Team

**Kelompok 10 — Teknik Informatika, Politeknik Caltex Riau**

| Name | Student ID | Role |
|------|-----------|------|
| **Mohamad Haziq Dafren** | 2355301119 | **Team Lead** — Full Stack Development, Database Architecture, API Integration, Deployment |
| Luthfiah Rahmi | - | Frontend Development, Profile UI, Documentation |
| Muhammad Atha Ananda | - | Frontend Development, Add Data UI, Documentation |
| Nazwa Salsabila Halim | - | Frontend Development, Package Data UI, Documentation |
| Siti Solikhah | - | Frontend Development, History UI, Documentation |

**Supervisor:** Mutia Sari Zulvi, S.S.T., M.M.SI
**Lab Instructor:** Muhammad Anwar, S.Tr.Kom

## Production Deployment

The application is deployed on **Render.com** with the following stack:
- **Web Service**: Laravel 11 application
- **Database**: PostgreSQL (Render PostgreSQL addon)
- **Environment**: Production-optimized configuration
- **Storage**: Persistent disk for file uploads

### Deployment Process
1. Connected GitHub repository to Render
2. Configured build and start commands
3. Set up PostgreSQL database addon
4. Configured environment variables
5. Ran migrations and seeders in production
6. Configured storage for file uploads

## Future Enhancements

- [ ] Email notifications as alternative to WhatsApp
- [ ] SMS notifications
- [ ] QR code generation for packages
- [ ] Mobile app (Android/iOS)
- [ ] Advanced analytics dashboard
- [ ] Multi-campus support
- [ ] Package barcode scanning
- [ ] Export data to PDF/Excel
- [ ] Real-time notifications using WebSockets
- [ ] Multi-language support

## License

This project was developed as academic coursework at Politeknik Caltex Riau. All rights reserved.

## Acknowledgments

- Politeknik Caltex Riau for project support
- Laravel community for excellent documentation
- Bootstrap and SweetAlert2 teams for UI frameworks
- Render.com for hosting services

---

**📦 Built with Laravel 11 | PostgreSQL | Bootstrap 5**
**🎓 TA 2024/2025 — Politeknik Caltex Riau**
