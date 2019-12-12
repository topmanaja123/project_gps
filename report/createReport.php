<?php
 $sql = $_POST['data'];

require_once '..\vendor\PHPspreadsheet\vendor\autoload.php';

// require './config.php';
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
];

$content = [
    'font' => [
        'bold' => false,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
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
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(29);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(29);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(29);

$sheet = $spreadsheet->getActiveSheet();

//ส่วนหัว
$sheet->setCellValue('A1', 'รายงานการเดินทางประจำวัน')->mergeCells('A1:H1')->getStyle('A1:E1')->applyFromArray($headStyle);
$sheet->setCellValue('A2', 'บริษัท มิรดา คอร์ปอเรชั่น จำกัด')->mergeCells('A2:H2')->getStyle('A2:E2')->applyFromArray($headStyle);

//ส่วนเมนู
$sheet->setCellValue('A3', 'เวลาเริ่มต้น')->mergeCells('A3:A4')->getStyle('A3')->applyFromArray($headMenu);
$sheet->setCellValue('B3', 'เวลาสิ้นสุด')->mergeCells('B3:B4')->getStyle('B3')->applyFromArray($headMenu);
$sheet->setCellValue('C3', "ความเร็วสูงสุด\n(กม./ชม.)")->mergeCells('C3:C4')->getStyle('C3')->applyFromArray($headMenu);
$sheet->getStyle('C3')->getAlignment()->setWrapText(true);
$sheet->setCellValue('D3', 'ระยะทางรวม')->mergeCells('D3:D4')->getStyle('D3')->applyFromArray($headMenu);
$sheet->setCellValue('E3', "ความเร็วเฉลี่ย\n(กม./ชม.)")->mergeCells('E3:E4')->getStyle('E3')->applyFromArray($headMenu);
$sheet->getStyle('D3')->getAlignment()->setWrapText(true);
$sheet->setCellValue('F3', 'ระยะเวลา')->mergeCells('F3:F4')->getStyle('F3')->applyFromArray($headMenu);
$sheet->setCellValue('G3', 'ตำแหน่งเริ่มต้น')->mergeCells('G3:G4')->getStyle('G3')->applyFromArray($headMenu);
$sheet->setCellValue('H3', 'ตำแหน่งสิ้นสุด')->mergeCells('H3:H4')->getStyle('H3')->applyFromArray($headMenu);
$sheet->getStyle('A3:H4')->applyFromArray($borderAll);

// //ส่วนข้อมูล
$i = 5;
foreach ($sql as $key => $value) {
$sheet->setCellValue('A' .$i, $value['timeStart'])->getStyle('A'. $i)->applyFromArray($content);
$sheet->setCellValue('B' .$i, $value['timeEnd'])->getStyle('B'. $i)->applyFromArray($content);
$sheet->setCellValue('C' .$i, $value['Fmaxspees'])->getStyle('C'. $i)->applyFromArray($content);
$sheet->setCellValue('D' .$i, $value['FtotalDis'])->getStyle('D'. $i)->applyFromArray($content);
$sheet->setCellValue('E' .$i, $value['FavgSpeed'])->getStyle('E'. $i)->applyFromArray($content);
$sheet->setCellValue('F' .$i, $value['totalTime'])->getStyle('F'. $i)->applyFromArray($content);
$sheet->setCellValue('G' .$i, $value['poiStart'])->getStyle('G'. $i)->applyFromArray($content);
$sheet->setCellValue('H' .$i, $value['poiEnd'])->getStyle('H'. $i)->applyFromArray($content);
$sheet->getStyle('A'.$i.':'.'H'.$i)->applyFromArray($borderAll);
$i++;
};
print_r($sql);
$writer = new Xlsx($spreadsheet);
// $filename = 'report.xlsx';

$writer->save('excel/report.xlsx');
?>

