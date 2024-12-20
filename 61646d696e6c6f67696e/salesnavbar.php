<nav class="navbar navbar-expand-md navbar-color  bg-color mb-2 topnavbar shadow">
<button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNavDropdown">
    
    <ul class="navbar-nav">
	

	
	<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='singleexporttallyadd.php')||($current_file_name=='exporttallyadd.php')||($current_file_name=='exporttallyedit.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='singleexporttallyadd.php')||($current_file_name=='exporttallyadd.php')||($current_file_name=='exporttallyedit.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-address-book"></i> &nbsp; 
     <span class="dropdown-toggle ">Sales Order Entry</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='singleexporttallyadd.php'))?'active':''?>" href="singleexporttallyadd.php?noofconsignee=1&maxproduct=1&getsubmit=Submit"><i class="fas fa-address-book"></i>&nbsp;Single </a>
<a class="dropdown-item <?=(($current_file_name=='exporttallyadd.php'))?'active':''?>" href="exporttallyadd.php"><i class="fas fa-address-book"></i>&nbsp;Multiple</a>

</div>
</li>
	     
	<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='compexporttally.php')||($current_file_name=='exporttally.php')||($current_file_name=='exporttallyadd.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='compexporttally.php')||($current_file_name=='exporttally.php')||($current_file_name=='exporttallyadd.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-file-alt"></i> &nbsp; 
     <span class="dropdown-toggle ">Sales Order Reports</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='compexporttally.php'))?'active':''?>" href="compexporttally.php"><i class="fas fa-file-alt"></i>&nbsp;Completed Sales Order</a>
<a class="dropdown-item <?=(($current_file_name=='exporttally.php'))?'active':''?>" href="exporttally.php"><i class="fas fa-file-alt"></i>&nbsp;Pending Sales Order</a>

</div>
</li>     
       
	   <li class="nav-item active p-1">
       <a class="nav-link1 "  href="draftlisting.php">
	   <div class="cardnav <?=($current_file_name=='draftlisting.php')?'active':''?>">
	 <div class="cardnav-body text-center"><i class="fa fa-file-pdf"></i> &nbsp;Sales Order Draft</div></div></a>
	   </li>
	   <li class="nav-item active p-1">
       <a class="nav-link1"  href="exporttallysearch.php">
	   <div class="cardnav  <?=($current_file_name=='exporttallysearch.php')?'active':''?>">
	   <div class="cardnav-body text-center">
	   <i class="fa fa-search"></i> &nbsp;Sales Order Search</div></div></a>
	   </li>
	   
	   
	   <li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='salespayadd.php')||($current_file_name=='resalespay.php')||($current_file_name=='outsalespay.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='salespayadd.php')||($current_file_name=='resalespay.php')||($current_file_name=='outsalespay.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-credit-card"></i> &nbsp; 
     <span class="dropdown-toggle ">Payments</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='salespayadd.php'))?'active':''?>" href="salespayadd.php"><i class="fas fa-credit-card"></i>&nbsp;Payment Entry</a>
<a class="dropdown-item <?=(($current_file_name=='resalespay.php'))?'active':''?>" href="resalespay.php"><i class="fas fa-credit-card"></i>&nbsp;Received Payment</a>
<a class="dropdown-item <?=(($current_file_name=='outsalespay.php'))?'active':''?>" href="outsalespay.php"><i class="fas fa-credit-card"></i>&nbsp;Outstanding Payment</a>

</div>
</li>     
	   
	   
	   <li class="nav-item active p-1">
<a class="nav-link1" href="importtallyhistory.php">
 <div class="cardnav   <?=(($current_file_name=='importtallyhistory.php'))?'active':''?>">
	   <div class="cardnav-body text-center">
<i class="fa fa-history"></i> &nbsp;Import Data History</div></div></a></li>
		  </ul> 
    
    
</div>
</nav>