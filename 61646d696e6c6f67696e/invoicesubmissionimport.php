<?php
include('lcheck.php'); 
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
		$sub=0;
		$unin=array();
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
        fgetcsv($csvFile);
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        {
			$claimsubon = mysqli_real_escape_string($connection, $getData[1]);
			if($claimsubon!='')
			{
				$claimsubon=date("Y-m-d", strtotime($claimsubon));
			}
            $installrefno = mysqli_real_escape_string($connection, $getData[2]);
            $suprefno = mysqli_real_escape_string($connection, $getData[3]);
            $invoiceno = mysqli_real_escape_string($connection, $getData[4]);
            $invoicedqty = mysqli_real_escape_string($connection, $getData[5]);
            $pono = mysqli_real_escape_string($connection, $getData[6]);
            $podate = mysqli_real_escape_string($connection, $getData[7]);
          
			if($podate!='')
			{
				$podate=date("Y-m-d", strtotime($podate));
			}
            $invoiceamt = mysqli_real_escape_string($connection, $getData[8]);
            $claimper = mysqli_real_escape_string($connection, $getData[9]);
            $claimamt = mysqli_real_escape_string($connection, $getData[10]);
			if($invoiceno!='')
			{
				$sqli=mysqli_query($connection, "select id from jrcxl where invoiceno='$invoiceno'");
				if(mysqli_num_rows($sqli)>0)
				{
					$qr="invoiceno='$invoiceno'";
					if($claimsubon!='')
					{
						if($qr!='')
						{
							$qr.=" , claimsubon='$claimsubon'";
						}
						else
						{
							$qr.=" , claimsubon='$claimsubon'";
						}	
					}
					if($installrefno!='')
					{
						if($qr!='')
						{
							$qr.=" , installrefno='$installrefno'";
						}
						else
						{
							$qr.=" , installrefno='$installrefno'";
						}	
					}
					if($suprefno!='')
					{
						if($qr!='')
						{
							$qr.=" , suprefno='$suprefno'";
						}
						else
						{
							$qr.=" , suprefno='$suprefno'";
						}	
					}
					if($invoicedqty!='')
					{
						if($qr!='')
						{
							$qr.=" , invoicedqty='$invoicedqty'";
						}
						else
						{
							$qr.=" , invoicedqty='$invoicedqty'";
						}	
					}
					if($pono!='')
					{
						if($qr!='')
						{
							$qr.=" , pono='$pono'";
						}
						else
						{
							$qr.=" , pono='$pono'";
						}	
					}
					if($podate!='')
					{
						if($qr!='')
						{
							$qr.=" , podate='$podate'";
						}
						else
						{
							$qr.=" , podate='$podate'";
						}	
					}
					if($invoiceamt!='')
					{
						if($qr!='')
						{
							$qr.=" , invoiceamt='$invoiceamt'";
						}
						else
						{
							$qr.=" , invoiceamt='$invoiceamt'";
						}	
					}
					if($claimper!='')
					{
						if($qr!='')
						{
							$qr.=" , claimper='$claimper'";
						}
						else
						{
							$qr.=" , claimper='$claimper'";
						}	
					}
					if($claimamt!='')
					{
						if($qr!='')
						{
							$qr.=" , claimamt='$claimamt'";
						}
						else
						{
							$qr.=" , claimamt='$claimamt'";
						}	
					}
					
					if($qr!='')
					{
						$sqli2=mysqli_query($connection, "update jrcxl set ".$qr." where invoiceno='$invoiceno'");
						if($sqli2)
						{
							$sub++;
						}
					}
				}
				else
				{
					$unin[]=$invoiceno;
				}
			}
		}
		if($sub!=0)
		{
			if(!empty($unin))
			{
				$uin=implode(', ',$unin);
				header("Location: invoicesubmission.php?remarks=Updated Successfully! Some Invoices not found (".$uin.")");	
			}
			else
			{
			header("Location: invoicesubmission.php?remarks=Updated Successfully");	
			}
			
		}
		else
		{
			if(!empty($unin))
			{
				$uin=implode(', ',$unin);
				header("Location: invoicesubmission.php?error=No Datas Imported! Some Invoices not found (".$uin.")");	
			}
			else
			{
			header("Location: invoicesubmission.php?error=No Datas Imported");
			}
		}
	}
	else
	{
		header("Location: invoicesubmission.php?error=No files Inserted");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Import Invoice Submission</title>

  
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
            <h1 class="h4 mb-2 mt-2 text-gray-800"> Import Invoice Submission</h1>
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
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Import Invoice Submission</h6>
            </div>-->
<div class="card-body">
<form action=""  method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-3">
 <div class="input-group">
                    <div class="form-group">
					<label class="control-label" for="customFileInput">Select File: <a href="invoicesubmission1.csv">Click Here to Download Sample File</a></label>
                        <input type="file" class="form-control" id="customFileInput" name="file" accept=".csv">
                        
                    </div>
                </div>
</div>
 </div>

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

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
<?php
include('additionaljs.php'); 
?> 
</body>
</html>
