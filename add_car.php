<?php
require "config.php";

$lat = 18.63517;
$lng = 99.044721666667;

for ($i=0; $i <=2000 ; $i++) { 
    $lat = $lat + 0.001 ;
    $lng = $lng + 0.001;
    $course = $course + 10;


    $sqlDevice =  "INSERT INTO devices(devi_name) VALUES('T$i')";
    $queryDevice = $conn->query($sqlDevice);
    $lastDevi_id = $conn->insert_id;

    $sqlPosition = "INSERT INTO positions(device_id,lat,lng,course) VALUES('$lastDevi_id','$lat','$lng','$course')";
    $queryPosition = $conn->query($sqlPosition);
    // unset($lastDevi_id);
    $lastPosi_id = $conn->insert_id;

    $sqlLastupdate = "UPDATE devices SET id_position = $lastPosi_id WHERE devi_id = $lastDevi_id";
    $queryLastupdate = $conn->query($sqlLastupdate);

}

if($query){
    echo "สำเร็จ";
}else{
    echo "ไม่สำเร็จ";
}


?>