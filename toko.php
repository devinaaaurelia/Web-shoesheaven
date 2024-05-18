<?php

session_start();  

//pembatas hlmn login

if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login terlebih dahulu');
    document.location.href = 'login.php';
    </script>";
exit;
}

$title = 'Toko';

include 'layout/header.php';

$data_toko = select("SELECT * FROM toko ORDER BY id_toko DESC");

?>

<div class="container mt-5"> 
            <h1>Toko</h1>
            <hr>
            <div class="container" style="text-align: right;">
                <a href="tambah-toko.php" class="btn btn-primary mb-3">Tambah</a>
            </div>

            <table class="table table-bordered table-striped mt-3" id="shoesheaven">
                <thead class="table-dark">
                    <tr>
                        <th>Id Toko</th>
                        <th>Nama Toko</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php foreach ($data_toko as $toko) : ?>
                        <tr>
                            <td><?= $toko['id_toko']; ?></td>
                            <td><?= $toko['nama_toko']; ?></td>
                            <td width="20%" class="text-center">
                                <a href="detail-toko.php?id_toko=<?= $toko['id_toko'];?>" class="btn btn-secondary btn-sm">Detail</a>

                                <a href="ubah-toko.php?id_toko=<?= $toko['id_toko']; ?>" class="btn btn-success btn-sm">Ubah</a>

                                <a href="hapus-toko.php?id_toko=<?= $toko['id_toko']; ?>" class="btn btn-danger" onclick = "return confirm('Yakin data toko akan dihapus')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
            </table>
        </div>

<?php
include 'layout/footer.php';
?>