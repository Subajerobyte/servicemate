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
	$quotationtypevalue=mysqli_real_escape_string($connection, $_POST['quotationtype']);
	$terms=mysqli_real_escape_string($connection, $_POST['terms']);
	$stockitem=mysqli_real_escape_string($connection, implode(',',$_POST['stockitem']));
		$msg = "";
  $msg_class = "";


	if(($quotationtypevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcquotationtype WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcquotationtype set quotationtype='$quotationtypevalue', terms='$terms', stockitem='$stockitem' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Quotation Type Information', '{$id}', 'jrcquotationtype')");
				header("Location: quotationtype.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: quotationtype.php?error=This record is Not Found! Kindly check in All Quotation Type List");
			}
	}
	else
			{
				header("Location: quotationtype.php?error=Error Data");
			}
			}
	else
			{
				header("Location: quotationtype.php?error=Error Data");
			}
}
else
			{
				header("Location: quotationtype.php");
			}
?>