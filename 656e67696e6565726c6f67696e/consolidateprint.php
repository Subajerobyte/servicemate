<?php 
include('lcheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?=$_SESSION['companyname']?> - Consolidate Report - <?=$_GET['id']?></title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
<style>
body
{
	font-family: Arial,sans-serif; 
}
.heading
{
	font-family: Arial Black,Arial,Gadget,sans-serif; 
}
table
{
	width:100%;
	margin-bottom:3px;
}
td, th
{
	vertical-align:middle;
	padding:0px 6px;
}
p
{
	margin-bottom: 0rem;
}
td.rotate {
  -ms-transform: rotate(-90deg); /* IE 9 */
  transform: rotate(-90deg);
  width:71px;
  height:71px;
}
@media print {
  .footer21 {page-break-after: always;}
}
</style>
</head>
<body onLoad="window.print();">
<?php
$times1=mysqli_real_escape_string($connection, $_GET['times']);
$sqlselect = "SELECT * From jrccalls where times='$times1' order by id desc LIMIT 1";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
while($rowselect = mysqli_fetch_array($queryselect))
{
$sqlxl = "SELECT * From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
$queryxl = mysqli_query($connection, $sqlxl);
$rowCountxl = mysqli_num_rows($queryxl);
if(!$queryxl){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountxl > 0)
{
$rowxl = mysqli_fetch_array($queryxl);
$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$querycons = mysqli_query($connection, $sqlcons);
$rowCountcons = mysqli_num_rows($querycons);
if(!$querycons){
die("SQL query failed: " . mysqli_error($connection));
}
$rowcons = mysqli_fetch_array($querycons);
}
}
}
?>
  <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					   <td align="center" width="90%" rowspan="2" class="heading" style="font-size:24px;"><strong>CONSOLIDATED REPORT</strong></td>
					  <td align="left"><strong>DATE :</strong></td>
					  </tr>
					  </table>
					   <table border="1" style="border:1px solid #bbbbbb">
					  <tr>
					 <td rowspan="2" width="50%"> <b>Company Details</b><br><?=$_SESSION['companyname']?><br><?=$_SESSION['companyaddress1']?> <?=$_SESSION['companyaddress2']?> <?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?> - <?=$_SESSION['companypincode']?><br> Mobile - <?=$_SESSION['companymobile']?></td> 
					 <td rowspan="2" width="50%"> <b>Customer Details</b><br><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> - <?=$rowcons['pincode']?><br> Mobile - <?=$rowcons['phone']?>, <?=$rowcons['mobile']?></td>
					  </tr>
					  </table>
					  <table border="1" style="border:1px solid #bbbbbb">
						  <tr>
						  <th style="text-align:center; padding:10px;">S.NO</th>
						  <th style="text-align:center">Department</th>
						  <th style="text-align:center">Ups Capacity</th>
						  <th style="text-align:center">Ups S.No</th>
						  <th style="text-align:center">Qty</th>
						  <th style="text-align:center">Battery capacity</th>
						  <th style="text-align:center">Qty</th>
						  <th style="text-align:center">Maintenance DT</th>
						  <th style="text-align:center">Remarks</th>
						  </tr>
                          <?php
					    $sqlrep = "SELECT * From jrccalls where times='$times1' order by id asc";
						$queryrep = mysqli_query($connection, $sqlrep);
						$rowCountrep = mysqli_num_rows($queryrep);
						if(!$queryrep){
						die("SQL query failed: " . mysqli_error($connection));
						}
						if($rowCountrep > 0)
						{
						$count=1;
						$noofbattery=0;
						while($rowrep = mysqli_fetch_array($queryrep))
						{
					    $sqlxl1 = "SELECT capacity, department From jrcxl where tdelete='0' and  id='".$rowrep['sourceid']."' order by id asc";
						$queryxl1 = mysqli_query($connection, $sqlxl1);
						$rowCountxl = mysqli_num_rows($queryxl1);
						$rowxl1 = mysqli_fetch_array($queryxl1);
					    $sql = "SELECT id,batteryah,noofbattery,engineerreport,addedon,custsignature,applisign From jrccalldetails where calltid = '{$rowrep['calltid']}' order by id asc";
						$query= mysqli_query($connection, $sql);
						$rowCount = mysqli_num_rows($query);
						$row = mysqli_fetch_array($query);
						$noofbattery +=$row['noofbattery'];
						?>
						<tr>
						<td data-label="S.No"><?=$count?></td>
						<td data-label="Department"><?=$rowxl1['department']?></td>
						<td data-label="ups capacity"><?=$rowxl1['capacity']?></td>
						<td data-label="Ups S.No"><?=$rowrep['serial']?></td>
						<td data-label="Qty">1</td>
						<td data-label="Battery capacity"><?php if($rowCount>0){ echo $row['batteryah']; }?></td>
						<td data-label="Qty"><?php if($rowCount>0){ echo $row['noofbattery']; }?></td>
						<td data-label="Maintenance DT"><?php if($rowCount>0){ echo $row['addedon']; }?></td>
						<td data-label="Remarks"><?php if($rowCount>0){ echo $row['engineerreport']; }?></td>
						</tr>
						<?php
						$count++;
						}
						?>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align:right;"><b>Total</b></td>
						<td><?=$noofbattery?></td>
						<td></td>
						<td></td>
						</tr>
					    <?php
						}
					    $sqlrep = "SELECT * From jrccalls where times='$times1' order by id asc";
						$queryrep = mysqli_query($connection, $sqlrep);
						$rowCountrep = mysqli_num_rows($queryrep);
						if(!$queryrep){
						die("SQL query failed: " . mysqli_error($connection));
						}
						if($rowCountrep > 0)
						{
						$rowrep = mysqli_fetch_array($queryrep);
						}
						?>
                       <table border="1" style="border:1px solid #8c8c8c">
						  <tr>
						  <td align="left" width="33%" style="vertical-align:bottom; height: 100px;">
						   Name & Signature of Authority<br>
						  
						  </td>
						 <td align="left" width="33%" style="vertical-align:bottom">
						 <b><?=$rowrep['engineername']?></b><br>
						   Name Of the Maintenance Engineer<br>
						  
						  </td>
						  </tr>
						  </table>	



  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
</body>
</html>
