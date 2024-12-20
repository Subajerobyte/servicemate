<?php
include('lcheck.php');
if($uploaddata=='0')
{
header("Location: dashboard.php");
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Add New Product</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php // include('productnavbar.php'); ?>
<div class="container-fluid">
<!-- Page Heading -->
<!--<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Add New Product</h1>
<a href="product.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Product Details</a>
</div>-->
<div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" ><b>Add New Product</b></h1>
  </div>
<div class="col-auto" style=" text-align: right;">
    <a href="product.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Product Details</a>
</div>
</div>
<?php
if(isset($_GET['remarks']))
{
?>
<div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
<?php
}
if(isset($_GET['error']))
{
?>
<div class="alert alert-danger shadow"><?=$_GET['error']?></div>
<?php
}
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<!-- <div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
</div>-->
<div class="card-body">
<form action="productadds.php" method="post">
<div class="row">
<?php
if($infolayoutproducts['type']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Type</label>
<br>
<label><input type="radio" id="type" name="type"<?=($infolayoutproducts['typereq']=='1')?'required':''?> value="Goods" checked> Goods</label>	&nbsp;
<label><input type="radio" id="type" name="type"<?=($infolayoutproducts['typereq']=='1')?'required':''?> value="Service" > Service</label>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="type" id="type" value="">
<?php
}
if($infolayoutproducts['code']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Product Code</label>
<input type="text" class="form-control" id="code" name="code" <?=($infolayoutproducts['codereq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="code" id="code" value="">
<?php
}
if($infolayoutproducts['marketname']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Market Name</label>
<input type="text" class="form-control" id="marketname" name="marketname" <?=($infolayoutproducts['marketnamereq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="marketname" id="marketname" value="">
<?php
}
if($infolayoutproducts['sku']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">SKU (Stock Keeping Unit) </label>
<input type="text" class="form-control" id="sku" name="sku" <?=($infolayoutproducts['skureq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="sku" id="sku" value="">
<?php
}
if($infolayoutproducts['unit']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Unit</label>
<select class="form-control" id="unit" name="unit" <?=($infolayoutproducts['unitreq']=='1')?'required':''?>>
<option value="">Select</option>
<option value="BAG - BAGS">BAG - BAGS </option>
<option value="BAL - BALE">BAL - BALE</option>
<option value="BDL - BUNDLES">BDL - BUNDLES</option>
<option value="BKL - BUCKLES">BKL - BUCKLES</option>
<option value="BOU - BILLIONS OF UNITS">BOU - BILLIONS OF UNITS</option>
<option value="BOX - BOX">BOX - BOX</option>
<option value="BTL - BOTTLES">BTL - BOTTLES</option>
<option value="BUN - BUNCHES">BUN - BUNCHES</option>
<option value="CAN - CANS">CAN - CANS</option>
<option value="CBM - CUBIC METER">CBM - CUBIC METER</option>
<option value="CCM - CUBIC CENTIMETER">CCM - CUBIC CENTIMETER</option>
<option value="CMS - CENTIMETER">CMS - CENTIMETER</option>
<option value="CTN - CARTONS">CTN - CARTONS</option>
<option value="DOZ - DOZEN">DOZ - DOZEN</option>
<option value="DRM - DRUM">DRM - DRUM</option>
<option value="GGR - GREAT GROSS">GGR - GREAT GROSS</option>
<option value="GMS - GRAMS">GMS - GRAMS</option>
<option value="GRS - GROSS">GRS - GROSS</option>
<option value="GYD - GROSS YARDS">GYD - GROSS YARDS</option>
<option value="KGS - KILOGRAMS">KGS - KILOGRAMS</option>
<option value="KLR - KILOLITER">KLR - KILOLITER</option>
<option value="KME - KILOMETRE">KME - KILOMETRE</option>
<option value="MLT - MILLILITRE">MLT - MILLILITRE</option>
<option value="MTR - METERS">MTR - METERS</option>
<option value="MTS - METRIC TONS">MTS - METRIC TONS</option>
<option value="NOS - NUMBERS">NOS - NUMBERS</option>
<option value="PAC - PACKS">PAC - PACKS</option>
<option value="PCS - PIECES">PCS - PIECES</option>
<option value="PRS - PAIRS">PRS - PAIRS</option>
<option value="QTL - QUINTAL">QTL - QUINTAL</option>
<option value="ROL - ROLLS">ROL - ROLLS</option>
<option value="SET - SETS">SET - SETS</option>
<option value="SQF - SQUARE FEET">SQF - SQUARE FEET</option>
<option value="SQM - SQUARE METERS">SQM - SQUARE METERS</option>
<option value="SQY - SQUARE YARDS">SQY - SQUARE YARDS</option>
<option value="TBS - TABLETS">TBS - TABLETS</option>
<option value="TGM - TEN GROSS">TGM - TEN GROSS</option>
<option value="THD - THOUSANDS">THD - THOUSANDS</option>
<option value="TON - TONNES">TON - TONNES</option>
<option value="TUB - TUBES">TUB - TUBES</option>
<option value="UGS - US GALLONS">UGS - US GALLONS</option>
<option value="UNT - UNITS">UNT - UNITS</option>
<option value="YDS - YARDS">YDS - YARDS</option>
<option value="OTH - OTHERS">OTH - OTHERS</option>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="unit" id="unit" value="">
<?php
}
if($infolayoutproducts['hsncode']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">HSN Code</label>
<input type="text" class="form-control" id="hsncode" name="hsncode" <?=($infolayoutproducts['hsncodereq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="hsncode" id="hsncode" value="">
<?php
}
if($infolayoutproducts['taxpreference']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Tax Preference</label>
<select class="form-control" id="taxpreference" name="taxpreference" <?=($infolayoutproducts['taxpreferencereq']=='1')?'required':''?> onclick="taxable()">
<option value="">Select</option>
<option value="Taxable" onclick="taxable()">Taxable </option>
<option value="Non-Taxable" onclick="taxable()">Non-Taxable</option>
</select>
</div>
</div>
<div class="col-lg-3" id="gstdiv">
<div class="form-group">
<label for="gstpercentage">Intra State Tax Rate</label>
<select class="form-control" id="gstpercentage" name="gstpercentage" onChange="perchange('gstpercentage')">
<option value="">Select</option>
<?php
$sqlgst = "SELECT * From jrcgstpercentage where gsttype='GST' order by gsttype asc, gstpercentage asc";
$querygst = mysqli_query($connection, $sqlgst);
$rowCountgst = mysqli_num_rows($querygst);
if(!$querygst){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountgst > 0)
{
$count=1;
while($rowgst = mysqli_fetch_array($querygst))
{
?>
<option value="<?=$rowgst['gstpercentage']?>"><?=$rowgst['gsttype']?> [<?=$rowgst['gstpercentage']?>%]</option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-3" id="igstdiv">
<div class="form-group">
<label for="igstpercentage">Inter State Tax Rate</label>
<select class="form-control" id="igstpercentage" name="igstpercentage" onChange="perchange('igstpercentage')">
<option value="">Select</option>
<?php
$sqlgst = "SELECT * From jrcgstpercentage where gsttype='IGST' order by gsttype asc, gstpercentage asc";
$querygst = mysqli_query($connection, $sqlgst);
$rowCountgst = mysqli_num_rows($querygst);
if(!$querygst){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountgst > 0)
{
$count=1;
while($rowgst = mysqli_fetch_array($querygst))
{
?>
<option value="<?=$rowgst['gstpercentage']?>"><?=$rowgst['gsttype']?> [<?=$rowgst['gstpercentage']?>%]</option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-3" id="exemptiondiv" style="display:none">
<div class="form-group">
<label for="exemption"> Exemption Reason</label>
<textarea class="form-control" id="exemption" onChange="taxable()" name="exemption"></textarea>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="taxpreference" id="taxpreference" value="">
<input type="hidden" name="gstpercentage" id="gstpercentage" value="">
<input type="hidden" name="igstpercentage" id="igstpercentage" value="">
<input type="hidden" name="exemption" id="exemption" value="">
<?php
}
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="stockmaincategory">Main Category</label>
<input type="text" class="form-control" id="stockmaincategory" name="stockmaincategory" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stockmaincategory" id="stockmaincategory" value="">
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="stocksubcategory">Sub Category</label>
<input type="text" class="form-control" id="stocksubcategory" name="stocksubcategory" <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stocksubcategory" id="stocksubcategory" value="">
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="stockitem">Product Name</label>
<input type="text" class="form-control" id="stockitem" name="stockitem" <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stockitem" id="stockitem" value="">
<?php
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="typeofproduct">Type of Product</label>
<input type="text" class="form-control" id="typeofproduct" name="typeofproduct" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="typeofproduct" id="typeofproduct" value="">
<?php
}
if($infolayoutproducts['componenttype']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="componenttype">Component Type</label>
<input type="text" class="form-control" id="componenttype" name="componenttype" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="componenttype" id="componenttype" value="">
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="componentname">Component Name</label>
<input type="text" class="form-control" id="componentname" name="componentname" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="componentname" id="componentname" value="">
<?php
}
if($infolayoutproducts['make']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="make">Make</label>
<input type="text" class="form-control" id="make" name="make" <?=($infolayoutproducts['makereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="make" id="make" value="">
<?php
}
if($infolayoutproducts['capacity']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="capacity">Capacity</label>
<input type="text" class="form-control" id="capacity" name="capacity" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="capacity" id="capacity" value="">
<?php
}
if($infolayoutproducts['description']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="description">Description</label>
<textarea class="form-control" id="description" name="description" <?=($infolayoutproducts['descriptionreq']=='1')?'required':''?>> </textarea>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="description" id="description" value="">
<?php
}
?>
</div>
<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>
</div>
</div>
</div>
<?php include('footer.php'); ?>
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
<script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script><script src="notification.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<!-- Page level plugins -->
<script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<!-- Page level plugins -->
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="../../1637028036/js/datatables.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
$( "#topsearch" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
$( "#stockmaincategory" ).autocomplete({
source: 'productsearch.php?type=stockmaincategory',
});
$( "#stocksubcategory" ).autocomplete({
source: 'productsearch.php?type=stocksubcategory',
});
$( "#stockitem" ).autocomplete({
source: 'productsearch.php?type=stockitem',
});
$( "#typeofproduct" ).autocomplete({
source: 'productsearch.php?type=typeofproduct',
});
$( "#componenttype" ).autocomplete({
source: 'productsearch.php?type=componenttype',
});
$( "#componentname" ).autocomplete({
source: 'productsearch.php?type=componentname',
});
$( "#make" ).autocomplete({
source: 'productsearch.php?type=make',
});
$( "#capacity" ).autocomplete({
source: 'productsearch.php?type=capacity',
});
});
</script>
<script>
function taxable()
{
var taxpreference=document.getElementById("taxpreference").value;
var gstdiv=document.getElementById("gstdiv");
var igstdiv=document.getElementById("igstdiv");
var exemptiondiv=document.getElementById("exemptiondiv");
var gstpercentage = document.getElementById("gstpercentage");
var igstpercentage = document.getElementById("igstpercentage");
var exemption = document.getElementById("exemption");
if(taxpreference=="Taxable")
{
gstdiv.style.display="block";
igstdiv.style.display="block";
exemptiondiv.style.display="none";
exemption.value="";
}
else
{
gstdiv.style.display="none";
igstdiv.style.display="none";
exemptiondiv.style.display="block";
gstpercentage.value="";
igstpercentage.value="";
}
}
</script>
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
function perchange(id)
{
// Get the select elements
var gstpercentage = document.getElementById("gstpercentage");
var igstpercentage = document.getElementById("igstpercentage");
if(id=="gstpercentage")
{
//console.log(gstpercentage.value);
igstpercentage.value= gstpercentage.value;
}
else
{
gstpercentage.value= igstpercentage.value;
}
}
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>