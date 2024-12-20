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
	$productname=mysqli_real_escape_string($connection, $_POST['productname']);
	$type=mysqli_real_escape_string($connection, $_POST['type']);
	$itemrate=mysqli_real_escape_string($connection, $_POST['itemrate']);
	$description=mysqli_real_escape_string($connection, $_POST['description']);
	$markper=mysqli_real_escape_string($connection, $_POST['markper']);
	$percentage=mysqli_real_escape_string($connection, $_POST['percentage']);
	$roundof=mysqli_real_escape_string($connection, $_POST['roundof']);

	if(($productname!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcmark WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcmark set productname='$productname', type='$type', itemrate='$itemrate', description='$description', markper='$markper', percentage='$percentage', roundof='$roundof' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				
				$sqlup1 = "Delete from jrcmarklist where markid='$id'";
			     $queryup1 = mysqli_query($connection, $sqlup1);
				if($itemrate=='1')
				{
				if($_POST['customerate']!="" || $_POST['indeper']!="")
				{
					for($i=0;$i<count($_POST['customerate']);$i++)
				{
				$productid=mysqli_real_escape_string($connection, $_POST['productid'][$i]);
				$standardprice=mysqli_real_escape_string($connection, $_POST['standardprice'][$i]);
				$indeper=mysqli_real_escape_string($connection, $_POST['indeper'][$i]);
				$idpercentage=mysqli_real_escape_string($connection, $_POST['idpercentage'][$i]);
				$customerate=mysqli_real_escape_string($connection, $_POST['customerate'][$i]);
				 mysqli_query($connection, "INSERT INTO jrcmarklist(markid,productid, standardprice, indeper,idpercentage, customerate) VALUES ('{$id}','{$productid}', '{$standardprice}', '{$indeper}','{$idpercentage}','{$customerate}' )");
				}
				
				}
				}
				
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated a Price Mark Detail', '{$id}', 'jrcmark')");
				header("Location: mark.php?remarks=Updated Successfully");
	    }
		}
		else
			{
				header("Location: mark.php?error=This record is Not Found! Kindly check in All Price Marks List");
			}
	}
	else
			{
				header("Location: mark.php?error=Error Data");
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