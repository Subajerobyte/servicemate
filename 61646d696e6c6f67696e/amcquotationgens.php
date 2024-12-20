<?php 
include('lcheck.php'); 
include('push.php'); 
if(isset($_POST['submit']))
{
		$createdon=date('Y-m-d H:i:s');
		$createdby=$email;
		$sourceid=mysqli_real_escape_string($connection, $_POST['sourceid']);
		$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);	

		$priceperyear=mysqli_real_escape_string($connection, $_POST['priceperyear']);
		$noofmonths=mysqli_real_escape_string($connection, $_POST['noofmonths']);
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
		$totalvalue=(float)mysqli_real_escape_string($connection, $_POST['totalvalue']);
		$maintenancetype=mysqli_real_escape_string($connection, $_POST['maintenancetype']);
		$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype']);
		$datefrom=mysqli_real_escape_string($connection, $_POST['datefrom']);
		$dateto=mysqli_real_escape_string($connection, $_POST['dateto']);
		$maintenancetype=mysqli_real_escape_string($connection, $_POST['maintenancetype']);
		
		
		
		$sqlselect = "select id from jrcamcquotation where sourceid='".$sourceid."'";
		$queryselect = mysqli_query($connection, $sqlselect);
		if(mysqli_num_rows($queryselect)>0)
		{
			$infoselect=mysqli_fetch_array($queryselect);
			$tid=$infoselect['id'];
			$sql = "update jrcamcquotation set createdon='".$createdon."', createdby='".$createdby."',sourceid='".$sourceid."', consigneeid='".$consigneeid."',  priceperyear='".$priceperyear."', noofmonths='".$noofmonths."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."', quantity='".$quantity."',amcgst='".$amcgst."', amcgstvalue='".$amcgstvalue."',  totalvalue='".$totalvalue."', quotationtype='".$quotationtype."',datefrom='".$datefrom."', dateto='".$dateto."', maintenancetype='".$maintenancetype."' where id='".$infoselect['id']."'";
			
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A AMC', '{$tid}', 'jrcamc')");
			$query = mysqli_query($connection, $sql);
			  
			header("Location: amcquotations.php?remarks=AMC Quotation Updated Successfully");
		}
		else
		{
				$querysr = mysqli_query($connection, "SELECT qno From jrcamcsrno");
				$infosr=mysqli_fetch_array($querysr);
				$qno=$_SESSION['companyshortname'].'/AMC/'.date('d').date('m').'-'.date('y').'/'.(str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
				$qdate=date('Y-m-d');
				$succe=0;
		
				mysqli_query($connection, "update jrcamcsrno set qno=qno+1");
				$sql = "insert into jrcamcquotation set createdon='".$createdon."', createdby='".$createdby."', sourceid='".$sourceid."', consigneeid='".$consigneeid."',  qno='".$qno."', qdate='".$createdon."', priceperyear='".$priceperyear."', noofmonths='".$noofmonths."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."',quantity='".$quantity."', amcgstvalue='".$amcgstvalue."',amcgst='".$amcgst."',totalvalue='".$totalvalue."',  quotationtype='".$quotationtype."', datefrom='".$datefrom."', dateto='".$dateto."', maintenancetype='".$maintenancetype."' ";
				$query = mysqli_query($connection, $sql);
				if(!$query){
				die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					$succe++;
				}
				if($succe!=0)
		{
			
			if(isset($_POST['ts1']))
			{
				$ts1=mysqli_real_escape_string($connection, $_POST['ts1']);
				$sqlts=mysqli_query($connection, "select id from jrcreminder where id='$ts1'");
				if(mysqli_num_rows($sqlts)>0)
				{
					$sqlits1=mysqli_query($connection, "update jrcreminder set status='AMC', enabled='1' where id='$ts1' ");
				}
			}
			
	
			//mysqli_query($connection, "update jrccalls set amcquotationgen='$qno' where calltid='$calltid'");
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A AMC Quotation', '{$qno}', 'jrcamcquotation')");
							header("Location: amcquotations.php?remarks=AMC Quotation Added Successfully");
					 //echo "Location: amcquotations.php?remarks=AMC Quotation Added Successfully";
		}
			else
		{
			// echo "Location: amcquotations.php?error=Error";
			header("Location: amcquotations.php?error=Error");
		}		
		}	
}
else
{
	header("Location: amcquotation.php");
} 
?>  