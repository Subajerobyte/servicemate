<?php
include('lcheck.php');
if(isset($_GET['date']))
{
$date=mysqli_real_escape_string($connection,$_GET['date']);
$end=mysqli_real_escape_string($connection,$_GET['end']);
$date1=mysqli_real_escape_string($connection,$_GET['date']);
$end1=mysqli_real_escape_string($connection,$_GET['end']);
}
else
{
$date = date("Y-m-d", strtotime("Monday this week"));
for ($i=0; $i<7;$i++){
    $end=date("Y-m-d", strtotime($date . " + $i day"));
}
$date1=$date;
$end1=$end;
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

  <title>Engineers Report - <?=$_SESSION['companyname']?></title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link href="../../1637028036/vendor/photoviewer/photoviewer.css" rel="stylesheet">
   <style>
   .historyid{
  line-height:1.3em;
}
   .history-tl-container{
    font-family: "Roboto",sans-serif;
  width:100%;
  margin:auto;
  display:block;
  position:relative;
}
.history-tl-container ul.tl{
    margin:20px 0;
    padding:0;
    display:inline-block;

}
.history-tl-container ul.tl li{
    list-style: none;
    margin:auto;
    margin-left:130px;
    min-height:50px;
    /*background: rgba(255,255,0,0.1);*/
  /* border-left:1px dashed #86D6FF; */
    padding:0 0 10px 16px;
    position:relative;
}
.history-tl-container ul.tl li:last-child{ border-left:0;}
.history-tl-container ul.tl li::before{
   position: absolute;
    left: -28px;
    top: -5px;
    content: " ";
    border: 8px solid rgba(255, 255, 255, 0.74);
    border-radius: 500%;
    background: #258CC7;
    height: 35px;
    width: 35px;
    transition: all 500ms ease-in-out; 

}
.history-tl-container ul.tl li:hover::before{
    border-color:  #258CC7;
    transition: all 1000ms ease-in-out;
}
ul.tl li .item-title{
}
ul.tl li .item-detail{
    color:rgba(0,0,0,0.5);
    font-size:12px;
}
ul.tl li .timestamp{
    color: #8D8D8D;
    position: absolute;
  width:100px;
    left: -140px;
    text-align: right;
    font-size: 12px;
}
@media print {
	@page { size: A4 landscape }
  .footer1 {page-break-after: always;}
}
body{
	font-size:0.75rem;
}
.rotateimg
    {
     -webkit-transform: rotate(-90deg); 
     -moz-transform:rotate(-90deg);
     filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }
.table td, .table th {
    padding: 0.2rem;
    vertical-align: top;
    border-top: 1px solid #e3e6f0;
}	
.card-body {
	padding:0;
}
   </style>
</head>

<body id="page-top">
          
          <div class="row">
	  <div class="col-lg-12">
	  
	  
	   <div class="card" style="border:none;">
           <div class="card-body">
	  
<?php
if(isset($_POST['attdate']))
{
$attdate=mysqli_real_escape_string($connection, $_POST['attdate']);
}
else if(isset($_GET['attdate']))
{
$attdate=$_GET['attdate'];
}
else
{
$attdate=date('Y-m-d');
}
			if(isset($_GET['id']))
			{
				$eid=mysqli_real_escape_string($connection,$_GET['id']);
				
				  $sqlselect = "SELECT * From jrcengineer where enabled='0' and id='".$eid."' order by username asc";
				  
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
		while(strtotime($date) <= strtotime($end)) 
			{
$attdate=$date;	
		
		$sqlmap = "SELECT * From jrcengroute where engineerid='".$rowselect['id']."' and attdate like '".$attdate."%' order by attdate desc";
				  
        $querymap = mysqli_query($connection, $sqlmap);
        $rowCountmap = mysqli_num_rows($querymap);
         
        if(!$querymap){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountmap > 0) 
		{
			?><img src="<?=$_SESSION['companylogo']?>" width="100" class="float-right">
<h3 style="font-size:1.5rem"><?=$rowselect['engineername']?> - <?=date('d/m/Y',strtotime($attdate))?></h3>

<?php	
			$infomap=mysqli_fetch_array($querymap);	
			?>
			<table class="footer1" style="width:100%">
			<tr>
			<td width="50%" style="height:420px; vertical-align:top">
			<h5 class="text-primary">Travel Locations</h5>
<?php
if($infomap['startlocation']!='')
{
	$waypoints='';
	$endpoint=$infomap['startlocation'];
	for($j=1;$j<=7;$j++)
  {
	  
  if($infomap['location'.$j]!='')
  {
	  if($waypoints=='')
	  {
		  $waypoints.=''.$infomap['location'.$j];
	  }
	  else
	  {
		  $waypoints.='|'.$infomap['location'.$j];
	  }
	$endpoint=$infomap['location'.$j];  
  }
  }
if($infomap['endlocation']!='')
{
	$endpoint=$infomap['endlocation'];  
}
}
?>
<div class="history-tl-container">
  <ul class="tl">
  <?php
  $prev='';
  $totalkms=0;
  $dakms=0;
  if($infomap['startlocation']!='')
  {
	$data1 = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['startlocation']."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
	$data = json_decode($data1);  
  ?>
    <li class="tl-item" ng-repeat="item in retailer_history">
      <div class="timestamp">
	  <?php
	  echo (date('jS M Y',strtotime($infomap['starttime']))).'<br>'.(date('h:i a',strtotime($infomap['starttime'])));
	  ?>
      </div>
      <div class="item-title">Start from Home</div>
      <div class="item-detail"><?php
	  for($i=0;$i<=7;$i++)
	  {
		  if(isset($data->results[0]->address_components[$i]))
		  {
		  echo $data->results[0]->address_components[$i]->long_name.', ';
		  }
	  }
	  ?></div>
    </li>
	<?php
  }
  ?>
  <?php
  $callpoints=0;
  for($j=1;$j<=7;$j++)
  {
  if($infomap['location'.$j]!='')
  {
	$data1 = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['location'.$j]."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
	$data = json_decode($data1);  
  ?>
    <li class="tl-item" ng-repeat="item in retailer_history">
      <div class="timestamp">
	  <?php
	  echo (date('jS M Y',strtotime($infomap['loctime'.$j]))).'<br>'.(date('h:i a',strtotime($infomap['loctime'.$j])));
	  ?>
      </div>
      <div class="item-title">Reached to Customer <?=$j?> (<?=$infomap['loccall'.$j]?>) - <?=$infomap['lockm'.$j]?>Kms</div>
      <div class="item-detail">
	  <?php
	 $sqlcalls1 = mysqli_query($connection, "SELECT t1.consigneename, t1.area, t1.district From jrcconsignee t1, jrccalls t2 where t2.calltid='".$infomap['loccall'.$j]."' and t1.id=t2.consigneeid");
	 if(mysqli_num_rows($sqlcalls1)>0)
	 {
	 $infocalls1=mysqli_fetch_array($sqlcalls1);
	 echo '<b>'.$infocalls1['consigneename'].', '.$infocalls1['area'].', '.$infocalls1['district'].'</b><br>';
	 }
	  
	  for($i=0;$i<=7;$i++)
	  {
		  if(isset($data->results[0]->address_components[$i]))
		  {
		  echo $data->results[0]->address_components[$i]->long_name.', ';
		  }
	  }
	  ?></div>
    </li>
	<?php
	$totalkms+=(float)$infomap['lockm'.$j];
	$dakms+=(float)$infomap['lockm'.$j];
	$callpoints+=(float)$infomap['points'.$j];
  }
  }
  if($infomap['endlocation']!='')
  {
	$data1 = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$infomap['endlocation']."&sensor=true&key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg");
	$data = json_decode($data1);  
  ?>
    <li class="tl-item" ng-repeat="item in retailer_history">
      <div class="timestamp">
	  <?php
	  echo (date('jS M Y',strtotime($infomap['endtime']))).'<br>'.(date('h:i a',strtotime($infomap['endtime'])));
	  ?>
      </div>
      <div class="item-title">Back to Home - <?=$infomap['endkm']?>Kms</div>
      <div class="item-detail"><?php
	  for($i=0;$i<=7;$i++)
	  {
		  if(isset($data->results[0]->address_components[$i]))
		  {
		  echo $data->results[0]->address_components[$i]->long_name.', ';
		  }
	  }
	  ?></div>
    </li>
	<?php
	$totalkms+=(float)$infomap['endkm'];
  }
  ?>
    

  </ul>
<?php

if($totalkms<75)
{
	$dapoints=0;
}
else if(($totalkms>74)&&($totalkms<201))
{
	$dapoints=5;
}
else if(($totalkms>200)&&($totalkms<301))
{
	$dapoints=10;
}
else if(($totalkms>300)&&($totalkms<401))
{
	$dapoints=15;
}
else
{
	$dapoints=20;
}
$da=0;
if($totalkms<150)
{
$da=0;
}
else if(($totalkms>149)&&($totalkms<241))
{
$da=50;
}
else
{
$da=120;
}
if(($infomap['daamount']!='')&&($infomap['daamount']!='0'))
{
	$da=(float)$infomap['daamount'];
}
?>
</td>
<td class="historyid" align="center" rowspan="2">
<?php if($infomap['tickets']!=''){$as=explode(',',$infomap['tickets']);$c=1;foreach($as as $a){?>
<img src="<?=$a?>" width="80%" alt="">
<?php
}}?>
</td>
</tr>
<tr>
<td style="vertical-align:bottom;">
<h5 class="text-primary">Allowance Details</h5>

<div class="table-responsive">
<table class="table text-left">
<tr>
<th width="50%">Total Call Points:</th>
<td><input type="hidden" name="callpoints" value="<?=$callpoints?>"><?=$callpoints?></td>
</tr>
<tr>
<th>Total Kms Travelled:</th>
<td><input type="hidden" name="totalkms" value="<?=$totalkms?>"><?=$totalkms?></td>
</tr>
<tr>
<th>Total Travel Points:</th>
<td><input type="hidden" name="travelpoints" value="<?=$dapoints?>"><?=$dapoints?></td>
</tr>
<tr>
<th>DA: Rs.</th>
<td><input type="hidden" name="daamount" value="<?=$da?>"><input type="hidden" name="dakms" value="<?=$totalkms?>"><?=$da?> (<?=$totalkms?> Kms)</td>
</tr>
<tr>
<th>TA: Rs.</th>
<td><?=$infomap['totexpense']?></td>
</tr>
<tr>
<th style="font-size:1.5rem;">Total: (DA + TA) Rs.</th>
<td style="font-size:1.5rem;"><?=$da+(float)$infomap['totexpense']?></td>
</tr>
</table>
</div>
<?php
if($infomap['ticketapprove']=='0')
{
	?>
	<div class="text-danger">Approval Pending</div>
	<?php
}
else
{
	?>
	<div class="text-success">Ticket Approved by <?=$infomap['ticketapproveby']?> on <?=date('d/m/Y h:i:s a',strtotime($infomap['ticketapproveon']))?></div>
	<?php
}
?>
</div>
</td>

			</tr>
			</table>
			<?php
		}
	
$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
			}
		}
?>

		<?php
		
		}
			}
			?>
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
<script src="../../1637028036/vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/jszip.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="../../1637028036/vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>

  <!-- Page level custom scripts -->
  
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
window.print();
</script>
  </body>
</html>