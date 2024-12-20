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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Edit Quotation Details</title>

  
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
          <?php include('quotationnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Edit Quotation</h1>
            
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
            <!--div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Quotation</h6>
            </div-->
<div class="card-body">
<?php
if(isset($_GET['id']) && isset($_GET['date']))
{
$qno=mysqli_real_escape_string($connection,$_GET['id']);
$createdon=mysqli_real_escape_string($connection,$_GET['date']);

		$sqlselect = "SELECT * From jrcquotation where qno='".$qno."' and createdon='".$createdon."'";
		$queryselect = mysqli_query($connection, $sqlselect);
        if(!$queryselect)
		{
           die("SQL query failed: " . mysqli_error($connection));
        }
         if(mysqli_num_rows($queryselect)>0)
{
$rowselect = array();
while($row = mysqli_fetch_assoc($queryselect)){ 
$rowselect[] = $row;
}
        
			
			?>
<form action="quoatationgenedits.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="qno" id="qno" value="<?=$rowselect[0]['qno']?>">
<input type="hidden" name="qdate" id="qdate" value="<?=$rowselect[0]['qdate']?>">
<input type="hidden" name="consigneeid" id="consigneeid" value="<?=$rowselect[0]['consigneeid']?>">
<input type="hidden" name="createdon" id="createdon" value="<?=$rowselect[0]['createdon']?>">
<input type="hidden" name="createdby" id="createdby" value="<?=$rowselect[0]['createdby']?>">
<input type="hidden" name="engineerid" id="engineerid" value="<?=$rowselect[0]['engineerid']?>">
<input type="hidden" name="sourceid" id="sourceid" value="<?=$rowselect[0]['sourceid']?>">
<input type="hidden" name="calltid" id="calltid" value="<?=$rowselect[0]['calltid']?>">



<?php
$inc=1;
foreach($rowselect as $row)
{
	if($row['qtype']=='PRODUCT')
	{
	?>
		 <input type="hidden" name="id[]" id="id<?=$inc?>" value="<?=$row['id']?>">
		 <input type="hidden" name="qtype<?=$inc?>" id="qtype<?=$inc?>" value="<?=$row['qtype']?>">
<h4 class="text-primary">Product <?=$inc?> Details</h4>
	
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="quotationtype<?=$inc?>">Product Type</label>
    <select class="form-control" name="quotationtype<?=$inc?>" id="quotationtype<?=$inc?>" required>
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
<option value="<?=$rowprotype['id']?>" <?=($rowprotype['id']==$row['quotationtype'])?'selected':''?>><?=$rowprotype['quotationtype']?></option>			
			
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
	<div class="col-lg-12">
    <div class="form-group">
    <label for="productname<?=$inc?>">Product Name</label>
    <select class="form-control" name="productname<?=$inc?>" id="productname<?=$inc?>" required>
		<option value="">Select</option>
	<?php
	$sqlselect = "SELECT stockitem From jrcquotationtype where id='".$row['quotationtype']."' order by quotationtype asc";
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
			$stockitems=explode(',',$rowprotype['stockitem']);
			foreach($stockitems as $st)
			{
				
				$sqlselect2 = "SELECT id, stockitem, make From jrcproduct where id='$st' order by stockitem asc";
				$queryselect2 = mysqli_query($connection, $sqlselect2);
				$infoselect2=mysqli_fetch_array($queryselect2);
		?>
	
		<option value="<?=$infoselect2['id']?>" <?=($infoselect2['id']==$row['productname'])?'selected':''?>><?=$infoselect2['stockitem']?><?=($infoselect2['make']!='')?' | '.$infoselect2['make']:''?></option>
		
		<?php
			}
			
			$count++;
		}
	}
	
		
	?>
	</select>
  </div>
	 
		</div>
	</div>
	<div class="row mb-1">
		<div class="col-12" id="productdetails<?=$inc?>">
		
		</div>
	</div>	

  	<?php
	$inc++;
	}
}
$noofproduts=($inc++)-1;
?>
	<hr>
	<?php
	$inc1=1;
	foreach($rowselect as $row)
{
	if($row['qtype']=='SCRAP')
	{
		?>
	<input type="hidden" name="id[]" id="id<?=$inc1?>" value="<?=$row['id']?>" >
	<input type="hidden" name="qtype<?=$inc1?>" id="qtype<?=$inc1?>" value="<?=$row['qtype']?>" >
	<h4 class="text-danger">Scrap Product <?=$inc1?> Details</h4>
	
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="squotationtype<?=$inc1?>">Scrap Product Type</label>
    <select class="form-control" name="squotationtype<?=$inc1?>" id="squotationtype<?=$inc1?>" required>
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
			<option value="<?=$rowprotype['id']?>" <?=($rowprotype['id']==$row['quotationtype'])?'selected':''?>><?=$rowprotype['quotationtype']?></option>					
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
	<div class="col-lg-12">
    <div class="form-group">
    <label for="sproductname<?=$inc1?>">Scrap Product Name</label>
    <select class="form-control" name="sproductname<?=$inc1?>" id="sproductname<?=$inc1?>" required>
	<option value="">Select</option>
	<?php
	
	
	$sqlselect = "SELECT stockitem From jrcquotationtype where id='".$row['quotationtype']."' order by quotationtype asc";
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
			$stockitems=explode(',',$rowprotype['stockitem']);
			foreach($stockitems as $st)
			{
				
				$sqlselect2 = "SELECT id,stockitem, make From jrcproduct where id='$st' order by stockitem asc";
				$queryselect2 = mysqli_query($connection, $sqlselect2);
				$infoselect2=mysqli_fetch_array($queryselect2);
		?>
	
		<option value="<?=$infoselect2['id']?>" <?=($infoselect2['id']==$row['productname'])?'selected':''?>><?=$infoselect2['stockitem']?><?=($infoselect2['make']!='')?' | '.$infoselect2['make']:''?></option>
		
		<?php
			}
		}
	}
	?>
	
	</select>
  </div>
	 
		</div>
	</div>
	<div class="row mb-1">
		<div class="col-lg-12" id="sproductdetails<?=$inc1?>">
		
		</div>
	</div>	

<?php
		$inc1++;
	}	
	$noofscraps=($inc1)-1;
}

?>
<input type="hidden" name="noofproduts" id="noofproduts" value="<?=$noofproduts?>">
<input type="hidden" name="noofscraps" id="noofscraps" value="<?=$noofscraps?>">


  <div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="prototal">Products Total Value</label>
	<input type="number" name="prototal" id="prototal" class="form-control" min="1" value="<?=$rowselect[0]['prototal']?>" readonly>
  </div>
 </div>
</div>
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="scrtotal">Scraps Total Value</label>
	<input type="number" name="scrtotal" id="scrtotal" class="form-control" min="0" value="<?=$rowselect[0]['scrtotal']?>" readonly>
  </div>
 </div>
</div>
<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="gratotal">Grand Total</label>
	<input type="number" name="gratotal" id="gratotal" class="form-control" min="1" value="<?=$rowselect[0]['gratotal']?>" readonly>
  </div>
 </div>
</div>


<br>

  <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
</form>
<?php
					
		}

}
			?>
          
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
$inc=1;
foreach($rowselect as $row)
{
	if($row['qtype']=='PRODUCT')
	{
	?>	
<script>
    $(document).ready(function(){
        $("#quotationtype<?=$inc?>").change(function(){
          var cid=$(this).val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{id:cid},
            success:function(res){
              $("#productname<?=$inc?>").html(res);
            }
          });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#productname<?=$inc?>").change(function(){
          var cid=$(this).val();
		  var quotationtype=$("#quotationtype<?=$inc?>").val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{proid:cid},
            success:function(res){
              var myArray = res.split("|");
			  var result='<table class="table table-bordered">';
			  if(myArray[0]!='')
			  {
				  result+='<input type="hidden" name="productid<?=$inc?>" id="productid<?=$inc?>" value="'+myArray[0].trim()+'">';
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
				  result+='<tr><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="price<?=$inc?>" id="price<?=$inc?>" value="'+myArray[11].trim()+'"></td></tr>';
			  }
			  if(myArray[12]!='')
			  {
				  result+='<input type="hidden" name="minprice<?=$inc?>" id="minprice<?=$inc?>" value="'+myArray[12].trim()+'">';
			  }
			  if(myArray[13]!='')
			  {
				  result+='<tr><th>GST</th><td>'+myArray[13].trim()+'%<input type="hidden" name="gst<?=$inc?>" id="gst<?=$inc?>" value="'+myArray[13].trim()+'"></td></tr>';
			  }
			  if(myArray[14]!='')
			  {
				  result+='<tr style="display:none"><th>Scrap Value</th><td>'+myArray[14].trim()+'<input type="hidden" name="scrapvalue<?=$inc?>" id="scrapvalue<?=$inc?>" value="'+myArray[14].trim()+'"></td></tr>';
			  }
			  if(myArray[17]!='')
			  {
				  result+='<tr><th>Installation Cost</th><td>'+myArray[17].trim()+'<input type="hidden" name="installcost<?=$inc?>" id="installcost<?=$inc?>" value="'+myArray[17].trim()+'"></td></tr>';
			  }
			  if(myArray[11]!='')
			  {
				  result+='<tr><th style="width:50%">Price</th><td><input type="number" name="saleprice<?=$inc?>" id="saleprice<?=$inc?>" class="form-control" value="'+myArray[11].trim()+'" min="'+myArray[12].trim()+'" max="'+myArray[11].trim()+'" onchange="productcalc<?=$inc?>()" required></td></tr><tr><th>No of Quantities</th><td><input type="number" name="salequantity<?=$inc?>" id="salequantity<?=$inc?>" class="form-control" value="<?=$row['salequantity']?>" min="1" onchange="productcalc<?=$inc?>()" required></td></tr><tr><th>Include Installation Cost</th><td><label><input type="radio" name="salesinstallation<?=$inc?>" id="salesinstallationyes<?=$inc?>" value="1"<?=($row['salesinstallation']=="1")?'checked':''?> onchange="productcalc<?=$inc?>()"> Yes</label> <label><input type="radio" name="salesinstallation<?=$inc?>" id="salesinstallationno<?=$inc?>" value="0"<?=($row['salesinstallation']=="0")?'checked':''?> onchange="productcalc<?=$inc?>()" > No</label></td></tr><tr><th>Installation Cost</th><td><input type="number" name="salesinstallcost<?=$inc?>" id="salesinstallcost<?=$inc?>" class="form-control" value="<?=$row['salesinstallcost']?>" onchange="productcalc<?=$inc?>()" readonly></td></tr><tr><th>Total Cost</th><td><input type="number" name="salestotal<?=$inc?>" id="salestotal<?=$inc?>" class="form-control" value="<?=$row['salestotal']?>" onchange="productcalc<?=$inc?>()" readonly></td></tr><tr><th>Total GST</th><td><input type="number" name="salesgst<?=$inc?>" id="salesgst<?=$inc?>" class="form-control" value="<?=$row['salesgst']?>" onchange="productcalc<?=$inc?>()" readonly></td></tr><tr><th>Net Total</th><td><input type="number" name="salesnettotal<?=$inc?>" id="salesnettotal<?=$inc?>" class="form-control" value="<?=$row['salesnettotal']?>" onchange="productcalc<?=$inc?>()" readonly></td></tr><tr style="display:none"><th>No of Scraps</th><td><input type="number" name="salescrap<?=$inc?>" id="salescrap<?=$inc?>" class="form-control" value="<?=$row['salescrap']?>" onchange="productcalc<?=$inc?>()"></td></tr><tr style="display:none"><th>Scrap Value</th><td><input type="number" name="salescrapvalue<?=$inc?>" id="salescrapvalue<?=$inc?>" class="form-control" value="<?=$row['salescrapvalue']?>" readonly onchange="productcalc<?=$inc?>()"></td></tr><tr style="display:none"><th>Grand Total</th><td><input type="number" name="salesgrandtotal<?=$inc?>" id="salesgrandtotal<?=$inc?>" class="form-control" value="<?=$row['salesgrandtotal']?>" onchange="productcalc<?=$inc?>()" readonly></td></tr>';
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
			  
			  $("#productdetails<?=$inc?>").html(result);
			  productcalc<?=$inc?>();
            }
          });
        });
		$("#productname<?=$inc?>").trigger("change");
    });
</script>
<script>
var producttotal=0;
function productcalc<?=$inc?>()
{
	var saleprice=document.getElementById("saleprice<?=$inc?>");
	var salequantity=document.getElementById("salequantity<?=$inc?>");
	var salesinstallationyes=document.getElementById("salesinstallationyes<?=$inc?>");
	
	var price=document.getElementById("price<?=$inc?>");	
	var minprice=document.getElementById("minprice<?=$inc?>");	
	var gst=document.getElementById("gst<?=$inc?>");	
	var scrapvalue=document.getElementById("scrapvalue<?=$inc?>");	
	var installcost=document.getElementById("installcost<?=$inc?>");
	
	var salesinstallcost=document.getElementById("salesinstallcost<?=$inc?>");
	var salestotal=document.getElementById("salestotal<?=$inc?>");
	var salesgst=document.getElementById("salesgst<?=$inc?>");
	var salesnettotal=document.getElementById("salesnettotal<?=$inc?>");
	var salescrap=document.getElementById("salescrap<?=$inc?>");
	var salescrapvalue=document.getElementById("salescrapvalue<?=$inc?>");
	var salesgrandtotal=document.getElementById("salesgrandtotal<?=$inc?>");
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
$inc++;
}
}
?>
<?php
$inc1=1;
foreach($rowselect as $row)
{
	
	if($row['qtype']=='SCRAP')
	{
	?>	
<script>
    $(document).ready(function(){
        $("#squotationtype<?=$inc1?>").change(function(){
          var cid=$(this).val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{id:cid},
            success:function(res){
              $("#sproductname<?=$inc1?>").html(res);
            }
          });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#sproductname<?=$inc1?>").change(function(){
          var cid=$(this).val();
		  var quotationtype=$("#squotationtype<?=$inc1?>").val();
          $.ajax({
            url:'quotation_products.php',
            type:'post',
            data:{proid:cid},
            success:function(res){
              var myArray = res.split("|");
			  var result='<table class="table table-bordered">';
			  if(myArray[0]!='')
			  {
				  result+='<input type="hidden" name="sproductid<?=$inc1?>" id="sproductid<?=$inc1?>" value="'+myArray[0].trim()+'">';
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
				  result+='<tr style="display:none"><th>Price</th><td>'+myArray[11].trim()+'<input type="hidden" name="sprice<?=$inc1?>" id="sprice<?=$inc1?>" value="'+myArray[11].trim()+'"></td></tr>';
			  }
			  if(myArray[12]!='')
			  {
				  result+='<input type="hidden" name="sminprice<?=$inc1?>" id="sminprice<?=$inc1?>" value="'+myArray[12].trim()+'">';
			  }
			  if(myArray[13]!='')
			  {
				  result+='<tr style="display:none"><th>GST</th><td>'+myArray[13].trim()+'%<input type="hidden" name="sgst<?=$inc1?>" id="sgst<?=$inc1?>" value="'+myArray[13].trim()+'"></td></tr>';
			  }
			  if(myArray[14]!='')
			  {
				  result+='<tr><th>Scrap Value</th><td>'+myArray[14].trim()+'<input type="hidden" name="sscrapvalue<?=$inc1?>" id="sscrapvalue<?=$inc1?>" value="'+myArray[14].trim()+'"></td></tr>';
			  }
			  if(myArray[17]!='')
			  {
				  result+='<tr style="display:none"><th>Installation Cost</th><td>'+myArray[17].trim()+'<input type="hidden" name="sinstallcost<?=$inc1?>" id="sinstallcost<?=$inc1?>" value="'+myArray[17].trim()+'"></td></tr>';
			  }
			  if(myArray[11]!='')
			  {
				  result+='<tr style="display:none"><th style="width:50%">Price</th><td><input type="number" name="ssaleprice<?=$inc1?>" id="ssaleprice<?=$inc1?>" class="form-control" value="'+myArray[11].trim()+'" min="'+myArray[12].trim()+'" max="'+myArray[11].trim()+'" onchange="sproductcalc<?=$inc1?>()" required></td></tr><tr style="display:none"><th>No of Quantities</th><td><input type="number" name="ssalequantity<?=$inc1?>" id="ssalequantity<?=$inc1?>" class="form-control" value="<?=$row['salequantity']?>" min="0" onchange="sproductcalc<?=$inc1?>()" required></td></tr><tr style="display:none"><th>Include Installation Cost</th><td><label><input type="radio" name="ssalesinstallation<?=$inc1?>" id="ssalesinstallationyes<?=$inc1?>" value="1" onchange="sproductcalc<?=$inc1?>()"> Yes</label> <label><input type="radio" name="ssalesinstallation<?=$inc1?>" id="ssalesinstallationno<?=$inc1?>" value="0" onchange="sproductcalc<?=$inc1?>()" checked> No</label></td></tr><tr style="display:none"><th>Installation Cost</th><td><input type="number" name="ssalesinstallcost<?=$inc1?>" id="ssalesinstallcost<?=$inc1?>" class="form-control" value="<?=$row['salesinstallcost']?>" onchange="sproductcalc<?=$inc1?>()" readonly></td></tr><tr style="display:none"><th>Total Cost</th><td><input type="number" name="ssalestotal<?=$inc1?>" id="ssalestotal<?=$inc1?>" class="form-control" value="<?=$row['salestotal']?>" onchange="sproductcalc<?=$inc1?>()" readonly></td></tr><tr style="display:none"><th>Total GST</th><td><input type="number" name="ssalesgst<?=$inc1?>" id="ssalesgst<?=$inc1?>" class="form-control" value="<?=$row['salesgst']?>" onchange="sproductcalc<?=$inc1?>()" readonly></td></tr><tr style="display:none"><th>Net Total</th><td><input type="number" name="ssalesnettotal<?=$inc1?>" id="ssalesnettotal<?=$inc1?>" class="form-control" value="<?=$row['salesnettotal']?>" onchange="sproductcalc<?=$inc1?>()" readonly></td></tr><tr><th>No of Scraps</th><td><input type="number" name="ssalescrap<?=$inc1?>" id="ssalescrap<?=$inc1?>" class="form-control" value="<?=$row['salescrap']?>" onchange="sproductcalc<?=$inc1?>()"></td></tr><tr><th>Scrap Value</th><td><input type="number" name="ssalescrapvalue<?=$inc1?>" id="ssalescrapvalue<?=$inc1?>" class="form-control" value="<?=$row['salescrapvalue']?>" readonly onchange="sproductcalc<?=$inc1?>()"></td></tr><tr ><th>Grand Total</th><td><input type="number" name="ssalesgrandtotal<?=$inc1?>" id="ssalesgrandtotal<?=$inc1?>" class="form-control" value="<?=$row['salesgrandtotal']?>" onchange="sproductcalc<?=$inc1?>()" readonly></td></tr>';
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
			  
			  $("#sproductdetails<?=$inc1?>").html(result);
			  sproductcalc<?=$inc1?>();
            }
          });
        });
		$("#sproductname<?=$inc1?>").trigger("change");
		 });
</script>
<script> 

function sproductcalc<?=$inc1?>()
{
	var saleprice=document.getElementById("ssaleprice<?=$inc1?>");
	var salequantity=document.getElementById("ssalequantity<?=$inc1?>");
	var salesinstallationyes=document.getElementById("ssalesinstallationyes<?=$inc1?>");
	
	var price=document.getElementById("sprice<?=$inc1?>");	
	var minprice=document.getElementById("sminprice<?=$inc1?>");	
	var gst=document.getElementById("sgst<?=$inc1?>");	
	var scrapvalue=document.getElementById("sscrapvalue<?=$inc1?>");	
	var installcost=document.getElementById("sinstallcost<?=$inc1?>");
	
	var salesinstallcost=document.getElementById("ssalesinstallcost<?=$inc1?>");
	var salestotal=document.getElementById("ssalestotal<?=$inc1?>");
	var salesgst=document.getElementById("ssalesgst<?=$inc1?>");
	var salesnettotal=document.getElementById("ssalesnettotal<?=$inc1?>");
	var salescrap=document.getElementById("ssalescrap<?=$inc1?>");
	var salescrapvalue=document.getElementById("ssalescrapvalue<?=$inc1?>");
	var salesgrandtotal=document.getElementById("ssalesgrandtotal<?=$inc1?>");
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
$inc1++;
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
for($i=1;$i<=$inc;$i++)
{
	?>
	if(document.getElementById("salesgrandtotal<?=$i?>"))
	{
	prototal+=parseFloat(document.getElementById("salesgrandtotal<?=$i?>").value);
	}
	<?php
}
for($i=1;$i<=$inc1;$i++)
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
document.getElementById("prototal").value=prototal;
document.getElementById("scrtotal").value=scrtotal;
document.getElementById("gratotal").value=gratotal;
}
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
