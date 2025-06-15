# Laravel Hosting Deployment Guide

## Persiapan File untuk Hosting

### 1. File Environment (.env)

-   ✅ `.env` - File konfigurasi lokal
-   ✅ `.env.production` - File konfigurasi untuk produksi
-   ⚠️ **JANGAN upload file .env asli ke hosting!**

### 2. File Konfigurasi

-   ✅ `.htaccess` - Untuk Apache server
-   ✅ Konfigurasi telah di-cache untuk optimasi

### 3. Assets

-   ✅ Assets sudah di-build untuk produksi
-   ✅ File CSS dan JS ada di `public/build/`

## Langkah-langkah Hosting:

### A. Jika menggunakan Shared Hosting (cPanel):

1. **Upload Files:**

    ```
    - Upload semua file KECUALI folder vendor/
    - Pindahkan isi folder public/ ke public_html/
    - Sisa folder (app, config, database, dll) taruh di luar public_html/
    ```

2. **Update index.php:**
   Edit file `public_html/index.php`:

    ```php
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    ```

3. **Install Dependencies:**

    ```bash
    composer install --optimize-autoloader --no-dev
    ```

4. **Setup Database:**

    - Buat database MySQL di cPanel
    - Update file .env dengan detail database
    - Jalankan migrasi: `php artisan migrate --force`

5. **Set Permissions:**
    ```bash
    chmod -R 755 storage/
    chmod -R 755 bootstrap/cache/
    ```

### B. Jika menggunakan VPS/Cloud:

1. **Clone Repository:**

    ```bash
    git clone [your-repo] /var/www/html/your-app
    cd /var/www/html/your-app
    ```

2. **Install Dependencies:**

    ```bash
    composer install --optimize-autoloader --no-dev
    npm install
    npm run build
    ```

3. **Setup Environment:**

    ```bash
    cp .env.production .env
    php artisan key:generate
    ```

4. **Database & Cache:**

    ```bash
    php artisan migrate --force
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

5. **Web Server Configuration (Nginx/Apache):**
    - Document root: `/var/www/html/your-app/public`
    - PHP version: 8.2+

## File yang HARUS diupdate sebelum hosting:

1. **`.env` atau `.env.production`:**

    ```env
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://yourdomain.com

    DB_HOST=your_host
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

2. **Database:**
    - Backup database lokal jika ada data penting
    - Siapkan database di hosting provider

## Checklist Hosting:

-   [ ] Upload semua file (kecuali vendor/ jika shared hosting)
-   [ ] Install composer dependencies
-   [ ] Setup database connection
-   [ ] Run migrations
-   [ ] Set proper file permissions
-   [ ] Update .env file
-   [ ] Test aplikasi

## Troubleshooting:

-   Jika error 500: Cek file permissions dan .env
-   Jika CSS/JS tidak load: Cek path dan build assets
-   Jika database error: Cek koneksi database di .env
