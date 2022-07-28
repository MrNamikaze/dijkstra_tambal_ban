<?php

/*
 * Author: doug@neverfear.org
 */

require("Dijkstra.php");
function runTest() {
	require_once("koneksi.php");
	$id_user = $_COOKIE["user"];
	$sql = "SELECT * FROM konsumen WHERE id_user = '$id_user'";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
    $id = $hasil['id_user'];
    $longitude_user = $hasil['longitude'];
    $latitude_user = $hasil['latitude'];
    //
    $sql2 = "SELECT * FROM vertex";
    $row = $db->prepare($sql2);
    $row->execute();
    $hasil2 = $row->fetchAll();
    $c=0;

    $sql3 = "SELECT * FROM lokasi WHERE status = 'buka'";
    $row = $db->prepare($sql3);
    $row->execute();
    $hasil3 = $row->fetchAll();

    //
    foreach ($hasil3 as $b) {
    	$long_before = $longitude_user;
	    $latitude_before = $latitude_user;

	    $long_after = $b['longitude'];
	    $latitude_after = $b['latitude'];

	    $earthRadius = 6371000;
	    $latFrom = deg2rad($latitude_before);
	    $lonFrom = deg2rad($long_before);
	    $latTo = deg2rad($latitude_after);
	    $lonTo = deg2rad($long_after);

	    $lonDelta = $lonTo - $lonFrom;
	    $a = pow(cos($latTo) * sin($lonDelta), 2) +
	        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
	    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

	    $angle = atan2(sqrt($a), $b);
	    $hasil_perhitungan_tambal[$c] = $angle * $earthRadius;
	    $c++;
    }
    $jarak_tambal_min = min($hasil_perhitungan_tambal);

    foreach ($hasil3 as $b) {
    	$long_before = $longitude_user;
	    $latitude_before = $latitude_user;
	    $id_sementara = $b['id_tambal'];
	    $long_after = $b['longitude'];
	    $latitude_after = $b['latitude'];

	    $earthRadius = 6371000;
	    $latFrom = deg2rad($latitude_before);
	    $lonFrom = deg2rad($long_before);
	    $latTo = deg2rad($latitude_after);
	    $lonTo = deg2rad($long_after);

	    $lonDelta = $lonTo - $lonFrom;
	    $a = pow(cos($latTo) * sin($lonDelta), 2) +
	        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
	    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

	    $angle = atan2(sqrt($a), $b);
	    $hasil_perhitungan_tambal = $angle * $earthRadius;
	    if($hasil_perhitungan_tambal == $jarak_tambal_min){
	    	$id_tambal_akhir = $id_sementara;
	    	$long_tambal_akhir = $long_after;
	    	$lat_tambal_akhir = $latitude_after;
	    }
	    else{

	    }
    }
    //
    foreach ($hasil2 as $b) {
    	$long_before = $longitude_user;
	    $latitude_before = $latitude_user;

	    $long_after = $b['longitude'];
	    $latitude_after = $b['latitude'];

	    $earthRadius = 6371000;
	    $latFrom = deg2rad($latitude_before);
	    $lonFrom = deg2rad($long_before);
	    $latTo = deg2rad($latitude_after);
	    $lonTo = deg2rad($long_after);

	    $lonDelta = $lonTo - $lonFrom;
	    $a = pow(cos($latTo) * sin($lonDelta), 2) +
	        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
	    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

	    $angle = atan2(sqrt($a), $b);
	    $hasil_perhitungan[$c] = $angle * $earthRadius;
	    $c++;
    }
    $jarak_user_min = min($hasil_perhitungan);

    foreach ($hasil2 as $b) {
    	$long_before = $longitude_user;
	    $latitude_before = $latitude_user;
	    $id_sementara = $b['id'];
	    $long_after = $b['longitude'];
	    $latitude_after = $b['latitude'];

	    $earthRadius = 6371000;
	    $latFrom = deg2rad($latitude_before);
	    $lonFrom = deg2rad($long_before);
	    $latTo = deg2rad($latitude_after);
	    $lonTo = deg2rad($long_after);

	    $lonDelta = $lonTo - $lonFrom;
	    $a = pow(cos($latTo) * sin($lonDelta), 2) +
	        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
	    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

	    $angle = atan2(sqrt($a), $b);
	    $hasil_perhitungan = $angle * $earthRadius;
	    if($hasil_perhitungan == $jarak_user_min){
	    	$id_akhir = $id_sementara;
	    	$long_user_akhir = $long_after;
	    	$lat_user_akhir = $latitude_after;
	    }
	    else{

	    }
    }
	$g = new Graph();
	$g->addedge("$id_user", "$id_akhir", $jarak_user_min);
	$sql3 = "SELECT * FROM edge";
    $row = $db->prepare($sql3);
    $row->execute();
    $hasil3 = $row->fetchAll();
    foreach ($hasil3 as $c) {
    	$id_before = $c['vertex_before'];
    	$id_after = $c['vertex_after'];
    	$jarak = $c['jarak'];
    	$g->addedge("$id_before", "$id_after", $jarak);
    }
    //
    $sql4 = "SELECT * FROM vertex WHERE id = '$id_before'";
	$row = $db->prepare($sql4);
	$row->execute();
	$hasil4 = $row->fetch();
	$longitude_last_before = $hasil4['longitude'];
	$latitude_last_before = $hasil4['latitude'];
    //
    $sql5 = "SELECT * FROM vertex WHERE id = '$id_after'";
	$row = $db->prepare($sql5);
	$row->execute();
	$hasil5 = $row->fetch();
	$longitude_last_after = $hasil5['longitude'];
	$latitude_last_after = $hasil5['latitude'];
	//
	$sql5 = "SELECT * FROM lokasi WHERE id_tambal = '$id_tambal_akhir'";
	$row = $db->prepare($sql5);
	$row->execute();
	$hasil5 = $row->fetch();
	$longitude_last_tambal = $hasil5['longitude'];
	$latitude_last_tambal = $hasil5['latitude'];
	//
    $long_before = $longitude_last_before;
    $latitude_before = $latitude_last_before;

    $long_after = $longitude_last_tambal;
    $latitude_after = $latitude_last_tambal;

    $earthRadius = 6371000;
    $latFrom = deg2rad($latitude_before);
    $lonFrom = deg2rad($long_before);
    $latTo = deg2rad($latitude_after);
    $lonTo = deg2rad($long_after);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
    $hasil_perhitungan_before = $angle * $earthRadius;
    //
    $long_before = $longitude_last_after;
    $latitude_before = $latitude_last_after;

    $long_after = $longitude_last_tambal;
    $latitude_after = $latitude_last_tambal;

    $earthRadius = 6371000;
    $latFrom = deg2rad($latitude_before);
    $lonFrom = deg2rad($long_before);
    $latTo = deg2rad($latitude_after);
    $lonTo = deg2rad($long_after);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
    $hasil_perhitungan_after = $angle * $earthRadius;
    //
    if($hasil_perhitungan_before > $hasil_perhitungan_after){
    	$g->addedge("$id_tambal_akhir", "$id_after", $jarak);
    	$g->addedge("$id_after", "$id_tambal_akhir", $jarak);
    }
    else if($hasil_perhitungan_before < $hasil_perhitungan_after){
    	$g->addedge("$id_tambal_akhir", "$id_before", $jarak);
    	$g->addedge("$id_before", "$id_tambal_akhir", $jarak);
    }
    else{
    	$g->addedge("$id_tambal_akhir", "$id_before", $jarak);
    	$g->addedge("$id_before", "$id_tambal_akhir", $jarak);
    }
    
	list($distances, $prev) = $g->paths_from("$id_user");
	
	$path = $g->paths_to($prev, "$id_tambal_akhir");
	$simpan = implode(",",$path);
	//
	$sql = "SELECT * FROM hasil WHERE id_user = '$id_user'";
    $row = $db->prepare($sql);
    $row->execute();
    $hasil = $row->fetch();
    //
    if($hasil==false){
    	$sql = "INSERT INTO hasil (id_user, hasil) 
                        VALUES (:id_user, :hasil)";
	    $stmt = $db->prepare($sql);

	    // bind parameter ke query
	    $params = array(
	        ":id_user" => $id_user,
	        ":hasil" => $simpan,
	    );

	    // eksekusi query untuk menyimpan ke database
	    $saved = $stmt->execute($params);
	    if($saved){
	        header("Location: index.php");
	    }
	    else{
	        $usr = 2;
	    }
    }
    else{
    	$id = $id_user;
		$sql = "DELETE FROM hasil WHERE id_user= ?";
		$row = $db->prepare($sql);
		$row->execute(array($id));

		$sql = "INSERT INTO hasil (id_user, hasil) 
                        VALUES (:id_user, :hasil)";
	    $stmt = $db->prepare($sql);

	    // bind parameter ke query
	    $params = array(
	        ":id_user" => $id_user,
	        ":hasil" => $simpan,
	    );

	    // eksekusi query untuk menyimpan ke database
	    $saved = $stmt->execute($params);
	    if($saved){
	        header("Location: index.php");
	    }
	    else{
	        $usr = 2;
	    }


    }
	
}


runTest();

