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

$title = 'Ubah toko';

include 'layout/header.php';

$id_toko = (int)$_GET['id_toko'];

$toko = select("SELECT * FROM toko WHERE id_toko = $id_toko")[0];

//cek tombol tambah
if (isset($_POST['ubah'])) {
    if (update_toko($_POST) > 0){
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'toko.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'toko.php';
        </script>";
    }
}

?>

<div class="container mt-5"> 
    <h1>Ubah toko</h1>
    <hr>

    <form action=""method="post">

        <input type="hidden" name="id_toko" value="<?= $toko['id_toko']; ?>">

        <div class="mb-3">
            <label for="nama_toko" class="form-label">Nama Toko</label>
            <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="<?= $toko['nama_toko']; ?>" placeholder="Nama" required>
        </div>


        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>

    </form>
</div>

<?php
include 'layout/footer.php';
?>