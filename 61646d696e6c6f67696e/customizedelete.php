<?php 
include ('lcheck.php');
?>
<?php 
	if(isset($_GET['id']))
	{
	$id=$_GET['id'];
	$sql="select * from jrccustomize where id='".$id."'";
	$result=mysqli_query($connection,$sql);
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
					if($connection)
					{
						$sql2=mysqli_query($connection,"DELETE FROM jrccustomize  where id='".$id."'");
							if($sql2)
								{
									header("location:customize.php?remarks=This Customize Information has been Deleted Successfully");
								}
								else
									{
										header("location:customize.php?error=".mysqli_error($connection));
									}
					}
					else
					{
						header("location:customize.php?error=Record does not Exists");
					}
		}
		else
		{
			header("location:customize.php?error=No Such Id");
		}
	}
	else
	{
		header("location:customize.php?error=Please Try Again");
	}
?>		
