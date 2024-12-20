<?php
include('lcheck.php');
if(($livelocation=='0')&&($engineerperformance=='0'))
{
	header("location: dashboard.php");
}
if((isset($_GET['attdate']))&&(isset($_GET['engid'])))
{
$attdate=mysqli_real_escape_string($connection,$_GET['attdate']);
$eid=mysqli_real_escape_string($connection,$_GET['engid']);
$sqlselect = "SELECT * From jrcengineer where enabled='0' and id='".$eid."' order by username asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect)
{
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0) 
{
$count=1;
while($rowselect = mysqli_fetch_array($queryselect)) 
{
	$sqlmap = "SELECT * From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$attdate."%' order by attdate desc";
				  
        $querymap = mysqli_query($connection, $sqlmap);
        $rowCountmap = mysqli_num_rows($querymap);
         
        if(!$querymap){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountmap > 0) 
		{
			$infomap=mysqli_fetch_array($querymap);	
			if(($infomap['startlocation']!='')&&($infomap['location1']==''))
			{
				$startip=$infomap['startlocation'];
				$startiptime=$infomap['starttime'];
				$sqlcall= "SELECT * From jrccalls where engineerid='".$rowselect['id']."' and startip='".$startip."' and startiptime='".$startiptime."'";
				$querycall = mysqli_query($connection, $sqlcall);
				if(mysqli_num_rows($querycall)>0)
				{
					$sqlupdate= "update jrccalls set startip='', startiptime='' where engineerid='".$rowselect['id']."' and startip='".$startip."' and startiptime='".$startiptime."'";
					$queryupdate = mysqli_query($connection, $sqlupdate);
					if($queryupdate)
					{
						$sqlengineer = "delete From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$attdate."%'";
						$queryengineer = mysqli_query($connection, $sqlengineer);
						
						header("Location: mapengineerview.php?id=".$eid."&attdate=".$attdate."&remarks=Attendance Made as Absent");
					}
					else
					{
						header("Location: mapengineerview.php?id=".$eid."&attdate=".$attdate."&error=".mysqli_error($connection));
					}
				}
else
{
	header("Location: mapengineerview.php?id=".$eid."&attdate=".$attdate."&error=No Call is Found");
}	
			}
			else
			{
				header("Location: mapengineerview.php?id=".$eid."&attdate=".$attdate."&error=Attendance is Already Processed");
			}
			
		}
		else
		{
			header("Location: mapengineerview.php?id=".$eid."&attdate=".$attdate."&error=Attendance Not Taken");
		}
}
}
else
{
	header("Location: mapengineerview.php?id=".$eid."&attdate=".$attdate."&error=Engineer Record Not Found");
}
}
else
{
	header("Location: dashboard.php");
}