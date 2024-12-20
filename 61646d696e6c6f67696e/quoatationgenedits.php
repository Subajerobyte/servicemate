<?php 
include('lcheck.php'); 
include('push.php'); 
if(isset($_POST['submit']))
{
	$createdon=mysqli_real_escape_string($connection, $_POST['createdon']);
	$createdby=mysqli_real_escape_string($connection, $_POST['createdby']);
	$engineerid=mysqli_real_escape_string($connection, $_POST['engineerid']);
	$sourceid=mysqli_real_escape_string($connection, $_POST['sourceid']);
	$calltid=mysqli_real_escape_string($connection, $_POST['calltid']);
	$qno=mysqli_real_escape_string($connection, $_POST['qno']);
	$qdate=mysqli_real_escape_string($connection, $_POST['qdate']);
	
	$sqlcon = "delete From jrcquotation WHERE qno = '{$qno}' and qdate = '{$qdate}'";
	$querycon = mysqli_query($connection, $sqlcon);
			
	$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
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
		/* $querysr = mysqli_query($connection, "SELECT qno From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		$qno=$_SESSION['companyshortname'].' / QN / '.date('m').date('y').' /'.(str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
		$qdate=date('Y-m-d');
		mysqli_query($connection, "update jrcsrno set qno=qno+1"); */
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
				
				 $sqlup = "INSERT INTO jrcquotation set createdon='$createdon', createdby='$createdby', consigneeid='$consigneeid',engineerid='$engineerid', sourceid='$sourceid', calltid='$calltid',quotationtype='$quotationtype', productname='$productname', qno='$qno', qdate='$qdate', qtype='PRODUCT', prototal='$prototal', scrtotal='$scrtotal', gratotal='$gratotal',  price='$price', minprice='$minprice', gst='$gst', scrapvalue='$scrapvalue', installcost='$installcost', saleprice='$saleprice', salequantity='$salequantity', salesinstallation='$salesinstallation', salesinstallcost='$salesinstallcost', salestotal='$salestotal', salesgst='$salesgst', salesnettotal='$salesnettotal', salescrap='$salescrap', salescrapvalue='$salescrapvalue', salesgrandtotal='$salesgrandtotal'";
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
				
		 $sqlup = "INSERT INTO jrcquotation set createdon='$createdon', createdby='$createdby', consigneeid='$consigneeid', 
engineerid='$engineerid', sourceid='$sourceid', calltid='$calltid',quotationtype='$quotationtype', productname='$productname', qno='$qno', qdate='$qdate', qtype='SCRAP', prototal='$prototal', scrtotal='$scrtotal', gratotal='$gratotal',  price='$price', minprice='$minprice', gst='$gst', scrapvalue='$scrapvalue', installcost='$installcost', saleprice='$saleprice', salequantity='$salequantity', salesinstallation='$salesinstallation', salesinstallcost='$salesinstallcost', salestotal='$salestotal', salesgst='$salesgst', salesnettotal='$salesnettotal', salescrap='$salescrap', salescrapvalue='$salescrapvalue', salesgrandtotal='$salesgrandtotal'";
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
			header("Location: quotations.php?id={$consigneeid}&remarks=Quotation Updated Successfully");
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