<?php 
include('lcheck.php');
if($calladd=='0')
{
	header("location: dashboard.php");
}
if(isset($_POST['submit']))
{$id=mysqli_real_escape_string($connection, $_POST['id']);
	$readycompstatus=mysqli_real_escape_string($connection, $_POST['readycompstatus']);
	$readyremarks=mysqli_real_escape_string($connection, $_POST['readyremarks']);
	$readydate=mysqli_real_escape_string($connection, $_POST['readydate']);

 
	$sqlis=mysqli_query($connection, "select id from jrccalls where id='$id'");
	if(mysqli_num_rows($sqlis)>0)
	{
		
	
		 $sqlise=mysqli_query($connection, "update jrccalls set  readycompstatus='$readycompstatus',readyremarks ='$readyremarks ',readydate='$readydate',compstatus='1',changeon='$readydate' where id='$id'");
	
		if($sqlise)
		{
			
			
		header("Location: inhousecalls.php?remarks=Updated Successfully");
		}
		else
		{
			header("Location: inhousecalls.php?error=".mysqli_error($connection));
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
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?=$_SESSION['companyname']?> - Jerobyte - OEM Product Movements</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
   <style>
		
.collapsible {
  background-color: #3d8eb9 !important;
  color: white;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.collapsible1 {
  background-color: #3d8eb9 !important;
  color: white;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.active, .collapsible:hover {
  background-color: #fff;
}

.content {
  padding: 10px;
  display: none;
  overflow: hidden;
  background-color: #fff;
}

		</style>
</head>
<body id="page-top" >
  <div id="wrapper">
    <?php  include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php  include('navbar.php');?>
          <?php  include('inhousenavbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">OEM Product Movements</h1>
            <a href="inhousecalls.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Carry-In Calls</a>
          </div>

<?php 
$id='';
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlcalls = "SELECT id,sourceid,callon,calltid,acknowlodge,callhandlingid,callhandlingname,coordinatorid,coordinatorname,engineertype,engineersid,engineersname,reportingengineerid,engineerid,engineername,compstatus,businesstype,servicetype,customernature,callnature,serial,diagnosisby,diagnosisengineername,diagnosiscoordinatorname,diagnosisremarks,diagnosismaterial,reportedproblem,problemobserved,actiontaken,narration,detailsid,otherremarks,dcno,suppliername,dcdate,supwarrantytype,supcomplaintno,supcomplaintremarks,supapprovalstatus,supestimatedcost,supestdelivery,supcompstatus,changeon,supcourierdate,supcourierpaytype,supcouriercharges,supcourierdetails,supcourierimg,taxablevalue,supcustomerremarks,suprcourierdate,suprcourierpaytype,suprcourierdetails,suprcourierimg,suprcouriercharges,suptype,suprtype,readycompstatus,readyremarks,readydate  From jrccalls where id='".$id."'";
}
if($id!='') 
{
        $querycalls = mysqli_query($connection, $sqlcalls);
        $rowCountcalls = mysqli_num_rows($querycalls);
        if(!$querycalls){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcalls > 0) 
		{
			
			?>

		<div class="row">
			<div class="col-lg-12">

			<div id="call" class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>Call Details</h5>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">

			<div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID and Date</th>
                      <th>Call Details</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Diagnosis Details</th>
					  <th>Problem Details</th>
					  <th>Warehouse product Repair Status</th>
					  <th>Status</th>
					</tr>
                  </thead>
                  <tbody>
				  <?php 
		$sqlselect = "SELECT id,sourceid,callon,calltid,acknowlodge,callhandlingid,callhandlingname,coordinatorid,coordinatorname,engineertype,engineersid,engineersname,reportingengineerid,engineerid,engineername,compstatus,businesstype,servicetype,customernature,callnature,serial,diagnosisby,diagnosisengineername,diagnosiscoordinatorname,diagnosisremarks,diagnosismaterial,diagnosissignmode,reportedproblem,problemobserved,actiontaken,narration,detailsid,otherremarks,dcno,suppliername,dcdate,supwarrantytype,supcomplaintno,supcomplaintremarks,supapprovalstatus,supestimatedcost,supestdelivery,supcompstatus,changeon,supcourierdate,supcourierpaytype,supoemestimatedcost,supoemestdelivery,supoemremarks,supcouriercharges,supcourierdetails,supcourierimg,taxablevalue,supcustomerremarks,suprcourierdetails,suprcourierimg,revserialnumber,suprcourierdate,suprcourierpaytype,godownname,consigneeid,suptype,suprtype,suprcouriercharges,	readycompstatus,readyremarks,readydate   From jrccalls where id='$id' order by id desc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0)  
		{
			$count=1;
			$rowselect = mysqli_fetch_array($queryselect);
			
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
                      <td> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowselect['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
                      <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php  echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
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
					  
					  <td> 
					  C/H: <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
					  C/O: <a href="coordinatorview.php?id=<?=$rowselect['coordinatorid']?>"><?=$rowselect['coordinatorname']?></a><br>
					Received Mode: <?=$rowselect['coordinatorname']?><br>
					  <?php
					  if($rowselect['engineertype']=='1')
					  {
						  $engnsid=explode(',',$rowselect['engineersid']);
						  $engnsname=explode(',',$rowselect['engineersname']);
						  for($eise=0; $eise<count($engnsid);$eise++)
						  {
							  ?>
							E-<?=($eise+1)?>: <a href="mapengineerview.php?id=<?=$engnsid[$eise]?>&attdate=<?=date('Y-m-d')?>"><?=$engnsname[$eise]?> <?=($rowselect['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
							<?php
						  }
						
					  }
					  else
					  {
						?>
						E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
						  <?php
					  }
					  ?>
					  <?php 
            if($rowselect['businesstype']!='')
            {
                ?>
                <span class="btn btn-sm btn-success"><?=$rowselect['businesstype']?></span><br>
                <?php						  
            } 
            if($rowselect['servicetype']!='')
            {
                ?>
                <span class="btn btn-sm btn-danger"><?=$rowselect['servicetype']?></span><br>
                <?php						  
            } 
					  if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
						   <?php 						  
					 }
					 if($rowselect['callnature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-primary"><?=$rowselect['callnature']?></span><br>
						   <?php 						  
					 }
					  if($rowselect['compstatus']!='2')
					  {
						 if($callchange=='1')
						{  
					  ?>
					  <a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-warning">Change Details</a>
					 <?php 
						}
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
         <?php
		 if($rowselect['readycompstatus']!='')
				 {	
		 ?>
                <b>Complaint Status:</b> <span class="text-primary"><?=$rowselect['readycompstatus']?></span><br>
                <b>Remarks:</b> <span class="text-primary"><?=$rowselect['readyremarks']?></span><br>
				<?php if($rowselect['compstatus']!='2'){
					?>
                <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Received" class="text-success">View or Update Details</a>
				<?php
				}
				 }
				 else
				 { if($rowselect['compstatus']!='2'){
					 ?>
					   <a href="oemprocess.php?id=<?=$rowselect['id']?>&active=Received" class="text-danger">Product Repair Detail</a>
					   <?php
				 }
				 }
				 ?>
              					  
					</td>
					 

					  <td>


					  <?php 
					  if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php  						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span>on <?=date('d/m/Y', strtotime($rowselect['changeon']))?>
						<?php 
						
					  }
					  else if($rowselect['compstatus']=='3')
					  {
						?>
						<span class="text-info">Cancelled </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php 
						
					  }
					  else
					 {
						?>
						<span class="text-warning">Open</span>
						<?php 						
					  }
					  ?>
					  </td>
                    </tr>
					<?php 
					$count++;
	
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
<!--collapse-->
<div  class="card card-profile shadow">
 <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>Warehouse Product Repair Status</h5>
              </div>
            </div>
<div class="card-body pt-0 pt-md-4">

<form onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?=$id?>">
<input type="hidden" name="callonvalue" id="callonvalue" value="<?=$rowselect['callon']?>">
<input type="hidden" name="callid" id="callid" value="<?=$rowselect['calltid']?>">
<input type="hidden" name="godownname" id="godownname" value="<?=$rowselect['godownname']?>">
<input type="hidden" name="consigneeidvalue" id="consigneeidvalue" value="<?=$rowselect['consigneeid']?>">
<input type="hidden" name="sourceidvalue" id="sourceidvalue" value="<?=$rowselect['sourceid']?>">
<!--start accordion -->
<div id="accordion">

<div class="card" style="width:100%">
    <div class="card-header" id="headingFive" style="padding: .1rem 2rem;">
      <h5 class="mb-0">
        <a class="btn btn-link collapsed text-primary" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
      <b>Product Repair Status</b>
        </a>
      </h5>
    </div>
    <div id="collapseFive" class="collapse <?=($_GET['active']=='Received')?'show':''?>" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
	<div class="row" id="oemestimatecost">
<div class="col-lg-3">
  <div class="form-group">
    <label for="readydate">Date</label>
    <input type="date" class="form-control" id="readydate" name="readydate"  value="<?=($rowselect['readydate']!='')?$rowselect['readydate']:date('Y-m-d')?>">
  </div>
</div>



<div class="col-lg-3">
  <div class="form-group">
    <label for="readyremarks">Remarks</label>
    <textarea class="form-control" id="readyremarks" name="readyremarks"><?=$rowselect['readyremarks']?></textarea>
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="readycompstatus">Product Service Status</label>
	<select class="form-control" id="readycompstatus" name="readycompstatus" ">
	<option value="">Select</option>	
	<option value="Completed" <?=($rowselect['readycompstatus']=="Completed")?'selected':''?>>Completed</option>
	<option value="Non Repairable" <?=($rowselect['readycompstatus']=="Non Repairable")?'selected':''?>>Non Repairable</option>
	
	</select>
  </div>
</div>


  </div>
  </div>
    </div>
  </div>     

</div>

<!--end accordion -->
<br>
&nbsp;<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

</div>
<?php
		}
		}
		?>



<!--collapse-->
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
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
	
<script>
    function image(thisImg) {
        // var img = document.createElement("IMG");
        // img.src = thisImg;
        // img.className="img-fluid";
        // document.getElementById('showData').appendChild(img);
        var count = $('.imgcontainer .imgcontent').length;
        count = Number(count) + 1;
        $('.imgcontainer').append("<div class='imgcontent' id='imgcontent_" + count + "' ><img src='" + thisImg +
            "' width='100' height='100'><span class='imgdelete' id='imgdelete_" + count + "'>Delete</span></div>");
    }
    $(document).ready(function() {
        var settings = {
            url: "imageups.php",
            method: "POST",
            allowedTypes: "jpg,png",
            fileName: "myfile",
            multiple: true,
            maxFileCount: 5,
            onSuccess: function(files, data, xhr) {
                var obj = JSON.parse(data);
                console.log(obj.imglist);
                image(obj.imglist);
                var vals = $("#supcourierimg").val();
                if (vals != '') {
                    $("#supcourierimg").val(vals + ',' + obj.imglist);
                } else {
                    $("#supcourierimg").val(obj.imglist);
                }
                $("#status").html("<font color='green'>Upload is success</font>");
            },
            onError: function(files, status, errMsg) {
                $("#status").html("<font color='red'>Upload is Failed</font>" + errMsg);
            }
        }
        $("#mulitplefileuploader").uploadFile(settings);
    });
    </script>
	<script>
    function image(thisImg) {
        // var img = document.createElement("IMG");
        // img.src = thisImg;
        // img.className="img-fluid";
        // document.getElementById('showData').appendChild(img);
        var count = $('.imgcontainer1 .imgcontent1').length;
        count = Number(count) + 1;
        $('.imgcontainer1').append("<div class='imgcontent1' id='imgcontent1_" + count + "' ><img src='" + thisImg +
            "' width='100' height='100'><span class='imgdelete1' id='imgdelete1_" + count + "'>Delete</span></div>");
    }
    $(document).ready(function() {
        var settings = {
            url: "imageups.php",
            method: "POST",
            allowedTypes: "jpg,png",
            fileName: "myfile",
            multiple: true,
            maxFileCount: 5,
            onSuccess: function(files, data, xhr) {
                var obj = JSON.parse(data);
                console.log(obj.imglist);
                image(obj.imglist);
                var vals = $("#suprcourierimg").val();
                if (vals != '') {
                    $("#suprcourierimg").val(vals + ',' + obj.imglist);
                } else {
                    $("#suprcourierimg").val(obj.imglist);
                }
                $("#status1").html("<font color='green'>Upload is success</font>");
            },
            onError: function(files, status, errMsg) {
                $("#status1").html("<font color='red'>Upload is Failed</font>" + errMsg);
            }
        }
        $("#mulitplefileuploader1").uploadFile(settings);
    });
    </script>
	<script>
    // Remove file
    $('.imgcontainer').on('click', '.imgcontent .imgdelete', function() {
        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#imgcontent_' + num + ' img').attr("src");
        var deleteFile = confirm("Do you really want to Delete?");
        if (deleteFile == true) {
            var vals = $("#supcourierimg").val();
            let newStr = vals.replace(imgElement_src + ',', '');
            newStr = newStr.replace(',' + imgElement_src, '');
            newStr = newStr.replace(imgElement_src, '');
            $("#supcourierimg").val(newStr);
            $('#imgcontent_' + num).remove();
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
    // Remove file
    $('.imgcontainer1').on('click', '.imgcontent1 .imgdelete1', function() {
        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#imgcontent1_' + num + ' img').attr("src");
        var deleteFile = confirm("Do you really want to Delete?");
        if (deleteFile == true) {
            var vals = $("#suprcourierimg").val();
            let newStr = vals.replace(imgElement_src + ',', '');
            newStr = newStr.replace(',' + imgElement_src, '');
            newStr = newStr.replace(imgElement_src, '');
            $("#suprcourierimg").val(newStr);
            $('#imgcontent1_' + num).remove();
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
	function valchange(els)
	{
		var data = $("#"+els+"id").select2('data');
		if(data) {
			if(data[0].text=='Select')
			{
				$("#"+els+'name').val('');
			}
			else
			{
				$("#"+els+'name').val(data[0].text);
			}
		}
		else
		{
			$("#"+els+'name').val('');
		}
	}
	</script>
	
	
	
	
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
	 $( "#callhandlingname" ).autocomplete({
       source: 'callsearch.php', select: function (event, ui) { $("#callhandlingname").val(ui.item.value); $("#callhandlingid").val(ui.item.id);}
     });
     $( "#coordinatorname" ).autocomplete({
       source: 'coorsearch.php', select: function (event, ui) { $("#coordinatorname").val(ui.item.value); $("#coordinatorid").val(ui.item.id);}
     });
	 $( "#engineername" ).autocomplete({
       source: 'engsearch.php', select: function (event, ui) { $("#engineername").val(ui.item.value); $("#engineerid").val(ui.item.id);}
     });
	 $( "#problemobserved" ).autocomplete({
       source: 'callssearch.php?type=problemobserved',
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
	
	function change()
{
	var supcompstatus=document.getElementById("supcompstatus").value;
	var sample=document.getElementById("sample");
	if(supcompstatus=="Replaced")
	{
		sample.style.display="block";
	}
	else
	{
		sample.style.display="none";
	}
}
function couriersent()
{
	
	var suptype=document.getElementById("suptype").value;
	var couriersent1=document.getElementById("couriersent1");
	var couriersent2=document.getElementById("couriersent2");
	var couriersent3=document.getElementById("couriersent3");
	if(suptype=="Courier")
	{ 

		couriersent1.style.display="block";
		couriersent2.style.display="block";
		couriersent3.style.display="block";
	}
	else
	{
		couriersent1.style.display="none";
		couriersent2.style.display="none";
		couriersent3.style.display="none";
		
		supcourierpaytype.value="";
		supcouriercharges.value="";
		taxablevalue.value="";
	}
}
function courierreceived()
{
	
	var suprtype=document.getElementById("suprtype").value;
	var couriershow1=document.getElementById("couriershow1");
	var couriershow2=document.getElementById("couriershow2");
	if(suprtype=="Courier")
	{ 

		couriershow1.style.display="block";
		couriershow2.style.display="block";
	}
	else
	{
		couriershow1.style.display="none";
		couriershow2.style.display="none";
		suprcourierpaytype.value="";
		suprcouriercharges.value="";
		
	}
}
</script>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<script>
var coll1 = document.getElementsByClassName("collapsible1");
var i;

for (i = 0; i < coll1.length; i++) {
  coll1[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
</body>
</html>
