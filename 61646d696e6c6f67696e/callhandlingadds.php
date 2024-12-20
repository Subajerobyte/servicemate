<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$callhandlingnamevalue=mysqli_real_escape_string($connection, $_POST['callhandlingname']);
	$designationvalue=mysqli_real_escape_string($connection, $_POST['designation']);
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
		$avatar="";
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
        
      }
    }
  }
  }
	if(($usernamevalue!="")&&($usernamevalue!="User Name(Unique)"))
	{		
		// Query if email exists in db
        $sqlcon = "SELECT id From jrccallhandling WHERE  username = '{$usernamevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        // If query fails, show the reason 
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
        // Check if email exist
        if($rowCountcon == 0) 
		{	
			// Query if email exists in db
			$sqlup = "INSERT INTO jrccallhandling( callhandlingname, designation, username, password, address1, address2, area, district, pincode, contact, phone, mobile, email, avatar) VALUES ( '$callhandlingnamevalue', '$designationvalue', '$usernamevalue', '$passwordvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue', '$avatar')";
			$queryup = mysqli_query($connection, $sqlup);
			// If query fails, show the reason 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Customer Support Executive', '{$tid}')");
				header("Location: callhandling.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: callhandling.php?error=This record is Already Found! Kindly check in All Customer Support Executive List");
			}
	}
	else
			{
				header("Location: callhandling.php?error=Error Data");
			}
}
else
			{
				header("Location: callhandling.php");
			}






?>