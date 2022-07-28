<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $sql = "SELECT * FROM user WHERE role = 2";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll();
    $a =1;
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_admin.php';
    require 'foot.php';
}
?>