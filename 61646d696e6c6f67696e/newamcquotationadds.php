<?php 
include('lcheck.php'); 
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
		$btotalvalue=(float)mysqli_real_escape_string($connection, $_POST['btotalvalue']);
		$totalvalue=(float)mysqli_real_escape_string($connection, $_POST['totalvalue']);
		$maintenancetype=mysqli_real_escape_string($connection, $_POST['maintenancetype']);
		$quotationtype="1";
		$datefrom=mysqli_real_escape_string($connection, $_POST['datefrom']);
		$dateto=mysqli_real_escape_string($connection, $_POST['dateto']);
		
		$amcrenewtype=mysqli_real_escape_string($connection, $_POST['amcrenewtype']);
		
		
		
		$sqlselect = "select id from jrcamcquotation where sourceid='".$sourceid."' and createdon='".$createdon."'";
		$queryselect = mysqli_query($connection, $sqlselect);
		 if($rowCountcon == 0) 
		{	
			
				$querysr = mysqli_query($connection, "SELECT qno From jrcamcsrno");
				$infosr=mysqli_fetch_array($querysr);
		 		$qno=$_SESSION['companyshortname'].'/AMC/'.date('d').date('m').'-'.date('y').'/'.(str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
				//$qno=$_SESSION['companyshortname'].' / QN / '.date('m').date('y').' /'.(str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
				//$qno=$_SESSION['companyshortname'].' / QN / '.date('m').date('y').' /'.(str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
				$qdate=date('Y-m-d');
				$succe=0;
		
				mysqli_query($connection, "update jrcamcsrno set qno=qno+1");
				$sql = "insert into jrcamcquotation set createdon='".$createdon."', createdby='".$createdby."', sourceid='".$sourceid."',consigneeid='".$consigneeid."',  qno='".$qno."', qdate='".$createdon."', priceperyear='".$priceperyear."', noofmonths='".$noofmonths."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."',quantity='".$quantity."', amcgstvalue='".$amcgstvalue."',amcgst='".$amcgst."',btotalvalue='".$btotalvalue."',totalvalue='".$totalvalue."',  quotationtype='".$quotationtype."', datefrom='".$datefrom."', dateto='".$dateto."', maintenancetype='".$maintenancetype."', amcrenewtype='".$amcrenewtype."'";
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
			
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A AMC Quotation', '{$qno}', 'jrcamcquotation')");
							
					header("Location: amcquotations.php?remarks=AMC Quotation Added Successfully");
		}
			else
		{
			header("Location: amcquotations.php?error=Error");
		}		
		}	
}
else
{
header("Location: amcquotation.php");
} 
?>