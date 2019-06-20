<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		include("config.php");
		$sql="SELECT
	      `device`.`devi_id`,
	      `device`.`devi_name`,
	      `device`.`devi_imei`,
	      `positions`.`posi_id`,
	      `positions`.`devicetime`,
	      `positions`.`servertime`,
	      `positions`.`fixtime`,
	      `positions`.`lat`,
	      `positions`.`lng`,
	      `positions`.`speed`,
	      `positions`.`course`,
	      `positions`.`rf_name`,
	      `positions`.`rf_number`,
	      `device`.`devi_model`,
	      `category`.`cate_id`,
	      `category`.`cate_name`,
	      `category`.`cate_pic`,
	      `device`.`devi_fuel`,
	      `device`.`devi_utc`,
	      `device`.`connect_dlt`,
	      `device`.`connect_post`,
	      `device`.`connect_acc`
	  FROM
	      `category`
	      INNER JOIN `device` ON `category`.`cate_id` = `device`.`devi_category`
	      INNER JOIN `positions` ON `positions`.`posi_id` = `device`.`devi_position`";
	      $result=$conn->query($sql);
	      $result1=$conn->query($sql);
	?>

	<meta charset="utf-8">
	<title>GPS MAP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fontawesome/css/all.css">
	<link href="vender/select2/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="vender/select2/css/select2-bootstrap4.css" type="text/css" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
	<link rel="stylesheet" type="text/css" href="css/style_positions.css">
	<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
	<script src="js/leaflet-realtime.js"></script>
	<script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>
</head>

<body onload="initialize_map(); add_map_point(-33.8688, 151.2093);">
	<div id="map" style="width: 100vw; height: 100vh;"></div>
</body>

</html>
<script>
	//ตัวแปล map,popup
	var popup = L.popup();
	var mymap = L.map('map').setView([18.796678, 98.981099], 15);
//api map
	L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
		maxZoom: 20,
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
	}).addTo(mymap);

	var realtime = L.realtime({
		url: 'realtime.json',
		crossOrigin: true,
		type: 'json',
		setView: true,
		watch: true
	}, {
		interval: 3 * 1000

	}).addTo(mymap).bindPopup('Device');

	

//marker
	var markers = [];
	<?php
				$s = 0;
				while($rs1=$result1->fetch_assoc()) {
				$s++;
			?>
	var marker = L.marker([<?= $rs1['lat']?>, <?= $rs1['lng']?>], {
		rotationAngle: 0,
		rotationOrigin: 'center center'
	}).bindPopup('Device : <?= $rs1['
		devi_name ']?> <br> Speed :  ').addTo(mymap);
	markers.push(marker);

	<?php
}

?>
</script>
