<?php
include('lcheck.php'); 

if($amcmanagement=='0')
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

  <title>AMC Expired Customers | Jerobyte - AMC Expired Customers</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/datatables/buttons.datatables.min.css">  
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
   .blink_me {
	   color:#ff0000;
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
?>
</style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php //include('consigneenavbar.php');?>
        

        
        <div class="container-fluid">

        
		  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>AMC Expired Customers</b></h1>
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

		<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
           
            <div class="card-body pt-0 pt-md-4">
              
			  <div class="table-responsive">
                <table class="table table-bordered font-13"  id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  <th>Customer Details</th>
                      <th>Invoice Details</th>
					  <th>Installation Details</th>
					  <th>Stock Details</th>
                      <th>Component Details</th>
					  <th>Qty</th>
                      <th style="width:20%" >Serial Nos.</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$count=1;
 $sqlamc1 = "SELECT sourceid From jrcamc where dateto<'".date('Y-m-d')."' order by id asc";
        $queryamc1 = mysqli_query($connection, $sqlamc1);
        $rowCountamc1 = mysqli_num_rows($queryamc1);
         
        if(!$queryamc1){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountamc1 > 0) 
		{
		
			while($rowamc1 = mysqli_fetch_array($queryamc1)) 
			{
	  $sqlselect = "SELECT maincategory, subcategory, department, consigneeid, consigneename, address1, address2, area, district, pincode, contact, phone, mobile, email, id,  installedby, stockmaincategory, stocksubcategory, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, installedon, warranty, qty, serialnumber, departments, stockitem, invoiceno, invoicedate From jrcxl where tdelete='0' and id='".$rowamc1['sourceid']."'";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			
			$stockitem="";
			$invoiceno="";
			$invoicedate="";
			$maincategory="";
			$subcategory="";
			$department="";
			$consigneename="";
			
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			?>
                    <tr>
                      <td><?=$count?></td>
					  <?php
			if(($maincategory!=$rowselect['maincategory'])||($subcategory!=$rowselect['subcategory'])||($department!=$rowselect['department'])||($consigneename!=$rowselect['consigneename']))
			{
				?>
					  
					  <td><?=$rowselect['maincategory']?><br><?=$rowselect['subcategory']?><br><?=$rowselect['department']?><br>
					  <b><?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowselect['consigneename']?></a>
					  <?php
					  }
					  else
					  {
					  ?>
					  <a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a>
					  <?php
					  }
					  ?></b><br><?=$rowselect['address1']?> <?=$rowselect['address2']?> <?=$rowselect['area']?> <?=$rowselect['district']?> <?=$rowselect['pincode']?><br><?=$rowselect['contact']?> <?=$rowselect['phone']?> <?=$rowselect['mobile']?> <?=$rowselect['email']?></td>
					<?php
				
			}
			else
			{
				?>
				<td></td>
				<?php
			}
			?>  
					  
			<?php
			if(($invoiceno!=$rowselect['invoiceno'])||($invoicedate!=$rowselect['invoicedate'])||($stockitem!=$rowselect['stockitem']))
			{
				?>
				
					  <td><?=$rowselect['invoiceno']?> <br> <?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?><br><a href="invoiceedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
					  <td><?=$rowselect['installedon']?> <br> <?=$rowselect['installedby']?></td>
					  <td><?=$rowselect['stockmaincategory']?> - <?=$rowselect['stocksubcategory']?><br><b><?=$rowselect['stockitem']?></b><br>Warranty: <?=$rowselect['overallwarranty']?>
					  <?php
					  if($rowselect['overallwarranty']!='')
					  {
						  if($rowselect['installedon']!='')
						  {
							  $overdate=$rowselect['installedon'];
						  }
						  else
						  {
							  $overdate=$rowselect['invoicedate'];
						  }
						  $off=(float)$rowselect['overallwarranty'];
						  $overdate = str_replace('/', '-', $overdate);
							$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
						$date = new DateTime($effectiveDate);
$now = new DateTime();

if($date < $now) {
    echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span>';
}
else
{
	echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span>';
}
					  }
					  ?>				  
					  </td>
				<?php
				
			}
			else
			{
				?>
				<td></td>
				<td></td>
				<td></td>
				<?php
			}
			?>
					  
                      <td><?=$rowselect['typeofproduct']?> - <?=$rowselect['componenttype']?> - <b><?=$rowselect['componentname']?></b><br>
					  Make: <?=$rowselect['make']?><br>
                      Capacity: <?=$rowselect['capacity']?><br>
					  Warranty: <?=$rowselect['warranty']?>
					  <?php
					  if($rowselect['warranty']!='')
					  {
						  if($rowselect['installedon']!='')
						  {
							  $overdate=$rowselect['installedon'];
						  }
						  else
						  {
							  $overdate=$rowselect['invoicedate'];
						  }
						  $off=(float)$rowselect['warranty'];
						  $overdate = str_replace('/', '-', $overdate);
							$overdate=date('Y-m-d', strtotime($overdate));
$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
						$date = new DateTime($effectiveDate);
$now = new DateTime();

if($date < $now) {
    echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span>';
}
else
{
	echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span>';
}
					  }
					  ?>
					  <br>
					  <?php
				  $sqlamc = "SELECT dateto, datefrom, amcduration, amctype From jrcamc where sourceid='".$rowselect['id']."'";
				  
        $queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountamc!=0)
		{
		?>
		<b>AMC:</b>
<?php		
         
		$rowamc = mysqli_fetch_array($queryamc); 
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
    echo '<span class="text-danger"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintenance) - AMC EXPIRED</strong></span>';
}
else
{
	echo '<span class="text-success"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintenance)</strong></span>';
	?>
	<?php
	
}
		}
		?>
		</td>
					  <td><?=$rowselect['qty']?></td>
					  <td><a href="serialnumberedit.php?consigneeid=<?=$rowselect['consigneeid']?>&xlid=<?=$rowselect['id']?>">Edit Serials</a><br>
					  <?php
					  $srls=explode("| ",$rowselect['serialnumber']);
					  $dpts=explode("| ",$rowselect['departments']);
					  for($sr=0;$sr<count($srls);$sr++)
					  {
						  if(isset($srls[$sr]))
						  {
							  echo '<br>'.$srls[$sr];
						  }
						  if(isset($dpts[$sr]))
						  {
							  echo '-'.$dpts[$sr];
						  }
					  }
					  $sqlcall = "SELECT callon From jrccalls where consigneeid='".$rowselect['consigneeid']."' and reportedproblem='AMC MAINTENANCE' order by id desc";
		$querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
         
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcall > 0) 
		{
			$rowcall = mysqli_fetch_array($querycall);
			$calldate=date('Y-m-01',strtotime($rowcall['callon']));
			if($rowamc['amctype']=='Monthly')
			{
				$final = date("Y-m-d", strtotime("+1 month", strtotime($calldate)));
			}
			if($rowamc['amctype']=='Quarterly')
			{
				$final = date("Y-m-d", strtotime("+3 months", strtotime($calldate)));
			}
			if($rowamc['amctype']=='Half Yearly')
			{
				$final = date("Y-m-d", strtotime("+6 months", strtotime($calldate)));
			}
			if($rowamc['amctype']=='Annually')
			{
				$final = date("Y-m-d", strtotime("+12 months", strtotime($calldate)));
			}
			if(strtotime($final)<time())
			{
				?>
				<br><h5 class="blink_me"><b> இந்த MONTH AMC பண்ண வேண்டும்</b></h5>
				<?php
			}
		}
					  ?><br><a href="callsadd.php?id=<?=$rowselect['id']?>&t=am" class="btn btn-danger btn-sm text-white">Take a AMC Call</a><br>
					  <a href="amcedit.php?consigneeid=<?=$rowselect['consigneeid']?>&xlid=<?=$rowselect['id']?>">AMC Details</a></td>
                    </tr>
					<?php
				$stockitem=$rowselect['stockitem'];
				$invoiceno=$rowselect['invoiceno'];
				$invoicedate=$rowselect['invoicedate'];
		
			}
		}
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
<script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
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
     $( "#maincategory" ).autocomplete({
       source: 'consigneesearch.php?type=maincategory',
     });
	 $( "#subcategory" ).autocomplete({
       source: 'consigneesearch.php?type=subcategory',
     });
	 $( "#consigneename" ).autocomplete({
       source: 'consigneesearch.php?type=consigneename',
     });
	 $( "#department" ).autocomplete({
       source: 'consigneesearch.php?type=department',
     });
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excel', 
                    text: 'Export to Excel', 
                    className: 'btn btn-success',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
