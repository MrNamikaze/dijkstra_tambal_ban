<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $not = 0;
    $id = $_GET['id'];
    $sql = "SELECT * FROM produk WHERE id = $id";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
    if(isset($_POST['edit'])){

        // filter data yang diinputkan
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
        $kategori = filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING);
        $data[] = $nama;
        $data[] = $harga;
        $data[] = $kategori;
        $data[] = $id;
        $sql = "UPDATE produk SET nama=?, harga=?, kategori=? WHERE id=?";
        $stmt = $db->prepare($sql);

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($data);
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
            header("Location: produk.php");
        }
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
    }
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_edit_produk.php';
    require 'foot.php';
}
?>