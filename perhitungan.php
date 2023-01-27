<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $long_before = 112.05695;
    $latitude_before = -6.896012;

    $long_after = 112.05697271481608;
    $latitude_after = -6.896002251528017;

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
    $hasil = $angle * $earthRadius;
    echo $hasil;
}
?>