## Deskripsi umum
Sistem ini adalah aplikasi berbasis web yang dibangun menggunakan bahasa pemrograman PHP (Native/Vanilla) dengan pola arsitektur MVC sederhana (Model-View-Controller) untuk memisahkan logika database, logika aplikasi, dan tampilan. Antarmuka pengguna (UI) dirancang menggunakan framework Bootstrap 5 agar responsif dan modern.
## Fitur dan Fungsi Sistem
Sistem ini membagi hak akses menjadi dua aktor utama, yaitu Masyarakat (User) dan Administrator (Admin). Berikut adalah rincian fitur berdasarkan aktor:
### Aktor: Masyarakat (Warga)
1. Login: Masuk ke dalam sistem menggunakan akun yang terdaftar.
2. Dashboard User: Melihat ringkasan laporan pribadi.
3. Buat Pengaduan (CRUD - Create): Mengisi form pengaduan yang terdiri dari isi laporan dan unggah bukti foto.
4. Pantau Status (CRUD - Read): Melihat daftar riwayat laporan beserta status terkini (Pending/Proses/Selesai) dan melihat bukti foto yang telah diunggah.
5. Ganti Password: Mengubah kata sandi akun untuk keamanan.
### Aktor: Administrator (Admin)
1. Login: Masuk ke sistem dengan hak akses penuh.
2. Dashboard Statistik: Melihat widget statistik jumlah laporan (Total, Pending, Proses, Selesai) secara real-time.
3. Manajemen Laporan (CRUD - Read & Update):
⋅⋅⋅⋅* Melihat seluruh laporan masuk dari semua warga.
⋅⋅⋅⋅* Memverifikasi laporan dengan mengubah status (Verifikasi & Penugasan).
⋅⋅⋅⋅* Melihat bukti foto laporan.
4. Pencarian & Filter: Mencari laporan berdasarkan kata kunci atau memfilter berdasarkan status tanpa reload halaman (menggunakan JavaScript).
5. Cetak Laporan: Mencetak rekapitulasi laporan ke dalam format siap cetak (Print/PDF).
6. Manajemen User (CRUD Lengkap): Menambah, melihat, dan menghapus akun user (baik admin baru maupun warga).
