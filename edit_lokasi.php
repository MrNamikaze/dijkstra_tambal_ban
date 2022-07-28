<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $not = 0;
    $id = $_GET['id'];
    $sql = "SELECT * FROM lokasi WHERE id = $id";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
    if(isset($_POST['edit'])){
        $coordinates = filter_input(INPUT_POST, 'coordinates', FILTER_SANITIZE_STRING);
        if($coordinates == ''){
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);

            $data[] = $nama;
            $data[] = $alamat;
            $data[] = $id;
            $sql = "UPDATE lokasi SET nama=?, alamat=? WHERE id=?";
            $stmt = $db->prepare($sql);

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($data);
            // jika query simpan berhasil, maka user sudah terdaftar
            // maka alihkan ke halaman login
            if($saved){
                header("Location: lokasi.php");
            }
            else{
                header("Location: edit_lokasi.php?id=$id");
            }
        }
        else{
            $koor1 = str_replace("LngLat","",$coordinates);
            $koor2 = str_replace("(","",$koor1);
            $koor3 = str_replace(")","",$koor2);
            $coor = explode(", ",$koor3);
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);

            $data[] = $nama;
            $data[] = $alamat;
            $data[] = $coor[0];
            $data[] = $coor[1];
            $data[] = $id;
            $sql = "UPDATE lokasi SET nama=?, alamat=?, longitude=?, latitude=? WHERE id=?";
            $stmt = $db->prepare($sql);

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($data);
            // jika query simpan berhasil, maka user sudah terdaftar
            // maka alihkan ke halaman login
            if($saved){
                header("Location: lokasi.php");
            }
            else{
                header("Location: edit_lokasi.php?id=$id");
            } 
        }
    }
    $cek_longitude = $hasil['longitude'];
    if($cek_longitude == 0){
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
        require 'view_edit_lokasi.php';
        require 'foot.php';
    }
    else{
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
        require 'view_edit_lokasi_b.php';
        require 'foot.php';
    }
    
    
}
?>