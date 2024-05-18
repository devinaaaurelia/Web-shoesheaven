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

$title = 'Ubah akun';

include 'layout/header.php';

$id_akun = (int)$_GET['id_akun'];

$akun = select("SELECT * FROM akun WHERE id_akun = $id_akun")[0];

//cek tombol tambah
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0){
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'akun.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'akun.php';
        </script>";
    }
}

?>

<div class="container mt-5"> 
    <h1>Ubah akun</h1>
    <hr>

    <form action=""method="post">

        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">

        <div class="mb-3">
            <label for="nama_akun" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="<?= $akun['nama_akun']; ?>" placeholder="Nama" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $akun['username']; ?>" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $akun['email']; ?>" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $akun['password']; ?>" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class='form-control' required>
                <option value ="">Pilih</option>
                <option value ="1">Penjual</option>
                <option value ="2">Pembeli</option>
            </select>
        </div>

        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>

    </form>
</div>

<?php
include 'layout/footer.php';
?>