<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['sono']))
	{
	$sono=mysqli_real_escape_string($connection, $_POST['sono']);
	$count=mysqli_real_escape_string($connection, $_POST['count']);
	for($i=0;$i<$_POST['count'];$i++)
	{
	$id=mysqli_real_escape_string($connection, $_POST['id'][$i]);
	$conserialno=mysqli_real_escape_string($connection, $_POST['conserialno'][$i]);
	$condepartmentname=mysqli_real_escape_string($connection, $_POST['condepartmentname'][$i]);
	$sqls2=mysqli_query($connection,"update jrctally set conserialno='".$conserialno."',condepartmentname='".$condepartmentname."' where id='".$id."'");	

	}
	if($sqls2)
{
	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Update Serial Number', '{$id}', 'jrctally')");
header("Location:exporttally.php?remarks=Updated Successfully");

}
			}
	else
			{
				header("Location: exporttally.php?error=Error Data");
			}
}
if(isset($_POST['submitic']))
{

	if(isset($_POST['sono']))
	{
	$sono=mysqli_real_escape_string($connection, $_POST['sono']);
	$installedon=mysqli_real_escape_string($connection, $_POST['installedon']);
	$idcount=mysqli_real_escape_string($connection, $_POST['idcount']);
	/* $sqls2=mysqli_query($connection,"update jrcxl set installedon='".$installedon."' where sono='".$sono."'"); */
	for($i=0;$i<$_POST['idcount'];$i++)
	{
		$id=mysqli_real_escape_string($connection, $_POST['id'][$i]);
		$warranty=mysqli_real_escape_string($connection, $_POST['warranty'][$i]);
		$off=(float)$warranty;
		$overdate = str_replace('/', '-', $installedon);
		$overdate=date('Y-m-d', strtotime($overdate));
		$warrantydate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
		$stockmaincategory=mysqli_real_escape_string($connection, $_POST['stockmaincategory'][$i]);
		$stocksubcategory=mysqli_real_escape_string($connection, $_POST['stocksubcategory'][$i]);
		$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
		$componenttype=mysqli_real_escape_string($connection, $_POST['componenttype'][$i]);
		$componentname=mysqli_real_escape_string($connection, $_POST['componentname'][$i]);
		$typeofproduct=mysqli_real_escape_string($connection, $_POST['typeofproduct'][$i]);
		$make=mysqli_real_escape_string($connection, $_POST['make'][$i]);
		$capacity=mysqli_real_escape_string($connection, $_POST['capacity'][$i]);
		$productid=mysqli_real_escape_string($connection, $_POST['productid'][$i]);

	echo $sqlconpro = "SELECT id,warrantycycle,productlifetime From jrcproduct WHERE id='{$productid}' ";
					$queryconpro = mysqli_query($connection, $sqlconpro);
					$rowCountconpro = mysqli_num_rows($queryconpro);
					 
					if(!$queryconpro){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					 
					if($rowCountconpro > 0) 
					{	
						 
						
						$rowcopro = mysqli_fetch_array($queryconpro);
						if($rowcopro['productlifetime']!='' && $rowcopro['productlifetime']!='NULL')
						{
						$off1=(float)$rowcopro['productlifetime'];
						$overdate1 = str_replace('/', '-', $overdate);
						$overdate1=date('Y-m-d', strtotime($overdate1));
						$lifetimedate = date('Y-m-d', strtotime("+$off1 years", strtotime($overdate1)));
						$productlifetime=$rowcopro['productlifetime'];	
						}
						else
						{
							$lifetimedate='';
							$productlifetime='';
						}
						
						
						$productid=$rowcopro['id'];	
						$warrantycycle=$rowcopro['warrantycycle'];	
						$sqlup1pro = "update jrcxl set productid='{$productid}',warrantydate='{$warrantydate}',productlifetime='{$productlifetime}' ,lifetimedate='{$lifetimedate}',installedon='{$installedon}'  WHERE sono='{$sono}' ";
						$queryup1pro = mysqli_query($connection, $sqlup1pro);
					}
	

	}
	if($queryup1pro)
{
	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Update Installation Date', '{$id}', 'jrcxl')");
	mysqli_query($connection,"update jrctally set installedon='".$installedon."' where sono='".$sono."'");
    header("Location:exporttally.php?remarks=Updated Successfully");

}
			}
	else
			{
				header("Location: exporttally.php?error=Error Data");
			}
}
?>