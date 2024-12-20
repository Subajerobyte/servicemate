<?php 
include('lcheck.php'); 

if($uploaddata=='0')
{
	header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$_SESSION['companyname']?> - Jerobyte - Product Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>
          <?php  include('productnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  
		  
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Product Details</b></h1>
  </div>
  <div class="col-auto">
    <a href="productaddnew.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Product</a>
  </div>
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
           <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
			  
            </div>-->
            <div class="card-body">
			
              <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.Nos</th>
					  <?php 
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
					  <th>Main Category</th>
					  <?php 
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
					  <th>Sub Category</th>
<?php 
}
if($infolayoutproducts['code']=='1')
{
?>						  
                      <th>Product Code</th>
<?php 
}
if($infolayoutproducts['stockitem']=='1')
{
?>						  
                      <th>Product Name</th>
<?php 
}
if($infolayoutproducts['marketname']=='1')
{
?>						  
                      <th>Market Name</th>
<?php 
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>						  
                      <th>Type of Product</th>
<?php 
}
if($infolayoutproducts['componenttype']=='1')
{
?>					  
					  <th>Component Type</th>
<?php 
}
if($infolayoutproducts['componentname']=='1')
{
?>					  
                      <th>Component Name</th>
<?php 
}
if($infolayoutproducts['make']=='1')
{
?>					  
                      <th>Make</th>
<?php 
}
if($infolayoutproducts['capacity']=='1')
{
?>					  
                      <th>Capacity</th>
<?php 
}
?>					  
					  <th>Edit</th>
					  <th>Delete</th>
					  
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
				  $sqlselect = "SELECT stockmaincategory, stocksubcategory, stockitem, typeofproduct, componenttype, componentname, make, capacity, id, invoiced,code,marketname From jrcproduct order by stockitem asc, typeofproduct desc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			?>
                    <tr>
                      <td><?=$count?></td>
					  <?php 
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
					  <td><?=$rowselect['stockmaincategory']?></td>
					  <?php 
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
					  <td><?=$rowselect['stocksubcategory']?></td>
					  <?php 
}
if($infolayoutproducts['code']=='1')
{
?>
					  <td><?=$rowselect['code']?></td>
					  <?php 
}
if($infolayoutproducts['stockitem']=='1')
{
?>
					  <td><?=$rowselect['stockitem']?></td>
					  <?php 
}
if($infolayoutproducts['marketname']=='1')
{
?>
					  <td><?=$rowselect['marketname']?></td>
					  <?php 
}
if($infolayoutproducts['typeofproduct']=='1')
{
?>
            <td><?=$rowselect['typeofproduct']?></td></td>
			<?php 
}
if($infolayoutproducts['componenttype']=='1')
{
?>
					  <td><?=$rowselect['componenttype']?></td>
					  <?php 
}
if($infolayoutproducts['componentname']=='1')
{
?>	
					  <td><?=$rowselect['componentname']?></td>
					  <?php 
}
if($infolayoutproducts['make']=='1')
{
?>
					  <td><?=$rowselect['make']?></td>
					  <?php 
}
if($infolayoutproducts['capacity']=='1')
{
?>	
					  <td><?=$rowselect['capacity']?> </td>
					  <?php 
}
?>
					  <td><a href="productedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
					  <?php 
					  if($rowselect['invoiced']=='0')
					  {
						  ?>
						  <td><a class="text-danger" href="productdelete.php?id=<?=$rowselect['id']?>" onclick="return confirm('Are you sure want to Delete this Product?')">Delete</a></td>
						  <?php 
					  }
					  else
					  {
						  ?>
						  <td></td>
						  <?php 
					  }
					  ?>
					  
                    </tr>
					<?php 
					$count++;
			}
		}
			?>
					
                  </tbody>
                </table>
              </div>
			  
			  <a href="productbdelete.php?pars=subm" class="btn btn-sm btn-danger text-white" onclick="return confirm('Are you want to Delete All Uninvoiced Products?')">Remove All Uninvoiced Products</a>
			  
            </div>
          </div>

        </div>
         

      </div>
       

       
      <?php  include('footer.php'); ?>
       

    </div>
     

  </div>
   

   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>

   
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

  
  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>

  
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script><script src="notification.js"></script>

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
