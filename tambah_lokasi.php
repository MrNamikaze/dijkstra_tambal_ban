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
            $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
            $coordinates = filter_input(INPUT_POST, 'coordinates', FILTER_SANITIZE_STRING);
            if($coordinates==''){
                $usr = 3;
            }
            else{
                $random = rand(10000000,99999999);
                $id_tambal = 'a'.$random;
                $koor1 = str_replace("LngLat","",$coordinates);
                $koor2 = str_replace("(","",$koor1);
                $koor3 = str_replace(")","",$koor2);
                $coor = explode(", ",$koor3);
                // menyiapkan query
                $sql = "INSERT INTO lokasi (id_tambal, nama, alamat, longitude, latitude) 
                        VALUES (:id_tambal, :nama, :alamat, :longitude, :latitude)";
                $stmt = $db->prepare($sql);

                // bind parameter ke query
                $params = array(
                    ":id_tambal" => $id_tambal,
                    ":nama" => $nama,
                    ":alamat" => $alamat,
                    ":longitude" => $coor[0],
                    ":latitude" => $coor[1],
                );

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($params);
                if($saved){
                    header("Location: lokasi.php");
                }
                else{
                    $usr = 2;
                }
            }
        }
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
        require 'view_tambah_lokasi.php';
        require 'foot.php';
    }
    else{
        header("Location: dashboard.php");
    }
    
}
?>