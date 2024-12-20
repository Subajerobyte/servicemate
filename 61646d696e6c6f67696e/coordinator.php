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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Call Co-ordinator Details</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/aarkayen-jrc-2.min.css" rel="stylesheet"><link rel="stylesheet" href="../vendor/jquery-ui/jquery-ui.css" />
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('sidebar.php');?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
          <?php include('navbar.php');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Call Co-ordinator Details</h1>
            <a href="coordinatoradd.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Call Co-ordinator</a>
          </div>
		  <?php
if(isset($_GET['remarks']))
{
?>	
 <div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
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
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Call Co-ordinator Details</h6>
            </div>
            <div class="card-body">
			
              <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call Co-ordinator Name</th>
					  <th>Designation</th>
                      <th>User Name</th>
					  <th>Password</th>
                      <th>Address</th>
					  <th>Contact</th>
					  <th>Edit</th>
					  <th>Enable/Disable</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $sqlselect = "SELECT * From jrccoordinator order by username asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        // If query fails, show the reason 
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        // Check if email exist
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?=$rowselect['coordinatorname']?></td></td>
					  <td><?=$rowselect['designation']?></td>
					  <?php
					  if($rowselect['username']!="")
					  {
						?>
                      <td><a href="coordinatorview.php?id=<?=$rowselect['id']?>"><?=$rowselect['username']?></a></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="coordinatorview.php?id=<?=$rowselect['id']?>">View</a></td>
					  <?php
					  }
					  ?>
					  <td><?=$rowselect['password']?></td>
					  <td><?=$rowselect['address1']?> <?=$rowselect['address2']?> <?=$rowselect['area']?> <?=$rowselect['district']?> <?=$rowselect['pincode']?></td>
					  <td><?=$rowselect['contact']?> <?=$rowselect['phone']?> <?=$rowselect['mobile']?> <?=$rowselect['email']?></td>
					  <td><a href="coordinatoredit.php?id=<?=$rowselect['id']?>">Edit</a></td>
					  <td>
					  <?php
					  if($rowselect['enabled']=='0')
					  {
						?>
						<a href="coordinatorchange.php?id=<?=$rowselect['id']?>&val=1" onclick="return confirm('Are you sure want to Disable this Call Co-ordinator?')" ><span class="text-success">Enabled</span></a>
						<?php						
					  }
					  else
					  {
						  ?>
						<a href="coordinatorchange.php?id=<?=$rowselect['id']?>&val=0" onclick="return confirm('Are you sure want to Enable this Call Co-ordinator?')" ><span class="text-danger">Disabled</span></a>
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

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include('footer.php'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/aarkayen-jrc-2.min.js"></script><script src="notification.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>


  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>
<script src="../vendor/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
  });
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
