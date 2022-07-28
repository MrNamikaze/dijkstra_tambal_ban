<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $not = 0;
    $url = $_GET['id'];
    $dataa = explode(" ",$url);
    $id = $dataa[0];
    $back = $dataa[1];
    $sql = "SELECT * FROM produk WHERE id = $id";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
    $id_hal = $hasil['id_kategori'];
    if(isset($_POST['edit'])){

        // filter data yang diinputkan
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $harga1 = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
        $harga = str_replace(',', '.', $harga1);
        $gedung = filter_input(INPUT_POST, 'gedung', FILTER_SANITIZE_STRING);
        $data[] = $nama;
        $data[] = $harga;
        $data[] = $gedung;
        $data[] = $id;
        $sql = "UPDATE produk SET nama=?, harga=?, gedung=? WHERE id=?";
        $stmt = $db->prepare($sql);

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($data);
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
            header("Location: detail_produk.php?id=$id_hal");
        }
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
    }
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_edit_detail_produk.php';
    require 'foot.php';
}
?>