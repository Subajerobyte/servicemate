<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['changeid']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['changeid']);
	 
        $sqlcon = "SELECT * From jrcproduct WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }	
	$infocon = mysqli_fetch_array($querycon);
	
	$stockmaincategoryvalue=$infocon['stockmaincategory'];
	$stocksubcategoryvalue=$infocon['stocksubcategory'];
	$stockitemvalue=$infocon['stockitem'];
	$typeofproductvalue=$infocon['typeofproduct'];
	$componenttypevalue=$infocon['componenttype'];
	$componentnamevalue=$infocon['componentname'];
	$makevalue=$infocon['make'];
	$capacityvalue=$infocon['capacity'];
		
	if((isset($_POST['ids']))&&is_array($_POST['ids']))
	{
		for($i=0;$i<count($_POST['ids']);$i++)
		{		
		$ids=mysqli_real_escape_string($connection, $_POST['ids'][$i]);
		 
        $sqlcon = "SELECT id From jrcxl WHERE tdelete='0' and  productid = '{$ids}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon)
		{
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup1 = "update jrcxl set stockmaincategory='$stockmaincategoryvalue', stocksubcategory='$stocksubcategoryvalue', stockitem='$stockitemvalue', typeofproduct='$typeofproductvalue', componenttype='$componenttypevalue', componentname='$componentnamevalue', make='$makevalue', capacity='$capacityvalue', productid='$id' where productid='$ids'";
			
			$queryup1 = mysqli_query($connection, $sqlup1);
			 
			if(!$queryup1)
			{
			   die("SQL query failed: " . mysqli_error($connection));
			}
			$sqlup2 = "update jrcamc set productid='$id' where productid='$ids'";
			$queryup2 = mysqli_query($connection, $sqlup2);
			 
			if(!$queryup2)
			{
			   die("SQL query failed: " . mysqli_error($connection));
			}
			$sqlup5 = "update jrcserials set productid='$id' where productid='$ids'";
			$queryup5 = mysqli_query($connection, $sqlup5);
			 
			if(!$queryup5)
			{
				die("SQL query failed: " . mysqli_error($connection));
			}
	    }
	}
}
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Merge A Product', '{$id}', 'jrcxl')");
				
header("Location: productmerge.php?remarks=Added Successfully");
			}
	else
			{
				header("Location: productmerge.php?error=Error Data");
			}
}
else
{
	header("Location: productmerge.php");
}
?>