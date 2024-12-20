<?php
include('lcheck.php');
if((isset($_POST['engineerid']))&&(isset($_POST['attdate'])))
{
	$ticketapproveby=$useremail;
	$ticketapproveon=date('Y-m-d H:i:s');
	$eid=mysqli_real_escape_string($connection,$_POST['engineerid']);
	$attdate=mysqli_real_escape_string($connection,$_POST['attdate']);
	$callpoints=mysqli_real_escape_string($connection,$_POST['callpoints']);
	$totalkms=mysqli_real_escape_string($connection,$_POST['totalkms']);
	$travelpoints=mysqli_real_escape_string($connection,$_POST['travelpoints']);
	$daamount=mysqli_real_escape_string($connection,$_POST['daamount']);
	$dakms=mysqli_real_escape_string($connection,$_POST['dakms']);
	
	$startingkm = mysqli_real_escape_string($connection,$_POST['startingkm']);
	$endingkm = mysqli_real_escape_string($connection,$_POST['endingkm']);
	$totalkm = mysqli_real_escape_string($connection,$_POST['totalkm']);
	$rateperkm = mysqli_real_escape_string($connection,$_POST['rateperkm']);
	$travelcost = mysqli_real_escape_string($connection,$_POST['travelcost']);
	$othercost = mysqli_real_escape_string($connection,$_POST['othercost']);
	$othermaterial = mysqli_real_escape_string($connection,$_POST['othermaterial']);
	$couriercharges = mysqli_real_escape_string($connection,$_POST['couriercharges']);
	$materialcharges = mysqli_real_escape_string($connection,$_POST['materialcharges']);
	$travelexpense = mysqli_real_escape_string($connection,$_POST['travelexpense']);
	$tototherexpense = mysqli_real_escape_string($connection,$_POST['tototherexpense']);
	$totexpense = mysqli_real_escape_string($connection,$_POST['totexpense']);
	
	$sqlmap = "SELECT id From jrcengroute where engineerid='".$eid."' and attdate like '".$attdate."%' order by attdate desc";
    $querymap = mysqli_query($connection, $sqlmap);
    $rowCountmap = mysqli_num_rows($querymap);
     
    if(!$querymap){
       die("SQL query failed: " . mysqli_error($connection));
    }
     
    if($rowCountmap > 0) 
	{
		$sqlup=mysqli_query($connection, "update jrcengroute set ticketapprove='1', ticketapproveby='$ticketapproveby', ticketapproveon='$ticketapproveon', callpoints='$callpoints', totalkms='$totalkms', travelpoints='$travelpoints', daamount='$daamount', dakms='$dakms', travelexpense='$travelexpense',startingkm='$startingkm', endingkm='$endingkm', totalkm='$totalkm', rateperkm='$rateperkm', travelcost='$travelcost',othercost='$othercost',othermaterial='$othermaterial', couriercharges='$couriercharges', materialcharges='$materialcharges',tototherexpense='$tototherexpense',totexpense='$totexpense' where engineerid='".$eid."' and attdate like '".$attdate."%'");	
		if($sqlup)
		{
			header("location: mapengineerview.php?id={$eid}&attdate={$attdate}&remarks=Approved Successfully");
		}
		else
		{
		header("location: mapengineerview.php?id={$eid}&attdate={$attdate}&error=Unable to Approve");
		}
	}
	else
	{
	header("location: mapengineerview.php?id={$eid}&attdate={$attdate}");
	}
}
else
{
	header("location: mapengineer.php");
}
?>