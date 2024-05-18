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

$title = 'Ubah kategori';

include 'layout/header.php';

$id_kategori = (int)$_GET['id_kategori'];

$kategori = select("SELECT * FROM kategori WHERE id_kategori = $id_kategori")[0];

//cek tombol tambah
if (isset($_POST['ubah'])) {
    if (update_kategori($_POST) > 0){
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'kategori.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'kategori.php';
        </script>";
    }
}

?>

<div class="container mt-5"> 
    <h1>Ubah kategori</h1>
    <hr>

    <form action=""method="post">

        <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>">

        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>" placeholder="Nama" required>
        </div>


        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>

    </form>
</div>

<?php
include 'layout/footer.php';
?>