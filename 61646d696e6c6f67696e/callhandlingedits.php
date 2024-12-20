<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
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
		$avatarold=mysqli_real_escape_string($connection, $_POST['avatarold']);
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
	if(($callhandlingnamevalue!="")||($designationvalue!="")||($usernamevalue!=""))
	{		
		// Query if email exists in db
        $sqlcon = "SELECT id From jrccallhandling WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        // If query fails, show the reason 
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
        // Check if email exist
        if($rowCountcon > 0) 
		{	
			// Query if email exists in db
			$sqlup = "update jrccallhandling set callhandlingname='$callhandlingnamevalue', designation='$designationvalue', password='$passwordvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', avatar='$avatar' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			// If query fails, show the reason 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Support Executive Information', '{$id}')");
				header("Location: callhandling.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: callhandling.php?error=This record is Not Found! Kindly check in All Customer Support Executive List");
			}
	}
	else
			{
				header("Location: callhandling.php?error=Error Data");
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