<?php
include('lcheck.php'); 

if($addconsignee=='0')
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Edit Customer Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"><link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php //include('consigneenavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Edit Customer Details</h1>
            <a href="consignee.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Customer Details</a>
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
           <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Customer Details</h6>
            </div>-->
<div class="card-body">
<?php
$id=mysqli_real_escape_string($connection,$_GET['id']);
				  $sqlselect = "SELECT ctype, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, latlong, contact, phone, mobile, email, gsttype, statecode, gstno From jrcconsignee where id='".$id."' order by consigneename asc";
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
				if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowselect['address1']!='')
		{
		$rowselect['address1']=jbsdecrypt($_SESSION['encpass'], $rowselect['address1']);
		}
		if($rowselect['phone']!='')
		{
		$rowselect['phone']=jbsdecrypt($_SESSION['encpass'], $rowselect['phone']);
		}
		if($rowselect['mobile']!='')
		{
		$rowselect['mobile']=jbsdecrypt($_SESSION['encpass'], $rowselect['mobile']);
		}
		if($rowselect['email']!='')
		{
		$rowselect['email']=jbsdecrypt($_SESSION['encpass'], $rowselect['email']);
		}
	}
}
			?>
<form action="consigneeedits.php" method="post">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<div class="row">
<?php
if($infolayoutcustomers['ctype']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="ctype">Customer Type</label>
	<select class="form-control" id="ctype" name="ctype" <?=($infolayoutcustomers['ctypereq']=='1')?'required':''?> >
<option value="">Select</option>
<?php
$sqlrep = "SELECT ctype From jrcctype order by ctype desc";
				  
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
         
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountrep > 0) 
		{
			
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['ctype']?>" <?=($rowselect['ctype']==$rowrep['ctype'])?"selected":""?>><?=$rowrep['ctype']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
  <?php
}
else
{
	?>
	<input type="hidden" name="ctype" id="ctype" value="<?=$rowselect['ctype']?>">
	<?php
}
  if($infolayoutcustomers['maincategory']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="maincategory">Main Category</label>
    <input type="text" class="form-control" id="maincategory" name="maincategory" <?=($infolayoutcustomers['maincategoryreq']=='1')?'required':''?> value="<?=$rowselect['maincategory']?>">
  </div>
</div>
<?php
}
else
{
	?>
	<input type="hidden" name="maincategory" id="maincategory" value="<?=$rowselect['maincategory']?>">
	<?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="subcategory">Sub Category</label>
    <input type="text" class="form-control" id="subcategory" name="subcategory" <?=($infolayoutcustomers['subcategoryreq']=='1')?'required':''?> value="<?=$rowselect['subcategory']?>">
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="subcategory" id="subcategory" value="<?=$rowselect['subcategory']?>">
	<?php
}
if($infolayoutcustomers['consigneename']=='1')
{
?>
<div class="col-lg-12">
      <div class="form-group">
    <label for="consigneename">Customer Name</label>
    <input type="text" class="form-control" id="consigneename" name="consigneename"  <?=($infolayoutcustomers['consigneenamereq']=='1')?'required':''?> value="<?=$rowselect['consigneename']?>">
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="consigneename" id="consigneename" value="<?=$rowselect['consigneename']?>">
	<?php
}
if($infolayoutcustomers['department']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="department">Department</label>
    <input type="text" class="form-control" id="department" name="department" <?=($infolayoutcustomers['departmentreq']=='1')?'required':''?> value="<?=$rowselect['department']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="department" id="department" value="<?=$rowselect['department']?>">
	<?php
}
if($infolayoutcustomers['address1']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1" <?=($infolayoutcustomers['address1req']=='1')?'required':''?> value="<?=$rowselect['address1']?>">
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="address1" id="address1" value="" value="<?=$rowselect['address1']?>">
	<?php
}
if($infolayoutcustomers['address2']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="address2">Address 2</label>
   <input type="text" class="form-control" id="address2" name="address2" <?=($infolayoutcustomers['address2req']=='1')?'required':''?> value="<?=$rowselect['address2']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="address2" id="address2"  value="<?=$rowselect['address2']?>">
	<?php
}
if($infolayoutcustomers['area']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="area">Area</label>
    <input type="text" class="form-control" id="area" name="area" <?=($infolayoutcustomers['areareq']=='1')?'required':''?> value="<?=$rowselect['area']?>">
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="area" id="area" value="<?=$rowselect['area']?>">
	<?php
}
if($infolayoutcustomers['district']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="district">District</label>
    <input type="text" class="form-control" id="district" name="district" <?=($infolayoutcustomers['districtreq']=='1')?'required':''?> value="<?=$rowselect['district']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="district" id="district"  value="<?=$rowselect['district']?>">
	<?php
}
if($infolayoutcustomers['pincode']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="pincode">Pincode</label>
    <input type="text" class="form-control" id="pincode" name="pincode" maxlength="6"  <?=($infolayoutcustomers['pincodereq']=='1')?'required':''?> value="<?=$rowselect['pincode']?>">
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="pincode" id="pincode"  value="<?=$rowselect['pincode']?>">
	<?php
}
if($infolayoutcustomers['latlong']=='1')
{
?> 
<div class="col-lg-3">
  <div class="form-group">
    <label for="latlong">LatLong</label><a onclick="openaddress()" class="float-right text-danger">Get LatLong</a>
    <input type="text" class="form-control" id="latlong" name="latlong" <?=($infolayoutcustomers['latlongreq']=='1')?'required':''?> onKeyup="cleartext()" value="<?=$rowselect['latlong']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="latlong" id="latlong"  value="<?=$rowselect['latlong']?>">
	<?php
}
if($infolayoutcustomers['contact']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="contact">Contact Person</label>
    <input type="text" class="form-control" id="contact" name="contact" <?=($infolayoutcustomers['contactreq']=='1')?'required':''?> value="<?=$rowselect['contact']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="contact" id="contact"  value="<?=$rowselect['contact']?>">
	<?php
}
if($infolayoutcustomers['phone']=='1')
{
?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="phone">Phone No</label>
    <input type="text" class="form-control" id="phone" name="phone" maxlength="11" <?=($infolayoutcustomers['phonereq']=='1')?'required':''?> value="<?=$rowselect['phone']?>">
  </div>
  </div>
<?php
}
else
{
	?>
	<input type="hidden" name="phone" id="phone" value="<?=$rowselect['phone']?>">
	<?php
}
if($infolayoutcustomers['mobile']=='1')
{
?>
<div class="col-lg-3">
  <div class="form-group">
    <label for="mobile">Mobile No</label>
    <input type="text" class="form-control" id="mobile" name="mobile" required maxlength="10" <?=($infolayoutcustomers['mobilereq']=='1')?'required':''?> value="<?=$rowselect['mobile']?>">
  </div>
   </div>
 <?php
}
else
{
	?>
	<input type="hidden" name="mobile" id="mobile" value="<?=$rowselect['mobile']?>">
	<?php
}
if($infolayoutcustomers['email']=='1')
{
?> 
<div class="col-lg-3">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" <?=($infolayoutcustomers['emailreq']=='1')?'required':''?> value="<?=$rowselect['email']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="email" id="email" value="<?=$rowselect['email']?>">
	<?php
}
if($infolayoutcustomers['gstno']=='1')
{
?> 
<div class="col-lg-3">
    <div class="form-group">
    <label for="gsttype">GST Registration Type</label>
	<select class="form-control" id="gsttype" name="gsttype" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?> >
<option value="">Select</option>
<?php
$sqlrep = "SELECT rype From jrcregtype order by id asc";
				  
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
         
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountrep > 0) 
		{
			
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['rype']?>" <?=($rowselect['gsttype']==$rowrep['rype'])?"selected":""?>><?=$rowrep['rype']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="statecode">State Code</label>
	<select class="form-control" id="statecode" name="statecode" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?> >
<option value="">Select</option>
<?php
$sqlrep1 = "SELECT statecode From jrcplace order by id asc";
				  
        $queryrep1 = mysqli_query($connection, $sqlrep1);
        $rowCountrep1 = mysqli_num_rows($queryrep1);
         
        if(!$queryrep1){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountrep1 > 0) 
		{
			
			while($rowrep1 = mysqli_fetch_array($queryrep1)) 
			{
				?>
<option value="<?=$rowrep1['statecode']?>" <?=($rowselect['statecode']==$rowrep1['statecode'])?"selected":""?>><?=$rowrep1['statecode']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="gstno">GST No</label>
    <input type="text" class="form-control" id="gstno" name="gstno" <?=($infolayoutcustomers['gstnoreq']=='1')?'required':''?> value="<?=$rowselect['gstno']?>">
  </div>
   </div>
<?php
}
else
{
	?>
	<input type="hidden" name="gsttype" id="gsttype" value="<?=$rowselect['gsttype']?>">
	<input type="hidden" name="statecode" id="statecode" value="<?=$rowselect['statecode']?>">
	<input type="hidden" name="gstno" id="gstno" value="<?=$rowselect['gstno']?>">
	<?php
}
?>

  </div>
  
  
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
<?php
					$count++;
			}
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
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
     $( "#maincategory" ).autocomplete({
       source: 'consigneesearch.php?type=maincategory',
     });
	 $( "#subcategory" ).autocomplete({
       source: 'consigneesearch.php?type=subcategory',
     });
	 $( "#consigneename" ).autocomplete({
       source: 'consigneesearch.php?type=consigneename',
     });
	 $( "#department" ).autocomplete({
       source: 'consigneesearch.php?type=department',
     });
  });
</script>
<script>
function cleartext()
{
	var str=document.getElementById("latlong").value;
	var result = str.replace(/[^0-9\.,]/g, "");
	document.getElementById("latlong").value=result;
}
function openaddress()
{
	var address1=document.getElementById("address1").value;
	var address2=document.getElementById("address2").value;
	var area=document.getElementById("area").value;
	var district=document.getElementById("district").value;
	var pincode=document.getElementById("pincode").value;
	window.open("maplatlong.php?address="+address1+" "+address2+" "+area+" "+district+" "+pincode+" ", "_blank"); 
}
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
