<?php
include('lcheck.php');
$sqlis=mysqli_query($connection, "select id, calltid, changeon, compstatus from jrccallshistory where compstatus='1' and (modifiedon='' or modifiedon is null)  order by id asc");
while($info=mysqli_fetch_array($sqlis))
{
$var = $info['changeon'];
$date = str_replace('/', '-', $var);
$changedate=date('Y-m-d H:i:s', strtotime($date));
	echo '<br>'.$info['calltid'].'-'.$info['changeon'].'-'.$changedate;
	
	$sqlis1=mysqli_query($connection, "select id, calltid, changeon, compstatus, pendingon1, pendingon2, pendingon3 from jrccalls where calltid='".$info['calltid']."' order by id asc");
	while($info1=mysqli_fetch_array($sqlis1))
	{
		$id=$info1['id'];
		$pendingon1=$info1['pendingon1'];
		$pendingon2=$info1['pendingon2'];
		$pendingon3=$info1['pendingon3'];

		if(($pendingon1=='')||($pendingon1 === NULL))
		{
			mysqli_query($connection,"update jrccalls set pendingon1='$changedate' where id='$id'");	
		}
		else
		{
			if(($pendingon2=='')||($pendingon2 === NULL))
			{
				mysqli_query($connection,"update jrccalls set pendingon2='$changedate' where id='$id'");	
			}
			else
			{
				if(($pendingon3=='')||($pendingon3 === NULL))
				{
					mysqli_query($connection,"update jrccalls set pendingon3='$changedate' where id='$id'");	
				}
			}
		}
	}
	
	
}
?>