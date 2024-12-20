<?php
include('lcheck.php');
if($addamc=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	
	if(isset($_POST['sourceid']))
	{
		$createdon=date('Y-m-d h:i:s a');
		$createdby=$email;
		$sourceid=mysqli_real_escape_string($connection, $_POST['sourceid']);
		$amcid=mysqli_real_escape_string($connection, $_POST['amcid']);
		$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
		$productid=mysqli_real_escape_string($connection, $_POST['productid']);
		$amctype=mysqli_real_escape_string($connection, $_POST['amctype']);
		$amcduration=mysqli_real_escape_string($connection, $_POST['amcduration']);
		$datefrom=mysqli_real_escape_string($connection, $_POST['datefrom']);
		$dateto=mysqli_real_escape_string($connection, $_POST['dateto']);
		$amcdetails=mysqli_real_escape_string($connection, $_POST['amcdetails']);
		if(isset($_POST['quotationid']))
	{
		$quotationid=mysqli_real_escape_string($connection, $_POST['quotationid']);
	}
	else
	{
		$quotationid="";
	} 
		$priceperyear=mysqli_real_escape_string($connection, $_POST['priceperyear']);
		if(!empty($_POST["serialnumber"]))
		  {
		$serialnumber=mysqli_real_escape_string($connection,implode(',',$_POST['serialnumber']));
		  } 
		  else 
		  {
		$serialnumber="";
		  }
		$resultvalue=(float)mysqli_real_escape_string($connection, $_POST['resultvalue']);
		$quantity=(float)mysqli_real_escape_string($connection, $_POST['quantity']);
		$amcgst=(float)mysqli_real_escape_string($connection, $_POST['amcgst']);
		$amcgstvalue=(float)mysqli_real_escape_string($connection, $_POST['amcgstvalue']);
		$btotalvalue=(float)mysqli_real_escape_string($connection, $_POST['btotalvalue']);
		$totalvalue=(float)mysqli_real_escape_string($connection, $_POST['totalvalue']);
		$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype']);
		$receivedamount=mysqli_real_escape_string($connection, $_POST['receivedamount']);
		$receivedmode=mysqli_real_escape_string($connection, $_POST['receivedmode']);
		$receiveddate=mysqli_real_escape_string($connection, $_POST['receiveddate']);
		$receivedby=mysqli_real_escape_string($connection, $_POST['receivedby']);
		$remarks=mysqli_real_escape_string($connection, $_POST['remarks']);
		$amcinvoiceno=mysqli_real_escape_string($connection, $_POST['amcinvoiceno']);
		
		
		
$sqlselect = "select id from jrcamc where sourceid='".$sourceid."' and amcinvoiceno='".$amcinvoiceno."'";
$queryselect = mysqli_query($connection, $sqlselect);
if(mysqli_num_rows($queryselect)>0)
{
	$infoselect=mysqli_fetch_array($queryselect);
	$tid=$infoselect['id'];
	$sql = "update jrcamchistory set sourceid='".$sourceid."', consigneeid='".$consigneeid."', productid='".$productid."', amctype='".$amctype."', amcduration='".$amcduration."', datefrom='".$datefrom."', dateto='".$dateto."', priceperyear='".$priceperyear."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."', quantity='".$quantity."', amcgst='".$amcgst."', amcgstvalue='".$amcgstvalue."', btotalvalue='".$btotalvalue."',totalvalue='".$totalvalue."', quotationtype='".$quotationtype."', amcdetails='".$amcdetails."', receivedamount='".$receivedamount."', receivedmode='".$receivedmode."', receiveddate='".$receiveddate."', receivedby='".$receivedby."', remarks='".$remarks."' where amcinvoiceno='".$amcinvoiceno."'";
	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A AMC', '{$tid}', 'jrcamchistory')");
	$query = mysqli_query($connection, $sql);
	mysqli_query($connection, "update jrcamc set sourceid='".$sourceid."', consigneeid='".$consigneeid."', productid='".$productid."', amctype='".$amctype."', amcduration='".$amcduration."', datefrom='".$datefrom."', dateto='".$dateto."', priceperyear='".$priceperyear."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."', quantity='".$quantity."', amcgst='".$amcgst."', amcgstvalue='".$amcgstvalue."',  btotalvalue='".$btotalvalue."',totalvalue='".$totalvalue."', quotationtype='".$quotationtype."', amcdetails='".$amcdetails."', receivedamount='".$receivedamount."', receivedmode='".$receivedmode."', receiveddate='".$receiveddate."', receivedby='".$receivedby."', remarks='".$remarks."' where  amcinvoiceno='".$amcinvoiceno."'");
	
}
else
{
	 $sql = "insert into jrcamchistory set createdon='".$createdon."',createdby='".$createdby."',sourceid='".$sourceid."', consigneeid='".$consigneeid."', productid='".$productid."', amctype='".$amctype."', amcduration='".$amcduration."', datefrom='".$datefrom."', dateto='".$dateto."', priceperyear='".$priceperyear."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."', quantity='".$quantity."', amcgst='".$amcgst."', amcgstvalue='".$amcgstvalue."',  btotalvalue='".$btotalvalue."',totalvalue='".$totalvalue."', quotationtype='".$quotationtype."', amcdetails='".$amcdetails."', quotationid='".$quotationid."', receivedamount='".$receivedamount."', receivedmode='".$receivedmode."', receiveddate='".$receiveddate."', receivedby='".$receivedby."', remarks='".$remarks."', amcinvoiceno='".$amcinvoiceno."', amcrenewtype='Renewal'";
	$query = mysqli_query($connection, $sql);
	mysqli_query($connection,"insert into jrcamc set createdon='".$createdon."',createdby='".$createdby."',sourceid='".$sourceid."', consigneeid='".$consigneeid."', productid='".$productid."', amctype='".$amctype."', amcduration='".$amcduration."', datefrom='".$datefrom."', dateto='".$dateto."', priceperyear='".$priceperyear."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."', quantity='".$quantity."', amcgst='".$amcgst."', amcgstvalue='".$amcgstvalue."',  btotalvalue='".$btotalvalue."',totalvalue='".$totalvalue."', quotationtype='".$quotationtype."', amcdetails='".$amcdetails."', quotationid='".$quotationid."', receivedamount='".$receivedamount."', receivedmode='".$receivedmode."', receiveddate='".$receiveddate."', receivedby='".$receivedby."', remarks='".$remarks."', amcinvoiceno='".$amcinvoiceno."', amcrenewtype='Renewal'");
	
if($sql)
	{
		//for invoice increment
				 $sqlamcinvoice = "SELECT amcinvoiceno from jrcamcinvoice";
				$queryamcinvoice = mysqli_query($connection, $sqlamcinvoice);
				$rowCountamcinvoice = mysqli_num_rows($queryamcinvoice);
				if(!$queryamcinvoice){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountamcinvoice > 0)
				{
				$rowamcinvoice = mysqli_fetch_array($queryamcinvoice);
				$total=$rowamcinvoice['amcinvoiceno']+1;
				}
			    mysqli_query($connection, "update jrcamcinvoice set amcinvoiceno='$total' ");
				
				
		mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Inserted A AMC', '{$tid}', 'jrcamchistory')");
		if($quotationid!='')
		{
	//$sqls1=mysqli_query($connection,"update jrcamchistory set status='2' where quotationid='".$quotationid."'");	
		 $sqls2=mysqli_query($connection,"update jrcamcquotation set compstatus='2',adate='$createdon' where id='".$quotationid."' ");	
		}
			
	}
	else
	{
		$error=mysqli_error($connection);
	}	
}

if(!$query){
    die("SQL query failed: " . mysqli_error($connection));
}
else
{
	header("Location: amcrenewal.php?consigneeid={$consigneeid}&xlid={$sourceid}&remarks=Updated Successfully");
}
			}
	else
			{
				header("Location: amcrenewal.php?error=Error Data");
			}
}
else
			{
				//header("Location: amcrenewal.php?error");
			}
?>