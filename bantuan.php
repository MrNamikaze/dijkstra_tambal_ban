<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $sql = "SELECT * FROM konsumen";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll();
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_bantuan.php';
    require 'foot.php';
    $a = 0;
}
?>