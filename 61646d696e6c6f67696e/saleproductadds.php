<?php
include('lcheck.php');
if($sellprice=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$changedon=date('Y-m-d H:i:s');
	$protype=mysqli_real_escape_string($connection, $_POST['protype']);
	$productname=mysqli_real_escape_string($connection, $_POST['productname']);
	$description=mysqli_real_escape_string($connection, $_POST['description']);
	$make=mysqli_real_escape_string($connection, $_POST['make']);
	$price=mysqli_real_escape_string($connection, $_POST['price']);
	$minprice=mysqli_real_escape_string($connection, $_POST['minprice']);
	$gst=mysqli_real_escape_string($connection, $_POST['gst']);
	$warranty=mysqli_real_escape_string($connection, $_POST['warranty']);
	$scrapvalue=mysqli_real_escape_string($connection, $_POST['scrapvalue']);

	$msg = "";
  	$msg_class = "";
	if(($protype!="")&&($productname!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcproduct WHERE productname = '{$productname}' and protype = '{$protype}' and make = '{$make}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcproduct( protype, productname, description, make,  price, minprice, gst, warranty, scrapvalue) VALUES ( '$protype', '$productname', '$description', '$make', '$price', '$minprice', '$gst', '$warranty', '$scrapvalue')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				$sqlup1 = "INSERT INTO jrcsaleprohistory( productid, changedon, price, minprice, gst, warranty, scrapvalue) VALUES ( '$tid', '$changedon', '$price', '$minprice', '$gst', '$warranty', '$scrapvalue')";
				$queryup1 = mysqli_query($connection, $sqlup1);
				//////
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Selling Price', '{$tid}')");
				header("Location: saleproduct.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: saleproduct.php?error=This record is Already Found! Kindly check in All Sales Product List");
			}
	}
	else
			{
				header("Location: saleproduct.php?error=Error Data");
			}
}
else
			{
				header("Location: saleproduct.php");
			}
?>