<?php
// $i = 0;
//   while ($i < $jsonArr){
//     $i++;
       $jsonArr=array('type' => "FeatureCollection", 'features' => array());
                $propertiesArr= array(
                  'id' => $_POST['devi_id']
                );

                $geometryArr= array(
                  'type' => "Point",
                  'coordinates' => array((float)"$_POST[lng]", (float)"$_POST[lat]")
                );
                
                $contentArr=array(
                  'devi_name' => $_POST['devi_name'],
                  'servertime'=> $_POST['servertime']
                );
                
                array_push($jsonArr['features'],
                [
                  'type' => "Feature",
                  'properties' => $propertiesArr,
                  'geometry' => $geometryArr,
                  'content' => $contentArr,
                ]);
  // }
     echo $json = json_encode($jsonArr);
     $file = fopen("json/data.json","w");
     fwrite($file,$json);
     fclose($file);
?>