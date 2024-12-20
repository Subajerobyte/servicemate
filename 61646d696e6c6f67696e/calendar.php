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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Calendar</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />


   <link rel="stylesheet" href="../../1637028036/vendor/fullcalendar/main.css" />
   <script src='../../1637028036/vendor/fullcalendar/main.js' ></script>
	<script src='../../1637028036/vendor/fullcalendar/locales-all.js'></script>
   	<script>

  document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'en';
    var localeSelectorEl = document.getElementById('locale-selector');
	var link = document.getElementById('myLink');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
	 height: '450px',
      expandRows: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: '<?=date('Y-m-d')?>',
      locale: initialLocaleCode,
      buttonIcons: true, // show the prev/next text
      weekNumbers: false,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: [
       
<?php

					  $sqlselect = "SELECT sourceid, remindertype, enddate From jrcreminder";
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
						$sqlxl = "SELECT id, consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
						$queryxl = mysqli_query($connection, $sqlxl);
						$rowCountxl = mysqli_num_rows($queryxl);
						if($rowCountxl>0)
						{
						$rowxl = mysqli_fetch_array($queryxl);
											
							?>

	   {
          title: '<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowselect['remindertype'] )) ?>, Customer Details :<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowxl['consigneename'] )) ?>,Product Details : <?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowxl['stocksubcategory'] )); ?> - <?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowxl['stockitem'] )) ?> ',
          start: '<?=$rowselect['enddate']?>',
		 url:'consigneeview.php?id=<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowxl['consigneeid'] ))?>'
        },
		
		<?php

						}
						else
						{
																		
							?>


		<?php
						
						
						$sqlfollow = "SELECT consigneeid, status From jrcfollowup where referqno='".$rowselect['sourceid']."' order by id asc";
						$queryfollow = mysqli_query($connection, $sqlfollow);
						$rowCountfollow = mysqli_num_rows($queryfollow);
						if($rowCountfollow>0)
						{
						$rowfollow = mysqli_fetch_array($queryfollow);
						$sqlcus = "SELECT consigneename From jrcxl where consigneeid='".$rowfollow['consigneeid']."' order by id asc";
						$querycus = mysqli_query($connection, $sqlcus);
						$rowcus = mysqli_fetch_array($querycus);						
							?>

	   {
          title:'<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowselect['remindertype'] )) ?>, Customer Details :<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowcus['consigneename'] )) ?> , Reminder : <?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowfollow['status'] ));?> ',
          start: '<?=$rowselect['enddate']?>',
		 url:'consigneeview.php?id=<?=mysqli_real_escape_string($connection,preg_replace( "/\r|\n/", "",$rowfollow['consigneeid'] ))?>'
        },
		
		<?php

						}
						else
						{
																		
							?>

	   {
          title:'Customer Details : , Product Details :  ',
          start: '<?=$rowselect['enddate']?>'
        },
		<?php
						}
						}
								$count++;
							}
						} 
						?>
		
      ],
	  eventClick: function(info) {
    info.jsEvent.preventDefault(); // don't let the browser navigate

    if (info.event.url) {
      window.open(info.event.url);
    }
  }
    });

    calendar.render();

    // build the locale selector's options
    calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
      var optionEl = document.createElement('option');
      optionEl.value = localeCode;
      optionEl.selected = localeCode == initialLocaleCode;
      optionEl.innerText = localeCode;
      localeSelectorEl.appendChild(optionEl);
    });

    // when the selected option changes, dynamically change the calendar option
    localeSelectorEl.addEventListener('change', function() {
      if (this.value) {
        calendar.setOption('locale', this.value);
      }
    });

  });

</script>

<style>
  
.go-corner {
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  width: 32px;
  height: 32px;
  overflow: hidden;
  top: 0;
  right: 0;
  background-color: #3d8eb9;
  border-radius: 0 4px 0 32px;
}

.go-arrow {
  margin-top: -4px;
  margin-right: -4px;
  color: white;
  font-family: courier, sans;
}

.card1 {
  display: block;
  position: relative;
  background-color: #3d8eb9;
  text-decoration: none;
  z-index: 0;
  overflow: hidden;
}
.card1:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: -16px;
    right: -16px;
    background: #ffffff;
    height: 32px;
    width: 32px;
    border-radius: 32px;
    transform: scale(1);
    transform-origin: 50% 50%;
    transition: transform 0.25s ease-out;
  }

.card1:hover:before {
    transform: scale(21);
  }

.card1:hover {
     color: #3d8eb9 !important;
 }
 .card-color 
{
	background-color: #fff !important;
	border-color: <?=$_SESSION['textcolor']?> !important;
}
.fc-h-event { /* allowed to be top-level */
  display: block;
  border: 1px solid <?=$_SESSION['bgcolor']?> !important;
  background-color: <?=$_SESSION['bgcolor']?> !important;
  text-color:<?=$_SESSION['textcolor']?> !important;
 
}
.fc .fc-daygrid-day-top {
    display: flex;
    flex-direction: row-reverse;
	font-size: 1.2rem;
	color: <?=$_SESSION['bgcolor']?>;
  }
  
  </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('alertnavbar.php');?>
        

        
        <div class="container-fluid">

         
          <!-- DataTales Example -->
	
			
  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Today ( <?=date('m-d-Y')?> ) Alerts</b></h1>
  </div>

</div>


          <div class="card shadow mb-4">
           <div class="card-header py-3">
	<?php 
					$amcexpiry=0;
					$amcinvoice=0;
					$quotation=0;
					$amcquotation=0;
					$amcmaintenance=0;
					$warrantysexpiry=0;
					$warrantymaintenance=0;
					$general=0;
					$lifetime=0;
			$sqlselect1 = "SELECT remindertype,enddate From jrcreminder where DATE(enddate)='".date('Y-m-d')."'";
				$queryselect1 = mysqli_query($connection, $sqlselect1);
				$rowCountselect1 = mysqli_num_rows($queryselect1);
				if($rowCountselect1 > 0) 
				{
					
					while($rowselect1 = mysqli_fetch_array($queryselect1)) 
					{
						
						if($rowselect1['remindertype']=="AMC MAINTENANCE")
						{
							$amcmaintenance++;
						}
						if($rowselect1['remindertype']=="PREVENTIVE MAINTENANCE")
						{
							$warrantymaintenance++;
						}
						if($rowselect1['remindertype']=="WARRANTY EXPIRE")
						{
							$warrantysexpiry++;
						}
						if($rowselect1['remindertype']=="AMC EXPIRE")
						{
							$amcexpiry++;
						}
						if($rowselect1['remindertype']=="AMC INVOICE")
						{
							$amcinvoice++;
						}
						if($rowselect1['remindertype']=="Quotation Followup")
						{
							$quotation++;
						}
						if($rowselect1['remindertype']=="AMC Quotation Followup")
						{
							$amcquotation++;
						}
						if($rowselect1['remindertype']=="General Followup")
						{
							$general++;
						}
						if($rowselect1['remindertype']=="PRODUCT LIFE TIME EXPIRE")
						{
							$lifetime++;
						}
					
					
					}
				}
				?>
			
				
<div class='row'>


						<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">AMC Expiry<br><span style="font-size:1.2rem;"><?=$amcexpiry?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">Warranty Expiry<br><span style="font-size:1.2rem;"><?=$warrantysexpiry?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">Warranty Maintenance<br><span style="font-size:1.2rem;"><?=$warrantymaintenance?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">AMC Maintenance<br><span style="font-size:1.2rem;"><?=$amcmaintenance?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
								<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">AMC Invoice<br><span style="font-size:1.2rem;"><?=$amcinvoice?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">Quotation Followup<br><span style="font-size:1.2rem;"><?=$quotation?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">AMC Quotation Followup<br><span style="font-size:1.2rem;"><?=$amcquotation?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">General Followup<br><span style="font-size:1.2rem;"><?=$general?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-3 mb-1" style="padding:0.25rem; z-index:2;">
								<div class="card card-color text-primary shadow1 " role="button">
									<div class="card-statistic-3 p-1">
										<div class="row align-items-center  d-flex" style="font-size:14px;">
											<div class="col-12 text-center">
												<h5 class="card-title mb-0" style="font-size:0.9rem; line-height:1.5; font-weight:bold">Product Lifetime Expiry<br><span style="font-size:1.2rem;"><?=$lifetime?></span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
</div>
</div>
</div>

<form action="" method="get" >
<div class="row">
	
<div class="col-lg-8"></div>
<div class="col-lg-2">
 <button type="submit" name="calendarview" class="btn btn-primary btn-block">Calendar View</button>
</div>
<div class="col-lg-2">
 <button type="submit" name="calendarhide" class="btn btn-secondary btn-block"> Hide Calendar</button>
</div>


</div>
</form>
<?php
if(isset($_GET['calendarview']))
{
	
?>
<form action="custcategoryadds.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-12">
<h4 class="h4 mb-2 mt-2 text-gray-800">Calendar</h4>
<div class="card shadow mb-4">
           <div class="card-header py-3">
						  
<div id='top' class="mb-2" style="display:none" >

    Locales:
    <select id='locale-selector'></select>

  </div>

  <div id='calendar'></div>
  
  
				
					</div>
				




  </div>
  </div>

        </div>
</form>
<?php
	
}
?>

         
        
         

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
     $( "#custcategory" ).autocomplete({
       source: 'custcategorysearch.php?type=custcategory',
     });
	 $( "#designation" ).autocomplete({
       source: 'custcategorysearch.php?type=designation',
     });
	 $( "#custcategory" ).autocomplete({
       source: 'custcategorysearch.php?type=custcategory',
     });
  });
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
        function openUrl() { 
            window.open( 
"consigneeview.php?id=<?=$rowxl['consigneeid']?>", "_blank"); 
        } 
    </script> 
</body>

</html>
