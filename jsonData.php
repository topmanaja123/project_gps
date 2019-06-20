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
                    'servertime'=> $value['servertime']
                  )
                );
            array_push($jsonArr['features'],$propertiesArr);
          }
     echo $json = json_encode($jsonArr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
     $file = fopen("json/data.json","w");
     fwrite($file,$json);
     fclose($file);
?>