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
	$sotype=mysqli_real_escape_string($connection,$_POST['sotype']);
	$invoicetype=mysqli_real_escape_string($connection,$_POST['invoicetype']);
	$noofconsignee=mysqli_real_escape_string($connection,$_POST['noofconsignee']);
	$maxproduct=mysqli_real_escape_string($connection,$_POST['maxproduct']);
	$sqls=mysqli_query($connection,"select serviceinvoice from jrcinvoice");
	$infos=mysqli_fetch_array($sqls);
	$invoicenofrom=(float)$infos['serviceinvoice']+1;
	$invoicenoto=(float)$infos['serviceinvoice']+(float)$noofconsignee;
	$invoicedate=mysqli_real_escape_string($connection,$_POST['invoicedate']);
	$qno=mysqli_real_escape_string($connection,$_POST['qno']);
	$qdate=mysqli_real_escape_string($connection,$_POST['qdate']);
	$maincategory=mysqli_real_escape_string($connection,$_POST['maincategory']);
	$buyerid=mysqli_real_escape_string($connection,$_POST['buyerid']);
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
	$buyertaluk=mysqli_real_escape_string($connection,$_POST['buyertaluk']);
	$buyerdistrict=mysqli_real_escape_string($connection,$_POST['buyerdistrict']);
	$buyerpincode=mysqli_real_escape_string($connection,$_POST['buyerpincode']);
	$buyerstate=mysqli_real_escape_string($connection,$_POST['buyerstate']);
	$buyermobile=mysqli_real_escape_string($connection,$_POST['buyermobile']);
	$buyermail=mysqli_real_escape_string($connection,$_POST['buyermail']);
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
	$grandtotal=mysqli_real_escape_string($connection,$_POST['grandtotal']);
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
	if($reftime!='')
	{
	$sqlselect = "SELECT reftime,id From jrctallydrafts where reftime='".$reftime."'";
	$queryselect = mysqli_query($connection, $sqlselect);
	$rowCountselect = mysqli_num_rows($queryselect);
	$rowselect = mysqli_fetch_array($queryselect);
	$sqllreftime=mysqli_query($connection,"DELETE FROM jrctallydrafts WHERE reftime='".$rowselect['reftime']."'");
	}
	for($i=0;$i<count($_POST['consigneeno']);$i++)
	{
	$consigneeno=mysqli_real_escape_string($connection,$_POST['consigneeno'][$i]);
	 $sono='SO / SER / '.(date('my')).' /'.(str_pad((float)$infos['serviceinvoice']+($consigneeno), 4, '0', STR_PAD_LEFT));
   //$id=mysqli_real_escape_string($connection,$_POST['qid'][$i]);
	$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename'][$i]);
	$consigneeid=mysqli_real_escape_string($connection,$_POST['consigneeid'][$i]);
	$condepartment=mysqli_real_escape_string($connection,$_POST['condepartment'][$i]);
	$conaddress1=mysqli_real_escape_string($connection,$_POST['conaddress1'][$i]);
	$conaddress2=mysqli_real_escape_string($connection,$_POST['conaddress2'][$i]);
	$conaddress3=mysqli_real_escape_string($connection,$_POST['conaddress3'][$i]);
	$contaluk=mysqli_real_escape_string($connection,$_POST['contaluk'][$i]);
	$condistrict=mysqli_real_escape_string($connection,$_POST['condistrict'][$i]);
	$conpincode=mysqli_real_escape_string($connection,$_POST['conpincode'][$i]);
	$constatecode=mysqli_real_escape_string($connection,$_POST['constatecode'][$i]);
	$concontact=mysqli_real_escape_string($connection,$_POST['concontact'][$i]);
	$conphone=mysqli_real_escape_string($connection,$_POST['conphone'][$i]);
	$conmobile=mysqli_real_escape_string($connection,$_POST['conmobile'][$i]);
	$conemail=mysqli_real_escape_string($connection,$_POST['conemail'][$i]);
	$congstno=mysqli_real_escape_string($connection,$_POST['congstno'][$i]);
	$conprogroup=mysqli_real_escape_string($connection,$_POST['conprogroup'][$i]);
	$conmultiple=mysqli_real_escape_string($connection,$_POST['conmultiple'][$i]);
	$conproductcode=mysqli_real_escape_string($connection,$_POST['conproductcode'][$i]);
	$promaincategory=mysqli_real_escape_string($connection,$_POST['promaincategory'][$i]);
	$prosubcategory=mysqli_real_escape_string($connection,$_POST['prosubcategory'][$i]);
	$conproduct=mysqli_real_escape_string($connection,$_POST['conproduct'][$i]);
	$conhsncode=mysqli_real_escape_string($connection,$_POST['conhsncode'][$i]);
	$conper=mysqli_real_escape_string($connection,$_POST['conper'][$i]);
	$conproductid=mysqli_real_escape_string($connection,$_POST['conproductid'][$i]);
	$conmarketname=mysqli_real_escape_string($connection,$_POST['conmarketname'][$i]);
	$conmake=mysqli_real_escape_string($connection,$_POST['conmake'][$i]);
	$concapacity=mysqli_real_escape_string($connection,$_POST['concapacity'][$i]);
	$conpromodel=mysqli_real_escape_string($connection,$_POST['conpromodel'][$i]);
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
	
	$sqls2=mysqli_query($connection,"INSERT INTO jrctally(createdon, createdby, dname, noofconsignee, invoicetype, sotype, maxproduct, invoicenofrom, invoicenoto, invoicedate, qno, qdate, sono, maincategory, buyerid, tender, subcategory, department, otherreference, pono, podate, pofile, custreference, duedays, buyername, buyeraddress1, buyeraddress2, buyeraddress3, buyertaluk, buyerdistrict, buyerpincode, buyerstate, buyermobile, buyermail, rtype, bgst, consigneeno, consigneename, consigneeid, condepartment, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, constatecode, concontact, conphone, conmobile, conemail, congstno, conprogroup, conmultiple, conproductcode, promaincategory, prosubcategory, conproduct, conhsncode, conper, conproductid, conmarketname, conmake, concapacity, conpromodel, conqty, conunit, conigst, consgst,concgst,conigstamount,consgstamount,concgstamount,contotal,conwarranty,subtotalamount,totalgstamount,netamount,discount,discountmode,discountamount,addamount,lessamount,grandtotal) VALUES ('$createdon', '$createdby', '$dname', '$noofconsignee', '$invoicetype', '$sotype', '$maxproduct', '$invoicenofrom', '$invoicenoto', '$invoicedate', '$qno', '$qdate', '$sono', '$maincategory', '$buyerid', '$tender', '$subcategory', '$department', '$otherreference', '$pono', '$podate', '$attachments', '$custreference', '$duedays', '$buyername', '$buyeraddress1', '$buyeraddress2', '$buyeraddress3', '$buyertaluk', '$buyerdistrict', '$buyerpincode', '$buyerstate', '$buyermobile', '$buyermail', '$rtype', '$bgst', '$consigneeno', '$consigneename', '$consigneeid', '$condepartment', '$conaddress1', '$conaddress2', '$conaddress3', '$contaluk', '$condistrict', '$conpincode', '$constatecode', '$concontact', '$conphone', '$conmobile', '$conemail', '$congstno', '$conprogroup', '$conmultiple', '$conproductcode', '$promaincategory', '$prosubcategory', '$conproduct', '$conhsncode', '$conper', '$conproductid', '$conmarketname', '$conmake', '$concapacity', '$conpromodel', '$conqty', '$conunit', '$conigst', '$consgst', '$concgst', '$conigstamount', '$consgstamount', '$concgstamount', '$contotal', '$conwarranty', '$subtotalamount', '$totalgstamount', '$netamount', '$discount', '$discountmode', '$discountamount', '$addamount', '$lessamount', '$grandtotal')");
	}
	if($sqls2)
	{
	$sqls=mysqli_query($connection,"update jrcinvoice set serviceinvoice='$invoicenoto'");	
	$sqls1=mysqli_query($connection,"update jrcquotation set  compstatus='2',changeon='$createdon',sono='$sono',sodate='$createdon' where qno='".$qno."' ");	
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

<body id="page-top" onLoad="procalc();">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php /* include('salesnavbar.php'); */?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
		  
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-gray-800 text-center">Add New Sales Order</h1>
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
<?php
if(isset($_GET['id']))
{

$quoteid=mysqli_real_escape_string($connection, $_GET['id']);
	    $sqlselect = "SELECT * From jrcquotation where id='".$quoteid."' group by qno, qdate order by id desc";
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
				$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
				 $sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
        $querycons = mysqli_query($connection, $sqlcons);
        $rowCountcons = mysqli_num_rows($querycons);
        if(!$querycons){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountcons > 0) 
		{
        $rowcons = mysqli_fetch_array($querycons);
		if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowcons['address1']!='')
		{
		$rowcons['address1']=jbsdecrypt($_SESSION['encpass'], $rowcons['address1']);
		}
		if($rowcons['phone']!='')
		{
		$rowcons['phone']=jbsdecrypt($_SESSION['encpass'], $rowcons['phone']);
		}
		if($rowcons['mobile']!='')
		{
		$rowcons['mobile']=jbsdecrypt($_SESSION['encpass'], $rowcons['mobile']);
		}
		if($rowcons['email']!='')
		{
		$rowcons['email']=jbsdecrypt($_SESSION['encpass'], $rowcons['email']);
		}
	}
}


	
	
	
$noofconsignee=1;	
$sqls=mysqli_query($connection,"select serviceinvoice from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['serviceinvoice']+1;
$invoicenoto=(float)$infos['serviceinvoice']+(float)$noofconsignee;
?>	
<div class="card shadow mb-4">
            <div class="card-body">
			<div class="card-header py-1">
<h6 class=" font-weight-bold text-primary text-center">Sales Order Information</h6>
</div>
<br>
<form action="" method="post" id="myForm" onsubmit="return validateForm()">
<input type="hidden" name="noofconsignee" value="<?=$noofconsignee?>">

<input type="hidden" name="qno" value="<?=$rowselect['qno']?>">
<input type="hidden" name="qdate" value="<?=$rowselect['qdate']?>">
<input type="hidden" name="maxproduct" value="<?=$rowselect['noofproduts']?>">
<input type="hidden" name="reftime" value="<?=time().rand()?>">

<div class="row">
<div class="col-lg-3" style="display:none">
<div class="form-group">
<label for="sotype ">S.O. Type<span class="text-danger">*</span></label>
<select class="form-control fav_clr" id="sotype" name="sotype">

<option value="Regular">Regular Sales Order</option>
<option value="Service" selected>Service Sales Order</option>
</select>
</div>
</div>
  <div class="col-lg-4" style="display:none">
   <div class="form-group">
    <label for="invoicenofrom">Sales Order Number</label>
    <input type="text" class="form-control" id="invoicenofrom" name="invoicenofrom" placeholder="Sales Order No" value="<?='SO / SER / '.(date('my')).' /'.(str_pad($invoicenofrom, 4, '0', STR_PAD_LEFT))?>">
   </div>
  </div>
<?php
if($invoicenofrom!=$invoicenoto)
{
?>  
  <div class="col-lg-4" style="display:none">
   <div class="form-group">
    <label for="invoicenofrom">Sales Order Number (Upto)</label>
    <input type="text" class="form-control" id="invoicenoto" name="invoicenoto" placeholder="Sales Order No To" value="<?='SO / SER / '.(date('my')).' /'.(str_pad($invoicenoto, 4, '0', STR_PAD_LEFT))?>">
   </div>
  </div>
  <?php
  }
  ?>
  <div class="col-lg-4" style="display:none">
   <div class="form-group">
    <label for="invoicedate">Sales Order Date</label>
    <input type="date" class="form-control" id="invoicedate" name="invoicedate" placeholder="Sales Order Date" value="<?=date('Y-m-d')?>">
   </div>
  </div>
  <div class="col-lg-3">
<div class="form-group">
<label for="invoicenofrom ">Registration Type<span class="text-danger">*</span></label>
<select class="form-control fav_clr" id="invoicetype" name="invoicetype" onchange="checkGSTINRequirement()">

<option value="B2B" selected>Registered Dealer (B2B)</option>
<option value="B2C">Unregistered Dealer (B2C)</option>
</select>
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
  <?php
  if ($rowselect['noofproduts'] >=1 && $rowselect['noofproduts'] <= 10) {
    $duedays = 15;
} elseif ($rowselect['noofproduts'] <= 25) {
    $duedays = 20;
} elseif ($rowselect['noofproduts'] <= 50) {
    $duedays = 25;
} elseif ($rowselect['noofproduts'] <= 100) {
    $duedays = 30;
} else {
    $duedays = "";
}
?>
  <div class="col-lg-3" style="display:none">
   <div class="form-group">
    <label for="duedays">Due Days</label>
    <input type="number" class="form-control" id="duedays" name="duedays" value="<?=$duedays?>">
   </div>
  </div>
  <div class="col-lg-4">
<div class="form-group">
<label for="attachments">Attach File(s) - Purchase Order</label>
<input type="file" class="form-control" id="attachments" name="attachments" style="padding:2px; height:auto">
<label for="terms">You can upload a maximum of two files, Each with a size limit of 2MB</label>
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
	<input type="hidden" class="form-control" id="buyerid" name="buyerid" value="<?=$rowcons['id']?>">
    <input type="text" class="form-control" id="buyername" name="buyername" value="<?=$rowcons['consigneename']?>" required >
   </div>
  </div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="maincategory">Main Category</label>
    <input type="text" class="form-control" id="maincategory" name="maincategory" value="<?=$rowcons['maincategory']?>" >
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
    <input type="text" class="form-control" id="subcategory" name="subcategory" value="<?=$rowcons['subcategory']?>" >
  </div>
  </div>
  
<div class="col-lg-3">
    <div class="form-group">
    <label for="department">Department Name</label>
    <input type="text" class="form-control" id="department" name="department" value="<?=$rowcons['department']?>" >
  </div>
  </div>
  <div class="col-lg-3" style="display:none">
    <div class="form-group">
    <label for="otherreference">Other Reference</label>
    <input type="text" class="form-control" id="otherreference" name="otherreference" value="Asst.year-<?=date('Y')?>-<?=date('y')+1?>">
  </div>
  </div>
   
 
 
  <div class="col-lg-3">
   <div class="form-group">
    <label for="buyeraddress1">Address 1 <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="buyeraddress1" name="buyeraddress1" value="<?=$rowcons['address1']?>" required>
   </div>
  </div>
  <div class="col-lg-3">
   <div class="form-group">
    <label for="buyeraddress2">Address 2</label>
    <input type="text" class="form-control" id="buyeraddress2" name="buyeraddress2" value="<?=$rowcons['address2']?>">
   </div>
  </div>
  <div class="col-lg-3">
   <div class="form-group">
    <label for="buyeraddress3">Address 3</label>
    <input type="text" class="form-control" id="buyeraddress3" name="buyeraddress3" value="<?=$rowcons['area']?>">
   </div>
  </div>
  <div class="col-lg-3">
<div class="form-group">
<label for="buyertaluk">Taluk</label>
<input type="text" class="form-control" id="buyertaluk" name="buyertaluk" value="<?=$rowcons['area']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyerdistrict">District <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerdistrict" name="buyerdistrict" required maxlength="50" value="<?=$rowcons['district']?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyerpincode">Pincode <span class="text-danger">*</span></label>
<input type="text" class="form-control" id="buyerpincode" name="buyerpincode" maxlength="6" inputmode="numeric" required value="<?=$rowcons['pincode']?>">
</div>
</div>
  <div class="col-lg-3">
   <div class="form-group">
    <label for="buyerstate">State Code & State  <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="buyerstate" name="buyerstate" value="<?=$rowcons['statecode']?>" required>
   </div>
  </div>
  <div class="col-lg-3">
<div class="form-group">
<label for="buyermobile">Mobile Number</label>
<input type="text" class="form-control" id="buyermobile" name="buyermobile" maxlength="10" inputmode="numeric" value="<?=$rowcons['mobile']?>" >
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
<label for="buyermail">E-mail </label>
<input type="email" class="form-control" id="buyermail" name="buyermail" maxlength="320" value="<?=$rowcons['email']?>" >
</div>
</div>
  <div class="col-lg-3" style="display:none">
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
  <div class="col-lg-3">
   <div class="form-group">
    <label for="bgst">GSTIN No <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="bgst" name="bgst" value="<?=$rowcons['gstno']?>" required>
   </div>
  </div>
  </div>
  <br>
<div class="card-header py-1">
<h6 class="font-weight-bold text-primary text-center">Customer Information</h6>
</div>
<br>
  <label for="sameas" class="text-danger"><input type="checkbox" id="sameas" name="sameas" onchange="sameass()"> Customer Address Same as Buyer Address</label>
   <div class="text-center mt-3"><a class="btn btn-light" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()">&larr;Scroll Left</a><a class="btn btn-light" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()">Scroll Right &rarr;</a></div>
  <div class="table-responsive">
  <table class="table" id="table-data">
  <tr>
  <th>No.</th>
  <th>CONSIGNEE NAME <span class="text-danger">*</span></th><th>DEPARTMENT</th><th>ADDRESS 1 <span class="text-danger">*</span></th><th>ADDRESS 2</th><th>address 3</th><th>TALUK</th><th>DISTRICT <span class="text-danger">*</span></th><th>PIN CODE<span class="text-danger">*</span></th><th>STATE CODE & STATE<span class="text-danger">*</span></th><th>Contact Person</th><th>PHONE NO.</th><th>MOBILE.NO.</th><th>MAIL ID</th><th>GST.NO.<span id="asterisk" class="text-danger">*</span></th><th></th><!--th>PRODUCT GROUP</th--><!--th>MULTIPLE GODOWN</th--><th>PRODUCT CODE</th><th>PRODUCT <span class="text-danger">*</span></th><!--th>HSN/SAC <span class="text-danger">*</span></th--><!--th>MARKET NAME </th--><th>QTY<span class="text-danger">*</span></th><th>Unit Price<span class="text-danger">*</span></th><!--th>IGST</th><th>SGST</th><th>CGST</th><th>IGST AMOUNT</th><th>SGST AMOUNT</th><th>CGST AMOUNT</th--><th>TOTAL AMOUNT</th><!--th>warranty months</th-->
  </tr>
  <?php
for($i=1;$i<=$noofconsignee;$i++)
{
  $sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='PRODUCT' order by id ASC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
		
		while($rowselect2 = mysqli_fetch_array($queryselect2)) 
		{
			
			$sqlengselect = "SELECT id, compprefix, compno, engineername, signature, mobile From jrcengineer where id='".$rowselect2['engineerid']."' order by id desc";
				$queryengselect = mysqli_query($connection, $sqlengselect);
				$rowCountengselect = mysqli_num_rows($queryengselect);
				$rowengselect = mysqli_fetch_array($queryengselect);
				if($rowCountengselect >0 )
				{
				$engineersignature=$rowengselect['signature'];
				$engineersignature=str_replace('uploads','padhivetram',$engineersignature);
				$engineername=$rowengselect['engineername'];
				$engineermobile=$rowengselect['mobile'];
				$compno=$rowengselect['compno'];
				$compprefix=$rowengselect['compprefix'];
				$engineerid=$rowengselect['id'];
				}
				$sqladmin = "SELECT id,signature,mobile,adminusername From jrcadminuser where username='".$rowselect2['createdby']."' order by id desc";
				$queryadmin = mysqli_query($connection, $sqladmin);
				$rowadmin = mysqli_num_rows($queryadmin);
				$rowSelectadmin = mysqli_fetch_array($queryadmin);
				if($rowadmin >0 )
				{
				$adminsignature=$rowSelectadmin['signature'];
				$adminsignature=str_replace('uploads','padhivetram',$adminsignature);
				$adminname=$rowSelectadmin['adminusername'];
				$adminmobile=$rowSelectadmin['mobile'];
				}
			
	$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
	$queryxl = mysqli_query($connection, $sqlxl);
	$rowCountxl = mysqli_num_rows($queryxl);
	if(!$queryxl){
	   die("SQL query failed: " . mysqli_error($connection));
	}
	$rowxl = mysqli_fetch_array($queryxl);
  
  

	?>
	<input type="hidden" name="qid[]" value="<?=$id?>">
	<tr class="tr_clone">
  <th><input type="hidden" name="consigneeno[]" value="<?=$i?>" value="<?=$rowcons['id']?>"><?=$i?></th>
  <th><input type="hidden" id="consigneeid<?=$i?>" name="consigneeid[]" value="<?=$rowcons['id']?>"><input type="text" name="consigneename[]" id="consigneename<?=$i?>" placeholder="CONSIGNEE NAME (<?=$i?>)" tabindex="21" value="<?=$rowcons['consigneename']?>"></th>
  <th><input type="text" name="condepartment[]" id="condepartment<?=$i?>" placeholder="DEPARTMENT (<?=$i?>)" tabindex="22" value="<?=$rowcons['department']?>"></th>
  <th><input type="text" name="conaddress1[]" id="conaddress1<?=$i?>" placeholder="ADDRESS 1 (<?=$i?>)" tabindex="23" value="<?=$rowcons['address1']?>"></th>
  <th><input type="text" name="conaddress2[]" id="conaddress2<?=$i?>" placeholder="ADDRESS 2 (<?=$i?>)" tabindex="24" value="<?=$rowcons['address2']?>"></th>
  <th><input type="text" name="conaddress3[]" id="conaddress3<?=$i?>" placeholder="ADDRESS 3 (<?=$i?>)" tabindex="25"></th>
  <th><input type="text" name="contaluk[]" id="contaluk<?=$i?>" placeholder="TALUK (<?=$i?>)" tabindex="26" value="<?=$rowcons['area']?>"></th>
  <th><input type="text" name="condistrict[]" id="condistrict<?=$i?>" placeholder="DISTRICT (<?=$i?>)" tabindex="27" value="<?=$rowcons['district']?>"></th>
  <th><input type="text" name="conpincode[]" id="conpincode<?=$i?>" placeholder="PIN CODE (<?=$i?>)" tabindex="28"  onKeyup="cleartext<?=$i?>()" value="<?=$rowcons['pincode']?>"></th>
  <th><input type="text" name="constatecode[]" id="constatecode<?=$i?>" placeholder="STATE CODE (<?=$i?>)" tabindex="29" value="<?=$rowcons['statecode']?>"></th>
  <th><input type="text" name="concontact[]" id="concontact<?=$i?>" placeholder="CONTACT PERSON (<?=$i?>)" tabindex="30" value="<?=$rowcons['contact']?>"></th>
  <th><input type="text" name="conphone[]" id="conphone<?=$i?>" placeholder="PHONE NO. (<?=$i?>)" tabindex="31" value="<?=$rowcons['phone']?>"></th>
  <th><input type="number" name="conmobile[]" id="conmobile<?=$i?>" placeholder="MOBILE NO. (<?=$i?>)" tabindex="32" value="<?=$rowcons['mobile']?>"></th>
  <th><input type="text" name="conemail[]" id="conemail<?=$i?>" placeholder="MAIL ID (<?=$i?>)" tabindex="33" value="<?=$rowcons['email']?>"></th>
  <th><input type="text" name="congstno[]" id="congstno<?=$i?>" placeholder="GST NO (<?=$i?>)" tabindex="34" value="<?=$rowcons['gstno']?>"></th>
  <th><input type="button" name="add" value="Add" class="tr_clone_add" tabindex="35"></th>
  <th style="display:none"><input type="text" name="conprogroup[]" id="conprogroup<?=$i?>" placeholder="PRODUCT GROUP (<?=$i?>)" tabindex="36" value="<?=$rowxl['stocksubcategory']?>"></th>
  <th style="display:none"><input type="text" name="conmultiple[]" id="conmultiple<?=$i?>" placeholder="MULTIPLE GODOWN (<?=$i?>)" tabindex="37" value=""></th>
  <th><input type="text" name="conproductcode[]" id="conproductcode<?=$i?>" placeholder="PRODUCT CODE (<?=$i?>)" tabindex="38" value="<?=$rowxl['code']?>"></th>
  <input type="hidden" class="promaincategory" name="promaincategory[]" id="promaincategory<?=$i?>" placeholder="MAIN CATEGORY(<?=$i?>)" tabindex="39" value="<?=$rowxl['stockmaincategory']?>">
  <input type="hidden" class="prosubcategory" name="prosubcategory[]" id="prosubcategory<?=$i?>" placeholder="SUB CATEGORY(<?=$i?>)" tabindex="40" value="<?=$rowxl['stocksubcategory']?>">
  <th><input type="hidden" id="conproductid<?=$i?>" name="conproductid[]" value="<?=$rowxl['id']?>"><input type="text" name="conproduct[]" id="conproduct<?=$i?>" placeholder="PRODUCT (<?=$i?>)" tabindex="41" value="<?=$rowxl['stockitem']?>"></th>
  <th style="display:none"><input type="text" class="conhsncode"  name="conhsncode[]" id="conhsncode<?=$i?>" placeholder="HSN/SAC (<?=$i?>)" tabindex="42" maxlength="8" value="<?=$rowxl['hsncode']?>" required></th>
  <input type="hidden" class="conper" name="conper[]" id="conper<?=$i?>" placeholder="PER (<?=$i?>)" tabindex="43" value="<?=$rowxl['unit']?>">
  <th style="display:none"><input type="text" name="conmarketname[]" id="conmarketname<?=$i?>" placeholder="MARKET NAME (<?=$i?>)" tabindex="44" value="<?=$rowxl['marketname']?>"></th>
  <input type="hidden" class="conmake" name="conmake[]" id="conmake<?=$i?>" placeholder="MAKE (<?=$i?>)" tabindex="45" value="<?=$rowxl['make']?>">
  <input type="hidden" class="concapacity" name="concapacity[]" id="concapacity<?=$i?>" placeholder="CAPACITY (<?=$i?>)" tabindex="46" value="<?=$rowxl['capacity']?>">
  <input type="hidden" class="conpromodel" name="conpromodel[]" id="conpromodel<?=$i?>" placeholder="MODEL (<?=$i?>)" tabindex="47" value="<?=$rowxl['model']?>">
  <th><input type="number" name="conqty[]" id="conqty<?=$i?>" placeholder="QTY (<?=$i?>)" onchange="procalc(<?=$i?>)" tabindex="48" value="<?=$rowselect2['salequantity']?>"></th>
  <th><input type="number" step="0.01" min="0" name="conunit[]" id="conunit<?=$i?>" placeholder="UNIT PRICE  (<?=$i?>)" onchange="procalc(<?=$i?>)" tabindex="49" value="<?=$rowselect2['saleprice']?>"></th>
  <th style="display:none"><input type="number" step="0.01" min="0" name="conigst[]" id="conigst<?=$i?>" placeholder="IGST (<?=$i?>)" onchange="procalc(<?=$i?>)" tabindex="50"></th>
  <th style="display:none"><input type="number" step="0.01" min="0" name="consgst[]" id="consgst<?=$i?>" placeholder="SGST (<?=$i?>)" onchange="procalc(<?=$i?>)" tabindex="51" value="<?=(float)$rowselect2['gst']/2?>"></th>
  <th style="display:none"><input type="number" step="0.01" min="0" name="concgst[]" id="concgst<?=$i?>" placeholder="CGST (<?=$i?>)" onchange="procalc(<?=$i?>)" readonly tabindex="-1" tabindex="52" value="<?=(float)$rowselect2['gst']/2?>"></th>
  <th style="display:none"><input type="number" step="0.01" min="0" name="conigstamount[]" id="conigstamount<?=$i?>" placeholder="IGST AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="53"></th>
  <th style="display:none"><input type="number" step="0.01" min="0" name="consgstamount[]" id="consgstamount<?=$i?>" placeholder="SGST AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="54" value="<?=(float)$rowselect2['salesgst']/2?>"></th>
  <th style="display:none"><input type="number" step="0.01" min="0" name="concgstamount[]" id="concgstamount<?=$i?>" placeholder="CGST AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="55" value="<?=(float)$rowselect2['salesgst']/2?>"></th>
  <th><input type="number" step="0.01" min="0" name="contotal[]" id="contotal<?=$i?>" placeholder="TOTAL AMOUNT (<?=$i?>)" readonly tabindex="-1" tabindex="56" value="<?=$rowselect2['salesnettotal']?>"></th>
  <th style="display:none"><input type="number" step="0.01" min="0" name="conwarranty[]" id="conwarranty<?=$i?>" placeholder="WARRANTY MONTHS (<?=$i?>)" tabindex="57" value="<?=$rowxl['warranty']?>"></th>
  </tr>
<?php	
		}
  }
		}
		?>
  
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
      <input type="number" step="0.01" min="0" readonly class="form-control" id="subtotalamount" name="subtotalamount" style="text-align:right" >
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
<input type="number" name="discount" id="discount" class="form-control" onchange="procalc(1)" style="text-align:right" min="0" step="0.01">
<div class="input-group-append">
<select id="discountmode" name="discountmode" class="form-control" data-live-search="true" onchange="procalc(1)">
<option value="percentage">%</option>
<option value="rupee">₹</option>
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
      <input type="number" step="0.01" min="0" class="form-control" id="addamount" name="addamount" onChange="procalc(1)" style="text-align:right" >
    </div>
  </div>
  
    <div class="form-group row">
    <label for="lessamount" class="col-sm-6 col-form-label text-right">Less Charges</label>
    <div class="col-sm-6">
      <input type="number" step="0.01" min="0" class="form-control" id="lessamount" name="lessamount" onChange="procalc(1)" style="text-align:right" >
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

			}
		}
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
	   source: 'consearch.php', select: function (event, ui) { $("#buyername").val(ui.item.value); $("#buyeraddress1").val(ui.item.address1); $("#buyeraddress2").val(ui.item.address2); $("#buyeraddress3").val(ui.item.area); $("#buyerdistrict").val(ui.item.district);$("#buyerpincode").val(ui.item.pincode);$("#buyermail").val(ui.item.email);$("#buyermobile").val(ui.item.mobile);$("#buyercontact").val(ui.item.contact);$("#buyerphone").val(ui.item.phone);$("#bgst").val(ui.item.gstno);$("#buyerstate").val(ui.item.statecode);$("#rtype").val(ui.item.gsttype);$("#maincategory").val(ui.item.maincategory);$("#subcategory").val(ui.item.subcategory);$("#department").val(ui.item.department);}, minLength: 3
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
	var conhsncode=document.getElementsByName("conhsncode[]");
	var conaddress3=document.getElementsByName("conaddress3[]");
	var contaluk=document.getElementsByName("contaluk[]");
	var condistrict=document.getElementsByName("condistrict[]");
	var conpincode=document.getElementsByName("conpincode[]");
	var conprogroup=document.getElementsByName("conprogroup[]");
	var conwarranty=document.getElementsByName("conwarranty[]");
	var congstvalue=document.getElementsByName("congstvalue[]");
	for(var i=0;i<consigneeno.length;i++)
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
	 $( prosubcategory[i][j] ).autocomplete({
	 source: 'tallysearch.php?type=stocksubcategory&table=jrcproduct',
	 });
	 $( componentname[i][j] ).autocomplete({
	 source: 'tallysearch.php?type=componentname&table=jrcproduct',
	 });
	 $( componenttype[i][j] ).autocomplete({
	 source: 'tallysearch.php?type=componenttype&table=jrcproduct',
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
	 $( "#conprogroup<?=$i?>" ).autocomplete({
       source: 'tallysearch.php?type=conprogroup&table=jrctally',
     });
	 $( "#conmultiple<?=$i?>" ).autocomplete({
       source: 'tallysearch.php?type=conmultiple&table=jrctally',
     });
	 $( "#promaincategory<?=$i?><?=$j?>" ).autocomplete({
	source: 'tallysearch.php?type=stockmaincategory&table=jrcproduct',
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
	 $( "#conproductcode<?=$i?>" ).autocomplete({
	source: 'tallysearch.php?type=code&table=jrcproduct',
	});
	$( "#conproduct<?=$i?>" ).autocomplete({
	source: 'tallysearch.php?type=stockitem&table=jrcproduct',
	});
	$( "#conmarketname<?=$i?>" ).autocomplete({
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
	 $( "#conpincode<?=$i?>" ).autocomplete({
       source: 'pincodesearch.php?type=pincode',
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
function validateForm() {
<?php
for ($i = 1; $i <= $noofconsignee; $i++) {
?>
    var hsnCode<?=$i?> = document.getElementById('conhsncode<?=$i?>').value;
    if (hsnCode<?=$i?>.trim() === '') {
        alert('HSN/SAC code cannot be empty!');
        return false; // Prevent form submission
    }
<?php
}
?>
    return true; // Allow form submission
}
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


grandtotal.value=((parseFloat(totalnet)+parseFloat(shipamount))-(parseFloat(discountamt)+parseFloat(lessamt))).toFixed(2);
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
$(document).ready(function(){
function autoSave()
{
/*
var form=$("#myForm");
var forms=$("#myForm1"); */
var dataString = $("#myForm").serialize();

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

function checkGSTINRequirement() {
  var invoiceType = document.getElementById("invoicetype").value;
var gstinFields = document.getElementsByName("congst[]");
  //var gstinField1 = document.getElementById("bgst");
  var asterisk = document.getElementById("asterisk");

  if (invoiceType == "B2B") {
    gstinField.style.display = "block";
    document.getElementById("bgst").required = true;
    document.getElementsByName("congst[]").required = true;
    asterisk.style.display = "inline"; // Show the asterisk
    asterisk1.style.display = "inline"; // Show the asterisk
  } else {
    gstinField.style.display = "none";
	//document.getElementById("bgst").required = false;
	document.getElementsByName("congst[]").required = false;
    asterisk.style.display = "none"; // Hide the asterisk
    asterisk1.style.display = "none"; // Hide the asterisk
  }
}
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
