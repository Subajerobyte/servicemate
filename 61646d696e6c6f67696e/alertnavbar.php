<style>
a.btn-primary {
    background-image:none !important;
	background-color: <?=$_SESSION['bgcolor']?> !important;
	border-color: <?=$_SESSION['bgcolor']?> !important;
	color: <?=$_SESSION['textcolor']?> !important;
}
a.btn-primary:hover{
	
	background-image:none !important;
	background-color: <?=$_SESSION['darkcolor']?> !important;
	border-color: <?=$_SESSION['darkcolor']?> !important;
	color: <?=$_SESSION['textcolor']?> !important;
}
</style>
<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow" >
	 <button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
    <span class="navbar-toggler-icon"></span>
  </button>
   <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	
      <li class="nav-item active p-1">
	  <a class="nav-link1 "  href="calendar.php">
	   <div class="cardnav  <?=($current_file_name=='calendar.php')?'active':''?>">
	   <div class="cardnav-body text-center">
	  <i class="fas fa-calendar"></i> &nbsp;Calendar</div></div></a>
      </li>
	  <li class="nav-item active p-1">
	  <a class="nav-link1 " href="alertpreventive.php?datefrom=<?=date('Y-m-01')?>&dateto=<?=date('Y-m-t')?>&submit=">
	   <div class="cardnav  <?=($current_file_name=='alertpreventive.php')?'active':''?>">
	   <div class="cardnav-body text-center"><i class="fas fa-wrench"></i> &nbsp;Warranty Maintenance</div></div></a>
      </li>
	   <li class="nav-item active p-1">
	  <a class="nav-link1 " href="alertwarrantyexpire.php?datefrom=<?=date('Y-m-01')?>&dateto=<?=date('Y-m-t')?>&submit=">
	   <div class="cardnav  <?=($current_file_name=='alertwarrantyexpire.php')?'active':''?>">
	   <div class="cardnav-body text-center"><i class="fas fa-hourglass-end"></i> &nbsp;Warranty Expiry</div></div></a>
      </li>
	   <li class="nav-item active p-1">
	  <a class="nav-link1 " href="alertamcmaintenance.php?datefrom=<?=date('Y-m-01')?>&dateto=<?=date('Y-m-t')?>&submit=">
	   <div class="cardnav  <?=($current_file_name=='alertamcmaintenance.php')?'active':''?>">
	   <div class="cardnav-body text-center"><i class="fas fa-tools"></i> &nbsp;AMC Maintenance</div></div></a>
	   </li>
	   <li class="nav-item active p-1">
	  <a class="nav-link1 " href="alertamcexpire.php?datefrom=<?=date('Y-m-01')?>&dateto=<?=date('Y-m-t')?>&submit=">
	   <div class="cardnav  <?=($current_file_name=='alertamcexpire.php')?'active':''?>">
	   <div class="cardnav-body text-center"><i class="fas fa-calendar-minus"></i> &nbsp;AMC Expiry</div></div></a>
	   </li> 
	   <li class="nav-item active p-1">
	  <a class="nav-link1 " href="productlifetimeexpire.php?datefrom=<?=date('Y-m-01')?>&dateto=<?=date('Y-m-t')?>&submit=">
	   <div class="cardnav  <?=($current_file_name=='productlifetimeexpire.php')?'active':''?>">
	   <div class="cardnav-body text-center"><i class="fas fa-stopwatch"></i> &nbsp;Product Lifetime Expiry</div></div></a>
	   </li>
	  </ul>
	  </div>
</nav>
	
	 

	 
	 