<?php
include('lcheck.php');
if($addconsignee=='0')
{
	header("Location: dashboard.php");
}
	
		
			if(isset($_POST['creportedproblem'])) 
		{
		$data = array();

	$reportedproblem=mysqli_real_escape_string($connection, $_POST['creportedproblem']);

		}
		else
		{
			$data = array();
	
	$reportedproblem=mysqli_real_escape_string($connection, $_POST['creportedproblem']);
	
		}

	if(($reportedproblem!=""))
	{		
		 
     echo   $sqlcon = "SELECT id From jrcreportedproblem  WHERE reportedproblem = '{$reportedproblem}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcreportedproblem(reportedproblem) VALUES ( '$reportedproblem')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert a Report Problem Detail', '{$id}', 'jrcreportedproblem')");
				 
			
				
					 $data[] = array( "reportedproblem"=>$reportedproblem);
				
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