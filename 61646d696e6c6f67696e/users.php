<?php
include('lcheck.php'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$_SESSION['companyname']?> - Jerobyte - User Permission Details</title>

    
    <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <meta name="theme-color" content="#3d8eb9">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    
    <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> 
    <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
    <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    
    <div id="wrapper">

        
        <?php include('sidebar.php');?>
        

        
        <div id="content-wrapper" class="d-flex flex-column">

            
            <div id="content">

                
                <?php include('navbar.php');?>
                            <?php include('usersnavbar.php');?>

                
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
					
					   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>User Permission Details</b></h1>
  </div>
  <div class="col-auto">
    <a href="adminuseradd.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Administrator</a>
  </div>
</div>

					
                    <?php
if(isset($_GET['remarks']))
{
?><div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
                    <?php
}
 if(isset($_GET['error']))
{
?>
                   <div class="alert alert-danger shadow"><?=$_GET['error']?></div>
                    <?php
}
?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User Permission Details</h6>
                        </div>-->
                        <div class="card-body">
						<?php
					if($secsystem=='1')
					{
					?>
					<div class="alert alert-danger shadow">All Passwords has been Encrypted, You can't View it. You can chage a New Password.</div>
					<?php
					}
					?>
                            <?php
 $sqlselect = "SELECT count(id) as coun From jrcadminuser where enabled='0' order by username asc";
 $queryselect = mysqli_query($connection, $sqlselect);
 $ins=mysqli_fetch_array($queryselect);
 $sqlselect1 = "SELECT count(id) as coun1 From jrcengineer where enabled='0' order by username asc";
 $queryselect1 = mysqli_query($connection, $sqlselect1);
 $ins1=mysqli_fetch_array($queryselect1);
 $sqlselect2 = "SELECT count(id) as coun2 From jrcsalesrep where enabled='0' order by username asc";
 $queryselect2 = mysqli_query($connection, $sqlselect2);
 $ins2=mysqli_fetch_array($queryselect2);
$available=(float)$ins['coun']+(float)$ins1['coun1']+(float)$ins2['coun2'];
?>
                            <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card bg-white text-primary shadow1 " role="button">
                                        <div class="card-statistic-3 p-3">
                                            <div class="row align-items-center  d-flex" style="font-size:14px;">
                                                <div class="col-12 text-center">
                                                    <div class="card-icon card-icon-large mb-2"><i
                                                            class="fas fa-lock fa-2x"></i></div>
                                                    <h5 class="card-title mb-0"
                                                        style="font-size:0.9rem; font-weight:bold">
                                                        Total Active Users
                                                    </h5>
                                                    <span style="font-size:1.2rem;"><b><?=$available?></b></span>
                                                            <h5 class="card-title mb-0"
                                                        style="font-size:0.8rem; font-weight:bold">
                                                        (Max <?=$empmax?> for Recharged)
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>    
                            
                            <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card bg-white text-primary shadow1 " role="button">
                                        <div class="card-statistic-3 p-3">
                                            <div class="row align-items-center  d-flex" style="font-size:14px;">
                                                <div class="col-12 text-center">
                                                    <div class="card-icon card-icon-large mb-2"><i
                                                            class="fas fa-lock fa-2x"></i></div>
                                                    <h5 class="card-title mb-0"
                                                        style="font-size:0.9rem; font-weight:bold">
                                                        Total Active Users
                                                    </h5>
                                                    <span style="font-size:1.2rem;"><b><?=$available?></b></span>
                                                            <h5 class="card-title mb-0"
                                                        style="font-size:0.8rem; font-weight:bold">
                                                        (Max <?=$slotmax?> for this Pack)
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            </div>
                            </div>
							
							
					<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="administrators-tab" data-toggle="tab" data-target="#administrators" type="button" role="tab" aria-controls="administrators" aria-selected="true">Administrators</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="engineer-tab" data-toggle="tab" data-target="#engineer" type="button" role="tab" aria-controls="engineer" aria-selected="true">Engineers</button>
  </li>
  <!--<li class="nav-item" role="presentation">
    <button class="nav-link" id="sales-tab" data-toggle="tab" data-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="true">Sales Representative</button>
  </li-->
  
</ul>		
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="administrators" role="tabpanel" aria-labelledby="administrators-tab">
							 <div class="card shadow mb-4">
							 <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" style="text-align:center;">Administrators</h6>
            </div>

 <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Login Type</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>User Name</th>
                                            <th>Password</th>
                                            <th>Permission</th>
                                            <th>Enable/Disable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
          	$count=1;
				  $sqlselect = "SELECT adminusername, designation, username, password, id, enabled From jrcadminuser where enabled='0' order by username asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
      if($rowCountselect > 0) 
		  {
		  while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td>Administrator</td>
                                            <td><?=$rowselect['adminusername']?></td>
                                            <td><?=$rowselect['designation']?></td>
                                            <td><?=$rowselect['username']?></td>
                                            <?php
					if($secsystem=='1')
					{
					?>
					<td><?=md5($rowselect['password'])?></td>
					<?php
					}
					else
					{
					?>
					<td><?=$rowselect['password']?></td>
					<?php
					}	
					?>
                                            <td><a href="useraccess.php?type=adminuser&id=<?=$rowselect['id']?>">Edit
                                            </td>
                                            <td>
                                                <?php
					if($rowselect['id']!='1')
					{						
					  if($rowselect['enabled']=='0')
					  {
						?>
                                                <a href="userchange.php?t=a&id=<?=$rowselect['id']?>&val=1"
                                                    onclick="return confirm('Are you sure want to Disable this User Permission?')"><span
                                                        class="text-success">Enabled</span></a>
                                                <?php						
					  }
					  else
					  {
						  ?>
                                                <a href="userchange.php?t=a&id=<?=$rowselect['id']?>&val=0"
                                                    onclick="return confirm('Are you sure want to Enable this User Permission?')"><span
                                                        class="text-danger">Disabled</span></a>
                                                <?php
					  }
					}
					  ?>
                                            </td>
                                        </tr>
                                        <?php
					$count++;
			}
		}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="tab-pane fade" id="engineer" role="tabpanel" aria-labelledby="engineer-tab">
 <div class="card shadow mb-4">
  <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" style="text-align:center;">Service Engineers</h6>
            </div>

 <div class="card-body">

<div class="table-responsive">
                                <table class="table table-bordered font-13" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Login Type</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>User Name</th>
                                            <th>Password</th>

                                            <th>Edit</th>
                                            <th>Enable/Disable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
    $sqlselect = "SELECT engineername, designation, username, password, id, enabled From jrcengineer where enabled='0' order by username asc";
				  
    $queryselect = mysqli_query($connection, $sqlselect);
    $rowCountselect = mysqli_num_rows($queryselect);
     
    if(!$queryselect){
       die("SQL query failed: " . mysqli_error($connection));
    }
     
    if($rowCountselect > 0) 
{
  while($rowselect = mysqli_fetch_array($queryselect)) 
  {
  ?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td>Engineer</td>
                                            <td><?=$rowselect['engineername']?></td>
                                            </td>
                                            <td><?=$rowselect['designation']?></td>
                                            <td><?=$rowselect['username']?></td>
                                            <?php
					if($secsystem=='1')
					{
					?>
					<td><?=md5($rowselect['password'])?></td>
					<?php
					}
					else
					{
					?>
					<td><?=$rowselect['password']?></td>
					<?php
					}	
					?>
                                            <td><a href="engineeredit.php?id=<?=$rowselect['id']?>">Edit</a></td>
                                            <td>
                                                <?php
        if($rowselect['enabled']=='0')
        {
        ?>
                                                <a href="userchange.php?t=e&id=<?=$rowselect['id']?>&val=1"
                                                    onclick="return confirm('Are you sure want to Disable this Engineer?')"><span
                                                        class="text-success">Enabled</span></a>
                                                <?php						
        }
        else
        {
          ?>
                                                <a href="userchange.php?t=e&id=<?=$rowselect['id']?>&val=0"
                                                    onclick="return confirm('Are you sure want to Enable this Engineer?')"><span
                                                        class="text-danger">Disabled</span></a>
                                                <?php
        }
        ?>
                                            </td>
                                        </tr>
                                        <?php
      $count++;
  }
}
		?>

                                    </tbody>
                                </table>
                            </div>
					
                        </div>
                    </div> 
					</div><?php
 if($salesmodule=='1')
{
	?>	 <div class="tab-pane fade  " id="sales" role="tabpanel" aria-labelledby="sales-tab"><br>
					<div class="card shadow mb-4">
  <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" style="text-align:center;">Sales Representatives</h6>
            </div>

 <div class="card-body">

<div class="table-responsive">
                                <table class="table table-bordered font-13" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Login Type</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>User Name</th>
                                            <th>Password</th>

                                            <th>Edit</th>
                                            <th>Enable/Disable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
    $sqlselect = "SELECT salesrepname, designation, username, password, id, enabled  From jrcsalesrep where enabled='0' order by username asc";
				  
    $queryselect = mysqli_query($connection, $sqlselect);
    $rowCountselect = mysqli_num_rows($queryselect);
     
    if(!$queryselect){
       die("SQL query failed: " . mysqli_error($connection));
    }
     
    if($rowCountselect > 0) 
{
  while($rowselect = mysqli_fetch_array($queryselect)) 
  {
  ?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td>Engineer</td>
                                            <td><?=$rowselect['salesrepname']?></td>
                                            </td>
                                            <td><?=$rowselect['designation']?></td>
                                            <td><?=$rowselect['username']?></td>
                                            <?php
					if($secsystem=='1')
					{
					?>
					<td><?=md5($rowselect['password'])?></td>
					<?php
					}
					else
					{
					?>
					<td><?=$rowselect['password']?></td>
					<?php
					}	
					?>
                                            <td><a href="salesrepedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
                                            <td>
                                                <?php
        if($rowselect['enabled']=='0')
        {
        ?>
                                                <a href="userchange.php?t=s&id=<?=$rowselect['id']?>&val=1"
                                                    onclick="return confirm('Are you sure want to Disable this Engineer?')"><span
                                                        class="text-success">Enabled</span></a>
                                                <?php						
        }
        else
        {
          ?>
                                                <a href="userchange.php?t=s&id=<?=$rowselect['id']?>&val=0"
                                                    onclick="return confirm('Are you sure want to Enable this Sales Representative?')"><span
                                                        class="text-danger">Disabled</span></a>
                                                <?php
        }
        ?>
                                            </td>
                                        </tr>
                                        <?php
      $count++;
  }
}
		?>

                                    </tbody>
                                </table>
                            </div>
					
                        </div>
                    </div></div>
					<?php
}
?>
					

                </div>
                 

            </div>
             

             
            <?php include('footer.php'); ?>
             

        </div>
         

    </div>
     

     
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
       
    </a>

     
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
    <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    
    <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>

    
    <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
    <script src="notification.js"></script>

    <!-- Page level plugins -->
    <script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>


    <!-- Page level plugins -->
    <script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../1637028036/js/datatables.js"></script>
    <script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $("#topsearch").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#topsearch").val(ui.item.value);
                $("#topsearchid").val(ui.item.id);
            },
            minLength: 3
        });
        $("#topsearch1").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#topsearch1").val(ui.item.value);
                $("#topsearchid1").val(ui.item.id);
            },
            minLength: 3
        });
    });
    $('#dataTable').dataTable({
        paging: false
    });
    </script>
	<?php include('additionaljs.php');   ?>
</body>

</html>