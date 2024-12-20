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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Service / AMC Revenue</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <style>
  .c-dashboardInfo {
  margin-bottom: 15px;
}
.c-dashboardInfo .wrap {
  background: #ffffff;
  box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
  border-radius: 7px;
  text-align: center;
  position: relative;
  overflow: hidden;
  padding: 40px 25px 20px;
  height: 100%;
}
.c-dashboardInfo__title,
.c-dashboardInfo__subInfo {
  color: #6c6c6c;
  font-size: 1.18em;
}
.c-dashboardInfo span {
  display: block;
}
.c-dashboardInfo__count {
  font-weight: 600;
  font-size: 2.5em;
  line-height: 64px;
  color: #323c43;
}
.c-dashboardInfo .wrap:after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 10px;
  content: "";
}

.c-dashboardInfo:nth-child(1) .wrap:after {
  background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
}
.c-dashboardInfo:nth-child(2) .wrap:after {
  background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
}
.c-dashboardInfo:nth-child(3) .wrap:after {
  background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
}
.c-dashboardInfo:nth-child(4) .wrap:after {
  background: linear-gradient(81.67deg, #ff647c 0%, #1f5dc5 100%);
}
.c-dashboardInfo__title svg {
  color: #d7d7d7;
  margin-left: 5px;
}
.MuiSvgIcon-root-19 {
  fill: currentColor;
  width: 1em;
  height: 1em;
  display: inline-block;
  font-size: 24px;
  transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
  user-select: none;
  flex-shrink: 0;
}
.cardb{
    border: 3px solid #3d8eb9!important;
}

.cardnew1
{
	height:100px!important;
	
}
 .card 
	{
        border: none;
    }
	.col-12
	{
		padding-right: 0;
		padding-left: 0;
	}
	.contable td, .contable th {
    padding: 0.3rem;
    vertical-align: top;
    border-top: 1px solid #e3e6f0;
}
  </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>

        
        <div class="container-fluid">

     
          <!-- Page Heading -->
		  
		  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Service / AMC Income</b></h1>
  </div>
<div class="col-auto" style="padding-top:10px; text-align: right;">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
        <div class="input-group">
            <input type="text" id="reportrange" name="reportrange" class="form-control"/>
            <div class="input-group-append">
                <button class="btn btn-navb" type="submit" name="submit">
                    <i class="fa-solid fa-calendar-days fa-sm" style="color: #3d8eb9;"></i>
                </button>
                <button class="btn btn-navb" type="submit">
                    <a href="revenue.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
                </button>
            </div>
        </div>
    </form>
</div>
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
         
<div id="root">
  <div class="container">
     <?php
		  if(isset($_POST['submit']))
		  {
			   $reportrange=mysqli_real_escape_string($connection, $_POST['reportrange']);

				$reportrange = explode(' - ', $reportrange);
				$from = $reportrange[0];
				$to   = $reportrange[1];
				
				$from = explode('/', $from);
				$month   =$from[0];
				$date   =$from[1];
				$year = $from[2];
				$dashfromdate =$from[2]."-".$from[0]."-".$from[1];
				
				$to = explode('/', $to);
				$month1   = $to[0];
				$date1   = $to[1];
				$year1 = $to[2];
				$dashtodate =$to[2]."-".$to[0]."-".$to[1];
				
			 $dashfromdate=mysqli_real_escape_string($connection, $dashfromdate);
						$dashtodate=mysqli_real_escape_string($connection, $dashtodate);
					$dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch1=' and datefrom between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
		  }
		  else
		  {
			  $dashfromdate='';
			  $dashtodate='';
			  $dashcallonsearch='';
			  $dashschargesearch='';
			  $dashschargesearch1='';
		  }?>
		 
    <div class="row align-items-stretch">
      
	  <div class="col-lg-6">
                            <div class="card shadow  cardb mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#04121f" class="m-0"><b>Monthwise Service Income </b><span
                                            class="float-right" style="color:<?=$_SESSION['bgcolor']?>"><b>( To be Collected: ₹ <span
                                                id="tobecollected"></span> )</b></span></h6>
                                </div>
                                <div class="card-body">
								
								<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<canvas id="myChart1" style="width:100%; height:232px;"></canvas>
                  <?php
				}
				else
				{
					?>
					<p style="width:100%; height:222px; text-align:center">
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Monthwise Service Income</b></span></a>
					</p>
					<?php
				}
				?>
								
                                    
                                </div>
							</div>
                        </div>
      <div class="col-lg-6">
                            <div class="card shadow cardb mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#04121f" class="m-0  "><b>Monthwise AMC Income </b><span
                                            class="float-right" style="color:<?=$_SESSION['bgcolor']?>"><b>( To be Collected: ₹ <span
                                                id="tobecollected1"></span> )</b></span></h6>
                                </div>
                                <div class="card-body">
								
								<?php
				if(($liveplan=='DIAMOND'))
				{
					?>
					<canvas id="myCharta1" style="width:100%; height:232px;"></canvas>
                  <?php
				}
				else
				{
					?>
					<p style="width:100%; height:222px; text-align:center">
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="mb-0 text-secondary"><b>Monthwise AMC Income</b></span></a>
					</p>
					<?php
				}
				?>
								
                                    
                                </div>
							</div>
                        </div>
      
    </div>
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

    
    <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
    <script src="notification.js"></script>

    <script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
    
    <script src="../../1637028036/vendor/chart.js/3.8/chart.js"></script>
	
    <script type="text/javascript" src="../../1637028036/vendor/chart.js/3.8/datalabels.js"></script>
        <script>
   // script.js
const popupOverlay = document.querySelector(".popup-overlay");
const popupContainer = document.querySelector(".popup-container");
const closePopupButton = document.getElementById("close_popup");
const yesbutton = document.getElementById("yesButton");

function openPopup() {
  popupOverlay.style.display = "flex";
  setTimeout(() => {
    popupContainer.style.opacity = "1";
    popupContainer.style.transform = "scale(1)";
  }, 100);
}

function closePopup() {
	  window.location.href = 'dashboard.php?close_popup';
  popupContainer.style.opacity = "0";
  popupContainer.style.transform = "scale(0.8)";
  setTimeout(() => {
    popupOverlay.style.display = "none";
  }, 300);
}
function openAnotherURL() {
            // Change the URL to the one you want to open
            window.location.href = 'swupdates.php?yesButton';
        }
// Automatically open the popup when the page loads
window.addEventListener("load", openPopup);

closePopupButton.addEventListener("click", closePopup);
yesbutton.addEventListener("click", openAnotherURL);

  </script>
    <script type="text/javascript">
    $(function() {
        $("#topsearch").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#topsearch").val(ui.item.value);
                $("#topsearchid").val(ui.item.id);
	        },
            minLength: 3
        });
        $("#topsearch1").autocomplete({
            source: 'topsearch.php',
            select: function(event, ui) {
                $("#topsearch1").val(ui.item.value);
                $("#topsearchid1").val(ui.item.id);
            },
            minLength: 3
        });
    });
    </script>

    <?php
$totalservicerevenue=0;
$todayservicerevenue=0;
$sdate=array();
$samount=array();
$monthsarray=array();
$monthsparray=array();
$montharray=array();
 $sqli=mysqli_query($connection, "select sum(scharge) as scharge, schargedate, cashstatus from jrccalldetails where srno!='' and scharge!='' and scharge!='0' and scharge!='0.00' and incgst!='2' and (schargedate > now() - INTERVAL 7 MONTH) ".$dashschargesearch." group by schargedate, cashstatus order by cast(schargedate as date) asc");
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $sdate[]=date('d M',strtotime($infoi['schargedate']));
	 $samount[]=$infoi['scharge'];
	 $totalservicerevenue+=(float)$infoi['scharge'];
	 if(date('d/m/Y')==date('d/m/Y',strtotime($infoi['schargedate'])))
	 {
		 $todayservicerevenue=$infoi['scharge'];
	 }
	 $monthsarray[date('Y-m-d',strtotime($infoi['schargedate']))]=$infoi['scharge'];
	 $montharray[]=date('M Y',strtotime($infoi['schargedate']));
	 if($infoi['cashstatus']=='1')
	 {
		 $monthsparray[date('Y-m-d',strtotime($infoi['schargedate']))]=$infoi['scharge'];
	 }
		else
		{
			$monthsparray[date('Y-m-d',strtotime($infoi['schargedate']))]=0;
		}	
 }
$montharray=array_unique($montharray); 
$result1=array(); 
$result2=array(); 
foreach($monthsarray as $key=>$val)
{
   if(isset($result1[substr($key,0,7)]))
   {
		$result1[substr($key,0,7)] += $val;
   }
   else
   {
		$result1[substr($key,0,7)] = $val;
   }
}

foreach($monthsparray as $key=>$val)
{
   if(isset($result2[substr($key,0,7)]))
   {
		$result2[substr($key,0,7)] += $val;
   }
   else
   {
		$result2[substr($key,0,7)] = $val;
   }
}
?>
    <script>
    var xValues = [<?php foreach ($sdate as $sd){ echo "'".$sd."',";}?>];
    var yValues = [<?php foreach ($samount as $sa){ echo $sa.',';}?>];
    document.getElementById("totalservicerevenue").innerHTML = '<?=$totalservicerevenue?>';
    document.getElementById("todayservicerevenue").innerHTML = '<?=$todayservicerevenue?>';
    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(61, 142, 185,1.0)",
                borderColor: "rgba(61, 142, 185,0.1)",
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                /* yAxes: [{ticks: {min: 6, max:16}}], */
            }
        }
    });
    </script>

<script>
    // setup 
	
    const data = {
      labels: [<?php foreach ($montharray as $sd){ echo "'".$sd."',";}?>],
      datasets: [{
        label: 'Total Amount',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result1[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
		backgroundColor: ['<?=$_SESSION['bgcolor']?>'],
        borderColor: ['<?=$_SESSION['bgcolor']?>'],
        borderWidth: 1
      }, {
        label: 'Collected',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result2[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
        backgroundColor: ['<?=$_SESSION['lightbgcolor']?>'],
        borderColor: ['<?=$_SESSION['lightbgcolor']?>'],
        borderWidth: 1
      }, {
        label: 'To be Collected',
        data: [
		<?php 
	$i=0;
	$tob=0;
	foreach ($montharray as $sd)
	{
		echo ((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]).','; 
		$tob+=((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]);
		$i++;
	}
	
	?>],
	
	
        backgroundColor: ['rgba(0, 0, 0, 0.2)'],
        borderColor: ['rgba(0, 0, 0, 0.2)'],
        borderWidth: 1
      }]
    };

const kdatefrom1 = [];
const kdateto1 = [];
<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		?>
		kdatefrom1[<?=$i?>]= "<?=date('Y-m-01', strtotime($sd))?>";
		kdateto1[<?=$i?>]= "<?=date('Y-m-t', strtotime($sd))?>";
		<?php
		$i++;
	}
	
	?>
    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
		  x: {
			  ticks: {
                    color: 'black' // Change the font color here
                },
			  stacked: false 
		  },
          y: {
			  ticks: {
                    color: 'black' // Change the font color here
                },
            beginAtZero: true,
			stacked: false
          }
        },
		plugins: {
			datalabels:{
				rotation:270,
			}
		},
      },
	  plugins: [ChartDataLabels]
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart1'),
      config
    );
const canvas = document.getElementById('myChart1'); // Updated canvas ID
canvas.onclick = function (e) {
  const bar = myChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
  if (bar.length > 0) {
   
    const index = bar[0].index;

    
    const clickedLabel = myChart.data.labels[index];

   
    const datasetIndex = bar[0].datasetIndex;

   
    const datasetLabel = myChart.data.datasets[datasetIndex].label;

    
    if (datasetLabel === 'Total Amount') {

      window.location.href = 'servicecharges.php?datefrom='+kdatefrom1[index]+'&dateto='+kdateto1[index]+'&submit=';
    } else if (datasetLabel === 'Collected') {
     
      window.location.href = 'servicecharges.php?datefrom='+kdatefrom1[index]+'&dateto='+kdateto1[index]+'&ty=1&submit=';
    } else if (datasetLabel === 'To be Collected') {
     
      window.location.href = 'servicecharges.php?datefrom='+kdatefrom1[index]+'&dateto='+kdateto1[index]+'&ty=0&submit=';
    }
  }
};
	
/* 	const url = 'servicecharges.php?datefrom=<?=date('Y-m-01', strtotime($sd))?>&dateto=<?=date('Y-m-t', strtotime($sd))?>&submit=';
	// Click event handler
const canvas = document.getElementById('myChart1'); // Updated canvas ID
canvas.onclick = function (e) {
  // Navigate to the specified URL when any bar is clicked
  window.location.href = url;
}; */
	
	document.getElementById("tobecollected").innerHTML="<?=$tob?>";
	

    </script>
	
	
	
	<!--for amc service chart-->
	
	
	<?php
$totalamcrevenue=0;
$todayamcrevenue=0;
$sdate=array();
$samount=array();
$monthsarray=array();
$monthsparray=array();
$montharray=array();
 $sqli=mysqli_query($connection, "select sum(totalvalue) as totalvalue,sum(receivedamount) as receivedamount, datefrom from jrcamc where totalvalue!='' and totalvalue!='0' and totalvalue!='0.00'  and (datefrom > now() - INTERVAL 7 MONTH) ".$dashschargesearch1." group by datefrom order by cast(datefrom as date) asc");
 
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $sdate[]=date('d M',strtotime($infoi['datefrom']));
	 $samount[]=$infoi['totalvalue'];
	 $totalamcrevenue+=(float)$infoi['receivedamount'];
	 if(date('d/m/Y')==date('d/m/Y',strtotime($infoi['datefrom'])))
	 {
		 $todayamcrevenue=$infoi['receivedamount'];
	 }
	 $monthsarray[date('Y-m-d',strtotime($infoi['datefrom']))]=$infoi['totalvalue'];
	 $montharray[]=date('M Y',strtotime($infoi['datefrom']));
	 
		 $monthsparray[date('Y-m-d',strtotime($infoi['datefrom']))]=$infoi['receivedamount'];
	 
 }
$montharray=array_unique($montharray); 
$result1=array(); 
$result2=array(); 
foreach($monthsarray as $key=>$val)
{
   if(isset($result1[substr($key,0,7)]))
   {
		$result1[substr($key,0,7)] += $val;
   }
   else
   {
		$result1[substr($key,0,7)] = $val;
   }
}

foreach($monthsparray as $key=>$val)
{
   if(isset($result2[substr($key,0,7)]))
   {
		$result2[substr($key,0,7)] += $val;
   }
   else
   {
		$result2[substr($key,0,7)] = $val;
   }
}
?>
    <script>
    var xValues = [<?php foreach ($sdate as $sd){ echo "'".$sd."',";}?>];
    var yValues = [<?php foreach ($samount as $sa){ echo $sa.',';}?>];
    document.getElementById("totalamcrevenue").innerHTML = '<?=$totalamcrevenue?>';
    document.getElementById("todayamcrevenue").innerHTML = '<?=$todayamcrevenue?>';
    new Chart("myCharta", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(61, 142, 185,1.0)",
                borderColor: "rgba(61, 142, 185,0.1)",
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                /* yAxes: [{ticks: {min: 6, max:16}}], */
            }
        }
    });
    </script>

<script>
    // setup 
    const data1 = {
      labels: [<?php foreach ($montharray as $sd){ echo "'".$sd."',";}?>],
      datasets: [{
        label: 'Total Amount',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result1[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
		backgroundColor: ['<?=$_SESSION['bgcolor']?>'],
        borderColor: ['<?=$_SESSION['bgcolor']?>'],
        borderWidth: 1
      }, {
        label: 'Collected',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result2[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
        backgroundColor: ['<?=$_SESSION['lightbgcolor']?>'],
        borderColor: ['<?=$_SESSION['lightbgcolor']?>'],
        borderWidth: 1
      }, {
        label: 'To be Collected',
        data: [
		<?php 
	$i=0;
	$tob1=0;
	foreach ($montharray as $sd)
	{
		echo ((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]).','; 
		$tob1+=((float)$result1[date('Y-m',strtotime($sd))]-(float)$result2[date('Y-m',strtotime($sd))]);
		$i++;
	}
	
	?>],
        backgroundColor: ['rgba(0, 0, 0, 0.2)'],
        borderColor: ['rgba(0, 0, 0, 0.2)'],
        borderWidth: 1
      }]
    };

const kdatefrom = [];
const kdateto = [];
<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		?>
		kdatefrom[<?=$i?>]= "<?=date('Y-m-01', strtotime($sd))?>";
		kdateto[<?=$i?>]= "<?=date('Y-m-t', strtotime($sd))?>";
		<?php
		$i++;
	}
	
	?>


    // config 
    const config1 = {
      type: 'bar',
      data:data1,
      options: {
        scales: {
		  x: {
			   ticks: {
                    color: 'black' // Change the font color here
                },
			  stacked: false
		  },
          y: {
			   ticks: {
                    color: 'black' // Change the font color here
                },
            beginAtZero: true,
			stacked: false
          }
        },
		plugins: {
			datalabels:{
				rotation:270,
			}
		},
      },
	  plugins: [ChartDataLabels]
    };

    // render init block
    const myCharta = new Chart(
      document.getElementById('myCharta1'),
      config1
    );
	
	const canvas1 = document.getElementById('myCharta1'); // Updated canvas ID
canvas1.onclick = function (e) {
  const bar1 = myCharta.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
  console.log(bar1);
  if (bar1.length > 0) {
   
 
    const index1 = bar1[0].index;

    
    const clickedLabel = myCharta.data.labels[index1];

   
    const datasetIndex = bar1[0].datasetIndex;

   
    const datasetLabel = myCharta.data.datasets[datasetIndex].label;

    
    if (datasetLabel === 'Total Amount') {

      window.location.href = 'amccharges.php?datefrom='+kdatefrom[index1]+'&dateto='+kdateto[index1]+'&submit=';
    } else if (datasetLabel === 'Collected') {
     
      window.location.href = 'amccharges.php?datefrom='+kdatefrom[index1]+'&dateto='+kdateto[index1]+'&ty=collected&submit=';
    } else if (datasetLabel === 'To be Collected') {
     
      window.location.href = 'amccharges.php?datefrom='+kdatefrom[index1]+'&dateto='+kdateto[index1]+'&ty=pending&submit=';
    }
	
  }
};

	/* const url1 = 'servicecharges.php?datefrom=<?=date('Y-m-01', strtotime($sd))?>&dateto=<?=date('Y-m-t', strtotime($sd))?>&submit=';
	// Click event handler
const canvas1 = document.getElementById('myCharta1'); // Updated canvas ID
canvas1.onclick = function (e) {
  // Navigate to the specified URL when any bar is clicked
  	const labelNames = data1.datasets.label;
alert(labelNames);
  window.location.href = url1;   */
  
  


	document.getElementById("tobecollected1").innerHTML="<?=$tob1?>";
    </script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
 <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
    <script>
    const demo = document.getElementById('demo');

    function error(err) {
        demo.innerHTML = `Failed to locate. Error: ${err.message}`;
    }

    function success(pos) {
        demo.innerHTML = 'Located: ' + `${pos.coords.latitude}, ${pos.coords.longitude}`;
        showPosition(pos);
        //alert(`${pos.coords.latitude}, ${pos.coords.longitude}`);
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

    function showPosition(position) {
        var useremail = "<?=$_SESSION['email']?>";
       /*  $.ajax({
            url: "livelocation.php",
            type: "post",
            data: {
                lati: position.coords.latitude,
                longi: position.coords.longitude,
                user: useremail
            },
            success: function(data) {
                console.log(data);
            }
        }); */
    }
    </script>
    <script>
    $(function() {
        $('marquee').mouseover(function() {
            $(this).attr('scrollamount', 0);
        }).mouseout(function() {
            $(this).attr('scrollamount', 5);
        });
    });
    </script>
	<script>
var timeOutId = 0;
var ajaxFn = function () {
        $.ajax({
            url: 'additionmarks.php',
            success: function (response) {
                if (response == 'True') {
                    clearTimeout(timeOutId);
                } else {
                    //timeOutId = setTimeout(ajaxFn, 10000);
                    console.log("call");
                }
            }
        });
}
ajaxFn();
//timeOutId = setTimeout(ajaxFn, 10000);
	</script>
	<!------------daterangepicker--->
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/moment.min.js"></script>
<script type="text/javascript" src="../../1637028036/vendor/daterangepicker-master/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

    var start = moment();
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
 <script>
      const myDiv = document.getElementById("myDiv");
      myDiv.addEventListener("mouseover", showTooltip);
      myDiv.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip1");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip1");
         tooltip.style.display = "none";
      }  
  </script> <script>
      const myDiv1 = document.getElementById("myDiv1");
      myDiv1.addEventListener("mouseover", showTooltip);
      myDiv1.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip2");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip2");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv2 = document.getElementById("myDiv2");
      myDiv2.addEventListener("mouseover", showTooltip);
      myDiv2.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip3");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip3");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv3 = document.getElementById("myDiv3");
      myDiv3.addEventListener("mouseover", showTooltip);
      myDiv3.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip4");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip4");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv4 = document.getElementById("myDiv4");
      myDiv4.addEventListener("mouseover", showTooltip);
      myDiv4.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip5");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip5");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv5 = document.getElementById("myDiv5");
      myDiv5.addEventListener("mouseover", showTooltip);
      myDiv5.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip6");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip6");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv6 = document.getElementById("myDiv6");
      myDiv6.addEventListener("mouseover", showTooltip);
      myDiv6.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip7");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip7");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv7 = document.getElementById("myDiv7");
      myDiv7.addEventListener("mouseover", showTooltip);
      myDiv7.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip8");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip8");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv8 = document.getElementById("myDiv8");
      myDiv8.addEventListener("mouseover", showTooltip);
      myDiv8.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip9");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip9");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv8 = document.getElementById("myDiv8");
      myDiv8.addEventListener("mouseover", showTooltip);
      myDiv8.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip9");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip9");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv9 = document.getElementById("myDiv9");
      myDiv9.addEventListener("mouseover", showTooltip);
      myDiv9.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip10");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip10");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv10 = document.getElementById("myDiv10");
      myDiv10.addEventListener("mouseover", showTooltip);
      myDiv10.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip11");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip11");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv11 = document.getElementById("myDiv11");
      myDiv11.addEventListener("mouseover", showTooltip);
      myDiv11.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip12");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip12");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv12 = document.getElementById("myDiv12");
      myDiv12.addEventListener("mouseover", showTooltip);
      myDiv12.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip13");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip13");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv13 = document.getElementById("myDiv13");
      myDiv13.addEventListener("mouseover", showTooltip);
      myDiv13.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip14");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip14");
         tooltip.style.display = "none";
      }  
  </script>
  <script>
      const myDiv14 = document.getElementById("myDiv14");
      myDiv14.addEventListener("mouseover", showTooltip);
      myDiv14.addEventListener("mouseout", hideTooltip);
      function showTooltip() {
         const tooltip = document.querySelector(".tooltip15");
         tooltip.style.display = "block";
      }
      function hideTooltip() {
         const tooltip = document.querySelector(".tooltip15");
         tooltip.style.display = "none";
      }  
  </script>
<!------------daterangepicker--->
<script>
$(".drag-me").draggable({
  axis: "y"
});
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	


<?php include('additionaljs.php');   ?>
</body>

</html>
