<?php
include('lcheck.php'); 
if($settings=='0')
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
  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Sales Order Payment</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
.img-placeholder {
  width: 100px;
  color: white;
  height: 100px;
  background: black;
  opacity: .7;
  height: 125px;
  border-radius: 5%;
  z-index: 2;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder h4 {
  margin-top: 40%;
  color: white;
}
.img-div:hover .img-placeholder {
  display: block;
  cursor: pointer;
}
   </style>
</head>
<body id="page-top">
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Add New Sales Order Payment</b></h1>
  </div>
  <div class="col-auto">
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
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Additional Material</h6>
            </div>-->
<div class="card-body">
<form action="salespayadds.php"  method="post" enctype="multipart/form-data" id="paymentForm">
<div class="row">
<div class="col-lg-6">
  <div class="form-group">
    <label for="pdate">Payment Date</label>
    <input type="datetime-local" class="form-control" id="pdate" name="pdate" required>
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="pono">P.O. No</label>
    <input type="text" class="form-control" id="pono" name="pono" required>
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="totalamount">Total Amount</label>
    <input type="number" class="form-control" id="totalamount" name="totalamount" readonly>
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="balanceamount">Balance Amount</label>
	<input type="number" class="form-control" id="balanceamount" name="balanceamount" readonly>
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="payamount">Payable Amount</label>
    <input type="number" class="form-control" id="payamount" name="payamount" required>
    <div id="error-message" style="color: red; display: none;">Payable amount must be less than or equal to the balance amount.</div>
  </div>
</div>
  </div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
            </div>
          </div>
        </div>
      </div>
      <?php include('footer.php'); ?>
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
<script>
$( "#pono" ).autocomplete({
source: 'pono1search.php?type=pono', select: function (event, ui) { $("#pono").val(ui.item.value); $("#totalamount").val(ui.item.totalamount); $("#balanceamount").val(ui.item.balanceamount);}, minLength: 3
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('paymentForm');
    const payAmountInput = document.getElementById('payamount');
    const balanceAmountInput = document.getElementById('balanceamount');
    const errorMessage = document.getElementById('error-message');
    payAmountInput.addEventListener('input', function() {
      validatePayAmount();
    });
    form.addEventListener('submit', function(event) {
      if (!validatePayAmount()) {
        event.preventDefault(); // Prevent form submission if validation fails
      }
    });
    function validatePayAmount() {
      const payAmount = parseFloat(payAmountInput.value);
      const balanceAmount = parseFloat(balanceAmountInput.value);
      if (isNaN(payAmount) || isNaN(balanceAmount)) {
        errorMessage.style.display = 'none';
        payAmountInput.setCustomValidity('');
        return true;
      }
      if (payAmount > balanceAmount) {
        errorMessage.style.display = 'block';
        payAmountInput.setCustomValidity('Payable amount must be less than or equal to the balance amount.');
        return false;
      } else {
        errorMessage.style.display = 'none';
        payAmountInput.setCustomValidity('');
        return true;
      }
    }
  });
</script>  
<?php include('additionaljs.php');   ?>
</body>
</html>