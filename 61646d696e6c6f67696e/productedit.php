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
<title><?=$_SESSION['companyname']?> - Jerobyte - Edit Product Details</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
</head>
<body id="page-top" onload="taxable()">
<div id="wrapper">
<?php  include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php  include('navbar.php');?>
<?php  include('productnavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Edit Product Details</h1>
<a href="product.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Product Details</a>
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
<!--<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Edit Product Details</h6>
</div>-->
<div class="card-body" >
<?php
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT id, stockmaincategory, stocksubcategory, stockitem, typeofproduct, componenttype, componentname, make, capacity,unit,type,code,sku,hsncode,taxpreference,gstpercentage, igstpercentage, exemption, description , marketname, unitqty From jrcproduct where id='".$id."' order by componentname asc";
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
?>
<form action="productedits.php" method="post">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
<?php
if($infolayoutproducts['type']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Type</label>
<br>
<label><input type="radio" id="type" name="type"<?=($infolayoutproducts['typereq']=='1')?'required':''?> value="Goods" <?=($rowselect['type']=='Goods')?'checked':''?>> Goods</label>	&nbsp;
<label><input type="radio" id="type" name="type"<?=($infolayoutproducts['typereq']=='1')?'required':''?> value="Service" <?=($rowselect['type']=='Service')?'checked':''?>> Service</label>
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
<input type="text" class="form-control" id="code" name="code" <?=($infolayoutproducts['codereq']=='1')?'required':''?>  value="<?=$rowselect['code']?>">
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
<input type="text" class="form-control" id="marketname" name="marketname" <?=($infolayoutproducts['marketnamereq']=='1')?'required':''?> value="<?=$rowselect['marketname']?>">
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
<label for="sku">SKU (Stock Keeping Unit) </label>
<input type="text" class="form-control" id="sku" name="sku" <?=($infolayoutproducts['skureq']=='1')?'required':''?>  value="<?=$rowselect['sku']?>">
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
<option value=""<?=($rowselect['unit']=="")?'selected':''?>>Select</option>
<option value="BAG - BAGS"<?=($rowselect['unit']=="BAG - BAGS")?'selected':''?>>BAG - BAGS </option>
<option value="BAL - BALE"<?=($rowselect['unit']=="BAL - BALE")?'selected':''?>>BAL - BALE</option>
<option value="BDL - BUNDLES"<?=($rowselect['unit']=="BDL - BUNDLES")?'selected':''?>>BDL - BUNDLES</option>
<option value="BKL - BUCKLES"<?=($rowselect['unit']=="BKL - BUCKLES")?'selected':''?>>BKL - BUCKLES</option>
<option value="BOU - BILLIONS OF UNITS"<?=($rowselect['unit']=="BOU - BILLIONS OF UNITS")?'selected':''?>>BOU - BILLIONS OF UNITS</option>
<option value="BOX - BOX"<?=($rowselect['unit']=="BOX - BOX")?'selected':''?>>BOX - BOX</option>
<option value="BTL - BOTTLES"<?=($rowselect['unit']=="BTL - BOTTLES")?'selected':''?>>BTL - BOTTLES</option>
<option value="BUN - BUNCHES"<?=($rowselect['unit']=="BUN - BUNCHES")?'selected':''?>>BUN - BUNCHES</option>
<option value="CAN - CANS"<?=($rowselect['unit']=="CAN - CANS")?'selected':''?>>CAN - CANS</option>
<option value="CBM - CUBIC METER"<?=($rowselect['unit']=="CBM - CUBIC METER")?'selected':''?>>CBM - CUBIC METER</option>
<option value="CCM - CUBIC CENTIMETER"<?=($rowselect['unit']=="CCM - CUBIC CENTIMETER")?'selected':''?>>CCM - CUBIC CENTIMETER</option>
<option value="CMS - CENTIMETER"<?=($rowselect['unit']=="CMS - CENTIMETER")?'selected':''?>>CMS - CENTIMETER</option>
<option value="CTN - CARTONS"<?=($rowselect['unit']=="CTN - CARTONS")?'selected':''?>>CTN - CARTONS</option>
<option value="DOZ - DOZEN"<?=($rowselect['unit']=="DOZ - DOZEN")?'selected':''?>>DOZ - DOZEN</option>
<option value="DRM - DRUM"<?=($rowselect['unit']=="DRM - DRUM")?'selected':''?>>DRM - DRUM</option>
<option value="GGR - GREAT GROSS"<?=($rowselect['unit']=="GGR - GREAT GROSS")?'selected':''?>>GGR - GREAT GROSS</option>
<option value="GMS - GRAMS"<?=($rowselect['unit']=="GMS - GRAMS")?'selected':''?>>GMS - GRAMS</option>
<option value="GRS - GROSS"<?=($rowselect['unit']=="GRS - GROSS")?'selected':''?>>GRS - GROSS</option>
<option value="GYD - GROSS YARDS"<?=($rowselect['unit']=="GYD - GROSS YARDS")?'selected':''?>>GYD - GROSS YARDS</option>
<option value="KGS - KILOGRAMS"<?=($rowselect['unit']=="KGS - KILOGRAMS")?'selected':''?>>KGS - KILOGRAMS</option>
<option value="KLR - KILOLITER"<?=($rowselect['unit']=="KLR - KILOLITER")?'selected':''?>>KLR - KILOLITER</option>
<option value="KME - KILOMETRE"<?=($rowselect['unit']=="KME - KILOMETRE")?'selected':''?>>KME - KILOMETRE</option>
<option value="MLT - MILLILITRE"<?=($rowselect['unit']=="MLT - MILLILITRE")?'selected':''?>>MLT - MILLILITRE</option>
<option value="MTR - METERS"<?=($rowselect['unit']=="MTR - METERS")?'selected':''?>>MTR - METERS</option>
<option value="MTS - METRIC TONS"<?=($rowselect['unit']=="MTS - METRIC TONS")?'selected':''?>>MTS - METRIC TONS</option>
<option value="NOS - NUMBERS"<?=($rowselect['unit']=="NOS - NUMBERS")?'selected':''?>>NOS - NUMBERS</option>
<option value="PAC - PACKS"<?=($rowselect['unit']=="PAC - PACKS")?'selected':''?>>PAC - PACKS</option>
<option value="PCS - PIECES"<?=($rowselect['unit']=="PCS - PIECES")?'selected':''?>>PCS - PIECES</option>
<option value="PRS - PAIRS"<?=($rowselect['unit']=="PRS - PAIRS")?'selected':''?>>PRS - PAIRS</option>
<option value="QTL - QUINTAL"<?=($rowselect['unit']=="QTL - QUINTAL")?'selected':''?>>QTL - QUINTAL</option>
<option value="ROL - ROLLS"<?=($rowselect['unit']=="ROL - ROLLS")?'selected':''?>>ROL - ROLLS</option>
<option value="SET - SETS"<?=($rowselect['unit']=="SET - SETS")?'selected':''?>>SET - SETS</option>
<option value="SQF - SQUARE FEET"<?=($rowselect['unit']=="SQF - SQUARE FEET")?'selected':''?>>SQF - SQUARE FEET</option>
<option value="SQM - SQUARE METERS"<?=($rowselect['unit']=="SQM - SQUARE METERS")?'selected':''?>>SQM - SQUARE METERS</option>
<option value="SQY - SQUARE YARDS"<?=($rowselect['unit']=="SQY - SQUARE YARDS")?'selected':''?>>SQY - SQUARE YARDS</option>
<option value="TBS - TABLETS"<?=($rowselect['unit']=="TBS - TABLETS")?'selected':''?>>TBS - TABLETS</option>
<option value="TGM - TEN GROSS"<?=($rowselect['unit']=="TGM - TEN GROSS")?'selected':''?>>TGM - TEN GROSS</option>
<option value="THD - THOUSANDS"<?=($rowselect['unit']=="THD - THOUSANDS")?'selected':''?>>THD - THOUSANDS</option>
<option value="TON - TONNES"<?=($rowselect['unit']=="TON - TONNES")?'selected':''?>>TON - TONNES</option>
<option value="TUB - TUBES"<?=($rowselect['unit']=="TUB - TUBES")?'selected':''?>>TUB - TUBES</option>
<option value="UGS - US GALLONS"<?=($rowselect['unit']=="UGS - US GALLONS")?'selected':''?>>UGS - US GALLONS</option>
<option value="UNT - UNITS"<?=($rowselect['unit']=="UNT - UNITS")?'selected':''?>>UNT - UNITS</option>
<option value="YDS - YARDS"<?=($rowselect['unit']=="YDS - YARDS")?'selected':''?>>YDS - YARDS</option>
<option value="OTH - OTHERS"<?=($rowselect['unit']=="OTH - OTHERS")?'selected':''?>>OTH - OTHERS</option>
</select>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="unitqty">Qty</label>
<input type="number" min="0" step="1" class="form-control" id="unitqty" name="unitqty" <?=($infolayoutproducts['unitreq']=='1')?'required':''?> value="<?=$rowselect['unitqty']?>">
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="unit" id="unit" value="">
<input type="hidden" name="unitqty" id="unitqty" value="0">
<?php
}
if($infolayoutproducts['hsncode']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">HSN Code</label>
<input type="text" class="form-control" id="hsncode" name="hsncode" <?=($infolayoutproducts['hsncodereq']=='1')?'required':''?>  value="<?=$rowselect['hsncode']?>" >
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
<option value="Taxable"<?=($rowselect['taxpreference']=="Taxable")?'selected':''?> onclick="taxable()">Taxable </option>
<option value="Non-Taxable"<?=($rowselect['taxpreference']=="Non-Taxable")?'selected':''?> onclick="taxable()">Non-Taxable</option>
</select>
</div>
</div>
<div class="col-lg-3" id="gstdiv">
<div class="form-group">
<label for="gstpercentage">Intra State Tax Rate</label>
<select class="form-control fav_clr" id="gstpercentage" name="gstpercentage" onChange="perchange('gstpercentage')">
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
<option value="<?=$rowgst['gstpercentage']?>"<?=($rowselect['gstpercentage']==$rowgst['gstpercentage'])?'selected':''?> ><?=$rowgst['gsttype']?> [<?=$rowgst['gstpercentage']?>%]</option>
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
<select class="form-control fav_clr" id="igstpercentage" name="igstpercentage" onChange="perchange('igstpercentage')">
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
<option value="<?=$rowgst['gstpercentage']?>"<?=($rowselect['igstpercentage']==$rowgst['gstpercentage'])?'selected':''?> ><?=$rowgst['gsttype']?> [<?=$rowgst['gstpercentage']?>%]</option>
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
<textarea class="form-control" id="exemption" onChange="taxable()" name="exemption"><?=$rowselect['exemption']?></textarea>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="taxpreference" id="taxpreference" value="<?=$rowselect['taxpreference']?>">
<input type="hidden" name="gstpercentage" id="gstpercentage" value="<?=$rowgst['gsttype']?> [<?=$rowgst['gstpercentage']?>%]">
<input type="hidden" name="igstpercentage" id="igstpercentage" value="<?=$rowgst['gsttype']?> [<?=$rowgst['gstpercentage']?>%]">
<input type="hidden" name="exemption" id="exemption" value="<?=$rowselect['exemption']?>">
<?php
}
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="stockmaincategory">Main Category</label>
<input type="text" class="form-control" id="stockmaincategory" name="stockmaincategory" value="<?=$rowselect['stockmaincategory']?>" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stockmaincategory" id="stockmaincategory" value="<?=$rowselect['stockmaincategory']?>">
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="stocksubcategory">Sub Category</label>
<input type="text" class="form-control" id="stocksubcategory" name="stocksubcategory" value="<?=$rowselect['stocksubcategory']?>" <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stocksubcategory" id="stocksubcategory" value="<?=$rowselect['stocksubcategory']?>">
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="stockitem">Product Name</label>
<input type="text" class="form-control" id="stockitem" name="stockitem" value="<?=$rowselect['stockitem']?>" <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="stockitem" id="stockitem" value="<?=$rowselect['stockitem']?>">
<?php
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="typeofproduct">Type of Product</label>
<input type="text" class="form-control" id="typeofproduct" name="typeofproduct" value="<?=$rowselect['typeofproduct']?>" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="typeofproduct" id="typeofproduct" value="<?=$rowselect['typeofproduct']?>">
<?php
}
if($infolayoutproducts['componenttype']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="componenttype">Component Type</label>
<input type="text" class="form-control" id="componenttype" name="componenttype" value="<?=$rowselect['componenttype']?>" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="componenttype" id="componenttype" value="<?=$rowselect['componenttype']?>">
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="componentname">Component Name</label>
<input type="text" class="form-control" id="componentname" name="componentname" value="<?=$rowselect['componentname']?>" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="componentname" id="componentname" value="<?=$rowselect['componentname']?>">
<?php
}
if($infolayoutproducts['make']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="make">Make</label>
<input type="text" class="form-control" id="make" name="make" value="<?=$rowselect['make']?>" <?=($infolayoutproducts['makereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="make" id="make" value="<?=$rowselect['make']?>">
<?php
}
if($infolayoutproducts['capacity']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="capacity">Capacity</label>
<input type="text" class="form-control" id="capacity" name="capacity" value="<?=$rowselect['capacity']?>" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="capacity" id="capacity" value="<?=$rowselect['capacity']?>">
<?php
}
if($infolayoutproducts['description']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="description">Description</label>
<textarea class="form-control" id="description" name="description" <?=($infolayoutproducts['descriptionreq']=='1')?'required':''?>><?=$rowselect['description']?></textarea>
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
<?php
$count++;
}
}
?>
</div>
</div>
</div>
</div>
<?php  include('footer.php'); ?>
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