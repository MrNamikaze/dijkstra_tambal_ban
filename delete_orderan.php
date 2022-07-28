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
    //
	$sql2 = "DELETE FROM orderan WHERE id= ?";
	$row = $db->prepare($sql2);
	$row->execute(array($id));
    header("Location: orderan.php");
}
?>