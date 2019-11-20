<?php
// โฮส Green_GPS
// $host = "217.175.242.25";
// // // $host = "27.254.81.27";
// // //Username phpmyadmin
// $username = "root";
// // //Password phpMyadmin
// $password = "Ple01010!@#";
// $db = "traccar";


//โฮส traccar
$host = "27.254.81.41";
//Username phpmyadmin
$username = "root";
//Password phpMyadmin
$password = "Ple01010!@#";
$db = "traccar_1";

// //โฮส traccar
// $host = "27.254.81.27";
// //Username phpmyadmin
// $username = "root";
// //Password phpMyadmin
// $password = "Ple01010!@#";
// $db = "traccar_5";

//คำสั่ง Connect ฐานข้อมูล
$conn = new mysqli($host, $username, $password, $db);
mysqli_query($conn, "SET NAMES UTF8");
// check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 ?>
