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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Edit Sub Company Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
#signDisplay, #companysealDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
#headerDisplay, #footerDisplay { display: block; height: 100px; width: 100%; margin: 0px auto; border-radius:5%; }
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
    <script src='https://cdn.tiny.cloud/1/m14ktntyv6pl3a77e3fsg1sb7j7y17lwmg1jsp4xwpuaumi3/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
selector: '#contentmessage'
});
tinymce.init({
selector: '#terms'
});
</script>
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
            <h1 class="h4 mb-2 mt-2 text-gray-800">Edit Sub Company Details</h1>
            <a href="subcompany.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Sub Company Details</a>
          </div>-->
		  
		  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" ><b>Edit Sub Company Details</b></h1>
  </div>
<div class="col-auto" style=" text-align: right;">
    <a href="subcompany.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Sub Company Details</a>
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
              <h6 class="m-0 font-weight-bold text-primary">Edit Sub Company Details</h6>
            </div>-->
<div class="card-body">
<?php 
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
				  $sqlselect = "SELECT id,companyname,companyshortname,address1,address2,area,district,pincode,statecode,gstno,panno,  cinno,contact,latlong,phone,mobile,email,salesemail,bankname,acno,branchname,ifscode,avatar,authsign,companyseal,subject,contentmessage,terms,headerimage,footerimage,fontname,diffper From jrcsubcompany where id='".$id."' order by companyname asc";
				  
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
<form action="subcompanyedits.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
	<div class="col-lg-10">
	  <div class="form-group">
		<label for="companyname">Company Name</label>
		<input type="text" class="form-control" id="companyname" name="companyname" value="<?=$rowselect['companyname']?>">
	  </div>
	</div>
	<div class="col-lg-2">
	  <div class="form-group">
		<label for="companyshortname">Company Short Name</label>
		<input type="text" class="form-control" id="companyshortname" name="companyshortname" value="<?=$rowselect['companyshortname']?>" maxlength="4">
	  </div>
	</div>

	<div class="col-lg-3">
      <div class="form-group">
    <label for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1" value="<?=$rowselect['address1']?>">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="address2">Address 2</label>
   <input type="text" class="form-control" id="address2" name="address2" value="<?=$rowselect['address2']?>">
  </div>
   </div>

<div class="col-lg-3">
    <div class="form-group">
		<label for="area">Area</label>
		<input type="text" class="form-control" id="area" name="area" value="<?=$rowselect['area']?>">
	</div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District</label>
    <input type="text" class="form-control" id="district" name="district" value="<?=$rowselect['district']?>">
  </div>
   </div>

 <div class="col-lg-3">
      <div class="form-group">
    <label for="pincode">Pincode</label>
    <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6" value="<?=$rowselect['pincode']?>">
  </div>
  </div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="statecode">State Code</label>
    <input type="text" class="form-control" id="statecode" name="statecode" value="<?=$rowselect['statecode']?>">
  </div>
   </div>

	<div class="col-lg-3">
      <div class="form-group">
    <label for="gstno">GST No</label>
    <input type="text" class="form-control" id="gstno" name="gstno" maxlength="15" value="<?=$rowselect['gstno']?>">
  </div>
  </div>
  <div class="col-lg-3">
      <div class="form-group">
    <label for="gstno">PAN No</label>
    <input type="text" class="form-control" id="panno" name="panno" maxlength="11" value="<?=$rowselect['panno']?>">
  </div>
  </div>

  <div class="col-lg-3">
  <div class="form-group">
    <label for="cinno">CIN</label>
    <input type="text" class="form-control" id="cinno" name="cinno" value="<?=$rowselect['cinno']?>">
  </div>
   </div>


<div class="col-lg-3">
  <div class="form-group">
    <label for="contact">Contact Person</label>
    <input type="text" class="form-control" id="contact" name="contact" value="<?=$rowselect['contact']?>">
  </div>
   </div>
    <div class="col-lg-3">
      <div class="form-group">
    <label for="latlong">LatLong </label><a onclick="openaddress()" class="float-right text-danger">Get LatLong</a>
    <input type="text" class="form-control" id="latlong" name="latlong" value="<?=$rowselect['latlong']?>" onKeyup="cleartext()">
  </div>
  </div>

<div class="col-lg-3">
      <div class="form-group">
    <label for="phone">Phone No</label>
    <input type="text" class="form-control" id="phone" name="phone" maxlength="11" value="<?=$rowselect['phone']?>">
  </div>
  </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="mobile">Mobile No</label>
    <input type="text" class="form-control" id="mobile" name="mobile" value="<?=$rowselect['mobile']?>">
  </div>
   </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?=$rowselect['email']?>">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="salesemail">Email (Sales)</label>
    <input type="email" class="form-control" id="salesemail" name="salesemail" value="<?=$rowselect['salesemail']?>">
  </div>
   </div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="bankname">Bank Name</label>
    <input type="text" class="form-control" id="bankname" name="bankname" value="<?=$rowselect['bankname']?>" maxlength="50">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="acno">Account No</label>
    <input type="text" class="form-control" id="acno" name="acno" value="<?=$rowselect['acno']?>" maxlength="50">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="branchname">Branch Name</label>
    <input type="text" class="form-control" id="branchname" name="branchname" value="<?=$rowselect['branchname']?>" maxlength="50">
  </div>
   </div>

   <div class="col-lg-3">
  <div class="form-group">
    <label for="ifscode">IFSCode</label>
    <input type="text" class="form-control" id="ifscode" name="ifscode" value="<?=$rowselect['ifscode']?>" maxlength="50">
  </div>
   </div>

   </div>


    <div class="row">
   <div class="col-lg-3">
		<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <h4>Company Logo</h4>
              </div>
			  <input type="hidden" name="avatarold" id="avatarold" value="<?=$rowselect['avatar']?>">
			  <?php 
			  if($rowselect['avatar']!='')
			  {
				?>  
              <img src="<?=$rowselect['avatar']?>" onClick="triggerClick()" id="profileDisplay">
			  <?php 
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerClick()" id="profileDisplay">
			  <?php 
			  }	  
			  ?>
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" accept="image/*" style="display: none;">
            <label>Company Logo</label>
        </div>
   </div>

   <div class="col-lg-3">
		<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick1()">
                <h4>Authorized Signature</h4>
              </div>
			  <input type="hidden" name="authsignold" id="authsignold" value="<?=$rowselect['authsign']?>">
			  <?php 
			  if($rowselect['authsign']!='')
			  {
				?>  
              <img src="<?=$rowselect['authsign']?>" onClick="triggerClick1()" id="signDisplay">
			  <?php 
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerClick1()" id="signDisplay">
			  <?php 
			  }	  
			  ?>
            </span>
            <input type="file" name="signImage" onChange="displayImage1(this)" id="signImage" class="form-control" accept="image/*" style="display: none;">
            <label>Authorised Signature</label>
        </div>
   </div>

   <div class="col-lg-3">
		<div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggercompanysealClick1()">
                <h4>Company Seal</h4>
              </div>
			  <input type="hidden" name="companysealold" id="companysealold" value="<?=$rowselect['companyseal']?>">
			  <?php 
			  if($rowselect['companyseal']!='')
			  {
				?>  
              <img src="<?=$rowselect['companyseal']?>" onClick="triggercompanysealClick1()" id="companysealDisplay">
			  <?php 
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggercompanysealClick1()" id="companysealDisplay">
			  <?php 
			  }	  
			  ?>
            </span>
            <input type="file" name="companysealImage" onChange="displaycompanysealImage1(this)" id="companysealImage" class="form-control" accept="image/*" style="display: none;">
            <label>Company Seal</label>
        </div>
   </div>



  </div>
  <hr>
  <div class="row">
<div class="col-lg-12">
  <div class="form-group">
    <label for="subject">Quotation Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" value="<?=$rowselect['subject']?>">
  </div>
</div>
<div class="col-lg-6">
	<div class="form-group">
		<label for="quotationtype">Content Message</label>
			<textarea id="contentmessage" name="contentmessage" rows="6"><?=$rowselect['contentmessage']?></textarea>
	</div>	
</div>
<div class="col-lg-6">
	<div class="form-group">
		<label for="terms">Terms and Conditions</label>
			<textarea id="terms" name="terms" rows="6"><?=$rowselect['terms']?></textarea>
	</div>	
</div>
<div class="col-lg-6">
   <div class="form-group" style="position: relative;" >
<label for="headerimage">Header Image</label>
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClickh()">
                <h4>Update image</h4>
              </div>
			  <input type="hidden" name="headerimageold" id="headerimageold" value="<?=$rowselect['headerimage']?>">
			  <?php 
			  if($rowselect['headerimage']!='')
			  {
				?>  
              <img src="<?=$rowselect['headerimage']?>" onClick="triggerClickh()" id="headerDisplay">
			  <?php 
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerClickh()" id="headerDisplay">
			  <?php 
			  }	  
			  ?>
            </span>
            <input type="file" name="headerimage" onChange="displayheader(this)" id="headerimage" class="form-control" accept="image/*" style="display:none">
          </div>
   </div>
 <div class="col-lg-6">
   <div class="form-group" style="position: relative;" >
<label for="footerimage">Footer Image</label>
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClickf()">
                <h4>Update image</h4>
              </div>
			  <input type="hidden" name="footerimageold" id="footerimageold" value="<?=$rowselect['footerimage']?>">
			  <?php 
			  if($rowselect['footerimage']!='')
			  {
				?>  
              <img src="<?=$rowselect['footerimage']?>" onClick="triggerClickf()" id="footerDisplay">
			  <?php 
			  }
			  else
			{
				?>  
              <img src="../img/avatar.png" onClick="triggerClickf()" id="footerDisplay">
			  <?php 
			  }	  
			  ?>
            </span>
            <input type="file" name="footerimage" onChange="displayfooter(this)" id="footerimage" class="form-control" accept="image/*" style="display:none">
          </div>
   </div>  
   
   <div class="col-lg-6">
  <div class="form-group">
    <label for="fontname">Font Name</label>
    <select class="form-control" id="fontname" name="fontname">
	<option value="">Select</option>
	<option value="Arial, sans-serif" <?=($rowselect['fontname']=="Arial, sans-serif")?'selected':''?>>Arial</option>
	<option value="Verdana, sans-serif" <?=($rowselect['fontname']=="Verdana, sans-serif")?'selected':''?>>Verdana</option>
	<option value="Tahoma, sans-serif" <?=($rowselect['fontname']=="Tahoma, sans-serif")?'selected':''?>>Tahoma</option>
	<option value="'Trebuchet MS', sans-serif" <?=($rowselect['fontname']=="'Trebuchet MS', sans-serif")?'selected':''?>>Trebuchet MS</option>
	<option value="'Times New Roman', serif" <?=($rowselect['fontname']=="'Times New Roman', serif")?'selected':''?>>Times New Roman</option>
	<option value="Georgia, serif" <?=($rowselect['fontname']=="Georgia, serif")?'selected':''?>>Georgia</option>
	<option value="Garamond, serif" <?=($rowselect['fontname']=="Garamond, serif")?'selected':''?>>Garamond</option>
	<option value="'Courier New', monospace" <?=($rowselect['fontname']=="'Courier New', monospace")?'selected':''?>>Courier New</option>
	<option value="'Brush Script MT', cursive" <?=($rowselect['fontname']=="'Brush Script MT', cursive")?'selected':''?>>Brush Script MT</option>
	</select>
  </div>
   </div>
   
    <div class="col-lg-6">
  <div class="form-group">
    <label for="diffper">Diff %</label>
    <input type="number" class="form-control" id="diffper" name="diffper" maxlength="50" min="0" step="0.01" value="<?=$rowselect['diffper']?>">
  </div>
   </div>
   
   
   
  </div>
  

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
<?php 
					$count++;
			}
		}
}
			?>
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
     $( "#subcompany" ).autocomplete({
       source: 'subcompanysearch.php?type=subcompany',
     });
	 $( "#designation" ).autocomplete({
       source: 'subcompanysearch.php?type=designation',
     });
	 $( "#subcompany" ).autocomplete({
       source: 'subcompanysearch.php?type=subcompany',
     });
  });
</script>
<script>

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

function triggercompanysealClick1(e) {
  document.querySelector('#companysealImage').click();
}
function displaycompanysealImage1(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#companysealDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClickh(e) {
  document.querySelector('#headerimage').click();
}
function triggerClickf(e) {
  document.querySelector('#footerimage').click();
}
function displayheader(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#headerDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
function displayfooter(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#footerDisplay').setAttribute('src', e.target.result);
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
