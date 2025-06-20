```markdown
# ✅ Taskora - Task Organizer

## 📝 Deskripsi Proyek

**Taskora** adalah aplikasi web yang dirancang untuk membantu pengguna dan admin dalam mengelola, melacak, dan menyelesaikan tugas-tugas harian maupun akademik secara efisien. Aplikasi ini menyediakan fitur manajemen tugas dengan antarmuka yang intuitif dan mendukung alur kerja dua jenis pengguna: **Admin** dan **User (ex: Mahasiswa)**.

Dengan Taskora, pengguna dapat menambahkan tugas, menetapkan prioritas, menentukan tenggat waktu (deadline), dan memantau progresnya. Admin memiliki akses penuh untuk memonitor seluruh aktivitas dan mengelola data pengguna, kategori tugas, serta status tugas.

![image](https://github.com/user-attachments/assets/525e352d-5dd8-47ea-89ee-5633beede1ce)

---

## 🚀 Fitur Utama

### 🔹 Umum

- Responsive design berbasis Tailwind CSS.
- Navigasi sederhana dan pengalaman pengguna yang ramah.

### 👤 Sebagai User

- **Tambah & Edit Tugas**: Isi judul, deskripsi, deadline, prioritas, dan kategori.
- **Tandai Tugas Selesai**: Ubah status tugas ketika sudah diselesaikan.
- **Lihat Tugas Milik Sendiri**: Filter berdasarkan kategori, prioritas, atau tanggal.
- **Upcoming Deadlines**: Tampilkan tugas yang paling mendekati tenggat waktu.
- **Edit Profil**: Ubah informasi pribadi secara mandiri.

### 🛠️ Sebagai Admin

- **Manajemen User**: Tambah, ubah, dan hapus akun pengguna.
- **Manajemen Semua Tugas**: Lihat dan kelola semua tugas dari seluruh pengguna.
- **Manajemen Referensi**:
  - Kategori tugas (`tasks_categories.php`)
  - Prioritas tugas (`tasks_priorities.php`)
  - Status tugas (`tasks_status.php`)
- **Edit Data Tugas Secara Global**
- **Akses Dashboard Admin**: Statistik, rekap tugas, dan data pengguna.

---

## 💻 Teknologi yang Digunakan

- **Frontend**: PHP Native, Tailwind CSS
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache (via XAMPP, Laragon, dsb.)
- **JavaScript**: Untuk fitur interaktif seperti pop-up/modal

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

3. **Atur Database**

   * Buat database baru di MySQL, misalnya: `taskora`.
   * Import file `taskora.sql`yang tersedia.
   * Edit konfigurasi koneksi database di `includes/config.php`.

4. **Jalankan Server**

   * Letakkan folder ke dalam `htdocs` (jika pakai XAMPP) dan 'www' (jika pakai Laragon).
   * Aktifkan **Apache** dan **MySQL** di XAMPP/Laragon.

5. **Akses Aplikasi**

   * Buka browser dan akses `http://localhost/taskora/index.php`.

---

## 🔐 Kredensial Default

### Admin:

* Email: `admin@gmail.com`
* Password: `admin123`

### User:

* Silahkan registrasi terlebuh dahulu dan login dengan akun yang sudah Anda daftar.

---

## 📘 Panduan Penggunaan

### ✅ Sebagai User

1. **Masuk** ke akun Anda.
2. Buka halaman **My Tasks** (`my_tasks.php`).
3. Tambah tugas melalui **Add Task**.
4. Gunakan **edit**, **delete**, dan **mark as done** untuk mengelola tugas.
5. Cek **Upcoming Deadlines** untuk melihat tugas yang mendekati deadline.
6. Gunakan menu **categories** untuk melihat semua kategori tugas anda berdasarkan status, prioritas, dan kategori.
7. Terapkan **Apply Filter** untuk mencari tugas berdasarkan status, kategori, dan prioritas.
8. Ubah data pribadi Anda di **Edit Profile**.

### 🛠️ Sebagai Admin

1. Login sebagai admin.
2. Kelola pengguna di `users.php`:

   * Tambah user baru.
   * Edit profil user.
   * Hapus akun yang tidak aktif.
3. Kelola semua tugas pengguna di `tasks_user.php`.
4. Kelola kategori, status, dan prioritas tugas.
5. Pantau statistik tugas dari halaman `dashboard.php`.

---

## 💡 Tips Penggunaan

* Gunakan kategori seperti *Personal*, *Work*, atau *Health* untuk mengelompokkan tugas.
* Admin dapat mengelola kelompok kategori tugas untuk user.
* Tandai tugas selesai segera agar tidak menumpuk.
* Gunakan fitur **Upcoming Deadlines** sebagai acuan pengingat harian.

---

## 👨‍💻 Kontributor

1. **Clara Monica** – [GitHub](https://github.com/)
2. **Luthfia Rahma Sholihah** – [GitHub](https://github.com/)
3. **Wildan Mukmin** – [GitHub](https://github.com/)

---
