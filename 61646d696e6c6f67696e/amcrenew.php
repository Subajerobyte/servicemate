<?php
include('lcheck.php');
if($addamc=='0')
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

  <title>AMC Details | Jerobyte - Customer Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('quotationnavbar.php');?>
        

        
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
<div class="col-lg-12 mb-2">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      <?=$_GET['remarks']?>
                    </div>
                  </div>
                </div>
<?php
}
 if(isset($_GET['error']))
{
?>	 
  <div class="col-lg-12 mb-2">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                     <?=$_GET['error']?>
                    </div>
                  </div>
                </div>
<?php
}
?>
<?php
if(isset($_GET['consigneeid']))
{
$id=mysqli_real_escape_string($connection,$_GET['consigneeid']);
		$sqlcon = "SELECT maincategory, subcategory, department, consigneename, address1, address2, area, district, pincode, contact, mobile, email, phone, id From jrcconsignee where id='".$id."' order by consigneename asc";
				  
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
				  $sqlselect = "SELECT productid, installedby, stockmaincategory, stocksubcategory, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, installedon, warranty, id, qty, serialnumber, departments, stockitem, invoiceno, invoicedate From jrcxl where tdelete='0' and id='".(mysqli_real_escape_string($connection, $_GET['xlid']))."' group by invoiceno, invoicedate, stockitem, typeofproduct, componenttype, componentname, serialnumber order by invoicedate desc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		$productid="";
         
        if($rowCountselect > 0) 
		{
			$count=1;
			$stockitem="";
			$invoiceno="";
			$invoicedate="";
			
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				$productid=$rowselect['productid'];
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
				  $sqlamc = "SELECT dateto, datefrom, amcduration, amctype  From jrcamc where sourceid='".$rowselect['id']."'";
				  
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
    echo '<span class="text-danger"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintenance)</strong></span>';
}
else
{
	echo '<span class="text-success"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintenance)</strong></span>';
	?>
	<script>
	document.getElementById("amccustomer").style.display="block";
	</script>
	<?php
	
}
		}
		?>
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
					  ?><br><a href="callsadd.php?id=<?=$rowselect['id']?>" class="btn btn-danger text-white btn-sm">Take A Complaint Call</a><br>
					  <a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$rowselect['id']?>">AMC Details</a></td>
                    </tr>
					<?php
				$stockitem=$rowselect['stockitem'];
				$invoiceno=$rowselect['invoiceno'];
				$invoicedate=$rowselect['invoicedate'];
				$serialnumber=$rowselect['serialnumber'];
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
				<h5>AMC Renewal Details</h5>
            </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
			
			<form action="amcrenews.php" method="post" onload="valuefun()">
			<input type="hidden" name="consigneeid" value="<?=$_GET['consigneeid']?>">
			<input type="hidden" name="sourceid" value="<?=$_GET['xlid']?>">
			<input type="hidden" name="amcdate" value="<?=$_GET['date']?>">
			<input type="hidden" name="productid" value="<?=$productid?>">
			
			<!--AMC Renewal Edit-->
			<?php
			if(isset($_GET['id']))
			{
				$amcid=mysqli_real_escape_string($connection, $_GET['id']);
				
				$amc= " and id='$amcid'";
				
			}
			else if(isset($_GET['date']))
			{
				$date=mysqli_real_escape_string($connection, $_GET['date']);
				if($date!='')
				{
				$amc=" and amcrenewtype='Renewal' and datefrom!='$date'";
				}else
				{
					$amc=" and amcrenewtype='Renewal' and datefrom=''";
				}
			}
			else
			{
				$amc='';
			}
			if(isset($_GET['qid']))
			{
				?>
			<input type="hidden" name="quotationid" value="<?=$_GET['qid']?>">

<?php
			}
			else
			{
				?>
				<input type="hidden" name="quotationid" value=" ">
				<?php
			}	
			if(isset($_GET['i']))
			{
				?>
			<input type="hidden" name="amcid" value="<?=$amcid?>">

<?php
			}
			else
			{
				?>
				<input type="hidden" name="amcid" value=" ">
				<?php
			}
			$sourceid=mysqli_real_escape_string($connection, $_GET['xlid']);
		
				  $sqlamc = "SELECT amctype, amcduration, datefrom, dateto,quotationtype, amcdetails, priceperyear, quantity, amcgst,amcgstvalue, resultvalue, totalvalue,btotalvalue, serialnumber, receivedamount, receivedmode, receiveddate, receivedby,remarks,amcinvoiceno,amcrenewtype  From jrcamc where sourceid='".$sourceid."' $amc";
				  
        $queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
         // Existing amc customers
		if(($rowCountamc>0) && (!isset($_GET['qid'])))
		{ 
$rowamc = mysqli_fetch_array($queryamc); 
			?>
			<div class="row">
			<?php
$sqls=mysqli_query($connection,"select amcinvoiceno from jrcamcinvoice");
$infos=mysqli_fetch_array($sqls);
$amcinvoicenofrom=(float)$infos['amcinvoiceno']+1;
$amcinvoicenoto=(float)$infos['amcinvoiceno'];
?>
<div class="col-lg-12">
<a href="amcrenewal.php?consigneeid=<?=$_GET['consigneeid']?>&xlid=<?=$_GET['xlid']?>" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-list fa-sm text-white-50"></i>Previous AMC History</a>
               </div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amctype">Type</label>
      <select class="form-control" id="amcrenewtype" name="amcrenewtype" required>
<option value="">Select</option>
<option value="AMC" <?=($rowamc['amcrenewtype']=='AMC' || $rowamc['amcrenewtype']=='')?'selected':''?>>AMC</option>
<option value="Renewal" <?=$rowamc['amcrenewtype']=='Renewal'?'selected':''?>>Renewal</option>
</select></div>
</div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amcinvoiceno">AMC Invoice No</label>
	<input type="text" class="form-control" id="amcinvoiceno" name="amcinvoiceno" placeholder="AMC Invoice No" value="<?=($rowamc['amcinvoiceno']!='')?$rowamc['amcinvoiceno']:'SR/AMC/'.(date('my')).'/'.(str_pad($amcinvoicenofrom, 4, '0', STR_PAD_LEFT))?>" readonly>
  </div>
  </div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amctype">AMC Type</label>
	<select class="form-control" id="amctype" name="amctype" required>
<option value=""<?=($rowamc['amctype']=='')?'selected':''?>>Select</option>
<option value="Monthly" <?=($rowamc['amctype']=='Monthly')?'selected':''?>>Monthly</option>
<option value="Quarterly"<?=($rowamc['amctype']=='Quarterly')?'selected':''?>>Quarterly</option>
<option value="Half Yearly" <?=($rowamc['amctype']=='Half Yearly')?'selected':''?>>Half Yearly</option>
<option value="Annually" <?=($rowamc['amctype']=='Annually')?'selected':''?>>Annually</option>
</select>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="quotationtype">Quotation Type</label>

	<select class="form-control" id="quotationtype" name="quotationtype" required >
	
	<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcamcquotationtype order by id asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>" <?=($rowamc['quotationtype']==$rowrep['id'])?"selected":""?>><?=$rowrep['quotationtype']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
  

<div class="col-lg-3">
    <div class="form-group">
    <label for="priceperyear">Price for 12 Months</label>
	<?php
	if($rowamc['priceperyear']!='')
	{
	?>
	<input type="text" class="form-control" id="priceperyear" name="priceperyear" required value="<?=$rowamc['priceperyear']?>" onchange="valuefun()" >
	<?php
	}
	else
	{
		 $sqlxl = "SELECT * From jrcxl where id='".$_GET['xlid']."' ";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowxl = mysqli_fetch_array($queryxl);
				
	
			$sqlselect1 = "SELECT DISTINCT stockitem, amcvalue,amcgst From jrcproduct where stockitem='".$rowxl['stockitem']."' order by id asc";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowselect1 = mysqli_fetch_array($queryselect1);
				?>
			<input type="text" class="form-control" id="priceperyear" name="priceperyear" required value="<?=$rowselect1['amcvalue']?>" onchange="valuefun()">

		<?php
	}
	?>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="amcduration">AMC Duration <span class="text-danger">(In Months)</span></label>
	<input type="number" class="form-control" id="amcduration" name="amcduration" required   value="<?=$rowamc['amcduration']?>" onchange="valuefun();monthupdate()">
  </div>
  </div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="datefrom">AMC Date From</label>
	<input type="date" class="form-control" id="datefrom" name="datefrom" required value="<?=$rowamc['datefrom']?>" onchange="monthupdate()" readonly>
  </div>
  </div>
 <div class="col-lg-3">
    <div class="form-group">
    <label for="dateto">AMC Date To</label>
	<input type="date" class="form-control" id="dateto" name="dateto" required value="<?=$rowamc['dateto']?>" onchange="monthupdate()" readonly>
  </div>
  </div> 
  
  <div class="col-lg-3">
    <div class="form-group">
    <label for="serialnumber">Serial Number</label>
	<?php if($rowamc['serialnumber']!='')
  {	  ?>
	<select class="form-control fav_clr" name="serialnumber[]" id="serialnumber" multiple>
	<option value="">Select</option>
	<?php
	$serials=$rowamc['serialnumber'];
	$seri=explode('|',$serials);
	$serialnumbers=array();
	$serialnumbers=explode(",",$serials);
	if(!empty($serialnumbers))
				  {
					  foreach($serialnumbers as $ser)
					  {
						  $serialnumbers[]=$ser;
						 ?>
						  <option value="<?=$ser?>"<?=(in_array($ser,$serialnumbers))?'selected':''?>><?=$ser?></option>
	<?php
					  }
				  }	  ?>
		</select>
  <?php } 
  else
  {
	  ?>
	  <select class="form-control fav_clr" name="serialnumber[]" id="serialnumber" multiple >
	<option value="">Select</option>
	
	<?php
	$serialnumbers=array();
	$serialnumbers=explode("|",$serialnumber);
	print_r($serialnumbers);
	if(!empty($serialnumbers))
				  {
					  foreach($serialnumbers as $ser)
					  {
						  $serialnumbers[]=$ser;
						 ?>
						  <option value="<?=$ser?>"><?=$ser?></option>
	<?php
					  }
				  }	  ?>
		</select>
		<?php
  }
  ?>
  </div>
  </div>
  

<div class="col-lg-3">
    <div class="form-group">
    <label for="quantity">Quantity</label>
	<input type="text" class="form-control" id="quantity" name="quantity" required value="<?=$rowamc['quantity']?>"  onchange="valuefun()"  readonly>
  </div>
  </div>
 <div class="col-lg-3">
    <div class="form-group">
    <label for="resultvalue">Value</label>
	<input type="number" class="form-control" id="resultvalue" name="resultvalue" required value="<?=$rowamc['resultvalue']?>" onchange="valuefun()" step="0.01" readonly>
  </div>
  </div> <div class="col-lg-3">
    <div class="form-group">
    <label for="amcgst">GST %</label>
	<?php
	if($rowamc['amcgstvalue']!='')
	{
	?>
	<input type="text" class="form-control" id="amcgst" name="amcgst" required value="<?=$rowamc['amcgst']?>" readonly>
	<?php
	}
	else
	{
		?>
		<input type="text" class="form-control" id="amcgst" name="amcgst" required value="<?=$rowselect1['amcgst']?>" readonly>
		<?php
	}
	?>
  </div>
  </div>
  

<div class="col-lg-3">
    <div class="form-group">
    <label for="amcgstvalue">GST Value</label>
	
	<input type="text" class="form-control" id="amcgstvalue" name="amcgstvalue" required value="<?=$rowamc['amcgstvalue']?>" readonly>
	
  </div>
  </div>
 <div class="col-lg-3">
    <div class="form-group">
    <label for="btotalvalue">Total Amount</label>
	<input type="text" class="form-control" id="btotalvalue" name="btotalvalue" required value="<?=($rowamc['btotalvalue'])?$rowamc['btotalvalue']:''?>" readonly>
  </div>
  </div>  
  <div class="col-lg-3">
    <div class="form-group">
    <label for="totalvalue">Total Rounded Amount</label>
	<input type="text" class="form-control" id="totalvalue" name="totalvalue" required value="<?=$rowamc['totalvalue']?>" readonly>
  </div>
  </div> 
  
   <div class="col-lg-3" style="display:none">
    <div class="form-group">
    <label for="amcdetails">AMC Details</label>
	<input type="text" class="form-control" id="amcdetails" name="amcdetails" maxlength="200" value="<?=$rowamc['amcdetails']?>" >
  </div>
  </div> 
  <hr>
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedamount">Received Amount</label>
   <input type="number" min="0" class="form-control" name="receivedamount" id="receivedamount" value="<?=$rowamc['receivedamount']?>">
  </div> 
  </div> 
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedmode">Received Mode</label>
    <select class="form-control" name="receivedmode" id="receivedmode">
							<option value=""<?=($rowamc['receivedmode']=='')?'selected':''?> >Select</option>
							<option value="CASH"<?=($rowamc['receivedmode']=='CASH')?'selected':''?> >CASH</option>
							<option value="CHEQUE"<?=($rowamc['receivedmode']=='CHEQUE')?'selected':''?> >CHEQUE</option>
							<option value="G-PAY"<?=($rowamc['receivedmode']=='G-PAY')?'selected':''?> >G-PAY</option>
							<option value="PAYTM"<?=($rowamc['receivedmode']=='PAYTM')?'selected':''?> >PAYTM</option>
							<option value="PHONEPE"<?=($rowamc['receivedmode']=='PHONEPE')?'selected':''?> >PHONEPE</option>
							<option value="NEFT"<?=($rowamc['receivedmode']=='NEFT')?'selected':''?> >NEFT</option>
							<option value="RTGS"<?=($rowamc['receivedmode']=='RTGS')?'selected':''?> >RTGS</option>
							<option value="IMPS"<?=($rowamc['receivedmode']=='IMPS')?'selected':''?> >IMPS</option>
							<option value="UPI"<?=($rowamc['receivedmode']=='UPI')?'selected':''?> >UPI</option>
	
	</select>
     </div>
  </div> 
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receiveddate">Received Date</label>
      <input type="date"  class="form-control" name="receiveddate" id="receiveddate" value="<?=$rowamc['receiveddate']?>">
    </div>
  </div> 
    <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedby">Received By</label>
	<input type="text" class="form-control" name="receivedby" id="receivedby" value="<?=$rowamc['receivedby']?>"></div>
  </div> 
 
   <div class="col-lg-3">
    <div class="form-group">
	<label for="remarks">Remarks</label>
   <input type="text" class="form-control" name="remarks" id="remarks" value="<?=$rowamc['remarks']?>"></div>
  </div> 
  </div> 
  
 

			<?php
		}
					//Amc quotation convert to amc
else if(isset($_GET['qid']))
		{
			$qid=mysqli_real_escape_string($connection,$_GET['qid']);
				$sqlq = "SELECT maintenancetype, dateto, datefrom,noofmonths,qno,qdate,id,priceperyear,serialnumber,resultvalue,quantity,amcgst,amcgstvalue,totalvalue,btotalvalue,quotationtype,amcrenewtype  From jrcamcquotation where sourceid='".(mysqli_real_escape_string($connection, $_GET['xlid']))."' and id='".$qid."'";
				  
        $queryq = mysqli_query($connection, $sqlq);
		
        $rowCountq = mysqli_num_rows($queryq);
         
        if(!$queryq){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
		if($rowCountq > 0)
		{
$rowq = mysqli_fetch_array($queryq); 
			?>
			<input type="hidden" name="quotationid" value="<?=$_GET['qid']?>">
			<input type="hidden" name="qdate" value="<?=$_GET['qdate']?>">
			<input type="hidden" name="qno" value="<?=$rowq['qno']?>">
<div class="row">
<?php
$sqls=mysqli_query($connection,"select amcinvoiceno from jrcamcinvoice");
$infos=mysqli_fetch_array($sqls);
$amcinvoicenofrom=(float)$infos['amcinvoiceno']+1;
$amcinvoicenoto=(float)$infos['amcinvoiceno'];
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amctype">Type</label>
      <select class="form-control" id="amcrenewtype" name="amcrenewtype" required>
<option value="">Select</option>
<option value="AMC" <?=($rowq['amcrenewtype']=='AMC' || $rowq['amcrenewtype']=='')?'selected':''?>>AMC</option>
<option value="Renewal" <?=$rowq['amcrenewtype']=='Renewal'?'selected':''?>>Renewal</option>
</select></div>
</div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amcinvoiceno">AMC Invoice No</label>
	<input type="text" class="form-control" id="amcinvoiceno" name="amcinvoiceno" placeholder="AMC Invoice No" value="<?='SR/AMC/'.(date('my')).'/'.(str_pad($amcinvoicenofrom, 4, '0', STR_PAD_LEFT))?>" readonly>
  </div>
  </div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amctype">AMC Type</label>
<select class="form-control" id="amctype" name="amctype" required>
<option value=""<?=($rowq['maintenancetype']=='')?'selected':''?>>Select</option>
<option value="Monthly" <?=($rowq['maintenancetype']=='Monthly')?'selected':''?>>Monthly</option>
<option value="Quarterly"<?=($rowq['maintenancetype']=='Quarterly')?'selected':''?>>Quarterly</option>
<option value="Half Yearly" <?=($rowq['maintenancetype']=='Half Yearly')?'selected':''?>>Half Yearly</option>
<option value="Annually" <?=($rowq['maintenancetype']=='Annually')?'selected':''?>>Annually</option>
</select>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="quotationtype">Quotation Type</label>

	<select class="form-control" id="quotationtype" name="quotationtype" required >
	
	<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcamcquotationtype order by id asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>" <?=($rowq['quotationtype']==$rowrep['id'])?"selected":""?>><?=$rowrep['quotationtype']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="priceperyear">Price for 12 Months</label>
	<input type="text" class="form-control" id="priceperyear" name="priceperyear"  value="<?=$rowq['priceperyear']?>" onchange="valuefun()" required>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="amcduration">AMC Duration <span class="text-danger">(In Months)</span></label>
	<input type="number" class="form-control" id="amcduration" name="amcduration" value="<?=$rowq['noofmonths']?>" onchange="valuefun();monthupdate()"  required>
  </div>
  </div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="datefrom">AMC Date From</label>
	<input type="date" class="form-control" id="datefrom" name="datefrom" value="<?=$rowq['datefrom']?>" onchange="monthupdate()" required>
  </div>
  </div>
 <div class="col-lg-3">
    <div class="form-group">
    <label for="dateto">AMC Date To</label>
	<input type="date" class="form-control" id="dateto" name="dateto" value="<?=$rowq['dateto']?>" onchange="monthupdate()" required readonly>
  </div>
  </div> 
  


  <div class="col-lg-3">
    <div class="form-group">
    <label for="serialnumber">Serial Number</label>

	
	<select class="form-control fav_clr" name="serialnumber[]" id="serialnumber"  onchange="valuefun()" multiple>
	<option value="">Select</option>
	<?php
	$serials=$rowq['serialnumber'];
	$seri=explode('|',$serials);
	$serialnumbers=array();
	
	$serialnumbers=explode(",",$serials);
	if(!empty($serialnumbers))
				  {
					  foreach($serialnumbers as $ser)
					  {
						  $serialnumbers[]=$ser;
						 ?>
						  <option value="<?=$ser?>" <?=(in_array($ser,$serialnumbers))?'selected':''?> ><?=$ser?></option>
	<?php
					  }
				  }	  ?>
		</select>
  </div>
  </div>
  

<div class="col-lg-3">
    <div class="form-group">
    <label for="quantity">Quantity</label>
	<input type="text" class="form-control" id="quantity" name="quantity"  value="<?=$rowq['quantity']?>"  onchange="valuefun()"  required readonly>
  </div>
  </div>
 <div class="col-lg-3">
    <div class="form-group">
    <label for="resultvalue">Value</label>
	<input type="number" class="form-control" id="resultvalue" name="resultvalue"  value="<?=$rowq['resultvalue']?>" onchange="valuefun()" step="0.01" readonly required>
  </div>
  </div> <div class="col-lg-3">
    <div class="form-group">
    <label for="amcgst">GST %</label>
	<input type="text" class="form-control" id="amcgst" name="amcgst"  value="<?=$rowq['amcgst']?>" onchange="valuefun()" readonly required>
  </div>
  </div>
  

<div class="col-lg-3">
    <div class="form-group">
    <label for="amcgstvalue">GST Value</label>
	<input type="text" class="form-control" id="amcgstvalue" name="amcgstvalue"  value="<?=$rowq['amcgstvalue']?>" onchange="valuefun()"  readonly required>
  </div>
  </div>
 <div class="col-lg-3">
    <div class="form-group">
    <label for="totalvalue">Total Amount</label>
	<input type="text" class="form-control" id="btotalvalue" name="btotalvalue"  value="<?=$rowq['btotalvalue']?>" onchange="valuefun()" readonly required>
  </div>
  </div> 
  <div class="col-lg-3">
    <div class="form-group">
    <label for="totalvalue">Total Rounded Amount</label>
	<input type="text" class="form-control" id="totalvalue" name="totalvalue"  value="<?=$rowq['totalvalue']?>" onchange="valuefun()" readonly required>
  </div>
  </div> 
  
   <div class="col-lg-3" style="display:none">
    <div class="form-group">
    <label for="amcdetails">AMC Details</label>
	<input type="text" class="form-control" id="amcdetails" name="amcdetails"  maxlength="200" value="<?=$rowq['qno'].' | '.$rowq['qdate']?>" >
  </div>
  </div> 
  <hr>
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedamount">Received Amount</label>
   <input type="number" min="0" class="form-control" name="receivedamount" id="receivedamount">
  </div> 
  </div> 
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedmode">Received Mode</label>
    <select class="form-control" name="receivedmode" id="receivedmode">
							<option value="" >Select</option>
							<option value="CASH" >CASH</option>
							<option value="CHEQUE" >CHEQUE</option>
							<option value="G-PAY" >G-PAY</option>
							<option value="PAYTM" >PAYTM</option>
							<option value="PHONEPE" >PHONEPE</option>
							<option value="NEFT" >NEFT</option>
							<option value="RTGS" >RTGS</option>
							<option value="IMPS" >IMPS</option>
							<option value="UPI" >UPI</option>
	</select>
     </div>
  </div> 
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receiveddate">Received Date</label>
      <input type="date"  class="form-control" name="receiveddate" id="receiveddate">
    </div>
  </div> 
    <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedby">Received By</label>
	<input type="text" class="form-control" name="receivedby" id="receivedby"></div>
  </div> 
 
   <div class="col-lg-3">
    <div class="form-group">
	<label for="remarks">Remarks</label>
   <input type="text" class="form-control" name="remarks" id="remarks" ></div>
  </div> 
  </div> 
 
<?php
 }
		}
		
		else
		{
			?>
			
			
			<!--AMC Renewal Add-->
			<div class="row">
			<div class="col-lg-12">
<a href="amcrenewal.php?consigneeid=<?=$_GET['consigneeid']?>&xlid=<?=$_GET['xlid']?>" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-list fa-sm text-white-50"></i>Previous AMC History</a>
               </div>
			<?php
$sqls=mysqli_query($connection,"select amcinvoiceno from jrcamcinvoice");
$infos=mysqli_fetch_array($sqls);
$amcinvoicenofrom=(float)$infos['amcinvoiceno']+1;
$amcinvoicenoto=(float)$infos['amcinvoiceno'];
?>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amctype">Type</label>
      <select class="form-control" id="amcrenewtype" name="amcrenewtype" required>
<option value="">Select</option>
<option value="AMC">AMC</option>
<option value="Renewal" selected>Renewal</option>
</select></div>
</div>
<div class="col-lg-3">
    <div class="form-group">
    <label for="amcinvoiceno">AMC Invoice No</label>
	<input type="text" class="form-control" id="amcinvoiceno" name="amcinvoiceno" placeholder="AMC Invoice No" value="<?='SR/AMC/'.(date('my')).'/'.(str_pad($amcinvoicenofrom, 4, '0', STR_PAD_LEFT))?>" readonly>
  </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="amctype">AMC Type</label>
	<select class="form-control" id="amctype" name="amctype" required>
<option value="">Select</option>
<option value="Monthly">Monthly</option>
<option value="Quarterly">Quarterly</option>
<option value="Half Yearly">Half Yearly</option>
<option value="Annually">Annually</option>
</select>
  </div>
  </div>
   <div class="col-lg-3">
  <div class="form-group">
    <label for="quotationtype">Quotation Type</label>
	<select class="form-control" id="quotationtype" name="quotationtype" required>
	
	<option value="">Select</option>
<?php
$sqlrep = "SELECT * From jrcamcquotationtype order by id asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			while($rowrep = mysqli_fetch_array($queryrep)) 
			{
				?>
<option value="<?=$rowrep['id']?>"><?=$rowrep['quotationtype']?></option>
<?php
			}
		}
		?>
</select>
</div>
 </div>	
 <div class="col-lg-3">
    <div class="form-group">
    <label for="priceperyear">Price for 12 Months</label>
	<?php $sqlxl = "SELECT * From jrcxl where id='".$_GET['xlid']."' ";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowxl = mysqli_fetch_array($queryxl);
				
	
			$sqlselect1 = "SELECT DISTINCT stockitem, amcvalue,amcgst From jrcproduct where stockitem='".$rowxl['stockitem']."' order by id asc";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowselect1 = mysqli_fetch_array($queryselect1);
	?>
	<input type="text" class="form-control" id="priceperyear" name="priceperyear" value="<?=$rowselect1['amcvalue']?>" onchange="valuefun()" >
  </div>
  </div> 
  <div class="col-lg-3">
    <div class="form-group">
    <label for="amcduration">AMC Duration <span class="text-danger">(In Months)</span></label>
	<input type="number" class="form-control" id="amcduration" name="amcduration" required onchange="valuefun();monthupdate()">
  </div>
  </div>
  

<div class="col-lg-3">
    <div class="form-group">
    <label for="datefrom">AMC Date From</label>
	<input type="date" class="form-control" id="datefrom" name="datefrom" required onchange="monthupdate()" >
  </div>
  </div>
 <div class="col-lg-3">
    <div class="form-group">
    <label for="dateto">AMC Date To</label>
	<input type="date" class="form-control" id="dateto" name="dateto" required onchange="monthupdate()" readonly>
  </div>
  </div> 
  
   
  <div class="col-lg-3">
    <div class="form-group">
    <label for="serialnumber">Serial Number</label>
	<select class="form-control fav_clr" name="serialnumber[]" id="serialnumber" multiple >
	<option value="">Select</option>
	
	<?php
	$serialnumbers=array();
	$serialnumbers=explode("|",$serialnumber);
	print_r($serialnumbers);
	if(!empty($serialnumbers))
				  {
					  foreach($serialnumbers as $ser)
					  {
						  $serialnumbers[]=$ser;
						 ?>
						  <option value="<?=$ser?>"><?=$ser?></option>
	<?php
					  }
				  }	  ?>
		</select>
		
		
		
		
		
		</div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
    <label for="quantity">Quantity</label>
	<input type="text" class="form-control" id="quantity" name="quantity" onchange="valuefun();qtyfun()"   required readonly>
  </div>
  </div> 
  <div class="col-lg-3">
    <div class="form-group">
    <label for="resultvalue">Value</label>
	<input type="number" class="form-control" id="resultvalue" name="resultvalue" readonly onchange="valuefun()" >
  </div>
  </div> 
  <div class="col-lg-3">
    <div class="form-group">
    <label for="amcgst">GST%</label>
	<input type="text" class="form-control" id="amcgst" name="amcgst" value="<?=$rowselect1['amcgst']?>" readonly>
  </div>
  </div> 
  <div class="col-lg-3">
    <div class="form-group">
    <label for="amcgstvalue">GST Value</label>
	<input type="text" class="form-control" id="amcgstvalue" name="amcgstvalue" readonly>
  </div>
  </div> 
  <div class="col-lg-3">
    <div class="form-group">
    <label for="btotalvalue">Total Amount</label>
	<input type="text" class="form-control" id="btotalvalue" name="btotalvalue" readonly>
  </div>
  </div> 
  
  <div class="col-lg-3">
    <div class="form-group">
    <label for="totalvalue">Total Rounded Amount</label>
	<input type="text" class="form-control" id="totalvalue" name="totalvalue" readonly>
  </div>
  </div> 
  <div class="col-lg-3"style="display:none">
    <div class="form-group">
    <label for="amcdetails">AMC Details</label>
	<input type="text" class="form-control" id="amcdetails" name="amcdetails"  maxlength="200">
  </div>
  </div> 
  
 <hr>
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedamount">Received Amount</label>
   <input type="number" min="0" class="form-control" name="receivedamount" id="receivedamount">
  </div> 
  </div> 
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedmode">Received Mode</label>
    <select class="form-control" name="receivedmode" id="receivedmode">
							<option value="">Select</option>
							<option value="CASH">CASH</option>
							<option value="CHEQUE">CHEQUE</option>
							<option value="G-PAY">G-PAY</option>
							<option value="PAYTM">PAYTM</option>
							<option value="PHONEPE">PHONEPE</option>
							<option value="NEFT">NEFT</option>
							<option value="RTGS">RTGS</option>
							<option value="IMPS">IMPS</option>
							<option value="UPI">UPI</option>
	</select>
     </div>
  </div> 
   <div class="col-lg-3">
    <div class="form-group">
      <label for="receiveddate">Received Date</label>
      <input type="date"  class="form-control" name="receiveddate" id="receiveddate">
    </div>
  </div> 
    <div class="col-lg-3">
    <div class="form-group">
      <label for="receivedby">Received By</label>
	<input type="text" class="form-control" name="receivedby" id="receivedby"></div>
  </div> 
 
   <div class="col-lg-3">
    <div class="form-group">
	<label for="remarks">Remarks</label>
   <input type="text" class="form-control" name="remarks" id="remarks">
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
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
	<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
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
	<script>
	
	$(document).on('change','#serialnumber',function(){

var rr = $('#serialnumber :selected').length;
$('#quantity').val(rr);
    // console.log(rr);
	valuefun();
});

</script>
<script>
function valuefun()
{
	var priceperyear = document.getElementById("priceperyear").value;
	if(priceperyear=='')
	{
		priceperyear=0;
	}
	var amcduration = document.getElementById("amcduration").value;
	if(amcduration=='')
	{
		amcduration=0;
	}
	document.getElementById("resultvalue").value =((parseFloat(priceperyear)/12)*parseFloat(amcduration)).toFixed(2);
	
	qtyfun();
}
 </script>	

<script>
function qtyfun()
{
	var quantity = document.getElementById("quantity").value;
	if(quantity=='')
	{
		quantity=0;
	}
	var resultvalue = document.getElementById("resultvalue").value;
if(resultvalue=='')
	{
		resultvalue=0;
	}
	
		document.getElementById("resultvalue").value =(parseFloat(quantity)*parseFloat(resultvalue));
	
	gstfun();
}
</script>
<script>
function gstfun()
{
	var resultvalue = document.getElementById("resultvalue").value;
	var amcgst = document.getElementById("amcgst").value;
	if(amcgst=='')
	{
		amcgst=0;
	}
	document.getElementById("amcgstvalue").value =((parseFloat(resultvalue)/100)*parseFloat(amcgst)).toFixed(2);
	netfun();
}
</script>
<script>
function netfun()
{
	var amcgstvalue = document.getElementById("amcgstvalue").value;
	var resultvalue = document.getElementById("resultvalue").value;
	document.getElementById("btotalvalue").value =parseFloat(resultvalue)+parseFloat(amcgstvalue);
	document.getElementById("totalvalue").value =Math.round(parseFloat(resultvalue)+parseFloat(amcgstvalue));
}
</script>
	
	
<script>
  $(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  placeholder: ''
    });
});
  $('.fav_clr').on("select2:select", function (e) { 
           var data = e.params.data.text;
           if(data=='all'){
            $(".fav_clr > option").prop("selected","selected");
            $(".fav_clr").trigger("change");
           }
      });
</script>
<script>
function add_months(dt, n) 
 {
   return new Date(dt.setMonth(dt.getMonth() + n));      
 }
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
} 
 function monthupdate()
 {
	 var amcduration=document.getElementById("amcduration");
	 var datefrom=document.getElementById("datefrom");
	 var dateto=document.getElementById("dateto");
	 if((amcduration.value!="")&&(datefrom.value!=""))
	 {
		 var str=datefrom.value;
		 console.log(str);
		 var res = str.split("-");
		 var dt = new Date(res[0],res[1],res[2]);
		 dt=add_months(dt, parseInt(amcduration.value)-1);
		 dt.setDate(dt.getDate() - 1);		 
		 dateto.value=formatDate(dt.toString());
	 }
	 
 }
</script>
</body>
</html>
