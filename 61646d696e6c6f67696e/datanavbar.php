<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">
  <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars text-white"></i>
  
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	
       <li class="nav-item active p-1">
        <a class="nav-link1"  href="upload.php">
		<div class="cardnav <?=(($current_file_name=='upload.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-file-alt"></i> &nbsp;Import Data (CSV File)</div></div></a>
      </li>
	  <li class="nav-item active p-1">
        <a class="nav-link1"  href="uploadsalesorder.php">
		<div class="cardnav <?=(($current_file_name=='uploadsalesorder.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-file-alt"></i> &nbsp;Import Sales Order (CSV File)</div></div></a>
      </li>
	  <li class="nav-item active p-1">
       <a class="nav-link1"  href="uploadtally.php"> 
	   <div class="cardnav <?=(($current_file_name=='uploadtally.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-file-archive"></i> &nbsp;Import Data (Tally Day book)</div></div></a>
      </li> 
	  <li class="nav-item active p-1">
       <a class="nav-link1"  href="uploadxml.php"> 
	   <div class="cardnav <?=(($current_file_name=='uploadxml.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-file-export"></i> &nbsp;Import Data(Xml File)</div></div></a>
      </li>
	  <li class="nav-item active p-1">
       <a class="nav-link1" href="uploadhistory.php"> 
	   <div class="cardnav  <?=(($current_file_name=='uploadhistory.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-history"></i> &nbsp;Import Data History</div></div></a>
      </li>
	  <li class="nav-item active p-1">
       <a class="nav-link1" href="warrantymissing.php"> 
	   <div class="cardnav <?=(($current_file_name=='warrantymissing.php'))?'active':''?>" >
	 <div class="cardnav-body text-center">
	   <i class="fas fa-mail-bulk"></i> &nbsp;Warranty Missing Invoices</div></div></a>
      </li>
		<!--li class="nav-item active p-1">
		<a class="nav-link1"  href="consigneemerge.php">
		<div class="cardnav <?=($current_file_name=='consigneemerge.php')?'active':''?>" >
	 <div class="cardnav-body text-center">
		<i class="fas fa-code-merge"></i> &nbsp;Merge Customer</div></div></a>
		</li>
		<li class="nav-item active p-1">
		<a class="nav-link1"   href="consigneeunique.php">
		<div class="cardnav <?=($current_file_name=='consigneeunique.php')?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-solid fa-user-tag"></i> &nbsp;Unique Customer</div></div></a>
		</li-->
	       
    </ul>
  </div>
</nav>