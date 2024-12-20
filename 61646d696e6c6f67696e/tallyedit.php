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
/* if($_POST['sotype']=="Regular")
{
$invoicenofrom=(float)$infos['invoiceno']+1;
$invoicenoto=(float)$infos['invoiceno']+(float)$noofconsignee;
}
else
{
$invoicenofrom=(float)$infos['serviceinvoice']+1;
$invoicenoto=(float)$infos['serviceinvoice']+(float)$noofconsignee;
} */
$invoicetype=mysqli_real_escape_string($connection,$_POST['invoicetype']);
//$salesledger=mysqli_real_escape_string($connection,$_POST['salesledger']);
$sotype=mysqli_real_escape_string($connection,$_POST['sotype']);
$orderreceived=mysqli_real_escape_string($connection,$_POST['orderreceived']);
$maincategory=mysqli_real_escape_string($connection,$_POST['maincategory']);
$tender=mysqli_real_escape_string($connection,$_POST['tender']);
$subcategory=mysqli_real_escape_string($connection,$_POST['subcategory']);
$department=mysqli_real_escape_string($connection,$_POST['department']);
$pono=mysqli_real_escape_string($connection,$_POST['pono']);
$podate=mysqli_real_escape_string($connection,$_POST['podate']);
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
$bgst=mysqli_real_escape_string($connection,$_POST['bgst']);
$reftime=mysqli_real_escape_string($connection,$_POST['reftime']);
 if (!file_exists('../padhivetram/pofile/')) {
        mkdir('../padhivetram/pofile/', 0777, true);
    }
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
				  } else 
				  {
					$attachments="";
				  }
/* if($reftime!='')
{
$sqlselect = "SELECT reftime,id From jrctallydraft where reftime='".$reftime."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
$rowselect = mysqli_fetch_array($queryselect);
$sqllreftime=mysqli_query($connection,"DELETE FROM jrctallydraft WHERE reftime='".$rowselect['reftime']."'");
} */
for($i=0;$i<count($_POST['consigneeno']);$i++)
{
	for($j=1;$j<=$maxproduct;$j++)
{
$consigneeno=mysqli_real_escape_string($connection,$_POST['consigneeno'][$i]);
/* if($_POST['sotype']=="Regular")
{
$sono='SO / REG / '.(date('my')).' /'.(str_pad((float)$infos['invoiceno']+($consigneeno), 4, '0', STR_PAD_LEFT));
}
else
{
$sono='SO / SER / '.(date('my')).' /'.(str_pad((float)$infos['serviceinvoice']+($consigneeno), 4, '0', STR_PAD_LEFT));
} */
$id=mysqli_real_escape_string($connection,$_POST['id'][$i]);
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename'][$i]);
$consigneeid=mysqli_real_escape_string($connection,$_POST['consigneeid'][$i]);
$conmaincategory=mysqli_real_escape_string($connection,$_POST['conmaincategory'][$i]);
$consubcategory=mysqli_real_escape_string($connection,$_POST['consubcategory'][$i]);
$condepartment=mysqli_real_escape_string($connection,$_POST['condepartment'][$i]);
$conaddress1=mysqli_real_escape_string($connection,$_POST['conaddress1'][$i]);
$conaddress2=mysqli_real_escape_string($connection,$_POST['conaddress2'][$i]);
$conaddress3=mysqli_real_escape_string($connection,$_POST['conaddress3'][$i]);
$contaluk=mysqli_real_escape_string($connection,$_POST['contaluk'][$i]);
$condistrict=mysqli_real_escape_string($connection,$_POST['condistrict'][$i]);
$conpincode=mysqli_real_escape_string($connection,$_POST['conpincode'][$i]);
$constatecode=mysqli_real_escape_string($connection,$_POST['constatecode'][$i]);
$congstno=mysqli_real_escape_string($connection,$_POST['congstno'][$i]);
$concontact=mysqli_real_escape_string($connection,$_POST['concontact'][$i]);
$conphone=mysqli_real_escape_string($connection,$_POST['conphone'][$i]);
$conmobile=mysqli_real_escape_string($connection,$_POST['conmobile'][$i]);
$conemail=mysqli_real_escape_string($connection,$_POST['conemail'][$i]);
}
$conprogroup=mysqli_real_escape_string($connection,$_POST['conprogroup'][$i]);
$conmultiple=mysqli_real_escape_string($connection,$_POST['conmultiple'][$i]);
$promaincategory=mysqli_real_escape_string($connection,$_POST['promaincategory'][$i]);
$hsntype=mysqli_real_escape_string($connection,$_POST['hsntype'][$i]);
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
$conunitqty=mysqli_real_escape_string($connection,$_POST['conunitqty'][$i]);
$conunit=mysqli_real_escape_string($connection,$_POST['conunit'][$i]);
$conigst=mysqli_real_escape_string($connection,$_POST['conigst'][$i]);
$consgst=mysqli_real_escape_string($connection,$_POST['consgst'][$i]);
$concgst=mysqli_real_escape_string($connection,$_POST['concgst'][$i]);
$conigstamount=mysqli_real_escape_string($connection,$_POST['conigstamount'][$i]);
$consgstamount=mysqli_real_escape_string($connection,$_POST['consgstamount'][$i]);
$concgstamount=mysqli_real_escape_string($connection,$_POST['concgstamount'][$i]);
$contotal=mysqli_real_escape_string($connection,$_POST['contotal'][$i]);
$subtotalamount=mysqli_real_escape_string($connection,$_POST['subtotalamount'][$i]);
$totalgstamount=mysqli_real_escape_string($connection,$_POST['totalgstamount'][$i]);
$netamount=mysqli_real_escape_string($connection,$_POST['netamount'][$i]);
$discount=mysqli_real_escape_string($connection,$_POST['discount'][$i]);
$discountmode=mysqli_real_escape_string($connection,$_POST['discountmode'][$i]);
$discountamount=mysqli_real_escape_string($connection,$_POST['discountamount'][$i]);
$addamount=mysqli_real_escape_string($connection,$_POST['addamount'][$i]);
$lessamount=mysqli_real_escape_string($connection,$_POST['lessamount'][$i]);
$buyback=mysqli_real_escape_string($connection,$_POST['buyback'][$i]);
$buyremark=mysqli_real_escape_string($connection,$_POST['buyremark'][$i]);
$ichargeremark=mysqli_real_escape_string($connection,$_POST['ichargeremark'][$i]);
$grandtotal=mysqli_real_escape_string($connection,$_POST['grandtotal'][$i]);
$conwarranty=mysqli_real_escape_string($connection,$_POST['conwarranty'][$i]);

    $sqlcon = "SELECT id From jrctally WHERE sono = '{$_POST['sono']}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{
$sqls2 =mysqli_query($connection, "update jrctally set sotype='$sotype', invoicetype='$invoicetype', orderreceived='$orderreceived', pono='$pono', podate='$podate', buyername='$buyername', buyerid='$buyerid', maincategory='$maincategory', tender='$tender',  subcategory='$subcategory',  department='$department',  buyeraddress1='$buyeraddress1', buyeraddress2='$buyeraddress2', buyeraddress3='$buyeraddress3', buyertaluk='$buyertaluk', buyerdistrict='$buyerdistrict', buyerpincode='$buyerpincode', bgst='$bgst', buyerstate='$buyerstate', buyermobile='$buyermobile', buyerphone='$buyerphone', buyercontact='$buyercontact', buyermail='$buyermail', consigneeid='$consigneeid', consigneename='$consigneename', conmaincategory='$conmaincategory', consubcategory='$consubcategory', condepartment='$condepartment', conaddress1='$conaddress1', conaddress2='$conaddress2', conaddress3='$conaddress3', contaluk='$contaluk', condistrict='$condistrict', conpincode='$conpincode', constatecode='$constatecode', congstno='$congstno', concontact='$concontact', conphone='$conphone', conmobile='$conmobile', conemail='$conemail', consigneeno='$consigneeno', conprogroup='$conprogroup', conmultiple='$conmultiple', conproductcode='$conproductcode', promaincategory='$promaincategory', hsntype='$hsntype', prosubcategory='$prosubcategory',  conproductid='$conproductid',  conproduct='$conproduct', componenttype='$componenttype', componentname='$componentname',  conmarketname='$conmarketname',  conmake='$conmake',  concapacity='$concapacity', conpromodel='$conpromodel', conhsncode='$conhsncode', conper='$conper', conqty='$conqty', conunitqty='$conunitqty', conunit='$conunit', discount='$discount',  discountmode='$discountmode',  discountamount='$discountamount',  conigst='$conigst',  consgst='$consgst',  concgst='$concgst', conigstamount='$conigstamount',  consgstamount='$consgstamount', concgstamount='$concgstamount', contotal='$contotal',  conwarranty='$conwarranty', subtotalamount='$subtotalamount', netamount='$netamount', addamount='$addamount', totalgstamount='$totalgstamount',  buyback='$buyback',  buyremark='$buyremark',  grandtotal='$grandtotal' where id='$id'");
		}
		else
			{
				header("Location: exporttally.php?error=This record is Not Found! Kindly check in All Sales order List");
				 exit;
			}
}
if($sqls2)
{
/* if($_POST['sotype']=="Regular")
{
$sqls=mysqli_query($connection,"update jrcinvoice set invoiceno='$invoicenoto'");
header("Location:exporttally.php?remarks=Added Successfully");
}
else
{
$sqls=mysqli_query($connection,"update jrcinvoice set serviceinvoice='$invoicenoto'");
header("Location:exporttally.php?remarks=Added Successfully");
} */
header("Location:exporttally.php?remarks=Updated Successfully");
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
<body id="page-top" onload="initProcalcs(); checkGSTINRequirement();">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php /* include('salesnavbar.php'); */?>
<div class="container-fluid">
<!-- Page Heading -->


<div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Add New Sales Order</b></h6>
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
<?php
if(isset($_GET['id']))	{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT * From jrctally where sono='".$id."'";
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
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-body">
<form action="" id="myForm1" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
<input type="hidden" name="noofconsignee" value="<?=$noofconsignee?>">
<input type="hidden" name="maxproduct" value="<?=$maxproduct?>">
<input type="hidden" name="sono" value="<?=$rowselect1['sono']?>">
<input type="hidden" id="reftime" name="reftime" value="<?=time().rand()?>">
<div class="row">

<div class="col-lg-4">
<div class="cardbox2">
  <div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
   <h6 class="card-title2" data-toggle="collapse" data-target="#collapseSalesOrder"><b>Sales Order Information</b></h6>
    </div>
	   <div class="card-body2 collapse show" id="collapseSalesOrder" style="height:330px;">	
  <div class="form-group">
  <div class="input-container">
<label for="sotype">S.O. Type :<span class="text-danger">*</span></label>
<select class="form-control fav_clr" id="sotype" name="sotype">
<option value="Regular"<?=($rowselect1['sotype']=="Regular")?'selected':''?>>Regular Sales Order </option>
<option value="Service"<?=($rowselect1['sotype']=="Service")?'selected':''?>>Service Sales Order </option>
</select>
  </div>
  </div>
 <div class="form-group">
  <div class="input-container">
    <label for="invoicetype">Registration Type :<span class="text-danger">*</span></label>
    <select class="form-control fav_clr" id="invoicetype" name="invoicetype" onchange="checkGSTINRequirement()">
	  <option value="B2B"<?=($rowselect1['invoicetype']=="B2B")?'selected':''?>>Registered Dealer (B2B) </option>
	  <option value="B2C"<?=($rowselect1['invoicetype']=="B2C")?'selected':''?>>Unregistered Dealer (B2C) </option>
    </select>
  </div>
</div>
  <div class="form-group">
    <div class="input-container">
<label for="orderreceived">Order Received By :</label>
<input type="text" class="form-control" id="orderreceived" name="orderreceived" value="<?=$rowselect1['orderreceived']?>">
  </div>
  </div>
<div class="form-group">
<div class="input-container">
<label for="pono">P.O. No :</label>
<input type="text" class="form-control" id="pono" name="pono" value="<?=$rowselect1['pono']?>">
<input type="hidden" name="orderstatus" id="orderstatus" value="0">
<span id="orderexist" style="color:red;font-weight:bold; display:none">This P.O. No Already Exists</span>
</div>
</div>
<div class="form-group">
<div class="input-container">
<label for="podate">P.O. Date :</label>
<input type="date" class="form-control" id="podate" name="podate" value="<?=$rowselect1['podate']?>">
</div>
</div>
<div class="form-group" style="display:none"> 
<div class="input-container">
<label for="attachments">Attach File(s) - Purchase Order :</label>
<input type="file" class="form-control" id="attachments" name="attachments" style="padding:2px; height:auto">

</div>
</div>
<div class="form-group text-center" style="display:none">
<label for="terms">You can upload a maximum of two files, Each with a size limit of 2MB</label>
</div>
   
  </div>
  </div>
</div>
<div class="col-lg-8">
<div class="cardbox2">
  <div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
  <h6 class="card-title2" data-toggle="collapse" data-target="#collapsebuyerOrder"><b>Buyer Information</b></h6>
    </div>
	 <div class="card-body2 collapse show" id="collapsebuyerOrder" style="height:329px;">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<div class="input-container">
<label for="buyername">Buyer Name : <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyername" name="buyername" maxlength="100" value="<?=$rowselect1['buyername']?>" required>
<input type="hidden" class="form-control" id="buyerid" name="buyerid" value="<?=$rowselect1['buyerid']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="maincategory">Main Category :</label>
<input type="text" class="form-control" id="maincategory" name="maincategory" value="<?=$rowselect1['maincategory']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="tender">Tender :</label>
<input type="text" class="form-control" id="tender" name="tender" value="<?=$rowselect1['tender']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="subcategory">Sub Category :</label>
<input type="text" class="form-control" id="subcategory" name="subcategory" value="<?=$rowselect1['subcategory']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="department">Department Name :</label>
<input type="text" class="form-control" id="department" name="department" value="<?=$rowselect1['department']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyeraddress1">Address 1 : <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyeraddress1" name="buyeraddress1" value="<?=$rowselect1['buyeraddress1']?> required maxlength="100">
</div>
</div>
   
<div class="form-group">
<div class="input-container">
<label for="buyeraddress2">Address 2 :</label>
<input type="text" class="form-control" id="buyeraddress2" name="buyeraddress2" value="<?=$rowselect1['buyeraddress2']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyeraddress3">Address 3 :</label>
<input type="text" class="form-control" id="buyeraddress3" name="buyeraddress3" value="<?=$rowselect1['buyeraddress3']?>">
</div>
</div>


<div class="form-group">
<div class="input-container">
<label for="buyertaluk">Taluk :</label>
<input type="text" class="form-control" id="buyertaluk" name="buyertaluk" value="<?=$rowselect1['buyertaluk']?>">
</div>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<div class="input-container">
<label for="buyerdistrict">District : <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerdistrict" name="buyerdistrict" value="<?=$rowselect1['buyerdistrict']?>" required maxlength="50">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyerpincode">Pincode : <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerpincode" name="buyerpincode" maxlength="6" value="<?=$rowselect1['buyerpincode']?>" inputmode="numeric" required>
</div>
</div>

<div class="form-group" id="gstinField">
  <div class="input-container">
    <label for="bgst">GSTIN No : <span id="asterisk1" class="text-danger">*</span></label>
    <input type="text" class="form-control" id="bgst" name="bgst" maxlength="15" value="<?=$rowselect1['bgst']?>" required>
  </div>
</div>

<div class="form-group">
 <div class="input-container">
<label for="buyerstate">State Code & State : <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerstate" name="buyerstate" value="<?=$rowselect1['buyerstate']?>"  required>
<input type="hidden" class="form-control" id="companystatecode" name="companystatecode" value="<?=$_SESSION['companystatecode']?>"  required>
</div>
</div>

<div class="form-group">
 <div class="input-container">
<label for="buyermobile">Mobile Number :</label>
<input type="text" class="form-control" id="buyermobile" name="buyermobile" maxlength="10" inputmode="numeric" value="<?=$rowselect1['buyermobile']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyerphone">Phone Number :</label>
<input type="text" class="form-control" id="buyerphone" name="buyerphone" maxlength="11" inputmode="numeric" value="<?=$rowselect1['buyerphone']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyercontact">Contact Person :</label>
<input type="text" class="form-control" id="buyercontact" name="buyercontact" value="<?=$rowselect1['buyercontact']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyermail">E-mail :<span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyermail" name="buyermail" maxlength="320" required value="<?=$rowselect1['buyermail']?>">
</div>
</div>
<div class="form-group text-center">
<label for="sameas" class="text-danger text-center"><input type="checkbox" id="sameas" name="sameas" onchange="sameass()"> Customer Address Same as Buyer Address</label>
</div>
  </div>
  </div>
  </div>
 
  </div>
</div>

</div>

<br>

<div class="row">
<?php
$sqlselect = "SELECT * From jrctally where sono='".$id."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$i=1;
$r=1;
$cons='';
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<div class="col-lg-4" <?php if($r != 1) { echo 'style="display:none;"'; } ?>>

<div class="cardbox2">
  <div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Consignee Information</b></h6>
    </div>
	
    <div class="card-body2" id="customerBody" style="height:515px;">
 
<div class="form-group">
<div class="input-container">
<label for="no">No :</label>
<input type="text" class="form-control tr_clone rowcount<?=$i?>" id="no" name="no" value="<?=$i?>" readonly>
<input type="hidden" class="consigneeid" id="consigneeid<?=$i?>" name="consigneeid[]" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'id')" >
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="maincategory">Consignee Name :<span class="text-danger">*</span></label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'consigneename')" class="consigneename" name="consigneename[]" id="consigneename<?=$i?>" placeholder="CONSIGNEE NAME (<?=$i?>)" maxlength="100" value="<?=$rowselect['consigneename']?>" required>
<input type="hidden" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conmaincategory')" class="conmaincategory" name="conmaincategory[]" id="conmaincategory<?=$i?>" placeholder="MAIN CATEGORY (<?=$i?>)"  onKeyup="cleartext<?=$i?>()" value="<?=$rowselect['conmaincategory']?>">
<input type="hidden" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'consubcategory')" class="consubcategory" name="consubcategory[]" id="consubcategory<?=$i?>" placeholder="SUB CATEGORY (<?=$i?>)" onKeyup="cleartext<?=$i?>()" value="<?=$rowselect['consubcategory']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="tender">Department :</label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'condepartment')" class="condepartment" name="condepartment[]" id="condepartment<?=$i?>" placeholder="DEPARTMENT (<?=$i?>)" onKeyup="cleartext<?=$i?>()" value="<?=$rowselect['condepartment']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="subcategory">Address 1 :<span class="text-danger">*</span></label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress1')" class="conaddress1" name="conaddress1[]" id="conaddress1<?=$i?>" placeholder="ADDRESS 1 (<?=$i?>)" maxlength="100" required value="<?=$rowselect['conaddress1']?>"> 
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="department">Address 2 :</label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress2')" class="conaddress2" name="conaddress2[]" id="conaddress2<?=$i?>" placeholder="ADDRESS 2 (<?=$i?>)" value="<?=$rowselect['conaddress2']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyeraddress1">Address 3 :</label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conaddress3')" class="conaddress3" name="conaddress3[]" id="conaddress3<?=$i?>" placeholder="ADDRESS 3 (<?=$i?>)" value="<?=$rowselect['conaddress3']?>">
</div>
</div>
   
<div class="form-group">
<div class="input-container">
<label for="buyeraddress2">Taluk :</label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'contaluk')" class="contaluk" name="contaluk[]" id="contaluk<?=$i?>" placeholder="TALUK (<?=$i?>)" value="<?=$rowselect['contaluk']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyeraddress3">District :<span class="text-danger">*</span></label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'condistrict')" class="condistrict" name="condistrict[]" id="condistrict<?=$i?>" placeholder="DISTRICT (<?=$i?>)" maxlength="50" required value="<?=$rowselect['condistrict']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyertaluk">Pin Code :<span class="text-danger">*</span></label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conpincode')" class="conpincode" name="conpincode[]" id="conpincode<?=$i?>" placeholder="PIN CODE (<?=$i?>)"  maxlength="6" inputmode="numeric"  onKeyup="cleartext<?=$i?>()" required value="<?=$rowselect['conpincode']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyerdistrict">State Code & State : <span class="text-danger">*</span></label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'constatecode')" class="constatecode" name="constatecode[]" id="constatecode<?=$i?>" placeholder="STATE CODE (<?=$i?>)" onKeyup="cleartext<?=$i?>()" value="<?=$rowselect['constatecode']?>" required>
</div>
</div>

<div class="form-group gstinFields">
  <div class="input-container">
    <label for="buyerpincode">GST.No : <span class="text-danger">*</span></label>
    <input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value, 'congstno')" class="congstno" name="congstno[]" id="congstno<?=$i?>" placeholder="GST.NO. (<?=$i?>)" onKeyup="cleartext<?=$i?>()" maxlength="15" value="<?=$rowselect['congstno']?>">
  </div>
</div>

  <div class="form-group">
  <div class="input-container">
    <label for="bgst">Contact Person :</label>
   <input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'concontact')" class="concontact" name="concontact[]" id="concontact<?=$i?>" placeholder="CONTACT PERSON (<?=$i?>)" value="<?=$rowselect['concontact']?>">
  </div>
</div>

<div class="form-group">
 <div class="input-container">
<label for="buyerstate">Phone No :</label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conphone')"  class="conphone" name="conphone[]" id="conphone<?=$i?>" placeholder="PHONE NO. (<?=$i?>)"  maxlength="11" inputmode="numeric" value="<?=$rowselect['conphone']?>">
</div>
</div>

<div class="form-group">
 <div class="input-container">
<label for="buyermobile">Mobile.No :</label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conmobile')"  class="conmobile" name="conmobile[]" id="conmobile<?=$i?>" placeholder="MOBILE NO. (<?=$i?>)"  maxlength="10" inputmode="numeric" value="<?=$rowselect['conmobile']?>">
</div>
</div>

<div class="form-group">
<div class="input-container">
<label for="buyerphone">Mail Id :<span class="text-danger">*</span></label>
<input type="text" stag="<?=$i?>" onchange="changeconsigneeinfo(this.getAttribute('stag'), this.value,  'conemail')"  class="conemail" name="conemail[]" id="conemail<?=$i?>" placeholder="MAIL ID (<?=$i?>)" required value="<?=$rowselect['conemail']?>"></div>
</div>

<!--div class="row">
<div class="col-lg-4 text-right">
<div class="form-group">
<label for="bbcharge">BuyBack Charges:</label>	<br>
</div>
</div>
<div class="col-lg-8 text-left">	
<label><input type="radio" id="bbcharge<?=$i?>" name="bbcharge[]" value="0"  onchange="checkmailer()"> Yes
</label>
<label><input type="radio" id="bbcharge<?=$i?>" name="bbcharge[]" value="1" checked onchange="checkmailer()"> No
</label>
</div>
</div>

<div class="row">
<div class="col-lg-4 text-right">
<div class="form-group">
<label for="discountcharge">Discount Charges:</label>	<br>
</div>
</div>
<div class="col-lg-8 text-left">	
<label><input type="radio" id="discountcharge<?=$i?>" name="discountcharge[]" value="0"  onchange="checkmailer1()"> Yes
</label>
<label><input type="radio" id="discountcharge<?=$i?>" name="discountcharge[]" value="1" checked onchange="checkmailer1()"> No
</label>
</div>
</div>

<div class="row">
<div class="col-lg-4 text-right">
<div class="form-group">
<label for="addcharge">Additional Charges:</label>	<br>
</div>
</div>
<div class="col-lg-8 text-left">	
<label><input type="radio" id="addcharge<?=$i?>" name="addcharge[]" value="0"  onchange="checkmailer2()"> Yes
</label>
<label><input type="radio" id="addcharge<?=$i?>" name="addcharge[]" value="1" checked onchange="checkmailer2()"> No
</label>
</div>
</div-->
			

	<!--a href="javascript:void(0);" data-toggle="modal" data-target="#conModal"  onclick="openModal2(document.getElementById('reftime').value, document.getElementById('consigneename<?=$i?>').value)" style="background-color: #9F5EB3;" class="btn btn shadow text-white">View</a--> 	

  </div>
  </div>
  

</div>

<?php
$r++;
}
}
?>

<br>
<div class="col-lg-8">
<div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Product Information</b></h6>
    </div>
<br>
<div class="table-responsive">
<table class="table table-fixed" id="table-data">
<thead>
<th style="width: 20px;">No.</th>
<!--th>MULTIPLE GODOWN</th--><th style="width: 20px;">Product Code</th><th style="width: 20px;">Product <span class="text-danger">*</span></th><th style="width: 20px;">Make</th><!--th>HSN/SAC <span class="text-danger">*</span></th--><th style="width: 50px;">QTY <span class="text-danger">*</span></th>
<!--th style="width: 20px;">Serial</th--><th style="width: 20px;">Unit Price <span class="text-danger">*</span></th><th style="width: 20px;">Discount Type<span class="text-danger">*</span></th><th style="width: 20px;">Discount Amount <span class="text-danger">*</span></th><!--th>IGST <label><input type="checkbox" id="igstcheck"> Same for All</label> </th><th>SGST <label><input type="checkbox" id="sgstcheck"> Same for All</label> </th><th>CGST <label><input type="checkbox" id="cgstcheck"> Same for All</label> </th><th>IGST AMOUNT</th><th>SGST AMOUNT</th><th>CGST AMOUNT</th--><th style="width: 20px;">Total Amount<span class="text-danger">*</span></th><th style="width: 20px;">Total Amount + GST <span class="text-danger">*</span></th><!--th>warranty months <label><input type="checkbox" id="warrantycheck"> Same for All</label></th-->
</thead>
<tbody id="tabletobdy">
<?php
$sqlselect = "SELECT * From jrctally where sono='".$id."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$i=1;
$j=1;
$cons='';
while($rowselect = mysqli_fetch_array($queryselect))
{
?>

<tr> 
<td><input type="hidden" class="consigneeno" id="consigneeno<?=$i?>" name="consigneeno[]" value="<?=$rowselect['consigneeno']?>"><input type="hidden" class="id" id="id<?=$i?><?=$j?>" name="id[]" value="<?=$rowselect['id']?>"><?=$j?></td>
<input type="hidden"  class="conprogroup" name="conprogroup[]" id="conprogroup<?=$i?><?=$j?>" placeholder="PRODUCT GROUP (<?=$i?>)" value="<?=$rowselect['conprogroup']?>">
<input type="hidden"  class="conmultiple" name="conmultiple[]" id="conmultiple<?=$i?><?=$j?>" placeholder="MULTIPLE GODOWN (<?=$i?>)" value="<?=$rowselect['conmultiple']?>">
<td><input type="text"   class="conproductcode" name="conproductcode[]" id="conproductcode<?=$i?><?=$j?>" placeholder="PRODUCT CODE (<?=$i?>)" value="<?=$rowselect['conproductcode']?>"></td>

<input type="hidden" class="promaincategory" name="promaincategory[]" id="promaincategory<?=$i?><?=$j?>" placeholder="MAIN CATEGORY(<?=$i?>)" value="<?=$rowselect['promaincategory']?>">
<input type="hidden" class="hsntype" name="hsntype[]" id="hsntype<?=$i?><?=$j?>" placeholder="HSN TYPE(<?=$i?>)" value="<?=$rowselect['hsntype']?>">
<input type="hidden" class="prosubcategory" name="prosubcategory[]" id="prosubcategory<?=$i?><?=$j?>" placeholder="SUB CATEGORY(<?=$i?>)" value="<?=$rowselect['prosubcategory']?>">

<td><input type="hidden" class="conproductid" id="conproductid<?=$i?><?=$j?>" name="conproductid[]"><input type="text" class="conproduct" name="conproduct[]" id="conproduct<?=$i?><?=$j?>" placeholder="PRODUCT (<?=$i?>)" required value="<?=$rowselect['conproduct']?>">

<input type="hidden"   name="congstvalue[]" id="congstvalue<?=$i?><?=$j?>" value="<?=$rowselect['congstvalue']?>" >
</td>

<input type="hidden" class="componenttype" name="componenttype[]" id="componenttype<?=$i?><?=$j?>" placeholder="COMPONENT TYPE (<?=$i?>)" value="<?=$rowselect['componenttype']?>">
<input type="hidden" class="componentname" name="componentname[]" id="componentname<?=$i?><?=$j?>" placeholder="COMPONENT NAME (<?=$i?>)" value="<?=$rowselect['componentname']?>">


<input type="hidden" class="conmarketname" name="conmarketname[]" id="conmarketname<?=$i?><?=$j?>" placeholder="MARKET NAME (<?=$i?>)" value="<?=$rowselect['conmarketname']?>">
<td><input type="text" class="conmake" name="conmake[]" id="conmake<?=$i?><?=$j?>" placeholder="MAKE (<?=$i?>)" value="<?=$rowselect['conmake']?>" readonly></td>
<input type="hidden" class="concapacity" name="concapacity[]" id="concapacity<?=$i?><?=$j?>" placeholder="CAPACITY (<?=$i?>)" value="<?=$rowselect['concapacity']?>">
<input type="hidden" class="conpromodel" name="conpromodel[]" id="conpromodel<?=$i?><?=$j?>" placeholder="MODEL (<?=$i?>)" value="<?=$rowselect['conpromodel']?>">
<input type="hidden" class="conhsncode" name="conhsncode[]" id="conhsncode<?=$i?><?=$j?>" placeholder="HSN/SAC (<?=$i?>)" maxlength="8" required value="<?=$rowselect['conhsncode']?>">
<input type="hidden" class="conper" name="conper[]" id="conper<?=$i?><?=$j?>" placeholder="PER (<?=$i?>)" value="<?=$rowselect['conper']?>">

<td style="width:20px;"><input type="number" class="conqty" name="conqty[]" id="conqty<?=$i?><?=$j?>" placeholder="QTY (<?=$i?>)" onchange="procalc<?=$i?>(<?=$i?>)" required value="<?=$rowselect['conqty']?>">
<input type="hidden" class="conunitqty" name="conunitqty[]" id="conunitqty<?=$i?><?=$j?>" placeholder="UNITQTY (<?=$i?>)" onchange="procalc<?=$i?>(<?=$i?>)" value="<?=$rowselect['conunitqty']?>"></td>
<td><input type="hidden" name="conserialno[]" id="conserialno<?=$i?><?=$j?>">
<input type="hidden" name="condepartmentname[]" id="condepartmentname<?=$i?><?=$j?>"><input type="number" step="0.01" min="0" class="conunit" name="conunit[]" id="conunit<?=$i?><?=$j?>" placeholder="UNIT PRICE  (<?=$i?>)" onchange="procalc<?=$i?>(<?=$i?>)" value="<?=$rowselect['conunit']?>" required></td>
<td>
  <div style="display: flex; align-items: center; border: 1px solid #ccc; border-radius: 4px; overflow: hidden;">
    <input type="number" name="discount[]" id="discount<?=$i?><?=$j?>" class="form-control discount-input"
      onchange="procalc<?=$i?>(<?=$i?>)" 
      style="border: none; text-align: right; min-width: 80px; padding-right: 5px;" 
      min="0" step="0.01" value="<?=$rowselect['discount']?>">

    <select id="discountmode<?=$i?><?=$j?>" name="discountmode[]" class="form-control"
      data-live-search="true" onchange="procalc<?=$i?>(<?=$i?>)" 
      style="border: none; border-left: 1px solid #ccc; min-width: 50px;">
	  <option value="percentage"<?=($rowselect['discountmode']=="percentage")?'selected':''?>>% </option>
	  <option value="rupee"<?=($rowselect['discountmode']=="rupee")?'selected':''?>>₹ </option>
     </select>
  </div>
</td>
<td> <input type="number" step="0.01" min="0" readonly class="discountamount" id="discountamount<?=$i?><?=$j?>" name="discountamount[]" onchange="procalc<?=$i?>(<?=$i?>)" value="<?=$rowselect['discountamount']?>"></td>
<input type="hidden" step="0.01" min="0" class="conigst" name="conigst[]" id="conigst<?=$i?><?=$j?>" placeholder="IGST (<?=$i?>)" onchange="igstcheckf(this.value); procalc<?=$i?>(<?=$i?>);" value="<?=$rowselect['conigst']?>">
<input type="hidden" step="0.01" min="0" class="consgst" name="consgst[]" id="consgst<?=$i?><?=$j?>" placeholder="SGST (<?=$i?>)" onchange="sgstcheckf(this.value); procalc<?=$i?>(<?=$i?>);" value="<?=$rowselect['consgst']?>">
<input type="hidden" step="0.01" min="0" class="concgst" name="concgst[]" id="concgst<?=$i?><?=$j?>" placeholder="CGST (<?=$i?>)" onchange="procalc<?=$i?>(<?=$i?>);" readonly value="<?=$rowselect['concgst']?>">
<input type="hidden" step="0.01" min="0" class="conigstamount" name="conigstamount[]" id="conigstamount<?=$i?><?=$j?>" placeholder="IGST AMOUNT (<?=$i?>)" readonly value="<?=$rowselect['conigstamount']?>">
<input type="hidden" step="0.01" min="0" class="consgstamount" name="consgstamount[]" id="consgstamount<?=$i?><?=$j?>" placeholder="SGST AMOUNT (<?=$i?>)" readonly value="<?=$rowselect['consgstamount']?>">
<input type="hidden" step="0.01" min="0" class="concgstamount" name="concgstamount[]" id="concgstamount<?=$i?><?=$j?>" placeholder="CGST AMOUNT (<?=$i?>)" readonly value="<?=$rowselect['concgstamount']?>">
<td><input type="number" step="0.01" min="0" class="contot" name="contot[]" id="contot<?=$i?><?=$j?>" placeholder="TOTAL AMOUNT (<?=$i?>)" readonly required></td>
<td><input type="number" step="0.01" min="0" class="contotal" name="contotal[]" id="contotal<?=$i?><?=$j?>" placeholder="TOTAL AMOUNT + GST (<?=$i?>)" readonly required></td>
<input type="hidden" step="0.01" min="0" class="conwarranty" name="conwarranty[]" id="conwarranty<?=$i?><?=$j?>" onchange="warrantycheckf(this.value);" placeholder="WARRANTY MONTHS (<?=$i?>)" value="<?=$rowselect['conwarranty']?>">
</tr>

<?php
$j++;
}
}
?>
</tbody>
</table>
</div>

<?php
for($i=1;$i<=$noofconsignee;$i++)
{
for($j=1;$j<=$maxproduct;$j++)
{ 
?>
<div id="additional_rows_<?=$i?>_<?=$j?>" style="display:<?php echo ($i == 1 && $j == 1) ? 'block' : 'none'; ?>">
<div class="form-group row">
 
    <label for="subtotalamount" class="col-sm-6 col-form-label text-right">Sub Total Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="subtotalamount<?=$i?>" name="subtotalamount[]" style="text-align:right" >
    </div>
  </div>

  <div class="form-group row">
    <label for="addamount" class="col-sm-6 col-form-label text-right" id="addamounts<?=$i?>">Add Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control addamount-input" id="addamount<?=$i?><?=$j?>" name="addamount[]" onChange="procalc<?=$i?>(<?=$i?>)" <?php if($i == 1 && $j == 1){ ?> value="<?=$rowselect1['addamount']?>" <?php } else { ?>value=""<?php } ?> style="text-align:right" >
    </div>
  </div>
  
    <div class="form-group row" style='display:none'>
    <label for="lessamount" class="col-sm-6 col-form-label text-right" id="lessamounts<?=$i?>">Less Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control lessamount-input" id="lessamount<?=$i?><?=$j?>" name="lessamount[]" onChange="procalc<?=$i?>(<?=$i?>)" style="text-align:right" >
    </div>
  </div>

<div class="form-group row">
    <label for="netamount" class="col-sm-6 col-form-label text-right">Net Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="netamount<?=$i?>" name="netamount[]" style="text-align:right" >
    </div>
  </div>

<div class="form-group row">
    <label for="totalgstamount" class="col-sm-6 col-form-label text-right">Total GST Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="totalgstamount<?=$i?>" name="totalgstamount[]" style="text-align:right" >
    </div>
  </div>
  
   
   <div class="form-group row">
    <label for="buyback" class="col-sm-6 col-form-label text-right" id="buybacks<?=$i?>">BuyBack Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control buyback-input" id="buyback<?=$i?><?=$j?>" name="buyback[]" onChange="procalc<?=$i?>(<?=$i?>)" <?php if($i == 1 && $j == 1){ ?> value="<?=$rowselect1['buyback']?>" <?php } else { ?>value=""<?php } ?> style="text-align:right">
    </div>
  </div>
  <div class="form-group row">
    <label for="buyremark" class="col-sm-6 col-form-label text-right" id="buyremarks<?=$i?>">BuyBack Remarks</label>
    <div class="col-sm-6">
	<textarea class="form-control" id="buyremark<?=$i?>" name="buyremark[]"><?php if($i == 1 && $j == 1){ echo $rowselect1['buyremark'];} else { echo"";} ?></textarea>
    </div>
  </div>
  <div class="form-group row" style='display:none'>
    <label for="ichargeremark" class="col-sm-6 col-form-label text-right" id="ichargeremark<?=$i?>">Installation Charge Remarks</label>
    <div class="col-sm-6">
	<textarea class="form-control" id="ichargeremark<?=$i?>" name="ichargeremark[]"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="grandtotal" class="col-sm-6 col-form-label text-right font-weight-bold">Grand Total (₹)</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="grandtotal<?=$i?>" name="grandtotal[]" style="text-align:right" >
    </div>
  </div>
  </div>
<?php
} 
}
?>
</div>
</div>


  
  <br>
<div class="row">
    <div class="col-lg-4">
        <div class="d-flex justify-content-between">
            <div class="text-left" style="display:none">
                <button type="button" class="btn btn-primary" onclick="displayPrevious()">Previous Consignee</button>
            </div>
            <div class="text-right" style="display:none">
                <button type="button" class="btn btn-primary" onclick="displayNext()">Next Consignee</button>
            </div>
        </div>
    </div>
 <div class="col-lg-8 text-right">

<!--a href="javascript:void(0);" data-toggle="modal" data-target="#ewayModal"  onclick="openModal1(document.getElementById('reftime').value)" style="background-color: #9F5EB3;" class="btn btn shadow text-white">View</a-->
<input class="btn btn-primary" type="submit" name="btnsubmit" value="Submit"><br>
</div>
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
<div class="modal" id="ewayModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sales Order View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
			<div class="modal-body" id="emodalContent">
		
     
            </div>
            </div> 
            </div> 
            </div> 
			
<div class="modal" id="conModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sales Order View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
			<div class="modal-body" id="emodalconsignee">
		
     
            </div>
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
source: 'consearch.php', select: function (event, ui) { $("#buyername").val(ui.item.value);$("#buyerid").val(ui.item.id); $("#buyeraddress1").val(ui.item.address1); $("#buyeraddress2").val(ui.item.address2); $("#buyeraddress3").val(ui.item.area);$("#buyerdistrict").val(ui.item.district);$("#buyerpincode").val(ui.item.pincode);$("#buyermail").val(ui.item.email);$("#buyermobile").val(ui.item.mobile);$("#buyercontact").val(ui.item.contact);$("#buyerphone").val(ui.item.phone);$("#bgst").val(ui.item.gstno);$("#buyerstate").val(ui.item.statecode);$("#rtype").val(ui.item.gsttype);$("#maincategory").val(ui.item.maincategory);$("#subcategory").val(ui.item.subcategory);$("#department").val(ui.item.department);}, minLength: 3

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

$(document).ready(function(){
    $('#bgst').on('input', function() {
        var gstin = $(this).val();
        var stateCode = gstin.substring(0, 2); 
        if(gstin === '') {
            $('#buyerstate').val('');
        } else {
            $.ajax({
                url: 'statesearch.php', 
                method: 'POST',
                data: { stateCode: stateCode },
                success: function(response) {
                    $('#buyerstate').val(response); 
                }
            });
        }
    });
});

$('#table-data').on('click', '.tr_clone_add', function() {
var $tr    = $(this).closest('.tr_clone');
var $clone = $tr.clone();
$clone.find('.btnDeleteRow').removeAttr("disabled");
$tr.after($clone);
var consigneeno=document.getElementsByName("consigneeno[]");
var constatecode=document.getElementsByName("constatecode[]");
var maxproduct=document.getElementsByName("maxproduct[]");
var consigneename=document.getElementsByName("consigneename[]");
var conmaincategory=document.getElementsByName("conmaincategory[]");
var consubcategory=document.getElementsByName("consubcategory[]");
var condepartment=document.getElementsByName("condepartment[]");
var condistrict=document.getElementsByName("condistrict[]");
var promaincategory=document.getElementsByName("promaincategory[]");
var hsntype=document.getElementsByName("hsntype[]");
var prosubcategory=document.getElementsByName("prosubcategory[]");
var conproduct=document.getElementsByName("conproduct[]");
var componentname=document.getElementsByName("componentname[]");
var componenttype=document.getElementsByName("componenttype[]");
var conproductcode=document.getElementsByName("conproductcode[]");
var conmarketname=document.getElementsByName("conmarketname[]");
var conmake=document.getElementsByName("conmake[]");
var concapacity=document.getElementsByName("concapacity[]");
var conpromodel=document.getElementsByName("conpromodel[]");
var conper=document.getElementsByName("conper[]");
var conunitqty=document.getElementsByName("conunitqty[]");
var conhsncode=document.getElementsByName("conhsncode[]");
var conaddress3=document.getElementsByName("conaddress3[]");
var contaluk=document.getElementsByName("contaluk[]");
var conpincode=document.getElementsByName("conpincode[]");
var conprogroup=document.getElementsByName("conprogroup[]");
var conwarranty=document.getElementsByName("conwarranty[]");
var congstvalue=document.getElementsByName("congstvalue[]");
for(var i=0;i<consigneeno.length;i++)
{
for(var j=0;j<maxproduct.length;j++)
{
$( consigneename[i] ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( conmaincategory[i] ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
});
$( consubcategory[i] ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
});
$( condepartment[i] ).autocomplete({
source: 'consigneesearch.php?type=department',
});
$( condistrict[i] ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( constatecode[i] ).autocomplete({
source: 'tallysearch.php?type=statecode&table=jrcplace',
});
$( promaincategory[i][j] ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
});
$( hsntype[i][j] ).autocomplete({
source: 'tallysearch.php?type=hsntype&table=jrcproduct',
});
$( prosubcategory[i][j] ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
});
$( componentname[i][j] ).autocomplete({
source: 'tallysearch.php?type=componentname&table=jrcproduct',
});
$( componenttype[i][j] ).autocomplete({
source: 'tallysearch.php?type=componenttype&table=jrcproduct',
});
$( conproduct[i][j] ).autocomplete({
source: 'tallysearch.php?type=stockitem&table=jrcproduct',
});
$( conproductcode[i][j] ).autocomplete({
source: 'tallysearch.php?type=code&table=jrcproduct',
});
$( conmarketname[i][j] ).autocomplete({
source: 'tallysearch.php?type=marketname&table=jrcproduct',
});
$( conmake[i][j] ).autocomplete({
source: 'tallysearch.php?type=make&table=jrcproduct',
});
$( concapacity[i][j] ).autocomplete({
source: 'tallysearch.php?type=capacity&table=jrcproduct',
});
$( conpromodel[i][j] ).autocomplete({
source: 'tallysearch.php?type=model&table=jrcproduct',
});
$( conper[i][j] ).autocomplete({
source: 'tallysearch.php?type=unit&table=jrcproduct',
});
$( conhsncode[i][j] ).autocomplete({
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
$( deliverymethod[i][j] ).autocomplete({
source: 'tallysearch.php?type=deliverymethod&table=jrctally',
});
$( agentname[i][j] ).autocomplete({
source: 'tallysearch.php?type=agentname&table=jrctally',
});
$( lrno[i][j] ).autocomplete({
source: 'tallysearch.php?type=lrno&table=jrctally',
});
$( vechileno[i][j] ).autocomplete({
source: 'tallysearch.php?type=vechileno&table=jrctally',
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
$( "#conmaincategory<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
});
$( "#consubcategory<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
});
$( "#condepartment<?=$i?>" ).autocomplete({
source: 'consigneesearch.php?type=department',
});
$( "#condistrict<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=district&table=jrcdistrict',
});
$( "#constatecode<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=statecode&table=jrcplace',
});
$( "#congstno<?=$i?>" ).autocomplete({
source: 'tallysearch.php?type=gstno&table=jrcconsingee',
});
$( "#conprogroup<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=typeofproduct&table=jrcproduct',
});
$( "#conmultiple<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=conmultiple&table=jrctally',
});
$( "#promaincategory<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
});
$( "#hsntype<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=hsntype&table=jrcproduct',
});
$( "#prosubcategory<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
});
$( "#componentname<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=componentname&table=jrcproduct',
});
$( "#componenttype<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=componenttype&table=jrcproduct',
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
$( "#conmake<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=make&table=jrcproduct',
});
$( "#concapacity<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=capacity&table=jrcproduct',
});
$( "#conpromodel<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=model&table=jrcproduct',
});
$( "#conper<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=unit&table=jrcproduct',
});
$( "#conhsncode<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=hsncode&table=jrcproduct',
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
$( "#deliverymethod<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=deliverymethod&table=jrctally',
});
$( "#agentname<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=agentname&table=jrctally',
});
$( "#lrno<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=lrno&table=jrctally',
});
$( "#vechileno<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=vechileno&table=jrctally',
});
$( "#conpincode<?=$i?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'pincodesearch1.php?type=pincode', select: function (event, ui) { $("#conpincode<?=$i?>").val(ui.item.value); $("#contaluk<?=$i?>").val(ui.item.taluk); $("#condistrict<?=$i?>").val(ui.item.district);}, minLength: 3
});
$( "#conproductcode<?=$i?><?=$j?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'productsearch1.php?type=code', select: function (event, ui) { $("#conproductcode<?=$i?><?=$j?>").val(ui.item.value); $("#conproduct<?=$i?><?=$j?>").val(ui.item.stockitem);$("#conproductid<?=$i?><?=$j?>").val(ui.item.id);$("#conprogroup<?=$i?><?=$j?>").val(ui.item.typeofproduct); $("#conmarketname<?=$i?><?=$j?>").val(ui.item.marketname);$("#conmake<?=$i?><?=$j?>").val(ui.item.make);$("#concapacity<?=$i?><?=$j?>").val(ui.item.capacity);$("#conpromodel<?=$i?><?=$j?>").val(ui.item.model);$("#conper<?=$i?><?=$j?>").val(ui.item.unit);$("#conunitqty<?=$i?><?=$j?>").val(ui.item.unitqty);$("#conhsncode<?=$i?><?=$j?>").val(ui.item.hsncode);$("#conunit<?=$i?><?=$j?>").val(ui.item.price);$("#promaincategory<?=$i?><?=$j?>").val(ui.item.stockmaincategory);$("#hsntype<?=$i?><?=$j?>").val(ui.item.hsntype);$("#prosubcategory<?=$i?><?=$j?>").val(ui.item.stocksubcategory);$("#componentname<?=$i?><?=$j?>").val(ui.item.componentname);$("#componenttype<?=$i?><?=$j?>").val(ui.item.componenttype);$("#conwarranty<?=$i?><?=$j?>").val(ui.item.warranty);$("#congstvalue<?=$i?><?=$j?>").val(ui.item.gst);$("#conqty<?=$i?><?=$j?>").val(0);$("#contot<?=$i?><?=$j?>").val(0);$("#contotal<?=$i?><?=$j?>").val(0);$("#discount<?=$i?><?=$j?>").val(0);
//statecode validate
var supplierGST = $("#companystatecode").val(); 
    var buyerGST = $("#buyerstate").val();
    if (supplierGST ==buyerGST) {
      var gstValue = parseFloat(ui.item.gst);
      var sgst = gstValue / 2;
      var cgst = gstValue / 2;
      $("#consgst<?=$i?><?=$j?>").val(sgst); 
      $("#concgst<?=$i?><?=$j?>").val(cgst);
      $("#conigst<?=$i?><?=$j?>").val("");
}
else{
	var gstValue = parseFloat(ui.item.gst);
	$("#conigst<?=$i?><?=$j?>").val(gstValue);
	 $("#consgst<?=$i?><?=$j?>").val(""); 
      $("#concgst<?=$i?><?=$j?>").val("");
}

}, minLength: 2 
});

$( "#conproduct<?=$i?><?=$j?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'productsearch1.php?type=stockitem', select: function (event, ui) { $("#conproduct<?=$i?><?=$j?>").val(ui.item.value); $("#conproductid<?=$i?><?=$j?>").val(ui.item.id); $("#conprogroup<?=$i?><?=$j?>").val(ui.item.typeofproduct); $("#conproductcode<?=$i?><?=$j?>").val(ui.item.code); $("#conmarketname<?=$i?><?=$j?>").val(ui.item.marketname);$("#conmake<?=$i?><?=$j?>").val(ui.item.make);$("#concapacity<?=$i?><?=$j?>").val(ui.item.capacity);$("#conpromodel<?=$i?><?=$j?>").val(ui.item.model);$("#conper<?=$i?><?=$j?>").val(ui.item.unit);$("#conunitqty<?=$i?><?=$j?>").val(ui.item.unitqty);$("#conhsncode<?=$i?><?=$j?>").val(ui.item.hsncode);$("#conunit<?=$i?><?=$j?>").val(ui.item.price);$("#promaincategory<?=$i?><?=$j?>").val(ui.item.stockmaincategory);$("#hsntype<?=$i?><?=$j?>").val(ui.item.hsntype);$("#prosubcategory<?=$i?><?=$j?>").val(ui.item.stocksubcategory);$("#componentname<?=$i?><?=$j?>").val(ui.item.componentname);$("#componenttype<?=$i?><?=$j?>").val(ui.item.componenttype);$("#conwarranty<?=$i?><?=$j?>").val(ui.item.warranty);$("#congstvalue<?=$i?><?=$j?>").val(ui.item.gst);$("#conqty<?=$i?><?=$j?>").val(0);$("#contot<?=$i?><?=$j?>").val(0);$("#contotal<?=$i?><?=$j?>").val(0);$("#discount<?=$i?><?=$j?>").val(0);
//statecode validate 
var supplierGST = $("#companystatecode").val(); 
    var buyerGST = $("#buyerstate").val();
    if (supplierGST ==buyerGST) {
      var gstValue = parseFloat(ui.item.gst);
      var sgst = gstValue / 2;
      var cgst = gstValue / 2;
      $("#consgst<?=$i?><?=$j?>").val(sgst); 
      $("#concgst<?=$i?><?=$j?>").val(cgst);
	  $("#conigst<?=$i?><?=$j?>").val("");
}
else{
	var gstValue = parseFloat(ui.item.gst);
	$("#conigst<?=$i?><?=$j?>").val(gstValue);
	 $("#consgst<?=$i?><?=$j?>").val(""); 
      $("#concgst<?=$i?><?=$j?>").val("");
}}, minLength: 2
});

$( "#consigneename<?=$i?>" ).autocomplete({
//source: 'consigneesearch.php?type=consigneename',
source: 'consearch.php', select: function (event, ui) { $("#consigneename<?=$i?>").val(ui.item.value).trigger('change');$("#consigneeid<?=$i?>").val(ui.item.consigneeid).trigger('change');$("#conmaincategory<?=$i?>").val(ui.item.maincategory).trigger('change');$("#consubcategory<?=$i?>").val(ui.item.subcategory).trigger('change');$("#condepartment<?=$i?>").val(ui.item.department).trigger('change'); $("#conaddress1<?=$i?>").val(ui.item.address1).trigger('change'); $("#conaddress2<?=$i?>").val(ui.item.address2).trigger('change'); $("#conaddress3<?=$i?>").val(ui.item.area).trigger('change');$("#condistrict<?=$i?>").val(ui.item.district).trigger('change');$("#conpincode<?=$i?>").val(ui.item.pincode).trigger('change');$("#conemail<?=$i?>").val(ui.item.email).trigger('change');$("#conmobile<?=$i?>").val(ui.item.mobile).trigger('change');$("#congstno<?=$i?>").val(ui.item.gstno).trigger('change');$("#constatecode<?=$i?>").val(ui.item.statecode).trigger('change');$("#conphone<?=$i?>").val(ui.item.phone).trigger('change');}, minLength: 3
});
 
$(document).ready(function() {
    $('#congstno<?=$i?>').on('input', function() {
        var gstin = $(this).val();
        var stateCode = gstin.substring(0, 2); 
        if(gstin === '') {
            $('#constatecode<?=$i?>').val('');
        } else {
            $.ajax({
                url: 'statesearch.php', 
                method: 'POST',
                data: { stateCode: stateCode },
                success: function(response) {
                    $('#constatecode<?=$i?>').val(response).trigger('change'); // Triggering change event
                }
            });
        }
    });
});

<?php
}
}
}
?>
});
</script>

<script>
// Function to auto-fill pono field based on orderreceived field
function autoFillPono() {
    var orderReceivedValue = $('#orderreceived').val().trim();
    
    if (orderReceivedValue !== "") {
        var currentDate = new Date();
        var dd = String(currentDate.getDate()).padStart(2, '0');
        var mm = String(currentDate.getMonth() + 1).padStart(2, '0');
        var yy = String(currentDate.getFullYear()).slice(-2);
        var todayDate = dd + '/' + mm + '/' + yy;

        // Autofill the pono field with orderReceivedValue and today's date
        $('#pono').val(orderReceivedValue + ' ' + todayDate).change(); // Trigger change event
    } else {
        // Clear the pono field if orderreceived field is empty
        $('#pono').val('').change(); // Trigger change event
    }
}

// Event handler for orderreceived field
$('#orderreceived').on('input', function() {
    autoFillPono(); // Call the auto-fill function when orderreceived input changes
});

// Event handler for pono field
$('#pono').change(function() {
    var city = $(this).val();
    $("#orderexist").hide();
    
    //send request to the ajax
    $.ajax({
        url: 'ponosearch.php',
        type: 'get',
        data: {
            'term': city
        },
        dataType: 'json',
    })
    .done(function(data) {
        console.log(typeof data[0]);
        if (typeof data[0] != 'undefined') {
            if (data[0].value != "") {
                $("#orderexist").show();
                $("#orderstatus").val("1");
            } else {
                $("#orderexist").hide();
            }
        } else {
            $("#orderexist").hide();
            $("#orderstatus").val("0");
        }
    })
    .fail(function(data, xhr, textStatus, errorThrown) {
        // alert(errorThrown);
    });
});

</script>

<script>
function validateForm() {
<?php
for ($i = 1; $i <= $noofconsignee; $i++) {
    for ($j = 1; $j <= $maxproduct; $j++) {
?>
    var hsnCode<?=$i?><?=$j?> = document.getElementById('conhsncode<?=$i?><?=$j?>').value;
    if (hsnCode<?=$i?><?=$j?>.trim() === '') {
        alert('HSN/SAC code cannot be empty!');
        return false; // Prevent form submission
    }
<?php
    }
}
?>
   return checkvalidate();
}

function checkvalidate()
{
	
	var orderstatus=$( "#orderstatus" ).val();
	if(orderstatus=="1")
	{
		alert("This Order-id Already Exists");
		return false;
	}
	else{
		return true;
	}
}
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
var conemail=document.getElementsByName("conemail[]");
var concontact=document.getElementsByName("concontact[]");
var condepartment=document.getElementsByName("condepartment[]");
var consubcategory=document.getElementsByName("consubcategory[]");
var conmaincategory=document.getElementsByName("conmaincategory[]");
for(var i=0;i<consigneeno.length;i++)
{
consigneename[i].value=document.getElementById("buyername").value;
consigneeid[i].value=document.getElementById("buyerid").value;
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
conemail[i].value=document.getElementById("buyermail").value;
concontact[i].value=document.getElementById("buyercontact").value;
condepartment[i].value=document.getElementById("department").value;
consubcategory[i].value=document.getElementById("subcategory").value;
conmaincategory[i].value=document.getElementById("maincategory").value;
}
}
}
<?php
for ($i = 1; $i <= $noofconsignee; $i++) {
?>
function procalc<?=$i?>(id) {	

    var totalsubtotal<?=$i?> = 0;
    var totalgst<?=$i?> = 0;
    var totalnet<?=$i?> = 0;
    var totaldiscount<?=$i?> = 0;
    var totalbuyback<?=$i?> = 0;
    var totalshipamount<?=$i?> = 0;
    var totallessamt<?=$i?> = 0;
    var discountApplied = false; // To track if any discount is applied
    var discountamount; // declare discountamount outside loop

    <?php
    for ($j = 1; $j <= $maxproduct; $j++) {
    ?>
   // alert(<?=$i?><?=$j?>);
    var conqty = document.getElementById("conqty<?=$i?><?=$j?>").value;
    var conunit = document.getElementById("conunit<?=$i?><?=$j?>").value;
    var conigst = document.getElementById("conigst<?=$i?><?=$j?>").value;
    var consgst = document.getElementById("consgst<?=$i?><?=$j?>").value;
    var concgst = document.getElementById("concgst<?=$i?><?=$j?>").value;
    var contotal = document.getElementById("contotal<?=$i?><?=$j?>").value;
    var addamount = document.getElementById("addamount<?=$i?><?=$j?>").value;
    var lessamount = document.getElementById("lessamount<?=$i?><?=$j?>").value;
    var buyback = document.getElementById("buyback<?=$i?><?=$j?>").value;
    var discount = document.getElementById("discount<?=$i?><?=$j?>").value;
    var discountmode = document.getElementById("discountmode<?=$i?><?=$j?>").value;
    var total = 0;
    var discountamt = 0;
    if (conqty !== '' && conunit !== '') {
        total = parseFloat(conqty) * parseFloat(conunit);
		contot<?=$i?><?=$j?>.value =total;
		totalsubtotal<?=$i?> += total; // Add the total first

	if (discount !== '') {
		if (discountmode === 'percentage') {
			discountamt = (parseFloat(discount) * parseFloat(total)) / 100;
			contot<?=$i?><?=$j?>.value = total - discountamt;
		} else {
			discountamt = parseFloat(discount);
			contot<?=$i?><?=$j?>.value = total - discountamt;
		}
		discountApplied = true;
		totaldiscount<?=$i?> += discountamt; // Track total discount
		totalsubtotal<?=$i?> -= discountamt; // Subtract the discount from the subtotal
	}

	discountamount<?=$i?><?=$j?>.value = discountamt;
 
        if (discount !== '') {
        if (conigst !== '') {
            var itax = total * (parseFloat(conigst) / 100);
            totalgst<?=$i?> += itax;
            var ttotal = parseFloat(total) + parseFloat(itax);
            contotal<?=$i?><?=$j?>.value = ttotal.toFixed(2);
            totalnet<?=$i?> += total;
            conigstamount<?=$i?><?=$j?>.value = itax.toFixed(2);
        }

        if (consgst !== '') {
            var stax = contot<?=$i?><?=$j?>.value * (parseFloat(consgst) / 100);
            var ctax = stax;
            var ttax = parseFloat(stax) + parseFloat(ctax);
            totalgst<?=$i?> += ttax;
            var ttotal = parseFloat(contot<?=$i?><?=$j?>.value) + parseFloat(ttax);
            contotal<?=$i?><?=$j?>.value = ttotal.toFixed(2);
		    totalnet<?=$i?> += total;
            consgstamount<?=$i?><?=$j?>.value = stax.toFixed(2);
			//alert(consgstamount<?=$i?><?=$j?>.value);
            concgstamount<?=$i?><?=$j?>.value = stax.toFixed(2);
        }
		 }
		 else
		 {
			if (conigst !== '') {
            var itax = total * (parseFloat(conigst) / 100);
            totalgst<?=$i?> += itax;
            var ttotal = parseFloat(total) + parseFloat(itax);
            contotal<?=$i?><?=$j?>.value = ttotal.toFixed(2);
            totalnet<?=$i?> += total;
            conigstamount<?=$i?><?=$j?>.value = itax.toFixed(2);
        }

        if (consgst !== '') {
            var stax = total * (parseFloat(consgst) / 100);
            var ctax = stax;
            var ttax = parseFloat(stax) + parseFloat(ctax);
            totalgst<?=$i?> += ttax;
            var ttotal = parseFloat(total) + parseFloat(ttax);
            contotal<?=$i?><?=$j?>.value = ttotal.toFixed(2);
            totalnet<?=$i?> += total;
            consgstamount<?=$i?><?=$j?>.value = stax.toFixed(2);
			//alert(consgstamount<?=$i?><?=$j?>.value);
            concgstamount<?=$i?><?=$j?>.value = stax.toFixed(2);
        }
		 }
    }	
    var shipamount = 0;
    if (addamount !== '') {
        shipamount = parseFloat(addamount);
    }
    totalshipamount<?=$i?> += shipamount;

    var lessamt = 0;
    if (lessamount !== '') {
        lessamt = parseFloat(lessamount);
    }
    totallessamt<?=$i?> += lessamt;

    var buybackamt = 0;
    if (buyback !== '') {
        buybackamt = parseFloat(buyback);
    }
    totalbuyback<?=$i?> += buybackamt;
    <?php
    }
    ?>
    var totalgstamount = document.getElementById("totalgstamount<?=$i?>");
    var subtotalamount = document.getElementById("subtotalamount<?=$i?>");
    var netamount = document.getElementById("netamount<?=$i?>");
    var grandtotal = document.getElementById("grandtotal<?=$i?>");
	
    totalgstamount.value = totalgst<?=$i?>.toFixed(2);
    subtotalamount.value = totalsubtotal<?=$i?>.toFixed(2);

    // Calculate net amount and grand total irrespective of discount
    netamount.value = ((parseFloat(totalnet<?=$i?>) + parseFloat(totalshipamount<?=$i?>)) - (parseFloat(totaldiscount<?=$i?>) + parseFloat(totallessamt<?=$i?>))).toFixed(2);
    grandtotal.value = ((parseFloat(totalnet<?=$i?>) - parseFloat(totalbuyback<?=$i?>) + totalgst<?=$i?> + parseFloat(totalshipamount<?=$i?>)) - (parseFloat(totaldiscount<?=$i?>) + parseFloat(totallessamt<?=$i?>))).toFixed(2);
}
<?php
}
?>

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
$clone.find('#condepartment1').attr("id", "condepartment"+(j));
$clone.find('#conmaincategory1').attr("id", "conmaincategory"+(j));
$clone.find('#consubcategory1').attr("id", "consubcategory"+(j));
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
$clone.find('#hsntype1').attr("id", "hsntype"+(j));
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
$clone.find('#conunitqty1'+j).attr("id", "conunitqty"+(j));
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
$clone.find('#condepartment'+j).attr("placeholder", "DEPARTMENT ("+j+")");
$clone.find('#conmaincategory'+j).attr("placeholder", "MAIN CATEGORY ("+j+")");
$clone.find('#consubcategory'+j).attr("placeholder", "SUB CATEGORY ("+j+")");
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
$clone.find('#hsntype'+j).attr("placeholder", "HSN TYPE ("+j+")");
$clone.find('#prosubcategory'+j).attr("placeholder", "SUB CATEGORY ("+j+")");
$clone.find('#conproduct'+j).attr("placeholder", "PRODUCT ("+j+")");
$clone.find('#componentname'+j).attr("placeholder", "COMPONENT NAME("+j+")");
$clone.find('#componenttype'+j).attr("placeholder", "COMPONENT TYPE ("+j+")");
$clone.find('#conmarketname'+j).attr("placeholder", "MARKET NAME ("+j+")");
$clone.find('#conmake'+j).attr("placeholder", "MAKE ("+j+")");
$clone.find('#concapacity'+j).attr("placeholder", "CAPACITY ("+j+")");
$clone.find('#conpromodel'+j).attr("placeholder", "MODEl ("+j+")");
$clone.find('#conhsncode'+j).attr("placeholder", "HSN/SAC ("+j+")");
$clone.find('#conper'+j).attr("placeholder", "PER ("+j+")");
$clone.find('#conqty'+j).attr("placeholder", "QTY ("+j+")");
$clone.find('#conunitqty'+j).attr("placeholder", "UNITQTY ("+j+")");
$clone.find('#conserialno'+j).attr("placeholder", "SERIAL ("+j+")");
$clone.find('#condepartmentname'+j).attr("placeholder", "DEPARTMENT ("+j+")");
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
$clone.find('#condepartment'+j).attr("stag", j);
$clone.find('#conmaincategory'+j).attr("stag", j);
$clone.find('#hsntype'+j).attr("stag", j);
$clone.find('#consubcategory'+j).attr("stag", j);
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
$clone.find('#conunitqty'+j).attr("stag", j);
$clone.find('#conserialno'+j).attr("stag", j);
$clone.find('#condepartmentname'+j).attr("stag", j);
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
$( ".conproduct" ).autocomplete({
source: 'tallysearch.php?type=productname&table=jrcproduct',
});
 $( ".promaincategory" ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
});
$( ".hsntype" ).autocomplete({
source: 'tallysearch.php?type=hsntype&table=jrcproduct',
}); 
$( ".prosubcategory" ).autocomplete({
source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
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
$( ".conproductcode" ).autocomplete({
source: 'productsearch1.php?type=code', select: function (event, ui) { 
const idInput = $(this).closest("tr").find(".conproductid");
const groupNameInput = $(this).closest("tr").find(".conprogroup");
const promaincategoryNameInput = $(this).closest("tr").find(".promaincategory");
const hsntypeNameInput = $(this).closest("tr").find(".hsntype");
const prosubcategoryNameInput = $(this).closest("tr").find(".prosubcategory");
const productNameInput = $(this).closest("tr").find(".conproduct");
const componentnameNameInput = $(this).closest("tr").find(".componentname");
const componenttypeNameInput = $(this).closest("tr").find(".componenttype");
const marketNameInput = $(this).closest("tr").find(".conmarketname");
const makeNameInput = $(this).closest("tr").find(".conmake");
const capacityNameInput = $(this).closest("tr").find(".concapacity");
const modelNameInput = $(this).closest("tr").find(".conpromodel");
const perNameInput = $(this).closest("tr").find(".conper");
const unitqtyNameInput = $(this).closest("tr").find(".conunitqty");
const hsncodeNameInput = $(this).closest("tr").find(".conhsncode");
const unitNameInput = $(this).closest("tr").find(".conunit");
const warrantyNameInput = $(this).closest("tr").find(".conwarranty");
const gstNameInput = $(this).closest("tr").find(".congstvalue");
$(this).val(ui.item.value);
idInput.val(ui.item.id);
groupNameInput.val(ui.item.typeofproduct);
promaincategoryNameInput.val(ui.item.stockmaincategory);
hsntypeNameInput.val(ui.item.hsntype);
prosubcategoryNameInput.val(ui.item.stocksubcategory);
productNameInput.val(ui.item.stockitem);
componentnameNameInput.val(ui.item.componentname);
componenttypeNameInput.val(ui.item.componenttype);
marketNameInput.val(ui.item.marketname);
makeNameInput.val(ui.item.make);
capacityNameInput.val(ui.item.capacity);
modelNameInput.val(ui.item.model);
perNameInput.val(ui.item.unit);
unitqtyNameInput.val(ui.item.unitqty);
hsncodeNameInput.val(ui.item.hsncode);
unitNameInput.val(ui.item.price);
warrantyNameInput.val(ui.item.warranty);
gstNameInput.val(ui.item.gst);
return false;
}, minLength: 1
});



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
        for (var i=0;i<els.length;i++) {
            els[i].value = val;
		}
	}
}
</script>
<script>
/* function serialnumbers(id)
{
	var conqty=document.getElementById("conqty"+id).value;
	var conunitqty=document.getElementById("conunitqty"+id).value;
	var rserialnumber=document.getElementById('conserialno'+id).value;
var rdepartment=document.getElementById('condepartmentname'+id).value; 
const rserialnumbers = rserialnumber.split(" | ");
const rdepartments = rdepartment.split(" | ");


	if(conqty!="")
	{
		var nos=parseFloat(conqty) * parseFloat(conunitqty);
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
} */

</script>
<script>
/* function serialsubmit1()
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
function checkGSTINRequirement() {
  var invoiceType = document.getElementById("invoicetype").value;

  var gstinField = document.getElementById("gstinField");
  var gstinFields = document.getElementsByClassName("gstinFields");
  var asterisk = document.getElementById("asterisk");
  var asterisk1 = document.getElementById("asterisk1");

  if (invoiceType == "B2B") {
    gstinField.style.display = "block";
    document.getElementById("bgst").required = true;

    for (var i = 0; i < gstinFields.length; i++) {
      gstinFields[i].style.display = "block";
      gstinFields[i].querySelector("input").required = true;
    }

    asterisk.style.display = "inline"; // Show the asterisk
    asterisk1.style.display = "inline"; // Show the asterisk
  } else {
    gstinField.style.display = "none";
    document.getElementById("bgst").required = false;

    for (var i = 0; i < gstinFields.length; i++) {
      gstinFields[i].style.display = "none";
      gstinFields[i].querySelector("input").required = false;
    }

    asterisk.style.display = "none"; // Hide the asterisk
    asterisk1.style.display = "none"; // Hide the asterisk
  }
}



/* function statecodevalid()
{
	var buyerstate=document.getElementById("buyerstate").value;
	var companystatecode=document.getElementById("companystatecode").value;
	if($("#congstvalue").val() != '')
	{
	var congstvalue=document.getElementById("congstvalue").value;
	}
	else
	{
		var  congstvalue="";
	}
	
	if(buyerstate==companystatecode)
	{
	  //var congstvalue=document.getElementById("congstvalue").value;
	  alert("hello keerthiga");
	 
	}
	else
	{
		
		alert("hello mera"+congstvalue);
	}
	
} */
function openModal1(sono) {
		
        // Send an AJAX request to your PHP script
        $.ajax({
            type: 'POST',
            url: 'exporttallyview.php',
            data: { reftime: sono },
            success: function (response) {
                // Handle the response from the server
                $('#emodalContent').html(response);
              // showAdditionalFields();
                // After the form submission, show the modal
                $('#ewayModal').modal('show');
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
	
	
function openModal2(sono, consigneename) {
    // Send an AJAX request to your PHP script
    $.ajax({
        type: 'POST',
        url: 'exporttally1view.php',
        data: { reftime: sono, consigneename: consigneename },
        success: function (response) {
            // Handle the response from the server
            $('#emodalconsignee').html(response);
            // showAdditionalFields();
            // After the form submission, show the modal
            $('#conModal').modal('show');
        },
        error: function (error) {
            console.log('Error:', error);
        }
    });
}
	
</script>
 <script>
    var currentConsignment = 1; // Initialize the current consignment for product
    var maxConsignment = <?php echo $noofconsignee; ?>; // Set the maximum consignments based on PHP variable
    var maxProduct = <?php echo $maxproduct; ?>; // Set the maximum products based on PHP variable

    function displayNext() {
        // Display next consignment for product
        if (currentConsignment < maxConsignment) {
            currentConsignment++;
        } else {
            currentConsignment = 1; // Reset to first consignment
        }
        displayContent();
    }

    function displayPrevious() {
        // Display previous consignment for product
        if (currentConsignment > 1) {
            currentConsignment--;
        } else {
            currentConsignment = maxConsignment; // Move to last consignment
        }
        displayContent();
    }

    function displayContent() {
        // Display consignee and products for the current consignment
        for (var i = 1; i <= maxConsignment; i++) {
            for (var j = 1; j <= maxProduct; j++) {
                var consigneeElement = document.getElementById("consignment_" + i + "_consignee_1");
                var consigneeDisplay = (i === currentConsignment) ? "block" : "none";
                if (consigneeElement) {
                    consigneeElement.style.display = consigneeDisplay;
                }

                var productElement = document.getElementById("consignment_" + i + "_product_" + j);
                var productDisplay = (i === currentConsignment) ? "table-row" : "none";
                if (productElement) {
                    productElement.style.display = productDisplay;
                }

                var additionalRow = document.getElementById("additional_rows_" + i + "_1");
                if (additionalRow) {
                    var additionalRowDisplay = (i === currentConsignment) ? "block" : "none";
                    additionalRow.style.display = additionalRowDisplay;
                }
            }
        }
    }
</script>
<script>
// This function will call all procalc functions based on the number of consignees
function initProcalcs() {
    <?php
    // Dynamically generate the JavaScript to call each procalc function on page load
    for ($i = 1; $i <= $noofconsignee; $i++) {
    ?>
    procalc<?=$i?>(<?=$i?>);  // Call procalc for each consignee
    <?php
    }
    ?>
	const elements = document.querySelectorAll('[stag]');
    elements.forEach(function(element) {
        const stag = element.getAttribute('stag');
        const value = element.value;
        const column = element.name.split('[')[0];  // Example to determine column based on name attribute
        changeconsigneeinfo(stag, value, column);
    });
}
</script>


 <!-- Auto Submit Or Draft Values-->
<?php include('additionaljs.php');   ?>
</body>
</html>