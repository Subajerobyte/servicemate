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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Price Marks</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
  
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
          <?php include('productnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Add New Price Marks</h1>
            <a href="mark.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Price Marks</a>
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
              <h6 class="m-0 font-weight-bold text-primary">Add New Price Marks</h6>
            </div>-->
<div class="card-body">
<form action="markadds.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<div class="row">
 <div class="col-lg-3">
  <div class="form-group">
    <label for="productname">Price Mark Name<span class="text-danger">&nbsp;*</span></label>
    <input type="text" class="form-control" id="productname" name="productname" required>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="type">Type</label>
	<br>
	<label><input type="radio" id="typesales" name="type" value="0" checked>&nbsp;Sales</label>&nbsp;			
	<label><input type="radio" id="typepurchase" name="type" value="1">&nbsp;Purchase</label>
  </div>
</div>

<div class="col-lg-6">
  <div class="form-group">
    <label for="type">Item Rate</label>
	<br>
	<label><input type="radio" id="ratemark" name="itemrate" value="0"  onclick="rate()" checked>&nbsp;Markup or Markdown the item rates by a percentage</label>&nbsp;			
	<label><input type="radio" id="rateeach" name="itemrate"  onclick="rate()" value="1">&nbsp;Enter the rate individually for each item</label>
  </div>
</div>

<div class="col-lg-12">
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description"  rows="3"></textarea>
  </div>
</div>


<div class="col-lg-4" id="percentageformarks">
  <label for="percentage">Percentage<span class="text-danger">&nbsp;*</span></label>
  <div class="input-group mb-3">
   <div class="input-group-prepend">
 <select id="markper" name="markper" class="form-control" data-live-search="true">
                        <option value="Increase">Increase</option>
                        <option value="Decrease">Decrease</option>
                    </select>
   
  </div>
  <input type="text" class="form-control" id="percentage" name="percentage">
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2" style="height:1.6rem">%</span>
  </div>
</div>
  </div>
<div class="col-lg-4" id="round">
  <div class="form-group">
    <label for="type">Round Off To<span class="text-danger">&nbsp;*</span></label>
	<select class="form-control fav_clr" id="roundof" name="roundof" <?=($infolayoutproducts['taxpreferencereq']=='1')?'required':''?> onclick="taxable()">  
<option value="Never Mind" >Never Mind </option>
<option value="Nearest whole number" >Nearest whole number</option>
<option value="0.99" >0.99</option>
<option value="0.50" >0.50</option>
<option value="0.49">0.49</option>
	</select>
  </div>
</div>

<div class="col-lg-12" id="customrate" onchange="rate()" style="display:none">
  <div class="form-group">
  <hr>
    <h4><b>Customize Item Rates in Bulk</b></h4>
   <p>Add custom rates for each item to be saved as a price list.</p>
    <div class="card shadow mb-4">
           
            <div class="card-body">
			
              <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					 <th>Product Detail</th>
					 <th>Standard Rate (INR)</th>
					 <th>Type</th>
					 <th>%</th>
					 <th>Custom Rate (INR)</th>
					</tr>
					</thead>
					<tbody>
					<?php 
				  $sqlselect = "SELECT stockmaincategory, stocksubcategory, stockitem, typeofproduct, componenttype, componentname, make, capacity, id, invoiced,price From  jrcproduct where price!='0' and price!='' and price IS NOT NULL order by stockitem asc";
				  
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
			<tr>
			<input type="hidden" class="form-control" name="productid[]" id="productid<?=$count?>" value="<?=$rowselect['id']?>">
			<input type="hidden" class="form-control" name="standardprice[]" id="standardprice<?=$count?>" value="<?=$rowselect['price']?>">
			<td value="<?=$rowselect['id']?>"><?=$rowselect['stockitem']?></td>
			<td><?=$rowselect['price']?></td>
			<td>
					<select id="indeper<?=$count?>" name="indeper[]" class="form-control" data-live-search="true" onchange="calc(<?=$count?>,'per')">
                        <option value="Increase">Increase</option>
                        <option value="Decrease">Decrease</option>
                    </select>
			</td>
			<td><input type="text" class="form-control" name="idpercentage[]" id="idpercentage<?=$count?>" onchange="calc(<?=$count?>,'per')"></td>
			<td><input type="text" class="form-control" name="customerate[]" id="customerate<?=$count?>" onchange="calc(<?=$count?>),'cus'"></td>
			</tr>
			
			<?php 
					$count++;
			}
		}
			?>
					</tbody>
					</table>
					</div>
					</div>
					</div>
   <?php
  
				?>
	</select>
  </div>
</div>

  </div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
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
  <!--script src="../../1637028036/js/datatables.js"></script-->
  <script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
     $( "#callnature" ).autocomplete({
       source: 'markaddedits.php?type=callnature',
     });
	 $( "#designation" ).autocomplete({
       source: 'markaddedits.php?type=designation',
     });
	 $( "#callnature" ).autocomplete({
       source: 'markaddedits.php?type=callnature',
     });
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
<script>
function rate()
{
var ratemark=document.getElementById('ratemark');
var rateeach=document.getElementById('rateeach');
var percentageformarks=document.getElementById('percentageformarks');
var round=document.getElementById('round');
var customrate=document.getElementById('customrate');
if(ratemark.checked==true)
{
	percentageformarks.style.display='block';
	round.style.display='block';
	customrate.style.display='none';
	
}
else
{
	
	customrate.style.display='block';
	percentageformarks.style.display='none';
	percentageformarks.style.display='none';
	round.style.display='none';
	percentage.value=' ';
}
}
</script>
<script>
$('#dataTable').dataTable({
    paging: false
});
</script>
<script>
function calc(id, type)
{
	var standardprice=$("#standardprice"+id).val();
	var indeper=$("#indeper"+id).val();
	var idpercentage=$("#idpercentage"+id).val();
	var customerate=$("#customerate"+id).val();
	if(type=='per')
	{
		if(idpercentage!='')
		{
			if(indeper=='Increase')
			{
				$("#customerate"+id).val(parseFloat(standardprice)+((parseFloat(idpercentage)*parseFloat(standardprice))/100));
			}
			else
			{
				$("#customerate"+id).val(parseFloat(standardprice)-((parseFloat(idpercentage)*parseFloat(standardprice))/100));
			}	
		}	
	}
	else
	{
		if(customerate!='')
		{
			$("#indeper"+id).val('Increase');
			$("#idpercentage"+id).val('');
		}
	}
}
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
