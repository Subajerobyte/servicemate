 <?php
include ('lcheck.php');
?>
<?php
if($connection)
{	
    $id=$_GET['id'];	
    $image=$_GET['img'];	
    $image1=$_GET['img1'];	
	if(isset($_GET['id']))
	{
    if($_GET['t']=="Expense")
  { 
        unlink($image);
		$sql="SELECT expensedoc From jrciexpense  where id='".$id."'";	  
		$result= mysqli_query($connection, $sql);
			 if(mysqli_num_rows($result)>0) 
				{
					$sql2 = mysqli_query($connection,"UPDATE jrciexpense SET expensedoc = '' WHERE expensedoc='".$image."'");
					
					
					if($sql2)
						{
						header("location:filemanager.php?t=Expense&remarks= The Image has been Successfully Deleted");
						exit();
						}  
					else
						{
						header("location:filemanager.php?error=".mysqli_error($connection));
						}					
				}				
				}
		
		 if($_GET['t']=="calls")
  {
	  unlink($image);
	  $sql="SELECT diagnosisimg From jrccalls  where id='".$id."'";	  
		$result= mysqli_query($connection, $sql);
			 if(mysqli_num_rows($result)>0) 
				{
					$sql2 = mysqli_query($connection,"UPDATE jrccalls SET diagnosisimg = '' WHERE diagnosisimg='".$image."'");
					
					if($sql2)
						{
						header("location:filemanager.php?t=calls&remarks= The Image has been Successfully Deleted");
						exit();
						}  
					else
						{
						header("location:filemanager.php?error=".mysqli_error($connection));
						}					
				}				
				}
if($_GET['t']=="calls1")
  {
	  unlink($image1);
	  $sql="SELECT diagnosissignature From jrccalls  where id='".$id."'";	  
		$result= mysqli_query($connection, $sql);
			 if(mysqli_num_rows($result)>0) 
				{
					$sql2 = mysqli_query($connection,"UPDATE jrccalls SET diagnosissignature = '' WHERE diagnosissignature='".$image1."'");
					
					if($sql2)
						{
						header("location:filemanager.php?t=calls&remarks= The Image has been Successfully Deleted");
						exit();
						}  
					else
						{
						header("location:filemanager.php?error=".mysqli_error($connection));
						}					
				}				
				} 				
if($_GET['t']=="attendance")	
  { 
        unlink($image);
	    $sql="SELECT tickets From jrcengroute  where id='".$id."'";	  
		$result= mysqli_query($connection, $sql);
			 if(mysqli_num_rows($result)>0) 
				{
					$sql2 = mysqli_query($connection,"UPDATE jrcengroute SET tickets = '' WHERE tickets='".$image."'");
					
					if($sql2)
						{
						header("location:filemanager.php?t=attendance&remarks= The Image has been Successfully Deleted");
						exit();
						}  
					else
						{
						header("location:filemanager.php?error=".mysqli_error($connection));
						}					
				}				
				}
 if($_GET['t']=="complaint")	
  {
	  unlink($image);
	    $sql="SELECT imguploads From jrccalldetails  where id='".$id."'";	  
		$result= mysqli_query($connection, $sql);
			 if(mysqli_num_rows($result)>0) 
				{
					$sql2 = mysqli_query($connection,"UPDATE jrccalldetails SET imguploads = '' WHERE imguploads='".$image."'");
					
					if($sql2)
						{
						header("location:filemanager.php?t=complaint&remarks= The Image has been Successfully Deleted");
						exit();
						}  
					else
						{
						header("location:filemanager.php?error=".mysqli_error($connection));
						}					
				}				
				}
				if($_GET['t']=="complaint1")	
  {
	  unlink($image1);
	    $sql="SELECT imgbefuploads From jrccalldetails  where id='".$id."'";	  
		$result= mysqli_query($connection, $sql);
			 if(mysqli_num_rows($result)>0) 
				{
					$sql2 = mysqli_query($connection,"UPDATE jrccalldetails SET imgbefuploads = '' WHERE imgbefuploads='".$image1."'");
					
					if($sql2)
						{
						header("location:filemanager.php?t=complaint&remarks= The Image has been Successfully Deleted");
						exit();
						}  
					else
						{
						header("location:filemanager.php?error=".mysqli_error($connection));
						}					
				}				
				}
			else
			{
					header("location:filemanager.php?error= The image does not exist");
			}
	}
	else
	{
		header("location:filemanager.php?error=No such id");
	}	
}
else
{
	header("location:filemanager.php?error=Please Try Again");
}
?>

