<?php
session_start();  

if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login terlebih dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

$title = 'Detail Kategori';

include 'layout/header.php';

$id_kategori = (int)$_GET['id_kategori'];

$kategori = selectSingle("SELECT * FROM kategori WHERE id_kategori = $id_kategori");

// Mengambil semua toko yang menjual barang dari kategori ini
$query_toko_barang = "SELECT toko.nama_toko, barang.nama_barang 
                    FROM toko 
                    JOIN barang ON toko.id_toko = barang.id_toko 
                    WHERE barang.id_kategori = $id_kategori";
$toko_barang = selectAll($query_toko_barang);
?>

<div class="container mt-5"> 
    <h1><?= $kategori['nama_kategori']; ?></h1>
    <hr>

    <table class="table table-bordered table-striped mt-3">
        <tr>
            <td><b>ID Kategori</b></td>
            <td><?= $kategori['id_kategori']?></td>
        </tr>
        <tr>
            <td><b>Nama Kategori</b></td>
            <td><?= $kategori['nama_kategori']?></td>
        </tr>
    </table>

    <h2>Daftar Barang dari Kategori Ini</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Toko</th>
                    <th>Nama Barang</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop untuk menampilkan daftar toko dan barang -->
                <?php $nomor = 1; ?>
                <?php foreach ($toko_barang as $item): ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $item['nama_toko']?></td>
                        <td><?= $item['nama_barang']?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="kategori.php" class="btn btn-secondary btn-sm" style="float: right;">Kembali</a>
</div>

<?php include 'layout/footer.php'; ?>