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
  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Quotation (New Customer)</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <style>
			.form-control
			{
				font-size: 0.9rem !important;
			}
			</style>
				<style>
		.ajax-upload-dragdrop, .ajax-file-upload-statusbar
		{
			width: 100% !important;
		}
		
		</style>
		<?php
	$sqlexcel = "SELECT * From jrcxl order by id desc";
		$queryexcel = mysqli_query($connection, $sqlexcel);
        $rowCountexcel = mysqli_num_rows($queryexcel);
         
        if(!$queryexcel){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountexcel > 0) 
		{
			while( $row = mysqli_fetch_assoc( $queryexcel)){
    $newexcel_array[] = $row; 
}}
	?>
</head>
<body id="page-top" >
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
          <?php //include('quotationnavbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
		  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Add New Quotation (New Customer)</b></h1>
  </div>
  <div class="col-auto">
    <a href="quotations.php" class="m-2 btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Quotation</a>
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
              <h6 class="m-0 font-weight-bold text-primary">Add New Call Details</h6>
            </div>-->
<div class="card-body">


<?php
if(!isset($_GET['noofproduts']))
{
	$noofproduts=0;
	$noofscraps=0;
	?>
	<form action="" method="get">
	
	<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="quotationtype">Number of Products</label>
	<input type="number" name="noofproduts" id="noofproduts" class="form-control" min="1">
  </div>
 </div>
</div>
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="quotationtype">Number of Scrap Products</label>
	<input type="number" name="noofscraps" id="noofscraps" class="form-control" min="0">
  </div>
 </div>
</div>
	
  <hr>
  <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
	</form>
	<?php
}
else
{
	$noofproduts=mysqli_real_escape_string($connection, $_GET['noofproduts']);
	$noofscraps=mysqli_real_escape_string($connection, $_GET['noofscraps']);
	?>		
<form action="newquotationadds.php" method="post" enctype="multipart/form-data">
	
	<input type="hidden" name="consigneeid" value="<?=$consigneeid?>">
	
	<input type="hidden" name="noofproduts" value="<?=$noofproduts?>">
	<input type="hidden" name="noofscraps" value="<?=$noofscraps?>">
	
	<div class="row">
<?php
if($infolayoutcustomers['maincategory']=='1')
{
	
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="maincategory">Main Category</label>
    <input type="text" class="form-control" id="maincategory" name="maincategory"<?=($infolayoutcustomers['maincategoryreq']=='1')?'required':''?>>
  </div>
</div>
<?php
}

else
{
	?>
	<input type="hidden" name="maincategory" id="maincategory" value="">
	<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="subcategory">Sub Category</label>
    <input type="text" class="form-control" id="subcategory" name="subcategory" <?=($infolayoutcustomers['subcategoryreq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="subcategory" id="subcategory" value="">
	<?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-12">
      <div class="form-group">
    <label for="consigneename">Customer Name</label>
    <input type="text" class="form-control" id="consigneename" name="consigneename"  <?=($infolayoutcustomers['consigneenamereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="consigneename" id="consigneename" value="">
	<?php
}
if($infolayoutcustomers['department']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="department">Department</label>
    <input type="text" class="form-control" id="department" name="department" <?=($infolayoutcustomers['departmentreq']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="department" id="department" value="">
	<?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1" <?=($infolayoutcustomers['address1req']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="address1" id="address1" value="">
	<?php
}
if($infolayoutcustomers['address2']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="address2">Address 2</label>
   <input type="text" class="form-control" id="address2" name="address2" <?=($infolayoutcustomers['address2req']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{ 
	?>
	<input type="hidden" name="address2" id="address2" value="">
	<?php
}
if($infolayoutcustomers['area']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="area">Area</label>
    <input type="text" class="form-control" id="area" name="area" <?=($infolayoutcustomers['areareq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="area" id="area" value="">
	<?php
}
if($infolayoutcustomers['district']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District</label>
    <input type="text" class="form-control" id="district" name="district" <?=($infolayoutcustomers['districtreq']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="district" id="district" value="">
	<?php
}
if($infolayoutcustomers['pincode']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="pincode">Pincode</label>
    <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6"  <?=($infolayoutcustomers['pincodereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="pincode" id="pincode" value="">
	<?php
}
if($infolayoutcustomers['contact']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="contact">Contact Person</label>
    <input type="text" class="form-control" id="contact" name="contact" <?=($infolayoutcustomers['contactreq']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="contact" id="contact" value="">
	<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="phone">Phone No</label>
    <input type="text" class="form-control" id="phone" name="phone" maxlength="11" <?=($infolayoutcustomers['phonereq']=='1')?'required':''?>>
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="phone" id="phone" value="">
	<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="mobile">Mobile No</label>
    <input type="text" class="form-control" id="mobile" name="mobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?>>
  </div>
   </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="mobile" id="mobile" value="">
	<?php
}
if($infolayoutcustomers['email']=='1')
{
?> 
<div class="col-lg-3">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?>>
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="email" id="email" value="">
	<?php
}

?>
</div>
	
	<?php
	for($i=1;$i<=$noofproduts;$i++)
	{
		?>

	<h4 class="text-primary">Product <?=$i?> Details</h4>
	
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="quotationtype<?=$i?>">Product Type</label>
    <select class="form-control" name="quotationtype<?=$i?>" id="quotationtype<?=$i?>" required>
		<option value="">Select</option>
		<?php
		$sqlselect = "SELECT id, quotationtype From jrcquotationtype order by quotationtype asc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowprotype = mysqli_fetch_array($queryselect)) 
			{
			?>			
			<option value="<?=$rowprotype['id']?>"><?=$rowprotype['quotationtype']?></option>
			<?php
			$count++;
			}
		}
		?>
	</select>
  </div>
 </div>
</div>
	
  
<div class="row mb-1">
	<div class="col-12">
    <div class="form-group">
    <label for="productname<?=$i?>">Product Name</label>
    <select class="form-control" name="productname<?=$i?>" id="productname<?=$i?>" required>
	<option value="">Select</option>
	</select>
  </div>
	 
		</div>
	</div>
	<div class="row mb-1">
		<div class="col-12" id="productdetails<?=$i?>">
		
		</div>
	</div>	
	<?php
	}
	?>
  	<?php
	for($i=1;$i<=$noofscraps;$i++)
	{
		?>
	<hr>
	<h4 class="text-danger">Scrap Product <?=$i?> Details</h4>
	
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="squotationtype<?=$i?>">Scrap Product Type</label>
    <select class="form-control" name="squotationtype<?=$i?>" id="squotationtype<?=$i?>" required>
		<option value="">Select</option>
		<?php
		$sqlselect = "SELECT id, quotationtype From jrcquotationtype order by quotationtype asc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowprotype = mysqli_fetch_array($queryselect)) 
			{
			?>			
			<option value="<?=$rowprotype['id']?>"><?=$rowprotype['quotationtype']?></option>
			<?php
			$count++;
			}
		}
		?>
	</select>
  </div>
 </div>
</div>
	
  
<div class="row mb-1">
	<div class="col-12">
    <div class="form-group">
    <label for="sproductname<?=$i?>">Scrap Product Name</label>
    <select class="form-control" name="sproductname<?=$i?>" id="sproductname<?=$i?>" required>
	<option value="">Select</option>
	</select>
  </div>
	 
		</div>
	</div>
	<div class="row mb-1">
		<div class="col-12" id="sproductdetails<?=$i?>">
		
		</div>
	</div>	
	<?php
	}
	?>
  <hr>
  <div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="prototal">Products Total Value</label>
	<input type="number" name="prototal" id="prototal" class="form-control" min="1" value="0" readonly>
  </div>
 </div>
</div>
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="scrtotal">Scraps Total Value</label>
	<input type="number" name="scrtotal" id="scrtotal" class="form-control" min="0" value="0" readonly>
  </div>
 </div>
</div>
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="gratotal">Grand Total</label>
	<input type="number" name="gratotal" id="gratotal" class="form-control" min="1" value="0" readonly>
  </div>
 </div>
</div>
<hr>
  <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
</form>
<?php
}
?>
		

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
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
	<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
	<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
	
	<script type="text/javascript">
    $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
	 $( "#maincategory" ).autocomplete({
       source: 'consigneesearch.php?type=maincategory', minLength: 3
     });
	 $( "#subcategory" ).autocomplete({
       source: 'consigneesearch.php?type=subcategory', minLength: 3
     });
	 $( "#consigneename" ).autocomplete({
       /* source: 'consigneesearch.php?type=consigneename', minLength: 3 */
	   
	   source: 'consearch.php', select: function (event, ui) { $("#consigneename").val(ui.item.value); $("#address1").val(ui.item.address1); $("#address2").val(ui.item.address2); $("#area").val(ui.item.area);$("#district").val(ui.item.district); $("#pincode").val(ui.item.pincode);$("#phone").val(ui.item.phone); $("#mobile").val(ui.item.mobile);$("#email").val(ui.item.email);$("#contact").val(ui.item.contact); $("#maincategory").val(ui.item.maincategory);$("#subcategory").val(ui.item.subcategory);$("#department").val(ui.item.department);}, minLength: 3 
     });
	 $( "#department" ).autocomplete({
       source: 'consigneesearch.php?type=department', minLength: 3
     });
  });
   $(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  dropdownAutoWidth : true,
  placeholder: ''
    });
});
  $('.fav_clr').on("select2:select", function (e) { 
           var data = e.params.data.text;
           if(data=='all'){
            $(".fav_clr > option").prop("selected","selected");
            $(".fav_clr").trigger("change");
           }
      });
</script>
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
</script>
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
<script>
function image(thisImg) {
    // var img = document.createElement("IMG");
    // img.src = thisImg;
	// img.className="img-fluid";
    // document.getElementById('showData').appendChild(img);
	var count = $('.imgcontainer .imgcontent').length;
	count = Number(count) + 1;
	$('.imgcontainer').append("<div class='imgcontent' id='imgcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgdelete' id='imgdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
    url: "complaintbefups.php",
    method: "POST",
    allowedTypes:"jpg,png,jpeg",
    fileName: "myfile",
    multiple: true,
	maxFileCount:5,
	acceptFiles:"image/*;capture=camera",
    onSuccess:function(files,data,xhr)
    {
		var obj = JSON.parse(data);
		console.log(obj.imglist);
		image(obj.imglist);
		var vals=$("#imgbefuploads").val();
		if(vals!='')
		{
		$("#imgbefuploads").val(vals+','+obj.imglist);
		}
		else
		{
		$("#imgbefuploads").val(obj.imglist);	
		}
		$("#status").html("<font color='green'>Upload is success</font>");
 
    },
    onError: function(files,status,errMsg)
    {       
        $("#status").html("<font color='red'>Upload is Failed</font>"+errMsg);
    }
}
$("#mulitplefileuploader").uploadFile(settings);
});
</script>
<script>
 // Remove file
                $('.imgcontainer').on('click','.imgcontent .imgdelete',function(){
                    
                    var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];

                     // Get image source
                    var imgElement_src = $( '#imgcontent_'+num+' img' ).attr("src");
                     
                    var deleteFile = confirm("Do you really want to Delete?");
                    if (deleteFile == true) {
						var vals=$("#imgbefuploads").val();
						let newStr = vals.replace(imgElement_src+',', '');
						newStr = newStr.replace(','+imgElement_src, '');
						newStr = newStr.replace(imgElement_src, '');
						$("#imgbefuploads").val(newStr);	
						$('#imgcontent_'+num).remove();
                        // AJAX request
                        /* $.ajax({
                           url: 'complaintrems.php',
                           type: 'post',
                           data: {path: imgElement_src,request: 2},
                           success: function(response){
                                if(response == 1){
                                    $('#imgcontent_'+num).remove();
                                }

                           }
                        }); */
                    }
                });
				</script>
				<script>
				var producttotal=0;
				var scraptotal=0;
				var grandtotal=0;
				</script>
				
<?php
if(isset($_GET['noofproduts']))
{
$noofproduts=mysqli_real_escape_string($connection, $_GET['noofproduts']);
$noofscraps=mysqli_real_escape_string($connection, $_GET['noofscraps']);	
for($i=1;$i<=$noofproduts;$i++)
{
?>	
<script>
    $(document).ready(function(){
        $("#quotationtype<?=$i?>").change(function(){
          var cid=$(this).val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{id:cid},
            success:function(res){
              $("#productname<?=$i?>").html(res);
            }
          });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#productname<?=$i?>").change(function(){
          var cid=$(this).val();
		  var quotationtype=$("#quotationtype<?=$i?>").val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{proid:cid},
            success:function(res){
              var myArray = res.split("|");
			  var result='<table class="table table-bordered">';
			  if(myArray[0]!='')
			  {
				  result+='<input type="hidden" name="productid<?=$i?>" id="productid<?=$i?>" value="'+myArray[0].trim()+'">';
			  }
			  if(myArray[1]!='')
			  {
				  result+='<tr><th>Product Main Category</th><td>'+myArray[1].trim()+'</td></tr>';
			  }
			  if(myArray[2]!='')
			  {
				  result+='<tr><th>Product Sub Category</th><td>'+myArray[2].trim()+'</td></tr>';
			  }
			  if(myArray[3]!='')
			  {
				  result+='<tr><th>Product Name</th><td>'+myArray[3].trim()+'</td></tr>';
			  }
			  if(myArray[4]!='')
			  {
				  result+='<tr><th>Type of Product</th><td>'+myArray[4].trim()+'</td></tr>';
			  }
			  if(myArray[5]!='')
			  {
				  result+='<tr><th>Component Type</th><td>'+myArray[5].trim()+'</td></tr>';
			  }
			  if(myArray[6]!='')
			  {
				  result+='<tr><th>Component Name</th><td>'+myArray[6].trim()+'</td></tr>';
			  }
			  if(myArray[7]!='')
			  {
				  result+='<tr><th>Make</th><td>'+myArray[7].trim()+'</td></tr>';
			  }
			  if(myArray[8]!='')
			  {
				  result+='<tr><th>Capacity</th><td>'+myArray[8].trim()+'</td></tr>';
			  }
			  if(myArray[9]!='')
			  {
				  result+='<tr><th>Warranty</th><td>'+myArray[9].trim()+'</td></tr>';
			  }
			  if(myArray[10]!='')
			  {
				  result+='<tr><th>Description</th><td>'+myArray[10].trim()+'</td></tr>';
			  }
			  if(quotationtype!='AMC QUOTATION')
			  {				  
			  if(myArray[11]!='')
			  {
				  
				 if(myArray[18]!='')
			  {
				  if(myArray[18].trim()=='1')
				  {
					  var GST_Rate=parseFloat(myArray[13]);
					  var Inclusive_Price=parseFloat(myArray[11]);
					 var inc= (Inclusive_Price*GST_Rate)/(100+GST_Rate);
					 var org=(parseFloat(myArray[11])-parseFloat(inc)).toFixed(2);
					  result+='<tr ><th>Price</th><td>'+org+' (Exc.'+myArray[11]+')<input type="hidden" name="price<?=$i?>" id="price<?=$i?>" value="'+org+'"></td></tr>';
					  console.log('k');
				  }
				  else
				  {
					 result+='<tr ><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="price<?=$i?>" id="price<?=$i?>" value="'+myArray[11].trim()+'"></td></tr>';  
					 var org=(parseFloat(myArray[11])).toFixed(2);
					  console.log(myArray[18].trim());
				  }
			  }
			  else
			  {
				  result+='<tr ><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="price<?=$i?>" id="price<?=$i?>" value="'+myArray[11].trim()+'"></td></tr>';
				  var org=(parseFloat(myArray[11])).toFixed(2);
				   console.log('Empty');
			  }
			  }
			  if(myArray[12]!='')
			  {
				  result+='<input type="hidden" name="minprice<?=$i?>" id="minprice<?=$i?>" value="'+myArray[12].trim()+'">';
			  }
			  if(myArray[13]!='')
			  {
				  result+='<tr><th>GST</th><td>'+myArray[13].trim()+'%<input type="hidden" name="gst<?=$i?>" id="gst<?=$i?>" value="'+myArray[13].trim()+'"></td></tr>';
			  }
			  if(myArray[14]!='')
			  {
				  result+='<tr style="display:none"><th>Scrap Value</th><td>'+myArray[14].trim()+'<input type="hidden" name="scrapvalue<?=$i?>" id="scrapvalue<?=$i?>" value="'+myArray[14].trim()+'"></td></tr>';
			  }
			  if(myArray[17]!='')
			  {
				  result+='<tr><th>Installation Cost</th><td>'+myArray[17].trim()+'<input type="hidden" name="installcost<?=$i?>" id="installcost<?=$i?>" value="'+myArray[17].trim()+'"></td></tr>';
			  }
			  if(myArray[11]!='')
			  {
				  result+='<tr><th style="width:50%">Price</th><td><input type="number" name="saleprice<?=$i?>" id="saleprice<?=$i?>" class="form-control" value="'+org+'" min="'+myArray[12].trim()+'" max="'+org+'"  step="0.01" onchange="productcalc<?=$i?>()" required></td></tr><tr><th>No of Quantities</th><td><input type="number" name="salequantity<?=$i?>" id="salequantity<?=$i?>" class="form-control" value="1" min="1" onchange="productcalc<?=$i?>()" required></td></tr><tr><th>Include Installation Cost</th><td><label><input type="radio" name="salesinstallation<?=$i?>" id="salesinstallationyes<?=$i?>" value="1" onchange="productcalc<?=$i?>()"> Yes</label> <label><input type="radio" name="salesinstallation<?=$i?>" id="salesinstallationno<?=$i?>" value="0" onchange="productcalc<?=$i?>()" checked> No</label></td></tr><tr><th>Installation Cost</th><td><input type="number" name="salesinstallcost<?=$i?>" id="salesinstallcost<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr><tr><th>Total Cost</th><td><input type="number" name="salestotal<?=$i?>" id="salestotal<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr><tr><th>Total GST</th><td><input type="number" name="salesgst<?=$i?>" id="salesgst<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr><tr><th>Net Total</th><td><input type="number" name="salesnettotal<?=$i?>" id="salesnettotal<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>No of Scraps</th><td><input type="number" name="salescrap<?=$i?>" id="salescrap<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()"></td></tr><tr style="display:none"><th>Scrap Value</th><td><input type="number" name="salescrapvalue<?=$i?>" id="salescrapvalue<?=$i?>" class="form-control" value="0" readonly onchange="productcalc<?=$i?>()"></td></tr><tr style="display:none"><th>Grand Total</th><td><input type="number" name="salesgrandtotal<?=$i?>" id="salesgrandtotal<?=$i?>" class="form-control" value="0" onchange="productcalc<?=$i?>()" readonly></td></tr>';
			  }
			  
			  }
			  else
			  {			  
			  if(myArray[15]!='')
			  {
				  result+='<tr><th>AMC Value</th><td>'+myArray[15].trim()+'</td></tr>';
			  }
			  if(myArray[16]!='')
			  {
				  result+='<tr><th>AMC GST</th><td>'+myArray[16].trim()+'</td></tr>';
			  }
			  }
			  
			  result+='</table>';
			  
			  $("#productdetails<?=$i?>").html(result);
			  productcalc<?=$i?>();
            }
          });
        });
		$("#productname").trigger("change");
    });
</script>
<script>
var producttotal=0;
function productcalc<?=$i?>()
{
	var saleprice=document.getElementById("saleprice<?=$i?>");
	var salequantity=document.getElementById("salequantity<?=$i?>");
	var salesinstallationyes=document.getElementById("salesinstallationyes<?=$i?>");
	
	var price=document.getElementById("price<?=$i?>");	
	var minprice=document.getElementById("minprice<?=$i?>");	
	var gst=document.getElementById("gst<?=$i?>");	
	var scrapvalue=document.getElementById("scrapvalue<?=$i?>");	
	var installcost=document.getElementById("installcost<?=$i?>");
	
	var salesinstallcost=document.getElementById("salesinstallcost<?=$i?>");
	var salestotal=document.getElementById("salestotal<?=$i?>");
	var salesgst=document.getElementById("salesgst<?=$i?>");
	var salesnettotal=document.getElementById("salesnettotal<?=$i?>");
	var salescrap=document.getElementById("salescrap<?=$i?>");
	var salescrapvalue=document.getElementById("salescrapvalue<?=$i?>");
	var salesgrandtotal=document.getElementById("salesgrandtotal<?=$i?>");
	if(saleprice.value!='')
	{
		if((parseFloat(saleprice.value)<parseFloat(minprice.value))||(parseFloat(saleprice.value)>parseFloat(price.value)))
		{
			alert("Please Enter Valid Selling Price");
			saleprice.focus();
			return false;
		}
		
		var total=0;
		
		if((salequantity.value!='')&&(saleprice.value!=''))
		{
			total=parseFloat(saleprice.value)*parseFloat(salequantity.value);
		}
		/* if(salesinstallationyes.checked==true)
		{
			salesinstallcost.value=installcost.value;
			total+=parseFloat(installcost.value);
		}
		else
		{
			salesinstallcost.value=0;
		}
		salestotal.value=total; */
		
		
		
	if(salesinstallationyes.checked==true)
{
 if(salesinstallcost.value=='0')
 {
    salesinstallcost.value = installcost.value;
 }
 else
 {
	 salesinstallcost.value = salesinstallcost.value; 
 }
salesinstallcost.removeAttribute("readonly");	
total+=parseFloat(salesinstallcost.value);
}
else
{
salesinstallcost.setAttribute("readonly", "readonly");
salesinstallcost.value=0;
}
salestotal.value=total;
		
		
		
		
		
		
		
		var gstvalue=(total*parseFloat(gst.value))/100;
		
		salesgst.value=gstvalue.toFixed(2);
		
		var nettotal=parseFloat(total)+parseFloat(gstvalue);
		
		salesnettotal.value=nettotal.toFixed(2);
		
		var scrap=0;
		if((salescrap.value!='')&&(salescrap.value!='0'))
		{
			scrap=parseFloat(scrapvalue.value)*parseFloat(salescrap.value);
		}		
		salescrapvalue.value=scrap;		
		salesgrandtotal.value=parseFloat(nettotal)-parseFloat(scrap);
		totalcalc();
	}
	else
	{
		
	}	
	
}
</script>	
<?php
}
for($i=1;$i<=$noofscraps;$i++)
{
?>	
<script>
    $(document).ready(function(){
        $("#squotationtype<?=$i?>").change(function(){
          var cid=$(this).val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{id:cid},
            success:function(res){
              $("#sproductname<?=$i?>").html(res);
            }
          });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#sproductname<?=$i?>").change(function(){
          var cid=$(this).val();
		  var quotationtype=$("#squotationtype<?=$i?>").val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{proid:cid},
            success:function(res){
              var myArray = res.split("|");
			  var result='<table class="table table-bordered">';
			  if(myArray[0]!='')
			  {
				  result+='<input type="hidden" name="sproductid<?=$i?>" id="sproductid<?=$i?>" value="'+myArray[0].trim()+'">';
			  }
			  if(myArray[1]!='')
			  {
				  result+='<tr><th>Product Main Category</th><td>'+myArray[1].trim()+'</td></tr>';
			  }
			  if(myArray[2]!='')
			  {
				  result+='<tr><th>Product Sub Category</th><td>'+myArray[2].trim()+'</td></tr>';
			  }
			  if(myArray[3]!='')
			  {
				  result+='<tr><th>Product Name</th><td>'+myArray[3].trim()+'</td></tr>';
			  }
			  if(myArray[4]!='')
			  {
				  result+='<tr><th>Type of Product</th><td>'+myArray[4].trim()+'</td></tr>';
			  }
			  if(myArray[5]!='')
			  {
				  result+='<tr><th>Component Type</th><td>'+myArray[5].trim()+'</td></tr>';
			  }
			  if(myArray[6]!='')
			  {
				  result+='<tr><th>Component Name</th><td>'+myArray[6].trim()+'</td></tr>';
			  }
			  if(myArray[7]!='')
			  {
				  result+='<tr><th>Make</th><td>'+myArray[7].trim()+'</td></tr>';
			  }
			  if(myArray[8]!='')
			  {
				  result+='<tr><th>Capacity</th><td>'+myArray[8].trim()+'</td></tr>';
			  }
			  if(myArray[9]!='')
			  {
				  result+='<tr style="display:none"><th>Warranty</th><td>'+myArray[9].trim()+'</td></tr>';
			  }
			  if(myArray[10]!='')
			  {
				  result+='<tr><th>Description</th><td>'+myArray[10].trim()+'</td></tr>';
			  }
			  if(quotationtype!='AMC QUOTATION')
			  {				  
			  if(myArray[11]!='')
			  {
				  result+='<tr style="display:none"><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="sprice<?=$i?>" id="sprice<?=$i?>" value="'+myArray[11].trim()+'"></td></tr>';
			  }
			  if(myArray[12]!='')
			  {
				  result+='<input type="hidden" name="sminprice<?=$i?>" id="sminprice<?=$i?>" value="'+myArray[12].trim()+'">';
			  }
			  if(myArray[13]!='')
			  {
				  result+='<tr style="display:none"><th>GST</th><td>'+myArray[13].trim()+'%<input type="hidden" name="sgst<?=$i?>" id="sgst<?=$i?>" value="'+myArray[13].trim()+'"></td></tr>';
			  }
			  if(myArray[14]!='')
			  {
				  result+='<tr><th>Scrap Value</th><td>'+myArray[14].trim()+'<input type="hidden" name="sscrapvalue<?=$i?>" id="sscrapvalue<?=$i?>" value="'+myArray[14].trim()+'"></td></tr>';
			  }
			  if(myArray[17]!='')
			  {
				  result+='<tr style="display:none"><th>Installation Cost</th><td>'+myArray[17].trim()+'<input type="hidden" name="sinstallcost<?=$i?>" id="sinstallcost<?=$i?>" value="'+myArray[17].trim()+'"></td></tr>';
			  }
			  if(myArray[11]!='')
			  {
				  result+='<tr style="display:none"><th style="width:50%">Price</th><td><input type="number" name="ssaleprice<?=$i?>" id="ssaleprice<?=$i?>" class="form-control" value="'+myArray[11].trim()+'" min="'+myArray[12].trim()+'" max="'+myArray[11].trim()+'" onchange="sproductcalc<?=$i?>()" required></td></tr><tr style="display:none"><th>No of Quantities</th><td><input type="number" name="ssalequantity<?=$i?>" id="ssalequantity<?=$i?>" class="form-control" value="0" min="0" onchange="sproductcalc<?=$i?>()" required></td></tr><tr style="display:none"><th>Include Installation Cost</th><td><label><input type="radio" name="ssalesinstallation<?=$i?>" id="ssalesinstallationyes<?=$i?>" value="1" onchange="sproductcalc<?=$i?>()"> Yes</label> <label><input type="radio" name="ssalesinstallation<?=$i?>" id="ssalesinstallationno<?=$i?>" value="0" onchange="sproductcalc<?=$i?>()" checked> No</label></td></tr><tr style="display:none"><th>Installation Cost</th><td><input type="number" name="ssalesinstallcost<?=$i?>" id="ssalesinstallcost<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>Total Cost</th><td><input type="number" name="ssalestotal<?=$i?>" id="ssalestotal<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>Total GST</th><td><input type="number" name="ssalesgst<?=$i?>" id="ssalesgst<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr style="display:none"><th>Net Total</th><td><input type="number" name="ssalesnettotal<?=$i?>" id="ssalesnettotal<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr><tr><th>No of Scraps</th><td><input type="number" name="ssalescrap<?=$i?>" id="ssalescrap<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()"></td></tr><tr><th>Scrap Value</th><td><input type="number" name="ssalescrapvalue<?=$i?>" id="ssalescrapvalue<?=$i?>" class="form-control" value="0" readonly onchange="sproductcalc<?=$i?>()"></td></tr><tr ><th>Grand Total</th><td><input type="number" name="ssalesgrandtotal<?=$i?>" id="ssalesgrandtotal<?=$i?>" class="form-control" value="0" onchange="sproductcalc<?=$i?>()" readonly></td></tr>';
			  }
			  
			  }
			  else
			  {			  
			  if(myArray[15]!='')
			  {
				  result+='<tr><th>AMC Value</th><td>'+myArray[15].trim()+'</td></tr>';
			  }
			  if(myArray[16]!='')
			  {
				  result+='<tr><th>AMC GST</th><td>'+myArray[16].trim()+'</td></tr>';
			  }
			  }
			  
			  result+='</table>';
			  
			  $("#sproductdetails<?=$i?>").html(result);
			  sproductcalc<?=$i?>();
            }
          });
        });
		$("#sproductname").trigger("change");
    });
</script>
<script> 

function sproductcalc<?=$i?>()
{
	var saleprice=document.getElementById("ssaleprice<?=$i?>");
	var salequantity=document.getElementById("ssalequantity<?=$i?>");
	var salesinstallationyes=document.getElementById("ssalesinstallationyes<?=$i?>");
	
	var price=document.getElementById("sprice<?=$i?>");	
	var minprice=document.getElementById("sminprice<?=$i?>");	
	var gst=document.getElementById("sgst<?=$i?>");	
	var scrapvalue=document.getElementById("sscrapvalue<?=$i?>");	
	var installcost=document.getElementById("sinstallcost<?=$i?>");
	
	var salesinstallcost=document.getElementById("ssalesinstallcost<?=$i?>");
	var salestotal=document.getElementById("ssalestotal<?=$i?>");
	var salesgst=document.getElementById("ssalesgst<?=$i?>");
	var salesnettotal=document.getElementById("ssalesnettotal<?=$i?>");
	var salescrap=document.getElementById("ssalescrap<?=$i?>");
	var salescrapvalue=document.getElementById("ssalescrapvalue<?=$i?>");
	var salesgrandtotal=document.getElementById("ssalesgrandtotal<?=$i?>");
	if(saleprice.value!='')
	{
		if((parseFloat(saleprice.value)<parseFloat(minprice.value))||(parseFloat(saleprice.value)>parseFloat(price.value)))
		{
			alert("Please Enter Valid Selling Price");
			saleprice.focus();
			return false;
		}
		
		var total=0;
		
		if((salequantity.value!='')&&(saleprice.value!=''))
		{
			total=parseFloat(saleprice.value)*parseFloat(salequantity.value);
		}
		if(salesinstallationyes.checked==true)
		{
			salesinstallcost.value=installcost.value;
			total+=parseFloat(installcost.value);
		}
		else
		{
			salesinstallcost.value=0;
		}
		salestotal.value=total;
		
		var gstvalue=(total*parseFloat(gst.value))/100;
		
		salesgst.value=gstvalue;
		
		var nettotal=parseFloat(total)+parseFloat(gstvalue);
		
		salesnettotal.value=nettotal;
		
		var scrap=0;
		if((salescrap.value!='')&&(salescrap.value!='0'))
		{
			scrap=parseFloat(scrapvalue.value)*parseFloat(salescrap.value);
		}
		
		salescrapvalue.value=scrap;
		
		salesgrandtotal.value=parseFloat(nettotal)-parseFloat(scrap);
		totalcalc();
		
	}
	else
	{
		
	}	
	
}
</script>	
<?php
}
}
?>
<script>
function totalcalc()
{
	var prototal=0;
	var scrtotal=0;
	var gratotal=0;
<?php
for($i=1;$i<=$noofproduts;$i++)
{
	?>
	if(document.getElementById("salesgrandtotal<?=$i?>"))
	{
	prototal+=parseFloat(document.getElementById("salesgrandtotal<?=$i?>").value);
	}
	<?php
}
for($i=1;$i<=$noofscraps;$i++)
{
?>
	if(document.getElementById("ssalesgrandtotal<?=$i?>"))
	{
	scrtotal-=parseFloat(document.getElementById("ssalesgrandtotal<?=$i?>").value);
	}
	<?php
}
?>
gratotal=parseFloat(prototal)-parseFloat(scrtotal);
document.getElementById("prototal").value=prototal.toFixed(2);
document.getElementById("scrtotal").value=scrtotal.toFixed(2);
document.getElementById("gratotal").value=gratotal.toFixed(2);
}
</script>
<?php include('additionaljs.php');   ?>	
	
	
	
</body>
</html>
