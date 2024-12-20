<?php
include('lcheck.php'); 

$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
$sqllayoutcall=mysqli_query($connection, "select * from jrclayoutcall");
$infolayoutcall=mysqli_fetch_array($sqllayoutcall);
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
   <style>
   .register{
    background: -webkit-linear-gradient(left, #3d8eb9, #3d8eb9);
    margin-top: 1%;
    padding: 2%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #ffffff;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding:2% 3%;
    margin-top: 10%;
}
@media only screen and (max-width: 768px) 
{
	.register .register-form
	{
		padding:2% 3%;
		margin-top: 20%;
	}
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #3d8eb9;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #3d8eb9;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}


/******************* Timeline Demo - 5 *****************/
.main-timeline5{overflow:hidden;position:relative}
.main-timeline5 .timeline{position:relative;margin-top:-70px}
.main-timeline5 .timeline:first-child{margin-top:0}
.main-timeline5 .timeline-icon,.main-timeline5 .year{margin:auto;position:absolute;top:0;left:0;bottom:0;right:0}
.main-timeline5 .timeline:after,.main-timeline5 .timeline:before{content:"";display:block;width:100%;clear:both}
.main-timeline5 .timeline:before{content:"";width:100%;height:100%;position:absolute;top:0;right:0;z-index:2}
.main-timeline5 .timeline-icon{width:125px;height:125px;border-radius:50%;border:15px solid transparent;border-top-color:#3d8eb9;border-right-color:#3d8eb9;z-index:1;transform:rotate(45deg)}
.main-timeline5 .year{display:block;width:80px;height:80px;line-height:80px;border-radius:50%;background:#fff;box-shadow:0 0 20px rgba(0,0,0,.4);font-size:25px;font-weight:700;color:#3d8eb9;text-align:center;transform:rotate(-45deg)}
.main-timeline5 .timeline-content{width:40%; min-height: 150px;float:right;border:5px solid #3d8eb9; background:#ffffff; color:#000000; padding:20px 20px;margin:40px 0;z-index:3;position:relative}
.main-timeline5 .timeline-content:before{content:"";width:10%;height:15px; border:5px solid #3d8eb9; background:#ffffff; position:absolute;top:50%;left:-10%;z-index:-1;transform:translateY(-50%)}
.main-timeline5 .title{font-size:15px;font-weight:700;color:#3d8eb9;margin:0 0 1px}
.main-timeline5 .description{font-size:13px;color:#000000;line-height:20px;margin:0}
.main-timeline5 .timeline:nth-child(2n):before{}
.main-timeline5 .timeline:nth-child(2n) .timeline-icon{transform:rotate(-135deg);border-top-color:#3d8eb9;border-right-color:#3d8eb9}
.main-timeline5 .timeline:nth-child(2n) .year{transform:rotate(135deg);color:#3d8eb9}
.main-timeline5 .timeline:nth-child(2n) .timeline-content{float:left}
.main-timeline5 .timeline:nth-child(2n) .timeline-content:before{left:auto;right:-10%}
.main-timeline5 .timeline:nth-child(2n) .timeline-content,.main-timeline5 .timeline:nth-child(2n) .timeline-content:before{border:5px solid #3d8eb9; background:#ffffff;}
.main-timeline5 .timeline:nth-child(3n) .timeline-icon{border-top-color:#3d8eb9;border-right-color:#3d8eb9}
.main-timeline5 .timeline:nth-child(3n) .year{color:#3d8eb9}
.main-timeline5 .timeline:nth-child(3n) .timeline-content,.main-timeline5 .timeline:nth-child(3n) .timeline-content:before{border:5px solid #3d8eb9; background:#ffffff;}
.main-timeline5 .timeline:nth-child(4n) .timeline-icon{border-top-color:#3d8eb9;border-right-color:#3d8eb9}
.main-timeline5 .timeline:nth-child(4n) .year{color:#3d8eb9}
.main-timeline5 .timeline:nth-child(4n) .timeline-content,.main-timeline5 .timeline:nth-child(4n) .timeline-content:before{border:5px solid #3d8eb9; background:#ffffff;}
@media only screen and (max-width:1199px){.main-timeline5 .timeline{margin-top:-103px}
.main-timeline5 .timeline-content:before{left:-18%}
.main-timeline5 .timeline:nth-child(2n) .timeline-content:before{right:-18%}
}
@media only screen and (max-width:990px){.main-timeline5 .timeline{margin-top:-127px}
.main-timeline5 .timeline-content:before{left:-2%}
.main-timeline5 .timeline:nth-child(2n) .timeline-content:before{right:-2%}
}
@media only screen and (max-width:767px){.main-timeline5 .timeline{margin-top:0;overflow:hidden}
.main-timeline5 .timeline:before,.main-timeline5 .timeline:nth-child(2n):before{box-shadow:none}
.main-timeline5 .timeline-icon,.main-timeline5 .timeline:nth-child(2n) .timeline-icon{margin-top:-15px;margin-bottom:20px;position:relative;transform:rotate(135deg)}
.main-timeline5 .timeline:nth-child(2n) .year,.main-timeline5 .year{transform:rotate(-135deg)}
.main-timeline5 .timeline-content,.main-timeline5 .timeline:nth-child(2n) .timeline-content{width:100%;float:none;border-radius:0 0 20px 20px;text-align:center;padding:25px 20px;margin:0 auto}
.main-timeline5 .timeline-content:before,.main-timeline5 .timeline:nth-child(2n) .timeline-content:before{width:15px;height:25px;position:absolute;top:-28px;left:50%;z-index:-1;transform:translate(-50%,0)}
}
ul.timeline-call {
    list-style-type: none;
    position: relative;
}
ul.timeline-call:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline-call > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline-call > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #3d8eb9;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
ul.timeline-call p{
	font-size:13px;
}
   </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">
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
			?>
			<div class="register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3 style="font-size: 1.5rem"><?=$conname=$rowcon['consigneename']?></h3>
						<div style="text-align:center">
						<?php
						if($rowcon['ctype']!='')
			{
				if($rowcon['ctype']=='BLOCK')
				{
				?>
				<span class="badge badge-danger"><?=$rowcon['ctype']?></span>
				<?php
				}
				else
				{
				?>
				<span class="badge badge-success"><?=$rowcon['ctype']?></span>
				<?php
				}	
			}	
			?>
						
						<span class="badge badge-success" id="warrantycustomer" style="display:none">Warranty Customer</span>
						<span class="badge badge-success" id="amccustomer" style="display:none">AMC Customer</span>
						</div>
						<div style="text-align:center" class="m-2">
						Customer for <span id="customerfor" style="padding:3px 10px; border-radius:50%; font-size:20px; background:#ffffff; color:blue">0</span> Years
						</div>
						<div class="table-responsive text-left">
											<table class="table font-13 text-white" width="100%" cellspacing="0">
											<?php
											if($infolayoutcustomers['maincategory']=='1')
											{
											?>
												 <tr>
												  <td><b>Main Category:</b><br><?=$rowcon['maincategory']?></td>
												 </tr> 
											<?php
											}
											if($infolayoutcustomers['subcategory']=='1')
											{
											?>											
												 <tr>
												  <td><b>Sub Category:</b><br><?=$rowcon['subcategory']?></td>
												  </tr> 
											<?php
											}
											if($infolayoutcustomers['department']=='1')
											{
											?>	  
												 <tr>
												  <td><b>Department:</b><br><?=$rowcon['department']?></td>
												  </tr>
											<?php
											}
											if(($infolayoutcustomers['address1']=='1')||($infolayoutcustomers['address2']=='1')||($infolayoutcustomers['area']=='1')||($infolayoutcustomers['district']=='1')||($infolayoutcustomers['pincode']=='1')||($infolayoutcustomers['latlong']=='1'))
											{
											?>	  
												 <tr>
												  <td><b>Address:</b><br><?=$rowcon['address1']?> <?=$rowcon['address2']?> <?=$rowcon['area']?> <?=$rowcon['district']?> <?=$rowcon['pincode']?>
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
												  </tr> 
											<?php
											}
											if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['email']=='1'))
											{
											?>
											
												 <tr>
												  <td><b>Contact:</b><br><?=$rowcon['contact']?> <?=$rowcon['phone']?> <?=$rowcon['mobile']?> <?=$rowcon['email']?> <!--<a href="tel:<?=$rowcon['phone']?>" class="btn btn-sm btn-success mr-4"><i class="fas fa-phone fa-sm"></i></a> <a href="sms:<?=$rowcon['phone']?>" class="btn btn-sm btn-warning float-right"><i class="fas fa-envelope fa-sm"></i></a>--></td>
												  </tr> 
												  <?php
											}
											?>
												 <tr>
												  <td><a href="consigneeedit.php?id=<?=$rowcon['id']?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
												  </tr> 
											  </tbody>
											</table>
										  </div>
						
						
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Calls</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Product Details</h3>
                                <div class="row register-form">
                                    <div class="col-md-12">
									
									
									
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline5">
					<?php
					$lastinvoiceyear=date('Y');
$sqlselect = "SELECT * From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' group by invoiceno, invoicedate, stockitem order by invoicedate desc, id asc";
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
					
                        <div class="timeline">
                            <div class="timeline-icon" id="timelineicon<?=$count?>"><span class="year"><?=date('Y',strtotime($rowselect['invoicedate']))?></span></div>
                            <div class="timeline-content" id="timeline<?=$count?>">
                                <h3 class="title"><?=$rowselect['invoiceno']?> - <?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?> <a href="invoiceedit.php?id=<?=$rowselect['id']?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></h3>
                                <p class="description">
								<?php
if(($infolayoutinvoice['installedon']=='1')||($infolayoutinvoice['installedby']=='1'))
{
	if($rowselect['installedon']!='')
	{
		echo 'Installed';
	
?>                                <?=($rowselect['installedon']!='')?'on '.date('d/m/Y',strtotime($rowselect['installedon'])):''?> <?=($rowselect['installedby']!='')?'by '.$rowselect['installedby']:''?><br>
<?php
	}
	?>
									<?php
}
?>
<?php
if(($infolayoutproducts['stockmaincategory']=='1')||($infolayoutproducts['stockmaincategory']=='1'))
{
?>	
<?=$rowselect['stockmaincategory']?> <?=$rowselect['stocksubcategory']?><br>
<?php
}
if($infolayoutproducts['stockitem']=='1')
{
?>	
<b><?=$rowselect['stockitem']?></b><br>
<?php
}
if($infolayoutinvoice['overallwarranty']=='1')
{
?>
			Overall Warranty: <?=$rowselect['overallwarranty']?>
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
				if($date < $now) 
				{
					echo '<span><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
				else
				{
					echo '<span><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
			}
}
			?>
			
			
<?php
$sqlselect1 = "SELECT * From jrcxl where tdelete='0' and  consigneeid='".$rowcon['id']."' and invoiceno='".(mysqli_real_escape_string($connection,$rowselect['invoiceno']))."' and invoicedate='".$rowselect['invoicedate']."' and stockitem='".(mysqli_real_escape_string($connection,$rowselect['stockitem']))."' order by invoicedate desc, id asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
while($rowselect1 = mysqli_fetch_array($queryselect1)) 
{
?>			
<?php 
if($infolayoutproducts['typeofproduct']=='1')
{
?>
<?=$rowselect1['typeofproduct']?> 
<?php
}
?>
<?php 
if($infolayoutproducts['componenttype']=='1')
{
?>
<?=$rowselect1['componenttype']?> 
<?php
}
?>	
<?php 
if($infolayoutproducts['componentname']=='1')
{
?>
<b><?=$rowselect1['componentname']?> </b>
<?php
}
?>
<?php 
if($infolayoutproducts['make']=='1')
{
?>
<?=$rowselect1['make']?> 
<?php
}
?>
<?php 
if($infolayoutproducts['capacity']=='1')
{
?>
<?=$rowselect1['capacity']?> 
<?php
}
if(($infolayoutproducts['typeofproduct']=='1')&&($infolayoutproducts['componenttype']=='1')&&($infolayoutproducts['componentname']=='1')&&($infolayoutproducts['make']=='1')&&($infolayoutproducts['capacity']=='1'))
{
?><br>
<?php
}
if($infolayoutinvoice['warranty']=='1')
{
if($rowselect1['warranty']!='')
{	
?>
Warranty: <?=$rowselect1['warranty']?> Months 
<?php
			
			if($rowselect1['installedon']!='')
			{
			$overdate=$rowselect1['installedon'];
			}
			else
			{
			$overdate=$rowselect1['invoicedate'];
			}
			$off=(float)$rowselect1['warranty'];
			$overdate = str_ireplace('/', '-', $overdate);
			$overdate=date('Y-m-d', strtotime($overdate));
			$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
			$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
			$date = new DateTime($effectiveDate);
			$now = new DateTime();
			if($date < $now)
			{
				echo '<span class="bg-danger"><strong>('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
			}
			else
			{
				echo '<span class="bg-success"><strong>('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
				?>
				
				<script>
				document.getElementById("warrantycustomer").style.display="inline-block";
				</script>
				<?php
			}
			}
}
			?><?php
			$sqlamc = "SELECT * From jrcamc where sourceid='".$rowselect1['id']."'";
				  
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
    echo '<span class="text-danger"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintanence)</strong></span><br>';
}
else
{
	echo '<span class="text-success"><strong><br>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).'<br>'.$rowamc['amcduration'].' Months - '.$rowamc['amctype'].' Maintanence)</strong></span><br>';
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		if($infolayoutinvoice['qty']=='1')
{
		?>
		Qty: <?=$rowselect1['qty']?>
		<?php
}
if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
					  $srls=explode("| ",$rowselect1['serialnumber']);
					  $dpts=explode("| ",$rowselect1['departments']);
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
}
					  ?><br><a href="callsadd.php?id=<?=$rowselect1['id']?>" class="btn btn-primary btn-sm bg-white text-primary">Take A Complaint Call</a>
					  <?php
					  if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
	?>
					  <a href="serialnumberedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$rowselect1['id']?>" class="btn btn-primary btn-sm bg-white text-primary">Edit Serials</a>
					  <?php
}
?>
					  <a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$rowselect1['id']?>" class="btn btn-primary btn-sm bg-white text-primary">Add to AMC</a> 
					  <?php
					  if($deleteproduct=='1')
					  {
						  ?>
					  <a href="invoicedelete.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$rowselect1['id']?>&tdelete=<?=$rowselect1['tdelete']?>" onclick="return confirm('Are you sure want to Delete this Product')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					  <?php
					  }
					  ?>
					  <br>
<?php
}
?>
                                </p>
                            </div>
                        </div>
						<?php
						$stockitem=$rowselect['stockitem'];
				$invoiceno=$rowselect['invoiceno'];
				$invoicedate=$rowselect['invoicedate'];
				$lastinvoiceyear=date('Y', strtotime($invoicedate));
				$count++;
	}
}

$customerfor=date('Y')-$lastinvoiceyear;
?>
<script>document.getElementById("customerfor").innerHTML="<?=$customerfor?>";</script>
                    </div>
                </div>
            </div>							
									
									
															
                                    </div>									
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Call History</h3>
                                <div class="row register-form">
                                    <div class="col-md-12">
									
										<ul class="timeline-call">
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
										
											<li>
												<a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowselect['calltid'];?>')"><?=$rowselect['calltid']?></a>
												<a href="#" class="float-right"><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?></a>
												<p>
												<b>Product:</b> <?php
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
												?><br>
												<?php
												if($infolayoutcall['serial']=='1')
												{
												?>	
												<b>Serial Number:</b> <?=$rowselect['serial']?><br>
												<?php
												}
												if($infolayoutcall['reportedproblem']=='1')
												{
												?>	
												  <b>Reported Problem:</b> <?=$rowselect['reportedproblem']?><br>
												  <?php
												}
												if($infolayoutcall['problemobserved']=='1')
												{
												?>
												  <b>Problem Observed:</b> <?=$rowselect['problemobserved']?><br>
												  <?php
												}
												if($infolayoutcall['actiontaken']=='1')
												{
												?>
												  <b>Action Taken:</b> <?=$rowselect['actiontaken']?><br>
												  <?php
												}
												?>
												  
												  <?php
												 if($rowselect['compstatus']=='2')
												  {
													?>
													<span class="text-success"><b>Completed</b> </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
													<?php
													
												  }
												  else if($rowselect['compstatus']=='1')
												  {
													?>
													<span class="text-danger"><b>Pending</b> </span>on <?=date('d/m/Y h:i:s a', strtotime($rowselect['changeon']))?>
													<?php
													
												  }
												  else
												 {
													?>
													<span class="text-warning"><b>Open</b></span>
													<?php
													
												  }
												  ?>
												  <br>
												  <?php
												  if($calledit=='1')
													{  
												 if($rowselect['compstatus']!='2')
												  {
												?>
												 <a href="callsedit.php?id=<?=$rowselect['id']?>">Edit</a><br>
												  <?php
												  }
													}
													if(($rowselect['detailsid']!=''))
													{
														?>
														<a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>" target="_blank" class="float-right btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-pdf fa-sm text-white-50"></i> View Service Call Report</a><br>
														<?php
													}
													?>
												</p>
											</li>
										<?php
												$count++;
										}
									}
										?>	
											
										</ul>
									</div>
                                </div>
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
