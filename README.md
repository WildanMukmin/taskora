
# ✅ Taskora - Task Organizer

## 📝 Deskripsi Proyek

**Taskora** adalah aplikasi web yang dirancang untuk membantu pengguna dan admin dalam mengelola, melacak, dan menyelesaikan tugas-tugas harian maupun akademik secara efisien. Aplikasi ini menyediakan fitur manajemen tugas dengan antarmuka yang intuitif dan mendukung alur kerja dua jenis pengguna: **Admin** dan **User (ex: Mahasiswa)**.

Dengan Taskora, pengguna dapat menambahkan tugas, menetapkan prioritas, menentukan tenggat waktu (deadline), dan memantau progresnya. Admin memiliki akses penuh untuk memonitor seluruh aktivitas dan mengelola data pengguna, kategori tugas, serta status tugas.

![screenshot-1750434399334](https://github.com/user-attachments/assets/7b41e557-b3d8-4151-a87f-0e27a6baf5a1)

---

## 🚀 Fitur Utama

### 🔹 Umum
- Desain responsif dengan Tailwind CSS.
- Navigasi yang sederhana dan ramah pengguna.
- Modal interaktif untuk proses edit tugas.

### 👤 Sebagai User (Mahasiswa)
- **Tambah & Edit Tugas**: Input judul, deskripsi, deadline, prioritas, dan kategori.
- **Tandai Tugas Selesai**: Ubah status saat tugas sudah diselesaikan.
- **Filter & Cari Tugas**: Berdasarkan status, kategori, atau prioritas.
- **Upcoming Deadlines**: Menampilkan tugas dengan deadline terdekat.
- **Edit Profil**: Ubah nama dan informasi akun secara mandiri.

### 🛠️ Sebagai Admin
- **Manajemen User**: Tambah, ubah, dan hapus akun pengguna.
- **Manajemen Semua Tugas**: Lihat dan kelola seluruh tugas pengguna.
- **Kelola Referensi Tugas**:
  - Kategori (`tasks_categories.php`)
  - Prioritas (`tasks_priorities.php`)
  - Status (`tasks_status.php`)
- **Dashboard Statistik**: Lihat ringkasan tugas dan pengguna aktif.

---

## 💻 Teknologi yang Digunakan

- **Frontend**: PHP Native, Tailwind CSS
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache (via XAMPP, Laragon)
- **JavaScript**: Untuk pop-up/modal dan interaksi UI

---

## ⚙️ Cara Instalasi

1. **Clone Repositori**
   ```bash
   git clone https://github.com/WildanMukmin/taskora.git
````

2. **Masuk ke Folder Proyek**

   ```bash
   cd taskora
   ```

3. **Konfigurasi Database**

   * Buat database baru bernama `taskora` di phpMyAdmin.
   * Import file `taskora.sql` yang tersedia di dalam folder proyek.
   * Ubah pengaturan database di `includes/config.php` sesuai environment kamu.

4. **Jalankan Server**

   * Letakkan folder ke dalam `htdocs` (XAMPP) atau `www` (Laragon).
   * Aktifkan **Apache** dan **MySQL** melalui control panel XAMPP/Laragon.

5. **Akses Aplikasi**

   * Buka browser dan kunjungi `http://localhost/taskora/index.php`.

---

## 🔐 Kredensial Default

### Admin

* Email: `admin@gmail.com`
* Password: `admin123`

### User

* Silakan daftar melalui halaman **Register**, kemudian login menggunakan akun yang telah dibuat.

---

## 📘 Panduan Penggunaan

### ✅ Sebagai User

1. Login menggunakan akun yang telah didaftarkan.
2. Akses menu **My Tasks** untuk melihat, menambah, mengedit, atau menghapus tugas.
3. Gunakan fitur **Mark as Done** untuk menandai tugas yang selesai.
4. Gunakan menu **Categories** untuk melihat dan menyaring tugas berdasarkan status, kategori, atau prioritas.
5. Gunakan **Apply Filter** untuk pencarian tugas yang lebih spesifik.
6. Akses **Upcoming Deadlines** untuk melihat tugas yang paling mendesak.
7. Edit data diri di menu **Edit Profile**.

### 🛠️ Sebagai Admin

1. Login sebagai admin dengan kredensial yang disediakan.
2. Akses halaman **Users** (`users.php`) untuk:

   * Menambahkan pengguna baru
   * Mengedit profil pengguna
   * Menghapus akun pengguna
3. Akses halaman **Tasks User** untuk melihat dan mengelola seluruh tugas pengguna.
4. Kelola referensi kategori, prioritas, dan status tugas.
5. Gunakan dashboard admin untuk melihat statistik jumlah tugas dan aktivitas user.

---

## 💡 Tips Penggunaan

* Gunakan kategori seperti *Personal*, *Work*, atau *Health* untuk pengelompokan tugas yang lebih baik.
* Admin dapat menyesuaikan jenis kategori, prioritas, dan status tugas agar sesuai dengan kebutuhan organisasi.
* Tandai tugas yang sudah selesai untuk menjaga fokus pada pekerjaan berikutnya.
* Rutin cek **Upcoming Deadlines** untuk menghindari keterlambatan.

---

## 👨‍💻 Kontributor

1. **Clara Monica** – [GitHub](https://github.com/ClaraaMon0o0)
2. **Luthfia Rahma Sholihah** – [GitHub](https://github.com/Luthfiaa1407)
3. **Wildan Mukmin** – [GitHub](https://github.com/WildanMukmin)

---

