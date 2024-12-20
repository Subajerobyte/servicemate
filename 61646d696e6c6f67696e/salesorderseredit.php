<?php
include('lcheck.php');
if($salesorder=='0')
{
header("Location: dashboard.php");
}
if(isset($_POST['btnsubmit']))
{
$dname=date('Y-m-d-h-i-s-a');
$createdon=date('Y-m-d h:i:s a');
$noofconsignee=mysqli_real_escape_string($connection,$_POST['noofconsignee']);
$sqls=mysqli_query($connection,"select serviceinvoice from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['serviceinvoice']+1;
$invoicenoto=(float)$infos['serviceinvoice']+(float)$noofconsignee;
$invoicedate=mysqli_real_escape_string($connection,$_POST['invoicedate']);
$maincategory=mysqli_real_escape_string($connection,$_POST['maincategory']);
$tender=mysqli_real_escape_string($connection,$_POST['tender']);
$subcategory=mysqli_real_escape_string($connection,$_POST['subcategory']);
$department=mysqli_real_escape_string($connection,$_POST['department']);
$otherreference=mysqli_real_escape_string($connection,$_POST['otherreference']);
$pono=mysqli_real_escape_string($connection,$_POST['pono']);
$podate=mysqli_real_escape_string($connection,$_POST['podate']);
$custreference=mysqli_real_escape_string($connection,$_POST['custreference']);
$duedays=mysqli_real_escape_string($connection,$_POST['duedays']);
$buyername=mysqli_real_escape_string($connection,$_POST['buyername']);
$buyeraddress1=mysqli_real_escape_string($connection,$_POST['buyeraddress1']);
$buyeraddress2=mysqli_real_escape_string($connection,$_POST['buyeraddress2']);
$buyeraddress3=mysqli_real_escape_string($connection,$_POST['buyeraddress3']);
$buyerstate=mysqli_real_escape_string($connection,$_POST['buyerstate']);
$rtype=mysqli_real_escape_string($connection,$_POST['rtype']);
$bgst=mysqli_real_escape_string($connection,$_POST['bgst']);
$reftime=mysqli_real_escape_string($connection,$_POST['reftime']);
if($reftime!='')
{
$sqllreftime=mysqli_query($connection,"DELETE FROM jrctallydrafts WHERE reftime='".$reftime."'");
}
for($i=0;$i<count($_POST['consigneeno']);$i++)
{
$consigneeno=mysqli_real_escape_string($connection,$_POST['consigneeno'][$i]);
$sono='SO / SER / '.(date('my')).' /'.(str_pad((float)$infos['serviceinvoice']+($consigneeno), 4, '0', STR_PAD_LEFT));
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename'][$i]);
$conaddress1=mysqli_real_escape_string($connection,$_POST['conaddress1'][$i]);
$conaddress2=mysqli_real_escape_string($connection,$_POST['conaddress2'][$i]);
$conaddress3=mysqli_real_escape_string($connection,$_POST['conaddress3'][$i]);
$contaluk=mysqli_real_escape_string($connection,$_POST['contaluk'][$i]);
$condistrict=mysqli_real_escape_string($connection,$_POST['condistrict'][$i]);
$conpincode=mysqli_real_escape_string($connection,$_POST['conpincode'][$i]);
$concontact=mysqli_real_escape_string($connection,$_POST['concontact'][$i]);
$conphone=mysqli_real_escape_string($connection,$_POST['conphone'][$i]);
$conmobile=mysqli_real_escape_string($connection,$_POST['conmobile'][$i]);
$conemail=mysqli_real_escape_string($connection,$_POST['conemail'][$i]);
$conprogroup=mysqli_real_escape_string($connection,$_POST['conprogroup'][$i]);
$conmultiple=mysqli_real_escape_string($connection,$_POST['conmultiple'][$i]);
$conproduct=mysqli_real_escape_string($connection,$_POST['conproduct'][$i]);
$conproductcode=mysqli_real_escape_string($connection,$_POST['conproductcode'][$i]);
$conmarketname=mysqli_real_escape_string($connection,$_POST['conmarketname'][$i]);
$conqty=mysqli_real_escape_string($connection,$_POST['conqty'][$i]);
$conunit=mysqli_real_escape_string($connection,$_POST['conunit'][$i]);
$conigst=mysqli_real_escape_string($connection,$_POST['conigst'][$i]);
$consgst=mysqli_real_escape_string($connection,$_POST['consgst'][$i]);
$concgst=mysqli_real_escape_string($connection,$_POST['concgst'][$i]);
$conigstamount=mysqli_real_escape_string($connection,$_POST['conigstamount'][$i]);
$consgstamount=mysqli_real_escape_string($connection,$_POST['consgstamount'][$i]);
$concgstamount=mysqli_real_escape_string($connection,$_POST['concgstamount'][$i]);
$contotal=mysqli_real_escape_string($connection,$_POST['contotal'][$i]);
$conwarranty=mysqli_real_escape_string($connection,$_POST['conwarranty'][$i]);
$sqls2=mysqli_query($connection,"INSERT INTO jrctallys(createdon, dname, noofconsignee, invoicenofrom, invoicenoto, invoicedate,sono, maincategory, tender, subcategory, department, otherreference, pono, podate, custreference, duedays, buyername, buyeraddress1, buyeraddress2, buyeraddress3, buyerstate, rtype, bgst, consigneeno, consigneename, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, concontact, conphone, conmobile, conemail, conprogroup, conmultiple, conproduct, conproductcode, conmarketname, conqty, conunit, conigst, consgst, concgst, conigstamount, consgstamount, concgstamount, contotal, conwarranty) VALUES ('$createdon', '$dname', '$noofconsignee', '$invoicenofrom', '$invoicenoto', '$invoicedate', '$sono', '$maincategory', '$tender', '$subcategory', '$department', '$otherreference', '$pono', '$podate', '$custreference', '$duedays', '$buyername', '$buyeraddress1', '$buyeraddress2', '$buyeraddress3', '$buyerstate', '$rtype', '$bgst', '$consigneeno', '$consigneename', '$conaddress1', '$conaddress2', '$conaddress3', '$contaluk', '$condistrict', '$conpincode', '$concontact', '$conphone', '$conmobile', '$conemail', '$conprogroup', '$conmultiple', '$conproduct', '$conproductcode', '$conmarketname', '$conqty', '$conunit', '$conigst', '$consgst', '$concgst', '$conigstamount', '$consgstamount', '$concgstamount', '$contotal', '$conwarranty')");
}
if($sqls2)
{
$sqls=mysqli_query($connection,"update jrcinvoice set serviceinvoice='$invoicenoto'");
header("Location:exporttallys.php?remarks=Added Successfully");
}
else
{
$error=mysqli_error($connection);
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Edit Service Sales Order</title>
<link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
.table td, .table th {
padding: 0rem;
vertical-align: middle;
text-align:center;
border-top: 1px solid #e3e6f0;
text-transform:uppercase;
}
::placeholder {
color: #cccccc;
opacity: 1; /* Firefox */
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
color: #cccccc;
}
::-ms-input-placeholder { /* Microsoft Edge */
color: #cccccc;
}
</style>
</head>
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php include('salesnavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Draft Service Sales Order</h1>
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
<?php if(isset($_GET['reftime']))	{
$reftime=mysqli_real_escape_string($connection,$_GET['reftime']);
$sqlselect = "SELECT * From jrctallydrafts where reftime='".$reftime."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowselect = mysqli_fetch_array($queryselect);
?>
<!-- DataTales Example -->
<?php
$noofconsignee=mysqli_real_escape_string($connection,$rowselect['noofconsignee']);



$sqls=mysqli_query($connection,"select serviceinvoice from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['serviceinvoice']+1;
$invoicenoto=(float)$infos['serviceinvoice']+(float)$noofconsignee;
?>
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Invoice Details</h6>
</div>
<div class="card-body">
<form action="" id="myForm1" method="post">
<input type="hidden" name="noofconsignee" id="noofconsignee" value="<?=$noofconsignee?>">
<input type="hidden" name="reftime" value="<?=$reftime?>">
<div class="row">
<div class="col-lg-4">
<div class="form-group">
<label for="invoicenofrom">Invoice Number</label>
<input type="text" class="form-control" id="invoicenofrom" name="invoicenofrom" placeholder="Invoice No" value="<?='SO / SER / '.(date('my')).' /'.(str_pad($invoicenofrom, 4, '0', STR_PAD_LEFT))?>">
</div>
</div>
<?php
if($invoicenofrom!=$invoicenoto)
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="invoicenofrom">Invoice Number (Upto)</label>
<input type="text" class="form-control" id="invoicenoto" name="invoicenoto" placeholder="Invoice No To" value="<?='SO / SER / '.(date('my')).' /'.(str_pad($invoicenoto, 4, '0', STR_PAD_LEFT))?>">
</div>
</div>
<?php
}
?>
<div class="col-lg-4">
<div class="form-group">
<label for="invoicedate">Invoice Date</label>
<input type="date" class="form-control" id="invoicedate" name="invoicedate" placeholder="Invoice Date" value="<?=$rowselect['invoicedate']?>">
</div>
</div>
</div>
<h5 class="mb-2">Buyer Information</h5>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="maincategory">Main Category</label>
<input type="text" class="form-control" id="maincategory" name="maincategory" value="<?=$rowselect['maincategory']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="tender">Tender</label>
<input type="text" class="form-control" id="tender" name="tender" value="<?=$rowselect['tender']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="subcategory">Sub Category</label>
<input type="text" class="form-control" id="subcategory" name="subcategory" value="<?=$rowselect['subcategory']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="department">Department Name</label>
<input type="text" class="form-control" id="department" name="department" value="<?=$rowselect['department']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="otherreference">Other Reference</label>
<input type="text" class="form-control" id="otherreference" name="otherreference" value="<?=$rowselect['otherreference']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="pono">P.O. No</label>
<input type="text" class="form-control" id="pono" name="pono" value="<?=$rowselect['pono']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="podate">P.O. Date</label>
<input type="date" class="form-control" id="podate" name="podate" value="<?=$rowselect['podate']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="custreference">Customer Reference ID</label>
<input type="text" class="form-control" id="custreference" name="custreference" value="<?=$rowselect['custreference']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="duedays">Due Days</label>
<input type="number" class="form-control" id="duedays" name="duedays" value="<?=$rowselect['duedays']?>">
</div>
</div>
<div class="col-lg-5">
<div class="form-group">
<label for="buyername">Buyer Name</label>
<input type="text" class="form-control" id="buyername" name="buyername" value="<?=$rowselect['buyername']?>">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyeraddress1">Address 1</label>
<input type="text" class="form-control" id="buyeraddress1" name="buyeraddress1" value="<?=$rowselect['buyeraddress1']?>">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyeraddress2">Address 2</label>
<input type="text" class="form-control" id="buyeraddress2" name="buyeraddress2" value="<?=$rowselect['buyeraddress2']?>">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyeraddress3">Address 3</label>
<input type="text" class="form-control" id="buyeraddress3" name="buyeraddress3" value="<?=$rowselect['buyeraddress3']?>">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyerstate">State</label>
<input type="text" class="form-control" id="buyerstate" name="buyerstate" value="<?=$rowselect['buyerstate']?>">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="rtype">Registration Type</label>
<select class="form-control" id="rtype" name="rtype">
<?php
$sqlsi=mysqli_query($connection, "select distinct rype from jrcregtype");
while($infosi=mysqli_fetch_array($sqlsi))
{
?>
<option value="<?=$infosi['rype']?>"><?=$infosi['rype']?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="bgst">GSTIN No</label>
<input type="text" class="form-control" id="bgst" name="bgst" value="<?=$rowselect['bgst']?>">
</div>
</div>
</div>
<h5 class="mb-2">Customer Information</h5> <label for="sameas" class="text-danger"><input type="checkbox" id="sameas" name="sameas" onchange="sameass()"> Customer Address Same as Buyer Address</label>
<div class="table-responsive">
<table class="table" id="table-data">
<thead>
<tr>
<th>No.</th>
<th>CONSIGNEE NAME</th><th>ADDRESS 1</th><th>ADDRESS 2</th><th>address 3</th><th>TALUK</th><th>DISTRICT </th><th>PIN CODE</th><th>Contact Person</th><th>PHONE NO.</th><th>MOBILE.NO.</th><th>MAIL ID</th><th></th><th></th><th>PRODUCT GROUP</th><th>MULTIPLE GODOWN</th><th>PRODUCT CODE</th><th>PRODUCT </th><th>MARKET NAME </th><th>QTY</th><th>Unit Price</th><th>IGST</th><th>SGST</th><th>CGST</th><th>IGST AMOUNT</th><th>SGST AMOUNT</th><th>CGST AMOUNT</th><th>TOTAL AMOUNT</th><th>warranty months</th>
</tr>
</thead>
<tbody id="tabletobdy">
<?php
for($i=1;$i<=$noofconsignee;$i++)
{
$sqlselect = "SELECT * From jrctallydrafts where reftime='".$reftime."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{

while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<tr class="tr_clone rowcount<?=$rowselect['consigneeno']?>">
<td><input type="hidden" class="consigneeno" id="consigneeno<?=$rowselect['consigneeno']?>" name="consigneeno[]" value="<?=$rowselect['consigneeno']?>"><span id="serial<?=$rowselect['consigneeno']?>"><?=$rowselect['consigneeno']?></span></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'consigneename')" class="consigneename" name="consigneename[]" id="consigneename<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consigneename']?>" placeholder="CONSIGNEE NAME (<?=$rowselect['consigneeno']?>)" tabindex="21"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress1')" class="conaddress1" name="conaddress1[]" id="conaddress1<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conaddress1']?>" placeholder="ADDRESS 1 (<?=$rowselect['consigneeno']?>)" tabindex="22"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress2')" class="conaddress2" name="conaddress2[]" id="conaddress2<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conaddress2']?>" placeholder="ADDRESS 2 (<?=$rowselect['consigneeno']?>)" tabindex="23"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress3')" class="conaddress3" name="conaddress3[]" id="conaddress3<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conaddress3']?>" placeholder="ADDRESS 3 (<?=$rowselect['consigneeno']?>)" tabindex="24"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'contaluk')" class="contaluk" name="contaluk[]" id="contaluk<?=$rowselect['consigneeno']?>" value="<?=$rowselect['contaluk']?>" placeholder="TALUK (<?=$rowselect['consigneeno']?>)" tabindex="25"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'condistrict')" class="condistrict" name="condistrict[]" id="condistrict<?=$rowselect['consigneeno']?>" value="<?=$rowselect['condistrict']?>" placeholder="DISTRICT (<?=$rowselect['consigneeno']?>)" tabindex="26"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conpincode')" class="conpincode" name="conpincode[]" id="conpincode<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conpincode']?>" placeholder="PIN CODE (<?=$rowselect['consigneeno']?>)" tabindex="27"  onKeyup="cleartext<?=$rowselect['consigneeno']?>()"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'concontact')" class="concontact" name="concontact[]" id="concontact<?=$rowselect['consigneeno']?>" value="<?=$rowselect['concontact']?>" placeholder="CONTACT PERSON (<?=$rowselect['consigneeno']?>)" tabindex="28"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conphone')"  class="conphone" name="conphone[]" id="conphone<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conphone']?>" placeholder="PHONE NO. (<?=$rowselect['consigneeno']?>)" tabindex="29"></td>
<td><input type="number" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conmobile')"  class="conmobile" name="conmobile[]" id="conmobile<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conmobile']?>" placeholder="MOBILE NO. (<?=$rowselect['consigneeno']?>)" tabindex="30"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conemail')"  class="conemail" name="conemail[]" id="conemail<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conemail']?>" placeholder="MAIL ID (<?=$rowselect['consigneeno']?>)" tabindex="31"></td>
<td><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="32"></td>
<td class="table-controls table-zapper"><button class="btnDeleteRow btn-zap" type="button" onclick="remfun(this)" disabled>&times;</button></td>
<td><input type="text" class="conprogroup" name="conprogroup[]" id="conprogroup<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conprogroup']?>" placeholder="PRODUCT GROUP (<?=$rowselect['consigneeno']?>)" tabindex="33"></td>
<td><input type="text" class="conmultiple" name="conmultiple[]" id="conmultiple<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conmultiple']?>" placeholder="MULTIPLE GODOWN (<?=$rowselect['consigneeno']?>)" tabindex="34"></td>
<td><input type="text" class="conproductcode" name="conproductcode[]" id="conproductcode<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conproductcode']?>" placeholder="PRODUCT (<?=$rowselect['consigneeno']?>)" tabindex="35"></td>
<td><input type="text" class="conproduct" name="conproduct[]" id="conproduct<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conproduct']?>" placeholder="PRODUCT (<?=$rowselect['consigneeno']?>)" tabindex="36"></td>
<td><input type="text" class="conmarketname" name="conmarketname[]" id="conmarketname<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conmarketname']?>" placeholder="PRODUCT (<?=$rowselect['consigneeno']?>)" tabindex="37"></td>
<td><input type="number" class="conqty" name="conqty[]" id="conqty<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conqty']?>" placeholder="QTY (<?=$rowselect['consigneeno']?>)" onchange="procalc(<?=$rowselect['consigneeno']?>)" tabindex="38"></td>
<td><input type="number" step="0.01" min="0" class="conunit" name="conunit[]" id="conunit<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conunit']?>" placeholder="UNIT PRICE  (<?=$rowselect['consigneeno']?>)" onchange="procalc(<?=$rowselect['consigneeno']?>)" tabindex="39"></td>
<td><input type="number" step="0.01" min="0" class="conigst" name="conigst[]" id="conigst<?=$rowselect['consigneeno']?>"  value="<?=$rowselect['conigst']?>" placeholder="IGST (<?=$rowselect['consigneeno']?>)" onchange="procalc(<?=$rowselect['consigneeno']?>)" tabindex="40"></td>
<td><input type="number" step="0.01" min="0" class="consgst" name="consgst[]" id="consgst<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consgst']?>" placeholder="SGST (<?=$rowselect['consigneeno']?>)" onchange="procalc(<?=$rowselect['consigneeno']?>)" tabindex="41"></td>
<td><input type="number" step="0.01" min="0" class="concgst" name="concgst[]" id="concgst<?=$rowselect['consigneeno']?>" value="<?=$rowselect['concgst']?>" placeholder="CGST (<?=$rowselect['consigneeno']?>)" onchange="procalc(<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="42"></td>
<td><input type="number" step="0.01" min="0" class="conigstamount" name="conigstamount[]" id="conigstamount<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conigstamount']?>" placeholder="IGST AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="43"></td>
<td><input type="number" step="0.01" min="0" class="consgstamount" name="consgstamount[]" id="consgstamount<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consgstamount']?>" placeholder="SGST AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="44"></td>
<td><input type="number" step="0.01" min="0" class="concgstamount" name="concgstamount[]" id="concgstamount<?=$rowselect['consigneeno']?>" value="<?=$rowselect['concgstamount']?>" placeholder="CGST AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="45"></td>
<td><input type="number" step="0.01" min="0" class="contotal" name="contotal[]" id="contotal<?=$rowselect['consigneeno']?>" value="<?=$rowselect['contotal']?>" placeholder="TOTAL AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="46"></td>
<td><input type="number" step="0.01" min="0" class="conwarranty" name="conwarranty[]" id="conwarranty<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conwarranty']?>" placeholder="WARRANTY MONTHS (<?=$rowselect['consigneeno']?>)" tabindex="47"></td>
</tr>
<?php

}
}
}
?>
</tbody>
</table>
</div>
<input class="btn btn-primary" type="submit" name="btnsubmit" value="Submit">
<div class="form-group">
<input type="hidden" name="post_id" id="post_id" />
<div id="autoSave" class="text-danger"></div>
</div>
</form>
</div>
</div>
<?php
}
?>
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
<script type="text/javascript">
$(function() {
$( "#topsearch" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
$( "#maincategory" ).autocomplete({
source: 'tallysearch.php?type=maincategory&table=jrccustcategory',
});
$( "#tender" ).autocomplete({
source: 'tallysearch.php?type=tender&table=jrctender',
});
$( "#subcategory" ).autocomplete({
//source: 'consigneesearch.php?type=subcategory',
source: 'tallysearch.php?type=subcategory&table=jrcsubcategory',
});
$( "#department" ).autocomplete({
source: 'consigneesearch.php?type=department',
});
$( "#buyername" ).autocomplete({
//source: 'consigneesearch.php?type=consigneename',
source: 'consearch.php', select: function (event, ui) { $("#buyername").val(ui.item.value); $("#buyeraddress1").val(ui.item.address1); $("#buyeraddress2").val(ui.item.address2); $("#buyeraddress3").val(ui.item.area);}, minLength: 3
});
$( "#otherreference" ).autocomplete({
source: 'tallysearch.php?type=assest&table=jrcassest',
});
$( "#buyerstate" ).autocomplete({
source: 'tallysearch.php?type=state&table=jrcdistrict',
});
$( "#buyeraddress3" ).autocomplete({
source: 'pincodesearch.php?type=officename',
});
$( "#pono" ).autocomplete({
source: 'tallysearch.php?type=pono&table=jrcreference',
});
$('#table-data').on('click', '.tr_clone_add', function() {
var $tr    = $(this).closest('.tr_clone');
var $clone = $tr.clone();
$clone.find('.btnDeleteRow').removeAttr("disabled");
$tr.after($clone);
var consigneeno=document.getElementsByName("consigneeno[]");
var consigneename=document.getElementsByName("consigneename[]");
var condistrict=document.getElementsByName("condistrict[]");
var conproduct=document.getElementsByName("conproduct[]");
var conproductcode=document.getElementsByName("conproductcode[]");
var conmarketname=document.getElementsByName("conmarketname[]");
var conaddress3=document.getElementsByName("conaddress3[]");
var contaluk=document.getElementsByName("contaluk[]");
var condistrict=document.getElementsByName("condistrict[]");
var conpincode=document.getElementsByName("conpincode[]");
for(var i=0;i<consigneeno.length;i++)
{
$( consigneename[i] ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( condistrict[i] ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( conproduct[i] ).autocomplete({
source: 'tallysearch.php?type=productname&table=jrcproducts',
});
$( conproductcode[i] ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( conmarketname[i] ).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct',
});
$( conaddress3[i] ).autocomplete({
source: 'pincodesearch.php?type=officename',
});
$( contaluk[i] ).autocomplete({
source: 'pincodesearch.php?type=taluk',
});
$( condistrict[i] ).autocomplete({
source: 'pincodesearch.php?type=district',
});
$( conpincode[i]).autocomplete({
source: 'pincodesearch.php?type=pincode',
});
}
});
<?php
if(isset($noofconsignee))
{
for($i=1;$i<=$noofconsignee;$i++)
{
?>
$( "#consigneename<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( "#condistrict<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( "#conprogroup<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
});
$( "#conmultiple<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=conmultiple&table=jrctallys',
});
$( "#conproductcode<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( "#conproduct<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=stockitem&table=jrcproduct',
});
$( "#conmarketname<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct',
});
$( "#conaddress3<?=$i?>" ).autocomplete({
source: 'pincodesearch.php?type=officename',
});
$( "#contaluk<?=$i?>" ).autocomplete({
source: 'pincodesearch.php?type=taluk',
});
$( "#condistrict<?=$i?>" ).autocomplete({
source: 'pincodesearch.php?type=district',
});
$( "#conpincode<?=$i?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'pincodesearch1.php?type=pincode', select: function (event, ui) { $("#conpincode<?=$i?>").val(ui.item.value); $("#contaluk<?=$i?>").val(ui.item.taluk); $("#condistrict<?=$i?>").val(ui.item.district);}, minLength: 3
});
$( "#conproductcode<?=$i?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'productsearch1.php?type=code', select: function (event, ui) { $("#conproductcode<?=$i?>").val(ui.item.value); $("#conproduct<?=$i?>").val(ui.item.stockitem); $("#conmarketname<?=$i?>").val(ui.item.marketname);}, minLength: 3
});
<?php
}
}
?>
});
</script>
<script>
function remfun(event)
{
if (!confirm('Are you sure want to delete?')) return false;
$(event).closest("tr").remove();
}
</script>
<script>
<?php
if(isset($noofconsignee))
{
for($i=1;$i<=$noofconsignee;$i++)
{
?>
function cleartext<?=$i?>()
{
var str=document.getElementById("conpincode<?=$i?>").value;
var result = str.replace(/[^0-9]/g, "");
document.getElementById("conpincode<?=$i?>").value=result;
}
<?php
}
}
?>
</script>
<script>
function sameass()
{
var sa=document.getElementById("sameas");
if(sa.checked==true)
{
var consigneeno=document.getElementsByName("consigneeno[]");
var consigneename=document.getElementsByName("consigneename[]");
var conaddress1=document.getElementsByName("conaddress1[]");
var conaddress2=document.getElementsByName("conaddress2[]");
var conaddress3=document.getElementsByName("conaddress3[]");
for(var i=0;i<consigneeno.length;i++)
{
consigneename[i].value=document.getElementById("buyername").value;
conaddress1[i].value=document.getElementById("buyeraddress1").value;
conaddress2[i].value=document.getElementById("buyeraddress2").value;
conaddress3[i].value=document.getElementById("buyeraddress3").value;
}
}
}
function procalc(id)
{
var consigneeno=document.getElementsByName("consigneeno[]");
var conqty=document.getElementsByName("conqty[]");
var conunit=document.getElementsByName("conunit[]");
var conigst=document.getElementsByName("conigst[]");
var consgst=document.getElementsByName("consgst[]");
var concgst=document.getElementsByName("concgst[]");
var conigstamount=document.getElementsByName("conigstamount[]");
var contotal=document.getElementsByName("contotal[]");
var consgstamount=document.getElementsByName("consgstamount[]");
var concgstamount=document.getElementsByName("concgstamount[]");
for(var i=0;i<consigneeno.length;i++)
{
var qty=conqty[i].value;
var unit=conunit[i].value;
var total=0;
var igst=conigst[i].value;
var sgst=consgst[i].value;
var cgst=concgst[i].value;
if((qty!='')&&(unit!=''))
{
total=parseFloat(qty)*parseFloat(unit);
if(igst!='')
{
var itax = total * (parseFloat(igst)/ 100);
conigstamount[i].value=itax.toFixed(2);
var ttotal=parseFloat(total)+parseFloat(itax);
contotal[i].value=ttotal.toFixed(2);
}
else
{
conigstamount[i].value='';
}
if(sgst!='')
{
concgst[i].value=sgst;
var stax = total * (parseFloat(sgst)/ 100);
var ctax = stax;
consgstamount[i].value=stax.toFixed(2);
concgstamount[i].value=stax.toFixed(2);
var ttax=parseFloat(stax)+parseFloat(ctax);
var ttotal=parseFloat(total)+parseFloat(ttax);
contotal[i].value=ttotal.toFixed(2);
}
else
{
consgstamount[i].value='';
concgstamount[i].value='';
}
}
else
{
conigstamount[i].value='';
concgstamount[i].value='';
consgstamount[i].value='';
contotal[i].value='';
}
}
}
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
/* function updatetransactions(){
var id = $('select option:selected').val();
$.ajax({
type:"post",
url:"updatetrans.php",
data:"status="+id,
success:function(data){
alert('Successfully updated mysql database');
}
});
} */
function changeconsigneeinfo(id, val, col)
{
var j=id;
var connames=document.getElementsByName(col+"[]");
for(var i=0;i<connames.length;i++)
{
var text=connames[i].id;
var k=text.replace(col, "");
if(j==k)
{
connames[i].value=val;
}
}
//updatetransactions();
}
</script>
<!-- Auto Submit Or Draft Values-->
<script>
$(document).ready(function(){
function autoSave()
{
/*
var form=$("#myForm");
var forms=$("#myForm1"); */
var dataString = $("#myForm1").serialize();
$.ajax({
url:"save_posts.php",
method:"POST",
data: dataString,
success: function(response){
console.log(response);
},
/* dataType:"text", */
success:function(data)
{
if(data != '')
{
$('#post_id').val(data);
}
$('#autoSave').text("Post save as draft");
setInterval(function(){
$('#autoSave').text('');
}, 10000);
}
});
}
setInterval(function(){
autoSave();
}, 10000);
});
</script>
<!-- Auto Submit Or Draft Values-->
<?php include('additionaljs.php');   ?>
</body>
</html>