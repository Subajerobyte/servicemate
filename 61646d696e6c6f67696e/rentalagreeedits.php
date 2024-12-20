
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
	$subject=mysqli_real_escape_string($connection, $_POST['subject']);
	$contentmessage=mysqli_real_escape_string($connection, $_POST['contentmessage']);
	$documenttypevalue=mysqli_real_escape_string($connection, $_POST['documenttype']);
	$terms=mysqli_real_escape_string($connection, $_POST['terms']);
	$aterms=mysqli_real_escape_string($connection, $_POST['aterms']);
	$stockitem=mysqli_real_escape_string($connection, implode(',',$_POST['stockitem']));
		$msg = "";
  $msg_class = "";


	if(isset($documenttypevalue))
	{		
		 
        $sqlcon = "SELECT id From jrcrentalagree WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
	
			 
			$sqlup = "update jrcrentalagree set subject='$subject', contentmessage='$contentmessage', documenttype='$documenttypevalue', terms='$terms', aterms='$aterms', stockitem='$stockitem' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated {$documenttypevalue} Information', '{$id}', 'jrcrentalagree')");
				header("Location: rentalagreeedit.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: rentalagreeedit.php?error=This record is Not Found! Kindly check in All List");
			}
	}
	else
			{
				header("Location: rentalagreeedit.php?error=Error Data");
			}
			}
	else
			{
				header("Location: rentalagreeedit.php?error=Error Data1");
			}
}
else
			{
				header("Location: rentalagreeedit.php");
			}
?>