<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $a = 0;
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_cari_rute.php';
    require 'foot.php';
    
}
?>