# Cari Tim - Platform Pencarian Tim & Mentorship

**Cari Tim** adalah platform berbasis web yang dirancang untuk memudahkan mahasiswa dalam mencari tim untuk kompetisi atau proyek, serta membantu ketua tim dalam merekrut anggota yang tepat. Selain itu, aplikasi ini juga memfasilitasi proses mentorship antara tim mahasiswa dengan dosen pembimbing.

## 🚀 Fitur Utama

Aplikasi ini memiliki sistem role-based access control (RBAC) dengan tiga peran utama: **Mahasiswa**, **Ketua Tim**, dan **Dosen**.

### 1. 🎓 Mahasiswa

-   **Dashboard Mahasiswa**: Tampilan utama khusus mahasiswa.
-   **Jelajah Rekrutmen**: Melihat daftar rekrutmen tim yang sedang dibuka.
-   **Lamar Posisi**: Mengirim aplikasi/lamaran untuk bergabung dengan tim tertentu.
-   **Riwayat Aplikasi**: Memantau status lamaran (Pending, Diterima, Ditolak).
-   **Ganti Role**: Fitur untuk beralih peran menjadi **Ketua Tim**.

### 2. 👑 Ketua Tim

-   **Manajemen Rekrutmen**: Membuat, mengedit, dan menghapus postingan rekrutmen anggota tim.
-   **Kelola Pelamar**: Melihat daftar mahasiswa yang melamar, serta menerima atau menolak lamaran tersebut.
-   **Request Mentorship**: Mengajukan permohonan bimbingan (mentorship) kepada Dosen.
-   **Ganti Role**: Fitur untuk beralih kembali menjadi **Mahasiswa** biasa.

### 3. 👨‍🏫 Dosen

-   **Dashboard Dosen**: Memantau aktivitas terkait akademik atau tim.
-   **Manajemen Mentorship**: Menerima dan mengelola permintaan mentorship dari tim mahasiswa.

### 4. 🔐 Autentikasi & Keamanan

-   Login dan Register menggunakan sistem yang aman (Laravel Breeze).
-   Verifikasi role otomatis saat login.
-   Proteksi rute berdasarkan role (Middleware).

---

## 🛠️ Teknologi yang Digunakan

-   **Framework Backend**: [Laravel](https://laravel.com) (PHP)
-   **Frontend**: Blade Templates
-   **Styling**: [Tailwind CSS](https://tailwindcss.com)
-   **Database**: MySQL (via Eloquent ORM)
-   **Authentication**: Laravel Breeze

---

## ⚙️ Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan perangkat Anda telah terinstal:

-   [PHP](https://www.php.net/) >= 8.2
-   [Composer](https://getcomposer.org/)
-   [Node.js](https://nodejs.org/) & NPM
-   Database Server (MySQL/MariaDB)

---

## 📥 Panduan Instalasi (Development)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

1.  **Clone Repository**

    ```bash
    git clone https://github.com/username/cari_tim.git
    cd cari_tim
    ```

2.  **Install Dependensi PHP**

    ```bash
    composer install
    ```

3.  **Install Dependensi JavaScript**

    ```bash
    npm install
    ```

4.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

    Buka file `.env` dan sesuaikan konfigurasi database Anda:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate App Key**

    ```bash
    php artisan key:generate
    ```

6.  **Migrasi Database**
    Jalankan migrasi untuk membuat tabel-tabel yang diperlukan:

    ```bash
    php artisan migrate
    ```

    _(Opsional) Jika ingin mengisi data dummy:_

    ```bash
    php artisan db:seed
    ```

7.  **Jalankan Aplikasi**
    Anda perlu menjalankan dua terminal terpisah:

    -   **Terminal 1 (Laravel Server):**
        ```bash
        php artisan serve
        ```
    -   **Terminal 2 (Vite Build/Dev):**
        ```bash
        npm run dev
        ```

    Akses aplikasi melalui browser di: `http://localhost:8000`

---

## 📂 Struktur Folder Penting

Berikut adalah gambaran singkat struktur folder proyek ini untuk memudahkan pengembangan:

-   **`app/Models/`**: Definisi model database (Recruitment, Application, Mentorship, User).
-   **`app/Http/Controllers/`**: Logika utama aplikasi.
    -   `RecruitmentController.php`: Mengatur CRUD rekrutmen.
    -   `ApplicationController.php`: Mengatur proses pelamaran anggota.
    -   `GantiRoleController.php`: Logika switch role Mahasiswa <-> Ketua Tim.
    -   `MentorshipController.php`: Logika pengajuan mentorship.
-   **`resources/views/`**: File tampilan (Frontend).
    -   `layouts/`: Template dasar (header, footer, sidebar).
    -   `dashboard/`: Halaman dashboard per role.
    -   `recruitments/`: Halaman daftar dan detail rekrutmen.
-   **`routes/web.php`**: Definisi rute URL aplikasi dan middleware.

---

## 🤝 Cara Berkontribusi

1.  Fork repository ini.
2.  Buat branch fitur baru (`git checkout -b fitur-keren`).
3.  Commit perubahan Anda (`git commit -m 'Menambahkan fitur keren'`).
4.  Push ke branch (`git push origin fitur-keren`).
5.  Buat Pull Request.

---

_Kelompok Internet Rakyat - Tugas Besar Web Application Development_
