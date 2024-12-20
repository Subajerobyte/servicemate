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
<title><?=$_SESSION['companyname']?> - Jerobyte - Edit New Sales Order</title>
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
<?php include('salesnavbar.php');?>
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Edit New Sales Order</h1>
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
<?php
if(isset($_GET['id']))
{
$sono=mysqli_real_escape_string($connection,$_GET['id']);
				  $sqlselect = "SELECT * From jrcsaleorder where sono='".$sono."' order by id asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$rowselect=array();
			
			while($row = mysqli_fetch_array($queryselect)) 
			{
				$rowselect[]=$row;		
				}
			?>
<div class="card shadow mb-4">
<div class="card-body">
<form method="post" method="post" action="salesorderedits.php" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value=<?=$rowselect[0]['id']?>>
<div class="row">
<div class="col-xl-8">
<div class="form-group">
<label for="consigneename">Customer Name</label>
<select class="form-control fav_clr" id="consigneename" name="consigneename">
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, consigneename From jrcconsignee where consigneename!='' order by consigneename";
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
<option value="<?=$rowgo['id']?>"<?=($rowselect[0]['consigneename']==$rowgo['id'])?'selected':''?>><?=$rowgo['consigneename']?></option>
<?php
}
}
?>
</select>
</div>
<div id="modalresponse" style="display:none;">
<div class="row" style=" background-color:#fcfcfc" >
<div class="col-md-6">
<div class="mt-1 text-primary mb-1">Buyer Details <input type="hidden" name="buyermainid" id="buyermainid" value="<?=$rowselect[0]['buyermainid']?>"><span href="#" data-toggle="modal" data-target="#buyermodal">&nbsp;<i class="fa fa-pen"></i> </span></div>
<div id="buyerresponse"></div>
</div>
<div class="col-md-6">
<div class="mt-1 text-primary mb-1">Consignee Details <input type="hidden" name="consigneemainid" id="consigneemainid" value="<?=$rowselect[0]['consigneemainid']?>"> <span href="#" data-toggle="modal" data-target="#consigneemodal" onclick="updateauto()">&nbsp;<i class="fa fa-pen"></i> </span>  <span href="#" data-toggle="modal" data-target="#consigneechangemodal" onclick="updateauto()" class="text-danger text-right">&nbsp; Change Consignee</span></div>
<div id="consigneeresponse"></div>
</div>
</div>
</div>
</div>
<div class="col-xl-4 ">

<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label for="sono">SO No</label>
<input type="text" class="form-control" id="sono" name="sono" placeholder="SO No" value="<?=$rowselect[0]['sono']?>" readonly>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="sodate">SO Date</label>
<input type="date" class="form-control" id="sodate" name="sodate" placeholder="SO Date" value="<?=$rowselect[0]['sodate']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="pono">P.O. No</label>
<input type="text" class="form-control" id="pono" name="pono" value="<?=$rowselect[0]['pono']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="podate">P.O. Date</label>
<input type="date" class="form-control" id="podate" name="podate" value="<?=$rowselect[0]['podate']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="otherreference">Asset. Year</label>
<input type="text" class="form-control" id="otherreference" name="otherreference" value="<?=$rowselect[0]['otherreference']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="custreference">Customer Reference ID</label>
<input type="text" class="form-control" id="custreference" name="custreference" value="<?=$rowselect[0]['custreference']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="tender">Tender</label>
<input type="text" class="form-control" id="tender" name="tender" value="<?=$rowselect[0]['tender']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="duedays">Due Days</label>
<input type="number" class="form-control" id="duedays" name="duedays" value="<?=$rowselect[0]['duedays']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="salesperson">Sales Person</label>
<select class="form-control" id="salesperson" name="salesperson" required>
<option value="">Select</option>
<?php
$sqlsai=mysqli_query($connection, "select name, email from jrcsalesperson where eligiblesales='1' order by name asc");
while($infosai=mysqli_fetch_array($sqlsai))
{
?>
<option value="<?=$infosai['email']?>"<?=($rowselect[0]['salesperson']==$infosai['email'])?'selected':''?>><?=$infosai['name']?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="shipment">Shipment Date</label>
<input type="date" class="form-control" id="shipment" name="shipment" value="<?=$rowselect[0]['shipment']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="deliverymethod">Delivery Method</label>
<input type="text" class="form-control" id="deliverymethod" name="deliverymethod" value="<?=$rowselect[0]['deliverymethod']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="agentname">Carrier Name / Agent</label>
<input type="text" class="form-control" id="agentname" name="agentname" value="<?=$rowselect[0]['agentname']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="lrno">Bill of Lading/LR-RR No</label>
<input type="text" class="form-control" id="lrno" name="lrno" value="<?=$rowselect[0]['lrno']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="vechileno">Motor Vehicle No</label>
<input type="text" class="form-control" id="vechileno" name="vechileno" value="<?=$rowselect[0]['vechileno']?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="deliveryremarks">Delivery Remarks</label>
<input type="text" class="form-control" id="deliveryremarks" name="deliveryremarks" value="<?=$rowselect[0]['deliveryremarks']?>">
</div>
</div>
</div>
</div>
</div>
<hr>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label for="pricemark">Price Marks</label>
<select class="form-control" id="pricemark" name="pricemark" onchange="pricemarkchange()">
<option value="">Select</option>
<?php
$sqlsai=mysqli_query($connection, "select * from jrcmark where enabled='0' order by productname asc limit 5");
while($infosai=mysqli_fetch_array($sqlsai))
{
?>
<option value="<?=$infosai['id']?>"<?=($rowselect[0]['pricemark']==$infosai['id'])?'selected':''?>><?=$infosai['productname']?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-lg-3">
<div class="markresponse">
</div>
</div>
</div>
<div class="table-responsive">
<table class="table table-bordered" id="table-data">
<tr>
<th>PRODUCT </th><th>QTY</th><th>RATE</th><th>DISCOUNT</th><th>TAX</th><th>AMOUNT</th><th></th>
</tr>
<?php
$i=1;
foreach($rowselect as $row) 
{
?>
<tr class="tr_clone">
<!--th><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="32"></th-->
<td>
<select class="form-control fav_clr stockitem1" id="stockitem<?=$i?>" name="stockitem[]" onchange="stockitemchange(<?=$i?>)">
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
<option value="<?=$rowgo['id']?>"<?=($row['stockitem']==$rowgo['id'])?'selected':''?>><?=$rowgo['stockitem']?></option>
<?php
}
}
?>
</select>
<div id="productresponse<?=$i?>"></div>
</td>

<input type="hidden" name="id[]" id="id<?=$i?>" value="<?=$row['id']?>">
<input type="hidden" name="oldqty[]" id="oldqty<?=$i?>" value="<?=$row['qty']?>">
<td style="width:8%"><input type="number" name="qty[]" id="qty<?=$i?>" class="form-control" min="0" onchange="productcalc(<?=$i?>)" style="text-align:right" value="<?=$row['qty']?>"><span href="#" data-toggle="modal" data-target="#serialchangemodal" onclick=" serialnumbers(<?=$i?>)" class="text-danger text-right">Update Serial</span>
<input type="hidden" name="serialnumber[]" id="serialnumber<?=$i?>" value="<?=$row['serialnumber']?>">
<input type="hidden" name="department[]" id="department<?=$i?>" value="<?=$row['department']?>"></td>
<td style="width:10%"><input type="number" name="rate[]" id="rate<?=$i?>" class="form-control" min="0" step="0.01" onchange="productcalc(<?=$i?>)" style="text-align:right" value="<?=$row['rate']?>"><div id="rateresponse<?=$i?>"></div><div id="ratecresponse<?=$i?>"></div>
<input type="hidden" name="productamount[]" id="productamount<?=$i?>">
</td>
<td style="width:12%">
<div class="input-group">
<input type="number" name="discount[]" id="discount<?=$i?>" class="form-control" onchange="productcalc(<?=$i?>)" style="text-align:right" min="0" step="0.01" value="<?=$row['discount']?>">
<div class="input-group-append">
<select id="discountmode<?=$i?>" name="discountmode[]" class="form-control" data-live-search="true" onchange="productcalc(<?=$i?>)">
<option value="percentage"<?=($row['discountmode']=='percentage')?'selected':''?>>%</option>
<option value="rupee"<?=($row['discountmode']=='rupee')?'selected':''?>>₹</option>
</select>
</div>
</div>
<input type="hidden" name="discountamount[]" id="discountamount<?=$i?>" value="<?=$row['discountamount']?>">
<input type="hidden" name="pretotalamount[]" id="pretotalamount<?=$i?>" value="<?=$row['pretotalamount']?>">
<div id="discountresponse<?=$i?>"></div>
</td>
<td style="width:12%"><input type="number" name="gstper[]" id="gstper<?=$i?>" readonly class="form-control" style="text-align:right"><div id="gstresponse<?=$i?>">
</div>
<input type="hidden" name="igstper[]" id="igstper<?=$i?>"  value="<?=$row['igstper']?>">
<input type="hidden" name="cgstper[]" id="cgstper<?=$i?>" value="<?=$row['cgstper']?>">
<input type="hidden" name="sgstper[]" id="sgstper<?=$i?>" value="<?=$row['sgstper']?>">
<input type="hidden" name="igstamount[]" id="igstamount<?=$i?>" value="<?=$row['igstamount']?>">
<input type="hidden" name="cgstamount[]" id="cgstamount<?=$i?>" value="<?=$row['cgstamount']?>">
<input type="hidden" name="sgstamount[]" id="sgstamount<?=$i?>" value="<?=$row['sgstamount']?>">
<input type="hidden" name="gstamount[]" id="gstamount<?=$i?>" value="<?=$row['gstamount']?>">
</td>
<td style="width:10%"><input type="number" name="totalamount[]" id="totalamount<?=$i?>" readonly class="form-control" style="text-align:right" value="<?=$row['totalamount']?>"><div id="totalamountresponse<?=$i?>"></div>
</td>
<td style="width:2%"><?php if(count($rowselect)==$i){?><span class="tr_clone_add"><i class="fa fa-plus"></i></span><?php } ?></td>
</tr>
<?php
$in[]=$i;
$i++;
}
?>
</table>
</div>
<div class="row">
<div class="col-lg-8">

<div class="row">
<div class="col-lg-4">
<div class="form-group">
<label for="totalitems">Total Items</label>
<input type="text" class="form-control" id="totalitems" name="totalitems" readonly value="<?=$rowselect[0]['totalitems']?>">
</div>
<div class="form-group">
<label for="totalqty">Total Qty</label>
<input type="text" class="form-control" id="totalqty" name="totalqty" readonly value="<?=$rowselect[0]['totalqty']?>">
</div>
</div>
<div class="col-lg-8">
<div class="form-group">
<label for="notes">Notes</label>
<textarea class="form-control" id="notes" name="notes" style="height: 78px;"><?=$rowselect[0]['notes']?></textarea>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div class="form-group">
<label for="attachments">Attach File(s) to Sales Order</label>
<input type="hidden"  id="oldattachments" name="oldattachments" value="<?=$rowselect[0]['attachments']?>">
<input type="file" class="form-control" id="attachments" name="attachments" style="padding:10px; height:auto">
<label for="terms">You can upload a maximum of two files, Each with a size limit of 2MB</label>
<?php 
if($rowselect[0]['attachments']!='')
{
$ext = pathinfo($rowselect[0]['attachments'], PATHINFO_EXTENSION);
if ($ext=="pdf") {
   
?>
<a href="#" class="pop"><embed src="<?php echo $rowselect[0]['attachments']?>" width="200px" height="200px"  type="application/pdf"/></a>
<?php
}
else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
   
?>
<a href="#" class="pop"><img src="<?php echo $rowselect[0]['attachments']?>" width="200px" height="200px" ></a>
<?php
}
else{
	?>
	<a href="<?php echo $rowselect[0]['attachments']?>" >View File</a>
	<?php
}
}

?>
</div>
</div>
<div class="col-lg-8">
<div class="form-group">
<label for="terms">Terms and Conditions</label>
<textarea class="form-control" id="terms" name="terms" style="height: 60px;"><?=$rowselect[0]['terms']?></textarea>

</div>
</div>
</div>

</div>
<div class="col-lg-4">

<div class="form-group row">
    <label for="subtotalamount" class="col-sm-4 col-form-label text-right">Sub Total Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="subtotalamount" name="subtotalamount" style="text-align:right" value="<?=$rowselect[0]['subtotalamount']?>" >
    </div>
  </div>
<div class="form-group row">
    <label for="totalgstamount" class="col-sm-4 col-form-label text-right">Total GST Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="totalgstamount" name="totalgstamount" style="text-align:right" value="<?=$rowselect[0]['totalgstamount']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="netamount" class="col-sm-4 col-form-label text-right">Net Amount</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="netamount" name="netamount" style="text-align:right" value="<?=$rowselect[0]['netamount']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="shippingamount" class="col-sm-4 col-form-label text-right">Shipping Charges</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="shippingamount" name="shippingamount" onChange="productnet()" style="text-align:right" value="<?=$rowselect[0]['shippingamount']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="grandtotal" class="col-sm-4 col-form-label text-right font-weight-bold">Grand Total (₹)</label>
    <div class="col-sm-8">
	  <input type="hidden" name="oldgrandtotal" id="oldgrandtotal" value="<?=$rowselect[0]['grandtotal']?>">
      <input type="text" readonly class="form-control" id="grandtotal" name="grandtotal" style="text-align:right" value="<?=$rowselect[0]['grandtotal']?>">
    </div>
  </div>

</div>
</div>
<div class="row">
<div class="col-lg-12">
<input type="submit" name="submit" id="submit" value="Submit">
</div>
</div>



</form>
</div>
</div>
<?php
		}
}
?>
</div>
</div>
</div>
</div>
<?php include('footer.php'); ?>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<!-----product modal---->
<div class="modal fade" id="productmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Change Product Information</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="prtagForm">
<input type="hidden" name="prproductid" id="prproductid">
<div class="row">
<?php
if($infolayoutproducts['type']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Type</label>
<br>
<label><input type="radio" id="prtypegoods" name="prtype"<?=($infolayoutproducts['typereq']=='1')?'required':''?> value="Goods" <?=($infolayoutproducts['type']=='Goods')?'checked':''?>> Goods</label>	&nbsp;
<label><input type="radio" id="prtypeservice" name="prtype"<?=($infolayoutproducts['typereq']=='1')?'required':''?> value="Service" <?=($infolayoutproducts['type']=='Service')?'checked':''?>> Service</label>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prtype" id="prtype" value="">
<?php
}
if($infolayoutproducts['sku']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">SKU (Stock Keeping Unit) </label>
<input type="text" class="form-control" id="prsku" name="prsku" <?=($infolayoutproducts['skureq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prsku" id="prsku" value="">
<?php
}
if($infolayoutproducts['unit']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Unit</label>
<select class="form-control" id="prunit" name="prunit" <?=($infolayoutproducts['unitreq']=='1')?'required':''?>>
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
<input type="hidden" name="prunit" id="prunit" value="">
<?php
}
if($infolayoutproducts['hsncode']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">HSN Code</label>
<input type="text" class="form-control" id="prhsncode" name="prhsncode" <?=($infolayoutproducts['hsncodereq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prhsncode" id="prhsncode" value="">
<?php
}
if($infolayoutproducts['taxpreference']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="type">Tax Preference</label>
<select class="form-control" id="prtaxpreference" name="prtaxpreference" <?=($infolayoutproducts['taxpreferencereq']=='1')?'required':''?> onclick="taxable()">
<option value="">Select</option>
<option value="Taxable" onclick="taxable()">Taxable </option>
<option value="Non-Taxable" onclick="taxable()">Non-Taxable</option>
</select>
</div>
</div>
<div class="col-lg-3" id="prgstdiv">
<div class="form-group">
<label for="gstpercentage">Intra State Tax Rate</label>
<select class="form-control" id="prgstpercentage" name="prgstpercentage" onChange="perchange('prgstpercentage')">
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
<div class="col-lg-3" id="prigstdiv">
<div class="form-group">
<label for="igstpercentage">Inter State Tax Rate</label>
<select class="form-control" id="prigstpercentage" name="prigstpercentage" onChange="perchange('prigstpercentage')">
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
<div class="col-lg-3" id="prexemptiondiv" style="display:none">
<div class="form-group">
<label for="exemption"> Exemption Reason</label>
<textarea class="form-control" id="prexemption" onChange="taxable()" name="prexemption"></textarea>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prtaxpreference" id="prtaxpreference" value="">
<input type="hidden" name="prgstpercentage" id="prgstpercentage" value="">
<input type="hidden" name="prigstpercentage" id="prigstpercentage" value="">
<input type="hidden" name="prexemption" id="prexemption" value="">
<?php
}
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="stockmaincategory">Main Category</label>
<input type="text" class="form-control" id="prstockmaincategory" name="prstockmaincategory" <?=($infolayoutproducts['stockmaincategoryreq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prstockmaincategory" id="prstockmaincategory" value="">
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="stocksubcategory">Sub Category</label>
<input type="text" class="form-control" id="prstocksubcategory" name="prstocksubcategory" <?=($infolayoutproducts['stocksubcategoryreq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prstocksubcategory" id="prstocksubcategory" value="">
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="stockitem">Product Name</label>
<input type="text" class="form-control" id="prstockitem" name="prstockitem" <?=($infolayoutproducts['stockitemreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prstockitem" id="prstockitem" value="">
<?php
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="typeofproduct">Type of Product</label>
<input type="text" class="form-control" id="prtypeofproduct" name="prtypeofproduct" <?=($infolayoutproducts['typeofproductreq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prtypeofproduct" id="prtypeofproduct" value="">
<?php
}
if($infolayoutproducts['componenttype']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="componenttype">Component Type</label>
<input type="text" class="form-control" id="prcomponenttype" name="prcomponenttype" <?=($infolayoutproducts['componenttypereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prcomponenttype" id="prcomponenttype" value="">
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<div class="col-lg-6">
<div class="form-group">
<label for="componentname">Component Name</label>
<input type="text" class="form-control" id="prcomponentname" name="prcomponentname" <?=($infolayoutproducts['componentnamereq']=='1')?'required':''?> >
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prcomponentname" id="prcomponentname" value="">
<?php
}
if($infolayoutproducts['make']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="make">Make</label>
<input type="text" class="form-control" id="prmake" name="prmake" <?=($infolayoutproducts['makereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prmake" id="prmake" value="">
<?php
}
if($infolayoutproducts['capacity']=='1')
{
?>
<div class="col-lg-3">
<div class="form-group">
<label for="capacity">Capacity</label>
<input type="text" class="form-control" id="prcapacity" name="prcapacity" <?=($infolayoutproducts['capacityreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="prcapacity" id="prcapacity" value="">
<?php
}
?>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="prtag-form-submit" onclick="productformsubmit(this.id)" name="prchsubmit" value="Submit">
</div>
</form>
</div>
</div>
</div>
<!-----product modal---->
<!-----buyer modal---->
<div class="modal fade" id="buyermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Change Buyer Information</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="bytagForm">
<input type="hidden" name="byconsigneeid" id="byconsigneeid">
<div class="row">
<?php
if($infolayoutcustomers['ctype']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="ctype">Customer Type</label>
<select class="form-control" id="byctype" name="byctype" <?=($infolayoutcustomers['ctypereq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT ctype From jrcctype order by ctype desc";
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
<option value="<?=$rowrep['ctype']?>"><?=$rowrep['ctype']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="byctype" id="byctype" value="">
<?php
}
if($infolayoutcustomers['maincategory']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="maincategory">Main Category</label>
<input type="text" class="form-control" id="bymaincategory" name="bymaincategory" <?=($infolayoutcustomers['maincategoryreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bymaincategory" id="bymaincategory" value="">
<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="subcategory">Sub Category</label>
<input type="text" class="form-control" id="bysubcategory" name="bysubcategory" <?=($infolayoutcustomers['subcategoryreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bysubcategory" id="bysubcategory" value="">
<?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-12">
<div class="form-group">
<label for="consigneename">Customer Name</label>
<input type="text" class="form-control" id="byconsigneename" name="byconsigneename"  <?=($infolayoutcustomers['consigneenamereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="byconsigneename" id="byconsigneename" value="">
<?php
}
if($infolayoutcustomers['department']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="department">Department</label>
<input type="text" class="form-control" id="bydepartment" name="bydepartment" <?=($infolayoutcustomers['departmentreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bydepartment" id="bydepartment" value="">
<?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="address1">Address 1</label>
<input type="text" class="form-control" id="byaddress1" name="byaddress1" <?=($infolayoutcustomers['address1req']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="byaddress1" id="byaddress1" value="">
<?php
}
if($infolayoutcustomers['address2']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="address2">Address 2</label>
<input type="text" class="form-control" id="byaddress2" name="byaddress2" <?=($infolayoutcustomers['address2req']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="byaddress2" id="byaddress2" value="">
<?php
}
if($infolayoutcustomers['area']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="area">Area</label>
<input type="text" class="form-control" id="byarea" name="byarea" <?=($infolayoutcustomers['areareq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="byarea" id="byarea" value="">
<?php
}
if($infolayoutcustomers['district']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="district">District</label>
<input type="text" class="form-control" id="bydistrict" name="bydistrict" <?=($infolayoutcustomers['districtreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bydistrict" id="bydistrict" value="">
<?php
}
if($infolayoutcustomers['pincode']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="pincode">Pincode</label>
<input type="text" class="form-control" id="bypincode" name="bypincode" maxlength="6"  <?=($infolayoutcustomers['pincodereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bypincode" id="bypincode" value="">
<?php
}
if($infolayoutcustomers['latlong']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="latlong">LatLong</label><a onclick="openaddress()" class="float-right text-danger">Get LatLong</a>
<input type="text" class="form-control" id="bylatlong" name="bylatlong" <?=($infolayoutcustomers['latlongreq']=='1')?'required':''?> onKeyup="cleartext()">
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bylatlong" id="bylatlong" value="">
<?php
}
if($infolayoutcustomers['contact']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="contact">Contact Person</label>
<input type="text" class="form-control" id="bycontact" name="bycontact" <?=($infolayoutcustomers['contactreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bycontact" id="bycontact" value="">
<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="phone">Phone No</label>
<input type="text" class="form-control" id="byphone" name="byphone" maxlength="11" <?=($infolayoutcustomers['phonereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="byphone" id="byphone" value="">
<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="mobile">Mobile No</label>
<input type="text" class="form-control" id="bymobile" name="bymobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bymobile" id="bymobile" value="">
<?php
}
if($infolayoutcustomers['email']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="email">Email</label>
<input type="email" class="form-control" id="byemail" name="byemail" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="byemail" id="byemail" value="">
<?php
}
if($infolayoutcustomers['gstno']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="bygsttype">GST Registration Type</label>
<select class="form-control" id="bygsttype" name="bygsttype" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT rype From jrcregtype order by id asc";
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
<option value="<?=$rowrep['rype']?>"><?=$rowrep['rype']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="gstno">GST No</label>
<input type="text" class="form-control" id="bygstno" name="bygstno" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?>>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="bystatecode">State Code</label>
<select class="form-control" id="bystatecode" name="bystatecode" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep1 = "SELECT statecode From jrcplace order by id asc";
$queryrep1 = mysqli_query($connection, $sqlrep1);
$rowCountrep1 = mysqli_num_rows($queryrep1);
if(!$queryrep1){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountrep1 > 0)
{
while($rowrep1 = mysqli_fetch_array($queryrep1))
{
?>
<option value="<?=$rowrep1['statecode']?>"><?=$rowrep1['statecode']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="bygstno" id="bygstno" value="">
<input type="hidden" name="bygsttype" id="bygsttype" value="">
<input type="hidden" name="bystatecode" id="bystatecode" value="">
<?php
}
?>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="bytag-form-submit" name="chsubmit" value="Submit">
</div>
</form>
</div>
</div>
</div>
<!-----buyer modal---->
<!-----consignee modal---->
<div class="modal fade" id="consigneemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Change Information</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="tagForm">
<input type="hidden" name="chconsigneeid" id="chconsigneeid">
<div class="row">
<?php
if($infolayoutcustomers['ctype']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="ctype">Customer Type</label>
<select class="form-control" id="chctype" name="chctype" <?=($infolayoutcustomers['ctypereq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT ctype From jrcctype order by ctype desc";
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
<option value="<?=$rowrep['ctype']?>"><?=$rowrep['ctype']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chctype" id="chctype" value="">
<?php
}
if($infolayoutcustomers['maincategory']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="maincategory">Main Category</label>
<input type="text" class="form-control" id="chmaincategory" name="chmaincategory" <?=($infolayoutcustomers['maincategoryreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chmaincategory" id="chmaincategory" value="">
<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="subcategory">Sub Category</label>
<input type="text" class="form-control" id="chsubcategory" name="chsubcategory" <?=($infolayoutcustomers['subcategoryreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chsubcategory" id="chsubcategory" value="">
<?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-12">
<div class="form-group">
<label for="consigneename">Customer Name</label>
<input type="text" class="form-control" id="chconsigneename" name="chconsigneename"  <?=($infolayoutcustomers['consigneenamereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chconsigneename" id="chconsigneename" value="">
<?php
}
if($infolayoutcustomers['department']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="department">Department</label>
<input type="text" class="form-control" id="chdepartment" name="chdepartment" <?=($infolayoutcustomers['departmentreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chdepartment" id="chdepartment" value="">
<?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="address1">Address 1</label>
<input type="text" class="form-control" id="chaddress1" name="chaddress1" <?=($infolayoutcustomers['address1req']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chaddress1" id="chaddress1" value="">
<?php
}
if($infolayoutcustomers['address2']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="address2">Address 2</label>
<input type="text" class="form-control" id="chaddress2" name="chaddress2" <?=($infolayoutcustomers['address2req']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chaddress2" id="chaddress2" value="">
<?php
}
if($infolayoutcustomers['area']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="area">Area</label>
<input type="text" class="form-control" id="charea" name="charea" <?=($infolayoutcustomers['areareq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="charea" id="charea" value="">
<?php
}
if($infolayoutcustomers['district']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="district">District</label>
<input type="text" class="form-control" id="chdistrict" name="chdistrict" <?=($infolayoutcustomers['districtreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chdistrict" id="chdistrict" value="">
<?php
}
if($infolayoutcustomers['pincode']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="pincode">Pincode</label>
<input type="text" class="form-control" id="chpincode" name="chpincode" maxlength="6"  <?=($infolayoutcustomers['pincodereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chpincode" id="chpincode" value="">
<?php
}
if($infolayoutcustomers['latlong']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="latlong">LatLong</label><a onclick="openaddress()" class="float-right text-danger">Get LatLong</a>
<input type="text" class="form-control" id="chlatlong" name="chlatlong" <?=($infolayoutcustomers['latlongreq']=='1')?'required':''?> onKeyup="cleartext()">
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chlatlong" id="chlatlong" value="">
<?php
}
if($infolayoutcustomers['contact']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="contact">Contact Person</label>
<input type="text" class="form-control" id="chcontact" name="chcontact" <?=($infolayoutcustomers['contactreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chcontact" id="chcontact" value="">
<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="phone">Phone No</label>
<input type="text" class="form-control" id="chphone" name="chphone" maxlength="11" <?=($infolayoutcustomers['phonereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chphone" id="chphone" value="">
<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="mobile">Mobile No</label>
<input type="text" class="form-control" id="chmobile" name="chmobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chmobile" id="chmobile" value="">
<?php
}
if($infolayoutcustomers['email']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="email">Email</label>
<input type="email" class="form-control" id="chemail" name="chemail" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?>>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chemail" id="chemail" value="">
<?php
}
if($infolayoutcustomers['gstno']=='1')
{
?>
<div class="col-lg-4">
<div class="form-group">
<label for="gsttype">GST Registration Type</label>
<select class="form-control" id="chgsttype" name="chgsttype" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT rype From jrcregtype order by id asc";
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
<option value="<?=$rowrep['rype']?>"><?=$rowrep['rype']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="chgstno">GST No</label>
<input type="text" class="form-control" id="chgstno" name="chgstno" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?>>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="statecode">State Code</label>
<select class="form-control" id="chstatecode" name="chstatecode" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep1 = "SELECT statecode From jrcplace order by id asc";
$queryrep1 = mysqli_query($connection, $sqlrep1);
$rowCountrep1 = mysqli_num_rows($queryrep1);
if(!$queryrep1){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountrep1 > 0)
{
while($rowrep1 = mysqli_fetch_array($queryrep1))
{
?>
<option value="<?=$rowrep1['statecode']?>"><?=$rowrep1['statecode']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chgstno" id="chgstno" value="">
<input type="hidden" name="chgsttype" id="chgsttype" value="">
<input type="hidden" name="chstatecode" id="chstatecode" value="">
<?php
}
?>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="tag-form-submit" name="chsubmit" value="Submit">
</div>
</form>
</div>
</div>
</div>
<!-----consignee modal---->
<!-----consignee change modal---->
<div class="modal fade" id="consigneechangemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Change Information</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="chchtagForm">
<div class="row">
<?php
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-12">
<div class="form-group">
<label for="consigneename">Customer Name</label>
<select class="form-control fav_clr" id="chchconsigneename" name="chchconsigneename">
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, consigneename From jrcconsignee where consigneename!='' order by consigneename asc limit 10";
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
<option value="<?=$rowgo['id']?>"<?=($rowselect[0]['consigneemainid']==$rowgo['id'])?'selected':''?>><?=$rowgo['consigneename']?></option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
else
{
?>
<input type="hidden" name="chconsigneename" id="chconsigneename" value="<?=$rowselect[0]['consigneemainid']?>">
<?php
}
?>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="chchtag-form-submit" name="chsubmit" value="Submit">
</div>
</form>
</div>
</div>
</div>
<!-----consignee change modal---->
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
$( "#chmaincategory" ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
appendTo: "#consigneemodal",
});
$( "#chsubcategory" ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
appendTo: "#consigneemodal",
});
$( "#chconsigneename" ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
appendTo: "#consigneemodal",
});
$( "#chdepartment" ).autocomplete({
source: 'consigneesearch.php?type=department',
appendTo: "#consigneemodal",
});
$( "#bymaincategory" ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
appendTo: "#buyermodal",
});
$( "#bysubcategory" ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
appendTo: "#buyermodal",
});
$( "#byconsigneename" ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
appendTo: "#buyermodal",
});
$( "#bydepartment" ).autocomplete({
source: 'consigneesearch.php?type=department',
appendTo: "#buyermodal",
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
$("#qty"+curid).val('');

$('#stockitem'+curid).val(null).trigger('change');
$("#rate"+curid).val('');
$("#discount"+curid).val('');
$("#totalamount"+curid).val('');
$("#gstper"+curid).val('');
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
$("#consigneename").select2({
width: '100%',
ajax: {
url: "invoicesalesearch.php",
type: "post",
dataType: 'json',
delay: 0,
data: function (params) {
return {
searchTerm: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});
$("#chchconsigneename").select2({
width: '100%',
ajax: {
url: "invoicesalesearch.php",
type: "post",
dataType: 'json',
delay: 0,
data: function (params) {
return {
searchTerm: params.term // search term
};
},
processResults: function (response) {
return {
results: response
};
},
cache: true
}
});
<?php
foreach($in as $inn) 
{
?>

$(".stockitem<?=$inn?>").select2({
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
<?php
}
?>

});
</script>
<script>
function stockitemchange(ids)
{
var stockitem = $("#stockitem"+ids).val();
var pricemark = $("#pricemark").val();
var datase='se';
$.ajax({
url: 'productsalesearch.php',
type: 'post',
data: {stockitem:stockitem, pricemark:pricemark},
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
productresponse1+='<div class="mt-1 text-primary mb-"+ids>Product Information <input type="hidden" name="productmainid[]" id="productmainid'+ids+'"><span href="#" data-toggle="modal" data-target="#productmodal" onclick="provalupdate('+ids+')">&nbsp;<i class="fa fa-pen"></i> </span></div><input type="hidden" name="productid[]" id="productid'+ids+'"><input type="hidden" name="stockmaincategory[]" id="stockmaincategory'+ids+'"><input type="hidden" name="stocksubcategory[]" id="stocksubcategory'+ids+'"><input type="hidden" name="typeofproduct[]" id="typeofproduct'+ids+'"><input type="hidden" name="stockname[]" id="stockname'+ids+'"><input type="hidden" name="componenttype[]" id="componenttype'+ids+'"><input type="hidden" name="componentname[]" id="componentname'+ids+'"><input type="hidden" name="make[]" id="make'+ids+'"><input type="hidden" name="capacity[]" id="capacity'+ids+'"><input type="hidden" name="warranty[]" id="warranty'+ids+'"><input type="hidden" name="description[]" id="description'+ids+'"><input type="hidden" name="price[]" id="price'+ids+'"><input type="hidden" name="minprice[]" id="minprice'+ids+'"><input type="hidden" name="gst[]" id="gst'+ids+'"><input type="hidden" name="currentstock[]" id="currentstock'+ids+'"><input type="hidden" name="type[]" id="type'+ids+'"><input type="hidden" name="sku[]" id="sku'+ids+'"><input type="hidden" name="unit[]" id="unit'+ids+'"><input type="hidden" name="hsncode[]" id="hsncode'+ids+'"><input type="hidden" name="taxpreference[]" id="taxpreference'+ids+'"><input type="hidden" name="gstpercentage[]" id="gstpercentage'+ids+'"><input type="hidden" name="igstpercentage[]" id="igstpercentage'+ids+'">';
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
if(currentstock!='')
{
productresponse1+='<div class="col-lg-12"><span class="text-primary">Available Stock: </span> '+currentstock+'';
var ava = availablestock.length;
for( var r = 0; r<ava; r++)
{
var available=availablestock[r]['availablestock'];
var godownname=availablestock[r]['godownname'];
var godownid=availablestock[r]['id'];
productresponse1+='<br><label><input type="radio" name="godownname'+ids+'" id="godownname'+ids+'s'+godownid+'" value="'+godownid+'"> '+godownname+' - '+available+'</label>';
}
productresponse1+='</div>';
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


//
gn();
	
productcalc(ids);
//productrate();
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
productresponse1+='<div class="mt-1 text-primary mb-"+ids>Product Information <input type="hidden" name="productmainid[]" id="productmainid'+ids+'"><span href="#" data-toggle="modal" data-target="#productmodal" onclick="provalupdate('+ids+')">&nbsp;<i class="fa fa-pen"></i> </span></div><input type="hidden" name="productid[]" id="productid'+ids+'"><input type="hidden" name="stockmaincategory[]" id="stockmaincategory'+ids+'"><input type="hidden" name="stocksubcategory[]" id="stocksubcategory'+ids+'"><input type="hidden" name="stockname[]" id="stockname'+ids+'"><input type="hidden" name="typeofproduct[]" id="typeofproduct'+ids+'"><input type="hidden" name="componenttype[]" id="componenttype'+ids+'"><input type="hidden" name="componentname[]" id="componentname'+ids+'"><input type="hidden" name="make[]" id="make'+ids+'"><input type="hidden" name="capacity[]" id="capacity'+ids+'"><input type="hidden" name="warranty[]" id="warranty'+ids+'"><input type="hidden" name="description[]" id="description'+ids+'"><input type="hidden" name="price[]" id="price'+ids+'"><input type="hidden" name="minprice[]" id="minprice'+ids+'"><input type="hidden" name="gst[]" id="gst'+ids+'"><input type="hidden" name="currentstock[]" id="currentstock'+ids+'"><input type="hidden" name="type[]" id="type'+ids+'"><input type="hidden" name="sku[]" id="sku'+ids+'"><input type="hidden" name="unit[]" id="unit'+ids+'"><input type="hidden" name="hsncode[]" id="hsncode'+ids+'"><input type="hidden" name="taxpreference[]" id="taxpreference'+ids+'"><input type="hidden" name="gstpercentage[]" id="gstpercentage'+ids+'"><input type="hidden" name="igstpercentage[]" id="igstpercentage'+ids+'">';
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
if(currentstock!='')
{
productresponse1+='<div class="col-lg-12"><span class="text-primary">Available Stock: </span> '+currentstock+'';
var ava = availablestock.length;
for( var r = 0; r<ava; r++)
{
var available=availablestock[r]['availablestock'];
var godownname=availablestock[r]['godownname'];
var godownid=availablestock[r]['id'];
productresponse1+='<br><label><input type="radio" name="godownname'+ids+'[]" id="godownname'+ids+'s'+godownid+'" value="'+godownid+'"> '+godownname+' - '+available+'</label>';
}
productresponse1+='</div>';
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


error: function(xhr, status, error) {
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
}

});
return false;
}
</script>
<script>
$(document).ready(function(){
$("#consigneename").change(function(){
var consigneename = $(this).val();
var datase='se';
$.ajax({
url: 'invoicesalesearch.php',
type: 'post',
data: {consigneename:consigneename},
dataType: 'json',
success:function(response)
{
var len = response.length;
$("#consigneeresponse").empty();
$("#buyerresponse").empty();
for( var i = 0; i<len; i++){
var consigneeid = response[i]['consigneeid'];
/* var consigneemainid = response[i]['consigneemainid']; */
var consigneename = response[i]['consigneename'];
var department = response[i]['department'];
var address1 = response[i]['address1'];
var address2 = response[i]['address2'];
var area = response[i]['area'];
var district = response[i]['district'];
var pincode = response[i]['pincode'];
var contact = response[i]['contact'];
var phone = response[i]['phone'];
var mobile = response[i]['mobile'];
var email = response[i]['email'];
var gstno= response[i]['gstno'];var gsttype= response[i]['gsttype']; var statecode= response[i]['statecode'];
var ctype= response[i]['ctype'];
$("#chchconsigneename").val(consigneeid);
$("#consigneeresponse").append(consigneename);
/* $("#chconsigneeid").val(consigneeid); */
<?php 
if($rowselect[0]['consigneemainid']==$rowselect[0]['consigneename'])
{
?>
$("#consigneemainid").val(consigneeid);
<?php
}
else
{
?>
$("#consigneemainid").val('<?=$rowselect[0]['consigneemainid']?>');
$("#chchconsigneename").val('<?=$rowselect[0]['consigneemainid']?>');
$("#chchtag-form-submit").trigger("click");

<?php
}
?>
$("#chconsigneename").val(consigneename);
if(ctype!='')
{
$("#consigneeresponse").append('<br>'+ctype);
}
$("#chctype").val(ctype);
if(department!='')
{
$("#consigneeresponse").append('<br>'+department);
}
$("#chdepartment").val(department);
if(address1!='')
{
$("#consigneeresponse").append('<br>'+address1);
}
$("#chaddress1").val(address1);
if(address2!='')
{
$("#consigneeresponse").append('<br>'+address2);
}
$("#chaddress2").val(address2);
if(area!='')
{
$("#consigneeresponse").append('<br>'+area);
}
$("#charea").val(area);
if(district!='')
{
$("#consigneeresponse").append('<br>'+district);
}
$("#chdistrict").val(district);
if(pincode!='')
{
$("#consigneeresponse").append('<br>'+pincode);
}
$("#chpincode").val(pincode);
if(contact!='')
{
$("#consigneeresponse").append('<br>'+contact);
}
$("#chcontact").val(contact);
if(phone!='')
{
$("#consigneeresponse").append('<br>'+phone);
}
$("#chphone").val(phone);
if(mobile!='')
{
$("#consigneeresponse").append('<br>'+mobile);
}
$("#chmobile").val(mobile);
if(email!='')
{
$("#consigneeresponse").append('<br>'+email);
}
$("#chemail").val(email);
if(gstno!='')
{
$("#consigneeresponse").append('<br>GST No: '+gstno);
}
$("#chgstno").val(gstno);
if(gsttype!='')
{
$("#consigneeresponse").append('<br>'+gsttype);
}
$("#chgsttype").val(gsttype);
if(statecode!='')
{
$("#consigneeresponse").append('<br>'+statecode);
}
$("#chstatecode").val(statecode);
////////buyer
$("#buyerresponse").append(consigneename);
$("#byconsigneeid").val(consigneeid);
$("#buyermainid").val(consigneeid);
$("#byconsigneename").val(consigneename);
if(ctype!='')
{
$("#buyerresponse").append('<br>'+ctype);
}
$("#byctype").val(ctype);
if(department!='')
{
$("#buyerresponse").append('<br>'+department);
}
$("#bydepartment").val(department);
if(address1!='')
{
$("#buyerresponse").append('<br>'+address1);
}
$("#byaddress1").val(address1);
if(address2!='')
{
$("#buyerresponse").append('<br>'+address2);
}
$("#byaddress2").val(address2);
if(area!='')
{
$("#buyerresponse").append('<br>'+area);
}
$("#byarea").val(area);
if(district!='')
{
$("#buyerresponse").append('<br>'+district);
}
$("#bydistrict").val(district);
if(pincode!='')
{
$("#buyerresponse").append('<br>'+pincode);
}
$("#bypincode").val(pincode);
if(contact!='')
{
$("#buyerresponse").append('<br>'+contact);
}
$("#bycontact").val(contact);
if(phone!='')
{
$("#buyerresponse").append('<br>'+phone);
}
$("#byphone").val(phone);
if(mobile!='')
{
$("#buyerresponse").append('<br>'+mobile);
}
$("#bymobile").val(mobile);
if(email!='')
{
$("#buyerresponse").append('<br>'+email);
}
$("#byemail").val(email);
if(gstno!='')
{
$("#buyerresponse").append('<br>GST No: '+gstno);
}
$("#bygstno").val(gstno);
if(gsttype!='')
{
$("#buyerresponse").append('<br>'+gsttype);
}
$("#bygsttype").val(gsttype);
if(statecode!='')
{
$("#buyerresponse").append('<br>'+statecode);
}
else
{
$("#buyerresponse").append('<br><span class="text-danger">State Code Missing</span>');
}
$("#bystatecode").val(statecode);
if($("#stockitem").val()!='')
{
<?php
foreach($in as $inn) 
{
?>
stockitemchange(<?=$inn?>);
<?php
}
?>
}
$("#modalresponse").css("display", "block");
}
}
});
});

$("#consigneename").val("<?=$rowselect[0]['consigneename']?>").trigger("change");
//$("#consigneemainid").val("<?=$rowselect[0]['consigneemainid']?>").trigger("change");

$('#chchtag-form-submit').on('click', function(e) {
e.preventDefault();
var consigneename = $("#chchconsigneename").val();
var datase='se';
$.ajax({
url: 'invoicesalesearch.php',
type: 'post',
data: {consigneename:consigneename},
dataType: 'json',
success:function(response)
{
console.log(response);
$('#consigneechangemodal').modal('toggle');
var len = response.length;
$("#consigneeresponse").empty();
for( var i = 0; i<len; i++){
var consigneeid = response[i]['consigneeid'];
var consigneename = response[i]['consigneename'];
var department = response[i]['department'];
var address1 = response[i]['address1'];
var address2 = response[i]['address2'];
var area = response[i]['area'];
var district = response[i]['district'];
var pincode = response[i]['pincode'];
var contact = response[i]['contact'];
var phone = response[i]['phone'];
var mobile = response[i]['mobile'];
var email = response[i]['email'];
var gstno= response[i]['gstno'];var gsttype= response[i]['gsttype']; var statecode= response[i]['statecode'];
var ctype= response[i]['ctype'];
$("#chchconsigneename").val(consigneeid);
$("#consigneeresponse").append(consigneename);
$("#chconsigneeid").val(consigneeid);
$("#consigneemainid").val(consigneeid);
$("#chconsigneename").val(consigneename);
if(ctype!='')
{
$("#consigneeresponse").append('<br>'+ctype);
}
$("#chctype").val(ctype);
if(department!='')
{
$("#consigneeresponse").append('<br>'+department);
}
$("#chdepartment").val(department);
if(address1!='')
{
$("#consigneeresponse").append('<br>'+address1);
}
$("#chaddress1").val(address1);
if(address2!='')
{
$("#consigneeresponse").append('<br>'+address2);
}
$("#chaddress2").val(address2);
if(area!='')
{
$("#consigneeresponse").append('<br>'+area);
}
$("#charea").val(area);
if(district!='')
{
$("#consigneeresponse").append('<br>'+district);
}
$("#chdistrict").val(district);
if(pincode!='')
{
$("#consigneeresponse").append('<br>'+pincode);
}
$("#chpincode").val(pincode);
if(contact!='')
{
$("#consigneeresponse").append('<br>'+contact);
}
$("#chcontact").val(contact);
if(phone!='')
{
$("#consigneeresponse").append('<br>'+phone);
}
$("#chphone").val(phone);
if(mobile!='')
{
$("#consigneeresponse").append('<br>'+mobile);
}
$("#chmobile").val(mobile);
if(email!='')
{
$("#consigneeresponse").append('<br>'+email);
}
$("#chemail").val(email);
if(gstno!='')
{
$("#consigneeresponse").append('<br>GST No: '+gstno);
}
$("#chgstno").val(gstno);
if(gsttype!='')
{
$("#consigneeresponse").append('<br>'+gsttype);
}
$("#chgsttype").val(gsttype);
if(statecode!='')
{
$("#consigneeresponse").append('<br>'+statecode);
}
$("#chstatecode").val(statecode);
$("#modalresponse").css("display", "block");
}
}
});
});
});
</script>
<script>
$(function() {
$('#tag-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "consigneeeditsajax.php",
data: $('#tagForm').serialize(),
success: function(response) {
console.log(response);
$('#consigneemodal').modal('toggle');
var len = response.length;
$("#consigneeresponse").empty();
var consigneeid = $("#chconsigneeid").val();
var byconsigneeid = $("#byconsigneeid").val();
var consigneename = $("#chconsigneename").val();
var department = $("#chdepartment").val();
var address1 = $("#chaddress1").val();
var address2 = $("#chaddress2").val();
var area = $("#charea").val();
var district = $("#chdistrict").val();
var pincode = $("#chpincode").val();
var contact = $("#chcontact").val();
var phone = $("#chphone").val();
var mobile = $("#chmobile").val();
var email = $("#chemail").val();
var gstno= $("#chgstno").val();
var gsttype= $("#chgsttype").val();
var statecode= $("#chstatecode").val();
var ctype= $("#chctype").val();
$("#consigneeresponse").append(consigneename);
if(ctype!='')
{
$("#consigneeresponse").append('<br>'+ctype);
}
if(department!='')
{
$("#consigneeresponse").append('<br>'+department);
}
if(address1!='')
{
$("#consigneeresponse").append('<br>'+address1);
}
if(address2!='')
{
$("#consigneeresponse").append('<br>'+address2);
}
if(area!='')
{
$("#consigneeresponse").append('<br>'+area);
}
if(district!='')
{
$("#consigneeresponse").append('<br>'+district);
}
if(pincode!='')
{
$("#consigneeresponse").append('<br>'+pincode);
}
if(contact!='')
{
$("#consigneeresponse").append('<br>'+contact);
}
if(phone!='')
{
$("#consigneeresponse").append('<br>'+phone);
}
if(mobile!='')
{
$("#consigneeresponse").append('<br>'+mobile);
}
if(email!='')
{
$("#consigneeresponse").append('<br>'+email);
}
if(gstno!='')
{
$("#consigneeresponse").append('<br>GST No: '+gstno);
}
if(gsttype!='')
{
$("#consigneeresponse").append('<br>'+gsttype);
}
if(statecode!='')
{
$("#consigneeresponse").append('<br>'+statecode);
}
///buyer
if(byconsigneeid==consigneeid)
{
$("#buyerresponse").empty();
$("#buyerresponse").append(consigneename);
if(ctype!='')
{
$("#buyerresponse").append('<br>'+ctype);
}
if(department!='')
{
$("#buyerresponse").append('<br>'+department);
}
if(address1!='')
{
$("#buyerresponse").append('<br>'+address1);
}
if(address2!='')
{
$("#buyerresponse").append('<br>'+address2);
}
if(area!='')
{
$("#buyerresponse").append('<br>'+area);
}
if(district!='')
{
$("#buyerresponse").append('<br>'+district);
}
if(pincode!='')
{
$("#buyerresponse").append('<br>'+pincode);
}
if(contact!='')
{
$("#buyerresponse").append('<br>'+contact);
}
if(phone!='')
{
$("#buyerresponse").append('<br>'+phone);
}
if(mobile!='')
{
$("#buyerresponse").append('<br>'+mobile);
}
if(email!='')
{
$("#buyerresponse").append('<br>'+email);
}
if(gstno!='')
{
$("#buyerresponse").append('<br>GST No: '+gstno);
}
if(gsttype!='')
{
$("#buyerresponse").append('<br>'+gsttype);
}
if(statecode!='')
{
$("#buyerresponse").append('<br>'+statecode);
}
}
$("#modalresponse").css("display", "block");
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>
<script>
$(function() {
$('#bytag-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "consigneeeditsajax.php",
data: $('#bytagForm').serialize(),
success: function(response) {
console.log(response);
$('#buyermodal').modal('toggle');
var len = response.length;
$("#buyerresponse").empty();
var consigneeid = $("#byconsigneeid").val();
var chconsigneeid = $("#chconsigneeid").val();
var consigneename = $("#byconsigneename").val();
var department = $("#bydepartment").val();
var address1 = $("#byaddress1").val();
var address2 = $("#byaddress2").val();
var area = $("#byarea").val();
var district = $("#bydistrict").val();
var pincode = $("#bypincode").val();
var contact = $("#bycontact").val();
var phone = $("#byphone").val();
var mobile = $("#bymobile").val();
var email = $("#byemail").val();
var gstno= $("#bygstno").val();
var gsttype= $("#bygsttype").val();
var statecode= $("#bystatecode").val();
var ctype= $("#byctype").val();
$("#buyerresponse").append(consigneename);
if(ctype!='')
{
$("#buyerresponse").append('<br>'+ctype);
}
if(department!='')
{
$("#buyerresponse").append('<br>'+department);
}
if(address1!='')
{
$("#buyerresponse").append('<br>'+address1);
}
if(address2!='')
{
$("#buyerresponse").append('<br>'+address2);
}
if(area!='')
{
$("#buyerresponse").append('<br>'+area);
}
if(district!='')
{
$("#buyerresponse").append('<br>'+district);
}
if(pincode!='')
{
$("#buyerresponse").append('<br>'+pincode);
}
if(contact!='')
{
$("#buyerresponse").append('<br>'+contact);
}
if(phone!='')
{
$("#buyerresponse").append('<br>'+phone);
}
if(mobile!='')
{
$("#buyerresponse").append('<br>'+mobile);
}
if(email!='')
{
$("#buyerresponse").append('<br>'+email);
}
if(gstno!='')
{
$("#buyerresponse").append('<br>GST No: '+gstno);
}
if(gsttype!='')
{
$("#buyerresponse").append('<br>'+gsttype);
}
if(statecode!='')
{
$("#buyerresponse").append('<br>'+statecode);
}
///consignee
if(chconsigneeid==consigneeid)
{
$("#consigneeresponse").empty();
$("#consigneeresponse").append(consigneename);
if(ctype!='')
{
$("#consigneeresponse").append('<br>'+ctype);
}
if(department!='')
{
$("#consigneeresponse").append('<br>'+department);
}
if(address1!='')
{
$("#consigneeresponse").append('<br>'+address1);
}
if(address2!='')
{
$("#consigneeresponse").append('<br>'+address2);
}
if(area!='')
{
$("#consigneeresponse").append('<br>'+area);
}
if(district!='')
{
$("#consigneeresponse").append('<br>'+district);
}
if(pincode!='')
{
$("#consigneeresponse").append('<br>'+pincode);
}
if(contact!='')
{
$("#consigneeresponse").append('<br>'+contact);
}
if(phone!='')
{
$("#consigneeresponse").append('<br>'+phone);
}
if(mobile!='')
{
$("#consigneeresponse").append('<br>'+mobile);
}
if(email!='')
{
$("#consigneeresponse").append('<br>'+email);
}
if(gstno!='')
{
$("#consigneeresponse").append('<br>GST No: '+gstno);
}
if(gsttype!='')
{
$("#consigneeresponse").append('<br>'+gsttype);
}
if(statecode!='')
{
$("#consigneeresponse").append('<br>'+statecode);
}
if($("#stockitem").val()!='')
{
<?php
foreach($in as $inn) 
{
?>	
stockitemchange(<?=$inn?>);
<?php
}
?>
}
}
$("#modalresponse").css("display", "block");
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>
<script>
function updateauto()
{
$( "#chmaincategory" ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
});
$( "#chsubcategory" ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
});
$( "#chconsigneename" ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( "#chdepartment" ).autocomplete({
source: 'consigneesearch.php?type=department',
});
$( "#bymaincategory" ).autocomplete({
source: 'consigneesearch.php?type=maincategory',
});
$( "#bysubcategory" ).autocomplete({
source: 'consigneesearch.php?type=subcategory',
});
$( "#byconsigneename" ).autocomplete({
source: 'consigneesearch.php?type=consigneename',
});
$( "#bydepartment" ).autocomplete({
source: 'consigneesearch.php?type=department',
});
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
function pricemarkchange()
{
var stockitems=document.getElementsByName("stockitem[]");
for(var i=1;i<=stockitems.length;i++)
{
stockitemchange(i);
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
var bystatecode=document.getElementById("bystatecode");
var companystatecode='<?=$_SESSION['companystatecode']?>';
<?php
foreach($in as $inn) 
{
?>
$("#totalamountresponse<?=$inn?>").empty();
<?php
}
?>
if(consigneename.value=='')
{
alert("Please Select the Consignee");
consigneename.focus();
$('#consigneename').select2('open');
}
else if(bystatecode.value=='')
{
alert("Buyer State Code Missing, Kindly Update");
$('#buyermodal').modal('show');
}
else if(stockitem.value=='')
{
alert("Please Select the Product");
stockitem.focus();
}
else
{
if((qty.value!='')&&(rate.value!=''))
{
var productamt=parseFloat(qty.value)*parseFloat(rate.value);
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
if(bystatecode.value==companystatecode)
{
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
else
{
cgstper.value='';
sgstper.value='';
igstper.value=gstp.toFixed(2);
gsta=((parseFloat(gstper.value)*parseFloat((productamt-discountamt)))/100);
cgstamount.value='';
sgstamount.value='';
gstamount.value=gsta.toFixed(2);
igstamount.value=gsta.toFixed(2);
$("#gstresponse"+id).html('IGST('+gstp+'%): '+gsta.toFixed(2));
}	
}
totalamount.value=((productamt-discountamt)+gsta).toFixed(2);
}
else
{
$("#productamount"+id).val('');
}
}
productnet();
serialnumbers(id);
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
	var totalitems=document.getElementById("totalitems");
	var totalqty=document.getElementById("totalqty");
	var subtotalamount=document.getElementById("subtotalamount");
	var totalgstamount=document.getElementById("totalgstamount");
	var netamount=document.getElementById("netamount");
	var shippingamount=document.getElementById("shippingamount");
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
	totalitems.value=toti.toFixed(2);
	totalqty.value=totq.toFixed(2);
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
		ship=parseFloat(shippingamount.value);
	}
	grandtotal.value=(neta+ship).toFixed(2);
	//productrate();
}
</script>
<script>
function gn()
{
<?php
$i=1;
foreach($rowselect as $row) 
{
	?>
	if(document.getElementById("godownname<?=$i?>s<?=$row['godownname']?>"))
	{
	document.getElementById("godownname<?=$i?>s<?=$row['godownname']?>").checked=true;
	}
	productcalc(<?=$i?>);
	<?php
	$i++;
}
?>

}
</script>
<script>
 setTimeout(function () {
        console.log('it works' + new Date());
		$('#consigneechangemodal').modal('hide');
		productrate();
    },1000);
</script>
<script>
function serialnumbers(id)
{
	var qty=document.getElementById("qty"+id).value;
var rserialnumber=document.getElementById('serialnumber'+id).value;
var rdepartment=document.getElementById('department'+id).value; 
const rserialnumbers = rserialnumber.split(" | ");
const rdepartments = rdepartment.split(" | ");


	if(qty!="")
	{
		var nos=parseFloat(qty);
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
}

</script>
<script>
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
document.getElementById('serialnumber'+id).value=rserialnumber;
document.getElementById('department'+id).value=rdepartment; 
//for submit toggle
    $('#serialchangemodal').modal('toggle'); //or  $('#IDModal').modal('hide');
	
}
</script>
<script>
function productrate()
{
<?php
$i=1;
foreach($rowselect as $row) 
{
	if($row['qty']!='')
	{
	?>
	document.getElementById('qty<?=$i?>').value=<?=$row['qty']?>;
	<?php
	}
	if($row['rate']!='')
	{
	?>
	document.getElementById('rate<?=$i?>').value=<?=$row['rate']?>;
	<?php
	}
	if($row['discount']!='')
	{
	?>
	document.getElementById('discount<?=$i?>').value=<?=$row['discount']?>;
	<?php
	}
	if($row['totalamount']!='')
	{
	?>
	document.getElementById('totalamount<?=$i?>').value=<?=$row['totalamount']?>;
	<?php
	}
	?>
	<?php
	$i++;
}
?>
}
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>