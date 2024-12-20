<?php 
include('lcheck.php'); 
include('push.php'); 
if(isset($_POST['submit']))
{
	$createdon=date('Y-m-d H:i:s');
	$createdby=$email;




$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['maincategory']);
$subcategoryvalue=mysqli_real_escape_string($connection, $_POST['subcategory']);
$consigneenamevalue=mysqli_real_escape_string($connection, $_POST['consigneename']);
$departmentvalue=mysqli_real_escape_string($connection, $_POST['department']);
$address1value=mysqli_real_escape_string($connection, $_POST['address1']);
$address2value=mysqli_real_escape_string($connection, $_POST['address2']);
$areavalue=mysqli_real_escape_string($connection, $_POST['area']);
$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
$pincodevalue=mysqli_real_escape_string($connection, $_POST['pincode']);
$contactvalue=mysqli_real_escape_string($connection, $_POST['contact']);
$phonevalue=mysqli_real_escape_string($connection, $_POST['phone']);
$mobilevalue=mysqli_real_escape_string($connection, $_POST['mobile']);
$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
$encstatus=0;
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
$encstatus=1;
$address1value=jbsencrypt($_SESSION['encpass'], $address1value);
$phonevalue=jbsencrypt($_SESSION['encpass'], $phonevalue);
$mobilevalue=jbsencrypt($_SESSION['encpass'], $mobilevalue);
$emailvalue=jbsencrypt($_SESSION['encpass'], $emailvalue);
}
}


if(($maincategoryvalue!="")||($subcategoryvalue!="")||($consigneenamevalue!="")||($departmentvalue!=""))
{
$sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon == 0)
{
 $sqlup = "INSERT INTO jrcconsignee( encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email) VALUES ( '$encstatus', '$maincategoryvalue', '$subcategoryvalue', '$consigneenamevalue', '$departmentvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue')";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$consigneeid=$id=mysqli_insert_id($connection);
$sqlup1 = "update jrcxl set consigneeid='{$id}' WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$queryup1 = mysqli_query($connection, $sqlup1);
if(!$queryup1){
die("SQL query failed: " . mysqli_error($connection));
}
}
}
else
{
$rowselect = mysqli_fetch_array($querycon);
$consigneeid=$id=$rowselect['id'];
$sqlup = "update jrcxl set consigneeid='{$id}' WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
}
}


	$noofproduts=mysqli_real_escape_string($connection, $_POST['noofproduts']);
	$noofscraps=mysqli_real_escape_string($connection, $_POST['noofscraps']);
	
	$prototal=(float)mysqli_real_escape_string($connection, $_POST['prototal']);
	$scrtotal=(float)mysqli_real_escape_string($connection, $_POST['scrtotal']);
	$gratotal=(float)mysqli_real_escape_string($connection, $_POST['gratotal']);

	$exists=0;
	$sexists=0;
	for($i=1;$i<=$noofproduts;$i++)
	{
		if((isset($_POST['quotationtype'.$i]))&&(isset($_POST['productname'.$i])))
		{
			$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype'.$i]);
			$productname=mysqli_real_escape_string($connection, $_POST['productname'.$i]);
			$salestotal=mysqli_real_escape_string($connection, $_POST['salestotal'.$i]);
			
			$sqlcon = "SELECT id From jrcquotation WHERE consigneeid = '{$consigneeid}' and quotationtype = '{$quotationtype}' and productname = '{$productname}' and salestotal='{$salestotal}' and qtype='PRODUCT'";
			$querycon = mysqli_query($connection, $sqlcon);
			$rowCountcon = mysqli_num_rows($querycon);
			 
			if(!$querycon)
			{
			   die("SQL query failed: " . mysqli_error($connection));
			}
			if($rowCountcon>0)
			{
				$exists++;
			}
		}
	}
	for($i=1;$i<=$noofscraps;$i++)
	{
		if((isset($_POST['quotationtype'.$i]))&&(isset($_POST['productname'.$i])))
		{
			$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype'.$i]);
			$productname=mysqli_real_escape_string($connection, $_POST['productname'.$i]);
			$salescrapvalue=mysqli_real_escape_string($connection, $_POST['salescrapvalue'.$i]);
			
		$sqlcon = "SELECT id From jrcquotation WHERE consigneeid = '{$consigneeid}' and quotationtype = '{$quotationtype}' and productname = '{$productname}' and salescrapvalue='{$salescrapvalue}' and qtype='SCRAP'";
			$querycon = mysqli_query($connection, $sqlcon);
			$rowCountcon = mysqli_num_rows($querycon);
			 
			if(!$querycon)
			{
			   die("SQL query failed: " . mysqli_error($connection));
			}
			if($rowCountcon>0)
			{
				$sexists++;
			}
		}
	}
	if(($exists==$noofproduts)&&($sexists==$noofscraps))
	{
		header("location: quotations.php?error=This Quotation is Already Generated");
	}
	else
	{
		$querysr = mysqli_query($connection, "SELECT qno From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		$qno=$_SESSION['companyshortname'].' / QN / '.date('m').date('y').' /'.(str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
		$qdate=date('Y-m-d');
		mysqli_query($connection, "update jrcsrno set qno=qno+1");
		$succe=0;
		for($i=1;$i<=$noofproduts;$i++)
		{
			if((isset($_POST['quotationtype'.$i]))&&(isset($_POST['productname'.$i])))
			{
				$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype'.$i]);
				$productname=mysqli_real_escape_string($connection, $_POST['productname'.$i]);
				$price=(float)mysqli_real_escape_string($connection, $_POST['price'.$i]);
				$minprice=(float)mysqli_real_escape_string($connection, $_POST['minprice'.$i]);
				$gst=(float)mysqli_real_escape_string($connection, $_POST['gst'.$i]);
				$scrapvalue=(float)mysqli_real_escape_string($connection, $_POST['scrapvalue'.$i]);
				$installcost=(float)mysqli_real_escape_string($connection, $_POST['installcost'.$i]);
				$saleprice=(float)mysqli_real_escape_string($connection, $_POST['saleprice'.$i]);
				$salequantity=(float)mysqli_real_escape_string($connection, $_POST['salequantity'.$i]);
				$salesinstallation=(float)mysqli_real_escape_string($connection, $_POST['salesinstallation'.$i]);
				$salesinstallcost=(float)mysqli_real_escape_string($connection, $_POST['salesinstallcost'.$i]);
				$salestotal=(float)mysqli_real_escape_string($connection, $_POST['salestotal'.$i]);
				$salesgst=(float)mysqli_real_escape_string($connection, $_POST['salesgst'.$i]);
				$salesnettotal=(float)mysqli_real_escape_string($connection, $_POST['salesnettotal'.$i]);
				$salescrap=(float)mysqli_real_escape_string($connection, $_POST['salescrap'.$i]);
				$salescrapvalue=(float)mysqli_real_escape_string($connection, $_POST['salescrapvalue'.$i]);
				$salesgrandtotal=(float)mysqli_real_escape_string($connection, $_POST['salesgrandtotal'.$i]);
				
				$sqlup = "INSERT INTO jrcquotation set createdon='$createdon', createdby='$createdby', consigneeid='$consigneeid',   quotationtype='$quotationtype', productname='$productname', qno='$qno', qdate='$qdate', qtype='PRODUCT', prototal='$prototal', scrtotal='$scrtotal', gratotal='$gratotal',  price='$price', minprice='$minprice', gst='$gst', scrapvalue='$scrapvalue', installcost='$installcost', saleprice='$saleprice', salequantity='$salequantity', salesinstallation='$salesinstallation', salesinstallcost='$salesinstallcost', salestotal='$salestotal', salesgst='$salesgst', salesnettotal='$salesnettotal', salescrap='$salescrap', salescrapvalue='$salescrapvalue', salesgrandtotal='$salesgrandtotal'";
				$queryup = mysqli_query($connection, $sqlup);
			 
				if(!$queryup){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					$succe++;
				} 
				
			}
		}
		for($i=1;$i<=$noofscraps;$i++)
		{
			if((isset($_POST['squotationtype'.$i]))&&(isset($_POST['sproductname'.$i])))
			{
				$quotationtype=mysqli_real_escape_string($connection, $_POST['squotationtype'.$i]);
				$productname=mysqli_real_escape_string($connection, $_POST['sproductname'.$i]);
				$price=(float)mysqli_real_escape_string($connection, $_POST['sprice'.$i]);
				$minprice=(float)mysqli_real_escape_string($connection, $_POST['sminprice'.$i]);
				$gst=(float)mysqli_real_escape_string($connection, $_POST['sgst'.$i]);
				$scrapvalue=(float)mysqli_real_escape_string($connection, $_POST['sscrapvalue'.$i]);
				$installcost=(float)mysqli_real_escape_string($connection, $_POST['sinstallcost'.$i]);
				$saleprice=(float)mysqli_real_escape_string($connection, $_POST['ssaleprice'.$i]);
				$salequantity=(float)mysqli_real_escape_string($connection, $_POST['ssalequantity'.$i]);
				$salesinstallation=(float)mysqli_real_escape_string($connection, $_POST['ssalesinstallation'.$i]);
				$salesinstallcost=(float)mysqli_real_escape_string($connection, $_POST['ssalesinstallcost'.$i]);
				$salestotal=(float)mysqli_real_escape_string($connection, $_POST['ssalestotal'.$i]);
				$salesgst=(float)mysqli_real_escape_string($connection, $_POST['ssalesgst'.$i]);
				$salesnettotal=(float)mysqli_real_escape_string($connection, $_POST['ssalesnettotal'.$i]);
				$salescrap=(float)mysqli_real_escape_string($connection, $_POST['ssalescrap'.$i]);
				$salescrapvalue=(float)mysqli_real_escape_string($connection, $_POST['ssalescrapvalue'.$i]);
				$salesgrandtotal=(float)mysqli_real_escape_string($connection, $_POST['ssalesgrandtotal'.$i]);
				
		 $sqlup = "INSERT INTO jrcquotation set createdon='$createdon', createdby='$createdby', consigneeid='$consigneeid',   quotationtype='$quotationtype', productname='$productname', qno='$qno', qdate='$qdate', qtype='SCRAP', prototal='$prototal', scrtotal='$scrtotal', gratotal='$gratotal',  price='$price', minprice='$minprice', gst='$gst', scrapvalue='$scrapvalue', installcost='$installcost', saleprice='$saleprice', salequantity='$salequantity', salesinstallation='$salesinstallation', salesinstallcost='$salesinstallcost', salestotal='$salestotal', salesgst='$salesgst', salesnettotal='$salesnettotal', salescrap='$salescrap', salescrapvalue='$salescrapvalue', salesgrandtotal='$salesgrandtotal'";
				$queryup = mysqli_query($connection, $sqlup);
			 
				if(!$queryup){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					$succe++;
				} 
				
			}
		}
		if($succe!=0)
		{
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Quotation', '{$qno}', 'jrcquotation')");				
			header("Location: quotations.php?id={$consigneeid}&remarks=Quotation Added Successfully");
		}
		else
		{
			header("Location: quotations.php?id={$consigneeid}&error=Error");
		}
		
	}	
}
else
{
header("Location: quotation.php?id={$consigneeid}");
} 
?>