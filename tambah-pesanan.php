<?php
session_start();

// Pembatas halaman login
if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login terlebih dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

$title = 'Tambah Pesanan Barang';

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_pesanan($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'pesanan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan');
        document.location.href = 'pesanan.php';
        </script>";
    }
}

?>

<div class="container mt-5">
    <h1>Tambah Pesanan Barang</h1>
    <hr>

    <form action="" method="post">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <select class="form-select" id="nama_barang" name="nama_barang" required>
                <option selected disabled>Pilih Barang</option>
                <?php
                // Ambil data barang dari tabel barang
                $query_barang = "SELECT id_barang, nama_barang FROM barang";
                $result_barang = mysqli_query($db, $query_barang);
                while ($row_barang = mysqli_fetch_assoc($result_barang)) {
                    echo "<option value='" . $row_barang['nama_barang'] . "'>" . $row_barang['nama_barang'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>