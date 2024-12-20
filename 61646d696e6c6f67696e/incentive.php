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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Service Engineer Incentive Details</title>

  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/datatables/buttons.datatables.min.css">
</head>

<body id="page-top">

  <div id="wrapper">

    <?php  include('sidebar.php');?>
    
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

          <?php  include('navbar.php');?>
          <?php  include('accountnavbar.php');?>
    
        <div class="container-fluid">

          <!-- Page Heading -->
		  
<div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>Service Engineer Incentive Details</b></h1>
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
}
?>

<!--date starts-->
          <div class="card shadow mb-4">
            <div class="card-body">
<form action="incentive.php" method="post">
<div class="row">
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="datefrom">Date From</label>
    <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="AMC Date From" value="<?=(isset($_POST['datefrom']))?$_POST['datefrom']:((isset($_GET['datefrom']))?$_GET['datefrom']:'')?>" >
  </div>
</div>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="dateto">Date To</label>
    <input type="date" class="form-control" id="dateto" name="dateto" placeholder="AMC Date To" value="<?=(isset($_POST['dateto']))?$_POST['dateto']:((isset($_GET['dateto']))?$_GET['dateto']:'')?>" >
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="cashstatus">Received By</label>
	<select class="form-control" id="receivedby" name="receivedby">
    <option value="">Select</option>

    <!-- Coordinator Section -->
    <!--<optgroup label="Coordinators">
    <?php
    $sqlcoordinator = "select adminusername as name, id from jrcadminuser where designation='CALL CO-ORDINATOR' order by name asc";
    $querycoordinator = mysqli_query($connection, $sqlcoordinator);
    if(!$querycoordinator){
        die("SQL query failed: " . mysqli_error($connection));
    }
    while($rowcoordinator = mysqli_fetch_array($querycoordinator)) {
        ?>
        <option value="c_<?=$rowcoordinator['id']?>" <?=(isset($_POST['receivedby'])&&($_POST['receivedby']=='c_'.$rowcoordinator['id']))?'selected':''?>><?=$rowcoordinator['name']?></option>
        <?php
    }
    ?>
    </optgroup>-->

    <!-- Engineer Section -->
    <optgroup label="Engineers">
    <?php
    $sqlengineer = "select engineername as name, id from jrcengineer order by name asc";
    $queryengineer = mysqli_query($connection, $sqlengineer);
    if(!$queryengineer){
        die("SQL query failed: " . mysqli_error($connection));
    }
    while($rowengineer = mysqli_fetch_array($queryengineer)) {
        ?>
        <option value="e_<?=$rowengineer['id']?>" <?=(isset($_POST['receivedby'])&&($_POST['receivedby']=='e_'.$rowengineer['id']))?'selected':''?>><?=$rowengineer['name']?></option>
        <?php
    }
    ?>
    </optgroup>
</select>
  </div>
</div>
</div>
<?php
	if($secsystem=='1')
	{
	?>
  <hr>
  <div class="alert alert-info">To View Consignee Details you must validate yourself by enter your Password</div>
  <div class="row">
  <div class="col-lg-3">
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
	</div>
</div>
  </div>
  <?php
	}
	?>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit"> 
</form>
</div>
</div>
<!--date ends-->

<?php
				$staqu="";
				$staqu1="";
			if(isset($_POST['submit']) || isset($_GET['submit']))
			{
				?>
				
				<?php
				$permit="";	
if(isset($_POST['password']))	
{
	$password=mysqli_real_escape_string($connection, $_POST['password']);
	if($password!='')
	{
		$sqlcon = "SELECT id From jrcadminuser WHERE username='".$_SESSION['email']."' and password='".$password."'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcon > 0) 
		{
			$permit="yes";
		}
		else
		{
			?><br>
			<div class="alert alert-danger shadow">Sorry! Your Password is Wrong! You unable to view this Details</div>
			<?php
		}
	}
}
else
{
	$permit="yes";
}
if($permit=="yes")
{
	if(isset($_GET['submit']))
	{
	if(($_GET['datefrom'])&&($_GET['dateto']))
				{
					if($staqu!="")
					{
						$staqu.=" and datefrom BETWEEN '".$_GET['datefrom']."' AND '".$_GET['dateto']."'";
					}
					else
					{
						$staqu.=" and datefrom BETWEEN '".$_GET['datefrom']."' AND '".$_GET['dateto']."'";
					}
				}
				
			?>	
			<h4 class="text-danger">
			Report 
			<?php
			if($_GET['datefrom']!="")
			{
				?>
				From <?=date('d/m/Y',strtotime($_GET['datefrom']))?>
				<?php
			}
			if($_GET['dateto']!="")
			{
				?>
			to  <?=date('d/m/Y',strtotime($_GET['dateto']))?>
			<?php
			}
			?>
			</h4>
			<?php
	}
	else{
	
				if(($_POST['datefrom'])&&($_POST['dateto']))
				{
					if($staqu!="")
					{
						$staqu.=" and receiveddate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
					else
					{
						$staqu.=" and receiveddate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
					if($staqu1!="")
					{
						$staqu1.=" and schargedate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
					else
					{
						$staqu1.=" and schargedate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
				}
				
			
			
		/* start Receivedby */
			if(isset($_POST['receivedby']))
			{
				
				
				
				
				$subquer="";
			 if($_POST['receivedby']!='')
			 { 
					if($subquer=="")
					{
						$subquer.=" (receivedby='".$_POST['receivedby']."' )";
					}
					else
						{
						$subquer.=" or (receivedby='".$_POST['receivedby']."' )";
					}
			 }
			
				
				if($subquer!="")
				{
					if($staqu!="")
					{
						$staqu.=" and (".$subquer.")";
					}
					else
					{
						$staqu.=" and (".$subquer.")";
					}
				}
			}
				
		/* end Receivedby */
	
			?>	
			<h4 class="text-danger">
			Report 
			<?php
			if($_POST['datefrom']!="")
			{
				?>
				From <?=date('d/m/Y',strtotime($_POST['datefrom']))?>
				<?php
			}
			if($_POST['dateto']!="")
			{
				?>
			to  <?=date('d/m/Y',strtotime($_POST['dateto']))?>
			<?php
			}
			?>
			</h4>
			<?php
	}
	?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Service Engineer Details</h6>
            </div>-->
            <div class="card-body">
			<?php 
					if($secsystem=='1')
					{
					?>
					<div class="alert alert-danger shadow">All Passwords has been Encrypted, You can't View it. You can change a New Password.</div>
					<?php 
					}
					?>
					<div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
              <div class="table-responsive scroll">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Engineer Name</th>
                      <th>AMC Charges</th> 
                      <th>Actual AMC Charges</th> 
					  <th>AMC Incentive %</th>
					  <th>AMC Incentive</th>
                      <th>Service Charges</th>
                      <th>Actual Service Charges</th>
					  	  <th>Service Incentive%</th>
					  	  <th>Service Incentive</th>
					  	  <th>Total Incentive</th>
                    </tr>
                  </thead>
                  <tbody>
				  
				  <?php 
				  $subque='';
				  if($_POST['receivedby']!='')
				  {
				  $engineerId1 = str_replace('e_', '', $_POST['receivedby']);
				  $subque="where id='".$engineerId1."'";
				  }
				 
				  $servicecharge=0;
				  $resultvalue=0;
				  $sqlselect = "SELECT id, engineername From jrcengineer $subque order by enabled=1 asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{	
$rowselect = array();
while($row = mysqli_fetch_assoc($queryselect)){ 
$rowselect[] = $row;
}
		?>	
		<?php	
			$i=1;
			foreach($rowselect as $row)
{
	$engineername=$row['engineername'];
	$engineerid='e_'.$row['id'];
	//amc charges
	
	
	 "select amcgst,receivedby,id,  sum(receivedamount) as receivedamount ,receiveddate from jrcamc where  receiveddate is not null ".$staqu." and receivedby='".$engineerid."'";
	
	
	//$rowselectamc=mysqli_query($connection,"select receivedby,id,  receiveddate , sum(receivedamount) as receivedamount  from jrcamc where  receiveddate is not null ".$staqu."");
	$rowselectamc=mysqli_query($connection,"select amcgst, receivedby,id,  sum(receivedamount) as receivedamount ,receiveddate from jrcamc where  receiveddate is not null ".$staqu." and receivedby='".$engineerid."'");
	$rowCountselect1 = mysqli_num_rows($rowselectamc);
	$rowamc=mysqli_fetch_array($rowselectamc);
	//service Charges
	$rowselectcall=mysqli_query($connection,"select t1.id, t1.calltid, t1.srno, t1.addedon, t1.schargeno, t1.incgst, t1.schargematerial, t1.schargescharge, t1.schargepre, t1.schargegst, t1.schargegstvalue, sum(t1.scharge) as scharge,t1.mchargescharge,t1.mchargegstvalue ,t1.sercharge  ,t1.sgstamt   , t1.schargedate, t1.schargereceivedon, t1.schargereceivedmode, t1.cashstatus, t2.engineername, t2.engineerid,t2.engineertype, t2.engineersname, t2.engineersid, t2.coordinatorname, t2.coordinatorid, t1.tallystatus, t2.consigneeid, t2.sourceid from jrccalldetails t1, jrccalls t2 where t1.calltid=t2.calltid and t1.scharge!='0.00' and t1.scharge!='0' and t1.scharge!=''  and ( (t2.engineername='".$engineername."' or find_in_set('".$engineername."', t2.engineersname)))and t1.scharge is not null ".$staqu1." order by cast(t1.schargedate as date) desc");
	$rowCountselectcall = mysqli_num_rows($rowselectcall);
	$rowcall=mysqli_fetch_array($rowselectcall);
?>  
<?php 

	$gst=round($rowamc['receivedamount']/(1+($rowamc['amcgst']/100)));

	$earnings=round($gst);
   if ($earnings == 0) {
        $incentive_rate = 0;
    }else if (($earnings >= 1) && ($earnings <= 10000)) {
        $incentive_rate = 0.02;
    } else if (($earnings >= 10001) && ($earnings <= 25000)){
        $incentive_rate = 0.04;
    } else if (($earnings >= 25001) && ($earnings <= 50000)){
        $incentive_rate = 0.06;
    } else if (($earnings >= 50001) && ($earnings <= 100000)){
        $incentive_rate = 0.08;
    } else if (100001 <= $earnings){
        $incentive_rate = 0.10;
    }
    $incentive = $gst * $incentive_rate;
?> 
<?php 
$sgst=round($rowcall['scharge']/(1+($rowcall['schargegst']/100)));

	 $searnings=round($sgst);
   if ($searnings == 0) {
        $sincentive_rate = 0;
    } else if (($searnings >= 1) && ($searnings <= 10000)) {
        $sincentive_rate = 0.02;
    } else if (($searnings >= 10001) && ($searnings <= 25000)){
        $sincentive_rate = 0.04;
    } else if (($searnings >= 25001) && ($searnings <= 50000)){
        $sincentive_rate = 0.06;
    } else if (($searnings >= 50001) && ($searnings <= 100000)){
        $sincentive_rate = 0.08;
    } else if (100001 <= $searnings){
        $sincentive_rate = 0.10;
    }
    $sincentive = $searnings * $sincentive_rate;
	$totalincentive = $incentive + $sincentive;
	
?> <tr>
                      <td><?=$i?></td>                  
					 
					  <td><?=$engineername?></td>
					  <td><?=number_format($rowamc['receivedamount'])?></td>
					  <td><?=number_format($gst)?></td>
					  <td><?=$incentive_rate*100?> %</td>
					  <td><?=$incentive?></td>
					  <td><?=number_format($rowcall['scharge'] )?></td>
					  <td><?=number_format($sgst)?></td>
					 <td><?=$sincentive_rate*100?> %</td>
					  <td><?=$sincentive?></td>
					  <td><?=$totalincentive?></td>
                    </tr><?php

	$i++;
				
}
?>        
					<?php 
					
			
		}
			?>
					
                  </tbody>
                </table>
              </div>
            </div>
          </div>

			<?php }} ?>


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
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>	
  
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
  $('#dataTable').dataTable({
    paging: false
});
</script>
	<script>
    function initializeDataTable() {
        // Check if the DataTable is already initialized
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            // Destroy the existing DataTable instance
            $('#dataTable').DataTable().destroy();
        }

        // Initialize the DataTable
        $('#dataTable').DataTable({
            "paging": false,
            "processing": true,
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'pdf', 
                    text: 'Export to PDF', 
                    className: 'btn btn-primary',
                    orientation: 'landscape',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'excel', 
                    text: 'Export to Excel', 
                    className: 'btn btn-success',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ]  
        });
    }

    $(document).ready(function () {
        initializeDataTable();

        // Example: Reinitialize the DataTable after some event
        $('#someButton').on('click', function () {
            initializeDataTable();
        });
    });
</script>

<?php include('additionaljs.php');   ?>
</body>

</html>
