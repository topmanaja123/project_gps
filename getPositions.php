<?php
	require'config.php';
	$strSQL = "SELECT
  `devices`.`devi_id`,
  `devices`.`devi_name`,
  `devices`.`devi_imei`,
  `positions`.`posi_id`,
  `positions`.`devicetime`,
  `positions`.`lat`,
  `positions`.`lng`,
  `positions`.`speed`,
  `positions`.`course`,
  `positions`.`state`,
  `positions`.`altitude`,
  `devices`.`connect_dlt`,
  `devices`.`connect_post`,
  `devices`.`connect_acc`,
  `devices`.`rfid_name`,
  `devices`.`rfid_number`,
  `devices`.`devi_fuel`,
  `positions`.`valid`,
  `positions`.`attributes`,
  `positions`.`servertime`,
  `devices`.`devi_category`
FROM
  `positions`
  INNER JOIN `devices` ON `positions`.`posi_id` = `devices`.`id_position` LIMIT 50";
	$objQuery = $conn->query($strSQL) or die (mysql_error());
	$intNumField = mysqli_num_fields($objQuery);
	$resultArray = array();
	while($obResult = $objQuery->fetch_assoc())
	{
		$arrCol = array();
        $arrCol =array(
			'devi_id' => $obResult['devi_id'],
      'devi_name' => $obResult['devi_name'],
      'devi_imei' => $obResult['devi_imei'],
      'devi_fuel' => $obResult['devi_fuel'],
      'posi_id' => $obResult['posi_id'],
      'rfid_name' => $obResult['rfid_name'],
      'rfid_number' => $obResult['rfid_number'],
      'devicetime' => $obResult['devicetime'],
      'servertime' => $obResult['servertime'],
      'altitude' => $obResult['altitude'],
      'lat' => $obResult['lat'],
      'lng' => $obResult['lng'],
      'speed' => $obResult['speed'],
      'course' => $obResult['course'],
      // 'attributes' =>	$arrAtt,
      'valid' => $obResult['valid'],
      'state' => $obResult['state'],
      'devi_category' => $obResult['devi_category']
		);
		array_push($resultArray,$arrCol);
	}
	
	mysqli_close($conn);
	
	echo json_encode($resultArray, JSON_UNESCAPED_UNICODE);
?>