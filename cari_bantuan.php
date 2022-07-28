<?php
require_once("koneksi.php");
$longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
$latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
date_default_timezone_set("Asia/Jakarta");
$waktu = date("H:i:s");
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
$sql = "SELECT * FROM konsumen WHERE id_user = '$id_user'";
$row = $db->prepare($sql);
$row->execute();
$produk = $row->fetch();
if($produk == true){
	$data[] = $longitude;
    $data[] = $latitude;
    $data[] = $waktu;
    $data[] = $id_user;
    $sql = "UPDATE konsumen SET longitude=?, latitude=?, waktu=? WHERE id_user=?";
    $stmt = $db->prepare($sql);

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($data);
    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved){
        header("Location: perhitungan_dijkstra.php");
    }
    else{
        echo 'a';
    }
	
}
else{
	$sql = "INSERT INTO konsumen (id_user, longitude, latitude, waktu) 
                        VALUES (:id_user, :longitude, :latitude, :waktu)";
	$stmt = $db->prepare($sql);

	// bind parameter ke query
	$params = array(
	    ":id_user" => $id_user,
	    ":longitude" => $longitude,
	    ":latitude" => $latitude,
	    ":waktu" => $waktu,
	);

	// eksekusi query untuk menyimpan ke database
	$saved = $stmt->execute($params);
	echo $id_user.'<br>';
	echo $longitude.'<br>';
	echo $latitude.'<br>';
	echo $waktu.'<br>';
	if($saved){
	    header("Location: perhitungan_dijkstra.php");
	}
	else{
	    echo 'b';
	}
}

?>

