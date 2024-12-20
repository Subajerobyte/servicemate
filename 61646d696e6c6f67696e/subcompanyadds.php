<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
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
	$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
	$latlong=mysqli_real_escape_string($connection, $_POST['latlong']);

  $salesemail=mysqli_real_escape_string($connection, $_POST['salesemail']);
  $panno=mysqli_real_escape_string($connection, $_POST['panno']);
  $bankname=mysqli_real_escape_string($connection, $_POST['bankname']);
  $acno=mysqli_real_escape_string($connection, $_POST['acno']);
  $branchname=mysqli_real_escape_string($connection, $_POST['branchname']);
  $ifscode=mysqli_real_escape_string($connection, $_POST['ifscode']);

$subject=mysqli_real_escape_string($connection, $_POST['subject']);
	$contentmessage=mysqli_real_escape_string($connection, $_POST['contentmessage']);
	$terms=mysqli_real_escape_string($connection, $_POST['terms']);
	
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
        $avatar="";
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
        $authsign="";
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
        $companyseal="";
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
        $headerimage="";
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
        $footerimage="";
      }
    }
	
  }
  

	if(($companynamevalue!="")&&($companynamevalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcsubcompany WHERE companyname = '{$companynamevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcsubcompany( companyname, companyshortname, address1, address2, area, district, statecode, gstno, cinno, pincode, contact, phone, mobile, email, avatar, latlong, salesemail, panno, bankname,acno, branchname, ifscode, authsign, companyseal, subject, contentmessage, terms, headerimage, footerimage, fontname, diffper) VALUES ( '$companynamevalue', '$companyshortname', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$statecode', '$gstno', '$cinno', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue', '$avatar', '$latlong', '$salesemail', '$panno', '$bankname', '$acno', '$branchname', '$ifscode', '$authsign', '$companyseal', '$subject', '$contentmessage', '$terms', '$headerimage', '$footerimage', '$fontname', '$diffper')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Sub Company', '{$tid}', 'jrcsubcompany')");
				header("Location: subcompany.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: subcompany.php?error=This record is Already Found! Kindly check in All Sub Company List");
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