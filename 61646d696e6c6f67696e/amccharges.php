<?php
include('lcheck.php'); 

if($servicecharges=='0')
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
  <title><?=$_SESSION['companyname']?> - Jerobyte - AMC Charges</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/datatables/buttons.datatables.min.css">  
<link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">    
</head>
<body id="page-top">
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
          <?php include('accountnavbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
        
		  <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>AMC Charges</b></h1>
  </div>
</div>
		 
          <div class="row">
 <div class="col-lg-12">
 <?php
 if(isset($_GET['remarks']))
 {
	 ?>
	 <div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
	 <?php
 }
?> <?php
	$sqlselect = "SELECT distinct engineername From jrccalls order by id desc";
		$queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		
        if($rowCountselect > 0) 
		{
			while( $row = mysqli_fetch_assoc( $queryselect)){
    $new_array[] = $row; // Inside while loop
}}
	?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Service Charges Details</h6>
            </div>-->
            <div class="card-body">
<form action="amccharges.php" method="post">
<div class="row">
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="datefrom">AMC Date From</label>
    <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="AMC Date From" value="<?=(isset($_POST['datefrom']))?$_POST['datefrom']:((isset($_GET['datefrom']))?$_GET['datefrom']:'')?>" >
  </div>
</div>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="dateto">AMC Date To</label>
    <input type="date" class="form-control" id="dateto" name="dateto" placeholder="AMC Date To" value="<?=(isset($_POST['dateto']))?$_POST['dateto']:((isset($_GET['dateto']))?$_GET['dateto']:'')?>" >
  </div>
</div>

<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="rdatefrom">Received Date From</label>
    <input type="date" class="form-control" id="rdatefrom" name="rdatefrom" placeholder="Received Date From" value="<?=(isset($_POST['rdatefrom']))?$_POST['rdatefrom']:((isset($_GET['rdatefrom']))?$_GET['rdatefrom']:'')?>" >
  </div>
</div>
<div class="col-lg-3 text-left">
  <div class="form-group">
    <label for="rdateto">Received Date To</label>
    <input type="date" class="form-control" id="rdateto" name="rdateto" placeholder="Received Date To" value="<?=(isset($_POST['rdateto']))?$_POST['rdateto']:((isset($_GET['rdateto']))?$_GET['rdateto']:'')?>" >
  </div>
</div>

<div class="col-lg-3">
  <div class="form-group">
    <label for="cashstatus">Received Status</label>
	<select class="fav_clr form-control" name="cashstatus" id="cashstatus">
	<option value=" " <?=(isset($_POST['cashstatus'])&&($_POST['cashstatus']==''))?'selected':' '?>>Select</option>
				<option value="pending" <?=((isset($_POST['cashstatus'])&&($_POST['cashstatus']=='pending'))||(  isset($_GET['ty']) && $_GET['ty']=='0') )?'selected':''?>>Pending</option>
				<option value="collected"<?=((isset($_POST['cashstatus'])&&($_POST['cashstatus']=='collected'))||( isset($_GET['ty']) && $_GET['ty']=='collected'))?'selected':''?> >Collected</option>
			
	</select>
  </div>
</div>
<div class="col-lg-3">
  <div class="form-group">
    <label for="cashstatus">Received By</label>
	<select class="form-control" id="receivedby" name="receivedby" required>
    <option value="">Select</option>

    <!-- Coordinator Section -->
    <optgroup label="Coordinators">
    <?php
    $sqlcoordinator = "select coordinatorname as name, id from jrccoordinator order by name asc";
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
    </optgroup>

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
 <?php
 $staquex="";
				$staqu="";
				$paidamount=0;
				$pendingbalance=0;
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
				if(isset($_GET['ty']))
			{
				$subquer="";
			 if($_GET['ty']=='collected')
			 {
					if($subquer=="")
					{
						$subquer.=" (receivedamount!=' ')";
					}
					else
						{
						$subquer.=" or (receivedamount!=' ' )";
					}
			 }
			 else
			 {
				 if($subquer=="")
					{
						$subquer.=" (receivedamount='' or receivedamount='NULL')";
					}
					else
						{
						$subquer.=" or (receivedamount='' or receivedamount='NULL')";
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
						$staqu.=" and datefrom BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
					else
					{
						$staqu.=" and datefrom BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
					}
				}
				if(($_POST['rdatefrom'])&&($_POST['rdateto']))
				{
					if($staqu!="")
					{
						$staqu.=" and receiveddate BETWEEN '".$_POST['rdatefrom']."' AND '".$_POST['rdateto']."'";
					}
					else
					{
						$staqu.=" and receiveddate BETWEEN '".$_POST['rdatefrom']."' AND '".$_POST['rdateto']."'";
					}
				}
				
				if(isset($_POST['cashstatus']))
			{
				$subquer="";
			 if($_POST['cashstatus']=='collected')
			 {
					if($subquer=="")
					{
						$subquer.=" (receivedamount!=' ' )";
					}
					else
						{
						$subquer.=" or (receivedamount!=' ')";
					}
			 }
			 else if($_POST['cashstatus']=='pending')
			 {
				 if($subquer=="")
					{
						$subquer.=" (totalvalue!=' ' and receivedamount='' or receivedamount='NULL')";
					}
					else
						{
						$subquer.=" or (totalvalue!=' ' and receivedamount='' or receivedamount='NULL')";
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
 <div class="row">
 <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">AMC Revenue <span
                                            class="text-primary float-right">Total: Rs. <span
                                                id="totalservicerevenue"></span> </span></h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%; height:250px;"></canvas>
                                </div>
                            </div>
                        </div>
						 <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Collection Status</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="myPieChart" width="301" height="253" style="display: block; width: 301px; height: 253px;" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-6">
						</div>
 </div>

 <div class="card shadow mb-4">
            <div class="card-body">
				 <div class="floating-container"><div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div></div>
 <div class="table-responsive scroll">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
 <tr>
 <th class="text-center">S.NO</th>
 <th class="text-center">RECEIVED BY</th>
 <th class="text-center">CUSTOMER</th>
 <th class="text-center">PRODUCT</th>
 <th class="text-center">RECEIVED STATUS</th>
 <th class="text-center">RECEIVED MODE</th>
 <th class="text-center">RECEIVED ON</th>
 <th>NET TOTAL</th>
 <th>NET GST</th>
 <th>GRAND TOTAL</th>

 </tr>
 </thead>
 <tbody>
 <?php
 $count=1;
 $pendingbalance=0;
$grandtotal =0;
$totalsgstamt=0;
$totalscharge=0;
$totalamount=0;
$paidamount=0;
 "select * from jrcamc where  resultvalue!='0.00' and resultvalue!='0' and resultvalue!='' and resultvalue is not null ".$staqu." order by cast(datefrom as date) desc";
$sqli=mysqli_query($connection, "select * from jrcamc where  resultvalue!='0.00' and resultvalue!='0' and resultvalue!='' and resultvalue is not null ".$staqu." order by cast(datefrom as date) desc");
 if(!$sqli){
           die("SQL query failed: " . mysqli_error($connection));
        }
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $incentiveper=0;
	$coincentiveper=0;
	$consigneeid=mysqli_real_escape_string($connection,$infoi['consigneeid']);
	$sourceid=mysqli_real_escape_string($connection,$infoi['sourceid']);
	$sqlcons = "SELECT address1, phone, mobile, email, consigneename, address2, area, pincode, contact, phone, mobile From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
	$querycons = mysqli_query($connection, $sqlcons);
    $infocon=mysqli_fetch_array($querycons);
	if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($infocon['address1']!='')
		{
		$infocon['address1']=jbsdecrypt($_SESSION['encpass'], $infocon['address1']);
		}
		if($infocon['phone']!='')
		{
		$infocon['phone']=jbsdecrypt($_SESSION['encpass'], $infocon['phone']);
		}
		if($infocon['mobile']!='')
		{
		$infocon['mobile']=jbsdecrypt($_SESSION['encpass'], $infocon['mobile']);
		}
		if($infocon['email']!='')
		{
		$infocon['email']=jbsdecrypt($_SESSION['encpass'], $infocon['email']);
		}
	}
}
	$sqlxl = "SELECT address1, phone, mobile, email, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$sourceid."' order by id asc";
	$queryxl = mysqli_query($connection, $sqlxl);
	$rowCountxl = mysqli_num_rows($queryxl);
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

	 ?>
	 <td><?=$count?></td>
	
	 <td><p><strong>
	 <?php
	 /* $coordinatorId = str_replace('c_', '', $infoi['receivedby']);
	 $engineerId = str_replace('e_', '', $infoi['receivedby']);
	  */?>
	  <?php
$receivedBy = $infoi['receivedby'];
if (strpos($receivedBy, 'c_') === 0) {
    $coordinatorId = str_replace('c_', '', $receivedBy);
    $sqlcoordinator = "select coordinatorname , id from jrccoordinator where id='$coordinatorId' order by coordinatorname asc";
    $querycoordinator = mysqli_query($connection, $sqlcoordinator);
	$rowcoordinator = mysqli_fetch_array($querycoordinator);
	echo $rowcoordinator['coordinatorname'];
} elseif (strpos($receivedBy, 'e_') === 0) {
     $engineerId = str_replace('e_', '', $receivedBy);
	 $sqlengineer = "select engineername , id from jrcengineer where id='$engineerId' order by engineername asc";
	 $queryengineer = mysqli_query($connection, $sqlengineer);
	 $rowengineer = mysqli_fetch_array($queryengineer);
	 echo $rowengineer['engineername'];
} else {
    // Fallback in case the prefix is not recognized
    echo $receivedBy;
}
?></strong></p></td>
	 
	 
	 <td><p><strong><?=$infocon['consigneename']?></strong><br><?=$infocon['address1']?> <?=$infocon['address2']?> <?=$infocon['area']?> <?=$infocon['pincode']?><br><?=$infocon['contact']?>  <?=$infocon['phone']?> <?=$infocon['mobile']?></p></td>
	 <td><?php
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
												?></td>
	 <?php
	 if($infoi['receivedamount']=='' || $infoi['receivedamount']=='NULL' )
	 {
		 $pendingbalance+=(float)$infoi['receivedamount'];
		 if($infoi['amcrenewtype']=='AMC')
		 {
		 ?>
	
		 <td><a class="text-danger" href="amcedit.php?consigneeid=<?=$consigneeid?>&xlid=<?=$sourceid?>&i=<?=$infoi['id']?>">Pending</a></td>
		 <?php
	 }
	 else
	 {
		 ?>
		<td><a class="text-danger" href="amcrenew.php?consigneeid=<?=$consigneeid?>&xlid=<?=$sourceid?>&id=<?=$infoi['id']?>">Pending </a></td> 
		<?php
	 }
	 }
	 else
	{
		if($infoi['amcrenewtype']=='AMC')
		 { 
		 ?>
	
		 <td><a class="text-success" href="amcedit.php?consigneeid=<?=$consigneeid?>&xlid=<?=$sourceid?>&i=<?=$infoi['id']?>">Received </a></td>
		 <?php
	 }
	 else
	 {
		 ?>
		<td><a class="text-success" href="amcrenew.php?consigneeid=<?=$consigneeid?>&xlid=<?=$sourceid?>&id=<?=$infoi['id']?>">Received </a></td> 
		<?php
	 }
	 }	 
	 ?>
	 <td><?=$infoi['receivedmode']?></td>
	 <td><?=($infoi['receiveddate']!='')?date('d/m/Y',strtotime($infoi['receiveddate'])):''?></td>
	 
	 <td class="text-right"><?=$infoi['resultvalue']?></td>
	 <td class="text-right"><?=$infoi['amcgstvalue']?></td>
	 <td class="text-right"><?=$infoi['totalvalue']?></td>
	 <?php
	 if($infoi['receivedamount']!='')
	 {
	 	 $paidamount+=(float)$infoi['totalvalue'];
		 
	 }
	  if($infoi['receivedamount']=='')
		{
	 	 $pendingbalance+=(float)$infoi['totalvalue'];
		 
	 } 
$grandtotal+=(float)$infoi['totalvalue'];	 
	
	
	 ?>
	 <?php 
if($infoi['receivedamount']!='')
{	 
$totalsgstamt+=(float)$infoi['resultvalue'];
$totalscharge+=(float)$infoi['totalvalue'];
$totalamount+=(float)$infoi['totalvalue'];
}	 
	
	 ?>
	 
	 </tr>
	 <?php
	 $count++;
 }
 
 ?>
</tbody>
   <tfoot>
    <tr>
	 <td ></td><td ></td><td ></td><td ></td><td ></td><td ></td><td ></td><td ></td>
        <td >Total Amount</td>
        <td class="text-right"><?= number_format($grandtotal, 2, '.', ',') ?></td>
    </tr>
    <tr>
	 <td ></td><td ></td><td ></td><td ></td><td ></td><td ></td><td ></td><td ></td>
        <td >Total Collected Amount</td>
        <td class="text-right text-success"><?= number_format($paidamount, 2, '.', ',') ?></td>
    </tr>
    <tr>
        <td ></td><td ></td><td ></td><td ></td><td ></td><td ></td><td ></td><td ></td>
        <td >Total Pending Amount</td>
        <td class="text-right text-danger"><?= number_format($pendingbalance, 2, '.', ',') ?></td>
    </tr>
</tfoot>

 </table>
 </div>
 <?php

}
}
?>
		</div>	
 </div>
			</div>
          </div>
       
      <?php include('footer.php'); ?>
    </div>
  </div>
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
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page level plugins -->
  <script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>	
  <!-- Page level custom scripts<script src="../../1637028036/js/datatables.js"></script> -->
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
       
		$(document).ready(function(){
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  placeholder: ''
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'excel', 
                    text: 'Export to Excel', 
                    className: 'btn btn-success',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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
<?php
$totalservicerevenue=0;
$todayservicerevenue=0;
$sdate=array();
$samount=array();
$monthsarray=array();
$montharray=array();
 $sqli=mysqli_query($connection,  "select *from jrcamc where  totalvalue!='0.00' and totalvalue!='0' and totalvalue!='' and totalvalue is not null ".$staqu." group by receiveddate order by cast(receiveddate as date) asc");
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $sdate[]=date('d M',strtotime($infoi['receiveddate']));
	 $samount[]=$infoi['totalvalue'];
	 $totalservicerevenue+=(float)$infoi['totalvalue'];
	 if(date('d/m/Y')==date('d/m/Y',strtotime($infoi['receiveddate'])))
	 {
		 $todayservicerevenue=$infoi['totalvalue'];
	 }
	 $monthsarray[date('Y-m-d',strtotime($infoi['receiveddate']))]=$infoi['totalvalue'];
	 $montharray[]=date('F Y',strtotime($infoi['receiveddate']));
 }
$montharray=array_unique($montharray); 
$result1=array(); 
foreach($monthsarray as $key=>$val){
   if(isset($result1[substr($key,0,7)]))
   {
		$result1[substr($key,0,7)] += $val;
   }
   else
   {
		$result1[substr($key,0,7)] = $val;
   }
}
?>
    <script>
    var xValues = [<?php foreach ($sdate as $sd){ echo "'".$sd."',";}?>];
    var yValues = [<?php foreach ($samount as $sa){ echo $sa.',';}?>];
    document.getElementById("totalservicerevenue").innerHTML = '<?=$totalservicerevenue?>';
    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                /* yAxes: [{ticks: {min: 6, max:16}}], */
            }
        }
    });
    </script>	
	<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000000';
// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Collected Amount", "Pending Amount"],
    datasets: [{
      data: [<?=$paidamount?>, <?=$pendingbalance?>],
      backgroundColor: ['#02DB9E', '#FF9C7F'],
      hoverBackgroundColor: ['#02DB9F', '#FF9C7E'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#000000",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 0,
  },
});
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>
