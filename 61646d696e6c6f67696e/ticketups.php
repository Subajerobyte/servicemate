<?php
include("lcheck.php");
//If directory doesnot exists create it.
$output_dir = "../padhivetram/tickets/";
$calltid=date('Y-m-d');
if(isset($_FILES["myfile"]))
{
	$ret = array();
	$error =$_FILES["myfile"]["error"];
	{
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
       	 	$fileName = $_FILES["myfile"]["name"];
       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$calltid.'-tic-'.$_FILES["myfile"]["name"]);
       	 	$ret['imglist']= $output_dir.$calltid.'-tic-'.$fileName;
		}
    	else
    	{
    	    $fileCount = count($_FILES["myfile"]['name']);
    		for($i=0; $i < $fileCount; $i++)
    		{
    		$fileName = $_FILES["myfile"]["name"][$i];
	       	$ret['imglist']= $output_dir.$calltid.'-tic-'.$fileName;
    		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$calltid.'-tic-'.$fileName );
			}
    	}
    }
    echo json_encode($ret);
}
?>