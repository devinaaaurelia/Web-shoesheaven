<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login terlebih dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

include 'layout/header.php';

$id_barang = (int)$_GET['id_barang'];

$barang = select("SELECT * FROM barang
LEFT JOIN toko ON toko.id_toko = barang.id_toko
LEFT JOIN kategori ON kategori.id_kategori = barang.id_kategori
WHERE barang.id_barang = $id_barang")[0];

//cek tombol ubah
if (isset($_POST['ubah'])) {
    if (update_barang($_POST) > 0){
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'index.php';
        </script>";
    }
}

?>

<div class="container mt-5"> 
    <h1>Ubah Barang</h1>
    <hr>

    <form action="" method="post">
        
        <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
        
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['nama_barang']; ?>" placeholder="Nama Barang" required>
        </div>
        <div class="mb-3">
            <label for="id_toko" class="form-label">Toko</label>
            <!-- Menggunakan dropdown untuk memilih toko -->
            <select class="form-select" id="id_toko" name="id_toko" required>
                <?php
                $query_toko = "SELECT id_toko, nama_toko FROM toko";
                $result_toko = mysqli_query($db, $query_toko);
                while ($row_toko = mysqli_fetch_assoc($result_toko)) {
                    $selected = ($barang['id_toko'] == $row_toko['id_toko']) ? 'selected' : '';
                    echo "<option value='" . $row_toko['id_toko'] . "' $selected>" . $row_toko['nama_toko'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori</label>
            <!-- Menggunakan dropdown untuk memilih kategori -->
            <select class="form-select" id="id_kategori" name="id_kategori" required>
                <?php
                $query_kategori = "SELECT id_kategori, nama_kategori FROM kategori";
                $result_kategori = mysqli_query($db, $query_kategori);
                while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                    $selected = ($barang['id_kategori'] == $row_kategori['id_kategori']) ? 'selected' : '';
                    echo "<option value='" . $row_kategori['id_kategori'] . "' $selected>" . $row_kategori['nama_kategori'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= $barang['harga']; ?>" placeholder="Harga" required>
        </div>

        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>
    </form>
</div>

<?php
include 'layout/footer.php';
?>