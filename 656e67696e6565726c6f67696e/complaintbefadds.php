<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$addedon=date('Y-m-d H:i:s');
	$editedon=date('Y-m-d H:i:s');
	$calltid=mysqli_real_escape_string($connection, $_POST['calltid']);
	$imgbefuploads=mysqli_real_escape_string($connection, $_POST['imgbefuploads']);
 
        $sqlcon = "SELECT id From jrccalldetails WHERE calltid = '{$calltid}' and reassign='0'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrccalldetails set addedon='$addedon', calltid='$calltid', imgbefuploads='$imgbefuploads'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "update jrccalls set detailsid='$tid' where calltid='$calltid'");
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A
 				Call Report(Site Image)', '{$tid}', 'jrccalldetails')");
				header("Location: complaint.php?id={$calltid}&remarks=Added Successfully");
			} 
	    }
		else
			{
				$info=mysqli_fetch_array($querycon);
				$tid=$info['id'];
				 
			$sqlup = "update jrccalldetails set editedon='$editedon', imgbefuploads='$imgbefuploads' where calltid='$calltid' and reassign='0'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "update jrccalls set detailsid='$tid' where calltid='$calltid'");
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A Call Report(Site Image)', '{$tid}', 'jrccalldetails')");
				header("Location: complaint.php?id={$calltid}&remarks=Updated Successfully");
			} 
			}
}
else
			{
				header("Location: dashboard.php?id={$calltid}");
			}
?>