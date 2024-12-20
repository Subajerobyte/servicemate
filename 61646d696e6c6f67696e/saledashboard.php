<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once '../../1637028036/vendor/excel1/Classes/PHPExcel.php';	
include('lcheck.php'); 
function convertXLStoCSV($infile,$outfile)
{
	$fileType = PHPExcel_IOFactory::identify($infile);
	$objReader = PHPExcel_IOFactory::createReader($fileType);
			 
	$objReader->setReadDataOnly(false); 
	$objPHPExcel = $objReader->load($infile);    
				 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
	$objWriter->save($outfile);
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

    <title><?=$_SESSION['companyname']?> - Jerobyte - Dashboard</title>

    
    <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <meta name="theme-color" content="#3d8eb9">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> 
    <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
    <style>
    .todo-list {
        margin: 0;
        padding: 0;
        list-style: none;
        overflow: auto;
    }

    .todo-list>li {
        border-radius: 2px;
        padding: 10px;
        background: #f4f4f4;
        margin-bottom: 2px;
        border-left: 2px solid #e6e7e8;
        color: #444;
    }

    .todo-list>li .label {
        margin-left: 10px;
        font-size: 9px;
    }

    .todo-list>li .tools {
        display: none;
        float: right;
        color: #dd4b39;
    }

    .todo-list>li:hover .tools {
        display: block;
    }

    .no-border {
        border: 0 !important;
    }

    .btn-sm {
        padding: .25rem .15rem;
        font-size: .675rem;
        line-height: 0.5;
        border-radius: .2rem;
    }

    .mybox:after 
	{
        content: '';
        position: absolute;
        right: 0px;
        top: 25%;
        height: 50%;
        border-right: 2px solid #ffffff;
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
	<style>
		  .plancentered {
  position: absolute;
  top: 50%;
  left: 50%; 
  transform: translate(-50%, -50%);
  background:rgba(255, 255, 255, 0.6);
  color:#6e707e;
  font-size:20px;
  line-height:1.5;
  text-align:center;
  padding:15%;
}
.plancenteredlg {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background:rgba(255, 255, 255, 0.6);
  color:#6e707e;
  font-size:20px;
  line-height:1.5;
  text-align:center;
  padding:15% 28%;
}
		  </style>
</head>

<body id="page-top" onLoad="getGeolocation()">

    
    <div id="wrapper">

        
        <?php include('sidebar.php');?>
        

        
        <div id="content-wrapper" class="d-flex flex-column">

            
            <div id="content">

                
                <?php include('navbar.php');?>
                

                
                <div class="container-fluid">
				
				
<!---- Start --->
<?php
						$totalcc=0;
						$totalwc=0;
						$totalhc=0;
						$totalquote=0;
						$totalconvert=0;
						$totallost=0;
$count=1;
			  
		$sqlcall = "SELECT consigneetype From jrcconsignee order by id desc";
		$querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
         
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcall > 0) 
		{
			
			while($rowcall = mysqli_fetch_array($querycall)) 
			{
				
						

				if($rowcall['consigneetype']=='Cold Call')
					{
						$totalcc++;
					}
					if($rowcall['consigneetype']=='Warm Call')
					{
						$totalwc++;
					}
					if($rowcall['consigneetype']=='Hot Call')
					{
						$totalhc++;
					}
					
					
					$sqli=mysqli_query($connection, "select compstatus from jrcquotation group by qno, qdate order by id asc");
						}
while($info=mysqli_fetch_array($sqli))
{
	$totalquote++;
	
	if($info['compstatus']=='2')
	{
		$totalconvert++;
	}
}
				
				
?>
<?php

		//$sqlselect = "SELECT count(jc.id) as count, jc.callnature From jrccalls jc, jrcxl jx ".$coustaqu." group by jc.callnature order by count desc";
		$sqlselect = "SELECT  consigneetype,count(consigneetype) as cnt from jrcconsignee group by consigneetype order by id desc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
		


		//$piecolor=array("#FF6C95", "#6F9FF5", "#04DCCB", "#FF9C7F", "#77808F", "#8A61EA");
		//$piecolorhover=array("#FF6C96", "#6F9FF6", "#04DCCC", "#FF9C7E", "#77808E", "#8A61EB");
		
		$piecolor=array("#FF6C95", "#6F9FF5", "#04DCCB", "#FF9C7F", "#77808F", "#8A61EA", "#FF5D68", "#C976DB", "#FEC368", "#02DB9E", "#398CE8", "#767AE3", "#FF7265", "#FEDB02", "#028FFD", "#F0484E");
		$piecolorhover=array("#FF6C96", "#6F9FF6", "#04DCCC", "#FF9C7E", "#77808E", "#8A61EB", "#FF5D69", "#C976DC", "#FEC369", "#02DB9F", "#398CE9", "#767AE4", "#FF7266", "#FEDB03", "#028FFE", "#F0484F");
		$pievalue=array();
		$piename=array();
        if($rowCountselect > 0) 
		{
			$piecount=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				$pievalue[]=(float)$rowselect['cnt'];
				$piename[]=$rowselect['consigneetype'];
				$piecount++;
			}
		}
		?>	



<div class="col-lg-12 mb-3">
			<div class="card shadow" role="button" >
				
				<div class="card-statistic-3 p-3" style="padding-bottom:0px !important">		
				<div class="row">
	
   <div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-phone fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
				<a href="#"><span  class="font-weight-bold text-primary1" style="font-size:1.0rem; line-height:1; text-decoration:underline;">Cold Calls</span></a>
                  <?php
											{
												?><h3 class="mb-2"><?=$totalcc?></h3>
												
                                                
												<?php
											}
											?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	   <div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-phone fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
				<a href="#"><span  class="font-weight-bold text-primary1" style="font-size:1.0rem; line-height:1; text-decoration:underline;">Warm Calls</span></a>
                  <?php
											{
												?><h3 class="mb-2"><?=$totalwc?></h3>
												
                                                
												<?php
											}
											?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-envelope-open fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
                  <a href="#"><span  class="font-weight-bold text-primary1" style="font-size:1.0rem; line-height:1; text-decoration:underline;">Hot Calls</span></a>
                <?php
											{
												?><h3 class="mb-2"><?=$totalwc?></h3>
												
                                                
												<?php
											}
											?>
				  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-phone fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
				<a href="#"><span  class="font-weight-bold text-primary1" style="font-size:1.0rem; line-height:1; text-decoration:underline;">Quotation</span></a>
                  <?php
											{
												?><h3 class="mb-2"><?=$totalquote?></h3>
												
                                                
												<?php
											}
											?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-phone fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
				<a href="#"><span  class="font-weight-bold text-primary1" style="font-size:1.0rem; line-height:1; text-decoration:underline;">Converted</span></a>
                  <?php
											{
												?><h3 class="mb-2"><?=$totalconvert?></h3>
												
                                                
												<?php
											}
											?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-phone fa-2x float-left"></i>
                </div>
                <div class="media-body text-center">
				<a href="#"><span  class="font-weight-bold text-primary1" style="font-size:1.0rem; line-height:1; text-decoration:underline;">Lost</span></a>
                  <?php
											{
												?><h3 class="mb-2"><?=$totallost?></h3>
												
                                                
												<?php
											}
											?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		
		
		
		
		
		
			<div class="col-xl-6 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pie - Chart</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:330px; overflow-y:auto">
								<div class="chart-pie pt-4">
								<div class="chartjs-size-monitor">
								<div class="chartjs-size-monitor-expand">
								<div class=""></div>
								</div>
								<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
								</div>
								</div>
								<canvas id="myPieChart" width="301" height="253" style="display: block; width: 301px; height: 253px;" class="chartjs-render-monitor"></canvas>
                                    </div>
								</div>
								</div>
												   
									
                                </div>
								
								
								  <?php
		  if(isset($_POST['submit']))
		  {
			  $dashfromdate=date('Y-m-d',strtotime($_POST['dashfromdate']));
			  $dashtodate=date('Y-m-d',strtotime($_POST['dashtodate']));
			  $dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashsalesgrandtotalsearch=' and qdate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
		  }
		  else
		  {
			  $dashfromdate='';
			  $dashtodate='';
			  $dashcallonsearch='';
			  $dashsalesgrandtotalsearch='';
		  }
		  $ad=1;
		  $jerobytecolors[$ad]='#3d8eb9';
		  ?>
		             <?php
$totalservicerevenue=0;
$sdate=array();
$samount=array();
$monthsarray=array();
$monthsparray=array();
$montharray=array();
 //$sqli=mysqli_query($connection, "select sum(scahrge) as scahrge, scahrgedate, cashstatus from jrccalldetails where srno!='' and scahrge!='' and scahrge!='0' and scahrge!='0.00' and incgst!='2' and (scahrgedate > now() - INTERVAL 7 MONTH) ".$dashscahrgesearch." group by scahrgedate, cashstatus order by cast(scahrgedate as date) asc");
 //$sqli=mysqli_query($connection, "select sum(salesgrandtotal) as salesgrandtotal, qdate, cashstatus from jrcquotation where srno!='' and salesgrandtotal!='' and salesgrandtotal!='0' and salesgrandtotal!='0.00' and incgst!='2' and (qdate > now() - INTERVAL 7 MONTH) ".$dashsalesgrandtotalsearch." group by qdate, cashstatus order by cast(qdate as date) asc");
 $sqli=mysqli_query($connection, "select salesgrandtotal,sum(salesgrandtotal) as salesgrandtotal2, qdate, sono,sodate from jrcquotation where salesgrandtotal!='' and salesgrandtotal!='0' and (qdate > now() - INTERVAL 12 MONTH) ".$dashsalesgrandtotalsearch." group by qdate order by qdate asc");
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $sdate[]=date('d M',strtotime($infoi['qdate']));
	 $samount[]=$infoi['salesgrandtotal2'];
	 $totalservicerevenue+=(float)$infoi['salesgrandtotal
	 
	 
	 '];

	 $monthsarray[date('Y-m-d',strtotime($infoi['qdate']))]=$infoi['salesgrandtotal2'];
	 $montharray[]=date('M Y',strtotime($infoi['qdate']));
	 if($infoi['sono']!='')
	 {
		 $monthsparray[date('Y-m-d',strtotime($infoi['qdate']))]=$infoi['salesgrandtotal'];
	 }
		else
		{
			$monthsparray[date('Y-m-d',strtotime($infoi['qdate']))]=0;
		}	
 }
$montharray=array_unique($montharray); 
$result1=array(); 

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
					<div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <h6 style="color:#6e707e" class="m-0  "> Monthwise Quotation <span
                                            class="text-primary float-right">( To be Collected: Rs. <span
                                                id="tobecollected"></span> )</span></h6>
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
					<a onclick="alert('Kindly subscribe DIAMOND PLAN to enjoy this Feature. Contact @ 9486781555 or sales@jerobyte.com')"><span class="font-weight-bold" style="color:<?=$jerobytecolors[$ad];?>; font-size:1.0rem; line-height:1; text-decoration:underline; opacity:0.5;">Monthwise Quotation</span></a>
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



<?php

			}
			?>








<!----- End ----->

  
    </div>
     
    </div>
     

     
    <?php include('footer.php') ?>
     
    </div>
     
    </div>
     

     
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a>
     
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
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
	<script>
    // setup 
    const data = {
      labels: [<?php foreach ($montharray as $sd){ echo "'".$sd."',";}?>],
      datasets: [{
        label: 'Total Quotation Value',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result1[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
		backgroundColor: ['rgba(61, 142, 185, 0.8)'],
        borderColor: ['rgba(61, 142, 185, 0.8)'],
        borderWidth: 1
      }, {
        label: 'Total Converted Value',
        data: [
		<?php 
	$i=0;
	foreach ($montharray as $sd)
	{
		echo $result2[date('Y-m',strtotime($sd))].','; 
		$i++;
	}
	
	?>],
        backgroundColor: ['rgba(28, 200, 138, 0.8)'],
        borderColor: ['rgba(28, 200, 138, 0.8)'],
        borderWidth: 1
      }, {
        label: 'Lost Value',
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

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
		  x: {
			  stacked: false
		  },
          y: {
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
	document.getElementById("tobecollected").innerHTML="<?=$tob?>";
    </script>

   
    <script>
    var xValues = [<?php foreach ($sdate as $sd){ echo "'".$sd."',";}?>];
    var yValues = [<?php foreach ($samount as $sa){ echo $sa.',';}?>];
    document.getElementById("totalservicerevenue").innerHTML = '<?=$totalservicerevenue?>';
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
	var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: [<?php foreach($piename as $pname){?>"<?=$pname?>",<?php }?>],
    datasets: [{
      data: [<?php foreach($pievalue as $pvalue){?><?=$pvalue?>,<?php }?>],
      backgroundColor: [<?php for($i=0;$i<$piecount;$i++){?>'<?=$piecolor[$i]?>', <?php } ?>],
      hoverBackgroundColor: [<?php for($i=0;$i<$piecount;$i++){?>'<?=$piecolorhover[$i]?>', <?php } ?>],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#000000",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 0,
  },
});

</script>
	