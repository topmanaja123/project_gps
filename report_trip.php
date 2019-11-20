<?php
require 'js.php';
require 'css.php';
// require 'all_functions.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">


    <script type="text/javascript" src="js/time/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="css/time/jquery.timepicker.css" />

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <style media="screen">
    #head-card {
        color: White;
        text-shadow: 2px 2px 5px black;
    }

    .wrap-table100 {
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
    }

    .card-wrap {
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
    }
    </style>
    <title>รายงานระยะทาง</title>
</head>

<body>
    <?php
    require "config.php";
    $sql = "SELECT `devices`.* FROM `devices`";
    $result = $conn->query($sql);
    ?>
    <?php
    if (isset($_POST['serach'])) {
        $dateStart = DateYMD($_POST['dateStart']).' '.$_POST['startTime'];
        $dateEnd = DateYMD($_POST['dateEnd']).' '.$_POST['endTime'];

      
        echo $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";
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
                            <label for="input1">อุปกรณ์</label>
                            <select class="form-control form-control-sm select2" name="deviceid" required>
                                <option value="" disabled selected>---------เลือกอุปกรณ์---------</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="input1">เริ่มวันที่</label>
                                    <input class="form-control form-control-sm" id="startDate" name="dateStart"
                                        autocomplete="off" required>
                                </div>
                                <div class=" col-md-2">
                                    <label for="input1">เวลาเริ่มต้น</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-sm" name="startTime" id="timeStart"
                                            value="00:00" placeholder="">
                                        <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label for="input1">สิ้นสุดวันที่</label>
                                    <input class="form-control form-control-sm" id="endDate" name="dateEnd"
                                        autocomplete="off" required>
                                </div>

                                <div class=" col-md-2">
                                    <label for="input1">ถึงเวลาสิ้นสุด</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-sm" name="endTime" id="timeEnd"
                                            value="23:59" placeholder="">
                                        <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                                    </div>
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
                            <span id="head-card"> <strong>ข้อมูลระยะทาง</strong> </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered wrap-table100">
                                    <thead>
                                        <tr>
                                            <td>เวลา</td>
                                            <td>ความเร็ว</td>
                                            <td>น้ำมันคงเหลือในถัง</td>
                                            <td>ละติจูด/ลองจิจูด</td>
                                            <td>รายละเอียด</td>
                                            <td>ที่อยู่</td>
                                            <td>ดูแผนที่</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                             while($rsData = $resultPosition->fetch_assoc()){
                                        ?>
                                        <tr>
                                            <th><?= $rsData['devicetime'];?></th>
                                            <th><?= $rsData['speed'];?></th>
                                            <th><?= $rsData['devicetime'];?></th>
                                            <th><?= $rsData['latitude'];?>,<?= $rsData['lngitude'];?></th>
                                            <th><?= $rsData['devicetime'];?></th>
                                            <th><?= $rsData['devicetime'];?></th>
                                        </tr>
                                        <?php
                                        }
                                     ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $resultPosition->close();
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

$('#endDate').datepicker({
    uiLibrary: 'bootstrap4'
});

$('#timeStart').timepicker({
    'timeFormat': 'H:i'
});

$('#timeEnd').timepicker({
    'timeFormat': 'H:i'
});
</script>
