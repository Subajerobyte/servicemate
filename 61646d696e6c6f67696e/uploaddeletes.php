<?php
include('lcheck.php');
if($deleteproduct=='0')
{
	header("Location: dashboard.php");
}

if(isset($_GET['submit']))
{
	if(isset($_GET['submit']))
	{
	$filename=$_GET['filename'];
	$sqlselect = "delete From jrcuploads WHERE file_name = '{$filename}'";
        $queryselect = mysqli_query($connection, $sqlselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		else
		{
			
				$sqlselect = "delete From jrcxl WHERE file_name = '{$filename}'";
        $queryselect = mysqli_query($connection, $sqlselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		else
		{
			
				header("Location: uploadhistory.php?Deleted Successfully");
			}
			}
	}
	else
			{
				header("Location: uploadhistory.php?error=Error Data");
			}
}
else
			{
				header("Location: uploadhistory.php");
			}
?>