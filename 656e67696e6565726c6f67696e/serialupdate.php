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
  <title><?=$_SESSION['companyname']?> - Jerobyte - Serial Update</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<style>
.imgcontainer, .imgcontainer2, .imgsealcontainer{
	height:auto;
 text-align:center;
}
.imgcontent, .imgsealcontent{
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
.imgsealcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgsealcontent span:hover{
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
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Serial Update</h1>
          </div>
          <div class="row">
 <div class="col-lg-12">
 <?php
 if(isset($_GET['remarks']))
 {
	 ?>
	 <div class="alert alert-success"><?=$_GET['remarks']?></div>
	 <?php
 }
?> 
 <div class="row" id="myItems">
 <?php
 if(isset($_GET['id']))
 {
	$calltid=mysqli_real_escape_string($connection,$_GET['id']);
	$_SESSION['calltid']=$calltid;
	$sqlselect = "SELECT * From jrccalls where (engineerid='".$id."' or find_in_set('".$id."', engineersid)) and calltid='".$calltid."' order by id desc";
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
				$sqlxl = "SELECT * From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
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
					  ?>
		<div class="col-lg-6 mb-4 items">
                                    <div class="card shadow">
									<div class="card-header <?=$bg?> text-white ">
									<?=$rowselect['calltid']?> - <?=$bgtext?>
									</div>
                                        <div class="card-body">
                                            <h5>Serial Update:</h5> 
											<p><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?><br>
											C/H: <?=$rowselect['callhandlingname']?><br>
											C/O: <?=$rowselect['coordinatorname']?><br>
											Call From: <a href="tel:<?=$rowselect['callfrom']?>"><?=$rowselect['callfrom']?></a><br>
											Customer Nature: <?php
					  if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
						   <?php						  
					 }
					 ?>
Business Type: <?php
if($rowselect['businesstype']!='')
{
		?>
	  <span class="btn btn-sm btn-success"><?=$rowselect['businesstype']?></span><br>
	  <?php						  
} 
?>
Service Type: <?php
if($rowselect['servicetype']!='')
{
		?>
	  <span class="btn btn-sm btn-danger"><?=$rowselect['servicetype']?></span><br>
	  <?php						  
} 
?>


					 Call Nature: <?php
					 if($rowselect['callnature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-primary"><?=$rowselect['callnature']?></span><br>
						   <?php						  
					 }
					  ?>
											</p>
											<hr>
											<h5>Customer Details:</h5>
											<p><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
										
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
												?><br><b><?=$rowselect['serial']?></b></p>
											<hr>
											<h5>Problem Details:</h5>
											<p>Reported: <?=$rowselect['reportedproblem']?> <?=($rowselect['otherremarks']!='')?'('.$rowselect['otherremarks'].')':''?><br>
					  Observed: <?=$rowselect['problemobserved']?><br>
					  Action Taken: <?=$rowselect['actiontaken']?></p>
					  <hr>
					  <?php
					  $sqlcon4 = "SELECT * From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
					  $querycon4 = mysqli_query($connection, $sqlcon4);
		$rowcon4=mysqli_num_rows($querycon4);
		$infocon4=mysqli_fetch_array($querycon4);
		?>
		
    
    <div class="row">
    <div class="col-lg-12 text-center">
    <video id="preview" width="200"></video>
</div>
</div>
<h2 class="text-primary">Total Serial Numbers: <span id="totalserials"></span> / <span id="total1serials"><?=$rowxl['qty']?></span></h2>
<form action="serialupdates.php" method="post">
<input type="hidden" name="callid" value="<?=$_GET['id']?>">
<input type="hidden" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
<input type="hidden" name="sourceid" value="<?=$rowselect['sourceid']?>">
<input type="hidden" name="productid" value="<?=$rowxl['productid']?>">
<div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th colspan="2">Primary Device Serial Number<br>
                      <input type="text" name="upsserial" id="upsserial" value="<?=$rowselect['serial']?>" class="form-control">
                    </th>
                      
                    </tr>  
                  
					<tr>
                      <th>S.No</th>
                      <th>Serial Number</th>
                    </tr>
                  </thead>
                  <tbody id="content2">
				  <?php
				  $location="";
				  $sqlcall = "SELECT * From jrcserials where sourceid='".$rowselect['sourceid']."' order by serialqty asc";
				  
        $querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
         
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcall > 0) 
		{
			$count=1;
			while($rowcall = mysqli_fetch_array($querycall)) 
			{
        if(trim($rowcall['serialnumber'])!='')
        {
          if(trim($rowcall['serialnumber'])!=$rowselect['serial'])
          { 
			?>
                    <tr>
                      <td><input type="hidden" name="ids[]" id="id<?=$count?>" value="<?=$rowcall['id']?>" class="form-control"><?=$count?></td>
                      <td><input type="text" name="serialnumber[]" id="serialnumber<?=$count?>" value="<?=$rowcall['serialnumber']?>" class="form-control" onchange="serialst()"></td>
                    </tr>
					<?php
					$count++;

if($rowcall['upsserial']!='')
{
?>
<script>document.getElementById("upsserial").value="<?=$rowcall['upsserial']?>";</script>
<?php
}
$location=$rowcall['location'];


          }
        }
			}
			?>

			<?php
		}
			?>
					
                  </tbody>
                  <tfoot>
                  <tr>
                      <td colspan="2" style="text-align:right">
                      <a style="cursor:pointer" class="btn btn-sm btn-danger text-white" onclick="addrow()">+ Add Row</a></td>
                    </tr>  
                  <tr>
				  <tr>
                      <td colspan="2" style="text-align:center">
                      <label>Department Name</label>
                      <input type="text" class="form-control" name="department" id="department"></td>
                    </tr>  
                  <tr>
                      <td colspan="2" style="text-align:center"><input type="submit" name="submit" class="btn btn-success" value="Submit"></td>
                    </tr>

                  </tfoot>
                </table>
              </div>
<?php
if($location!='')
{
  
?>
<script>document.getElementById("department").value="<?=$location?>";</script>
<?php
}
?>
<script>
  document.getElementById("totalserials").innerHTML="<?=$count-1?>";
  </script>

</form>

</div>
                                    </div>
                                </div>		
					<?php
					$count++;
			}
		}
 }		
			?>
 </div>
			</div>
          </div>
        </div>
      </div>
      <?php include('footer.php') ?>
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
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
  <script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
  <script src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
  <script>
    function serialst()
    {
      var total=0;
        var serials=document.getElementsByName("serialnumber[]");
        for(var i=0;i<serials.length;i++)
        {
            if(serials[i].value!="")
            {
                total++;
            }
        }
        document.getElementById("totalserials").innerHTML=total;
    }
    </script>
  <script type="text/javascript">
   
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
      scanner.addListener('scan', function (content) {
        console.log(content);
        var as=0;
        var totals=1;
        if(document.getElementsByName("serialnumber[]"))
        {
        var serials=document.getElementsByName("serialnumber[]");
        for(var i=0;i<serials.length;i++)
        {
          if(serials[i].value!="")
          {
          if(serials[i].value==content)
          {
            as++;
          }               
          totals++;    
          }
        }
        }
        if(as==0)
        {
          var total1serials=document.getElementById("total1serials").innerHTML;
          var totalserials=document.getElementById("totalserials").innerHTML;
          if(total1serials==totalserials)
          {
            alert('You scanned All Serials');
          }
          else
          {
            $("#content2").prepend( ' <tr> <td><input type="hidden" name="ids[]" id="id'+totals+'" class="form-control">'+totals+'</td><td><input type="text" name="serialnumber[]" id="serialnumber'+totals+'" value="'+content+'" class="form-control" onchange="serialst()"></td></tr>' );
            totals++;
          }
          
        }
        else
        {
          alert('Sorry! This QR is Already Exists');
        }
        document.getElementById("totalserials").innerHTML=(totals-1);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
	  
	function addrow()
	  {
		  var totals=0;
		  var total1serials=document.getElementById("total1serials").innerHTML;
          var totalserials=document.getElementById("totalserials").innerHTML;
          if(total1serials==totalserials)
          {
            alert('All Text boxes Created');
          }
          else
          {
            $("#content2").append( ' <tr> <td><input type="hidden" name="ids[]" id="id'+totals+'" class="form-control">'+totals+'</td><td><input type="text" name="serialnumber[]" id="serialnumber'+totals+'" class="form-control" onchange="serialst()"></td></tr>' );
      
          }
	  }
    </script>
	<script>
	  
	  
	</script>
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
  });
</script>
</body>
</html>