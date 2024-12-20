<?php
include('lcheck.php');
 if(isset($_GET['id']))
 {
	$id=mysqli_real_escape_string($connection,$_GET['id']);
		$sqlselect = "SELECT id, calltid From jrccalls where (engineerid='".$engineerid."' or find_in_set('".$engineerid."', engineersid)) and id='".$id."' order by id desc";
				 
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$rowselect=mysqli_fetch_array($queryselect);
			$sqlse=mysqli_query($connection, "update jrccalls set acknowlodge='1' where id='".$rowselect['id']."' order by id desc");
			$sqlse=mysqli_query($connection, "update jrccallstravel set acknowlodge='1' where engineerid='".$engineerid."' and calltid='".$rowselect['calltid']."' order by id desc");
			$tid=$rowselect['id'];
							mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Call Acknowledge', '{$tid}', 'jrccalls')");
				
			if($sqlse)
			{
				header("Location: calls.php?status=".$_GET['status']."&remarks=Acknowledged");
			}
			else
			{
				header("Location: calls.php?status=".$_GET['status']."&error=".(mysqli_error($connection))."");
			}
		}
		else
		{
			header("Location: calls.php?status=".$_GET['status']."&error=No Data");
		}	
 }
 else
 {
	 header("Location: calls.php?remarks=No Data");
 }
?>