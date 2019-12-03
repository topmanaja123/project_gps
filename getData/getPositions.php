<?php
// $sc = isset($_POST['data']) ? $_POST['data'] : '';
// require 'config.php';
// $strSQL = "SELECT
// `devices`.`id`,
// `devices`.`name`,
// `devices`.`uniqueid`,
// `devices`.`lastupdate`,
// `devices`.`positionid`,
// `positions`.`protocol`,
// `positions`.`deviceid`,
// `positions`.`servertime`,
// `positions`.`devicetime`,
// `positions`.`fixtime`,
// `positions`.`valid`,
// `positions`.`latitude`,
// `positions`.`longitude`,
// `positions`.`speed`,
// `positions`.`course`,
// `positions`.`attributes`,
// `devices`.`connect`,
// `devices`.`connect_post`,
// `devices`.`type`,
// `devices`.`driverLicense`,
// `devices`.`fuel`,
// `devices`.`connect_acc`,
// `devices`.`category`,
// `device_category`.`photo`
// FROM
// `devices`
// INNER JOIN `positions` ON `devices`.`positionid` = `positions`.`id`
// INNER JOIN `device_category` ON `devices`.`category` = `device_category`.`id`";
// if ($sc !== "") {
//   $strSQL .= " WHERE name LIKE '%$sc%' ";
// }
// $strSQL .= " LIMIT 500";
// $objQuery = $conn->query($strSQL) or die(mysql_error());
// $intNumField = mysqli_num_fields($objQuery);
// $resultArray = array();
// while ($obResult = $objQuery->fetch_assoc()) {
//   $arrCol = array();
//   $arrCol = array(
//     'id' => $obResult['id'],
//     'name' => $obResult['name'],
//     'uniqueid' => $obResult['uniqueid'],
//     // 'fuel' => $obResult['devi_fuel'],
//     'positionid' => $obResult['positionid'],
//     // 'rfid_name' => $obResult['rfid_name'],
//     // 'rfid_number' => $obResult['rfid_number'],
//     'devicetime' => $obResult['devicetime'],
//     'servertime' => $obResult['servertime'],
//     'fixtime' => $obResult['fixtime'],
//     'attributes' => $obResult['attributes'],
//     'lat' => $obResult['latitude'],
//     'lng' => $obResult['longitude'],
//     'speed' => $obResult['speed'],
//     'course' => $obResult['course'],
//     // 'attributes' =>	$arrAtt,
//     'valid' => $obResult['valid'],
//     // 'state' => $obResult['state'],
//     // 'category' => $obResult['category'],
//     'photo' => $obResult['photo']
//   );
//   array_push($resultArray, $arrCol);
// }
// // echo $strSQL;
// mysqli_close($conn);

// echo json_encode($resultArray, JSON_UNESCAPED_UNICODE);
?>

<?php
ob_start();
session_start();
$sc = $_POST['data'];

require '../config.php';
$strSQL = "SELECT
`devices`.`id`,
`devices`.`name`,
`devices`.`uniqueid`,
`devices`.`lastupdate`,
`devices`.`positionid`,
`positions`.`protocol`,
`positions`.`deviceid`,
`positions`.`servertime`,
`positions`.`devicetime`,
`positions`.`fixtime`,
`positions`.`valid`,
`positions`.`latitude`,
`positions`.`longitude`,
`positions`.`speed`,
`positions`.`course`,
`positions`.`attributes`,
`devices`.`connect`,
`devices`.`connect_post`,
`devices`.`type`,
`devices`.`driverLicense`,
`devices`.`fuel`,
`devices`.`connect_acc`,
`devices`.`category`,
`user_device`.`userid`
FROM
`devices`
INNER JOIN `positions` ON `devices`.`positionid` = `positions`.`id`
INNER JOIN `user_device` ON `user_device`.`deviceid` = `positions`.`deviceid`
WHERE `user_device`.`userid` = $_SESSION[userid]";
if ($sc) {
  $strSQL .= " AND name LIKE '%$sc%' ";
}
$strSQL .= " LIMIT 300";
$objQuery = $conn->query($strSQL) or die(mysql_error());
$intNumField = mysqli_num_fields($objQuery);
$resultArray = array();
while ($obResult = $objQuery->fetch_assoc()) {
  // $arrCol = array();
  $arrCol = array(
    'id' => $obResult['id'],
    'name' => $obResult['name'],
    'uniqueid' => $obResult['uniqueid'],
    // 'fuel' => $obResult['devi_fuel'],
    'positionid' => $obResult['positionid'],
    'protocol' => $obResult['protocol'],
    'driverLicense' => $obResult['driverLicense'],
    // 'rfid_number' => $obResult['rfid_number'],
    'devicetime' => $obResult['devicetime'],
    'servertime' => $obResult['servertime'],
    'fixtime' => $obResult['fixtime'],
    'attributes' => $obResult['attributes'],
    'lat' => $obResult['latitude'],
    'lng' => $obResult['longitude'],
    'speed' => ($obResult['speed']*1.852),
    'course' => $obResult['course'],
    'attributes' =>	$obResult['attributes'],
    'valid' => $obResult['valid'],
    'connect' => $obResult['connect'],
    'connect_post' => $obResult['connect_post'],
    'connect_acc' => $obResult['connect_acc'],
    // 'state' => $obResult['state'],
    'category' => $obResult['category']
  ); 
  array_push($resultArray, $arrCol);
}
// echo $strSQL;
mysqli_close($conn);
echo json_encode($resultArray, JSON_UNESCAPED_UNICODE);