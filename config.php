<?php
//โฮส Green_GPS
$host = "217.175.242.25";
//Username phpmyadmin
$username = "root";
//Password phpMyadmin
$password = "Ple01010!@#";
$db = "green_gps";


// //โฮส traccar
// $host = "217.175.242.25";
// //Username phpmyadmin
// $username = "root";
// //Password phpMyadmin
// $password = "Ple01010!@#";
// $db = "traccar";

//คำสั่ง Connect ฐานข้อมูล
$conn = new mysqli($host, $username, $password, $db);
mysqli_query($conn, "SET NAMES UTF8");
// check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 ?>
