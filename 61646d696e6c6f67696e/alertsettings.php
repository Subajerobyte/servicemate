<?php 
include('lcheck.php'); 

if(isset($_POST['submit']))
{
	$preventive=mysqli_real_escape_string($connection, $_POST['preventive']);
	$preventivealert=mysqli_real_escape_string($connection, $_POST['preventivealert']);
	$warrantyexpire=mysqli_real_escape_string($connection, $_POST['warrantyexpire']);
	
	$amcmaintenance=mysqli_real_escape_string($connection, $_POST['amcmaintenance']);
	$amcmaintenancealert=mysqli_real_escape_string($connection, $_POST['amcmaintenancealert']);
	$amcexpire=mysqli_real_escape_string($connection, $_POST['amcexpire']);
	$amcrenewal=mysqli_real_escape_string($connection, $_POST['amcrenewal']);
	$lifetime=mysqli_real_escape_string($connection, $_POST['lifetime']);	
	$amcmaintype=mysqli_real_escape_string($connection, $_POST['amcmaintype']);	
	$msg = "";
  $msg_class = "";
 	 
$sqlcon = "SELECT id, companyid From jrccompany";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
 
if(!$querycon)
{
die("SQL query failed: " . mysqli_error($connection));
}
         
        if($rowCountcon > 0)
		{
		$infos=mysqli_fetch_array($querycon);
		$sqlup = "update jrccompany set preventive='$preventive', preventivealert='$preventivealert', warrantyexpire='$warrantyexpire', amcmaintenance='$amcmaintenance', amcmaintenancealert='$amcmaintenancealert', amcexpire='$amcexpire', amcrenewal='$amcrenewal', lifetime='$lifetime' ,amcmaintype='$amcmaintype'";
		$queryup = mysqli_query($connection, $sqlup);
		if(!$queryup){
		   die("SQL query failed: " . mysqli_error($connection));
		}
		else
		{
			$tid=$infos['id'];
			mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Company Information', '{$tid}' ,'jrccompany')");
			header("Location: alertsettings.php?remarks=Updated Successfully");
		} 
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Alert Settings</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
#signDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
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

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>
          <?php  include('mastersnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<!--<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Alert Settings</h1>
          </div>-->
		  
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" ><b>Alert Settings</b></h1>
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
          <div class="card shadow mb-4">
<div class="card-body">
<?php 
$sqlselect = "SELECT preventive,preventivealert,warrantyexpire,amcmaintenance,amcmaintenancealert,amcexpire,amcrenewal,lifetime,amcmaintype From jrccompany order by id asc";  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		$rowselect = mysqli_fetch_array($queryselect);
			?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
	<div class="col-lg-4">
	  <div class="form-group">
		<label for="amcmaintype">AMC Maintenance Type</label><br>
		<label class="mr-2"><input type="radio" name="amcmaintype" id="amcmaintypeauto" value="Auto" <?=(($rowselect['amcmaintype']=='Auto')?"checked":"")?>> Auto (Fixed Duration) </label>
	<label class="mr-2"><input type="radio" name="amcmaintype" id="amcmaintypescalable" value="Scalable"  <?=(($rowselect['amcmaintype']=='Scalable')?"checked":"")?>> Scalable (Last Call +  Duration) </label>
		
		
	  </div>
	</div>
	
	<div class="col-lg-4">
	  <div class="form-group">
		<label for="preventive">Preventive Maintenance Cycle (in Months)</label>
		<input type="number" class="form-control" id="preventive" name="preventive" value="<?=$rowselect['preventive']?>" min="1" max="12">
	  </div>
	</div>
	<div class="col-lg-4">
	  <div class="form-group">
		<label for="preventivealert">Preventive Maintenance Alert (in Days)</label>
		<input type="number" class="form-control" id="preventivealert" name="preventivealert" value="<?=$rowselect['preventivealert']?>">
	  </div>
	</div>
  </div>
  <div class="row">
  <div class="col-lg-4">
	  <div class="form-group">
		<label for="warrantyexpire">Warranty Expiry Alert (in Days)</label>
		<input type="number" class="form-control" id="warrantyexpire" name="warrantyexpire" value="<?=$rowselect['warrantyexpire']?>">
	  </div>
	</div>
	<div class="col-lg-4">
	  <div class="form-group">
		<label for="amcmaintenance">AMC Maintenance Cycle (in Months)</label>
		<input type="number" class="form-control" id="amcmaintenance" name="amcmaintenance" value="<?=$rowselect['amcmaintenance']?>" min="1" max="12">
	  </div>
	</div>
	<div class="col-lg-4">
	  <div class="form-group">
		<label for="amcmaintenancealert">AMC Maintenance Alert (in Days)</label>
		<input type="number" class="form-control" id="amcmaintenancealert" name="amcmaintenancealert" value="<?=$rowselect['amcmaintenancealert']?>">
	  </div>
	</div>
  </div>
  <div class="row">
  <div class="col-lg-4">
	  <div class="form-group">
		<label for="amcexpire">AMC Expiry Alert (in Days)</label>
		<input type="number" class="form-control" id="amcexpire" name="amcexpire" value="<?=$rowselect['amcexpire']?>">
	  </div>
	</div>
	<div class="col-lg-4">
	  <div class="form-group">
		<label for="amcrenewal">AMC Invoice Alert (in Days)</label>
		<input type="number" class="form-control" id="amcrenewal" name="amcrenewal" value="<?=$rowselect['amcrenewal']?>">
	  </div>
	</div>
	<div class="col-lg-4">
	  <div class="form-group">
		<label for="lifetime">Product Lifetime Expiry Alert (in Months)</label>
		<input type="number" class="form-control" id="lifetime" name="lifetime" value="<?=$rowselect['lifetime']?>">
	  </div>
	</div>	
  </div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

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
     $( "#companyname" ).autocomplete({
       source: 'engineersearch.php?type=companyname',
     });
	 $( "#designation" ).autocomplete({
       source: 'engineersearch.php?type=designation',
     });
	 $( "#username" ).autocomplete({
       source: 'engineersearch.php?type=username',
     });
  });
</script>
<script>
var password = document.getElementById("password");
password.addEventListener('keyup', function() {

  var pwd = password.value

  // Reset if password length is zero
  if (pwd.length === 0) {
    document.getElementById("progresslabel").innerHTML = "";
    document.getElementById("progress").value = "0";
    return;
  }

  // Check progress
  var prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
    .reduce((memo, test) => memo + test.test(pwd), 0);

  // Length must be at least 8 chars
  if(prog > 2 && pwd.length > 7){
    prog++;
  }

  // Display it
  var progress = "";
  var strength = "";
  switch (prog) {
    case 0:
    case 1:
    case 2:
      strength = "25%";
      progress = "25";
      break;
    case 3:
      strength = "50%";
      progress = "50";
      break;
    case 4:
      strength = "75%";
      progress = "75";
      break;
    case 5:
      strength = "100% - Password strength is good";
      progress = "100";
      break;
  }
  document.getElementById("progresslabel").innerHTML = strength;
  document.getElementById("progress").value = progress;

});
</script>
<script>
function checkvalidate()
{
	if(document.getElementById("progress").value!="100")
	{
		alert("Kindly give Strength Password");
		document.getElementById("password").focus();
		return false;
	}
}
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
function triggerClick1(e) {
  document.querySelector('#signImage').click();
}
function displayImage1(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#signDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
</script>

<script>
function cleartext()
{
	var str=document.getElementById("latlong").value;
	var result = str.replace(/[^0-9\.,]/g, "");
	document.getElementById("latlong").value=result;
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
