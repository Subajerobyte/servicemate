<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">



	 <button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
    <span class="navbar-toggler-icon"></span>
  </button>
   <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	 		
		 <li class="nav-item active p-1">
	 <a class="nav-link1 " href="iexpense.php"><div class="cardnav <?=(($current_file_name=='iexpense.php'))?'active':''?>">
    <div class="cardnav-body text-center">
<i class="fas fa-hand-holding-usd"></i> &nbsp;Expenses</div>
  </div></a></li>


  
  
  
  
  
  
		  <?php
if($servicecharges=='1')
{
?>
<li class="nav-item active p-1">
	 <a class="nav-link1"  href="servicecharges.php"><div class="cardnav <?=(($current_file_name=='servicecharges.php')||($current_file_name=='servicechargese.php'))?'active':''?>">   <div class="cardnav-body text-center">
<i class="fas fa-dollar-sign"></i> &nbsp;Service Charges</div></div></a></li>


<li class="nav-item active p-1">
	 <a class="nav-link1"  href="estimatecharges.php"><div class="cardnav <?=(($current_file_name=='estimatecharges.php'))?'active':''?>"> <div class="cardnav-body text-center">
<i class="fas fa-file-invoice-dollar"></i> &nbsp;Estimate Charges</div></div></a></li>
 
<?php
}
?>
<li class="nav-item active p-1">
	 <a class="nav-link1"  href="amccharges.php">
	 <div class="cardnav <?=(($current_file_name=='amccharges.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
<i class="fas fa-coins"></i> &nbsp;AMC Charges</div></div></a></li>
<li class="nav-item active p-1">
	 <a class="nav-link1" href="purchaseorder.php">
	 <div class="cardnav  <?=(($current_file_name=='purchaseorder.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
<i class="fas fa-shopping-cart"></i> &nbsp;Purchase Order</div></div></a></li>

<li class="nav-item active p-1">
	 <a class="nav-link1" href="incentive.php">
	 <div class="cardnav  <?=(($current_file_name=='incentive.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-gift"></i> &nbsp;Incentive</div></div></a></li>
        </ul>
    </div>
</nav>
	 
	 
	 
	 
	 
	  