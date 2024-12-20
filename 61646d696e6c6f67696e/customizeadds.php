<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$filename=mysqli_real_escape_string($connection, $_POST['filename']);
	$description=mysqli_real_escape_string($connection, $_POST['description']);
	
	if (!file_exists('img/customize'))
		{
    mkdir('img/customize', 0777, true);
        }
	$target_dir = "img/customize/";
$target_file = $target_dir . basename($_FILES["customizeupload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["customizeupload"]["tmp_name"]);
  if($check !== false) {
   //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
	 //echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
	//echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["customizeupload"]["size"] > 500000) {
	// echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	 //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["customizeupload"]["tmp_name"], $target_file)) {
    $customizeupload=$target_file;
  } else {
    $customizeupload="";
  }
}
	
		$msg = "";
  $msg_class = "";
	if(($filename!="")||($customizeupload!=""))
	{		
		 
        $sqlcon = "SELECT id From jrccustomize WHERE filename = '{$filename}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrccustomize(filename, description, customizeupload) VALUES ( '$filename','$description', '$customizeupload')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Expense Details', '{$tid}', 'jrccustomize')");
				if ($uploadOk == 0) {
	            header("Location: customize.php?error=Sorry, Your File Was Not Uploaded");
                 }
				 else 
				 {
				 header("Location: customize.php?remarks=Added Successfully");
                 }
			} 
	    }
		else
			{
				header("Location: customize.php?error=This record is Already Found! Kindly check in All Additional Materials List");
			}
	}
	else
			{
				header("Location: customize.php?error=Error Data");
			}
}
else
			{
				header("Location: customize.php");
			}
?>