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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Activity Log</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    
   
   <style>
	.vertical-timeline {
    width: 100%;
    position: relative;
    padding: 1.5rem 0 1rem;
}

.vertical-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 67px;
    height: 100%;
    width: 4px;
    background: #e9ecef;
    border-radius: .25rem;
}

.vertical-timeline-element {
    position: relative;
    margin: 0 0 1rem;
}

.vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
    visibility: visible;
    animation: cd-bounce-1 .8s;
}
.vertical-timeline-element-icon {
    position: absolute;
    top: 0;
    left: 60px;
}

.vertical-timeline-element-icon .badge-dot-xl {
    box-shadow: 0 0 0 5px #fff;
}

.badge-dot-xl {
    width: 18px;
    height: 18px;
    position: relative;
}
.badge:empty {
    display: none;
}


.badge-dot-xl::before {
    content: '';
    width: 10px;
    height: 10px;
    border-radius: .25rem;
    position: absolute;
    left: 50%;
    top: 50%;
    margin: -5px 0 0 -5px;
    background: #fff;
}

.vertical-timeline-element-content {
    position: relative;
    margin-left: 90px;
    font-size: .8rem;
}

.vertical-timeline-element-content .timeline-title {
    font-size: .8rem;
    text-transform: uppercase;
    margin: 0 0 .5rem;
    padding: 2px 0 0;
    font-weight: bold;
}

.vertical-timeline-element-content .vertical-timeline-element-date {
    display: block;
    position: absolute;
    left: -90px;
    top: 0;
    padding-right: 10px;
    text-align: right;
    color: #adb5bd;
    font-size: .7619rem;
    white-space: nowrap;
}
.badge-danger
{
	background-color:#ee5b5b;
}
.badge-warning
{
	background-color:#fcd53b;
}
.badge-success
{
	background-color:#0ddbb9;
}
.badge-primary
{
	background-color:#3792cb;
}
	</style>
   
   
   
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

<body id="page-top" onload="getGeolocation()">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800  mt-2">Activity Log</h1>
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
<div class="card-body">		
<form action="#" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">

<div class="row">
<?php

if($adminuserid=='1')
{
			?>
<div class="col-lg-3">
      <div class="form-group">
    <label for="adminuserlog">Admin Users</label>
		
	<select class="form-control fav_clr" id="adminuserlog" name="adminuserlog" >
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername,username From jrcadminuser where enabled='0' order by adminusername asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep =mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['username']?>"> <?=$rowrep['adminusername'] ?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>

 
 
 <div class="col-lg-3">
  <div class="form-group">
    <label for="engineername">Engineers </label>
	<select class="form-control fav_clr" id="engineerlog" name="engineerlog">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername,username From jrcengineer where enabled='0' order by engineername asc";
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
<option value="<?=$rowrep['username']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>





</select>

  </div>
	</div>
	<?php }
?>
	



<div class="col-lg-3">
  <div class="form-group">
    <label for="todate">To Date</label>
	<input type="text"  id="reportrange"  name="reportrange" class="form-control"/>
									</div>
	</div>
	</div>
	<input class="btn btn-primary " type="submit" name="submit" value="Submit"/>
		</form>
   </div>
   </div>
   

  <?php
if(isset($_POST['submit']))
{
	if($adminuserid=='1')
	{
	$adminuserlog=mysqli_real_escape_string($connection,$_POST['adminuserlog']);
	$engineerlog=mysqli_real_escape_string($connection,$_POST['engineerlog']);
	}
	else{
	$adminuserlog=$email;
	$engineerlog="";
	}
	          
$statitle="";
$staqu="";
			  $reportrange=mysqli_real_escape_string($connection,$_POST['reportrange']);
//$reportrange=mysqli_real_escape_string($connection,$_POST['reportrange']);
	
				$reportrange = explode(' - ', $reportrange); 
				$from = $reportrange[0];
				$to   = $reportrange[1];
				
				$from = explode('/', $from);
				$month   =$from[0];
				$date   =$from[1];
				$year = $from[2];
				$fromdate =$from[2]."-".$from[0]."-".$from[1];
				
				$to = explode('/', $to);
				$month1   = $to[0];
				$date1   = $to[1];
				$year1 = $to[2];
				$todate =$to[2]."-".$to[0]."-".$to[1];
				
			   $dashfromdate=mysqli_real_escape_string($connection,$fromdate);
			  $dashtodate=mysqli_real_escape_string($connection,$todate);
			 $dashcallonsearch=' and (t2.callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
			  $dashschargesearch=' and (t2.schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
			  
			  if($staqu!="")
				{
					$staqu.=' and (t2.callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
				}
				else
				{
					$staqu.=' and (t2.callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59")';
				}
				
		  
		 				

if ($adminuserlog!="")
{
	$usersearch= $adminuserlog;
}
elseif ($engineerlog!="")
{
	$usersearch= $engineerlog;
}
else
{
	$usersearch= ""; 
	
}
?>
<div class="card shadow mb-4">
<div class="card-body">
<?php
if ($usersearch!="")
{
	

	?>
	
	<div class="row">
			 <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
				<?php
				
				$batcharray=array('badge-primary','badge-primary','badge-primary','badge-primary');
				$sqlselect = "SELECT user,remarks,ipaddress,times From jrchistory where DATE(times)>='".$fromdate."' and DATE(times)<='".$todate."' and user='".$usersearch."' order by id desc";
					  $queryselect = mysqli_query($connection, $sqlselect);
					  $rowCountselect = mysqli_num_rows($queryselect);
						if(!$queryselect){
						   die("SQL query failed: " . mysqli_error($connection));
						}
			 
						if($rowCountselect > 0) 
						{
							$count=0;
							while($rowselect = mysqli_fetch_array($queryselect)) 
							{
							?>
				
				
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl <?=$batcharray[$count];?>"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title"><?=$rowselect['user']?> - <?=$rowselect['remarks']?></h4>
                                                            <p>from <a href="javascript:void(0);" data-abc="true"><?=$rowselect['ipaddress']?></a></p>
                                                            <span class="vertical-timeline-element-date"><?=date('d/m/Y', strtotime($rowselect['times']))?></br><?=date(' h:i a', strtotime($rowselect['times']))?></span>
                                                        </div>
                                                    </div>
                                                </div>
												
												<?php
								$count++;
								if(($count%4)==0)
								{
									$count=0;
								}
							}
						}
						?>
                                                
                                                
                                                   
                                                
                                            </div>
				
				
				  </div>
				  </div>
				  </div>
				  </div>
					
	<?php
}
else{
	echo '<div class = "bg-danger" > Please Select Either Admin User or Engineer</div>';
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
     $( "#adminusername" ).autocomplete({
       source: 'engineersearch.php?type=adminusername',
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
const demo = document.getElementById('demo');
    function error(err) {
        demo.innerHTML = `Failed to locate. Error: ${err.message}`;
    }

    function success(pos) {
        demo.innerHTML = 'Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`;
		document.getElementById("latlong").value=`${pos.coords.latitude}, ${pos.coords.longitude}`;
    }

    function getGeolocation() {
        if (navigator.geolocation) {
            demo.innerHTML = 'Locating…';
            setInterval(function(){
			  navigator.geolocation.getCurrentPosition(success, error);
			}, 30000);	
        } else { 
            demo.innerHTML = 'Geolocation is not supported by this browser.';
        }
    }
 
           
            </script>
<script>
var password = document.getElementById("password");
password.addEventListener('keyup', function() {

  var pwd = password.value

  // Reset if password length is zero
  if (pwd.length === 0) {
    document.getElementById("progresslabel").innerHTML = "";
    document.getElementById("progress").value = "0";
    return;
  }

  // Check progress
  var prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
    .reduce((memo, test) => memo + test.test(pwd), 0);

  // Length must be at least 8 chars
  if(prog > 2 && pwd.length > 7){
    prog++;
  }

  // Display it
  var progress = "";
  var strength = "";
  switch (prog) {
    case 0:
    case 1:
    case 2:
      strength = "25%";
      progress = "25";
      break;
    case 3:
      strength = "50%";
      progress = "50";
      break;
    case 4:
      strength = "75%";
      progress = "75";
      break;
    case 5:
      strength = "100% - Password strength is good";
      progress = "100";
      break;
  }
  document.getElementById("progresslabel").innerHTML = strength;
  document.getElementById("progress").value = progress;

});
</script>
<script>
function checkvalidate()
{
	if(document.getElementById("progress").value!="100")
	{
		alert("Kindly give Strength Password");
		document.getElementById("password").focus();
		return false;
	}
}
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
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
<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script>
  (function(window) {
    var $canvas,
        onResize = function(event) {
          $canvas.attr({
 
          });
        };

    $(document).ready(function() {
	  $canvas = $('canvas');
      window.addEventListener('orientationchange', onResize, false);
      window.addEventListener('resize', onResize, false);
      onResize();
	  $('#clear').click(function() {
  $('#signpad').signaturePad().clearCanvas();
});

      $('#signpad').signaturePad({
        drawOnly: true,
        defaultAction: 'drawIt',
        validateFields: false,
        lineWidth: 0,
        output :'.output',
        sigNav: null,
        name: null,
        typed: null,
        clear: '#clear',
        typeIt: null,
        drawIt: null,
        typeItDesc: null,
        drawItDesc: null
      });
	  $("#btnSaveSign").click(function(e){
		  
			html2canvas([document.getElementById('pad')], {
				onrendered: function (canvas) {
					var canvas_img_data = canvas.toDataURL('image/png');
					var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					//ajax call to save image inside folder
					$.ajax({
						url: 'save_sign.php',
						data: { img_data:img_data },
						type: 'post',
						success: function (response) {
							console.log(response);
						    $("#signatureimg").attr("src",response);
							$("#signatureimg").show();
						   $("#signature").val(response);
						}
					});
				}, 
				backgroundColor: null, 
			});
		});
    });
  }(this));
  </script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
  <!------------daterangepicker--->
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/moment.min.js"></script>
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(6, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'Last 365 Days': [moment().subtract(364, 'days'), moment()],
			'This Week': [moment().startOf('week'), moment().endOf('week')],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'This Year': [moment().startOf('year'), moment().endOf('year')],
			'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')], 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        }
    }, cb);

    cb(start, end);
	<?php
	if((isset($dashfromdate))&&($dashfromdate!=''))
	{
		?>
		$('#reportrange').data('daterangepicker').setStartDate('<?=date('m/d/Y',strtotime($dashfromdate))?>');
		$('#reportrange').data('daterangepicker').setEndDate('<?=date('m/d/Y',strtotime($dashtodate))?>');
		<?php
	}
	?>
});
</script>
<!------------daterangepicker--->
<?php include('additionaljs.php');   ?>
</body>

</html>