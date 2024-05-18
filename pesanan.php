<?php
session_start();

// Pastikan login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login terlebih dahulu');
            document.location.href = 'login.php';
        </script>";
    exit;
}

include 'layout/header.php';

// Query pesanan dengan join tabel barang dan toko
$query = mysqli_query($db, "SELECT pesanan.id_pesanan, barang.nama_barang, toko.nama_toko, pesanan.jumlah, pesanan.waktu 
                            FROM pesanan
                            LEFT JOIN barang ON barang.id_barang = pesanan.id_barang
                            LEFT JOIN toko ON toko.id_toko = barang.id_toko");
while ($record = mysqli_fetch_array($query)){
    $result[] = $record;
}
?>

<div class="container mt-5"> 
    <h1>Pesanan</h1>
    <hr>

    <div class="container" style="text-align: right;">
        <a href="tambah-pesanan.php" class="btn btn-primary mb-3">Tambah</a>
    </div>   

    <table class="table table-bordered table-striped mt-3" id="shoesheaven">
        <thead class="table-dark">
            <tr>
                <th>Id pesanan</th>
                <th>Nama Barang</th>
                <th>Nama Toko</th>
                <th>Jumlah</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $pesanan) : ?>
                <tr>
                    <td style="min-width: 20px;"><?= $pesanan['id_pesanan']; ?></td>
                    <td><?= $pesanan['nama_barang']; ?></td>
                    <td><?= $pesanan['nama_toko']; ?></td>
                    <td><?= $pesanan['jumlah']; ?></td>
                    <td><?= $pesanan['waktu']; ?></td>
                    <td width="15%" class="text-center">
                        <a href="detail-pesanan.php?id_pesanan=<?= $pesanan['id_pesanan'];?>" class="btn btn-secondary btn-sm">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>