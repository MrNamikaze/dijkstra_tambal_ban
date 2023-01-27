<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");

    $sql2 = "SELECT COUNT(id) AS jumlah_edge FROM edge";
    $row = $db->prepare($sql2);
    $row->execute();
    $hasil2 = $row->fetch();
    $jumlah_edge = $hasil2['jumlah_edge']/2;

    $sql3 = "SELECT COUNT(id) AS jumlah_vertex FROM vertex";
    $row = $db->prepare($sql3);
    $row->execute();
    $hasil3 = $row->fetch();
    $jumlah_vertex = $hasil3['jumlah_vertex'];

    $sql4 = "SELECT COUNT(id) AS jumlah_konsumen FROM konsumen";
    $row = $db->prepare($sql4);
    $row->execute();
    $hasil4 = $row->fetch();
    $jumlah_konsumen = $hasil4['jumlah_konsumen'];

    $sql5 = "SELECT COUNT(id) AS jumlah_lokasi FROM lokasi";
    $row = $db->prepare($sql5);
    $row->execute();
    $hasil5 = $row->fetch();
    $jumlah_lokasi = $hasil5['jumlah_lokasi'];
    
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_dashboard_master.php';
    require 'foot.php';
}
?>