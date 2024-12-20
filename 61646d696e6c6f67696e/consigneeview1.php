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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Customer Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Customer Details</h1>
            <a href="consignee.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Customer Details</a>
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
  <div class="col-lg-6 mb-4" id="warrantycustomer" style="display:none" >
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                     Warranty Customer
                    </div>
                  </div>
                </div>
				  <div class="col-lg-6 mb-4" id="amccustomer" style="display:none" >
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                     AMC Customer
                    </div>
                  </div>
                </div>
<?php
if((isset($_GET['id']))&&($_GET['id']!=''))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
				  $sqlcon = "SELECT * From jrcconsignee where id='".$id."' order by consigneename asc";
				  
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
			if($rowcon['ctype']!='')
			{
				if($rowcon['ctype']=='BLOCK')
				{
				?>
				<div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Customer Type : <?=$rowcon['ctype']?>
                    </div>
                  </div>
                </div>
				<?php
				}
				else
				{
				?>
				<div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Customer Type : <?=$rowcon['ctype']?>
                    </div>
                  </div>
                </div>
				<?php
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
	                  <td><?=$conname=$rowcon['consigneename']?></td>
					  <td><?=$rowcon['address1']?> <?=$rowcon['address2']?> <?=$rowcon['area']?> <?=$rowcon['district']?> <?=$rowcon['pincode']?>
					  <?php 
					  if($rowcon['latlong']!='')
					  {
						  $ll=explode(',',$rowcon['latlong']);
						  ?>
						  <br><b><a class="text-success" data-toggle="modal" data-target="#myModalmap" data-lat='<?=$ll[0]?>' data-lng='<?=$ll[1]?>' style="cursor:pointer;">View Customer Location</a></b>
						  <?php
					  }
					  else
					  {
						  ?>
						  <br><b><a class="text-danger" href="consigneeedit.php?id=<?=$rowcon['id']?>">LatLong Not Found, Kindly Update</a></b>
						  <?php
					  }
					  ?></td>
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
				<h5>Call History</h5>
               </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="table-responsive">
                <table class="table table-bordered font-13" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID</th>
					  <th>Date</th>
					  <th>Call Details</th>
					  <th>Product Details</th>
					  <th>Serial Number</th>
					  <th>Problem Reported</th>
					  <th>Problem Observed</th>
					  <th>Action Taken</th>
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
				  $sqlcall = "SELECT * From jrccalls where consigneeid='".$id."' order by id desc";
				  
        $queryselect = mysqli_query($connection, $sqlcall);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				$sqlxl = "SELECT * From jrcxl where id='".$rowselect['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountxl > 0) 
				{
					$rowxl = mysqli_fetch_array($queryxl);
					if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowxl['address1']!='')
		{
		$rowxl['address1']=jbsdecrypt($_SESSION['encpass'], $rowxl['address1']);
		}
		if($rowxl['phone']!='')
		{
		$rowxl['phone']=jbsdecrypt($_SESSION['encpass'], $rowxl['phone']);
		}
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($_SESSION['encpass'], $rowxl['mobile']);
		}
		if($rowxl['email']!='')
		{
		$rowxl['email']=jbsdecrypt($_SESSION['encpass'], $rowxl['email']);
		}
	}
}
				}
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				  $sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
				  
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
                      <td><?=$count?></td>
                      <td><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a></td>
					  
					  <td><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></td>
					  <td>C/H: <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
					  C/O: <a href="coordinatorview.php?id=<?=$rowselect['coordinatorid']?>"><?=$rowselect['coordinatorname']?></a><br>
					  E: <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
					  
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
					  
					   
					  <td><?=$rowxl['stocksubcategory']?> - <?=$rowxl['componentname']?></td>
					  <td><?=$rowselect['serial']?></td>
					  <td><?=$rowselect['reportedproblem']?></td>
					  <td><?=$rowselect['problemobserved']?></td>
					  <td><?=$rowselect['actiontaken']?></td>
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
					?>
					  <td><a href="callsedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
					  <?php
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
				  $sqlselect = "SELECT * From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' group by invoiceno, invoicedate, stockitem, typeofproduct, componenttype, componentname, serialnumber order by invoicedate desc";
				  
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
						  $overdate = str_ireplace('/', '-', $overdate);
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
						  $overdate = str_ireplace('/', '-', $overdate);
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
	?>
	<script>
	document.getElementById("warrantycustomer").style.display="block";
	</script>
	<?php
}
					  }
					  ?>
					  <br>
					  <?php
				  $sqlamc = "SELECT * From jrcamc where sourceid='".$rowselect['id']."'";
				  
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
					  ?><br><a href="callsadd.php?id=<?=$rowselect['id']?>" class="btn btn-danger btn-sm">Take A Complaint Call</a><br>
					  <a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$rowselect['id']?>">AMC Details</a>
					  <br>
					  <br>
					  <?php
					  if($deleteproduct=='1')
					  {
						  ?>
					  <a href="invoicedelete.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$rowselect['id']?>&tdelete=<?=$rowselect['tdelete']?>" onclick="return confirm('Are you sure want to Delete this Product')" class="text-danger">Delete this product</a>
					  <?php
					  }
					  ?>
					  
					  </td>
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
	 
<?php
					$count++;
			}
		}
		}
		else
		{
      
      if(isset($_GET['topsearch']))
      {
        $term=mysqli_real_escape_string($connection, $_GET['topsearch']);
        if(strlen($term)>2)
        {

        
        $terms=explode(' ',$term);
$q="";
$finds=array();
$replaces=array();

foreach($terms as $t)
{
  $finds[]=$t;
  $replaces[]='<span style="background-color:#CCFF00">'.$t.'</span>';
	if($q=="")
	{
		$q.="((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(email) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
	}
	else
		{
		$q.=" and ((LOWER(maincategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoiceno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(invoicedate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcno) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(dcdate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pono) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(podate) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(subcategory) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(consigneename) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(department) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address1) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(address2) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(area) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(district) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(pincode) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(contact) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(phone) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(mobile) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(email) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(stockitem) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(departments) LIKE LOWER('%".$t."%'))";
		$q.=" or (LOWER(serialnumber) LIKE LOWER('%".$t."%')))";
	}
		
}
?>
<div class="row">
        <div class="col-xl-12 order-xl-1 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-body">
 <div class="table-responsive">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
					  
<?php
$c=0;
?>
<th>Invoice No.</th>
<th>Invoice Date</th>
<th>Tender No.</th>
<th>Purchase Order No.</th>
<th>PO Date</th>
<th>DC No.</th>
<th>DC Date</th>
<th>Installed On</th>
<th>Installed By</th>
<th>Main Category</th>
<th>Sub Category</th>
<th>Customer Name(Unique)</th>
<th>Department</th>
<th>Address 1</th>
<th>Address 2</th>
<th>Area</th>
<th>District</th>
<th>Pin Code</th>
<th>Contact</th>
<th>Phone</th>
<th>Mobile</th>
<th>Email</th>
<th>Main Category</th>
<th>Sub Category</th>
<th>Product Name</th>
<th>Invoiced Qty</th>
<th>Overall Warranty Months</th>
<th>Type of Product</th>
<th>Component Type</th>
<th>Component Name</th>
<th>Make</th>
<th>Capacity</th>
<th>Warranty</th>
<th>Qty</th>
<th>Serial Numbers</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $sqlselect = "SELECT * FROM jrcxl WHERE tdelete='0' and (".$q.") group by consigneename ORDER BY consigneename ASC"; 
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
                      <td><?=$count?></td>
					  <td><?=str_ireplace($finds, $replaces,$rowselect['invoiceno'])?></td>
<td><?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['tenderno'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['pono'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['podate'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['dcno'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['dcdate'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['installedon'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['installedby'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['maincategory'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['subcategory'])?></td>
<?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowselect['consigneename']?></a></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?>
<td><?=str_ireplace($finds, $replaces,$rowselect['department'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['address1'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['address2'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['area'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['district'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['pincode'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['contact'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['phone'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['mobile'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['email'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['stockmaincategory'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['stocksubcategory'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['stockitem'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['invoicedqty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['overallwarranty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['typeofproduct'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['componenttype'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['componentname'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['make'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['capacity'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['warranty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['qty'])?></td>
<td><?=str_ireplace($finds, $replaces,$rowselect['serialnumber'])?></td>
					  
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
<?php

}
else
{
  ?>
  <div class="alert alert-danger shadow">Please Enter Atleast 3 Characters to Search</div> 
  <?php
}
      }
			?>
			
			<?php
		}
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

<div class="modal fade" id="myModalmap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
		  <h4 class="modal-title" id="myModalLabel"><?=$conname?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 modal_body_map">
              <div class="location-map" id="location-map">
                <div style="width: 600px; height: 400px;" id="map_canvas"></div>
              </div>
            </div>
          </div>
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
<script>
// Code goes here

$(document).ready(function() {
  var map = null;
  var myMarker;
  var myLatlng;

  function initializeGMap(lat, lng) {
    myLatlng = new google.maps.LatLng(lat, lng);

    var myOptions = {
      zoom: 15,
      zoomControl: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    myMarker = new google.maps.Marker({
      position: myLatlng
    });
    myMarker.setMap(map);
  }

  // Re-init map before show modal
  $('#myModalmap').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    initializeGMap(button.data('lat'), button.data('lng'));
    $("#location-map").css("width", "100%");
    $("#map_canvas").css("width", "100%");
  });

  // Trigger map resize event after modal shown
  $('#myModalmap').on('shown.bs.modal', function() {
    google.maps.event.trigger(map, "resize");
    map.setCenter(myLatlng);
  });
});
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=initMap&libraries=&v=weekly"
      async
    ></script>
	<?php include('additionaljs.php');   ?>
</body>

</html>
