<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$createdon=date('Y-m-d');
	$createdby=$email;
	$title=mysqli_real_escape_string($connection, $_POST['title']);
	$message=mysqli_real_escape_string($connection, $_POST['message']);
	$claimsubon=mysqli_real_escape_string($connection, $_POST['claimsubon']);
	$pono=mysqli_real_escape_string($connection, $_POST['pono']);
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	
	$column1=mysqli_real_escape_string($connection, $_POST['column1']);
	$column2=mysqli_real_escape_string($connection, $_POST['column2']);
	$column3=mysqli_real_escape_string($connection, $_POST['column3']);
	$column4=mysqli_real_escape_string($connection, $_POST['column4']);
	$column5=mysqli_real_escape_string($connection, $_POST['column5']);
	$column6=mysqli_real_escape_string($connection, $_POST['column6']);
	$column7=mysqli_real_escape_string($connection, $_POST['column7']);
	$column8=mysqli_real_escape_string($connection, $_POST['column8']);
	$column9=mysqli_real_escape_string($connection, $_POST['column9']);
	$column10=mysqli_real_escape_string($connection, $_POST['column10']);
	$column11=mysqli_real_escape_string($connection, $_POST['column11']);
	$column12=mysqli_real_escape_string($connection, $_POST['column12']);
	
	
	$value1=mysqli_real_escape_string($connection, $_POST['value1']);
	$value2=mysqli_real_escape_string($connection, $_POST['value2']);
	$value3=mysqli_real_escape_string($connection, $_POST['value3']);
	$value4=mysqli_real_escape_string($connection, $_POST['value4']);
	$value5=mysqli_real_escape_string($connection, $_POST['value5']);
	$value6=mysqli_real_escape_string($connection, $_POST['value6']);
	$value7=mysqli_real_escape_string($connection, $_POST['value7']);
	$value8=mysqli_real_escape_string($connection, $_POST['value8']);
	$value9=mysqli_real_escape_string($connection, $_POST['value9']);
	$value10=mysqli_real_escape_string($connection, $_POST['value10']);
	$value11=mysqli_real_escape_string($connection, $_POST['value11']);
	$value12=mysqli_real_escape_string($connection, $_POST['value12']);
	
	
		$msg = "";
  $msg_class = "";
	if(($title!=""))
	{		
		 
     echo   $sqlcon = "SELECT id From jrcinvoicesubmission where claimsubon='".$claimsubon."' and pono='".$pono."'  group by pono";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			 $sqlup = "update jrcinvoicesubmission set title='$title',message='$message',column1='$column1',column2='$column2',column3='$column3',column4='$column4',column5='$column5',column6='$column6',column7='$column7',column8='$column8',column9='$column9',column10='$column10',column11='$column11',column12='$column12',value1='$value1',value2='$value2',value3='$value3',value4='$value4',value5='$value5',value6='$value6',value7='$value7',value8='$value8',value9='$value9',value10='$value10',value11='$value11',value12='$value12' where id='".$id."'";
			
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid,tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated A Invoice Submission', '{$tid}',jrcinvoicesubmission)");
				header("Location: invoicesubmission.php?remarks=Updated Successfully");
			} 
	    }
		else if($rowCountcon==0) 
			{
				$sqlup = "INSERT INTO jrcinvoicesubmission( createdby,createdon,title,message,claimsubon,pono,column1,column2,column3,column4,column5,column6,column7,column8,column9,column10,column11,column12,value1,value2,value3,value4,value5,value6,value7,value8,value9,value10,value11,value12) VALUES ( '$createdby','$createdon','$title','$message','$claimsubon','$pono','$column1','$column2','$column3','$column4','$column5','$column6','$column7','$column8','$column9','$column10','$column11','$column12','$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8','$value9','$value10','$value11','$value12')";
				$queryup = mysqli_query($connection, $sqlup);
				 $sqlup1 = "update jrcxl set title='$title' where pono='".$pono."' and claimsubon='".$claimsubon."'";
			  $queryup1 = mysqli_query($connection, $sqlup1);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid,tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Invoice Submission', '{$id}',jrcinvoicesubmission)");
				header("Location: invoicesubmission.php?remarks=Updated Successfully");
			}
			}
	}
	else
			{
				header("Location: invoicesubmission.php?error=Error Data");
			}
}
else
			{
				header("Location: invoicesubmission.php");
			}






?>