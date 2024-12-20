
<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">
  <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars text-white"></i>
    </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
<li class="nav-item active p-1">
<a class="nav-link1" href="consignee.php">
	<div class="cardnav <?=(($current_file_name=='consignee.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-file-alt"></i>Customer Details</div></div></a>
      </li>
<li class="nav-item active p-1">
<a class="nav-link1" href="consigneesearch1.php">
<div class="cardnav <?=(($current_file_name=='consigneesearch1.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-file-alt"></i>Search Customer</div></div></a>
</li>


	<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='warrantycustomersall.php')||($current_file_name=='warrantycustomers.php')||($current_file_name=='warrantycustomersexpired.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='warrantycustomersall.php')||($current_file_name=='warrantycustomers.php')||($current_file_name=='warrantycustomersexpired.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-users"></i> &nbsp; 
     <span class="dropdown-toggle ">&nbsp; Warranty Customers</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='warrantycustomersall.php'))?'active':''?>" href="warrantycustomersall.php"><i class="fas fa-users"></i>&nbsp;Warranty Customers </a>
<a class="dropdown-item <?=(($current_file_name=='warrantycustomers.php'))?'active':''?>" href="warrantycustomers.php"><i class="fas fa-users"></i>&nbsp;Warranty to Expire Customers</a>
<a class="dropdown-item <?=(($current_file_name=='warrantycustomersexpired.php'))?'active':''?>" href="warrantycustomersexpired.php"><i class="fas fa-users"></i>&nbsp;Warranty Expired Customers</a>

</div>
</li>

	<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='amccustomers.php')||($current_file_name=='amcgoingtoexpirecustomers.php')||($current_file_name=='amcexpiredcustomers.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='amccustomers.php')||($current_file_name=='amcgoingtoexpirecustomers.php')||($current_file_name=='amcexpiredcustomers.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-user-friends"></i> &nbsp; 
     <span class="dropdown-toggle ">&nbsp; AMC Customers</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='amccustomers.php'))?'active':''?>" href="amccustomers.php"><i class="fas fa-user-friends"></i>&nbsp;AMC Customers </a>
<a class="dropdown-item <?=(($current_file_name=='amcgoingtoexpirecustomers.php'))?'active':''?>" href="amcgoingtoexpirecustomers.php"><i class="fas fa-user-friends"></i>&nbsp;AMC to Expire Customers</a>
<a class="dropdown-item <?=(($current_file_name=='amcexpiredcustomers.php'))?'active':''?>" href="amcexpiredcustomers.php"><i class="fas fa-user-friends"></i>&nbsp;AMC Expired Customers</a>

</div>
</li>
<li class="nav-item active p-1">
<a class="nav-link1" href="consigneemerge.php">
<div class="cardnav <?=(($current_file_name=='consigneemerge.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-file-alt"></i>Merge Customer Details</div></div></a>
</li>
<li class="nav-item active p-1">
<a class="nav-link1" href="consigneeunique.php">
<div class="cardnav <?=(($current_file_name=='consigneeunique.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-solid fa-user-tag"></i>Unique Customer</div></div></a>
</li>
<li class="nav-item active p-1">
<a class="nav-link1" href="mapcustomers.php">
<div class="cardnav <?=(($current_file_name=='mapcustomers.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-map-marked-alt"></i>Customer Location</div></div></a>
</li>


</ul>
</div>
</nav>