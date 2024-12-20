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

  <title>Activity Log - <?=$_SESSION['companyname']?></title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link href="../../1637028036/vendor/photoviewer/photoviewer.css" rel="stylesheet">
 <style>
	.vertical-timeline {
    width: 100%;
    position: relative;
    padding: 1.5rem 0 1rem;
}

.vertical-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 67px;
    height: 100%;
    width: 4px;
    background: #e9ecef;
    border-radius: .25rem;
}

.vertical-timeline-element {
    position: relative;
    margin: 0 0 1rem;
}

.vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
    visibility: visible;
    animation: cd-bounce-1 .8s;
}
.vertical-timeline-element-icon {
    position: absolute;
    top: 0;
    left: 60px;
}

.vertical-timeline-element-icon .badge-dot-xl {
    box-shadow: 0 0 0 5px #fff;
}

.badge-dot-xl {
    width: 18px;
    height: 18px;
    position: relative;
}
.badge:empty {
    display: none;
}


.badge-dot-xl::before {
    content: '';
    width: 10px;
    height: 10px;
    border-radius: .25rem;
    position: absolute;
    left: 50%;
    top: 50%;
    margin: -5px 0 0 -5px;
    background: #fff;
}

.vertical-timeline-element-content {
    position: relative;
    margin-left: 90px;
    font-size: .8rem;
}

.vertical-timeline-element-content .timeline-title {
    font-size: .8rem;
    text-transform: uppercase;
    margin: 0 0 .5rem;
    padding: 2px 0 0;
    font-weight: bold;
}

.vertical-timeline-element-content .vertical-timeline-element-date {
    display: block;
    position: absolute;
    left: -90px;
    top: 0;
    padding-right: 10px;
    text-align: right;
    color: #adb5bd;
    font-size: .7619rem;
    white-space: nowrap;
}
.badge-danger
{
	background-color:#ee5b5b;
}
.badge-warning
{
	background-color:#fcd53b;
}
.badge-success
{
	background-color:#0ddbb9;
}
.badge-primary
{
	background-color:#3792cb;
}
	</style>
   
   
  
   <style>
   .historyid{
  line-height:1.3em;
}
   .history-tl-container{
    font-family: "Roboto",sans-serif;
  width:100%;
  margin:auto;
  display:block;
  position:relative;
}
.history-tl-container ul.tl{
    margin:20px 0;
    padding:0;
    display:inline-block;

}
.history-tl-container ul.tl li{
    list-style: none;
    margin:auto;
    margin-left:100px;
    min-height:50px;
    /*background: rgba(255,255,0,0.1);*/
    border-left:1px dashed #86D6FF;
    padding:0 0 30px 30px;
    position:relative;
}
.history-tl-container ul.tl li:last-child{ border-left:0;}
.history-tl-container ul.tl li::before{
    position: absolute;
    left: -18px;
    top: -5px;
    content: " ";
    border: 8px solid rgba(255, 255, 255, 0.74);
    border-radius: 500%;
    background: #258CC7;
    height: 35px;
    width: 35px;
    transition: all 500ms ease-in-out;

}
.history-tl-container ul.tl li:hover::before{
    border-color:  #258CC7;
    transition: all 1000ms ease-in-out;
}
ul.tl li .item-title{
}
ul.tl li .item-detail{
    color:rgba(0,0,0,0.5);
    font-size:12px;
}
ul.tl li .timestamp{
    color: #8D8D8D;
    position: absolute;
  width:100px;
    left: -65%;
    text-align: right;
    font-size: 12px;
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
          <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Activity Log</h1>
            <!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          
          <div class="row">
	  <div class="col-lg-12">
	  
	  
	   <div class="card shadow mb-4">
           <div class="card-body">
	  
	  
	  
	  
	  
	  <form action="#" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">

<div class="row">
	
	<div class="col-lg-3">
  <div class="form-group">
    <label for="fromdate">From Date</label>
	<input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="From" value="<?=date('Y-m-d') ?>" required>
	</div>
	</div>


<div class="col-lg-3">
  <div class="form-group">
    <label for="todate">To Date</label>
	<input type="date" class="form-control" id="dateto" name="dateto" placeholder="To" value="<?=date('Y-m-d') ?>" required>
	</div>
	</div>

	
	 </div>
	<input class="btn btn-primary " type="submit" name="submit" value="Submit">
   </form>

  </br>
  </br>
  
  <?php
if(isset($_POST['submit']))
{
	
	$adminuserlog="";
	$engineerlog=$email;
	
	date_default_timezone_set('UTC');
	$datefrom=mysqli_real_escape_string($connection, $_POST['datefrom']);
	$dateto=mysqli_real_escape_string($connection, $_POST['dateto']);			
							

if ($adminuserlog!="")
{
	$usersearch= $adminuserlog;
}
elseif ($engineerlog!="")
{
	$usersearch= $engineerlog;
}
else
{
	$usersearch= ""; 
	
}
if ($usersearch!="")
{
	

	?>
	
	<div class="row">
			 <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  
                  
				
				<div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
				<?php
				
				$batcharray=array('badge-primary','badge-primary','badge-primary','badge-primary');
				$sqlselect = "SELECT * From jrchistory where DATE(times)>='".$datefrom."' and DATE(times)<='".$dateto."' and user='".$usersearch."' order by id desc";
					  $queryselect = mysqli_query($connection, $sqlselect);
					  $rowCountselect = mysqli_num_rows($queryselect);
						if(!$queryselect){
						   die("SQL query failed: " . mysqli_error($connection));
						}
			 
						if($rowCountselect > 0) 
						{
							$count=0;
							while($rowselect = mysqli_fetch_array($queryselect)) 
							{
							?>
				
				
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl <?=$batcharray[$count];?>"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title"><?=$rowselect['user']?> - <?=$rowselect['remarks']?></h4>
                                                            <p>from <a href="javascript:void(0);" data-abc="true"><?=$rowselect['ipaddress']?></a></p>
                                                            <span class="vertical-timeline-element-date"><?=date('d/m/Y', strtotime($rowselect['times']))?></br><?=date(' h:i a', strtotime($rowselect['times']))?></span>
                                                        </div>
                                                    </div>
                                                </div>
												
												<?php
								$count++;
								if(($count%4)==0)
								{
									$count=0;
								}
							}
						}
						?>
                                                
                                                
                                                   
                                                
                                            </div>
				
				
				  </div>
				  </div>
				  </div>
				  </div>
					
	<?php
}
else{
	echo '<div class = "bg-danger" > Please Select Either Admin User or Engineer</div>';
}	
}


?>

	  
	  
	  
	  
	  
	  
	  
	  
	   </div>
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
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>

  <!-- Page level custom scripts -->
  
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
<script type="text/javascript">
  $(document).ready(function() {
$(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "paging": false,
                "processing": true,
				"bSort": false,
                dom: 'Blfrtip',
				buttons: [
			   {
				   extend: 'pdf',text: 'Export to PDF', className: 'btn btn-primary',
				   orientation: 'landscape',
				   footer: true,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
					}
					
			   },
			   {
				   extend: 'excel',text: 'Export to Excel', className: 'btn btn-success',
				   footer: false,
				   exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
					}
			   }         
			]  
            });

        });
  
  });
</script>
<script src="../../1637028036/vendor/photoviewer/photoviewer.js"></script>
  <script>
    // initialize manually with a list of links
    $('[data-gallery=photoviewer]').click(function (e) {

      e.preventDefault();

      var items = [],
        options = {
          index: $(this).index(),
        };

      $('[data-gallery=photoviewer]').each(function () {
        items.push({
          src: $(this).attr('href'),
          title: $(this).attr('data-title')
        });
      });

      new PhotoViewer(items, options);

    });
  </script>
  </body>
</html>