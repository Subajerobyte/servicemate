<?php
include("lcheck.php");

function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
} 

$output_dir = "../padhivetram/site/";
$calltid=$_SESSION['calltid'];
//If directory doesnot exists create it.
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["myfile"]["name"];
			$compressedImage = compressImage($_FILES["myfile"]["tmp_name"], $output_dir.$calltid.'-'.$_FILES["myfile"]["name"], 40); 
       	 	//move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$calltid.'-'.$_FILES["myfile"]["name"]);
       	 	$ret['imglist']= $output_dir.$calltid.'-'.$fileName;
		}
    	else
    	{
    	     $fileCount = count($_FILES["myfile"]['name']);
    		  for($i=0; $i < $fileCount; $i++)
    		  {
    		  	$fileName = $_FILES["myfile"]["name"][$i];
	       	 	 $ret['imglist']= $output_dir.$calltid.'-'.$fileName;
				 $compressedImage = compressImage($_FILES["myfile"]["tmp_name"][$i], $output_dir.$calltid.'-'.$fileName, 40); 
    		   //move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$calltid.'-'.$fileName );
			  }
    	
    	}
    }
    echo json_encode($ret);
 
}

?>