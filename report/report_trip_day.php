<?php
require 'js.php';
require 'function_report.php';
// require 'all_functions.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/time/jquery.timepicker.css" />
    <script type="text/javascript" src="./js/time/jquery.timepicker.js"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="report\css\table-custom.css">
    <link rel="stylesheet" href="report\css\custom-scrollbars.css">

    <style media="screen">
    #head-card {
        color: White;
        text-shadow: 2px 2px 5px black;
    }

    .wrap-table100 {
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
    }

    .card-wrap {
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
    }

    .btn-outline-secondary {
        color: #495057 !important;
        background-color: #e9ecef !important;
    }

    .gj-icon {
        line-height: 0.8;
    }
    </style>
    <title>รายงานระยะทาง</title>
</head>

<script>
function creatSheet(datasent) {
    $.ajax({
        url: "report/createReport.php",
        type: "POST",
        // cache: false,
        data: {
            data: datasent,
        }, // multiple data sent using ajax
        success: function(resual) {
            // console.log(resual)
        }
    });
    // console.log(datasent);
}
</script>

<body>
    <?php
    require './config.php';
    $sql = "SELECT
    `user_device`.`userid`,
    `devices`.*
  FROM
    `devices`
    INNER JOIN `user_device` ON `devices`.`id` = `user_device`.`deviceid`
    WHERE `user_device`.`userid` = $_SESSION[userid]";
    $result = $conn->query($sql);
    // $attPosition = "SELECT `positions`.* FROM `positions`";
    // $rePosition = $conn->query($attPosition);
    ?>
    <?php
    if (isset($_POST['serach'])) {
        $dateStart = Datestr($_POST['startDate']) . ' ' . $_POST['timeStart'];
        $dateEnd = Datestr($_POST['dateEnd']) . ' ' . $_POST['timeEnd'];

        $sqlPosition = "SELECT  * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";
        // echo $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";
        $resultPosition = $conn->query($sqlPosition);
     }
    ?>
    <p>
        <p>
            <form id="search" action="" method="post" style="width: 99%" onsubmit="return checkInterval()">
                <div class="card card-wrap">
                    <div class="card-header bg-success">
                        <div class="text-center">
                            <span id="head-card"> <strong>รายงานระยะทาง</strong> </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input1">อุปกรณ์</label>
                            <select class="form-control form-control-sm select2" name="deviceid" required>
                                <option value="" disabled selected>---------เลือกอุปกรณ์---------</option>
                                <?php while ($row = $result->fetch_assoc()) {
                                    ?>
                                <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="input1">วันที่เริ่มต้น</label>
                                    <input class="form-control form-control-sm" name="startDate" id="startDate"
                                        autocomplete="off" required>
                                </div>
                                <div class="col">
                                    <label for="input1">เวลาเริ่มต้น</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="timeStart"
                                            name="timeStart" aria-describedby="basic-addon3" value="00:00"
                                            autocomplete="off" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text rounded-right"><i
                                                    class="fa fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="input1">สิ้นสุดวันที่</label>
                                    <input class="form-control form-control-sm" id="dateEnd" name="dateEnd"
                                        autocomplete="off" required>
                                </div>

                                <div class="col">
                                    <label for="input1">ถึงเวลาสิ้นสุด</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="timeEnd"
                                            name="timeEnd" aria-describedby="basic-addon3" value="23:59"
                                            autocomplete="off" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text rounded-right"><i
                                                    class="fa fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" class="type" value="<?= $sqlPosition ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 offset-md-4 text-center">
                                <button class="btn btn-info btn-block" onclick="clear()" type="submit"
                                    name="serach">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <p>
                <?php
                if (isset($resultPosition)) {
                    ?>
                <div class="card card-res card-wrap">
                    <div class="card-header bg-success">
                        <div class="text-center">
                            <span id="head-card"> <strong>ข้อมูลระยะทาง</strong> </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-fixed table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; width:11%">เวลาเริ่มต้น</th>
                                            <th style="text-align:center; width:11%">เวลาสิ้นสุด</th>
                                            <th style="text-align:center; width:10%">ความเร็วสูงสุด</th>
                                            <th style="text-align:center; width:10%">ระยะทางรวม</th>
                                            <th style="text-align:center; width:10%">ความเร็วเฉลี่ย</th>
                                            <th style="text-align:center; width:10%">ระยะเวลา</th>
                                            <th style="text-align:center; width:19%">สถานที่(เริ่ม)</th>
                                            <th style="text-align:center; width:19%">สถานที่(สิ้นสุด)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $status = '';
                                                $fule = '';
                                                $count = 0;
                                                $maxSpeed = 0;
                                                $distand = 0;
                                                $totalDistand = 0;
                                                $point1 = '';
                                                $point2 = '';
                                                $timeStart = '';
                                                $timeEnd = '';
                                                $totalTime = '';
                                                $totalSpeed = 0;
                                                $poiStart = '';
                                                $poiEnd = '';
                                                
                                                $dataSend = array();
                                                while ($rsData = $resultPosition->fetch_assoc()) {
                                                    $att = json_decode($rsData['attributes'], true);
                                                    $deviceTime = $rsData['devicetime'];
                                                  
                                                    if ($rsData['protocol'] == 'meiligao' || $rsData['protocol'] == 'meitrack' || $rsData['protocol'] == 'h02') {
                                                      $status = keyCheck($att['status'], $rsData['protocol']);
                                                        // $fule = fuel($att['adc1'],$rsData['protocol']);
                                                    } elseif ($rsData['protocol'] == 'gt06') {
                                                        if ($att['ignition'] == true) {
                                                           $status = '1';
                                                        } elseif ($att['ignition'] == false) {
                                                           $status = '0';
                                                        } else { 
                                                            
                                                        }
                                                    }

                                                    if ($status == '1') {
                                                        if ($timeStart == '') {
                                                        $timeStart = $deviceTime;
                                                        }
                                                        
                                                        $latlng = $rsData['latitude'] . ',' . $rsData['longitude'];
                                                        if($poiStart == ''){
                                                           $poiStart = $latlng;
                                                        }
                                                
      
                                                        $count = $count + 1;
                                                        if ($rsData['speed'] > $maxSpeed) {
                                                          $maxSpeed = $rsData['speed'] * 1.852;
                                                            // $rsData['speed'].'</br>';
                                                        }

                                                        if ($point1 != '') {
                                                            $startPoint = $latlng;
                                                            $point2 = $latlng;
                                                            $distance = distand($point1, $point2);
                                                            $totalDistand = $totalDistand + $distance;
                                                            $point1 = $latlng;
                                                        } else {
                                                            $point1 = $latlng;
                                                        }
                                                        $totalSpeed = $totalSpeed + $maxSpeed;

                                                    } elseif ($status == '0' AND $count > 0) {
                                                        $avgSpeed = ($totalSpeed / $count);
                                                        $endPoint = $latlng;
                                                        $poiEnd = $latlng;
                                                        $timeEnd = $deviceTime;  
                                                        $totalTime = Ddiff($timeStart,$timeEnd);
                                                        $Fmaxspees =  number_format($maxSpeed,2);
                                                        $FtotalDis = number_format($totalDistand,2);
                                                        $FavgSpeed =  number_format($avgSpeed,2);

                                                        echo '<tr>';
                                                            echo '<td style="text-align:center; width:11%">'. $timeStart .'</td>';
                                                            echo '<td style="text-align:center; width:11%">'. $timeEnd .'</td>';
                                                            echo '<td style="text-align:right; width:10%">'. $Fmaxspees.' กม./ชม.'.'</td>';
                                                            echo '<td style="text-align:right; width:10%">'. $FtotalDis .' กม.'.'</td>';
                                                            echo '<td style="text-align:right; width:10%">'.$FavgSpeed .' กม./ชม.'.'</td>';
                                                            echo '<td style="text-align:right; width:10%">'. $totalTime .'</td>';
                                                            echo '<td style="text-align:right; width:19%">'. $poiStart.'</td>';
                                                            echo '<td style="text-align:right; width:19%">'. $poiEnd .'</td>';
                                                        echo '</tr>';

                                                       $send = array(
                                                            "timeStart" => $timeStart,
                                                            "timeEnd" => $timeEnd,
                                                            "Fmaxspees" =>$Fmaxspees,
                                                            "FtotalDis" => $FtotalDis,
                                                            "FavgSpeed" => $FavgSpeed,
                                                            "totalTime" => $totalTime,
                                                            "poiStart" => $poiStart,
                                                            "poiEnd" => $poiEnd
                                                        );
                                                        $dataSend1 = array_push($dataSend,$send);
          
                                                        $point1 = '';
                                                        $point2 = '';
                                                        $count = 0;
                                                        $maxSpeed = 0;
                                                        $timeStart = '';
                                                        $timeEnd = '';
                                                        $totalDistand = 0;
                                                        $totalTime = '';
                                                        $totalSpeed = 0;
                                                        $poiStart = '';
                                                        $poiEnd = '';

                                                        // $status = '';
                                                        // $avgSpeed = $totalSpeed / $count;
                                                    } 
                                                    ?>

                                        <?php
                                                    } //while($rsData = $resultPosition->fetch_assoc())
                                                  $jsonData = json_encode($dataSend);
                                                  echo $postdata = "<script>creatSheet(".$jsonData.")</script>";
                                             ?>
                                    </tbody>
                                </table>
                                <div class="col text-center">
                                    <button onclick="report()" type="button" class="btn btn-info" name=""><span
                                            class="fas fa-file-export"></span>
                                        ออกรายงาน
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>
</body>

</html>
<script src="report\js\function_report.js"></script>
<script>
function report() {
    location.replace('report/excel/report.xlsx');
}
</script>

<script>
$(document).ready(function() {
    $('.select2').select2();
});

$('#startDate').datepicker({
    uiLibrary: 'bootstrap4'
});

$('#dateEnd').datepicker({
    uiLibrary: 'bootstrap4'
});

$('#timeStart').timepicker({
    'timeFormat': 'H:i'
});

$('#timeEnd').timepicker({
    'timeFormat': 'H:i'
});
</script>