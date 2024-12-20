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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Merge Product Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
<style>
#overlay{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  background:rgba(0,0,0,0.1);
  transition: 1s 0.4s;
}
#progress{
  height:1px;
  background:#fff;
  position:absolute;
  width:0;
  top:50%;
}
#progstat{
  font-size:1.7em;
  letter-spacing: 3px;
  position:absolute;
  top:50%;
  margin-top:-40px;
  width:100%;
  text-align:center;
  color:#ff0000;
}
</style>
</head>

<body id="page-top">
 <div id="overlay">
    <div id="progstat">Loading...</div>
    <div id="progress"></div>
  </div>
  
  <div id="wrapper">

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>
          <?php  //include('productnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<!--<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Merge Product Details</h1>
            <a href="productadd.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Product</a>
          </div>-->
		  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" ><b>Merge Product Details</b></h1>
  </div>
<div class="col-auto" style=" text-align: right;">
    <a href="productadd.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Product</a>
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
<?php 
	$sqlselect = "SELECT * From jrcxl order by id desc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			while( $row = mysqli_fetch_assoc( $queryselect)){
    $new_array[] = $row; // Inside while loop
}}
	?>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Merge Product Details</h6>
            </div>-->
			
            <div class="card-body">
			<form action="" method="post">
<div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label for="stockmaincategory">Stock Main Category </label>
	<select class="fav_clr form-control" name="stockmaincategory[]" id="stockmaincategory" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stockmaincategory']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['stockmaincategory']))&&(in_array($urep, $_POST['stockmaincategory'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="stocksubcategory">Stock Sub Category </label>
	<select class="fav_clr form-control" name="stocksubcategory[]" id="stocksubcategory" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stocksubcategory']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['stocksubcategory']))&&(in_array($urep, $_POST['stocksubcategory'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="stockitem">Product Name </label>
	<select class="fav_clr form-control" name="stockitem[]" id="stockitem" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['stockitem']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['stockitem']))&&(in_array($urep, $_POST['stockitem'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="typeofproduct">Product Type </label>
	<select class="fav_clr form-control" name="typeofproduct[]" id="typeofproduct" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['typeofproduct']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['typeofproduct']))&&(in_array($urep, $_POST['typeofproduct'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="componenttype">Component Type</label>
	<select class="fav_clr form-control" name="componenttype[]" id="componenttype" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['componenttype']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['componenttype']))&&(in_array($urep, $_POST['componenttype'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>


<div class="col-lg-3">
  <div class="form-group">
    <label for="componentname">Component Name</label>
	<select class="fav_clr form-control" name="componentname[]" id="componentname" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['componentname']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['componentname']))&&(in_array($urep, $_POST['componentname'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="make">Make </label>
	<select class="fav_clr form-control" name="make[]" id="make" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['make']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['make']))&&(in_array($urep, $_POST['make'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="capacity">Capacity </label>
	<select class="fav_clr form-control" name="capacity[]" id="capacity" multiple="multiple">
	<?php 
	if((isset($new_array))&&(is_array($new_array)))
	{
		
	$uniquereportedproblem = array_unique(array_map(function ($i) { return $i['capacity']; }, $new_array));
	sort($uniquereportedproblem);
			foreach($uniquereportedproblem as $urep) 
			{
				?>
				<option value="<?=$urep?>" <?=((isset($_POST['capacity']))&&(in_array($urep, $_POST['capacity'])))?'selected':''?>><?=$urep?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
</div>

  </div>

  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
</div>
</div>
  
			<?php 
if(isset($_POST['submit']))
{
	
$staqu="";
			
			if(isset($_POST['stockmaincategory']))
			{
				$subquer="";
				foreach($_POST['stockmaincategory'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="stockmaincategory='".$repp."'";
					}
					else
						{
						$subquer.=" or stockmaincategory='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['stocksubcategory']))
			{
				$subquer="";
				foreach($_POST['stocksubcategory'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="stocksubcategory='".$repp."'";
					}
					else
						{
						$subquer.=" or stocksubcategory='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			
			if(isset($_POST['componenttype']))
			{
				$subquer="";
				foreach($_POST['componenttype'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="componenttype='".$repp."'";
					}
					else
						{
						$subquer.=" or componenttype='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			
			if(isset($_POST['componentname']))
			{
				$subquer="";
				foreach($_POST['componentname'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="componentname='".$repp."'";
					}
					else
						{
						$subquer.=" or componentname='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			
			if(isset($_POST['stockitem']))
			{
				$subquer="";
				foreach($_POST['stockitem'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="stockitem='".$repp."'";
					}
					else
						{
						$subquer.=" or stockitem='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
if(isset($_POST['typeofproduct']))
			{
				$subquer="";
				foreach($_POST['typeofproduct'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="typeofproduct='".$repp."'";
					}
					else
						{
						$subquer.=" or typeofproduct='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['make']))
			{
				$subquer="";
				foreach($_POST['make'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="make='".$repp."'";
					}
					else
						{
						$subquer.=" or make='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
			if(isset($_POST['capacity']))
			{
				$subquer="";
				foreach($_POST['capacity'] as $repp)
				{
					if($subquer=="")
					{
						$subquer.="capacity='".$repp."'";
					}
					else
						{
						$subquer.=" or capacity='".$repp."'";
					}
				}
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" where (".$subquer.")";
					}
				}
			}
		
?>	
<div class="card shadow mb-4">
            <div class="card-body">
<form action="productmerges.php" method="post" onsubmit="return checkvalidate()">
              <div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Main Category</th>
					  <th>Sub Category</th>
                      <th>Product Name</th>
					  <th>Product Type</th>
                      <th>Component Type</th>
					  <th>Component Name</th>
					  <th>Make</th>
					  <th>Capacity</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
				  $sqlselect = "SELECT productid, stockmaincategory, stocksubcategory, stockitem, typeofproduct, componenttype, componentname, make, capacity From jrcxl ".$staqu." group by productid order by stockitem asc";
				  
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
                      <td><?=$count?> <input type="checkbox" name="ids[]" value="<?=$rowselect['productid']?>"></td>
                      <td><?=$rowselect['stockmaincategory']?></td>
					  <td><?=$rowselect['stocksubcategory']?></td>					  
                      <td><?=$rowselect['stockitem']?></td>
					  <td><?=$rowselect['typeofproduct']?></td>
					  <td><?=$rowselect['componenttype']?> </td>
					  <td><?=$rowselect['componentname']?></td>
					  <td><?=$rowselect['make']?></td>
					  <td><?=$rowselect['capacity']?></td>
					  
                    </tr>
					<?php 
					$count++;
			}
			?>
			<tr>
			<td colspan="9">
  <div class="form-group">
    <label for="mobile">New Product </label>
	<select class="fav_clr form-control" name="changeid" id="changeid">
	<?php 
		$sqlselect = "SELECT id, stockitem, stockmaincategory, stocksubcategory, typeofproduct, componenttype, make, capacity From jrcproduct ".$staqu." order by stockitem asc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($val = mysqli_fetch_array($queryselect)) 
			{
			?>
			<option value="<?=$val['id']?>" ><?=$val['stockitem']?> | <?=$val['stockmaincategory']?> | <?=$val['stocksubcategory']?> | <?=$val['typeofproduct']?> | <?=$val['componenttype']?> | <?=$val['make']?> | <?=$val['capacity']?></option>
				<?php 
			}
	}
	?>
	</select>
  </div>
			</td>
			</tr>
			<tr>
			<td colspan="9" style="text-align:center"><input type="submit" name="submit" class="btn btn-success" value="Submit"></td>
			</tr>
			<?php 
		}
			?>
					
                  </tbody>
                </table>
              </div>
			  </form>
			  </div>
         
 </div>
           
<?php 
}
?>
        
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
  });
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
;(function(){
  function id(v){return document.getElementById(v); }
  function loadbar() {
    var ovrl = id("overlay"),
        prog = id("progress"),
        stat = id("progstat"),
        img = document.images,
        c = 0;
        tot = img.length;

    function imgLoaded(){
      c += 1;
      var perc = ((100/tot*c) << 0) +"%";
      prog.style.width = perc;
      stat.innerHTML = "Loading "+ perc;
      if(c===tot) return doneLoading();
    }
    function doneLoading(){
      ovrl.style.opacity = 0;
      setTimeout(function(){ 
        ovrl.style.display = "none";
      }, 1200);
    }
    for(var i=0; i<tot; i++) {
      var tImg     = new Image();
      tImg.onload  = imgLoaded;
      tImg.onerror = imgLoaded;
      tImg.src     = img[i].src;
    }    
  }
  document.addEventListener('DOMContentLoaded', loadbar, false);
}());
</script>
<script>
function checkvalidate()
{
	var ids=document.getElementsByName("ids[]");
	var j=0;
	for(var i=0;i<ids.length;i++)
	{
		if(ids[i].checked==true)
		{
			j++;
		}
	}
	if(j==0)
	{
		alert("Please Select any product to Merge");
		return false;
	}
	else
	{
		return confirm("Are you sure want to change this product?");
	}
}
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>