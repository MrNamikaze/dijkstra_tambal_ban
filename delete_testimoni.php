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
	$sql = "DELETE FROM testimoni WHERE id= ?";
	$row = $db->prepare($sql);
	$row->execute(array($id));

	$sql1 = "DELETE FROM testimoni WHERE id_ket= ?";
	$row1 = $db->prepare($sql1);
	$row1->execute(array($id));
    header("Location: testimoni.php");
}
?>