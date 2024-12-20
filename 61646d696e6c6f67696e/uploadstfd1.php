<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
require_once '../../1637028036/vendor/excel1/Classes/PHPExcel.php';	
function convertXLStoCSV($infile,$outfile)
{
	$fileType = PHPExcel_IOFactory::identify($infile);
	$objReader = PHPExcel_IOFactory::createReader($fileType);
			 
	$objReader->setReadDataOnly(false); 
	$objPHPExcel = $objReader->load($infile);    
				 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
	$objWriter->save($outfile);
}
include('../session.php');
include('../mukkiyam/db.php');
if(isset($_GET['email']))
{
$_SESSION['email']=mysqli_real_escape_string($connection, $_GET['email']);
}
$dcdirname = '../tallyexport/dc/';
$dccsvs = glob($dcdirname."*.xlsx");
$indirname = '../tallyexport/invoice/';
$incsvs = glob($indirname."*.xlsx");
$dcis=count($dccsvs);
$inis=count($incsvs);
if($dcis!=0)
{
$xlsfile=str_replace(".xlsx","",$dccsvs[0]);  
convertXLStoCSV($xlsfile.'.xlsx',$xlsfile.'.csv');
}
if($inis!=0)
{
$xlsfile=str_replace(".xlsx","",$incsvs[0]);  
convertXLStoCSV($xlsfile.'.xlsx',$xlsfile.'.csv');
}
if((file_exists("../tallyexport/dc/DC_Details.csv")))
{
$upload="DC_Details.csv";
}
else
{
header("location: uploadstf1.php");
}
function string_sanitize($s) {
    $result = preg_replace("/[^a-zA-Z0-9]\s+/", " ", html_entity_decode($s, ENT_QUOTES));
    return $result;
}
function clean($string) {
   //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]\s+/', '', $string); // Removes special chars.
}


if(isset($upload))
{     
$uploadDir = "../padhivetram/";
    $fileName = time().'-'.$upload;
	$oldfile="../tallyexport/dc/".$upload;
    $uploadedFile = $uploadDir.$fileName;    
	$upload_time=date("Y-m-d H:i:s");
	$uploadby=$_SESSION['email'];

if(copy($oldfile,$uploadedFile))
{
		
$data=array();
$arrinvoiceno=array();
$arrinvoicedate=array();
$arrtenderno=array();
$arrpono=array();
$arrpodate=array();
$arrdcno=array();
$arrdcdate=array();
$arrinstalledon=array();
$arrinstalledby=array();
$arrmaincategory=array();
$arrsubcategory=array();
$arrconsigneename=array();
$arrdepartment=array();
$arraddress1=array();
$arraddress2=array();
$arrarea=array();
$arrdistrict=array();
$arrpincode=array();
$arrcontact=array();
$arrphone=array();
$arrmobile=array();
$arremail=array();
$arrgstno=array();
$arrstockmaincategory=array();
$arrstocksubcategory=array();
$arrstockitem=array();
$arrinvoicedqty=array();
$arrrate=array();
$arrgstper=array();
$arroverallwarranty=array();
$arrtypeofproduct=array();
$arrcomponenttype=array();
$arrcomponentname=array();
$arrmake=array();
$arrcapacity=array();
$arrwarranty=array();
$arrqty=array();
$arrserialnumber=array();
$arrdepartments=array();

$invoiceno="";
$invoicedate="";
$tenderno="";
$pono="";
$podate="";
$dcno="";
$dcdate="";
$installedon="";
$installedby="";
$maincategory="";
$subcategory="";
$consigneename="";
$department="";
$address1="";
$address2="";
$area="";
$district="";
$pincode="";
$contact="";
$phone="";
$mobile="";
$email="";
$gstno="";
$stockmaincategory="";
$stocksubcategory="";
$stockitem="";
$invoicedqty="";
$rate="";
$gstper="";
$overallwarranty="";
$typeofproduct="";
$componenttype="";
$componentname="";
$make="";
$capacity="";
$warranty="";
$qty="";
$serialnumber="";
$departments="";

 $handle = fopen($uploadedFile, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 5000, ",")) !== false)
                    {
						for($s=0;$s<39;$s++)
						{
						$data[$c][$s]=$filesop[$s];
						}
						$c++;
						
					}
$totaldatas=count($data)-1;
$mysqlInsert = "INSERT INTO jrcuploads (uploadby, file_name, upload_time, uploaded)VALUES('".$uploadby."','".$fileName."','".$upload_time."','".$totaldatas."')";
mysqli_query($connection, $mysqlInsert);

for ($i = 0; $i < count($data); $i++) {
	$te=0;
	for ($j = 0; $j < 39; $j++) {
		if($j==0)
		{
			$arrinvoiceno[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$invoiceno=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==1)
		{
			if(trim($data[$i][$j])!=="")
			{
			$indate=date('Y-m-d',strtotime(strtr(mysqli_real_escape_string($connection,trim($data[$i][$j])), '/', '-')));
			}
			else
			{
			$indate="";	
			}
			$arrinvoicedate[]=$indate;
			$invoicedate=$indate;
			
		}
		if($j==2)
		{
			$arrtenderno[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$tenderno=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==3)
		{
			$arrpono[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$pono=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==4)
		{
			if(trim($data[$i][$j])!=="")
			{
			$pdate=date('Y-m-d',strtotime(strtr(mysqli_real_escape_string($connection,trim($data[$i][$j])), '/', '-')));
			}
			else
			{
			$pdate="";	
			}
			$arrpodate[]=$pdate;
			$podate=$pdate;
		}
		if($j==5)
		{
			$arrdcno[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$dcno=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==6)
		{
			if(trim($data[$i][$j])!=="")
			{
			$ddate=date('Y-m-d',strtotime(strtr(mysqli_real_escape_string($connection,trim($data[$i][$j])), '/', '-')));
			}
			else
			{
			$ddate="";	
			}
			$arrdcdate[]=$ddate;
			$dcdate=$ddate;
		}
		if($j==7)
		{
			if(trim($data[$i][$j])!=="")
			{
			$idate=date('Y-m-d',strtotime(strtr(mysqli_real_escape_string($connection,trim($data[$i][$j])), '/', '-')));
			}
			else
			{
			$idate="";	
			}
			$arrinstalledon[]=$idate;
			$installedon=$idate;
		}
		if($j==8)
		{
			$arrinstalledby[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$installedby=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==9)
		{
			$arrmaincategory[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$maincategory=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==10)
		{
			$arrsubcategory[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$subcategory=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==11)
		{
			$arrconsigneename[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$consigneename=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==12)
		{
			$arrdepartment[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$department=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==13)
		{
			$arraddress1[]=mysqli_real_escape_string($connection,string_sanitize(trim($data[$i][$j])));;
			$address1=mysqli_real_escape_string($connection,string_sanitize(trim($data[$i][$j])));;
		}
		if($j==14)
		{
			$arraddress2[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$address2=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==15)
		{
			$arrarea[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$area=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==16)
		{
			$arrdistrict[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$district=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==17)
		{
			$arrpincode[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$pincode=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==18)
		{
			$arrcontact[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$contact=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==19)
		{
			$phono = preg_replace("/[^0-9]/", "", mysqli_real_escape_string($connection,trim($data[$i][$j])) );
			$arrphone[]=$phono;
			$phone=$phono;
		}
		if($j==20)
		{
			$arrmobile[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$mobile=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==21)
		{
			$arremail[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$email=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		/////
		if($j==22)
		{
			$arrgstno[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$gstno=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		//////
		if($j==23)
		{
			$arrstockmaincategory[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$stockmaincategory=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==24)
		{
			$arrstocksubcategory[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$stocksubcategory=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==25)
		{
			$arrstockitem[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$stockitem=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$stockitem=clean($stockitem);
		}
		if($j==26)
		{
			$arrinvoicedqty[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$invoicedqty=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		/////
		if($j==27)
		{
			$arrrate[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$rate=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==28)
		{
			$arrgstper[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$gstper=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		/////		
		if($j==29)
		{
			$arroverallwarranty[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$overallwarranty=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==30)
		{
			$arrtypeofproduct[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$typeofproduct=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==31)
		{
			$arrcomponenttype[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$componenttype=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==32)
		{
			$arrcomponentname[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$componentname=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==33)
		{
			$arrmake[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$make=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==34)
		{
			$arrcapacity[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$capacity=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==35)
		{
			$arrwarranty[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$warranty=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==36)
		{
			$arrqty[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$qty=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==37)
		{
			$arrserialnumber[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$serialnumber=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==38)
		{
			$arrdepartments[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$departments=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		
		
	}
	
$encstatus=0;		
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{
		$encstatus=1;
		
		
		$address1=jbsencrypt($_SESSION['encpass'], $address1);
		
		
		$phone=jbsencrypt($_SESSION['encpass'], $phone);
		$mobile=jbsencrypt($_SESSION['encpass'], $mobile);
		$email=jbsencrypt($_SESSION['encpass'], $email);
	}
}

	if($installedon!='')
{
$overdate=$installedon;
}
else
{
$overdate= $invoicedate;
}
$off=(float)$warranty;
$overdate = str_replace('/', '-', $overdate);
$overdate=date('Y-m-d', strtotime($overdate));
$warrantydate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
	if($i>0)
	{
		//echo $invoiceno."-";
		if($te==0)
		{
		 
		
		
		$sqlselect = "SELECT id From jrcxl WHERE tdelete='0' and invoiceno = '{$invoiceno}' and invoicedate = '{$invoicedate}' and maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and typeofproduct = '{$typeofproduct}' and componenttype = '{$componenttype}' and serialnumber = '{$serialnumber}' ";
		$queryselect = mysqli_query($connection, $sqlselect);
        
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		else
		{
			$rowCountselect = mysqli_num_rows($queryselect);	
			 
			if($rowCountselect == 0) 
			{	
				 
				$sqlup = "INSERT INTO jrcxl(encstatus, file_name, upload_time, invoiceno, invoicedate, tenderno, pono, podate, dcno, dcdate, installedon, installedby, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, gstno, stockmaincategory, stocksubcategory, stockitem, invoicedqty, rate, gstper, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, warranty, warrantydate, qty, serialnumber) VALUES ('$encstatus', '$fileName', '$upload_time', '$invoiceno', '$invoicedate', '$tenderno', '$pono', '$podate', '$dcno', '$dcdate', '$installedon', '$installedby', '$maincategory', '$subcategory', '$consigneename', '$department', '$address1', '$address2', '$area', '$district', '$pincode', '$contact', '$phone', '$mobile', '$email', '$gstno', '$stockmaincategory', '$stocksubcategory', '$stockitem', '$invoicedqty', '$rate', '$gstper', '$overallwarranty', '$typeofproduct', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$warrantydate', '$qty', '$serialnumber')";
				$queryup = mysqli_query($connection, $sqlup);
				 
				if(!$queryup){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					$sourceid=mysqli_insert_id($connection);
					 
					$sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
					$querycon = mysqli_query($connection, $sqlcon);
					$rowCountcon = mysqli_num_rows($querycon);
					 
					if(!$querycon){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					 
					if($rowCountcon == 0) 
					{	
						 
						$sqlupconsignee = "INSERT INTO jrcconsignee(encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, gstno) VALUES ( '$encstatus', '$maincategory', '$subcategory', '$consigneename', '$department', '$address1', '$address2', '$area', '$district', '$pincode', '$contact', '$phone', '$mobile', '$email', '$gstno')";
						$queryupconsignee = mysqli_query($connection, $sqlupconsignee);
						 
						if(!$queryupconsignee){
						   die("SQL query failed: " . mysqli_error($connection));
						}
						else
						{
							$consigneeid=mysqli_insert_id($connection);
							$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
							$queryup1 = mysqli_query($connection, $sqlup1);
							 
							if(!$queryup1){
							   die("SQL query failed: " . mysqli_error($connection));
							}
						}
					}
					else
					{
						$rowco = mysqli_fetch_array($querycon);	
						$consigneeid=$rowco['id'];	
						$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
						$queryup1 = mysqli_query($connection, $sqlup1);
						 
						if(!$queryup1){
						   die("SQL query failed: " . mysqli_error($connection));
						}
					}
					/////////////////////
					 
					$sqlconpro = "SELECT id From jrcproduct WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
					$queryconpro = mysqli_query($connection, $sqlconpro);
					$rowCountconpro = mysqli_num_rows($queryconpro);
					 
					if(!$queryconpro){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					 
					if($rowCountconpro == 0) 
					{	
						 
						$sqluppro = "INSERT INTO jrcproduct( stockmaincategory, stocksubcategory, stockitem, componenttype, componentname, typeofproduct, make, capacity) VALUES ('$stockmaincategory', '$stocksubcategory', '$stockitem', '$componenttype', '$componentname', '$typeofproduct', '$make', '$capacity')";
						$queryuppro = mysqli_query($connection, $sqluppro);
						 
						if(!$queryuppro){
						   die("SQL query failed: " . mysqli_error($connection));
						}
						else
						{
							$productid=mysqli_insert_id($connection);
							$sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
							$queryup1pro = mysqli_query($connection, $sqlup1pro);
							 
							if(!$queryup1pro){
							   die("SQL query failed: " . mysqli_error($connection));
							}
						}
					}
					else
					{
						$rowcopro = mysqli_fetch_array($queryconpro);	
						$productid=$rowcopro['id'];	
						$sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
						$queryup1pro = mysqli_query($connection, $sqlup1pro);
						 
						if(!$queryup1pro){
						   die("SQL query failed: " . mysqli_error($connection));
						}
					}
				}
			}
			else
			{
				$sourceinfo=mysqli_fetch_array($queryselect);
				$sourceid=$sourceinfo['id'];
				
				  
				$sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				 
				if(!$querycon){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountcon == 0) 
				{	
					 
					$sqlupconsignee = "INSERT INTO jrcconsignee(encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, gstno) VALUES ( '$encstatus', '$maincategory', '$subcategory', '$consigneename', '$department', '$address1', '$address2', '$area', '$district', '$pincode', '$contact', '$phone', '$mobile', '$email', '$gstno')";
					$queryupconsignee = mysqli_query($connection, $sqlupconsignee);
					 
					if(!$queryupconsignee){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					else
					{
						$consigneeid=mysqli_insert_id($connection);
						$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
						$queryup1 = mysqli_query($connection, $sqlup1);
						 
						if(!$queryup1){
							   die("SQL query failed: " . mysqli_error($connection));
						}
					}
				}
				else
				{
					$rowco = mysqli_fetch_array($querycon);	
					$consigneeid=$rowco['id'];	
					$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
					$queryup1 = mysqli_query($connection, $sqlup1);
					 
					if(!$queryup1){
						   die("SQL query failed: " . mysqli_error($connection));
					}
				}
				/////////////////////
				 
				$sqlconpro = "SELECT id From jrcproduct WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
				$queryconpro = mysqli_query($connection, $sqlconpro);
				$rowCountconpro = mysqli_num_rows($queryconpro);
				 
				if(!$queryconpro){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountconpro == 0) 
				{	
					 
					$sqluppro = "INSERT INTO jrcproduct( stockmaincategory, stocksubcategory, stockitem, componenttype, componentname, typeofproduct, make, capacity) VALUES ('$stockmaincategory', '$stocksubcategory', '$stockitem', '$componenttype', '$componentname', '$typeofproduct', '$make', '$capacity')";
					$queryuppro = mysqli_query($connection, $sqluppro);
					 
					if(!$queryuppro){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					else
					{
						$productid=mysqli_insert_id($connection);
						$sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
						$queryup1pro = mysqli_query($connection, $sqlup1pro);
						 
						if(!$queryup1pro){
						   die("SQL query failed: " . mysqli_error($connection));
						}
					}
				}
				else
				{
					$rowcopro = mysqli_fetch_array($queryconpro);	
					$productid=$rowcopro['id'];	
					$sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
					$queryup1pro = mysqli_query($connection, $sqlup1pro);
					 
					if(!$queryup1pro){
					   die("SQL query failed: " . mysqli_error($connection));
					}
				}
			}
			//echo $sourceid.'-'.$consigneeid.'-'.$productid.'<br>';
			
		}
	}
	else
	{
		
	}

	}
}

$sqlselect = "SELECT * From jrcxl where file_name='".$fileName."' order by id asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
    die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountselect > 0) 
{
	$count=1;
	while($rowselect = mysqli_fetch_array($queryselect)) 
	{
		$sourceid=$rowselect['id'];
		$consigneeid=$rowselect['consigneeid'];
		$productid=$rowselect['productid'];
		$serialnumber=$rowselect['serialnumber'];
		$departments=$rowselect['departments'];
		$qty=$rowselect['qty'];
		//echo $sourceid.'-'.$consigneeid.'-'.$productid.'<br>';
			$sstatus=0;
			$serials=explode("| ",$serialnumber);
			$departs=explode("| ",$departments);
			 
			$sqlcon = "delete From jrcserials WHERE sourceid = '{$sourceid}' and consigneeid = '{$consigneeid}' and productid = '{$productid}'";
			$querycon = mysqli_query($connection, $sqlcon);
			 
			if(!$querycon){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{	
				for($sr=0;$sr<$qty;$sr++)
				{
					$serialqty=$sr+1;	//////
					$serial="";
					$depart="";
					if(isset($serials[$sr]))
					{		
						$serial=$serials[$sr];	
						$serial=str_replace("\\r","",$serial);
						$serial=str_replace("\\n","",$serial);
					}
					if(isset($departs[$sr]))
					{
						$depart=$departs[$sr];	
						$depart=str_replace("\\r","",$depart);
						$depart=str_replace("\\n","",$depart);
					}
					 
					$sqlup = "INSERT INTO jrcserials(sourceid, consigneeid, productid, serialnumber, serialqty, sstatus) VALUES ( '$sourceid', '$consigneeid', '$productid', '$serial', '$serialqty', '$sstatus')";
					$queryup = mysqli_query($connection, $sqlup);
					 
					if(!$queryup){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					else
					{
						
					}
				}
			}
	}
}
	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Uploaded a CSV', '{$uploadedFile}')");
	$fl=str_replace("../tallyexport/dc/","../del/".(date('Y-m-d'))."-",$oldfile);
	rename($oldfile, $fl);
	$f2=str_replace(".csv",".xlsx",$oldfile);
	unlink($f2);	
	if((file_exists("../tallyexport/invoice/Invoice_Details.csv")))
{
header("Location:uploadstf1.php");
}
else
{
header("location: dashboard.php");
}
	
    }   
}
?>
