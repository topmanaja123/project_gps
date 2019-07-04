<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- realtime -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>

    <!-- marker -->
    <script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>

    <style>
    .table {
        font-size: 14px;
    }

    .myCSSClass {
        font-size: 20px;
        color: red;
        font-weight: bold;
        background: none;
        /* background-color: none; */
        border: none;
        /* border-color: none; */
        box-shadow: none;
        cursor: none;
        margin: 0;
    }

    .leaflet-tooltip-bottom:before {
        border: none;
    }

    .my-custom-scrollbar {
        position: relative;
        height: 700px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
    </style>
</head>


<?php
require "config.php";
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
    `positions`.`servertime`
  FROM
    `positions`
    INNER JOIN `devices` ON `positions`.`posi_id` = `devices`.`id_position` LIMIT 300";
    $objQuery = $conn->query($strSQL) or die (mysql_error());
?>

<body>

    <div class="form-row">
    <div class="col-sm-6 col-md-9">
            <div id="map" style="height:88.88vh"></div>
        </div>
        <script src="map.js"></script>
        <script>
        

        function myMark(id,lat,lng) {
            L.marker([lat,lng]).addTo(map)
            //     .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            //     .openPopup();
        }
        </script>
        <div class="col-md-3 col-sm-6">
            <p>
                <form class="form-inline" method="post">
                    <label>ค้นหา</label>
                    <div class="col">
                        <input class="form-control" type="text" id="myInput" onkeyup="search()" placeholder="ทะเบียนรถ">
                    </div>
                </form>
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-hover table-sm" id="myTable">
                        <thead>
                            <tr class="header">
                                <th width="40%">
                                    <div align="center">ทะเบียน</div>
                                </th>
                                <th width="10%">
                                    <div align="center">ความเร็ว</div>
                                </th>
                                <th width="10%">
                                    <div align="center">ทิศทาง</div>
                                </th>
                                <th width="35%">
                                    <div align="center">เชื่อมต่อล่าสุด </div>
                                </th>

                            </tr>
                        </thead>

                        <?
                        while($objResult = $objQuery->fetch_assoc())
                        {
                        ?>
                        <tbody style="cursor:pointer;">
                            <tr>

                                <td>
                                    <div align="center">
                                        <?php echo $objResult["devi_name"];?></div>
                                </td>
                                <td><?php echo $objResult["speed"];?></td>
                                <td><?php echo $objResult["course"];?></td>
                                <td>
                                    <div align="center"><?php echo $objResult["devicetime"];?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <script>
                        var id = '<?php echo $objResult["devi_id"]?>';
                        var lat = <?php echo $objResult["lat"]?>;
                        var lng = <?php echo $objResult["lng"]?>;
                        myMark(id,lat,lng);
                       
                        </script>
                        <?
                        }
                        ?>
                    </table>

                </div>
        </div>

        
        
      


    </div>

    

    <script>
    //zoom add a scale at your map.
    var scale = L.control.scale().addTo(map);

    map.on('popupopen', function(centerMarker) {
        var cM = map.project(centerMarker.popup._latlng);
        cM.y -= centerMarker.popup._container.clientHeight /
            map.setView(map.unproject(cM), 17, {
                markerZoomAnimation: true,
                animate: true
            });
    });

    function search() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // function myPanto(id, lat, lng) {
    //     map.panTo([lat, lng], {
    //         animate: true,
    //         noMoveStart: true
    //     });
    // }
    </script>

</body>

</html>


