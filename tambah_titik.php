<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $usr = 0;
    $sql = "SELECT * FROM vertex";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll();
    $cek_titk = count($hasil);
    if($cek_titk==0){
        if($_SESSION['user']['role'] == 1){
            if(isset($_POST['register'])){
                $coordinates = filter_input(INPUT_POST, 'coordinates', FILTER_SANITIZE_STRING);
                if($coordinates==''){
                    $usr = 3;
                }
                else{
                    $koor1 = str_replace("LngLat","",$coordinates);
                    $koor2 = str_replace("(","",$koor1);
                    $koor3 = str_replace(")","",$koor2);
                    $coor = explode(", ",$koor3);
                    // menyiapkan query
                    $sql = "INSERT INTO vertex (longitude, latitude) 
                            VALUES (:longitude, :latitude)";
                    $stmt = $db->prepare($sql);

                    // bind parameter ke query
                    $params = array(
                        ":longitude" => $coor[0],
                        ":latitude" => $coor[1],
                    );

                    // eksekusi query untuk menyimpan ke database
                    $saved = $stmt->execute($params);
                    if($saved){
                        header("Location: tambah_titik.php");
                    }
                    else{
                        $usr = 2;
                    }
                }
            }
            require 'head.php';
            require 'navbar.php';
            require 'sidebar.php';
            require 'view_tambah_titik_empty.php';
            require 'foot.php';
        }
        else{
            header("Location: dashboard.php");
        }
    }
    else{
        if($_SESSION['user']['role'] == 1){
            if(isset($_POST['register'])){
                $coordinates = filter_input(INPUT_POST, 'coordinates', FILTER_SANITIZE_STRING);
                if($coordinates==''){
                    $usr = 3;
                }
                else{
                    $koor1 = str_replace("LngLat","",$coordinates);
                    $koor2 = str_replace("(","",$koor1);
                    $koor3 = str_replace(")","",$koor2);
                    $coor = explode(", ",$koor3);
                    // menyiapkan query
                    $sql = "INSERT INTO vertex (longitude, latitude) 
                            VALUES (:longitude, :latitude)";
                    $stmt = $db->prepare($sql);

                    // bind parameter ke query
                    $params = array(
                        ":longitude" => $coor[0],
                        ":latitude" => $coor[1],
                    );

                    // eksekusi query untuk menyimpan ke database
                    $saved = $stmt->execute($params);
                    if($saved){
                        header("Location: tambah_titik.php");
                    }
                    else{
                        $usr = 2;
                    }
                }
            }
            require 'head.php';
            require 'navbar.php';
            require 'sidebar.php';
            require 'view_tambah_titik.php';
            require 'foot.php';
        }
        else{
            header("Location: dashboard.php");
        }
    }
}
?>