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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Sales Order Details</title>

  
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
          <?php  include('salesnavbar.php');?>

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Sales Order Details</h1>
            <a href="salesordernew.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Sales Order</a>
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
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Administrator Details</h6>
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
			
			
              <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>SO details</th>
					  <th>Sales Person</th>
                      <th>Net Amount</th>
					  <th>Shipping Charges</th>
					  <th>Grand Total</th>
					  <th>Edit</th>
					  <th>Print</th>
					  <th>Print1</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
				  $sqlselect = "SELECT * From jrcsaleorder group by sono order by sodate desc ";
				  
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
            <td><b>SO Number :</b> <?=$rowselect['sono']?> <br> <b>SO Date :</b> <?=date('d/m/Y',strtotime($rowselect['sodate']))?></td></td>
					  <td><?=($rowselect['salesperson']!='')?$rowselect['salesperson']:''?> </td>
					  <td><?=($rowselect['netamount']!='')?$rowselect['netamount']:''?> </td>
					  <td><?=($rowselect['shippingamount']!='')?$rowselect['shippingamount']:''?> </td>
					  <td><?=($rowselect['grandtotal']!='')?$rowselect['grandtotal']:''?> </td>
				  <td><a href="salesorderedit.php?id=<?=$rowselect['sono']?>">Edit</a></td>  
				  <td><a href="salesorderdc.php?id=<?=$rowselect['sono']?>">Print DC</a></td>
				  <td><a href="salesorderdn.php?id=<?=$rowselect['sono']?>">Print DN</a></td>
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
$("#topsearch").autocomplete({
  source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
  source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
});
$('#dataTable').dataTable({
    paging: false
});
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>
