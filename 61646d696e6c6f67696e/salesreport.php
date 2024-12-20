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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Call Reports</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
  .c-dashboardInfo {
  margin-bottom: 15px;
}
.c-dashboardInfo .wrap {
  background: #ffffff;
  box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
  border-radius: 7px;
  text-align: center;
  position: relative;
  overflow: hidden;
  padding: 40px 25px 20px;
  height: 100%;
}
.c-dashboardInfo__title,
.c-dashboardInfo__subInfo {
  color: #6c6c6c;
  font-size: 1.18em;
}
.c-dashboardInfo span {
  display: block;
}
.c-dashboardInfo__count {
  font-weight: 600;
  font-size: 2.5em;
  line-height: 64px;
  color: #323c43;
}
.c-dashboardInfo .wrap:after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 10px;
  content: "";
}

.c-dashboardInfo:nth-child(1) .wrap:after {
  background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
}
.c-dashboardInfo:nth-child(2) .wrap:after {
  background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
}
.c-dashboardInfo:nth-child(3) .wrap:after {
  background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
}
.c-dashboardInfo:nth-child(4) .wrap:after {
  background: linear-gradient(81.67deg, #ff647c 0%, #1f5dc5 100%);
}
.c-dashboardInfo:nth-child(5) .wrap:after {
  background: linear-gradient(81.67deg, #ffacc8 0%, #8fb7ff 100%);
}
.c-dashboardInfo:nth-child(6) .wrap:after {
  background: linear-gradient(81.67deg, #ff0055 0%, #00aaff 100%);
}
.c-dashboardInfo:nth-child(7) .wrap:after {
  background: linear-gradient(81.67deg, #ffdab9 0%, #9ac0cd 100%);
}
.c-dashboardInfo__title svg {
  color: #d7d7d7;
  margin-left: 5px;
}
.MuiSvgIcon-root-19 {
  fill: currentColor;
  width: 1em;
  height: 1em;
  display: inline-block;
  font-size: 24px;
  transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
  user-select: none;
  flex-shrink: 0;
}

  </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>

        
        <div class="container-fluid">

          <!-- Page Heading -->
		    <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Sales Order</b></h1>
  </div>
</div>
		  <?php 
if(isset($_GET['remarks']))
{
?>	
<div class="alert alert-success shadow">
<?=$_GET['remarks']?>
</div>
<?php 
}
 if(isset($_GET['error']))
{
?>	 
  <div class="alert alert-danger shadow">
<?=$_GET['error']?>
</div>
<?php 
}
?>
          <!-- DataTales Example -->
<div id="root">
  <div class="container">
    <div class="row align-items-stretch">
      <div class="c-dashboardInfo col-lg-4 col-md-4">
        <div class="wrap">
          <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><b><a href="exporttally.php">Pending Sales Order</a></b><svg
              class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
              
            </svg></h4>
        </div>
      </div>
	  <div class="c-dashboardInfo col-lg-4 col-md-4">
        <div class="wrap">
          <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><b><a href="exporttallysearch.php">Sales Order Search</a></b><svg
              class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
              
            </svg></h4>
        </div>
      </div>
	  <div class="c-dashboardInfo col-lg-4 col-md-4">
        <div class="wrap">
		 <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><b><a href="compexporttally.php">Sales </a></b><svg
              class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
              
            </svg></h4>
        </div>
      </div> 
	  <div class="c-dashboardInfo col-lg-4 col-md-4">
        <div class="wrap">
		 <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><b><a href="salespayadd.php">Payment Entry</a></b><svg
              class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
              
            </svg></h4>
        </div>
      </div>
	  <div class="c-dashboardInfo col-lg-4 col-md-4">
        <div class="wrap">
		 <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><b><a href="outsalespay.php">Outstanding Payment</a></b><svg
              class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
              
            </svg></h4>
        </div>
      </div>
	  <div class="c-dashboardInfo col-lg-4 col-md-4">
        <div class="wrap">
		 <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><b><a href="resalespay.php">Received Payment</a></b><svg
              class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
              
            </svg></h4>
        </div>
      </div>
	  <div class="c-dashboardInfo col-lg-4 col-md-4">
        <div class="wrap">
		 <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"><b><a href="singleexporttallyadd.php?noofconsignee=1&maxproduct=1&getsubmit=Submit">Single Sales Entry</a></b><svg
              class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
              
            </svg></h4>
        </div>
      </div>
      
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
