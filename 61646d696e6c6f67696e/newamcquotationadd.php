<?php
include('lcheck.php'); 

if($callview=='0')
{
	header("location: dashboard.php");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Call History</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
  <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <style>
.blink {
  animation: blinker 1s step-start infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
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
		
		       <!-- DataTales Example -->
		  <?php  
if((isset($_GET['id']))&&(isset($_GET['xlid'])))
{
	$id=mysqli_real_escape_string($connection,$_GET['xlid']);
	$consigneeid=mysqli_real_escape_string($connection,$_GET['id']);
 $sql="select * from jrcxl where id='$id' and consigneeid='$consigneeid'";
	$rowquery=mysqli_query($connection,$sql);
	$rowCountselect=mysqli_num_rows($rowquery);
	while($rowselect=mysqli_fetch_array($rowquery))
	{
		$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
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
          <div class="card shadow mb-4">
		  <div class="card-body py-3">
              <h6 class="m-0 font-weight-bold">Customer Details :</h6>
<p><?=$rowselect['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <br><?=$rowcons['contact']?>  <br><?=($rowcons['phone']!='' && $rowcons['mobile']!='' )?$rowcons['phone'].' |':(($rowcons['phone']!='')?$rowcons['phone']:'')?> <?=$rowcons['mobile']?></p> 
<hr>
<h6 class="m-0 font-weight-bold">Product Details :</h6>
<p><?php
if($infolayoutproducts['stockmaincategory']=='1')
{
?>
<?=$rowselect['stockmaincategory']?> -
<?php
}
if($infolayoutproducts['stocksubcategory']=='1')
{
?>
<?=$rowselect['stocksubcategory']?> -
<?php
}
if($infolayoutproducts['componentname']=='1')
{
?>
<?=$rowselect['componentname']?> -
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>
<?=$rowselect['stockitem']?>
<?php
}
?><br>Serial Number: <?=($rowselect['serialnumber']!='')?$rowselect['serialnumber']:'Not Available'?></p>

            </div>
            </div>
          <div class="card shadow mb-4">
            
			
<div class="card-body">

<form action="newamcquotationadds.php" method="post" enctype="multipart/form-data" id="myForm">
<input type="hidden" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
<input type="hidden" name="sourceid" value="<?=$rowselect['id']?>">
<input type="hidden" name="quotationtype" value="AMC>">

<?php 
$sqlselect1 = "SELECT DISTINCT stockitem, amcvalue,amcgst From jrcproduct where id='".$rowselect['productid']."' order by id asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
$rowCountselect = mysqli_num_rows($queryselect1);
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
<input type="number" class="form-control" name="priceperyear" id="priceperyear" value="<?=($rowselect1['amcvalue'])?>"  onchange="valuefun()">
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
$serialnumbers=explode("|",$rowselect['serialnumber']);
print_r($serialnumbers);
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
<option value="Not Available">Not Available</option>
</select>
</div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="quantity" class="col-form-label">Quantity</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="quantity" id="quantity" onchange="valuefun();qtyfun()"  required readonly>
</div>
</div>
<hr>
<div class="row mb-1">
<div class="col-6">
<label for="resultvalue" class="col-form-label">Value</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="resultvalue" id="resultvalue"  onchange="valuefun()" step="0.01" readonly>
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
<label for="btotalvalue" class="col-form-label">Total Amount</label>
</div>
<div class="col-6">
<input type="number" min="0" class="form-control" name="btotalvalue" id="btotalvalue" readonly></div>
</div>
<div class="row mb-1">
<div class="col-6">
<label for="totalvalue" class="col-form-label">Total Rounded Amount</label>
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
<input type="date" class="form-control" name="dateto" id="dateto" onchange="monthupdate()">
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
<button type="submit" name="submit" class="btn btn-primary" onclick="validateFormAndSubmit()">SUBMIT</button>
</form>

</div>
</div>
<?php
}
}
?>
		
		
		

      </div>
       

       
      <?php include('footer.php'); ?>
       

    </div>
     

  </div>
   

   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<!--Modal starts Here-->
<div class="modal fade" id="dynamicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Call History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="callhistorybody">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
   
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
  });
   function searchhistory(id)
   {
        var id=id;
        
        $.ajax({
            url:"searchcallhistory.php",
            method:"post",
            data:{id:id},
            success:function(response){
                $("#callhistorybody").html(response);
                $("#dynamicModal").modal('show'); 
            }
        }) 
    }
</script>
<script>
$(document).on('change','#serialnumber',function(){
var rr = $('#serialnumber :selected').length;
$('#quantity').val(rr);
console.log(rr);
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
if(amcgst=='')
{
amcgst=0;
}
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

<?php include('additionaljs.php');   ?>
</body>

</html>
