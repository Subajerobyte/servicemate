<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
$custsignature=mysqli_real_escape_string($connection, $_POST['custsignature']);
$applisign=mysqli_real_escape_string($connection, $_POST['applisign']);
foreach ($_POST['calldetailsid'] as $id)
{
$sqlcon = "SELECT calltid From jrccalldetails where id = '{$id}'";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon > 0)
{
$sqlup = "update jrccalldetails set custsignature='$custsignature', applisign='$applisign' where id = '{$id}'";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
header("Location: calls.php?remarks=Updated Successfully");
}
}
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Consolidate Report</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
</head>
<body id="page-top"  >
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Consolidate Report</h1>
<!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>
<div class="row">
<div class="col-lg-12">
<?php
if(isset($_GET['remarks']))
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-success text-white shadow">
<div class="card-body">
<?=$_GET['remarks']?>
</div>
</div>
</div>
<?php
}
if(isset($_GET['error']))
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<?=$_GET['error']?>
</div>
</div>
</div>
<?php
}
?>
<?php
if(isset($_GET['times']))
{
?>
<form action=""  method="post" id="myForm">
<div class="row">
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
?>
<div class="col-lg-12">
<div class="card shadow">
<div class="card-body">
<h5>Customer Details:</h5>
<p><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
if($rowcons['latlong']!='')
{
?>
<br>
<a class="text-primary" style="cursor:pointer" onclick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a>
<?php
}
?>
</p>
<hr>
<h5>Product Details:</h5>
<p><?php
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<?=$rowxl['stockmaincategory']?> -
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<?=$rowxl['stocksubcategory']?> -
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<?=$rowxl['componentname']?> -
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<?=$rowxl['stockitem']?>
<?php
}
?><br><?=$rowselect['serial']?></p>
<hr>
<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>S.No</th>
<th>Department</th>
<th>ups capacity</th>
<th>Ups S.No</th>
<th>Qty</th>
<th>Battery capacity</th>
<th>Qty</th>
<th>Maintenanc DT</th>
<th>Remarks</th>
</tr>
</thead>
<tbody>
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
?>
<input type="hidden" name="calldetailsid[]" id="calldetails" value="<?php if($rowCount>0){ echo $row['id']; }?>">
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
</tbody>
</table>
</div>
<div class="col-lg-6">
Is this signature applicable for all calls?
<label><input type="radio" name="applisign" value="Yes" id="applisign" <?=($row['applisign']=='Yes')?"checked":""?>> yes
</label>
<label><input type="radio" name="applisign" value="No" id="applisign" <?=($row['applisign']=='No')?"checked":""?>> No
</label>
</div>
<div class="col-lg-6">
<div class="form-group">
<h5 class="mb-2"><label for="signname">Signature</label></h5>
<input type="hidden" class="form-control" name="custsignature" id="custsignature" value="<?=$row['custsignature']?>">
<img id="signatureimg" src="<?=$row['custsignature']?>">
<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#signModal">Get Signature</a>
<div id="signModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Get Signature</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body" class="text-center" align="center">
<p class="text-center"><div id="signpad" align="center" style="border:1px solid #000000; width:302px; height:202px;">
<canvas class="pad" id="pad" width="300" height="200" ></canvas>
</div></p>
</div>
<div class="modal-footer">
<input type="reset" class="btn btn-warning" value="Clear" id="clear" />
<input type="button" id="btnSaveSign" class="btn btn-success" value="Submit"  data-dismiss="modal"/>
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>
</div>
<input class="btn btn-primary" type="submit" name="submit" value="Submit" onclick="validateFormAndSubmit()"
>
</form>
</div>
</div>
</div>
<hr>
<?php
}
}
}
}
}
?>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php') ?>
<?php include('spin.php') ?>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<a class="btn btn-primary" href="../logout.php">Logout</a>
</div>
</div>
</div>
</div>
<script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
<script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
<script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
<script>
(function(window) {
var $canvas,
onResize = function(event) {
$canvas.attr({
});
};
$(document).ready(function() {
$canvas = $('canvas');
window.addEventListener('orientationchange', onResize, false);
window.addEventListener('resize', onResize, false);
onResize();
$('#clear').click(function() {
$('#signpad').signaturePad().clearCanvas();
});
$('#signpad').signaturePad({
drawOnly: true,
defaultAction: 'drawIt',
validateFields: false,
lineWidth: 0,
output :'.output',
sigNav: null,
name: null,
typed: null,
clear: '#clear',
typeIt: null,
drawIt: null,
typeItDesc: null,
drawItDesc: null
});
$("#btnSaveSign").click(function(e){
html2canvas([document.getElementById('pad')], {
onrendered: function (canvas) {
var canvas_img_data = canvas.toDataURL('image/png');
var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
//ajax call to save image inside folder
$.ajax({
url: 'save_sign.php',
data: { img_data:img_data },
type: 'post',
success: function (response) {
console.log(response);
$("#signatureimg").attr("src",response);
$("#signatureimg").show();
$("#custsignature").val(response);
}
});
},
backgroundColor: null,
});
});
});
}(this));
</script>
<script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
</body>
</html>