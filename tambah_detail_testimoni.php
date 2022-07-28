<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    if($_SESSION['user']['role'] == 1){
        $id = $_GET['id'];
    	require_once("koneksi.php");
	    $sql = "SELECT * FROM testimoni WHERE id_kategori = $id";
	    $row = $db->prepare($sql);
	    $row->execute();
	    $hasil = $row->fetchAll();
	    $a =1;

        $sql = "SELECT * FROM testimoni WHERE id = $id";
        $row = $db->prepare($sql);
        $row->execute();
        $hasil1 = $row->fetch();
        if(isset($_POST['register'])){

            // filter data yang diinputkan
            $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
            $tanggal = filter_input(INPUT_POST, 'tanggal', FILTER_SANITIZE_STRING);
            $orderan = filter_input(INPUT_POST, 'orderan', FILTER_SANITIZE_STRING);
            $id_ket = $id;
            $foto = $_FILES;
            $jumlah_foto = count($foto['gambar']['name']);
            for ($i=0; $i < $jumlah_foto; $i++) { 
                $namaFile = $foto['gambar']['name'][$i];
                $gambar = explode(".",$namaFile);
                $hitungan = $i+2*3;
                $namafoto = time().$hitungan.".".$gambar[1];
                $namaSementara = $foto['gambar']['tmp_name'][$i];

                $sql = "INSERT INTO testimoni (nama, tanggal, orderan, gambar, id_ket) 
                        VALUES (:nama, :tanggal, :orderan, :gambar, :id_ket)";
                $stmt = $db->prepare($sql);

                // bind parameter ke query
                $params = array(
                    ":nama" => $nama,
                    ":tanggal" => $tanggal,
                    ":orderan" => $orderan,
                    ":gambar" => $namafoto,
                    ":id_ket" => $id_ket,
                );

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($params);
                $dirUpload = "img/";
                $terupload = move_uploaded_file($namaSementara, $dirUpload.$namafoto);
            }
                // jika query simpan berhasil, maka user sudah terdaftar
                // maka alihkan ke halaman login
                if($saved){
                    header("Location: detail_testimoni.php?id=$id");
                }
                else{
                    $usr = 2;
                }
        }
        require 'head.php';
        require 'navbar.php';
        require 'sidebar.php';
	    require 'view_tambah_detail_testimoni.php';
        require 'foot.php';
    }
    else{
    	header("Location: dashboard.php");
    }
}
?>