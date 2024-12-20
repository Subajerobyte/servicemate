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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New AMC Quotation</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
	
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
   
   <style>
.imgcontainer{
	height:auto;
 text-align:center;
}
.imgcontent{
 width: 110px;
 float: left;
 margin-right: 5px;
 border: 1px solid gray;
 border-radius: 3px;
 padding: 5px;
}

/* Delete */
.imgcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgcontent span:hover{
 cursor: pointer;
}
.ajax-upload-dragdrop, .ajax-file-upload-statusbar, .ajax-file-upload-filename
{
	width: 100% !important;
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
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Add New AMC Quotation</h1>
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
              <h6 class="m-0 font-weight-bold text-primary"> Add New AMC Quotation</h6>
            </div>-->
<div class="card-body">
<div class="row">
 <div class="col-lg-12">
 <?php
 if(isset($_GET['remarks']))
 {
	 ?>
	 <div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
	
	 <?php
 }
?> 
 <div class="row" id="myItems">
 
 <?php
 if(isset($_GET['id']))
 {
	$id=mysqli_real_escape_string($connection,$_GET['id']);
	$xlid=mysqli_real_escape_string($connection,$_GET['xlid']);
	//$calltid=mysqli_real_escape_string($connection,$_GET['id']);
	//$_SESSION['calltid']=$calltid;
	
		$sqlselect = "SELECT * From jrcamcquotation";
        $queryselect = mysqli_query($connection, $sqlselect);
       	$rowselect = mysqli_fetch_array($queryselect);
			
	
		
				$sqlxl = "SELECT * From jrcxl where tdelete='0' and  id='".$xlid."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountxl > 0) 
				{
					$rowxl = mysqli_fetch_array($queryxl);
					if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowxl['address1']!='')
		{
		$rowxl['address1']=jbsdecrypt($encpass, $rowxl['address1']);
		}
		if($rowxl['phone']!='')
		{
		$rowxl['phone']=jbsdecrypt($encpass, $rowxl['phone']);
		}
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($encpass, $rowxl['mobile']);
		}
		if($rowxl['email']!='')
		{
		$rowxl['email']=jbsdecrypt($encpass, $rowxl['email']);
		}
	}
}
				}
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				  $sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
				  
        $querycons = mysqli_query($connection, $sqlcons);
        $rowCountcons = mysqli_num_rows($querycons);
         
        if(!$querycons){
           die("SQL query failed: " . mysqli_error($connection));
        }
        $rowcons = mysqli_fetch_array($querycons);
		if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowcons['address1']!='')
		{
		$rowcons['address1']=jbsdecrypt($encpass, $rowcons['address1']);
		}
		if($rowcons['phone']!='')
		{
		$rowcons['phone']=jbsdecrypt($encpass, $rowcons['phone']);
		}
		if($rowcons['mobile']!='')
		{
		$rowcons['mobile']=jbsdecrypt($encpass, $rowcons['mobile']);
		}
		if($rowcons['email']!='')
		{
		$rowcons['email']=jbsdecrypt($encpass, $rowcons['email']);
		}
	}
}
		?>
		<?php
		if(isset($rowselect['compstatus']))
		{
					 if($rowselect['compstatus']=='2')
					  {
						$bg="bg-success";
						$bgtext="Completed";
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						$bg="bg-warning";
						$bgtext="Pending";
					  }
					  else
					 {
						 $bg="bg-danger";
						$bgtext="Open";
					  }
		}
					  ?>
		<div class="col-lg-12 mb-4 items">
                                   
									
                                            <h5>Customer Details:</h5>
											<p><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
											if($rowcons['latlong']!='')
											{
											?>	
											<br>
											<a class="text-primary" style="cursor:pointer" onClick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a><?php
											}
											?>
											</p>
											<hr>
											<h5>Product Details:</h5>
											<p><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowxl['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowxl['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowxl['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowxl['stockitem']?>
												<?php
												}
												?><br><?=$rowxl['serialnumber']?></p>

<?php
if(!isset($_GET['quotationtype']))
{
	?>
	<form action="" method="get">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="xlid" value="<?=$xlid?>">
	<?php
			  if(isset($_GET['ts1']))
			  {
				?>
				<input type="hidden" id="ts1" name="ts1" value="<?=$_GET['ts1']?>">
				<?php				
			  }
			  ?>
	<div class="row">
 <div class="col-lg-12">
  <div class="form-group">
    <label for="quotationtype">Quotation Type</label>
	<select class="form-control" id="quotationtype" name="quotationtype" required>
	
	<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcamcquotationtype order by id asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['quotationtype']?></option>
<?php
			}
		}
		?>
</select></div>
 </div>	
</div>

  <hr>
  <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
	</form>
	<?php
}
else
{
	$id=mysqli_real_escape_string($connection,$_GET['id']);
	$quotationtype=mysqli_real_escape_string($connection, $_GET['quotationtype']);
	?>		
<form action="amcquotationgens.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="sourceid" value="<?=$xlid?>">
	<input type="hidden" name="consigneeid" value="<?=$consigneeid?>">
	<input type="hidden" name="quotationtype" value="<?=$quotationtype?>">
	<input type="hidden" name="ts1" value="<?=$_GET['ts1']?>">

	
	<hr>
	

<?php
			$sqlselect1 = "SELECT DISTINCT stockitem, amcvalue,amcgst From jrcproduct where stockitem='".$rowxl['stockitem']."' order by id asc";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowselect1 = mysqli_fetch_array($queryselect1);
		 ?> 
		  <div class="row mb-1">
     <div class="col-6">
      <label for="amcrenewtype" class="col-form-label">AMC Type</label>
    </div>
    <div class="col-6">
      <select class="form-control" id="amcrenewtype" name="amcrenewtype" required>
<option value="">Select</option>
<option value="AMC">AMC</option>
<option value="Renewal">Renewal</option>
</select></div>
  </div> 
<div class="row mb-1">
     <div class="col-6">
      <label for="priceperyear" class="col-form-label">Price for 12 Months</label>
    </div>
    <div class="col-6">
      <input type="number" class="form-control" name="priceperyear" id="priceperyear" value="<?=($rowselect1['amcvalue'])?>"readonly onchange="valuefun()">
    </div>
  </div> 
<div class="row mb-1">
     <div class="col-6">
      <label for="noofmonths" class="col-form-label">Number of Months</label>
    </div>
	<div class="col-6">
	<input type="number" min="0" class="form-control" name="noofmonths" id="noofmonths"  onchange="valuefun();monthupdate()"  required>
    </div>
 </div>   
   <div class="row mb-1">
     <div class="col-6">
      <label for="serialnumber" class="col-form-label">Serial Number</label>
    </div>
    <div class="col-6">
	<select class="form-control fav_clr" name="serialnumber[]" id="serialnumber" multiple  onchange="valuefun()">
	<option value="">Select</option>
	<?php
	$serialnumbers=array();
	$serialnumbers=explode("|",$rowxl['serialnumber']);
	if(!empty($serialnumbers))
				  {
					  
					  foreach($serialnumbers as $ser)
					  {
						  $serialnumbers[]=$ser;
						 ?>
						  <option value="<?=$ser?>"><?=$ser?></option>
	<?php
					  }
				  }	  ?>
	</select>
     </div>
  </div> 
  <div class="row mb-1">
     <div class="col-6">
      <label for="quantity" class="col-form-label">Quantity</label>
    </div>
	<div class="col-6">
	<input type="number" min="0" class="form-control" name="quantity" id="quantity" onchange="valuefun()"   required readonly>
    </div>
 </div>  

  <hr>
  
   <div class="row mb-1">
     <div class="col-6">
      <label for="resultvalue" class="col-form-label">Value</label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="resultvalue" id="resultvalue" readonly onchange="valuefun()" step="0.01">
    </div>
    </div>
 
 <div class="row mb-1">
     <div class="col-2">
      <label for="amcgst" class="col-form-label">GST</label>
    </div>
	<div class="col-4">
	<input type="number" min="0" class="form-control" name="amcgst" id="amcgst" readonly value="<?=($rowselect1['amcgst'])?>" >
    </div>
	
	
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="amcgstvalue" id="amcgstvalue" readonly >
   
 </div>  
 </div> 	 
   <div class="row mb-1">
     <div class="col-6">
      <label for="totalvalue" class="col-form-label">Total Amount</label>
    </div>
    <div class="col-6">
       <input type="number" min="0" class="form-control" name="totalvalue" id="totalvalue" readonly></div>
  </div> 
  
  
  <hr>
  <div class="row mb-1">
     <div class="col-6">
      <label for="datefrom" class="col-form-label">Duration From</label>
    </div>
    <div class="col-6">
      <input type="date"  class="form-control" name="datefrom" id="datefrom" onchange="monthupdate()" required>
    </div>
  </div> 
<div class="row mb-1">
     <div class="col-6">
      <label for="dateto" class="col-form-label">Duration To</label>
    </div>

    <div class="col-6">
      <input type="date" class="form-control" name="dateto" id="dateto" onchange="monthupdate()" readonly>
    </div>
 </div>   
   <div class="row mb-1">
     <div class="col-6">
      <label for="maintenancetype" class="col-form-label">Maintenance Type</label>
    </div>
    <div class="col-6">
      <select class="form-control" id="maintenancetype" name="maintenancetype" required>
<option value="">Select</option>
<option value="Monthly">Monthly</option>
<option value="Quarterly">Quarterly</option>
<option value="Half Yearly">Half Yearly</option>
<option value="Annually">Annually</option>
</select></div>
  </div> 
  <hr>
  
 
  <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
</form>
<?php
}
?>


											
                                        </div>
                                 		
					<?php
 }		
			?>
			
			
 </div>
			
			</div>
			

            
          </div>
		
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
				
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>
	
	$(document).on('change','#serialnumber',function(){

var rr = $('#serialnumber :selected').length;
$('#quantity').val(rr);
valuefun();
     //console.log(rr);
});

</script>
<script>
function valuefun()
{
	var priceperyear = document.getElementById("priceperyear").value;
	var noofmonths = document.getElementById("noofmonths").value;
	if(priceperyear!="" && noofmonths!="")
	{
	document.getElementById("resultvalue").value =((parseFloat(priceperyear)/12)*parseFloat(noofmonths));
	}
	else
	{
		document.getElementById("resultvalue").value =(parseFloat(priceperyear));
	}
	
	qtyfun();
}
 </script>	
<script>
function qtyfun()
{
	var quantity = document.getElementById("quantity").value;
	var resultvalue = document.getElementById("resultvalue").value;
	document.getElementById("resultvalue").value =(parseFloat(quantity)*parseFloat(resultvalue));
	if(quantity=="0" && resultvalue!="")
	{
	document.getElementById("resultvalue").value =(parseFloat(quantity));
	}
	else
	{
		document.getElementById("resultvalue").value =(parseFloat(quantity)*parseFloat(resultvalue));
	}
	gstfun();
}
</script>
<script>
function gstfun()
{
	var resultvalue = document.getElementById("resultvalue").value;
	var amcgst = document.getElementById("amcgst").value;
	document.getElementById("amcgstvalue").value =((parseFloat(resultvalue)/100)*parseFloat(amcgst));
	netfun();
} 
</script>
<script>
function netfun()
{
	var amcgstvalue = document.getElementById("amcgstvalue").value;
	var resultvalue = document.getElementById("resultvalue").value;
	document.getElementById("totalvalue").value =(parseFloat(resultvalue)+parseFloat(amcgstvalue));
	
}
</script>
	

		<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
	
<script>
  $(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
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
<script>
function add_months(dt, n) 
 {
   return new Date(dt.setMonth(dt.getMonth() + n));      
 }
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
} 
 function monthupdate()
 {
	 var noofmonths=document.getElementById("noofmonths");
	 var datefrom=document.getElementById("datefrom");
	 var dateto=document.getElementById("dateto");
	 if((noofmonths.value!="")&&(datefrom.value!=""))
	 {
		 var str=datefrom.value;
		 console.log(str);
		 var res = str.split("-");
		 var dt = new Date(res[0],res[1],res[2]);
		 dt=add_months(dt, parseInt(noofmonths.value)-1);
		 dt.setDate(dt.getDate() - 1);		 
		 dateto.value=formatDate(dt.toString());
	 }
	 
 }
</script>

<script>
function mapsSelector(lat,lon) {
  if ((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) || (navigator.platform.indexOf("iPod") != -1))
  {
    window.open("maps://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
  }
else 
{
    window.open("https://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
}
function myFunction() {
    var input, filter, cards, cardContainer, h5, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("items");
    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
