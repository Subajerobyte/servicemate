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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Service Engineer</title>

  
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
          <?php include('usersnavbar.php');?>
         
         

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Add New Service Engineer</h1>
            <a href="engineer.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Service Engineer Details</a>
          </div>
		  <?php
if(isset($_GET['remarks']))
{
?>	
<div class="col-lg-12 mb-2">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      <?=$_GET['remarks']?>
                    </div>
                  </div>
                </div>
<?php
}
 if(isset($_GET['error']))
{
?>	 
  <div class="col-lg-12 mb-2">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                     <?=$_GET['error']?>
                    </div>
                  </div>
                </div>
<?php
}
?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Service Engineer</h6>
            </div>-->
<div class="card-body">
<form action="engineeradds.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label for="engineername">Engineer Name</label>
    <input type="text" class="form-control" id="engineername" name="engineername" required>
  </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="designation">Designation</label>
	<select class="form-control" name="designation" id="designation" required>
	<option value="SERVICE ENGINEER">SERVICE ENGINEER</option>
	<option value="OTHERS">OTHERS</option>
	</select>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="engineergrade">Engineer Grade</label>
	<select class="form-control" name="engineergrade" id="engineergrade" required>
	<option value="">Select</option>
	<option value="GRADE A">GRADE A</option>
	<option value="GRADE B">GRADE B</option>
	<option value="GRADE C">GRADE C</option>
	<option value="GRADE D">GRADE D</option>
	<option value="GRADE E">GRADE E</option>	
	</select>
  </div>
  </div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="compprefix">Service Report Prefix</label>
    <input type="text" class="form-control" id="compprefix" name="compprefix" required>
  </div>
</div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="compno">Service Report Starting No</label>
    <input type="number" class="form-control" id="compno" name="compno" min="0" required>
  </div>
  </div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="compno">Target Point</label>
    <input type="number" class="form-control" min="0" id="targetpoint" name="targetpoint" required>
  </div>
  </div>
  

<div class="col-lg-3">
      <div class="form-group">
      <label for="username">User Name (E-mail)</label>
    <input type="email" class="form-control" id="username" name="username" required>
	
  </div>
  </div>
    
<div class="col-lg-3">
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password"  required>
	<progress id="progress" value="0" max="100">0</progress>
    <span id="progresslabel"></span>
  </div>
   </div>

<div class="col-lg-3">
      <div class="form-group">
    <label for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="address2">Address 2</label>
   <input type="text" class="form-control" id="address2" name="address2">
  </div>
</div>
<div class="col-lg-3">
      <div class="form-group">
    <label for="area">Area</label>
    <input type="text" class="form-control" id="area" name="area">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District</label>
    <input type="text" class="form-control" id="district" name="district">
  </div>
   </div>
   <div class="col-lg-3">
      <div class="form-group">
    <label for="latlong">LatLong </label><a onclick="openaddress()" class="float-right text-danger">Get LatLong</a>
    <input type="text" class="form-control" id="latlong" name="latlong" onKeyup="cleartext()">
  </div>
  </div>

<div class="col-lg-3">
      <div class="form-group">
    <label for="pincode">Pincode</label>
    <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="contact">Contact Person</label>
    <input type="text" class="form-control" id="contact" name="contact" >
  </div>
   </div>

<div class="col-lg-3">
      <div class="form-group">
    <label for="phone">Phone No</label>
    <input type="text" class="form-control" id="phone" name="phone" maxlength="11">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="mobile">Mobile No</label>
    <input type="text" class="form-control" id="mobile" name="mobile" required maxlength="10">
  </div>
   </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="email">E-mail For Notification</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
   </div>
   <div class="col-lg-3">
  <div class="form-group">
    <label for="email">Service Incentive %</label>
    <input type="number" class="form-control" id="incentiveper" name="incentiveper" value="0" min="0" max="100" step="0.01">
  </div>
   </div>
   <?php
	   if($salesmodule=='1')
  {
	  ?>
<div class="col-lg-3">
	  <div class="form-group">
	  <label for="eligiblesales" >Is Eligible For Sales</label ><br>
	<label class="mr-2"><input type="radio" name="eligiblesales" id="eligiblesales" value="1"  onclick="eligible()"> Yes </label>
	<label class="mr-2"><input type="radio" name="eligiblesales" id="eligiblesales" value="0" checked onclick="eligible()"> No </label>
	</div>
	</div>
   <div class="col-lg-3" style="display:none" id="sincentiveper">
  <div class="form-group">
    <label for="sincentiveper">Sales Incentive %</label>
    <input type="number" class="form-control" id="sincentiveper" name="sincentiveper" value="0" min="0" max="100" step="0.01" onchange="eligible()">
  </div>
   </div>

  <?php 
  }
  ?>
<div class="col-lg-3">
	  <div class="form-group">
	  <label for="eligiblesales" >Is Eligible For Taking Calls?</label ><br>
	<label class="mr-2"><input type="radio" name="eligiblecalls" id="eligiblecalls" value="1"  onclick="eligible()"> Yes </label>
	<label class="mr-2"><input type="radio" name="eligiblecalls" id="eligiblecalls" value="0" checked onclick="eligible()"> No </label>
	</div>
	</div>
	<div class="col-lg-3">
	  <div class="form-group">
	  <label for="eligiblesales" >Is Eligible For Taking New Calls From New Customers?</label ><br>
	<label class="mr-2"><input type="radio" name="celigiblecalls" id="celigiblecalls" value="1"  onclick="eligible()"> Yes </label>
	<label class="mr-2"><input type="radio" name="celigiblecalls" id="celigiblecalls" value="0" checked onclick="eligible()"> No </label>
	</div>
	</div>

   <div class="col-lg-3">
   <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <h4>Update image</h4>
              </div>
              <img src="../img/avatar.png" onClick="triggerClick()" id="profileDisplay">
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" accept="image/*" style="display: none;">
            <label>Profile Image</label>
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
     $( "#engineername" ).autocomplete({
       source: 'engineersearch.php?type=engineername',
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
<script>
function eligible()
		{
			var eligiblesales=document.getElementById("eligiblesales");
			var sincentiveper=document.getElementById("sincentiveper");

			if(eligiblesales.checked==true)
			{
				sincentiveper.style.display="block";
			}
			else
			{
				sincentiveper.style.display="none";
			}
		}
		</script>
</body>

</html>