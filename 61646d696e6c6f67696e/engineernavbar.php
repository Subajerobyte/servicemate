<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow" >

	 <button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
    <span class="navbar-toggler-icon"></span>
  </button>
   <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	 			<?php
if(($liveplan=='DIAMOND'))
{
if(($livelocation=='1'))
{
?>	
<li class="nav-item active p-1">
     

		 <li class="nav-item active p-1">
	 <a class="nav-link1 " href="mapengineer.php">
	  <div class="cardnav <?=(($current_file_name=='mapengineer.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
<i class="fas fa-map-marker-alt"></i> &nbsp;Engineers Live Location</div></div></a></li>
		   <?php
}
}
if(($engineerperformance=='1'))
{
?>	
		        <li class="nav-item active p-1">
	 <a class="nav-link1  " href="mapengineerda.php"> 
	 <div class="cardnav <?=(($current_file_name=='mapengineerda.php'))?'active':''?>">
	 <div class="cardnav-body text-center"> 
	 <i class="fas fa-chart-pie"></i> &nbsp;Engineers Performance Reports</div></div></a></li>
	 
	 <li class="nav-item active p-1">
	 <a class="nav-link1  " href="currentlocation.php"> 
	  <div class="cardnav <?=(($current_file_name=='currentlocation.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	 <i class="fa fa-map-marker"></i> &nbsp;Engineer Nearby Customers</div></div></a></li>
				<?php
}

?>
        </ul>
    </div>
</nav>
	 
	 
	 
	 
	 
	  