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

include 'config/app.php';

$id_barang = (int)$_GET['id_barang'];

if (delete_barang($id_barang) > 0) {
    echo "<script>
    alert('Data berhasil dihapus');
    document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus');
    document.location.href = 'index.php';
    </script>";
}
?>