<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$gsttype=mysqli_real_escape_string($connection, $_POST['gsttype']);
	$gstpercentagevalue=mysqli_real_escape_string($connection, $_POST['gstpercentage']);
		$msg = "";
  $msg_class = "";
	if(($gstpercentagevalue!="")&&($gstpercentagevalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcgstpercentage WHERE gstpercentage = '{$gstpercentagevalue}' and gsttype = '{$gsttype}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcgstpercentage( gstpercentage, gsttype) VALUES ( '$gstpercentagevalue', '$gsttype')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A GST Rate', '{$tid}', 'jrcgstpercentage')");
				header("Location: gstpercentage.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: gstpercentage.php?error=This record is Already Found! Kindly check in All GST Rate List");
			}
	}
	else
			{
				header("Location: gstpercentage.php?error=Error Data");
			}
}
else
			{
				header("Location: gstpercentage.php");
			}
?>