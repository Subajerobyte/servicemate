<?php
include('lcheck.php'); 

if(isset($_POST['submit']))
{
	$companynamevalue=mysqli_real_escape_string($connection, $_POST['companyname']);
	$companyshortname=mysqli_real_escape_string($connection, $_POST['companyshortname']);
	$address1value=mysqli_real_escape_string($connection, $_POST['address1']);
	$address2value=mysqli_real_escape_string($connection, $_POST['address2']);
	$areavalue=mysqli_real_escape_string($connection, $_POST['area']);
	$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
	$statecode=mysqli_real_escape_string($connection, $_POST['statecode']);
	$gstno=mysqli_real_escape_string($connection, $_POST['gstno']);
	$cinno=mysqli_real_escape_string($connection, $_POST['cinno']);
	$pincodevalue=mysqli_real_escape_string($connection, $_POST['pincode']);
	$contactvalue=mysqli_real_escape_string($connection, $_POST['contact']);
	$phonevalue=mysqli_real_escape_string($connection, $_POST['phone']);
	$mobilevalue=mysqli_real_escape_string($connection, $_POST['mobile']);
	$mobile1value=mysqli_real_escape_string($connection, $_POST['mobile1']);
	$mobile2value=mysqli_real_escape_string($connection, $_POST['mobile2']);
	$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
	$latlong=mysqli_real_escape_string($connection, $_POST['latlong']);

  $salesemail=mysqli_real_escape_string($connection, $_POST['salesemail']);
  $panno=mysqli_real_escape_string($connection, $_POST['panno']);
  $bankname=mysqli_real_escape_string($connection, $_POST['bankname']);
  $acno=mysqli_real_escape_string($connection, $_POST['acno']);
  $branchname=mysqli_real_escape_string($connection, $_POST['branchname']);
  $ifscode=mysqli_real_escape_string($connection, $_POST['ifscode']);
  $callhandlingid=mysqli_real_escape_string($connection, $_POST['callhandlingid']);
  $coordinatorid=mysqli_real_escape_string($connection, $_POST['coordinatorid']);
  $perkm=(float)mysqli_real_escape_string($connection, $_POST['perkm']);
  $authsignold=mysqli_real_escape_string($connection, $_POST['authsignold']);
  $companysealold=mysqli_real_escape_string($connection, $_POST['companysealold']);
  $headerimageold=mysqli_real_escape_string($connection, $_POST['headerimageold']);
  $footerimageold=mysqli_real_escape_string($connection, $_POST['footerimageold']);
  $gstreg=mysqli_real_escape_string($connection, $_POST['gstreg']);
  $legalname=mysqli_real_escape_string($connection, $_POST['legalname']);
  $tradename=mysqli_real_escape_string($connection, $_POST['tradename']);
  $gstregon=mysqli_real_escape_string($connection, $_POST['gstregon']);
  $comscheme=mysqli_real_escape_string($connection, $_POST['comscheme']);
  $comschemeval=mysqli_real_escape_string($connection, $_POST['comschemeval']);
  $revcharge=mysqli_real_escape_string($connection, $_POST['revcharge']);
  $avatarold=mysqli_real_escape_string($connection, $_POST['avatarold']);
  $qrcodeold=mysqli_real_escape_string($connection, $_POST['qrcodeold']);
  $amcprefix=mysqli_real_escape_string($connection, $_POST['amcprefix']);
  $serprefix=mysqli_real_escape_string($connection, $_POST['serprefix']);
  $estprefix=mysqli_real_escape_string($connection, $_POST['estprefix']);
  $shortname=mysqli_real_escape_string($connection, $_POST['shortname']);
  $currentyear=mysqli_real_escape_string($connection, $_POST['currentyear']);
  $financialyear=mysqli_real_escape_string($connection, $_POST['financialyear']);
  $month=mysqli_real_escape_string($connection, $_POST['month']);
  $runningserial=mysqli_real_escape_string($connection, $_POST['runningserial']);
  $rinvoiceno=mysqli_real_escape_string($connection, $_POST['rinvoiceno']);
  $serviceinvoice=mysqli_real_escape_string($connection, $_POST['serviceinvoice']);
  $dcno=mysqli_real_escape_string($connection, $_POST['dcno']);
  $invoiceno=mysqli_real_escape_string($connection, $_POST['invoiceno']);
  $invoiceser=mysqli_real_escape_string($connection, $_POST['invoiceser']);
  $somail=mysqli_real_escape_string($connection, $_POST['somail']);
	
		$msg = "";
  $msg_class = "";
   if (isset($_POST['submit'])) {
    // for the database
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "../padhivetram/prof/";
    $target_file = $target_dir . basename($profileImageName);
	$avatar=$target_file;
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
	  $error="1";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
      } else {
        $avatar=$avatarold;
      }
    }
  }
  
  if (isset($_POST['submit'])) {
    // for the database
    $qrcodeName = time() . '-' . $_FILES["qrImage"]["name"];
    // For image upload
    $target_dir = "../padhivetram/prof/";
    $target_file = $target_dir . basename($qrcodeName);
	$qrcode=$target_file;
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['qrImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
	  $error="1";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["qrImage"]["tmp_name"], $target_file)) {
      } else {
        $qrcode=$qrcodeold;
      }
    }
  }
  
  

  if (isset($_POST['submit'])) {
    // for the database
    $signImageName = time() . '-' . $_FILES["signImage"]["name"];
    // For image upload
    $target_dir = "../padhivetram/prof/";
    $target_file = $target_dir . basename($signImageName);
	$authsign=$target_file;
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['signImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
	  $error="1";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["signImage"]["tmp_name"], $target_file)) {
      } else {
        $authsign=$authsignold;
      }
    }
  }
  
  
  if (isset($_POST['submit'])) {
    // for the database
    $companysealImageName = time() . '-' . $_FILES["companysealImage"]["name"];
    // For image upload
    $target_dir = "../padhivetram/prof/";
    $target_file = $target_dir . basename($companysealImageName);
	$companyseal=$target_file;
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['companysealImage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
	  $error="1";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["companysealImage"]["tmp_name"], $target_file)) {
      } else {
        $companyseal=$companysealold;
      }
    }
  }
if (isset($_POST['submit'])) {
    // for the database
    $headerimageName = time() . '-' . $_FILES["headerimage"]["name"];
    // For image upload
    $target_dir = "../padhivetram/prof/";
    $target_file = $target_dir . basename($headerimageName);
	$headerimage=$target_file;
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['headerimage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
	  $error="1";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["headerimage"]["tmp_name"], $target_file)) {
      } else {
        $headerimage=$headerimageold;
      }
    }
}
if (isset($_POST['submit'])) {
	// for the database
    $footerimageName = time() . '-' . $_FILES["footerimage"]["name"];
    // For image upload
    $target_dir = "../padhivetram/prof/";
    $target_file = $target_dir . basename($footerimageName);
	$footerimage=$target_file;
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['footerimage']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
	  $error="1";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["footerimage"]["tmp_name"], $target_file)) {
      } else {
        $footerimage=$footerimageold;
      }
    }
	
  }
	 
$sqlcon = "SELECT id, companyid From jrccompany";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
 
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrccompany( companyname, companyshortname, address1, address2, area, district, statecode, gstno, cinno, pincode, contact, phone, mobile,mobile1,mobile2, email, avatar, qrcode, latlong, salesemail, panno, bankname,acno, branchname, ifscode, callhandlingid, coordinatorid, perkm, authsign, companyseal, headerimage, footerimage, gstreg, legalname, tradename, gstregon, comscheme, comschemeval, revcharge,serprefix,amcprefix,estprefix,shortname, currentyear, financialyear, month, runningserial,somail) VALUES ( '$companynamevalue', '$companyshortname', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$statecode', '$gstno', '$cinno', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue','$mobile1value','$mobile2value', '$emailvalue', '$avatar', '$qrcode', '$latlong', '$salesemail', '$panno', '$bankname', '$acno', '$branchname', '$ifscode', '$callhandlingid', '$coordinatorid', '$perkm', '$authsign', '$companyseal', '$headerimage', '$footerimage', '$gstreg', '$legalname', '$tradename', '$gstregon', '$comscheme', '$comschemeval', '$revcharge','$serprefix','$amcprefix','$estprefix', '$shortname', '$currentyear', '$financialyear', '$month', '$runningserial', '$somail')";
			$queryup = mysqli_query($connection, $sqlup);
      
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Company Information', '{$tid}')");
				//header("Location: companysettings.php?remarks=Added Successfully");
			} 
	    }
		else
		{
		$infos=mysqli_fetch_array($querycon);
		$sqlup = "update jrccompany set companyname='$companynamevalue', companyshortname='$companyshortname', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue',mobile1='$mobile1value',mobile2='$mobile2value', email='$emailvalue', avatar='$avatar', qrcode='$qrcode', latlong='$latlong', statecode='$statecode', gstno='$gstno', cinno='$cinno', salesemail='$salesemail', panno='$panno', bankname='$bankname', acno='$acno', branchname='$branchname', ifscode='$ifscode', callhandlingid='$callhandlingid', coordinatorid='$coordinatorid', perkm='$perkm', authsign='$authsign', companyseal='$companyseal', headerimage='$headerimage', footerimage='$footerimage' , gstreg='$gstreg', legalname='$legalname', tradename='$tradename', gstregon='$gstregon', comscheme='$comscheme', comschemeval='$comschemeval', revcharge='$revcharge', serprefix='$serprefix', estprefix='$estprefix', amcprefix='$amcprefix', shortname='$shortname', currentyear='$currentyear', financialyear='$financialyear', month='$month', runningserial='$runningserial', somail='$somail'";

		 $sqlup1 = "update jrccompany set companyname='$companynamevalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue',mobile1='$mobile1value',mobile2='$mobile2value', email='$emailvalue', avatar='$avatar', qrcode='$qrcode', latlong='$latlong', statecode='$statecode', gstno='$gstno', cinno='$cinno', salesemail='$salesemail', panno='$panno', bankname='$bankname', acno='$acno', branchname='$branchname', ifscode='$ifscode', callhandlingid='$callhandlingid', coordinatorid='$coordinatorid', perkm='$perkm', authsign='$authsign', companyseal='$companyseal', headerimage='$headerimage', footerimage='$footerimage' , gstreg='$gstreg', legalname='$legalname', tradename='$tradename', gstregon='$gstregon', comscheme='$comscheme', comschemeval='$comschemeval', revcharge='$revcharge', serprefix='$serprefix', estprefix='$estprefix', amcprefix='$amcprefix', shortname='$shortname', currentyear='$currentyear', financialyear='$financialyear', month='$month', runningserial='$runningserial', somail='$somail' where id='".$infos['companyid']."'";
		$queryup = mysqli_query($connection1, $sqlup1);
		$queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{ 
				mysqli_query($connection, "update jrcsrno set dnno = '$dcno' , invoiceno = '$invoiceno', invoiceser = '$invoiceser'");
				mysqli_query($connection, "update jrcinvoice set invoiceno = '$rinvoiceno' , serviceinvoice = '$serviceinvoice'");
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Company Information', '{$tid}')");
				header("Location: companysettings.php?remarks=Updated Successfully");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Company Settings</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
#signDisplay,#qrcodeDisplay, #companysealDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
.img-placeholder {
  width: 100px;
  color: white;
  height: 100px;
  background: black;
  opacity: .7;
  height: 125px;
  border-radius: 5%;
  z-index: 2;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder h4 {
  margin-top: 40%;
  color: white;
}
.img-div:hover .img-placeholder {
  display: block;
  cursor: pointer;
}
   </style>
   <style>
#headerDisplay, #footerDisplay { display: block; height: 100px; width: 100%; margin: 0px auto; border-radius:5%; }
.img-placeholder1 {
  width: 100%;
  color: white;
  height: 100px;
  background: black;
  opacity: .7;
  height: 135px;
  z-index: 2;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder1 h4 {
  margin-top:10%;
  color: white;
}
.img-div:hover .img-placeholder1 {
  display: block;
  cursor: pointer;
}
   </style>
 
</head>

<body id="page-top" onload="gstregyes()">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800 mt-2">Company Settings</h1>
          </div>
		  <?php
if(isset($_GET['remarks']))
{
?>	
<div class="alert alert-success shadow">
<?=$_GET['remarks']?>
</div>
<?php
}
 if(isset($_GET['error']))
{
?>	 
  <div class="alert alert-danger shadow">
<?=$_GET['error']?>
</div>
<?php
}
?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Company Settings</h6>
            </div>-->
<div class="card-body">
<?php
$sqlselect = "SELECT companyname, companyshortname, address1, address2, area, district, pincode, statecode, gstno, panno, cinno, contact, latlong, phone, mobile,mobile1,mobile2, email, salesemail, bankname, acno, branchname, ifscode, perkm, qrcode, avatar, authsign, companyseal, headerimage, footerimage, callhandlingid, coordinatorid, gstreg,  legalname, tradename, gstregon, comscheme, comschemeval, revcharge,amcprefix,estprefix,serprefix,shortname,currentyear,financialyear,month,runningserial,somail From jrccompany order by id asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		$rowselect = mysqli_fetch_array($queryselect);

$sqls=mysqli_query($connection,"select invoiceno, serviceinvoice from jrcinvoice");
$infos=mysqli_fetch_array($sqls);	

$sqls1=mysqli_query($connection,"select dnno, invoiceno, invoiceser from jrcsrno");
$infos1=mysqli_fetch_array($sqls1);		
			?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
<div class="col-lg-3">
 <label class="text-primary">Company Details</label>
 </div>
 </div>
<div class="row">
	<div class="col-lg-10">
	  <div class="form-group">
		<label for="companyname">Company Name</label>
		<input type="text" class="form-control" id="companyname" name="companyname" value="<?=$rowselect['companyname']?>">
	  </div>
	</div>
	<div class="col-lg-2">
	  <div class="form-group">
		<label for="companyshortname">Company Short Name</label>
		<input type="text" class="form-control" id="companyshortname" name="companyshortname" value="<?=$rowselect['companyshortname']?>" maxlength="4">
	  </div>
	</div>
	</div>
	<hr>
<div class="row">
<div class="col-lg-3">
 <label class="text-primary">Contact Details</label>
 </div>
 </div>
 
 <div class="row">
	<div class="col-lg-3">
      <div class="form-group">
    <label for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1" value="<?=$rowselect['address1']?>">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="address2">Address 2</label>
   <input type="text" class="form-control" id="address2" name="address2" value="<?=$rowselect['address2']?>">
  </div>
   </div>

<div class="col-lg-3">
    <div class="form-group">
		<label for="area">Area</label>
		<input type="text" class="form-control" id="area" name="area" value="<?=$rowselect['area']?>">
	</div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District</label>
    <input type="text" class="form-control" id="district" name="district" value="<?=$rowselect['district']?>">
  </div>
   </div>

 <div class="col-lg-3">
      <div class="form-group">
    <label for="pincode">Pincode</label>
    <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6" value="<?=$rowselect['pincode']?>">
  </div>
  </div>



<div class="col-lg-3">
  <div class="form-group">
    <label for="contact">Contact Person</label>
    <input type="text" class="form-control" id="contact" name="contact" value="<?=$rowselect['contact']?>">
  </div>
   </div>
    <div class="col-lg-3">
      <div class="form-group">
    <label for="latlong">LatLong </label><a onclick="openaddress()" class="float-right text-danger">Get LatLong</a>
    <input type="text" class="form-control" id="latlong" name="latlong" value="<?=$rowselect['latlong']?>" onKeyup="cleartext()">
  </div>
  </div>

<div class="col-lg-3">
      <div class="form-group">
    <label for="phone">Phone No</label>
    <input type="text" class="form-control" id="phone" name="phone" maxlength="11" value="<?=$rowselect['phone']?>">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="mobile">Mobile No</label>
    <input type="text" class="form-control" id="mobile" name="mobile" value="<?=$rowselect['mobile']?>">
  </div>
   </div>
   <div class="col-lg-3">
  <div class="form-group">
    <label for="mobile1">Additional Mobile No:1</label>
    <input type="text" class="form-control" id="mobile1" name="mobile1" value="<?=$rowselect['mobile1']?>">
  </div>
   </div>  
   <div class="col-lg-3">
  <div class="form-group">
    <label for="mobile2">Additional Mobile No:2</label>
    <input type="text" class="form-control" id="mobile2" name="mobile2" value="<?=$rowselect['mobile2']?>">
  </div>
   </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?=$rowselect['email']?>">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="salesemail">Email (Sales)</label>
    <input type="email" class="form-control" id="salesemail" name="salesemail" value="<?=$rowselect['salesemail']?>">
  </div>
   </div>
   </div>
   <hr>
  <div class="row">
	<div class="col-lg-3">
	  <div class="form-group">
	  <label class="text-primary">Call Id Details</label ><br>
	  </div>
	</div>
	</div>
	<div class="row">
  <div class="col-lg-2">
  <div class="form-group">
    <label for="shortname">Prefix - 1</label>
	<select class="form-control fav_clr" name="shortname" id="shortname">
	<option value="">Select</option>
	 <option value="Company Short Name"<?=($rowselect['shortname']=="Company Short Name")?'selected':''?>>Company Short Name</option>
		</select>
   </div>
   </div> 
   <div class="col-lg-2">
  <div class="form-group">
    <label for="currentyear">Prefix - 2</label>
	<select class="form-control fav_clr" name="currentyear" id="currentyear">
	  <option value="">Select</option>
	 <option value="2-Digit Current Year"<?=($rowselect['currentyear']=="2-Digit Current Year")?'selected':''?>>2-Digit Current Year</option>
	 <option value="4-Digit Current Year"<?=($rowselect['currentyear']=="4-Digit Current Year")?'selected':''?>>4-Digit Current Year</option>
		</select>
   </div>
   </div> 
   <div class="col-lg-2">
  <div class="form-group">
    <label for="financialyear">Prefix - 3</label>
	<select class="form-control fav_clr" name="financialyear" id="financialyear">
	<option value="">Select</option>
	 <option value="Financial Year 2 digit Start & End"<?=($rowselect['financialyear']=="Financial Year 2 digit Start & End")?'selected':''?>>Financial Year 2 digit Start & End</option>
	 <option value="Financial Year 4 digit Start & End"<?=($rowselect['financialyear']=="Financial Year 4 digit Start & End")?'selected':''?>>Financial Year 4 digit Start & End</option>
		</select>
   </div>
   </div>
   <div class="col-lg-2">
  <div class="form-group">
    <label for="month">Prefix - 4</label>
	<select class="form-control fav_clr" name="month" id="month">
	<option value="">Select</option>
	 <option value="2-Digit Month"<?=($rowselect['month']=="2-Digit Month")?'selected':''?>>2-Digit Month</option>
	 <option value="Month In Alphabet"<?=($rowselect['month']=="Month In Alphabet")?'selected':''?>>Month In Alphabet</option>
		</select>
   </div>
   </div>
   <div class="col-lg-2">
  <div class="form-group">
    <label for="runningserial">Running Serial</label>
    <input type="runningserial" class="form-control" id="runningserial" name="runningserial" value="<?=($rowselect['runningserial']!='')?$rowselect['runningserial']:'00001'?>" readonly>
  </div>
   </div>
   </div>
   <hr>
   <div class="row">
	<div class="col-lg-3">
	  <div class="form-group">
	  <label class="text-primary">Serial No Details</label ><br>
	  </div>
	</div>
	</div>
	<div class="row">
  <div class="col-lg-2">
  <div class="form-group">
    <label for="rinvoiceno">Regular Sales Order No</label>
	<input type="number" class="form-control" id="rinvoiceno" name="rinvoiceno" maxlength="15" value="<?=$infos['invoiceno']?>">
   </div>
   </div>
   <div class="col-lg-2">
  <div class="form-group">
    <label for="serviceinvoice">Service Sales Order No</label>
	<input type="number" class="form-control" id="serviceinvoice" name="serviceinvoice" maxlength="15" value="<?=$infos['serviceinvoice']?>">
   </div>
   </div> 
   <div class="col-lg-2">
  <div class="form-group">
    <label for="dcno">Delivery Challan No</label>
	<input type="number" class="form-control" id="dcno" name="dcno" maxlength="15" value="<?=$infos1['dnno']?>">
   </div>
   </div> 
   <div class="col-lg-2">
  <div class="form-group">
    <label for="invoiceno">Product Invoice No</label>
	<input type="number" class="form-control" id="invoiceno" name="invoiceno" maxlength="15" value="<?=$infos1['invoiceno']?>">
   </div>
   </div>
   
   <div class="col-lg-2">
  <div class="form-group">
    <label for="invoiceser">Service Invoice No</label>
	<input type="number" class="form-control" id="invoiceser" name="invoiceser" maxlength="15" value="<?=$infos1['invoiceser']?>">
   </div>
   </div>
	<div class="col-lg-2">
	  <div class="form-group">
		<label for="somail">To Send Mail</label>
		<input type="email" class="form-control" id="somail" name="somail" value="<?=$rowselect['somail']?>">
	  </div>
	   </div>

   </div>
   <hr>
  <div class="row">
	<div class="col-lg-3">
	  <div class="form-group">
	  <label class="text-primary">GST Details</label ><br>
	  </div>
	</div>
	</div>
	<div class="row"> 
   <div class="col-lg-3">
	  <div class="form-group">
	  <label for="gstreg" > Is your business registered for GST?</label ><br>
	  </div>
	</div>
	<div class="col-lg-3">
	  <div class="form-group">
	<label class="mr-2"><input type="radio" name="gstreg" id="gstreg" value="1" <?=($rowselect['gstreg']=='1')?"checked":""?> onclick="gstregyes()"> Yes </label>
	<label class="mr-2"><input type="radio" name="gstreg" id="gstreg" value="0" <?=($rowselect['gstreg']=='0')?"checked":""?> onclick="gstregyes()" > No </label>
	  </div>
	</div> 
  </div>
  <div id="gst" style="display:none" onchange="gstregyes()">
  
  <div class="row">
  <div class="col-lg-4">
  <div class="form-group">
    <label for="statecode">State Code</label>
	<select class="form-control" name="statecode" id="statecode">
	<option value="">Select</option>
	<?php $sqlselect1 = "SELECT id,statecode From jrcplace";
	$queryselect1 = mysqli_query($connection, $sqlselect1);
	
	while($rowselect1 = mysqli_fetch_array($queryselect1)){
	?>
						  <option value="<?=$rowselect1['statecode']?>"<?=$rowselect1['statecode']==$rowselect['statecode']?'selected':''?>><?=$rowselect1['statecode']?></option>
	<?php
	}
					 ?>
		</select>
   </div>
   </div>

	<div class="col-lg-4">
	  <div class="form-group" id="gstno">
		 <label for="gstno">GST No</label>
    <input type="text" class="form-control" id="gstno" name="gstno" maxlength="15" value="<?=$rowselect['gstno']?>">
  </div>
	</div>
	<div class="col-lg-4">
	<div class="form-group" id="gstregon">
		<label for="gstregon">GST Registered On</label>
		<input type="date" class="form-control" id="gstregon" name="gstregon" value="<?=$rowselect['gstregon']?>" >
	  </div>
	  </div>
	<div class="col-lg-6">
	  <div class="form-group" id="tradename">
		<label for="tradename">Business Trade Name</label>
		<input type="text" class="form-control" id="tradename" name="tradename" value="<?=$rowselect['tradename']?>">
	  </div>
	</div>
	
	<div class="col-lg-6">
	  <div class="form-group" id="legalname">
		<label for="legalname">Business Legal Name</label>
		<input type="text" class="form-control" id="legalname" name="legalname" value="<?=$rowselect['legalname']?>">
	  </div>
	</div>
	<div class="col-lg-6">
	  <div class="form-group" id="comschemeval1">
		<label for="comschemeval">Composition Scheme</label>
		<label class="mr-2"><input type="checkbox" id="comschemeval" name="comschemeval" value="My Business is Registered for Composition Scheme" <?=($rowselect['comschemeval']=='My Business is Registered for Composition Scheme')?"checked":""?>  onchange="gstscheme()"> My Business is Registered for Composition Scheme</label>
		
		<div id="composition" style="display:none" onchange="gstscheme()">
		<label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="1% (For Traders and Manufacturers)" <?=($rowselect['comscheme']=='1% (For Traders and Manufacturers)')?"checked":""?>> 1% (For Traders and Manufacturers)</label><br>
		<label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="2% (For Manufacturers - GSTN has lowered the rate for manufacturers to 1%)" <?=($rowselect['comscheme']=='2% (For Manufacturers - GSTN has lowered the rate for manufacturers to 1%)')?"checked":""?>> 2% (For Manufacturers - GSTN has lowered the rate for manufacturers to 1%)</label><br>
	    <label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="5% (For Restaurant sector)" <?=($rowselect['comscheme']=='5% (For Restaurant sector)')?"checked":""?>> 5% (For Restaurant sector)</label><br>
	    <label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="6% (For Suppliers of Services or Mixed Suppliers)" <?=($rowselect['comscheme']=='6% (For Suppliers of Services or Mixed Suppliers)')?"checked":""?>> 6% (For Suppliers of Services or Mixed Suppliers)</label>
	  </div>
	  </div>
		</div>
     <div class="col-lg-6">
	  <div class="form-group" id="revcharge">
		<label for="revcharge">Reverse Charge</label>
		<input type="checkbox" name="revcharge" id="revcharge" value="Enable Reverse Charge in Sales Transactions" <?=($rowselect['revcharge']=='Enable Reverse Charge in Sales Transactions')?"checked":""?>> Enable Reverse Charge in Sales Transactions
	  </div>
	</div>
  </div>
  </div>
 <div class="row">

	
  <div class="col-lg-3">
      <div class="form-group">
    <label for="gstno">PAN No</label>
    <input type="text" class="form-control" id="panno" name="panno" maxlength="11" value="<?=$rowselect['panno']?>">
  </div>
  </div>

  <div class="col-lg-3">
  <div class="form-group">
    <label for="cinno">CIN</label>
    <input type="text" class="form-control" id="cinno" name="cinno" value="<?=$rowselect['cinno']?>">
  </div>
   </div>
   </div>
   
   <hr>
  <div class="row">
<div class="col-lg-3">
 <label class="text-primary">Bank Details</label>
 </div>
 </div>
 <div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label for="bankname">Bank Name</label>
    <input type="text" class="form-control" id="bankname" name="bankname" value="<?=$rowselect['bankname']?>" maxlength="50">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="acno">Account No</label>
    <input type="text" class="form-control" id="acno" name="acno" value="<?=$rowselect['acno']?>" maxlength="50">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="branchname">Branch Name</label>
    <input type="text" class="form-control" id="branchname" name="branchname" value="<?=$rowselect['branchname']?>" maxlength="50">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="ifscode">IFSCode</label>
    <input type="text" class="form-control" id="ifscode" name="ifscode" value="<?=$rowselect['ifscode']?>" maxlength="50">
  </div>
   </div> 
   </div>
   <hr>
  <div class="row">
<div class="col-lg-3">
 <label class="text-primary">Default Settings</label>
 </div>
 </div>
 <div class="row">
     <div class="col-lg-3">
  <div class="form-group">
    <label for="perkm">Allowance Per KM</label>
    <input type="number" class="form-control" id="perkm" name="perkm"  value="<?=$rowselect['perkm']?>" maxlength="3">
  </div>
   </div>
   <div class="col-lg-3">
  <div class="form-group">
    <label for="callhandlingname">Default Call Handled By</label>	
	<select class="form-control fav_clr" id="callhandlingid" name="callhandlingid">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser order by adminusername asc";
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
				<option value="<?=$rowrep['id']?>" <?=(($rowrep['id']==$rowselect['callhandlingid'])?"selected":"")?>><?=$rowrep['adminusername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
   </div>
   <div class="col-lg-3">
      <div class="form-group">
    <label for="coordinatorname">Default Co-Ordinator Assigned</label>
	<select class="form-control fav_clr" id="coordinatorid" name="coordinatorid">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser order by adminusername asc";
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
				<option value="<?=$rowrep['id']?>" <?=(($rowrep['id']==$rowselect['coordinatorid'])?"selected":"")?>><?=$rowrep['adminusername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>

     <div class="col-lg-3">
  <div class="form-group">
    <label for="serprefix">Service Prefix</label>
    <input type="text" class="form-control" id="serprefix" name="serprefix"  value="<?=$rowselect['serprefix']?>" maxlength="3">
  </div>
   </div>
    <div class="col-lg-3">
  <div class="form-group">
    <label for="amcprefix">AMC Prefix</label>
    <input type="text" class="form-control" id="amcprefix" name="amcprefix"  value="<?=$rowselect['amcprefix']?>" maxlength="3">
  </div>
   </div>
   <div class="col-lg-3">
  <div class="form-group">
    <label for="estprefix">Estimate Prefix</label>
    <input type="text" class="form-control" id="estprefix" name="estprefix" value="<?=$rowselect['estprefix']?>" maxlength="3">
  </div>
   </div>


   </div>


    <hr>
  <div class="row">
<div class="col-lg-3">
 <label class="text-primary">Logo and Official Settings</label>
 </div>
 </div>
 <div class="row">
	<div class="col-lg-3">
		<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick2()">
                <h4>QR CODE</h4>
              </div>
			  <input type="hidden" name="qrcodeold" id="qrcodeold" value="<?=$rowselect['qrcode']?>">
			  <?php
			  if($rowselect['qrcode']!='')
			  {
				?>  
              <img src="<?=$rowselect['qrcode']?>" onClick="triggerClick2()" id="qrcodeDisplay">
			  <?php
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerClick2()" id="qrcodeDisplay">
			  <?php
			  }	  
			  ?>
            </span>
            <input type="file" name="qrImage" onChange="displayImage3(this)" id="qrImage" class="form-control" accept="image/*" style="display: none;">
            <label>QR CODE</label>
        </div>
   </div>
	
   <div class="col-lg-3">
		<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <h4>Company Logo</h4>
              </div>
			  <input type="hidden" name="avatarold" id="avatarold" value="<?=$rowselect['avatar']?>">
			  <?php
			  if($rowselect['avatar']!='')
			  {
				?>  
              <img src="<?=$rowselect['avatar']?>" onClick="triggerClick()" id="profileDisplay">
			  <?php
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerClick()" id="profileDisplay">
			  <?php
			  }	  
			  ?>
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" accept="image/*" style="display: none;">
            <label>Company Logo</label>
        </div>
   </div>

   <div class="col-lg-3">
		<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick1()">
                <h4>Authorized Signature</h4>
              </div>
			  <input type="hidden" name="authsignold" id="authsignold" value="<?=$rowselect['authsign']?>">
			  <?php
			  if($rowselect['authsign']!='')
			  {
				?>  
              <img src="<?=$rowselect['authsign']?>" onClick="triggerClick1()" id="signDisplay">
			  <?php
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerClick1()" id="signDisplay">
			  <?php
			  }	  
			  ?>
            </span>
            <input type="file" name="signImage" id="signImage" onChange="displayImage1(this)" class="form-control" accept="image/*" style="display: none;">
            <label>Authorised Signature</label>
        </div>
   </div>

   <div class="col-lg-3">
		<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggercompanysealClick1()">
                <h4>Company Seal</h4>
              </div>
			  <input type="hidden" name="companysealold" id="companysealold" value="<?=$rowselect['companyseal']?>">
			  <?php
			  if($rowselect['companyseal']!='')
			  {
				?>  
              <img src="<?=$rowselect['companyseal']?>" onClick="triggercompanysealClick1()" id="companysealDisplay">
			  <?php
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggercompanysealClick1()" id="companysealDisplay">
			  <?php
			  }	  
			  ?>
            </span>
            <input type="file" name="companysealImage" onChange="displaycompanysealImage1(this)" id="companysealImage" class="form-control" accept="image/*" style="display: none;">
            <label>Company Seal</label>
        </div>
   </div>



  </div>
 <div class="row">
  <div class="col-lg-6">
   <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder1"  onClick="triggerheaderclick1()">
                <h4>Letter Header</h4>
              </div>
			  <input type="hidden" name="headerimageold" id="headerimageold" value="<?=$rowselect['headerimage']?>">
			  <?php
			  if($rowselect['headerimage']!='')
			  {
				?>  
              <img src="<?=$rowselect['headerimage']?>" onClick="triggerheaderclick1()" id="headerDisplay">
			  <?php
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerheaderclick1()" id="headerDisplay">
			  <?php
			  }	  
			  ?>
            </span>
            <input type="file" name="headerimage" onChange="displayheaderImage1(this)" id="headerImage" class="form-control" accept="image/*" style="display: none;">
            <label>Letter Header</label>
        </div>
   </div>
 
 <div class="col-lg-6">
   <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder1"  onClick="triggerfooterclick1()">
                <h4>Letter Footer</h4>
              </div>
			  <input type="hidden" name="footerimageold" id="footerimageold" value="<?=$rowselect['footerimage']?>">
			  <?php
			  if($rowselect['footerimage']!='')
			  {
				?>  
              <img src="<?=$rowselect['footerimage']?>" onClick="triggerfooterclick1()" id="footerDisplay">
			  <?php
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerfooterclick1()" id="footerDisplay">
			  <?php
			  }	  
			  ?>
            </span>
            <input type="file" name="footerimage" onChange="displayfooterImage1(this)" id="footerImage" class="form-control" accept="image/*" style="display: none;">
            <label>Letter Footer</label>
        </div>
   </div>
  
</div>
  <br>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

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
     $( "#companyname" ).autocomplete({
       source: 'engineersearch.php?type=companyname',
     });
	 $( "#designation" ).autocomplete({
       source: 'engineersearch.php?type=designation',
     });
	 $( "#username" ).autocomplete({
       source: 'engineersearch.php?type=username',
     });
  });
</script>
<script>
var password = document.getElementById("password");
password.addEventListener('keyup', function() {

  var pwd = password.value

  // Reset if password length is zero
  if (pwd.length === 0) {
    document.getElementById("progresslabel").innerHTML = "";
    document.getElementById("progress").value = "0";
    return;
  }

  // Check progress
  var prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
    .reduce((memo, test) => memo + test.test(pwd), 0);

  // Length must be at least 8 chars
  if(prog > 2 && pwd.length > 7){
    prog++;
  }

  // Display it
  var progress = "";
  var strength = "";
  switch (prog) {
    case 0:
    case 1:
    case 2:
      strength = "25%";
      progress = "25";
      break;
    case 3:
      strength = "50%";
      progress = "50";
      break;
    case 4:
      strength = "75%";
      progress = "75";
      break;
    case 5:
      strength = "100% - Password strength is good";
      progress = "100";
      break;
  }
  document.getElementById("progresslabel").innerHTML = strength;
  document.getElementById("progress").value = progress;

});
</script>
<script>
function checkvalidate()
{
	if(document.getElementById("progress").value!="100")
	{
		alert("Kindly give Strength Password");
		document.getElementById("password").focus();
		return false;
	}
}
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClick2(e) {
  document.querySelector('#qrImage').click();
}
function displayImage3(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#qrcodeDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}


function triggerClick1(e) {
  document.querySelector('#signImage').click();
}
function displayImage1(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#signDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggercompanysealClick1(e) {
  document.querySelector('#companysealImage').click();
}
function displaycompanysealImage1(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#companysealDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}


function triggerheaderclick1(e) {
  document.querySelector('#headerImage').click();
}
function displayheaderImage1(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#headerDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerfooterclick1(e) {
  document.querySelector('#footerImage').click();
}
function displayfooterImage1(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#footerDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
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
$(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  dropdownAutoWidth : true,
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
</script><script>
function gstregyes()
		{
			var gstreg=document.getElementById("gstreg");
			var gst=document.getElementById("gst");

			if(gstreg.checked==true)
			{
				gst.style.display="block";
			}
			else
			{
				gst.style.display="none";
			}
			gstscheme();
		}
		</script>
		<script>
function gstscheme()
		{
			var comschemeval=document.getElementById("comschemeval");
			var composition=document.getElementById("composition");

			if(comschemeval.checked==true)
			{
				composition.style.display="block";
			}
			else
			{
				composition.style.display="none";
			}
		}
		</script>
		<?php include('additionaljs.php');   ?>
</body>

</html>
