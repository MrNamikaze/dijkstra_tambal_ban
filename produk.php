<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    if($_SESSION['user']['role'] == 1){
    	require_once("koneksi.php");
	    $sql = "SELECT * FROM produk WHERE id_kategori = 0";
	    $row = $db->prepare($sql);
	    $row->execute();
	    $hasil = $row->fetchAll();
	    $a =1;
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
	    require 'view_produk.php';
        require 'foot.php';
    }
    else{
    	header("Location: dashboard.php");
    }
}
?>