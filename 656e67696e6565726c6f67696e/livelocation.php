<?php
include('lcheck.php');
if(isset($_POST['user']))
{
    if($_POST['lati'] && $_POST['longi']){
      $lat = mysqli_real_escape_string($connection,$_POST['lati']);
      $long = mysqli_real_escape_string($connection,$_POST['longi']);
	  $_SESSION['mylat']=$lat;
	  $_SESSION['mylong']=$long;
	  
	  $user=$_SESSION['email'];
	  date_default_timezone_set('Asia/Calcutta');
$ldate=date('Y-m-d H:i:s');

      $q = "INSERT INTO jrclive (user, lati, longi, ldate) VALUES ('$user', '$lat', '$long', '$ldate')";
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