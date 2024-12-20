<?php
include('lcheck.php'); 

$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$_SESSION['companyname']?> - Jerobyte - Service Call Reports</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php // include('callnavbar.php'); ?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
		  
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
<?php
$statitle="";
$staqu="";
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
		  }
		  else
		  {
			  $dashfromdate=date('Y-m-01');
			  $dashtodate=date('Y-m-t');
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
			  
			  
		  }
		  ?>
						
						
						
						
						
          <!-- Page Heading -->
			<div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" style="padding-left:300px;"><b>Service Call Reports</b></h1>
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
                    <a href="scrdetails.php"><i class="fas fa-undo fa-sm" style="color:#3d8eb9;"></i></a>
                </button>
            </div>
        </div>
    </form>
</div>
</div>			
						
						
          <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Service Call Reports from <?=date('d/m/Y', strtotime($dashfromdate))?> to <?=date('d/m/Y', strtotime($dashtodate))?></h6>   
    <div class="ml-auto">
        <button class="btn btn-info btn-sm" onclick="location.href='callstatus.php'"><b>Consolidated Call Report</b></button>
        <button class="btn btn-info btn-sm " onclick="location.href='consigneemailbulk.php'"><b>Bulk Mail - Call Report</b></button>
    </div>
</div>


            <div class="card-body">
			  <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID</th>
					  <th>SR No</th>
					  <th>Date</th>
					  <th>Status</th>
					  <th>Call Details</th>
					  <th>Customer Details</th>
					  <th>Product Details</th>
					  <th>Edit Call</th>
					  <th>View Service Report</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 $sqlcomp = "SELECT t1.calltid, t1.srno,t1.imgmanual, t2.sourceid, t2.callon, t2.calltid, t2.compstatus, t2.changeon, t2.callhandlingid, t2.callhandlingname, t2.coordinatorid, t2.coordinatorname, t2.engineerid, t2.engineername, t2.engineersid, t2.engineersname, t2.engineertype, t2.reportingengineerid, t2.reportingengineername, t2.businesstype, t2.servicetype, t2.customernature, t2.callnature, t2.id, t3.consigneeid, t3.consigneename, t3.stockmaincategory, t3.stocksubcategory, t3.componentname, t3.stockitem, t4.address1, t4.address2, t4.area, t4.district, t4.pincode, t4.contact, t4.phone, t4.mobile From jrccalldetails t1 left join jrccalls t2 on t1.calltid=t2.calltid left join jrcxl t3 on t3.id=t2.sourceid left join jrcconsignee t4 on t4.id=t3.consigneeid where t1.reassign='0' and (t1.srno!='' and t1.srno is not null) ".$staqu." order by t1.id desc";
	
		
        $querycomp = mysqli_query($connection, $sqlcomp);
        $rowCountcomp = mysqli_num_rows($querycomp);
         
        if(!$querycomp){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcomp > 0) 
		{
			$count=1;
			while($rowselect = mysqli_fetch_array($querycomp)) 
			{
			
				
			
					//echo '<br>'.$rowselect['calltid'].'-'.$rowselect['sourceid'].'-'.$rowselect['consigneename'].'-'.$rowselect['mobile'];
				/* 
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem, id From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
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
*/
		?>
                    <tr>
					<td> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowselect['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
                      <td><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a></td>
					  <td><?=$rowselect['srno']?></td>
					  <td><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
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
					  <td>C/H: <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
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
					  ?></td>
					   <?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowselect['consigneename']?></a><br><?=$rowselect['address1']?> <?=$rowselect['address2']?> <?=$rowselect['area']?> <?=$rowselect['district']?> <?=$rowselect['pincode']?>  <?=$rowselect['contact']?>  <?=$rowselect['phone']?> <?=$rowselect['mobile']?></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?>
					  <td><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowselect['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowselect['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowselect['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowselect['stockitem']?>
												<?php
												}
												?></td>
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
					  <td><a target="_blank" href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>"><b>View Report</b></a> 
					  <?php  
					  if($infolayoutservice['manual']=='1' && $rowselect['imgmanual']!="" && $rowselect['imgmanual']!='NULL') 
						  { 
						 
?>				
 
					 <br>/ <a target="_blank" href="<?=($infolayoutservice['manual']=='1')?'complaintprintm1.php':'complaintprintm1.php'?>?id=<?=$rowselect['imgmanual']?>">Manual Report</a> 
					  <?php
						  
					  } ?>
					  
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

<?php
		 /*  if($_SESSION['companyid']=='1')
		  {
			  ?>
		  <div class="row">
		  <div class="col-lg-4">
		  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6635039710002828"
     crossorigin="anonymous"></script>
<!-- Square -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6635039710002828"
     data-ad-slot="7662356617"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
		  </div>
		  <div class="col-lg-4">
	
<!-- Square -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6635039710002828"
     data-ad-slot="7662356617"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
		  </div>
		  <div class="col-lg-4">

<!-- Square -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6635039710002828"
     data-ad-slot="7662356617"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
		  </div>
		  </div>
<?php
		  } */
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
                <h5 class="modal-title">Service Call Reports</h5>
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
