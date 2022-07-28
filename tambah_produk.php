<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $usr = 0;
    if($_SESSION['user']['role'] == 1){
        if(isset($_POST['register'])){

            // filter data yang diinputkan
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $harga = filter_input(INPUT_POST, 'harga', FILTER_SANITIZE_STRING);
            $kategori = filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING);
            $id_kategori = 0;
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $row = $db->prepare($sql);
            $row->execute();
            $hasil = $row->fetchAll();

            if(!empty($hasil)){
                $usr = 3;
            }
            else{
                // menyiapkan query
                $sql = "INSERT INTO produk (nama, harga, kategori, id_kategori) 
                        VALUES (:nama, :harga, :kategori, :id_kategori)";
                $stmt = $db->prepare($sql);

                // bind parameter ke query
                $params = array(
                    ":nama" => $nama,
                    ":harga" => $harga,
                    ":kategori" => $kategori,
                    ":id_kategori" => $id_kategori,
                );

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($params);
                // jika query simpan berhasil, maka user sudah terdaftar
                // maka alihkan ke halaman login
                if($saved){
                    header("Location: produk.php");
                }
                else{
                    $usr = 2;
                }
            }
        }
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
        require 'view_tambah_produk.php';
        require 'foot.php';
    }
    else{
        header("Location: dashboard.php");
    }
    
}
?>