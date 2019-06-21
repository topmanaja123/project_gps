<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
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
$sql = "SELECT
     `devices`.`devi_id`,
     `devices`.`devi_name`,
     `devices`.`devi_imei`,
     `devices`.`id_position`,
     `devices`.`rfid_name`,
     `devices`.`rfid_number`,
     `positions`.`devicetime`,
     `positions`.`servertime`,
     `positions`.`altitude`,
     `positions`.`lat`,
     `positions`.`lng`,
     `positions`.`speed`,
     `positions`.`course`,
     `positions`.`attributes`,
     `positions`.`valid`,
     `positions`.`state`
   FROM
     `devices`
      INNER JOIN `positions` ON `devices`.`id_position` = `positions`.`posi_id`";
$result = $conn->query($sql);
    
    ?>
    <?php
    if(isset($_POST['serach'])) {
      $sqlData= "SELECT * FROM `positions` WHERE posi_id AND device_id ='7' AND devicetime BETWEEN '$_POST[date_start]' AND '$_POST[date_end]' order by devicetime DESC";
      $sqlDistance = $conn->query($sqlData);
    }
    ?>
    <p>
        <p>
            <form action="" method="post">
                <div class="card card-wrap" style="width: 99%">
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
                                    <select class="form-control form-control-sm" name="dev_id">
                                        <option selected>--เลือก--</option>
                                        <?php
                                          while ($rs = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $rs['devi_id']?>"><?=$rs['devi_name']?></option>
                                        <?php
                                          }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm">
                                    <label for="input1">จากเวลา</label>
                                    <input type="date" class="form-control form-control-sm" name="date_start"
                                        placeholder="">
                                </div>
                                <div class="col-xs-12 col-sm">
                                    <label for="input1">ถึงเวลา</label>
                                    <input type="date" class="form-control form-control-sm" name="date_end"
                                        placeholder="">
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
                                            <td>ชื่ออุปกรณ์</td>
                                            <td>ระยะทาง</td>
                                            <td>ความเร็วสูงสุด</td>
                                            <td>ความเร็วเฉลี่ย</td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
</body>

</html>