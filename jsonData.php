<?php
$data = $_POST['data'];   
$jsonArr=array('type' => "FeatureCollection", 'features' => array());

            foreach ($data as $value) {
              
                   $propertiesArr= array(
                  'type' => "Feature",
                  'properties' => array(
                    'id' => $value[devi_id]
                  ),
                  'geometry' => array(
                    'type' => "Point",
                    'coordinates' => array((float)"$value[lng]", (float)"$value[lat]")
                  ),
                  'content' => array(
                    'devi_name' => $value['devi_name'],
                    'devi_imei'=> $value['devi_imei'],
                    'id_position'=> $value['id_position'],
                    'rfid_name'=> $value['rfid_name'],
                    'rfid_number'=> $value['rfid_number'],
                    'devicetime'=> $value['devicetime'],
                    'servertime'=> $value['servertime'],
                    'altitude'=> $value['altitude'],
                    'lat'=> $value['lat'],
                    'lng'=> $value['lng'],
                    'speed'=> $value['speed'],
                    'course'=> $value['course'],
                    'valid'=> $value['valid'],
							      'state'=> $value['state']
                  )
                );
            array_push($jsonArr['features'],$propertiesArr);
          }
     echo $json = json_encode($jsonArr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
     $file = fopen("/var/www/html/project_gps/json/data.json","w");
     fwrite($file,$json);
     fclose($file);
?>