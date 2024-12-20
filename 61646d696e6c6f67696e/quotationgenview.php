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

  <title><?=$_SESSION['companyname']?> - Jerobyte - View Quotation Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
.img-placeholder {
  width: 100px;
  color: white;
  height: 100px;
  background: black;
  opacity: .7;
  height: 125px;
  border-radius: 5%;
  z-index: 2;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder h4 {
  margin-top: 40%;
  color: white;
}
.img-div:hover .img-placeholder {
  display: block;
  cursor: pointer;
}
   </style>
   
   <style>
   .main-body {
  font-size: 90%;
}
.mytabl th, .mytabl td
{
	padding:1px 5px;
}

a.button8
{
display:inline-block;
padding:0.05em 0.2em;
border-radius:5px;
margin:0.1em;
border:0.15em solid #CCCCCC;
box-sizing: border-box;
text-decoration:none;
font-family:'Segoe UI','Roboto',sans-serif;
font-weight:400;
color:#000000;
background-color:#CCCCCC;
text-align:center;
position:relative;
}
a.button8:hover{
border-color:#7a7a7a;
}
a.button8:active{
background-color:#999999;
}
@media all and (max-width:30em){
a.button8{
display:block;
margin:0.2em auto;
}
}
   </style>
   <style>
.blink {
  animation: blinker 1s step-start infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>
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
            <h1 class="h4 mb-2 mt-2 text-gray-800">View Quotation</h1>
            
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            

<?php
if(isset($_GET['id']) )
{
$qno=mysqli_real_escape_string($connection,$_GET['id']);

		$sqlselect = "SELECT * From jrcquotation where qno='".$qno."'";
		$queryselect = mysqli_query($connection, $sqlselect);
		
        if(!$queryselect)
		{
           die("SQL query failed: " . mysqli_error($connection));
        }
         if(mysqli_num_rows($queryselect)>0)
{
$rowselect = array();
while($row = mysqli_fetch_assoc($queryselect)){ 
$rowselect[] = $row;
}
      
			
			?>
			<!-- start consignee details-->
	<div class="card">
     <div class="card-body" style="padding:0.5rem">
	 <div class="row gutters-sm">
	 <?php
	 $sqlselectcon = "SELECT * From jrcconsignee where id='".$rowselect[0]['consigneeid']."'";
		$queryselectcon = mysqli_query($connection, $sqlselectcon);
		$rowcon = mysqli_fetch_array($queryselectcon); 
						
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
		<div class="col-md-2">
		<img src="../img/avatar.png" alt="Admin" class="rounded-circle" width="108">
		</div>	 
		<div class="<?=($rowcon['latlong']!='')?"col-md-6":"col-md-10"?>" >
		<h4 class="text-center text-primary mb-1"><?=$conname=$rowcon['consigneename']?> <a href="consigneeedit.php?id=<?=$rowcon['id']?>" ><i class="fa fa-edit"></i></a></h4>
		<p class="text-secondary text-center mb-1"><?php
						if($rowcon['ctype']!='')
			{
				if($rowcon['ctype']=='BLOCK')
				{
				?>
				<span class="badge badge-danger font-13"><?=$rowcon['ctype']?></span>
				<?php
				}
				else
				{
				?>
				<span class="badge badge-success font-13"><?=$rowcon['ctype']?></span>
				<?php
				}	
			}	
			?>
			<span class="badge badge-success font-13" id="warrantycustomer" style="display:none;">Warranty Customer</span>
			<span class="badge badge-success font-13" id="amccustomer" style="display:none">AMC Customer</span><br>
			<?php
			if(($infolayoutcustomers['address1']=='1')||($infolayoutcustomers['address2']=='1')||($infolayoutcustomers['area']=='1')||($infolayoutcustomers['district']=='1')||($infolayoutcustomers['pincode']=='1'))
{
?>
					  <span><i class="fa fa-address-book text-primary"></i> <?=$rowcon['address1']?> <?=$rowcon['address2']?> <?=$rowcon['area']?> <?=$rowcon['district']?>,<?=$rowcon['pincode']?>.</span><br>
					  <?php
}
if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['email']=='1'))
{
?>
					  <span><?=$rowcon['contact']?> <i class="fa fa-phone text-primary"></i>  <?=$rowcon['phone']?> <?=$rowcon['mobile']?> <i class="fa fa-envelope text-primary"></i> <?=$rowcon['email']?></span> <!-- Button trigger modal -->

<br>
					  <?php
}
?>
<span>
				<?php
if($infolayoutcustomers['maincategory']=='1')
{
?>
                      <?=$rowcon['maincategory']?> -
					  <?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
					  <?=$rowcon['subcategory']?> - 
					  <?php
}
if($infolayoutcustomers['department']=='1')
{
?>
					  <?=$rowcon['department']?>
					  <?php
}

?>
</span>
			</p>
			
		</div>
		<?php 
												  if($rowcon['latlong']!='')
												  {
													  $ll=explode(',',$rowcon['latlong']);
													  ?>
													 
													  
				<div class="col-md-4">
                <iframe 
  frameborder="0" 
  scrolling="no" 
  marginheight="0" 
  marginwidth="0" 
  height="108"
  src="https://maps.google.com/maps?q=<?=$ll[0]?>,<?=$ll[1]?>&hl=en&z=14&amp;output=embed"
 >
 </iframe>
              </div>
													  
													  <?php
												  }
												  ?>
		
		
		</div>
		</div>
	 </div>
	 </div>
	
<!-- end of consignee details-->
<!-- start of quotation view-->
 <div class="card shadow mb-4">
 <div class="card-body pt-0 pt-md-4">
 <div class="row gutters-sm">
<table class="table table-bordered">
	<thead>
	<tr>
	<th style="width:85px;">Sl. No.</th>
	<th>Product Description</th>
	<th style="width:160px;">Unit Price</th>
	<th>Qty</th>
	<th style="width:160px;">Total Amount</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	$warrs="";	
	$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect[0]['qno']."' and qdate='".$rowselect[0]['qdate']."' and qtype='PRODUCT' order by id ASC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
		
		while($rowselect2 = mysqli_fetch_array($queryselect2)) 
		{
			
			$sqlengselect = "SELECT id, compprefix, compno, engineername, signature, mobile From jrcengineer where enabled='0' and id='".$rowselect2['engineerid']."' order by id desc";
				$queryengselect = mysqli_query($connection, $sqlengselect);
				$rowCountengselect = mysqli_num_rows($queryengselect);
				$rowengselect = mysqli_fetch_array($queryengselect);
				if($rowCountengselect >0 )
					{
				$engineersignature=$rowengselect['signature'];
				$engineersignature=str_replace('uploads','padhivetram',$engineersignature);
				$engineername=$rowengselect['engineername'];
				$engineermobile=$rowengselect['mobile'];
				$compno=$rowengselect['compno'];
				$compprefix=$rowengselect['compprefix'];
				$engineerid=$rowengselect['id'];
					}
					
					
				 $sqladmin = "SELECT id,signature,mobile,adminusername From jrcadminuser where username='".$rowselect2['createdby']."' order by id desc";
				$queryadmin = mysqli_query($connection, $sqladmin);
				$rowadmin = mysqli_num_rows($queryadmin);
				$rowSelectadmin = mysqli_fetch_array($queryadmin);
				if($rowadmin >0 )
					{
				$adminsignature=$rowSelectadmin['signature'];
				$adminsignature=str_replace('uploads','padhivetram',$adminsignature);
				$adminname=$rowSelectadmin['adminusername'];
				$adminmobile=$rowSelectadmin['mobile'];
				
					}
			
	$sqlxl = "SELECT * From jrcproduct where id='".$rowselect2['productname']."' order by id asc";
	$queryxl = mysqli_query($connection, $sqlxl);
	$rowCountxl = mysqli_num_rows($queryxl);
	if(!$queryxl){
	   die("SQL query failed: " . mysqli_error($connection));
	}
	$rowxl = mysqli_fetch_array($queryxl);
	
	if(($rowxl['warranty']!="")&&($rowxl['warranty']!="0"))
			{
				if($warrs!="")
				{
					$warrs.="".$rowxl['warranty']." Months (".$rowxl['stockitem'].")<br>";
				}
				else
				{
					$warrs.="<p><b>Warranty: </b></p>";
					$warrs.="".$rowxl['warranty']." Months (".$rowxl['stockitem'].")<br>";
				}
			}
			
	?>		
	<tr>
	<td><?=$i?></td>
	<td><b><?=$rowxl['stockitem']?></b><br>
	<?=nl2br($rowxl['description'])?> </td>
	<td class="text-right">Rs. <?=number_format((float)$rowselect2['saleprice'],2,'.',',')?></td>
	<td class="text-center"><?=$rowselect2['salequantity']?></td>
	<td class="text-right">Rs. <?=number_format(((float)$rowselect2['saleprice']*(float)$rowselect2['salequantity']),2,'.',',')?></td>
	</tr>
	<?php
	if($rowselect2['salesinstallation']=='1')
	{
		?>
	<tr>
	<td></td>
	<td>Delivery & Installation charges</td>
	<td></td>
	<td></td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesinstallcost'],2,'.',',')?></td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td></td>
	<td>ADD: GST <?=$rowselect2['gst']?>% </td>
	<td></td>
	<td></td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesgst'],2,'.',',')?></td>
	</tr>
	<tr>
	<td></td>
	<th>Total Amount Inclusive of GST</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salesnettotal'],2,'.',',')?></th>
	</tr>
	<?php 
	$i++;
	}
	?>
	<tr>
	<td></td>
	<th>PRODUCT TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect[0]['prototal'],2,'.',',')?></th>
	</tr>
	<?php 
		}
	
	$sqlselect2 = "SELECT * From jrcquotation where qno='".$rowselect[0]['qno']."' and qdate='".$rowselect[0]['qdate']."' and qtype='SCRAP' order by id ASC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountselect2>0)
		{
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
	
	<tr>
	<td><?=$i?></td>
	<td><b>LESS: Scrap Value</b><br>
	(<?=$rowxl['stockitem']?> - <?=$rowselect2['salescrap']?> Nos)</td>
	<td></td>
	<td>
	
	</td>
	<td class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect2['salescrapvalue'],2,'.',',')?></td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td></td>
	<th>SCRAP TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect[0]['scrtotal'],2,'.',',')?></th>
	</tr>
	<?php 
		}
		?>
		<tr>
	<td></td>
	<th>NET TOTAL</th>
	<td></td>
	<td></td>
	<th class="text-right" style="border-bottom: 1px dashed #000000">Rs. <?=number_format((float)$rowselect[0]['gratotal'],2,'.',',')?></th>
	</tr>
	</tbody>
	</table>
	</div>
	</div>
	</div>
	 <!-- end of the quotation details -->
	 <!--Start of the followup details -->
	  <div class="card shadow mb-4">
	 
		
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary"> Quotation Followup</h6>
               </div>
            </div>
			
            <div class="card-body pt-0 pt-md-4">
			<a href="followupadd.php?id=<?=$rowselect[0]['qno']?>" class="btn btn-primary btn-sm mb-3 float-right"><i class="fa fa-plus"></i> Add Quotation Followup</a>
			<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
 <tr>
		<th>S.No</th>
		<th>Followup Date and Time</th>
		<th>Quotation Number</th>
		<th>Postponed Date and Time</th>
		<th>Remarks Given</th> 
		<th>Followup Status</th> 
		
		
      </tr>	
</thead>
<tbody>

<?php
	$sql="select * from jrcfollowup where referqno='".$rowselect[0]['qno']."' order by followupdate desc";
	$result=mysqli_query($connection,$sql);
	if($result)
	{
		if(mysqli_num_rows($result)>0)
		{
			$i=1;
			while($row=mysqli_fetch_array($result))
			{
				?>
	<tr>
		<td data-label="S.No"><?=$i?></td>
		<td data-label="Followup Date and Time"><?php if($row['followupdate']!="")echo date('d-m-Y h:i a',strtotime($row['followupdate']))?></td>
		<td data-label="Quotation Number"><?=$row['referqno']?></td>
		<td data-label="Postponed Date and Time"><?php if($row['followupback']!="")echo date('d-m-Y h:i a',strtotime($row['followupback']))?></td>
		<td data-label="Remarks Given"><?php echo $row['reason']?></td>
		<td data-label="Followup Status"><?php  if($row['status']=='Completed'){ ?><span class="text-success"><b><?=$row['status']?></b></span><?php } else { ?><span class="text-danger"><b><?=$row['status']?></b></span><?php } ?></td>
		
	</tr>
	<?php
	$i++;
			}
		}
	}
	
	?>

</tbody>
</table>
</div>
</div>
			  
			<div class="modal fade" id="additionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
		$s=0;
		foreach($callfrom as $cf)
		{
			if(trim($cf)!='')
			{
			echo $cf.'<br>';
			$s++;
			}
		}
		if($s==0)
		{
			?>
			<script>document.getElementById("additionalcontact").style.display="none";</script>
			<?php
		}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
			
            
       
		
	 <!-- end of the followup details -->
	 
<?php
					
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
     $( "#material" ).autocomplete({
       source: 'materialsearch.php?type=material',
     });
	 $( "#designation" ).autocomplete({
       source: 'materialsearch.php?type=designation',
     });
	 $( "#material" ).autocomplete({
       source: 'materialsearch.php?type=material',
     });
  });
</script>

</body>

</html>
