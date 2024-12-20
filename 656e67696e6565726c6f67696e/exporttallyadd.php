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
$maxproduct=mysqli_real_escape_string($connection,$_POST['maxproduct']);
$sqls=mysqli_query($connection,"select invoiceno from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['invoiceno']+1;
$invoicenoto=(float)$infos['invoiceno']+(float)$noofconsignee;
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
$sqlselect = "SELECT reftime,id From jrctallydraft where reftime='".$reftime."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
$rowselect = mysqli_fetch_array($queryselect);
$sqllreftime=mysqli_query($connection,"DELETE FROM jrctallydraft WHERE reftime='".$rowselect['reftime']."'");
}
for($i=0;$i<count($_POST['consigneeno']);$i++)
{
$consigneeno=mysqli_real_escape_string($connection,$_POST['consigneeno'][$i]);
$sono='SO / REG / '.(date('my')).' /'.(str_pad((float)$infos['invoiceno']+($consigneeno), 4, '0', STR_PAD_LEFT));
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
$sqls2=mysqli_query($connection,"INSERT INTO jrctally(createdon, dname, noofconsignee, maxproduct, invoicenofrom, invoicenoto, invoicedate,sono, maincategory, tender, subcategory, department, otherreference, pono, podate, custreference, duedays, buyername, buyeraddress1, buyeraddress2, buyeraddress3, buyerstate, rtype, bgst, consigneeno, consigneename, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, concontact, conphone, conmobile, conemail, conprogroup, conmultiple, conproduct, conproductcode, conmarketname, conqty, conunit, conigst, consgst, concgst, conigstamount, consgstamount, concgstamount, contotal, conwarranty) VALUES ('$createdon', '$dname', '$noofconsignee', '$maxproduct', '$invoicenofrom', '$invoicenoto', '$invoicedate', '$sono', '$maincategory', '$tender', '$subcategory', '$department', '$otherreference', '$pono', '$podate', '$custreference', '$duedays', '$buyername', '$buyeraddress1', '$buyeraddress2', '$buyeraddress3', '$buyerstate', '$rtype', '$bgst', '$consigneeno', '$consigneename', '$conaddress1', '$conaddress2', '$conaddress3', '$contaluk', '$condistrict', '$conpincode', '$concontact', '$conphone', '$conmobile', '$conemail', '$conprogroup', '$conmultiple', '$conproduct', '$conproductcode', '$conmarketname', '$conqty', '$conunit', '$conigst', '$consgst', '$concgst', '$conigstamount', '$consgstamount', '$concgstamount', '$contotal', '$conwarranty')");
}
if($sqls2)
{
$sqls=mysqli_query($connection,"update jrcinvoice set invoiceno='$invoicenoto'");
header("Location:exporttally.php?remarks=Added Successfully");
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Add New Sales Order</title>
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
<h1 class="h4 mb-2 mt-2 text-gray-800">Add New Sales Order</h1>
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
<form action="" id="myForm" method="get">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label for="noofconsignee">Enter No of Customers</label>
<input type="text" class="form-control" id="noofconsignee" name="noofconsignee" placeholder="Enter No of Customers" value="<?=(isset($_GET['noofconsignee']))?$_GET['noofconsignee']:''?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="maxproduct">Maximum No of Products</label>
<input type="text" class="form-control" id="maxproduct" name="maxproduct" placeholder="Maximum No of Products" value="<?=(isset($_GET['maxproduct']))?$_GET['maxproduct']:''?>">
</div>
</div>
</div>
<input class="btn btn-primary" type="submit" name="getsubmit" value="Submit">
</form>
</div>
</div>
<?php
if(isset($_GET['getsubmit']))
{
$noofconsignee=mysqli_real_escape_string($connection,$_GET['noofconsignee']);
$maxproduct=mysqli_real_escape_string($connection,$_GET['maxproduct']);
$sqls=mysqli_query($connection,"select invoiceno from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['invoiceno']+1;
$invoicenoto=(float)$infos['invoiceno']+(float)$noofconsignee;
?>
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Invoice Details</h6>
</div>
<div class="card-body">
<form action="" id="myForm1" method="post">
<input type="hidden" name="noofconsignee" value="<?=$noofconsignee?>">
<input type="hidden" name="reftime" value="<?=time().rand()?>">
<div class="row">
<div class="col-lg-4">
<div class="form-group">
<label for="invoicenofrom">Invoice Number</label>
<input type="text" class="form-control" id="invoicenofrom" name="invoicenofrom" placeholder="Invoice No" value="<?='SO / REG / '.(date('my')).' /'.(str_pad($invoicenofrom, 4, '0', STR_PAD_LEFT))?>">
</div>
</div>
<?php
if($invoicenofrom!=$invoicenoto)
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="invoicenofrom">Invoice Number (Upto)</label>
<input type="text" class="form-control" id="invoicenoto" name="invoicenoto" placeholder="Invoice No To" value="<?='SO / REG / '.(date('my')).' /'.(str_pad($invoicenoto, 4, '0', STR_PAD_LEFT))?>">
</div>
</div>
<?php
}
?>
<div class="col-lg-4">
<div class="form-group">
<label for="invoicedate">Invoice Date</label>
<input type="date" class="form-control" id="invoicedate" name="invoicedate" placeholder="Invoice Date" value="<?=date('Y-m-d')?>">
</div>
</div>
</div>
<h5 class="mb-2">Buyer Information</h5>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="maincategory">Main Category</label>
<input type="text" class="form-control" id="maincategory" name="maincategory" >
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="tender">Tender</label>
<input type="text" class="form-control" id="tender" name="tender" >
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="subcategory">Sub Category</label>
<input type="text" class="form-control" id="subcategory" name="subcategory" >
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="department">Department Name</label>
<input type="text" class="form-control" id="department" name="department" >
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="otherreference">Other Reference</label>
<input type="text" class="form-control" id="otherreference" name="otherreference" value="Asst.year-<?=date('Y');?>-<?=date('y',strtotime('+1 year'));?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="pono">P.O. No</label>
<input type="text" class="form-control" id="pono" name="pono">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="podate">P.O. Date</label>
<input type="date" class="form-control" id="podate" name="podate" value="<?=date('Y-m-d')?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="custreference">Customer Reference ID</label>
<input type="text" class="form-control" id="custreference" name="custreference">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="duedays">Due Days</label>
<input type="number" class="form-control" id="duedays" name="duedays">
</div>
</div>
<div class="col-lg-5">
<div class="form-group">
<label for="buyername">Buyer Name</label>
<input type="text" class="form-control" id="buyername" name="buyername">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyeraddress1">Address 1</label>
<input type="text" class="form-control" id="buyeraddress1" name="buyeraddress1">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyeraddress2">Address 2</label>
<input type="text" class="form-control" id="buyeraddress2" name="buyeraddress2">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyeraddress3">Address 3</label>
<input type="text" class="form-control" id="buyeraddress3" name="buyeraddress3">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="buyerstate">State</label>
<input type="text" class="form-control" id="buyerstate" name="buyerstate" value="TAMILNADU">
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
<input type="text" class="form-control" id="bgst" name="bgst">
</div>
</div>
</div>
<h5 class="mb-2">Customer Information</h5> <label for="sameas" class="text-danger"><input type="checkbox" id="sameas" name="sameas" onchange="sameass()"> Customer Address Same as Buyer Address</label>
<label for="copyrec" class="text-danger float-right"><input type="button" id="copyrec" name="copyrec" onclick="copyrec1()" value="COPY CONSIGNEE 1 RECORD TO ALL"></label>
<div class="table-responsive">
<table class="table" id="table-data">
<thead>
<tr>
<th>No.</th>
<th>CONSIGNEE NAME</th><th>ADDRESS 1</th><th>ADDRESS 2</th><th>address 3</th><th>TALUK</th><th>DISTRICT </th><th>PIN CODE</th><th>Contact Person</th><th>PHONE NO.</th><th>MOBILE.NO.</th><th>MAIL ID</th><th></th><th>Del</th><th>PRODUCT GROUP</th><th>MULTIPLE GODOWN</th><th>PRODUCT CODE</th><th>PRODUCT </th><th>MARKET NAME </th><th>QTY</th><th>Unit Price</th><th>IGST <label><input type="checkbox" id="igstcheck"> Same for All</label> </th><th>SGST <label><input type="checkbox" id="sgstcheck"> Same for All</label> </th><th>CGST <label><input type="checkbox" id="cgstcheck"> Same for All</label> </th><th>IGST AMOUNT</th><th>SGST AMOUNT</th><th>CGST AMOUNT</th><th>TOTAL AMOUNT</th><th>warranty months <label><input type="checkbox" id="warrantycheck"> Same for All</label></th>
</tr>
</thead>
<tbody id="tabletobdy">
<?php
for($i=1;$i<=$noofconsignee;$i++)
{
for($j=1;$j<=$maxproduct;$j++)
{
?>
<tr class="tr_clone rowcount<?=$i?>">
<td><input type="hidden" class="consigneeno" id="consigneeno<?=$i?>" name="consigneeno[]" value="<?=$i?>"><span id="serial<?=$i?>"><?=$i?></span></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'consigneename')" class="consigneename" name="consigneename[]" id="consigneename<?=$i?>" placeholder="CONSIGNEE NAME (<?=$i?>)" tabindex="21"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress1')" class="conaddress1" name="conaddress1[]" id="conaddress1<?=$i?>" placeholder="ADDRESS 1 (<?=$i?>)" tabindex="22"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress2')" class="conaddress2" name="conaddress2[]" id="conaddress2<?=$i?>" placeholder="ADDRESS 2 (<?=$i?>)" tabindex="23"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress3')" class="conaddress3" name="conaddress3[]" id="conaddress3<?=$i?>" placeholder="ADDRESS 3 (<?=$i?>)" tabindex="24"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'contaluk')" class="contaluk" name="contaluk[]" id="contaluk<?=$i?>" placeholder="TALUK (<?=$i?>)" tabindex="25"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'condistrict')" class="condistrict" name="condistrict[]" id="condistrict<?=$i?>" placeholder="DISTRICT (<?=$i?>)" tabindex="26"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conpincode')" class="conpincode" name="conpincode[]" id="conpincode<?=$i?>" placeholder="PIN CODE (<?=$i?>)" tabindex="27"  onKeyup="cleartext<?=$i?>()"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'concontact')" class="concontact" name="concontact[]" id="concontact<?=$i?>" placeholder="CONTACT PERSON (<?=$i?>)" tabindex="28"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conphone')"  class="conphone" name="conphone[]" id="conphone<?=$i?>" placeholder="PHONE NO. (<?=$i?>)" tabindex="29"></td>
<td><input type="number" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conmobile')"  class="conmobile" name="conmobile[]" id="conmobile<?=$i?>" placeholder="MOBILE NO. (<?=$i?>)" tabindex="30"></td>
<td><input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conemail')"  class="conemail" name="conemail[]" id="conemail<?=$i?>" placeholder="MAIL ID (<?=$i?>)" tabindex="31"></td>
<td><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="32"></td>
<td class="table-controls table-zapper">
<button class="btnDeleteRow btn-zap" type="button" onclick="remfun(this)" <?=($j==1)?'disabled':''?>>&times;</button>
</td>
<td><input type="text"  class="conprogroup" name="conprogroup[]" id="conprogroup<?=$i?>" placeholder="PRODUCT GROUP (<?=$i?>)" tabindex="33"></td>
<td><input type="text"  class="conmultiple" name="conmultiple[]" id="conmultiple<?=$i?>" placeholder="MULTIPLE GODOWN (<?=$i?>)" tabindex="34"></td>
<td><input type="text"   class="conproductcode" name="conproductcode[]" id="conproductcode<?=$i?><?=$j?>" placeholder="PRODUCT CODE (<?=$i?>)" tabindex="35"></td>
<td><input type="text" class="conproduct" name="conproduct[]" id="conproduct<?=$i?><?=$j?>" placeholder="PRODUCT (<?=$i?>)" tabindex="36"></td>
<td><input type="text" class="conmarketname" name="conmarketname[]" id="conmarketname<?=$i?><?=$j?>" placeholder="MARKET NAME (<?=$i?>)" tabindex="37"></td>
<td><input type="number" class="conqty" name="conqty[]" id="conqty<?=$i?>" placeholder="QTY (<?=$i?>)" onchange="procalc(<?=$i?>)" tabindex="38"></td>
<td><input type="number" step="0.01" min="0" class="conunit" name="conunit[]" id="conunit<?=$i?>" placeholder="UNIT PRICE  (<?=$i?>)" onchange="procalc(<?=$i?>)" tabindex="39"></td>
<td><input type="number" step="0.01" min="0" class="conigst" name="conigst[]" id="conigst<?=$i?>" placeholder="IGST (<?=$i?>)" onchange="igstcheckf(this.value); procalc(<?=$i?>);" tabindex="40"></td>
<td><input type="number" step="0.01" min="0" class="consgst" name="consgst[]" id="consgst<?=$i?>" placeholder="SGST (<?=$i?>)" onchange="sgstcheckf(this.value); procalc(<?=$i?>);" tabindex="41"></td>
<td><input type="number" step="0.01" min="0" class="concgst" name="concgst[]" id="concgst<?=$i?>" placeholder="CGST (<?=$i?>)" onchange="procalc(<?=$i?>);" readonly tabindex="-1" tabindex="42"></td>
<td><input type="number" step="0.01" min="0" class="conigstamount" name="conigstamount[]" id="conigstamount<?=$i?>" placeholder="IGST AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="43"></td>
<td><input type="number" step="0.01" min="0" class="consgstamount" name="consgstamount[]" id="consgstamount<?=$i?>" placeholder="SGST AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="44"></td>
<td><input type="number" step="0.01" min="0" class="concgstamount" name="concgstamount[]" id="concgstamount<?=$i?>" placeholder="CGST AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="45"></td>
<td><input type="number" step="0.01" min="0" class="contotal" name="contotal[]" id="contotal<?=$i?>" placeholder="TOTAL AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="46"></td>
<td><input type="number" step="0.01" min="0" class="conwarranty" name="conwarranty[]" id="conwarranty<?=$i?>" onchange="warrantycheckf(this.value);" placeholder="WARRANTY MONTHS (<?=$i?>)" tabindex="47"></td>
</tr>
<?php
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
var maxproduct=document.getElementsByName("maxproduct[]");
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
for(var j=0;i<maxproduct.length;i++)
{
$( consigneename[i] ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( condistrict[i] ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( conproduct[i][j] ).autocomplete({
source: 'tallysearch.php?type=productname&table=jrcproducts',
});
$( conproductcode[i][j] ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( conmarketname[i][j] ).autocomplete({
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
}
});
<?php
if(isset($noofconsignee) && isset($maxproduct))
{
for($i=1;$i<=$noofconsignee;$i++)
{
for($j=1;$j<=$maxproduct;$j++)
{
?>
$( "#consigneename<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( "#condistrict<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( "#conprogroup<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
});
$( "#conmultiple<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=conmultiple&table=jrctally',
});
$( "#conproductcode<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( "#conproduct<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=stockitem&table=jrcproduct',
});
$( "#conmarketname<?=$i?><?=$j?>" ).autocomplete({
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
$( "#conproductcode<?=$i?><?=$j?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'productsearch1.php?type=code', select: function (event, ui) { $("#conproductcode<?=$i?><?=$j?>").val(ui.item.value); $("#conproduct<?=$i?><?=$j?>").val(ui.item.stockitem); $("#conmarketname<?=$i?><?=$j?>").val(ui.item.marketname);}, minLength: 3
});
<?php
}
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
function copyrec1()
{
if (!confirm('Are you Sure want to Proceed? (1/3)')) return false;
if (!confirm('Are you Sure want to Proceed? (2/3)')) return false;
if (!confirm('Are you Sure want to Proceed? (3/3)')) return false;
<?php
if(isset($noofconsignee))
{
?>
var noofconsignee='<?=$noofconsignee?>';
document.querySelectorAll('#tabletobdy tr:not(.rowcount1)').forEach((tr) => {
tr.remove();
});
for(var j=2;j<=noofconsignee; j++)
{
var iss=1;
var opts = {};
$.each($(".rowcount1"),function(){
var self=$(this);
var $clone = self.clone();
$clone.attr("class","tr_clone rowcount");
$clone.find('#serial1').attr("id", "serial"+(j));
$clone.find('#serial'+j).text(j);
$clone.find('#consigneeno1').attr("id", "consigneeno"+(j));
$clone.find('#consigneename1').attr("id", "consigneename"+(j));
$clone.find('#conaddress11').attr("id", "conaddress1"+(j));
$clone.find('#conaddress21').attr("id", "conaddress2"+(j));
$clone.find('#conaddress31').attr("id", "conaddress3"+(j));
$clone.find('#contaluk1').attr("id", "contaluk"+(j));
$clone.find('#condistrict1').attr("id", "condistrict"+(j));
$clone.find('#conpincode1').attr("id", "conpincode"+(j));
$clone.find('#concontact1').attr("id", "concontact"+(j));
$clone.find('#conphone1').attr("id", "conphone"+(j));
$clone.find('#conmobile1').attr("id", "conmobile"+(j));
$clone.find('#conemail1').attr("id", "conemail"+(j));
$clone.find('#conprogroup1').attr("id", "conprogroup"+(j));
$clone.find('#conmultiple1').attr("id", "conmultiple"+(j));
$clone.find('#conproductcode1').attr("id", "conproductcode"+(j));
$clone.find('#conproduct1').attr("id", "conproduct"+(j));
$clone.find('#conmarketname1').attr("id", "conmarketname"+(j));
$clone.find('#conqty1').attr("id", "conqty"+(j));
$clone.find('#conunit1').attr("id", "conunit"+(j));
$clone.find('#conigst1').attr("id", "conigst"+(j));
$clone.find('#consgst1').attr("id", "consgst"+(j));
$clone.find('#concgst1').attr("id", "concgst"+(j));
$clone.find('#conigstamount1').attr("id", "conigstamount"+(j));
$clone.find('#consgstamount1').attr("id", "consgstamount"+(j));
$clone.find('#concgstamount1').attr("id", "concgstamount"+(j));
$clone.find('#contotal1').attr("id", "contotal"+(j));
$clone.find('#conwarranty1').attr("id", "conwarranty"+(j));
$clone.find('#consigneename'+j).attr("placeholder", "CONSIGNEE NAME ("+j+")");
$clone.find('#conaddress1'+j).attr("placeholder", "ADDRESS 1 ("+j+")");
$clone.find('#conaddress2'+j).attr("placeholder", "ADDRESS 2 ("+j+")");
$clone.find('#conaddress3'+j).attr("placeholder", "ADDRESS 3 ("+j+")");
$clone.find('#contaluk'+j).attr("placeholder", "TALUK ("+j+")");
$clone.find('#condistrict'+j).attr("placeholder", "DISTRICT ("+j+")");
$clone.find('#conpincode'+j).attr("placeholder", "PIN CODE ("+j+")");
$clone.find('#concontact'+j).attr("placeholder", "CONTACT PERSON ("+j+")");
$clone.find('#conphone'+j).attr("placeholder", "PHONE NO. ("+j+")");
$clone.find('#conmobile'+j).attr("placeholder", "MOBILE NO. ("+j+")");
$clone.find('#conemail'+j).attr("placeholder", "MAIL ID ("+j+")");
$clone.find('#conprogroup'+j).attr("placeholder", "PRODUCT GROUP ("+j+")");
$clone.find('#conmultiple'+j).attr("placeholder", "MULTIPLE GODOWN ("+j+")");
$clone.find('#conproductcode'+j).attr("placeholder", "PRODUCT CODE ("+j+")");
$clone.find('#conproduct'+j).attr("placeholder", "PRODUCT ("+j+")");
$clone.find('#conmarketname'+j).attr("placeholder", "MARKET NAME ("+j+")");
$clone.find('#conqty'+j).attr("placeholder", "QTY ("+j+")");
$clone.find('#conunit'+j).attr("placeholder", "UNIT PRICE ("+j+")");
$clone.find('#conigst'+j).attr("placeholder", "IGST ("+j+")");
$clone.find('#consgst'+j).attr("placeholder", "SGST ("+j+")");
$clone.find('#concgst'+j).attr("placeholder", "CGST ("+j+")");
$clone.find('#conigstamount'+j).attr("placeholder", "IGST AMOUNT ("+j+")");
$clone.find('#consgstamount'+j).attr("placeholder", "SGST AMOUNT ("+j+")");
$clone.find('#concgstamount'+j).attr("placeholder", "CGST AMOUNT ("+j+")");
$clone.find('#contotal'+j).attr("placeholder", "TOTAL AMOUNT ("+j+")");
$clone.find('#conwarranty'+j).attr("placeholder", "WARRANTY MONTHS ("+j+")");
$clone.find('#consigneename'+j).attr("stag", j);
$clone.find('#conaddress1'+j).attr("stag", j);
$clone.find('#conaddress2'+j).attr("stag", j);
$clone.find('#conaddress3'+j).attr("stag", j);
$clone.find('#contaluk'+j).attr("stag", j);
$clone.find('#condistrict'+j).attr("stag", j);
$clone.find('#conpincode'+j).attr("stag", j);
$clone.find('#concontact'+j).attr("stag", j);
$clone.find('#conphone'+j).attr("stag", j);
$clone.find('#conmobile'+j).attr("stag", j);
$clone.find('#conemail'+j).attr("stag", j);
$clone.find('#conprogroup'+j).attr("stag", j);
$clone.find('#conmultiple'+j).attr("stag", j);
$clone.find('#conproductcode'+j).attr("stag", j);
$clone.find('#conproduct'+j).attr("stag", j);
$clone.find('#conmarketname'+j).attr("stag", j);
$clone.find('#conqty'+j).attr("stag", j);
$clone.find('#conunit'+j).attr("stag", j);
$clone.find('#conigst'+j).attr("stag", j);
$clone.find('#consgst'+j).attr("stag", j);
$clone.find('#concgst'+j).attr("stag", j);
$clone.find('#conigstamount'+j).attr("stag", j);
$clone.find('#consgstamount'+j).attr("stag", j);
$clone.find('#concgstamount'+j).attr("stag", j);
$clone.find('#contotal'+j).attr("stag", j);
$clone.find('#conwarranty'+j).attr("stag", j);
$clone.find('#consigneeno'+j).val(j)
/* $clone.html(function(i, oldHTML) {
return oldHTML.replace("CONSIGNEE NAME (1)", "CONSIGNEE NAME ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("ADDRESS 1 (1)", "ADDRESS 1 ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("ADDRESS 2 (1)", "ADDRESS 2 ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("ADDRESS 3 (1)", "ADDRESS 3 ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("TALUK (1)", "TALUK ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("DISTRICT (1)", "DISTRICT ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("PIN CODE (1)", "PIN CODE ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("CONTACT PERSON (1)", "CONTACT PERSON ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("PHONE NO. (1)", "PHONE NO. ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("MOBILE NO. (1)", "MOBILE NO. ("+j+")");
});
$clone.html(function(i, oldHTML) {
return oldHTML.replace("MAIL ID (1)", "MAIL ID ("+j+")");
}); */
$clone.appendTo("#tabletobdy");
$( ".consigneename" ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( ".condistrict" ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( ".conprogroup" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproducts',
});
$( ".conmultiple" ).autocomplete({
source: 'tallysearch.php?type=conmultiple&table=jrctally',
});
$( ".conproduct" ).autocomplete({
source: 'tallysearch.php?type=productname&table=jrcproducts',
});
$( ".conproductcode" ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( ".conmarketname" ).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct',
});
$( ".conaddress3" ).autocomplete({
source: 'pincodesearch.php?type=officename',
});
$( ".contaluk" ).autocomplete({
source: 'pincodesearch.php?type=taluk',
});
$( ".condistrict" ).autocomplete({
source: 'pincodesearch.php?type=district',
});
$( ".conpincode" ).autocomplete({
source: 'pincodesearch.php?type=pincode',
});
iss++;
});
}
<?php
}
?>
//$(".rowcount1").clone().attr("class","tr_clone rowcount").appendTo("#tabletobdy");
}
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
var dataString = $("#myForm, #myForm1").serialize();
if(noofconsignee != '' && maxproduct != '')
{
$.ajax({
url:"save_post.php",
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
}, 60000);
}
});
}
}
setInterval(function(){
autoSave();
}, 60000);
});
</script>
<script>
function igstcheckf(val)
{
	var igstcheck=document.getElementById("igstcheck");
	if(igstcheck.checked==true)
	{
		var els=document.getElementsByClassName("conigst");
        for (var i=0;i<els.length;i++) {
            els[i].value = val;
		}
	}
}
function sgstcheckf(val)
{
	var sgstcheck=document.getElementById("sgstcheck");
	if(sgstcheck.checked==true)
	{
		var els=document.getElementsByClassName("consgst");
        for (var i=0;i<els.length;i++) {
            els[i].value = val;
		}
	}
}
function warrantycheckf(val)
{
	var warrantycheck=document.getElementById("warrantycheck");
	if(warrantycheck.checked==true)
	{
		var els=document.getElementsByClassName("conwarranty");
        for (var i=0;i<els.length;i++) {
            els[i].value = val;
		}
	}
}
</script>
<!-- Auto Submit Or Draft Values-->
<?php include('additionaljs.php');   ?>
</body>
</html>