<?php
include('lcheck.php');
if(isset($_POST['startip']))
{
    if($_POST['lati'] && $_POST['longi'] && $_POST['startip'] && $_POST['attdate'])
	{
    $lat = mysqli_real_escape_string($connection,$_POST['lati']);
    $long = mysqli_real_escape_string($connection,$_POST['longi']);
	$startip = mysqli_real_escape_string($connection,$_POST['startip']);
	$attdate = mysqli_real_escape_string($connection,$_POST['attdate']);
	$tickets = mysqli_real_escape_string($connection,$_POST['tickets']);
	$startingkm = (float)mysqli_real_escape_string($connection,$_POST['startingkm']);
	$endingkm = (float)mysqli_real_escape_string($connection,$_POST['endingkm']);
	$totalkm = (float)mysqli_real_escape_string($connection,$_POST['totalkm']);
	$rateperkm = (float)mysqli_real_escape_string($connection,$_POST['rateperkm']);
	$travelcost = (float)mysqli_real_escape_string($connection,$_POST['travelcost']);
	$othercost = (float)mysqli_real_escape_string($connection,$_POST['othercost']);
	$othermaterial = (float)mysqli_real_escape_string($connection,$_POST['othermaterial']);
	$couriercharges = (float)mysqli_real_escape_string($connection,$_POST['couriercharges']);
	$materialcharges = (float)mysqli_real_escape_string($connection,$_POST['materialcharges']);
	$travelexpense = (float)mysqli_real_escape_string($connection,$_POST['travelexpense']);
	$tototherexpense = (float)mysqli_real_escape_string($connection,$_POST['tototherexpense']);
	$totexpense = (float)mysqli_real_escape_string($connection,$_POST['totexpense']);
	
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
	$sql=mysqli_query($connection,"select * from jrcengroute where attdate='".$attdate."' and engineerid='$engineerid'");
	if(mysqli_num_rows($sql)>0)
	{
		while($info=mysqli_fetch_array($sql))
		{
			$sql1=mysqli_query($connection,"update jrcengroute set endlocation='$endip', endtime='$ldate', endkm='$km', tickets='$tickets',  travelexpense='$travelexpense',startingkm='$startingkm', endingkm='$endingkm', totalkm='$totalkm', rateperkm='$rateperkm', travelcost='$travelcost',othercost='$othercost',othermaterial='$othermaterial', couriercharges='$couriercharges', materialcharges='$materialcharges',tototherexpense='$tototherexpense',totexpense='$totexpense' where attdate='".$attdate."' and engineerid='$engineerid'");
		}
	}
	  $q = "INSERT INTO jrclive (user, lati, longi, ldate) VALUES ('$user', '$lat', '$long', '$ldate')";
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