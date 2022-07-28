<?php
session_start();
require_once("koneksi.php");
if($_SESSION['user']['role'] == 1){
    if(isset($_POST['register'])){
        $id_before = filter_input(INPUT_POST, 'id_before', FILTER_SANITIZE_STRING);
        $id_after = filter_input(INPUT_POST, 'id_after', FILTER_SANITIZE_STRING);
        $penanda = $id_after;
        echo $id_before;
        echo $id_after;
        if($id_before=='' || $id_after==''){
            echo 'a';
        }
        else{
            $sql = "SELECT * FROM vertex WHERE id = $id_before";
            $row = $db->prepare($sql);
            $row->execute();
            $hasil2 = $row->fetch();

            $long_before = $hasil2['longitude'];
            $lat_before = $hasil2['latitude'];

            $sql = "SELECT * FROM vertex WHERE id = $penanda";
            $row = $db->prepare($sql);
            $row->execute();
            $hasil3 = $row->fetch();

            $long_after = $hasil3['longitude'];
            $lat_after = $hasil3['latitude'];

            //
            $long_before = $long_before;
            $latitude_before = $lat_before;

            $long_after = $long_after;
            $latitude_after = $lat_after;

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
            $hasil4 = $angle * $earthRadius;
            // menyiapkan query
            $sql = "INSERT INTO edge (vertex_before, vertex_after, jarak) 
                    VALUES (:vertex_before, :vertex_after, :jarak)";
            $stmt = $db->prepare($sql);

            // bind parameter ke query
            $params = array(
                ":vertex_before" => $id_before,
                ":vertex_after" => $penanda,
                ":jarak" => $hasil4,
            );

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($params);

            $sql2 = "INSERT INTO edge (vertex_before, vertex_after, jarak) 
                    VALUES (:vertex_before, :vertex_after, :jarak)";
            $stmt2 = $db->prepare($sql2);

            // bind parameter ke query
            $params2 = array(
                ":vertex_before" => $penanda,
                ":vertex_after" => $id_before,
                ":jarak" => $hasil4,
            );

            // eksekusi query untuk menyimpan ke database
            $saved2 = $stmt2->execute($params2);
            if($saved2){
                header("Location: tambah_jalan.php");
            }
            else{
                echo 'b';
            }
        }
    }
}
else{
    echo 'c';
}
?>