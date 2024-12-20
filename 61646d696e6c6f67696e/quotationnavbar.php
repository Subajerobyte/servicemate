<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">
 <button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	

	
	<li class="nav-item active p-1">
       <a class="nav-link1"  href="newquotationadd.php">
	   <div class="cardnav  <?=($current_file_name=='newquotationadd.php')?'active':''?>">
	   <div class="cardnav-body text-center">
	   <i class="fas fa-users"></i> &nbsp;Add New Quotation (New Customer)</div></div></a>
	   </li>
	   <li class="nav-item active p-1">
       <a class="nav-link1 "  href="quotations.php">
	   <div class="cardnav <?=(($current_file_name=='quotations.php') || ($current_file_name=='quotationgenview.php') || ($current_file_name=='followupadd.php'))?'active':''?>">
	 <div class="cardnav-body text-center"><i class="fas fa-eye"></i> &nbsp;View Quotations</div></div></a>
	   </li>
	       
	   <li class="nav-item active p-1">
       <a class="nav-link1 "  href="amcquotations.php">
	   <div class="cardnav <?=($current_file_name=='amcquotations.php')?'active':''?>">
	 <div class="cardnav-body text-center"><i class="fas fa-file-alt"></i> &nbsp; View AMC Quotations</div></div></a>
	   </li>
	   <li class="nav-item active p-1">
       <a class="nav-link1"  href="quotationtoso.php">
	   <div class="cardnav  <?=($current_file_name=='quotationtoso.php')?'active':''?>">
	   <div class="cardnav-body text-center">
	   <i class="fas fa-users"></i> &nbsp;Convert Quotation to SO</div></div></a>
	   </li>
		  </ul>
  </div>
</nav>







