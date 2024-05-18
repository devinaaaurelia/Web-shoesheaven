<?php

session_start();   

//pembatas hlmn login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login terlebih dahulu');
            document.location.href = 'login.php';
        </script>";
    exit;
}

include 'layout/header.php';

//query barang dengan join tabel barang dan toko
$query = mysqli_query($db, "SELECT * FROM barang
LEFT JOIN toko ON toko.id_toko = barang.id_toko
LEFT JOIN kategori ON kategori.id_kategori = barang.id_kategori");
while ($record = mysqli_fetch_array($query)){
    $result[] = $record;
}

?>

        <div class="container mt-5"> 
            <h1>Barang</h1>
            <hr>

            <div class="container" style="text-align: right;">
                <a href="tambah-barang.php" class="btn btn-primary mb-3">Tambah</a>
            </div>   

            <table class="table table-bordered table-striped mt-3" id="shoesheaven">
                <thead class="table-dark">
                    <tr>
                        <th>Id Barang</th>
                        <th>Nama Barang</th>
                        <th>Toko</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php foreach ($query as $barang) : ?>
                            <tr>
                                <td style="min-width: 20px;"><?= $barang['id_barang']; ?></td>
                                <td style="min-width: 20px;"><?= $barang['nama_barang']; ?></td>
                                <td><?= $barang['nama_toko']; ?></td>
                                <td><?= $barang['nama_kategori']; ?></td>
                                <td>Rp. <?= number_format($barang['harga'],0,',','.'); ?></td>
                                <td width="15%" class="text-center">
                                    <div style="display: flex; justify-content: space-around;">
                                        <a href="detail-barang.php?id_barang=<?= $barang['id_barang'];?>" class="btn btn-secondary btn-sm">Detail</a>
                                        <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success btn-sm" style="margin: 0 5px;">Ubah</a>
                                        <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin data barang akan dihapus')" style="margin: 0 5px;">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
        </div>

<?php
include 'layout/footer.php';
?>