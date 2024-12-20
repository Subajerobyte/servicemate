<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">
  <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars text-white"></i>
    </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
<li class="nav-item active p-1">
<a class="nav-link1" href="callnew.php">
	<div class="cardnav <?=(($current_file_name=='callnew.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-phone-square"></i>&nbsp; Add New Call</div></div></a>
      </li>

	<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=($current_file_name1=='calls.php?status=0')||($current_file_name1=='calls.php?status=1')||($current_file_name1=='calls.php?status=2')||($current_file_name1=='calls.php?status=3')||($current_file_name=='calls.php')?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=($current_file_name1=='calls.php?status=0')||($current_file_name1=='calls.php?status=1')||($current_file_name1=='calls.php?status=2')||($current_file_name1=='calls.php?status=3')||($current_file_name=='calls.php')?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-phone"></i> &nbsp; 
     <span class="dropdown-toggle ">Calls</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='calls.php?status=0'))?'active':''?>" href="calls.php?status=0"><i class="fas fa-phone"></i>&nbsp;Open Calls </a>
<a class="dropdown-item <?=(($current_file_name=='calls.php?status=1'))?'active':''?>" href="calls.php?status=1"><i class="fas fa-phone"></i>&nbsp;Pending Calls </a>
<a class="dropdown-item <?=(($current_file_name=='calls.php?status=2'))?'active':''?>" href="calls.php?status=2"><i class="fas fa-phone"></i>&nbsp;Completed Calls </a>
<a class="dropdown-item <?=(($current_file_name=='calls.php?status=2'))?'active':''?>" href="calls.php?status=3"><i class="fas fa-phone"></i>&nbsp;Cancelled Calls </a>

</div>
</li>
<li class="nav-item active p-1">
<a class="nav-link1" href="calls.php">
	<div class="cardnav <?=(($current_file_name=='calls.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
		<i class="fas fa-chart-bar"></i>&nbsp;Overall Call History</div></div></a>
      </li>

</ul>
</div>
</nav>











