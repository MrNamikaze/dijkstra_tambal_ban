<?php
require_once("koneksi.php");
$sql = "SELECT * FROM lokasi";
$row = $db->prepare($sql);
$row->execute();
$hasil = $row->fetchAll();
$cek = count($hasil);
$a=0;
$random = rand(10000000,99999999);
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
  $cookie_value = $random;
  setcookie($cookie_name, $cookie_value, time() + (3600), "/");
  $id_user = $_COOKIE[$cookie_name];
} 
else {
	$id_user = $_COOKIE[$cookie_name];
}
$sql4 = "SELECT * FROM hasil WHERE id_user = '$id_user'";
$row = $db->prepare($sql4);
$row->execute();
$hasil4 = $row->fetch();
if($hasil4 == false){
	require 'view_index_empty.php';
}
else{
	require 'view_index.php';
}
?>

