<?php 
include('lcheck.php'); 
include('push.php'); 
if(isset($_POST['submit']))
{
		$createdon=mysqli_real_escape_string($connection, $_POST['createdon']);
		$createdby=mysqli_real_escape_string($connection, $_POST['createdby']);
		$calltid=mysqli_real_escape_string($connection, $_POST['calltid']);
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
		$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype']);
		$datefrom=mysqli_real_escape_string($connection, $_POST['datefrom']);
		$dateto=mysqli_real_escape_string($connection, $_POST['dateto']);
		$amcrenewtype=mysqli_real_escape_string($connection, $_POST['amcrenewtype']);

		
		$sqlselect = "select id from jrcamcquotation where sourceid='".$sourceid."' and  createdon='".$createdon."'";
		$queryselect = mysqli_query($connection, $sqlselect);
		if(mysqli_num_rows($queryselect)>0)
		{
			$infoselect=mysqli_fetch_array($queryselect);
			$tid=$infoselect['id'];
			$sql = "update jrcamcquotation set calltid='".$calltid."',sourceid='".$sourceid."', consigneeid='".$consigneeid."',  priceperyear='".$priceperyear."', noofmonths='".$noofmonths."', serialnumber='".$serialnumber."', resultvalue='".$resultvalue."', quantity='".$quantity."',amcgst='".$amcgst."', amcgstvalue='".$amcgstvalue."',  btotalvalue='".$btotalvalue."',totalvalue='".$totalvalue."', quotationtype='".$quotationtype."',datefrom='".$datefrom."', dateto='".$dateto."',amcrenewtype='".$amcrenewtype."', maintenancetype='".$maintenancetype."' where id='".$infoselect['id']."'";
			
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A AMC', '{$tid}', 'jrcamc')");
			$query = mysqli_query($connection, $sql);
			header("Location: amcquotations.php?remarks=AMC Quotation Updated Successfully");
		}
}
else
{
header("Location: consigneeview.php?id={$consigneeid}");
} 
?>