<?php  
      // requires php5  
      define('UPLOAD_DIR', '../padhivetram/receiversig/');  
	  if (!is_dir(UPLOAD_DIR)) {
		mkdir(UPLOAD_DIR, 0777, true);
		}

      $rimg = $_POST['img_data1'];  
      $rimg = str_replace(' ', '+', $rimg);  
      $rdata = base64_decode($rimg);  
      $rfile = UPLOAD_DIR . uniqid() . '.png';  
      $rsuccess = file_put_contents($rfile, $rdata);  
      echo $rsuccess ? $rfile : 'Unable to save the file.';  
 ?>  