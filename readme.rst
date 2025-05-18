# Website Profil Mahasiswa dengan Dashboard Admin

Sebuah website profil mahasiswa lengkap dengan landing page responsif dan dashboard admin untuk mengelola konten. Dibangun dengan menggunakan CodeIgniter 3 dan Bootstrap 5.

<img src="images/index.png" alt="Screenshot Dashboard Admin" width="800">

## Fitur

- 💼 **Landing page profil mahasiswa responsif** yang menampilkan:
  - Profil singkat
  - Prestasi & sertifikasi
  - Riwayat pendidikan
  - Keahlian dengan visualisasi progress bar
  - Portfolio proyek
  - Formulir kontak
  
- 🔐 **Dashboard admin** dengan kemampuan:
  - Autentikasi admin (login/logout)
  - Mengelola data profil
  - Menambah/mengubah/menghapus prestasi
  - Menambah/mengubah/menghapus riwayat pendidikan
  - Menambah/mengubah/menghapus keahlian
  - Menambah/mengubah/menghapus proyek (dengan upload gambar)
  - Melihat dan mengelola pesan yang diterima
  - Mengubah password admin

- 📱 **Responsif di Semua Perangkat**
  - Tampilan yang optimal di desktop, tablet, dan mobile
  - Dashboard admin yang responsif

## Teknologi yang Digunakan

- **Backend**: CodeIgniter 3 (PHP Framework)
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: MySQL
- **Lainnya**: jQuery, Chart.js (untuk visualisasi di dashboard)

## Persyaratan Sistem

- PHP 7.3 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache, Nginx, Laragon)
- mod_rewrite diaktifkan (untuk URL yang bersih)

## Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/prassaaa/Profile_CI3.git
   cd Profile_CI3
   ```

2. **Buat database**
   - Buat database baru bernama `profil_mahasiswa`
   - Import file SQL dari `database/profil_mahasiswa.sql`

3. **Konfigurasi**
   - Buka file `application/config/config.php` dan sesuaikan `base_url`
   ```php
   $config['base_url'] = 'http://localhost/Profile_CI3/';
   ```
   
   - Buka file `application/config/database.php` dan sesuaikan konfigurasi database
   ```php
   $db['default'] = array(
       'hostname' => 'localhost',
       'username' => 'root',
       'password' => '',
       'database' => 'profil_mahasiswa',
       // ...
   );
   ```

4. **Buat folder upload**
   ```bash
   mkdir -p assets/uploads/projects
   ```
   
5. **Atur permission**
   ```bash
   chmod 777 -R assets/uploads
   chmod 777 -R application/cache
   chmod 777 -R application/logs
   ```

6. **Akses website**
   - Landing page: `http://localhost/Profile_CI3/`
   - Admin login: `http://localhost/Profile_CI3/auth/login`
   - Default admin: 
     - Username: `admin`
     - Password: `admin123`

## Struktur Folder

```
profil-mahasiswa/
├── application/             # Kode aplikasi CodeIgniter
│   ├── controllers/         # Controller untuk menangani request
│   ├── models/              # Model untuk interaksi database
│   └── views/               # View untuk tampilan
│       ├── admin/           # Template dashboard admin
│       └── landing_page.php # Template landing page
├── assets/                  # File statis
│   ├── css/                 # File CSS kustom
│   ├── js/                  # File JavaScript kustom
│   ├── images/              # Gambar statis
│   └── uploads/             # File yang diupload
│       └── projects/        # Gambar proyek
├── system/                  # Core CodeIgniter
├── database/                # File SQL untuk import database
└── .htaccess                # Konfigurasi URL rewrite
```

## Penggunaan

### Mengubah Profil

1. Login ke dashboard admin
2. Klik menu "Profil"
3. Isi formulir dengan data yang benar
4. Upload foto jika diperlukan
5. Klik "Simpan Perubahan"

### Menambah Prestasi

1. Login ke dashboard admin
2. Klik menu "Prestasi"
3. Klik tombol "Tambah Prestasi"
4. Isi formulir yang muncul
5. Klik "Simpan"

### Menambah Proyek

1. Login ke dashboard admin
2. Klik menu "Proyek"
3. Klik tombol "Tambah Proyek"
4. Isi judul, deskripsi, dan informasi lainnya
5. Upload gambar proyek
6. Klik "Simpan"

## Kontribusi

Kontribusi sangat diterima! Jika Anda ingin berkontribusi pada proyek ini:

1. Fork repository
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## Kredit

- [CodeIgniter](https://codeigniter.com/)
- [Bootstrap](https://getbootstrap.com/)
- [Font Awesome](https://fontawesome.com/)
- [Chart.js](https://www.chartjs.org/)

## Penghargaan

Terima kasih kepada:
- Dosen pembimbing saya yang telah memberikan masukan berharga
- Komunitas CodeIgniter Indonesia untuk dukungan teknis
- Semua kontributor yang telah membantu proyek ini

## Screenshot

### Landing Page
<p align="center">
  <img src="images/index.png" alt="Landing Page" width="800"><br>
  <img src="images/index1.png" alt="Landing Page" width="800"><br>
  <img src="images/index2.png" alt="Landing Page" width="800"><br>
  <img src="images/index3.png" alt="Landing Page" width="800">
</p>

### Dashboard Admin
<p align="center">
  <img src="images/dashboard.png" alt="Dashboard Admin" width="800"><br>
  <img src="images/dashboard1.png" alt="Dashboard Admin" width="800"><br>
  <img src="images/dashboard2.png" alt="Dashboard Admin" width="800"><br>
  <img src="images/dashboard3.png" alt="Dashboard Admin" width="800">
</p>

### Login Admin
<p align="center">
  <img src="images/login.png" alt="Login Admin" width="800">
</p>

---

<p align="center">
  Dibuat dengan 💙 oleh <a href="https://github.com/prassaaa">Anthonio Fernando Jose</a>
</p>
