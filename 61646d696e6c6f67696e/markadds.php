<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$createdon=date("Y-m-d H:i:s");
$createdby=$_SESSION['email'];
	$productname=mysqli_real_escape_string($connection, $_POST['productname']);
	$type=mysqli_real_escape_string($connection, $_POST['type']);
	$itemrate=mysqli_real_escape_string($connection, $_POST['itemrate']);
	$description=mysqli_real_escape_string($connection, $_POST['description']);
	$markper=mysqli_real_escape_string($connection, $_POST['markper']);
	$percentage=mysqli_real_escape_string($connection, $_POST['percentage']);
	$roundof=mysqli_real_escape_string($connection, $_POST['roundof']);
		
	if(($productname!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcmark WHERE productname ='{$productname}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcmark( createdby,createdon, type, productname,itemrate,description,markper,percentage,roundof) VALUES ( '$createdby', '$createdon','$type', '$productname', '$itemrate', '$description', '$markper', '$percentage','$roundof')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
			echo	$tid=mysqli_insert_id($connection);
				if($itemrate=='1')
				{
				if($_POST['customerate']!="" || $_POST['indeper']!="" || $_POST['idpercentage']!="" )
				{
					for($i=0;$i<count($_POST['customerate']);$i++)
				{
				$productid=mysqli_real_escape_string($connection, $_POST['productid'][$i]);
				$standardprice=mysqli_real_escape_string($connection, $_POST['standardprice'][$i]);
				$indeper=mysqli_real_escape_string($connection, $_POST['indeper'][$i]);
				$idpercentage=mysqli_real_escape_string($connection, $_POST['idpercentage'][$i]);
				$customerate=mysqli_real_escape_string($connection, $_POST['customerate'][$i]);
				echo $sql1="INSERT INTO jrcmarklist(markid,productid, standardprice,indeper,idpercentage, customerate) VALUES ('{$tid}','{$productid}', '{$standardprice}', '{$indeper}','{$idpercentage}','{$customerate}' )";
				$query1= mysqli_query($connection,$sql1);
				}
				
				}
				}
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Price Mark', '{$tid}', 'jrcmark')");
				header("Location: mark.php?remarks=Added Successfully");
				
			} 
	    }
		else
			{
				header("Location: mark.php?error=This record is Already Found! Kindly check in All Price Marks List");
			}
	}
	else
			{
				header("Location: mark.php?error=Error Data");
			}
}
else
			{
				header("Location: mark.php");
			}
?>