<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
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
		$avatarold=mysqli_real_escape_string($connection, $_POST['avatarold']);
		$incentiveper=(float)mysqli_real_escape_string($connection, $_POST['incentiveper']);
		$sincentiveper=(float)mysqli_real_escape_string($connection, $_POST['sincentiveper']);
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
	if(($adminusernamevalue!="")||($designationvalue!="")||($usernamevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcadminuser WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			$infopass=mysqli_fetch_array($querycon);
			if(md5($infopass['password'])==$passwordvalue)
			{
			  $sqlup = "update jrcadminuser set adminusername='$adminusernamevalue', designation='$designationvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', eligiblesales='$eligiblesalesvalue', avatar='$avatar', sincentiveper='$sincentiveper', incentiveper='$incentiveper' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			}
			else
			{
				 $sqlup = "update jrcadminuser set adminusername='$adminusernamevalue', designation='$designationvalue', password='$passwordvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', eligiblesales='$eligiblesalesvalue', avatar='$avatar', sincentiveper='$sincentiveper', incentiveper='$incentiveper' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			}
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
			    mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Administrator Details', '{$id}', 'jrcadminuser')");
	    $sqlcon1 = "SELECT * From jrcsalesperson WHERE email = '{$usernamevalue}'";
        $querycon1 = mysqli_query($connection, $sqlcon1);
        $rowCountcon1 = mysqli_num_rows($querycon1);
         
        if(!$querycon1){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountcon1 > 0) 
		{
	        $infoperson=mysqli_fetch_array($querycon1);
			if($infoperson['email']!="")
			{
			     mysqli_query($connection,"update jrcsalesperson set name='$adminusernamevalue', eligiblesales='$eligiblesalesvalue', sincentiveper='$sincentiveper' where email='$usernamevalue'");
			}
		}
			else
			{
				 mysqli_query($connection, "INSERT INTO jrcsalesperson (name, email, type, eligiblesales, sincentiveper) VALUES ('{$adminusernamevalue}', '{$usernamevalue}', 'Adminuser', '{$eligiblesalesvalue}', '{$sincentiveper}')");
			}
		
		
				header("Location: adminuser.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: adminuser.php?error=This record is Not Found! Kindly check in All Administrator List");
			}
	}
	else
			{
				header("Location: adminuser.php?error=Error Data");
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