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

$title = 'Tambah toko';

include 'layout/header.php';

//cek tombol tambah
if (isset($_POST['tambah'])) {
    if (create_toko($_POST)>0){
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'toko.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan');
        document.location.href = 'toko.php';
        </script>";
    }
}

?>

<div class="container mt-5"> 
    <h1>Tambah Toko</h1>
    <hr>

    <form action=""method="post">
        <div class="mb-3">
            <label for="nama_toko" class="form-label">Nama Toko</label>
            <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="Nama Toko" required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>

    </form>
</div>

<?php
include 'layout/footer.php';
?>