<?php
include('lcheck.php'); 
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$quotationtypevalue=mysqli_real_escape_string($connection, $_POST['quotationtype']);
	$terms=mysqli_real_escape_string($connection, $_POST['terms']);
	$stockitem=mysqli_real_escape_string($connection, implode(',',$_POST['stockitem']));
		$msg = "";
  $msg_class = "";
  
	if(($quotationtypevalue!="")&&($quotationtypevalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcquotationtype WHERE quotationtype = '{$quotationtypevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcquotationtype(quotationtype, terms, stockitem) VALUES ('$quotationtypevalue', '$terms', '$stockitem')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Quotation Type', '{$tid}', 'jrcquotationtype')");
				header("Location: quotationtype.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: quotationtype.php?error=This record is Already Found! Kindly check in All Quotation Type List");
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