<?php
include('lcheck.php');
$sqlselect = "SELECT id, consigneeid, productid, serialnumber, departments, qty From jrcxl order by id asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
    die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountselect > 0) 
{
	$count=1;
	while($rowselect = mysqli_fetch_array($queryselect)) 
	{
		$sourceid=$rowselect['id'];
		$consigneeid=$rowselect['consigneeid'];
		$productid=$rowselect['productid'];
		$serialnumber=$rowselect['serialnumber'];
		$departments=$rowselect['departments'];
		$qty=$rowselect['qty'];
		echo $sourceid.'-'.$consigneeid.'-'.$productid.'<br>';
			$sstatus=0;
			$serials=explode("| ",$serialnumber);
			$departs=explode("| ",$departments);
			 
			$sqlcon = "delete From jrcserials WHERE sourceid = '{$sourceid}' and consigneeid = '{$consigneeid}' and productid = '{$productid}'";
			$querycon = mysqli_query($connection, $sqlcon);
			 
			if(!$querycon){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{	
				for($sr=0;$sr<$qty;$sr++)
				{
					$serialqty=$sr+1;	//////
					$serial="";
					$depart="";
					if(isset($serials[$sr]))
					{		
						$serial=$serials[$sr];	
						$serial=str_replace("\\r","",$serial);
						$serial=str_replace("\\n","",$serial);
					}
					if(isset($departs[$sr]))
					{
						$depart=$departs[$sr];	
						$depart=str_replace("\\r","",$depart);
						$depart=str_replace("\\n","",$depart);
					}
					 
					$sqlup = "INSERT INTO jrcserials(sourceid, consigneeid, productid, serialnumber, serialqty, sstatus) VALUES ( '$sourceid', '$consigneeid', '$productid', '$serial', '$serialqty', '$sstatus')";
					$queryup = mysqli_query($connection, $sqlup);
					 
					if(!$queryup){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					else
					{
						
					}
				}
			}
	}
}
?>
		