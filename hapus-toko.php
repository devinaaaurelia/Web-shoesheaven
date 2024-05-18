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

$id_toko = (int)$_GET['id_toko'];

if(delete_toko($id_toko) > 0 ){
        echo "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'toko.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus');
        document.location.href = 'toko.php';
        </script>";
    }