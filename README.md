# SURPA — Package & Mail Tracking System
**Sistem Pendataan Surat dan Paket Politeknik Caltex Riau**

A comprehensive package and mail tracking system built for university coursework at Politeknik Caltex Riau (TA 2024/2025). This web application enables security personnel to efficiently manage, track, and notify recipients about incoming packages and mail deliveries on campus.

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
- **Google OAuth** — Sign in with Google for quick authentication
- **Expedition Management** — Manage courier/expedition companies (JNE, TIKI, J&T, etc.)

### User Roles
- **Security Personnel** — Full access to create, read, update, and delete package records
- **Package Recipients** — Limited access to track their packages using receipt numbers

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend Framework** | Laravel 11 (PHP 8.1+) |
| **Authentication** | Laravel Sanctum, Google OAuth (Socialite) |
| **Database** | MySQL |
| **Frontend** | Blade Templates, Bootstrap 5, JavaScript |
| **Asset Compilation** | Laravel Mix (Webpack) |
| **Styling** | Sass/SCSS, Custom CSS |
| **Notifications** | WhatsApp Click-to-Chat API |
| **File Storage** | Local Storage (public disk) |
| **Development** | Composer, NPM |

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
│   │   │   ├── SessionsController.php       → Auth & Google OAuth
│   │   │   ├── RegisterController.php       → User registration
│   │   │   └── InfoUserController.php       → User profile management
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── DataPaket.php                    → Package model
│       ├── Histori.php                      → History model
│       ├── LacakPaket.php                   → Tracking model
│       └── Ekspedisi.php                    → Expedition model
│
├── database/
│   ├── migrations/                          → Database schema definitions
│   └── seeders/
│       └── UserSeeder.php                   → Default user data
│
├── resources/
│   └── views/
│       ├── session/
│       │   ├── login-session.blade.php      → Login page
│       │   └── lacakpaket.blade.php         → Package tracking page
│       ├── dataPaket.blade.php              → Package list view
│       ├── paket.blade.php                  → Add package form
│       ├── editPaket.blade.php              → Edit package form
│       ├── laravel-examples/
│       │   ├── histori.blade.php            → History view
│       │   └── user-profile.blade.php       → User profile
│       ├── bantuan.blade.php                → Help/Contact page
│       └── layouts/                         → Layout templates
│
├── routes/
│   └── web.php                              → Application routes
│
├── public/
│   └── assets/                              → CSS, JS, images
│
├── .env.example                             → Environment configuration template
├── composer.json                            → PHP dependencies
├── package.json                             → NPM dependencies
└── README.md
```

## Database Schema

The application uses a **star schema** design with the following main tables:

### Core Tables
- **users** — Security personnel accounts
- **data_paket** — Main package records table
- **histori** — Complete delivery history
- **lacak_paket** — Package tracking data
- **ekspedisi** — Courier/expedition companies

### Key Relationships
- `DataPaket` hasMany `Histori` (1:N)
- `DataPaket` belongsTo `Ekspedisi` (N:1)
- `DataPaket` belongsTo `User` (N:1)
- `Histori` belongsTo `Ekspedisi` (N:1)

## Installation & Setup

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM
- Web server (Apache/Nginx)

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
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=surpa_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Configure Google OAuth (Optional)
Add Google OAuth credentials to `.env`:
```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### Step 6: Run Migrations
```bash
# Create database tables
php artisan migrate

# (Optional) Seed database with test data
php artisan db:seed
```

### Step 7: Create Storage Link
```bash
# Link storage for file uploads
php artisan storage:link
```

### Step 8: Compile Assets
```bash
# Development
npm run dev

# Production
npm run production
```

### Step 9: Run the Application
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Usage

### For Security Personnel

1. **Login** — Sign in using email/password or Google OAuth
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
2. Enter receipt number (received via WhatsApp)
3. View package status, location, and expedition details

## Key Features Explained

### WhatsApp Notifications
When a package is registered, the system:
1. Formats the phone number (converts 08xx to +628xx)
2. Generates a Click-to-Chat URL with pre-filled message
3. Redirects security personnel to WhatsApp to confirm sending
4. Message includes package location and tracking instructions

**Message Format:**
```
Paket Anda sudah berada di lokasi: Pos Security.

Mohon segera mengambil paket Anda. Jika Anda ingin melihat lokasi paket Anda, silakan kunjungi link berikut: [tracking URL] dan masukkan No. Resi Anda: [receipt number].

Terima kasih.
```

### Package Lifecycle
1. **Package Arrives** → Security registers in system (Status: "Belum Diterima", Location: "Pos Security")
2. **Notification Sent** → Recipient receives WhatsApp message
3. **Package Claimed** → Security updates status to "Sudah Diterima" and uploads proof photo
4. **History Recorded** → All changes saved in history table

### Search & Filtering
- Search packages by receipt number, owner name, or phone number
- Filter history by date and status
- Paginated results for better performance

## API Endpoints

While this is primarily a web application, it includes one Sanctum-protected API endpoint:

```
GET /api/user (requires authentication)
```

## Security Features

- CSRF protection on all forms
- Password hashing with bcrypt
- Session-based authentication
- Google OAuth integration
- File upload validation (max 2MB, jpeg/png/jpg/gif only)
- SQL injection protection via Eloquent ORM
- XSS protection via Blade escaping

## Development Team

**Kelompok 10 — Teknik Informatika, Politeknik Caltex Riau**

| Name | Student ID | Role |
|------|-----------|------|
| **Mohamad Haziq Dafren** | 2355301119 | **Team Lead** — Backend Development, Business Logic, Database Architecture, API Integration |
| Luthfiah Rahmi | - | Frontend Development, Profile UI, Documentation |
| Muhammad Atha Ananda | - | Frontend Development, Add Data UI, Documentation |
| Nazwa Salsabila Halim | - | Frontend Development, Package Data UI, Documentation |
| Siti Solikhah | - | Frontend Development, History UI, Documentation |

**Supervisor:** Mutia Sari Zulvi, S.S.T., M.M.SI
**Lab Instructor:** Muhammad Anwar, S.Tr.Kom

## Screenshots

*Add screenshots of your application here:*

- Login page
- Dashboard with package statistics
- Package data table
- Add package form
- History view
- Package tracking page

## Future Enhancements

- [ ] Email notifications as alternative to WhatsApp
- [ ] SMS notifications
- [ ] QR code generation for packages
- [ ] Mobile app (Android/iOS)
- [ ] Advanced analytics dashboard
- [ ] Multi-campus support
- [ ] Package barcode scanning
- [ ] Export data to PDF/Excel

## License

This project was developed as academic coursework at Politeknik Caltex Riau. All rights reserved.

## Acknowledgments

- Politeknik Caltex Riau for project support
- Laravel community for excellent documentation
- Bootstrap team for the UI framework

---

**📦 Built with Laravel 11 — TA 2024/2025**
