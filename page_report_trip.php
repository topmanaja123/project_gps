<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <style media="screen">
    .select2-container--bootstrap4 .select2-selection {
        /* background-color: #fff; */
        /* outline: 0; */
        /* display: inline-block; */
        /* border: 1px solid #ced4da; */
        /* border-radius: .10rem; */
        /* width: 100%; */
        height: calc(1.8rem + 2px);
        padding: .200rem .50rem;
        line-height: 1.5;
        color: #495057;
    }

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
    </style>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->
    <title></title>
        
    
</head>

<body>
    <?php
      require "config.php";
        $sql = "SELECT `devices`.* FROM `devices`";
        $result = $conn->query($sql);
    ?>

    <?php
      if (isset($_POST['serach'])) {
        $sqlPosition = "SELECT * FROM positions WHERE device_id = $_POST[dev_id] AND devicetime BETWEEN '$_POST[date_start]' AND '$_POST[date_end]'";
        $resultPosition = $conn->query($sqlPosition);
        // $resultPositionLine = $conn->query($sqlPosition);
        // echo $sqlDate;
        // echo '<br>';
        // echo $sqlPosition;
      }
    ?>
    <p></p>
    <form action="" method="post">
        <div class="card card-wrap" style="width: 99%">
            <div class="card-header bg-success">
                <div class="text-center">
                    <span id="head-card"> <strong>รายงานการเดินทาง</strong> </span>
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
                                <option value="<?=$rs['devi_id'];?>"><?=$rs['devi_name'];?></option>
                                <?php
                                  }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="col">
              <label for="input1">แยกโดย</label>
              <select class="form-control form-control-sm ">
                <option>ลอง1</option>
                <option>2อง1</option>
              </select>
            </div> -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 col-sm">
                            <label for="input1">จากเวลา</label>
                            <input type="date" class="form-control form-control-sm" name="date_start" placeholder="">
                        </div>
                        <div class="col-xs-12 col-sm">
                            <label for="input1">ถึงเวลา</label>
                            <input type="date" class="form-control form-control-sm" name="date_end" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 offset-md-4 text-center">
                        <button class="btn btn-info btn-block" type="submit" name="serach">ค้นหา</button>
                        <button class="btn btn-success btn-block" type="button" name="print">ออกรายงาน</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <p>
        <?php
          if ($resultPosition) {
        ?>
        <div class="card card-wrap" style="width: 99%">
            <div class="card-header bg-success">
                <div class="text-center ">
                    <span id="head-card"> <strong>ข้อมูลเส้นทาง</strong> </span>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <td>เวลา</td>
                                    <td>latitude</td>
                                    <td>longitude</td>
                                    <td>ความเร็ว</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  while ($rs1 = $resultPosition->fetch_assoc()) {
                                ?>
                                <tr>
                                    <th><?= $rs1['devicetime'];?></th>
                                    <th><?= $rs1['lat'];?></th>
                                    <th><?= $rs1['lng'];?></th>
                                    <th><?= $rs1['speed'];?></th>
                                </tr>
                                <?php
                                  } // while ($rs1 = $resultDate->fetch_assoc()) {
                                ?>
                            </tbody>
                        </table>

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
    $('#example').DataTable();
} );
</script>