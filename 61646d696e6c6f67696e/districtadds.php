<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
	$state=mysqli_real_escape_string($connection, $_POST['state']);
		$msg = "";
  $msg_class = "";
	if(($districtvalue!="")&&($districtvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcdistrict WHERE district = '{$districtvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcdistrict( district, state) VALUES ( '$districtvalue', '$state')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A District', '{$tid}', 'jrcdistrict')");
				header("Location: district.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: district.php?error=This record is Already Found! Kindly check in All District List");
			}
	}
	else
			{
				header("Location: district.php?error=Error Data");
			}
}
else
			{
				header("Location: district.php");
			}
?>