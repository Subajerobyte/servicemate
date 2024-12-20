<?php
include('lcheck.php');
if (isset($_GET['id'])) {
$id=mysqli_real_escape_string($connection, $_GET['id']);
$val=mysqli_real_escape_string($connection, $_GET['val']);
$t=mysqli_real_escape_string($connection, $_GET['t']);
if(($id!="")&&($val!="")&&($t!=""))
	{		
		$table='';
		if($t=='a')
		{
			$table='adminuser';
			$role='Administrator';
			$tab='jrcadminuser';
		}
		if($t=='e')
		{
			$table='engineer';
			$role='Engineer';
			$tab='jrcengineer';
		}
		if($t=='s')
		{
			$table='salesrep';
			$role='Sales Representative';
			$tab='jrcsalesrep';
		}
		if($table!='')
		{
			if(($val=='0')&&(((float)$empcur+1)>(float)$slotmax))
			{
				header("Location: users.php?error=Sorry! Already You enabled Maximum Users for this Package, Please contact support team for change your Package to New Package");
			}
			else
			{	
		 
        $sqlcon = "SELECT id, username, enabled From jrc".$table." WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			$infouser=mysqli_fetch_array($querycon);
			if($infouser['enabled']!=$val)
			{
			$username=$infouser['username'];
			
			 
			$sqlup = "update jrc".$table." set enabled='$val' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{				
				$sqlselect = "SELECT count(id) as coun From jrcadminuser where enabled='0' order by username asc";
				$queryselect = mysqli_query($connection, $sqlselect);
				$ins=mysqli_fetch_array($queryselect);
				$sqlselect1 = "SELECT count(id) as coun1 From jrcengineer where enabled='0' order by username asc";
				$queryselect1 = mysqli_query($connection, $sqlselect1);
				$ins1=mysqli_fetch_array($queryselect1);
				$sqlselect2 = "SELECT count(id) as coun2 From jrcsalesrep where enabled='0' order by username asc";
				$queryselect2 = mysqli_query($connection, $sqlselect2);
				$ins2=mysqli_fetch_array($queryselect2);
				$available=(float)$ins['coun']+(float)$ins1['coun1']+(float)$ins2['coun2'];	

				if($val=='0')
				{
					$status='Enabled';
				}
				else
				{
					$status='Disabled';
				}
				$ser=mysqli_query($connection1, "insert into jrcuserstatus set companyid='{$companyid}', username='{$username}', status='{$status}', statuson='{$times}'");

				$ser=mysqli_query($connection1, "update jrccompany set empcur='{$available}' where id='{$companyid}'");

				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed {$role} Status', '{$id}', '{$tab}')");
				header("Location: users.php?remarks=Updated Successfully");
				}
			}
			else
			{
				header("Location: users.php?error=Warning");
			}
	    }
		else
		{
			header("Location: users.php?error=This record is Not Found! Kindly check in All {$role} List");
		}
	}
	}
	else
	{
		header("Location: users.php?error=Warning");
	}
	}
	else
	{
		header("Location: users.php?error=Error Data");
	}
}
?>