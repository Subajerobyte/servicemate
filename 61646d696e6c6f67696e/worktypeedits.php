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
	$worktypevalue=mysqli_real_escape_string($connection, $_POST['worktype']);
	$workcategory=mysqli_real_escape_string($connection, $_POST['workcategory']);
		$msg = "";
  $msg_class = "";

	if(($worktypevalue!="")||($workcategory!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcworktype WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcworktype set worktype='$worktypevalue', workcategory='$workcategory' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				
				
				for($i=0;$i<count($_POST['stockitem']);$i++)
				{
					$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
					$point=mysqli_real_escape_string($connection, $_POST['point'][$i]);
					$mult=mysqli_real_escape_string($connection, (isset($_POST['mult'.($i+1)]))?$_POST['mult'.($i+1)]:'0');
					if(($stockitem!="")&&($point!=""))
					{
						$sqli=mysqli_query($connection, "select point from jrcworkpoints where stockitem='$stockitem' and workcategory='$workcategory' and worktype='$worktypevalue'");
					
						if(mysqli_num_rows($sqli)>0)
						{
							$sqli2=mysqli_query($connection,"update jrcworkpoints set point='$point', mult='$mult' where stockitem='$stockitem' and workcategory='$workcategory' and worktype='$worktypevalue'");							
						}
						else
						{
							$sqli2=mysqli_query($connection,"insert jrcworkpoints set point='$point', mult='$mult', stockitem='$stockitem', workcategory='$workcategory', worktype='$worktypevalue'");
						}
						
					}
					
				}
				
				
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid ,tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Work Type Information', '{$id}', 'jrcworktype')");
				header("Location: worktype.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: worktype.php?error=This record is Not Found! Kindly check in All Work Type List");
			}
	}
	else
			{
				header("Location: worktype.php?error=Error Data");
			}
			}
	else
			{
				header("Location: worktype.php?error=Error Data");
			}
}
else
			{
				header("Location: worktype.php");
			}
?>