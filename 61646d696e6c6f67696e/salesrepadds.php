<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$salesrepnamevalue=mysqli_real_escape_string($connection, $_POST['salesrepname']);
	$designationvalue=mysqli_real_escape_string($connection, $_POST['designation']);
	$compno=(float)mysqli_real_escape_string($connection, $_POST['compno']);
	$targetpoint=(float)mysqli_real_escape_string($connection, $_POST['targetpoint']);
	$compprefix=mysqli_real_escape_string($connection, $_POST['compprefix']);
		$usernamevalue=mysqli_real_escape_string($connection, $_POST['username']);
		$passwordvalue=mysqli_real_escape_string($connection, $_POST['password']);
		$address1value=mysqli_real_escape_string($connection, $_POST['address1']);
		$address2value=mysqli_real_escape_string($connection, $_POST['address2']);
		$areavalue=mysqli_real_escape_string($connection, $_POST['area']);
		$districtvalue=mysqli_real_escape_string($connection, $_POST['district']);
		$pincodevalue=mysqli_real_escape_string($connection, $_POST['pincode']);
		$contactvalue=mysqli_real_escape_string($connection, $_POST['contact']);
		$phonevalue=mysqli_real_escape_string($connection, $_POST['phone']);
		$mobilevalue=mysqli_real_escape_string($connection, $_POST['mobile']);
		$emailvalue=mysqli_real_escape_string($connection, $_POST['email']);
		$latlong=mysqli_real_escape_string($connection, $_POST['latlong']);
		$incentiveper=(float)mysqli_real_escape_string($connection, $_POST['incentiveper']);
		$sincentiveper=(float)mysqli_real_escape_string($connection, $_POST['sincentiveper']);
		$msg = "";
  $msg_class = "";
  if (isset($_POST['submit'])) {
	   if(file_exists($_FILES["profileImage"]["tmp_name"])) 
	{
    // for the database
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "../padhivetram/prof/";
    $target_file = $target_dir . basename($profileImageName);
	
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
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
		  $avatar=$target_file;
		  
      } else {
		   $avatar="";
        
      }
    }
	}
  }
	if(($usernamevalue!="")&&($usernamevalue!="User Name(Unique)"))
	{		
		 
        $sqlcon = "SELECT id From jrcsalesrep WHERE username = '{$usernamevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcsalesrep( salesrepname, designation, username, password, address1, address2, area, district, pincode, contact, phone, mobile, email, avatar, latlong, compno, compprefix,targetpoint, enabled, incentiveper, sincentiveper) VALUES ( '$salesrepnamevalue', '$designationvalue', '$usernamevalue', '$passwordvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue', '$avatar', '$latlong', '$compno', '$compprefix', '$targetpoint', '1', '$incentiveper', '$sincentiveper')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Engineer', '{$tid}')");
				mysqli_query($connection, "INSERT INTO jrcsalesperson (name, email, type,  sincentiveper) VALUES ('{$salesrepnamevalue}', '{$usernamevalue}', 'Sales Engineer',  '{$sincentiveper}')");
				header("Location: usersd.php?remarks=Engineer Added Successfully! Please Enable the Engineer!");
			} 
	    }
		else
			{
				header("Location: salesrep.php?error=This record is Already Found! Kindly check in All Sales Representative List");
			}
	}
	else
			{
				header("Location: salesrep.php?error=Error Data");
			}
}
else
			{
				header("Location: salesrep.php");
			}






?>