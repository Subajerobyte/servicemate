<?php
include('lcheck.php');
if($addconsignee=='0')
{
	header("Location: dashboard.php");
}
	
		
			if(isset($_POST['aactiontaken'])) 
		{
		$data = array();

	$actiontaken=mysqli_real_escape_string($connection, $_POST['aactiontaken']);
	
		}
		else
		{
			$data = array();
	
	$actiontaken=mysqli_real_escape_string($connection, $_POST['aactiontaken']);
	
		}
		
		
		
	if(($actiontaken!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcactiontaken WHERE actiontaken= '{$actiontaken}' ";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcactiontaken(actiontaken) VALUES ( '$actiontaken')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Details', '{$id}', 'jrcactiontaken')");
				 
			
				
					 $data[] = array( "actiontaken"=>$actiontaken);
				
			} 
	    }
		else
			{
				//header("Location: complaint.php?error=This record is Not Found! Kindly check in All Customer List");
			}
	}
	else
			{
				//header("Location: complaint.php?error=Error Data");
			}
			echo json_encode($data);

			

?>