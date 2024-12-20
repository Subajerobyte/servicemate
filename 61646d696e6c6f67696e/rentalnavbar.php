 <style>


</style>
<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">

	 <button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
    <span class="navbar-toggler-icon"></span>
  </button>
   <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	  <?php
// if($addinvoice=='1')
// {
?>
<!--<li class="nav-item active">
	 <a class="nav-link <?//=(($current_file_name=='invoice.php'))?'active':''?>" href="invoice.php">
<i class="fas fa-file-invoice"></i> &nbsp;invoice details</a></li>-->
<?php
//}
?>

<?php /* 
if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
{
if($salesorder=='1')
{ */
?>		  
<!--<li class="nav-item active">
	 <a class="nav-link <?//=(($current_file_name=='exporttally.php'))?'active':''?>" href="exporttally.php">
<i class="fas fa-handshake"></i> &nbsp;Sales Order</a></li>-->
<?php
/* }
} */
?>
<li class="nav-item active p-1"> 
	 <a class="nav-link1 " href="rentallist.php"> <div class="cardnav <?=(($current_file_name=='rentallist.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-coins"></i> &nbsp; 
     Rental Details
    </div>
  </div></a></li>
<li class="nav-item active p-1">
	<a class="nav-link1 " href="payments.php"> <div class="cardnav <?=(($current_file_name=='payments.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-coins"></i> &nbsp; 
     Rental Payments
   </div>
  </div> </a></li>
		
        </ul>
    </div>
</nav>

