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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Call History</title>

  
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
<?php
$statitle="";
$staqu="";
if(isset($_GET['status']))
{
	if($_GET['status']=='2')
	{
		$statitle=" - Completed";
		$staqu=" where compstatus='2'";
	}
	else if($_GET['status']=='1')
	{
		$statitle=" - Pending";
		$staqu=" where compstatus='1'";
	}
	else
	{
		$statitle=" - Open";
		$staqu=" where compstatus='0'";
	}
}
?>
<div class="row">
          <!-- Page Heading -->
<div class="col-lg-6 mb-4">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Call Status - History </h1>
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
<?php
$staqu="";
if((isset($_GET['type']))&&(isset($_GET['fdate'])))
{
	if(($_GET['type']!='')&&($_GET['fdate']!=''))
	{
		$fdate=mysqli_real_escape_string($connection, $_GET['fdate']);
		$type=mysqli_real_escape_string($connection, $_GET['type']);
		
		$result=mysqli_query($connection, "SELECT id, calltype, compstatus, callon, calltid, changeon, pendingon1, pendingon2, pendingon3 From jrccalls order by id asc");
		while($array = mysqli_fetch_assoc($result))
		{
			$row[] = $array;
		}		
		
			$oldcalls=array();
			$oldopen=array();
			$oldopeningpending=array();
			$oldpending=array();
			$oldpendingcomplete=array();
			$oldcompleted=array();
			$oldbalance=array();
			$oldpendingbalance=array();
			
			
			$oldsccalls=array();
			$oldscopen=array();
			$oldscopeningpending=array();
			$oldscpending=array();
			$oldscpendingcomplete=array();
			$oldsccompleted=array();
			$oldscbalance=array();
			$oldscpendingbalance=array();
			
			$oldoccalls=array();
			$oldocopen=array();
			$oldocopeningpending=array();
			$oldocpending=array();
			$oldocpendingcomplete=array();
			$oldoccompleted=array();
			$oldocbalance=array();
			$oldocpendingbalance=array();
			
			foreach($row as $d)
			{
				if($fdate>date('Y-m-d',strtotime($d['callon'])))
				{
					$oldcalls[]=$d['id'];
					if($d['calltype']=='Service Call')
					{
						$oldsccalls[]=$d['id'];
					}
					else
					{
						$oldoccalls[]=$d['id'];
					}
					if($d['compstatus']=='0')
					{
						$oldopen[]=$d['id'];
						if($d['calltype']=='Service Call')
						{
							$oldscopen[]=$d['id'];
						}
						else
						{
							$oldocopen[]=$d['id'];
						}
					}
				}
				if(($fdate>date('Y-m-d',strtotime($d['changeon'])))&&($d['pendingon1']==''))
				{
					if($d['compstatus']=='2')
					{
						$oldcompleted[]=$d['id'];
						if($d['calltype']=='Service Call')
						{
							$oldsccompleted[]=$d['id'];
						}
						else
						{
							$oldoccompleted[]=$d['id'];
						}
					}
				}

				if((($d['pendingon1']!='')&&($fdate>date('Y-m-d',strtotime($d['pendingon1'])))))	
				{
					$oldpending[]=$d['id'];	
					if($d['calltype']=='Service Call')
					{
						$oldscpending[]=$d['id'];
					}
					else
					{
						$oldocpending[]=$d['id'];
					}					
					if(($fdate>date('Y-m-d',strtotime($d['changeon']))))
					{
						if($d['compstatus']=='2')
						{
							$oldpendingcomplete[]=$d['id'];
							if($d['calltype']=='Service Call')
							{
								$oldscpendingcomplete[]=$d['id'];
							}
							else
							{
								$oldocpendingcomplete[]=$d['id'];
							}
						}
					}
				}				
			}
			$mcomplete=array_merge($oldcompleted,$oldpendingcomplete);
			$mpending = array_diff($oldpending, $oldpendingcomplete);
			$m1complete=array_merge($mcomplete,$mpending);
			$oldbalance = array_diff($oldcalls, $m1complete);			
			$oldpendingbalance = array_diff($oldpending, $oldpendingcomplete);	
			
			
			$msccomplete=array_merge($oldsccompleted,$oldscpendingcomplete);
			$mscpending = array_diff($oldscpending, $oldscpendingcomplete);
			$msc1complete=array_merge($msccomplete,$mscpending);
			$oldscbalance = array_diff($oldsccalls, $msc1complete);			
			$oldscpendingbalance = array_diff($oldscpending, $oldscpendingcomplete);	
			
			
			$moccomplete=array_merge($oldoccompleted,$oldocpendingcomplete);
			$mocpending = array_diff($oldocpending, $oldocpendingcomplete);
			$moc1complete=array_merge($moccomplete,$mocpending);
			$oldocbalance = array_diff($oldoccalls, $moc1complete);			
			$oldocpendingbalance = array_diff($oldocpending, $oldocpendingcomplete);	



			$todaycalls=array();
			$todayopen=array();
			$todayopeningpending=array();
			$todaypending=array();
			$todayoldcompleted=array();
			$todaynewcompleted=array();
			$todaypendingcompleted=array();
			$todaycompleted=array();
			$todayoldbalance=array();
			$todaynewbalance=array();
			$todaybalance=array();
			$todaypendingbalance=array();
			$todaypendingtodaycomplete=array();
			$oldpendingtodaycomplete=array();
			
			$todaysccalls=array();
			$todayscopen=array();
			$todayscopeningpending=array();
			$todayscpending=array();
			$todayscoldcompleted=array();
			$todayscnewcompleted=array();
			$todayscpendingcompleted=array();
			$todaysccompleted=array();
			$todayscoldbalance=array();
			$todayscnewbalance=array();
			$todayscbalance=array();
			$todayscpendingbalance=array();
			$todayscpendingtodaysccomplete=array();
			$oldscpendingtodaysccomplete=array();
			
			$todayoccalls=array();
			$todayocopen=array();
			$todayocopeningpending=array();
			$todayocpending=array();
			$todayocoldcompleted=array();
			$todayocnewcompleted=array();
			$todayocpendingcompleted=array();
			$todayoccompleted=array();
			$todayocoldbalance=array();
			$todayocnewbalance=array();
			$todayocbalance=array();
			$todayocpendingbalance=array();
			$todayocpendingtodayoccomplete=array();
			$oldocpendingtodayoccomplete=array();
			
			
			

			foreach($row as $d)
			{
			if($fdate==date('Y-m-d',strtotime($d['callon'])))
			{
				$todaycalls[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$todaysccalls[]=$d['id'];
				}
				else
				{
					$todayoccalls[]=$d['id'];
				}
				if($d['compstatus']=='0')
				{
					$todayopen[]=$d['id'];
					if($d['calltype']=='Service Call')
					{
						$todayscopen[]=$d['id'];
					}
					else
					{
						$todayocopen[]=$d['id'];
					}
				}
			}
			if($fdate==date('Y-m-d',strtotime($d['changeon'])))
			{
			if($d['compstatus']=='2')
			{
				$todaycompleted[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$todaysccompleted[]=$d['id'];
				}
				else
				{
					$todayoccompleted[]=$d['id'];
				}
			}
			}
			if(($fdate==date('Y-m-d',strtotime($d['changeon'])))&&($d['pendingon1']!=''))
			{
			if($d['compstatus']=='2')
			{
			$todaypendingcompleted[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$todayscpendingcompleted[]=$d['id'];
				}
				else
				{
					$todayocpendingcompleted[]=$d['id'];
				}


			if((($d['pendingon1']!='')&&($fdate==date('Y-m-d',strtotime($d['pendingon1'])))))
			{
			$todaypendingtodaycomplete[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$todayscpendingtodaysccomplete[]=$d['id'];
				}
				else
				{
					$todaypendingtodaycomplete[]=$d['id'];
				}
			}
			else
			{
				$oldpendingtodaycomplete[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$oldscpendingtodaysccomplete[]=$d['id'];
				}
				else
				{
					$oldocpendingtodaysccomplete[]=$d['id'];
				}
			}
			}
			}


			if(($fdate==date('Y-m-d',strtotime($d['changeon'])))&&($fdate!=date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']==''))
			{
			if($d['compstatus']=='2')
			{
			$todayoldcompleted[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$todayscoldcompleted[]=$d['id'];
				}
				else
				{
					$todayocoldcompleted[]=$d['id'];
				}
			}
			}
			if(($fdate==date('Y-m-d',strtotime($d['changeon'])))&&($fdate==date('Y-m-d',strtotime($d['callon'])))&&($d['pendingon1']==''))
			{
			if($d['compstatus']=='2')
			{
			$todaynewcompleted[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$todayscnewcompleted[]=$d['id'];
				}
				else
				{
					$todayocnewcompleted[]=$d['id'];
				}
			}
			}

			if((($d['pendingon1']!='')&&($fdate==date('Y-m-d',strtotime($d['pendingon1'])))))
			{
			$todaypending[]=$d['id'];
				if($d['calltype']=='Service Call')
				{
					$todayscpending[]=$d['id'];
				}
				else
				{
					$todayocpending[]=$d['id'];
				}
			}
			}
			
			$todayoldbalance=array_diff($oldbalance, $todayoldcompleted);
			$todaynewbalance=array_diff($todaycalls, $todaynewcompleted);			
			$mdiff1=array_diff($todaypending, $todaypendingcompleted);
			$mmerge2=array_merge($todaycompleted, $mdiff1);			
			$mmerge3=array_merge($todaycalls, $oldbalance);			
			$todaybalance=array_diff($mmerge3, $mmerge2);
			$todaypendingbalance=array_merge($oldpendingbalance, $mdiff1);			
			$balanceoldpending=array_diff($oldpendingbalance, $oldpendingtodaycomplete);
			$balancetodaypending=array_diff($todaypending, $todaypendingtodaycomplete);
			
			
			$todayscoldbalance=array_diff($oldscbalance, $todayscoldcompleted);
			$todayscnewbalance=array_diff($todaysccalls, $todayscnewcompleted);			
			$mscdiff1=array_diff($todayscpending, $todayscpendingcompleted);
			$mscmerge2=array_merge($todaysccompleted, $mscdiff1);			
			$mscmerge3=array_merge($todaysccalls, $oldscbalance);			
			$todayscbalance=array_diff($mscmerge3, $mscmerge2);
			$todayscpendingbalance=array_merge($oldscpendingbalance, $mscdiff1);			
			$balanceoldpending=array_diff($oldscpendingbalance, $oldscpendingtodaysccomplete);
			$balancetodayscpending=array_diff($todayscpending, $todayscpendingtodaysccomplete);
			
			$todayocoldbalance=array_diff($oldocbalance, $todayocoldcompleted);
			$todayocnewbalance=array_diff($todayoccalls, $todayocnewcompleted);			
			$mocdiff1=array_diff($todayocpending, $todayocpendingcompleted);
			$mocmerge2=array_merge($todayoccompleted, $mocdiff1);			
			$mocmerge3=array_merge($todayoccalls, $oldocbalance);			
			$todayocbalance=array_diff($mocmerge3, $mocmerge2);
			$todayocpendingbalance=array_merge($oldocpendingbalance, $mocdiff1);			
			$balanceoldpending=array_diff($oldocpendingbalance, $oldocpendingtodayoccomplete);
			$balancetodayocpending=array_diff($todayocpending, $todayocpendingtodayoccomplete);

			
		
		if($type=='oldopenbalance')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Old Opening Balance - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($oldbalance))
			{
				$ids="";
				foreach($oldbalance as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='oldpendingbalance')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Old Pending Balance - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($oldpendingbalance))
			{
				$ids="";
				foreach($oldpendingbalance as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaycalls')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Calls - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaycalls))
			{
				$ids="";
				foreach($todaycalls as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaypending')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Pending Calls - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaypending))
			{
				$ids="";
				foreach($todaypending as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todayoldcompleted')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Completed Calls from Old Calls - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todayoldcompleted))
			{
				$ids="";
				foreach($todayoldcompleted as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaynewcompleted')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Completed Calls from New Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaynewcompleted))
			{
				$ids="";
				foreach($todaynewcompleted as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaypendingcompleted')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Completed Calls from Pending Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaypendingcompleted))
			{
				$ids="";
				foreach($todaypendingcompleted as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaycompleted')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Completed Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaycompleted))
			{
				$ids="";
				foreach($todaycompleted as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todayoldbalance')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Closing Open Calls from Old Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todayoldbalance))
			{
				$ids="";
				foreach($todayoldbalance as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaynewbalance')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Closing Open Calls from New Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaynewbalance))
			{
				$ids="";
				foreach($todaynewbalance as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaybalance')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Closing Open Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaybalance))
			{
				$ids="";
				foreach($todaybalance as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='balanceoldpending')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Closing Pending Calls from Old Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($balanceoldpending))
			{
				$ids="";
				foreach($balanceoldpending as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='balancetodaypending')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Closing Pending Calls from New Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($balancetodaypending))
			{
				$ids="";
				foreach($balancetodaypending as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		if($type=='todaypendingbalance')
		{
			?>
			<h5><?=date('d/m/Y', strtotime($fdate))?> - Today Closing Pending Calls  - <?=$_GET['nos']?></h5><br>
			<?php	
			if(!empty($todaypendingbalance))
			{
				$ids="";
				foreach($todaypendingbalance as $mb)
				{
					if($ids!='')
					{
						$ids.=','.$mb;
					}
					else
					{
						$ids.=''.$mb;
					}
				}
				if($ids!="")
				{
					$staqu=" where id in (".$ids.")";
				}
				else
				{
					$staqu=" where id=''";
				}
			}
			else
			{
				$staqu=" where id=''";
			}			
		}
		////
		
		
		
		
	}
}
?>

          <div class="card shadow mb-4">
            <div class="card-body">
			  <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID and Date</th>
                      <th>Call Details</th>
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
							  ?>
							  <td><a href="callsedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
							  <?php						
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
       

       
      <?php include('footer.php'); ?>
       

    </div>
     

  </div>
   

   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>
<!--Modal starts Here-->
<div class="modal fade" id="dynamicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Call History</h5>
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
  });
   function searchhistory(id)
   {
        var id=id;
        
        $.ajax({
            url:"searchcallhistory.php",
            method:"post",
            data:{id:id},
            success:function(response){
                $("#callhistorybody").html(response);
                $("#dynamicModal").modal('show'); 
            }
        }) 
    }
</script>
<?php include('additionaljs.php');   ?>
</body>

</html>
