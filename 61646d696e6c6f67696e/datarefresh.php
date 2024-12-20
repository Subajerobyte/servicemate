<?php
include('lcheck.php');
if((file_exists("../tallyexport/dc/DC_Details.csv"))||(file_exists("../tallyexport/invoice/Invoice_Details.csv")))
{

}
else
{

//header("location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$_SESSION['companyname']?> - Jerobyte - Data Importing..</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
 html, body {
  background: #347fc3;
  width: 100%;
  overflow-x: hidden;
  overflow-y: hidden;
}

.bar {
  position: relative;
  height: 2px;
  width: 500px;
  margin: 0 auto;
  background: #fff;
  margin-top: 150px;
}

.circle {
  position: absolute;
  top: -30px;
  margin-left: -30px;
  height: 60px;
  width: 60px;
  left: 0;
  background: #fff;
  border-radius: 30%;
  -webkit-animation: move 5s infinite;
}

p {
  position: absolute;
  top: -25px;
  right: -85px;
  text-transform: uppercase;
  color: #347fc3;
  font-family: helvetica, sans-serif;
  font-weight: bold;
}

@-webkit-keyframes move {
  0% {left: 0;}
  50% {left: 100%; -webkit-transform: rotate(450deg); width: 150px; height: 150px;}
  75% {left: 100%; -webkit-transform: rotate(450deg); width: 150px; height: 150px;}
  100 {right: 100%;}
} 
  </style>
</head>

<body id="page-top">
			<div class="bar">
  <div class="circle"></div>
  <p>Loading</p>
</div>
<script>
  <?php
  if($dbloc=='1')
  {
    ?>
window.location.href="http://192.168.1.25:2909/l/uploadstfd1.php?e=<?=$_SESSION['email']?>";
    <?php
  }
  else
  {
    ?>
window.location.href="uploadstfd1.php?e=<?=$_SESSION['email']?>";
    <?php
  }
?>
</script>
</body>

</html>
