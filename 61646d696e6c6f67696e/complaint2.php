<?php 
include('lcheck.php'); 
$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?=$_SESSION['companyname']?> - Jerobyte - Call Details</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
<style>
.imgcontainer, .imgcontainer2, .imgsealcontainer , .imgmanualcontainer{
	height:auto;
 text-align:center;
}
.imgcontent, .imgsealcontent, .imgmanualcontent{
 width: 110px;
 float: left;
 margin-right: 5px;
 border: 1px solid gray;
 border-radius: 3px;
 padding: 5px;
}
/* Delete */
.imgcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgcontent span:hover{
 cursor: pointer;
}
.imgsealcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgmanualcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgsealcontent, .imgmanualcontent span:hover{
 cursor: pointer;
}
.ajax-upload-dragdrop, .ajax-file-upload-statusbar, .ajax-file-upload-filename
{
	width: 100% !important;
}
</style>
</head>
<body id="page-top" onload="customerchange();gstamount(1);totalcalc();totalamount(1)">
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
          <?php // include('callnavbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Call Details</h1>
          </div>
          <div class="row">
 <div class="col-lg-12">
 <?php
 if(isset($_GET['remarks']))
 {
	 ?>
	 <div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
	 <?php
 }
?> 
 <div class="row" id="myItems">
 <?php
 if(isset($_GET['id']))
 {
	$calltid=mysqli_real_escape_string($connection,$_GET['id']);
	$_SESSION['calltid']=$calltid;
	$sqlselect = "SELECT engineerid, reportingengineerid, sourceid, compstatus, callon, callhandlingname, coordinatorname, callfrom, servicetype, serial, reportedproblem, otherremarks, problemobserved, actiontaken, calltid, businesstype, id, customernature, callnature, calltype, engineertype, engineersname, engineersid From jrccalls where calltid='".$calltid."' order by id desc";
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
if($rowselect['engineertype']=='0')
{
$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where id='".$rowselect['engineerid']."' order by id desc";   
$queryengselect = mysqli_query($connection, $sqlengselect);   
$rowCountengselect = mysqli_num_rows($queryengselect);   
$rowengselect = mysqli_fetch_array($queryengselect);   
$engsignature=isset($rowengselect['signature'])?$rowengselect['signature']:'';   
$engineername=isset($rowengselect['engineername'])?$rowengselect['engineername']:'';   
$compno=isset($rowengselect['compno'])?$rowengselect['compno']:'';   
$compprefix=isset($rowengselect['compprefix'])?$rowengselect['compprefix']:'';   
$engineerid=isset($rowengselect['id'])?$rowengselect['id']:''; 
}
else
{
$sqlengselect = "SELECT id, compprefix, compno, engineername, signature From jrcengineer where id='".$rowselect['reportingengineerid']."' order by id desc";   
$queryengselect = mysqli_query($connection, $sqlengselect);   
$rowCountengselect = mysqli_num_rows($queryengselect);   
$rowengselect = mysqli_fetch_array($queryengselect);   
$engsignature=isset($rowengselect['signature'])?$rowengselect['signature']:'';   
$engineername=isset($rowengselect['engineername'])?$rowengselect['engineername']:'';   
$compno=isset($rowengselect['compno'])?$rowengselect['compno']:'';   
$compprefix=isset($rowengselect['compprefix'])?$rowengselect['compprefix']:'';   
$engineerid=isset($rowengselect['id'])?$rowengselect['id']:''; 
}




				$sqlxl = "SELECT address1, phone, mobile, email, consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem, make, capacity,id  From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountxl > 0) 
				{
					$rowxl = mysqli_fetch_array($queryxl);
				 $sqlserial = "SELECT location  From jrcserials where sourceid='".$rowxl['id']."' order by id asc";
				$queryserial = mysqli_query($connection, $sqlserial);
				$rowCountserial = mysqli_num_rows($queryserial);
				$rowserial = mysqli_fetch_array($queryserial);
					
					
					if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowxl['address1']!='')
		{
		$rowxl['address1']=jbsdecrypt($_SESSION['encpass'], $rowxl['address1']);
		}
		if($rowxl['phone']!='')
		{
		$rowxl['phone']=jbsdecrypt($_SESSION['encpass'], $rowxl['phone']);
		}
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($_SESSION['encpass'], $rowxl['mobile']);
		}
		if($rowxl['email']!='')
		{
		$rowxl['email']=jbsdecrypt($_SESSION['encpass'], $rowxl['email']);
		}
	}
}
				}
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				  $sqlcons = "SELECT address1, email, address2, area, district, pincode, contact, phone, mobile, latlong, gstno, id From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
        $querycons = mysqli_query($connection, $sqlcons);
        $rowCountcons = mysqli_num_rows($querycons);
        if(!$querycons){
           die("SQL query failed: " . mysqli_error($connection));
        }
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
		?>
		<?php
					  if($rowselect['compstatus']=='2')
					  {
						$bg="bg-success";
						$bgtext="Completed";
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						$bg="bg-warning";
						$bgtext="Pending";
					  }
					  else
					  {
						$bg="bg-danger";
						$bgtext="Open";
					  }
					  ?>
		<div class="col-lg-12 mb-4 items">
                                    <div class="card shadow">
									<div class="card-header <?=$bg?> text-white ">
									<?=$rowselect['calltid']?> - <?=$bgtext?>
									</div>
                                        <div class="card-body">
                                            <h5>Call Details:</h5> 
											<p><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?><br>
											C/H: <?=$rowselect['callhandlingname']?><br>
											C/O: <?=$rowselect['coordinatorname']?><br>
											Call From: <a href="tel:<?=$rowselect['callfrom']?>"><?=$rowselect['callfrom']?></a><br>
											Customer Nature: <?php
					  if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
						   <?php						  
					 }
					 ?>
Business Type: <?php
if($rowselect['businesstype']!='')
{
		?>
	  <span class="btn btn-sm btn-success"><?=$rowselect['businesstype']?></span><br>
	  <?php						  
} 
?>
Service Type: <?php
if($rowselect['servicetype']!='')
{
		?>
	  <span class="btn btn-sm btn-danger"><?=$rowselect['servicetype']?></span><br>
	  <?php						  
} 
?>
					 Call Nature: <?php
					 if($rowselect['callnature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-primary"><?=$rowselect['callnature']?></span><br>
						   <?php						  
					 }
					  ?>
											</p>
											<hr>
											<h5>Customer Details:</h5>
											<p><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
											if($rowcons['latlong']!='')
											{
											?>	
											<br>
											<a class="text-primary" style="cursor:pointer" onClick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a>
											<?php
											}
											?>
											</p>
											<hr>
											<h5>Product Details:</h5>
											<p><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowxl['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowxl['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowxl['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowxl['stockitem']?>
												<?php
												}
												?><br><b><?=$rowselect['serial']?><?=($rowserial['location']!='')?'-'.$rowserial['location']:''?></b></p>
											<hr>
											<h5>Problem Details:</h5>
											<p>Reported: <?=$rowselect['reportedproblem']?> <?=($rowselect['otherremarks']!='')?'('.$rowselect['otherremarks'].')':''?><br>
					  Observed: <?=$rowselect['problemobserved']?><br>
					  Action Taken: <?=$rowselect['actiontaken']?></p>
					  <hr>
					  <?php
				 $sqlcon4 = "SELECT imgbefuploads, consigneeavailable, srno, worktype, problemobserved, stockitem, make, capacity, mfgcode, producttype, pvmake, pvtype, pvcapacity, pvqty, pvslno, ntmake, nttype, ntcapacity, ntqty, ntslno, shadow, noofplstr, noofstr, tilt, plposter, civil, mechanical, elecwiring, acearth, dcearth, laearth, spvvol, spvcur, plvoc, plcell, plseries, plparallel, plvol, plangel, plpower, pltime, avgloadnight, avgloadday, totalload, inputsupply, dvstfree, earthingcheck, upsavailability, airconditioned, inputvoltage, earthleakage, cleaning, softwarecheck, antiviruscheck, looseconnection, speedcheck, tempfilecleaning, hardwarecheck, printcheck, keyboard, mouse, batterymake, batteryah, noofbattery, noofset, phasetype, voliry, volirn, voliyb, volibn, volibr, voliyn, voline, curir, freir, curiy, freiy, curib, freib, curin, volipn, curip, volipe, cur1in, vol1ine, freip, volory, volorn, voloyb, volobn, volobr, voloyn, volone, curor, freor, curoy, freoy, curob, freob, cur1on, volopn, curop, volope, curon, vol1one, freop, verification, directsunlight, wiringready, modificationwiring, waterdripping, coastelarea, pollutionlevel, moisture, stabilizer, phasereverse, earthing, overload, chargingv, chargingo, dischargingv, dischargingo, dischargingwv, dischargingwo, batterycondition, mfpbwa4cpr, mfpbwa4fax, mfpbwa4prp, mfpclcpr, mfpclfax, mfpclprp, priportmaster, priportcopies, totalmeterreading, sparesused1, sparesused1q, sparesused2, sparesused2q, sparesused3, sparesused3q, sparesused4, sparesused4q, sparesused5, sparesused5q, sparesrequired1, sparesrequired1q, sparesrequired2, sparesrequired2q, sparesrequired3, sparesrequired3q, sparesrequired4, sparesrequired4q, sparesrequired5, sparesrequired5q, actiontaken, schargeno, schargedate, smaterial1, smaterial2, smaterial3, smaterial4, smaterial5, sprice1, sprice2, sprice3, sprice4, sprice5, squantity1, squantity2, squantity3, squantity4, squantity5, stotal1, stotal2, stotal3, stotal4, stotal5, sgstper1, sgstper2, sgstper3, sgstper4, sgstper5, sgstpervalue1, sgstpervalue2, sgstpervalue3, sgstpervalue4, sgstpervalue5, schargepre1, schargepre2, schargepre3, schargepre4, schargepre5,  schargegstvalue, sercharge, schargepre, sgstamt, scharge, mchargescharge, mchargegstvalue, schargematerial, schargescharge, schargegst, incgst, imguploads, engineerreport, customerfeedback, engapproach, signname, signature, imgseal, imgmanual, callstatus ,id,airearthing,airstabilizer,airtonnage,airipvolt,airopvolt,aircurrent,airgril,airroom,airdpressure,airspressure,airothers,airambient  From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
	    $querycon4 = mysqli_query($connection, $sqlcon4);
		$rowcon4=mysqli_num_rows($querycon4);
		$infocon4=mysqli_fetch_array($querycon4);
		?>
					  <form action="complaintadds.php" method="post" enctype="multipart/form-data" onsubmit="return checkvalidate()">
					  <input type="hidden" name="calltid" value="<?=$rowselect['calltid']?>">
					  <input type="hidden" name="businesstype" value="<?=$rowselect['businesstype']?>">
					  <input type="hidden" name="calloid" value="<?=$rowselect['id']?>">
					  <input type="hidden" name="consigneeid" value="<?=$rowcons['id']?>">
					  <input type="hidden" name="customernature" id="customernature" value="<?=$rowselect['customernature']?>">
					  <input type="hidden" name="callnature" id="callnature" value="<?=$rowselect['callnature']?>">
					  <input type="hidden" name="calltype" id="calltype" value="<?=$rowselect['calltype']?>">
					  <input type="hidden" name="engsignature" id="engsignature" value="<?=$engsignature?>">
					  <input type="hidden" name="engineername" id="engineername" value="<?=$engineername?>">
					  <input type="hidden" name="compno" id="compno" value="<?=$compno?>">
					  <input type="hidden" name="compprefix" id="compprefix" value="<?=$compprefix?>">
					  <input type="hidden" name="engineerid" id="engineerid" value="<?=$engineerid?>">
<?php
if($infolayoutservice['imgbefuploads']=='1')
{
?>					  
					   <div class="row mb-1">
     <div class="col-12">
	 <h5 class="mb-2"><label for="showData2">Site Images (Before Taking Action)</label></h5>
<div id="showData2" class="imgcontainer2"><?php if($rowcon4>0){if($infocon4['imgbefuploads']!=''){$as=explode(',',$infocon4['imgbefuploads']);$c=1;foreach($as as $a){echo "<div class='imgcontent' ><img src='".$a."' width='100' height='100'></div>";$c++;}}}?></div>
<input id="imgbefuploads" type="hidden" name="imgbefuploads" value="<?=($rowcon4>0)?$infocon4['imgbefuploads']:''?>"><br>
</div>
</div> 
 <hr>
<?php
}
else
{
	?>
	<input type="hidden" name="imgbefuploads" id="imgbefuploads" value="<?=($rowcon4>0)?$infocon4['imgbefuploads']:''?>">
	<?php
}
?>
<?php
if($infolayoutservice['callstatus']=='1')
{
	?>
<div class="row">
    <div class="col-6">
      <label for="consigneeavailable" class="col-form-label">Customer Available Status</label>
    </div>
	<div class="col-6">
        <select class="form-control" onclick="customerchange()" onchange="customerchange()"  name="consigneeavailable" id="consigneeavailable" <?=($infolayoutservice['callstatusreq']=='1')?'required':''?>>
		<option value="" onclick="customerchange()">Select</option>
		<option  value="available" <?=($rowcon4>0)?(($infocon4['consigneeavailable']=="available")?"selected":""):""?> selected>Available</option>
		<option onclick="customerchange()" onchange="customerchange()" value="notavailable"<?=($rowcon4>0)?(($infocon4['consigneeavailable']=="notavailable")?"selected":""):""?>>Customer Not Available</option>
		<option onclick="customerchange()" onchange="customerchange()" value="productnot" <?=($rowcon4>0)?(($infocon4['consigneeavailable']=="productnot")?"selected":""):""?>>Product Not Available</option>
		<option onclick="customerchange()" onchange="customerchange()" value="othermake" <?=($rowcon4>0)?(($infocon4['consigneeavailable']=="othermake")?"selected":""):""?>>Other Make Product</option>
		</select>
	</div>
  </div>
<?php
  }
  else
{
	?>
	<input type="hidden" name="consigneeavailable" id="consigneeavailable" value="<?=($rowcon4>0)?$infocon4['consigneeavailable']:''?>">
	<?php
}
  ?>
<hr>
<div id="customeravail" onchange="customerchange()">
<?php
if($infolayoutservice['srno']=='1')
{
?> 
<div class="row mb-1">
     <div class="col-6">
      <label for="srno" class="col-form-label">Service Report No</label>
    </div>
    <div class="col-6"><?php $srno=$compprefix.' / '.date('m').date('y').' / '.(str_pad(((float)$compno+1),4,"0",STR_PAD_LEFT)); ?>
      <input type="text" class="form-control" name="srno" id="srno" value="<?=($rowcon4>0)?(($infocon4['srno']!='')?$infocon4['srno']:''):''?>" readonly>
    </div>
  </div>
<hr>
<?php
}
else
{
	?>
	<input type="hidden" name="srno" id="srno" value="<?=($rowcon4>0)?$infocon4['srno']:''?>">
	<?php
}
if($infolayoutservice['worktype']=='1')
{
?>	
	<div class="row mb-1">
     <div class="col-6">
      <label for="worktype" class="col-form-label">Work Nature<?php if($infolayoutservice['worktypereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
        <select class="form-control" name="worktype" id="worktype" <?=($infolayoutservice['worktypereq']=='1')?'required':''?>>
		<option value="">Select</option>
		<?php
		$sqlselectworkcategory = "SELECT distinct workcategory From jrcworktype order by workcategory asc";
        $queryselectworkcategory = mysqli_query($connection, $sqlselectworkcategory);
        $rowCountselectworkcategory = mysqli_num_rows($queryselectworkcategory);
		while($rowselectworkcategory = mysqli_fetch_array($queryselectworkcategory)) 
		{
			?>
			<optgroup label="<?=$rowselectworkcategory['workcategory']?>">
			<?php
			$sqlselectworktype = "SELECT distinct worktype From jrcworktype where workcategory='".$rowselectworkcategory['workcategory']."' order by workcategory asc";
			$queryselectworktype = mysqli_query($connection, $sqlselectworktype);
			$rowCountselectworktype = mysqli_num_rows($queryselectworktype);
			while($rowselectworktype = mysqli_fetch_array($queryselectworktype)) 
			{
			?>
			<option value="<?=$rowselectworktype['worktype']?>" <?=($rowcon4>0)?(($infocon4['worktype']==$rowselectworktype['worktype'])?"selected":""):""?>><?=$rowselectworktype['worktype']?></option>
			<?php
			}
			?>
			</optgroup>
		<?php
		}
		?>	
		</select>
    </div>
  </div>
 <hr>
 <?php
}
else
{
	?>
	<input type="hidden" name="worktype" id="worktype" value="<?=($rowcon4>0)?$infocon4['worktype']:''?>">
	<?php
}
?>
 <?php
if($infolayoutservice['problemobserved']=='1')
{
?> <hr> 
  <div class="form-group">
    <h5 class="mb-2"><label for="problemobserved">Problem Observed<?php if($infolayoutservice['problemobservedreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?><span href="#" data-toggle="modal" data-target="#problemobservedmodal">&nbsp;<i class="fa fa-plus text-primary"></i> </span></label></h5>
	<select class="form-control fav_clr" id="problemobserved" name="problemobserved"  <?=($infolayoutservice['problemobservedreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT problemobserved From jrcproblemobserved order by problemobserved asc";
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
<option value="<?=$rowrep['problemobserved']?>" <?=($rowcon4>0)?(($infocon4['problemobserved']==$rowrep['problemobserved'])?"selected":""):""?>><?=$rowrep['problemobserved']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  <hr>
 <?php
}
else
{
	?>
	<input type="hidden" name="problemobserved" id="problemobserved" value="<?=($rowcon4>0)?$infocon4['problemobserved']:''?>">
	<?php
} 
if($infolayoutservice['stockitem']=='1')
{
?> 
  <div class="row mb-1">
     <div class="col-6">
      <label for="stockitem" class="col-form-label">Product Name<?php if($infolayoutservice['stockitemreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
	  <select class="form-control fav_clr" id="stockitem" name="stockitem"  <?=($infolayoutservice['stockitemreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT distinct stockitem From jrcproduct where stockitem!='' order by cast(stockitem as unsigned) asc";
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
<option value="<?=$rowrep['stockitem']?>" <?=($rowxl['stockitem']==$rowrep['stockitem'])?"selected":((($rowcon4>0)&&($infocon4['stockitem']==$rowrep['stockitem']))?"selected":"")?>><?=$rowrep['stockitem']?></option>
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
	<input type="hidden" name="stockitem" id="stockitem" value="<?=($rowcon4>0)?$infocon4['stockitem']:''?>">
	<?php
}
if($infolayoutservice['make']=='1')
{
?>   
  <div class="row mb-1">
     <div class="col-6">
      <label for="make" class="col-form-label">Make<?php if($infolayoutservice['makereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <select class="form-control" id="make" name="make"  <?=($infolayoutservice['makereq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT distinct make From jrcxl where make!='' order by make asc";
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
<option value="<?=$rowrep['make']?>" <?=(($rowcon4>0)&&($infocon4['make']!=''))?(($infocon4['make']==$rowrep['make'])?"selected":""):(($rowxl['make']==$rowrep['make'])?"selected":"")?>><?=$rowrep['make']?></option>
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
	<input type="hidden" name="make" id="make" value="<?=($rowcon4>0)?$infocon4['make']:''?>">
	<?php
}
if($infolayoutservice['capacity']=='1')
{
?> 
  <div class="row mb-1">
     <div class="col-6">
      <label for="capacity" class="col-form-label">Capacity / DC V<?php if($infolayoutservice['capacityreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <select class="form-control" id="capacity" name="capacity"  <?=($infolayoutservice['capacityreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT distinct capacity From jrcxl where capacity!='' order by capacity asc";
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
<option value="<?=$rowrep['capacity']?>" <?=(($rowcon4>0)&&($infocon4['capacity']!=''))?(($infocon4['capacity']==$rowrep['capacity'])?"selected":""):(($rowxl['capacity']==$rowrep['capacity'])?"selected":"")?>><?=$rowrep['capacity']?></option>
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
	<input type="hidden" name="capacity" id="capacity" value="<?=($rowcon4>0)?$infocon4['capacity']:''?>">
	<?php
}
if($infolayoutservice['mfgcode']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="mfgcode" class="col-form-label">MFG Code<?php if($infolayoutservice['mfgcodereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="mfgcode" id="mfgcode" value="<?=($rowcon4>0)?$infocon4['mfgcode']:''?>" <?=($infolayoutservice['mfgcodereq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="mfgcode" id="mfgcode" value="<?=($rowcon4>0)?$infocon4['mfgcode']:''?>">
	<?php
}
?>
 <hr>
<?php
if($rowselect['businesstype']=='SOLAR')
{
if($infolayoutservice['producttype']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="producttype" class="col-form-label">Product Type<?php if($infolayoutservice['producttypereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="producttype" id="producttype" value="<?=($rowcon4>0)?$infocon4['producttype']:''?>" <?=($infolayoutservice['producttypereq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="producttype" id="producttype" value="<?=($rowcon4>0)?$infocon4['producttype']:''?>">
	<?php
}
if($infolayoutservice['pvmake']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="pvmake" class="col-form-label">PV Panel Make<?php if($infolayoutservice['pvmakereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="pvmake" id="pvmake" value="<?=($rowcon4>0)?$infocon4['pvmake']:''?>" <?=($infolayoutservice['pvmakereq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="pvmake" id="pvmake" value="<?=($rowcon4>0)?$infocon4['pvmake']:''?>">
	<?php
}
if($infolayoutservice['pvtype']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="pvtype" class="col-form-label">PV Panel Type<?php if($infolayoutservice['pvtypereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="pvtype" id="pvtype" value="<?=($rowcon4>0)?$infocon4['pvtype']:''?>" <?=($infolayoutservice['pvtypereq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="pvtype" id="pvtype" value="<?=($rowcon4>0)?$infocon4['pvtype']:''?>">
	<?php
}
if($infolayoutservice['pvcapacity']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="pvcapacity" class="col-form-label">PV Panel Capacity<?php if($infolayoutservice['pvcapacityreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="pvcapacity" id="pvcapacity" value="<?=($rowcon4>0)?$infocon4['pvcapacity']:''?>" <?=($infolayoutservice['pvcapacityreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="pvcapacity" id="pvcapacity" value="<?=($rowcon4>0)?$infocon4['pvcapacity']:''?>">
	<?php
}
if($infolayoutservice['pvqty']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="pvqty" class="col-form-label">PV Panel Qty<?php if($infolayoutservice['pvqtyreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="pvqty" id="pvqty" value="<?=($rowcon4>0)?$infocon4['pvqty']:''?>" <?=($infolayoutservice['pvqtyreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="pvqty" id="pvqty" value="<?=($rowcon4>0)?$infocon4['pvqty']:''?>">
	<?php
}
if($infolayoutservice['pvslno']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="pvslno" class="col-form-label">PV Panel SL No<?php if($infolayoutservice['pvslnoreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="pvslno" id="pvslno" value="<?=($rowcon4>0)?$infocon4['pvslno']:''?>" <?=($infolayoutservice['pvslnoreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="pvslno" id="pvslno" value="<?=($rowcon4>0)?$infocon4['pvslno']:''?>">
	<?php
}
if($infolayoutservice['ntmake']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="ntmake" class="col-form-label">Net Meter Make<?php if($infolayoutservice['ntmakereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="ntmake" id="ntmake" value="<?=($rowcon4>0)?$infocon4['ntmake']:''?>" <?=($infolayoutservice['ntmakereq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="ntmake" id="ntmake" value="<?=($rowcon4>0)?$infocon4['ntmake']:''?>">
	<?php
}
if($infolayoutservice['nttype']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="nttype" class="col-form-label">Net Meter Type<?php if($infolayoutservice['nttypereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="nttype" id="nttype" value="<?=($rowcon4>0)?$infocon4['nttype']:''?>" <?=($infolayoutservice['nttypereq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="nttype" id="nttype" value="<?=($rowcon4>0)?$infocon4['nttype']:''?>">
	<?php
}
if($infolayoutservice['ntcapacity']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="ntcapacity" class="col-form-label">Net Meter Capacity</label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="ntcapacity" id="ntcapacity" value="<?=($rowcon4>0)?$infocon4['ntcapacity']:''?>" <?=($infolayoutservice['ntcapacityreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="ntcapacity" id="ntcapacity" value="<?=($rowcon4>0)?$infocon4['ntcapacity']:''?>">
	<?php
}
if($infolayoutservice['ntqty']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="ntqty" class="col-form-label">Net Meter Qty<?php if($infolayoutservice['ntqtyreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="ntqty" id="ntqty" value="<?=($rowcon4>0)?$infocon4['ntqty']:''?>" <?=($infolayoutservice['ntqtyreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="ntqty" id="ntqty" value="<?=($rowcon4>0)?$infocon4['ntqty']:''?>">
	<?php
}
if($infolayoutservice['ntslno']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="ntslno" class="col-form-label">Net Meter SL No<?php if($infolayoutservice['ntslnoreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="ntslno" id="ntslno" value="<?=($rowcon4>0)?$infocon4['ntslno']:''?>" <?=($infolayoutservice['ntslnoreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="ntslno" id="ntslno" value="<?=($rowcon4>0)?$infocon4['ntslno']:''?>">
	<?php
}
if($infolayoutservice['shadow']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Shadow Free Area<?php if($infolayoutservice['shadowreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="shadow" id="shadow" value="1" <?=($rowcon4>0)?(($infocon4['shadow']=='1')?'checked':''):''?> <?=($infolayoutservice['shadowreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="shadow" id="shadow" value="0" <?=($rowcon4>0)?(($infocon4['shadow']=='0')?'checked':''):''?> <?=($infolayoutservice['shadowreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="shadow" id="shadow" value="<?=($rowcon4>0)?$infocon4['shadow']:''?>">
	<?php
}
if($infolayoutservice['noofplstr']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="noofplstr" class="col-form-label">No of Panel in String<?php if($infolayoutservice['noofplstrreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="noofplstr" id="noofplstr" value="<?=($rowcon4>0)?$infocon4['noofplstr']:''?>" <?=($infolayoutservice['noofplstrreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="noofplstr" id="noofplstr" value="<?=($rowcon4>0)?$infocon4['noofplstr']:''?>">
	<?php
}
if($infolayoutservice['noofstr']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="noofstr" class="col-form-label">No of Strings<?php if($infolayoutservice['noofstrreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="noofstr" id="noofstr" value="<?=($rowcon4>0)?$infocon4['noofstr']:''?>" <?=($infolayoutservice['noofstrreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="noofstr" id="noofstr" value="<?=($rowcon4>0)?$infocon4['noofstr']:''?>">
	<?php
}
if($infolayoutservice['tilt']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="tilt" class="col-form-label">Tilt Angle<?php if($infolayoutservice['tiltreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="tilt" id="tilt" value="<?=($rowcon4>0)?$infocon4['tilt']:''?>" <?=($infolayoutservice['tiltreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="tilt" id="tilt" value="<?=($rowcon4>0)?$infocon4['tilt']:''?>">
	<?php
}
if($infolayoutservice['plposter']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plposter" class="col-form-label">Panel Position<?php if($infolayoutservice['plposterreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plposter" id="plposter" value="<?=($rowcon4>0)?$infocon4['plposter']:''?>" <?=($infolayoutservice['plposterreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plposter" id="plposter" value="<?=($rowcon4>0)?$infocon4['plposter']:''?>">
	<?php
}
if($infolayoutservice['civil']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Civil Structure<?php if($infolayoutservice['civilreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="civil" id="civil" value="1" <?=($rowcon4>0)?(($infocon4['civil']=='1')?'checked':''):''?> <?=($infolayoutservice['civilreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="civil" id="civil" value="0" <?=($rowcon4>0)?(($infocon4['civil']=='0')?'checked':''):''?> <?=($infolayoutservice['civilreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="civil" id="civil" value="<?=($rowcon4>0)?$infocon4['civil']:''?>">
	<?php
}
if($infolayoutservice['mechanical']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Mechanical Structure<?php if($infolayoutservice['mechanicalreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="mechanical" id="mechanical" value="1" <?=($rowcon4>0)?(($infocon4['mechanical']=='1')?'checked':''):''?> <?=($infolayoutservice['mechanicalreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="mechanical" id="mechanical" value="0" <?=($rowcon4>0)?(($infocon4['mechanical']=='0')?'checked':''):''?> <?=($infolayoutservice['mechanicalreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="mechanical" id="mechanical" value="<?=($rowcon4>0)?$infocon4['mechanical']:''?>">
	<?php
}
if($infolayoutservice['elecwiring']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Electrical Wiring<?php if($infolayoutservice['elecwiringreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="elecwiring" id="elecwiring" value="1" <?=($rowcon4>0)?(($infocon4['elecwiring']=='1')?'checked':''):''?> <?=($infolayoutservice['elecwiringreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="elecwiring" id="elecwiring" value="0" <?=($rowcon4>0)?(($infocon4['elecwiring']=='0')?'checked':''):''?> <?=($infolayoutservice['elecwiringreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="elecwiring" id="elecwiring" value="<?=($rowcon4>0)?$infocon4['elecwiring']:''?>">
	<?php
}
if($infolayoutservice['acearth']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">AC Earthing<?php if($infolayoutservice['acearthreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="acearth" id="acearth" value="1" <?=($rowcon4>0)?(($infocon4['acearth']=='1')?'checked':''):''?> <?=($infolayoutservice['acearthreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="acearth" id="acearth" value="0" <?=($rowcon4>0)?(($infocon4['acearth']=='0')?'checked':''):''?> <?=($infolayoutservice['acearthreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="acearth" id="acearth" value="<?=($rowcon4>0)?$infocon4['acearth']:''?>">
	<?php
}
if($infolayoutservice['dcearth']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">DC Earthing<?php if($infolayoutservice['dcearthreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="dcearth" id="dcearth" value="1" <?=($rowcon4>0)?(($infocon4['dcearth']=='1')?'checked':''):''?> <?=($infolayoutservice['dcearthreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="dcearth" id="dcearth" value="0" <?=($rowcon4>0)?(($infocon4['dcearth']=='0')?'checked':''):''?> <?=($infolayoutservice['dcearthreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="dcearth" id="dcearth" value="<?=($rowcon4>0)?$infocon4['dcearth']:''?>">
	<?php
}
if($infolayoutservice['laearth']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">LA Earthing<?php if($infolayoutservice['laearthreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="laearth" id="laearth" value="1" <?=($rowcon4>0)?(($infocon4['laearth']=='1')?'checked':''):''?> <?=($infolayoutservice['laearthreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="laearth" id="laearth" value="0" <?=($rowcon4>0)?(($infocon4['laearth']=='0')?'checked':''):''?> <?=($infolayoutservice['laearthreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="laearth" id="laearth" value="<?=($rowcon4>0)?$infocon4['laearth']:''?>">
	<?php
}
if($infolayoutservice['spvvol']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="spvvol" class="col-form-label">SPV Charging Voltage<?php if($infolayoutservice['spvvolreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="spvvol" id="spvvol" value="<?=($rowcon4>0)?$infocon4['spvvol']:''?>" <?=($infolayoutservice['spvvolreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="spvvol" id="spvvol" value="<?=($rowcon4>0)?$infocon4['spvvol']:''?>">
	<?php
}
if($infolayoutservice['spvcur']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="spvcur" class="col-form-label">SPV Charging Current<?php if($infolayoutservice['spvcurreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="spvcur" id="spvcur" value="<?=($rowcon4>0)?$infocon4['spvcur']:''?>" <?=($infolayoutservice['spvcurreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="spvcur" id="spvcur" value="<?=($rowcon4>0)?$infocon4['spvcur']:''?>">
	<?php
}
if($infolayoutservice['plvoc']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plvoc" class="col-form-label">Panel VOC (String)<?php if($infolayoutservice['plvocreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plvoc" id="plvoc" value="<?=($rowcon4>0)?$infocon4['plvoc']:''?>" <?=($infolayoutservice['plvocreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plvoc" id="plvoc" value="<?=($rowcon4>0)?$infocon4['plvoc']:''?>">
	<?php
}
if($infolayoutservice['plcell']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plcell" class="col-form-label">Panel Cells<?php if($infolayoutservice['plcellreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plcell" id="plcell" value="<?=($rowcon4>0)?$infocon4['plcell']:''?>" <?=($infolayoutservice['plcellreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plcell" id="plcell" value="<?=($rowcon4>0)?$infocon4['plcell']:''?>">
	<?php
}
if($infolayoutservice['plseries']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plseries" class="col-form-label">Panel String in Series<?php if($infolayoutservice['plseriesreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plseries" id="plseries" value="<?=($rowcon4>0)?$infocon4['plseries']:''?>" <?=($infolayoutservice['plseriesreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plseries" id="plseries" value="<?=($rowcon4>0)?$infocon4['plseries']:''?>">
	<?php
}
if($infolayoutservice['plparallel']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plparallel" class="col-form-label">Panel String in Parallel<?php if($infolayoutservice['plparallelreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plparallel" id="plparallel" value="<?=($rowcon4>0)?$infocon4['plparallel']:''?>" <?=($infolayoutservice['plparallelreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plparallel" id="plparallel" value="<?=($rowcon4>0)?$infocon4['plparallel']:''?>">
	<?php
}
if($infolayoutservice['plvol']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plvol" class="col-form-label">Panel Voltage at SPV Chg. ON<?php if($infolayoutservice['plvocreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plvol" id="plvol" value="<?=($rowcon4>0)?$infocon4['plvol']:''?>" <?=($infolayoutservice['plvolreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plvol" id="plvol" value="<?=($rowcon4>0)?$infocon4['plvol']:''?>">
	<?php
}
if($infolayoutservice['plangel']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plangel" class="col-form-label">Panel Angle and direction</label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plangel" id="plangel" value="<?=($rowcon4>0)?$infocon4['plangel']:''?>" <?=($infolayoutservice['plangelreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plangel" id="plangel" value="<?=($rowcon4>0)?$infocon4['plangel']:''?>">
	<?php
}
if($infolayoutservice['plpower']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="plpower" class="col-form-label">Panel Power<?php if($infolayoutservice['plpowerreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="plpower" id="plpower" value="<?=($rowcon4>0)?$infocon4['plpower']:''?>" <?=($infolayoutservice['plpowerreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="plpower" id="plpower" value="<?=($rowcon4>0)?$infocon4['plpower']:''?>">
	<?php
}
if($infolayoutservice['pltime']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="pltime" class="col-form-label">Time<?php if($infolayoutservice['pltimereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="pltime" id="pltime" value="<?=($rowcon4>0)?$infocon4['pltime']:''?>" <?=($infolayoutservice['pltimereq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="pltime" id="pltime" value="<?=($rowcon4>0)?$infocon4['pltime']:''?>">
	<?php
}
if($infolayoutservice['avgloadnight']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="avgloadnight" class="col-form-label">Average Load (night)<?php if($infolayoutservice['avgloadnightreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="avgloadnight" id="avgloadnight" value="<?=($rowcon4>0)?$infocon4['avgloadnight']:''?>" <?=($infolayoutservice['avgloadnightreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="avgloadnight" id="avgloadnight" value="<?=($rowcon4>0)?$infocon4['avgloadnight']:''?>">
	<?php
}
if($infolayoutservice['avgloadday']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="avgloadday" class="col-form-label">Average Load (day)<?php if($infolayoutservice['avgloaddayreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="avgloadday" id="avgloadday" value="<?=($rowcon4>0)?$infocon4['avgloadday']:''?>" <?=($infolayoutservice['avgloaddayreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="avgloadday" id="avgloadday" value="<?=($rowcon4>0)?$infocon4['avgloadday']:''?>">
	<?php
}
if($infolayoutservice['totalload']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-6">
      <label for="totalload" class="col-form-label">Total Load<?php if($infolayoutservice['totalloadreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="totalload" id="totalload" value="<?=($rowcon4>0)?$infocon4['totalload']:''?>" <?=($infolayoutservice['totalloadreq']=='1')?'required':''?>>
    </div>
  </div>  
  <?php
}
else
{
	?>
	<input type="hidden" name="totalload" id="totalload" value="<?=($rowcon4>0)?$infocon4['totalload']:''?>">
	<?php
}
}
if($rowselect['businesstype']=='COMPUTERS')
{
if($infolayoutservice['inputsupply']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Input Supply<?php if($infolayoutservice['inputsupplyreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="inputsupply" id="inputsupply" value="1" <?=($rowcon4>0)?(($infocon4['inputsupply']=='1')?'checked':''):''?> <?=($infolayoutservice['inputsupplyreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="inputsupply" id="inputsupply" value="0" <?=($rowcon4>0)?(($infocon4['inputsupply']=='0')?'checked':''):''?> <?=($infolayoutservice['inputsupplyreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="inputsupply" id="inputsupply" value="<?=($rowcon4>0)?$infocon4['inputsupply']:''?>">
	<?php
}
if($infolayoutservice['dvstfree']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Dust Free<?php if($infolayoutservice['dvstfreereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="dvstfree" id="dvstfree" value="1" <?=($rowcon4>0)?(($infocon4['dvstfree']=='1')?'checked':''):''?> <?=($infolayoutservice['dvstfreereq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="dvstfree" id="dvstfree" value="0" <?=($rowcon4>0)?(($infocon4['dvstfree']=='0')?'checked':''):''?> <?=($infolayoutservice['dvstfreereq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="dvstfree" id="dvstfree" value="<?=($rowcon4>0)?$infocon4['dvstfree']:''?>">
	<?php
}
if($infolayoutservice['earthingcheck']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Earthing<?php if($infolayoutservice['earthingcheckreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="earthingcheck" id="earthingcheck" value="1" <?=($rowcon4>0)?(($infocon4['earthingcheck']=='1')?'checked':''):''?> <?=($infolayoutservice['earthingcheckreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="earthingcheck" id="earthingcheck" value="0" <?=($rowcon4>0)?(($infocon4['earthingcheck']=='0')?'checked':''):''?> <?=($infolayoutservice['earthingcheckreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="earthingcheck" id="earthingcheck" value="<?=($rowcon4>0)?$infocon4['earthingcheck']:''?>">
	<?php
}
if($infolayoutservice['upsavailability']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">UPS Availability<?php if($infolayoutservice['upsavailabilityreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="upsavailability" id="upsavailability" value="1" <?=($rowcon4>0)?(($infocon4['upsavailability']=='1')?'checked':''):''?> <?=($infolayoutservice['upsavailabilityreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="upsavailability" id="upsavailability" value="0" <?=($rowcon4>0)?(($infocon4['upsavailability']=='0')?'checked':''):''?> <?=($infolayoutservice['upsavailabilityreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="upsavailability" id="upsavailability" value="<?=($rowcon4>0)?$infocon4['upsavailability']:''?>">
	<?php
}
if($infolayoutservice['airconditioned']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Air Conditioned<?php if($infolayoutservice['airconditionedreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="airconditioned" id="airconditioned" value="1" <?=($rowcon4>0)?(($infocon4['airconditioned']=='1')?'checked':''):''?> <?=($infolayoutservice['airconditionedreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="airconditioned" id="airconditioned" value="0" <?=($rowcon4>0)?(($infocon4['airconditioned']=='0')?'checked':''):''?> <?=($infolayoutservice['airconditionedreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="airconditioned" id="airconditioned" value="<?=($rowcon4>0)?$infocon4['airconditioned']:''?>">
	<?php
}
if($infolayoutservice['inputvoltage']=='1')
{
?>
<div class="row mb-1">
     <div class="col-6">
      <label for="inputvoltage" class="col-form-label">Input Voltage<?php if($infolayoutservice['inputvoltagereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="number" class="form-control" name="inputvoltage" id="inputvoltage" value="<?=($rowcon4>0)?$infocon4['inputvoltage']:''?>" <?=($infolayoutservice['inputvoltagereq']=='1')?'required':''?> >
    </div>
  </div>    
 <?php
}
else
{
	?>
	<input type="hidden" name="inputvoltage" id="inputvoltage" value="<?=($rowcon4>0)?$infocon4['inputvoltage']:''?>">
	<?php
}
if($infolayoutservice['earthleakage']=='1')
{
?>
<div class="row mb-1">
     <div class="col-6">
      <label for="earthleakage" class="col-form-label">Earth Leakage<?php if($infolayoutservice['earthleakagereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="number" class="form-control" name="earthleakage" id="earthleakage" value="<?=($rowcon4>0)?$infocon4['earthleakage']:''?>" <?=($infolayoutservice['earthleakagereq']=='1')?'required':''?> >
    </div>
  </div>    
 <?php
}
else
{
	?>
	<input type="hidden" name="earthleakage" id="earthleakage" value="<?=($rowcon4>0)?$infocon4['earthleakage']:''?>">
	<?php
}
if($infolayoutservice['cleaning']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Cleaning<?php if($infolayoutservice['cleaningreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="cleaning" id="cleaning" value="1" <?=($rowcon4>0)?(($infocon4['cleaning']=='1')?'checked':''):''?> <?=($infolayoutservice['cleaningreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="cleaning" id="cleaning" value="0" <?=($rowcon4>0)?(($infocon4['cleaning']=='0')?'checked':''):''?> <?=($infolayoutservice['cleaningreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="cleaning" id="cleaning" value="<?=($rowcon4>0)?$infocon4['cleaning']:''?>">
	<?php
}
if($infolayoutservice['softwarecheck']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Software Check<?php if($infolayoutservice['softwarecheckreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="softwarecheck" id="softwarecheck" value="1" <?=($rowcon4>0)?(($infocon4['softwarecheck']=='1')?'checked':''):''?> <?=($infolayoutservice['softwarecheckreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="softwarecheck" id="softwarecheck" value="0" <?=($rowcon4>0)?(($infocon4['softwarecheck']=='0')?'checked':''):''?> <?=($infolayoutservice['softwarecheckreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="softwarecheck" id="softwarecheck" value="<?=($rowcon4>0)?$infocon4['softwarecheck']:''?>">
	<?php
}
if($infolayoutservice['antiviruscheck']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Antivirus Check<?php if($infolayoutservice['antiviruscheckreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="antiviruscheck" id="antiviruscheck" value="1" <?=($rowcon4>0)?(($infocon4['antiviruscheck']=='1')?'checked':''):''?> <?=($infolayoutservice['antiviruscheckreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="antiviruscheck" id="antiviruscheck" value="0" <?=($rowcon4>0)?(($infocon4['antiviruscheck']=='0')?'checked':''):''?> <?=($infolayoutservice['antiviruscheckreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="antiviruscheck" id="antiviruscheck" value="<?=($rowcon4>0)?$infocon4['antiviruscheck']:''?>">
	<?php
}
if($infolayoutservice['looseconnection']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Loose Connection<?php if($infolayoutservice['looseconnectionreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="looseconnection" id="looseconnection" value="1" <?=($rowcon4>0)?(($infocon4['looseconnection']=='1')?'checked':''):''?> <?=($infolayoutservice['looseconnectionreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="looseconnection" id="looseconnection" value="0" <?=($rowcon4>0)?(($infocon4['looseconnection']=='0')?'checked':''):''?> <?=($infolayoutservice['looseconnectionreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="looseconnection" id="looseconnection" value="<?=($rowcon4>0)?$infocon4['looseconnection']:''?>">
	<?php
}
if($infolayoutservice['speedcheck']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Speed Check<?php if($infolayoutservice['speedcheckreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="speedcheck" id="speedcheck" value="1" <?=($rowcon4>0)?(($infocon4['speedcheck']=='1')?'checked':''):''?> <?=($infolayoutservice['speedcheckreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="speedcheck" id="speedcheck" value="0" <?=($rowcon4>0)?(($infocon4['speedcheck']=='0')?'checked':''):''?> <?=($infolayoutservice['speedcheckreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="speedcheck" id="speedcheck" value="<?=($rowcon4>0)?$infocon4['speedcheck']:''?>">
	<?php
}
if($infolayoutservice['tempfilecleaning']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Temp File Cleaning<?php if($infolayoutservice['tempfilecleaningreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="tempfilecleaning" id="tempfilecleaning" value="1" <?=($rowcon4>0)?(($infocon4['tempfilecleaning']=='1')?'checked':''):''?> <?=($infolayoutservice['tempfilecleaningreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="tempfilecleaning" id="tempfilecleaning" value="0" <?=($rowcon4>0)?(($infocon4['tempfilecleaning']=='0')?'checked':''):''?> <?=($infolayoutservice['tempfilecleaningreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="tempfilecleaning" id="tempfilecleaning" value="<?=($rowcon4>0)?$infocon4['tempfilecleaning']:''?>">
	<?php
}
if($infolayoutservice['hardwarecheck']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Hardward Check<?php if($infolayoutservice['hardwarecheckreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="hardwarecheck" id="hardwarecheck" value="1" <?=($rowcon4>0)?(($infocon4['hardwarecheck']=='1')?'checked':''):''?> <?=($infolayoutservice['hardwarecheckreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="hardwarecheck" id="hardwarecheck" value="0" <?=($rowcon4>0)?(($infocon4['hardwarecheck']=='0')?'checked':''):''?> <?=($infolayoutservice['hardwarecheckreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="hardwarecheck" id="hardwarecheck" value="<?=($rowcon4>0)?$infocon4['hardwarecheck']:''?>">
	<?php
}
if($infolayoutservice['printcheck']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Print Check<?php if($infolayoutservice['printcheckreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="printcheck" id="printcheck" value="1" <?=($rowcon4>0)?(($infocon4['printcheck']=='1')?'checked':''):''?> <?=($infolayoutservice['printcheckreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="printcheck" id="printcheck" value="0" <?=($rowcon4>0)?(($infocon4['printcheck']=='0')?'checked':''):''?> <?=($infolayoutservice['printcheckreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="printcheck" id="printcheck" value="<?=($rowcon4>0)?$infocon4['printcheck']:''?>">
	<?php
}
if($infolayoutservice['keyboard']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Keyboard<?php if($infolayoutservice['keyboardreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="keyboard" id="keyboard" value="1" <?=($rowcon4>0)?(($infocon4['keyboard']=='1')?'checked':''):''?> <?=($infolayoutservice['keyboardreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="keyboard" id="keyboard" value="0" <?=($rowcon4>0)?(($infocon4['keyboard']=='0')?'checked':''):''?> <?=($infolayoutservice['keyboardreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="keyboard" id="keyboard" value="<?=($rowcon4>0)?$infocon4['keyboard']:''?>">
	<?php
}
if($infolayoutservice['mouse']=='1')
{
?>
  <div class="row">
    <div class="col-6">
      <label for="voliry" class="col-form-label">Mouse<?php if($infolayoutservice['mousereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="mouse" id="mouse" value="1" <?=($rowcon4>0)?(($infocon4['mouse']=='1')?'checked':''):''?> <?=($infolayoutservice['mousereq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="mouse" id="mouse" value="0" <?=($rowcon4>0)?(($infocon4['mouse']=='0')?'checked':''):''?> <?=($infolayoutservice['mousereq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="mouse" id="mouse" value="<?=($rowcon4>0)?$infocon4['mouse']:''?>">
	<?php
}
}
else
{
	?>
	<input type="hidden" name="inputsupply" id="inputsupply" value="<?=($rowcon4>0)?$infocon4['inputsupply']:''?>">
<input type="hidden" name="dvstfree" id="dvstfree" value="<?=($rowcon4>0)?$infocon4['dvstfree']:''?>">
<input type="hidden" name="earthingcheck" id="earthingcheck" value="<?=($rowcon4>0)?$infocon4['earthingcheck']:''?>">
<input type="hidden" name="upsavailability" id="upsavailability" value="<?=($rowcon4>0)?$infocon4['upsavailability']:''?>">
<input type="hidden" name="airconditioned" id="airconditioned" value="<?=($rowcon4>0)?$infocon4['airconditioned']:''?>">
<input type="hidden" name="inputvoltage" id="inputvoltage" value="<?=($rowcon4>0)?$infocon4['inputvoltage']:''?>">
<input type="hidden" name="earthleakage" id="earthleakage" value="<?=($rowcon4>0)?$infocon4['earthleakage']:''?>">
<input type="hidden" name="cleaning" id="cleaning" value="<?=($rowcon4>0)?$infocon4['cleaning']:''?>">
<input type="hidden" name="softwarecheck" id="softwarecheck" value="<?=($rowcon4>0)?$infocon4['softwarecheck']:''?>">
<input type="hidden" name="antiviruscheck" id="antiviruscheck" value="<?=($rowcon4>0)?$infocon4['antiviruscheck']:''?>">
<input type="hidden" name="looseconnection" id="looseconnection" value="<?=($rowcon4>0)?$infocon4['looseconnection']:''?>">
<input type="hidden" name="speedcheck" id="speedcheck" value="<?=($rowcon4>0)?$infocon4['speedcheck']:''?>">
<input type="hidden" name="tempfilecleaning" id="tempfilecleaning" value="<?=($rowcon4>0)?$infocon4['tempfilecleaning']:''?>">
<input type="hidden" name="hardwarecheck" id="hardwarecheck" value="<?=($rowcon4>0)?$infocon4['hardwarecheck']:''?>">
<input type="hidden" name="printcheck" id="printcheck" value="<?=($rowcon4>0)?$infocon4['printcheck']:''?>">
<input type="hidden" name="keyboard" id="keyboard" value="<?=($rowcon4>0)?$infocon4['keyboard']:''?>">
<input type="hidden" name="mouse" id="mouse" value="<?=($rowcon4>0)?$infocon4['mouse']:''?>">
	<?php
}
if(($rowselect['businesstype']=='UPS BATTERY')||($rowselect['businesstype']=='SOLAR'))
{
if($infolayoutservice['batterymake']=='1')
{
?>
<div class="row mb-1">
     <div class="col-6">
      <label for="batterymake" class="col-form-label">Battery Make<?php if($infolayoutservice['batteryahreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="batterymake" id="batterymake" value="<?=($rowcon4>0)?$infocon4['batterymake']:''?>" <?=($infolayoutservice['batterymakereq']=='1')?'required':''?>>
    </div>
  </div>    
 <?php
}
else
{
	?>
	<input type="hidden" name="batterymake" id="batterymake" value="<?=($rowcon4>0)?$infocon4['batterymake']:''?>">
	<?php
}
if($infolayoutservice['batteryah']=='1')
{
?> 
  <div class="row mb-1">
     <div class="col-6">
      <label for="batteryah" class="col-form-label">Battery AH<?php if($infolayoutservice['batteryahreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="text" class="form-control" name="batteryah" id="batteryah" value="<?=($rowcon4>0)?$infocon4['batteryah']:''?>" <?=($infolayoutservice['batteryahreq']=='1')?'required':''?>>
    </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="batteryah" id="batteryah" value="<?=($rowcon4>0)?$infocon4['batteryah']:''?>">
	<?php
}
if($infolayoutservice['noofbattery']=='1')
{
?>
<div class="row mb-1">
     <div class="col-6">
      <label for="noofbattery" class="col-form-label">No. of Battery<?php if($infolayoutservice['noofbatteryreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="noofbattery" id="noofbattery" value="<?=($rowcon4>0)?$infocon4['noofbattery']:''?>" <?=($infolayoutservice['noofbatteryreq']=='1')?'required':''?>>
    </div>
  </div> 
<?php
}
else
{
	?>
	<input type="hidden" name="noofbattery" id="noofbattery" value="<?=($rowcon4>0)?$infocon4['noofbattery']:''?>">
	<?php
}
if($infolayoutservice['noofset']=='1')
{
?>
<div class="row mb-1">
     <div class="col-6">
      <label for="noofset" class="col-form-label">No. of Set<?php if($infolayoutservice['noofsetreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="noofset" id="noofset" value="<?=($rowcon4>0)?$infocon4['noofset']:''?>" <?=($infolayoutservice['noofsetreq']=='1')?'required':''?>>
    </div>
  </div>   
<?php
}
else
{
	?>
	<input type="hidden" name="noofset" id="noofset" value="<?=($rowcon4>0)?$infocon4['noofset']:''?>">
	<?php
}
}
else
{
	?>
	<input type="hidden" name="batterymake" id="batterymake" value="<?=($rowcon4>0)?$infocon4['batterymake']:''?>">
<input type="hidden" name="batteryah" id="batteryah" value="<?=($rowcon4>0)?$infocon4['batteryah']:''?>">
<input type="hidden" name="noofbattery" id="noofbattery" value="<?=($rowcon4>0)?$infocon4['noofbattery']:''?>">
<input type="hidden" name="noofset" id="noofset" value="<?=($rowcon4>0)?$infocon4['noofset']:''?>">
	<?php
}
if($rowselect['businesstype']=='UPS BATTERY')
{
?> 
<?php
if($infolayoutservice['verification']=='1')
{
?>
<h5 class="mb-2">Site Verification</h5>
  <div class="row">
    <div class="col-4">
      <label for="verification" class="col-form-label">Ventilation<?php if($infolayoutservice['verificationreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="verification" id="verification" value="1" <?=($rowcon4>0)?(($infocon4['verification']=='1')?'checked':''):''?> <?=($infolayoutservice['verificationreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="verification" id="verification" value="2" <?=($rowcon4>0)?(($infocon4['verification']=='2')?'checked':''):''?> <?=($infolayoutservice['verificationreq']=='1')?'required':''?>> Partial</label>
	 <label><input type="radio" name="verification" id="verification" value="0" <?=($rowcon4>0)?(($infocon4['verification']=='0')?'checked':''):''?> <?=($infolayoutservice['verificationreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="verification" id="verification" value="<?=($rowcon4>0)?$infocon4['verification']:''?>">
	<?php
}
if($infolayoutservice['directsunlight']=='1')
{
?>  
  <div class="row">
    <div class="col-4">
      <label for="directsunlight" class="col-form-label">Direct Sunlight<?php if($infolayoutservice['directsunlightreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="directsunlight" id="directsunlight" value="1" <?=($rowcon4>0)?(($infocon4['directsunlight']=='1')?'checked':''):''?> <?=($infolayoutservice['directsunlightreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="directsunlight" id="directsunlight" value="2" <?=($rowcon4>0)?(($infocon4['directsunlight']=='2')?'checked':''):''?> <?=($infolayoutservice['directsunlightreq']=='1')?'required':''?>> Partial</label>
	 <label><input type="radio" name="directsunlight" id="directsunlight" value="0" <?=($rowcon4>0)?(($infocon4['directsunlight']=='0')?'checked':''):''?> <?=($infolayoutservice['directsunlightreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="directsunlight" id="directsunlight" value="<?=($rowcon4>0)?$infocon4['directsunlight']:''?>">
	<?php
}
if($infolayoutservice['wiringready']=='1')
{
?> 
  <div class="row">
    <div class="col-4">
      <label for="wiringready" class="col-form-label">Wiring Ready<?php if($infolayoutservice['wiringreadyreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="wiringready" id="wiringready" value="1" <?=($rowcon4>0)?(($infocon4['wiringready']=='1')?'checked':''):''?> <?=($infolayoutservice['wiringreadyreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="wiringready" id="wiringready" value="0" <?=($rowcon4>0)?(($infocon4['wiringready']=='0')?'checked':''):''?> <?=($infolayoutservice['wiringreadyreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="wiringready" id="wiringready" value="<?=($rowcon4>0)?$infocon4['wiringready']:''?>">
	<?php
}
if($infolayoutservice['modificationwiring']=='1')
{
?>  
  <div class="row">
    <div class="col-4">
      <label for="modificationwiring" class="col-form-label">Modification on Wiring / Load<?php if($infolayoutservice['modificationwiringreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="modificationwiring" id="modificationwiring" value="1" <?=($rowcon4>0)?(($infocon4['modificationwiring']=='1')?'checked':''):''?> <?=($infolayoutservice['modificationwiringreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="modificationwiring" id="modificationwiring" value="0" <?=($rowcon4>0)?(($infocon4['modificationwiring']=='0')?'checked':''):''?> <?=($infolayoutservice['modificationwiringreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="modificationwiring" id="modificationwiring" value="<?=($rowcon4>0)?$infocon4['modificationwiring']:''?>">
	<?php
}
if($infolayoutservice['waterdripping']=='1')
{
?> 
    <div class="row">
    <div class="col-4">
      <label for="waterdripping" class="col-form-label">Rain/Cleaning Water Dripping<?php if($infolayoutservice['waterdrippingreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="waterdripping" id="waterdripping" value="1" <?=($rowcon4>0)?(($infocon4['waterdripping']=='1')?'checked':''):''?> <?=($infolayoutservice['waterdrippingreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="waterdripping" id="waterdripping" value="0" <?=($rowcon4>0)?(($infocon4['waterdripping']=='0')?'checked':''):''?> <?=($infolayoutservice['waterdrippingreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="waterdripping" id="waterdripping" value="<?=($rowcon4>0)?$infocon4['waterdripping']:''?>">
	<?php
}
if($infolayoutservice['coastelarea']=='1')
{
?>
<div class="row">
    <div class="col-4">
      <label for="coastelarea" class="col-form-label">Coastal Area<?php if($infolayoutservice['coastelareareq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="coastelarea" id="coastelarea" value="1" <?=($rowcon4>0)?(($infocon4['coastelarea']=='1')?'checked':''):''?> <?=($infolayoutservice['coastelareareq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="coastelarea" id="coastelarea" value="0" <?=($rowcon4>0)?(($infocon4['coastelarea']=='0')?'checked':''):''?> <?=($infolayoutservice['coastelareareq']=='1')?'required':''?>> No</label>
	</div>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="coastelarea" id="coastelarea" value="<?=($rowcon4>0)?$infocon4['coastelarea']:''?>">
	<?php
}
if($infolayoutservice['pollutionlevel']=='1')
{
?>
  <div class="row">
    <div class="col-4">
      <label for="pollutionlevel" class="col-form-label">Pollution Level<?php if($infolayoutservice['pollutionlevelreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="pollutionlevel" id="pollutionlevel" value="1" <?=($rowcon4>0)?(($infocon4['pollutionlevel']=='1')?'checked':''):''?> <?=($infolayoutservice['pollutionlevelreq']=='1')?'required':''?>> High</label>
	 <label><input type="radio" name="pollutionlevel" id="pollutionlevel" value="2" <?=($rowcon4>0)?(($infocon4['pollutionlevel']=='2')?'checked':''):''?> <?=($infolayoutservice['pollutionlevelreq']=='1')?'required':''?>> Medium</label>
	 <label><input type="radio" name="pollutionlevel" id="pollutionlevel" value="0" <?=($rowcon4>0)?(($infocon4['pollutionlevel']=='0')?'checked':''):''?> <?=($infolayoutservice['pollutionlevelreq']=='1')?'required':''?>> Low</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="pollutionlevel" id="pollutionlevel" value="<?=($rowcon4>0)?$infocon4['pollutionlevel']:''?>">
	<?php
}
if($infolayoutservice['moisture']=='1')
{
?> 
   <div class="row">
    <div class="col-4">
      <label for="moisture" class="col-form-label">Moisture<?php if($infolayoutservice['moisturereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="moisture" id="moisture" value="1" <?=($rowcon4>0)?(($infocon4['moisture']=='1')?'checked':''):''?> <?=($infolayoutservice['moisturereq']=='1')?'required':''?>> High</label>
	 <label><input type="radio" name="moisture" id="moisture" value="2" <?=($rowcon4>0)?(($infocon4['moisture']=='2')?'checked':''):''?> <?=($infolayoutservice['moisturereq']=='1')?'required':''?>> Medium</label>
	 <label><input type="radio" name="moisture" id="moisture" value="0" <?=($rowcon4>0)?(($infocon4['moisture']=='0')?'checked':''):''?> <?=($infolayoutservice['moisturereq']=='1')?'required':''?>> Low</label>
	</div>
  </div>
<hr>
<?php
}
else
{
	?>
	<input type="hidden" name="moisture" id="moisture" value="<?=($rowcon4>0)?$infocon4['moisture']:''?>">
	<?php
}
}
if(($rowselect['businesstype']=='UPS BATTERY')||($rowselect['businesstype']=='SOLAR'))
{
if($infolayoutservice['acdata']=='1')
{
?>
  <h5 class="mb-2">AC Data</h5>
<div class="form-group">
    <label for="phasetype">Phase Type<?php if($infolayoutservice['phasereversereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
	   <select class="custom-select" name="phasetype" id="phasetype" onChange="phasechange()" <?=($infolayoutservice['acdatareq']=='1')?'required':''?>>
	  <option selected value="">Select</option>
	  <option value="31" <?=($rowcon4>0)?(($infocon4['phasetype']=='31')?'selected':''):''?>>3Φ Input / 1Φ Output</option>
	  <option value="33" <?=($rowcon4>0)?(($infocon4['phasetype']=='33')?'selected':''):''?>>3Φ Input / 3Φ Output</option>
	  <option value="11" <?=($rowcon4>0)?(($infocon4['phasetype']=='11')?'selected':''):''?>>1Φ Input / 1Φ Output</option>
	</select>
  </div>
  <div id="i3" class="mb-2" style="display:none">
  <h5 class="text-primary m-2 text-center">3Φ Input</h5>
  <h6 class="text-danger m-2 text-center">Voltage</h6>
  <div class="row mb-1">
    <div class="col-2">
      <label for="voliry" class="col-form-label">RY</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="voliry" id="voliry" value="<?=($rowcon4>0)?$infocon4['voliry']:''?>">
    </div>
	 <div class="col-2">
      <label for="volirn" class="col-form-label">RN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volirn" id="volirn" value="<?=($rowcon4>0)?$infocon4['volirn']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="voliyb" class="col-form-label">YB</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="voliyb" id="voliyb" value="<?=($rowcon4>0)?$infocon4['voliyb']:''?>">
    </div>
	<div class="col-2">
      <label for="volibn" class="col-form-label">BN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volibn" id="volibn" value="<?=($rowcon4>0)?$infocon4['volibn']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="volibr" class="col-form-label">BR</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volibr" id="volibr" value="<?=($rowcon4>0)?$infocon4['volibr']:''?>">
    </div>
	<div class="col-2">
      <label for="voliyn" class="col-form-label">YN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="voliyn" id="voliyn" value="<?=($rowcon4>0)?$infocon4['voliyn']:''?>">
    </div>
  </div>
  <div class="row mb-1">
	<div class="col-2">
	</div>
	<div class="col-4">
	</div>
    <div class="col-2">
      <label for="voline" class="col-form-label">NE</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="voline" id="voline" value="<?=($rowcon4>0)?$infocon4['voline']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col text-center">
      <h6 class="text-danger m-2">Current</h6>
    </div>
    <div class="col text-center">
      <h6 class="text-danger m-2">Frequency</h6>
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="curir" class="col-form-label">R</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curir" id="curir" value="<?=($rowcon4>0)?$infocon4['curir']:''?>">
    </div>
	<div class="col-2">
      <label for="freir" class="col-form-label">R</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freir" id="freir" value="<?=($rowcon4>0)?$infocon4['freir']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="curiy" class="col-form-label">Y</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curiy" id="curiy" value="<?=($rowcon4>0)?$infocon4['curiy']:''?>">
    </div>
	<div class="col-2">
      <label for="freiy" class="col-form-label">Y</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freiy" id="freiy" value="<?=($rowcon4>0)?$infocon4['freiy']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="curib" class="col-form-label">B</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curib" id="curib" value="<?=($rowcon4>0)?$infocon4['curib']:''?>">
    </div>
	<div class="col-2">
      <label for="freib" class="col-form-label">B</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freib" id="freib" value="<?=($rowcon4>0)?$infocon4['freib']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="curin" class="col-form-label">N</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curin" id="curin" value="<?=($rowcon4>0)?$infocon4['curin']:''?>">
    </div>
  </div>
 </div> 
 <div id="i1" class="mb-2" style="display:none">
  <h5 class="text-primary mt-4 text-center">1Φ Input</h5>
    <div class="row mb-1">
    <div class="col text-center">
      <h6 class="text-danger m-2">Voltage</h6>
    </div>
    <div class="col text-center">
      <h6 class="text-danger m-2">Current</h6>
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="volipn" class="col-form-label">PN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volipn" id="volipn" value="<?=($rowcon4>0)?$infocon4['volipn']:''?>">
    </div>
	<div class="col-2">
      <label for="curip" class="col-form-label">P</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curip" id="curip" value="<?=($rowcon4>0)?$infocon4['curip']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="volipe" class="col-form-label">PE</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volipe" id="volipe" value="<?=($rowcon4>0)?$infocon4['volipe']:''?>">
    </div>
	<div class="col-2">
      <label for="cur1in" class="col-form-label">N</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="cur1in" id="cur1in" value="<?=($rowcon4>0)?$infocon4['cur1in']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="vol1ine" class="col-form-label">NE</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="vol1ine" id="vol1ine" value="<?=($rowcon4>0)?$infocon4['vol1ine']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-6 text-center">
      <h6 class="text-danger m-2">Frequency</h6>
    </div>
    <div class="col-2">
      <label for="freip" class="col-form-label">P</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freip" id="freip" value="<?=($rowcon4>0)?$infocon4['freip']:''?>">
    </div>
  </div>
 </div> 
 <div id="o3" class="mb-2" style="display:none">
  <h5 class="text-primary m-2 text-center">3Φ Output</h5>
  <h6 class="text-danger m-2 text-center">Voltage</h6>
  <div class="row mb-1">
    <div class="col-2">
      <label for="volory" class="col-form-label">RY</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volory" id="volory" value="<?=($rowcon4>0)?$infocon4['volory']:''?>">
    </div>
	 <div class="col-2">
      <label for="volorn" class="col-form-label">RN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volorn" id="volorn" value="<?=($rowcon4>0)?$infocon4['volorn']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="voloyb" class="col-form-label">YB</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="voloyb" id="voloyb" value="<?=($rowcon4>0)?$infocon4['voloyb']:''?>">
    </div>
	<div class="col-2">
      <label for="volobn" class="col-form-label">BN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volobn" id="volobn" value="<?=($rowcon4>0)?$infocon4['volobn']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="volobr" class="col-form-label">BR</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volobr" id="volobr" value="<?=($rowcon4>0)?$infocon4['volobr']:''?>">
    </div>
	<div class="col-2">
      <label for="voloyn" class="col-form-label">YN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="voloyn" id="voloyn" value="<?=($rowcon4>0)?$infocon4['voloyn']:''?>">
    </div>
  </div>
  <div class="row mb-1">
	<div class="col-2">
	</div>
	<div class="col-4">
	</div>
    <div class="col-2">
      <label for="volone" class="col-form-label">NE</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volone" id="volone" value="<?=($rowcon4>0)?$infocon4['volone']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col text-center">
      <h6 class="text-danger m-2">Current</h6>
    </div>
    <div class="col text-center">
      <h6 class="text-danger m-2">Frequency</h6>
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="curor" class="col-form-label">R</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curor" id="curor" value="<?=($rowcon4>0)?$infocon4['curor']:''?>">
    </div>
	<div class="col-2">
      <label for="freor" class="col-form-label">R</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freor" id="freor" value="<?=($rowcon4>0)?$infocon4['freor']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="curoy" class="col-form-label">Y</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curoy" id="curoy" value="<?=($rowcon4>0)?$infocon4['curoy']:''?>">
    </div>
	<div class="col-2">
      <label for="freoy" class="col-form-label">Y</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freoy" id="freoy" value="<?=($rowcon4>0)?$infocon4['freoy']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="curob" class="col-form-label">B</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curob" id="curob" value="<?=($rowcon4>0)?$infocon4['curob']:''?>">
    </div>
	<div class="col-2">
      <label for="freob" class="col-form-label">B</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freob" id="freob" value="<?=($rowcon4>0)?$infocon4['freob']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="cur1on" class="col-form-label">N</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="cur1on" id="cur1on" value="<?=($rowcon4>0)?$infocon4['cur1on']:''?>">
    </div>
  </div>
 </div> 
 <div id="o1" class="mb-2" style="display:none">
  <h5 class="text-primary mt-4 text-center">1Φ Output</h5>
    <div class="row mb-1">
    <div class="col text-center">
      <h6 class="text-danger m-2">Voltage</h6>
    </div>
    <div class="col text-center">
      <h6 class="text-danger m-2">Current</h6>
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="volopn" class="col-form-label">PN</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volopn" id="volopn" value="<?=($rowcon4>0)?$infocon4['volopn']:''?>">
    </div>
	<div class="col-2">
      <label for="curop" class="col-form-label">P</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curop" id="curop" value="<?=($rowcon4>0)?$infocon4['curop']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="volope" class="col-form-label">PE</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="volope" id="volope" value="<?=($rowcon4>0)?$infocon4['volope']:''?>">
    </div>
	<div class="col-2">
      <label for="curon" class="col-form-label">N</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="curon" id="curon" value="<?=($rowcon4>0)?$infocon4['curon']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label for="vol1one" class="col-form-label">NE</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="vol1one" id="vol1one" value="<?=($rowcon4>0)?$infocon4['vol1one']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-6 text-center">
      <h6 class="text-danger m-2">Frequency</h6>
    </div>
    <div class="col-2">
      <label for="freop" class="col-form-label">P</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="freop" id="freop" value="<?=($rowcon4>0)?$infocon4['freop']:''?>">
    </div>
  </div>
 </div> 
 <?php
}
else
{
	?>
	<input type="hidden" name="phasetype" id="phasetype" value="<?=($rowcon4>0)?$infocon4['phasetype']:''?>">
	<input type="hidden" name="voliry" id="voliry" value="<?=($rowcon4>0)?$infocon4['voliry']:''?>">
	<input type="hidden" name="volirn" id="volirn" value="<?=($rowcon4>0)?$infocon4['volirn']:''?>">
	<input type="hidden" name="voliyb" id="voliyb" value="<?=($rowcon4>0)?$infocon4['voliyb']:''?>">
	<input type="hidden" name="volibn" id="volibn" value="<?=($rowcon4>0)?$infocon4['volibn']:''?>">
	<input type="hidden" name="volibr" id="volibr" value="<?=($rowcon4>0)?$infocon4['volibr']:''?>">
	<input type="hidden" name="voliyn" id="voliyn" value="<?=($rowcon4>0)?$infocon4['voliyn']:''?>">
	<input type="hidden" name="voline" id="voline" value="<?=($rowcon4>0)?$infocon4['voline']:''?>">
	<input type="hidden" name="curir" id="curir" value="<?=($rowcon4>0)?$infocon4['curir']:''?>">
	<input type="hidden" name="freir" id="freir" value="<?=($rowcon4>0)?$infocon4['freir']:''?>">
	<input type="hidden" name="curiy" id="curiy" value="<?=($rowcon4>0)?$infocon4['curiy']:''?>">
	<input type="hidden" name="freiy" id="freiy" value="<?=($rowcon4>0)?$infocon4['freiy']:''?>">
	<input type="hidden" name="curib" id="curib" value="<?=($rowcon4>0)?$infocon4['curib']:''?>">
	<input type="hidden" name="freib" id="freib" value="<?=($rowcon4>0)?$infocon4['freib']:''?>">
	<input type="hidden" name="curin" id="curin" value="<?=($rowcon4>0)?$infocon4['curin']:''?>">
	<input type="hidden" name="volipn" id="volipn" value="<?=($rowcon4>0)?$infocon4['volipn']:''?>">
	<input type="hidden" name="curip" id="curip" value="<?=($rowcon4>0)?$infocon4['curip']:''?>">
	<input type="hidden" name="volipe" id="volipe" value="<?=($rowcon4>0)?$infocon4['volipe']:''?>">
	<input type="hidden" name="cur1in" id="cur1in" value="<?=($rowcon4>0)?$infocon4['cur1in']:''?>">
	<input type="hidden" name="vol1ine" id="vol1ine" value="<?=($rowcon4>0)?$infocon4['vol1ine']:''?>">
	<input type="hidden" name="freip" id="freip" value="<?=($rowcon4>0)?$infocon4['freip']:''?>">
	<input type="hidden" name="volory" id="volory" value="<?=($rowcon4>0)?$infocon4['volory']:''?>">
	<input type="hidden" name="volorn" id="volorn" value="<?=($rowcon4>0)?$infocon4['volorn']:''?>">
	<input type="hidden" name="voloyb" id="voloyb" value="<?=($rowcon4>0)?$infocon4['voloyb']:''?>">
	<input type="hidden" name="volobn" id="volobn" value="<?=($rowcon4>0)?$infocon4['volobn']:''?>">
	<input type="hidden" name="volobr" id="volobr" value="<?=($rowcon4>0)?$infocon4['volobr']:''?>">
	<input type="hidden" name="voloyn" id="voloyn" value="<?=($rowcon4>0)?$infocon4['voloyn']:''?>">
	<input type="hidden" name="volone" id="volone" value="<?=($rowcon4>0)?$infocon4['volone']:''?>">
	<input type="hidden" name="curor" id="curor" value="<?=($rowcon4>0)?$infocon4['curor']:''?>">
	<input type="hidden" name="freor" id="freor" value="<?=($rowcon4>0)?$infocon4['freor']:''?>">
	<input type="hidden" name="curoy" id="curoy" value="<?=($rowcon4>0)?$infocon4['curoy']:''?>">
	<input type="hidden" name="freoy" id="freoy" value="<?=($rowcon4>0)?$infocon4['freoy']:''?>">
	<input type="hidden" name="curob" id="curob" value="<?=($rowcon4>0)?$infocon4['curob']:''?>">
	<input type="hidden" name="freob" id="freob" value="<?=($rowcon4>0)?$infocon4['freob']:''?>">
	<input type="hidden" name="cur1on" id="cur1on" value="<?=($rowcon4>0)?$infocon4['cur1on']:''?>">
	<input type="hidden" name="volopn" id="volopn" value="<?=($rowcon4>0)?$infocon4['volopn']:''?>">
	<input type="hidden" name="curop" id="curop" value="<?=($rowcon4>0)?$infocon4['curop']:''?>">
	<input type="hidden" name="volope" id="volope" value="<?=($rowcon4>0)?$infocon4['volope']:''?>">
	<input type="hidden" name="curon" id="curon" value="<?=($rowcon4>0)?$infocon4['curon']:''?>">
	<input type="hidden" name="vol1one" id="vol1one" value="<?=($rowcon4>0)?$infocon4['vol1one']:''?>">
	<input type="hidden" name="freop" id="freop" value="<?=($rowcon4>0)?$infocon4['freop']:''?>">
	<?php
}
}
else
{
	?>
	<input type="hidden" name="phasetype" id="phasetype" value="<?=($rowcon4>0)?$infocon4['phasetype']:''?>">
	<input type="hidden" name="voliry" id="voliry" value="<?=($rowcon4>0)?$infocon4['voliry']:''?>">
	<input type="hidden" name="volirn" id="volirn" value="<?=($rowcon4>0)?$infocon4['volirn']:''?>">
	<input type="hidden" name="voliyb" id="voliyb" value="<?=($rowcon4>0)?$infocon4['voliyb']:''?>">
	<input type="hidden" name="volibn" id="volibn" value="<?=($rowcon4>0)?$infocon4['volibn']:''?>">
	<input type="hidden" name="volibr" id="volibr" value="<?=($rowcon4>0)?$infocon4['volibr']:''?>">
	<input type="hidden" name="voliyn" id="voliyn" value="<?=($rowcon4>0)?$infocon4['voliyn']:''?>">
	<input type="hidden" name="voline" id="voline" value="<?=($rowcon4>0)?$infocon4['voline']:''?>">
	<input type="hidden" name="curir" id="curir" value="<?=($rowcon4>0)?$infocon4['curir']:''?>">
	<input type="hidden" name="freir" id="freir" value="<?=($rowcon4>0)?$infocon4['freir']:''?>">
	<input type="hidden" name="curiy" id="curiy" value="<?=($rowcon4>0)?$infocon4['curiy']:''?>">
	<input type="hidden" name="freiy" id="freiy" value="<?=($rowcon4>0)?$infocon4['freiy']:''?>">
	<input type="hidden" name="curib" id="curib" value="<?=($rowcon4>0)?$infocon4['curib']:''?>">
	<input type="hidden" name="freib" id="freib" value="<?=($rowcon4>0)?$infocon4['freib']:''?>">
	<input type="hidden" name="curin" id="curin" value="<?=($rowcon4>0)?$infocon4['curin']:''?>">
	<input type="hidden" name="volipn" id="volipn" value="<?=($rowcon4>0)?$infocon4['volipn']:''?>">
	<input type="hidden" name="curip" id="curip" value="<?=($rowcon4>0)?$infocon4['curip']:''?>">
	<input type="hidden" name="volipe" id="volipe" value="<?=($rowcon4>0)?$infocon4['volipe']:''?>">
	<input type="hidden" name="cur1in" id="cur1in" value="<?=($rowcon4>0)?$infocon4['cur1in']:''?>">
	<input type="hidden" name="vol1ine" id="vol1ine" value="<?=($rowcon4>0)?$infocon4['vol1ine']:''?>">
	<input type="hidden" name="freip" id="freip" value="<?=($rowcon4>0)?$infocon4['freip']:''?>">
	<input type="hidden" name="volory" id="volory" value="<?=($rowcon4>0)?$infocon4['volory']:''?>">
	<input type="hidden" name="volorn" id="volorn" value="<?=($rowcon4>0)?$infocon4['volorn']:''?>">
	<input type="hidden" name="voloyb" id="voloyb" value="<?=($rowcon4>0)?$infocon4['voloyb']:''?>">
	<input type="hidden" name="volobn" id="volobn" value="<?=($rowcon4>0)?$infocon4['volobn']:''?>">
	<input type="hidden" name="volobr" id="volobr" value="<?=($rowcon4>0)?$infocon4['volobr']:''?>">
	<input type="hidden" name="voloyn" id="voloyn" value="<?=($rowcon4>0)?$infocon4['voloyn']:''?>">
	<input type="hidden" name="volone" id="volone" value="<?=($rowcon4>0)?$infocon4['volone']:''?>">
	<input type="hidden" name="curor" id="curor" value="<?=($rowcon4>0)?$infocon4['curor']:''?>">
	<input type="hidden" name="freor" id="freor" value="<?=($rowcon4>0)?$infocon4['freor']:''?>">
	<input type="hidden" name="curoy" id="curoy" value="<?=($rowcon4>0)?$infocon4['curoy']:''?>">
	<input type="hidden" name="freoy" id="freoy" value="<?=($rowcon4>0)?$infocon4['freoy']:''?>">
	<input type="hidden" name="curob" id="curob" value="<?=($rowcon4>0)?$infocon4['curob']:''?>">
	<input type="hidden" name="freob" id="freob" value="<?=($rowcon4>0)?$infocon4['freob']:''?>">
	<input type="hidden" name="cur1on" id="cur1on" value="<?=($rowcon4>0)?$infocon4['cur1on']:''?>">
	<input type="hidden" name="volopn" id="volopn" value="<?=($rowcon4>0)?$infocon4['volopn']:''?>">
	<input type="hidden" name="curop" id="curop" value="<?=($rowcon4>0)?$infocon4['curop']:''?>">
	<input type="hidden" name="volope" id="volope" value="<?=($rowcon4>0)?$infocon4['volope']:''?>">
	<input type="hidden" name="curon" id="curon" value="<?=($rowcon4>0)?$infocon4['curon']:''?>">
	<input type="hidden" name="vol1one" id="vol1one" value="<?=($rowcon4>0)?$infocon4['vol1one']:''?>">
	<input type="hidden" name="freop" id="freop" value="<?=($rowcon4>0)?$infocon4['freop']:''?>">
	<?php
}
if(($rowselect['businesstype']=='UPS BATTERY'))
{
if($infolayoutservice['stabilizer']=='1')
{
?>
 <div class="row">
    <div class="col-4">
      <label for="voliry" class="col-form-label">Stabilizer<?php if($infolayoutservice['stabilizerreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="stabilizer" id="stabilizer" value="1" <?=($rowcon4>0)?(($infocon4['stabilizer']=='1')?'checked':''):''?> <?=($infolayoutservice['stabilizerreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="stabilizer" id="stabilizer" value="0" <?=($rowcon4>0)?(($infocon4['stabilizer']=='0')?'checked':''):''?> <?=($infolayoutservice['stabilizerreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="stabilizer" id="stabilizer" value="<?=($rowcon4>0)?$infocon4['stabilizer']:''?>">
	<?php
}
if($infolayoutservice['phasereverse']=='1')
{
?>
  <div class="row">
    <div class="col-4">
      <label for="voliry" class="col-form-label">Phase Reverse<?php if($infolayoutservice['phasereversereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="phasereverse" id="phasereverse" value="1" <?=($rowcon4>0)?(($infocon4['phasereverse']=='1')?'checked':''):''?> <?=($infolayoutservice['phasereversereq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="phasereverse" id="phasereverse" value="0" <?=($rowcon4>0)?(($infocon4['phasereverse']=='0')?'checked':''):''?> <?=($infolayoutservice['phasereversereq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="phasereverse" id="phasereverse" value="<?=($rowcon4>0)?$infocon4['phasereverse']:''?>">
	<?php
}
if($infolayoutservice['earthing']=='1')
{
?> 
  <div class="row">
    <div class="col-4">
      <label for="voliry" class="col-form-label">Earthing<?php if($infolayoutservice['earthingreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="earthing" id="earthing" value="1" <?=($rowcon4>0)?(($infocon4['earthing']=='1')?'checked':''):''?> <?=($infolayoutservice['earthingreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="earthing" id="earthing" value="0" <?=($rowcon4>0)?(($infocon4['earthing']=='0')?'checked':''):''?> <?=($infolayoutservice['earthingreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="earthing" id="earthing" value="<?=($rowcon4>0)?$infocon4['earthing']:''?>">
	<?php
}
if($infolayoutservice['overload']=='1')
{
?>
  <div class="row">
    <div class="col-4">
      <label for="voliry" class="col-form-label">Overload<?php if($infolayoutservice['overloadreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label>
    </div>
	<div class="col-8 mt-2">
	 <label><input type="radio" name="overload" id="overload" value="1" <?=($rowcon4>0)?(($infocon4['overload']=='1')?'checked':''):''?> <?=($infolayoutservice['overloadreq']=='1')?'required':''?>> Yes</label>
	 <label><input type="radio" name="overload" id="overload" value="0" <?=($rowcon4>0)?(($infocon4['overload']=='0')?'checked':''):''?> <?=($infolayoutservice['overloadreq']=='1')?'required':''?>> No</label>
	</div>
  </div>
 <hr>
 <?php
}
else
{
	?>
	<input type="hidden" name="overload" id="overload" value="<?=($rowcon4>0)?$infocon4['overload']:''?>">
	<?php
}
}
else
{
	?>
<input type="hidden" name="verification" id="verification" value="<?=($rowcon4>0)?$infocon4['verification']:''?>">
<input type="hidden" name="directsunlight" id="directsunlight" value="<?=($rowcon4>0)?$infocon4['directsunlight']:''?>">
<input type="hidden" name="wiringready" id="wiringready" value="<?=($rowcon4>0)?$infocon4['wiringready']:''?>">
<input type="hidden" name="modificationwiring" id="modificationwiring" value="<?=($rowcon4>0)?$infocon4['modificationwiring']:''?>">
<input type="hidden" name="waterdripping" id="waterdripping" value="<?=($rowcon4>0)?$infocon4['waterdripping']:''?>">
<input type="hidden" name="coastelarea" id="coastelarea" value="<?=($rowcon4>0)?$infocon4['coastelarea']:''?>">
<input type="hidden" name="pollutionlevel" id="pollutionlevel" value="<?=($rowcon4>0)?$infocon4['pollutionlevel']:''?>">
<input type="hidden" name="moisture" id="moisture" value="<?=($rowcon4>0)?$infocon4['moisture']:''?>">
<input type="hidden" name="stabilizer" id="stabilizer" value="<?=($rowcon4>0)?$infocon4['stabilizer']:''?>">
<input type="hidden" name="phasereverse" id="phasereverse" value="<?=($rowcon4>0)?$infocon4['phasereverse']:''?>">
<input type="hidden" name="earthing" id="earthing" value="<?=($rowcon4>0)?$infocon4['earthing']:''?>">
<input type="hidden" name="overload" id="overload" value="<?=($rowcon4>0)?$infocon4['overload']:''?>">
	<?php
}
if(($rowselect['businesstype']=='UPS BATTERY')||($rowselect['businesstype']=='SOLAR'))
{
if($infolayoutservice['dcdata']=='1')
{
?>
  <h5 class="mb-2">DC Data</h5>
  <div class="row mb-1">
    <div class="col-4">
    </div>
    <div class="col-4 text-center">
      <label for="chargingv" class="col-form-label">V</label>
    </div>
    <div class="col-4 text-center">
      <label for="chargingv" class="col-form-label">A</label>
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-4">
      <label for="chargingv" class="col-form-label">@ Charging</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="chargingv" id="chargingv" value="<?=($rowcon4>0)?$infocon4['chargingv']:''?>">
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="chargingo" id="chargingo" value="<?=($rowcon4>0)?$infocon4['chargingo']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-4">
      <label for="dischargingv" class="col-form-label">@ Discharging with Load</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="dischargingv" id="dischargingv" value="<?=($rowcon4>0)?$infocon4['dischargingv']:''?>">
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="dischargingo" id="dischargingo" value="<?=($rowcon4>0)?$infocon4['dischargingo']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-4">
      <label for="dischargingwv" class="col-form-label">@ Discharging without Load</label>
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="dischargingwv" id="dischargingwv" value="<?=($rowcon4>0)?$infocon4['dischargingwv']:''?>">
    </div>
    <div class="col-4">
      <input type="number" min="0" step="0.01" class="form-control" name="dischargingwo" id="dischargingwo" value="<?=($rowcon4>0)?$infocon4['dischargingwo']:''?>">
    </div>
  </div>
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="chargingv" id="chargingv" value="<?=($rowcon4>0)?$infocon4['chargingv']:''?>">
	<input type="hidden" name="chargingo" id="chargingo" value="<?=($rowcon4>0)?$infocon4['chargingo']:''?>">
	<input type="hidden" name="dischargingv" id="dischargingv" value="<?=($rowcon4>0)?$infocon4['dischargingv']:''?>">
	<input type="hidden" name="dischargingo" id="dischargingo" value="<?=($rowcon4>0)?$infocon4['dischargingo']:''?>">
	<input type="hidden" name="dischargingwv" id="dischargingwv" value="<?=($rowcon4>0)?$infocon4['dischargingwv']:''?>">
	<input type="hidden" name="dischargingwo" id="dischargingwo" value="<?=($rowcon4>0)?$infocon4['dischargingwo']:''?>">
	<?php
}
if($infolayoutservice['batterycondition']=='1')
{
?>
  <div class="form-group">
    <h5 class="mb-2"><label for="batterycondition">Battery Condition<?php if($infolayoutservice['batteryconditionreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <textarea class="form-control" name="batterycondition" id="batterycondition" <?=($infolayoutservice['batteryconditionreq']=='1')?'required':''?>><?=($rowcon4>0)?$infocon4['batterycondition']:''?></textarea>
  </div>
    <hr>
	<?php
}
else
{
	?>
	<input type="hidden" name="batterycondition" id="batterycondition" value="<?=($rowcon4>0)?$infocon4['batterycondition']:''?>">
	<?php
}
}
else
{
	?>
<input type="hidden" name="chargingv" id="chargingv" value="<?=($rowcon4>0)?$infocon4['chargingv']:''?>">
	<input type="hidden" name="chargingo" id="chargingo" value="<?=($rowcon4>0)?$infocon4['chargingo']:''?>">
	<input type="hidden" name="dischargingv" id="dischargingv" value="<?=($rowcon4>0)?$infocon4['dischargingv']:''?>">
	<input type="hidden" name="dischargingo" id="dischargingo" value="<?=($rowcon4>0)?$infocon4['dischargingo']:''?>">
	<input type="hidden" name="dischargingwv" id="dischargingwv" value="<?=($rowcon4>0)?$infocon4['dischargingwv']:''?>">
	<input type="hidden" name="dischargingwo" id="dischargingwo" value="<?=($rowcon4>0)?$infocon4['dischargingwo']:''?>">
<input type="hidden" name="batterycondition" id="batterycondition" value="<?=($rowcon4>0)?$infocon4['batterycondition']:''?>">
	<?php
}
if($rowselect['businesstype']=='AIR CONDITIONERS')
{
	if($infolayoutservice['technicaldetails']=='1')
	{
	?>
	 <div class="row mb-1">
    <div class="col-12 text-center ">
      <label class="col-form-label font-weight-bold">Technical Details</label>
    </div>
  </div>	
	<div class="row mb-1">
    <div class="col-6">
      <label for="airearthing" class="col-form-label">Earthing</label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="airearthing" id="airearthing" value="Ok" <?=($rowcon4>0)?(($infocon4['airearthing']=='Ok')?'checked':''):'checked'?> > Ok</label>
	 <label><input type="radio" name="airearthing" id="airearthing" value="Not Ok" <?=($rowcon4>0)?(($infocon4['airearthing']=='Not Ok')?'checked':''):''?> > Not Ok</label>
	</div>
	<div class="col-6">
      <label for="airstabilizer" class="col-form-label">Stabilizer</label>
    </div>
	<div class="col-6 mt-2">
	 <label><input type="radio" name="airstabilizer" id="airstabilizer" value="Ok" <?=($rowcon4>0)?(($infocon4['airstabilizer']=='Ok')?'checked':''):'checked'?> > Ok</label>
	 <label><input type="radio" name="airstabilizer" id="airstabilizer" value="Not Ok" <?=($rowcon4>0)?(($infocon4['airstabilizer']=='Not Ok')?'checked':''):''?> > Not Ok</label>
	</div>
	<div class="col-6">
      <label for="airtonnage" class="col-form-label">Tonnage / R.Size </label>
    </div>
	<div class="col-5 mt-2">
	 <label><input type="radio" name="airtonnage" id="airtonnage" value="Ok" <?=($rowcon4>0)?(($infocon4['airtonnage']=='Ok')?'checked':''):'checked'?> > Ok</label>
	 <label><input type="radio" name="airtonnage" id="airtonnage" value="Not Ok" <?=($rowcon4>0)?(($infocon4['airtonnage']=='Not Ok')?'checked':''):''?> > Not Ok</label>
	</div>
	<div class="col-6">
      <label class="col-form-label">I/P Voltage</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="airipvolt" id="airipvolt" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['airipvolt']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">&nbsp;&nbsp;V&nbsp;&nbsp;</span>
            </div>
     </div>
     </div>
	<div class="col-6">
      <label class="col-form-label">O/P Voltage</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="airopvolt" id="airopvolt" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['airopvolt']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">&nbsp;&nbsp;V&nbsp;&nbsp;</span>
            </div>
     </div>
     </div>
	<div class="col-6">
      <label class="col-form-label">Current Drawn</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="aircurrent" id="aircurrent" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['aircurrent']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">&nbsp;&nbsp;A&nbsp;&nbsp;</span>
            </div>
     </div>
     </div>
	<div class="col-6">
      <label class="col-form-label">Grill</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="airgril" id="airgril" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['airgril']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">&nbsp;°C&nbsp;</span>
            </div>
     </div>
     </div>
<div class="col-6">
      <label class="col-form-label">Room</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="airroom" id="airroom" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['airroom']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">&nbsp;°C&nbsp;</span>
            </div>
     </div>
     </div>
<div class="col-6">
      <label class="col-form-label">Ambient</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="airambient" id="airambient" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['airambient']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">&nbsp;°C&nbsp;</span>
            </div>
     </div>
     </div>
<div class="col-6">
      <label class="col-form-label">D.Pressure</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="airdpressure" id="airdpressure" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['airdpressure']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">PSI</span>
            </div>
     </div>
     </div>
<div class="col-6">
      <label class="col-form-label">S.Pressure</label>
    </div>
	<div class="col-6">
	<div class="input-group">
            <input type="number" name="airspressure" id="airspressure" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['airspressure']:''?>">
            <div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">PSI</span>
            </div>
     </div>
     </div>
<div class="col-6">
      <label class="col-form-label">Refrigerant Gas</label>
    </div>
    <div class="col-6">
	<div class="input-group">
            <input type="text" name="airothers" id="airothers" step="0.01" min="0" class="form-control" value="<?=($rowcon4>0)?$infocon4['airothers']:''?>">
            <!--div class="input-group-append">
                <span  class="input-group-text" style="height: 1.75rem;">KG</span>
            </div-->
     </div>
    </div>
  </div>
  <?php
}
}
else
{
	?>
	<input type="hidden" name="airearthing" id="airearthing" value="<?=($rowcon4>0)?$infocon4['airearthing']:''?>">
		<input type="hidden" name="airstabilizer" id="airstabilizer" value="<?=($rowcon4>0)?$infocon4['airstabilizer']:''?>">
		<input type="hidden" name="airtonnage" id="airtonnage" value="<?=($rowcon4>0)?$infocon4['airtonnage']:''?>">
		<input type="hidden" name="airipvolt" id="airipvolt" value="<?=($rowcon4>0)?$infocon4['airipvolt']:''?>">
		<input type="hidden" name="airopvolt" id="airopvolt" value="<?=($rowcon4>0)?$infocon4['airopvolt']:''?>">
		<input type="hidden" name="aircurrent" id="aircurrent" value="<?=($rowcon4>0)?$infocon4['aircurrent']:''?>">
		<input type="hidden" name="airgril" id="airgril" value="<?=($rowcon4>0)?$infocon4['airgril']:''?>">
		<input type="hidden" name="airroom" id="airroom" value="<?=($rowcon4>0)?$infocon4['airroom']:''?>">
		<input type="hidden" name="airdpressure" id="airdpressure" value="<?=($rowcon4>0)?$infocon4['airdpressure']:''?>">
		<input type="hidden" name="airspressure" id="airspressure" value="<?=($rowcon4>0)?$infocon4['airspressure']:''?>">
		<input type="hidden" name="airothers" id="airothers" value="<?=($rowcon4>0)?$infocon4['airothers']:''?>">
		<input type="hidden" name="airambient" id="airambient" value="<?=($rowcon4>0)?$infocon4['airambient']:''?>">
		<?php
}
?>
<hr>
<?php
if($rowselect['businesstype']=='COPIER')
{
	if($infolayoutservice['meterreading']=='1')
	{
	?>
	<h5 class="mb-2">Meter Reading</h5>
 <div class="row mb-1">
    <div class="col-12 text-center ">
      <label class="col-form-label font-weight-bold">Multi Function Printer (MFP)</label>
    </div>
  </div>	
	<div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label">B/W</label>
    </div>
	<div class="col-5">
      <label class="col-form-label">Copy Printer</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="mfpbwa4cpr" id="mfpbwa4cpr" value="<?=($rowcon4>0)?$infocon4['mfpbwa4cpr']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label"></label>
    </div>
	<div class="col-5">
      <label class="col-form-label">FAX</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="mfpbwa4fax" id="mfpbwa4fax" value="<?=($rowcon4>0)?$infocon4['mfpbwa4fax']:''?>">
    </div>
  </div>
    <div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label"></label>
    </div>
	<div class="col-5">
      <label class="col-form-label">Printer</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="mfpbwa4prp" id="mfpbwa4prp" value="<?=($rowcon4>0)?$infocon4['mfpbwa4prp']:''?>">
    </div>
  </div>
   <div class="row mb-1 mt-4">
    <div class="col-2">
      <label class="col-form-label">Colour</label>
    </div>
	<div class="col-5">
      <label class="col-form-label">Copy Printer</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="mfpclcpr" id="mfpclcpr" value="<?=($rowcon4>0)?$infocon4['mfpclcpr']:''?>">
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label"></label>
    </div>
	<div class="col-5">
      <label class="col-form-label">FAX</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="mfpclfax" id="mfpclfax" value="<?=($rowcon4>0)?$infocon4['mfpclfax']:''?>">
    </div>
  </div>
    <div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label"></label>
    </div>
	<div class="col-5">
      <label class="col-form-label">Printer</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="mfpclprp" id="mfpclprp" value="<?=($rowcon4>0)?$infocon4['mfpclprp']:''?>">
    </div>
  </div>
   <div class="row mb-1 mt-4">
    <div class="col-12 text-center ">
      <label class="col-form-label font-weight-bold">PRI-PORT</label>
    </div>
  </div>	
  <div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label"></label>
    </div>
	<div class="col-5">
      <label class="col-form-label">Master</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="priportmaster" id="priportmaster" value="<?=($rowcon4>0)?$infocon4['priportmaster']:''?>">
    </div>
  </div>
    <div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label"></label>
    </div>
	<div class="col-5">
      <label class="col-form-label">Copies</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="priportcopies" id="priportcopies" value="<?=($rowcon4>0)?$infocon4['priportcopies']:''?>">
    </div>
  </div>
  <div class="row mb-1 mt-4">
    <div class="col-12 text-center ">
      <label class="col-form-label font-weight-bold">TOTAL</label>
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-2">
      <label class="col-form-label"></label>
    </div>
	<div class="col-5">
      <label class="col-form-label">Total</label>
    </div>
    <div class="col-5">
      <input type="number" min="0" step="0.01" class="form-control" name="totalmeterreading" id="totalmeterreading" value="<?=($rowcon4>0)?$infocon4['totalmeterreading']:''?>">
    </div>
  </div>
	<?php
	}
	else
	{
		?>
		<input type="hidden" name="mfpbwa4cpr" id="mfpbwa4cpr" value="<?=($rowcon4>0)?$infocon4['mfpbwa4cpr']:''?>">
		<input type="hidden" name="mfpbwa4fax" id="mfpbwa4fax" value="<?=($rowcon4>0)?$infocon4['mfpbwa4fax']:''?>">
		<input type="hidden" name="mfpbwa4prp" id="mfpbwa4prp" value="<?=($rowcon4>0)?$infocon4['mfpbwa4prp']:''?>">
		<input type="hidden" name="mfpclcpr" id="mfpclcpr" value="<?=($rowcon4>0)?$infocon4['mfpclcpr']:''?>">
		<input type="hidden" name="mfpclfax" id="mfpclfax" value="<?=($rowcon4>0)?$infocon4['mfpclfax']:''?>">
		<input type="hidden" name="mfpclprp" id="mfpclprp" value="<?=($rowcon4>0)?$infocon4['mfpclprp']:''?>">
		<input type="hidden" name="priportmaster" id="priportmaster" value="<?=($rowcon4>0)?$infocon4['priportmaster']:''?>">
		<input type="hidden" name="priportcopies" id="priportcopies" value="<?=($rowcon4>0)?$infocon4['priportcopies']:''?>">
		<input type="hidden" name="totalmeterreading" id="totalmeterreading" value="<?=($rowcon4>0)?$infocon4['totalmeterreading']:''?>">
		<?php
	}		
}
else
	{
		?>
		<input type="hidden" name="mfpbwa4cpr" id="mfpbwa4cpr" value="<?=($rowcon4>0)?$infocon4['mfpbwa4cpr']:''?>">
		<input type="hidden" name="mfpbwa4fax" id="mfpbwa4fax" value="<?=($rowcon4>0)?$infocon4['mfpbwa4fax']:''?>">
		<input type="hidden" name="mfpbwa4prp" id="mfpbwa4prp" value="<?=($rowcon4>0)?$infocon4['mfpbwa4prp']:''?>">
		<input type="hidden" name="mfpclcpr" id="mfpclcpr" value="<?=($rowcon4>0)?$infocon4['mfpclcpr']:''?>">
		<input type="hidden" name="mfpclfax" id="mfpclfax" value="<?=($rowcon4>0)?$infocon4['mfpclfax']:''?>">
		<input type="hidden" name="mfpclprp" id="mfpclprp" value="<?=($rowcon4>0)?$infocon4['mfpclprp']:''?>">
		<input type="hidden" name="priportmaster" id="priportmaster" value="<?=($rowcon4>0)?$infocon4['priportmaster']:''?>">
		<input type="hidden" name="priportcopies" id="priportcopies" value="<?=($rowcon4>0)?$infocon4['priportcopies']:''?>">
		<input type="hidden" name="totalmeterreading" id="totalmeterreading" value="<?=($rowcon4>0)?$infocon4['totalmeterreading']:''?>">
		<?php
	}		
if($infolayoutservice['sparesused']=='1')
{
?>
	<h5 class="mb-2">Spares Used</h5>
	<div class="row mb-1">
    <div class="col-1">
      <label for="sparesused1" class="col-form-label">1</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesused1" id="sparesused1">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesused1']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesused1q" id="sparesused1q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesused1q']:''?>">
            <div class="input-group-append">
                <span  id="usedid1" name="usedid1" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesused2" class="col-form-label">2</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesused2" id="sparesused2">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesused2']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesused2q" id="sparesused2q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesused2q']:''?>">
            <div class="input-group-append">
                <span  id="usedid2" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesused3" class="col-form-label">3</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesused3" id="sparesused3">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesused3']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesused3q" id="sparesused3q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesused3q']:''?>">
            <div class="input-group-append">
                <span  id="usedid3" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesused4" class="col-form-label">4</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesused4" id="sparesused4">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesused4']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesused4q" id="sparesused4q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesused4q']:''?>">
            <div class="input-group-append">
                <span  id="usedid4" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesused5" class="col-form-label">5</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesused5" id="sparesused5">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesused5']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesused5q" id="sparesused5q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesused5q']:''?>">
            <div class="input-group-append">
                <span  id="usedid5" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="sparesused1" id="sparesused1" value="<?=($rowcon4>0)?$infocon4['sparesused1']:''?>">
	<input type="hidden" name="sparesused1q" id="sparesused1q" value="<?=($rowcon4>0)?$infocon4['sparesused1q']:''?>">
	<input type="hidden" name="sparesused2" id="sparesused2" value="<?=($rowcon4>0)?$infocon4['sparesused2']:''?>">
	<input type="hidden" name="sparesused2q" id="sparesused2q" value="<?=($rowcon4>0)?$infocon4['sparesused2q']:''?>">
	<input type="hidden" name="sparesused3" id="sparesused3" value="<?=($rowcon4>0)?$infocon4['sparesused3']:''?>">
	<input type="hidden" name="sparesused3q" id="sparesused3q" value="<?=($rowcon4>0)?$infocon4['sparesused3q']:''?>">
	<input type="hidden" name="sparesused4" id="sparesused4" value="<?=($rowcon4>0)?$infocon4['sparesused4']:''?>">
	<input type="hidden" name="sparesused4q" id="sparesused4q" value="<?=($rowcon4>0)?$infocon4['sparesused4q']:''?>">
	<input type="hidden" name="sparesused5" id="sparesused5" value="<?=($rowcon4>0)?$infocon4['sparesused5']:''?>">
	<input type="hidden" name="sparesused5q" id="sparesused5q" value="<?=($rowcon4>0)?$infocon4['sparesused5q']:''?>">
	<?php
}
if($infolayoutservice['sparesrequired']=='1')
{
?>
	<h5 class="mb-2">Spares Required</h5>
	<div class="row mb-1">
    <div class="col-1">
      <label for="sparesrequired1" class="col-form-label">1</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesrequired1" id="sparesrequired1">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesrequired1']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesrequired1q" id="sparesrequired1q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesrequired1q']:''?>">
            <div class="input-group-append">
                <span  id="requiredid1" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesrequired2" class="col-form-label">2</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesrequired2" id="sparesrequired2">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesrequired2']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesrequired2q" id="sparesrequired2q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesrequired2q']:''?>">
            <div class="input-group-append">
                <span  id="requiredid2" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesrequired3" class="col-form-label">3</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesrequired3" id="sparesrequired3">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesrequired3']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesrequired3q" id="sparesrequired3q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesrequired3q']:''?>">
            <div class="input-group-append">
                <span  id="requiredid3" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesrequired4" class="col-form-label">4</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesrequired4" id="sparesrequired4">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesrequired4']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesrequired4q" id="sparesrequired4q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesrequired4q']:''?>">
            <div class="input-group-append">
                <span  id="requiredid4" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
<div class="row mb-1">
    <div class="col-1">
      <label for="sparesrequired5" class="col-form-label">5</label>
    </div>
    <div class="col-7">
      <select class="form-control" name="sparesrequired5" id="sparesrequired5">
		<option value="">Select</option>
		<?php
		$sqi=mysqli_query($connection,"select distinct maincategory from jrcspares order by maincategory");
		while($ini=mysqli_fetch_array($sqi))
		{
		?>
		<optgroup label="<?=$ini['maincategory']?>">
		<?php
		$sqi2=mysqli_query($connection,"select subcategory, wattage from jrcspares where maincategory='".$ini['maincategory']."' order by maincategory, subcategory, wattage");
		while($ini2=mysqli_fetch_array($sqi2))
		{
		?>
		<option value="<?=htmlspecialchars($ini2['subcategory'])?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?>" <?=($rowcon4>0)?(($infocon4['sparesrequired5']==($ini2['subcategory'].(($ini2['wattage']!='')?' - '.$ini2['wattage']:'')))?'selected':''):''?>><?=$ini2['subcategory']?><?=($ini2['wattage']!='')?' - '.$ini2['wattage']:''?></option>
		<?php	
		}
		?>
		</optgroup>
		<?php
		}
		?>
		</select>
    </div>
	<div class="col-4">
	<div class="input-group">
            <input type="number" name="sparesrequired5q" id="sparesrequired5q" step="0.01" class="form-control" value="<?=($rowcon4>0)?$infocon4['sparesrequired5q']:''?>">
            <div class="input-group-append">
                <span  id="requiredid5" class="input-group-text" style="height: 1.70rem;width: 50px;"></span>
            </div>
     </div>
     </div>
  </div>  
  <hr>
 <?php
}
else
{
	?>
	<input type="hidden" name="sparesrequired1" id="sparesrequired1" value="<?=($rowcon4>0)?$infocon4['sparesrequired1']:''?>">
	<input type="hidden" name="sparesrequired1q" id="sparesrequired1q" value="<?=($rowcon4>0)?$infocon4['sparesrequired1q']:''?>">
	<input type="hidden" name="sparesrequired2" id="sparesrequired2" value="<?=($rowcon4>0)?$infocon4['sparesrequired2']:''?>">
	<input type="hidden" name="sparesrequired2q" id="sparesrequired2q" value="<?=($rowcon4>0)?$infocon4['sparesrequired2q']:''?>">
	<input type="hidden" name="sparesrequired3" id="sparesrequired3" value="<?=($rowcon4>0)?$infocon4['sparesrequired3']:''?>">
	<input type="hidden" name="sparesrequired3q" id="sparesrequired3q" value="<?=($rowcon4>0)?$infocon4['sparesrequired3q']:''?>">
	<input type="hidden" name="sparesrequired4" id="sparesrequired4" value="<?=($rowcon4>0)?$infocon4['sparesrequired4']:''?>">
	<input type="hidden" name="sparesrequired4q" id="sparesrequired4q" value="<?=($rowcon4>0)?$infocon4['sparesrequired4q']:''?>">
	<input type="hidden" name="sparesrequired5" id="sparesrequired5" value="<?=($rowcon4>0)?$infocon4['sparesrequired5']:''?>">
	<input type="hidden" name="sparesrequired5q" id="sparesrequired5q" value="<?=($rowcon4>0)?$infocon4['sparesrequired5q']:''?>">
	<?php
}
if($infolayoutservice['actiontaken']=='1')
{
?> 
  <div class="form-group">
    <h5 class="mb-2"><label for="actiontaken">Action Taken<?php if($infolayoutservice['actiontakenreq']=='1') { ?><span class="text-danger"> *</span><span href="#" data-toggle="modal" data-target="#actiontakenmodal">&nbsp;<i class="fa fa-plus text-primary"></i> </span><?php  } ?></label></h5>
	<select class="form-control fav_clr" id="actiontaken" name="actiontaken"  <?=($infolayoutservice['actiontakenreq']=='1')?'required':''?>>
<option value="">Select</option>

<?php
$sqlrep = "SELECT actiontaken From jrcactiontaken order by actiontaken asc";
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
<option value="<?=$rowrep['actiontaken']?>" <?=($rowcon4>0)?(($infocon4['actiontaken']==$rowrep['actiontaken'])?"selected":""):""?>><?=$rowrep['actiontaken']?></option>
<?php
			}
		}
		?>
		
		
</select>
  </div>
   <hr>
   <?php
}
else
{
	?>
	<input type="hidden" name="actiontaken" id="actiontaken" value="<?=($rowcon4>0)?$infocon4['actiontaken']:''?>">
	<?php
}
if($infolayoutservice['gstno']=='1')
{
?>
  <div class="form-group">
    <h5 class="mb-2"><label for="gstno">GST No<?php if($infolayoutservice['gstnoreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <input type="text" class="form-control" name="gstno" id="gstno" value="<?=$rowcons['gstno']?>" <?=($infolayoutservice['gstnoreq']=='1')?'required':''?>>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="gstno" id="gstno" value="<?=$rowcons['gstno']?>">
	<?php
}
if($infolayoutservice['email']=='1')
{
?>
  <div class="form-group">
    <h5 class="mb-2"><label for="email">Email ID<?php if($infolayoutservice['emailreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <input type="text" class="form-control" name="email" id="email" value="<?=$rowcons['email']?>" <?=($infolayoutservice['emailreq']=='1')?'required':''?>>
  </div>
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="email" id="email" value="<?=$rowcons['email']?>">
	<?php
}
if($infolayoutservice['servicecharges']=='1')
{
?>
   <h5 class="mb-2"><label for="schargematerial">Charges</label></h5>
   <div class="row mb-1">
     <div class="col-6">
      <label for="schargematerial" class="col-form-label"><strong>Invoice No.</strong></label>
    </div>
    <div class="col-6"><strong><?=($rowcon4>0)?$infocon4['schargeno']:''?></strong></div>
  </div>
  <div class="row mb-1">
     <div class="col-6">
      <label for="schargematerial" class="col-form-label"><strong>Invoice Date</strong></label>
    </div>
    <div class="col-6"><strong><?=(($rowcon4>0)&&($infocon4['schargedate']!=''))?(date('d/m/Y',strtotime($infocon4['schargedate']))):''?></strong></div>
  </div>  
   <input type="hidden" name="schargeno" id="schargeno" value="<?=($rowcon4>0)?$infocon4['schargeno']:''?>">
   <input type="hidden" name="schargedate" id="schargedate" value="<?=($rowcon4>0)?$infocon4['schargedate']:''?>">
  <input type="hidden" name="oldincgst" id="oldincgst" value="<?=($rowcon4>0)?$infocon4['incgst']:''?>"> 
  <div class="row mb-1">
     <div class="col-6">
      <label for="incgst" class="col-form-label">GST Type</label>
    </div>
    <div class="col-6">
	
      <label><input type="radio" name="incgst" id="incgst" value="0" <?=($rowcon4>0)?(($infocon4['incgst']=='0')?'checked':''):''?> onClick="return  executeFunctions();"> Included GST</label> <label><input type="radio" name="incgst" id="excgst" value="1" <?=($rowcon4>0)?(($infocon4['incgst']=='1')?'checke	d':''):'checked'?> onClick="return  executeFunctions()" checked> Excluded GST</label> <label><input type="radio" name="incgst" id="nogst" value="2" <?=($rowcon4>0)?(($infocon4['incgst']=='2')?'checked':''):''?> onClick="return executeFunctions()"> Estimation</label>
    </div>
  </div>  
  <hr>
  <!-- spares div started-->
  <div id="materialdiv">
 <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Material</th>
					  <th>Price</th>
					  <th>Quantity</th>
					  <th>Total</th>
					  <th>GST %</th>
					  <th>GST Amt.</th>
					  <th>Net Amt.</th>
                    </tr>
                  </thead>
                  <tbody> 
				  <?php $i=1;
					while($i<=5)
					{	
				  ?>
				  
				  <tr>
				 
                    <td><?=$i?></td>
                    <td><select class="form-control fav_clr" id="smaterial<?=$i?>" name="smaterial<?=$i?>" onChange="getpro(<?=$i?>)">
	<option value="">Select</option>
	<?php
	$sqlspares = "SELECT id, maincategory, subcategory  From jrcspares order by maincategory asc";
			$queryspares = mysqli_query($connection, $sqlspares);
			$rowCountspares = mysqli_num_rows($queryspares);
			if(!$queryspares){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			if($rowCountspares > 0) 
			{
				$count=1;
				while($rowspares = mysqli_fetch_array($queryspares)) 
				{
					?>
	<option value="<?=$rowspares['id']?>" <?=($rowcon4>0)?(($infocon4['smaterial'.$i]==$rowspares['id'])?"selected":""):""?>><?=preg_replace("/'/","",$rowspares['maincategory'])?> - <?=preg_replace("/'/","",$rowspares['subcategory'])?></option>
	<?php
				}
			}
			?>
	</select></td>
                    <td><input type="number" min="0" class="form-control" name="sprice<?=$i?>" id="sprice<?=$i?>" value="<?=($rowcon4>0)?$infocon4['sprice'.$i]:''?>" onchange="totalamount(<?=$i?>)" step="0.01" readonly></td>
                    <td> <input type="number" min="0" class="form-control" name="squantity<?=$i?>" id="squantity<?=$i?>" value="<?=($rowcon4>0)?$infocon4['squantity'.$i]:''?>" onChange="totalamount(<?=$i?>)" step="0.01"></td>
                    <td><input type="number" min="0" class="form-control" name="stotal<?=$i?>" id="stotal<?=$i?>" value="<?=($rowcon4>0)?$infocon4['stotal'.$i]:''?>" onChange="totalamount(<?=$i?>);netamt()"  readonly step="0.01"></td>
                    <td><input type="number" min="0" class="form-control" name="sgstper<?=$i?>" id="sgstper<?=$i?>" readonly value="<?=($rowcon4>0)?$infocon4['sgstper'.$i]:''?>" onChange="totalamount(<?=$i?>)"  step="0.01">
					<input type="hidden" min="0" class="form-control" name="sgstperdup<?=$i?>" id="sgstperdup<?=$i?>">
					
					</td>
                    <td><input type="number" min="0" class="form-control" name="sgstpervalue<?=$i?>" id="sgstpervalue<?=$i?>" readonly value="<?=($rowcon4>0)?$infocon4['sgstpervalue'.$i]:''?>" onChange="netamt()"    step="0.01" >
					</td>
                    <td><input type="number" min="0" class="form-control" name="schargepre<?=$i?>" id="schargepre<?=$i?>" value="<?=($rowcon4>0)?$infocon4['schargepre'.$i]:''?>" onChange="gstamount(<?=$i?>)"  readonly step="0.01"></td>
					
					
                    </tr>
					<?php 
					
					$i++;
					}
					?>
                  </tbody>
				 </table>
</div>				 
</div>

  <!-- spares div ended-->
    <hr>
   <div class="row mb-1">
     <div class="col-6">
      <label for="mchargescharge" class="col-form-label">Material Total</label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="mchargescharge" id="mchargescharge" value="<?=($rowcon4>0)?$infocon4['mchargescharge']:''?>" onChange="netamt();" step="0.01" readonly>
    </div>
  </div> 
<div class="row mb-1">
     <div class="col-6">
      <label for="mchargegstvalue" class="col-form-label"> Material GST</label>
    </div>
	<div class="col-6">
	<input type="number" min="0" class="form-control" name="mchargegstvalue" id="mchargegstvalue" readonly value="<?=($rowcon4>0)?$infocon4['mchargegstvalue']:''?>" onChange="netamt()"  step="0.01">
    </div>
 </div>   
   <div class="row mb-1">
     <div class="col-6">
      <label for="schargematerial" class="col-form-label"><strong>Material Net Total</strong></label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="schargematerial" id="schargematerial" readonly value="<?=($rowcon4>0)?$infocon4['schargematerial']:''?>" onChange="totalcalc();netamt()" step="0.01">
    </div>
  </div> 
  <hr>
   <div class="row mb-1">
     <div class="col-6">
      <label for="schargescharge" class="col-form-label">Service Charges</label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="schargescharge" id="schargescharge" value="<?=($rowcon4>0)?$infocon4['schargescharge']:''?>" onChange="totalcalc();netamt()"  step="0.01">
    </div>
  </div> 
<div class="row mb-1">
     <div class="col-2">
      <label for="schargegst" class="col-form-label">GST</label>
    </div>
	<div class="col-4">
	<input type="number" min="0" class="form-control" name="schargegst" id="schargegst" readonly value="<?=($rowcon4>0)?'18':'18'?>" onChange="totalcalc()" step="0.01">
	
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="schargegstvalue" id="schargegstvalue" readonly value="<?=($rowcon4>0)?$infocon4['schargegstvalue']:''?>" onChange="totalcalc();netamt()"  step="0.01">
    </div>
 </div>   
   <div class="row mb-1">
     <div class="col-6">
      <label for="sercharge" class="col-form-label"><strong>Total Amount</strong></label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="sercharge" id="sercharge" readonly value="<?=($rowcon4>0)?$infocon4['sercharge']:''?>" onChange="totalcalc()" step="0.01">
    </div>
  </div> 
  <hr>
   <div class="row mb-1">
     <div class="col-6">
      <label for="schargepre" class="col-form-label">Net Total</label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="schargepre" id="schargepre" value="<?=($rowcon4>0)?$infocon4['schargepre']:''?>" onChange="netamt()" step="0.01" readonly>
    </div>
  </div> 
<div class="row mb-1">
     <div class="col-6">
      <label for="sgstamt" class="col-form-label"> Net GST</label>
    </div>
	<div class="col-6">
	<input type="number" min="0" class="form-control" name="sgstamt" id="sgstamt" readonly value="<?=($rowcon4>0)?$infocon4['sgstamt']:''?>" onChange="netamt()"  step="0.01">
    </div>
 </div>   
   <div class="row mb-1">
     <div class="col-6">
      <label for="scharge" class="col-form-label"><strong>Grand Total </strong>(round of)</label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="scharge" id="scharge" readonly value="<?=($rowcon4>0)?$infocon4['scharge']:''?>" onChange="netamt();totalcalc()" step="0.01">
    </div>
  </div> 
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="smaterial1" id="smaterial1" value="<?=($rowcon4>0)?$infocon4['smaterial1']:''?>">
	<input type="hidden" name="smaterial2" id="smaterial2" value="<?=($rowcon4>0)?$infocon4['smaterial2']:''?>">
	<input type="hidden" name="smaterial3" id="smaterial3" value="<?=($rowcon4>0)?$infocon4['smaterial3']:''?>">
	<input type="hidden" name="smaterial4" id="smaterial4" value="<?=($rowcon4>0)?$infocon4['smaterial4']:''?>">
	<input type="hidden" name="smaterial5" id="smaterial5" value="<?=($rowcon4>0)?$infocon4['smaterial5']:''?>">
	<input type="hidden" name="sprice1" id="sprice1" value="<?=($rowcon4>0)?$infocon4['sprice1']:''?>">
	<input type="hidden" name="sprice2" id="sprice2" value="<?=($rowcon4>0)?$infocon4['sprice2']:''?>">
	<input type="hidden" name="sprice3" id="sprice3" value="<?=($rowcon4>0)?$infocon4['sprice3']:''?>">
	<input type="hidden" name="sprice4" id="sprice4" value="<?=($rowcon4>0)?$infocon4['sprice4']:''?>">
	<input type="hidden" name="sprice5" id="sprice5" value="<?=($rowcon4>0)?$infocon4['sprice5']:''?>">
	<input type="hidden" name="squantity1" id="squantity1" value="<?=($rowcon4>0)?$infocon4['squantity1']:''?>">
	<input type="hidden" name="squantity2" id="squantity2" value="<?=($rowcon4>0)?$infocon4['squantity2']:''?>">
	<input type="hidden" name="squantity3" id="squantity3" value="<?=($rowcon4>0)?$infocon4['squantity3']:''?>">
	<input type="hidden" name="squantity4" id="squantity4" value="<?=($rowcon4>0)?$infocon4['squantity4']:''?>">
	<input type="hidden" name="squantity5" id="squantity5" value="<?=($rowcon4>0)?$infocon4['squantity5']:''?>">
	<input type="hidden" name="stotal1" id="stotal1" value="<?=($rowcon4>0)?$infocon4['stotal1']:''?>">
	<input type="hidden" name="stotal2" id="stotal2" value="<?=($rowcon4>0)?$infocon4['stotal2']:''?>">
	<input type="hidden" name="stotal3" id="stotal3" value="<?=($rowcon4>0)?$infocon4['stotal3']:''?>">
	<input type="hidden" name="stotal4" id="stotal4" value="<?=($rowcon4>0)?$infocon4['stotal4']:''?>">
	<input type="hidden" name="stotal5" id="stotal5" value="<?=($rowcon4>0)?$infocon4['stotal5']:''?>">
	<input type="hidden" name="sgstper1" id="sgstper1" value="<?=($rowcon4>0)?$infocon4['sgstper1']:''?>">
	<input type="hidden" name="sgstper2" id="sgstper2" value="<?=($rowcon4>0)?$infocon4['sgstper2']:''?>">
	<input type="hidden" name="sgstper3" id="sgstper3" value="<?=($rowcon4>0)?$infocon4['sgstper3']:''?>">
	<input type="hidden" name="sgstper4" id="sgstper4" value="<?=($rowcon4>0)?$infocon4['sgstper4']:''?>">
	<input type="hidden" name="sgstper5" id="sgstper5" value="<?=($rowcon4>0)?$infocon4['sgstper5']:''?>">
	<input type="hidden" name="schargepre1" id="schargepre1" value="<?=($rowcon4>0)?$infocon4['schargepre1']:''?>">
	<input type="hidden" name="schargepre2" id="schargepre2" value="<?=($rowcon4>0)?$infocon4['schargepre2']:''?>">
	<input type="hidden" name="schargepre3" id="schargepre3" value="<?=($rowcon4>0)?$infocon4['schargepre3']:''?>">
	<input type="hidden" name="schargepre4" id="schargepre4" value="<?=($rowcon4>0)?$infocon4['schargepre4']:''?>">
	<input type="hidden" name="schargepre5" id="schargepre5" value="<?=($rowcon4>0)?$infocon4['schargepre5']:''?>">
	<input type="hidden" name="sgstpervalue1" id="sgstpervalue1" value="<?=($rowcon4>0)?$infocon4['sgstpervalue1']:''?>">
	<input type="hidden" name="sgstpervalue2" id="sgstpervalue2" value="<?=($rowcon4>0)?$infocon4['sgstpervalue2']:''?>">
	<input type="hidden" name="sgstpervalue3" id="sgstpervalue3" value="<?=($rowcon4>0)?$infocon4['sgstpervalue3']:''?>">
	<input type="hidden" name="sgstpervalue4" id="sgstpervalue4" value="<?=($rowcon4>0)?$infocon4['sgstpervalue4']:''?>">
	<input type="hidden" name="sgstpervalue5" id="sgstpervalue5" value="<?=($rowcon4>0)?$infocon4['sgstpervalue5']:''?>">
	<input type="hidden" name="mchargescharge" id="mchargescharge" value="<?=($rowcon4>0)?$infocon4['mchargescharge']:''?>">
	<input type="hidden" name="mchargegstvalue" id="mchargegstvalue" value="<?=($rowcon4>0)?$infocon4['mchargegstvalue']:''?>">
	<input type="hidden" name="schargematerial" id="schargematerial" value="<?=($rowcon4>0)?$infocon4['schargematerial']:''?>">
	<input type="hidden" name="schargescharge" id="schargescharge" value="<?=($rowcon4>0)?$infocon4['schargescharge']:''?>">
	<input type="hidden" name="schargegst" id="schargegst" value="<?=($rowcon4>0)?$infocon4['schargegst']:''?>">
	<input type="hidden" name="incgst" id="incgst" value="<?=($rowcon4>0)?$infocon4['incgst']:''?>">
	<input type="hidden" name="sercharge" id="sercharge" value="<?=($rowcon4>0)?$infocon4['sercharge']:''?>">
	<input type="hidden" name="schargegstvalue" id="schargegstvalue" value="<?=($rowcon4>0)?$infocon4['schargegstvalue']:''?>">
	<input type="hidden" name="schargepre" id="schargepre" value="<?=($rowcon4>0)?$infocon4['schargepre']:''?>">
	<input type="hidden" name="sgstamt" id="sgstamt" value="<?=($rowcon4>0)?$infocon4['sgstamt']:''?>">
	<input type="hidden" name="scharge" id="scharge" value="<?=($rowcon4>0)?$infocon4['scharge']:''?>">
	<?php
}
if($infolayoutservice['imguploads']=='1')
{
?>
  <div class="row mb-1">
     <div class="col-12">
	 <h5 class="mb-2"><label for="imguploads">Site Images (After Action Taken)</label></h5>
  <div id="mulitplefileuploader">Upload Site Images</div>
<div id="status"></div>
<div id="showData" class="imgcontainer"><?php if($rowcon4>0){if($infocon4['imguploads']!=''){$as=explode(',',$infocon4['imguploads']);$c=1;foreach($as as $a){echo "<div class='imgcontent' id='imgcontent_".$c."' ><img src='".$a."' width='100' height='100'><span class='imgdelete' id='imgdelete_".$c."'>Delete</span></div>";$c++;}}}?></div>
<input id="imguploads" type="hidden" name="imguploads" value="<?=($rowcon4>0)?$infocon4['imguploads']:''?>"><br>
</div>
</div>
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="imguploads" id="imguploads" value="<?=($rowcon4>0)?$infocon4['imguploads']:''?>">
	<?php
}
?>
</div>
<div id="customeravail1" onchange="customerchange()">
<?php
if($infolayoutservice['engineerreport']=='1')
{
?> 
  <div class="form-group">
    <h5 class="mb-2"><label for="engineerreport">Engineer's Report<?php if($infolayoutservice['engineerreportreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <textarea class="form-control" name="engineerreport" id="engineerreport" style="text-transform:uppercase;"  <?=($infolayoutservice['engineerreportreq']=='1')?'required':''?>><?=($rowcon4>0)?$infocon4['engineerreport']:''?></textarea>
  </div>
    <hr>
	<?php
}
else
{
	?>
	<input type="hidden" name="engineerreport" id="engineerreport" value="<?=($rowcon4>0)?$infocon4['engineerreport']:''?>">
	<?php
}
?>
</div>
<div id="customeravail2" onchange="customerchange()">
<?php
if($infolayoutservice['customerfeedback']=='1')
{
?>
  <div class="form-group">
    <h5 class="mb-2"><label for="customerfeedback">Customer's Feedback<?php if($infolayoutservice['customerfeedbackreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <textarea class="form-control" name="customerfeedback" id="customerfeedback"  <?=($infolayoutservice['customerfeedbackreq']=='1')?'required':''?>><?=($rowcon4>0)?$infocon4['customerfeedback']:''?></textarea>
  </div>
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="customerfeedback" id="customerfeedback" value="<?=($rowcon4>0)?$infocon4['customerfeedback']:''?>">
	<?php
}
if($infolayoutservice['engineerapproach']=='1')
{
?>
  <div class="form-group">
    <h5 class="mb-2"><label for="engapproach">Engineer's Approach <?php if($infolayoutservice['engineerapproachreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <select class="form-control" name="engapproach" id="engapproach"  <?=($infolayoutservice['engineerapproachreq']=='1')?'required':''?>>
	<option value="">Select</option>
	<option value="Excellent" <?=($rowcon4>0)?(($infocon4['engapproach']=='Excellent')?'selected':''):''?>>Excellent</option>
	<option value="Better" <?=($rowcon4>0)?(($infocon4['engapproach']=='Better')?'selected':''):''?>>Better</option>
	<option value="Need Improvement" <?=($rowcon4>0)?(($infocon4['engapproach']=='Need Improvement')?'selected':''):''?>>Need Improvement</option>
	</select>
  </div>
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="engapproach" id="engapproach" value="<?=($rowcon4>0)?$infocon4['engapproach']:''?>">
	<?php
}
if($infolayoutservice['signature']=='1')
{
?>
  <div class="form-group">
    <h5 class="mb-2"><label for="signname">Signatory's Name<?php if($infolayoutservice['signaturereq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <input type="text" class="form-control" name="signname" id="signname"  <?=($infolayoutservice['signaturereq']=='1')?'required':''?> value="<?=($rowcon4>0)?$infocon4['signname']:''?>">
  </div>
  <hr>
  <div class="form-group">
    <h5 class="mb-2"><label for="signname">Signature</label></h5>
    <input type="hidden" class="form-control" name="signature" id="signature" value="<?=($rowcon4>0)?$infocon4['signature']:''?>">
	<img id="signatureimg" style="<?=($rowcon4>0)?'display:block':'display:none'?>" src="<?=($rowcon4>0)?$infocon4['signature']:''?>">
	<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#signModal">Get Signature</a>
	<div id="signModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Get Signature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" class="text-center" align="center">
        <p class="text-center"><div id="signpad" align="center" style="border:1px solid #000000; width:302px; height:202px;">
		<canvas class="pad" id="pad" width="300" height="200" ></canvas>
		</div></p>
      </div>
      <div class="modal-footer">
	  <input type="button" class="btn btn-warning" value="Clear" id="clear" />
			<input type="button" id="btnSaveSign" class="btn btn-success" value="Submit"  data-dismiss="modal"/>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="signature" id="signature" value="<?=($rowcon4>0)?$infocon4['signature']:''?>">
	<input type="hidden" name="signname" id="signname" value="<?=($rowcon4>0)?$infocon4['signname']:''?>">
	<?php
}
if($infolayoutservice['seal']=='1')
{
?>
    <div class="row mb-1">
     <div class="col-12">
	 <h5 class="mb-2"><label for="customerfeedback">Customer Seal<?php if($infolayoutservice['sealreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
  <div id="mulitplefileuploaderseal">Capture Seal</div>
<div id="statusseal"></div>
<div id="showDataseal" class="imgsealcontainer"><?php if($rowcon4>0){if($infocon4['imgseal']!=''){$as=explode(',',$infocon4['imgseal']);$c=1;foreach($as as $a){echo "<div class='imgsealcontent' id='imgsealcontent_".$c."' ><img src='".$a."' width='100' height='100'><span class='imgsealdelete' id='imgsealdelete_".$c."'>Delete</span></div>";$c++;}}}?></div>
<input id="imgseal" type="hidden" name="imgseal" value="<?=($rowcon4>0)?$infocon4['imgseal']:''?>"><br>
</div>
</div>
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="imgseal" id="imgseal" value="<?=($rowcon4>0)?$infocon4['imgseal']:''?>">
	<?php
}
if($infolayoutservice['manual']=='1')
{
?>
    <div class="row mb-1">
     <div class="col-12">
	 <h5 class="mb-2"><label for="customerfeedback1">Manual Service Call Report<?php if($infolayoutservice['manualreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
  <div id="mulitplefileuploadermanual">Capture Manual Service Call Report<?php if($infolayoutservice['manualreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></div>
<div id="statusmanual"></div>
<div id="showDatamanual" class="imgmanualcontainer"><?php if($rowcon4>0){if($infocon4['imgmanual']!='' && $infocon4['imgmanual']!='NULL' ){$as=explode(',',$infocon4['imgmanual']);$c=1;foreach($as as $a){echo "<div class='imgmanualcontent' id='imgmanualcontent_".$c."' ><img src='".$a."' width='100' height='100'><span class='imgmanualdelete' id='imgmanualdelete_".$c."'>Delete</span></div>";$c++;}}}?></div>
<input id="imgmanual" type="hidden" name="imgmanual" value="<?=($rowcon4>0)?$infocon4['imgmanual']:''?>"><br>
</div>
</div>
  <hr>
  <?php
}
else
{
	?>
	<input type="hidden" name="imgmanual" id="imgmanual" value="<?=($rowcon4>0)?$infocon4['imgmanual']:''?>">
	<?php
}
?>
<input type="hidden" name="engineertype" id="engineertype" value="<?=$rowselect['engineertype']?>">
<?php
if($rowselect['engineertype']=='1')
{
	?>
<div class="row mb-1">
<div class="col-12">
<h5 class="mb-2"><label>Contribution % for this Work</label></h5>
<table class="table">
 <tr>
  <th>ENGINEER NAME</th>
  <th>WORK %</th>
 </tr>
  <?php
  $engnames=explode(',', $rowselect['engineersname']);
  $engids=explode(',', $rowselect['engineersid']);
  for($i=0; $i<count($engids); $i++)
  {
	  if($engids!='')
	  {
		  $sqlieng=mysqli_query($connection, "select workper from jrccallstravel where calltid='$calltid' and engineerid='".$engids[$i]."'");
		  $infoeng=mysqli_fetch_array($sqlieng);
		  ?>
		  <tr>
		  <td><input type="hidden" name="cengineersid[]" id="cengineersid<?=$i?>" value="<?=$engids[$i]?>"><?=$engnames[$i]?></td>
		  <td><input type="number" name="cengineersper[]" id="cengineersper<?=$i?>" min="0" max="100" class="form-control" value="<?=$infoeng['workper']?>"  onChange="workperchange(<?=$i?>)" required></td>
		  </tr>
		  <?php
	  }
  }
  ?>
	</table>
	</div>
	</div>
	<?php
}
?>
</div>
<?php
if($infolayoutservice['callstatus']=='1')
{
?>
  <div class="form-group">
    <h5 class="mb-2"><label for="callstatus">Call Status<?php if($infolayoutservice['callstatusreq']=='1') { ?><span class="text-danger"> *</span><?php  } ?></label></h5>
    <select class="form-control" name="callstatus" id="callstatus"  <?=($infolayoutservice['callstatusreq']=='1')?'required':''?>>
	<option value="">Select</option>
	<option value="Completed" <?=($rowcon4>0)?(($infocon4['callstatus']=='Completed')?'selected':''):''?>>Completed</option>
	<!--<option value="Observation" <?//=($rowcon4>0)?(($infocon4['callstatus']=='Observation')?'selected':''):''?>>Observation</option>-->
	<option value="Pending" <?=($rowcon4>0)?(($infocon4['callstatus']=='Pending')?'selected':''):''?>>Pending</option>
	<option value="Cancelled" <?=($rowcon4>0)?(($infocon4['callstatus']=='Cancelled')?'selected':''):''?>>Cancelled</option>
	<!--<option value="Awaiting for Approval" <?//=($rowcon4>0)?(($infocon4['callstatus']=='Awaiting for Approval')?'selected':''):''?>>Awaiting for Approval</option>-->
	<!--<option value="Claim" <?//=($rowcon4>0)?(($infocon4['callstatus']=='Claim')?'selected':''):''?>>Claim</option>-->
	</select>
  </div>  
  <hr>
 <?php
}
else
{
	?>
	<input type="hidden" name="callstatus" id="callstatus" value="<?=($rowcon4>0)?$infocon4['callstatus']:''?>">
	<?php
}
?>
  <button type="submit" name="submit" value="Submit" class="btn btn-primary">SUBMIT</button>
</form>
                                        </div>
                                    </div>
                                </div>		
					<?php
					$count++;
			}
		}
 }		
			?>
 </div>
			</div>
          </div>
        </div>
      </div>
      <?php include('footer.php') ?>
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
  
  
  
  
    <!-----action taken modal---->
<div class="modal fade" id="actiontakenmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add New Action Taken</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="actiontagForm">
<div class="row">
 <div class="col-lg-12">
			<div class="form-group">
				<label>Action Taken</label><span class="text-danger">*</span>
					<input type="text" class="form-control" id="aactiontaken" name="aactiontaken"  required>
			</div>
		</div>

  </div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="actiontaken-form-submit" name="actiont" value="Submit" >
</div>
</form>
</div>
</div>
</div>
</div>

<!-----action taken modal---->  
    <!-----action taken modal---->
<div class="modal fade" id="problemobservedmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add New Problem Observation</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="problemtagForm">
<div class="row">
 <div class="col-lg-12">
			<div class="form-group">
				<label>Problem Observation</label><span class="text-danger">*</span>
					<input type="text" class="form-control" id="pproblemobserved" name="pproblemobserved"  required>
			</div>
		</div>

  </div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="problemobserved-form-submit" name="problemob" value="Submit" >
</div>
</form>
</div>
</div>
</div>
</div>

<!-----action taken modal---->



  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
  <script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
  <script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
  <script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
  <!--action taken model-->
<script>
$(function() {
$('#actiontaken-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "callactiontaken.php",
data: $('#actiontagForm').serialize(),
success: function(response) {
console.log(response);
$('#actiontakenmodal').modal('toggle');
var len = response.length;
var actiontaken = $("#aactiontaken").val();
var newOption = new Option(actiontaken, actiontaken, true, true);
    // Append it to the select
    $('#actiontaken').append(newOption).trigger('change');
document.getElementById("actiontagForm").reset();
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>
<!--action taken model-->
  <!--problem observation model-->
<script>
$(function() {
$('#problemobserved-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "callproblemobserved.php",
data: $('#problemtagForm').serialize(),
success: function(response) {
console.log(response);
$('#problemobservedmodal').modal('toggle');
var len = response.length;
var problemobserved = $("#pproblemobserved").val();
var newOption = new Option(problemobserved, problemobserved, true, true);
    // Append it to the select
    $('#problemobserved').append(newOption).trigger('change');
document.getElementById("problemtagForm").reset();
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>
<!--problem observation  model-->
  <script>
$(document).ready(function(){	
	$("#sparesused1").change(function(){
		 var sparesused1=$("#sparesused1").val();
		 if(sparesused1=="")
		 {
			 $("#usedid1").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesused1: sparesused1} , function(data){
				console.log(data);
				$("#usedid1").html(data);
			});
		 }
	});
	$("#sparesused1").trigger("change");
	});
 </script>
  <script>
 	$(document).ready(function(){
	$("#sparesused2").change(function(){
		 var sparesused2=$("#sparesused2").val();
		 if(sparesused2=="")
		 {
			 $("#usedid2").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesused2: sparesused2} , function(data){
				console.log(data);
				$("#usedid2").html(data);	
			});
		 }
	});
$("#sparesused2").trigger("change");
});
 </script>
 <script>
 	$(document).ready(function(){
	$("#sparesused3").change(function(){
		 var sparesused3=$("#sparesused3").val();
		 if(sparesused3=="")
		 {
			 $("#usedid3").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesused3: sparesused3} , function(data){
				console.log(data);
				$("#usedid3").html(data);	
			});
		 }
	});
	$("#sparesused3").trigger("change");
});
 </script>
 <script>
 	$(document).ready(function(){
	$("#sparesused4").change(function(){
		 var sparesused4=$("#sparesused4").val();
		 if(sparesused4=="")
		 {
			 $("#usedid4").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesused4: sparesused4} , function(data){
				console.log(data);
				$("#usedid4").html(data);	
			});
		 }
	});
	$("#sparesused4").trigger("change");
});
 </script>
 <script>
 	$(document).ready(function(){
	$("#sparesused5").change(function(){
		 var sparesused5=$("#sparesused5").val();
		 if(sparesused5=="")
		 {
			 $("#usedid5").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesused5: sparesused5} , function(data){
				console.log(data);
				$("#usedid5").html(data);	
			});
		 }
	});
	$("#sparesused5").trigger("change");
});
 </script>
 <script>
$(document).ready(function(){	
	$("#sparesrequired1").change(function(){
		 var sparesrequired1=$("#sparesrequired1").val();
		 if(sparesrequired1=="")
		 {
			 $("#requiredid1").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesrequired1: sparesrequired1} , function(data){
				console.log(data);
				$("#requiredid1").html(data);
			});
		 }
	});
	$("#sparesrequired1").trigger("change");
	});
 </script>
  <script>
 	$(document).ready(function(){
	$("#sparesrequired2").change(function(){
		 var sparesrequired2=$("#sparesrequired2").val();
		 if(sparesrequired2=="")
		 {
			 $("#requiredid2").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesrequired2: sparesrequired2} , function(data){
				console.log(data);
				$("#requiredid2").html(data);	
			});
		 }
	});
$("#sparesrequired2").trigger("change");
});
 </script>
 <script>
 	$(document).ready(function(){
	$("#sparesrequired3").change(function(){
		 var sparesrequired3=$("#sparesrequired3").val();
		 if(sparesrequired3=="")
		 {
			 $("#requiredid3").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesrequired3: sparesrequired3} , function(data){
				console.log(data);
				$("#requiredid3").html(data);
			});
		 }
	});
	$("#sparesrequired3").trigger("change");
});
 </script>
 <script>
 	$(document).ready(function(){
	$("#sparesrequired4").change(function(){
		 var sparesrequired4=$("#sparesrequired4").val();
		 if(sparesrequired4=="")
		 {
			 $("#requiredid4").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesrequired4: sparesrequired4} , function(data){
				console.log(data);
				$("#requiredid4").html(data);
			});
		 }
	});
	$("#sparesrequired4").trigger("change");
});
 </script>
 <script>
 	$(document).ready(function(){
	$("#sparesrequired5").change(function(){
		 var sparesrequired5=$("#sparesrequired5").val();
		 if(sparesrequired5=="")
		 {
			 $("#requiredid5").val('');
		 }
		 else
		 {
			$.get("get_unit.php", {sparesrequired5: sparesrequired5} , function(data){
				console.log(data);
				$("#requiredid5").html(data);
			});
		 }
	});
	$("#sparesrequired5").trigger("change");
});
 </script>

<script>

function executeFunctions() {
	for(var i=1; i<=5 ; i++)
	{
		totalamount(i);
		
    gstamount(i);
    totalcalc();
    
	}
}
function getpro(id)
{
var smaterial1=$("#smaterial"+id).val();
if(smaterial1=="")
{
$("#sprice"+id).val('');
$("#sgstper"+id).val('');
}
else
{
$.get("sparessearch.php", {smaterial1: smaterial1} , function(data){
var dataarray=data.split("|");
console.log(dataarray);
$("#spareid"+id).val(dataarray[0].trim());
$("#sprice"+id).val(parseFloat(dataarray[1]));
$("#sgstper"+id).val(parseFloat(dataarray[2]));
$("#sgstperdup"+id).val(parseFloat(dataarray[2]));
spriceIn(id);
});
}
}
</script>
<script>
  function spriceIn(id) {
    var spriceInput = document.getElementById('sprice'+id);
    if (parseFloat(spriceInput.value) === 0) {
        spriceInput.removeAttribute('readonly');
    } else {
        spriceInput.setAttribute('readonly', 'readonly');
    }
} 
</script>
<script>
<!--quantity calc for  material-->
function totalamount(id)
{
var sprice = document.getElementById("sprice"+id).value;
var squantity = document.getElementById("squantity"+id).value;
document.getElementById("stotal"+id).value =((parseFloat(squantity)*parseFloat(sprice)).toFixed(2));
gstamount(id);
}
<!--gst calc for  material-->

function gstamount(id)
{
/*var stotal = document.getElementById("stotal"+id).value;
var sgstper = document.getElementById("sgstper"+id).value;
document.getElementById("sgstpervalue"+id).value =((parseFloat(stotal)*parseFloat(sgstper))/100);
netamount(id);*/
var sprice = $("#sprice"+id).val();
var squantity = $("#squantity"+id).val();
var schargepre = $("#schargepre"+id).val();
var sgstper = $("#sgstper"+id).val();
var stotal = $("#stotal"+id).val();
if(document.getElementById('excgst').checked==true)
{
document.getElementById('schargepre'+id).setAttribute('readonly','readonly');
$("#sgstper"+id).val();
if(stotal!='')
{
var sgstpervalue1=(parseFloat(stotal)*parseFloat(sgstper))/100;
$("#sgstpervalue"+id).val(sgstpervalue1.toFixed(2));
var iNetPrice = parseFloat(stotal)+parseFloat(sgstpervalue1);
$("#schargepre"+id).val(iNetPrice.toFixed(2));
}
}
if(document.getElementById('incgst').checked==true)
{
document.getElementById('schargepre'+id).removeAttribute('readonly');
document.getElementById('stotal'+id).setAttribute('readonly','readonly');
$("#sgstper"+id).val();
var original=$("#schargepre"+id).val();
var quantity=$("#squantity"+id).val();
var ipreamoutv=parseFloat(original);
var igstperv=parseFloat(sgstper);
var iGSTAmount =ipreamoutv-(ipreamoutv*(100/(100+igstperv)));
var iNetPrice = ipreamoutv-iGSTAmount;
var iNetTota1 = iNetPrice/parseFloat(quantity);
var iProductvalue=iNetTota1 - iGSTAmount;
$("#sgstpervalue"+id).val(iGSTAmount.toFixed(2));
$("#stotal"+id).val(iProductvalue.toFixed(2));
//$("#schargepre").val(iNetPrice.toFixed(2));
$("#sprice"+id).val(iNetTota1.toFixed(2));
}
if(document.getElementById('nogst').checked==true)
{
var sprice = document.getElementById("sprice"+id).value;
var squantity = document.getElementById("squantity"+id).value;
document.getElementById("stotal"+id).value =(parseFloat(squantity)*parseFloat(sprice));
document.getElementById('sgstper'+id).setAttribute('readonly','readonly');
document.getElementById('schargepre'+id).setAttribute('readonly','readonly');
$("#sgstper"+id).val(0);
/* var original=$("#sercharge").val();
var ipreamoutv=parseFloat(original);
var igstperv=parseFloat(0);
var iGSTAmount =ipreamoutv-(ipreamoutv*(100/(100+igstperv)));
var iNetPrice = ipreamoutv-iGSTAmount;
$("#schargegstvalue").val(iGSTAmount.toFixed(2));
$("#schargepre").val(iNetPrice.toFixed(2));
$("#schargescharge").val(iNetPrice.toFixed(2));	   */
var schargepreval=parseFloat(stotal);
//$("#schargepre").val(schargepreval.toFixed(2));
var schargegstvalueval=(parseFloat(schargepreval)*parseFloat(0))/100;
$("#sgstper"+id).val(schargegstvalueval.toFixed(2));
$("#sgstpervalue"+id).val(schargegstvalueval.toFixed(2));
var iNetPrice = parseFloat(schargepreval)+parseFloat(schargegstvalueval);
$("#schargepre"+id).val(iNetPrice.toFixed(2));
}
netamt();
}
<!--totalamount calc for each  material-->
function netamount(id)
{
var stotal = document.getElementById("stotal"+id).value;
var sgstpervalue = document.getElementById("sgstpervalue"+id).value;
if(stotal!="" && sgstpervalue!="")
{
document.getElementById("schargepre"+id).value =(parseFloat(stotal)+parseFloat(sgstpervalue));
}
else
{
document.getElementById("schargepre"+id).value =(parseFloat(stotal)+parseFloat(0));
}
netamt();
}
</script>
<script>
<!--materail total amount calculation-->
function netamt()
{
var stot=0;  var sgstper=0; var schargepr=0;
for(var id=1;id<=5;id++)
{
if(document.getElementById("stotal"+id))
{
var stotal = document.getElementById("stotal"+id).value;
stot+=parseFloat(stotal);
}
if(document.getElementById("sgstpervalue"+id))
{
var sgstpervalue = document.getElementById("sgstpervalue"+id).value;
sgstper+=parseFloat(sgstpervalue);
}
if(document.getElementById("schargepre"+id))
{
var schargepre = document.getElementById("schargepre"+id).value;
schargepr+=parseFloat(schargepre);
}
}
document.getElementById("mchargescharge").value=stot;
document.getElementById("mchargegstvalue").value=sgstper;
document.getElementById("schargematerial").value=schargepr.toFixed(2);
grandamt();
}
<!--For Grand value calculation-->
function grandamt()
{
var schargescharge = document.getElementById("schargescharge").value;
if(schargescharge=="")
{
schargescharge=0;
}
var schargegstvalue = document.getElementById("schargegstvalue").value;
if(schargegstvalue=="")
{
schargegstvalue=0;
}
var sercharge = document.getElementById("sercharge").value;
if(sercharge=="")
{
sercharge=0;
}
var mchargescharge = document.getElementById("mchargescharge").value;
if(mchargescharge=="")
{
mchargescharge=0;
}
var mchargegstvalue = document.getElementById("mchargegstvalue").value;
if(mchargegstvalue=="")
{
mchargegstvalue=0;
}
var schargematerial = document.getElementById("schargematerial").value;
if(schargematerial=="")
{
schargematerial=0;
}
document.getElementById("schargepre").value =(parseFloat(mchargescharge)+parseFloat(schargescharge));
document.getElementById("sgstamt").value =((parseFloat(mchargegstvalue)+parseFloat(schargegstvalue)).toFixed(2));
document.getElementById("scharge").value =Math.round((parseFloat(schargematerial)+parseFloat(sercharge)));
}
</script>
<script>
<?php
if(isset($engids))
{
?>
function workperchange(id)
{
var vals=0;
<?php
for($i=0; $i<(count($engids)-1); $i++)
{
if($engids!='')
{
?>
vals+=parseFloat($("#cengineersper<?=$i?>").val());
<?php
}
}
?>
var valbal=100-vals;
if(vals>100)
{
alert("Percentage is more than 100");
valbal=valbal+parseFloat($("#cengineersper"+id).val());
$("#cengineersper"+id).val('');
$("#cengineersper"+id).focus();
}
$("#cengineersper<?=count($engids)-1?>").val(valbal);
}
<?php
}
?>

function totalcalc()
{
var schargescharge=$("#schargescharge").val();
var schargepre=$("#schargepre").val();
var schargegst=$("#schargegst").val();
var schargegstvalue=$("#schargegstvalue").val();
var sercharge=$("#sercharge").val();
if(document.getElementById('excgst').checked==true)
{
document.getElementById('schargescharge').removeAttribute('readonly');
document.getElementById('sercharge').setAttribute('readonly','readonly');
$("#schargegst").val(18);
if((schargescharge!=''))
{
var schargepreval=parseFloat(schargescharge);
$("#schargepre").val(schargepreval.toFixed(2));
var schargegstvalueval=(parseFloat(schargepreval)*parseFloat(schargegst))/100;
$("#schargegstvalue").val(schargegstvalueval.toFixed(2));
var iNetPrice = parseFloat(schargepreval)+parseFloat(schargegstvalueval);
$("#sercharge").val(iNetPrice.toFixed(2));
}
}
if(document.getElementById('incgst').checked==true)
{
document.getElementById('sercharge').removeAttribute('readonly');
document.getElementById('schargescharge').setAttribute('readonly','readonly');
$("#schargegst").val(18);
var original=$("#sercharge").val();
var ipreamoutv=parseFloat(original);
var igstperv=parseFloat(schargegst);
var iGSTAmount =ipreamoutv-(ipreamoutv*(100/(100+igstperv)));
var iNetPrice = ipreamoutv-iGSTAmount;
$("#schargegstvalue").val(iGSTAmount.toFixed(2));
$("#schargepre").val(iNetPrice.toFixed(2));
$("#schargescharge").val(iNetPrice.toFixed(2));
}
if(document.getElementById('nogst').checked==true)
{
document.getElementById('schargescharge').removeAttribute('readonly');
document.getElementById('sercharge').setAttribute('readonly','readonly');
$("#schargegst").val(0);
/* var original=$("#sercharge").val();
var ipreamoutv=parseFloat(original)-parseFloat(schargematerial);
var igstperv=parseFloat(0);
var iGSTAmount =ipreamoutv-(ipreamoutv*(100/(100+igstperv)));
var iNetPrice = ipreamoutv-iGSTAmount;
$("#schargegstvalue").val(iGSTAmount.toFixed(2));
$("#schargepre").val(iNetPrice.toFixed(2));
$("#schargescharge").val(iNetPrice.toFixed(2));	   */
var schargepreval=parseFloat(schargescharge);
$("#schargepre").val(schargepreval.toFixed(2));
var schargegstvalueval=(parseFloat(schargepreval)*parseFloat(0))/100;
$("#schargegstvalue").val(schargegstvalueval.toFixed(2));
var iNetPrice = parseFloat(schargepreval)+parseFloat(schargegstvalueval);
$("#sercharge").val(iNetPrice.toFixed(2));
}
netamt();
}
</script>
<script type="text/javascript">
$(function() {
$( "#topsearch" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
});
</script>
<script>
function mapsSelector(lat,lon) {
if ((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) || (navigator.platform.indexOf("iPod") != -1))
{
window.open("maps://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
else
{
window.open("https://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
}
function myFunction() {
var input, filter, cards, cardContainer, h5, title, i;
input = document.getElementById("myFilter");
filter = input.value.toUpperCase();
cardContainer = document.getElementById("myItems");
cards = cardContainer.getElementsByClassName("items");
for (i = 0; i < cards.length; i++) {
title = cards[i].querySelector(".card");
if (title.innerText.toUpperCase().indexOf(filter) > -1) {
cards[i].style.display = "";
} else {
cards[i].style.display = "none";
}
}
}
</script>
<script>
function phasechange()
{
var phasetype=document.getElementById("phasetype").value;
if(phasetype=='31')
{
document.getElementById('i1').style.display="none";
document.getElementById('i3').style.display="block";
document.getElementById('o1').style.display="block";
document.getElementById('o3').style.display="none";
}
if(phasetype=='33')
{
document.getElementById('i1').style.display="none";
document.getElementById('i3').style.display="block";
document.getElementById('o1').style.display="none";
document.getElementById('o3').style.display="block";
}
if(phasetype=='11')
{
document.getElementById('i1').style.display="block";
document.getElementById('i3').style.display="none";
document.getElementById('o1').style.display="block";
document.getElementById('o3').style.display="none";
}
}
</script>
<script>
function customerchange()
{
var consigneeavailable=document.getElementById("consigneeavailable");
var customeravail=document.getElementById("customeravail");
var customeravail1=document.getElementById("customeravail1");
var customeravail2=document.getElementById("customeravail2");
if(consigneeavailable.value=='available')
{
customeravail.style.display="block";
customeravail1.style.display="block";
customeravail2.style.display="block";
document.getElementById("worktype").required = true;
document.getElementById("problemobserved").required = true;
document.getElementById("actiontaken").required = true;
document.getElementById("customerfeedback").required = true;
document.getElementById("engapproach").required = true;
document.getElementById("signname").required = true;
document.getElementById("engineerreport").required = true;
document.getElementById("callstatus").required = true;
}
else
{
customeravail.style.display="none";
customeravail1.style.display="block";
customeravail2.style.display="none";
var idsToDisableRequired = ["imgbefuploads","srno","worktype","make","capacity","stockitem","mfgcode","diagnosis","batterymake","batteryah","noofbattery","noofset","verification","problemobserved","directsunlight","wiringready","modificationwiring","waterdripping","coastelarea","pollutionlevel","moisture","acdata","stabilizer","phasereverse","earthing","overload","dcdata","batterycondition","sparesused","sparesrequired","actiontaken","gstno","email","mobile","servicecharges","imguploads","customerfeedback","signature","seal","manual","engineerapproach","inputsupply","dvstfree","earthingcheck","upsavailability","airconditioned","requesttime","inputvoltage","earthleakag","cleaning","softwarecheck","antiviruscheck","looseconnection","speedcheck","tempfilecleaning","hardwarecheck","printcheck","keyboard","mouse","functionproperly","problemexplained","customersuggestion","autosubmit","separateimage","termscondition","diagnosis","estimation","productimg","addmaterial","diagnosison","diagnosisremark","estimatedate","meterreading","producttype","pvmake","pvtype","pvcapacity","pvqty","pvslno","ntmake","nttype","ntcapacity","ntqty","ntslno","shadow","noofplstr","noofstr","tilt","plposter","civil","mechanical","elecwiring","acearth","dcearth","laearth","spvvol","spvcur","plvoc","plcell","plseries","plparallel","plvol","plangel","plpower","pltime","avgloadnight","avgloadday","totalload","engapproach","signname","phasetype"];
idsToDisableRequired.forEach(function(id) {
  var element = document.getElementById(id);
  if (element) {
    element.required = false;
  }
});
document.getElementById("engineerreport").required = true;
document.getElementById("callstatus").required = true;
}
}
</script>
<script>
(function(window) {
var $canvas,
onResize = function(event) {
$canvas.attr({
});
};
$(document).ready(function() {
//phasechange();
$canvas = $('canvas');
window.addEventListener('orientationchange', onResize, false);
window.addEventListener('resize', onResize, false);
onResize();
$('#clear').click(function() {
$('#signpad').signaturePad().clearCanvas();
});
$('#signpad').signaturePad({
drawOnly: true,
defaultAction: 'drawIt',
validateFields: false,
lineWidth: 0,
output :'.output',
sigNav: null,
name: null,
typed: null,
clear: '#clear',
typeIt: null,
drawIt: null,
typeItDesc: null,
drawItDesc: null
});
$("#btnSaveSign").click(function(e){
html2canvas([document.getElementById('pad')], {
onrendered: function (canvas) {
var canvas_img_data = canvas.toDataURL('image/png');
var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
//ajax call to save image inside folder
$.ajax({
url: 'save_sign.php',
data: { img_data:img_data },
type: 'post',
success: function (response) {
//console.log(response);
$("#signatureimg").attr("src",response);
$("#signatureimg").show();
$("#signature").val(response);
$("#signname").focus();
forceDownload(response);
}
});
},
backgroundColor: null,
});
});
});
}(this));
</script>
<script>
function image(thisImg) {
// var img = document.createElement("IMG");
// img.src = thisImg;
// img.className="img-fluid";
// document.getElementById('showData').appendChild(img);
var count = $('.imgcontainer .imgcontent').length;
count = Number(count) + 1;
$('.imgcontainer').append("<div class='imgcontent' id='imgcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgdelete' id='imgdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
url: "complaintups.php",
method: "POST",
allowedTypes:"jpg,png,jpeg",
fileName: "myfile",
multiple: true,
maxFileCount:5,
onSuccess:function(files,data,xhr)
{
var obj = JSON.parse(data);
console.log(obj.imglist);
image(obj.imglist);
var vals=$("#imguploads").val();
if(vals!='')
{
$("#imguploads").val(vals+','+obj.imglist);
}
else
{
$("#imguploads").val(obj.imglist);
}
$("#status").html("<font color='green'>Upload is success</font>");
},
onError: function(files,status,errMsg)
{
$("#status").html("<font color='red'>Upload is Failed</font>"+errMsg);
}
}
$("#mulitplefileuploader").uploadFile(settings);
});
</script>
<script>
function imageseal(thisImg) {
// var img = document.createElement("IMG");
// img.src = thisImg;
// img.className="img-fluid";
// document.getElementById('showData').appendChild(img);
var count = $('.imgsealcontainer .imgsealcontent').length;
count = Number(count) + 1;
$('.imgsealcontainer').append("<div class='imgsealcontent' id='imgsealcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgsealdelete' id='imgsealdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
url: "complaintups.php",
method: "POST",
allowedTypes:"jpg,png,jpeg",
fileName: "myfile",
multiple: true,
maxFileCount:1,
onSuccess:function(files,data,xhr)
{
var obj = JSON.parse(data);
console.log(obj.imglist);
imageseal(obj.imglist);
var vals=$("#imgseal").val();
if(vals!='')
{
$("#imgseal").val(vals+','+obj.imglist);
}
else
{
$("#imgseal").val(obj.imglist);
}
$("#statusseal").html("<font color='green'>Upload is success</font>");
},
onError: function(files,statusseal,errMsg)
{
$("#statusseal").html("<font color='red'>Upload is Failed</font>"+errMsg);
}
}
$("#mulitplefileuploaderseal").uploadFile(settings);
});
</script>
<script>
function imagemanual(thisImg) {
// var img = document.createElement("IMG");
// img.src = thisImg;
// img.className="img-fluid";
// document.getElementById('showData').appendChild(img);
var count = $('.imgmanualcontainer .imgmanualcontent').length;
count = Number(count) + 1;
$('.imgmanualcontainer').append("<div class='imgmanualcontent' id='imgmanualcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgmanualdelete' id='imgmanualdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
url: "complaintups.php",
method: "POST",
allowedTypes:"jpg,png,jpeg",
fileName: "myfile",
multiple: true,
maxFileCount:1,
onSuccess:function(files,data,xhr)
{
var obj = JSON.parse(data);
console.log(obj.imglist);
imagemanual(obj.imglist);
var vals=$("#imgmanual").val();
if(vals!='')
{
$("#imgmanual").val(vals+','+obj.imglist);
}
else
{
$("#imgmanual").val(obj.imglist);
}
$("#statusmanual").html("<font color='green'>Upload is success</font>");
},
onError: function(files,statusmanual,errMsg)
{
$("#statusmanual").html("<font color='red'>Upload is Failed</font>"+errMsg);
}
}
$("#mulitplefileuploadermanual").uploadFile(settings);
});
</script>
<script>
// Remove file
$('.imgcontainer').on('click','.imgcontent .imgdelete',function(){
var id = this.id;
var split_id = id.split('_');
var num = split_id[1];
// Get image source
var imgElement_src = $( '#imgcontent_'+num+' img' ).attr("src");
var deleteFile = confirm("Do you really want to Delete?");
if (deleteFile == true) {
var vals=$("#imguploads").val();
let newStr = vals.replace(imgElement_src+',', '');
newStr = newStr.replace(','+imgElement_src, '');
newStr = newStr.replace(imgElement_src, '');
$("#imguploads").val(newStr);
$('#imgcontent_'+num).remove();
// AJAX request
/* $.ajax({
url: 'complaintrems.php',
type: 'post',
data: {path: imgElement_src,request: 2},
success: function(response){
if(response == 1){
$('#imgcontent_'+num).remove();
}
}
}); */
}
});
</script>
<script>
// Remove file
$('.imgsealcontainer').on('click','.imgsealcontent .imgsealdelete',function(){
var id = this.id;
var split_id = id.split('_');
var num = split_id[1];
// Get image source
var imgElement_src = $( '#imgsealcontent_'+num+' img' ).attr("src");
var deleteFile = confirm("Do you really want to Delete?");
if (deleteFile == true) {
var vals=$("#imgseal").val();
let newStr = vals.replace(imgElement_src+',', '');
newStr = newStr.replace(','+imgElement_src, '');
newStr = newStr.replace(imgElement_src, '');
$("#imgseal").val(newStr);
$('#imgsealcontent_'+num).remove();
// AJAX request
/* $.ajax({
url: 'complaintrems.php',
type: 'post',
data: {path: imgElement_src,request: 2},
success: function(response){
if(response == 1){
$('#imgcontent_'+num).remove();
}
}
}); */
}
});
</script>
<script>
// Remove file
$('.imgmanualcontainer').on('click','.imgmanualcontent .imgmanualdelete',function(){
var id = this.id;
var split_id = id.split('_');
var num = split_id[1];
// Get image source
var imgElement_src = $( '#imgmanualcontent_'+num+' img' ).attr("src");
var deleteFile = confirm("Do you really want to Delete?");
if (deleteFile == true) {
var vals=$("#imgmanual").val();
let newStr = vals.replace(imgElement_src+',', '');
newStr = newStr.replace(','+imgElement_src, '');
newStr = newStr.replace(imgElement_src, '');
$("#imgmanual").val(newStr);
$('#imgmanualcontent_'+num).remove();
// AJAX request
/* $.ajax({
url: 'complaintrems.php',
type: 'post',
data: {path: imgElement_src,request: 2},
success: function(response){
if(response == 1){
$('#imgcontent_'+num).remove();
}
}
}); */
}
});
</script>
<script>
function forceDownload(href) {
var anchor = document.createElement('a');
anchor.href = href;
anchor.download = '<?=$_SESSION["calltid"]?>';
document.body.appendChild(anchor);
anchor.click();
}
</script>
<script>
function checkvalidate()
{
return confirm('Do you really want to submit the Service Report? \nOnce you submit you unable to change the details. \n\nAre you sure?');
var customernature=$("#customernature").val();
var callnature=$("#callnature").val();
var scharge=$("#scharge").val();
var callstatus=$("#callstatus").val();
if((document.getElementById('incgst').checked==true)||(document.getElementById('excgst').checked==true))
{
/* if(((customernature=='Out of Warranty')||(customernature=='Other Make'))&&(callstatus=='Completed')&&(callnature!='Maintanence'))
{
if((scharge=='')||(scharge=='0')||(scharge=='0.00'))
{
alert("This is an "+customernature+" Call. You must Collect Service Charge");
return false;
}
} */
}
else
{
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


<?php include('additionaljs.php');   ?>
</body>
</html>