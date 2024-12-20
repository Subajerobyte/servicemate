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
<title><?=$_SESSION['companyname']?> - Jerobyte - Quotation Generation</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
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
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Quotation Generation</h1>
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
<a onclick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction</a>
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
<?php
if(!isset($_GET['noofproduts']))
{
	$noofproduts=0;
	$noofscraps=0;
?>
<form action="" method="get">
<input type="hidden" name="id" value="<?=$rowselect['calltid']?>">
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="quotationtype">Number of Products</label>
<input type="number" name="noofproduts" id="noofproduts" class="form-control" min="1">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="quotationtype">Number of Scrap Products</label>
<input type="number" name="noofscraps" id="noofscraps" class="form-control" min="0">
</div>
</div>
</div>
<hr>
<button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
</form>
<?php
}
else
{
$noofproduts=mysqli_real_escape_string($connection, $_GET['noofproduts']);
$noofscraps=mysqli_real_escape_string($connection, $_GET['noofscraps']);
?>
<form action="quotationgens.php" method="post" enctype="multipart/form-data" id="myForm">
<input type="hidden" name="calltid" value="<?=$rowselect['calltid']?>">
<input type="hidden" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
<input type="hidden" name="sourceid" value="<?=$rowselect['sourceid']?>">
<input type="hidden" name="noofproduts" value="<?=$noofproduts?>">
<input type="hidden" name="noofscraps" value="<?=$noofscraps?>">
<?php
for($i=1;$i<=$noofproduts;$i++)
{
?>
<hr>
<h4 class="text-primary">Product <?=$i?> Details</h4>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="quotationtype<?=$i?>">Product Type</label>
<select class="form-control" name="quotationtype<?=$i?>" id="quotationtype<?=$i?>" required>
<option value="">Select</option>
<?php
$sqlselect = "SELECT id, quotationtype From jrcquotationtype order by quotationtype asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
while($rowprotype = mysqli_fetch_array($queryselect))
{
?>
<option value="<?=$rowprotype['id']?>"><?=$rowprotype['quotationtype']?></option>
<?php
$count++;
}
}
?>
</select>
</div>
</div>
</div>
<div class="row mb-1">
<div class="col-12">
<div class="form-group">
<label for="productname<?=$i?>">Product Name</label>
<select class="form-control" name="productname<?=$i?>" id="productname<?=$i?>" required>
<option value="">Select</option>
</select>
</div>
</div>
</div>
<div class="row mb-1">
<div class="col-12" id="productdetails<?=$i?>">
</div>
</div>
<?php
}
?>
<?php
for($i=1;$i<=$noofscraps;$i++)
{
?>
<hr>
<h4 class="text-danger">Scrap Product <?=$i?> Details</h4>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="squotationtype<?=$i?>">Scrap Product Type</label>
<select class="form-control" name="squotationtype<?=$i?>" id="squotationtype<?=$i?>" required>
<option value="">Select</option>
<?php
$sqlselect = "SELECT id, quotationtype From jrcquotationtype order by quotationtype asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$count=1;
while($rowprotype = mysqli_fetch_array($queryselect))
{
?>
<option value="<?=$rowprotype['id']?>"><?=$rowprotype['quotationtype']?></option>
<?php
$count++;
}
}
?>
</select>
</div>
</div>
</div>
<div class="row mb-1">
<div class="col-12">
<div class="form-group">
<label for="sproductname<?=$i?>">Scrap Product Name</label>
<select class="form-control" name="sproductname<?=$i?>" id="sproductname<?=$i?>" required>
<option value="">Select</option>
</select>
</div>
</div>
</div>
<div class="row mb-1">
<div class="col-12" id="sproductdetails<?=$i?>">
</div>
</div>
<?php
}
?>
<hr>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="prototal">Products Total Value</label>
<input type="number" name="prototal" id="prototal" class="form-control" min="1" value="0" readonly>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="scrtotal">Scraps Total Value</label>
<input type="number" name="scrtotal" id="scrtotal" class="form-control" min="0" value="0" readonly>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label for="gratotal">Grand Total</label>
<input type="number" name="gratotal" id="gratotal" class="form-control" min="1" value="0" readonly>
</div>
</div>
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
<script type="text/javascript">
$(function() {
$( "#topsearch" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
});
</script>
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
<script>
function image(thisImg) {
// var img = document.createElement("IMG");
// img.src = thisImg;
// img.className="img-fluid";
// document.getElementById('showData').appendChild(img);
var count = $('.imgcontainer .imgcontent').length;
count = Number(count) + 1;
$('.imgcontainer').append("<div class='imgcontent' id='imgcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgdelete' id='imgdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
url: "complaintbefups.php",
method: "POST",
allowedTypes:"jpg,png,jpeg",
fileName: "myfile",
multiple: true,
maxFileCount:5,
acceptFiles:"image/*;capture=camera",
onSuccess:function(files,data,xhr)
{
var obj = JSON.parse(data);
console.log(obj.imglist);
image(obj.imglist);
var vals=$("#imgbefuploads").val();
if(vals!='')
{
$("#imgbefuploads").val(vals+','+obj.imglist);
}
else
{
$("#imgbefuploads").val(obj.imglist);
}
$("#status").html("<font color='green'>Upload is success</font>");
},
onError: function(files,status,errMsg)
{
$("#status").html("<font color='red'>Upload is Failed</font>"+errMsg);
}
}
$("#mulitplefileuploader").uploadFile(settings);
});
</script>
<script>
// Remove file
$('.imgcontainer').on('click','.imgcontent .imgdelete',function(){
var id = this.id;
var split_id = id.split('_');
var num = split_id[1];
// Get image source
var imgElement_src = $( '#imgcontent_'+num+' img' ).attr("src");
var deleteFile = confirm("Do you really want to Delete?");
if (deleteFile == true) {
var vals=$("#imgbefuploads").val();
let newStr = vals.replace(imgElement_src+',', '');
newStr = newStr.replace(','+imgElement_src, '');
newStr = newStr.replace(imgElement_src, '');
$("#imgbefuploads").val(newStr);
$('#imgcontent_'+num).remove();
// AJAX request
/* $.ajax({
url: 'complaintrems.php',
type: 'post',
data: {path: imgElement_src,request: 2},
success: function(response){
if(response == 1){
$('#imgcontent_'+num).remove();
}
}
}); */
}
});
</script>
<script>
var producttotal=0;
var scraptotal=0;
var grandtotal=0;
</script>
<?php
if(isset($_GET['noofproduts']))
{
$noofproduts=mysqli_real_escape_string($connection, $_GET['noofproduts']);
$noofscraps=mysqli_real_escape_string($connection, $_GET['noofscraps']);
for($i=1;$i<=$noofproduts;$i++)
{
?>
<script>
$(document).ready(function(){
$("#quotationtype<?=$i?>").change(function(){
var cid=$(this).val();
$.ajax({
url:'quotation_products.php',
type:'post',
data:{id:cid},
success:function(res){
$("#productname<?=$i?>").html(res);
}
});
});
});
</script>
<script>
$(document).ready(function(){
$("#productname<?=$i?>").change(function(){
var cid=$(this).val();
var quotationtype=$("#quotationtype<?=$i?>").val();
$.ajax({
url:'quotation_products.php',
type:'post',
data:{proid:cid},
success:function(res){
var myArray = res.split("|");
var result='<table class="table table-bordered">';
if(myArray[0]!='')
{
result+='<input type="hidden" name="productid<?=$i?>" id="productid<?=$i?>" value="'+myArray[0].trim()+'">';
}
if(myArray[1]!='')
{
result+='<tr><th>Product Main Category</th><td>'+myArray[1].trim()+'</td></tr>';
}
if(myArray[2]!='')
{
result+='<tr><th>Product Sub Category</th><td>'+myArray[2].trim()+'</td></tr>';
}
if(myArray[3]!='')
{
result+='<tr><th>Product Name</th><td>'+myArray[3].trim()+'</td></tr>';
}
if(myArray[4]!='')
{
result+='<tr><th>Type of Product</th><td>'+myArray[4].trim()+'</td></tr>';
}
if(myArray[5]!='')
{
result+='<tr><th>Component Type</th><td>'+myArray[5].trim()+'</td></tr>';
}
if(myArray[6]!='')
{
result+='<tr><th>Component Name</th><td>'+myArray[6].trim()+'</td></tr>';
}
if(myArray[7]!='')
{
result+='<tr><th>Make</th><td>'+myArray[7].trim()+'</td></tr>';
}
if(myArray[8]!='')
{
result+='<tr><th>Capacity</th><td>'+myArray[8].trim()+'</td></tr>';
}
if(myArray[9]!='')
{
result+='<tr><th>Warranty</th><td>'+myArray[9].trim()+'</td></tr>';
}
if(myArray[10]!='')
{
result+='<tr><th>Description</th><td>'+myArray[10].trim()+'</td></tr>';
}
if(quotationtype!='AMC QUOTATION')
{
if(myArray[11]!='')
{
 if(myArray[18]!='')
			  {
				  if(myArray[18].trim()=='1')
				  {
					  var GST_Rate=parseFloat(myArray[13]);
					  var Inclusive_Price=parseFloat(myArray[11]);
					 var inc= (Inclusive_Price*GST_Rate)/(100+GST_Rate);
					 var org=(parseFloat(myArray[11])-parseFloat(inc)).toFixed(2);
					  result+='<tr ><th>Price</th><td>'+org+' (Exc.'+myArray[11]+')<input type="hidden" name="price<?=$i?>" id="price<?=$i?>" value="'+org+'"></td></tr>';
					  console.log('k');
				  }
				  else
				  {
					 result+='<tr ><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="price<?=$i?>" id="price<?=$i?>" value="'+myArray[11].trim()+'"></td></tr>';  
					 var org=(parseFloat(myArray[11])).toFixed(2);
					  console.log(myArray[18].trim());
				  }
			  }
			  else
			  {
				  result+='<tr ><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="price<?=$i?>" id="price<?=$i?>" value="'+myArray[11].trim()+'"></td></tr>';
				  var org=(parseFloat(myArray[11])).toFixed(2);
				   console.log('Empty');
			  }
}
if(myArray[12]!='')
{
result+='<input type="hidden" name="minprice<?=$i?>" id="minprice<?=$i?>" value="'+myArray[12].trim()+'">';
}
if(myArray[13]!='')
{
result+='<tr><th>GST</th><td>'+myArray[13].trim()+'%<input type="hidden" name="gst<?=$i?>" id="gst<?=$i?>" value="'+myArray[13].trim()+'"></td></tr>';
}
if(myArray[14]!='')
{
result+='<tr style="display:none"><th>Scrap Value</th><td>'+myArray[14].trim()+'<input type="hidden" name="scrapvalue<?=$i?>" id="scrapvalue<?=$i?>" value="'+myArray[14].trim()+'"></td></tr>';
}
if(myArray[17]!='')
{
result+='<tr><th>Installation Cost</th><td>'+myArray[17].trim()+'<input type="hidden" name="installcost<?=$i?>" id="installcost<?=$i?>" value="'+myArray[17].trim()+'"></td></tr>';
}
if(myArray[11]!='')
{
result+='<tr><th style="width:50%">Price</th><td><input type="number" name="saleprice<?=$i?>" id="saleprice<?=$i?>" class="form-control" value="'+org+'" min="'+myArray[12].trim()+'" max="'+org+'" onchange="productcalc<?=$i?>()" step="0.01" required></td></tr><tr><th>No of Quantities</th><td><input type="number" name="salequantity<?=$i?>" id="salequantity<?=$i?>" class="form-control" value="1" min="1" onchange="productcalc<?=$i?>()" required></td></tr><tr><th>Include Installation Cost</th><td><label><input type="radio" name="salesinstallation<?=$i?>" id="salesinstallationyes<?=$i?>" value="1" onchange="productcalc<?=$i?>()"> Yes</label> <label><input type="radio" name="salesinstallation<?=$i?>" id="salesinstallationno<?=$i?>" value="0" onchange="productcalc<?=$i?>()" checked> No</label></td></tr><tr><th>Installation Cost</th><td><input type="number" name="salesinstallcost<?=$i?>" id="salesinstallcost<?=$i?>" class="form-control" value="'+myArray[17].trim()+'" onchange="productcalc<?=$i?>()" readonly></td></tr><tr><th>Total Cost</th><td><input type="number" name="salestotal<?=$i?>" id="salestotal<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr><tr><th>Total GST</th><td><input type="number" name="salesgst<?=$i?>" id="salesgst<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr><tr><th>Net Total</th><td><input type="number" name="salesnettotal<?=$i?>" id="salesnettotal<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>No of Scraps</th><td><input type="number" name="salescrap<?=$i?>" id="salescrap<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()"></td></tr><tr style="display:none"><th>Scrap Value</th><td><input type="number" name="salescrapvalue<?=$i?>" id="salescrapvalue<?=$i?>" class="form-control" value="0" readonly onchange="productcalc<?=$i?>()"></td></tr><tr style="display:none"><th>Grand Total</th><td><input type="number" name="salesgrandtotal<?=$i?>" id="salesgrandtotal<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr>';

}
}
else
{
if(myArray[15]!='')
{
result+='<tr><th>AMC Value</th><td>'+myArray[15].trim()+'</td></tr>';
}
if(myArray[16]!='')
{
result+='<tr><th>AMC GST</th><td>'+myArray[16].trim()+'</td></tr>';
}
}
result+='</table>';
$("#productdetails<?=$i?>").html(result);
productcalc<?=$i?>();
}
});
});
});
</script>
<script>
var producttotal=0;
function productcalc<?=$i?>()
{
var saleprice=document.getElementById("saleprice<?=$i?>");
var salequantity=document.getElementById("salequantity<?=$i?>");
var salesinstallationyes=document.getElementById("salesinstallationyes<?=$i?>");
var price=document.getElementById("price<?=$i?>");
var minprice=document.getElementById("minprice<?=$i?>");
var gst=document.getElementById("gst<?=$i?>");
var scrapvalue=document.getElementById("scrapvalue<?=$i?>");
var installcost=document.getElementById("installcost<?=$i?>");
var salesinstallcost=document.getElementById("salesinstallcost<?=$i?>");
var salestotal=document.getElementById("salestotal<?=$i?>");
var salesgst=document.getElementById("salesgst<?=$i?>");
var salesnettotal=document.getElementById("salesnettotal<?=$i?>");
var salescrap=document.getElementById("salescrap<?=$i?>");
var salescrapvalue=document.getElementById("salescrapvalue<?=$i?>");
var salesgrandtotal=document.getElementById("salesgrandtotal<?=$i?>");
if(saleprice.value!='')
{
if((parseFloat(saleprice.value)<parseFloat(minprice.value))||(parseFloat(saleprice.value)>parseFloat(price.value)))
{
alert("Please Enter Valid Selling Price");
saleprice.focus();
return false;
}
var total=0;
if((salequantity.value!='')&&(saleprice.value!=''))
{
total=parseFloat(saleprice.value)*parseFloat(salequantity.value);
}
/* if(salesinstallationyes.checked==true)
{
 if(salesinstallcost.value=='0')
 {
    salesinstallcost.value = installcost.value;
 }
 else
 {
	 salesinstallcost.value = salesinstallcost.value; 
 }
salesinstallcost.removeAttribute("readonly");	
total+=parseFloat(salesinstallcost.value);
}
else
{
salesinstallcost.setAttribute("readonly", "readonly");
salesinstallcost.value=0;
}
total=salestotal.value; */
if(salesinstallationyes.checked==true)
{
 if(salesinstallcost.value=='0')
 {
    salesinstallcost.value = installcost.value;
 }
 else
 {
	 salesinstallcost.value = salesinstallcost.value; 
 }
salesinstallcost.removeAttribute("readonly");	
total+=parseFloat(salesinstallcost.value);
}
else
{
salesinstallcost.setAttribute("readonly", "readonly");
salesinstallcost.value=0;
}
salestotal.value=parseFloat(total).toFixed(2);
var gstvalue=(total*parseFloat(gst.value))/100;
salesgst.value=gstvalue.toFixed(2);
var nettotal=parseFloat(total)+parseFloat(gstvalue);
salesnettotal.value=nettotal.toFixed(2);
var scrap=0;
if((salescrap.value!='')&&(salescrap.value!='0'))
{
scrap=parseFloat(scrapvalue.value)*parseFloat(salescrap.value);
}
salescrapvalue.value=scrap;
salesgrandtotal.value=(parseFloat(nettotal)-parseFloat(scrap)).toFixed(2);
totalcalc();
}
else
{
}
}
</script>
<?php
}
for($i=1;$i<=$noofscraps;$i++)
{
?>
<script>
$(document).ready(function(){
$("#squotationtype<?=$i?>").change(function(){
var cid=$(this).val();
$.ajax({
url:'quotation_products.php',
type:'post',
data:{id:cid},
success:function(res){
$("#sproductname<?=$i?>").html(res);
}
});
});
});
</script>
<script>
$(document).ready(function(){
$("#sproductname<?=$i?>").change(function(){
var cid=$(this).val();
var quotationtype=$("#squotationtype<?=$i?>").val();
$.ajax({
url:'quotation_products.php',
type:'post',
data:{proid:cid},
success:function(res){
var myArray = res.split("|");
var result='<table class="table table-bordered">';
if(myArray[0]!='')
{
result+='<input type="hidden" name="sproductid<?=$i?>" id="sproductid<?=$i?>" value="'+myArray[0].trim()+'">';
}
if(myArray[1]!='')
{
result+='<tr><th>Product Main Category</th><td>'+myArray[1].trim()+'</td></tr>';
}
if(myArray[2]!='')
{
result+='<tr><th>Product Sub Category</th><td>'+myArray[2].trim()+'</td></tr>';
}
if(myArray[3]!='')
{
result+='<tr><th>Product Name</th><td>'+myArray[3].trim()+'</td></tr>';
}
if(myArray[4]!='')
{
result+='<tr><th>Type of Product</th><td>'+myArray[4].trim()+'</td></tr>';
}
if(myArray[5]!='')
{
result+='<tr><th>Component Type</th><td>'+myArray[5].trim()+'</td></tr>';
}
if(myArray[6]!='')
{
result+='<tr><th>Component Name</th><td>'+myArray[6].trim()+'</td></tr>';
}
if(myArray[7]!='')
{
result+='<tr><th>Make</th><td>'+myArray[7].trim()+'</td></tr>';
}
if(myArray[8]!='')
{
result+='<tr><th>Capacity</th><td>'+myArray[8].trim()+'</td></tr>';
}
if(myArray[9]!='')
{
result+='<tr style="display:none"><th>Warranty</th><td>'+myArray[9].trim()+'</td></tr>';
}
if(myArray[10]!='')
{
result+='<tr><th>Description</th><td>'+myArray[10].trim()+'</td></tr>';
}
if(quotationtype!='AMC QUOTATION')
{
if(myArray[11]!='')
{
result+='<tr style="display:none"><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="sprice<?=$i?>" id="sprice<?=$i?>" value="'+myArray[11].trim()+'"></td></tr>';
}
if(myArray[12]!='')
{
result+='<input type="hidden" name="sminprice<?=$i?>" id="sminprice<?=$i?>" value="'+myArray[12].trim()+'">';
}
if(myArray[13]!='')
{
result+='<tr style="display:none"><th>GST</th><td>'+myArray[13].trim()+'%<input type="hidden" name="sgst<?=$i?>" id="sgst<?=$i?>" value="'+myArray[13].trim()+'"></td></tr>';
}
if(myArray[14]!='')
{
result+='<tr><th>Scrap Value</th><td>'+myArray[14].trim()+'<input type="hidden" name="sscrapvalue<?=$i?>" id="sscrapvalue<?=$i?>" value="'+myArray[14].trim()+'"></td></tr>';
}
if(myArray[17]!='')
{
result+='<tr style="display:none"><th>Installation Cost</th><td>'+myArray[17].trim()+'<input type="hidden" name="sinstallcost<?=$i?>" id="	<?=$i?>" value="'+myArray[17].trim()+'"></td></tr>';
}
if(myArray[11]!='')
{
result+='<tr style="display:none"><th style="width:50%">Price</th><td><input type="number" name="ssaleprice<?=$i?>" id="ssaleprice<?=$i?>" class="form-control" value="'+myArray[11].trim()+'" min="'+myArray[12].trim()+'" max="'+myArray[11].trim()+'" onchange="sproductcalc<?=$i?>()" required></td></tr><tr style="display:none"><th>No of Quantities</th><td><input type="number" name="ssalequantity<?=$i?>" id="ssalequantity<?=$i?>" class="form-control" value="0" min="0" onchange="sproductcalc<?=$i?>()" required></td></tr><tr style="display:none"><th>Include Installation Cost</th><td><label><input type="radio" name="ssalesinstallation<?=$i?>" id="ssalesinstallationyes<?=$i?>" value="1" onchange="sproductcalc<?=$i?>()"> Yes</label> <label><input type="radio" name="ssalesinstallation<?=$i?>" id="ssalesinstallationno<?=$i?>" value="0" onchange="sproductcalc<?=$i?>()" checked> No</label></td></tr><tr style="display:none"><th>Installation Cost</th><td><input type="number" name="ssalesinstallcost<?=$i?>" id="ssalesinstallcost<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>Total Cost</th><td><input type="number" name="ssalestotal<?=$i?>" id="ssalestotal<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>Total GST</th><td><input type="number" name="ssalesgst<?=$i?>" id="ssalesgst<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>Net Total</th><td><input type="number" name="ssalesnettotal<?=$i?>" id="ssalesnettotal<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr><th>No of Scraps</th><td><input type="number" name="ssalescrap<?=$i?>" id="ssalescrap<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()"></td></tr><tr><th>Scrap Value</th><td><input type="number" name="ssalescrapvalue<?=$i?>" id="ssalescrapvalue<?=$i?>" class="form-control" value="0" readonly onchange="sproductcalc<?=$i?>()"></td></tr><tr ><th>Grand Total</th><td><input type="number" name="ssalesgrandtotal<?=$i?>" id="ssalesgrandtotal<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr>';
}
}
else
{
if(myArray[15]!='')
{
result+='<tr><th>AMC Value</th><td>'+myArray[15].trim()+'</td></tr>';
}
if(myArray[16]!='')
{
result+='<tr><th>AMC GST</th><td>'+myArray[16].trim()+'</td></tr>';
}
}
result+='</table>';
$("#sproductdetails<?=$i?>").html(result);
sproductcalc<?=$i?>();
}
});
});
});
</script>
<script>
function sproductcalc<?=$i?>()
{
var saleprice=document.getElementById("ssaleprice<?=$i?>");
var salequantity=document.getElementById("ssalequantity<?=$i?>");
var salesinstallationyes=document.getElementById("ssalesinstallationyes<?=$i?>");
var price=document.getElementById("sprice<?=$i?>");
var minprice=document.getElementById("sminprice<?=$i?>");
var gst=document.getElementById("sgst<?=$i?>");
var scrapvalue=document.getElementById("sscrapvalue<?=$i?>");
var installcost=document.getElementById("sinstallcost<?=$i?>");
var salesinstallcost=document.getElementById("ssalesinstallcost<?=$i?>");
var salestotal=document.getElementById("ssalestotal<?=$i?>");
var salesgst=document.getElementById("ssalesgst<?=$i?>");
var salesnettotal=document.getElementById("ssalesnettotal<?=$i?>");
var salescrap=document.getElementById("ssalescrap<?=$i?>");
var salescrapvalue=document.getElementById("ssalescrapvalue<?=$i?>");
var salesgrandtotal=document.getElementById("ssalesgrandtotal<?=$i?>");
if(saleprice.value!='')
{
if((parseFloat(saleprice.value)<parseFloat(minprice.value))||(parseFloat(saleprice.value)>parseFloat(price.value)))
{
alert("Please Enter Valid Selling Price");
saleprice.focus();
return false;
}
var total=0;
if((salequantity.value!='')&&(saleprice.value!=''))
{
total=parseFloat(saleprice.value)*parseFloat(salequantity.value);
}
if(salesinstallationyes.checked==true)
{
salesinstallcost.value=installcost.value;
total+=parseFloat(installcost.value);
}
else
{
salesinstallcost.value=0;
}
salestotal.value=total;
var gstvalue=(total*parseFloat(gst.value))/100;
salesgst.value=gstvalue;
var nettotal=parseFloat(total)+parseFloat(gstvalue);
salesnettotal.value=nettotal;
var scrap=0;
if((salescrap.value!='')&&(salescrap.value!='0'))
{
scrap=parseFloat(scrapvalue.value)*parseFloat(salescrap.value);
}
salescrapvalue.value=scrap.toFixed(2);
salesgrandtotal.value=(parseFloat(nettotal)-parseFloat(scrap)).toFixed(2);
totalcalc();
}
else
{
}
}
</script>
<?php
}
}
?>
<script>
function totalcalc()
{
var prototal=0;
var scrtotal=0;
var gratotal=0;
<?php
for($i=1;$i<=$noofproduts;$i++)
{
?>
if(document.getElementById("salesgrandtotal<?=$i?>"))
{
prototal+=parseFloat(document.getElementById("salesgrandtotal<?=$i?>").value);
}
<?php
}
for($i=1;$i<=$noofscraps;$i++)
{
?>
if(document.getElementById("ssalesgrandtotal<?=$i?>"))
{
scrtotal-=parseFloat(document.getElementById("ssalesgrandtotal<?=$i?>").value);
}
<?php
}
?>
gratotal=parseFloat(prototal)-parseFloat(scrtotal);
document.getElementById("prototal").value=prototal;
document.getElementById("scrtotal").value=scrtotal;
document.getElementById("gratotal").value=gratotal;
}
</script>
</body>
</html>