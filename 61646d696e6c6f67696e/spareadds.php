<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
	
{
	$subcategory=mysqli_real_escape_string($connection, $_POST['subcategory']);
	$maincategory=mysqli_real_escape_string($connection, $_POST['maincategory']);
	$wattage=mysqli_real_escape_string($connection, $_POST['wattage']);
	$price=mysqli_real_escape_string($connection, $_POST['price']);
	$gstper=mysqli_real_escape_string($connection, $_POST['gstper']);
	$spareunit=mysqli_real_escape_string($connection, $_POST['spareunit']);
		$msg = "";
  $msg_class = "";
	if(($subcategory!="")||($maincategory!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcspares WHERE subcategory = '{$subcategory}' and maincategory = '{$maincategory}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcspares( subcategory, maincategory, wattage, price,gstper,spareunit) VALUES ( '$subcategory', '$maincategory', '$wattage', '$price', '$gstper', '$spareunit')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid , tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Spare Name', '{$tid}', 'jrcspares' )");
				header("Location: spare.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: spare.php?error=This record is Already Found! Kindly check in All Spare Name List");
			}
	}
	else
			{
				header("Location: spare.php?error=Error Data");
			}
}
else
			{
				header("Location: spare.php");
			}
?>