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

$title = 'Kategori';

include 'layout/header.php';

$data_kategori = select("SELECT * FROM kategori ORDER BY id_kategori DESC");

?>

        <div class="container mt-5"> 
            <h1>Kategori</h1>
            <hr>

            <div class="container" style="text-align: right;">
                <a href="tambah-kategori.php" class="btn btn-primary mb-3">Tambah</a>
            </div>

            <table class="table table-bordered table-striped mt-3" id="shoesheaven">
                <thead class="table-dark" id="example">
                    <tr>
                        <th>Id Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php foreach ($data_kategori as $kategori) : ?>
                            <tr>
                                <td><?= $kategori['id_kategori']; ?></td>
                                <td><?= $kategori['nama_kategori']; ?></td>
                                <td width="20%" class="text-center">  
                                    <a href="detail-kategori.php?id_kategori=<?= $kategori['id_kategori'];?>" class="btn btn-secondary btn-sm">Detail</a>
                                    <a href="ubah-kategori.php?id_kategori=<?= $kategori['id_kategori']; ?>" class="btn btn-success btn-sm">Ubah</a>
                                    <a href="hapus-kategori.php?id_kategori=<?= $kategori['id_kategori']; ?>" class="btn btn-danger" onclick = "return confirm('Yakin data kategori akan dihapus')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
            </table>
        </div>

<?php
include 'layout/footer.php';
?>