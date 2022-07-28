<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $not = 0;
    $id = $_GET['id'];
    $sql = "SELECT * FROM testimoni WHERE id = $id";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();

    $sql1 = "SELECT * FROM produk WHERE id_kategori = 0";
    $row1 = $db->prepare($sql1);
    $row1->execute();
    $hasil1 = $row1->fetchAll();

    $usr = 0;
    if(isset($_POST['edit'])){
        $namaFile = $_FILES['foto']['name'];
        $foto = explode(".",$namaFile);
        $namafoto = time().".".$foto[1];
        $namaSementara = $_FILES['foto']['tmp_name'];
        if($namaFile == ''){
            // filter data yang diinputkan
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $orderan = filter_input(INPUT_POST, 'orderan', FILTER_SANITIZE_STRING);
            $tanggal = filter_input(INPUT_POST, 'tanggal', FILTER_SANITIZE_STRING);
            if($tanggal==''){
                    $usr = 3;
                }
            $data[] = $nama;
            $data[] = $orderan;
            $data[] = $tanggal;
            $data[] = $id;
            $sql = "UPDATE testimoni SET nama=?, orderan=?, tanggal=? WHERE id=?";
            $stmt = $db->prepare($sql);

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($data);
            // jika query simpan berhasil, maka user sudah terdaftar
            // maka alihkan ke halaman login
            if($saved){
                header("Location: testimoni.php");
            }
            else{
                $usr = 2;
            }
        }
        else{
            // filter data yang diinputkan
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $orderan = filter_input(INPUT_POST, 'orderan', FILTER_SANITIZE_STRING);
            $tanggal = filter_input(INPUT_POST, 'tanggal', FILTER_SANITIZE_STRING);
            if($tanggal==''){
                    $usr = 3;
                }
            $data[] = $nama;
            $data[] = $orderan;
            $data[] = $tanggal;
            $data[] = $namafoto;
            $data[] = $id;
            $sql = "UPDATE testimoni SET nama=?, orderan=?, tanggal=?, gambar=? WHERE id=?";
            $stmt = $db->prepare($sql);

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($data);
            // jika query simpan berhasil, maka user sudah terdaftar
            $dirUpload = "img/";

            // pindahkan file
            $terupload = move_uploaded_file($namaSementara, $dirUpload.$namafoto);
            if($saved){
                header("Location: testimoni.php");
            }
            else{
                $usr = 2;
            }
        }
        
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
    }
    require 'head.php';
    require 'navbar.php';
    require 'sidebar.php';
    require 'view_edit_testimoni.php';
    require 'foot.php';
}
?>