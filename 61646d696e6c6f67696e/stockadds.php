<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$stockmaincategoryvalue=mysqli_real_escape_string($connection, $_POST['stockmaincategory']);
	$stocksubcategoryvalue=mysqli_real_escape_string($connection, $_POST['stocksubcategory']);
		$stockitemvalue=mysqli_real_escape_string($connection, $_POST['stockitem']);
		
	if(($stockitemvalue!="")&&($stockitemvalue!="Product Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcstock WHERE stockmaincategory = '{$stockmaincategoryvalue}' and stocksubcategory = '{$stocksubcategoryvalue}' and stockitem = '{$stockitemvalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcstock( stockmaincategory, stocksubcategory, stockitem) VALUES ( '$stockmaincategoryvalue', '$stocksubcategoryvalue', '$stockitemvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Stock', '{$tid}')");
				header("Location: stock.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: stock.php?error=This record is Already Found! Kindly check in All Stock List");
			}
	}
	else
			{
				header("Location: stock.php?error=Error Data");
			}
}
else
			{
				header("Location: stock.php");
			}






?>