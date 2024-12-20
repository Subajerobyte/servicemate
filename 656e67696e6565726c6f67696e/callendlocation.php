<?php
include('lcheck.php');
if(isset($_POST['callid']))
{
    if($_POST['lati'] && $_POST['longi'] && $_POST['callid'])
	{
    $lat = mysqli_real_escape_string($connection,$_POST['lati']);
    $long = mysqli_real_escape_string($connection,$_POST['longi']);
	$calltid = mysqli_real_escape_string($connection,$_POST['callid']);
	$startip = mysqli_real_escape_string($connection,$_POST['startip']);
	$endip=$lat.','.$long;
	$engineerid=$id;
	$user=$_SESSION['email'];
	date_default_timezone_set('Asia/Calcutta');
	$ldate=date('Y-m-d H:i:s');
	$from = $startip;
	$to = $endip;
	$from = urlencode($from);
	$to = urlencode($to);
	$data1 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&mode=driving&language=en-EN&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
	$data = json_decode($data1);
	$time = 0;
	$distance = 0;
	foreach($data->rows[0]->elements as $road) {
		$time+= $road->duration->value;
		$distance+= $road->distance->value;
	}
	$km=$distance/1000;
	$sql=mysqli_query($connection,"select * from jrcengroute where attdate='".date('Y-m-d')."' and engineerid='$engineerid'");
	if(mysqli_num_rows($sql)>0)
	{
		while($info=mysqli_fetch_array($sql))
		{
			for($i=1;$i<=7;$i++)
			{
				if($info['location'.$i]=='')
				{
					$sql1=mysqli_query($connection,"update jrcengroute set location".$i."='$endip', loccall".$i."='$calltid', loctime".$i."='$ldate', lockm".$i."='$km' where attdate='".date('Y-m-d')."' and engineerid='$engineerid'");
					break;
				}
				else
				{
					if($info['loccall'.$i]==$calltid)
					{
						break;
					}
				}
			}
		}
	}
	$sql=mysqli_query($connection,"select consigneeid from jrccalls where calltid='$calltid'");
	$info=mysqli_fetch_array($sql);
	$consigneeid=$info['consigneeid'];
	$sql1=mysqli_query($connection,"update jrcconsignee set latlong='$endip' where id='$consigneeid'");
	  $q = "INSERT INTO jrclive (user, lati, longi, ldate) VALUES ('$user', '$lat', '$long', '$ldate')";
      $query = mysqli_query($connection, $q);
	  $q = "update jrccallstravel set endip='$endip', endiptime='$ldate', kms='$km' where calltid='$calltid' and engineerid='$engineerid'";
	   $tid=$engineerid;
							mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Call End Location', '{$tid}', 'jrcengroute')");
      $query = mysqli_query($connection, $q);
      if($query)
	  {
          echo json_encode("Data Inserted Successfully");
      }
      else 
	  {
        echo json_encode('problem');
      }
   }
}
?>