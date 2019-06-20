<!DOCTYPE html>
<?php
include('function.php');
include('config.php');
$sql = "SELECT * FROM positions";
$result = $conn->query($sql);
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style media="screen">
        #siglow{
          color: #ff2600;
        }
        #sigmid{
          color: #ffb000;
        }
        #sighig{
          color: #50e600;
        }
    </style>

  </head>
  <body>
    <div class="row">
      <table class="table table-striped table-borderless table-responsive table-sm" border="0" style="width:100%;" >
        <thead class="thead-dark">
          <tr>
            <th style="width:7%" class="text-center"> <input type="checkbox" name="" value=""> </th>
            <th class="text-center"></i> </th>
            <th style="width:58%" class="text-center"> <i class="fas fa-car"></i>
               ชื่ออุปกรณ์
            </th>
            <th style="width:7%" class="text-center"> <i class="fas fa-gas-pump" data-toggle="tooltip" data-placement="top" title="น้ำมัน"></i>
            </th>
            <th style="width:7%" class="text-center  d-md" data-toggle="tooltip" data-placement="top" title="ความเร็ว"> km/h</th>
            <th style="width:7%" class="text-center"><i class="fas fa-signal" data-toggle="tooltip" data-placement="top" title="สถานะการณ์ปัจจุบัน"></th>
            <th style="width:7%" class="text-center"><i class="fas fa-globe " data-toggle="tooltip" data-placement="top" title="GPS State"></th>
            <th style="width:7%" class="text-center"><i class="fas fa-route " data-toggle="tooltip" data-placement="top" title="เส้นทางการวิ่ง"  ></th>
          </tr>
        </thead>
        <tbody>
          <?php
           while ($rs = $result->fetch_assoc()) {
          ?>
          <tr >
            <td scope="row"><input type="checkbox" name="" value=""></td>
            <td class="text-center"><i class="fas fa-user fa-sm"></i></td>
            <td style="cursor: pointer;" onclick="clickZoom()"><?= $rs['device'] ?></td>
            <td class="text-center">0.0</td>
            <td class="text-center" canSendCmds><?= $rs['speed'] ?></td>
            <td class="text-center" style="font-size: 1rem;"><i id="acc" class="fas fa-minus-circle"></i>  </td>
            <td class="text-center" style="font-size: 1rem;">
              <i id="siglow" class="far fa-thermometer-empty fa-sm"></i>
              <i id="sigmid" class="fas fa-thermometer-half"></i>
              <i id="sighig" class="fas fa-thermometer-full"></i>
            </td>
            <td class="text-center"> <input type="checkbox" name="" value=""> </td>
          </tr>
          <?php
        }
           ?>
        </tbody>
      </table>

    </div>
  </body>
</html>
