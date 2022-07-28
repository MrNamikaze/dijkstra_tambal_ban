<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    if($_SESSION['user']['role'] == 1){
        $id = $_GET['id'];
    	require_once("koneksi.php");
	    $sql = "SELECT * FROM testimoni WHERE id_ket = $id";
	    $row = $db->prepare($sql);
	    $row->execute();
	    $hasil = $row->fetchAll();

        $sql1 = "SELECT * FROM testimoni WHERE id = $id";
        $row1 = $db->prepare($sql1);
        $row1->execute();
        $hasil1 = $row1->fetch();
	    $a =1;
        $back = '+'.$id;
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
	    require 'view_detail_testimoni.php';
        require 'foot.php';
    }
    else{
    	header("Location: dashboard.php");
    }
}
?>