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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Followup</title>

  
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
   
   <style>
.imgcontainer{
	height:auto;
 text-align:center;
}
.imgcontent{
 width: 110px;
 float: left;
 margin-right: 5px;
 border: 1px solid gray;
 border-radius: 3px;
 padding: 5px;
}

/* Delete */
.imgcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgcontent span:hover{
 cursor: pointer;
}
.ajax-upload-dragdrop, .ajax-file-upload-statusbar, .ajax-file-upload-filename
{
	width: 100% !important;
}
</style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('quotationnavbar.php');?>
        

        
        <div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800"> Add New AMC Followup</h1>
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
          <div class="card shadow mb-4">
            <!---<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"> Add New AMC Followup</h6>
            </div>-->
<div class="card-body">
<div class="row" id="myItems">
 
 <?php
 if(isset($_GET['id']))
 {
	$qno=mysqli_real_escape_string($connection,$_GET['id']);
	
				$sqlcons = "SELECT * From jrcamcquotation where qno='".$qno."'";
				$querycons = mysqli_query($connection, $sqlcons);
				$rowCountcons = mysqli_num_rows($querycons);
				$rowselect=mysqli_fetch_array($querycons);
		?>
		
<div class="col-lg-12 mb-4 items">					
<form action="amcfollowupadds.php" onsubmit="return checkvalidate()" method="post">
<input type="hidden" name="referqno" value="<?=$qno?>">
<input type="hidden" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
<input type="hidden" name="referqdate" value="<?=$rowselect['qdate']?>">
<input type="hidden" name="sourceid" value="<?=$rowselect['sourceid']?>">
	
	
<div class="row">
<div class="col-lg-4">
  <div class="form-group">
    <label for="followupdate">Followup Date and Time</label>
    <input type="datetime-local" class="form-control" id="followupdate" name="followupdate" required>
  </div>
</div>
<div class="col-lg-4">
    <div class="form-group">
    <label for="status">Status</label>
	<select class="form-control" name="status" id="status" onclick="reasonfun()">
						<option value="">Select</option>
						<option value="Completed">Completed</option>
						<option value="Postponed" selected >Postponed</option>
						</option>
					</select>
  </div>
 </div>
 <div class="col-md-4" id="statdiv1" >
			<div class="form-group">
				<label>Followup Postponed Date and Time</label>
					<input  type="datetime-local" name="followupback" id="followupback" class="form-control" >
			</div>
		</div>
  
<div class="col-lg-4">
  <div class="form-group">
    <label for="reason">Remarks Given</label>
    <input type="text" class="form-control" id="reason" name="reason" required>
  </div>
</div>
</div>
  
  
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>		
<?php		
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
     $( "#material" ).autocomplete({
       source: 'materialsearch.php?type=material',
     });
	 $( "#designation" ).autocomplete({
       source: 'materialsearch.php?type=designation',
     });
	 $( "#material" ).autocomplete({
       source: 'materialsearch.php?type=material',
     });
  });
  
    function reasonfun()
{
	var stat=document.getElementById("status").value;
	var statdiv1=document.getElementById("statdiv1");	
	if(stat=="Postponed")
	{
	statdiv1.style.display="block";
	}
	else
	{
	statdiv1.style.display="none";
	followupback.value="";
	}	
}
</script>
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>

<?php include('additionaljs.php');   ?>
</body>

</html>
