<?php
include('lcheck.php');
if($sellprice=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))  
	{
	$changedon=date('Y-m-d H:i:s');
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$stockmaincategory=mysqli_real_escape_string($connection, $_POST['stockmaincategory']);
	$stocksubcategory=mysqli_real_escape_string($connection, $_POST['stocksubcategory']);
	$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem']);
	$typeofproduct=mysqli_real_escape_string($connection, $_POST['typeofproduct']);
	$componenttype=mysqli_real_escape_string($connection, $_POST['componenttype']);
	$componentname=mysqli_real_escape_string($connection, $_POST['componentname']);
	$make=mysqli_real_escape_string($connection, $_POST['make']);
	$capacity=mysqli_real_escape_string($connection, $_POST['capacity']);
	$model=mysqli_real_escape_string($connection, $_POST['model']);
	$description=mysqli_real_escape_string($connection, $_POST['description']);	
	$hsntype=mysqli_real_escape_string($connection, $_POST['hsntype']);	
	$price=mysqli_real_escape_string($connection, $_POST['price']);
	$minprice=mysqli_real_escape_string($connection, $_POST['minprice']);
	$gst=mysqli_real_escape_string($connection, $_POST['gst']);
	$warranty=mysqli_real_escape_string($connection, $_POST['warranty']);
	$warrantycycle=mysqli_real_escape_string($connection, $_POST['warrantycycle']);
	$productlifetime=mysqli_real_escape_string($connection, $_POST['productlifetime']);
	$scrapvalue=mysqli_real_escape_string($connection, $_POST['scrapvalue']);
	$amcvalue=mysqli_real_escape_string($connection, $_POST['amcvalue']);
	$amcminvalue=mysqli_real_escape_string($connection, $_POST['amcminvalue']);
	$amcgst=mysqli_real_escape_string($connection, $_POST['amcgst']);
	$camcvalue=mysqli_real_escape_string($connection, $_POST['camcvalue']);
	$camcminvalue=mysqli_real_escape_string($connection, $_POST['camcminvalue']);
	$camcgst=mysqli_real_escape_string($connection, $_POST['camcgst']);
	$rentalvalue=mysqli_real_escape_string($connection, $_POST['rentalvalue']);
	$rentalminvalue=mysqli_real_escape_string($connection, $_POST['rentalminvalue']);
	$rentalgst=mysqli_real_escape_string($connection, $_POST['rentalgst']);
	$installvalue=mysqli_real_escape_string($connection, $_POST['installvalue']);
	$gsttype=mysqli_real_escape_string($connection, $_POST['gsttype']);
	$msg = "";
  	$msg_class = "";
	if(($stockitem!=""))
	{		 
		 
        $sqlcon = "SELECT id From jrcproduct WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			  
			$sqlup = "update jrcproduct set stockmaincategory='$stockmaincategory',stocksubcategory='$stocksubcategory',stockitem='$stockitem',typeofproduct='$typeofproduct',componenttype='$componenttype',componentname='$componentname',make='$make',capacity='$capacity',model='$model', description='$description', hsntype='$hsntype', price='$price', minprice='$minprice', gst='$gst', warranty='$warranty',warrantycycle='$warrantycycle',productlifetime='$productlifetime', scrapvalue='$scrapvalue', amcvalue='$amcvalue', amcminvalue='$amcminvalue', amcgst='$amcgst', camcvalue='$camcvalue', camcminvalue='$camcminvalue', camcgst='$camcgst', rentalvalue='$rentalvalue', rentalminvalue='$rentalminvalue', rentalgst='$rentalgst', installvalue='$installvalue', gsttype='$gsttype' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				
				
				$sqlcon = "SELECT id, price, minprice, gst, warranty, scrapvalue From jrcsaleprohistory WHERE productid = '{$id}' order by id desc limit 1";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				 
				if(!$querycon){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountcon == 0) 
				{	
					$sqlup1 = "INSERT INTO jrcsaleprohistory( productid, changedon, price, minprice, gst, warranty, scrapvalue) VALUES ('$id', '$changedon', '$price', '$minprice', '$gst', '$warranty', '$scrapvalue')";
					$queryup1 = mysqli_query($connection, $sqlup1);
				}
				else
				{	
					$infos=mysqli_fetch_array($querycon);
					if(($infos['price']!=$price)||($infos['minprice']!=$minprice)||($infos['gst']!=$gst)||($infos['scrapvalue']!=$scrapvalue))
					{
						$sqlup1 = "INSERT INTO jrcsaleprohistory( productid, changedon, price, minprice, gst, warranty, scrapvalue) VALUES ('$id', '$changedon', '$price', '$minprice', '$gst', '$warranty', '$scrapvalue')";
						$queryup1 = mysqli_query($connection, $sqlup1);
					}
				}

				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Reported Problem Information', '{$id}', 'jrcproduct')");
				header("Location: saleproduct.php?remarks=Updated Successfully");
			} 
			}
			else
			{
				header("Location: saleproduct.php?error=This record is Not Found! Kindly check in All Sales Product List");
			}
			}
			else
			{
				header("Location: saleproduct.php?error=Error Data");
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