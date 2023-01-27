<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $id = $_GET['id'];
	$sql = "DELETE FROM vertex WHERE id = ?";
	$row = $db->prepare($sql);
	$row->execute(array($id));

    $sql2 = "DELETE FROM edge WHERE vertex_before = ?";
	$row = $db->prepare($sql2);
	$row->execute(array($id));

    $sql3 = "DELETE FROM edge WHERE vertex_after = ?";
	$row = $db->prepare($sql3);
	$row->execute(array($id));
    header("Location: tambah_titik.php");
}
?>