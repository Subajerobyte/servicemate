<?php
include('lcheck.php'); 

if($callview=='0')
{
	header("location: dashboard.php");
}
if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
{
}
else
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - In-House Calls</title>

  
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
<?php
$statitle="";
$staqu=" where ((servicetype='Carry-In'))";
if(isset($_GET['status']))
{
	if($_GET['status']=='2')
	{
		$statitle="Completed";

		if($staqu!="")
		{
			$staqu.=" and compstatus='2'";
		}
		else
		{
			$staqu.=" where compstatus='2'";
		}	
	}
	else if($_GET['status']=='1')
	{
		$statitle="Pending";
		if($staqu!="")
		{
			$staqu.=" and compstatus='1'";
		}
		else
		{
			$staqu.=" where compstatus='1'";
		}
	}
	else if($_GET['status']=='3')
	{
		$statitle="Cancelled";
		if($staqu!="")
		{
			$staqu.=" and compstatus='3'";
		}
		else
		{
			$staqu.=" where compstatus='3'";
		}
	}
	else
	{
		$statitle="Open";
		if($staqu!="")
		{
			$staqu.=" and compstatus='0'";
		}
		else
		{
			$staqu.=" where compstatus='0'";
		}
	}
}
?>
          <!-- Page Heading -->
<?php
if(isset($_GET['prob']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['prob']);
	if($staqu!="")
	{
		$staqu.=" and reportedproblem='".$prob."'";
	}
	else
	{
		$staqu.=" where reportedproblem='".$prob."'";
	}	
}
if(isset($_GET['action']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['action']);
	if($staqu!="")
	{
		$staqu.=" and actiontaken='".$prob."'";
	}
	else
	{
		$staqu.=" where actiontaken='".$prob."'";
	}	
}
if(isset($_GET['ctype']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['ctype']);
	if($staqu!="")
	{
		$staqu.=" and calltype='".$prob."'";
	}
	else
	{
		$staqu.=" where calltype='".$prob."'";
	}	
}
if(isset($_GET['nature']))
{
	$prob=mysqli_real_escape_string($connection, $_GET['nature']);
	if($staqu!="")
	{
		$staqu.=" and callnature='".$prob."'";
	}
	else
	{
		$staqu.=" where callnature='".$prob."'";
	}	
}
?>
<?php
          $godownname='';
		  if(isset($_POST['submit']))
			  
		  {
			  $reportrange=mysqli_real_escape_string($connection,$_POST['reportrange']);

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
			  $dashcallonsearch=' where callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  $dashschargesearch=' and schargedate between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
			  
			  if($staqu!="")
				{
					$staqu.=' and  callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				else
				{
					$staqu.=' where  callon between "'.$dashfromdate.' 00:00:00" and "'.$dashtodate.' 23:59:59"';
				}
				
		   }
		  else
		  {
			  $dashfromdate='';
			  $dashtodate='';
			  $dashcallonsearch='';
			  $dashschargesearch='';
			 
		  }
		  
		  ?>
          <div class="row">
    <div class="col">
        <h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Delivery Notes</b></h1>
    </div>
    <div class="col-auto" style="padding-top:10px;">
        <div class="row justify-content-end">
                <a href="oembulkdcsent.php" class="btn btn-success btn-block">Create DN</a>
            </div>
    </div>
    <div class="col-auto" style="padding-top:10px;">
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
            <div class="input-group">
                <input type="text" id="reportrange" name="reportrange" class="form-control"/>
                <div class="input-group-append">
                    <button class="btn btn-navb" type="submit" name="submit">
                        <i class="fa-solid fa-calendar-days fa-sm" style="color: #3d8eb9;"></i>
                    </button>
                    <button class="btn btn-navb d-inline-block" type="submit">
                        <a href="deliverynotes.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
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
 <div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
<?php
}
 if(isset($_GET['error']))
{
?>	 
   <div class="alert alert-danger shadow"><?=$_GET['error']?></div>
<?php
}?>
<div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">In-House Calls <?=$statitle?></h6>
            </div>-->
            <div class="card-body">
			 <div class="floating-container">
	 <div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div>
	 </div>
			  <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  <th>DN No</th>
                      <th>DN Date</th>
					  <th>Supplier Name</th>
					  <th>Call ID</th>
					  <th>Call Date</th>
					  <th>Delivery Note</th>
					  <th>Email to Supplier</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	    $sqlselect = "SELECT id,callon,calltid,dcno,dcdate,suppliername,compstatus From jrccalls ".$staqu." and dcno!='' group by suppliername,dcno,dcdate order by dcdate desc ,dcno desc";
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
			
			?>
				
                    <tr>
					
					  <td> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowselect['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
		 <td><?=$rowselect['dcno']?></td>
					  <td><?=date('d/m/Y',strtotime($rowselect['dcdate']))?></td>
				<td>
					<?php  
					$sqlrep2 = "SELECT id,suppliername,email From jrcsuppliers where id='".$rowselect['suppliername']."' order by suppliername asc";
					$queryrep2 = mysqli_query($connection, $sqlrep2);
					$inforep2=mysqli_fetch_array($queryrep2);
					echo $inforep2['suppliername']; 
					?>
				 </td>
                 <td style="text-align:center;">
				<?php
				$sqlselect1 = "SELECT id,callon,calltid,dcno,dcdate,suppliername From jrccalls where dcno='".$rowselect['dcno']."'";
		$queryselect1 = mysqli_query($connection, $sqlselect1);
        $rowCountselect1 = mysqli_num_rows($queryselect1);
         
        if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if(mysqli_num_rows($queryselect1)>0)
{
$rowselect1 = array();
while($row = mysqli_fetch_assoc($queryselect1)){ 
$rowselect1[] = $row;
}
?>
<?php
foreach($rowselect1 as $row)
{
	?>
	<a href="<?= ($rowselect['compstatus'] != '2') ? 'oemprocess.php?id=' . $row['id'] . '&active=DC' : '' ?>"
 class="<?= ($rowselect['compstatus'] != '2') ? 'info' : 'success' ?>" target="_blank"><?= $row['calltid']?></a>
	<br>
	<?php 
}
			}
		
				 
				 
				 ?>
				 </td>
				 <td> 
					  <?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?>
				</td>
				<?php  
			   $sqlrep2 = "SELECT id,suppliername,email From jrcsuppliers where id='".$rowselect['suppliername']."' order by suppliername asc";
               $queryrep2 = mysqli_query($connection, $sqlrep2);
               $inforep2=mysqli_fetch_array($queryrep2);
				?>
				<td>
					<a href="deliverynoteprint.php?id=<?=$rowselect['dcno']?>" class="text-info" target="_blank">Print</a>
				</td>
				<td>
					<a href="dcsentsupplier.php?id=<?=$rowselect['dcno']?>&email=<?=$inforep2['email']; ?>" class="text-info" target="_blank">Send</a>
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
