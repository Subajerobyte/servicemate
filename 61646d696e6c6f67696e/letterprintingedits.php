<?php
include('lcheck.php');
if($uploaddata=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$title=mysqli_real_escape_string($connection, $_POST['title']);
	$message=mysqli_real_escape_string($connection, $_POST['message']);
	if(isset($_POST['fieldname1']))
	{
		$fieldname1=mysqli_real_escape_string($connection, $_POST['fieldname1']);
	}
	else
	{
	$fieldname1="";	
	}
	if(isset($_POST['fieldname2']))
	{
		$fieldname2=mysqli_real_escape_string($connection, $_POST['fieldname2']);
	}
	else
	{
	$fieldname2="";	
	}
	
	if(isset($_POST['fieldname3']))
	{
		$fieldname3=mysqli_real_escape_string($connection, $_POST['fieldname3']);
	}
	else
	{
	$fieldname3="";	
	}
	if(isset($_POST['fieldname4']))
	{
		$fieldname4=mysqli_real_escape_string($connection, $_POST['fieldname4']);
	}
	else
	{
	$fieldname4="";	
	}
	if(isset($_POST['fieldname5']))
	{
		$fieldname5=mysqli_real_escape_string($connection, $_POST['fieldname5']);
	}
	else
	{
	$fieldname5="";	
	}
	if(isset($_POST['fieldname6']))
	{
		$fieldname6=mysqli_real_escape_string($connection, $_POST['fieldname6']);
	}
	else
	{
	$fieldname6="";	
	}
	if(isset($_POST['fieldname7']))
	{
		$fieldname7=mysqli_real_escape_string($connection, $_POST['fieldname7']);
	}
	else
	{
	$fieldname7="";	
	}
	if(isset($_POST['fieldname8']))
	{
		$fieldname8=mysqli_real_escape_string($connection, $_POST['fieldname8']);
	}
	else
	{
	$fieldname8="";	
	}
	if(isset($_POST['fieldname9']))
	{
		$fieldname9=mysqli_real_escape_string($connection, $_POST['fieldname9']);
	}
	else
	{
	$fieldname9="";	
	}
	if(isset($_POST['fieldname10']))
	{
		$fieldname10=mysqli_real_escape_string($connection, $_POST['fieldname10']);
	}
	else
	{
	$fieldname10="";	
	}
	
	if(isset($_POST['fieldvalue1']))
	{
		$fieldvalue1=mysqli_real_escape_string($connection, $_POST['fieldvalue1']);
	}
	else
	{
	$fieldvalue1="";	
	}
	if(isset($_POST['fieldvalue2']))
	{
		$fieldvalue2=mysqli_real_escape_string($connection, $_POST['fieldvalue2']);
	}
	else
	{
	$fieldvalue2="";	
	}


if(isset($_POST['fieldvalue3']))
	{
		$fieldvalue3=mysqli_real_escape_string($connection, $_POST['fieldvalue3']);
	}
	else
	{
	$fieldvalue3="";	
	}
	if(isset($_POST['fieldvalue4']))
	{
		$fieldvalue4=mysqli_real_escape_string($connection, $_POST['fieldvalue4']);
	}
	else
	{
	$fieldvalue4="";	
	}	
if(isset($_POST['fieldvalue5']))
	{
		$fieldvalue5=mysqli_real_escape_string($connection, $_POST['fieldvalue5']);
	}
	else
	{
	$fieldvalue5="";	
	}
	if(isset($_POST['fieldvalue6']))
	{
		$fieldvalue6=mysqli_real_escape_string($connection, $_POST['fieldvalue6']);
	}
	else
	{
	$fieldvalue6="";	
	}	
if(isset($_POST['fieldvalue7']))
	{
		$fieldvalue7=mysqli_real_escape_string($connection, $_POST['fieldvalue7']);
	}
	else
	{
	$fieldvalue7="";	
	}
	if(isset($_POST['fieldvalue8']))
	{
		$fieldvalue8=mysqli_real_escape_string($connection, $_POST['fieldvalue8']);
	}
	else
	{
	$fieldvalue8="";	
	}
if(isset($_POST['fieldvalue9']))
	{
		$fieldvalue9=mysqli_real_escape_string($connection, $_POST['fieldvalue9']);
	}
	else
	{
	$fieldvalue9="";	
	}
	if(isset($_POST['fieldvalue10']))
	{
		$fieldvalue10=mysqli_real_escape_string($connection, $_POST['fieldvalue10']);
	}
	else
	{
	$fieldvalue10="";	
	}
		
	if($title!="")
	{		
		 
       $sqlcon = "SELECT id From jrcletter WHERE  id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcletter set title='$title', message='$message' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Letter Printing', '{$id}', 'jrcletter')");
				 header("Location: letterprintings.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: letterprintings.php?error=This record is Not Found! Kindly check in All Letter Printing List");
			}
	}
	else
			{
				header("Location: letterprintings.php?error=Error Data");
			}
			}
	else
			{
				header("Location: letterprintings.php?error=Error Data");
			}
}
else
			{
				header("Location: letterprintings.php");
			}
?>