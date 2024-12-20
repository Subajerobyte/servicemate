<?php
include('lcheck.php');
if(isset($_POST['callid']))
{
    if($_POST['lati'] && $_POST['longi'] && $_POST['callid']){
      $lat = mysqli_real_escape_string($connection,$_POST['lati']);
      $long = mysqli_real_escape_string($connection,$_POST['longi']);
	  $calltid = mysqli_real_escape_string($connection,$_POST['callid']);
	  $startip=$lat.','.$long;
	  $user=$_SESSION['email'];
	  $engineerid=$id;
	  date_default_timezone_set('Asia/Calcutta');
	  $ldate=date('Y-m-d H:i:s');
	  
	  $sql2=mysqli_query($connection,"select id from jrcengroute where attdate='".date('Y-m-d')."' and engineerid='$engineerid' and (endlocation is not null and endlocation!='')");
	  if(mysqli_num_rows($sql2)>0)
	  {
		  $attdate=date('Y-m-d',strtotime("tomorrow"));
		  
		  $sql=mysqli_query($connection,"select id from jrcengroute where attdate='".$attdate."' and engineerid='$engineerid'");
		  if(mysqli_num_rows($sql)==0)
		  {
			$sql1=mysqli_query($connection,"insert into jrcengroute set attdate='".$attdate."', engineerid='$engineerid', startlocation='$startip', starttime='$ldate'");
		  }
	  }
	  else
	  {
	  $sql=mysqli_query($connection,"select id from jrcengroute where attdate='".date('Y-m-d')."' and engineerid='$engineerid'");
	  if(mysqli_num_rows($sql)==0)
	  {
		$sql1=mysqli_query($connection,"insert into jrcengroute set attdate='".date('Y-m-d')."', engineerid='$engineerid', startlocation='$startip', starttime='$ldate'");
	  }
	  }
	  $q = "INSERT INTO jrclive (user, lati, longi, ldate) VALUES ('$user', '$lat', '$long', '$ldate')";
      $query = mysqli_query($connection, $q);
	  $q = "update jrccallstravel set startip='$startip', startiptime='$ldate' where calltid='$calltid' and engineerid='$engineerid'";
	  $tid=$engineerid;
							mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Call Start Location', '{$tid}', 'jrcengroute')");
				
      $query = mysqli_query($connection, $q);
      if($query)
	  {
          echo json_encode("Data Inserted Successfully");
      }
      else {
          echo json_encode('problem');
         }
      }
}
?>