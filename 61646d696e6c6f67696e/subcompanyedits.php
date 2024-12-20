<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
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
	$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
	$latlong=mysqli_real_escape_string($connection, $_POST['latlong']);

  $salesemail=mysqli_real_escape_string($connection, $_POST['salesemail']);
  $panno=mysqli_real_escape_string($connection, $_POST['panno']);
  $bankname=mysqli_real_escape_string($connection, $_POST['bankname']);
  $acno=mysqli_real_escape_string($connection, $_POST['acno']);
  $branchname=mysqli_real_escape_string($connection, $_POST['branchname']);
  $ifscode=mysqli_real_escape_string($connection, $_POST['ifscode']);
  $authsignold=mysqli_real_escape_string($connection, $_POST['authsignold']);
  $companysealold=mysqli_real_escape_string($connection, $_POST['companysealold']);

  $avatarold=mysqli_real_escape_string($connection, $_POST['avatarold']);
  
  
  $subject=mysqli_real_escape_string($connection, $_POST['subject']);
	$contentmessage=mysqli_real_escape_string($connection, $_POST['contentmessage']);
	$terms=mysqli_real_escape_string($connection, $_POST['terms']);
	$headerimageold=mysqli_real_escape_string($connection, $_POST['headerimageold']);
	$footerimageold=mysqli_real_escape_string($connection, $_POST['footerimageold']);
	$fontname=mysqli_real_escape_string($connection, $_POST['fontname']);
	$diffper=mysqli_real_escape_string($connection, $_POST['diffper']);
  
  
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


	if(($companynamevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcsubcompany WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			$sqlup = "update jrcsubcompany set companyname='$companynamevalue', companyshortname='$companyshortname', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', avatar='$avatar', latlong='$latlong', statecode='$statecode', gstno='$gstno', cinno='$cinno', salesemail='$salesemail', panno='$panno', bankname='$bankname', acno='$acno', branchname='$branchname', ifscode='$ifscode', authsign='$authsign', companyseal='$companyseal', subject='$subject', contentmessage='$contentmessage', terms='$terms', headerimage='$headerimage', footerimage='$footerimage', fontname='$fontname', diffper='$diffper' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Sub Company Information', '{$id}', 'jrcsubcompany')");
				header("Location: subcompany.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: subcompany.php?error=This record is Not Found! Kindly check in All Sub Company List");
			}
	}
	else
			{
				header("Location: subcompany.php?error=Error Data");
			}
			}
	else
			{
				header("Location: subcompany.php?error=Error Data");
			}
}
else
			{
				header("Location: subcompany.php");
			}
?>