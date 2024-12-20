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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Edit AMC Quotation Details</title>

  
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
            <h1 class="h4 mb-2 mt-2 text-gray-800">Edit AMC Quotation</h1>
            
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
              <h6 class="m-0 font-weight-bold text-primary">Edit Quotation</h6>
            </div>-->
<div class="card-body">
<?php
if(isset($_GET['id']) && isset($_GET['date']))
{
$qno=mysqli_real_escape_string($connection,$_GET['id']);
$createdon=mysqli_real_escape_string($connection,$_GET['date']);

		 $sqlselect = "SELECT * From jrcamcquotation where qno='".$qno."' and createdon='".$createdon."'";
		$queryselect = mysqli_query($connection, $sqlselect);
        if(!$queryselect)
		{
           die("SQL query failed: " . mysqli_error($connection));
        }
         if(mysqli_num_rows($queryselect)>0)
{
	
while($rowselect = mysqli_fetch_array($queryselect)){ 
  
			
			?>
<form action="amcquotationgenedits.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="calltid" value="<?=$rowselect['calltid']?>">
	<input type="hidden" name="createdby" value="<?=$rowselect['createdby']?>">
	<input type="hidden" name="createdon" value="<?=$rowselect['createdon']?>">
	<input type="hidden" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
	<input type="hidden" name="sourceid" value="<?=$rowselect['sourceid']?>">
	<input type="hidden" name="quotationtype" value="<?=$rowselect['quotationtype']?>">
	<input type="hidden" name="engineerid" value="<?=$rowselect['engineerid']?>">
	
 <div class="row mb-1">
     <div class="col-6">
      <label for="amcrenewtype" class="col-form-label">AMC Type</label>
    </div>
    <div class="col-6">
      <select class="form-control" id="amcrenewtype" name="amcrenewtype" required>
<option value="">Select</option>
<option value="AMC" <?=($rowselect['amcrenewtype']=='AMC' || $rowselect['amcrenewtype']=='')?'selected':''?>>AMC</option>
<option value="Renewal" <?=$rowselect['amcrenewtype']=='Renewal'?'selected':''?>>Renewal</option>
</select></div>
  </div> 
	
<div class="row mb-1">
     <div class="col-6">
      <label for="priceperyear" class="col-form-label">Price for 12 Months</label>
    </div>
    <div class="col-6">
      <input type="number" class="form-control" name="priceperyear" id="priceperyear" value="<?=($rowselect['priceperyear'])?>" readonly onchange="valuefun()">
    </div>
  </div> 
<div class="row mb-1">
     <div class="col-6">
      <label for="noofmonths" class="col-form-label">Number of Months</label>
    </div>
	<div class="col-6">
	<input type="number" min="0" class="form-control" name="noofmonths" id="noofmonths" value="<?=($rowselect['noofmonths'])?>" onchange="valuefun();monthupdate()"  required>
    </div> 
 </div>   
   <div class="row mb-1">
     <div class="col-6">
      <label for="serialnumber" class="col-form-label">Serial Number</label>
    </div>
    <div class="col-6">
	<select class="form-control fav_clr" name="serialnumber[]" id="serialnumber" multiple>
	<option value="">Select</option>
	<?php
	$serials=$rowselect['serialnumber'];
	$seri=explode('|',$serials);
	$serialnumbers=array();
	$serialnumbers=explode(",",$serials);
	if(!empty($serialnumbers))
				  {
					  foreach($serialnumbers as $ser)
					  {
						  $serialnumbers[]=$ser;
						  
						 ?>
						  <option value="<?=$ser?>" <?=(in_array($ser,$serialnumbers))?'selected':''?> ><?=$ser?></option>
	<?php
					  }
				  }	  ?>
				  <option value="Not Available" >Not Available</option>
		</select>
		 </div>
	  </div> 
	  <div class="row mb-1">
		 <div class="col-6">
		  <label for="quantity" class="col-form-label">Quantity</label>
		</div>
	<div class="col-6">
	<input type="number" min="0" class="form-control" name="quantity" id="quantity" onchange="valuefun()"    value=<?=$rowselect['quantity']?> required readonly>
    </div>
 </div>  

  <hr>
  
   <div class="row mb-1">
     <div class="col-6">
      <label for="resultvalue" class="col-form-label">Value</label>
    </div>
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="resultvalue" id="resultvalue" readonly onchange="valuefun()"  step="0.01" value=<?=$rowselect['resultvalue']?>>
    </div>
    </div>
 
 <div class="row mb-1">
     <div class="col-2">
      <label for="amcgst" class="col-form-label">GST</label>
    </div>
	<div class="col-4">
	<input type="number" min="0" class="form-control" name="amcgst" id="amcgst" readonly value="<?=($rowselect['amcgst'])?>" >
    </div>
	
	
    <div class="col-6">
      <input type="number" min="0" class="form-control" name="amcgstvalue" id="amcgstvalue" readonly  value=<?=$rowselect['amcgstvalue']?>>
   
 </div>  
 </div> 	
<div class="row mb-1">
<div class="col-6">
<label for="btotalvalue" class="col-form-label">Total Amount</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="btotalvalue" id="btotalvalue" readonly value=<?=$rowselect['btotalvalue']?>></div>
</div> 
   <div class="row mb-1">
     <div class="col-6">
      <label for="totalvalue" class="col-form-label">Total Rounded Amount</label>
    </div>
    <div class="col-6">
       <input type="number" min="0" class="form-control" name="totalvalue" id="totalvalue" readonly value=<?=$rowselect['totalvalue']?>></div>
  </div> 
  
  
  <hr>
  <div class="row mb-1">
     <div class="col-6">
      <label for="datefrom" class="col-form-label">Duration From</label>
    </div>
    <div class="col-6">
      <input type="date"  class="form-control" name="datefrom" id="datefrom" onchange="monthupdate()" required value="<?=date('Y-m-d',strtotime($rowselect['datefrom']))?>">
    </div>
  </div> 
<div class="row mb-1">
     <div class="col-6">
      <label for="dateto" class="col-form-label">Duration To</label>
    </div>

    <div class="col-6">
      <input type="date" class="form-control" name="dateto" id="dateto" onchange="monthupdate()" value="<?=date('Y-m-d',strtotime($rowselect['dateto']))?>" readonly>
    </div>
 </div>   
   <div class="row mb-1">
     <div class="col-6">
      <label for="maintenancetype" class="col-form-label">Maintenance Type</label>
    </div>
    <div class="col-6">
      <select class="form-control" id="maintenancetype" name="maintenancetype" required>
<option value="">Select</option>
<option value="Monthly"<?=($rowselect['maintenancetype']=='Monthly')?'selected':''?>>Monthly</option>
<option value="Quarterly" <?=($rowselect['maintenancetype']=='Quarterly')?'selected':''?>> Quarterly</option>
<option value="Half Yearly" <?=($rowselect['maintenancetype']=='Half Yearly')?'selected':''?>>Half Yearly</option>
<option value="Annually" <?=($rowselect['maintenancetype']=='Annually')?'selected':''?>>Annually</option>
</select></div>
  </div> 
 
 <hr>
  <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
</form>
<?php
}			
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
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>

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
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
	<script>
	
	$(document).on('change','#serialnumber',function(){

var rr = $('#serialnumber :selected').length;
$('#quantity').val(rr);
     //console.log(rr);
	 valuefun();
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
		document.getElementById("resultvalue").value =(parseFloat(priceperyear)).toFixed(2);
	}
	
	qtyfun();
}
 </script>	
<script>
function gstfun()
{
	var resultvalue = document.getElementById("resultvalue").value;
	var amcgst = document.getElementById("amcgst").value;
	document.getElementById("amcgstvalue").value =((parseFloat(resultvalue)/100)*parseFloat(amcgst)).toFixed(2);
	netfun();
}
</script>
<script>
function qtyfun()
{
	var quantity = document.getElementById("quantity").value;
	var resultvalue = document.getElementById("resultvalue").value;
	document.getElementById("resultvalue").value =(parseFloat(quantity)*parseFloat(resultvalue)).toFixed(2);
	gstfun();
}
</script>
<script>
function netfun()
{
var amcgstvalue = document.getElementById("amcgstvalue").value;
var resultvalue = document.getElementById("resultvalue").value;
document.getElementById("btotalvalue").value =(parseFloat(resultvalue)+parseFloat(amcgstvalue)).toFixed(2);
document.getElementById("totalvalue").value =Math.round((parseFloat(resultvalue)+parseFloat(amcgstvalue)).toFixed(2));
}
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
