<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $url = $_GET['id'];
	$data = explode(" ",$url);
	$id = $data[0];
	$back = $data[1];
	$sql = "DELETE FROM produk WHERE id= ?";
	$row = $db->prepare($sql);
	$row->execute(array($id));
    header("Location: detail_produk.php?id=$back");
}
?>