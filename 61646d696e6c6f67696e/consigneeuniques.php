<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['changetext']))
	{
	$changetext=mysqli_real_escape_string($connection, $_POST['changetext']);
	$searchfield=mysqli_real_escape_string($connection, $_POST['searchfield']);
	if((isset($_POST['finds']))&&is_array($_POST['finds']))
	{
		for($i=0;$i<count($_POST['finds']);$i++)
		{		
			$finds=mysqli_real_escape_string($connection, $_POST['finds'][$i]);
			//$finds=str_replace("\\r\\n","",$finds);
			//$finds = trim(preg_replace('/\s+/', ' ', $finds));
			$sqlup1 = 'update jrcxl set '.$searchfield.'="'.$changetext.'" where '.$searchfield.'="'.$finds.'"';
			echo $sqlup1.'<br>';
			$queryup1 = mysqli_query($connection, $sqlup1);
			 
			if(!$queryup1){
			   die("SQL query failed: " . mysqli_error($connection));
			} 
			 $sqlt="SELECT table_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '$dbname' AND column_name = '$searchfield' and table_name='jrcconsignee'";
			$queryupt = mysqli_query($connection, $sqlt);
			if(mysqli_num_rows($queryupt)>0)
			{
				$sqlup1 = 'update jrcconsignee set '.$searchfield.'="'.$changetext.'" where '.$searchfield.'="'.$finds.'"';
				$queryup1 = mysqli_query($connection, $sqlup1);
				 
				if(!$queryup1){
					die("SQL query failed: " . mysqli_error($connection));
				} 
			 } 
	    }
	}
}
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Merge A Customer Record', '{$finds}', 'jrcconsignee')");
header("Location: consigneeunique.php?".$_POST['qs']."&remarks=Updated Successfully");
			}
	else
			{
				header("Location: consigneeunique.php?error=Error Data");
			}
?>