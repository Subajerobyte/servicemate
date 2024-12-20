<nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

	  <!--button id="sidebarToggleTop" class="btn btn-primary rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button-->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon">
          <img src="../../1637028036/img/logo-o-w.png" width="40">
		  
		  
        </div>
       <div class="mx-3" style="line-height:1.2">JEROBYTE<br><span style="font-size:0.7em;" >EASY PROFIT</span><sup></sup></div>
      </a>

          <!-- Topbar Search 
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="consigneeview.php" method="get">
            <div class="input-group">
			<input type="hidden" name="id" id="topsearchid">
              <input type="text" id="topsearch" name="topsearch" class="form-control bg-light border-0 small" placeholder="Search for Customer Name, Area, Mobile, etc..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>-->

          <!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

           
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline"><?=$_SESSION['engineername']?></span>
				
				 <?php
			  if($avatar!='')
			  {
				?>  
				<img class="img-profile rounded-circle" src="<?=$_SESSION['avatar']?>">
  		  <?php
			  }
			  else
			{
				?>  
				<img class="img-profile rounded-circle" src="../img/smiley.png">
  		  <?php
			  }	  
			  ?>
				
                
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 "></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 "></i>
                  Settings
                </a>
                <a class="dropdown-item" href="activitylog.php">
                  <i class="fas fa-list fa-sm fa-fw mr-2 "></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>