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
        header("Location: dashboard.php");
    }
    else{
        $sql2 = "SELECT * FROM edge";
        $row = $db->prepare($sql2);
        $row->execute();
        $hasil2 = $row->fetchAll();
        $cek_jalan = count($hasil2);
        if($cek_jalan==0){
            require 'head.php';
            require 'navbar.php';
            require 'sidebar.php';
            require 'view_tambah_jalan_empty.php';
            require 'foot.php';
        }
        else{
            $sql2 = "SELECT * FROM edge WHERE (id % 2) = 0";
            $row = $db->prepare($sql2);
            $row->execute();
            $hasil3 = $row->fetchAll();
            require 'head.php';
            require 'navbar.php';
            require 'sidebar.php';
            require 'view_tambah_jalan.php';
            require 'foot.php';
        }
    }
}
?>