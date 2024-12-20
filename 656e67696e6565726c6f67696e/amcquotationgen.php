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
<title><?=$_SESSION['companyname']?> - Jerobyte - AMC Quotation Generation</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
<style>
.imgcontainer{
height:auto;
text-align:center;
}
.imgcontent{
width: 110px;
float: left;
margin-right: 5px;
border: 1px solid gray;
border-radius: 3px;
padding: 5px;
}
/* Delete */
.imgcontent span{
border: 2px solid red;
display: inline-block;
width: 100%;
text-align: center;
color: red;
}
.imgcontent span:hover{
cursor: pointer;
}
.ajax-upload-dragdrop, .ajax-file-upload-statusbar, .ajax-file-upload-filename
{
width: 100% !important;
}
</style>
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
<h1 class="h4 mb-0 text-gray-800">AMC Quotation Generation</h1>
</div>
<div class="row">
<div class="col-lg-12">
<?php
if(isset($_GET['remarks']))
{
?>
<div class="alert alert-success"><?=$_GET['remarks']?></div>
<?php
}
?>
<div class="row" id="myItems">
<?php
if(isset($_GET['id']))
{
$calltid=mysqli_real_escape_string($connection,$_GET['id']);
$_SESSION['calltid']=$calltid;
$sqlselect = "SELECT * From jrccalls where (engineerid='".$id."' or find_in_set('".$id."', engineersid)) and calltid='".$calltid."' order by id desc";
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
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
if($rowxl['address1']!='')
{
$rowxl['address1']=jbsdecrypt($encpass, $rowxl['address1']);
}
if($rowxl['phone']!='')
{
$rowxl['phone']=jbsdecrypt($encpass, $rowxl['phone']);
}
if($rowxl['mobile']!='')
{
$rowxl['mobile']=jbsdecrypt($encpass, $rowxl['mobile']);
}
if($rowxl['email']!='')
{
$rowxl['email']=jbsdecrypt($encpass, $rowxl['email']);
}
}
}
}
$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
$querycons = mysqli_query($connection, $sqlcons);
$rowCountcons = mysqli_num_rows($querycons);
if(!$querycons){
die("SQL query failed: " . mysqli_error($connection));
}
$rowcons = mysqli_fetch_array($querycons);
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
if($rowcons['address1']!='')
{
$rowcons['address1']=jbsdecrypt($encpass, $rowcons['address1']);
}
if($rowcons['phone']!='')
{
$rowcons['phone']=jbsdecrypt($encpass, $rowcons['phone']);
}
if($rowcons['mobile']!='')
{
$rowcons['mobile']=jbsdecrypt($encpass, $rowcons['mobile']);
}
if($rowcons['email']!='')
{
$rowcons['email']=jbsdecrypt($encpass, $rowcons['email']);
}
}
}
?>
<?php
if($rowselect['compstatus']=='2')
{
$bg="bg-success";
$bgtext="Completed";
}
else if($rowselect['compstatus']=='1')
{
$bg="bg-warning";
$bgtext="Pending";
}
else
{
$bg="bg-danger";
$bgtext="Open";
}
?>
<div class="col-lg-6 mb-4 items">
<div class="card shadow">
<div class="card-header <?=$bg?> text-white ">
<?=$rowselect['calltid']?> - <?=$bgtext?>
</div>
<div class="card-body">
<h5>Customer Details:</h5>
<p><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
if($rowcons['latlong']!='')
{
?>
<br>
<a class="text-primary" style="cursor:pointer" onClick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a><?php
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
<?php
if(!isset($_GET['quotationtype']))
{
?>
<form action="" method="get">
<input type="hidden" name="id" value="<?=$rowselect['calltid']?>">
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="quotationtype">Quotation Type</label>
<select class="form-control" id="quotationtype" name="quotationtype" required>
<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcamcquotationtype order by id asc";
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
?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['quotationtype']?></option>
<?php
}
}
?>
</select></div>
</div>
</div>
<hr>
<button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
</form>
<?php
}
else
{
$quotationtype=mysqli_real_escape_string($connection, $_GET['quotationtype']);
?>
<form action="amcquotationgens.php" method="post" enctype="multipart/form-data" id="myForm">
<input type="hidden" name="calltid" value="<?=$rowselect['calltid']?>">
<input type="hidden" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
<input type="hidden" name="sourceid" value="<?=$rowselect['sourceid']?>">
<input type="hidden" name="quotationtype" value="<?=$quotationtype?>">
<hr>
<?php
$sqlselect1 = "SELECT DISTINCT stockitem, amcvalue,amcgst,gsttype From jrcproduct where stockitem='".$rowxl['stockitem']."' order by id asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
$rowCountselect = mysqli_num_rows($queryselect1);
$rowselect1 = mysqli_fetch_array($queryselect1);
?>
<input type="hidden" class="gsttype" id="gsttype" value="<?=$rowselect1['gsttype']?>">
<div class="row mb-1">
<div class="col-6">
<label for="priceperyear" class="col-form-label">Price for 12 Months</label>
</div>
<div class="col-6">
<input type="number" class="form-control" name="priceperyear" id="priceperyear" value="<?=($rowselect1['amcvalue'])?>" readonly onchange="valuefun()">
</div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="noofmonths" class="col-form-label">Number of Months</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="noofmonths" id="noofmonths"  onchange="valuefun();monthupdate()"  required>
</div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="serialnumber" class="col-form-label">Serial Number</label>
</div>
<div class="col-6">
<select class="form-control fav_clr" name="serialnumber[]" id="serialnumber" multiple  onchange="valuefun()">
<option value="">Select</option>
<?php
$serialnumbers=array();
$serialnumbers=explode("|",$rowxl['serialnumber']);
print_r($serialnumbers);
if(!empty($serialnumbers))
{
foreach($serialnumbers as $ser)
{
$serialnumbers[]=$ser;
?>
<option value="<?=$ser?>"><?=$ser?></option>
<?php
}
}	  ?>
</select>
</div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="quantity" class="col-form-label">Quantity</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="quantity" id="quantity" onchange="valuefun();qtyfun()"  required readonly>
</div>
</div>
<hr>
<div class="row mb-1">
<div class="col-6">
<label for="resultvalue" class="col-form-label">Value</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="resultvalue" id="resultvalue"  onchange="valuefun()" step="0.01" readonly>
</div>
</div>
<div class="row mb-1">
<div class="col-2">
<label for="amcgst" class="col-form-label">GST</label>
</div>
<div class="col-4">
<input type="number" min="0" class="form-control" name="amcgst" id="amcgst" readonly value="<?=($rowselect1['amcgst'])?>" >
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="amcgstvalue" id="amcgstvalue" readonly >
</div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="btotalvalue" class="col-form-label">Total Amount</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="btotalvalue" id="btotalvalue" readonly></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="totalvalue" class="col-form-label">Total Rounded Amount</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="totalvalue" id="totalvalue" readonly></div>
</div>
<hr>
<div class="row mb-1">
<div class="col-6">
<label for="datefrom" class="col-form-label">Duration From</label>
</div>
<div class="col-6">
<input type="date"  class="form-control" name="datefrom" id="datefrom" onchange="monthupdate()" required>
</div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="dateto" class="col-form-label">Duration To</label>
</div>
<div class="col-6">
<input type="date" class="form-control" name="dateto" id="dateto" onchange="monthupdate()">
</div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="maintenancetype" class="col-form-label">Maintenance Type</label>
</div>
<div class="col-6">
<select class="form-control" id="maintenancetype" name="maintenancetype" required>
<option value="">Select</option>
<option value="Monthly">Monthly</option>
<option value="Quarterly">Quarterly</option>
<option value="Half Yearly">Half Yearly</option>
<option value="Annually">Annually</option>
</select></div>
</div>
<hr>
<button type="submit" name="submit" class="btn btn-primary" onclick="validateFormAndSubmit()">SUBMIT</button>
</form>
<?php
}
?>
</div>
</div>
</div>
<?php
$count++;
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
<script>
$(document).on('change','#serialnumber',function(){
var rr = $('#serialnumber :selected').length;
$('#quantity').val(rr);
console.log(rr);
valuefun();
});
</script>
<script>
function valuefun() {
  updateResult();
  qtyfun();
}

function updateResult() {
  var priceperyear = parseFloat(document.getElementById("priceperyear").value) || 0;
  var noofmonths = parseFloat(document.getElementById("noofmonths").value) || 0;
  var quantity = document.getElementById("quantity").value;
  var amcgst = parseFloat(document.getElementById("amcgst").value) || 0;
  var gsttype = document.getElementById("gsttype").value;
if(quantity!='' && noofmonths!='')
{
  var resultvalue = (priceperyear !="" && noofmonths !="") ? ((priceperyear / 12) * noofmonths) : priceperyear.toFixed(2);

  if (gsttype != '') {
    if (gsttype === '1') {
		 var btotalvalue = (parseFloat(resultvalue) * parseFloat(quantity)).toFixed(2);
      var amcgst = (btotalvalue * parseFloat(amcgst)) / (100 + parseFloat(amcgst));
      document.getElementById("amcgstvalue").value = amcgst.toFixed(2);
      var result = parseFloat(btotalvalue) - parseFloat(amcgst);
	  
    } 
	else if (gsttype === '0') {
      var resultvalue1=(resultvalue * quantity).toFixed(2);
      var amcgst = (resultvalue1 * parseFloat(amcgst)) / 100;
      document.getElementById("amcgstvalue").value = amcgst.toFixed(2);
      var result = parseFloat(resultvalue1);
	  var btotalvalue = (parseFloat(result) + parseFloat(document.getElementById("amcgstvalue").value)).toFixed(2);
    }
  }
  var totalvalue = Math.round(btotalvalue);
  document.getElementById("resultvalue").value = result.toFixed(2);
  document.getElementById("btotalvalue").value = btotalvalue;
  document.getElementById("totalvalue").value = totalvalue;
}
}

function gstfun() {
  updateResult();
}

function qtyfun() {
  var quantity =document.getElementById("quantity").value;
  var resultvalue = document.getElementById("resultvalue").value;
  document.getElementById("resultvalue").value = (quantity * resultvalue).toFixed(2);
  gstfun();
}

function netfun() {
  updateResult();
}
</script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
$('.fav_clr').select2({
width: '100%',
allowClear: true,
placeholder: ''
});
});
$('.fav_clr').on("select2:select", function (e) {
var data = e.params.data.text;
if(data=='all'){
$(".fav_clr > option").prop("selected","selected");
$(".fav_clr").trigger("change");
}
});
</script>
<script>
function add_months(dt, n)
{
return new Date(dt.setMonth(dt.getMonth() + n));
}
function formatDate(date) {
var d = new Date(date),
month = '' + (d.getMonth() + 1),
day = '' + d.getDate(),
year = d.getFullYear();
if (month.length < 2)
month = '0' + month;
if (day.length < 2)
day = '0' + day;
return [year, month, day].join('-');
}
function monthupdate()
{
var noofmonths=document.getElementById("noofmonths");
var datefrom=document.getElementById("datefrom");
var dateto=document.getElementById("dateto");
if((noofmonths.value!="")&&(datefrom.value!=""))
{
var str=datefrom.value;
console.log(str);
var res = str.split("-");
var dt = new Date(res[0],res[1],res[2]);
dt=add_months(dt, parseInt(noofmonths.value)-1);
dt.setDate(dt.getDate() - 1);
dateto.value=formatDate(dt.toString());
}
}
</script>
<script>
function mapsSelector(lat,lon) {
if ((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) || (navigator.platform.indexOf("iPod") != -1))
{
window.open("maps://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
else
{
window.open("https://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
}
function myFunction() {
var input, filter, cards, cardContainer, h5, title, i;
input = document.getElementById("myFilter");
filter = input.value.toUpperCase();
cardContainer = document.getElementById("myItems");
cards = cardContainer.getElementsByClassName("items");
for (i = 0; i < cards.length; i++) {
title = cards[i].querySelector(".card");
if (title.innerText.toUpperCase().indexOf(filter) > -1) {
cards[i].style.display = "";
} else {
cards[i].style.display = "none";
}
}
}
</script>
</body>
</html>