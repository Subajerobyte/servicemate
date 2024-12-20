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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Invoice Submission</title>

  
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

<body id="page-top" >

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
           <?php include('officialnavbar.php');?>
        <div class="container-fluid">

          <!-- Page Heading -->
		  <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800"> Add New Invoice Submission</h1>
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
if(isset($_GET['id']) )
{
	$id=mysqli_real_escape_string($connection, $_GET['id']);

					   $sqlselect1 = "SELECT * From jrcinvoicesubmission where id='".$id."'  order by claimsubon desc ";
        $queryselect1 = mysqli_query($connection, $sqlselect1);
        $rowCountselect1 = mysqli_num_rows($queryselect1);
		 if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect1 > 0 )
		{
         $rowselect1 = mysqli_fetch_array($queryselect1);
		 ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Letter Printing</h6>
            </div>-->
<div class="card-body">

	<form action="invoicesubmissionads.php"  method="Post"  enctype="multipart/form-data">
	
	<input type="hidden" name="id" id="id" value="<?=$id?>" >
	<input type="hidden" name="claimsubon" id="claimsubon" value="<?=$rowselect1['claimsubon']?>" >

<div class="row">
<div class="col-lg-8">
  <div class="form-group">
    <label for="title">Title</label>
	<input type="text" class="form-control"  id="title" name="title" value="<?=$rowselect1['title']?>" required>
	</div>
	
	<label for="editor">Message</label>
	<?php 
	$message=$rowselect1['message'];
    ?>
	<textarea id="editor" name="message" required><?=htmlentities($message);?>
	
	</textarea>

	</div>
	
	<div class="col-lg-4">
	<h4>Variable Codes</h4>
	<span id="messagetip" class="text-primary"></span>
	
	<p> Insert_Table <pre><code id="selectable10" onclick="selectText('selectable10')">&lt;Insert_Table&gt;</code></pre></p>
	
	<p> Invoice_Submitted_On <pre><code id="selectable" onclick="selectText('selectable')">&lt;Invoice_Submitted_On&gt;</code></pre></p>
	
	<p> Invoice_Amount <pre><code id="selectable1" onclick="selectText('selectable1')">&lt;Invoice_Amount&gt;</code></pre></p>
	
	<p> Claim_Percentage<pre><code id="selectable2" onclick="selectText('selectable2')">&lt;Claim_Percentage&gt;</code></pre></p>
	
	<p> Claim_Amount <pre><code id="selectable3" onclick="selectText('selectable3')">&lt;Claim_Amount&gt;</code></pre></p>
	
	<p> Installation_Ref_No <pre><code id="selectable4" onclick="selectText('selectable4')">&lt;Installation_Ref_No&gt;</code></pre></p>
	
	<p> Supplier_Invoice_Ref_No <pre><code id="selectable5" onclick="selectText('selectable5')">&lt;Supplier_Invoice_Ref_No&gt;</code></pre></p>
	
	<p> PO_No <pre><code id="selectable6" onclick="selectText('selectable6')">&lt;PO_No&gt;</code></pre></p>
	
	<p> Quantity <pre><code id="selectable7" onclick="selectText('selectable7')">&lt;Quantity&gt;</code></pre></p>
	
	<p> Invoice_Number <pre><code id="selectable8" onclick="selectText('selectable8')">&lt;Invoice_Number&gt;</code></pre></p>
	
	<p> Invoice_Date <pre><code id="selectable9" onclick="selectText('selectable9')">&lt;Invoice_Date&gt;</code></pre></p>
	
	</div>
	
	<div  id="inserttable" class="col-lg-8" >
	<div  class="table-responsive"  >
	<table id="displaytable2"    cellpadding="1" cellspacing="0" border="3">
    <tr align="center">
      <td  class="lbl" placeholder="column1" style="width:5%"><input  type="text" id="column1" name="column1" placeholder="column1" value="<?=$rowselect1['column1']?>"></td>
      <td  class="lbl" placeholder="column2" style="width:5%"><input type="text" id="column2" name="column2" placeholder="column2" value="<?=$rowselect1['column2']?>"></td>
      <td  class="lbl" placeholder="column3" style="width:5%"><input type="text" id="column3" name="column3" placeholder="column3" value="<?=$rowselect1['column3']?>"></td>
      <td  class="lbl" placeholder="column4" style="width:5%"><input type="text" id="column4" name="column4" placeholder="column4" value="<?=$rowselect1['column4']?>"></td>
      <td  class="lbl" placeholder="column5" style="width:5%"><input  type="text" id="column5" name="column5" placeholder="column5" value="<?=$rowselect1['column5']?>"></td>
      <td  class="lbl" placeholder="column6" style="width:5%"><input  type="text" id="column6" name="column6" placeholder="column6" value="<?=$rowselect1['column6']?>"></td>
      <td  class="lbl" placeholder="column7" style="width:5%"><input  type="text" id="column7" name="column7" placeholder="column7" value="<?=$rowselect1['column7']?>"></td>
      <td  class="lbl" placeholder="column8" style="width:5%"><input  type="text" id="column8" name="column8" placeholder="column8" value="<?=$rowselect1['column8']?>"></td>
      <td  class="lbl" placeholder="column9" style="width:5%"><input type="text" id="column9" name="column9" placeholder="column9" value="<?=$rowselect1['column9']?>"></td>
      <td  class="lbl" placeholder="column10" style="width:5%"><input  type="text" id="column10" name="column10" placeholder="column10" value="<?=$rowselect1['column10']?>"></td>
	  <td  class="lbl" placeholder="column11" style="width:5%"><input  type="text" id="column11" name="column11" placeholder="column11" value="<?=$rowselect1['column11']?>"></td>
	  <td  class="lbl" placeholder="column12" style="width:5%"><input  type="text" id="column12" name="column12" placeholder="column12" value="<?=$rowselect1['column12']?>"></td>
     
    </tr>
    <tr>
      <td align="center" placeholder="value1" name="value1"><input  type="text" id="value1" name="value1" placeholder="value1" value="<?=$rowselect1['value1']?>"></td>
      <td align="center" placeholder="value2" name="value2"><input  type="text" id="value2" name="value2" placeholder="value2" value="<?=$rowselect1['value2']?>"></td>
      <td align="center" placeholder="value3" name="value3"><input  type="text" id="value3" name="value3" placeholder="value3" value="<?=$rowselect1['value3']?>"></td>
      <td align="center" placeholder="value4" name="value4"><input  type="text" id="value4" name="value4" placeholder="value4" value="<?=$rowselect1['value4']?>"></td>
      <td align="center" placeholder="value5" name="value5"><input  type="text" id="value5" name="value5" placeholder="value5" value="<?=$rowselect1['value5']?>"></td>
      <td align="center" placeholder="value6" name="value6"><input  type="text" id="value6" name="value6" placeholder="value6" value="<?=$rowselect1['value6']?>"></td>
      <td align="center" placeholder="value7" name="value7"><input  type="text" id="value7" name="value7" placeholder="value7" value="<?=$rowselect1['value7']?>"></td>
      <td align="center" placeholder="value8" name="value8"><input  type="text" id="value8" name="value8" placeholder="value8" value="<?=$rowselect1['value8']?>"></td>
      <td align="center" placeholder="value9" name="value9"><input  type="text" id="value9" name="value9" placeholder="value9" value="<?=$rowselect1['value9']?>"></td>
      <td align="center" placeholder="value10" name="value10"><input  type="text" id="value10" name="value10" placeholder="value10" value="<?=$rowselect1['value10']?>"></td> 
	  <td align="center" placeholder="value11" name="value11"><input  type="text" id="value11" name="value11" placeholder="value11" value="<?=$rowselect1['value11']?>"></td> 
	  <td align="center" placeholder="value12" name="value12"><input  type="text" id="value12" name="value12" placeholder="value12" value="<?=$rowselect1['value12']?>"></td>
    </tr>
   
  </table>
	
		</div>
		</div>

	</div>
	<button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Submit</button>
</form>	
	  
 
          </div>
        </div>
 
<?php
}
}
else if(isset($_GET['date']) && isset($_GET['pono']))
{
		$date=mysqli_real_escape_string($connection, $_GET['date']);
		$pono=mysqli_real_escape_string($connection, $_GET['pono']);
	?>
	<div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Letter Printing</h6>
            </div>-->
<div class="card-body">

	<form action="invoicesubmissionads.php"  method="Post"  enctype="multipart/form-data">
	<input type="hidden" name="claimsubon" id="claimsubon" value="<?=$date?>" >
	<input type="hidden" name="pono" id="pono" value="<?=$pono?>" >
	<input type="hidden" name="id" id="id" value="" >

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
	<p> Insert_Table<pre><code id="selectable10" onclick="selectText('selectable10')">&lt;Insert_Table&gt;</code></pre></p>	
	
	<p> Invoice_Submitted_On <pre><code id="selectable" onclick="selectText('selectable')">&lt;Invoice_Submitted_On&gt;</code></pre></p>
	
	<p> Invoice_Amount <pre><code id="selectable1" onclick="selectText('selectable1')">&lt;Invoice_Amount&gt;</code></pre></p>
	
	<p> Claim_Percentage<pre><code id="selectable2" onclick="selectText('selectable2')">&lt;Claim_Percentage&gt;</code></pre></p>
	
	<p> Claim_Amount <pre><code id="selectable3" onclick="selectText('selectable3')">&lt;Claim_Amount&gt;</code></pre></p>
	
	<p> Installation_Ref_No <pre><code id="selectable4" onclick="selectText('selectable4')">&lt;Installation_Ref_No&gt;</code></pre></p>
	
	<p> Supplier_Invoice_Ref_No <pre><code id="selectable5" onclick="selectText('selectable5')">&lt;Supplier_Invoice_Ref_No&gt;</code></pre></p>
	
	<p> PO_No <pre><code id="selectable6" onclick="selectText('selectable6')">&lt;PO_No&gt;</code></pre></p>
	
	<p> Quantity <pre><code id="selectable7" onclick="selectText('selectable7')">&lt;Quantity&gt;</code></pre></p>
	
	<p> Invoice_Number <pre><code id="selectable8" onclick="selectText('selectable8')">&lt;Invoice_Number&gt;</code></pre></p>
	
	<p> Invoice_Date <pre><code id="selectable9" onclick="selectText('selectable9')">&lt;Invoice_Date&gt;</code></pre></p>
	</div>
	
	<div  style="display:none;" id="inserttable" class="col-lg-8" >
	<div  class="table-responsive"  >
	<table id="displaytable2"  width="300px"  cellpadding="1" cellspacing="0" border="3">
    <tr align="center">
      <td  class="lbl" placeholder="column1" style="width:5%"><input  type="text" id="column1" name="column1" placeholder="column1"></td>
      <td  class="lbl" placeholder="column2" style="width:5%"><input type="text" id="column2" name="column2" placeholder="column2"></td>
      <td  class="lbl" placeholder="column3" style="width:5%"><input type="text" id="column3" name="column3" placeholder="column3"></td>
      <td  class="lbl" placeholder="column4" style="width:5%"><input type="text" id="column4" name="column4" placeholder="column4"></td>
      <td  class="lbl" placeholder="column5" style="width:5%"><input  type="text" id="column5" name="column5" placeholder="column5"></td>
      <td  class="lbl" placeholder="column6" style="width:5%"><input  type="text" id="column6" name="column6" placeholder="column6"></td>
      <td  class="lbl" placeholder="column7" style="width:5%"><input  type="text" id="column7" name="column7" placeholder="column7"></td>
      <td  class="lbl" placeholder="column8" style="width:5%"><input  type="text" id="column8" name="column8" placeholder="column8"></td>
      <td  class="lbl" placeholder="column9" style="width:5%"><input type="text" id="column9" name="column9" placeholder="column9"></td>
      <td  class="lbl" placeholder="column10" style="width:5%"><input  type="text" id="column10" name="column10" placeholder="column10"></td>
      <td  class="lbl" placeholder="column11" style="width:5%"><input  type="text" id="column11" name="column11" placeholder="column11"></td>
      <td  class="lbl" placeholder="column12" style="width:5%"><input  type="text" id="column12" name="column12" placeholder="column12"></td>
    </tr>
    <tr>
      <td align="center" placeholder="value1" name="value1"><input  type="text" id="value1" name="value1" placeholder="value1"></td>
      <td align="center" placeholder="value2" name="value2"><input  type="text" id="value2" name="value2" placeholder="value2"></td>
      <td align="center" placeholder="value3" name="value3"><input  type="text" id="value3" name="value3" placeholder="value3"></td>
      <td align="center" placeholder="value4" name="value4"><input  type="text" id="value4" name="value4" placeholder="value4"></td>
      <td align="center" placeholder="value5" name="value5"><input  type="text" id="value5" name="value5" placeholder="value5"></td>
      <td align="center" placeholder="value6" name="value6"><input  type="text" id="value6" name="value6" placeholder="value6"></td>
      <td align="center" placeholder="value7" name="value7"><input  type="text" id="value7" name="value7" placeholder="value7"></td>
      <td align="center" placeholder="value8" name="value8"><input  type="text" id="value8" name="value8" placeholder="value8"></td>
      <td align="center" placeholder="value9" name="value9"><input  type="text" id="value9" name="value9" placeholder="value9"></td>
      <td align="center" placeholder="value10" name="value10"><input  type="text" id="value10" name="value10" placeholder="value10"></td>
      <td align="center" placeholder="value11" name="value11"><input  type="text" id="value11" name="value11" placeholder="value11"></td>
      <td align="center" placeholder="value12" name="value12"><input  type="text" id="value12" name="value12" placeholder="value12"></td>
    </tr>
   
  </table>
	
		</div>
		</div>
		
	
	</div>
	<button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Submit</button>
</form>	
	  
 
          </div>
        </div>
	<?php
}



?>
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
height:640,
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
<script>
$('#selectable10').click(function(){
    $("#inserttable").show();
});
/* $("#selectable10").click(function(){
  $("inserttable").show();
}); */
</script>
<?php
include('additionaljs.php'); 
?> 
</body>
</html>
