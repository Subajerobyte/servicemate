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
$createdby=$email;
$noofconsignee=mysqli_real_escape_string($connection,$_POST['noofconsignee']);
$maxproduct=mysqli_real_escape_string($connection,$_POST['maxproduct']);
$sqls=mysqli_query($connection,"select invoiceno, serviceinvoice from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
if($_POST['sotype']=="Regular")
{
$invoicenofrom=(float)$infos['invoiceno']+1;
$invoicenoto=(float)$infos['invoiceno']+(float)$noofconsignee;
}
else
{
$invoicenofrom=(float)$infos['serviceinvoice']+1;
$invoicenoto=(float)$infos['serviceinvoice']+(float)$noofconsignee;
}
$sotype=mysqli_real_escape_string($connection,$_POST['sotype']);
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
$buyerid=mysqli_real_escape_string($connection,$_POST['buyerid']);
$orgbuyername=explode(',', $_POST['buyername']);
$buyername=mysqli_real_escape_string($connection,$orgbuyername[0]);
$buyeraddress1=mysqli_real_escape_string($connection,$_POST['buyeraddress1']);
$buyeraddress2=mysqli_real_escape_string($connection,$_POST['buyeraddress2']);
$buyeraddress3=mysqli_real_escape_string($connection,$_POST['buyeraddress3']);
$buyertaluk=mysqli_real_escape_string($connection,$_POST['buyertaluk']);
$buyerdistrict=mysqli_real_escape_string($connection,$_POST['buyerdistrict']);
$buyerpincode=mysqli_real_escape_string($connection,$_POST['buyerpincode']);
$buyerstate=mysqli_real_escape_string($connection,$_POST['buyerstate']);
$buyermobile=mysqli_real_escape_string($connection,$_POST['buyermobile']);
$buyerphone=mysqli_real_escape_string($connection,$_POST['buyerphone']);
$buyermail=mysqli_real_escape_string($connection,$_POST['buyermail']);
$buyercontact=mysqli_real_escape_string($connection,$_POST['buyercontact']);
$rtype=mysqli_real_escape_string($connection,$_POST['rtype']);
$bgst=mysqli_real_escape_string($connection,$_POST['bgst']);
$reftime=mysqli_real_escape_string($connection,$_POST['reftime']);
$subtotalamount=mysqli_real_escape_string($connection,$_POST['subtotalamount']);
$totalgstamount=mysqli_real_escape_string($connection,$_POST['totalgstamount']);
$netamount=mysqli_real_escape_string($connection,$_POST['netamount']);
$discount=mysqli_real_escape_string($connection,$_POST['discount']);
$discountmode=mysqli_real_escape_string($connection,$_POST['discountmode']);
$discountamount=mysqli_real_escape_string($connection,$_POST['discountamount']);
$addamount=mysqli_real_escape_string($connection,$_POST['addamount']);
$lessamount=mysqli_real_escape_string($connection,$_POST['lessamount']);
$buyback=mysqli_real_escape_string($connection,$_POST['buyback']);
$buyremark=mysqli_real_escape_string($connection,$_POST['buyremark']);
$grandtotal=mysqli_real_escape_string($connection,$_POST['grandtotal']);
$oldattachments=mysqli_real_escape_string($connection, $_POST['oldattachments']);

if(file_exists($_FILES["attachments"]['tmp_name'])) {
			$target_dir = "../padhivetram/pofile/";
				$target_file = $target_dir .time(). basename($_FILES["attachments"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				  if (move_uploaded_file($_FILES["attachments"]["tmp_name"], $target_file)) 
				  {
					$attachments=$target_file;
				  } else 
				  {
					$attachments="";
				  }
				  } 
				  else 
				  {
					$attachments=$oldattachments;
				  }
if($reftime!='')
{
$sqllreftime=mysqli_query($connection,"DELETE FROM jrctallydraft WHERE reftime='".$reftime."'");
}
for($i=0;$i<count($_POST['consigneeno']);$i++)
{
$consigneeno=mysqli_real_escape_string($connection,$_POST['consigneeno'][$i]);
if($_POST['sotype']=="Regular")
{
$sono='SO / REG / '.(date('my')).' /'.(str_pad((float)$infos['invoiceno']+($consigneeno), 4, '0', STR_PAD_LEFT));
}
else
{
$sono='SO / SER / '.(date('my')).' /'.(str_pad((float)$infos['serviceinvoice']+($consigneeno), 4, '0', STR_PAD_LEFT));
}
$consigneeid=mysqli_real_escape_string($connection,$_POST['consigneeid'][$i]);
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename'][$i]);
$conmaincategory=mysqli_real_escape_string($connection,$_POST['conmaincategory'][$i]);
$consubcategory=mysqli_real_escape_string($connection,$_POST['consubcategory'][$i]);
$condepartment=mysqli_real_escape_string($connection,$_POST['condepartment'][$i]);
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
$promaincategory=mysqli_real_escape_string($connection,$_POST['promaincategory'][$i]);
$prosubcategory=mysqli_real_escape_string($connection,$_POST['prosubcategory'][$i]);
$conproductid=mysqli_real_escape_string($connection,$_POST['conproductid'][$i]);
$conproduct=mysqli_real_escape_string($connection,$_POST['conproduct'][$i]);
$componentname=mysqli_real_escape_string($connection,$_POST['componentname'][$i]);
$componenttype=mysqli_real_escape_string($connection,$_POST['componenttype'][$i]);
$conproductcode=mysqli_real_escape_string($connection,$_POST['conproductcode'][$i]);
$conmarketname=mysqli_real_escape_string($connection,$_POST['conmarketname'][$i]);
$conmake=mysqli_real_escape_string($connection,$_POST['conmake'][$i]);
$concapacity=mysqli_real_escape_string($connection,$_POST['concapacity'][$i]);
$conpromodel=mysqli_real_escape_string($connection,$_POST['conpromodel'][$i]);
$conhsncode=mysqli_real_escape_string($connection,$_POST['conhsncode'][$i]);
$conper=mysqli_real_escape_string($connection,$_POST['conper'][$i]);
$conserialno=mysqli_real_escape_string($connection,$_POST['conserialno'][$i]);
$condepartmentname=mysqli_real_escape_string($connection,$_POST['condepartmentname'][$i]);
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
$sqls2=mysqli_query($connection,"INSERT INTO jrctally(createdon,createdby, dname, noofconsignee, maxproduct, invoicenofrom, invoicenoto,sotype,invoicedate,sono, maincategory, tender, subcategory, department, otherreference, pono, podate,pofile, custreference, duedays, buyerid,buyername, buyeraddress1, buyeraddress2, buyeraddress3, buyertaluk,buyerdistrict,buyerpincode,buyerstate,buyermobile,buyerphone,buyermail,buyercontact, rtype, bgst, consigneeid,consigneeno, consigneename, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, concontact, conphone, conmobile, conemail, conprogroup, conmultiple, conproductid,conproduct, conproductcode, conmarketname,conmake,concapacity,conpromodel,conper,conhsncode,conserialno,condepartmentname, conqty, conunit, conigst, consgst, concgst, conigstamount, consgstamount, concgstamount, contotal, conwarranty,subtotalamount,totalgstamount,netamount,discount,discountmode,discountamount,addamount,lessamount,buyback,buyremark,grandtotal) VALUES ('$createdon','$createdby', '$dname', '$noofconsignee', '$maxproduct', '$invoicenofrom', '$invoicenoto', '$invoicedate', '$sotype', '$sono', '$maincategory', '$tender', '$subcategory', '$department', '$otherreference', '$pono', '$podate', '$attachments', '$custreference', '$duedays', '$buyerid','$buyername', '$buyeraddress1', '$buyeraddress2', '$buyeraddress3', '$buyertaluk','$buyerdistrict','$buyerpincode','$buyerstate','$buyermobile','$buyerphone','$buyermail', '$buyercontact', '$rtype', '$bgst', '$consigneeid','$consigneeno', '$consigneename', '$conaddress1', '$conaddress2', '$conaddress3', '$contaluk', '$condistrict', '$conpincode', '$concontact', '$conphone', '$conmobile', '$conemail', '$conprogroup', '$conmultiple', '$conproductid','$conproduct', '$conproductcode', '$conmarketname', '$conmake', '$concapacity','$conpromodel', '$conper', '$conhsncode', '$conserialno','$condepartmentname','$conqty', '$conunit', '$conigst', '$consgst', '$concgst', '$conigstamount', '$consgstamount', '$concgstamount', '$contotal', '$conwarranty', '$subtotalamount', '$totalgstamount', '$netamount', '$discount', '$discountmode', '$discountamount', '$addamount', '$lessamount', '$buyback', '$buyremark', '$grandtotal')");
}
if($sqls2)
{
if($_POST['sotype']=="Regular")
{
$sqls=mysqli_query($connection,"update jrcinvoice set invoiceno='$invoicenoto'");
header("Location:exporttally.php?remarks=Added Successfully");
}
else
{
$sqls=mysqli_query($connection,"update jrcinvoice set serviceinvoice='$invoicenoto'");
header("Location:exporttally.php?remarks=Added Successfully");
}	
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
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
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
<style>
.table-fixed th:nth-child(2), 
.table-fixed td:nth-child(2) {
  position: sticky;
  left: 0;
  z-index: 2;
  background-color: #fff; /* Background color of the fixed column */
}
 </style>
</head>
<body id="page-top" onload="procalc(1);checkGSTINRequirement();">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php include('salesnavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Draft Sales Order</h1>
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
$sqlselect = "SELECT * From jrctallydraft where reftime='".$reftime."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowselect1 = mysqli_fetch_array($queryselect);
$rowselect1['discount'];
?>
<!-- DataTales Example -->
<?php
$noofconsignee=mysqli_real_escape_string($connection,$rowselect1['noofconsignee']);
$maxproduct=mysqli_real_escape_string($connection,$rowselect1['maxproduct']);
if ($maxproduct >=1 && $maxproduct <= 10) {
    $duedays = 15;
} elseif ($maxproduct <= 25) {
    $duedays = 20;
} elseif ($maxproduct <= 50) {
    $duedays = 25;
} elseif ($maxproduct <= 100) {
    $duedays = 30;
} else {
    $duedays = "";
}
$sqls=mysqli_query($connection,"select invoiceno from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['invoiceno']+1;
$invoicenoto=(float)$infos['invoiceno']+(float)$noofconsignee;
?>
<div class="card shadow mb-4">

<div class="card-body">
<form action="" id="myForm1" method="post" enctype="multipart/form-data">
<input type="hidden" name="noofconsignee" id="noofconsignee" value="<?=$noofconsignee?>">
<input type="hidden" name="maxproduct" id="noofconsignee" value="<?=$maxproduct?>">
<input type="hidden" name="reftime" value="<?=$reftime?>">
<div class="card-header py-1">
<h6 class=" font-weight-bold text-primary text-center">Sales Order Information</h6>
</div><br>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="sotype ">S.O. Type<span class="text-danger">*</span></label>
<select class="form-control fav_clr" id="sotype" name="sotype">

<option value="Regular" selected>Regular Sales Order</option>
<option value="Service">Service Sales Order</option>
</select>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="invoicetype ">Registration Type<span class="text-danger">*</span></label>
<select class="form-control fav_clr" id="invoicetype" name="invoicetype" onchange="checkGSTINRequirement()">

<option value="B2B" <?=($rowselect1['invoicetype']=="B2B")?'selected':''?>>Register Dealer (B2B)</option>
<option value="B2C" <?=($rowselect1['invoicetype']=="B2C")?'selected':''?>>Unregister Dealer (B2C)</option>
</select>
</div>
</div>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="invoicenofrom">SO Number</label>
<input type="text" class="form-control" id="invoicenofrom" name="invoicenofrom" placeholder="Sales Order No" value="<?='SO / REG / '.(date('my')).' /'.(str_pad($invoicenofrom, 4, '0', STR_PAD_LEFT))?>" readonly>
</div>
</div>
<?php
if($invoicenofrom!=$invoicenoto)
{
?>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="invoicenofrom">SO Number (Upto)</label>
<input type="text" class="form-control" id="invoicenoto" name="invoicenoto" placeholder="Sales Order To" value="<?='SO / REG / '.(date('my')).' /'.(str_pad($invoicenoto, 4, '0', STR_PAD_LEFT))?>" readonly>
</div>
</div>
<?php
}
?>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="invoicedate">SO Date</label>
<input type="date" class="form-control" id="invoicedate" name="invoicedate" placeholder="Invoice Date" value="<?=$rowselect1['invoicedate']?>">
</div>
</div>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="otherreference">Other Reference</label>
<input type="text" class="form-control" id="otherreference" name="otherreference" value="<?=$rowselect1['otherreference']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="pono">P.O. No</label>
<input type="text" class="form-control" id="pono" name="pono" value="<?=$rowselect1['pono']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="podate">P.O. Date</label>
<input type="date" class="form-control" id="podate" name="podate" value="<?=$rowselect1['podate']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="custreference">Customer Reference ID</label>
<input type="text" class="form-control" id="custreference" name="custreference" value="<?=$rowselect1['custreference']?>">
</div>
</div>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="duedays">Due Days</label>
<input type="number" class="form-control" id="duedays" name="duedays" value="<?=$rowselect1['duedays']?$rowselect1['duedays']:$duedays?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="attachments">Attach File(s) to Sales Order</label>
<input type="hidden"  id="oldattachments" name="oldattachments" value="<?=$rowselect1['attachments']?>">
<input type="file" class="form-control" id="attachments" name="attachments" style="padding:5px; height:auto">
<label for="terms">You can upload a maximum of two files, Each with a size limit of 2MB</label>
<?php 
if($rowselect1['pofile']!='')
{
$ext = pathinfo($rowselect1['pofile'], PATHINFO_EXTENSION);
if ($ext=="pdf") {
   
?>
<a href="#" class="pop"><embed src="<?php echo $rowselect1['pofile']?>" width="200px" height="200px"  type="application/pdf"/></a>
<?php
}
else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
   
?>
<a href="#" class="pop"><img src="<?php echo $rowselect1['pofile']?>" width="200px" height="200px" ></a>
<?php
}
else{
	?>
	<a href="<?php echo $rowselect1['pofile']?>" >View File</a>
	<?php
}
}

?>
</div>
</div>
</div>
<br>
<div class="card-header py-1">
<h6 class=" font-weight-bold text-primary text-center">Buyer Information</h6>
</div>
<br>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label for="buyername">Buyer Name <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyername" name="buyername" value="<?=$rowselect1['buyername']?>" required maxlength="100"> 
<input type="hidden" class="form-control" id="buyerid" name="buyerid" value="<?=$rowselect1['buyerid']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="maincategory">Main Category</label>
<input type="text" class="form-control" id="maincategory" name="maincategory" value="<?=$rowselect1['maincategory']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="tender">Tender</label>
<input type="text" class="form-control" id="tender" name="tender" value="<?=$rowselect1['tender']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="subcategory">Sub Category</label>
<input type="text" class="form-control" id="subcategory" name="subcategory" value="<?=$rowselect1['subcategory']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="department">Department Name</label>
<input type="text" class="form-control" id="department" name="department" value="<?=$rowselect1['department']?>">
</div>
</div>	
<div class="col-lg-3">
<div class="form-group">
<label for="buyeraddress1">Address 1 <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyeraddress1" name="buyeraddress1" value="<?=$rowselect1['buyeraddress1']?>" required maxlength="100">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyeraddress2">Address 2</label>
<input type="text" class="form-control" id="buyeraddress2" name="buyeraddress2" value="<?=$rowselect1['buyeraddress2']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyeraddress3">Address 3</label>
<input type="text" class="form-control" id="buyeraddress3" name="buyeraddress3" value="<?=$rowselect1['buyeraddress3']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyertaluk">Taluk</label>
<input type="text" class="form-control" id="buyertaluk" name="buyertaluk" value="<?=$rowselect1['buyertaluk']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyerdistrict">District <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerdistrict" name="buyerdistrict" value="<?=$rowselect1['buyerdistrict']?>" required maxlength="50">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyerpincode">Pincode <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerpincode" name="buyerpincode" value="<?=$rowselect1['buyerpincode']?>"  maxlength="6" inputmode="numeric"  required>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyerstate">State Code & State <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerstate" name="buyerstate" value="<?=$rowselect1['buyerstate']?>"  required>
<input type="hidden" class="form-control" id="companystatecode" name="companystatecode" value="<?=$_SESSION['companystatecode']?>"  required>
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyermobile">Mobile Number </label>
<input type="text" class="form-control" id="buyermobile" name="buyermobile" value="<?=$rowselect1['buyermobile']?>"  maxlength="10" inputmode="numeric">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyerphone">Phone Number </label>
<input type="text" class="form-control" id="buyerphone" name="buyerphone" maxlength="11" inputmode="numeric" value="<?=$rowselect1['buyerphone']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyercontact">Contact Person</label>
<input type="text" class="form-control" id="buyercontact" name="buyercontact" value="<?=$rowselect1['buyercontact']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyermail">E-mail</label>
<input type="email" class="form-control" id="buyermail" name="buyermail" value="<?=$rowselect1['buyermail']?>"  maxlength="320">
</div>
</div>
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="rtype">Registration Type</label>
<select class="form-control fav_clr" id="rtype" name="rtype">
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
<div class="col-lg-3">
<div class="form-group">
<label for="bgst">GSTIN No <span id="asterisk1" class="text-danger">*</span></label>
<input type="text" class="form-control" id="bgst" name="bgst" value="<?=$rowselect1['bgst']?>" required maxlength="15"> 
</div>
</div>
</div>

<br>
<div class="card-header py-1">
<h6 class="font-weight-bold text-primary text-center">Customer Information</h6>
</div>
<br>
<label for="sameas" class="text-danger"><input type="checkbox" id="sameas" name="sameas" onchange="sameass()"> Customer Address Same as Buyer Address</label>
<label for="copyrec" class="text-danger float-right"><input type="button" id="copyrec" name="copyrec" onclick="copyrec1()" value="COPY CONSIGNEE 1 RECORD TO ALL"></label>
<div class="text-center mt-3"><a class="btn btn-light" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()">&larr;Scroll Left</a><a class="btn btn-light" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()">Scroll Right &rarr;</a></div>
<div class="table-responsive">
 
<table class="table table-fixed" id="table-data">
<thead>
<tr>
<th>No.</th>
<th>CONSIGNEE NAME <span class="text-danger">*</span></th><th>DEPARTMENT</th><th>ADDRESS 1 <span class="text-danger">*</span></th><th>ADDRESS 2</th><th>address 3</th><th>TALUK</th><th>DISTRICT  <span class="text-danger">*</span></th><th>PIN CODE <span class="text-danger">*</span></th><th>STATE CODE & STATE <span class="text-danger">*</span></th><th>GST.NO. <span id="asterisk" class="text-danger">*</span></th><th>Contact Person</th><th>PHONE NO.</th><th>MOBILE.NO.</th><th>MAIL ID</th><th></th><th>Del</th><!--th>MULTIPLE GODOWN</th--><th>PRODUCT CODE</th><th>PRODUCT <span class="text-danger">*</span></th><!--th>HSN/SAC <span class="text-danger">*</span></th--><th>QTY <span class="text-danger">*</span></th><th>SERIAL</th><th>Unit Price <span class="text-danger">*</span></th><!--th>IGST <label><input type="checkbox" id="igstcheck"> Same for All</label> </th><th>SGST <label><input type="checkbox" id="sgstcheck"> Same for All</label> </th><th>CGST <label><input type="checkbox" id="cgstcheck"> Same for All</label> </th><th>IGST AMOUNT</th><th>SGST AMOUNT</th><th>CGST AMOUNT</th--><th>TOTAL AMOUNT <span class="text-danger">*</span></th><!--th>warranty months <label><input type="checkbox" id="warrantycheck"> Same for All</label></th-->
</tr>
</thead>
<tbody id="tabletobdy">
<?php
$sqlselect = "SELECT * From jrctallydraft where reftime='".$reftime."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$i=1;
$cons='';
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<tr class="tr_clone rowcount<?=$rowselect['consigneeno']?>">
<td><input type="hidden" class="consigneeno" id="consigneeno<?=$rowselect['consigneeno']?>" name="consigneeno[]" value="<?=$rowselect['consigneeno']?>" ><span id="serial<?=$rowselect['consigneeno']?>"><?=$rowselect['consigneeno']?></span></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'consigneename')" class="consigneename" name="consigneename[]" id="consigneename<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consigneename']?>" placeholder="CONSIGNEE NAME (<?=$rowselect['consigneeno']?>)" tabindex="21" required maxlength="100">  <input type="hidden" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'consigneeid')" class="consigneeid" name="consigneeid[]" id="consigneeid<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consigneeid']?>"></td>

<input type="hidden" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conmaincategory')" class="conmaincategory" name="conmaincategory[]" id="conmaincategory<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conmaincategory']?>" placeholder="MAIN CATEGORY (<?=$rowselect['consigneeno']?>)" tabindex="22">
<input type="hidden" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'consubcategory')" class="consubcategory" name="consubcategory[]" id="consubcategory<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consubcategory']?>" placeholder="SUB CATEGORY (<?=$rowselect['consigneeno']?>)" tabindex="23">
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'condepartment')" class="condepartment" name="condepartment[]" id="condepartment<?=$rowselect['consigneeno']?>" value="<?=$rowselect['condepartment']?>" placeholder="DEPARTMENT (<?=$rowselect['consigneeno']?>)" tabindex="24"></td>


<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress1')" class="conaddress1" name="conaddress1[]" id="conaddress1<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conaddress1']?>" placeholder="ADDRESS 1 (<?=$rowselect['consigneeno']?>)" maxlength="100" tabindex="25" required></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress2')" class="conaddress2" name="conaddress2[]" id="conaddress2<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conaddress2']?>" placeholder="ADDRESS 2 (<?=$rowselect['consigneeno']?>)" tabindex="26"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress3')" class="conaddress3" name="conaddress3[]" id="conaddress3<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conaddress3']?>" placeholder="ADDRESS 3 (<?=$rowselect['consigneeno']?>)" tabindex="27"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'contaluk')" class="contaluk" name="contaluk[]" id="contaluk<?=$rowselect['consigneeno']?>" value="<?=$rowselect['contaluk']?>" placeholder="TALUK (<?=$rowselect['consigneeno']?>)" tabindex="28"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'condistrict')" class="condistrict" name="condistrict[]" id="condistrict<?=$rowselect['consigneeno']?>" value="<?=$rowselect['condistrict']?>" placeholder="DISTRICT (<?=$rowselect['consigneeno']?>)" tabindex="29" maxlength="50" required></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conpincode')" class="conpincode" name="conpincode[]" id="conpincode<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conpincode']?>" placeholder="PIN CODE (<?=$rowselect['consigneeno']?>)" tabindex="30"  maxlength="6" inputmode="numeric" onKeyup="cleartext<?=$rowselect['consigneeno']?>()" required></td>

<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'constatecode')" class="constatecode" name="constatecode[]" id="constatecode<?=$rowselect['consigneeno']?>" value="<?=$rowselect['constatecode']?>" placeholder="STATE CODE (<?=$rowselect['consigneeno']?>)" tabindex="31"  onKeyup="cleartext<?=$rowselect['consigneeno']?>()"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'congstno')" class="congstno" name="congstno[]" id="congstno<?=$rowselect['consigneeno']?>" value="<?=$rowselect['congstno']?>" placeholder="GST.NO. (<?=$rowselect['consigneeno']?>)"  maxlength="15"tabindex="32"  onKeyup="cleartext<?=$rowselect['consigneeno']?>()" ></td>


<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'concontact')" class="concontact" name="concontact[]" id="concontact<?=$rowselect['consigneeno']?>" value="<?=$rowselect['concontact']?>" placeholder="CONTACT PERSON (<?=$rowselect['consigneeno']?>)" tabindex="33"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conphone')"  class="conphone" name="conphone[]" id="conphone<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conphone']?>" placeholder="PHONE NO. (<?=$rowselect['consigneeno']?>)"  maxlength="11" inputmode="numeric"  tabindex="34"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conmobile')"  class="conmobile" name="conmobile[]" id="conmobile<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conmobile']?>" placeholder="MOBILE NO. (<?=$rowselect['consigneeno']?>)"  maxlength="10" inputmode="numeric" tabindex="35"></td>
<td><input type="text" stag="<?=$rowselect['consigneeno']?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conemail')"  class="conemail" name="conemail[]" id="conemail<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conemail']?>" placeholder="MAIL ID (<?=$rowselect['consigneeno']?>)" tabindex="36"></td>
<td><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="37"></td>
<td class="table-controls table-zapper"><button class="btnDeleteRow btn-zap" type="button" onclick="remfun(this)" <?=($cons!=$rowselect['consigneeno'])?'disabled':''?>>&times;</button></td>
<input type="hidden" class="conprogroup" name="conprogroup[]" id="conprogroup<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conprogroup']?>" placeholder="PRODUCT GROUP (<?=$rowselect['consigneeno']?>)" tabindex="38">
<input type="hidden" class="conmultiple" name="conmultiple[]" id="conmultiple<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conmultiple']?>" placeholder="MULTIPLE GODOWN (<?=$rowselect['consigneeno']?>)" tabindex="39">
<td><input type="text" class="conproductcode" name="conproductcode[]" id="conproductcode<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conproductcode']?>" placeholder="PRODUCT CODE(<?=$rowselect['consigneeno']?>)" tabindex="40"></td>
<input type="hidden" class="promaincategory" name="promaincategory[]" id="promaincategory<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['promaincategory'], ENT_QUOTES)?>" placeholder="MAIN CATEGORY (<?=$rowselect['consigneeno']?>)" tabindex="41">
<input type="hidden" class="prosubcategory" name="prosubcategory[]" id="prosubcategory<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['prosubcategory'], ENT_QUOTES)?>" placeholder="SUB CATEGORY (<?=$rowselect['consigneeno']?>)" tabindex="42">
<td><input type="text" class="conproduct" name="conproduct[]" id="conproduct<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['conproduct'], ENT_QUOTES)?>" placeholder="PRODUCT (<?=$rowselect['consigneeno']?>)" tabindex="43" required>
<input type="hidden" step="0.01" min="0" class="congstvalue" name="congstvalue[]" id="congstvalue<?=$rowselect['consigneeno']?>"   >
<input type="hidden" class="conproductid" name="conproductid[]" id="conproductid<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['conproductid'], ENT_QUOTES)?>"></td>
<input type="hidden" class="componentname" name="componentname[]" id="componentname<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['componentname'], ENT_QUOTES)?>" placeholder="COMPONENT NAME (<?=$rowselect['consigneeno']?>)" tabindex="44">
<input type="hidden" class="componenttype" name="componenttype[]" id="componenttype<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['componenttype'], ENT_QUOTES)?>" placeholder="COMPONENT TYPE (<?=$rowselect['consigneeno']?>)" tabindex="45">
<input type="hidden" class="conmarketname" name="conmarketname[]" id="conmarketname<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['conmarketname'], ENT_QUOTES)?>" placeholder="MARKET NAME (<?=$rowselect['consigneeno']?>)" tabindex="46">
<input type="hidden" class="conmake" name="conmake[]" id="conmake<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['conmake'], ENT_QUOTES)?>" placeholder="MAKE (<?=$rowselect['consigneeno']?>)" tabindex="47">
<input type="hidden" class="concapacity" name="concapacity[]" id="concapacity<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['concapacity'], ENT_QUOTES)?>" placeholder="CAPACITY (<?=$rowselect['consigneeno']?>)" tabindex="48">
<input type="hidden" class="conpromodel" name="conpromodel[]" id="conpromodel<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['conpromodel'], ENT_QUOTES)?>" placeholder="MODEL (<?=$rowselect['consigneeno']?>)" tabindex="49">
<input type="hidden" class="conhsncode" name="conhsncode[]" id="conhsncode<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['conhsncode'], ENT_QUOTES)?>" placeholder="HSN/SAC (<?=$rowselect['consigneeno']?>)" tabindex="50" required maxlength="8">
<input type="hidden" class="conper" name="conper[]" id="conper<?=$rowselect['consigneeno']?>" value="<?=htmlspecialchars($rowselect['conper'], ENT_QUOTES)?>" placeholder="PER (<?=$rowselect['consigneeno']?>)" tabindex="51">
<td><input type="text" class="conqty" name="conqty[]" id="conqty<?=$rowselect['consigneeno']?><?=$i?>" value="<?=htmlspecialchars($rowselect['conqty'], ENT_QUOTES)?>" onchange="procalc(<?=$rowselect['consigneeno']?>)" placeholder="QTY (<?=$rowselect['consigneeno']?>)" tabindex="52" required></td>
<td><span href="#" data-toggle="modal" data-target="#serialchangemodal"  class="text-danger text-right" onclick="serialnumbers(<?=$rowselect['consigneeno']?><?=$i?>)" tabindex="53" >Update Serial</span>
<input type="hidden" name="conserialno[]" id="conserialno<?=$rowselect['consigneeno']?><?=$i?>" value="<?=$rowselect['conserialno']?>">
<input type="hidden" name="condepartmentname[]" id="condepartmentname<?=$rowselect['consigneeno']?><?=$i?>" value="<?=$rowselect['condepartmentname']?>"></td>

<td><input type="number" step="0.01" min="0" class="conunit" name="conunit[]" id="conunit<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conunit']?>" placeholder="UNIT PRICE  (<?=$rowselect['consigneeno']?>)" onchange="procalc(<?=$rowselect['consigneeno']?>)" tabindex="54" required></td>
<input type="hidden" step="0.01" min="0" class="conigst" name="conigst[]" id="conigst<?=$rowselect['consigneeno']?>"  value="<?=$rowselect['conigst']?>" placeholder="IGST (<?=$rowselect['consigneeno']?>)" onchange="igstcheckf(this.value); procalc(<?=$rowselect['consigneeno']?>)" tabindex="55">
<input type="hidden" step="0.01" min="0" class="consgst" name="consgst[]" id="consgst<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consgst']?>" placeholder="SGST (<?=$rowselect['consigneeno']?>)" onchange="sgstcheckf(this.value); procalc(<?=$rowselect['consigneeno']?>)" tabindex="56">
<input type="hidden" step="0.01" min="0" class="concgst" name="concgst[]" id="concgst<?=$rowselect['consigneeno']?>" value="<?=$rowselect['concgst']?>" placeholder="CGST (<?=$rowselect['consigneeno']?>)" onchange="procalc(<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="57">
<input type="hidden" step="0.01" min="0" class="conigstamount" name="conigstamount[]" id="conigstamount<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conigstamount']?>" placeholder="IGST AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="58">
<input type="hidden" step="0.01" min="0" class="consgstamount" name="consgstamount[]" id="consgstamount<?=$rowselect['consigneeno']?>" value="<?=$rowselect['consgstamount']?>" placeholder="SGST AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="59">
<input type="hidden" step="0.01" min="0" class="concgstamount" name="concgstamount[]" id="concgstamount<?=$rowselect['consigneeno']?>" value="<?=$rowselect['concgstamount']?>" placeholder="CGST AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="60">
<td><input type="number" step="0.01" min="0" class="contotal" name="contotal[]" id="contotal<?=$rowselect['consigneeno']?>" value="<?=$rowselect['contotal']?>" placeholder="TOTAL AMOUNT (<?=$rowselect['consigneeno']?>)" readonly tabindex="-1" tabindex="61" ></td>
<input type="hidden" step="0.01" min="0" class="conwarranty" name="conwarranty[]" id="conwarranty<?=$rowselect['consigneeno']?>" value="<?=$rowselect['conwarranty']?>" placeholder="WARRANTY MONTHS (<?=$rowselect['consigneeno']?>)" onchange="warrantycheckf(this.value);" tabindex="62">
</tr>
<?php
$i++;
$cons=$rowselect['consigneeno'];
}
}
?>
</tbody>
</table>
</div>
<br>
<div class="row">
<div class="col-lg-6">
</div>
<div class="col-lg-6">

<div class="form-group row">
    <label for="subtotalamount" class="col-sm-6 col-form-label text-right">Sub Total Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="subtotalamount" name="subtotalamount" style="text-align:right">
    </div>
  </div>


<div class="form-group row">
    <label for="totalgstamount" class="col-sm-6 col-form-label text-right">Total GST Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="totalgstamount" name="totalgstamount" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="netamount" class="col-sm-6 col-form-label text-right">Net Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="netamount" name="netamount" style="text-align:right" >
    </div>
  </div>
    <div class="row">
  <label for="subtotalamount" class="col-sm-3 col-form-label text-right">Discount</label>
<div class="form-group col-sm-3">
<div class="input-group">
<input type="number" name="discount" id="discount" class="form-control" onchange="procalc(<?=$rowselect1['consigneeno']?>)" style="text-align:right" min="0" step="0.01" value="<?=$rowselect1['discount']?>">	
<div class="input-group-append">
<select id="discountmode" name="discountmode" class="form-control" data-live-search="true" onchange="procalc(<?=$rowselect1['consigneeno']?>)">
<option value="percentage" <?=($rowselect1['discountmode']=='percentage')?'selected':''?>>%</option>
<option value="rupee" <?=($rowselect1['discountmode']=='rupee')?'selected':''?>>₹</option>
</select>
</div>
</div>
</div>
<div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="discountamount" name="discountamount" style="text-align:right" >
    </div>
</div>
  <div class="form-group row">
    <label for="addamount" class="col-sm-6 col-form-label text-right">Add Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control" id="addamount" name="addamount" onChange="procalc(<?=$rowselect1['consigneeno']?>)"  value="<?=$rowselect1['addamount']?>" style="text-align:right" >
    </div>
  </div>
  
    <div class="form-group row">
    <label for="lessamount" class="col-sm-6 col-form-label text-right">Less Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control" id="lessamount" name="lessamount" onChange="procalc(<?=$rowselect1['consigneeno']?>)"   value="<?=$rowselect1['lessamount']?>" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="buyback" class="col-sm-6 col-form-label text-right">BuyBack Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control" id="buyback" name="buyback" onChange="procalc(1)" style="text-align:right" >
    </div>
  </div>
  <div class="form-group row">
    <label for="buyremark" class="col-sm-6 col-form-label text-right">BuyBack Remarks</label>
    <div class="col-sm-6">
	<textarea class="form-control" id="buyremark" name="buyremark"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="grandtotal" class="col-sm-6 col-form-label text-right font-weight-bold">Grand Total (₹)</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="grandtotal" name="grandtotal" style="text-align:right" >
    </div>
  </div>

</div>
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
<!-----serial  change modal---->
<div class="modal fade" id="serialchangemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Serials</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="serialform">


<div id="seriallist">
</div>
</div>


<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

<input class="btn btn-primary" type="button" id="serialtag-form-submit" name="serialsubmit" value="Submit" onclick="serialsubmit1()">

</div>
</form>
</div>
</div>
</div>
<!-----serial change modal---->
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
source: 'consearch.php', select: function (event, ui) { $("#buyername").val(ui.item.value); $("#buyeraddress1").val(ui.item.address1); $("#buyeraddress2").val(ui.item.address2); $("#buyeraddress3").val(ui.item.area);$("#buyerdistrict").val(ui.item.district);$("#buyerpincode").val(ui.item.pincode);$("#buyermail").val(ui.item.email);$("#buyermobile").val(ui.item.mobile);$("#buyerphone").val(ui.item.phone);$("#buyercontact").val(ui.item.contact);$("#bgst").val(ui.item.gstno);$("#buyerstate").val(ui.item.statecode);$("#rtype").val(ui.item.gsttype);$("#maincategory").val(ui.item.maincategory);$("#subcategory").val(ui.item.subcategory);$("#department").val(ui.item.department);}, minLength: 3
});
$( "#otherreference" ).autocomplete({
source: 'tallysearch.php?type=assest&table=jrcassest',
});
$( "#buyerstate" ).autocomplete({
source: 'tallysearch.php?type=statecode&table=jrcplace',
});
$( "#buyerdistrict" ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( "#buyerpincode" ).autocomplete({
source: 'tallysearch.php?type=pincode&table=jrcconsignee',
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
var condepartment=document.getElementsByName("condepartment[]");
var conmaincategory=document.getElementsByName("conmaincategory[]");
var consubcategory=document.getElementsByName("consubcategory[]");
var condistrict=document.getElementsByName("condistrict[]");
var conproduct=document.getElementsByName("conproduct[]");
var promaincategory=document.getElementsByName("promaincategory[]");
var prosubcategory=document.getElementsByName("prosubcategory[]");
var componentname=document.getElementsByName("componentname[]");
var componenttype=document.getElementsByName("componenttype[]");
var conprogroup=document.getElementsByName("conprogroup[]");
var conproductcode=document.getElementsByName("conproductcode[]");
var conmarketname=document.getElementsByName("conmarketname[]");
var conmake=document.getElementsByName("conmake[]");
var concapacity=document.getElementsByName("concapacity[]");
var conpromodel=document.getElementsByName("conpromodel[]");
var conper=document.getElementsByName("conper[]");
var conhsncode=document.getElementsByName("conhsncode[]");
var conaddress3=document.getElementsByName("conaddress3[]");
var contaluk=document.getElementsByName("contaluk[]");
var constatecode=document.getElementsByName("constatecode[]");
var conpincode=document.getElementsByName("conpincode[]");
var conwarranty=document.getElementsByName("conwarranty[]");
var congstvalue=document.getElementsByName("congstvalue[]");
for(var i=0;i<consigneeno.length;i++)
{
$( consigneename[i] ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( condepartment[i] ).autocomplete({
source: 'consigneesearch.php?type=department',
});
$( conmaincategory[i] ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
});
$( consubcategory[i] ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
});
$( condistrict[i] ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( constatecode[i] ).autocomplete({
source: 'tallysearch.php?type=statecode&table=jrcplace',
});
$( conproduct[i] ).autocomplete({
source: 'tallysearch.php?type=stockitem&table=jrcproduct',
});
$( promaincategory[i] ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
});
$( prosubcategory[i] ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
});
$( componenttype[i] ).autocomplete({
source: 'tallysearch.php?type=componenttype&table=jrcproduct',
});
$( componentname[i] ).autocomplete({
source: 'tallysearch.php?type=componentname&table=jrcproduct',
});
$( conproductcode[i]).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( conmarketname[i]).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct',
});
$( conmake[i]).autocomplete({
source: 'tallysearch.php?type=make&table=jrcproduct',
});
$( concapacity[i]).autocomplete({
source: 'tallysearch.php?type=capacity&table=jrcproduct',
});
$( conpromodel[i]).autocomplete({
source: 'tallysearch.php?type=model&table=jrcproduct',
});
$( conper[i]).autocomplete({
source: 'tallysearch.php?type=unit&table=jrcproduct',
});
$( conhsncode[i]).autocomplete({
source: 'tallysearch.php?type=hsncode&table=jrcproduct',
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
$( deliverymethod[i]).autocomplete({
source: 'tallysearch.php?type=deliverymethod&table=jrctallly',
});
$( lrno[i]).autocomplete({
source: 'tallysearch.php?type=lrno&table=jrctally',
});
$( agentname[i]).autocomplete({
source: 'tallysearch.php?type=agentname&table=jrctally',
});
$( vechileno[i]).autocomplete({
source: 'tallysearch.php?type=vechileno&table=jrcproduct',
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
$( "#condepartment<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=department',
});
$( "#conmaincategory<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
});
$( "#consubcategory<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
});
$( "#condistrict<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( "#conprogroup<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=typeofproduct&table=jrcproduct',
});
$( "#conmultiple<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=conmultiple&table=jrctally',
});
$( "#conproductcode<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( "#concapacity<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=capacity&table=jrcproduct',
});
$( "#conpromodel<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=model&table=jrcproduct',
});
$( "#conproduct<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=stockitem&table=jrcproduct',
});
$( "#promaincategory<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
});
$( "#prosubcategory<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
});
$( "#componentname<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=componenttype&table=jrcproduct',
});
$( "#componenttype<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=componenttype&table=jrcproduct',
});
$( "#conper<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=unit&table=jrcproduct',
});
$( "#conunit<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=price&table=jrcproduct',
});
$( "#conmake<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=make&table=jrcproduct',
});
$( "#conhsncode<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=hsncode&table=jrcproduct',
});
$( "#conmarketname<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct',
});
$( "#deliverymethod<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=deliverymethod&table=jrctally',
});
$( "#lrno<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=lrno&table=jrctally',
});
$( "#agentname<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=agentname&table=jrctally',
});
$( "#vechileno<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=vechileno&table=jrctally',
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
source: 'productsearch1.php?type=code', select: function (event, ui) { $("#conproductcode<?=$i?>").val(ui.item.value);$("#conproductid<?=$i?>").val(ui.item.id); $("#conproduct<?=$i?>").val(ui.item.stockitem);$("#promaincategory<?=$i?>").val(ui.item.stockmaincategory);$("#prosubcategory<?=$i?>").val(ui.item.stocksubcategory);$("#componentname<?=$i?>").val(ui.item.componentname);$("#componenttype<?=$i?>").val(ui.item.componenttype); $("#conmarketname<?=$i?>").val(ui.item.marketname);$("#conmake<?=$i?>").val(ui.item.make);$("#concapacity<?=$i?>").val(ui.item.capacity);$("#conpromodel<?=$i?>").val(ui.item.model);$("#conper<?=$i?>").val(ui.item.unit);$("#conhsncode<?=$i?>").val(ui.item.hsncode);$("#conunit<?=$i?>").val(ui.item.price);$("#conprogroup<?=$i?>").val(ui.item.typeofproduct);$("#conwarranty<?=$i?>").val(ui.item.warranty);$("#congstvalue<?=$i?>").val(ui.item.gst);  
//statecode validate
    var supplierGST = $("#companystatecode").val(); 
    var buyerGST = $("#buyerstate").val();
    if (supplierGST ==buyerGST) {
      var gstValue = parseFloat(ui.item.gst);
      var sgst = gstValue / 2;
      var cgst = gstValue / 2;
      $("#consgst<?=$i?>").val(sgst); 
      $("#concgst<?=$i?>").val(cgst);
	 $("#conigst<?=$i?>").val("");
}
else{
	var gstValue = parseFloat(ui.item.gst);
	$("#conigst<?=$i?>").val(gstValue);
	$("#consgst<?=$i?>").val(""); 
    $("#concgst<?=$i?>").val("");
}


}, minLength: 2
}); 
$( "#conproduct<?=$i?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'productsearch1.php?type=stockitem', select: function (event, ui) { $("#conproduct<?=$i?>").val(ui.item.value); $("#conproductid<?=$i?>").val(ui.item.id);$("#conproductcode<?=$i?>").val(ui.item.code);$("#promaincategory<?=$i?>").val(ui.item.stockmaincategory);$("#prosubcategory<?=$i?>").val(ui.item.stocksubcategory);$("#componentname<?=$i?>").val(ui.item.componentname);$("#componenttype<?=$i?>").val(ui.item.componenttype); $("#conmarketname<?=$i?>").val(ui.item.marketname);$("#conmake<?=$i?>").val(ui.item.make);$("#concapacity<?=$i?>").val(ui.item.capacity);$("#conpromodel<?=$i?>").val(ui.item.model);$("#conper<?=$i?>").val(ui.item.unit);$("#conhsncode<?=$i?>").val(ui.item.hsncode);$("#conunit<?=$i?>").val(ui.item.price);$("#conprogroup<?=$i?>").val(ui.item.typeofproduct);$("#conwarranty<?=$i?>").val(ui.item.warranty);$("#congstvalue<?=$i?>").val(ui.item.gst); 
//statecode validate 
var supplierGST = $("#companystatecode").val(); 
    var buyerGST = $("#buyerstate").val();
    if (supplierGST ==buyerGST) {
      var gstValue = parseFloat(ui.item.gst);
      var sgst = gstValue / 2;
      var cgst = gstValue / 2;
      $("#consgst<?=$i?>").val(sgst); 
      $("#concgst<?=$i?>").val(cgst);
      $("#conigst<?=$i?>").val("");
}
else{
	var gstValue = parseFloat(ui.item.gst);
	$("#conigst<?=$i?>").val(gstValue);
	$("#consgst<?=$i?>").val(""); 
      $("#concgst<?=$i?>").val("");
}
  }, minLength: 2
}); 
$( "#consigneename<?=$i?>" ).autocomplete({
//source: 'consigneesearch.php?type=consigneename',
source: 'consearch.php', select: function (event, ui) { $("#consigneename<?=$i?>").val(ui.item.value); $("#consigneeid<?=$i?>").val(ui.item.id); $("#condepartment<?=$i?>").val(ui.item.department);$("#conmaincategory<?=$i?>").val(ui.item.maincategory);$("#consubcategory<?=$i?>").val(ui.item.subcategory);$("#conaddress1<?=$i?>").val(ui.item.address1); $("#conaddress2<?=$i?>").val(ui.item.address2); $("#conaddress3<?=$i?>").val(ui.item.area);$("#condistrict<?=$i?>").val(ui.item.district);$("#conpincode<?=$i?>").val(ui.item.pincode);$("#conemail<?=$i?>").val(ui.item.email);$("#conmobile<?=$i?>").val(ui.item.mobile);$("#congstno<?=$i?>").val(ui.item.gstno);$("#constatecode<?=$i?>").val(ui.item.statecode);$("#conphone<?=$i?>").val(ui.item.phone);$("#concontact<?=$i?>").val(ui.item.contact);}, minLength: 3
});

<?php
}
}
?>
 $( ".conproductcode" ).autocomplete({
source: 'productsearch1.php?type=code', select: function (event, ui) { 
const productNameInput = $(this).closest("tr").find(".conproduct");
const promainNameInput = $(this).closest("tr").find(".promaincategory");
const prosubNameInput = $(this).closest("tr").find(".prosubcategory");
const componentnameNameInput = $(this).closest("tr").find(".componentname");
const componenttypeNameInput = $(this).closest("tr").find(".componenttype");
const marketNameInput = $(this).closest("tr").find(".conmarketname");
const makeNameInput = $(this).closest("tr").find(".conmake");
const capacityNameInput = $(this).closest("tr").find(".concapacity");
const modelNameInput = $(this).closest("tr").find(".conpromodel");
const perNameInput = $(this).closest("tr").find(".conper");
const hsncodeNameInput = $(this).closest("tr").find(".conhsncode");
const unitNameInput = $(this).closest("tr").find(".conunit");
const groupNameInput = $(this).closest("tr").find(".conprogroup");
const warrantyNameInput = $(this).closest("tr").find(".conwarranty");
const gstNameInput = $(this).closest("tr").find(".congstvalue");
const igstNameInput = $(this).closest("tr").find(".conigst");
const sgstNameInput = $(this).closest("tr").find(".consgst");
const cgstNameInput = $(this).closest("tr").find(".concgst");

$(this).val(ui.item.value);
productNameInput.val(ui.item.stockitem);
promainNameInput.val(ui.item.stockmaincategory);
prosubNameInput.val(ui.item.stocksubcategory);
componentnameNameInput.val(ui.item.componentname);
componenttypeNameInput.val(ui.item.componenttype);
marketNameInput.val(ui.item.marketname);
makeNameInput.val(ui.item.make);
capacityNameInput.val(ui.item.capacity);
modelNameInput.val(ui.item.model);
perNameInput.val(ui.item.unit);
hsncodeNameInput.val(ui.item.hsncode);
unitNameInput.val(ui.item.price);
groupNameInput.val(ui.item.typeofproduct);
warrantyNameInput.val(ui.item.warranty);
gstNameInput.val(ui.item.gst);
var supplierGST = $("#companystatecode").val(); 
var buyerGST = $("#buyerstate").val();
if (supplierGST == buyerGST) {
    var gstValue = parseFloat(ui.item.gst);
    var sgst = gstValue / 2;
    var cgst = gstValue / 2;
    sgstNameInput.val(sgst);
    cgstNameInput.val(cgst);
	igstNameInput.val("");
} else {
	var gstValue = parseFloat(ui.item.gst);
    igstNameInput.val(gstValue);
	sgstNameInput.val("");
    cgstNameInput.val("");
}
return false;
}, minLength: 1 });
 
 $( ".conproduct" ).autocomplete({
source: 'productsearch1.php?type=stockitem', select: function (event, ui) { 
const productNameInput = $(this).closest("tr").find(".conproductcode");
const promainNameInput = $(this).closest("tr").find(".promaincategory");
const prosubNameInput = $(this).closest("tr").find(".prosubcategory");
const componentnameNameInput = $(this).closest("tr").find(".componentname");
const componenttypeNameInput = $(this).closest("tr").find(".componenttype");
const marketNameInput = $(this).closest("tr").find(".conmarketname");
const makeNameInput = $(this).closest("tr").find(".conmake");
const capacityNameInput = $(this).closest("tr").find(".concapacity");
const modelNameInput = $(this).closest("tr").find(".conpromodel");
const perNameInput = $(this).closest("tr").find(".conper");
const hsncodeNameInput = $(this).closest("tr").find(".conhsncode");
const unitNameInput = $(this).closest("tr").find(".conunit");
const groupNameInput = $(this).closest("tr").find(".conprogroup");
const warrantyNameInput = $(this).closest("tr").find(".conwarranty");
const gstNameInput = $(this).closest("tr").find(".congstvalue");
$(this).val(ui.item.value);
productNameInput.val(ui.item.code);
promainNameInput.val(ui.item.stockmaincategory);
prosubNameInput.val(ui.item.stocksubcategory);
componentnameNameInput.val(ui.item.componentname);
componenttypeNameInput.val(ui.item.componenttype);
marketNameInput.val(ui.item.marketname);
makeNameInput.val(ui.item.make);
capacityNameInput.val(ui.item.capacity);
modelNameInput.val(ui.item.model);
perNameInput.val(ui.item.unit);
hsncodeNameInput.val(ui.item.hsncode);
unitNameInput.val(ui.item.price);
groupNameInput.val(ui.item.typeofproduct);
warrantyNameInput.val(ui.item.warranty);
gstNameInput.val(ui.item.gst);
var supplierGST = $("#companystatecode").val(); 
var buyerGST = $("#buyerstate").val();
if (supplierGST == buyerGST) {
    var gstValue = parseFloat(ui.item.gst);
    var sgst = gstValue / 2;
    var cgst = gstValue / 2;
    sgstNameInput.val(sgst);
    cgstNameInput.val(cgst);
	igstNameInput.val("");
} else {
	var gstValue = parseFloat(ui.item.gst);
    igstNameInput.val(gstValue);
	sgstNameInput.val("");
    cgstNameInput.val("");
}
return false;
}, minLength: 1
});    
$( ".conprogroup" ).autocomplete({
source: 'tallysearch.php?type=typeofproduct&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});

$( ".conmultiple" ).autocomplete({
source: 'tallysearch.php?type=conmultiple&table=jrctally', select: function (event, ui) {      
}, minLength: 2
});
$( ".conproduct" ).autocomplete({
source: 'tallysearch.php?type=stockitem&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".promaincategory" ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".prosubcategory" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".componentname" ).autocomplete({
source: 'tallysearch.php?type=componentname&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".componenttype" ).autocomplete({
source: 'tallysearch.php?type=componenttype&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".conmarketname" ).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".conmake" ).autocomplete({
source: 'tallysearch.php?type=make&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".concapacity" ).autocomplete({
source: 'tallysearch.php?type=capacity&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".conpromodel" ).autocomplete({
source: 'tallysearch.php?type=model&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".conper" ).autocomplete({
source: 'tallysearch.php?type=unit&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
$( ".conhsncode" ).autocomplete({
source: 'tallysearch.php?type=hsncode&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
});
});
$( ".conunit" ).autocomplete({
source: 'tallysearch.php?type=price&table=jrcproduct', select: function (event, ui) {      
}, minLength: 2
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
var consigneeid=document.getElementsByName("consigneeid[]");
var consigneename=document.getElementsByName("consigneename[]");
var condepartment=document.getElementsByName("condepartment[]");
var conmaincategory=document.getElementsByName("conmaincategory[]");
var consubcategory=document.getElementsByName("consubcategory[]");
var conaddress1=document.getElementsByName("conaddress1[]");
var conaddress2=document.getElementsByName("conaddress2[]");
var conaddress3=document.getElementsByName("conaddress3[]");
var contaluk=document.getElementsByName("contaluk[]");
var condistrict=document.getElementsByName("condistrict[]");
var conpincode=document.getElementsByName("conpincode[]");
var constatecode=document.getElementsByName("constatecode[]");
var congstno=document.getElementsByName("congstno[]");
var conmobile=document.getElementsByName("conmobile[]");
var conphone=document.getElementsByName("conphone[]");
var concontact=document.getElementsByName("concontact[]");
var conemail=document.getElementsByName("conemail[]");
for(var i=0;i<consigneeno.length;i++)
{
consigneename[i].value=document.getElementById("buyername").value;
consigneeid[i].value=document.getElementById("buyerid").value;
condepartment[i].value=document.getElementById("department").value;
conmaincategory[i].value=document.getElementById("maincategory").value;
consubcategory[i].value=document.getElementById("subcategory").value;
conaddress1[i].value=document.getElementById("buyeraddress1").value;
conaddress2[i].value=document.getElementById("buyeraddress2").value;
conaddress3[i].value=document.getElementById("buyeraddress3").value;
contaluk[i].value=document.getElementById("buyertaluk").value;
condistrict[i].value=document.getElementById("buyerdistrict").value;
conpincode[i].value=document.getElementById("buyerpincode").value;
constatecode[i].value=document.getElementById("buyerstate").value;
congstno[i].value=document.getElementById("bgst").value;
conmobile[i].value=document.getElementById("buyermobile").value;
conphone[i].value=document.getElementById("buyerphone").value;
concontact[i].value=document.getElementById("buyercontact").value;
conemail[i].value=document.getElementById("buyermail").value;
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
var totalsubtotal=0;
var totalgst=0;
var totalnet=0;
var subtotalamount=document.getElementById("subtotalamount");
var pretotalamount=document.getElementById("pretotalamount");
var totalgstamount=document.getElementById("totalgstamount");
var netamount=document.getElementById("netamount");
var addamount=document.getElementById("addamount");
var lessamount=document.getElementById("lessamount");
var buyback=document.getElementById("buyback");
var grandtotal=document.getElementById("grandtotal");
var discount=document.getElementById("discount");
var discountmode=document.getElementById("discountmode");
var discountamount=document.getElementById("discountamount");
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
totalsubtotal+=total;
if(igst!='')
{
var itax = total * (parseFloat(igst)/ 100);
conigstamount[i].value=itax.toFixed(2);
totalgst+=itax;
var ttotal=parseFloat(total)+parseFloat(itax);
contotal[i].value=ttotal.toFixed(2);
totalnet+=ttotal;
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
totalgst+=ttax;
var ttotal=parseFloat(total)+parseFloat(ttax);
contotal[i].value=ttotal.toFixed(2);
totalnet+=ttotal;
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
subtotalamount.value=totalsubtotal.toFixed(2);
totalgstamount.value=totalgst.toFixed(2);
netamount.value=totalnet.toFixed(2);

var shipamount=0;
if(addamount.value!='')
{
	shipamount=addamount.value;
}
var lessamt=0;
if(lessamount.value!='')
{
	lessamt=lessamount.value;
}

var buybackamt=0;
if(buyback.value!='')
{
	buybackamt=buyback.value;
}

var discountamt=0;
if(discount.value!='')
{
if(discountmode.value=='percentage')
{
discountamt=((parseFloat(discount.value)*parseFloat(totalnet))/100);
}
else
{
discountamt=parseFloat(discount.value);
}
}
discountamount.value=discountamt.toFixed(2);

grandtotal.value=((parseFloat(totalnet)+parseFloat(shipamount))-(parseFloat(discountamt)+parseFloat(lessamt)+parseFloat(buybackamt))).toFixed(2);
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
$clone.find('#conmaincategory1').attr("id", "conmaincategory"+(j));
$clone.find('#consubcategory1').attr("id", "consubcategory"+(j));
$clone.find('#condepartment1').attr("id", "condepartment"+(j));
$clone.find('#conaddress11').attr("id", "conaddress1"+(j));
$clone.find('#conaddress21').attr("id", "conaddress2"+(j));
$clone.find('#conaddress31').attr("id", "conaddress3"+(j));
$clone.find('#contaluk1').attr("id", "contaluk"+(j));
$clone.find('#condistrict1').attr("id", "condistrict"+(j));
$clone.find('#conpincode1').attr("id", "conpincode"+(j));
$clone.find('#constatecode1'+j).attr("id", "constatecode"+(j));
$clone.find('#congstno1'+j).attr("id", "congstno"+(j));
$clone.find('#concontact1').attr("id", "concontact"+(j));
$clone.find('#conphone1').attr("id", "conphone"+(j));
$clone.find('#conmobile1').attr("id", "conmobile"+(j));
$clone.find('#conemail1').attr("id", "conemail"+(j));
$clone.find('#conprogroup1').attr("id", "conprogroup"+(j));
$clone.find('#conmultiple1').attr("id", "conmultiple"+(j));
$clone.find('#conproductcode1').attr("id", "conproductcode"+(j));
$clone.find('#promaincategory1').attr("id", "promaincategory"+(j));
$clone.find('#prosubcategory1').attr("id", "prosubcategory"+(j));
$clone.find('#conproduct1').attr("id", "conproduct"+(j));
$clone.find('#componentname1').attr("id", "componentname"+(j));
$clone.find('#componenttype1').attr("id", "componenttype"+(j));
$clone.find('#conmarketname1').attr("id", "conmarketname"+(j));
$clone.find('#conmake1'+j).attr("id", "conmake"+(j));
$clone.find('#concapacity1'+j).attr("id", "concapacity"+(j));
$clone.find('#conpromodel1'+j).attr("id", "conpromodel"+(j));
$clone.find('#conhsncode1'+j).attr("id", "conhsncode"+(j));
$clone.find('#conper1'+j).attr("id", "conper"+(j));
$clone.find('#conqty1'+j).attr("id", "conqty"+(j));
$clone.find('#conserialno1'+j).attr("id", "conserialno"+(j));
$clone.find('#condepartmentname1'+j).attr("id", "condepartmentname"+(j));
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
$clone.find('#conmaincategory'+j).attr("placeholder", "MAIN CATEGORY ("+j+")");
$clone.find('#consubcategory'+j).attr("placeholder", "SUB CATEGORY ("+j+")");
$clone.find('#condepartment'+j).attr("placeholder", "DEPARTMENT ("+j+")");
$clone.find('#conaddress1'+j).attr("placeholder", "ADDRESS 1 ("+j+")");
$clone.find('#conaddress2'+j).attr("placeholder", "ADDRESS 2 ("+j+")");
$clone.find('#conaddress3'+j).attr("placeholder", "ADDRESS 3 ("+j+")");
$clone.find('#contaluk'+j).attr("placeholder", "TALUK ("+j+")");
$clone.find('#condistrict'+j).attr("placeholder", "DISTRICT ("+j+")");
$clone.find('#conpincode'+j).attr("placeholder", "PIN CODE ("+j+")");
$clone.find('#constatecode'+j).attr("placeholder", "STATE CODE ("+j+")");
$clone.find('#congstno'+j).attr("placeholder", "GST.NO. ("+j+")");
$clone.find('#concontact'+j).attr("placeholder", "CONTACT PERSON ("+j+")");
$clone.find('#conphone'+j).attr("placeholder", "PHONE NO. ("+j+")");
$clone.find('#conmobile'+j).attr("placeholder", "MOBILE NO. ("+j+")");
$clone.find('#conemail'+j).attr("placeholder", "MAIL ID ("+j+")");
$clone.find('#conprogroup'+j).attr("placeholder", "PRODUCT GROUP ("+j+")");
$clone.find('#conmultiple'+j).attr("placeholder", "MULTIPLE GODOWN ("+j+")");
$clone.find('#conproductcode'+j).attr("placeholder", "PRODUCT CODE ("+j+")");
$clone.find('#promaincategory'+j).attr("placeholder", "MAIN CATEGORY ("+j+")");
$clone.find('#prosubcategory'+j).attr("placeholder", "SUB CATEGORY ("+j+")");
$clone.find('#conproduct'+j).attr("placeholder", "PRODUCT ("+j+")");
$clone.find('#componentname'+j).attr("placeholder", "COMPONENT NAME ("+j+")");
$clone.find('#componenttype'+j).attr("placeholder", "COMPONENT TYPE ("+j+")");
$clone.find('#conmarketname'+j).attr("placeholder", "MARKET NAME ("+j+")");
$clone.find('#conmake'+j).attr("placeholder", "MAKE ("+j+")");
$clone.find('#concapacity'+j).attr("placeholder", "CAPACITY ("+j+")");
$clone.find('#conpromodel'+j).attr("placeholder", "MODEL ("+j+")");
$clone.find('#conhsncode'+j).attr("placeholder", "HSN/SAC ("+j+")");
$clone.find('#conper'+j).attr("placeholder", "PER ("+j+")");
$clone.find('#conqty'+j).attr("placeholder", "QTY ("+j+")");
$clone.find('#serialnumber'+j).attr("placeholder", "SERIAL ("+j+")");
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
$clone.find('#conmaincategory'+j).attr("stag", j);
$clone.find('#consubcategory'+j).attr("stag", j);
$clone.find('#condepartment'+j).attr("stag", j);
$clone.find('#conaddress1'+j).attr("stag", j);
$clone.find('#conaddress2'+j).attr("stag", j);
$clone.find('#conaddress3'+j).attr("stag", j);
$clone.find('#contaluk'+j).attr("stag", j);
$clone.find('#condistrict'+j).attr("stag", j);
$clone.find('#conpincode'+j).attr("stag", j);
$clone.find('#constatecode'+j).attr("stag", j);
$clone.find('#congstno'+j).attr("stag", j);
$clone.find('#concontact'+j).attr("stag", j);
$clone.find('#conphone'+j).attr("stag", j);
$clone.find('#conmobile'+j).attr("stag", j);
$clone.find('#conemail'+j).attr("stag", j);
$clone.find('#conprogroup'+j).attr("stag", j);
$clone.find('#conmultiple'+j).attr("stag", j);
$clone.find('#conproductcode'+j).attr("stag", j);
$clone.find('#promaincategory'+j).attr("stag", j);
$clone.find('#prosubcategory'+j).attr("stag", j);
$clone.find('#conproduct'+j).attr("stag", j);
$clone.find('#componentname'+j).attr("stag", j);
$clone.find('#componenttype'+j).attr("stag", j);
$clone.find('#conmarketname'+j).attr("stag", j);
$clone.find('#conmake'+j).attr("stag", j);
$clone.find('#concapacity'+j).attr("stag", j);
$clone.find('#conpromodel'+j).attr("stag", j);
$clone.find('#conhsncode'+j).attr("stag", j);
$clone.find('#conper'+j).attr("stag", j);
$clone.find('#conqty'+j).attr("stag", j);
$clone.find('#serialnumber'+j).attr("stag", j);
$clone.find('#conunit'+j).attr("stag", j);
$clone.find('#conigst'+j).attr("stag", j);
$clone.find('#consgst'+j).attr("stag", j);
$clone.find('#concgst'+j).attr("stag", j);
$clone.find('#conigstamount'+j).attr("stag", j);
$clone.find('#consgstamount'+j).attr("stag", j);
$clone.find('#concgstamount'+j).attr("stag", j);
$clone.find('#contotal'+j).attr("stag", j);
$clone.find('#conwarranty'+j).attr("stag", j);
$clone.find('#consigneeno'+j).val(j);
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
source: 'tallysearch.php?type=typeofproduct&table=jrcproduct',
});
$( ".conmultiple" ).autocomplete({
source: 'tallysearch.php?type=conmultiple&table=jrctally',
});
$( ".promaincategory" ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
});
$( ".prosubcategory" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
});
$( ".conproduct" ).autocomplete({
source: 'tallysearch.php?type=stockitem&table=jrcproduct',
});
$( ".componentname" ).autocomplete({
source: 'tallysearch.php?type=componentname&table=jrcproduct',
});
$( ".componenttype" ).autocomplete({
source: 'tallysearch.php?type=componenttype&table=jrcproduct',
});
$( ".conproductcode" ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( ".conmarketname" ).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct',
});
$( ".conmake" ).autocomplete({
source: 'tallysearch.php?type=make&table=jrcproduct',
});
$( ".concapacity" ).autocomplete({
source: 'tallysearch.php?type=capacity&table=jrcproduct',
});
$( ".conpromodel" ).autocomplete({
source: 'tallysearch.php?type=model&table=jrcproduct',
});
$( ".conper" ).autocomplete({
source: 'tallysearch.php?type=unit&table=jrcproduct',
});
$( ".conhsncode" ).autocomplete({
source: 'tallysearch.php?type=hsncode&table=jrcproduct',
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
var dataString = $("#myForm1").serialize();
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
}, 6000);
}
});
}
setInterval(function(){
autoSave();
}, 6000);
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
		var cels=document.getElementsByClassName("concgst");
        for (var i=0;i<els.length;i++) {
            els[i].value = val;
			cels[i].value = val;
		}
	}
}
function warrantycheckf(val)
{
	var warrantycheck=document.getElementById("warrantycheck");
	if(warrantycheck.checked==true)
	{
		var els=document.getElementsByClassName("conwarranty");
        for (var i=0;i<els.length;i++) 
		{
            els[i].value = val;
		}
	}
}
</script>
<script>

/* function serialnumbers(id)
{
	var conqty=document.getElementById("conqty"+id).value;
var rserialnumber=document.getElementById('conserialno'+id).value;
var rdepartment=document.getElementById('condepartmentname'+id).value; 
const rserialnumbers = rserialnumber.split(" | ");
alert(rserialnumber);
//console.log(rserialnumbers);
const rdepartments = rdepartment.split(" | ");


	if(conqty!="")
	{
		var nos=parseFloat(conqty);
		if(nos>0)
		{
			var output="<input type='hidden' name='serialformid' id='serialformid'  value='"+id+"'>";
			for(var i=1; i<=nos; i++)
			{
				var svalue='';
				if(rserialnumbers[i-1])
				{
					svalue=rserialnumbers[i-1];
				}var dvalue='';
				if(rdepartments[i-1])
				{
					dvalue=rdepartments[i-1];
				}
				
				
				output+='<div class="row"><div class="col-lg-6"><div class="form-group"><label for="kserialnumber">'+i+')&nbsp;Serial Number</label><input type="text" class="form-control" id="kserialnumber'+i+'" name="kserialnumber[]" value="'+svalue+'"></div></div><div class="col-lg-6"><div class="form-group"><label for="kdepartment">Department</label><input type="text" class="form-control" id="kdepartment'+i+'" name="kdepartment[]" value="'+dvalue+'" ></div></div></div>';
				//alert(output);
			}
			document.getElementById("seriallist").innerHTML=output;
		}
		else
		{
			document.getElementById("seriallist").innerHTML="";
			
		}
	}
	else
	{
		document.getElementById("seriallist").innerHTML="";
	}
}
function serialsubmit1()
{
var id=document.getElementById('serialformid').value;
 var kserialnumbers=document.getElementsByName('kserialnumber[]');
var kdepartments=document.getElementsByName('kdepartment[]');
var rserialnumber='';
var rdepartment='';
for(var k=0;k<kserialnumbers.length;k++)
{
	if(kserialnumbers[k].value!='')
	{
		
		if(rserialnumber!='')
		{
			rserialnumber+=' | '+kserialnumbers[k].value;
		}
		else
		{
		rserialnumber=kserialnumbers[k].value;
		}
		
	}
	if(kdepartments[k].value!='')
	{
	
		if(rdepartment!='')
		{
	
			rdepartment+=' | '+kdepartments[k].value;
		}
		else
		{
			rdepartment=kdepartments[k].value;
		}
		
	}
}
document.getElementById('conserialno'+id).value=rserialnumber;
document.getElementById('condepartmentname'+id).value=rdepartment; 
//for submit toggle
    $('#serialchangemodal').modal('toggle'); //or  $('#IDModal').modal('hide');
	
} */

function serialnumbers(id)
{
	var conqty=document.getElementById("conqty"+id).value;
var rserialnumber=document.getElementById('conserialno'+id).value;
var rdepartment=document.getElementById('condepartmentname'+id).value; 
const rserialnumbers = rserialnumber.split(" | ");
console.log(rserialnumber);
//console.log(rserialnumbers);
const rdepartments = rdepartment.split(" | ");


	if(conqty!="")
	{
		var nos=parseFloat(conqty);
		if(nos>0)
		{
			var output="<input type='hidden' name='serialformid' id='serialformid'  value='"+id+"'>";
			for(var i=1; i<=nos; i++)
			{
				var svalue='';
				if(rserialnumbers[i-1])
				{
					svalue=rserialnumbers[i-1];
				}var dvalue='';
				if(rdepartments[i-1])
				{
					dvalue=rdepartments[i-1];
				}
				
				
				output+='<div class="row"><div class="col-lg-6"><div class="form-group"><label for="kserialnumber">'+i+')&nbsp;Serial Number</label><input type="text" class="form-control" id="kserialnumber'+i+'" name="kserialnumber[]" value="'+svalue+'"></div></div><div class="col-lg-6"><div class="form-group"><label for="kdepartment">Department</label><input type="text" class="form-control" id="kdepartment'+i+'" name="kdepartment[]" value="'+dvalue+'" ></div></div></div>';
				//alert(output);
			}
			document.getElementById("seriallist").innerHTML=output;
		}
		else
		{
			document.getElementById("seriallist").innerHTML="";
			
		}
	}
	else
	{
		document.getElementById("seriallist").innerHTML="";
	}
}
function serialsubmit1()
{
var id=document.getElementById('serialformid').value;
 var kserialnumbers=document.getElementsByName('kserialnumber[]');
var kdepartments=document.getElementsByName('kdepartment[]');
var rserialnumber='';
var rdepartment='';
for(var k=0;k<kserialnumbers.length;k++)
{
	if(kserialnumbers[k].value!='')
	{
		
		if(rserialnumber!='')
		{
			rserialnumber+=' | '+kserialnumbers[k].value;
		}
		else
		{
		rserialnumber=kserialnumbers[k].value;
		}
		
	}
	if(kdepartments[k].value!='')
	{
	
		if(rdepartment!='')
		{
	
			rdepartment+=' | '+kdepartments[k].value;
		}
		else
		{
			rdepartment=kdepartments[k].value;
		}
		
	}
}
document.getElementById('conserialno'+id).value=rserialnumber;
document.getElementById('condepartmentname'+id).value=rdepartment; 
//for submit toggle
    $('#serialchangemodal').modal('toggle'); //or  $('#IDModal').modal('hide');
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
function checkGSTINRequirement() {
  var invoiceType = document.getElementById("invoicetype").value;
  var gstinFields = document.getElementsByName("congst[]");
  var gstinField = document.getElementById("bgst");
  var asterisk = document.getElementById("asterisk");

  if (invoiceType == "B2B") {
    gstinField.style.display = "block";
    document.getElementById("bgst").required = true;
    document.getElementsByName("congst[]").required = true;
    asterisk.style.display = "inline"; // Show the asterisk
    asterisk1.style.display = "inline"; // Show the asterisk
  } else {
    gstinField.style.display = "block";
	document.getElementById("bgst").required = false;
	document.getElementsByName("congst[]").required = false;
    asterisk.style.display = "none"; // Hide the asterisk
    asterisk1.style.display = "none"; // Hide the asterisk
  }
}
</script>
<!-- Auto Submit Or Draft Values-->
<?php include('additionaljs.php');   ?>
</body>
</html>