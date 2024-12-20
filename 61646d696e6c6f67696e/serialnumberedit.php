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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Serial Number Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
   .timeline {
  display: block !important;
  margin-left: 0;
  padding-left: 0;
}

.timeline-card {
  display: flex;
  justify-content: center;
  align-items: center;
  color: <?=$_SESSION['bgcolor']?> !important;
  position: relative;
}

.timeline li:before {
  content: "";
  width: 0.2rem;
  height: 100%;
  background-color: <?=$_SESSION['bgcolor']?> !important;
  position: absolute;
  left: 16px;
  z-index: -1;
}

.timeline li:first-child:before {
  top: 50%;
  height: 50%;
}

.timeline li:last-child:before {
  bottom: 50%;
  height: 50%;
}
.timeline-title {
  margin-bottom: 0.5rem;
   top: 50%;
}
.circle-custom {
  font-size: 0.70rem !important;
}

.subcard {
  padding: 1em 1.5em 1.5em 1.5em;
  background: #ffffff;
  color: <?=$_SESSION['bgcolor']?>;
  width: -webkit-fill-available;
  min-height: 1.3rem;
}

   </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php // include('callnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Serial Number Details</h1>
            <a href="consignee.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Serial Number Details</a>
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
<?php
if(isset($_GET['consigneeid']))
{
$id=mysqli_real_escape_string($connection,$_GET['consigneeid']);
				  $sqlcon = "SELECT maincategory, subcategory, department, consigneename, address1, address2, area, district, pincode, contact,  mobile, email, phone, id  From jrcconsignee where id='".$id."' order by consigneename asc";
				  
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{
			$count=1;
			while($rowcon = mysqli_fetch_array($querycon)) 
			{
			if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowcon['address1']!='')
		{
		$rowcon['address1']=jbsdecrypt($_SESSION['encpass'], $rowcon['address1']);
		}
		if($rowcon['phone']!='')
		{
		$rowcon['phone']=jbsdecrypt($_SESSION['encpass'], $rowcon['phone']);
		}
		if($rowcon['mobile']!='')
		{
		$rowcon['mobile']=jbsdecrypt($_SESSION['encpass'], $rowcon['mobile']);
		}
		if($rowcon['email']!='')
		{
		$rowcon['email']=jbsdecrypt($_SESSION['encpass'], $rowcon['email']);
		}
	}
}	
			?>
			
			<div class="row">
        <div class="col-xl-12 order-xl-1 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-body">
			  <div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Main Category</th>
					  <th>Sub Category</th>
					  <th>Department</th>
                      <th>Customer Name</th>
                      <th>Address</th>
					  <th>Contact</th>
					  <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>				
                    <tr>
                      <td><?=$rowcon['maincategory']?></td></td>
					  <td><?=$rowcon['subcategory']?></td>
					  <td><?=$rowcon['department']?></td>
	                  <td><?=$rowcon['consigneename']?></td>
					  <td><?=$rowcon['address1']?> <?=$rowcon['address2']?> <?=$rowcon['area']?> <?=$rowcon['district']?> <?=$rowcon['pincode']?></td>
					  <td><?=$rowcon['contact']?> <?=$rowcon['phone']?> <?=$rowcon['mobile']?> <?=$rowcon['email']?> <!--<a href="tel:<?=$rowcon['phone']?>" class="btn btn-sm btn-success mr-4"><i class="fas fa-phone fa-sm"></i></a> <a href="sms:<?=$rowcon['phone']?>" class="btn btn-sm btn-warning float-right"><i class="fas fa-envelope fa-sm"></i></a>--></td>
					  <td><a href="consigneeedit.php?id=<?=$rowcon['id']?>">Edit</a></td>
                    </tr>
				  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
		</div>
		<br>
		<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>Product Details</h5>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              
			  <div class="table-responsive">
                <table class="table table-bordered font-13"  id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
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
				  $sqlselect = "SELECT installedby, stockmaincategory, stocksubcategory, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, installedon, warranty, id, qty, serialnumber, departments, stockitem, invoiceno, invoicedate From jrcxl where tdelete='0' and  id='".$_GET['xlid']."' group by invoiceno, invoicedate, stockitem, typeofproduct, componenttype, componentname, serialnumber order by invoicedate desc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			$stockitem="";
			$invoiceno="";
			$invoicedate="";
			
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
			?>
                    <tr>
                      <td><?=$count?></td>
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
				  $sqlamc = "SELECT datefrom, dateto, amcduration, amctype  From jrcamc where sourceid='".$rowselect['id']."'";
				  
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
    echo '<span class="text-danger"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintanence)</strong></span>';
}
else
{
	echo '<span class="text-success"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintanence)</strong></span>';
	?>
	<script>
	document.getElementById("amccustomer").style.display="block";
	</script>
	<?php
	
}
		}
		?>
		</td>
					  <td><?=$rowselect['qty']?></td>
					  <td><a href="serialnumberedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$rowselect['id']?>">Edit Serials</a><?php
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
					  ?><br><a href="callsadd.php?id=<?=$rowselect['id']?>" class="btn btn-danger btn-sm">Take A Complaint Call</a></td>
                    </tr>
					<?php
				$stockitem=$rowselect['stockitem'];
				$invoiceno=$rowselect['invoiceno'];
				$invoicedate=$rowselect['invoicedate'];
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
	  <br>
		<div class="row">
		<div class="col-xl-3 mb-4">
			<div class="card shadow cardb" role="button">
				<div class="card-header py-2">
                                    <h6 style="color:#04121f" class="m-0 text-center"><b>History</b></h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="height:250px; overflow-y:auto">
							
								
								<?php
								$sqlselect=mysqli_query($connection,"select oldserialnumber, serialnumber, createdon from jrcserialhistory where sourceid='".$_GET['xlid']."' and consigneeid='".$_GET['consigneeid']."' order by id desc");
								$numrowselect=mysqli_num_rows($sqlselect);
								if($numrowselect > 0)
								{
									?>
										<ul class="timeline">
									<?php
									
									$count=1;
									while($rowserial=mysqli_fetch_array($sqlselect))
									{
								?>
 <li class="timeline-card">
  <span aria-hidden="true" class="fa fa-stack fa-2x circle-custom" style="font-size: 1.7rem;"><i aria-hidden="true" class="fa fas fa-circle fa-stack-2x"></i> &nbsp;</span>
    <div class="subcard">
      <h6 class="timeline-title">Changed from <b><?=$rowserial['oldserialnumber']?></b> to <b><?=$rowserial['serialnumber']?></b>
      <a >Changed On <?=date('d/m/y h:i a',strtotime($rowserial['createdon']))?></a></h6>
    </div>
  </li>

  <?php
								}
								$count++;
								?>
								  </ul>
								<?php
	
								}
								else
								{
									?>
									
    <div class="subcard">
      <h6 class="timeline-title text Primary text-center"><b>No activity!!!</b></h6>
     
    </div>

									<?php
								}
  ?>

			</div>
				
				</div>
				</div>
		<div class="col-xl-9 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
                 <h6 style="color:#04121f" class="m-0 text-center"><b>Serial Number</b></h6>
            </div>
            <div class="card-body pt-0 pt-md-4">
			<form action="serialnumberedits.php" method="post">
			<input type="hidden" name="consigneeid" value="<?=$_GET['consigneeid']?>">
			<input type="hidden" name="sourceid" value="<?=$_GET['xlid']?>">
				<?php
			  if(isset($_GET['ts1']))
			  {
				?>
				<input type="hidden" id="ts1" name="ts1" value="<?=$_GET['ts1']?>">
				<?php				
			  }
			  ?>
              <div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Primary Device Serial Number</th>
					  <th colspan="2"><input type="text" name="upsserial" id="upsserial" value="" class="form-control"></th>
					  
                    </tr>
					
					<tr>
                      <th>S.No</th>
                      <th>Serial Number</th>
					  <th>Department</th>
					  <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $sqlcall = "SELECT id, serialnumber, location, sstatus, upsserial From jrcserials where sourceid='".$_GET['xlid']."' order by serialqty asc";
				  
        $querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
         
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcall > 0) 
		{
			$count=1;
			while($rowcall = mysqli_fetch_array($querycall)) 
			{
			?>
                    <tr>
                      <td><input type="hidden" name="id[]" id="id<?=$count?>" value="<?=$rowcall['id']?>" class="form-control"><?=$count?></td>
                      <td><input type="text" name="serialnumber[]" id="serialnumber<?=$count?>" value="<?=$rowcall['serialnumber']?>" class="form-control"></td>
					  <td><input type="text" name="location[]" id="location<?=$count?>" value="<?=$rowcall['location']?>" class="form-control"></td>
					  <td><select name="sstatus[]" id="sstatus<?=$count?>"  class="form-control" required>
					  <option value="0" style="color:#009900" <?=($rowcall['sstatus']=='0')?"selected":''?>>Active</option>
					  <option value="1" style="color:#ff0000" <?=($rowcall['sstatus']=='1')?"selected":''?>>Non-Active</option>
					  </select></td>
                    </tr>
					<script>
					document.getElementById("upsserial").value="<?=$rowcall['upsserial']?>";
					</script>
					<?php
					$count++;
			}
			?>
			<tr>
                      <td colspan="4" style="text-align:center"><input type="submit" name="submit" class="btn btn-success" value="Submit"></td>
                    </tr>
			<?php
		}
			?>
					
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
		
			
		</div>
<?php
					$count++;
			}
		}
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
<?php include('additionaljs.php');   ?>
</body>

</html>
