<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login terlebih dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

include 'layout/header.php';

$id_pesanan = (int)$_GET['id_pesanan'];

$pesanan = select("SELECT * FROM pesanan
LEFT JOIN barang ON barang.id_barang = pesanan.id_barang
LEFT JOIN toko ON toko.id_toko = pesanan.id_toko
WHERE pesanan.id_pesanan = $id_pesanan")[0];
?>

<div class="container mt-5">
    <h1>Detail Pesanan</h1>
    <hr>

    <table class="table table-bordered table-striped mt-3">
        <tr>
            <td><b>ID Pesanan</b></td>
            <td><?= $pesanan['id_pesanan']; ?></td>
        </tr>
        <tr>
            <td><b>Nama Barang</b></td>
            <td><?= $pesanan['nama_barang']; ?></td>
        </tr>
        <tr>
            <td><b>Nama Toko</b></td>
            <td><?= $pesanan['nama_toko']; ?></td>
        </tr>
        <tr>
            <td><b>Jumlah</b></td>
            <td><?= $pesanan['jumlah']; ?></td>
        </tr>
        <tr>
            <td><b>Waktu</b></td>
            <td><?= $pesanan['waktu']; ?></td>
        </tr>
    </table>
    <a href="pesanan.php" class="btn btn-secondary btn-sm" style="float: right;">Kembali</a>
</div>

<?php
include 'layout/footer.php';
?>