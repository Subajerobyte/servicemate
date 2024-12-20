<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$stockmaincategoryvalue=mysqli_real_escape_string($connection, $_POST['stockmaincategory']);
	$stocksubcategoryvalue=mysqli_real_escape_string($connection, $_POST['stocksubcategory']);
		$stockitemvalue=mysqli_real_escape_string($connection, $_POST['stockitem']);
		
	if(($stockmaincategoryvalue!="")||($stocksubcategoryvalue!="")||($stockitemvalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcstock WHERE id = '{$id}'";
		$querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Stock Information', '{$id}')");
			 
			$sqlup = "update jrcstock set stockmaincategory='$stockmaincategoryvalue', stocksubcategory='$stocksubcategoryvalue', stockitem='$stockitemvalue' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$sqlup1 = "update jrcxl set stockmaincategory='$stockmaincategoryvalue', stocksubcategory='$stocksubcategoryvalue', stockitem='$stockitemvalue' where stockid='$id'";
				$queryup1 = mysqli_query($connection, $sqlup1);
				 
				if(!$queryup1){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					header("Location: stock.php?remarks=Updated Successfully");
				} 
			} 
	    }
		else
			{
				header("Location: stock.php?error=This record is Not Found! Kindly check in All Stock List");
			}
	}
	else
			{
				header("Location: stock.php?error=Error Data");
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