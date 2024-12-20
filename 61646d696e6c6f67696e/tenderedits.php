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
	$tendervalue=mysqli_real_escape_string($connection, $_POST['tender']);
	$logo=mysqli_real_escape_string($connection, $_POST['logo']);
		$msg = "";
  $msg_class = "";
  
   $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
 
    $target_dir = "../padhivetram/tender/";
	
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); 
    //echo 'Directory created successfully.';
} else {
    //echo 'Directory already exists.';
} 
	
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
	  $error="1";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) 
	  {
		  $avatar=$target_file;
		  
      } else {
        $avatar=$logo;
      }
    }   
	

	if(($tendervalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrctender WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrctender set tender='$tendervalue', logo='$avatar' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Tender Type Information', '{$id}', 'jrctender')");
				header("Location: tender.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: tender.php?error=This record is Not Found! Kindly check in All Tender Type List");
			}
	}
	else
			{
				header("Location: tender.php?error=Error Data");
			}
			}
	else
			{
				header("Location: tender.php?error=Error Data");
			}
}
else
			{
				header("Location: tender.php");
			}
?>