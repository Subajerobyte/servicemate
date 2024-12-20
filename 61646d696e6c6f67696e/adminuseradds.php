
<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	$adminusernamevalue=mysqli_real_escape_string($connection, $_POST['adminusername']);
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
		$eligiblesalesvalue=mysqli_real_escape_string($connection, $_POST['eligiblesales']);
		$incentiveper=(float)mysqli_real_escape_string($connection, $_POST['incentiveper']);
		$sincentiveper=(float)mysqli_real_escape_string($connection, $_POST['sincentiveper']);
		$msg = "";
  $msg_class = "";
  $avatar = "";
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
		 
        $sqlcon = "SELECT id From jrcadminuser WHERE username = '{$usernamevalue}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcadminuser( adminusername, designation, username, password, address1, address2, area, district, pincode, contact, phone, mobile, email, eligiblesales, avatar, enabled, sincentiveper, incentiveper) VALUES ( '$adminusernamevalue', '$designationvalue', '$usernamevalue', '$passwordvalue', '$address1value', '$address2value', '$areavalue', '$districtvalue', '$pincodevalue', '$contactvalue', '$phonevalue', '$mobilevalue', '$emailvalue', '$eligiblesalesvalue', '$avatar','1','$sincentiveper', '$incentiveper')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Administrator', '{$tid}', 'jrcadminuser')");
				header("Location: adminuser.php?remarks=Added Successfully");
				mysqli_query($connection, "INSERT INTO jrcsalesperson (name, email, type, eligiblesales, sincentiveper) VALUES ('{$adminusernamevalue}', '{$usernamevalue}', 'Adminuser', '{$eligiblesalesvalue}', '{$sincentiveper}')");
			} 
	    }
		else
			{
				header("Location: adminuser.php?error=This record is Already Found! Kindly check in All Administrator List");
			}
	}
	else
			{
				header("Location: adminuser.php?error=Error Data");
			}
}
else
			{
				header("Location: adminuser.php");
			}






?>