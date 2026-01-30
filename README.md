## Deskripsi umum
Sistem ini adalah aplikasi berbasis web yang dibangun menggunakan bahasa pemrograman PHP (Native/Vanilla) dengan pola arsitektur MVC sederhana (Model-View-Controller) untuk memisahkan logika database, logika aplikasi, dan tampilan. Antarmuka pengguna (UI) dirancang menggunakan framework Bootstrap 5 agar responsif dan modern.
## Fitur dan Fungsi Sistem
Sistem ini membagi hak akses menjadi dua aktor utama, yaitu Masyarakat (User) dan Administrator (Admin). Berikut adalah rincian fitur berdasarkan aktor:
### Aktor: Masyarakat (Warga)
- Login: Masuk ke dalam sistem menggunakan akun yang terdaftar.
- Dashboard User: Melihat ringkasan laporan pribadi.
- Buat Pengaduan (CRUD - Create): Mengisi form pengaduan yang terdiri dari isi laporan dan unggah bukti foto.
- Pantau Status (CRUD - Read): Melihat daftar riwayat laporan beserta status terkini (Pending/Proses/Selesai) dan melihat bukti foto yang telah diunggah.
- Ganti Password: Mengubah kata sandi akun untuk keamanan.
### Aktor: Administrator (Admin)
- Login: Masuk ke sistem dengan hak akses penuh.
- Dashboard Statistik: Melihat widget statistik jumlah laporan (Total, Pending, Proses, Selesai) secara real-time.
- Manajemen Laporan (CRUD - Read & Update):
⋅⋅⋅⋅* Melihat seluruh laporan masuk dari semua warga.
⋅⋅⋅⋅* Memverifikasi laporan dengan mengubah status (Verifikasi & Penugasan).
⋅⋅⋅⋅* Melihat bukti foto laporan.
- Pencarian & Filter: Mencari laporan berdasarkan kata kunci atau memfilter berdasarkan status tanpa reload halaman (menggunakan JavaScript).
- Cetak Laporan: Mencetak rekapitulasi laporan ke dalam format siap cetak (Print/PDF).
- Manajemen User (CRUD Lengkap): Menambah, melihat, dan menghapus akun user (baik admin baru maupun warga).
