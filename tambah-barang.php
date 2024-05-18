<?php

session_start();

//pembatas halaman login
if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login terlebih dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

$title = 'Tambah barang';

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    //mengambil id toko yang dipilih dari form
    $nama_toko = $_POST['nama_toko'];
    $query_toko = "SELECT id_toko FROM toko WHERE nama_toko = '$nama_toko'";
    $result_toko = mysqli_query($db, $query_toko);
    $row_toko = mysqli_fetch_assoc($result_toko);
    $id_toko = $row_toko['id_toko'];

    //mengambil id kategori yang dipilih dari form
    $nama_kategori = $_POST['nama_kategori'];
    $query_kategori = "SELECT id_kategori FROM kategori WHERE nama_kategori = '$nama_kategori'";
    $result_kategori = mysqli_query($db, $query_kategori);
    $row_kategori = mysqli_fetch_assoc($result_kategori);
    $id_kategori = $row_kategori['id_kategori'];

    //memasukkan id toko dan kategori ke dalam $_POST agar dapat disimpan
    $_POST['id_toko'] = $id_toko;
    $_POST['id_kategori'] = $id_kategori;

    if (create_barang($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}

?>

<div class="container mt-5">
    <h1>Tambah Barang</h1>
    <hr>

    <form action="" method="post">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required>
        </div>
        <div class="mb-3">
            <label for="nama_toko" class="form-label">Toko</label>
            <select class="form-select" id="nama_toko" name="nama_toko" required>
                <option selected disabled>Pilih Toko</option>
                <?php
                //mengambil data toko dari tabel toko
                $query_toko = "SELECT nama_toko FROM toko";
                $result_toko = mysqli_query($db, $query_toko);
                while ($row_toko = mysqli_fetch_assoc($result_toko)) {
                    echo "<option value='" . $row_toko['nama_toko'] . "'>" . $row_toko['nama_toko'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Kategori</label>
            <select class="form-select" id="nama_kategori" name="nama_kategori" required>
                <option selected disabled>Pilih Kategori</option>
                <?php
                //mengambil data kategori dari tabel kategori
                $query_kategori = "SELECT nama_kategori FROM kategori";
                $result_kategori = mysqli_query($db, $query_kategori);
                while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                    echo "<option value='" . $row_kategori['nama_kategori'] . "'>" . $row_kategori['nama_kategori'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>