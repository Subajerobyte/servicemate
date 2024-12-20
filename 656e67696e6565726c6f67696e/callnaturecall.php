<?php
include('lcheck.php');
if($addconsignee=='0')
{
	header("Location: dashboard.php");
}
	
		
			if(isset($_POST['ccalltype'])) 
		{
		$data = array();

	$calltype=mysqli_real_escape_string($connection, $_POST['ccalltype']);
	$callnature=mysqli_real_escape_string($connection, $_POST['ccallnature']);
	
		}
		else
		{
			$data = array();
	
	$calltype=mysqli_real_escape_string($connection, $_POST['ccalltype']);
	$callnature=mysqli_real_escape_string($connection, $_POST['ccallnature']);
	
		}
		
		
		
	if(($calltype!="")&&($callnature!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrccallnature WHERE callnature= '{$callnature}' and calltype= '{$calltype}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrccallnature( callnature, calltype) VALUES ( '$callnature', '$calltype')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Details', '{$id}', 'jrcconsignee')");
				 
			
				
					 $data[] = array( "calltype"=>$calltype, "callnature" => $callnature);
				
			} 
	    }
		else
			{
				//header("Location: consignee.php?error=This record is Not Found! Kindly check in All Customer List");
			}
	}
	else
			{
				//header("Location: consignee.php?error=Error Data");
			}
			echo json_encode($data);

			

?>