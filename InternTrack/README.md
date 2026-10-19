# InternTrack
Sistem monitoring PKL siswa (PHP + MySQL)

## Cara jalanin di lokal (XAMPP / Laragon)
1. Copy folder InternTrack ke htdocs (XAMPP) atau www (Laragon)
2. Nyalain Apache + MySQL
3. Buka phpMyAdmin → Import → pilih `database/interntrack.sql`
4. Buka http://localhost/InternTrack/

## Cara upload ke InfinityFree
1. Daftar / login di infinityfree.com, buat akun hosting + domain
2. Di control panel:
   - Buat **MySQL Database** (catat: Host, Database name, Username, Password)
   - Host biasanya mirip: `sqlXXX.infinityfree.com` (bukan localhost)
3. Buka phpMyAdmin dari panel InfinityFree
   - Pilih database yang baru dibuat
   - Tab **Import** → pilih file `database/interntrack_hosting.sql` → Go
4. Edit file `config/koneksi.php`, ganti isinya sesuai data MySQL dari panel:
   ```
   $DB_HOST = 'sqlXXX.infinityfree.com';
   $DB_NAME = 'if0_xxxxxxx_namadb';
   $DB_USER = 'if0_xxxxxxx';
   $DB_PASS = 'password_mysql_kamu';
   ```
5. Upload semua file (kecuali folder docs kalau mau) lewat File Manager atau FTP ke folder `htdocs`
6. Buka domain kamu, contoh: `https://namasitus.infinityfreeapp.com/`

## Akun demo
| Role | Username | Password |
|------|----------|----------|
| Admin | admin | admin123 |
| Pembimbing | pembimbing1 s/d 10 | password |
| Siswa | NIS (contoh: 2026001) | password |

## Catatan InfinityFree
- Pakai file SQL yang **interntrack_hosting.sql** (bukan yang ada CREATE DATABASE)
- Host database **bukan** localhost
- Kalau muncul "Koneksi database gagal", cek lagi isi `config/koneksi.php`
- Folder `config` dan `database` sudah dilindungi .htaccess

Dokumentasi lengkap: `docs/DOKUMENTASI.md`
