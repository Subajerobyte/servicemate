<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow" >
 <button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	
	
	  
	   <!--li class="nav-item active p-1">
       <a class="nav-link1 "  href="productadd.php">
	    <div class="cardnav <?=($current_file_name=='productadd.php')?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-plus"></i> &nbsp;Add New Product</div></div></a>
	   </li-->	
	   <li class="nav-item active p-1">
       <a class="nav-link1 "  href="product.php">
	    <div class="cardnav <?=($current_file_name=='product.php')?'active':''?>">
	 <div class="cardnav-body text-center"><i class="fas fa-asterisk"></i> &nbsp;Product Details</div></div></a>
	   </li>	
	   <li class="nav-item active p-1">
       <a class="nav-link1 "  href="productmerge.php">
	    <div class="cardnav <?=($current_file_name=='productmerge.php')?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-compress"></i> &nbsp;Merge Product Details</div></div></a>
	   </li>
	   <li class="nav-item active p-1">
       <a class="nav-link1 "  href="warrantycycle.php">
	    <div class="cardnav <?=($current_file_name=='warrantycycle.php')?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-life-ring"></i>
 &nbsp;Warranty Cycle Missing Products</div></div></a>  
 </li>
 <li class="nav-item active p-1">
       <a class="nav-link1 "  href="productlifetime.php">
	    <div class="cardnav <?=($current_file_name=='productlifetime.php')?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-life-ring"></i>
 &nbsp;Lifetime Missing Products</div></div></a>  
 </li>
<?php
if(($liveplan=='DIAMOND'))
{
if($sellprice=='1')
{
?>	   
	   <li class="nav-item active p-1" >
       <a class="nav-link1 "  href="saleproduct.php">
	    <div class="cardnav <?=(($current_file_name=='saleproduct.php') || ($current_file_name=='saleproductedit.php'))?'active':''?>">
	 <div class="cardnav-body text-center"><i class="fas fa-money-bill"></i> &nbsp;Price Details</div></div></a>
	   </li>	
	   <?php
}
}
?>
<!--li class="nav-item active">
       <a class="nav-link <?=(($current_file_name=='mark.php')||($current_file_name=='markadd.php')||($current_file_name=='markedit.php'))?'active':''?>"  href="mark.php"><i class="fas fa-coins"></i> &nbsp; Price Marks</a>
	   </li-->
		 </ul>
  </div>
</nav>
 
		   