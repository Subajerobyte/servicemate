 <?php
include('lcheck.php');
if((isset($_POST['submit'])) || (isset($_POST['submit1'])))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$remindervalue=mysqli_real_escape_string($connection, $_POST['reminder']);
	$status=mysqli_real_escape_string($connection, $_POST['status']);
	$enddate=mysqli_real_escape_string($connection, $_POST['enddate']);
	$reminderstatus=mysqli_real_escape_string($connection, $_POST['reminderstatus']);
	$msg = "";
  $msg_class = "";

	if(($remindervalue!=""))
	{		
		 
        $sqlcon = "SELECT id,sourceid From jrcreminder WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
							$rowcon = mysqli_fetch_array($querycon);
						
			 
						$sqlxl = "SELECT id, consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem,serialnumber From jrcxl where id='".$rowcon['sourceid']."' order by consigneeid asc";
						
						$queryxl = mysqli_query($connection, $sqlxl);
						$rowCountxl = mysqli_num_rows($queryxl);
						$rowxl = mysqli_fetch_array($queryxl);
						


			$sqlup = "update jrcreminder set reminder='$remindervalue', status='$status', enddate='$enddate', reminderstatus='$reminderstatus' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				if($reminderstatus=='Denied')
				{
					$sqlup1 = "update jrcreminder set enabled='2' where id='$id'";
					$queryup1 = mysqli_query($connection, $sqlup1);
				}
				
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Reminder Information', '{$id}', 'jrcreminder')");
				if(isset($_POST['submit1'])){
				header("Location: amcquotationgen.php?id={$rowxl['consigneeid']}&xlid={$rowxl['id']}&ts=amcexpire&ts1={$id}&remarks=Updated Successfully");
				}else{
					header("Location: reminder.php?remarks=Updated Successfully");
				
				}
			} 
	    }
		else
			{
				header("Location: reminder.php?error=This record is Not Found! Kindly check in All Reminder List");
			}
	}
	else
			{
				header("Location: reminder.php?error=Error Data");
			}
			}
	else
			{
				header("Location: reminder.php?error=Error Data");
			}
}
else
			{
				header("Location: reminder.php");
			}
?>