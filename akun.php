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

$title = 'Akun';

include 'layout/header.php';

$data_akun = select("SELECT * FROM akun ORDER BY id_akun DESC");

?>

        <div class="container mt-5"> 
            <h1>Akun</h1>
            <hr>

            <a href="tambah-akun.php" class="btn btn-primary mb-3" style="float: right;">Tambah</a>

            <table class="table table-bordered table-striped mt-3">
                <thead class="table-dark" id="example">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data_akun as $akun) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $akun['nama_akun']; ?></td>
                                <td><?= $akun['username']; ?></td>
                                <td><?= $akun['email']; ?></td>
                                <td>Password Ter-enskripsi</td>
                                <td width="15%" class="text-center">
                                    <a href="ubah-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-success">Ubah</a>
                                    <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger" onclick = "return confirm('Yakin data akun akan dihapus')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>    
        </div>

<?php
include 'layout/footer.php';
?>