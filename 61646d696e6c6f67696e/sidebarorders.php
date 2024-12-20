<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
$itemname=array();
foreach($_POST['itemname'] as $data)
{

$itemnames[]=$data;
}
$itemname=implode(" | ",$itemnames);
	$sqlcon = "SELECT id From jrcitemorder where id='1'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{
 $sqlup = "update jrcitemorder set itemname='".$itemname."'";
			$queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				//for history update
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Item Order Changed', '{$tid}', 'jrcitemorder')");
				
				
				header("Location: sidebarorder.php?remarks=Updated Successfully");
		}
}
else
			{
			header("Location: sidebarorder.php?error=This record is Already Found!");
			}
}
else
			{
				header("Location: sidebarorder.php");
			}
?>
