<?php
session_start();

// Memastikan login
if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login terlebih dahulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}

$title = 'Detail toko';

include 'layout/header.php';

// Mengambil ID toko dari parameter URL
$id_toko = (int)$_GET['id_toko'];

// Mengambil detail toko
$query_toko = "SELECT * FROM toko WHERE id_toko = $id_toko";
$toko = selectSingle($query_toko);

// Jika toko ditemukan, tampilkan detailnya
if ($toko) {
    echo "
    <div class='container mt-5'> 
        <h1>{$toko['nama_toko']}</h1>
        <hr>

        <table class='table table-bordered table-striped mt-3'>
            <tr>
                <td><b>ID Toko</b></td>
                <td>{$toko['id_toko']}</td>
            </tr>
            <tr>
                <td><b>Nama Toko</b></td>
                <td>{$toko['nama_toko']}</td>
            </tr>
        </table>
        <h2>Daftar barang</h2>
        <table class='table table-bordered table-striped mt-3'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>";

    // Mengambil barang-barang dari toko ini
    $query_barang = "
    SELECT barang.id_barang, barang.nama_barang, barang.harga 
    FROM barang 
    WHERE barang.id_toko = $id_toko";
    $barang_result = select($query_barang);

    // Menampilkan daftar barang
    $nomor = 1;
    foreach ($barang_result as $barang) {
        echo "
        <tr>
            <td>{$nomor}</td>
            <td>{$barang['id_barang']}</td>
            <td>{$barang['nama_barang']}</td>
            <td>{$barang['harga']}</td>
        </tr>";
        $nomor++;
    }

    echo "
        </tbody>
        </table>
        <a href='toko.php' class='btn btn-secondary btn-sm' style='float: right;'>Kembali</a>
    </div>";
} else {
    echo "<p>Toko tidak ditemukan</p>";
}

include 'layout/footer.php';
?>