# Workout Planner - Project UAS Pemrograman Web

## Identitas

- **Nama:** Daffa Abdurrahman Jatmiko
- **NIM:** 121140181
- **Username GitHub:** DaffaJatmiko

## Deskripsi Proyek

Proyek ini merupakan implementasi sistem perencanaan latihan (Workout Planner) berbasis web. Pengguna dapat menambah, mengedit, dan menghapus jadwal latihan mereka. Proyek ini menggunakan kombinasi pemrograman sisi klien dan sisi server, dengan JavaScript dan PHP sebagai teknologi utama.

## Link Halaman Web

- [Workout Planner Web](https://workoutplanner-121140181-uas-pemweb.000webhostapp.com/)

## Bagian 1: Client-side Programming (Bobot: 30%)

### 1.1 Halaman Web Sederhana

- Halaman web sederhana dibuat dalam file `index.php`.
- Mengimplementasikan JavaScript untuk memanipulasi DOM di bagian index.php, yang berfungsi untuk mengubah mode tampilan halaman antara dark mode dan light mode.
- Menampilkan form input dengan 4 elemen pada file `create.php` dan `edit.php`.
- Menampilkan data dari server menggunakan tag table pada file `index.php`.

### 1.2 Event Handling

- Terdapat 3 event untuk menghandle form pada `index.php`.
- Implementasi JavaScript untuk validasi input sebelum diproses oleh PHP pada file `edit.php` dan `create.php`.

## Bagian 2: Server-side Programming (Bobot: 30%)

### 2.1 Script PHP untuk Pengolahan Data

- Menggunakan `$_POST` pada semua file, termasuk `index.php`, `create.php`, `login.php`, `register.php`, `edit.php`.
- Penggunaan `$_GET` terdapat di file `edit.php` untuk memanggil data dari database.
- Menampilkan hasil pengolahan data ke halaman `index.php`.

### 2.2 Objek PHP Berbasis OOP

- Membuat objek PHP OOP dalam file `workout.php` yang terdapat 2 method yang nantinya akan di panggil dan digunakan oleh file `create.php` dan `edit.php`.

## Bagian 3: Database Management (Bobot: 20%)

### 3.1 Tabel pada Database MySQL

- Membuat tabel pada database MySQL untuk menyimpan jadwal latihan dan informasi user.
- Langkah-langkah pembuatan basis data dengan syntax basis data seperti pada file `workout_planner.sql`.

### 3.2 Konfigurasi Koneksi ke Database

- Konfigurasi koneksi ke database MySQL dilakukan di file `index.php`, `create.php`, `edit.php`, `login.php`, dan `register.php`.

### 3.3 Manipulasi Data pada Tabel Database

- Melakukan manipulasi data pada tabel database dengan query SQL pada file `create.php`, `edit.php`, `register.php`, dan `delete.php`.
- Jenis manipulasi data yang diimplementasikan melibatkan penambahan, pembaruan, dan penghapusan entitas pada tabel database.

## Bagian 4: State Management (Bobot: 20%)

### 4.1 Skrip PHP dengan Session

- Menggunakan session PHP untuk menyimpan dan mengelola state pengguna pada `index.php`, `create.php`, `edit.php`, dan `login.php`.

### 4.2 Pengelolaan State menggunakan Cookie dan Browser Storage

- Implementasi pengelolaan state menggunakan cookie dan browser storage dengan JavaScript pada `index.php`, `create.php`, dan `edit.php`.
- Contoh penggunaan cookie untuk menyimpan data formulir pada `create.php`.

## Bonus: Hosting Aplikasi Web (Bobot Tambahan: 20%)

### Langkah-langkah Meng-host Aplikasi Web

1. **Pendaftaran Akun:**

   - Mendaftar dan membuat akun di 000webhost.

2. **Upload File:**

   - Meng-upload semua file proyek, termasuk file PHP, HTML, CSS, dan JavaScript ke dalam direktori yang sesuai di 000webhost melalui FTP atau File Manager.

3. **Database:**

   - Membuat database di panel 000webhost dan menghubungkannya dengan aplikasi web.

4. **Konfigurasi Koneksi Database:**

   - Memastikan konfigurasi koneksi database pada file PHP (seperti `index.php`, `create.php`, dan `edit.php`) sesuai dengan informasi database di 000webhost.

5. **Testing:**
   - Melakukan testing untuk memastikan aplikasi berjalan dengan baik setelah di-hosting.

### Pemilihan Penyedia Hosting Web

Saya memilih 000webhost karena:

- **Gratis:** 000webhost menyediakan layanan hosting gratis dengan ruang penyimpanan yang memadai untuk proyek web skala kecil hingga menengah.
- **Mudah Digunakan:** Antarmuka pengguna 000webhost mudah dipahami dan ramah pengguna, cocok untuk pengguna pemula.

- **Dukungan PHP dan MySQL:** 000webhost mendukung PHP dan MySQL, sesuai dengan teknologi yang saya gunakan dalam proyek ini.

### Keamanan Aplikasi Web

Beberapa langkah yang saya terapkan untuk memastikan keamanan aplikasi web:

- **Update Reguler:** Melakukan pembaruan reguler pada aplikasi dan platform yang digunakan.

- **Validasi Input:** Mengimplementasikan validasi input pada sisi klien dan sisi server untuk mencegah serangan injeksi.

- **Enkripsi Koneksi:** Menggunakan protokol HTTPS untuk mengamankan komunikasi antara klien dan server.

### Konfigurasi Server

Konfigurasi server yang mendukung aplikasi web ini telah disesuaikan oleh penyedia layanan web hosting, 000webhost. Beberapa aspek konfigurasi yang mencakup:

- **PHP Version:** Menggunakan versi PHP yang sesuai dengan kebutuhan aplikasi.

- **File Permissions:** Menetapkan izin file dan direktori yang tepat untuk memastikan keamanan dan konsistensi.

- **Memory Limit:** Menyesuaikan batas memori PHP sesuai dengan kebutuhan aplikasi.

- **Error Handling:** Mengatur penanganan kesalahan untuk memudahkan pemecahan masalah.
