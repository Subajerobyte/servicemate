<?php
include('lcheck.php'); 

if($callview=='0')
{
	header("location: dashboard.php");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Daily Call Status</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="../../1637028036/vendor/chart.js/Chart.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h4 mb-0 text-gray-800">Daily Call Status </h1>
	
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
<div class="card shadow mb-4">
<div class="card-body">
		  <div class="row align-items-center">
		  <div class="col-lg-12 mb-2">
		  <form class="form-inline" action="callstatus.php" method="post">
  <div class="form-group m-2 mt-1">
    <label for="dashfromdate">From &nbsp; &nbsp;</label>
    <input type="date" class="form-control" id="dashfromdate" name="dashfromdate" value="<?=(isset($_POST['dashfromdate']))?$_POST['dashfromdate']:((isset($_GET['dashfromdate']))?$_GET['dashfromdate']:date('Y-m-01'))?>" required>
  </div>
  <div class="form-group m-2 mt-1">
    <label for="dashtodate">To &nbsp; &nbsp;</label>
    <input type="date" class="form-control" id="dashtodate" name="dashtodate" value="<?=(isset($_POST['dashtodate']))?$_POST['dashtodate']:((isset($_GET['dashtodate']))?$_GET['dashtodate']:date('Y-m-d'))?>" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary m-2 mt-1">GET INFO</button>
  <a href="callstatus.php" class="btn btn-primary m-2 mt-1">RESET</a>
</form>
		  
		  </div>
		  </div>
</div>
</div>
<?php
		  if(isset($_POST['submit']))
		  {
			  $dashfromdate=date('Y-m-d',strtotime($_POST['dashfromdate']));
			  $dashtodate=date('Y-m-d',strtotime($_POST['dashtodate']));
		  }
		  else if(isset($_GET['submit']))
		  {
			  $dashfromdate=date('Y-m-d',strtotime($_GET['dashfromdate']));
			  $dashtodate=date('Y-m-d',strtotime($_GET['dashtodate']));
		  }
		  else
		  {
			  $dashfromdate=date('Y-m-01', time());
			  $dashtodate=date('Y-m-d', time());
		  }
		  
		  ?>
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daily Call Status </h6>
            </div>-->
            <div class="card-body">
			  <div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th rowspan="4">S.No</th>
                      <th rowspan="4">Date</th>
                      <th colspan="6" style="background-color:#FF6C95; color:#ffffff">Opening Status</th>
					  <th colspan="21" style="background-color:#FEC368; color:#000000">Day Status</th>
					  <th colspan="18" style="background-color:#02DB9E; color:#ffffff">Closing Status</th>					  
                    </tr>
					<tr class="text-center">
                      <th rowspan="2" colspan="3" style="background-color:#FF6C95; color:#ffffff">Open</th>
					  <th rowspan="2" colspan="3" style="background-color:#FF6C95; color:#ffffff">Pending</th>
					  <th rowspan="2" colspan="3" style="background-color:#FEC368; color:#000000">Received</th>
					  <th rowspan="2" colspan="3" style="background-color:#FEC368; color:#000000">Pending</th>
					  <th colspan="15" style="background-color:#FEC368; color:#000000">Completed</th>
					  <th colspan="9" style="background-color:#02DB9E; color:#ffffff">Open</th>
					  <th colspan="9" style="background-color:#02DB9E; color:#ffffff">Pending</th>
					  
                    </tr>
					<tr class="text-center">
					  <th colspan="3" style="background-color:#FEC368; color:#000000">From Old</th>
					  <th colspan="3" style="background-color:#FEC368; color:#000000">From Today</th>
					  <th colspan="3" style="background-color:#FEC368; color:#000000">From Old Pending</th>					  
					  <th colspan="3" style="background-color:#FEC368; color:#000000">From Today Pending</th>
					  <th colspan="3" style="background-color:#FEC368; color:#000000">Total</th>
					  <th colspan="3" style="background-color:#02DB9E; color:#ffffff">From Old</th>
					  <th colspan="3" style="background-color:#02DB9E; color:#ffffff">From Today</th>
					  <th colspan="3" style="background-color:#02DB9E; color:#ffffff">Total</th>
					  <th colspan="3" style="background-color:#02DB9E; color:#ffffff">From Old</th>
					  <th colspan="3" style="background-color:#02DB9E; color:#ffffff">From Today</th>
					  <th colspan="3" style="background-color:#02DB9E; color:#ffffff">Total</th>
					  
                    </tr>
					<tr>
					  <th  style="background-color:#FF6C95; color:#ffffff">SC</th>
					  <th  style="background-color:#FF6C95; color:#ffffff">OC</th>
					  <th  style="background-color:#FF6C95; color:#ffffff">TOT</th>
					  <th  style="background-color:#FF6C95; color:#ffffff">SC</th>
					  <th  style="background-color:#FF6C95; color:#ffffff">OC</th>
					  <th  style="background-color:#FF6C95; color:#ffffff">TOT</th>
					  
					  <th  style="background-color:#FEC368; color:#000000">SC</th>
					  <th  style="background-color:#FEC368; color:#000000">OC</th>
					  <th  style="background-color:#FEC368; color:#000000">TOT</th>
					  <th  style="background-color:#FEC368; color:#000000">SC</th>
					  <th  style="background-color:#FEC368; color:#000000">OC</th>
					  <th  style="background-color:#FEC368; color:#000000">TOT</th>
					  
					  <th  style="background-color:#FEC368; color:#000000">SC</th>
					  <th  style="background-color:#FEC368; color:#000000">OC</th>
					  <th  style="background-color:#FEC368; color:#000000">TOT</th>
					  
					  <th  style="background-color:#FEC368; color:#000000">SC</th>
					  <th  style="background-color:#FEC368; color:#000000">OC</th>
					  <th  style="background-color:#FEC368; color:#000000">TOT</th>
					  <th  style="background-color:#FEC368; color:#000000">SC</th>
					  <th  style="background-color:#FEC368; color:#000000">OC</th>
					  <th  style="background-color:#FEC368; color:#000000">TOT</th>
					  <th  style="background-color:#FEC368; color:#000000">SC</th>
					  <th  style="background-color:#FEC368; color:#000000">OC</th>
					  <th  style="background-color:#FEC368; color:#000000">TOT</th>
					  <th  style="background-color:#FEC368; color:#000000">SC</th>
					  <th  style="background-color:#FEC368; color:#000000">OC</th>
					  <th  style="background-color:#FEC368; color:#000000">TOT</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">SC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">OC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">TOT</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">SC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">OC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">TOT</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">SC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">OC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">TOT</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">SC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">OC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">TOT</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">SC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">OC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">TOT</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">SC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">OC</th>
					  <th  style="background-color:#02DB9E; color:#ffffff">TOT</th>
					</tr>
				  </thead>
                  <tbody>
						<?php
						$datefrom=mysqli_real_escape_string($connection, $dashfromdate);
						$dateto=mysqli_real_escape_string($connection, $dashtodate);
						$result=mysqli_query($connection, "SELECT calltype, compstatus, callon, calltid, changeon, pendingon1, pendingon2, pendingon3 From jrccalls order by id asc");
						while($array = mysqli_fetch_assoc($result)){
						  
							$row[] = $array;
						}
						$result1=mysqli_query($connection, "SELECT calltype, compstatus, callon, calltid, changeon From jrccallshistory order by id asc");
						while($array1 = mysqli_fetch_assoc($result1)){
						  
							$row1[] = $array1;
						}
						$oldcalls=0;
							$oldopen=0;
							$oldopeningpending=0;
							$oldpending=0;
							$oldpendingcomplete=0;
							$oldcompleted=0;
							$oldbalance=0;
							$oldpendingbalance=0;
							
							$oldsccalls=0;
							$oldscopen=0;
							$oldscopeningpending=0;
							$oldscpending=0;
							$oldscpendingcomplete=0;
							$oldsccompleted=0;
							$oldscbalance=0;
							$oldscpendingbalance=0;
							
							$oldoccalls=0;
							$oldocopen=0;
							$oldocopeningpending=0;
							$oldocpending=0;
							$oldocpendingcomplete=0;
							$oldoccompleted=0;
							$oldocbalance=0;
							$oldocpendingbalance=0;
							
							foreach($row as $d)
							{
								if($datefrom>date('Y-m-d',strtotime($d['callon'])))
								{
									$oldcalls++;
									if($d['calltype']=='Service Call')
									{
										$oldsccalls++;
									}
									else
									{
										$oldoccalls++;
									}
									
									if($d['compstatus']=='0')
									{
										$oldopen++;
										if($d['calltype']=='Service Call')
										{
											$oldscopen++;
										}
										else
										{
											$oldocopen++;
										}
									}
								}
								if(($datefrom>date('Y-m-d',strtotime($d['changeon'])))&&($d['pendingon1']==''))
								{
									if($d['compstatus']=='2')
									{
										$oldcompleted++;
										if($d['calltype']=='Service Call')
										{
											$oldsccompleted++;
										}
										else
										{
											$oldoccompleted++;
										}
									}
								}
								if((($d['pendingon1']!='')&&($datefrom>date('Y-m-d',strtotime($d['pendingon1'])))))	
								{
									$oldpending++;
									if($d['calltype']=='Service Call')
									{
										$oldscpending++;
									}
									else
									{
										$oldocpending++;
									}
									
									if(($datefrom>date('Y-m-d',strtotime($d['changeon']))))
									{
										if($d['compstatus']=='2')
										{
											$oldpendingcomplete++;
											if($d['calltype']=='Service Call')
											{
												$oldscpendingcomplete++;
											}
											else
											{
												$oldocpendingcomplete++;
											}
										}
									}
								}								
							}
							
							$oldbalance=($oldcalls)-(($oldcompleted+$oldpendingcomplete)+($oldpending-$oldpendingcomplete));
							$oldpendingbalance=$oldpending-$oldpendingcomplete;
							
							$oldscbalance=($oldsccalls)-(($oldsccompleted+$oldscpendingcomplete)+($oldscpending-$oldscpendingcomplete));
							$oldscpendingbalance=$oldscpending-$oldscpendingcomplete;
							
							$oldocbalance=($oldoccalls)-(($oldoccompleted+$oldocpendingcomplete)+($oldocpending-$oldocpendingcomplete));
							$oldocpendingbalance=$oldocpending-$oldocpendingcomplete;
						?>
						<tr>
							  <td></td>
							  <td>Opening</td>
							  <td style="background-color:#ffcbda" class="text-center"><?=$oldsccalls-$oldscpending?></td>
							  <td style="background-color:#ffcbda" class="text-center"><?=$oldoccalls-$oldocpending?></td>
							  <td style="background-color:#ffcbda" class="text-center"><?=$oldcalls-$oldpending?></td>
							  <td style="background-color:#ffcbda" class="text-center"><?=$oldscpending?></td>
							  <td style="background-color:#ffcbda" class="text-center"><?=$oldocpending?></td>
							  <td style="background-color:#ffcbda" class="text-center"><?=$oldpending?></td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=$oldsccompleted?></td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=$oldoccompleted?></td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=$oldcompleted?></td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=$oldscpendingcomplete?></td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=$oldocpendingcomplete?></td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=$oldpendingcomplete?></td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center">0</td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=($oldsccompleted+$oldscpendingcomplete)?></td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=($oldoccompleted+$oldocpendingcomplete)?></td>
							  <td style="background-color:#ffe4ba" class="text-center"><?=($oldcompleted+$oldpendingcomplete)?></td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldscbalance?></td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldocbalance?></td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldbalance?></td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldscbalance?></td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldocbalance?></td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldbalance?></td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center">0</td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldscpendingbalance?></td>
						      <td style="background-color:#cafff0" class="text-center"><?=$oldocpendingbalance?></td>
							  <td style="background-color:#cafff0" class="text-center"><?=$oldpendingbalance?></td>							  
							</tr>
						<?php						
						$count=1;
						while(strtotime($datefrom) <= strtotime($dateto))
						{
							$todaycalls=0;
							$todayopen=0;
							$todayopeningpending=0;
							$todaypending=0;
							$todayoldcompleted=0;
							$todaynewcompleted=0;
							$todaypendingcompleted=0;
							$todaycompleted=0;
							$todayoldbalance=0;
							$todaynewbalance=0;
							$todaybalance=0;
							$todaypendingbalance=0;							
							$todaypendingtodaycomplete=0;
							$oldpendingtodaycomplete=0;
							
							$todaysccalls=0;
							$todayscopen=0;
							$todayscopeningpending=0;
							$todayscpending=0;
							$todayscoldcompleted=0;
							$todayscnewcompleted=0;
							$todayscpendingcompleted=0;
							$todaysccompleted=0;
							$todayscoldbalance=0;
							$todayscnewbalance=0;
							$todayscbalance=0;
							$todayscpendingbalance=0;							
							$todayscpendingtodaysccomplete=0;
							$oldscpendingtodaysccomplete=0;							
							
							$todayoccalls=0;
							$todayocopen=0;
							$todayocopeningpending=0;
							$todayocpending=0;
							$todayocoldcompleted=0;
							$todayocnewcompleted=0;
							$todayocpendingcompleted=0;
							$todayoccompleted=0;
							$todayocoldbalance=0;
							$todayocnewbalance=0;
							$todayocbalance=0;
							$todayocpendingbalance=0;							
							$todayocpendingtodayoccomplete=0;
							$oldocpendingtodayoccomplete=0;
							
							foreach($row as $d)
							{
								if($datefrom==date('Y-m-d',strtotime($d['callon'])))
								{
									$todaycalls++;
									if($d['calltype']=='Service Call')
									{
										$todaysccalls++;
									}
									else
									{
										$todayoccalls++;
									}
									if($d['compstatus']=='0')
									{
										$todayopen++;
										if($d['calltype']=='Service Call')
										{
											$todayscopen++;
										}
										else
										{
											$todayocopen++;
										}										
									}
								}
								if($datefrom==date('Y-m-d',strtotime($d['changeon'])))
								{
									if($d['compstatus']=='2')
									{
										$todaycompleted++;
										if($d['calltype']=='Service Call')
										{
											$todaysccompleted++;
										}
										else
										{
											$todayoccompleted++;
										}
									}
								}
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($d['pendingon1']!=''))
								{
									if($d['compstatus']=='2')
									{
										$todaypendingcompleted++;
										if($d['calltype']=='Service Call')
										{
											$todayscpendingcompleted++;
										}
										else
										{
											$todayocpendingcompleted++;
										}
										
										if((($d['pendingon1']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon1'])))))	
										{
											$todaypendingtodaycomplete++;
											if($d['calltype']=='Service Call')
											{
												$todayscpendingtodaysccomplete++;
											}
											else
											{
												$todayocpendingtodayoccomplete++;
											}
										}
										else
										{
											$oldpendingtodaycomplete++;
											if($d['calltype']=='Service Call')
											{
												$oldscpendingtodaysccomplete++;
											}
											else
											{
												$oldocpendingtodayoccomplete++;
											}
										}
									}
								}
								
								
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($datefrom!=date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']==''))
								{
									if($d['compstatus']=='2')
									{
										$todayoldcompleted++;
										if($d['calltype']=='Service Call')
										{
											$todayscoldcompleted++;
										}
										else
										{
											$todayocoldcompleted++;
										}
									}
								}
								if(($datefrom==date('Y-m-d',strtotime($d['changeon'])))&&($datefrom==date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']==''))
								{
									if($d['compstatus']=='2')
									{
										$todaynewcompleted++;
										if($d['calltype']=='Service Call')
										{
											$todayscnewcompleted++;
										}
										else
										{
											$todayocnewcompleted++;
										}
									}
								}
								if((($d['pendingon1']!='')&&($datefrom==date('Y-m-d',strtotime($d['pendingon1'])))))	
								{
									$todaypending++;
									if($d['calltype']=='Service Call')
									{
										$todayscpending++;
									}
									else
									{
										$todayocpending++;
									}
								}
							}
							$todayoldbalance=$oldbalance-$todayoldcompleted;
							$todaynewbalance=$todaycalls-$todaynewcompleted;
							$todaybalance=($todaycalls+$oldbalance)-($todaycompleted+($todaypending-$todaypendingcompleted));
							$todaypendingbalance=$oldpendingbalance+($todaypending-$todaypendingcompleted);							
							
							$balanceoldpending=$oldpendingbalance-$oldpendingtodaycomplete;
							$balancetodaypending=$todaypending-$todaypendingtodaycomplete;
							
							//sc
							$todayscoldbalance=$oldscbalance-$todayscoldcompleted;
							$todayscnewbalance=$todaysccalls-$todayscnewcompleted;
							$todayscbalance=($todaysccalls+$oldscbalance)-($todaysccompleted+($todayscpending-$todayscpendingcompleted));
							$todayscpendingbalance=$oldscpendingbalance+($todayscpending-$todayscpendingcompleted);							
							
							$balanceoldscpending=$oldscpendingbalance-$oldscpendingtodaysccomplete;
							$balancetodayscpending=$todayscpending-$todayscpendingtodaysccomplete;
							//oc
							$todayocoldbalance=$oldocbalance-$todayocoldcompleted;
							$todayocnewbalance=$todayoccalls-$todayocnewcompleted;
							$todayocbalance=($todayoccalls+$oldocbalance)-($todayoccompleted+($todayocpending-$todayocpendingcompleted));
							$todayocpendingbalance=$oldocpendingbalance+($todayocpending-$todayocpendingcompleted);							
							
							$balanceoldocpending=$oldocpendingbalance-$oldocpendingtodayoccomplete;
							$balancetodayocpending=$todayocpending-$todayocpendingtodayoccomplete;
							
							
							?>
							<tr>
							  <td><?=$count?></td>
							  <td><?=date('d/m/Y',strtotime($datefrom))?></td>
							  <td style="background-color:#ffcbda" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldscbalance&nos=<?=$oldscbalance?>" target="_blank" style="color:#000000"><?=$oldscbalance?></a></td>
							  <td style="background-color:#ffcbda" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldocbalance&nos=<?=$oldocbalance?>" target="_blank" style="color:#000000"><?=$oldocbalance?></a></td>
							  <td style="background-color:#ffcbda" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldbalance&nos=<?=$oldbalance?>" target="_blank" style="color:#000000"><?=$oldbalance?></a></td>
							  
							  <td style="background-color:#ffcbda" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldscpendingbalance&nos=<?=$oldscpendingbalance?>" target="_blank" style="color:#000000"><?=$oldscpendingbalance?></a></td>
							  <td style="background-color:#ffcbda" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldocpendingbalance&nos=<?=$oldocpendingbalance?>" target="_blank" style="color:#000000"><?=$oldocpendingbalance?></a></td>
							  <td style="background-color:#ffcbda" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldpendingbalance&nos=<?=$oldpendingbalance?>" target="_blank" style="color:#000000"><?=$oldpendingbalance?></a></td>
							  
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaysccalls&nos=<?=$todaysccalls?>" target="_blank" style="color:#000000"><?=$todaysccalls?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayoccalls&nos=<?=$todayoccalls?>" target="_blank" style="color:#000000"><?=$todayoccalls?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaycalls&nos=<?=$todaycalls?>" target="_blank" style="color:#000000"><?=$todaycalls?></a></td>
							  
							  
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscpending&nos=<?=$todayscpending?>" target="_blank" style="color:#000000"><?=$todayscpending?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocpending&nos=<?=$todayocpending?>" target="_blank" style="color:#000000"><?=$todayocpending?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaypending&nos=<?=$todaypending?>" target="_blank" style="color:#000000"><?=$todaypending?></a></td>
							  
							  
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscoldcompleted&nos=<?=$todayscoldcompleted?>" target="_blank" style="color:#000000"><?=$todayscoldcompleted?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocoldcompleted&nos=<?=$todayocoldcompleted?>" target="_blank" style="color:#000000"><?=$todayocoldcompleted?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayoldcompleted&nos=<?=$todayoldcompleted?>" target="_blank" style="color:#000000"><?=$todayoldcompleted?></a></td>
							  
							  
							  
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscnewcompleted&nos=<?=$todayscnewcompleted?>" target="_blank" style="color:#000000"><?=$todayscnewcompleted?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocnewcompleted&nos=<?=$todayocnewcompleted?>" target="_blank" style="color:#000000"><?=$todayocnewcompleted?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaynewcompleted&nos=<?=$todaynewcompleted?>" target="_blank" style="color:#000000"><?=$todaynewcompleted?></a></td>
							  
							  
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldscpendingtodaysccomplete&nos=<?=$oldscpendingtodaysccomplete?>" target="_blank" style="color:#000000"><?=$oldscpendingtodaysccomplete?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldocpendingtodayoccomplete&nos=<?=$oldocpendingtodayoccomplete?>" target="_blank" style="color:#000000"><?=$oldocpendingtodayoccomplete?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=oldpendingtodaycomplete&nos=<?=$oldpendingtodaycomplete?>" target="_blank" style="color:#000000"><?=$oldpendingtodaycomplete?></a></td>
							  
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscpendingtodaysccomplete&nos=<?=$todayscpendingtodaysccomplete?>" target="_blank" style="color:#000000"><?=$todayscpendingtodaysccomplete?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocpendingtodayoccomplete&nos=<?=$todayocpendingtodayoccomplete?>" target="_blank" style="color:#000000"><?=$todayocpendingtodayoccomplete?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaypendingtodaycomplete&nos=<?=$todaypendingtodaycomplete?>" target="_blank" style="color:#000000"><?=$todaypendingtodaycomplete?></a></td>
							  
							  
							  
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaysccompleted&nos=<?=$todaysccompleted?>" target="_blank" style="color:#000000"><?=$todaysccompleted?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayoccompleted&nos=<?=$todayoccompleted?>" target="_blank" style="color:#000000"><?=$todayoccompleted?></a></td>
							  <td style="background-color:#ffe4ba" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaycompleted&nos=<?=$todaycompleted?>" target="_blank" style="color:#000000"><?=$todaycompleted?></a></td>
							  
							  
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscoldbalance&nos=<?=$todayscoldbalance?>" target="_blank" style="color:#000000"><?=$todayscoldbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocoldbalance&nos=<?=$todayocoldbalance?>" target="_blank" style="color:#000000"><?=$todayocoldbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayoldbalance&nos=<?=$todayoldbalance?>" target="_blank" style="color:#000000"><?=$todayoldbalance?></a></td>
							  
							  
							  
							  
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscnewbalance&nos=<?=$todayscnewbalance?>" target="_blank" style="color:#000000"><?=$todayscnewbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocnewbalance&nos=<?=$todayocnewbalance?>" target="_blank" style="color:#000000"><?=$todayocnewbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaynewbalance&nos=<?=$todaynewbalance?>" target="_blank" style="color:#000000"><?=$todaynewbalance?></a></td>
							  
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscbalance&nos=<?=$todayscbalance?>" target="_blank" style="color:#000000"><?=$todayscbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocbalance&nos=<?=$todayocbalance?>" target="_blank" style="color:#000000"><?=$todayocbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaybalance&nos=<?=$todaybalance?>" target="_blank" style="color:#000000"><?=$todaybalance?></a></td>
							  
							  
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=balanceoldscpending&nos=<?=$balanceoldscpending?>" target="_blank" style="color:#000000"><?=$balanceoldscpending?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=balanceoldocpending&nos=<?=$balanceoldocpending?>" target="_blank" style="color:#000000"><?=$balanceoldocpending?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=balanceoldpending&nos=<?=$balanceoldpending?>" target="_blank" style="color:#000000"><?=$balanceoldpending?></a></td>
							  
							  
							  
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=balancetodayscpending&nos=<?=$balancetodayscpending?>" target="_blank" style="color:#000000"><?=$balancetodayscpending?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=balancetodayocpending&nos=<?=$balancetodayocpending?>" target="_blank" style="color:#000000"><?=$balancetodayocpending?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=balancetodaypending&nos=<?=$balancetodaypending?>" target="_blank" style="color:#000000"><?=$balancetodaypending?></a></td>
							  
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayscpendingbalance&nos=<?=$todayscpendingbalance?>" target="_blank" style="color:#000000"><?=$todayscpendingbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todayocpendingbalance&nos=<?=$todayocpendingbalance?>" target="_blank" style="color:#000000"><?=$todayocpendingbalance?></a></td>
							  <td style="background-color:#cafff0" class="text-center"><a href="callsdetails.php?fdate=<?=$datefrom?>&type=todaypendingbalance&nos=<?=$todaypendingbalance?>" target="_blank" style="color:#000000"><?=$todaypendingbalance?></a></td>
							</tr>
							<?php
							$oldbalance=$todaybalance;
							$oldpendingbalance=$todaypendingbalance;
							$datefrom = date("Y-m-d", strtotime("+1 days", strtotime($datefrom)));
							$count++;
						}
						?>
					
                  </tbody>
                </table>
              </div>
            </div>
			 </div>
			<?php
			
			
		  
		  $staqu="";
			if(isset($_POST['submit']))
		  { 
			  
			  $dashfromdate=date('Y-m-d',strtotime($_POST['dashfromdate']));
			  $dashtodate=date('Y-m-d',strtotime($_POST['dashtodate']));
			  $dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  
			  if($staqu!="")
				{
					$staqu.=' and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				else
				{
					$staqu.=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
		  }
		  else if(isset($_GET['submit']))
		  { 
			  
			  $dashfromdate=date('Y-m-d',strtotime($_GET['dashfromdate']));
			  $dashtodate=date('Y-m-d',strtotime($_GET['dashtodate']));
			  $dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  
			  if($staqu!="")
				{
					$staqu.=' and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				else
				{
					$staqu.=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
		  }
		  else
		  {
			  $dashfromdate=date('Y-m-01');
			  $dashtodate=date('Y-m-t');
			  $dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  
			  if($staqu!="")
				{
					$staqu.=' and callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				else
				{
					$staqu.=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
			  
			  
		  }
			?>
			     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Call History </h6>
            </div>
            <div class="card-body">
			  <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID and Date</th>
                      <th>Call Details</th>
                      <th>Type Details</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Problem Details</th>
					  <th>Status</th>
					  <?php
					  if($calledit=='1')
					  {
						?>  
					  <th>Action</th>
					  <?php
					  }
					  ?>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				 
		$sqlselect = "SELECT sourceid, callfrom, callon, calltid, acknowlodge, compstatus, changeon, id, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid,engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, callnature, customernature, businesstype, servicetype, calltype, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid From jrccalls ".$staqu." order by id desc";
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
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				
					$rowxl = mysqli_fetch_array($queryxl);
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				  $sqlcons = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$rowxl['consigneeid']."' order by consigneename asc";
				  
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
                      <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
					  <br>
					  <?=$rowselect['callfrom']?><br>
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
					  <?php
					  
					  if($rowselect['engineertype']=='1')
					  {
						  if($rowselect['engineersname']!='')
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
						   <a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-danger blink">Assign Engineer</a>
						   <?php
					  }
					  }
					  else
					  {
						  if($rowselect['engineername']!='')
					  {
						?>
						E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
						  <?php
						  											  }
					  else
					  {
						  ?>
						  <a href="callsmodify.php?id=<?=$rowselect['id']?>" class="text-danger blink">Assign Engineer</a>
						   <?php
					  }
					  }
					  ?>
					   <br>
					  <?php
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
					  <td>
					  <?php
					 if($rowselect['businesstype']!='')
					 {
							 ?>
						   <span class="text-success text-bold"><?=$rowselect['businesstype']?></span><br>
						   <?php						  
					 } 
					 if($rowselect['servicetype']!='')
					 {
							 ?>
						   <span class="text-danger text-bold"><?=$rowselect['servicetype']?></span><br>
						   <?php						  
					 } 
					  if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="text-info text-bold"><?=$rowselect['customernature']?></span><br>
						   <?php						  
					 }
					 if($rowselect['callnature']!='')
					 {
							 ?>
						   <span class="text-primary text-bold"><?=$rowselect['callnature']?></span><br>
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
					  if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
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
					  <?php
					  if($calledit=='1')
					  {
						 if($rowselect['compstatus']!='2')
						  { 
					  if($rowselect['compstatus']=='0')
					  { 
				       ?>
					  <td><a href="callsedit.php?id=<?=$rowselect['id']?>&rd=open">Edit</a></td>
					  <?php	
					  }
					  else
					  {
					  ?>
					  <td><a href="callsedit.php?id=<?=$rowselect['id']?>&rd=pending">Edit</a></td>
					  <?php	
					  }				
						  }
						  else
						  {
							  ?>
							  <td></td>
							  <?php
						  }
					  }
					  ?>
                    </tr>
					<?php
					$datefrom = date("Y-m-d", strtotime("+1 days", strtotime($datefrom)));
					$count++;
			}
		}
			?>
					
                  </tbody>
                </table>
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
                <h5 class="modal-title">Daily Call Status</h5>
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
<script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> 
<script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
  });
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
