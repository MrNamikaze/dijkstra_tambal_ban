<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $not = 0;
    $id = $_GET['id'];
    $sql = "SELECT * FROM orderan WHERE id = $id";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
    if(isset($_POST['edit'])){

        // filter data yang diinputkan
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $jenis_paket = filter_input(INPUT_POST, 'jenis_paket', FILTER_SANITIZE_STRING);
        $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
        $no_wa = filter_input(INPUT_POST, 'no_wa', FILTER_SANITIZE_STRING);
        $deskripsi = filter_input(INPUT_POST, 'deskripsi', FILTER_SANITIZE_STRING);

        $data[] = $nama;
        $data[] = $alamat;
        $data[] = $jenis_paket;
        $data[] = $harga;
        $data[] = $no_wa;
        $data[] = $deskripsi;
        $data[] = $id;
        $sql = "UPDATE orderan SET nama=?, alamat=?, jenis_paket=?, harga=?, no_wa=?, deskripsi=? WHERE id=?";
        $stmt = $db->prepare($sql);

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($data);
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
            header("Location: orderan.php");
        }


        
    }
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_edit_orderan.php';
    require 'foot.php';
}
?>