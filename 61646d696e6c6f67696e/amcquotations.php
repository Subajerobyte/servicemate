<?php
include('lcheck.php'); 

if($callview=='0')
{
	header("location: dashboard.php");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte -  AMC Quotations</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php //include('quotationnavbar.php');?>
        

        
        <div class="container-fluid">
<?php
$statitle="";
$staqu="";
$piecolor=array("#FF6C95", "#6F9FF5", "#04DCCB", "#FF9C7F", "#77808F", "#8A61EA", "#FF5D68", "#C976DB", "#FEC368", "#02DB9E", "#398CE8", "#767AE3", "#FF7265", "#FEDB02", "#028FFD", "#F0484E");
$piecolorhover=array("#FF6C96", "#6F9FF6", "#04DCCC", "#FF9C7E", "#77808E", "#8A61EB", "#FF5D69", "#C976DC", "#FEC369", "#02DB9F", "#398CE9", "#767AE4", "#FF7266", "#FEDB03", "#028FFE", "#F0484F");
$pievalue=array();
$piename=array();
if(isset($_GET['status']))
{
	if($_GET['status']=='2')
	{
		$statitle=" - Completed";
		$staqu=" where compstatus='2'";
	}
	else if($_GET['status']=='1')
	{
		$statitle=" - Pending";
		$staqu=" where compstatus='1'";
	}
	else
	{
		$statitle=" - Open";
		$staqu=" where compstatus='0'";
	}
}
?>
          <!-- Page Heading -->

		  
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>AMC Quotations <?=$statitle?></b></h1>
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
<?php 
$total=0;
$open=0;
$converted=0;

$sqli=mysqli_query($connection, "select compstatus from jrcamcquotation group by qno, qdate order by id asc");
while($info=mysqli_fetch_array($sqli))
{
	$total++;
	if($info['compstatus']=='0')
	{
		$open++;
	}
	if($info['compstatus']=='2')
	{
		$converted++;
	}
}
$piename[]="Pending";
$pievalue[]=$open;
$piename[]="Converted";
$pievalue[]=$converted;
$piecount=2;
?>
<div class="row">
<div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-history fa-2x float-left" style=" font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="amcquotations.php"><span class="font-weight-bold" style="font-size:1.0rem; line-height:1; text-decoration:underline;">Total <br>AMC Quotations</span></a>
                  <h3><?=$total?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-history fa-2x float-left" style="font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="amcquotations.php?status=0"><span class="font-weight-bold" style=" font-size:1.0rem; line-height:1; text-decoration:underline;">To be Converted<br> AMC Quotations</span></a>
                  <h3><?=$open?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <div class="col-xl-4 col-sm-6 mb-3"> 
        <div class="card cardnew1 shadow">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-top" style="display:none">
                  <i class="fas fa-history fa-2x float-left" style=" font-size:1.0rem; line-height:1; text-decoration:underline;"></i>
                </div>
                <div class="media-body text-center">
				<a href="amcquotations.php?status=2"><span class="font-weight-bold" style=" font-size:1.0rem; line-height:1; text-decoration:underline;">Converted<br>AMC Quotations</span></a>
                  <h3><?=$converted?></h3>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <!--div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow mb-4">
                                <div class="card-body" style="height:130px; overflow-y:auto">
								<div class="chart-pie pt-4">
								<div class="chartjs-size-monitor">
								<div class="chartjs-size-monitor-expand">
								<div class=""></div>
								</div>
								<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
								</div>
								</div>
								<canvas id="myPieChart" width="301" height="153" style="display: block; width: 301px; height: 153px;" class="chartjs-render-monitor"></canvas>
                                    </div>
								</div>
								</div>
												   
									
                                </div-->
	  
</div>
<div class="card">
<div class="card-body">
<div class="floating-container">
	 <div class="text-center mt-3"><a class="btn btn-scroll" id="scrollUpBtn" onmousedown="startContinuousScroll('up')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-up"></i></a><a class="btn btn-scroll" id="scrollLeftBtn" onmousedown="startContinuousScroll('left')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-left"></i></a><a class="btn btn-scroll" id="scrollRightBtn" onmousedown="startContinuousScroll('right')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-right"></i></a><a class="btn btn-scroll" id="scrollDownBtn" onmousedown="startContinuousScroll('down')" onmouseup="stopContinuousScroll()"><i class="fas fa-chevron-circle-down"></i></a></div>
	 </div>
              <div class="table-responsive scroll">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>

<tr>
<th>S.No</th>
<th>Age</th>
<th>AMC Quotation No</th>
<th>AMC Quotation Date</th>
<th>Given By</th>
<th>Customer Details</th>
<th>Total Value</th>
<th>From Date</th>
<th>To Date</th>
<th>Maintenance Type</th>
<th>Status</th>
<th>Convert to AMC</th>
<th>Edit</th>
<th>View / Print</th>
</tr>
</thead>
<tbody>
<?php 

	$sqlselect = "SELECT engineerid, createdby, qdate, qno, consigneeid, datefrom,dateto,totalvalue,maintenancetype, compstatus,  id, createdon,sourceid,adate,amcrenewtype From jrcamcquotation ".$staqu." group by qno, qdate order by id desc";
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

				$engineerid=mysqli_real_escape_string($connection,$rowselect['engineerid']);
				$sqleng = "SELECT engineername From jrcengineer where id='".$engineerid."' order by engineername asc";
				$queryeng = mysqli_query($connection, $sqleng);
				$roweng = mysqli_fetch_array($queryeng);
				
				$createdby=mysqli_real_escape_string($connection,$rowselect['createdby']);
				$sqladmin = "SELECT adminusername From  jrcadminuser where username='".$createdby."' order by adminusername asc";
				$queryadmin = mysqli_query($connection, $sqladmin);
				$rowadmin = mysqli_fetch_array($queryadmin);
				
				$consigneeid=mysqli_real_escape_string($connection,$rowselect['consigneeid']);
				$sqlcons = "SELECT consigneename, address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
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
				
$diff = abs(time() - strtotime($rowselect['qdate']));
$days = floor(($diff)/ (60*60*24));
				?>
				<tr>
				<td><?=$count?></td>
				<td><?=$days?></td>
				<td><a href="amcquotationgenview.php?id=<?=$rowselect['qno']?>" target="_blank"><?=$rowselect['qno']?></a></td>
				<td><?=date('d/m/Y', strtotime($rowselect['qdate']))?></td>
				<td><?php if(isset($rowadmin['adminusername'])) { echo $rowadmin['adminusername']; } else { echo $roweng['engineername']; } ?></td>
				 <?php
					  if($rowselect['consigneeid']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowcons['consigneename']?></a><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?>
<td class="text-right"><?=$rowselect['totalvalue']?></td>
<td class="text-right"><?=date('d/m/Y', strtotime($rowselect['datefrom']))?></td>
<td class="text-right"><?=date('d/m/Y ', strtotime($rowselect['dateto']))?></td>
<td class="text-right"><?=$rowselect['maintenancetype']?></td>
<td>
					  <?php
					 if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['adate']))?>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span>on <?=date('d-m-Y h:i:s a', strtotime($rowselect['adate']))?>
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
					 
					

<td>
<?php
					  if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Converted</span><br><?=$rowselect['qno']?>    On<br><?=date('d-m-Y',strtotime($rowselect['qdate']))?>
						<?php
						
					  }
					  else
					  {   
if($rowselect['amcrenewtype']=='AMC')
{	
						  ?>
						    <a href="amcedit.php?consigneeid=<?=$rowselect['consigneeid']?>&xlid=<?=$rowselect['sourceid']?>&qid=<?=$rowselect['id']?>&qdate=<?=$rowselect['qdate']?>" class="text-danger" onclick="return confirm('Are you sure want to Convert?')">Click to Convert </a>
						 <?php
}
else
{
	?>
	 <a href="amcrenew.php?consigneeid=<?=$rowselect['consigneeid']?>&xlid=<?=$rowselect['sourceid']?>&qid=<?=$rowselect['id']?>&qdate=<?=$rowselect['qdate']?>" class="text-danger" onclick="return confirm('Are you sure want to Convert?')">Click to Convert </a>
	<?php
}
					  }
					  ?>
					  </td>  
					  
					  <td>
					  <?php
					  if($rowselect['compstatus']!='2')
					  {
						  ?>
					  <a href="amcquotationgenedit.php?id=<?=$rowselect['qno']?>&date=<?=$rowselect['createdon']?>"  class="text-primary">Edit</a>
					  <?php
					  }
					  ?>
					  </td> 
					  <td>
					  <a href="amcquotationprint.php?id=<?=$rowselect['qno']?>" target="_blank" class="text-primary">View / Print</a>
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
                <h5 class="modal-title">AMC Quotations</h5>
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
<?php include('additionaljs.php');   ?>
</body>

</html>
