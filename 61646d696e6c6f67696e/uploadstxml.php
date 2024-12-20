<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include('lcheck.php');
function string_sanitize($s) {
    $result = preg_replace("/[^a-zA-Z0-9]\s+/", " ", html_entity_decode($s, ENT_QUOTES));
    return $result;
}
function clean($string) {
   //$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]\s+/', '', $string); // Removes special chars.
}
if(!empty($_FILES)){     
    $uploadDir = "../padhivetram/xml/";
    $fileName = time().'-'.$_FILES['file']['name'];
    $uploadedFile = $uploadDir.$fileName;    
	$upload_time=date("Y-m-d H:i:s");
	$uploadby=$_SESSION['email'];
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadedFile)) 
	{
  
///////////////////////xml
$content= file_get_contents($uploadedFile);
$content=str_replace('<StoresData>','',$content);
$content=str_replace('<KGMSales>','',$content);
$content=str_replace('</KGMSales>','',$content);
$content=str_replace('</StoresData>','',$content);
$content=str_replace('&#47;','/',$content);

$invoices=explode('</SalesRow>',$content);
$data=array();

$data[0]['invoiceno']='Invoice No.';
$data[0]['invoicedate']='Invoice Date';
$data[0]['tenderno']='Tender No.';
$data[0]['pono']='Purchase Order No.';
$data[0]['podate']='PO Date';
$data[0]['dcno']='DC No.';
$data[0]['dcdate']='DC Date';
$data[0]['installedon']='Installed On';
$data[0]['installedby']='Installed By';
$data[0]['maincategory']='Main Category';
$data[0]['subcategory']='Sub Category';
$data[0]['consigneename']='Consignee Name(Unique)';
$data[0]['department']='Department';
$data[0]['address1']='Address 1';
$data[0]['address2']='Address 2';
$data[0]['area']='Area';
$data[0]['district']='District';
$data[0]['pincode']='Pin Code';
$data[0]['contact']='Contact';
$data[0]['phone']='Phone';
$data[0]['mobile']='Mobile';
$data[0]['email']='Email';
$data[0]['gstno']='GSTIN';
$data[0]['stockmaincategory']='Main Category';
$data[0]['stocksubcategory']='Sub Category';
$data[0]['stockitem']='Stock Item';
$data[0]['invoicedqty']='Invoiced Qty';
$data[0]['rate']='Rate';
$data[0]['gstper']='GST %';
$data[0]['overallwarranty']='Overall Warranty Months';
$data[0]['typeofproduct']='Type of Product';
$data[0]['componenttype']='Component Type';
$data[0]['componentname']='Component Name';
$data[0]['make']='Make';
$data[0]['capacity']='Capacity';
$data[0]['warranty']='Warranty';
$data[0]['qty']='Qty';
$data[0]['serialnumber']='Serial Numbers';
$data[0]['departments']='Department';

$k=1;

for($i=0;$i<count($invoices);$i++)
{
	
	$content2=$invoices[$i];
	$invoicedata=explode('<Bill>',$content2);
	if(isset($invoicedata[1])) 
	{
	$content2=$invoicedata[1];
	$invoicedata=explode('</Bill>',$content2);
	$invoiceno=$invoicedata[0];
	
	$content2=$invoicedata[1];
	
	
	$invoicedata=explode('<BillDate>',$content2);
	$content2=$invoicedata[1];
	$invoicedata=explode('</BillDate>',$content2);
	$invoicedate=$invoicedata[0];
	$content2=$invoicedata[1];
	
	

	$invoicedata=explode('<SmasName>',$content2);
	$content2=$invoicedata[1];
	$invoicedata=explode('</SmasName>',$content2);
	$customername=$invoicedata[0];
	$content2=$invoicedata[1];
	
	
	$invoicedata=explode('<Address1>',$content2);
	if(isset($invoicedata[1])) 
	{
	$content2=$invoicedata[1];
	$invoicedata=explode('</Address1>',$content2);
	$address1=$invoicedata[0];
	$content2=$invoicedata[1];
	}
	else
	{
		$content2=$invoicedata[0];
		$address1='';
	}
	
	
	$invoicedata=explode('<Address2>',$content2);
	if(isset($invoicedata[1])) 
	{
	$content2=$invoicedata[1];
	$invoicedata=explode('</Address2>',$content2);
	$address2=$invoicedata[0];
	$content2=$invoicedata[1];
	}
	else
	{
		$content2=$invoicedata[0];
		$address2='';
	}
	
	
	$invoicedata=explode('<Address3>',$content2);
	if(isset($invoicedata[1])) 
	{
	$content2=$invoicedata[1];
	$invoicedata=explode('</Address3>',$content2);
	$address3=$invoicedata[0];
	$content2=$invoicedata[1];
	}
	else
	{
		$content2=$invoicedata[0];
		$address3='';
	}
	
	$invoicedata=explode('<Address4>',$content2);
	if(isset($invoicedata[1])) 
	{
	$content2=$invoicedata[1];
	$invoicedata=explode('</Address4>',$content2);
	$address4=$invoicedata[0];
	$content2=$invoicedata[1];
	}
	else
	{
		$content2=$invoicedata[0];
		$address4='';
	}
	
	$invoicedata=explode('<SalesTran>',$content2);
	
	$products=explode('</SalesTranRow>',$invoicedata[1]);
for($j=0;$j<count($products);$j++)
{
	
	
	$content3=$products[$j];
	$invoicedata1=explode('<ItemName>',$content3);
	if(isset($invoicedata1[1]))
	{

	
	
	
	$content3=$invoicedata1[1];
	$invoicedata1=explode('</ItemName>',$content3);
	 $itemname=$invoicedata1[0];
    $content3=$invoicedata1[1];
	
	
	
	
	
	$invoicedata1=explode('<ItemType >',$content3);
	if(isset($invoicedata1[1])) 
	{
	$content3=$invoicedata1[1];
	$invoicedata1=explode('</ItemType>',$content3);
	$itemtype=$invoicedata1[0];
	$content3=$invoicedata1[1];
	}
	else{
		$content3=$invoicedata1[0];
	    $ItemType='';
	}
	
	
	
	
	$invoicedata1=explode('<Qty>',$content3);
	if(isset($invoicedata1[1])) 
	{
	$content3=$invoicedata1[1];
	$invoicedata1=explode('</Qty>',$content3);
	 $qty=round($invoicedata1[0], 2);
	$content3=$invoicedata1[1];
	}
	else{
		$content3=$invoicedata1[0];
		$qty='';
	}
	
	
	
	
	$invoicedata1=explode('<Rate>',$content3);
	if(isset($invoicedata1[1])) 
	{
	$content3=$invoicedata1[1];
	$invoicedata1=explode('</Rate>',$content3);
	 $rate = round($invoicedata1[0], 2);
	$content3=$invoicedata1[0];
	}
	else{
		$content3=$invoicedata1[0];
		$rate='';
	}
	
	
	
	$invoicedata1=explode('<TaxName>',$content3);
	if(isset($invoicedata1[1])) 
	{
	$content3=$invoicedata1[1];
	$invoicedata1=explode('% GST',$content3);
	$content3=$invoicedata1[0];
	$invoicedata1=explode('</TaxName>',$content3);
	 $taxname=$invoicedata1[0];
	 $content3=$invoicedata1[1];
	}
	else{
		$content3=$invoicedata1[0];
		$taxname='';
	}
	
$data[$k]['invoiceno']=$invoiceno;
$data[$k]['invoicedate']=$invoicedate;
$data[$k]['tenderno']='';
$data[$k]['pono']='';
$data[$k]['podate']='';
$data[$k]['dcno']='';
$data[$k]['dcdate']='';
$data[$k]['installedon']='';
$data[$k]['installedby']='';
$data[$k]['maincategory']='';
$data[$k]['subcategory']='';
$data[$k]['consigneename']=str_replace('\\','',$customername);
$data[$k]['department']='';
$data[$k]['address1']=$address1.' '.$address2;
$data[$k]['address2']=$address3.' '.$address4;
$data[$k]['area']='';
$data[$k]['district']='';
$data[$k]['pincode']='';
$data[$k]['contact']='';
$data[$k]['phone']='';
$data[$k]['mobile']='';
$data[$k]['email']='';
$data[$k]['gstno']='';
$data[$k]['stockmaincategory']='';
$data[$k]['stocksubcategory']='';
$data[$k]['stockitem']=$itemname;
$data[$k]['invoicedqty']='';
$data[$k]['rate']=$rate;
$data[$k]['gstper']=$taxname;
$data[$k]['overallwarranty']='';
$data[$k]['typeofproduct']='';
$data[$k]['componenttype']='';
$data[$k]['componentname']='';
$data[$k]['make']='';
$data[$k]['capacity']='';
$data[$k]['warranty']='';
$data[$k]['qty']=$qty;
$data[$k]['serialnumber']='';
$data[$k]['departments']='';
	
}
$k++;
}
	

	}
}
print_r($data);

$csvfile=str_replace(".xml",".csv",$uploadedFile); 
$fp = fopen($csvfile,"w");

foreach ($data as $line) {
  fputcsv($fp, $line);
}
fclose($data);


/////////////////////////////xml

$data=array();
 $handle = fopen($csvfile, "r");
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
			$phono = preg_replace("/[^0-9.]/", "", mysqli_real_escape_string($connection,trim($data[$i][$j])) );
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
		echo $invoiceno."-";
		if($te==0)
		{
		 
		
		if(($dcno!='')&&($dcdate!=''))
		{
        $sqlselect = "SELECT id From jrcxl WHERE tdelete='0' and dcno = '{$dcno}' and dcdate = '{$dcdate}' and maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and typeofproduct = '{$typeofproduct}' and componenttype = '{$componenttype}' and serialnumber = '{$serialnumber}' ";
		}
		else
		{
		$sqlselect = "SELECT id From jrcxl WHERE tdelete='0' and invoiceno = '{$invoiceno}' and invoicedate = '{$invoicedate}' and maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and typeofproduct = '{$typeofproduct}' and componenttype = '{$componenttype}' and serialnumber = '{$serialnumber}' ";
		}
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
					 
					$sqlconpro = "SELECT id,warrantycycle,productlifetime From jrcproduct WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
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
						$warrantycycle=$rowcopro['warrantycycle'];	
						if($rowcopro['productlifetime']!='' && $rowcopro['productlifetime']!='NULL')
						{
						$off1=(float)$rowcopro['productlifetime'];
						$overdate1 = str_replace('/', '-', $overdate);
						$overdate1=date('Y-m-d', strtotime($overdate1));
						$lifetimedate = date('Y-m-d', strtotime("+$off1 years", strtotime($overdate1)));
						$productlifetime=$rowcopro['productlifetime'];	
						}
						else
						{
							$lifetimedate='';
							$productlifetime='';
						}
						$sqlup1pro = "update jrcxl set productid='{$productid}',warrantycycle='{$warrantycycle}',productlifetime='{$productlifetime}',lifetimedate='{$lifetimedate}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
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
				if(($dcno!='')&&($dcdate!=''))
				{
				$sqlxlup = "update jrcxl set invoiceno='{$invoiceno}', invoicedate='{$invoicedate}' WHERE dcno = '{$dcno}' and dcdate = '{$dcdate}' ";
				$queryxlup = mysqli_query($connection, $sqlxlup);
				}
		
				  
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
				 
				$sqlconpro = "SELECT id,warrantycycle,productlifetime From jrcproduct WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
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
					$warrantycycle=$rowcopro['warrantycycle'];	
					if($rowcopro['productlifetime']!='' && $rowcopro['productlifetime']!='NULL')
						{
						$off1=(float)$rowcopro['productlifetime'];
						$overdate1 = str_replace('/', '-', $overdate);
						$overdate1=date('Y-m-d', strtotime($overdate1));
						$lifetimedate = date('Y-m-d', strtotime("+$off1 years", strtotime($overdate1)));
						$productlifetime=$rowcopro['productlifetime'];	
						}
						else
						{
							$lifetimedate='';
							$productlifetime='';
						}
					$sqlup1pro = "update jrcxl set productid='{$productid}',warrantycycle='{$warrantycycle}',productlifetime='{$productlifetime}',lifetimedate='{$lifetimedate}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
					$queryup1pro = mysqli_query($connection, $sqlup1pro);
					 
					if(!$queryup1pro){
					   die("SQL query failed: " . mysqli_error($connection));
					}
				}
			}
			echo $sourceid.'-'.$consigneeid.'-'.$productid.'<br>';
			
		}
	}
	else
	{
		
	}

	}
}

 $sqlselect = "SELECT id, consigneeid, productid, serialnumber, departments, qty From                                                  where file_name='".$fileName."' order by id asc";
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
		echo $sourceid.'-'.$consigneeid.'-'.$productid.'<br>';
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
$mysqlInsert = "INSERT INTO jrcuploads (uploadby, file_name, upload_time, uploaded)VALUES('".$uploadby."','".$fileName."','".$upload_time."','".$totaldatas."')";
mysqli_query($connection, $mysqlInsert);
	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Uploaded a CSV', '{$uploadedFile}', 'jrcuploads')");
	header("Location:uploadhistory.php"); 
     }   
} 
?>
