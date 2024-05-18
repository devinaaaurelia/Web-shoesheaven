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

$id_barang = (int)$_GET['id_barang'];

$barang = select("SELECT * FROM barang
LEFT JOIN toko ON toko.id_toko = barang.id_toko
LEFT JOIN kategori ON kategori.id_kategori = barang.id_kategori
WHERE barang.id_barang = $id_barang")[0];

?>

<div class="container mt-5"> 
    <h1><?= $barang['nama_barang']; ?></h1>
    <hr>

    <table class="table table-bordered table-striped mt-3">
        <tr>
            <td><b>Id Barang</b></td>
            <td><?= $barang['id_barang']?></td>
        </tr>
        <tr>
            <td><b>Nama Barang</b></td>
            <td><?= $barang['nama_barang']?></td>
        </tr>
        <tr>
            <td><b>Toko</b></td>
            <td><?= $barang['nama_toko']?></td>
        </tr>
        <tr>
            <td><b>Kategori</b></td>
            <td><?= $barang['nama_kategori']?></td>
        </tr>
        <tr>
            <td><b>Harga</b></td>
            <td><?= $barang['harga']?></td>
        </tr>
    </table>
    <a href="kategori.php" class="btn btn-secondary btn-sm" style="float: right;">Kembali</a>
</div>

<?php
include 'layout/footer.php';
?>