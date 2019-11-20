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

    <?php
require_once '../vendor/PHPspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set("Asia/Bangkok");
$spreadsheet = new Spreadsheet();

$headStyle = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    // 'borders' => [
    //     'top' => [
    //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //     ],
    // ],
];

$headMenu = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
];

$borderAll = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '#000000'],
        ],
    ],
];

//Set ฟอร์น
$spreadsheet->getDefaultStyle()->getFont()->setName('TH SarabunPSK');
$spreadsheet->getDefaultStyle()->getFont()->setSize(16);

//Set Column Width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(16);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(29);

$sheet = $spreadsheet->getActiveSheet();

//ส่วนหัว
$sheet->setCellValue('A1', 'รายงานการเดินทางประจำวัน '.$monthStr.' '.$yearStr)->mergeCells('A1:E1')->getStyle('A1:E1')->applyFromArray($headStyle);
$sheet->setCellValue('A2', 'บริษัท มิรดา คอร์ปอเรชั่น จำกัด')->mergeCells('A2:E2')->getStyle('A2:E2')->applyFromArray($headStyle);

//ส่วนเมนู
$sheet->setCellValue('A4', 'เวลาเริ่มต้น')->mergeCells('A4:A5')->getStyle('A4')->applyFromArray($headMenu);
$sheet->setCellValue('B4', 'เวลาสิ้นสุด')->mergeCells('B4:B5')->getStyle('B4')->applyFromArray($headMenu);
$sheet->setCellValue('C4', "ความเร็วสูงสุด\n(กม./ชม.)")->mergeCells('C4:C5')->getStyle('C4')->applyFromArray($headMenu);
$sheet->getStyle('C4')->getAlignment()->setWrapText(true);
$sheet->setCellValue('D4', "ความเร็วเฉลี่ย\n(กม./ชม.)")->mergeCells('D4:D5')->getStyle('D4')->applyFromArray($headMenu);
$sheet->getStyle('D4')->getAlignment()->setWrapText(true);
$sheet->setCellValue('E4', 'ระยะเวลา')->mergeCells('E4:E5')->getStyle('E4')->applyFromArray($headMenu);
$sheet->getStyle('A4:E5')->applyFromArray($borderAll);

$writer = new Xlsx($spreadsheet);
$filename = 'รายงานการเดินทางประจำวัน';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

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