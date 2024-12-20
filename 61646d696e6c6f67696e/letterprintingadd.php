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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Letter Printing</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">  
 <script src="../../1637028036/vendor/ckeditor/ckeditor.js"></script>
   <script src="../../1637028036/vendor/ckeditor/samples/js/sample.js"></script>   
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
   <style>
	pre code {
  background-color: #eee;
  border: 1px solid #999;
  display: block;
  padding: 5px;
}
p
{
	margin-bottom:0.5rem;
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

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
           <?php include('officialnavbar.php');?>
        <div class="container-fluid">

          <!-- Page Heading -->
		  <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800"> Add New Letter Printing</h1>
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
              <h6 class="m-0 font-weight-bold text-primary">Letter Printing</h6>
            </div>-->
<div class="card-body">
<form action=""  method="get" >
<div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label>Number of Common Fields</label>
    <input type="number" class="form-control" id="numberofcommon" name="numberofcommon"  min="1" max="10"  value="<?php if(isset($_GET['numberofcommon'])) { echo $_GET['numberofcommon']; }?>" required >
  </div>
</div>
 </div>

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

<?php 
if(isset($_GET['submit']))
{
$numberofcommon=mysqli_real_escape_string($connection, $_GET['numberofcommon']);

?>
<hr>
<form action="" method="Post">
<input type="hidden" name="numberofcommon" value="<?php echo $_GET['numberofcommon']; ?>" />
<?php

for( $i=1; $i<=$numberofcommon; $i++)
			{
				?>
<div class="row">
<div class="col-lg-3">
<div class="form-group">
<label>Field Name <?=$i; ?></label>
<input type="text" class="form-control"  id="fieldname<?=$i; ?>" name="fieldname<?=$i; ?>" value="<?php if(isset($_POST['fieldname'.$i])) { echo $_POST['fieldname'.$i]; }?>">
</div>
</div>
<div class="col-lg-3">
<div class="form-group">
    <label>Field Values <?=$i; ?></label>
<textarea class="form-control" id="fieldvalue<?=$i;?>" name="fieldvalue<?=$i; ?>"  rows="3" required><?php if(isset($_POST['fieldvalue'.$i])) { echo $_POST['fieldvalue'.$i]; }?></textarea>
</div>
</div>
</div>
<?php
			}
			?>
			
<input class="btn btn-primary" type="submit" name="hello" value="Submit">


</form>

<?php
}
  ?>
 
<?php
if(isset($_POST['hello']))
{
	
	
?>
<hr> 
	<form action="letterprintingadds.php"  method="Post"  enctype="multipart/form-data">
	<input type="hidden" name="numberofcommon" value="<?php echo $_GET['numberofcommon']; ?>" />


<input type="hidden" name="fieldname1" id="fieldname1" value="<?php if (isset($_POST['fieldname1'])) { echo $_POST['fieldname1']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue1" id="fieldvalue1" value="<?php if (isset($_POST['fieldvalue1'])) { echo $_POST['fieldvalue1']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname2" id="fieldname2" value="<?php if (isset($_POST['fieldname2'])) { echo $_POST['fieldname2']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue2" id="fieldvalue2" value="<?php if (isset($_POST['fieldvalue2'])) { echo $_POST['fieldvalue2']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname3" id="fieldname3" value="<?php if (isset($_POST['fieldname3'])) { echo $_POST['fieldname3']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue3" id="fieldvalue3" value="<?php if (isset($_POST['fieldvalue3'])) { echo $_POST['fieldvalue3']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname4" id="fieldname4" value="<?php if (isset($_POST['fieldname4'])) { echo $_POST['fieldname4']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue4" id="fieldvalue4" value="<?php if (isset($_POST['fieldvalue4'])) { echo $_POST['fieldvalue4']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname5" id="fieldname5" value="<?php if (isset($_POST['fieldname5'])) { echo $_POST['fieldname5']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue5" id="fieldvalue5" value="<?php if (isset($_POST['fieldvalue5'])) { echo $_POST['fieldvalue5']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname6" id="fieldname6" value="<?php if (isset($_POST['fieldname6'])) { echo $_POST['fieldname6']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue6" id="fieldvalue5" value="<?php if (isset($_POST['fieldvalue6'])) { echo $_POST['fieldvalue6']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname7" id="fieldname7" value="<?php if (isset($_POST['fieldname7'])) { echo $_POST['fieldname7']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue7" id="fieldvalue7" value="<?php if (isset($_POST['fieldvalue7'])) { echo $_POST['fieldvalue7']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname8" id="fieldname8" value="<?php if (isset($_POST['fieldname8'])) { echo $_POST['fieldname8']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue8" id="fieldvalue8" value="<?php if (isset($_POST['fieldvalue8'])) { echo $_POST['fieldvalue8']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname9" id="fieldname9" value="<?php if (isset($_POST['fieldname9'])) { echo $_POST['fieldname9']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue9" id="fieldvalue9" value="<?php if (isset($_POST['fieldvalue9'])) { echo $_POST['fieldvalue9']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldname10" id="fieldname10" value="<?php if (isset($_POST['fieldname10'])) { echo $_POST['fieldname10']; } else { echo ""; } ?>" >
<input type="hidden" name="fieldvalue10" id="fieldvalue10" value="<?php if (isset($_POST['fieldvalue10'])) { echo $_POST['fieldvalue10']; } else { echo ""; } ?>" >
<div class="row">
<div class="col-lg-8">
  <div class="form-group">
    <label for="title">Title</label>
	<input type="text" class="form-control"  id="title" name="title" value="" required>
	</div>
	
	<label for="editor">Message</label>
	<textarea id="editor" name="message" required>
	</textarea>
	</div>
	
	<div class="col-lg-4">
	<h4>Variable Codes</h4>
	<span id="messagetip" class="text-primary"></span>
	<?php if(isset($_POST['fieldname1']))
	{  ?> 
	<p> fieldname1 <pre><code id="selectable" onclick="selectText('selectable')">&lt;<?=$_POST['fieldname1']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname2']))
	{ 
?>
	<p> fieldname2 <pre><code id="selectable1" onclick="selectText('selectable1')">&lt;<?=$_POST['fieldname2']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname3']))
	{ 
?>
	<p> fieldname3 <pre><code id="selectable2" onclick="selectText('selectable2')">&lt;<?=$_POST['fieldname3']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname4']))
	{ 
?>
	<p> fieldname4 <pre><code id="selectable3" onclick="selectText('selectable3')">&lt;<?=$_POST['fieldname4']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname5']))
	{
			
?>
	<p> fieldname5 <pre><code id="selectable4" onclick="selectText('selectable4')">&lt;<?=$_POST['fieldname5']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname6']))
	{ 
?>
	<p> fieldname6 <pre><code id="selectable5" onclick="selectText('selectable5')">&lt;<?=$_POST['fieldname6']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname7']))
	{ 
?>
	<p> fieldname7 <pre><code id="selectable6" onclick="selectText('selectable6')">&lt;<?=$_POST['fieldname7']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname8']))
	{ 
?>
	<p> fieldname8 <pre><code id="selectable7" onclick="selectText('selectable7')">&lt;<?=$_POST['fieldname8']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname9']))
	{ 
?>
	<p> fieldname9 <pre><code id="selectable8" onclick="selectText('selectable8')">&lt;<?=$_POST['fieldname9']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	
	if(isset($_POST['fieldname10']))
	{ 
?>
	<p> fieldname10<pre><code id="selectable9" onclick="selectText('selectable9')">&lt;<?=$_POST['fieldname10']?>&gt;</code></pre></p>
	<?php
	}
else
{
}	 
?>
	</div>
	</div>
	<button type="submit" name="hello2" id="hello2" class="btn btn-primary mt-3"><i class="fa fa-submit"></i> Print Letters</button>
</form>	
	  
<?php
}
?>  
          </div>
        </div>
  </div>
       
      <?php include('footer.php'); ?>
       

    </div>
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
<script>
CKEDITOR.replace('editor', {
height:500,
filebrowserUploadUrl:"upimg.php",
filebrowserUploadMethod:"form"
})
</script>
<script type="text/javascript"> 
function selectText(containerid) {
    if (document.selection) { // IE
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select();
		var copy=document.execCommand("Copy");
		var copied=document.getElementById(containerid).innerHTML;
		document.getElementById("messagetip").innerHTML="Variable "+copied+" Copied.. <br>Paste by usnig Ctrl + V at Editor";
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
		var copy=document.execCommand("Copy");
		var copied=document.getElementById(containerid).innerHTML;
		document.getElementById("messagetip").innerHTML="Variable "+copied+" Copied.. <br>Paste by usnig Ctrl + V at Editor";
    }
}
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>
