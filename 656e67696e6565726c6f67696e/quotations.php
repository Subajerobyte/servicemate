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
  <title><?=$_SESSION['companyname']?> - Jerobyte - Quotations</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
</head>
<body id="page-top"  onload="getGeolocation()">
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Quotations</h1>
            <!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
          <div class="row">
 <div class="col-lg-12">
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
  $opencallstatus=0;
 if(isset($_GET['id']))
 {
$quoteid=mysqli_real_escape_string($connection, $_GET['id']);
?>	 
 <div class="row">
    <div class="col-sm-12 mb-2">
      <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Search..">
	  <span class="text-black-50 small">Hints: Open, Pending, Date, Mobile, Name, Address</span>
    </div>
  </div>
  <a href="quotationgen.php?id=<?=$quoteid?>" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> New Quotation</a>
 <div class="row" id="myItems">
 <?php
		$sqlselect = "SELECT * From jrcquotation where engineerid='".$id."' and calltid='".$quoteid."' group by qno, qdate order by id desc";
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
					$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
				  	$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
					$querycons = mysqli_query($connection, $sqlcons);
					$rowCountcons = mysqli_num_rows($querycons);
					if(!$querycons){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					if($rowCountcons>0)
					{
					$rowcons = mysqli_fetch_array($querycons);
					if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowcons['address1']!='')
		{
		$rowcons['address1']=jbsdecrypt($encpass, $rowcons['address1']);
		}
		if($rowcons['phone']!='')
		{
		$rowcons['phone']=jbsdecrypt($encpass, $rowcons['phone']);
		}
		if($rowcons['mobile']!='')
		{
		$rowcons['mobile']=jbsdecrypt($encpass, $rowcons['mobile']);
		}
		if($rowcons['email']!='')
		{
		$rowcons['email']=jbsdecrypt($encpass, $rowcons['email']);
		}
	}
}
		
					 if($rowselect['compstatus']=='2')
					  {
						$bg="bg-success";
						$bgtext="Completed";
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						$bg="bg-warning";
						$bgtext="Pending";
					  }
					  else
					 {
						 $bg="bg-danger";
						$bgtext="Open";
					  }
					  ?>
		<div class="col-lg-6 mb-4 items">
                                    <div class="card shadow">
									<div class="card-header <?=$bg?> text-white ">
									<?=$rowselect['qno']?> - <?=date('d/m/Y',strtotime($rowselect['qdate']))?> - <?=$bgtext?>
									</div>
                                        <div class="card-body">
										<?php
										$sqlquotation=mysqli_query($connection, "select quotationtype from jrcquotationtype where id='".$rowselect['quotationtype']."'");
										$infoquotation=mysqli_fetch_array($sqlquotation);
										?>
										
										<h4><?=$infoquotation['quotationtype']?></h4>
                                            <p>Generated On <?=date('d/m/Y h:i:s a', strtotime($rowselect['createdon']))?></p>
											<hr>
											<h5 class="mb-1">Customer Details:</h5>
											<p><?=$rowcons['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
											if($rowcons['latlong']!='')
											{
											?>	
											<br>
											<a class="text-primary" style="cursor:pointer" onclick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a>
											<?php
											}
											?>
											</p>
											
				<?php 
				$i=1;
				$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='PRODUCT' order by id asc";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
			?>
			<hr>
			<h5 class="mb-2">Product Details:</h5>
			<?php
        	while($rowselect2 = mysqli_fetch_array($queryselect2)) 
			{
				
				$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$rowxl = mysqli_fetch_array($queryxl);
				?>				

			<h6 class="mb-2 font-weight-bold">Product <?=$i?>:</h6>
											<p class="mb-1"><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowxl['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowxl['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowxl['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowxl['stockitem']?>
												<?php
												}
												
												?></p>
											
<span class="text-primary" id="opendetails<?=$count?>p<?=$i?>" onclick="opendetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Product Details</span>
<span class="text-primary" id="hidedetails<?=$count?>p<?=$i?>" onclick="hidedetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Product Details</span>
<script>
function opendetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("detailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hidedetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("opendetails<?=$count?>p<?=$i?>").style.display="none";
}
function hidedetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("detailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hidedetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("opendetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="detailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>Product Main Category</th>
        <td><?=$rowxl['stockmaincategory']?> </td>
    </tr>
    <tr>
        <th>Product Sub Category</th>
        <td><?=$rowxl['stocksubcategory']?> </td>
    </tr>
    <tr>
        <th>Product Name</th>
        <td><?=$rowxl['stockitem']?> </td>
    </tr>
    <tr>
        <th>Type of Product</th>
        <td><?=$rowxl['typeofproduct']?> </td>
    </tr>
    <tr>
        <th>Component Type</th>
        <td><?=$rowxl['componenttype']?> </td>
    </tr>
    <tr>
        <th>Component Name</th>
        <td><?=$rowxl['componentname']?> </td>
    </tr>
    <tr>
        <th>Make</th>
        <td><?=$rowxl['make']?> </td>
    </tr>
    <tr>
        <th>Capacity</th>
        <td><?=$rowxl['capacity']?> </td>
    </tr>
    <tr>
        <th>Warranty</th>
        <td><?=$rowxl['warranty']?> </td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?=$rowxl['description']?> </td>
    </tr>
</table>
											</div>
<br>											
											
<span class="text-primary" id="openqdetails<?=$count?>p<?=$i?>" onclick="openqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Quotation Details</span>
<span class="text-primary" id="hideqdetails<?=$count?>p<?=$i?>" onclick="hideqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Quotation Details</span>
				<hr>
<script>
function openqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="none";
}
function hideqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="qdetailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>Price</th>
        <td class="text-right">Rs. <?=$rowselect2['saleprice']?></td>
    </tr>
    <tr>
        <th>No of Quantities</th>
        <td class="text-right"><?=$rowselect2['salequantity']?> </td>
    </tr>
    <tr>
        <th>Installation Cost</th>
        <td class="text-right">Rs. <?=$rowselect2['salesinstallcost']?> </td>
    </tr>
    <tr>
        <th>Total Cost</th>
        <td class="text-right">Rs. <?=$rowselect2['salestotal']?> </td>
    </tr>
	<tr>
        <th>GST</th>
        <td class="text-right"><?=$rowselect2['gst']?>% </td>
    </tr>
    <tr>
        <th>Total GST</th>
        <td class="text-right">Rs. <?=$rowselect2['salesgst']?> </td>
    </tr>
    <tr>
        <th>Net Total</th>
        <td class="text-right">Rs. <?=$rowselect2['salesnettotal']?> </td>
    </tr>
    <tr>
        <th>No of Scraps</th>
        <td class="text-right"><?=$rowselect2['salescrap']?> </td>
    </tr>
    <tr>
        <th>Scrap Value</th>
        <td class="text-right">Rs. <?=$rowselect2['salescrapvalue']?> </td>
    </tr>
    <tr>
        <th>Grand Total</th>
        <td class="text-right">Rs. <?=$rowselect2['salesgrandtotal']?> </td>
    </tr>
</table>

										  
					                    </div>
									<?php
									$i++;
				}
		}
?>				

<?php 
				$i=1;
				$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='SCRAP' order by id asc";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
			?>
			<h5 class="mb-2">Scrap Product Details:</h5>
			<?php
        	while($rowselect2 = mysqli_fetch_array($queryselect2)) 
			{
				
				$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$rowxl = mysqli_fetch_array($queryxl);
				?>				
		
			<h6 class="mb-2 text-danger font-weight-bold">Scrap Product <?=$i?>:</h6>
											<p class="mb-1"><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowxl['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowxl['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowxl['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowxl['stockitem']?>
												<?php
												}
												
												?></p>
											
<span class="text-danger" id="opensdetails<?=$count?>p<?=$i?>" onclick="opensdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Product Details</span>
<span class="text-danger" id="hidesdetails<?=$count?>p<?=$i?>" onclick="hidesdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Product Details</span>
<script>
function opensdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("sdetailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hidesdetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("opensdetails<?=$count?>p<?=$i?>").style.display="none";
}
function hidesdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("sdetailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hidesdetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("opensdetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="sdetailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>Product Main Category</th>
        <td><?=$rowxl['stockmaincategory']?> </td>
    </tr>
    <tr>
        <th>Product Sub Category</th>
        <td><?=$rowxl['stocksubcategory']?> </td>
    </tr>
    <tr>
        <th>Product Name</th>
        <td><?=$rowxl['stockitem']?> </td>
    </tr>
    <tr>
        <th>Type of Product</th>
        <td><?=$rowxl['typeofproduct']?> </td>
    </tr>
    <tr>
        <th>Component Type</th>
        <td><?=$rowxl['componenttype']?> </td>
    </tr>
    <tr>
        <th>Component Name</th>
        <td><?=$rowxl['componentname']?> </td>
    </tr>
    <tr>
        <th>Make</th>
        <td><?=$rowxl['make']?> </td>
    </tr>
    <tr>
        <th>Capacity</th>
        <td><?=$rowxl['capacity']?> </td>
    </tr>
</table>
											</div>
<br>											
											
<span class="text-danger" id="openqdetails<?=$count?>p<?=$i?>" onclick="openqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Quotation Details</span>
<span class="text-danger" id="hideqdetails<?=$count?>p<?=$i?>" onclick="hideqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Quotation Details</span>
<script>
function openqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="none";
}
function hideqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="qdetailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>No of Scraps</th>
        <td class="text-right"><?=$rowselect2['salescrap']?> </td>
    </tr>
    <tr>
        <th>Scrap Value</th>
        <td class="text-right">Rs. <?=$rowselect2['salescrapvalue']?> </td>
    </tr>
    <tr>
        <th>Grand Total</th>
        <td class="text-right">Rs. <?=$rowselect2['salesgrandtotal']?> </td>
    </tr>
</table>

										  
					                    </div>
										<hr>
									<?php
									$i++;
				}
		}
?>				

<h6>Product Price: Rs. <?=$rowselect['prototal']?>/-</h6>
<h6>Scrap Price: Rs. <?=$rowselect['scrtotal']?>/-</h6>
										<h3>Rs. <?=$rowselect['gratotal']?>/-</h3>
										<?php
										if($rowselect['compstatus']=='0')
										{
											?>										
										<a href="quotationprint.php?id=<?=$rowselect['id']?>" target="_blank" class="btn btn-primary btn-sm">Print Quotation</a>
										<?php
										}
										?>
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
 <?php
 }
 else if(isset($_GET['status']))
 {
	 $Q='';
	 if($_GET['status']!='ALL')
	 {
		 $Q='and compstatus="'.mysqli_real_escape_string($connection,$_GET['status']).'"';
	 }
?>	 
 <div class="row">
    <div class="col-sm-12 mb-3">
      <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Search..">
	  <span class="text-black-50 small">Hints: Open, Pending, Date, Mobile, Name, Address</span>
    </div>
  </div>
 <div class="row" id="myItems">
 <?php
		$sqlselect = "SELECT * From jrcquotation where engineerid='".$id."' ".$Q." group by qno, qdate order by id desc";
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
					$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
				  	$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
					$querycons = mysqli_query($connection, $sqlcons);
					$rowCountcons = mysqli_num_rows($querycons);
					if(!$querycons){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					if($rowCountcons>0)
					{
					$rowcons = mysqli_fetch_array($querycons);
					if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowcons['address1']!='')
		{
		$rowcons['address1']=jbsdecrypt($encpass, $rowcons['address1']);
		}
		if($rowcons['phone']!='')
		{
		$rowcons['phone']=jbsdecrypt($encpass, $rowcons['phone']);
		}
		if($rowcons['mobile']!='')
		{
		$rowcons['mobile']=jbsdecrypt($encpass, $rowcons['mobile']);
		}
		if($rowcons['email']!='')
		{
		$rowcons['email']=jbsdecrypt($encpass, $rowcons['email']);
		}
	}
}
		
					 if($rowselect['compstatus']=='2')
					  {
						$bg="bg-success";
						$bgtext="Completed";
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						$bg="bg-warning";
						$bgtext="Pending";
					  }
					  else
					 {
						 $bg="bg-danger";
						$bgtext="Open";
					  }
					  ?>
		<div class="col-lg-6 mb-4 items">
                                    <div class="card shadow">
									<div class="card-header <?=$bg?> text-white ">
									<?=$rowselect['qno']?> - <?=date('d/m/Y',strtotime($rowselect['qdate']))?> - <?=$bgtext?>
									</div>
                                        <div class="card-body">
										<?php
										$sqlquotation=mysqli_query($connection, "select quotationtype from jrcquotationtype where id='".$rowselect['quotationtype']."'");
										$infoquotation=mysqli_fetch_array($sqlquotation);
										?>
										
										<h4><?=$infoquotation['quotationtype']?></h4>
                                            <p>Generated On <?=date('d/m/Y h:i:s a', strtotime($rowselect['createdon']))?></p>
											<hr>
											<h5 class="mb-1">Customer Details:</h5>
											<p><?=$rowcons['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
											if($rowcons['latlong']!='')
											{
											?>	
											<br>
											<a class="text-primary" style="cursor:pointer" onclick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a>
											<?php
											}
											?>
											</p>
											
				<?php 
				$i=1;
				$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='PRODUCT' order by id asc";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
			?>
			<hr>
			<h5 class="mb-2">Product Details:</h5>
			<?php
        	while($rowselect2 = mysqli_fetch_array($queryselect2)) 
			{
				
				$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$rowxl = mysqli_fetch_array($queryxl);
				?>				

			<h6 class="mb-2 font-weight-bold">Product <?=$i?>:</h6>
											<p class="mb-1"><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowxl['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowxl['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowxl['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowxl['stockitem']?>
												<?php
												}
												
												?></p>
											
<span class="text-primary" id="opendetails<?=$count?>p<?=$i?>" onclick="opendetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Product Details</span>
<span class="text-primary" id="hidedetails<?=$count?>p<?=$i?>" onclick="hidedetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Product Details</span>
<script>
function opendetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("detailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hidedetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("opendetails<?=$count?>p<?=$i?>").style.display="none";
}
function hidedetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("detailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hidedetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("opendetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="detailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>Product Main Category</th>
        <td><?=$rowxl['stockmaincategory']?> </td>
    </tr>
    <tr>
        <th>Product Sub Category</th>
        <td><?=$rowxl['stocksubcategory']?> </td>
    </tr>
    <tr>
        <th>Product Name</th>
        <td><?=$rowxl['stockitem']?> </td>
    </tr>
    <tr>
        <th>Type of Product</th>
        <td><?=$rowxl['typeofproduct']?> </td>
    </tr>
    <tr>
        <th>Component Type</th>
        <td><?=$rowxl['componenttype']?> </td>
    </tr>
    <tr>
        <th>Component Name</th>
        <td><?=$rowxl['componentname']?> </td>
    </tr>
    <tr>
        <th>Make</th>
        <td><?=$rowxl['make']?> </td>
    </tr>
    <tr>
        <th>Capacity</th>
        <td><?=$rowxl['capacity']?> </td>
    </tr>
    <tr>
        <th>Warranty</th>
        <td><?=$rowxl['warranty']?> </td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?=$rowxl['description']?> </td>
    </tr>
</table>
											</div>
<br>											
											
<span class="text-primary" id="openqdetails<?=$count?>p<?=$i?>" onclick="openqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Quotation Details</span>
<span class="text-primary" id="hideqdetails<?=$count?>p<?=$i?>" onclick="hideqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Quotation Details</span>
				<hr>
<script>
function openqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="none";
}
function hideqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="qdetailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>Price</th>
        <td class="text-right">Rs. <?=$rowselect2['saleprice']?></td>
    </tr>
    <tr>
        <th>No of Quantities</th>
        <td class="text-right"><?=$rowselect2['salequantity']?> </td>
    </tr>
    <tr>
        <th>Installation Cost</th>
        <td class="text-right">Rs. <?=$rowselect2['salesinstallcost']?> </td>
    </tr>
    <tr>
        <th>Total Cost</th>
        <td class="text-right">Rs. <?=$rowselect2['salestotal']?> </td>
    </tr>
	<tr>
        <th>GST</th>
        <td class="text-right"><?=$rowselect2['gst']?>% </td>
    </tr>
    <tr>
        <th>Total GST</th>
        <td class="text-right">Rs. <?=$rowselect2['salesgst']?> </td>
    </tr>
    <tr>
        <th>Net Total</th>
        <td class="text-right">Rs. <?=$rowselect2['salesnettotal']?> </td>
    </tr>
    <tr>
        <th>No of Scraps</th>
        <td class="text-right"><?=$rowselect2['salescrap']?> </td>
    </tr>
    <tr>
        <th>Scrap Value</th>
        <td class="text-right">Rs. <?=$rowselect2['salescrapvalue']?> </td>
    </tr>
    <tr>
        <th>Grand Total</th>
        <td class="text-right">Rs. <?=$rowselect2['salesgrandtotal']?> </td>
    </tr>
</table>

										  
					                    </div>
									<?php
									$i++;
				}
		}
?>				

<?php 
				$i=1;
				$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect['qno']."' and qdate='".$rowselect['qdate']."' and qtype='SCRAP' order by id asc";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
			?>
			<h5 class="mb-2">Scrap Product Details:</h5>
			<?php
        	while($rowselect2 = mysqli_fetch_array($queryselect2)) 
			{
				
				$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				$rowxl = mysqli_fetch_array($queryxl);
				?>				
		
			<h6 class="mb-2 text-danger font-weight-bold">Scrap Product <?=$i?>:</h6>
											<p class="mb-1"><?php
												if($infolayoutproducts['stockmaincategory']=='1')
												{
													?>
												<?=$rowxl['stockmaincategory']?> - 
												<?php
												}
												if($infolayoutproducts['stocksubcategory']=='1')
												{
													?>
												<?=$rowxl['stocksubcategory']?> - 
												<?php
												}
												if($infolayoutproducts['componentname']=='1')
												{
													?>
												<?=$rowxl['componentname']?> - 
												<?php
												}
												if($infolayoutproducts['stockitem']=='1')
												{
													?>
												<?=$rowxl['stockitem']?>
												<?php
												}
												
												?></p>
											
<span class="text-danger" id="opensdetails<?=$count?>p<?=$i?>" onclick="opensdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Product Details</span>
<span class="text-danger" id="hidesdetails<?=$count?>p<?=$i?>" onclick="hidesdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Product Details</span>
<script>
function opensdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("sdetailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hidesdetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("opensdetails<?=$count?>p<?=$i?>").style.display="none";
}
function hidesdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("sdetailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hidesdetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("opensdetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="sdetailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>Product Main Category</th>
        <td><?=$rowxl['stockmaincategory']?> </td>
    </tr>
    <tr>
        <th>Product Sub Category</th>
        <td><?=$rowxl['stocksubcategory']?> </td>
    </tr>
    <tr>
        <th>Product Name</th>
        <td><?=$rowxl['stockitem']?> </td>
    </tr>
    <tr>
        <th>Type of Product</th>
        <td><?=$rowxl['typeofproduct']?> </td>
    </tr>
    <tr>
        <th>Component Type</th>
        <td><?=$rowxl['componenttype']?> </td>
    </tr>
    <tr>
        <th>Component Name</th>
        <td><?=$rowxl['componentname']?> </td>
    </tr>
    <tr>
        <th>Make</th>
        <td><?=$rowxl['make']?> </td>
    </tr>
    <tr>
        <th>Capacity</th>
        <td><?=$rowxl['capacity']?> </td>
    </tr>
</table>
											</div>
<br>											
											
<span class="text-danger" id="openqdetails<?=$count?>p<?=$i?>" onclick="openqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer">View Quotation Details</span>
<span class="text-danger" id="hideqdetails<?=$count?>p<?=$i?>" onclick="hideqdetailsdiv<?=$count?>p<?=$i?>()" style="cursor:pointer; display:none;">Hide Quotation Details</span>
<script>
function openqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="block";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="none";
}
function hideqdetailsdiv<?=$count?>p<?=$i?>()
{
	document.getElementById("qdetailsdiv<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("hideqdetails<?=$count?>p<?=$i?>").style.display="none";
	document.getElementById("openqdetails<?=$count?>p<?=$i?>").style.display="block";
}
</script>
<div id="qdetailsdiv<?=$count?>p<?=$i?>" style="display:none">
<table class="table table-bordered">
    <tr>
        <th>No of Scraps</th>
        <td class="text-right"><?=$rowselect2['salescrap']?> </td>
    </tr>
    <tr>
        <th>Scrap Value</th>
        <td class="text-right">Rs. <?=$rowselect2['salescrapvalue']?> </td>
    </tr>
    <tr>
        <th>Grand Total</th>
        <td class="text-right">Rs. <?=$rowselect2['salesgrandtotal']?> </td>
    </tr>
</table>

										  
					                    </div>
										<hr>
									<?php
									$i++;
				}
		}
?>				

<h6>Product Price: Rs. <?=$rowselect['prototal']?>/-</h6>
<h6>Scrap Price: Rs. <?=$rowselect['scrtotal']?>/-</h6>
										<h3>Rs. <?=$rowselect['gratotal']?>/-</h3>
										<?php
										if($rowselect['compstatus']=='0')
										{
											?>										
										<a href="quotationprint.php?id=<?=$rowselect['id']?>" target="_blank" class="btn btn-primary btn-sm">Print Quotation</a>
										<?php
										}
										?>
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
 <?php
 }
 else
 {
	 ?>
 <div class="row">
 <?php
				  $totalcalls=0;
				  $totalopen=0;
				  $totalpending=0;
				  $totalcomplete=0;
				  $todaycalls=0;
				  $todayopen=0;
				  $todaypending=0;
				  $todaycomplete=0;
				  $sqlcall = "SELECT * From jrcquotation where engineerid='".$id."' group by qno, qdate order by id desc";
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
				$totalcalls++;
				if($rowcall['compstatus']=='0')
				{
					$totalopen++;
				}
				if($rowcall['compstatus']=='1')
				{
					$totalpending++;
				}
				if($rowcall['compstatus']=='2')
				{
					$totalcomplete++;
				}
				if(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['createdon'])))
				{
					$todaycalls++;
					if($rowcall['compstatus']=='0')
					{
						$todayopen++;
					}
					if($rowcall['compstatus']=='1')
					{
						$todaypending++;
					}
					if($rowcall['compstatus']=='2')
					{
						$todaycomplete++;
					}
				}
			}
		}
		$result = mysqli_query($connection,"select year(createdon) as year, month(createdon) as month, count(id) as total_calls
from jrcquotation
group by year(createdon), month(createdon) order by id asc");
$i=0;
$months='';
$totals='';
while($row = mysqli_fetch_array($result)) 
{
	$month_name = date("F", mktime(0, 0, 0, $row["month"], 10));
	if($months=='')
	{		
	$months='"'.$row["year"].'-'.$month_name.'"';
	}
	else
	{
		$months.=', "'.$row["year"].'-'.$month_name.'"';
	}
	if($totals=='')
	{		
	$totals=''.$row["total_calls"].'';
	}
	else
	{
		$totals.=', '.$row["total_calls"].'';
	}
}
		?>
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card bg-primary text-white shadow h-100 py-1" role="button" onclick="window.location.href= 'quotations.php?status=ALL'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="font-weight-bold text-uppercase mb-1">Total Quotations</div>
                      <div class="h4 mb-1 font-weight-bold"><?=$totalcalls?></div>
					  <div class="h6 mb-1">(Today: <?=$todaycalls?>) Click here to View Quotations</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-phone fa-2x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-xl-6 col-md-6 mb-4">
              <div class="card bg-info text-white shadow h-100 py-1" role="button" onclick="window.location.href= 'quotations.php?status=0'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="font-weight-bold text-uppercase mb-1">Open Quotations</div>
                      <div class="h4 mb-1 font-weight-bold"><?=$totalopen?></div>
					  <div class="h6 mb-1">(Today: <?=$todayopen?>) Click here to View Quotations</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hourglass-half fa-2x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-xl-6 col-md-6 mb-4">
              <div class="card bg-success text-white shadow h-100 py-1" role="button" onclick="window.location.href= 'quotations.php?status=2'">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="font-weight-bold text-uppercase mb-1">Closed Quotations</div>
                      <div class="h4 mb-1 font-weight-bold"><?=$totalcomplete?></div>
					  <div class="h6 mb-1">(Today: <?=$todaycomplete?>) Click here to View Quotations</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check fa-2x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div> 
 <?php
 }
 ?>
			</div>
          </div>
        </div>
      </div>
      <?php include('footer.php') ?>
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
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script>
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
<script>
function mapsSelector(lat,lon) {
  if ((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) || (navigator.platform.indexOf("iPod") != -1))
  {
    window.open("maps://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
  }
else 
{
    window.open("https://maps.google.com/maps?daddr="+lat+","+lon+"&amp;ll=");
}
}
function myFunction() {
    var input, filter, cards, cardContainer, h5, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("items");
    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>
<script>
 function displayLocation(latitude,longitude)
 {
    var request = new XMLHttpRequest();
        var method = 'GET';
        var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg';
        var async = true;
        request.open(method, url, async);
        request.onreadystatechange = function(){
          if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
			console.log(data);
            var address = data.results[0];
			console.log(address.formatted_address);
            document.getElementById('daddress').innerHTML='<b>Your Current Location: </b>'+address.formatted_address;
          }
        };
        request.send();
      }
const demo = document.getElementById('demo');
    function error(err) {
        demo.innerHTML = `Failed to locate. Error: ${err.message}`;
    }
    function success(pos) {
        demo.innerHTML = '<b>Located:</b> '+`${pos.coords.latitude}, ${pos.coords.longitude}`;
		showPosition(pos);
		displayLocation(`${pos.coords.latitude}`, `${pos.coords.longitude}`);
        //alert(`${pos.coords.latitude}, ${pos.coords.longitude}`);
    }
    function getGeolocation() {
        if (navigator.geolocation) {
            demo.innerHTML = 'Locating…';
			navigator.geolocation.getCurrentPosition(success, error);
            setInterval(function(){
			  navigator.geolocation.getCurrentPosition(success, error);
			}, 30000);	
        } else { 
            demo.innerHTML = 'Geolocation is not supported by this browser.';
        }
    }
            function showPosition(position) 
			{
				var useremail="<?=$_SESSION['email']?>";
            $.ajax({
                    url: "livelocation.php",
                    type: "post",
                    data: { lati: position.coords.latitude, longi: position.coords.longitude, user:useremail},
                    success: function (data) {
						console.log(data);
                    }
                  });
            }  
</script>
<script>
var callid = "";
    function error1(err) {
        alert(`Failed to locate. Error: ${err.message}`);
    }
    function success1(pos) {
        alert('Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`);
		startposition(pos);
    }
    function startmylocation(id) {
		callid=id;
		var opencallstatus=<?=$opencallstatus?>;
		if(opencallstatus==0)
		{
		if (navigator.geolocation) {
            demo.innerHTML = 'Locating…';
            navigator.geolocation.getCurrentPosition(success1, error1);
        } else { 
            alert('Geolocation is not supported by this browser.');
        }
		}
		else
		{
			alert('Already A call has been Started, Please Complete that call before start new one');
		}
    }
    function startposition(position) 
	{
		var useremail="<?=$_SESSION['email']?>";
        $.ajax({
            url: "callstartlocation.php",
            type: "post",
            data: { lati: position.coords.latitude, longi: position.coords.longitude, callid:callid},
                success: function (data) {
				console.log(data);
				window.location.reload();
                  }
            });
    } 
</script>
<script>
var callid = "";
var startip = "";
    function error2(err) {
        alert(`Failed to locate. Error: ${err.message}`);
    }
    function success2(pos) {
        alert('Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`);
		endposition(pos);
    }
    function endlocation(ip,id) {
		callid=id;
		startip=ip;
        if (navigator.geolocation) {
            demo.innerHTML = 'Locating…';
            navigator.geolocation.getCurrentPosition(success2, error2);
        } else { 
            alert('Geolocation is not supported by this browser.');
        }
    }
    function endposition(position) 
	{
		var useremail="<?=$_SESSION['email']?>";
        $.ajax({
            url: "callendlocation.php",
            type: "post",
            data: { lati: position.coords.latitude, longi: position.coords.longitude, callid:callid, startip:startip},
                success: function (data) {
				console.log(data);
				window.location.reload();
                  }
            });
    } 
</script>
</body>
</html>