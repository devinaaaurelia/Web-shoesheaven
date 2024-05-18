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

$id_kategori = (int)$_GET['id_kategori'];

if(delete_kategori($id_kategori) > 0 ){
        echo "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'kategori.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus');
        document.location.href = 'kategori.php';
        </script>";
    }