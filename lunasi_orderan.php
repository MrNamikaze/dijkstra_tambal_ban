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
	$sql = "SELECT * FROM orderan WHERE id = $id";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
	$nama = $hasil['nama'];
	$alamat = $hasil['alamat'];
	$jenis_paket = $hasil['jenis_paket'];
	$harga = $hasil['harga'];
	$no_wa = $hasil['no_wa'];
	if($harga==0){
		header("Location: orderan.php");
	}
	else{
		$sql1 = "INSERT INTO history (id_history, nama, alamat, jenis_paket, harga, no_wa) 
                        VALUES (:id_history, :nama, :alamat, :jenis_paket, :harga, :no_wa) ";
	    $stmt = $db->prepare($sql1);

	    // bind parameter ke query
	    $params = array(
	    	":id_history" => time(),
	        ":nama" => $nama,
	        ":alamat" => $alamat,
	        ":jenis_paket" => $jenis_paket,
	        ":harga" => $harga,
	        ":no_wa" => $no_wa,
	    );
	    $saved = $stmt->execute($params);
		$sql2 = "DELETE FROM orderan WHERE id= ?";
		$row = $db->prepare($sql2);
		$row->execute(array($id));
	    if($saved){
	        header("Location: history.php");
	    }
	}
}
?>