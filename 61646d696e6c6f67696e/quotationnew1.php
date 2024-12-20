<?php
include('lcheck.php'); 

if($salesorder=='0')
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Add New Sales Order</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->

 <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Add New Quotation</b></h1>
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
if((isset($error))&&($error!=''))
{
?>
<div class="col-lg-12 mb-2">
<div class="card bg-danger text-white shadow">
<div class="card-body">
<?=$error?>
</div>
</div>
</div>
<?php
}
?>
<!-- DataTales Example -->

<div class="card shadow mb-4">
<div class="card-body">
<form method="post" method="post" action="quotationnew1s.php" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-4">
  <div class="cardbox2">
  <div class="card-header2" style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2" onclick="toggleCustomerInput()" style="color:#fff;"><b>Customer Details</b></h6>
    </div>
    <div class="card-body2" id="customerBody" ><?php

 
	 $querysr = mysqli_query($connection, "SELECT qno From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		 $invoiceno=$_SESSION['companyshortname'].' / QN / '.date('m').date('y').' / '. (str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
		$invoicedate=date('Y-m-d');
	
	?>	
	<div class="form-group">
    <div class="input-container"> 
        <label for="invoiceno">Quotation No :</label>
        <input type="text" name="invoiceno" id="invoiceno" class="form-control" value="<?php echo (isset($invoiceno))?$invoiceno:'';?>"  >
    </div>
</div>
	
	
				
  <div class="form-group">
    <div class="input-container">
	<label for="qdate">Quotation Date :</label>
	<input type="date" class="form-control" id="qdate" name="qdate" value="<?=date('Y-m-d')?>">
	</div>
	</div>

  <div class="form-group">
    <div class="input-container">
	  <label for="consigneename" >Customer Name :</label>
     <input type="text" class="form-control" id="consigneename" name="consigneename"  <?=($infolayoutcustomers['consigneenamereq']=='1')?'required':''?>>
	 </div>
  </div>

  <div class="form-group">
    <div class="input-container">
	  <label for="mobile" >Mobile No :</label>
      <input type="number" class="form-control" id="mobile" name="mobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?>>
    </div>
  </div>

  <div class="form-group">
    <div class="input-container">
	  <label for="address1" >Address :</label>
      <input type="text" class="form-control" id="address1" name="address1" <?=($infolayoutcustomers['address1req']=='1')?'required':''?>>
    </div>
  </div>

  <div class="form-group">
    <div class="input-container">
	  <label for="district">District :</label>
      <input type="text" class="form-control" id="district" name="district" <?=($infolayoutcustomers['districtreq']=='1')?'required':''?>>
    </div>
  </div>

<div id="customerInputBox5" >
  <div class="form-group">
    <div class="input-container">
	  <label for="email">Email :</label>
      <input type="email" class="form-control" id="email" name="email" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?>>
    </div>
  </div>
</div>  
</div>

</div>


</div>
</div>
<hr>
<!--start product table-->
<div class="table-responsive">
<table class="table table-bordered" id="table-data">
<tr>
<th>PRODUCT </th><th>QTY</th><th>RATE</th><th>DISCOUNT</th><th>TAX</th><th>AMOUNT</th><th></th>
</tr>
<tr class="tr_clone">
<!--th><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="32"></th-->
<td>
<select class="form-control fav_clr stockitem1" id="stockitem1" name="stockitem[]" onchange="stockitemchange(1)">
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, stockitem From jrcproduct where price!='' order by stockitem asc limit 10";
$querygo = mysqli_query($connection, $sqlgo);
$rowCountgo = mysqli_num_rows($querygo);
if(!$querygo){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountgo > 0)
{
$count=1;
while($rowgo = mysqli_fetch_array($querygo))
{
?>
<option value="<?=$rowgo['id']?>"><?=$rowgo['stockitem']?></option>
<?php
}
}
?>
</select>
<div id="productresponse1"></div>
</td>
<td style="width:8%"><input type="number" name="qty[]" id="qty1" class="form-control" min="0" onchange="productcalc(1);" style="text-align:right">  <span href="#" data-toggle="modal" data-target="#serialmodal" onclick="updateauto()"></span>  
<input type="hidden" name="serialnumber[]" id="serialnumber1">
<input type="hidden" name="department[]" id="department1">
</td>
<td style="width:10%"><input type="number" name="rate[]" id="rate1" class="form-control" min="0" step="0.01" onchange="productcalc(1)" style="text-align:right"><div id="rateresponse1"></div><div id="ratecresponse1"></div>
<input type="hidden" name="productamount[]" id="productamount1">
</td>
<td style="width:12%">
<div class="input-group">
<input type="number" name="discount[]" id="discount1" class="form-control" onchange="productcalc(1)" style="text-align:right" min="0" step="0.01">
<div class="input-group-append">
<select id="discountmode1" name="discountmode[]" class="form-control" data-live-search="true" onchange="productcalc(1)">
<option value="percentage">%</option>
<option value="rupee">₹</option>
</select>
</div>
</div>
<input type="hidden" name="discountamount[]" id="discountamount1">
<input type="hidden" name="discountamount[]" id="discountamount1">
<input type="hidden" name="pretotalamount[]" id="pretotalamount1">
<div id="discountresponse1"></div>
</td>
<td style="width:12%"><input type="number" name="gstper[]" id="gstper1" readonly class="form-control" style="text-align:right"><div id="gstresponse1"></div>
<input type="hidden" name="igstper[]" id="igstper1">
<input type="hidden" name="cgstper[]" id="cgstper1">
<input type="hidden" name="sgstper[]" id="sgstper1">
<input type="hidden" name="igstamount[]" id="igstamount1">
<input type="hidden" name="cgstamount[]" id="cgstamount1">
<input type="hidden" name="sgstamount[]" id="sgstamount1">
<input type="hidden" name="gstamount[]" id="gstamount1">
</td>
<td style="width:10%"><input type="number" name="totalamount[]" id="totalamount1" readonly class="form-control" style="text-align:right"><div id="totalamountresponse1"></div>
</td>
<td style="width:2%"><span class="tr_clone_add"><i class="fa fa-plus"></i></span></td>
</tr>
</table>
</div>
<div class="row">
<div class="col-lg-8">

</div>
<div class="col-lg-4">

<div class="form-group row">
    <label for="subtotalamount" class="col-sm-4 col-form-label text-right">Sub Total Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="subtotalamount" name="subtotalamount" style="text-align:right" >
    </div>
  </div>
<div class="form-group row">
    <label for="totalgstamount" class="col-sm-4 col-form-label text-right">Total GST Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="totalgstamount" name="totalgstamount" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="netamount" class="col-sm-4 col-form-label text-right">Net Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="netamount" name="netamount" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="shippingamount" class="col-sm-4 col-form-label text-right">Shipping Charges</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="shippingamount" name="shippingamount" onChange="productnet()" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="grandtotal" class="col-sm-4 col-form-label text-right font-weight-bold">Grand Total (₹)</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="grandtotal" name="grandtotal" style="text-align:right" >
    </div>
  </div>

</div>
</div>
<!--end product table-->
<!--start scrap table--><div class="table-responsive">
<table class="table table-bordered" id="table-data">
<tr>
<th>SCRAP</th><th>QTY</th><th>RATE</th><th>TAX</th><th>AMOUNT</th><th></th>
</tr>
<tr class="tr_clone">
<!--th><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="32"></th-->
<td>
<select class="form-control fav_clr stockitem1" id="stockitem1" name="stockitem[]" onchange="stockitemchange(1)">
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, stockitem From jrcproduct where price!='' order by stockitem asc limit 10";
$querygo = mysqli_query($connection, $sqlgo);
$rowCountgo = mysqli_num_rows($querygo);
if(!$querygo){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountgo > 0)
{
$count=1;
while($rowgo = mysqli_fetch_array($querygo))
{
?>
<option value="<?=$rowgo['id']?>"><?=$rowgo['stockitem']?></option>
<?php
}
}
?>
</select>
<div id="productresponse1"></div>
</td>



<td style="width:8%"><input type="number" name="qty[]" id="qty1" class="form-control" min="0" onchange="productcalc(1);" style="text-align:right">  <span href="#" data-toggle="modal" data-target="#serialmodal" onclick="updateauto()"></span>  
<input type="hidden" name="serialnumber[]" id="serialnumber1">
<input type="hidden" name="department[]" id="department1">
</td>
<td style="width:10%"><input type="number" name="rate[]" id="rate1" class="form-control" min="0" step="0.01" onchange="productcalc(1)" style="text-align:right"><div id="rateresponse1"></div><div id="ratecresponse1"></div>
<input type="hidden" name="productamount[]" id="productamount1">
</td>
<td style="width:12%"><input type="number" name="gstper[]" id="gstper1" readonly class="form-control" style="text-align:right"><div id="gstresponse1"></div>
<input type="hidden" name="igstper[]" id="igstper1">
<input type="hidden" name="cgstper[]" id="cgstper1">
<input type="hidden" name="sgstper[]" id="sgstper1">
<input type="hidden" name="igstamount[]" id="igstamount1">
<input type="hidden" name="cgstamount[]" id="cgstamount1">
<input type="hidden" name="sgstamount[]" id="sgstamount1">
<input type="hidden" name="gstamount[]" id="gstamount1">
</td>
<td style="width:10%"><input type="number" name="totalamount[]" id="totalamount1" readonly class="form-control" style="text-align:right"><div id="totalamountresponse1"></div>
</td>
<td style="width:2%"><span class="tr_clone_add"><i class="fa fa-plus"></i></span></td>
</tr>
</table>
</div>
<div class="row">
<div class="col-lg-8">

</div>
<div class="col-lg-4">

<div class="form-group row">
    <label for="subtotalamount" class="col-sm-4 col-form-label text-right">Sub Total Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="subtotalamount" name="subtotalamount" style="text-align:right" >
    </div>
  </div>
<div class="form-group row">
    <label for="totalgstamount" class="col-sm-4 col-form-label text-right">Total GST Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="totalgstamount" name="totalgstamount" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="netamount" class="col-sm-4 col-form-label text-right">Net Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="netamount" name="netamount" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="shippingamount" class="col-sm-4 col-form-label text-right">Shipping Charges</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="shippingamount" name="shippingamount" onChange="productnet()" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="grandtotal" class="col-sm-4 col-form-label text-right font-weight-bold">Grand Total (₹)</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="grandtotal" name="grandtotal" style="text-align:right" >
    </div>
  </div>

</div>
</div>
<!--end scrap table-->


<div class="row">
<div class="col-lg-12">
<input type="submit" name="submit" id="submit" value="Submit">
</div>
</div>



</form>
</div>
</div>
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
<!-- Page level plugins -->
<script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<!-- Page level plugins -->
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="../../1637028036/js/datatables.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$( "#topsearch" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});

$( "#tender" ).autocomplete({
source: 'tallysearch.php?type=tender&table=jrctender',
});
$( "#otherreference" ).autocomplete({
source: 'tallysearch.php?type=assest&table=jrcassest',
});
$( "#pono" ).autocomplete({
source: 'tallysearch.php?type=pono&table=jrcreference',
});
$( "#prstockmaincategory" ).autocomplete({
source: 'productsearch.php?type=stockmaincategory',
});
$( "#prstocksubcategory" ).autocomplete({
source: 'productsearch.php?type=stocksubcategory',
});
$( "#prstockitem" ).autocomplete({
source: 'productsearch.php?type=stockitem',
});
$( "#prtypeofproduct" ).autocomplete({
source: 'productsearch.php?type=typeofproduct',
});
$( "#prcomponenttype" ).autocomplete({
source: 'productsearch.php?type=componenttype',
});
$( "#prcomponentname" ).autocomplete({
source: 'productsearch.php?type=componentname',
});
$( "#prmake" ).autocomplete({
source: 'productsearch.php?type=make',
});
$( "#prcapacity" ).autocomplete({
source: 'productsearch.php?type=capacity',
});
$( "#consigneename" ).autocomplete({
//source: 'consigneesearch.php?type=consigneename',
source: 'consearch.php', select: function (event, ui) { $("#consigneename").val(ui.item.value);$("#consigneeid").val(ui.item.id); $("#address1").val(ui.item.address1); $("#address2").val(ui.item.address2); $("#address3").val(ui.item.area);$("#district").val(ui.item.district);$("#pincode").val(ui.item.pincode);$("#mail").val(ui.item.email);$("#mobile").val(ui.item.mobile);$("#contact").val(ui.item.contact);$("#phone").val(ui.item.phone);$("#gst").val(ui.item.gstno);$("#state").val(ui.item.statecode);$("#rtype").val(ui.item.gsttype);$("#maincategory").val(ui.item.maincategory);$("#subcategory").val(ui.item.subcategory);$("#department").val(ui.item.department);}, minLength: 3
});
/* $('#table-data').on('click', '.tr_clone_add', function() {
var $tr    = $(this).closest('.tr_clone');
var $clone = $tr.clone();
$tr.after($clone);
}); */
$("#table-data").on('click', '.tr_clone_add', function() {
$('.stockitem1').select2("destroy");
var $tr = $(this).closest('.tr_clone');
var allTrs = $tr.closest('table').find('tr');
var lastTr = allTrs[allTrs.length-1];
var $clone = $(lastTr).clone();
var curid=1;
$clone.find('td').each(function(){
var el = $(this).find(':first-child');
var id = el.attr('id') || null;
if(id) {
var i = id.substr(id.length-1);
var prefix = id.substr(0, (id.length-1));
el.attr('id', prefix+(+i+1));
curid=i;
}
});
var oldcurid=curid;
curid++;
$clone.find('input').val('');
$clone.find('#productresponse'+oldcurid).attr("id", "productresponse"+curid);
$clone.find('#rateresponse'+oldcurid).attr("id", "rateresponse"+curid);
$clone.find('#ratecresponse'+oldcurid).attr("id", "ratecresponse"+curid);
$clone.find('#gstresponse'+oldcurid).attr("id", "gstresponse"+curid);
$clone.find('#totalamountresponse'+oldcurid).attr("id", "totalamountresponse"+curid);
$clone.find('#productamount'+oldcurid).attr("id", "productamount"+curid);
$clone.find('#discountresponse'+oldcurid).attr("id", "discountresponse"+curid);
$clone.find('#discount'+oldcurid).attr("id", "discount"+curid);
$clone.find('#discountmode'+oldcurid).attr("id", "discountmode"+curid);
$clone.find('#discountamount'+oldcurid).attr("id", "discountamount"+curid);
$clone.find('#pretotalamount'+oldcurid).attr("id", "pretotalamount"+curid);
$clone.find('#igstper'+oldcurid).attr("id", "igstper"+curid);
$clone.find('#cgstper'+oldcurid).attr("id", "cgstper"+curid);
$clone.find('#sgstper'+oldcurid).attr("id", "sgstper"+curid);
$clone.find('#igstamount'+oldcurid).attr("id", "igstamount"+curid);
$clone.find('#cgstamount'+oldcurid).attr("id", "cgstamount"+curid);
$clone.find('#sgstamount'+oldcurid).attr("id", "sgstamount"+curid);
$clone.find('#gstamount'+oldcurid).attr("id", "gstamount"+curid);
$clone.find('#serialnumber'+oldcurid).attr("id", "serialnumber"+curid);
$clone.find('#department'+oldcurid).attr("id", "department"+curid);
$clone.html(function(i, oldHTML) {
return oldHTML.replace("stockitemchange("+oldcurid+")", "stockitemchange("+curid+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("serialnumbers("+oldcurid+")", "serialnumbers("+curid+")");
});
for(var k=0;k<4;k++)
{
$clone.html(function(i, oldHTML) {
return oldHTML.replace("productcalc("+oldcurid+")", "productcalc("+curid+")");
});
}
$tr.closest('table').append($clone);
$(".stockitem1").select2({
width: '100%',
ajax: {
url: "productsalesearch.php",
type: "post",
dataType: 'json',
delay: 0,
data: function (params) {
return {
searchTerm: params.term // search term
};
console.log(response);
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});
console.log(curid);
//$("#stockitem"+curid).last().next().next().remove();
$("#productresponse"+curid).empty();
$("#gstresponse"+curid).empty();
$("#rateresponse"+curid).empty();
$("#ratecresponse"+curid).empty();
$("#discountresponse"+curid).empty();
$(this).remove();
});
});
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
$(document).on("keypress", 'form', function (e) {
var code = e.keyCode || e.which;
if (code == 13) {
e.preventDefault();
return false;
}
});
</script>
<script>
$(document).ready(function(){

$(".stockitem1").select2({
width: '100%',
ajax: {
url: "productsalesearch.php",
type: "post",
dataType: 'json',
delay: 0,
data: function (params) {
return {
searchTerm: params.term // search term
};
console.log(response);
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});
});
</script>
<script>
function stockitemchange(ids)
{
var stockitem = $("#stockitem"+ids).val();
var datase='se';
$.ajax({
url: 'productsalesearch.php',
type: 'post',
data: {stockitem:stockitem},
dataType: 'json',
success:function(response)
{
console.log(response);
var len = response.length;
$("#productresponse"+ids).empty();
$("#rateresponse"+ids).empty();
$("#ratecresponse"+ids).empty();
$("#gstresponse"+ids).empty();
for( var i = 0; i<len; i++){
$("#productresponse"+ids).append(stockitem);
var productid = response[i]['productid'];
var stockmaincategory = response[i]['stockmaincategory'];
var stocksubcategory = response[i]['stocksubcategory'];
var stockitem = response[i]['stockitem'];
var typeofproduct = response[i]['typeofproduct'];
var componenttype = response[i]['componenttype'];
var componentname = response[i]['componentname'];
var make = response[i]['make'];
var capacity = response[i]['capacity'];
var warranty = response[i]['warranty'];
var description = response[i]['description'];
var price= response[i]['price'];
var minprice= response[i]['minprice'];
var gst= response[i]['gst'];
var currentstock= response[i]['currentstock'];
var type= response[i]['type'];
var sku= response[i]['sku'];
var unit= response[i]['unit'];
var hsncode= response[i]['hsncode'];
var taxpreference= response[i]['taxpreference'];
var gstpercentage= response[i]['gstpercentage'];
var igstpercentage= response[i]['igstpercentage'];
var availablestock=response[i]['availablestock'];
var customprice=response[i]['customprice'];
var productresponse1='';
productresponse1+='<div class="mt-1 text-primary mb-"+ids>Product Information <input type="hidden" name="productmainid[]" id="productmainid'+ids+'"></div><input type="hidden" name="productid[]" id="productid'+ids+'"><input type="hidden" name="stockmaincategory[]" id="stockmaincategory'+ids+'"><input type="hidden" name="stocksubcategory[]" id="stocksubcategory'+ids+'"><input type="hidden" name="typeofproduct[]" id="typeofproduct'+ids+'"><input type="hidden" name="stockname[]" id="stockname'+ids+'"><input type="hidden" name="componenttype[]" id="componenttype'+ids+'"><input type="hidden" name="componentname[]" id="componentname'+ids+'"><input type="hidden" name="make[]" id="make'+ids+'"><input type="hidden" name="capacity[]" id="capacity'+ids+'"><input type="hidden" name="warranty[]" id="warranty'+ids+'"><input type="hidden" name="description[]" id="description'+ids+'"><input type="hidden" name="price[]" id="price'+ids+'"><input type="hidden" name="minprice[]" id="minprice'+ids+'"><input type="hidden" name="gst[]" id="gst'+ids+'"><input type="hidden" name="currentstock[]" id="currentstock'+ids+'"><input type="hidden" name="type[]" id="type'+ids+'"><input type="hidden" name="sku[]" id="sku'+ids+'"><input type="hidden" name="unit[]" id="unit'+ids+'"><input type="hidden" name="hsncode[]" id="hsncode'+ids+'"><input type="hidden" name="taxpreference[]" id="taxpreference'+ids+'"><input type="hidden" name="gstpercentage[]" id="gstpercentage'+ids+'"><input type="hidden" name="igstpercentage[]" id="igstpercentage'+ids+'">';
if(type!='')
{
productresponse1+='<span class="bg-success text-white" style="padding:2px; border-radius:5px;">'+type+'</span>';
}
productresponse1+='<div class="row">';
if(description!='')
{
productresponse1+='<div class="col-lg-12"><span class="font-italic">Description: </span> <textarea id="productdescription"+ids name="productdescription[]" class="form-control">'+description+'</textarea></div>';
}
if(stockmaincategory!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Main Category: </span> '+stockmaincategory+'</div>';
}
if(stocksubcategory!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Sub Category: </span> '+stocksubcategory+'</div>';
}
if(typeofproduct!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Type of Product: </span> '+typeofproduct+'</div>';
}
if(componenttype!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Component Type: </span> '+componenttype+'</div>';
}
if(componentname!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Component Name: </span> '+componentname+'</div>';
}
if(make!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Make: </span> '+make+'</div>';
}
if(capacity!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Capacity: </span> '+capacity+'</div>';
}
if(warranty!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Warranty: </span> '+warranty+'</div>';
}
if(sku!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">SKU: </span> '+sku+'</div>';
}
if(unit!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Unit: </span> '+unit+'</div>';
}
if(hsncode!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">HSN Code: </span> '+hsncode+'</div>';
}
if(taxpreference!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Tax Preference: </span> '+taxpreference+'</div>';
}
if(gstpercentage!='')
{
productresponse1+='<div class="col-lg-3"><span class="font-italic">GST %: </span> '+gstpercentage+'</div>';
}
if(igstpercentage!='')
{
productresponse1+='<div class="col-lg-3"><span class="font-italic">IGST%: </span> '+igstpercentage+'</div>';
}
productresponse1+='</div>';99
$("#productresponse"+ids).append(productresponse1);
$("#productid"+ids).val(productid);
$("#type"+ids).val(type);
$("#description"+ids).val(description);
$("#stockmaincategory"+ids).val(stockmaincategory);
$("#stocksubcategory"+ids).val(stocksubcategory);
$("#stockname"+ids).val(stockitem);
$("#typeofproduct"+ids).val(typeofproduct);
$("#componenttype"+ids).val(componenttype);
$("#componentname"+ids).val(componentname);
$("#make"+ids).val(make);
$("#capacity"+ids).val(capacity);
$("#warranty"+ids).val(warranty);
$("#price"+ids).val(price);
$("#rate"+ids).val(price);
if(customprice!=price)
{
//$("#rateresponse"+ids).append('Original: <span class="text-danger">'+price+'</span><br>Modified: <span class="text-success">'+customprice+'</span>');
$("#rate"+ids).val(customprice);
}
$("#minprice"+ids).val(minprice);
$("#gst"+ids).val(gst);
$("#gstper"+ids).val(gst);
$("#currentstock"+ids).val(currentstock);
$("#sku"+ids).val(sku);
$("#unit"+ids).val(unit);
$("#hsncode"+ids).val(hsncode);
$("#taxpreference"+ids).val(taxpreference);
$("#gstpercentage"+ids).val(gstpercentage);
$("#igstpercentage"+ids).val(igstpercentage);
productcalc(ids);
}
}
});
}
</script>
<script>
function provalupdate(ids)
{
$("#prtaxpreference").val($("#taxpreference"+ids).val());
$("#prproductid").val($("#productid"+ids).val());
if($("#type"+ids).val()=="Service")
{
$("#prtypeservice").attr('checked', 'checked');
}
else
{
$("#prtypegoods").attr('checked', 'checked');
}
$("#prdescription").val($("#description"+ids).val());
$("#prstockmaincategory").val($("#stockmaincategory"+ids).val());
$("#prstocksubcategory").val($("#stocksubcategory"+ids).val());
$("#prstockitem").val($("#stockname"+ids).val());
$("#prtypeofproduct").val($("#typeofproduct"+ids).val());
$("#prcomponenttype").val($("#componenttype"+ids).val());
$("#prcomponentname").val($("#componentname"+ids).val());
$("#prmake").val($("#make"+ids).val());
$("#prcapacity").val($("#capacity"+ids).val());
$("#prwarranty").val($("#warranty"+ids).val());
$("#prprice").val($("#price"+ids).val());
$("#prrate").val($("#price"+ids).val());
$("#prminprice").val($("#minprice"+ids).val());
$("#prgst").val($("#gst"+ids).val());
$("#prgstper").val($("#gst"+ids).val());
$("#prcurrentstock").val($("#currentstock"+ids).val());
$("#prsku").val($("#sku"+ids).val());
$("#prunit").val($("#unit"+ids).val());
$("#prhsncode").val($("#hsncode"+ids).val());
$("#prtaxpreference").val($("#taxpreference"+ids).val());
$("#prgstpercentage").val($("#gstpercentage"+ids).val());
$("#prigstpercentage").val($("#igstpercentage"+ids).val());
$('input[name="prchsubmit"]').attr('id','prtag-form-submit'+ids);
}
</script>
<script>
function productformsubmit(curid)
{
var ids = curid.replace("prtag-form-submit", "");
$.ajax({
type: "POST",
url: "producteditsajax.php",
data: $('#prtagForm').serialize(),
dataType:'json',
success: function(response) {
console.log(response);
var len = response.length;
$('#productmodal').modal('toggle');
$("#productresponse"+ids).empty();
for( var i = 0; i<len; i++){
$("#productresponse"+ids).append(stockitem);
var productid = response[i]['productid'];
var stockmaincategory = response[i]['stockmaincategory'];
var stocksubcategory = response[i]['stocksubcategory'];
var stockitem = response[i]['stockitem'];
var typeofproduct = response[i]['typeofproduct'];
var componenttype = response[i]['componenttype'];
var componentname = response[i]['componentname'];
var make = response[i]['make'];
var capacity = response[i]['capacity'];
var warranty = response[i]['warranty'];
var description = response[i]['description'];
var price= response[i]['price'];
var minprice= response[i]['minprice'];
var gst= response[i]['gst'];
var currentstock= response[i]['currentstock'];
var type= response[i]['type'];
var sku= response[i]['sku'];
var unit= response[i]['unit'];
var hsncode= response[i]['hsncode'];
var taxpreference= response[i]['taxpreference'];
var gstpercentage= response[i]['gstpercentage'];
var igstpercentage= response[i]['igstpercentage'];
var availablestock=response[i]['availablestock'];
var productresponse1='';
productresponse1+='<div class="mt-1 text-primary mb-"+ids>Product Information <input type="hidden" name="productmainid[]" id="productmainid'+ids+'"></div><input type="hidden" name="productid[]" id="productid'+ids+'"><input type="hidden" name="stockmaincategory[]" id="stockmaincategory'+ids+'"><input type="hidden" name="stocksubcategory[]" id="stocksubcategory'+ids+'"><input type="hidden" name="stockname[]" id="stockname'+ids+'"><input type="hidden" name="typeofproduct[]" id="typeofproduct'+ids+'"><input type="hidden" name="componenttype[]" id="componenttype'+ids+'"><input type="hidden" name="componentname[]" id="componentname'+ids+'"><input type="hidden" name="make[]" id="make'+ids+'"><input type="hidden" name="capacity[]" id="capacity'+ids+'"><input type="hidden" name="warranty[]" id="warranty'+ids+'"><input type="hidden" name="description[]" id="description'+ids+'"><input type="hidden" name="price[]" id="price'+ids+'"><input type="hidden" name="minprice[]" id="minprice'+ids+'"><input type="hidden" name="gst[]" id="gst'+ids+'"><input type="hidden" name="currentstock[]" id="currentstock'+ids+'"><input type="hidden" name="type[]" id="type'+ids+'"><input type="hidden" name="sku[]" id="sku'+ids+'"><input type="hidden" name="unit[]" id="unit'+ids+'"><input type="hidden" name="hsncode[]" id="hsncode'+ids+'"><input type="hidden" name="taxpreference[]" id="taxpreference'+ids+'"><input type="hidden" name="gstpercentage[]" id="gstpercentage'+ids+'"><input type="hidden" name="igstpercentage[]" id="igstpercentage'+ids+'">';
if(type!='')
{
productresponse1+='<span class="bg-success text-white" style="padding:2px; border-radius:5px;">'+type+'</span>';
}
productresponse1+='<div class="row">';
if(description!='')
{
productresponse1+='<div class="col-lg-12"><span class="font-italic">Description: </span> <textarea id="productdescription"+ids name="productdescription[]" class="form-control">'+description+'</textarea></div>';
}
if(stockmaincategory!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Main Category: </span> '+stockmaincategory+'</div>';
}
if(stocksubcategory!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Sub Category: </span> '+stocksubcategory+'</div>';
}
if(typeofproduct!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Type of Product: </span> '+typeofproduct+'</div>';
}
if(componenttype!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Component Type: </span> '+componenttype+'</div>';
}
if(componentname!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Component Name: </span> '+componentname+'</div>';
}
if(make!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Make: </span> '+make+'</div>';
}
if(capacity!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Capacity: </span> '+capacity+'</div>';
}
if(warranty!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Warranty: </span> '+warranty+'</div>';
}
if(sku!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">SKU: </span> '+sku+'</div>';
}
if(unit!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Unit: </span> '+unit+'</div>';
}
if(hsncode!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">HSN Code: </span> '+hsncode+'</div>';
}
if(taxpreference!='')
{
productresponse1+='<div class="col-lg-6"><span class="font-italic">Tax Preference: </span> '+taxpreference+'</div>';
}
if(gstpercentage!='')
{
productresponse1+='<div class="col-lg-3"><span class="font-italic">GST %: </span> '+gstpercentage+'</div>';
}
if(igstpercentage!='')
{
productresponse1+='<div class="col-lg-3"><span class="font-italic">IGST %: </span> '+igstpercentage+'</div>';
}
productresponse1+='</div>';
$("#productresponse"+ids).append(productresponse1);
$("#productid"+ids).val(productid);
$("#type"+ids).val(type);
$("#description"+ids).val(description);
$("#stockmaincategory"+ids).val(stockmaincategory);
$("#stocksubcategory"+ids).val(stocksubcategory);
$("#stockname"+ids).val(stockitem);
$("#typeofproduct"+ids).val(typeofproduct);
$("#componenttype"+ids).val(componenttype);
$("#componentname"+ids).val(componentname);
$("#make"+ids).val(make);
$("#capacity"+ids).val(capacity);
$("#warranty"+ids).val(warranty);
$("#price"+ids).val(price);
$("#rate"+ids).val(price);
$("#minprice"+ids).val(minprice);
$("#gst"+ids).val(gst);
$("#gstper"+ids).val(gst);
$("#currentstock"+ids).val(currentstock);
$("#sku"+ids).val(sku);
$("#unit"+ids).val(unit);
$("#hsncode"+ids).val(hsncode);
$("#taxpreference"+ids).val(taxpreference);
$("#gstpercentage"+ids).val(gstpercentage);
$("#igstpercentage"+ids).val(igstpercentage);
stockitemchange(ids);
}
},
error: function() {
alert('Error');
}
});
return false;
}
</script>


<script>
function cleartext()
{
var str=document.getElementById("latlong").value;
var result = str.replace(/[^0-9\.,]/g, "");
document.getElementById("latlong").value=result;
}
function openaddress()
{
var address1=document.getElementById("address1").value;
var address2=document.getElementById("address2").value;
var area=document.getElementById("area").value;
var district=document.getElementById("district").value;
var pincode=document.getElementById("pincode").value;
window.open("maplatlong.php?address="+address1+" "+address2+" "+area+" "+district+" "+pincode+" ", "_blank");
}
</script>
<script>
function taxable()
{
var taxpreference=document.getElementById("prtaxpreference").value;
var gstdiv=document.getElementById("prgstdiv");
var igstdiv=document.getElementById("prigstdiv");
var exemptiondiv=document.getElementById("prexemptiondiv");
var gstpercentage = document.getElementById("prgstpercentage");
var igstpercentage = document.getElementById("prigstpercentage");
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
function perchange(id)
{
// Get the select elements
var gstpercentage = document.getElementById("prgstpercentage");
var igstpercentage = document.getElementById("prigstpercentage");
if(id=="prgstpercentage")
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

<script>
function productcalc(id)
{
var consigneename=document.getElementById("consigneename");
var stockitem=document.getElementById("stockitem"+id);
var qty=document.getElementById("qty"+id);
var rate=document.getElementById("rate"+id);
var productamount=document.getElementById("productamount"+id);
var discount=document.getElementById("discount"+id);
var discountmode=document.getElementById("discountmode"+id);
var discountamount=document.getElementById("discountamount"+id);
var pretotalamount=document.getElementById("pretotalamount"+id);
var gstper=document.getElementById("gstper"+id);
var cgstper=document.getElementById("cgstper"+id);
var sgstper=document.getElementById("sgstper"+id);
var igstper=document.getElementById("igstper"+id);
var gstamount=document.getElementById("gstamount"+id);
var cgstamount=document.getElementById("cgstamount"+id);
var sgstamount=document.getElementById("sgstamount"+id);
var igstamount=document.getElementById("igstamount"+id);
var totalamount=document.getElementById("totalamount"+id);
var totalamount=document.getElementById("totalamount"+id);
//var statecode=document.getElementById("statecode");
var companystatecode='<?=$_SESSION['companystatecode']?>';

$("#totalamountresponse1").empty();
if(stockitem.value=='')
{
alert("Please Select the Product");
stockitem.focus();
}
else
{
	
if((qty.value!='')&&(rate.value!=''))
{
	console.log(qty.value);
var productamt=parseFloat(qty.value)*parseFloat(rate.value);
var qty=parseFloat(qty.value)*parseFloat(rate.value);

$("#productamount"+id).val(productamt);
$("#ratecresponse"+id).html('Total: '+productamt.toFixed(2));
pretotalamount.value=productamt.toFixed(2);
var discountamt=0;
if(discount.value!='')
{
if(discountmode.value=='percentage')
{
discountamt=((parseFloat(discount.value)*parseFloat(productamt))/100);
}
else
{
discountamt=parseFloat(discount.value);
}
$("#discountamount"+id).val(discountamt);
$("#discountresponse"+id).html('Discount: -'+discountamt.toFixed(2)+'<br>Pre Total: '+(productamt-discountamt).toFixed(2));
pretotalamount.value=(productamt-discountamt).toFixed(2);
}
var gsta=0;
if(gstper.value!='')
{
var gstp=parseFloat(gstper.value);

cgstper.value=(gstp/2).toFixed(2);
sgstper.value=(gstp/2).toFixed(2);
igstper.value='';
gsta=((parseFloat(gstper.value)*parseFloat((productamt-discountamt)))/100);
cgstamount.value=(gsta/2).toFixed(2);
sgstamount.value=(gsta/2).toFixed(2);
gstamount.value=gsta.toFixed(2);
igstamount.value='';
$("#gstresponse"+id).html('CGST('+(gstp/2)+'%): '+(gsta/2).toFixed(2)+'<br>SGST('+(gstp/2)+'%): '+(gsta/2).toFixed(2));
	
}
totalamount.value=((productamt-discountamt)+gsta).toFixed(2);
}

else
{
$("#productamount"+id).val('');
}
}


 productnet();
}
</script>
<script>
function productnet()
{
	var stockitems=document.getElementsByName("stockitem[]");
	var pretotalamounts=document.getElementsByName("pretotalamount[]");
	var gstamounts=document.getElementsByName("gstamount[]");
	var totalamounts=document.getElementsByName("totalamount[]");
	var qtys=document.getElementsByName("qty[]");
	//var totalitems=document.getElementById("totalitems");
	//var totalqty=document.getElementById("totalqty");
	var subtotalamount=document.getElementById("subtotalamount");
	var totalgstamount=document.getElementById("totalgstamount");
	var netamount=document.getElementById("netamount");
	//var shippingamount=document.getElementById("shippingamount");
	var grandtotal=document.getElementById("grandtotal");
	var toti=0;
	var totq=0;
	var suba=0;
	var gsta=0;
	var neta=0;
	var shia=0;
	var graa=0;
	for(var i=0;i<stockitems.length;i++)
	{
		if(stockitems[i].value!='')
		{
			toti++;
		}
		if(qtys[i].value!='')
		{
			totq+=parseFloat(qtys[i].value);
		}
	    if(pretotalamounts[i].value!='')
		{
			suba+=parseFloat(pretotalamounts[i].value);
		}
	    if(gstamounts[i].value!='')
		{
			gsta+=parseFloat(gstamounts[i].value);
		}
	    if(totalamounts[i].value!='')
		{
			neta+=parseFloat(totalamounts[i].value);
		}		
	}
	//totalitems.value=toti.toFixed(2);
	//totalqty.value=totq.toFixed(2);
	subtotalamount.value=suba.toFixed(2);
	totalgstamount.value=gsta.toFixed(2);
	netamount.value=neta.toFixed(2);
	var ship=0;
	if(shippingamount.value=='')
	{
		ship=0;
	}
	else
	{
		//ship=parseFloat(shippingamount.value);
	}
	grandtotal.value=(neta+ship).toFixed(2);
	
}
</script>


<?php include('additionaljs.php');   ?>
</body>
</html>