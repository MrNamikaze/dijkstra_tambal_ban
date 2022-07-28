<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    if($_SESSION['user']['role'] == 1){
        $id = $_GET['id'];
    	require_once("koneksi.php");
	    $sql = "SELECT * FROM produk WHERE id_kategori = $id";
	    $row = $db->prepare($sql);
	    $row->execute();
	    $hasil = $row->fetchAll();
	    $a =1;

        $sql = "SELECT * FROM produk WHERE id = $id";
        $row = $db->prepare($sql);
        $row->execute();
        $hasil1 = $row->fetch();
        if(isset($_POST['register'])){

            // filter data yang diinputkan
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
            $gedung = filter_input(INPUT_POST, 'gedung', FILTER_SANITIZE_STRING);
            $id_kategori = $id;
            
            $sql1 = "INSERT INTO produk (nama, harga, gedung, id_kategori) 
                        VALUES (:nama, :harga, :gedung, :id_kategori)";
                $stmt = $db->prepare($sql1);

                // bind parameter ke query
                $params = array(
                    ":nama" => $nama,
                    ":harga" => $harga,
                    ":gedung" => $gedung,
                    ":id_kategori" => $id_kategori,
                );

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($params);
                // jika query simpan berhasil, maka user sudah terdaftar
                // maka alihkan ke halaman login
                if($saved){
                    header("Location: tambah_detail_produk.php?id=$id");
                }
                else{
                    $usr = 2;
                }
        }
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
	    require 'view_tambah_detail_produk.php';
        require 'foot.php';
    }
    else{
    	header("Location: dashboard.php");
    }
}
?>