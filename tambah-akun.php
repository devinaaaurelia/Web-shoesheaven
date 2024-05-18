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

$title = 'Tambah akun';

include 'layout/header.php';

//cek tombol tambah
if (isset($_POST['tambah'])) {
    if (create_akun($_POST)>0){
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'akun.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan');
        document.location.href = 'akun.php';
        </script>";
    }
}

?>

<div class="container mt-5"> 
    <h1>Tambah akun</h1>
    <hr>

    <form action=""method="post">
    <div class="mb-3">
    <label for="nama_toko" class="form-label">Toko</label>
    <select class="form-select" id="nama_toko" name="nama_toko" required>
        <option selected disabled>Pilih Toko</option>
        <?php
        // Ambil data toko dari tabel toko
        $query_toko = "SELECT id_toko, nama_toko FROM toko";
        $result_toko = mysqli_query($db, $query_toko);
        while ($row_toko = mysqli_fetch_assoc($result_toko)) {
            echo "<option value='" . $row_toko['nama_toko'] . "'>" . $row_toko['nama_toko'] . "</option>";
        }
        ?>
    </select>
</div>
        <button type="button" class="btn btn-secondary" style="float: right;">Kembali</button>
        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>

    </form>
</div>

<?php
include 'layout/footer.php';
?>