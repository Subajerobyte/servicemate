<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
require_once '../../1637028036/vendor/excel1/Classes/PHPExcel.php';	
include('lcheck.php');
function convertXLStoCSV($infile,$outfile)
{
	$fileType = PHPExcel_IOFactory::identify($infile);
	$objReader = PHPExcel_IOFactory::createReader($fileType);
			 
	$objReader->setReadDataOnly(false); 
	$objPHPExcel = $objReader->load($infile);    
				 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
	$objWriter->save($outfile);
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Import Data from Tally XL</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<style>

.todo-list {
    margin: 0;
    padding: 0;
    list-style: none;
    overflow: auto;
}
.todo-list>li {
    border-radius: 2px;
    padding: 10px;
    background: #f4f4f4;
    margin-bottom: 2px;
    border-left: 2px solid #e6e7e8;
    color: #444;
}
.todo-list>li .label {
    margin-left: 10px;
    font-size: 9px;
}
.todo-list>li .tools {
    display: none;
    float: right;
    color: #dd4b39;
}
.todo-list>li:hover .tools{
    display: block;  
}
.no-border {
    border: 0 !important;
}
.btn-sm {
    padding: .25rem .15rem;
    font-size: .675rem;
    line-height: 0.5;
    border-radius: .2rem;
}
</style>
</head>

<body id="page-top" onLoad="getGeolocation()">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h4 mb-0 text-gray-800">Import Data from Tally XL</h1>
            <!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          
          <div class="row">
		  <div class="col-xl-12 col-md-12">
		  <div class="row">
 			
			<div class="col-xl-6 col-md-6 mb-4">
              <div class="card bg-primary text-white shadow h-100 py-1" role="button">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
								
<?php
$dirname = '../tallyexport/dc/';
$csvs = glob($dirname."*.xlsx");

foreach($csvs as $csv) {
}
?>

					  <div class="font-weight-bold text-uppercase mb-1">Tally Import - DC</div>
                      <div class="h4 mb-1 font-weight-bold"><?=$is=count($csvs)?> Files FOUND</div>
					  <div class="h6 mb-1"><?php
					  if($is!=0)
					  {
					  	$xlsfile=str_replace(".xlsx","",$csvs[0]);  
						convertXLStoCSV($xlsfile.'.xlsx',$xlsfile.'.csv');
						$csvn=str_replace($dirname,"",$xlsfile.'.csv'); 
						  ?>
						  <a href="uploadstfd.php?upload=<?=$csvn?>" onClick="javascript:confirm('Are you sure want to Upload this File?')" class="text-white">Click Here to Upload</a>
						  <?php
					  }
					  ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file-excel fa-2x"></i>                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="col-xl-6 col-md-6 mb-4">
              <div class="card bg-primary text-white shadow h-100 py-1" role="button" >
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
								
<?php
$dirname = '../tallyexport/invoice/';
$csvs = glob($dirname."*.xlsx");

foreach($csvs as $csv) {
}
?>

					  <div class="font-weight-bold text-uppercase mb-1">Tally Import - INVOICE</div>
                      <div class="h4 mb-1 font-weight-bold"><?=$is=count($csvs)?> Files FOUND</div>
					  <div class="h6 mb-1"><?php
					  if($is!=0)
					  {
					  	$xlsfile=str_replace(".xlsx","",$csvs[0]);  
						convertXLStoCSV($xlsfile.'.xlsx',$xlsfile.'.csv');
						$csvn=str_replace($dirname,"",$xlsfile.'.csv'); 
						  ?>
						  <a href="uploadstf.php?upload=<?=$csvn?>" onClick="javascript:confirm('Are you sure want to Upload this File?')" class="text-white">Click Here to Upload</a>
						  <?php
					  }
					  ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file-excel fa-2x"></i>                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			
			
			
			</div>
			</div>
			
          </div>

          
        </div>
         
      </div>
       

       
      <?php include('footer.php'); ?>
       
    </div>
     
  </div>
   

   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
    <i class="fas fa-angle-up"></i>  </a>

   
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>        </div>
      </div>
    </div>
  </div>

  
  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>

  
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script><script src="notification.js"></script>

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
	$(function() {
    $('marquee').mouseover(function() {
        $(this).attr('scrollamount',0);
    }).mouseout(function() {
         $(this).attr('scrollamount',5);
    });
});
			</script>
</body>
</html>
