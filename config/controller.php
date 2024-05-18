<?php

//fungsi menampilkan data
function select($query)
{
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

//fungsi menambahkan data barang
function create_barang($post)
{
    global $db;

    $id_barang = $post['id_barang'];
    $nama_barang = $post['nama_barang'];
    $id_toko = $post['id_toko'];
    $nama_kategori = $post['id_kategori']; // Mengambil ID Kategori dari $_POST
    $harga = $post['harga'];

    //query menambahkan data barang
    $query = "INSERT INTO barang (id_barang, nama_barang, id_toko, id_kategori, harga) VALUES ('$id_barang', '$nama_barang', '$id_toko', '$nama_kategori', '$harga')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


//fungsi mengubah data barang

function update_barang($post)
{
    global $db;

    $id_barang = $post['id_barang'];
    $nama_barang = $post['nama_barang'];
    $id_toko = $post['id_toko'];
    $id_kategori = $post['id_kategori'];
    $harga = $post['harga'];

    //query ubah data
    $query = "UPDATE barang SET nama_barang = '$nama_barang', id_toko = '$id_toko', id_kategori = '$id_kategori', harga = '$harga' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus data barang

function delete_barang($id_barang)
{
    global $db;

    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menambahkan data toko

function create_toko($post)
{
    global $db;

    $nama = $post['nama_toko'];

    //query tambah data
    $query = "INSERT INTO toko VALUES(null, '$nama')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi detail toko
function selectSingle($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    return mysqli_fetch_assoc($result);
}

//fungsi mengubah data toko

function update_toko($post)
{
    global $db;

    $id_toko   = $post['id_toko'];
    $nama_toko = $post['nama_toko'];

    //query ubah data
    $query = "UPDATE toko SET nama_toko = '$nama_toko' WHERE id_toko = $id_toko";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus data toko

function delete_toko($id_toko)
{
    global $db;

    $query = "DELETE FROM toko WHERE id_toko = $id_toko";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi detail kategori
function selectAll($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

//fungsi menambahkan data kategori

function create_kategori($post)
{
    global $db;

    $nama   = $post['nama_kategori'];

    //query tambah data
    $query = "INSERT INTO kategori VALUES(null, '$nama')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi mengubah data kategori
function update_kategori($post)
{
    global $db;

    $id_kategori   = $post['id_kategori'];
    $nama_kategori = $post['nama_kategori'];

    //query ubah data
    $query = "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = $id_kategori";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus data kategori

function delete_kategori($id_kategori)
{
    global $db;

    $query = "DELETE FROM kategori WHERE id_kategori = $id_kategori";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menambahkan data akun

function create_akun($post)
{
    global $db;

    $nama       = $post['nama_akun'];
    $username   = $post['username'];
    $email      = $post['email'];
    $password   = $post['password'];
    $role       = $post['role'];

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query tambah data
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$role')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi mengubah data akun
function update_akun($post)
{
    global $db;

    $id_akun    = $post['id_akun'];
    $nama_akun  = $post['nama_akun'];
    $username   = $post['username'];
    $email      = $post['email'];
    $password   = $post['password'];
    $role       = $post['role'];

    //query ubah data
    $query = "UPDATE akun SET nama_akun = '$nama_akun', username = '$username',  email = '$email',  password = '$password',  role = '$role' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus data akun

function delete_akun($id_akun)
{
    global $db;

    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menambahkan data pesanan
function create_pesanan($post)
{
    global $db;

    $nama_barang = $post['nama_barang'];
    $jumlah = $post['jumlah'];

    // Mendapatkan ID barang sesuai nama yang diinput
    $query_barang = "SELECT id_barang FROM barang WHERE nama_barang = '$nama_barang'";
    $result_barang = mysqli_query($db, $query_barang);

    if (!$result_barang) {
        die("Error in query: " . mysqli_error($db));
    }

    $row_barang = mysqli_fetch_assoc($result_barang);
    $id_barang = $row_barang['id_barang'];

    // Insert data dengan ID barang yang sesuai
    $query = "INSERT INTO pesanan (id_barang, jumlah, id_toko) VALUES ('$id_barang', '$jumlah', NULL)";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}