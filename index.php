<?php
session_start();
require_once("koneksi.php");
if(isset($_SESSION['konsumen'])){
      $sql = "SELECT * FROM lokasi";
      $row = $db->prepare($sql);
      $row->execute();
      $hasil = $row->fetchAll();
      $cek = count($hasil);
      $a=0;
      $id_user = $_SESSION['konsumen'];
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
}
else{
    $random = rand(10000000,99999999);
    $_SESSION['konsumen'] = $random;
    $sql = "SELECT * FROM lokasi";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll();
    $cek = count($hasil);
    $a=0;
    $id_user = $random;
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
}
?>

