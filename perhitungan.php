<?php
session_start();
if(is_null($_SESSION["user"])){
    header("Location: index.php");
}
else{
    require_once("koneksi.php");
    $long_before = 112.0617703528763;
    $latitude_before = -6.8995637843220265;

    $long_after = 112.06338625115114;
    $latitude_after = -6.900014011453692;

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