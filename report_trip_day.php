<?php
require 'js.php';
require 'report/function_report.php';
// require 'all_functions.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">


    <link rel="stylesheet" type="text/css" href="css/time/jquery.timepicker.css"/>
    <script type="text/javascript" src="js/time/jquery.timepicker.js"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


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
    </style>
    <title>รายงานระยะทาง</title>
</head>

<body>
    <?php
    require 'config.php';
    $sql = 'SELECT `devices`.* FROM `devices`';
    $result = $conn->query($sql);

    // $attPosition = "SELECT `positions`.* FROM `positions`";
    // $rePosition = $conn->query($attPosition);

    ?>

    <?php
    if (isset($_POST['serach'])) {
        $dateStart = Datestr($_POST['startDate']) . ' ' . $_POST['timeStart'];
        $dateEnd = Datestr($_POST['dateEnd']) . ' ' . $_POST['timeEnd'];

       echo $sqlPosition = "SELECT  * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";

        // echo $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";
        $resultPosition = $conn->query($sqlPosition);
    }
    ?>
    <?php
// require_once './vendor/PHPspreadsheet/vendor/autoload.php';
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// date_default_timezone_set("Asia/Bangkok");
// $spreadsheet = new Spreadsheet();

// $headStyle = [
//     'font' => [
//         'bold' => true,
//     ],
//     'alignment' => [
//         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
//     ]

// ];

// $content = [
//     'font' => [
//         'bold' => false,
//     ],
//     'alignment' => [
//         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
//         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
//     ],
// ];

// $headMenu = [
//     'font' => [
//         'bold' => true,
//     ],
//     'alignment' => [
//         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
//         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
//     ],
// ];

// $borderAll = [
//     'borders' => [
//         'allBorders' => [
//             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
//             'color' => ['argb' => '#000000'],
//         ],
//     ],
// ];

// //Set ฟอร์น
// $spreadsheet->getDefaultStyle()->getFont()->setName('TH SarabunPSK');
// $spreadsheet->getDefaultStyle()->getFont()->setSize(16);

// //Set Column Width
// $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
// $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(16);
// $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
// $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
// $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(29);

// $sheet = $spreadsheet->getActiveSheet();

// //ส่วนหัว
// $sheet->setCellValue('A1', 'รายงานการเดินทางประจำวัน '.$monthStr.' '.$yearStr)->mergeCells('A1:E1')->getStyle('A1:E1')->applyFromArray($headStyle);
// $sheet->setCellValue('A2', 'บริษัท มิรดา คอร์ปอเรชั่น จำกัด')->mergeCells('A2:E2')->getStyle('A2:E2')->applyFromArray($headStyle);

// //ส่วนเมนู
// $sheet->setCellValue('A4', 'เวลาเริ่มต้น')->mergeCells('A4:A5')->getStyle('A4')->applyFromArray($headMenu);
// $sheet->setCellValue('B4', 'เวลาสิ้นสุด')->mergeCells('B4:B5')->getStyle('B4')->applyFromArray($headMenu);
// $sheet->setCellValue('C4', "ความเร็วสูงสุด\n(กม./ชม.)")->mergeCells('C4:C5')->getStyle('C4')->applyFromArray($headMenu);
// $sheet->getStyle('C4')->getAlignment()->setWrapText(true);
// $sheet->setCellValue('D4', 'ระยะทางรวม')->mergeCells('D4:D5')->getStyle('D4')->applyFromArray($headMenu);
// $sheet->setCellValue('E4', "ความเร็วเฉลี่ย\n(กม./ชม.)")->mergeCells('E4:E5')->getStyle('E4')->applyFromArray($headMenu);
// $sheet->getStyle('D4')->getAlignment()->setWrapText(true);
// $sheet->setCellValue('F4', 'ระยะเวลา')->mergeCells('F4:F5')->getStyle('F4')->applyFromArray($headMenu);
// $sheet->getStyle('A4:E5')->applyFromArray($borderAll);
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
                                    <input class="form-control form-control-sm" name="startDate" id="startDate1"
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
                                <table class="table table-bordered wrap-table100 table-sm">
                                    <thead>
                                        <tr>
                                            <td style="text-align:center;">เวลาเริ่มต้น</td>
                                            <td style="text-align:center;">เวลาสิ้นสุด</td>
                                            <td style="text-align:center;">ความเร็วสูงสุด <br>(กม./ชม.)</td>
                                            <td style="text-align:center;">ระยะทางรวม</td>
                                            <td style="text-align:center;">ความเร็วเฉลี่ย <br>(กม./ชม.)</td>
                                            <td style="text-align:center;">ระยะเวลา</td>
                                            <td style="text-align:center;">สถานที่(เริ่ม)</td>
                                            <td style="text-align:center;">สถานที่(สิ้นสุด)</td>
                                      
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $i = 6;
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


                                                while ($rsData = $resultPosition->fetch_assoc()) {
                                                    $att = json_decode($rsData['attributes'], true);
                                                    $deviceTime = $rsData['devicetime'];
                                                    //    echo $att{'ignition'};
                                                    if ($rsData['protocol'] == 'meiligao' || $rsData['protocol'] == 'meitrack' || $rsData['protocol'] == 'h02') {
                                                        $status = keyCheck($att['status'], $rsData['protocol']);
                                                        //    $fule = fuel($att->{'adc1'});
                                                    } elseif ($rsData['protocol'] == 'gt06') {
                                                        if ($att['ignition'] == true) {
                                                            $status = '1';
                                                        } elseif ($att['ignition'] == false) {
                                                            $status = '0';
                                                        } else { }
                                                    }

                                                    if ($status == '1') {
                                                        if ($timeStart == '') {
                                                           
                                                        $timeStart = $deviceTime;
                                                        }
                                                        
                                                        $latlng = $rsData['latitude'] . ',' . $rsData['longitude'];
                                                        if($poiStart == ''){
                                                            $poiStart = $latlng;
                                                        }
                                                    //   echo $addr = geocodeLatLng($latlng,$latlng,$latlng);
      
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
                                                      $totalTime = Ddiff($timeStart,$timeEnd)."<br>";
                                                      
                                               
                                                        echo '<tr>';
                                                            echo '<th style="text-align:center;">'. $timeStart .'</th>';
                                                            echo '<th style="text-align:center;">'. $timeEnd .'</th>';
                                                            echo '<th style="text-align:right;">'. number_format($maxSpeed,2).'</th>';
                                                            echo '<th style="text-align:right;" >'. number_format($totalDistand,2).' กม.'. '</th>';
                                                            echo '<th style="text-align:right;">'. number_format($avgSpeed,2).'</th>';
                                                            echo '<th style="text-align:right;">'. $totalTime .'</th>';
                                                            echo '<th style="text-align:right;">'. $poiStart.'</th>';
                                                            echo '<th style="text-align:right;">'. $poiEnd .'</th>';
                                                            
                                                        echo '</tr>';
                                                    
                                                        

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
                                                        $i++;

                                                        // $status = '';
                                                        // $avgSpeed = $totalSpeed / $count;
                                                    } ?>


                                        <?php
                                                // $sheet->setCellValue('A' .$i, $timeStart)->getStyle('A'. $i)->applyFromArray($content);
                                                // $sheet->setCellValue('B' .$i, $timeEnd)->getStyle('B'. $i)->applyFromArray($content);
                                                // $sheet->setCellValue('C' .$i, number_format($maxSpeed,2))->getStyle('C'. $i)->applyFromArray($content);
                                                // $sheet->setCellValue('D' .$i, number_format($totalDistand,2))->getStyle('D'. $i)->applyFromArray($content);
                                                // $sheet->setCellValue('E' .$i, number_format($avgSpeed,2))->getStyle('E'. $i)->applyFromArray($content);
                                                // $sheet->setCellValue('F' .$i, $totalTime)->getStyle('F'. $i)->applyFromArray($content);
                                                
                                                // $sheet->getStyle('A'.$i.':'.'F'.$i)->applyFromArray($borderAll);
                                                } //while($rsData = $resultPosition->fetch_assoc())
                                               
                                            // $writer = new Xlsx($spreadsheet);
                                            // $filename = 'report.xlsx';
                                  
                                            // $writer->save('excel/'.$filename);
                                                ?>
                                    </tbody>
                                </table>
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-info"><span class="fas fa-file-export"></span>
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