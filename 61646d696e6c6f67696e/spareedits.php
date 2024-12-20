<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
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
		 
        $sqlcon = "SELECT id From jrcspares WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcspares set subcategory='$subcategory', maincategory='$maincategory', wattage='$wattage', price='$price',gstper='$gstper',spareunit='$spareunit' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Spare Name Information', '{$id}', 'jrcspares')");
				header("Location: spare.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: spare.php?error=This record is Not Found! Kindly check in All Spare Name List");
			}
	}
	else
			{
				header("Location: spare.php?error=Error Data");
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