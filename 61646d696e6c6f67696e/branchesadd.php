<?php
include('lcheck.php'); 


if($settings=='0')
{
	header("Location: dashboard.php");
}
?>
<?php
if(isset($_POST['submit']))
{
	$createdon=date('Y-m-d H:i:s');
	$createdby=$email;
	$branchname=mysqli_real_escape_string($connection, $_POST['branchname']);
	$branchdes=mysqli_real_escape_string($connection, $_POST['branchdes']);
	$address1=mysqli_real_escape_string($connection, $_POST['address1']);
	$address2=mysqli_real_escape_string($connection, $_POST['address2']);
	$area=mysqli_real_escape_string($connection, $_POST['area']);
	$district=mysqli_real_escape_string($connection, $_POST['district']);
	$pincode=mysqli_real_escape_string($connection, $_POST['pincode']);
	$caretaker=mysqli_real_escape_string($connection, $_POST['caretaker']);
	$caretakerphone=mysqli_real_escape_string($connection, $_POST['caretakerphone']);
	$geolocation=mysqli_real_escape_string($connection, $_POST['geolocation']);
	if(($branchname!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcbranch WHERE branchname = '{$branchname}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
			 
			 $sqlup = "INSERT INTO jrcbranch(createdon,createdby,branchname,branchdes,address1,address2,area,district,pincode,caretaker,caretakerphone,geolocation) VALUES ( '$createdon','$createdby','$branchname','$branchdes','$address1','$address2','$area','$district','$pincode','$caretaker','$caretakerphone','$geolocation')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A New Branch', '{$tid}', 'jrcbranch')");
				header("Location: branches.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: branches.php?error=This record is Already Found! Kindly check in All Branch List");
			}
	}
	else
			{
				header("Location: branches.php?error=Error Data");
			}
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Branch </title>

  
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
          <?php include('mastersnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Add New Branch</h1>
            <a href="branches.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Branch Details</a>
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
           <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add Branch Details</h6>
            </div>-->
<div class="card-body">
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-4">
  <div class="form-group">
    <label for="branchname">Branch Name</label><span class="text-danger"> *</span>
    <input type="text" class="form-control" id="branchname" name="branchname" placeholder="Branch Name" required>
  </div>
</div>
 <div class="col-lg-4">
  <div class="form-group">
    <label for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="address1">Address 2</label>
    <input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="area">Area</label>
    <input type="text" class="form-control" id="area" name="area" placeholder="Area">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="district">District</label>
    <input type="text" class="form-control" id="district" name="district" placeholder="District">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="description">Pincode</label>
    <input type="text" class="form-control" id="pincode" name="pincode" maxlength='6' placeholder="Pincode">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="caretaker">Care Taker</label>
    <input type="text" class="form-control" id="caretaker" name="caretaker" placeholder="Care Taker">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="caretakerphone">Contact</label>
    <input type="text" class="form-control" id="caretakerphone" name="caretakerphone" maxlength='10' placeholder="Contact">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="branchdes">Branch Description</label>
    <input type="text" class="form-control" id="branchdes" name="branchdes" placeholder="Branch Description">
  </div>
</div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="geolocation">Lat Long</label><a onclick="openaddress()" class="float-right text-danger">Get LatLong</a>
    <input type="text" class="form-control" id="geolocation" name="geolocation" onKeyup="cleartext()">
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
function cleartext()
{
	var str=document.getElementById("geolocation").value;
	var result = str.replace(/[^0-9\.,]/g, "");
	document.getElementById("geolocation").value=result;
}
function openaddress()
{
	var address1=document.getElementById("address1").value;
	var address2=document.getElementById("address2").value;
	var area=document.getElementById("area").value;
	var district=document.getElementById("district").value;
	var pincode=document.getElementById("pincode").value;
	window.open("maplatlong.php?address="+address1+" "+address2+" "+area+" "+district+" "+pincode+" ", "_blank"); 
}
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
