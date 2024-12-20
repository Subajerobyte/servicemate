
<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow" >
  <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars text-white"></i>
  
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	
	
	
	
       <li class="nav-item active p-1">
        <a class="nav-link1 " href="letterprintings.php">
		 <div class="cardnav <?=(($current_file_name=='letterprintings.php')||($current_file_name=='letterprintingadd.php')||($current_file_name=='letterprintingedit.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
<i class="fas fa-print"></i> &nbsp;Letter Printing</div></div></a>
      </li> 
	  
	  <li class="nav-item active p-1">
       <a class="nav-link1 " href="invoicesubmission.php"> 
	    <div class="cardnav <?=(($current_file_name=='invoicesubmission.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-file-export"></i> &nbsp;Invoice Submission</div></div></a>
      </li>
	  
	  <li class="nav-item active p-1">
       <a class="nav-link1 " href="bulkemail.php"> 
	    <div class="cardnav <?=(($current_file_name=='bulkemail.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-mail-bulk"></i> &nbsp;Bulk E-mails</div></div></a>
      </li>
	  
	   <li class="nav-item active p-1">
       <a class="nav-link1 " href="filemanager.php"> 
	    <div class="cardnav <?=(($current_file_name=='filemanager.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fa fa-file"></i> &nbsp;File Manager</div></div></a>
      </li>
	  <?php
	  	if($companyid=='1')
				{
					////////jrc
					?>
	  <li class="nav-item active p-1" >
	   <?php
    // API URL
    $apiUrl = 'http://sms.tektrix.in/api/creditapi?key=3ca2502224cfe2ef09eeb478616eb524&route=2';

    // Make the API request
    $response = file_get_contents($apiUrl);

    if ($response) {
        // Parse the JSON response
        $data = json_decode($response, true);

        if (isset($data['Credits'])) {
            $credits = $data['Credits'];
           
        } 
    } 
    ?>
       <a class="nav-link1" >
<div class="cardnav ">
	 <div class="cardnav-body text-center">	   
	 <i class="fas fa-comments"></i> &nbsp;<b>Sms Remaining : <?=$credits?></b> 
	  
	  </div></div> </a>
      </li>
	  <?php
				}
				?>
    </ul>
  </div>
</nav>