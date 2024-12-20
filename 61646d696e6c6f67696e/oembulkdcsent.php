<?php
include('lcheck.php'); 


if(isset($_POST['submit']))
{
	
	$dcno=mysqli_real_escape_string($connection, $_POST['dcno']);
	$dcdate=mysqli_real_escape_string($connection, $_POST['dcdate']);
	
	
	if(isset($_POST['update']))
	{
    foreach($_POST['update'] as $updateid)
	{
	$suppliername=mysqli_real_escape_string($connection, $_POST['suppliername'.$updateid]);
	$supwarrantytype=mysqli_real_escape_string($connection, $_POST['supwarrantytype'.$updateid]);
	$supcomplaintno=mysqli_real_escape_string($connection, $_POST['supcomplaintno'.$updateid]);
	$supcomplaintremarks=mysqli_real_escape_string($connection, $_POST['supcomplaintremarks'.$updateid]);
	
	
	$sqlis=mysqli_query($connection, "select id from jrccalls where id='$id'");
	if(mysqli_num_rows($sqlis)>0)
	{
		if($dcno=='')
		{
		$querysr = mysqli_query($connection, "SELECT dcno From jrcsrno");
		$infosr=mysqli_fetch_array($querysr);
		$dcno='DN / '.date('m').date('y').' /'.(str_pad(((float)$infosr['dcno']+1),5,"0",STR_PAD_LEFT));
		$dcdate=date('Y-m-d');
		mysqli_query($connection, "update jrcsrno set dcno=dcno+1");
		}
	
	$sqlise=mysqli_query($connection, "update jrccalls set dcno='$dcno', dcdate='$dcdate', suppliername='$suppliername', supwarrantytype='$supwarrantytype', supcomplaintno='$supcomplaintno', supcomplaintremarks='$supcomplaintremarks', compstatus='1',changeon='$dcdate',supcourierdate='$dcdate' where id='$updateid'");
		if($sqlise)
		{
			
		
		header("Location: deliverynotes.php?remarks=Added Successfully");
		}
	
		else
		{
			header("Location: inhousecalls.php?error=".mysqli_error($connection));
		}
	}
	}
	}
	else
	{
		header("Location: inhousecalls.php?error=No Data Found");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
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
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$_SESSION['companyname']?> - Jerobyte - Carry-In Calls</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
        <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('inhousenavbar.php');?>
		  
		  
        

        
        <div class="container-fluid">
    <!-- Page Heading -->
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

<div class="row">
 
		  <div class="col-xl-3 col-md-6 text-primary" style="font-weight:bold">
		  <h1 class="h4 mb-2 mt-2 text-gray-800">Create DN</h1>
		</div>
		
</div>
          
<!--for head search-->
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
<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div  class="card card-profile shadow">
            <!--div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>OEM Sent Details</h5>
              </div>
            </div-->
            <div class="card-body pt-0 pt-md-4">

<form method="post" enctype="multipart/form-data" id="supplierform" onsubmit="return SubmitForm();">

<div class="row">
<div class="col-lg-3">
  <div class="form-group">
    <label for="dcno">DN No</label>
    <input type="text" class="form-control" id="dcno" name="dcno"  readonly>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="dcdate">DN Date</label>
    <input type="text" class="form-control" id="dcdate" name="dcdate"   readonly>
  </div>
</div>	

</div>


	<hr>
<div class="row">
			<div class="col-lg-12">

			<div id="call" class="card card-profile shadow">
           
            <div class="card-body pt-0 pt-md-4">

			<div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Select<input type='checkbox' id='checkAll' ></th>
					  <th>Supplier Name</th>
                      <th>Call ID and Date</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Diagnosis Details</th>
					  <th>Problem Details</th>
					  <th>Supplier Warranty Type</th>
					  <th>Complaint No</th>
					  <th>Product Remarks</th>
					</tr>
                  </thead>
                  <tbody>
				  <?php 
		 $sqlselect = "SELECT id,sourceid,callon,calltid,acknowlodge,callhandlingid,callhandlingname,coordinatorid,coordinatorname,engineertype,engineersid,engineersname,reportingengineerid,engineerid,engineername,compstatus,businesstype,servicetype,customernature,callnature,serial,diagnosisby,diagnosisengineername,diagnosiscoordinatorname,diagnosisremarks,diagnosismaterial,reportedproblem,problemobserved,actiontaken,narration,detailsid,otherremarks,dcno,suppliername,dcdate,supwarrantytype,supcomplaintno,supcomplaintremarks,supapprovalstatus,supestimatedcost,supestdelivery,supcompstatus,changeon,supcourierdate,supcourierpaytype,supcouriercharges,supcourierdetails,supcourierimg,taxablevalue From jrccalls where  ((dcno IS NULL) or dcno='') and compstatus='0' and servicetype='Carry-In' order by suppliername desc";
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
			        
			//for input fields	 
		 $id = $rowselect['id'];
         $supcomplaintremarks = $rowselect['supcomplaintremarks'];
         $supcomplaintno = $rowselect['supcomplaintno'];
         $supwarrantytype = $rowselect['supwarrantytype'];
        
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				$rowxl = mysqli_fetch_array($queryxl);
				
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				 $sqlcons = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
				  
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
						$rowcons['address1']=jbsdecrypt($_SESSION['encpass'], $rowcons['address1']);
						}
						if($rowcons['phone']!='')
						{
						$rowcons['phone']=jbsdecrypt($_SESSION['encpass'], $rowcons['phone']);
						}
						if($rowcons['mobile']!='')
						{
						$rowcons['mobile']=jbsdecrypt($_SESSION['encpass'], $rowcons['mobile']);
						}
						if($rowcons['email']!='')
						{
						$rowcons['email']=jbsdecrypt($_SESSION['encpass'], $rowcons['email']);
						}
					}
				}
						?>
                    <tr>
					<td><input type='checkbox' id='update' name='update[]' value='<?=$id?>' ></td>
					<td>
					<div class="row">
					<div class="col-lg-12">

  <div class="form-group">
    
<select class="form-control fav_clr" id="suppliername<?=$id?>" name="suppliername<?=$id?>">
<option value="">Select</option>
<?php 
$sqlrep = "SELECT id,suppliername From jrcsuppliers order by suppliername asc";
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
<option value="<?=$rowrep['id']?>" <?=($rowselect['suppliername']==$rowrep['id'])?'selected':''?>><?=$rowrep['suppliername']?></option>
<?php 
			}
		}
		?>
</select>

  </div>
</div></td>
</div></td>
                     
                    <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?=$rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
					  <br>
					  <?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?>
					  <br><?php 
					  if($rowselect['acknowlodge']=='1')
					  {
						  ?>
						  <span class="badge badge-primary">Approved</span>
						  <?php 
					  }
					  else
					  {
						  ?>
						  <span class="badge badge-default shadow">Wait for Appr.</span>
						  <?php 
					  }
					  ?>
					  </td>
					  
					 
					   <?php 
					  if($rowxl['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>"><?=$rowxl['consigneename']?></a><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></td>
					  <?php 
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>">View</a></td>
					  <?php 
					  }
					  ?>
					  <td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span><br><b>Serial:</b> <?=$rowselect['serial']?></td>
					  
					 <td>
						 <b>Diagnosis By:</b> <span class="text-primary"><?=($rowselect['diagnosisby']=='engineer')?$rowselect['diagnosisengineername']:$rowselect['diagnosiscoordinatorname']?></span><br>
						 <b>Remarks:</b> <span class="text-primary"><?=$rowselect['diagnosisremarks']?></span><br>
						 <b>Other Materials:</b> <span class="text-primary"><?=$rowselect['diagnosismaterial']?></span><br>

					</td>
					
					  <td><b>Reported:</b> <span class="text-primary"><?=$rowselect['reportedproblem']?></span><br>
					  <b>Observed:</b> <span class="text-primary"><?=$rowselect['problemobserved']?></span><br>
					  <b>Action:</b> <span class="text-primary"><?=$rowselect['actiontaken']?></span><br>
					  <b>Narration:</b> <span class="text-primary"><?=$rowselect['narration']?></span>
					  <?php
					  if($rowselect['businesstype']=='COPIER')
					 {
						 $totalmeterreading="";
						 if($rowselect['detailsid']!='')
						 {
							 $sqlise=mysqli_query($connection, "select totalmeterreading from jrccalldetails where id='".$rowselect['detailsid']."'");
							 $infose=mysqli_fetch_array($sqlise);
							 $totalmeterreading=$infose['totalmeterreading'];
						 }
						 else
						 {
							$totalmeterreading=$rowselect['otherremarks'];
						 }
						 ?>
						 <br>
						 <b>Last Meter Reading:</b> <span class="text-primary"><?=$totalmeterreading?></span>
						 <?php
					 }
					 ?>
					  </td>
					  
					  <td>
						<select class="form-control" id="supwarrantytype" name="supwarrantytype<?=$id?>" width='100%'>
						<option value="">Select</option>	
						<option value="Warranty" <?=($rowselect['supwarrantytype']=="Warranty")?'selected':''?>>Warranty</option>
						<option value="Out of Warranty" <?=($rowselect['supwarrantytype']=="Out of Warranty")?'selected':''?>>Out of Warranty</option>
						</select>
					</td>
					<td>
						<input type='text' name='supcomplaintno<?=$id?>' value='<?=$rowselect['supcomplaintno']?>' height="50%">
					</td>
					<td>
						<input type='text' name='supcomplaintremarks<?=$id?>' value='<?=$rowselect['supcomplaintremarks']?>' height="50%">	  
					</td>


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
	</div>
	</div>

	<br>
	<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>




	</div>
	</div>
	</div>
	</div>

<?php

?>

        </div>
         

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
                <h5 class="modal-title">In-House Calls</h5>
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



 

  <!-- Page level custom scripts -->
 
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>



<!-- Start Script for bulk select -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="update[]"]').prop('checked',true);
    }else{
      $('input[name="update[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="update[]"]').click(function(){
    var total_checkboxes = $('input[name="update[]"]').length;
var total_checkboxes_checked = $('input[name="update[]"]:checked').length;
    if(total_checkboxes_checked == total_checkboxes){

       $('#checkAll').prop('checked',true);
	   
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>
<script>
function SubmitForm()
    {
		var j=0;
        var update=document.getElementsByName("update[]");
		for(var i=0;i<update.length;i++)
		{
			if(update[i].checked==true)
			{
				var id=update[i].value;
				var suppliername=document.getElementById("suppliername"+id);
				if(suppliername.value=='')
				{
					alert("Please Select Supplier");
					return false;
				}
			j++;
			}
		}
		if(j==0)
		{
			alert("Please Select Any Call");
			return false;
		}

    }	
</script>

<!--  End Script for bulk select -->
<?php include('additionaljs.php');   ?>
</body>

</html>
