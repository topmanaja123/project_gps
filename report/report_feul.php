<?php
// require 'js.php';
require 'function_report.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- css && js graph -->
    <link rel="stylesheet" href="report\css\graph.css">
    <script src="report\js\graph.js"></script>


    <!-- vue js -->

    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>

    <title>รายงานระยะทาง</title>

    <style>
    #chart {
        max-width: 1000px;
        margin: 35px auto;
    }

    .toolbar {
        margin-left: 45px;
    }

    button {
        background: #fff;
        color: #222;
        border: 1px solid #e7e7e7;
        border-bottom: 2px solid #ddd;
        border-radius: 2px;
        padding: 4px 17px;
    }

    button.active {
        color: #fff;
        background: #008FFB;
        border: 1px solid blue;
        border-bottom: 2px solid blue;
    }

    button:focus {
        outline: 0;
    }
    </style>
</head>

<body>
    <?php
    require 'config.php';
    $sql = 'SELECT `devices`.* FROM `devices`';
    $result = $conn->query($sql);
   ?>

    <?php
    if (isset($_POST['serach'])) {
        $dateStart = Datestr($_POST['startDate']);
        $dateEnd = Datestr($_POST['dateEnd']);

        echo $sqlPosition = "SELECT  * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";
        // echo $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";
        $resultPosition = $conn->query($sqlPosition);
    }
    ?>
    <p>
        <p>
            <form action="" method="post" class="container-fluid">
                <div class="card card-wrap">
                    <div class="card-header bg-success">
                        <div class="text-center">
                            <span id="head-card"> <strong>รายงานระยะทาง</strong> </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
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
                                <div class="col">
                                    <label for="input1">วันที่เริ่มต้น</label>
                                    <input class="form-control form-control-sm" name="startDate" id="startDate"
                                        autocomplete="off" required>
                                </div>
                                <div class="col">
                                    <label for="input1">สิ้นสุดวันที่</label>
                                    <input class="form-control form-control-sm" id="dateEnd" name="dateEnd"
                                        autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 offset-md-4 text-center">
                                <button class="btn btn-info btn-block" type="submit" name="serach">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <p>

                <?php
                if (isset($resultPosition)) {
                    ?>
                <div class="card card-wrap" style="width: 99%">
                    <div class="card-header bg-success">
                        <div class="text-center ">
                            <span id="head-card"> <strong>กราฟข้อมูลการใช้น้ำมัน</strong> </span>
                        </div>
                    </div>

                    <?php
                            $status = '';
                        //    $result = $resultPosition->num_rows ;
                        // $dataSend = array(
                        //         // "key" => 'key',
                        //         // "values" => []
                        //   );

                            while ($rsData = $resultPosition->fetch_assoc()) {
                                // $check += 1; 
                                $att = json_decode($rsData['attributes'], true);
                                $deviceTime = $rsData['devicetime'];
                                // $strTime = strtotime($deviceTime);
                                // echo $att['status'];

                                if ($rsData['protocol'] == 'meiligao' || $rsData['protocol'] == 'meitrack' || $rsData['protocol'] == 'h02') {
                                  $status = keyCheck($att['status'], $rsData['protocol']);
                                     $fule = fuel($att['adc1'], $rsData['protocol']);
                                } elseif ($rsData['protocol'] == 'gt06') {
                                    if ($att['ignition'] == true) {
                                        $status = '1';
                                    } elseif ($att['ignition'] == false) {
                                        $status = '0';
                                    } else { }
                                }

                                if ($status == '1') {
                                   if ($fule>'0') {
                                        // echo '3';
                                        $x = $deviceTime;
                                        $y = $fule;
                                    $send .= '['.'"'.$x.'"'.','.number_format($y, 2).'],';
                                    } elseif ($fule<'0'){
                                        // echo '5';
                                        $x = $deviceTime;
                                        $y = '0';
                                    $send .= '['.'"'.$x.'"'.','.number_format($y, 2).'],';
                                    } elseif ($fule == '0') {
                                      echo "<script>alert('รถไม่มีการเก็บค่าของน้ำมัน')</script>";
                                        //     echo '5';
                                        // $check = 0;
                                        break; 
                                    }
                                } elseif ($status == '0') {
                                    if ($fule != '0') {
                                        // echo '1';
                                    $x = $deviceTime;
                                    $y = $y;
                                    $send .= '['.'"'.$x.'"'.','.number_format($y, 2).'],';
                                    }elseif ($fule == '0'){
                                        // echo '2';
                                          $x = $deviceTime;
                                          $last = $y;
                                    $send .= '['.'"'.$x.'"'.','.number_format($last, 2).'],';
                                    }
                                } 
                                $status = '';
                                // echo $check;
                                ?>

                            <?php
                                } //  while ($rsData = $resultPosition->fetch_assoc())
                           echo $arrGraph = '['.$send.']';
                                // print_r($dataSend);
                                // echo $jsonGraph = json_encode($dataSend);
                                // echo $graph = json_decode($jsonGraph, true);
                                echo "<script>createGraph(".$arrGraph.")</script>";                 
                            ?>
                    <div class="card-body">
                        <div id="chart">
                            <div style="font-size: 20px; text-align: center">กราฟรายงานน้ำมัน</div>
                            <div>
                                <apexchart type=area height=350 :options="chartOptions" :series="series" />
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
    uiLibrary: 'bootstrap',
    'timeFormat': 'H:i'
});

$('#timeEnd').timepicker({
    uiLibrary: 'bootstrap',
    'timeFormat': 'H:i'
});
</script>