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
$fields = array('','DATE', 'MAIN CATEGORY', 'TENDER WISE', 'SUB CATEGORY', 'Department Name', 'Other Reference', 'PURCHASE ORDER.NO.', 'PO DATE', 'CUSTOMER REFERENCE ID', 'DUE DAYS', 'BUYER      ADDRESS', 'ADDRESS 1', 'ADDRESS 2', 'ADDRESS 3', 'ADDRESS 4', 'Statename', 'Registration Type', 'GSTIN.NO.', 'consignee no', 'CONSIGNEE ADDRESS', 'ADDRESS 1', 'ADDRESS 2','address3', 'TALUK', 'DISTRICT ', 'PIN CODE', 'Contact Person', 'PHONE.NO.', 'MOBILE.NO.', 'MAIL ID', 'PRODUCT GROUP','MULTIPLE     GODOWN', 'PRODUCT ', 'QTY', 'UPS Sl.No.', 'Battery Sl.No.', 'Unit Price', 'Installation Charge', 'DISCOUNT', 'IGST', 'SGST', 'CGST', 'IGST AMOUNT', 'SGST AMOUNT', 'CGST AMOUNT', 'ROUNDED OFF', 'TOTAL AMOUNT', 'warranty months', '', ''); 
$column = 'A';
for ($i = 0; $i < count($fields); $i++)  
{
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $fields[$i]);
    $column++;
}
$lastcolumn=$column;

$rowCount = 3; 
while($row = mysqli_fetch_array($result)){ 

if($row['invoicetype']=='B2B'){ $regtype='REGULAR'; } else { $regtype='UNREGISTERED';}
$buyer_state = $row['buyerstate'];
$parts = explode("-", $buyer_state);
$display_state = trim($parts[2]);

$rowData = array($row['sono'], (($row['invoicedate']!='')?date('d.m.Y',strtotime($row['invoicedate'])):''), $row['maincategory'], $row['tender'], $row['subcategory'], $row['department'], $row['otherreference'], $row['pono'], (($row['podate']!='')?date('d.m.Y',strtotime($row['podate'])):''), $row['custreference'], $row['duedays'], $row['buyername'].(($row['buyeraddress1']!='')?' - '.$row['buyeraddress1']:''), $row['buyeraddress1'], $row['buyeraddress2'], $row['buyeraddress3'], (($row['conaddress3']!='')?$row['conaddress3'].' - ':'').$row['condistrict'], $display_state, $regtype , $row['bgst'], $row['consigneeno'], $row['consigneename'], $row['conaddress1'], $row['conaddress2'], $row['conaddress3'], $row['contaluk'], $row['condistrict'], $row['conpincode'], $row['concontact'], $row['conphone'], $row['conmobile'], $row['conemail'], $row['conprogroup'], $row['conmultiple'], (($row['conproductcode']!='')?$row['conproductcode'].' - ':'').  $row['conproduct'], $row['conqty'], $row['conserialno'],'', $row['conunit'],'','', (($row['conigst']!='')?$row['conigst'].'%':''), (($row['consgst']!='')?$row['consgst'].'%':''), (($row['concgst']!='')?$row['concgst'].'%':''), $row['conigstamount'], $row['consgstamount'], $row['concgstamount'],'', $row['contotal'], $row['conwarranty'], '',''); 
$column = 'A';
for ($i = 0; $i < count($rowData); $i++)  
{
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $rowData[$i]);
    $column++;
}
$rowCount++; 
} 
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
$column = 'A';
for ($i = 0; $i < count($fields); $i++)  
{
$objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
$column++;
}
cellColor('A1:E1', 'ffff00');
cellColor('F1', 'fabf8f');
cellColor('G1', 'ffff00');
cellColor('H1:O1', 'FFC000');
cellColor('P1', 'FF0000');
cellColor('Q1:T1', 'ffff00');
cellColor('U1:AC1', 'FFC000');
cellColor('AD1:AG1', 'ffff00');
cellColor('AH1:AI1', 'FFC000');
cellColor('AJ1:AK1', 'ffff00');
cellColor('AL1', 'FFC000');
cellColor('AM1:AO1', 'ffff00');
cellColor('AP1:AW1', 'FFC000');
cellColor('A2:AW2', '00b0f0');
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$lastcolumn--;
$rowCount--;
unlink('../padhivetram/TallyImport-'.$id.'.xlsx'); 
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastcolumn.$rowCount)->applyFromArray($styleArray);
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
$objWriter->save('../padhivetram/TallyImport-'.$id.'.xlsx'); 
$query = "update jrctally set exp='1' where dname='$id'";  
$result = mysqli_query($connection,$query) or die(mysqli_error($connection));
header('location:exporttally.php?remarks=Exported Successfully');
}
?>