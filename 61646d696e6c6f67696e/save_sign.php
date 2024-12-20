<?php  
      // requires php5  
      define('UPLOAD_DIR', '../padhivetram/sig/');  
      $img = $_POST['img_data'];  
      $img = str_replace(' ', '+', $img);  
      $data = base64_decode($img);  
      $file = UPLOAD_DIR . uniqid() . '.png';  
      $success = file_put_contents($file, $data);  
      echo $success ? $file : 'Unable to save the file.';  
 ?>  