<?php
require __DIR__ . '/../config/koneksi.php';
$base = '../';
wajib_login(['admin', 'pembimbing'], $base);
$judul = 'Skenario Uji Coba';

// ambil 1 siswa contoh buat demo
$contoh = $pdo->query("SELECT id, nis, nama FROM siswa ORDER BY id LIMIT 1")->fetch();
$nis_contoh = $contoh ? $contoh['nis'] : '2026001';
$nama_contoh = $contoh ? $contoh['nama'] : 'Contoh Siswa';
$id_contoh = $contoh ? $contoh['id'] : 1;

include __DIR__ . '/../config/header.php';
?>

<style>
.uji-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 14px;
    margin-top: 10px;
}
.uji-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 14px 16px;
    border-left: 5px solid #1b7a4b;
}
.uji-card.merah { border-left-color: #c0392b; }
.uji-card.kuning { border-left-color: #d68910; }
.uji-card.biru { border-left-color: #2980b9; }
.uji-card h4 {
    margin: 0 0 6px;
    font-size: 15px;
}
.uji-card .skenario {
    font-size: 13px;
    color: #555;
    margin-bottom: 8px;
}
.uji-card .hasil {
    font-size: 12px;
    background: #f4f9f6;
    padding: 6px 8px;
    border-radius: 4px;
    margin-bottom: 10px;
}
.uji-card .btn { margin-right: 4px; margin-bottom: 4px; }
.uji-info {
    background: #fff8e6;
    border: 1px solid #f0d78c;
    padding: 12px 14px;
    border-radius: 6px;
    margin-bottom: 16px;
    font-size: 14px;
}
</style>

<div class="uji-info">
    <b>Cara pakai:</b> Klik tombol di bawah sesuai skenario yang diminta penguji.
    Halaman tujuan akan terbuka, data contoh sudah disiapkan biar tinggal klik Simpan / lihat hasil.
    <br>Akun demo: <b>admin / admin123</b> &nbsp;|&nbsp; Siswa: <b><?= e($nis_contoh) ?> / password</b>
</div>

<div class="uji-grid">

    <!-- 1 -->
    <div class="uji-card biru">
        <h4>1. Login – Username benar</h4>
        <div class="skenario">Username & password benar</div>
        <div class="hasil">Expected: Berhasil login → masuk dashboard</div>
        <a class="btn kecil" href="<?= $base ?>auth/logout.php">Logout dulu</a>
        <a class="btn kecil biru" href="<?= $base ?>auth/login.php">Buka Login</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Isi: <b>admin</b> / <b>admin123</b> lalu Login</p>
    </div>

    <!-- 2 -->
    <div class="uji-card merah">
        <h4>2. Login – Password salah</h4>
        <div class="skenario">Username benar, password salah</div>
        <div class="hasil">Expected: Login ditolak (muncul pesan error)</div>
        <a class="btn kecil" href="<?= $base ?>auth/logout.php">Logout dulu</a>
        <a class="btn kecil biru" href="<?= $base ?>auth/login.php">Buka Login</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Isi: <b>admin</b> / <b>salah123</b> lalu Login</p>
    </div>

    <!-- 3 -->
    <div class="uji-card">
        <h4>3. Siswa – Tambah data lengkap</h4>
        <div class="skenario">Isi semua field dengan benar</div>
        <div class="hasil">Expected: Data tersimpan</div>
        <a class="btn kecil biru" href="siswa.php?aksi=tambah&demo=lengkap">Buka Form + Data Contoh</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Tinggal klik <b>Simpan</b></p>
    </div>

    <!-- 4 -->
    <div class="uji-card kuning">
        <h4>4. Siswa – NIS kosong</h4>
        <div class="skenario">NIS dikosongkan</div>
        <div class="hasil">Expected: Muncul validasi</div>
        <a class="btn kecil kuning" href="siswa.php?aksi=tambah&demo=nis_kosong">Buka Form (NIS kosong)</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Langsung klik <b>Simpan</b> → muncul error</p>
    </div>

    <!-- 5 -->
    <div class="uji-card merah">
        <h4>5. Siswa – NIS duplikat</h4>
        <div class="skenario">NIS yang sudah ada</div>
        <div class="hasil">Expected: Data ditolak</div>
        <a class="btn kecil merah" href="siswa.php?aksi=tambah&demo=nis_duplikat">Buka Form (NIS duplikat)</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">NIS sudah terpakai: <b><?= e($nis_contoh) ?></b></p>
    </div>

    <!-- 6 -->
    <div class="uji-card">
        <h4>6. Jurnal – Input jurnal</h4>
        <div class="skenario">Isi jurnal kegiatan</div>
        <div class="hasil">Expected: Data tersimpan</div>
        <a class="btn kecil" href="<?= $base ?>auth/logout.php">Logout</a>
        <a class="btn kecil biru" href="<?= $base ?>auth/login.php">Login sebagai Siswa</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">
            Login: <b><?= e($nis_contoh) ?> / password</b><br>
            Lalu buka menu <b>Jurnal</b> → isi → Simpan
        </p>
    </div>

    <!-- 7 -->
    <div class="uji-card">
        <h4>7. Absensi – Input hadir</h4>
        <div class="skenario">Input status Hadir</div>
        <div class="hasil">Expected: Data tersimpan</div>
        <a class="btn kecil biru" href="absensi.php?demo=hadir">Buka Form Absensi</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Pilih siswa → Status <b>Hadir</b> → Simpan</p>
    </div>

    <!-- 8 -->
    <div class="uji-card biru">
        <h4>8. Absensi – Rekap kehadiran</h4>
        <div class="skenario">Lihat rekap & persentase</div>
        <div class="hasil">Expected: Persentase muncul</div>
        <a class="btn kecil biru" href="absensi.php#rekap">Lihat Rekap Kehadiran</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Scroll ke tabel rekap, kolom Persentase & Status</p>
    </div>

    <!-- 9 -->
    <div class="uji-card">
        <h4>9. Monitoring – Input nilai</h4>
        <div class="skenario">Input catatan + nilai</div>
        <div class="hasil">Expected: Data tersimpan</div>
        <a class="btn kecil biru" href="monitoring.php?demo=nilai">Buka Form Monitoring</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Pilih siswa → isi catatan & nilai → Simpan</p>
    </div>

    <!-- 10 -->
    <div class="uji-card biru">
        <h4>10. Search – Cari nama siswa</h4>
        <div class="skenario">Cari nama siswa</div>
        <div class="hasil">Expected: Data sesuai tampil</div>
        <a class="btn kecil biru" href="siswa.php?q=<?= urlencode(explode(' ', $nama_contoh)[0]) ?>">Cari "<?= e(explode(' ', $nama_contoh)[0]) ?>"</a>
        <p style="font-size:12px;margin:8px 0 0;color:#555">Langsung muncul hasil pencarian</p>
    </div>

</div>

<p style="margin-top:20px;font-size:13px;color:#666">
    Tip: Kalau penguji minta skenario lain, cukup buka menu terkait dan ikuti alurnya.
    Halaman ini cuma bantu biar cepat pas ujian.
</p>

<?php include __DIR__ . '/../config/footer.php'; ?>
