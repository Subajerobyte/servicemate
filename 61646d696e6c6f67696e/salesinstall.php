<?php 
include('lcheck.php');  
 
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$subject=mysqli_real_escape_string($connection, $_POST['subject']);
	$contentmessage=mysqli_real_escape_string($connection, $_POST['contentmessage']);
	$terms=mysqli_real_escape_string($connection, $_POST['terms']);
		$msg = "";
  $msg_class = "";
  $msg_class = "";


        $sqlcon = "SELECT id From jrcsalesinstall";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcsalesinstall set subject='$subject', contentmessage='$contentmessage', terms='$terms'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Sales Installation Certificate', '{$id}', 'jrcsalesinstall')");
				header("Location: salesinstall.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				
				$sqlup = "INSERT INTO jrcsalesinstall(subject, contentmessage, terms) VALUES ('$subject', '$contentmessage', '$terms')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert Sales Installation Certificate', '{$tid}')");
				header("Location: salesinstall.php?remarks=Added Successfully");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Sales Installation Certificate</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">   
   <style>
#headerDisplay, #footerDisplay { display: block; height: 100px; width: 100%; margin: 0px auto; border-radius:5%; }
.img-placeholder {
  width: 100%;
  color: white;
  height: 100px;
  background: black;
  opacity: .7;
  height: 135px;
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
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Sales Installation Certificate</h1>
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
              <h6 class="m-0 font-weight-bold text-primary">Quotation Settings</h6>
            </div>-->
<div class="card-body">
<?php 
				  $sqlselect = "SELECT subject,contentmessage,terms From jrcsalesinstall";
				  
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
<div class="col-lg-12">
  <div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" value="<?php  if($rowCountselect > 0) { echo $rowselect['subject']; } ?>">
  </div>
</div>
<div class="col-lg-6">
	<div class="form-group">
		<label for="quotationtype">Content Message</label>
			<textarea id="contentmessage" name="contentmessage" rows="6"><?php  if($rowCountselect > 0) { echo $rowselect['contentmessage']; } ?></textarea>
	</div>	
</div>
<div class="col-lg-6">
	<div class="form-group">
		<label for="terms">Terms and Conditions</label>
			<textarea id="terms" name="terms" rows="6"><?php  if($rowCountselect > 0) { echo $rowselect['terms']; } ?></textarea>
	</div>	
</div>
<!--<div class="col-lg-6">
   <div class="form-group" style="position: relative;" >
<label for="headerimage">Header Image</label>
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClickh()">
                <h4>Update image</h4>
              </div>
			  <input type="hidden" name="headerimageold" id="headerimageold" value="$rowselect['headerimage']?>">
			  <?php 
			  /*if($rowselect['headerimage']!='')
			  {
				?>  
              <img src="<?=$rowselect['headerimage']?>" onClick="triggerClickh()" id="headerDisplay">
			  <?php 
			  }
			  else
			{
				?>  
              <img src="" onClick="triggerClickh()" id="headerDisplay">
			  <?php 
			  }	*/  
			  ?>
            </span>
            <input type="file" name="headerimage" onChange="displayheader(this)" id="headerimage" class="form-control" accept="image/*">
          </div>
   </div>
 <div class="col-lg-6">
   <div class="form-group" style="position: relative;" >
<label for="footerimage">Footer Image</label>
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClickf()">
                <h4>Update image</h4>
              </div>
			  <input type="hidden" name="footerimageold" id="footerimageold" value="$rowselect['footerimage']">
			  <?php 
			  /*if($rowselect['footerimage']!='')
			  {
				?>  
              <img src="<?=$rowselect['footerimage']?>" onClick="triggerClickf()" id="footerDisplay">
			  <?php 
			  }
			  else
			{
				?>  
              <img src="" onClick="triggerClickf()" id="footerDisplay">
			  <?php 
			  }	*/  
			  ?>
            </span>
            <input type="file" name="footerimage" onChange="displayfooter(this)" id="footerimage" class="form-control" accept="image/*">
          </div>
   </div> --> 
   
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
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>	
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
     $( "#quotationtype" ).autocomplete({
       source: 'quotationtypesearch.php?type=quotationtype',
     });
  });
  $(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  placeholder: ''
    });
});
</script>
<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script>
  (function(window) {
    var $canvas,
        onResize = function(event) {
          $canvas.attr({
 
          });
        };

    $(document).ready(function() {
	  $canvas = $('canvas');
      window.addEventListener('orientationchange', onResize, false);
      window.addEventListener('resize', onResize, false);
      onResize();
	  $('#clear').click(function() {
  $('#signpad').signaturePad().clearCanvas();
});

      $('#signpad').signaturePad({
        drawOnly: true,
        defaultAction: 'drawIt',
        validateFields: false,
        lineWidth: 0,
        output :'.output',
        sigNav: null,
        name: null,
        typed: null,
        clear: '#clear',
        typeIt: null,
        drawIt: null,
        typeItDesc: null,
        drawItDesc: null
      });
	  $("#btnSaveSign").click(function(e){
		  
			html2canvas([document.getElementById('pad')], {
				onrendered: function (canvas) {
					var canvas_img_data = canvas.toDataURL('image/png');
					var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					//ajax call to save image inside folder
					$.ajax({
						url: 'save_sign.php',
						data: { img_data:img_data },
						type: 'post',
						success: function (response) {
							console.log(response);
						    $("#signatureimg").attr("src",response);
							$("#signatureimg").show();
						   $("#signature").val(response);
						}
					});
				}, 
				backgroundColor: null, 
			});
		});
    });
  }(this));
  </script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
  <script>
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
  <?php include('additionaljs.php');   ?>
</body>

</html>