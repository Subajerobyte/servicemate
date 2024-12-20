<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">
  <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars text-white"></i>
  
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
       <li class="nav-item active p-1">
        <a class="nav-link1"  href="users.php">
		<div class="cardnav <?=(($current_file_name=='users.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
<i class="fas fa-toolbox"></i> &nbsp;User Permission Management</div></div></a>
      </li> 
	  <li class="nav-item active p-1">
       <a class="nav-link1" href="adminuser.php">
	   <div class="cardnav <?=(($current_file_name=='adminuser.php')||($current_file_name=='adminuseradd.php')||($current_file_name=='adminuseredit.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
<i class="fas fa-user-cog"></i> &nbsp;Administrator (Add/Edit)</div></div></a>
      </li>
	  <li class="nav-item active p-1">
       <a class="nav-link1" href="engineer.php"> 
	   <div class="cardnav  <?=(($current_file_name=='engineer.php')||($current_file_name=='engineeradd.php')||($current_file_name=='engineeredit.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-hard-hat"></i> &nbsp;Service Engineers (Add/Edit)</div></div></a>
      </li> 
	  
	  <li class="nav-item active p-1">
       <a class="nav-link1" href="salesrep.php">
		<div class="cardnav <?=(($current_file_name=='salesrep.php')||($current_file_name=='salesrepadd.php')||($current_file_name=='salesrepedit.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-user-tag"></i> &nbsp;Sales  Person (Add/Edit)</div></div></a>
      </li> 
	  
	  <li class="nav-item active p-1">
       <a class="nav-link1" href="usersd.php">
		<div class="cardnav  <?=(($current_file_name=='usersd.php'))?'active':''?>">
	 <div class="cardnav-body text-center">
	   <i class="fas fa-user-lock"></i> &nbsp;Disabled Users / Service Engineers</div></div></a>
      </li>
    </ul>
  </div>
</nav>
