<?php 
include('lcheck.php'); 

if(isset($_POST['submit']))
{
	$gstreg=mysqli_real_escape_string($connection, $_POST['gstreg']);
	$gstin=mysqli_real_escape_string($connection, $_POST['gstin']);
	$legalname=mysqli_real_escape_string($connection, $_POST['legalname']);
	$tradename=mysqli_real_escape_string($connection, $_POST['tradename']);
	$gstregon=mysqli_real_escape_string($connection, $_POST['gstregon']);
	$comscheme=mysqli_real_escape_string($connection, $_POST['comscheme']);
	$comschemeval=mysqli_real_escape_string($connection, $_POST['comschemeval']);
	$revcharge=mysqli_real_escape_string($connection, $_POST['revcharge']);
	$msg = "";
  $msg_class = "";
 	 
$sqlcon = "SELECT id, gstin From jrcgstsettings";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
 
if(!$querycon)
{
die("SQL query failed: " . mysqli_error($connection));
}
         
         if($rowCountcon == 0) 
		{	
			 
			$sqlup = "INSERT INTO jrcgstsettings( gstreg, gstin, legalname, tradename, gstregon, comscheme, comschemeval, revcharge) VALUES ( '$gstreg', '$gstin', '$legalname', '$tradename', '$gstregon', '$comscheme', '$comschemeval', '$revcharge')";
			$queryup = mysqli_query($connection, $sqlup);
      
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A GST Information', '{$tid}')");
				//header("Location: companysettings.php?remarks=Added Successfully");
			} 
	    }
		else
		{
		$infos=mysqli_fetch_array($querycon);
		$sqlup = "update jrcgstsettings set gstreg='$gstreg', gstin='$gstin', legalname='$legalname', tradename='$tradename', gstregon='$gstregon', comscheme='$comscheme', comschemeval='$comschemeval', revcharge='$revcharge'";
		
		$queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A GST Information', '{$tid}')");
				header("Location: gstsettings.php?remarks=Updated Successfully");
			} 
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - GST Settings</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
#signDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
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

<body id="page-top" onload="gstregyes(); gstscheme">

  
  <div id="wrapper">

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>
          <?php  include('mastersnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<!--<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">GST Settings</h1>
          </div>-->
		  
		    <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" ><b>GST Settings</b></h1>
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
<div class="card-body">
<?php 
$sqlselect = "SELECT * From jrcgstsettings order by id asc";  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		$rowselect = mysqli_fetch_array($queryselect);
		
			?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
	<div class="col-lg-4">
	  <div class="form-group">
	  <label for="gstreg" > Is your business registered for GST?</label ><br>
	  </div>
	</div>
	<div class="col-lg-4">
	  <div class="form-group">
	<label class="mr-2"><input type="radio" name="gstreg" id="gstreg" value="1" <?=($rowselect['gstreg']=='1')?"checked":""?> onclick="gstregyes()"> Yes </label>
	<label class="mr-2"><input type="radio" name="gstreg" id="gstreg" value="0" <?=($rowselect['gstreg']=='0')?"checked":""?> onclick="gstregyes()" > No </label>
	  </div>
	</div>
  </div>
  
  
  <div id="gst" style="display:none" onchange="gstregyes()">
  <div class="row">
	<div class="col-lg-6">
	  <div class="form-group" id="gstin">
		<label for="gstin">GSTIN</label>
		<input type="text" class="form-control" id="gstin" name="gstin" maxlength="15"  value="<?=$rowselect['gstin']?>">
	  </div>
	</div>
	<div class="col-lg-6">
	  <div class="form-group" id="legalname">
		<label for="legalname">Business Legal Name</label>
		<input type="text" class="form-control" id="legalname" name="legalname" value="<?=$rowselect['legalname']?>">
	  </div>
	</div>
	<div class="col-lg-6">
	  <div class="form-group" id="tradename">
		<label for="tradename">Business Trade Name</label>
		<input type="text" class="form-control" id="tradename" name="tradename" value="<?=$rowselect['tradename']?>">
	  </div>
	</div>
	
	<div class="col-lg-6">
	  <div class="form-group" id="gstregon">
		<label for="gstregon">GST Registered On</label>
		<input type="date" class="form-control" id="gstregon" name="gstregon" value="<?=$rowselect['gstregon']?>" >
	  </div>
	</div>
	<div class="col-lg-6">
	  <div class="form-group" id="comschemeval1">
		<label for="comschemeval">Composition Scheme</label>
		<label class="mr-2"><input type="checkbox" id="comschemeval" name="comschemeval" value="My Business is Registered for Composition Scheme" <?=($rowselect['comschemeval']=='My Business is Registered for Composition Scheme')?"checked":""?>  onchange="gstscheme()"> My Business is Registered for Composition Scheme</label>
		
		<div id="composition" style="display:none" onchange="gstscheme()">
		<label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="1% (For Traders and Manufacturers)" <?=($rowselect['comscheme']=='1% (For Traders and Manufacturers)')?"checked":""?>> 1% (For Traders and Manufacturers)</label><br>
		<label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="2% (For Manufacturers - GSTN has lowered the rate for manufacturers to 1%)" <?=($rowselect['comscheme']=='2% (For Manufacturers - GSTN has lowered the rate for manufacturers to 1%)')?"checked":""?>> 2% (For Manufacturers - GSTN has lowered the rate for manufacturers to 1%)</label><br>
	    <label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="5% (For Restaurant sector)" <?=($rowselect['comscheme']=='5% (For Restaurant sector)')?"checked":""?>> 5% (For Restaurant sector)</label><br>
	    <label class="mr-2"><input type="radio" id="comscheme" name="comscheme" value="6% (For Suppliers of Services or Mixed Suppliers)" <?=($rowselect['comscheme']=='6% (For Suppliers of Services or Mixed Suppliers)')?"checked":""?>> 6% (For Suppliers of Services or Mixed Suppliers)</label>
	  </div>
	  </div>
		</div>
     <div class="col-lg-6">
	  <div class="form-group" id="revcharge">
		<label for="revcharge">Reverse Charge</label>
		<input type="checkbox" name="revcharge" id="revcharge" value="Enable Reverse Charge in Sales Transactions" <?=($rowselect['revcharge']=='Enable Reverse Charge in Sales Transactions')?"checked":""?>> Enable Reverse Charge in Sales Transactions
	  </div>
	</div>
  </div>
  </div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

            </div>
          </div>

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
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
     $( "#companyname" ).autocomplete({
       source: 'engineersearch.php?type=companyname',
     });
	 $( "#designation" ).autocomplete({
       source: 'engineersearch.php?type=designation',
     });
	 $( "#username" ).autocomplete({
       source: 'engineersearch.php?type=username',
     });
  });
</script>
<script>
function gstregyes()
		{
			var gstreg=document.getElementById("gstreg");
			var gst=document.getElementById("gst");

			if(gstreg.checked==true)
			{
				gst.style.display="block";
			}
			else
			{
				gst.style.display="none";
			}
			gstscheme();
		}
		</script>
		<script>
function gstscheme()
		{
			var comschemeval=document.getElementById("comschemeval");
			var composition=document.getElementById("composition");

			if(comschemeval.checked==true)
			{
				composition.style.display="block";
			}
			else
			{
				composition.style.display="none";
			}
		}
		</script>
		<?php include('additionaljs.php');   ?>
</body>

</html>
