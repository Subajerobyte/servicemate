<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['maincategory']);
		$msg = "";
  $msg_class = "";
	if(($maincategoryvalue!="")&&($maincategoryvalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrccustcategory WHERE maincategory = '{$maincategoryvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrccustcategory( maincategory) VALUES ( '$maincategoryvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Customer Main Category', '{$tid}', 'jrccustcategory')");
				header("Location: custcategory.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: custcategory.php?error=This record is Already Found! Kindly check in All Customer Main Category List");
			}
	}
	else
			{
				header("Location: custcategory.php?error=Error Data");
			}
}
else
			{
				header("Location: custcategory.php");
			}
?>