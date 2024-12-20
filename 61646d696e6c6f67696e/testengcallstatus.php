<?php
include('lcheck.php');
if(isset($_GET['start']))
{
	$start=$_GET['start'];
}	
else
{
	$start=0;
}
if(isset($_GET['limit']))
{
	$limit=$_GET['limit'];
}	
else
{
	$limit=100;
}
$sqli=mysqli_query($connection, "select id, engineerid, detailsid1, detailsid2, detailsid3, detailsid4, detailsid5, detailsid6, detailsid7 from jrcengroute order by id asc limit $start, $limit");
while($info=mysqli_fetch_array($sqli))
{
	for($i=1;$i<=7;$i++)
	{
		if($info['detailsid'.$i]!='')
		{
			$sqlit1=mysqli_query($connection, "select calltid, callstatus from jrccalldetails where id='".$info['detailsid'.$i]."'");
			$infot1=mysqli_fetch_array($sqlit1);
			if($infot1['callstatus']!='')
			{
				$sqlit3=mysqli_query($connection, "select calltype from jrccalls where calltid='".$infot1['calltid']."'");
				$infot3=mysqli_fetch_array($sqlit3);
				$sqlit2=mysqli_query($connection, "update jrcengroute set callstatus".$i."='".$infot1['callstatus']."', calltype".$i."='".$infot3['calltype']."' where id='".$info['id']."'");
				echo $info['id'].'-'.$info['engineerid'].'-'.$i.'-'.$infot1['callstatus'].'-'.$infot3['calltype'].'<br>';
			}
		}
	}
}
echo 'Done';
?>