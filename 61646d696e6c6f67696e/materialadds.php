<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$materialvalue=mysqli_real_escape_string($connection, $_POST['material']);
	$descriptionvalue=mysqli_real_escape_string($connection, $_POST['description']);
		$msg = "";
  $msg_class = "";
	if(($materialvalue!="")&&($materialvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcmaterial WHERE material = '{$materialvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcmaterial(material,description) VALUES ( '$materialvalue','$descriptionvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Additional Materials', '{$tid}', 'jrcmaterial')");
				header("Location: material.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: material.php?error=This record is Already Found! Kindly check in All Additional Materials List");
			}
	}
	else
			{
				header("Location: material.php?error=Error Data");
			}
}
else
			{
				header("Location: material.php");
			}
?>