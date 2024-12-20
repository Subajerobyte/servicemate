<?php 
include('lcheck.php'); 
include('push.php'); 
if(isset($_POST['submit']))
{
	$createdon=date('Y-m-d H:i:s');
	$createdby=$email;
$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['maincategory']);
$subcategoryvalue=mysqli_real_escape_string($connection, $_POST['subcategory']);
$consigneenamevalue=mysqli_real_escape_string($connection, $_POST['consigneename']);
$departmentvalue=mysqli_real_escape_string($connection, $_POST['department']);
$address1value=mysqli_real_escape_string($connection, $_POST['address1']);
$address2value=mysqli_real_escape_string($connection, $_POST['address2']);
$areavalue=mysqli_real_escape_string($connection, $_POST['area']);
$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
$pincodevalue=mysqli_real_escape_string($connection, $_POST['pincode']);
$contactvalue=mysqli_real_escape_string($connection, $_POST['contact']);
$phonevalue=mysqli_real_escape_string($connection, $_POST['phone']);
$mobilevalue=mysqli_real_escape_string($connection, $_POST['mobile']);
$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
$encstatus=0;
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
{
$encstatus=1;
$address1value=jbsencrypt($_SESSION['encpass'], $address1value);
$phonevalue=jbsencrypt($_SESSION['encpass'], $phonevalue);
$mobilevalue=jbsencrypt($_SESSION['encpass'], $mobilevalue);
$emailvalue=jbsencrypt($_SESSION['encpass'], $emailvalue);
}
}


if(($maincategoryvalue!="")||($subcategoryvalue!="")||($consigneenamevalue!="")||($departmentvalue!=""))
{
$sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountcon == 0)
{
 $sqlup = "INSERT INTO jrcconsignee( encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email) VALUES ( '$encstatus', '$maincategoryvalue', '$subcategoryvalue', '$consigneenamevalue', '$departmentvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue')";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
else
{
$consigneeid=$id=mysqli_insert_id($connection);
$sqlup1 = "update jrcxl set consigneeid='{$id}' WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$queryup1 = mysqli_query($connection, $sqlup1);
if(!$queryup1){
die("SQL query failed: " . mysqli_error($connection));
}
}
}
else
{
$rowselect = mysqli_fetch_array($querycon);
$consigneeid=$id=$rowselect['id'];
$sqlup = "update jrcxl set consigneeid='{$id}' WHERE maincategory = '{$maincategoryvalue}' and subcategory = '{$subcategoryvalue}' and consigneename = '{$consigneenamevalue}' and department = '{$departmentvalue}' ";
$queryup = mysqli_query($connection, $sqlup);
if(!$queryup){
die("SQL query failed: " . mysqli_error($connection));
}
}
}


	$noofproduts=mysqli_real_escape_string($connection, $_POST['noofproducts']);
	$noofscraps=mysqli_real_escape_string($connection, $_POST['noofscraps']);
	
	$prototal=(float)mysqli_real_escape_string($connection, $_POST['prototal']);
	$scrtotal=(float)mysqli_real_escape_string($connection, $_POST['scrtotal']);
	$gratotal=(float)mysqli_real_escape_string($connection, $_POST['gratotal']);

	$exists=0;
	$sexists=0;
	//correct  
	
	
	
	
	
	
	
	
	
	for($i=1;$i<=$noofproduts;$i++)
	{
		if((isset($_POST['quotationtype'.$i]))&&(isset($_POST['conproductid'.$i])))
		{
			$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype'.$i]);
			$productname=mysqli_real_escape_string($connection, $_POST['conproductid'.$i]);
			$salestotal=mysqli_real_escape_string($connection, $_POST['contotal'.$i]);
			
			$sqlcon = "SELECT id From jrcquotation WHERE consigneeid = '{$consigneeid}' and quotationtype = '{$quotationtype}' and productname = '{$productname}' and salestotal='{$salestotal}' and qtype='PRODUCT'";
			$querycon = mysqli_query($connection, $sqlcon);
			$rowCountcon = mysqli_num_rows($querycon);
			 
			if(!$querycon)
			{
			   die("SQL query failed: " . mysqli_error($connection));
			}
			if($rowCountcon>0)
			{
				$exists++;
			}
		}
	}
	for($i=1;$i<=$noofscraps;$i++)
	{
		if((isset($_POST['squotationtype'.$i]))&&(isset($_POST['sconproductid'.$i])))
		{
			$quotationtype=mysqli_real_escape_string($connection, $_POST['squotationtype'.$i]);
			$productname=mysqli_real_escape_string($connection, $_POST['sconproductid'.$i]);
			$salescrapvalue=mysqli_real_escape_string($connection, $_POST['scontotal'.$i]);
			
		$sqlcon = "SELECT id From jrcquotation WHERE consigneeid = '{$consigneeid}' and quotationtype = '{$quotationtype}' and productname = '{$productname}' and salescrapvalue='{$salescrapvalue}' and qtype='SCRAP'";
			$querycon = mysqli_query($connection, $sqlcon);
			$rowCountcon = mysqli_num_rows($querycon);
			 
			if(!$querycon)
			{
			   die("SQL query failed: " . mysqli_error($connection));
			}
			if($rowCountcon>0)
			{
				$sexists++;
			}
		}
	}
	if(($exists==$noofproduts)&&($sexists==$noofscraps))
	{
		header("location: quotations.php?error=This Quotation is Already Generated");
	}
	else
	{
		//echo "hello";
		$querysr = mysqli_query($connection, "SELECT qno From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		$qno=$_SESSION['companyshortname'].' / QN / '.date('m').date('y').' /'.(str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
		$qdate=date('Y-m-d');
		mysqli_query($connection, "update jrcsrno set qno=qno+1");
		$succe=0;
		for($i=1;$i<=$noofproduts;$i++)
		{
				//echo "hello2";
				$quotationtype=mysqli_real_escape_string($connection, $_POST['quotationtype'.$i]);
				$productname=mysqli_real_escape_string($connection, $_POST['conproductid'.$i]);
				$price=(float)mysqli_real_escape_string($connection, $_POST['conunit'.$i]);
				$minprice=(float)mysqli_real_escape_string($connection, $_POST['conunit'.$i]);
				$gst=(float)mysqli_real_escape_string($connection, $_POST['congst'.$i]);
				$scrapvalue=(float)mysqli_real_escape_string($connection, $_POST['scrapvalue'.$i]);
				$installcost=(float)mysqli_real_escape_string($connection, $_POST['addamount'.$i]);
				$saleprice=(float)mysqli_real_escape_string($connection, $_POST['conunit'.$i]);
				$salequantity=(float)mysqli_real_escape_string($connection, $_POST['conqty'.$i]);
				$salesinstallcost=(float)mysqli_real_escape_string($connection, $_POST['addamount'.$i]);
				if($salesinstallcost!='')
					{
				$salesinstallation=(float)mysqli_real_escape_string($connection, $_POST['addamount'.$i]);
					}
					else
					{
						$salesinstallation=0;
					}
				$salestotal=(float)mysqli_real_escape_string($connection, $_POST['subtotalamount'.$i]);
				$salesgst=(float)mysqli_real_escape_string($connection, $_POST['totalgstamount'.$i]);
				$salesnettotal=(float)mysqli_real_escape_string($connection, $_POST['netamount[]'.$i]);
				$salescrap=(float)mysqli_real_escape_string($connection, $_POST['ssubtotalamount1'.$i]);
				$salescrapvalue=(float)mysqli_real_escape_string($connection, $_POST['sgrandtotal'.$i]);
				$salesgrandtotal=(float)mysqli_real_escape_string($connection, $_POST['grandtotal'.$i]);
				
				$sqlup = "INSERT INTO jrcquotation set createdon='$createdon', createdby='$createdby', consigneeid='$consigneeid',   quotationtype='$quotationtype', productname='$productname', qno='$qno', qdate='$qdate', qtype='PRODUCT', prototal='$prototal', scrtotal='$scrtotal', gratotal='$gratotal',  price='$price', minprice='$minprice', gst='$gst', scrapvalue='$scrapvalue', installcost='$installcost', saleprice='$saleprice', salequantity='$salequantity', salesinstallation='$salesinstallation', salesinstallcost='$salesinstallcost', salestotal='$salestotal', salesgst='$salesgst', salesnettotal='$salesnettotal', salescrap='$salescrap', salescrapvalue='$salescrapvalue', salesgrandtotal='$salesgrandtotal'";
				$queryup = mysqli_query($connection, $sqlup);
			 
				if(!$queryup){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					$succe++;
				} 
				
			
		}
		for($i=1;$i<=$noofscraps;$i++)
		{
			
				$quotationtype=mysqli_real_escape_string($connection, $_POST['squotationtype'.$i]);
				$productname=mysqli_real_escape_string($connection, $_POST['sconproductid'.$i]);
				$price=(float)mysqli_real_escape_string($connection, $_POST['sconunit'.$i]);
				$minprice=(float)mysqli_real_escape_string($connection, $_POST['sconunit'.$i]);
				$gst=(float)mysqli_real_escape_string($connection, $_POST['scongst'.$i]);
				$scrapvalue=(float)mysqli_real_escape_string($connection, $_POST['scrapvalue'.$i]);
				$installcost=0;
				$saleprice=(float)mysqli_real_escape_string($connection, $_POST['sconunit'.$i]);
				$salequantity=(float)mysqli_real_escape_string($connection, $_POST['sconqty'.$i]);
				$salesinstallcost=(float)mysqli_real_escape_string($connection, $_POST['addamount'.$i]);
				$salesinstallation=0;
				$salestotal=0;
				$salesgst=0;
				$salesnettotal=0;
				$salescrap=(float)mysqli_real_escape_string($connection, $_POST['sconqty'.$i]);
				$salescrapvalue=(float)mysqli_real_escape_string($connection, $_POST['sgrandtotal'.$i]);
				$salesgrandtotal=(float)mysqli_real_escape_string($connection, $_POST['sgrandtotal'.$i]);
				
	echo	 $sqlup = "INSERT INTO jrcquotation set createdon='$createdon', createdby='$createdby', consigneeid='$consigneeid',   quotationtype='$quotationtype', productname='$productname', qno='$qno', qdate='$qdate', qtype='SCRAP', prototal='$prototal', scrtotal='$scrtotal', gratotal='$gratotal',  price='$price', minprice='$minprice', gst='$gst', scrapvalue='$scrapvalue', installcost='$installcost', saleprice='$saleprice', salequantity='$salequantity', salesinstallation='$salesinstallation', salesinstallcost='$salesinstallcost', salestotal='$salestotal', salesgst='$salesgst', salesnettotal='$salesnettotal', salescrap='$salescrap', salescrapvalue='$salescrapvalue', salesgrandtotal='$salesgrandtotal'";
				$queryup = mysqli_query($connection, $sqlup);
			 
				if(!$queryup){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					$succe++;
				} 
				
			
		}
		if($succe!=0)
		{
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Quotation', '{$qno}', 'jrcquotation')");				
			header("Location: quotations.php?id={$consigneeid}&remarks=Quotation Added Successfully");
		}
		else
		{
			//header("Location: quotations.php?id={$consigneeid}&error=Error");
		}
		
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
<title><?=$_SESSION['companyname']?> - Jerobyte - Add New Quotation</title>
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
<body id="page-top">
<div id="wrapper">
<?php include('sidebar.php');?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include('navbar.php');?>
<?php /* include('salesnavbar.php'); */?>
<div class="container-fluid">
<!-- Page Heading -->


<div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Add New Quotation</b></h6>
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
<form action="" id="myForm" method="get" enctype="multipart/form-data">
<div class="col-lg-4">
<div class="cardbox2">
  <div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Quotation</b></h6>
    </div>
	
    <div class="card-body2" id="customerBody" style="height:110px;">
  <div class="form-group">
    <div class="input-container">
<label for="noofproducts">Enter No of Products:</label>
<input type="text" class="form-control" id="noofproducts" name="noofproducts" placeholder="Enter No of Products" value="<?=(isset($_GET['noofproducts']))?$_GET['noofproducts']:''?>">
  </div>
  </div>
  <div class="form-group">
    <div class="input-container">
<label for="noofscraps">Enter No of Scraps:</label>
<input type="text" class="form-control" id="noofscraps" name="noofscraps" placeholder="Enter No of Scraps" value="<?=(isset($_GET['noofscraps']))?$_GET['noofscraps']:''?>">
  </div>
  </div>
  </div>
  </div>
  </div>
  <br>
  <div class="col-lg-4">
<div class="cardbox2">
  <input class="btn btn-primary" type="submit" name="getsubmit" value="Submit">
  </div>
</div>

</form>
</div>
</div>
<?php
if(isset($_GET['getsubmit']))
{
$noofproducts=mysqli_real_escape_string($connection,$_GET['noofproducts']);
$noofproducts1=mysqli_real_escape_string($connection,$_GET['noofproducts']);
$noofscraps=mysqli_real_escape_string($connection,$_GET['noofscraps']);
$noofscraps1=mysqli_real_escape_string($connection,$_GET['noofscraps']);

$sqls=mysqli_query($connection,"select qno from jrcquotation");
$infos=mysqli_fetch_array($sqls);
$qno=(float)$infos['qno']+1;
?>
<div class="card shadow mb-4">

<div class="card-body">
<form action="" id="myForm1" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
<input type="hidden" name="noofproducts" id="noofproducts" value="<?=$noofproducts?>">
<input type="hidden" name="noofproducts1" id="noofproducts1" value="<?=$noofproducts?>">
<input type="hidden" name="noofscraps" id="noofscraps" value="<?=$noofscraps?>">
<input type="hidden" name="noofscraps1"  id="noofscraps1" value="<?=$noofscraps?>">

<div class="row">
<div class="col-lg-4" >

<div class="cardbox2">
  <div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Consignee Information</b></h6>
    </div>
	
    <div class="card-body2" id="customerBody" style="height:250px;">
<?php

 
	 $querysr = mysqli_query($connection, "SELECT qno From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		 $qno=$_SESSION['companyshortname'].' / QN / '.date('m').date('y').' / '. (str_pad(((float)$infosr['qno']+1),5,"0",STR_PAD_LEFT));
		$qdate=date('Y-m-d');
	
	?>	
	<div class="form-group">
    <div class="input-container"> 
        <label for="qno">Quotation No :</label>
        <input type="text" name="qno" id="qno" class="form-control" value="<?php echo (isset($qno))?$qno:'';?>"  >
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
<input type="hidden" class="form-control" id="maincategory" name="maincategory" <?=($infolayoutcustomers['maincategoryreq']=='1')?'required':''?>>
	<input type="hidden" class="form-control" id="subcategory" name="subcategory" <?=($infolayoutcustomers['subcategoryreq']=='1')?'required':''?>>
	<input type="hidden" class="form-control" id="department" name="department" <?=($infolayoutcustomers['departmentreq']=='1')?'required':''?>>
	<input type="hidden" class="form-control" id="address2" name="address2" <?=($infolayoutcustomers['address2req']=='1')?'required':''?>>
	<input type="hidden" class="form-control" id="area" name="area" <?=($infolayoutcustomers['areareq']=='1')?'required':''?>>
	<input type="hidden" class="form-control" id="pincode" name="pincode" <?=($infolayoutcustomers['pincodereq']=='1')?'required':''?>>
	<input type="hidden" class="form-control" id="contact" name="contact" <?=($infolayoutcustomers['contactreq']=='1')?'required':''?>>
	<input type="hidden" class="form-control" id="phone" name="phone" <?=($infolayoutcustomers['phonereq']=='1')?'required':''?>>
  </div>
  </div>
  
</div>


<br>
<div class="col-lg-8">
<?php
if((isset($noofproducts)) && ($noofproducts!=""))
{
	?>
<div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Product Information</b></h6>
    </div>
<br>
<div class="table-responsive">
<table class="table table-fixed" id="table-data">
<thead>
<th style="width: 20px;">No.</th>
<!--th>MULTIPLE GODOWN</th--><th style="width: 20px;">Quotation Type</th><th style="width: 20px;">Product Code</th><th style="width: 20px;">Product <span class="text-danger">*</span></th><!--th>HSN/SAC <span class="text-danger">*</span></th--><th style="width: 50px;">QTY <span class="text-danger">*</span></th>
<th style="width: 20px;">Unit Price <span class="text-danger">*</span></th><!--th>IGST <label><input type="checkbox" id="igstcheck"> Same for All</label> </th><th>SGST <label><input type="checkbox" id="sgstcheck"> Same for All</label> </th><th>CGST <label><input type="checkbox" id="cgstcheck"> Same for All</label> </th><th>IGST AMOUNT</th><th>SGST AMOUNT</th><th>CGST AMOUNT</th--><th style="width: 20px;">Total Amount <span class="text-danger">*</span></th><!--th>warranty months <label><input type="checkbox" id="warrantycheck"> Same for All</label></th-->
</thead>
<tbody id="tabletobdy">
<?php
for($i=1;$i<=$noofproducts;$i++)
{
for($j=1;$j<=$noofproducts1;$j++)
{
?>


<tr id="consignment_<?php echo $i; ?>_product_<?php echo $j; ?>" style="display:<?php echo ($i == 1 && $j <= $noofproducts1) ? 'table-row' : 'none'; ?>">
<td><input type="hidden" class="consigneeno" id="consigneeno<?=$i?>" name="consigneeno[]" value="<?=$i?>"><span id="serial<?=$i?>"><?=$j?></span></td>
<input type="hidden"  class="conprogroup" name="conprogroup[]" id="conprogroup<?=$i?><?=$j?>" placeholder="PRODUCT GROUP (<?=$i?>)">
<input type="hidden"  class="conmultiple" name="conmultiple[]" id="conmultiple<?=$i?><?=$j?>" placeholder="MULTIPLE GODOWN (<?=$i?>)" value="MAIN GODOWN">
<td> <select class="form-control" name="quotationtype<?=$i?>" id="quotationtype<?=$i?><?=$j?>" required>
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
	</select></td>
<td><input type="text"   class="conproductcode" name="conproductcode[]" id="conproductcode<?=$i?><?=$j?>" placeholder="PRODUCT CODE (<?=$i?>)" ></td>

<input type="hidden" class="promaincategory" name="promaincategory[]" id="promaincategory<?=$i?><?=$j?>" placeholder="MAIN CATEGORY(<?=$i?>)">
<input type="hidden" class="prosubcategory" name="prosubcategory[]" id="prosubcategory<?=$i?><?=$j?>" placeholder="SUB CATEGORY(<?=$i?>)">

<td><input type="hidden" class="conproductid" id="conproductid<?=$i?><?=$j?>" name="conproductid[]"><input type="text" class="conproduct" name="conproduct[]" id="conproduct<?=$i?><?=$j?>" placeholder="PRODUCT (<?=$i?>)" required>

<input type="hidden"   name="congstvalue[]" id="congstvalue<?=$i?><?=$j?>" >
</td>

<input type="hidden" class="componenttype" name="componenttype[]" id="componenttype<?=$i?><?=$j?>" placeholder="COMPONENT TYPE (<?=$i?>)">
<input type="hidden" class="componentname" name="componentname[]" id="componentname<?=$i?><?=$j?>" placeholder="COMPONENT NAME (<?=$i?>)">


<input type="hidden" class="conmarketname" name="conmarketname[]" id="conmarketname<?=$i?><?=$j?>" placeholder="MARKET NAME (<?=$i?>)">
<input type="hidden" class="conmake" name="conmake[]" id="conmake<?=$i?><?=$j?>" placeholder="MAKE (<?=$i?>)">
<input type="hidden" class="concapacity" name="concapacity[]" id="concapacity<?=$i?><?=$j?>" placeholder="CAPACITY (<?=$i?>)">
<input type="hidden" class="conpromodel" name="conpromodel[]" id="conpromodel<?=$i?><?=$j?>" placeholder="MODEL (<?=$i?>)">
<input type="hidden" class="conhsncode" name="conhsncode[]" id="conhsncode<?=$i?><?=$j?>" placeholder="HSN/SAC (<?=$i?>)" maxlength="8" required>
<input type="hidden" class="conper" name="conper[]" id="conper<?=$i?><?=$j?>" placeholder="PER (<?=$i?>)">

<td style="width:20px;"><input type="number" class="conqty" name="conqty[]" id="conqty<?=$i?><?=$j?>" placeholder="QTY (<?=$i?>)" onchange="procalc<?=$i?>(<?=$i?>)" required></td>
<td><input type="number" step="0.01" min="0" class="conunit" name="conunit[]" id="conunit<?=$i?><?=$j?>" placeholder="UNIT PRICE  (<?=$i?>)" onchange="procalc<?=$i?>(<?=$i?>)" required></td>
<input type="hidden" step="0.01" min="0" class="conigst" name="conigst[]" id="conigst<?=$i?><?=$j?>" placeholder="IGST (<?=$i?>)" onchange="igstcheckf(this.value); procalc<?=$i?>(<?=$i?>);">
<input type="hidden" step="0.01" min="0" class="consgst" name="consgst[]" id="consgst<?=$i?><?=$j?>" placeholder="SGST (<?=$i?>)" onchange="sgstcheckf(this.value); procalc<?=$i?>(<?=$i?>);">
<input type="hidden" step="0.01" min="0" class="concgst" name="concgst[]" id="concgst<?=$i?><?=$j?>" placeholder="CGST (<?=$i?>)" onchange="procalc<?=$i?>(<?=$i?>);" readonly>
<input type="hidden" step="0.01" min="0" class="conigstamount" name="conigstamount[]" id="conigstamount<?=$i?><?=$j?>" placeholder="IGST AMOUNT (<?=$i?>)" readonly>
<input type="hidden" step="0.01" min="0" class="consgstamount" name="consgstamount[]" id="consgstamount<?=$i?><?=$j?>" placeholder="SGST AMOUNT (<?=$i?>)" readonly>
<input type="hidden" step="0.01" min="0" class="concgstamount" name="concgstamount[]" id="concgstamount<?=$i?><?=$j?>" placeholder="CGST AMOUNT (<?=$i?>)" readonly>
<td><input type="number" step="0.01" min="0" class="contotal" name="contotal[]" id="contotal<?=$i?><?=$j?>" placeholder="TOTAL AMOUNT (<?=$i?>)" readonly required></td>
<input type="hidden" step="0.01" min="0" class="conwarranty" name="conwarranty[]" id="conwarranty<?=$i?><?=$j?>" onchange="warrantycheckf(this.value);" placeholder="WARRANTY MONTHS (<?=$i?>)">
</tr>

<?php
}
}
?>
</tbody>
</table>
</div>

<?php
for($i=1;$i<=$noofproducts;$i++)
{
for($j=1;$j<=$noofproducts1;$j++)
{ 
?>
<div id="additional_rows_<?=$i?>_<?=$j?>" style="display:<?php echo ($i == 1 && $j == 1) ? 'block' : 'none'; ?>">
<div class="form-group row">
 
    <label for="subtotalamount" class="col-sm-6 col-form-label text-right">Sub Total Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="subtotalamount<?=$i?>" name="subtotalamount[]" style="text-align:right" >
    </div>
  </div>

 <div class="row">
  <label for="subtotalamount" class="col-sm-3 col-form-label text-right" id="discounts<?=$i?>">Discount</label>
<div class="form-group col-sm-3">
<div class="input-group">
<input type="number" name="discount[]" id="discount<?=$i?><?=$j?>" class="form-control discount-input" onchange="procalc<?=$i?>(<?=$i?>)" style="text-align:right" min="0" step="0.01">
<div class="input-group-append">
<select id="discountmode<?=$i?><?=$j?>" name="discountmode[]" class="form-control" data-live-search="true" onchange="procalc<?=$i?>(<?=$i?>)">
<option value="percentage">%</option>
<option value="rupee">₹</option>
</select>
</div>
</div>
</div>
<div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="discountamount<?=$i?><?=$j?>" name="discountamount[]" style="text-align:right" >
    </div>
</div>
  <div class="form-group row">
    <label for="addamount" class="col-sm-6 col-form-label text-right" id="addamounts<?=$i?>" >Installation Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control addamount-input" id="addamount<?=$i?><?=$j?>" name="addamount[]" onChange="procalc<?=$i?>(<?=$i?>)" style="text-align:right" >
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
<?php
}
if((isset($noofscraps)) && ($noofscraps!=""))
{
	?>

<!--Scrap Products-->
<div class="card-header"   style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2"><b>Scrap Information</b></h6>
    </div>
<br>
<div class="table-responsive">
<table class="table table-fixed" id="table-data">
<thead>
<th style="width: 20px;">No.</th>
<!--th>MULTIPLE GODOWN</th--><th style="width: 20px;">Quotation Type</th><th style="width: 20px;">Product Code</th><th style="width: 20px;">Product <span class="text-danger">*</span></th><!--th>HSN/SAC <span class="text-danger">*</span></th--><th style="width: 50px;">QTY <span class="text-danger">*</span></th>
<th style="width: 20px;">Unit Price <span class="text-danger">*</span></th><!--th>IGST <label><input type="checkbox" id="igstcheck"> Same for All</label> </th><th>SGST <label><input type="checkbox" id="sgstcheck"> Same for All</label> </th><th>CGST <label><input type="checkbox" id="cgstcheck"> Same for All</label> </th><th>IGST AMOUNT</th><th>SGST AMOUNT</th><th>CGST AMOUNT</th--><th style="width: 20px;">Total Amount <span class="text-danger">*</span></th><!--th>warranty months <label><input type="checkbox" id="warrantycheck"> Same for All</label></th-->
</thead>
<tbody id="tabletobdy">
<?php
for($k=1;$k<=$noofscraps;$k++)
{
for($l=1;$l<=$noofscraps1;$l++)
{
?>


<tr id="sconsignment_<?php echo $k; ?>_product_<?php echo $l; ?>" style="display:<?php echo ($k == 1 && $l <= $noofscraps1) ? 'table-row' : 'none'; ?>">
<td><input type="hidden" class="sconsigneeno" id="sconsigneeno<?=$k?>" name="sconsigneeno[]" value="<?=$k?>"><span id="serial<?=$k?>"><?=$l?></span></td>
<input type="hidden"  class="sconprogroup" name="sconprogroup[]" id="sconprogroup<?=$k?><?=$l?>" placeholder="PRODUCT GROUP (<?=$k?>)">
<input type="hidden"  class="sconmultiple" name="sconmultiple[]" id="sconmultiple<?=$k?><?=$l?>" placeholder="MULTIPLE GODOWN (<?=$k?>)" value="MAIN GODOWN">
<td><select class="form-control" name="squotationtype<?=$i?>" id="squotationtype<?=$i?>" required>
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
	</select></td>
<td><input type="text"   class="sconproductcode" name="sconproductcode[]" id="sconproductcode<?=$k?><?=$l?>" placeholder="PRODUCT CODE (<?=$k?>)" ></td>

<input type="hidden" class="spromaincategory" name="spromaincategory[]" id="spromaincategory<?=$k?><?=$l?>" placeholder="MAIN CATEGORY(<?=$k?>)">
<input type="hidden" class="sprosubcategory" name="sprosubcategory[]" id="sprosubcategory<?=$k?><?=$l?>" placeholder="SUB CATEGORY(<?=$k?>)">

<td><input type="hidden" class="sconproductid" id="sconproductid<?=$k?><?=$l?>" name="sconproductid[]"><input type="text" class="sconproduct" name="sconproduct[]" id="sconproduct<?=$k?><?=$l?>" placeholder="PRODUCT (<?=$k?>)" required>

<input type="hidden"   name="scongstvalue[]" id="scongstvalue<?=$k?><?=$l?>" >
</td>

<input type="hidden" class="scomponenttype" name="scomponenttype[]" id="scomponenttype<?=$k?><?=$l?>" placeholder="COMPONENT TYPE (<?=$k?>)">
<input type="hidden" class="scomponentname" name="scomponentname[]" id="scomponentname<?=$k?><?=$l?>" placeholder="COMPONENT NAME (<?=$k?>)">


<input type="hidden" class="sconmarketname" name="sconmarketname[]" id="sconmarketname<?=$k?><?=$l?>" placeholder="MARKET NAME (<?=$k?>)">
<input type="hidden" class="sconmake" name="sconmake[]" id="sconmake<?=$k?><?=$l?>" placeholder="MAKE (<?=$k?>)">
<input type="hidden" class="sconcapacity" name="sconcapacity[]" id="sconcapacity<?=$k?><?=$l?>" placeholder="CAPACITY (<?=$k?>)">
<input type="hidden" class="sconpromodel" name="sconpromodel[]" id="sconpromodel<?=$k?><?=$l?>" placeholder="MODEL (<?=$k?>)">
<input type="hidden" class="sconhsncode" name="sconhsncode[]" id="sconhsncode<?=$k?><?=$l?>" placeholder="HSN/SAC (<?=$k?>)" maxlength="8" required>
<input type="hidden" class="sconper" name="sconper[]" id="sconper<?=$k?><?=$l?>" placeholder="PER (<?=$k?>)">

<td style="width:20px;"><input type="number" class="sconqty" name="sconqty[]" id="sconqty<?=$k?><?=$l?>" placeholder="QTY (<?=$k?>)" onchange="sprocalc<?=$k?>(<?=$k?>)" required></td>
<td><input type="number" step="0.01" min="0" class="sconunit" name="sconunit[]" id="sconunit<?=$k?><?=$l?>" placeholder="UNIT PRICE  (<?=$k?>)" onchange="sprocalc<?=$k?>(<?=$k?>)" required></td>
<input type="hidden" step="0.01" min="0" class="sconigst" name="sconigst[]" id="sconigst<?=$k?><?=$l?>" placeholder="IGST (<?=$k?>)" onchange="igstcheckf(this.value); sprocalc<?=$k?>(<?=$k?>);">
<input type="hidden" step="0.01" min="0" class="sconsgst" name="sconsgst[]" id="sconsgst<?=$k?><?=$l?>" placeholder="SGST (<?=$k?>)" onchange="sgstcheckf(this.value); sprocalc<?=$k?>(<?=$k?>);">
<input type="hidden" step="0.01" min="0" class="sconcgst" name="sconcgst[]" id="sconcgst<?=$k?><?=$l?>" placeholder="CGST (<?=$k?>)" onchange="sprocalc<?=$k?>(<?=$k?>);" readonly>
<input type="hidden" step="0.01" min="0" class="sconigstamount" name="sconigstamount[]" id="sconigstamount<?=$k?><?=$l?>" placeholder="IGST AMOUNT (<?=$k?>)" readonly>
<input type="hidden" step="0.01" min="0" class="sconsgstamount" name="sconsgstamount[]" id="sconsgstamount<?=$k?><?=$l?>" placeholder="SGST AMOUNT (<?=$k?>)" readonly>
<input type="hidden" step="0.01" min="0" class="sconcgstamount" name="sconcgstamount[]" id="sconcgstamount<?=$k?><?=$l?>" placeholder="CGST AMOUNT (<?=$k?>)" readonly>
<td><input type="number" step="0.01" min="0" class="scontotal" name="scontotal[]" id="scontotal<?=$k?><?=$l?>" placeholder="TOTAL AMOUNT (<?=$k?>)" readonly required></td>
<input type="hidden" step="0.01" min="0" class="sconwarranty" name="sconwarranty[]" id="sconwarranty<?=$k?><?=$l?>" onchange="warrantycheckf(this.value);" placeholder="WARRANTY MONTHS (<?=$k?>)">
</tr>

<?php
}
}
?>
</tbody>
</table>
</div>

<?php
for($k=1;$k<=$noofscraps;$k++)
{
for($l=1;$l<=$noofscraps1;$l++)
{ 
?>
<div id="additional_rows_<?=$k?>_<?=$l?>" style="display:<?php echo ($k == 1 && $l == 1) ? 'block' : 'none'; ?>">
<div class="form-group row">
 
    <label for="ssubtotalamount" class="col-sm-6 col-form-label text-right">Sub Total Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="ssubtotalamount<?=$k?>" name="ssubtotalamount[]" style="text-align:right" onchange="grandtotal1()">
    </div>
  </div>




<div class="form-group row">
    <label for="snetamount" class="col-sm-6 col-form-label text-right">Net Amount</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="snetamount<?=$k?>" name="snetamount[]" style="text-align:right" onchange="grandtotal1()">
    </div>
  </div>

  <div class="form-group row">
    <label for="sgrandtotal" class="col-sm-6 col-form-label text-right font-weight-bold">Grand Total (₹)</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="sgrandtotal<?=$k?>" name="sgrandtotal[]" style="text-align:right"  >
    </div>
  </div>
  </div>
<?php
} 
}

}
?>
<!--Scrap Products-->
<hr>
<div class="form-group row">
    <label for="prototal" class="col-sm-6 col-form-label text-right font-weight-bold">Product Grand Total (₹)</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="prototal" name="prototal" style="text-align:right"  value="0">
    </div>
  </div>
  <div class="form-group row">
    <label for="scrtotal" class="col-sm-6 col-form-label text-right font-weight-bold">Scraps Grand Total (₹)</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="scrtotal" name="scrtotal" style="text-align:right" value="0">
    </div>
  </div> 
  <div class="form-group row">
    <label for="gratotal" class="col-sm-6 col-form-label text-right font-weight-bold">Grand Total (₹)</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" readonly class="form-control" id="gratotal" name="gratotal" style="text-align:right" value="0">
    </div>
  </div>
</div>
</div>



 
  <br>
<div class="row">
 <div class="col-lg-12 text-right">
<input class="btn btn-primary" type="submit" name="submit" value="Submit"><br>
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
<a class="scroll-to-top rounded" href="#sage-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#sage-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
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
//for consignee search
$( "#consigneename" ).autocomplete({
//source: 'consigneesearch.php?type=consigneename',
source: 'consearch.php', select: function (event, ui) { $("#consigneename").val(ui.item.value);$("#consigneeid").val(ui.item.id); $("#address1").val(ui.item.address1); $("#address2").val(ui.item.address2); $("#address3").val(ui.item.area);$("#district").val(ui.item.district);$("#sincode").val(ui.item.pincode);$("#mail").val(ui.item.email);$("#mobile").val(ui.item.mobile);$("#contact").val(ui.item.contact);$("#shone").val(ui.item.phone);$("#gst").val(ui.item.gstno);$("#state").val(ui.item.statecode);$("#rtype").val(ui.item.gsttype);$("#maincategory").val(ui.item.maincategory);$("#subcategory").val(ui.item.subcategory);$("#department").val(ui.item.department);}, minLength: 3
});
//for consignee search



<?php
if(isset($noofscraps) && isset($noofscraps1))
{
for($i=1;$i<=$noofscraps;$i++)
{
for($j=1;$j<=$noofscraps1;$j++)
{
?>
$( "#sconproductcode<?=$i?><?=$j?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'sproductsearch1.php?type=code', select: function (event, ui) { $("#sconproductcode<?=$i?><?=$j?>").val(ui.item.value); $("#sconproduct<?=$i?><?=$j?>").val(ui.item.stockitem);$("#sconproductid<?=$i?><?=$j?>").val(ui.item.id);$("#sconprogroup<?=$i?><?=$j?>").val(ui.item.typeofproduct); $("#sconmarketname<?=$i?><?=$j?>").val(ui.item.marketname);$("#sconmake<?=$i?><?=$j?>").val(ui.item.make);$("#sconcapacity<?=$i?><?=$j?>").val(ui.item.capacity);$("#sconpromodel<?=$i?><?=$j?>").val(ui.item.model);$("#sconper<?=$i?><?=$j?>").val(ui.item.unit);$("#sconhsncode<?=$i?><?=$j?>").val(ui.item.hsncode);$("#sconunit<?=$i?><?=$j?>").val(ui.item.price);$("#ssromaincategory<?=$i?><?=$j?>").val(ui.item.stockmaincategory);$("#ssrosubcategory<?=$i?><?=$j?>").val(ui.item.stocksubcategory);$("#scomponentname<?=$i?><?=$j?>").val(ui.item.componentname);$("#scomponenttype<?=$i?><?=$j?>").val(ui.item.componenttype);$("#sconwarranty<?=$i?><?=$j?>").val(ui.item.warranty);$("#scongstvalue<?=$i?><?=$j?>").val(ui.item.gst);

}, minLength: 2
});


$( "#sconproduct<?=$i?><?=$j?>" ).autocomplete({
//source: 'pincodesearch.php?type=pincode',
source: 'sproductsearch1.php?type=stockitem', select: function (event, ui) { $("#sconproduct<?=$i?><?=$j?>").val(ui.item.value); $("#sconproductid<?=$i?><?=$j?>").val(ui.item.id); $("#sconprogroup<?=$i?><?=$j?>").val(ui.item.typeofproduct); $("#sconproductcode<?=$i?><?=$j?>").val(ui.item.code); $("#sconmarketname<?=$i?><?=$j?>").val(ui.item.marketname);$("#sconmake<?=$i?><?=$j?>").val(ui.item.make);$("#sconcapacity<?=$i?><?=$j?>").val(ui.item.capacity);$("#sconpromodel<?=$i?><?=$j?>").val(ui.item.model);$("#sconper<?=$i?><?=$j?>").val(ui.item.unit);$("#sconhsncode<?=$i?><?=$j?>").val(ui.item.hsncode);$("#sconunit<?=$i?><?=$j?>").val(ui.item.price);$("#ssromaincategory<?=$i?><?=$j?>").val(ui.item.stockmaincategory);$("#ssrosubcategory<?=$i?><?=$j?>").val(ui.item.stocksubcategory);$("#scomponentname<?=$i?><?=$j?>").val(ui.item.componentname);$("#scomponenttype<?=$i?><?=$j?>").val(ui.item.componenttype);$("#sconwarranty<?=$i?><?=$j?>").val(ui.item.warranty);$("#scongstvalue<?=$i?><?=$j?>").val(ui.item.gst);
}, minLength: 2
});
 


<?php
}
}
}
?>





<?php
if(isset($noofproducts) && isset($noofproducts1))
{
for($i=1;$i<=$noofproducts;$i++)
{
for($j=1;$j<=$noofproducts1;$j++)
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
$( "#sromaincategory<?=$i?><?=$j?>" ).autocomplete({
source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
});
$( "#srosubcategory<?=$i?><?=$j?>" ).autocomplete({
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
source: 'productsearch1.php?type=code', select: function (event, ui) { $("#conproductcode<?=$i?><?=$j?>").val(ui.item.value); $("#conproduct<?=$i?><?=$j?>").val(ui.item.stockitem);$("#conproductid<?=$i?><?=$j?>").val(ui.item.id);$("#conprogroup<?=$i?><?=$j?>").val(ui.item.typeofproduct); $("#conmarketname<?=$i?><?=$j?>").val(ui.item.marketname);$("#conmake<?=$i?><?=$j?>").val(ui.item.make);$("#concapacity<?=$i?><?=$j?>").val(ui.item.capacity);$("#conpromodel<?=$i?><?=$j?>").val(ui.item.model);$("#conper<?=$i?><?=$j?>").val(ui.item.unit);$("#conhsncode<?=$i?><?=$j?>").val(ui.item.hsncode);$("#conunit<?=$i?><?=$j?>").val(ui.item.price);$("#sromaincategory<?=$i?><?=$j?>").val(ui.item.stockmaincategory);$("#srosubcategory<?=$i?><?=$j?>").val(ui.item.stocksubcategory);$("#componentname<?=$i?><?=$j?>").val(ui.item.componentname);$("#componenttype<?=$i?><?=$j?>").val(ui.item.componenttype);$("#conwarranty<?=$i?><?=$j?>").val(ui.item.warranty);$("#congstvalue<?=$i?><?=$j?>").val(ui.item.gst);
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
source: 'productsearch1.php?type=stockitem', select: function (event, ui) { $("#conproduct<?=$i?><?=$j?>").val(ui.item.value); $("#conproductid<?=$i?><?=$j?>").val(ui.item.id); $("#conprogroup<?=$i?><?=$j?>").val(ui.item.typeofproduct); $("#conproductcode<?=$i?><?=$j?>").val(ui.item.code); $("#conmarketname<?=$i?><?=$j?>").val(ui.item.marketname);$("#conmake<?=$i?><?=$j?>").val(ui.item.make);$("#concapacity<?=$i?><?=$j?>").val(ui.item.capacity);$("#conpromodel<?=$i?><?=$j?>").val(ui.item.model);$("#conper<?=$i?><?=$j?>").val(ui.item.unit);$("#conhsncode<?=$i?><?=$j?>").val(ui.item.hsncode);$("#conunit<?=$i?><?=$j?>").val(ui.item.price);$("#sromaincategory<?=$i?><?=$j?>").val(ui.item.stockmaincategory);$("#srosubcategory<?=$i?><?=$j?>").val(ui.item.stocksubcategory);$("#componentname<?=$i?><?=$j?>").val(ui.item.componentname);$("#componenttype<?=$i?><?=$j?>").val(ui.item.componenttype);$("#conwarranty<?=$i?><?=$j?>").val(ui.item.warranty);$("#congstvalue<?=$i?><?=$j?>").val(ui.item.gst);
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

<?php
}
}
}
?>
});




</script>


<script>



//product
<?php
for ($i = 1; $i <= $noofproducts; $i++) {
?>
function procalc<?=$i?>(id) {	

    var totalsubtotal<?=$i?> = 0;
    var totalgst<?=$i?> = 0;
    var totalnet<?=$i?> = 0;
    var totaldiscount<?=$i?> = 0;
	var totalshipamount<?=$i?> = 0;
	var discountamount; // declare discountamount outside loop
		
    <?php
    for ($j = 1; $j <= $noofproducts1; $j++) {
    ?>
    // alert(<?=$i?><?=$j?>);
    var conqty = document.getElementById("conqty<?=$i?><?=$j?>").value;
    var conunit = document.getElementById("conunit<?=$i?><?=$j?>").value;
    var conigst = document.getElementById("conigst<?=$i?><?=$j?>").value;
    var consgst = document.getElementById("consgst<?=$i?><?=$j?>").value;
    var concgst = document.getElementById("concgst<?=$i?><?=$j?>").value;
    var contotal = document.getElementById("contotal<?=$i?><?=$j?>").value;
	 var addamount = document.getElementById("addamount<?=$i?><?=$j?>").value;
    ///var discount = document.getElementById("discount<?=$i?><?=$j?>").value;
	//alert(conqty);
	//alert(discount);
	document.getElementById("discount<?=$i?><?=$j?>").value = document.getElementById("discount<?=$i?>1").value;
	var discount = document.getElementById("discount<?=$i?><?=$j?>").value;
	//alert(discount);
    var discountmode = document.getElementById("discountmode<?=$i?><?=$j?>").value;
    var discountamount = document.getElementById("discountamount<?=$i?>1");
    
    // Calculate subtotal, total GST, and net amount for each product

    var total = 0;
        
    if (conqty !== '' && conunit !== '') {
        //alert(conqty);
        //alert(conunit);
        total = parseFloat(conqty) * parseFloat(conunit);
        totalsubtotal<?=$i?> += total;
        // alert(totalsubtotal<?=$i?>);
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
			var ttax=parseFloat(stax)+parseFloat(ctax);
            totalgst<?=$i?> += ttax;
            var ttotal = parseFloat(total) + parseFloat(ttax);
            contotal<?=$i?><?=$j?>.value = ttotal.toFixed(2);
            totalnet<?=$i?> += total;
            consgstamount<?=$i?><?=$j?>.value = stax.toFixed(2);
			//alert(consgstamount<?=$i?><?=$j?>.value);
            concgstamount<?=$i?><?=$j?>.value = stax.toFixed(2);
        }
    }
	 var shipamount = 0;
    if (addamount !== '') {
        shipamount = parseFloat(addamount);
    }
    totalshipamount<?=$i?> += shipamount;
    var discountamt = 0;
	//alert(discount);
    if (discount !== '') {
        if (discountmode === 'percentage') {
			  //alert(total);
			 // alert(discount);
            discountamt = (parseFloat(discount) * parseFloat(total)) / 100;
			//alert(discountamt);
        } else {
            discountamt = parseFloat(discount);
        }
    }
    totaldiscount<?=$i?> += discountamt;
	//alert(totaldiscount<?=$i?>);
    

    <?php
    }
    ?>
   discountamount.value = totaldiscount<?=$i?>.toFixed(2);
   // alert(totalsubtotal<?=$i?>);
    
    var subtotalamount = document.getElementById("subtotalamount<?=$i?>");
    var totalgstamount = document.getElementById("totalgstamount<?=$i?>");
    var netamount = document.getElementById("netamount<?=$i?>");
    var grandtotal = document.getElementById("grandtotal<?=$i?>");
    var prototal = document.getElementById("prototal");
    subtotalamount.value = totalsubtotal<?=$i?>.toFixed(2);
    totalgstamount.value = totalgst<?=$i?>.toFixed(2);
    netamount.value = ((parseFloat(totalnet<?=$i?>) + parseFloat(totalshipamount<?=$i?>)) - (parseFloat(totaldiscount<?=$i?>) )).toFixed(2);
    grandtotal.value = ((parseFloat(totalnet<?=$i?>) + parseFloat(totalgst<?=$i?>) + parseFloat(totalshipamount<?=$i?>)) - (parseFloat(totaldiscount<?=$i?>))).toFixed(2);
    prototal.value = ((parseFloat(totalnet<?=$i?>) + parseFloat(totalgst<?=$i?>) + parseFloat(totalshipamount<?=$i?>)) - (parseFloat(totaldiscount<?=$i?>))).toFixed(2);
	grandtotal1();
}
<?php
}
?>
//product

//scrap product
<?php
for ($k = 1; $k <= $noofscraps; $k++) {
?>
function sprocalc<?=$k?>(id) {	

    var stotalsubtotal<?=$k?> = 0;
    var stotalgst<?=$k?> = 0;
    var stotalnet<?=$k?> = 0;
 
		
    <?php
    for ($l = 1; $l <= $noofscraps1; $l++) {
    ?>
    // alert(<?=$k?><?=$l?>);
    var sconqty = document.getElementById("sconqty<?=$k?><?=$l?>").value;
    var sconunit = document.getElementById("sconunit<?=$k?><?=$l?>").value;
    var scontotal = document.getElementById("scontotal<?=$k?><?=$l?>").value;
    // Calculate subtotal, total GST, and net amount for each product

    var stotal = 0;
        
    if (sconqty !== '' && sconunit !== '') {
        //alert(conqty);
        //alert(conunit);
        stotal = parseFloat(sconqty) * parseFloat(sconunit);
        stotalsubtotal<?=$k?> += stotal;
        // alert(totalsubtotal<?=$k?>);
            var sttotal = parseFloat(stotal) ;
            scontotal<?=$k?><?=$l?>.value = sttotal.toFixed(2);
            stotalnet<?=$k?> += stotal;
           
        
    }
   
    

    <?php
    }
    ?>
  
    
    var ssubtotalamount = document.getElementById("ssubtotalamount<?=$k?>");
    var snetamount = document.getElementById("snetamount<?=$k?>");
    var sgrandtotal = document.getElementById("sgrandtotal<?=$k?>");
    var scrtotal = document.getElementById("scrtotal");
    ssubtotalamount.value = stotalsubtotal<?=$k?>.toFixed(2);
    snetamount.value = ((parseFloat(stotalnet<?=$k?>))).toFixed(2);
    sgrandtotal.value = ((parseFloat(stotalnet<?=$k?>) )).toFixed(2);
    scrtotal.value = ((parseFloat(stotalnet<?=$k?>) )).toFixed(2);
	grandtotal1();
}
<?php
}
?>
//scrap  product
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




function grandtotal1()
{
	//alert("helll");
  var prototal = document.getElementById("prototal").value;	
  var scrtotal = document.getElementById("scrtotal").value;	
  var gratotal = document.getElementById("gratotal");	
  var productgtValue = parseFloat(prototal);
   var scrapgtValue = parseFloat(scrtotal);
  if(productgtValue!='' && scrapgtValue!='')
  {
	  gratotal.value=(parseFloat(productgtValue) - parseFloat(scrapgtValue)).toFixed(2);
  }
  else if(productgtValue!='')
  {
	   gratotal.value=(parseFloat(productgtValue)).toFixed(2);
  }
  else if(scrapgtValue!='')
  {
	   gratotal.value=(parseFloat(scrapgtValue)).toFixed(2);
  }
}

</script>

<script>
function validateForm() {
<?php
for ($i = 1; $i <= $noofproducts; $i++) {
    for ($j = 1; $j <= $noofproducts1; $j++) {
?>
    var hsnCode<?=$i?><?=$j?> = document.getElementById('conhsncode<?=$i?><?=$j?>').value;
    if (hsnCode<?=$i?><?=$j?>.trim() === '') {
        alert('HSN/SAC code cannot be empty!');
        return false; // Prevent form submission
    }
<?php
    }
}
for ($k = 1; $k <= $noofproducts; $k++) {
    for ($l = 1; $l <= $noofproducts1; $l++) {
?>
    var hsnCode<?=$k?><?=$l?> = document.getElementById('sconhsncode<?=$k?><?=$l?>').value;
    if (hsnCode<?=$k?><?=$l?>.trim() === '') {
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
 <!-- Auto Submit Or Draft Values-->
<?php include('additionaljs.php');   ?>
</body>
</html>