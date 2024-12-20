<?php 
if(isset($_GET['id']))
{
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
require_once '../../1637028036/vendor/excel1/Classes/PHPExcel.php';	
include('lcheck.php');	
if($salesorder=='0')
{
	header("Location: dashboard.php");
}
function cellColor($cells,$color){
    global $objPHPExcel;
    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}
$id=mysqli_real_escape_string($connection,$_GET['id']);	
$query = "SELECT * FROM jrctally where dname='$id' ORDER BY id ASC";  
$result = mysqli_query($connection,$query) or die(mysqli_error($connection));
$objPHPExcel = new PHPExcel(); 
$objPHPExcel->setActiveSheetIndex(0); 
$rowCount = 1; 
$fields = array('S.No','PO No', 'Item Code', 'Product Serial No'); 
$column = 'A';
for ($i = 0; $i < count($fields); $i++)  
{
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $fields[$i]);
    $column++;
}
$lastcolumn=$column;

$rowCount = 3; 
$r = 1;
while($row = mysqli_fetch_array($result)){ 
    if($row['conserialno'] != '') 
    {
        $serialNumbers = explode(' | ', $row['conserialno']);
    }
    else
    {
        $serialNumbers = array("-");
    }

    foreach ($serialNumbers as $serialNumber) {
        $rowData = array($r, $row['pono'], $row['conproductcode'], $serialNumber); 
        $column = 'A';
        for ($i = 0; $i < count($rowData); $i++)  
        {
            $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $rowData[$i]);
            $column++;
        }
        $rowCount++; 
        $r++;
    }
} 
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
$column = 'A';
for ($i = 0; $i < count($fields); $i++)  
{
$objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
$column++;
}
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$lastcolumn--;
$rowCount--;
unlink('../padhivetram/Elcot-'.$id.'.xlsx'); 
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastcolumn.$rowCount)->applyFromArray($styleArray);
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
$objWriter->save('../padhivetram/Elcot-'.$id.'.xlsx'); 
$query = "update jrctally set expelcot='1' where dname='$id'";  
$result = mysqli_query($connection,$query) or die(mysqli_error($connection));
header('location:exporttally.php?remarks=Exported Successfully');
}
?>