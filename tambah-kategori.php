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

$title = 'Tambah kategori';

include 'layout/header.php';

//cek tombol tambah
if (isset($_POST['tambah'])) {
    if (create_kategori($_POST)>0){
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'kategori.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan');
        document.location.href = 'kategori.php';
        </script>";
    }
}

?>

<div class="container mt-5"> 
    <h1>Tambah Kategori</h1>
    <hr>

    <form action=""method="post">
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori" required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>

    </form>
</div>

<?php
include 'layout/footer.php';
?>