<!-- carry in with map code-->
<?php
include('lcheck.php'); 

$sqllayoutinvoice=mysqli_query($connection, "select * from jrclayoutinvoice");
$infolayoutinvoice=mysqli_fetch_array($sqllayoutinvoice);
$sqllayoutcall=mysqli_query($connection, "select * from jrclayoutcall");
$infolayoutcall=mysqli_fetch_array($sqllayoutcall);
if($calladd=='0')
{
	header("location: dashboard.php");
}
$latlong="";
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT consigneeid,serialnumber From jrcxl where tdelete='0' and  id='".$id."' order by consigneename asc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{
			$count=1;
			$rowselect = mysqli_fetch_array($queryselect);
			$consigneeid=$rowselect['consigneeid'];
			$sqlselect1 = "SELECT ctype,latlong, consigneename From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowCountselect1 = mysqli_num_rows($queryselect1);
			if(!$queryselect1){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			if($rowCountselect1 > 0) 
			{
				$count=1;
				$rowselect1 = mysqli_fetch_array($queryselect1);

				$latlong=$rowselect1['latlong'];
			}		
		}
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
  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Complaint Call</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
	
	<!--map-->
	<script>
      let map;
function initMap()
{
	initMap1();
	initMap2();
}
      function initMap1() {
        map = new google.maps.Map(document.getElementById("map_div"), {
			<?php
			if($latlong!='')
			{
			?>	
          center: new google.maps.LatLng(<?=$latlong?>),
		  <?php
			}
			else
			{
			?>	
          center: new google.maps.LatLng(<?=$_SESSION['companylatlong']?>),
		  <?php
			}
			?>
          zoom: 14,
		  mapType: 'styledMap',
		  showTooltip: true,
			showInfoWindow: true,
			useMapTypeControl: true,
			maps: {
			  // Your custom mapTypeId holding custom map styles.
			  styledMap: {
				name: 'Styled Map', // This name will be displayed in the map type control.
				styles: [
				  {featureType: 'poi.attraction',
				   stylers: [{color: '#fce8b2'}]
				  },
				  {featureType: 'road.highway',
				   stylers: [{hue: '#0277bd'}, {saturation: -50}]
				  },
				  {featureType: 'road.highway',
				   elementType: 'labels.icon',
				   stylers: [{hue: '#000'}, {saturation: 100}, {lightness: 50}]
				  },
				  {featureType: 'landscape',
				   stylers: [{hue: '#259b24'}, {saturation: 10}, {lightness: -22}]
				  }
			]}}
        });
		const contentString ='Customer Location';
		const infowindow = new google.maps.InfoWindow({
			content: contentString,
		  });
        const iconBase =
          "http://maps.google.com/mapfiles/ms/icons/";
        const icons = {
          parking: {
            icon: iconBase + "blue-dot.png",
          },
          library: {
            icon: iconBase + "library_maps.png",
          },
          info: {
            icon: iconBase + "red-dot.png",
          },
        };
        const features = [
		<?php
		$sqlselect = "SELECT latlong, engineername From jrcengineer where latlong!='' and latlong!='$latlong' and enabled='0' order by engineername asc";
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
          {
            position: new google.maps.LatLng(<?=$rowselect['latlong']?>),
            type: "info",
			title: "<?=$rowselect['engineername']?>",
          },
		  <?php
			}
		}
			?>
			<?php
			if($latlong!='')
			{
			?>
          {
            position: new google.maps.LatLng(
			 <?=$latlong?>
            ),
			type: "parking",
			title: 'Customer Location',
          },
		  <?php
			}
			?>
        ];
        // Create markers.
        for (let i = 0; i < features.length; i++) {
          const marker = new google.maps.Marker({
            position: features[i].position,
            icon: icons[features[i].type].icon,
            map: map,
			title: features[i].title,
          });
		  google.maps.event.addListener(marker, "click", function(evt) {  
			infowindow.setContent(this.get('title'));
			infowindow.open(map,this);
			}); 
        }
      }
	  function initMap2() {
        map = new google.maps.Map(document.getElementById("map_div2"), {
			<?php
			if($latlong!='')
			{
			?>	
          center: new google.maps.LatLng(<?=$latlong?>),
		  <?php
			}
			else
			{
			?>	
          center: new google.maps.LatLng(<?=$_SESSION['companylatlong']?>),
		  <?php
			}
			?>
          zoom: 14,
		  mapType: 'styledMap',
		  showTooltip: true,
			showInfoWindow: true,
			useMapTypeControl: true,
			maps: {
			  // Your custom mapTypeId holding custom map styles.
			  styledMap: {
				name: 'Styled Map', // This name will be displayed in the map type control.
				styles: [
				  {featureType: 'poi.attraction',
				   stylers: [{color: '#fce8b2'}]
				  },
				  {featureType: 'road.highway',
				   stylers: [{hue: '#0277bd'}, {saturation: -50}]
				  },
				  {featureType: 'road.highway',
				   elementType: 'labels.icon',
				   stylers: [{hue: '#000'}, {saturation: 100}, {lightness: 50}]
				  },
				  {featureType: 'landscape',
				   stylers: [{hue: '#259b24'}, {saturation: 10}, {lightness: -22}]
				  }
			]}}
        });
		const contentString ='Customer Location';
		const infowindow = new google.maps.InfoWindow({
			content: contentString,
		  });
        const iconBase =
          "http://maps.google.com/mapfiles/ms/icons/";
        const icons = {
          parking: {
            icon: iconBase + "blue-dot.png",
          },
          library: {
            icon: iconBase + "library_maps.png",
          },
          info: {
            icon: iconBase + "red-dot.png",
          },
        };
        const features = [
		<?php
		$sqlselect = "SELECT id, latlong, consigneename From jrcconsignee where latlong!='' and latlong!='$latlong' order by consigneename asc";
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
          {
            position: new google.maps.LatLng(<?=$rowselect['latlong']?>),
            type: "info",
			title: '<?=mysqli_real_escape_string($connection,$rowselect["consigneename"])?> <br><a target="_blank" href="consigneeview.php?id=<?=$rowselect["id"]?>">View</a>',
          },
		  <?php
			}
		}
			?>
			<?php
			if($latlong!='')
			{
			?>
          {
            position: new google.maps.LatLng(
			 <?=$latlong?>
            ),
			type: "parking",
			title: 'Customer Location',
          },
		  <?php
			}
			?>
        ];
        // Create markers.
        for (let i = 0; i < features.length; i++) {
          const marker = new google.maps.Marker({
            position: features[i].position,
            icon: icons[features[i].type].icon,
            map: map,
			title: features[i].title,
          });
		  google.maps.event.addListener(marker, "click", function(evt) {  
			infowindow.setContent(this.get('title'));
			infowindow.open(map,this);
			}); 
        }
      }
    </script>
	
	
	
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<script>
var coll1 = document.getElementsByClassName("collapsible1");
var i;

for (i = 0; i < coll1.length; i++) {
  coll1[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
	
	<!--map-->
	
	
	 	<!--<style>
.select2-results__option:before {
  content: "";
  display: inline-block;
  position: relative;
  height: 20px;
  width: 20px;
  border: 2px solid #e9e9e9;
  border-radius: 4px;
  background-color: #fff;
  margin-right: 20px;
  vertical-align: middle;
}
.select2-results__option[aria-selected=true]:before {
  font-family:fontAwesome;
  content: "\f00c";
  color: #fff;
  background-color: <?=$_SESSION['bgcolor']?>;
  border: 0;
  display: inline-block;
  padding-left: 3px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
	background-color: #fff;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
	background-color: #eaeaeb;
	color: <?=$_SESSION['bgcolor']?>;
}

</style>-->
	 <style>
		
.collapsible {
  background-color: #3d8eb9 !important;
  color: white;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.collapsible1 {
  background-color: #3d8eb9 !important;
  color: white;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.active, .collapsible:hover {
  background-color: #fff;
}

.content {
  padding: 10px;
  display: none;
  overflow: hidden;
  background-color: #fff;
}

		</style>
	<style>
		.ajax-upload-dragdrop, .ajax-file-upload-statusbar
		{
			width: auto !important;
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
  .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
  }
  .col-9, .col-3 {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
    padding-top: 15px;
    box-sizing: border-box; /* Ensures padding and border are included in the width */
  }
  .col-9 {
    flex: 0 0 75%;
    max-width: 75%;
  }
  .col-3 {
    flex: 0 0 25%;
    max-width: 25%;
    border: 1px solid #3d8eb9; /* Add border to col-3 */
  }
</style>
		<style>
h6 {
line-height: 0.6;
font-size: 0.8rem;

}
.font-13 {
    font-size: 0.7rem !important;
}
</style>
 <?php
		 $sqlcall = "SELECT sourceid, callfrom, callon, calltid, acknowlodge, compstatus, changeon, id, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid,engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, callnature, customernature, businesstype, servicetype, calltype, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid, wastatus, consigneeid  From jrccalls where sourceid='".$id."' order by id desc";
		$querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcall > 0) 
		{
			
			$count=1;
			$rowcall= mysqli_fetch_array($querycall);
		
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowcall['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
					$rowxl = mysqli_fetch_array($queryxl);
					//alert box start
					
					 
			$rowcall1 = mysqli_fetch_array($querycall);
			
			/* if ($rowcall1['wastatus'] == 0 && $rowcall1['consigneeid'] == $rowxl['consigneeid']) {
            echo '<script>alert("This product is currently awaiting approval.");</script>';
        } */
		if ($rowcall1 !== null && $rowxl !== null && $rowcall1['wastatus'] == 0 && $rowcall1['consigneeid'] == $rowxl['consigneeid']) {
    echo '<script>alert("This product is currently awaiting approval.");</script>';
}
}

		// alert box end 
		?>
</head>
<body id="page-top" onLoad="checkcarry();checkengineer(); checkreport()">
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
          <?php //include('callnavbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
         
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
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT * From jrcxl where tdelete='0' and  id='".$id."' order by consigneename asc";
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
				
				
				
				//$t start
				
				if(isset($_GET['type']))
 {
			$sqlamc = "SELECT dateto From jrcrental where rono='".$rowselect['rono']."' and id='".$_GET['type']."'";
$queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountamc!=0)
		{
		$rowamc = mysqli_fetch_array($queryamc); 
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
	
	//echo '<span class="bg-danger text-white">Lasped Rental <strong>('.date('d/m/Y h:i a',strtotime($rowamc['dateto'])).')</strong></span><br>';
    /* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
    $t=3;
	//echo '<span class="bg-success text-white">Rental Active <strong>('.date('d/m/Y h:i a',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
 }
 //rental end

			
 $sqlamc = "SELECT dateto From jrcamc where sourceid='".$rowselect['id']."' order by id desc";
$queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountamc!=0)
		{
		
		$rowamc = mysqli_fetch_array($queryamc); 
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
	
	//echo '<span class="bg-danger text-white">AMC Expired <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
    /* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
    $t=2;
	//echo '<span class="bg-success text-white">AMC Active <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		
if($infolayoutinvoice['warranty']=='1')
{
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
			if($date < $now)
			{
				if(!isset($t))
				{
				 $t=1;
				}
				//echo '<span class="bg-danger text-white">Warranty Expired <strong>('.$effectiveDate1.')</strong></span><br>';
				
			}
			else
			{
				if(!isset($t))
				{
					//$t =0  warranty
					//$t =1  out of warranty
					//$t =2  AMC
					//$t =3  Rental
					
			    $t=0;
			 $t;
				}
				//echo '<span class="bg-success text-white">Warranty Active <strong>('.$effectiveDate1.')</strong></span><br>';
				
				?>
				<script>
				document.getElementById("warrantycustomer").style.display="inline-block";
				</script>
				<?php
				
			}
			}
}
				
				
				//$t end
				
				
				 $consigneeid=$rowselect['consigneeid'];
			$sqlselect1 = "SELECT consigneename, address1, address2, area, district, pincode, mobile, contact, phone, email, maincategory, subcategory, department,latlong,id,ctype   From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowCountselect1 = mysqli_num_rows($queryselect1);
			if(!$queryselect1){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			if($rowCountselect1 > 0) 
			{
				$count=1;
				$rowselect1 = mysqli_fetch_array($queryselect1);
				$latlong=$rowselect1['latlong'];
				$mobile=$rowselect1['mobile'];
			}
				
			?>
			
			
			
		<div class="main-body">
		<div class="col-md-12" >
		<h6 class="text-center text-primary "><b><?=$conname=$rowselect1['consigneename']?> </b><a href="consigneeedit.php?id=<?=$rowselect1['id']?>" ><i class="fa fa-edit"></i></a></h6>	
		<h6 class="text-center text-black "><b><?=$rowselect['stockitem']?></b> - 
			<!-- Start Customer Nature -->
			<?php
if($infolayoutinvoice['warranty']=='1')
{
if($rowselect['warranty']!='')
{	
?>
<?php
			
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
			if($date < $now)
			{
				echo '<span class="text-danger"><b>O/W</b><strong class="text-dark"> ('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
			}
			else
			{
				echo '<span class="text-success"><b>WAR</b><strong class="text-dark"> ('.$effectiveDate1.')</strong></span><br>';
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
	
?>

			<?php
 $sqlamc = "SELECT dateto,id From jrcamc where sourceid='".$rowselect['id']."' order by id desc";
$queryamc = mysqli_query($connection, $sqlamc);
        $rowCountamc = mysqli_num_rows($queryamc);
         
        if(!$queryamc){
           die("SQL query failed: " . mysqli_error($connection));
        }
		if($rowCountamc!=0)
		{
		?>
<?php		
         
		$rowamc = mysqli_fetch_array($queryamc); 
		$_SESSION['amcid']=$rowamc['id'];
		$_SESSION['dateto']=$rowamc['dateto'];
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
	
	echo '<span class="text-danger"><b>AMC Expired</b> <strong class="text-dark">('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
    /* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
	echo '<span class=" text-success"><b>AMC Active</b> <strong class="text-dark">('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}?>
			<!-- End Customer Nature -->
			</h6>
		</div>
		</div>
		
				
		<div class="row">
		<div class="col-lg-8" id="maindiv">
  <div class="cardbox2">
  
  <div class="card-header2" style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2" onclick="toggleCallInput()" style="color:#fff;"><b>Book Complaint</b></h6>
    </div>
    <div class="card-body2" id="callBody" >

			  <form method="post" action="callsadds.php">
		<?php 	 
		 $sqlcall1 = "SELECT sourceid, callfrom, callon, calltid, acknowlodge, compstatus, changeon, id, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid,engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, callnature, customernature, businesstype, servicetype, calltype, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid, wastatus, consigneeid  From jrccalls where sourceid='".$id."' and wastatus='0' and actiontaken='WAITING FOR APPROVAL' order by id desc";
		$querycall1 = mysqli_query($connection, $sqlcall1);
        $rowCountcall1 = mysqli_num_rows($querycall1);
        if(!$querycall1){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcall1 > 0) 
		{
			
			$count=1;
			
		while($rowcall1 = mysqli_fetch_array($querycall1)) {
    $wcalltid = $rowcall1['calltid'];
    if (!empty($wcalltid)) {
         $wcalltid;  
		?><input type="hidden" id="wcalltid" name="wcalltid" value="<?=$wcalltid?>">
        <?php 
    }
}
}
				?>
			  <input type="hidden" id="consigneeid" name="consigneeid" value="<?=$consigneeid?>">
			  <input type="hidden" id="sourceid" name="sourceid" value="<?=$id?>">
			
			  <input type="hidden" name="callhandlingname" id="callhandlingname" value="JRC" class="ui-autocomplete-input" autocomplete="off">
			  <input type="hidden" name="callhandlingid" id="callhandlingid" value="1"> 
			 <div class="row">
			 <div class="col-lg-6 " id="productdiv">
			 <div class="form-group text-center">
 <b style="font-size:14px;"><label class="text-primary">Call Nature</label></b>
</div>
<?php

$businesstypes1=explode(',',$businesstype);	
if($infolayoutcall['businesstype']=='1')
{
if(count($businesstypes1)>1)
{
?>				
  <div class="form-group">
    <div class="input-container"><label for="businesstype" >Business Type :</label>
	  <select class="fav_clr form-control" name="businesstype" id="businesstype" <?= ($infolayoutcall['businesstypereq'] == '1') ? 'required' : '' ?>>
	  <?php
if($businesstype!='')
{
$businesstypes=explode(',',$businesstype);
  $selected = true;
foreach($businesstypes as $btype)
{
?>	
		
	  
	  
	  <option value="<?=$btype?>" <?=($infolayoutcall['businesstypereq']=='1')?'required':''?> <?=($selected)?'selected':''?>><?=$btype?></option>
		
	  
					
	
<?php
 $selected = false;
	}
	}
	?></select>
	</div>
	</div>
	
	<?php
}
	else
	{
		?>
			<input type="hidden" name="businesstype" id="businesstype" value="<?=$businesstypes1[0]?>">
		<?php
	}
}
else
{
	?>
		<input type="hidden" name="businesstype" id="businesstype" value="<?=$businesstypes1[0]?>">
	<?php
}
?>
<?php

if($infolayoutcall['callfrom']=='1')
{//ECHO $businesstypes1;
?>					
	
	<div class="form-group">
    <div class="input-container"> <label for="callfrom" >Call Received From :</label>
	<input type="text" inputmode="numeric" class="form-control" id="callfrom" name="callfrom" maxlength="11"  value="<?=$mobile?>" <?=($infolayoutcall['callfromreq']=='1')?'required':''?>>

	</div>
	</div>
<?php
}
else
{
	?>
	<input type="hidden" name="callfrom" id="callfrom" value="">
	<?php
}
?>

	
<?php
if($infolayoutcall['customernature']=='1')
{
?>					
  <div class="form-group">
    <div class="input-container">	   
	<label for="businesstype" >Customer Nature :</label>
	 <select class="fav_clr form-control" name="customernature" id="customernature" <?= ($infolayoutcall['customernaturereq'] == '1') ? 'required' : '' ?>>
	 <?php
	 if(($infolayoutcall['customernaturew']=='1'))
					  { ?>
        <option value="Warranty" <?=($infolayoutcall['customernaturew']=='1')?'required':''?><?=((isset($primarywarranty))&&(($primarywarranty=='Warranty')))?'selected':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')))?'selected':''?>  <?=((isset($t))&&(($t=='0')))?'selected':''?>>Warranty</option>
					  <?php } 
	 if(($infolayoutcall['customernaturea']=='1'))
					  { ?>
        <option value="AMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?><?=((isset($primarywarranty))&&(($primarywarranty=='AMC')))?'selected':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'selected':''?> <?=((isset($t))&&(($t=='2')))?'selected':''?>>AMC</option>
					  <?php } 
					   if(($infolayoutcall['customernatureow']=='1'))
					  {
					  ?>
					  <option value="Out of Warranty" <?=((isset($primarywarranty))&&(($primarywarranty=='Out of Warranty')))?'selected':''?> <?=((isset($t))&&(($t=='1')))?'selected':''?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>Out of Warranty</option>
					  
					  
					  
					  
<?php
					  }
					  
					    if(($infolayoutcall['customernaturenone']=='1'))
					  {
					  ?>
					   <option value="None" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>  <?=((isset($t))&&(($t=='1') || ($t=='0') || ($t=='2')) )?'':'selected'?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>None</option>
<?php
					  }
					  
					  
					  if(($infolayoutcall['customernatureom']=='1'))
					  {
					  ?>
					   <option value="Other Make" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>Other Make</option>
<?php
					  } 
					  if(($infolayoutcall['customernaturefsma']=='1'))
					  {
					  ?>
					   <option value="FSMA" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>FSMA</option>
<?php
					  }
					  if(($infolayoutcall['customernaturecamc']=='1'))
					  {
					  ?>
					   <option value="CAMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>CAMC</option>
<?php
					  }
					  if(($infolayoutcall['customernaturerental']=='1'))
					  {
					  ?>
					   <option value="Rental" <?=(isset($_GET['type']))?'selected':''?> <?=((isset($t))&&(($t=='3')))?'selected':''?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>Rental</option>
<?php
					  }
					  if(($infolayoutcall['customernaturecorporate']=='1'))
					  {
					  ?>
					   <option value="Corporate" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>Corporate</option>
<?php
					  }
					  if(($infolayoutcall['customernaturewalkin']=='1'))
					  {
					  ?>
					   <option value="Walk-In" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>Walk-In</option>
<?php
					  }if(($infolayoutcall['customernaturechannel']=='1'))
					  {
					  ?>
					   <option value="Channel" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Channel</option>
<?php
					  }
					  ?>
    </select>
        <!-- Add more options if needed -->
		<!--
<?php
						if(($infolayoutcall['customernaturea']=='1'))
					  {
						  ?>
<label class="mr-2"><input type="radio" name="customernature" <?=((isset($primarywarranty))&&(($primarywarranty=='AMC')))?'checked':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> <?=((isset($t))&&(($t=='2')))?'checked':''?> value="AMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> AMC </label>
<?php
					  }
					  if(($infolayoutcall['customernaturew']=='1'))
					  {
						 
					  ?>
<label class="mr-2"><input type="radio" name="customernature" <?=((isset($primarywarranty))&&(($primarywarranty=='Warranty')))?'checked':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')))?'checked':''?>  <?=((isset($t))&&(($t=='0')))?'checked':''?> value="Warranty" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Warranty </label>
<?php
					  }
					  if(($infolayoutcall['customernatureow']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Out of Warranty" <?=((isset($primarywarranty))&&(($primarywarranty=='Out of Warranty')))?'checked':''?> <?=((isset($t))&&(($t=='1')))?'checked':''?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Out of Warranty </label>
<?php
					  }
					  if(($infolayoutcall['customernaturenone']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="None"  <?=((isset($t))&&(($t=='1') || ($t=='0') || ($t=='2')) )?'':'checked'?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> None </label>
<?php
					  }
					  if(($infolayoutcall['customernatureom']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Other Make" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Other Make</label>
<?php
					  } 
					  if(($infolayoutcall['customernaturefsma']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="FSMA" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> FSMA</label>
<?php
					  }
					  if(($infolayoutcall['customernaturecamc']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="CAMC" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> CAMC</label>
<?php
					  }
					  
					  if(($infolayoutcall['customernaturerental']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Rental" <?=(isset($_GET['type']))?'checked':''?> <?=((isset($t))&&(($t=='3')))?'checked':''?> <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>>   Rental</label>
<?php
					  } 
					  if(($infolayoutcall['customernaturecorporate']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Corporate" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Corporate</label>
<?php
					  }
					  if(($infolayoutcall['customernaturewalkin']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Walk-In" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Walk-In</label>
<?php
					  }
					  if(($infolayoutcall['customernaturechannel']=='1'))
					  {
					  ?>
<label class="mr-2"><input type="radio" name="customernature" value="Channel" <?=($infolayoutcall['customernaturereq']=='1')?'required':''?>> Channel</label>
<?php
					  }
					  ?>-->
	</div>
	</div>
<?php
	}else {
		?>
		<input type="hidden" name="customernature" id="customernature" value="">
		<?php
	}
?>


<?php

if($infolayoutcall['coordinator']=='1'){
	//ECHO $businesstypes1;
?>					
	
	<div class="form-group">
    <div class="input-container"> <label for="coordinatorid" >Co-Ordinator :</label>
	
	<?php
	$sqlrep1 = "SELECT id, adminusername From jrcadminuser where id='".$_SESSION['coordinatorid']."' order by adminusername asc";
        $queryrep1 = mysqli_query($connection, $sqlrep1);
        $rowCountrep1 = mysqli_num_rows($queryrep1);
		$rowrep1 = mysqli_fetch_array($queryrep1);
		?>
		<input type="hidden" id="coordinatorname" name="coordinatorname" <?=($infolayoutcall['coordinatorreq']=='1')?'required':''?> value="<?=$rowrep1['adminusername']?>" >
<select class="form-control fav_clr" id="coordinatorid" name="coordinatorid" <?=($infolayoutcall['coordinatorreq']=='1')?'required':''?> onchange="valchange('coordinator')">

<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser where enabled='0'  order by adminusername asc";
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
	 <option value="<?=$rowrep['id']?>" <?=(($rowrep['id']==$_SESSION['coordinatorid'])?"selected":"")?>><?=$rowrep['adminusername']?></option><?php
			}
		}
		?>
</select>
	</div>
	</div>
<?php
	}
?>





<?php

if($infolayoutcall['servicetype']=='1'){
?>					
  <div class="form-group">
    <div class="input-container" >	   
	<label for="servicetype" >Service Type :</label>
	
	
	
	<select class="fav_clr form-control" name="servicetype" onchange="checkcarry()" id="servicetype" <?=($infolayoutcall['servicetypereq']=='1')?'required':''?>>
    <option value="On-Site" <?=((isset($_GET['ts']))&&(($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'selected':''?>  onchange="checkcarry();" id="servicetypeonsite">On-Site</option>
	
    <?php if ($liveplan == 'GOLD' || $liveplan == 'DIAMOND'): ?>
    <option value="Carry-In" <?=((isset($_GET['at']))&&($_GET['at']=="in"))?'selected':''?> onchange="checkcarry();" id="servicetypecarry">Carry-In</option>
    <?php endif; ?>
</select>

	</div>
	</div>
<?php
	}
?>




<?php
if($infolayoutcall['calltype']=='1')

{

?>




<div class="form-group">
    <div class="input-container"> <label for="calltype" >Call Type : </label>
	
<!--<div class="col-lg-4 mb-3" style="border-right:1px solid #cccccc">

<label class="mr-2"><input type="radio" name="calltype" value="Service Call" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>> Service Call (Received from Customer) </label>

</div>

<div class="col-lg-6 mb-3">

<label class="mr-2"><input type="radio" name="calltype" <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')||($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'checked':''?> value="Other Call" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>> Other Call (Service Related Activities) </label>



</div>-->



	<select class="form-control fav_clr" id="calltype" name="calltype" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>>
<!--<option value="">Select</option>-->
<?php
$sqlrep = "SELECT calltype From jrccallnature order by calltype asc";
        $queryrep = mysqli_query($connection, $sqlrep);
        $rowCountrep = mysqli_num_rows($queryrep);
        if(!$queryrep){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountrep > 0) 
		{
			$count=1;
			$rowrep = mysqli_fetch_array($queryrep);
				?>
<option  value="Service Call" id="calltypes" <?=($infolayoutcall['calltypereq']=='1')?'required':''?>>Service Call</option>
<option value="Other Call" id="calltypeo" <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire')||($_GET['ts']=='amcmaintenance')||($_GET['ts']=='amcexpire')))?'selected':''?>  <?=($infolayoutcall['calltypereq']=='1')?'required':''?>> Other Call</option>
<?php
			
		}
		?>
		</select>
		</div>
		</div>
<?php

}

else

{

	?>

	<input type="hidden" name="calltype" id="calltype" value="">

	<?php

}
?>


	
<?php
if($infolayoutcall['callnature']=='1')
{
?>					
	
	<div class="form-group">
    <div class="input-container"> <label for="callnature" >Call Nature<span href="#" data-toggle="modal" data-target="#callnaturemodal">&nbsp;<i class="fa fa-plus text-primary"></i> </span>: </label>
	<select class="form-control fav_clr" id="callnature" name="callnature" <?=($infolayoutcall['callnaturereq']=='1')?'required':''?>>
<!--<option value="">Select</option>-->
<?php
$sqlrep = "SELECT callnature From jrccallnature order by callnature asc";
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
<option value="<?=$rowrep['callnature']?>"><?=$rowrep['callnature']?></option>
<?php
			}
		}
		?>
</select>
	</div>
	</div>
<?php
}
else
{
	?>
	<input type="hidden" name="callnature" id="callnature" value="">
	<?php
}
?>

<?php
if($infolayoutcall['callon']=='1')
{
?>					
	
	<div class="form-group">
    <div class="input-container"> <label for="callon" >Call Received On : </label>
	 <input type="text" class="form-control" id="callon" name="callon" readonly  value="<?=date('Y-m-d H:i:s')?>" <?=($infolayoutcall['callonreq']=='1')?'required':''?>>
	</div>
	</div>
<?php
}
else
{
	?>
	<input type="hidden" name="callon" id="callon" value="<?=date('Y-m-d H:i:s')?>">
	<?php
}
?>
<?php
if($infolayoutcall['reportedproblem']=='1')
{
?>					
	
	<div class="form-group">
    <div class="input-container"> <label for="reportedproblem" >Reported Problem<span href="#" data-toggle="modal" data-target="#reportmodal">&nbsp;<i class="fa fa-plus text-primary" ></i> </span>: </label>
	 <select class="form-control fav_clr" id="reportedproblem" name="reportedproblem" <?=($infolayoutcall['reportedproblemreq']=='1')?'required':''?>>
<option value="">Select</option>
<?php
$sqlrep = "SELECT reportedproblem From jrcreportedproblem order by reportedproblem asc";
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
<option value="<?=$rowrep['reportedproblem']?>" <?=((isset($_GET['t']))&&($_GET['t']=='wm')&&($rowrep['reportedproblem']=='WARRANTY MAINTENANCE'))?'selected':''?> <?=((isset($_GET['ts']))&&(($_GET['ts']=='preventive')||($_GET['ts']=='warrantyexpire'))&&($rowrep['reportedproblem']=='WARRANTY MAINTENANCE'))?'selected':''?> <?=((isset($_GET['t']))&&($_GET['t']=='am')&&($rowrep['reportedproblem']=='AMC MAINTENANCE'))?'selected':''?>><?=$rowrep['reportedproblem']?></option>
<?php
			}
		}
		?>
</select>
	</div>
	</div>
<?php
}
else
{
	?>
	<input type="hidden" name="reportedproblem" id="reportedproblem" value="">
	<?php
}
?>
<?php
if($infolayoutcall['serial']=='1')
{
	if(isset($_GET['type']))
	{
?>					
	
	<div class="form-group">
    <div class="input-container"> <label for="serial" >Serial Number : </label>
	<select class="js_select2 form-control" name="serial[]" id="serial" <?=($infolayoutcall['serialreq']=='1')?'required':''?> multiple="multiple">
	<?php
	$sqlserial = "SELECT serialnumber,id From jrcrental where id='".$_GET['type']."'  order by id asc";
        $queryserial = mysqli_query($connection, $sqlserial);
        $rowCountserial = mysqli_num_rows($queryserial);
        if(!$queryserial){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountserial > 0) 
		{
			$count=1;
			while($rowserial = mysqli_fetch_array($queryserial)) 
			{
				$serialnumbers=explode(" | ",$rowserial['serialnumber']);
	if(!empty($serialnumbers))
				  {
					  foreach($serialnumbers as $ser)
					  {
						  
						 ?>
						  <option value="<?=$ser?>" ><?=$ser?></option>
	<?php
					  }
				  }	 
			}
		}
	?>
	<option value="Not Available">Not Available</option>
	</select>
	</div>
	</div>
<?php
}
else
{
	?>
	<div class="form-group">
    <div class="input-container"> <label for="serial" >Serial Number : </label>
	<select class="fav_clr form-control" name="serial[]" id="serial" <?=($infolayoutcall['serialreq']=='1')?'required':''?> multiple="multiple">
	<?php
	echo $sqlserial = "SELECT serialnumber From jrcserials where sourceid='".$_GET['id']."' and sstatus='0' order by serialqty asc";
        $queryserial = mysqli_query($connection, $sqlserial);
        $rowCountserial = mysqli_num_rows($queryserial);
        if(!$queryserial){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountserial > 0) 
		{
			$count=1;
			while($rowserial = mysqli_fetch_array($queryserial)) 
			{
				?>
				<option value="<?=$rowserial['serialnumber']?>"><?=$rowserial['serialnumber']?></option>
				<?php
			}
		}
		else
		{
		    ?>
		    <option value="<?=$rowselect['serialnumber']?>"><?=$rowselect['serialnumber']?></option>
		    	<?php
		}
	?>

<option value="Not Available">Not Available</option>

	</select>
	</div>
	</div><?php
}}
else
{
	?>
	<input type="hidden" name="serial" id="serial" value="Not Available">
	<?php
}
?>



	
<?php
if($infolayoutcall['otherremarks']=='1')
{
?>					
	
	<div class="form-group">
    <div class="input-container"> <label for="otherremarks" >Other Remarks : </label>
	 <textarea type="text" class="form-control" id="otherremarks" name="otherremarks"  <?=($infolayoutcall['otherremarksreq']=='1')?'required':''?>></textarea>
	 </div>
	</div>
<?php
}
else
{
	?>
	<input type="hidden" name="otherremarks" id="otherremarks" value="">
	<?php
}
?><div id="infodiv">
 <div class="form-group text-center">
 <b style="font-size:14px;"><label class="text-primary">Product Information</label></b>
</div>
		 <div class="form-group">
    <div class="input-container">
  <label for="diagnosissignname">Received From (Name) :</label>
    <input type="text" class="form-control" name="diagnosissignname" id="diagnosissignname">
  </div>
	</div>
	<div class="form-group">
    <div class="input-container">
  <label for="diagnosissignmode">Received Mode :</label>
   <select class="form-control fav_clr" id="diagnosissignmode" name="diagnosissignmode">
   <option value="">Select</option>
<option value="By Hand">By Hand</option>
<option value="By Courier">By Courier</option>
</select>
  </div>
  </div>
<div class="form-group">
    <div class="input-container">
  <label for="diagnosissignmoderemark">Remarks :</label>
   <textarea  class="form-control" id="diagnosissignmoderemark" name="diagnosissignmoderemark" rows="1">
</textarea>
  </div>
	</div>
 
</div>
</div>
<hr>
<!-- start Carry-In model-->
		<div id="carrydiv" class="col-lg-4">
		<!--<div class="form-group">
 <label class="text-primary"></label>
	</div>-->
 
<div class="form-group text-center">
 <b style="font-size:14px;"><label class="text-primary">Diagnosis Information</label></b>
</div>


 <div class="form-group">
    <div class="input-container"> 
	 <label for="diagnosisby">Diagnosis By :</label>
	<select class="fav_clr form-control" name="diagnosisby"  onchange="checkcarry()"> 
	<option id="awaitingfordiagnosis" value="awaiting" onchange="checkcarry()" >Awaiting</option>
    <option id="diagnosisbyengineer" value="engineer" onchange="checkcarry()">Engineer</option>
    <option id="diagnosisbycoordinator" value="coordinator" onchange="checkcarry()">Co-ordinator</option>
   
	</select>
  </div>
</div>
	<div id="diagnosiseng">
 <div class="form-group">
    <div class="input-container">
    <label for="diagnosisname">Engineer Name :</label>
	<input type="hidden" id="diagnosisengineername" name="diagnosisengineername" >	
	<select class="form-control fav_clr" id="diagnosisengineerid" name="diagnosisengineerid" onchange="valchange('diagnosisengineer');checkcarry();">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer  where enabled='0'  order by engineername asc";
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
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
	</div>
	</div>

	<div id="diagnosiscoor">
	<div class="form-group">
    <div class="input-container">
    <label for="diagnosisname">Co-Ordinator Name :</label>

	<input type="hidden" id="diagnosiscoordinatorname" name="diagnosiscoordinatorname">	
	<select class="form-control fav_clr" id="diagnosiscoordinatorid" name="diagnosiscoordinatorid" onchange="valchange('diagnosiscoordinator'); checkcarry();">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, adminusername From jrcadminuser  where enabled='0'  order by adminusername asc";
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
<option value="<?=$rowrep['id']?>"><?=$rowrep['adminusername']?></option>
<?php
			}
		}
		?>
</select>

  </div>
	</div>
	</div>
<div id="diagnosis">
<!--<div class="form-group">
    <div class="input-container">
    <label for="callon">Diagnosed On :</label>
    <input type="datetime-local" class="form-control" id="diagnosison" value="<?=date('Y-m-d H:i:s')?>" name="diagnosison" step="60">
  </div>
  </div>-->
<input type="hidden" class="form-control" id="diagnosison" value="<?=date('Y-m-d H:i:s')?>" name="diagnosison" step="60">
  
  
<div class="form-group">
    <div class="input-container">
    <label for="problemobserved">Problem Observed :</label>
<select class="form-control fav_clr" id="problemobserved" name="problemobserved">
<option value="">Select</option>
<?php
$sqlrep = "SELECT problemobserved From jrcproblemobserved order by problemobserved asc";
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
<option value="<?=$rowrep['problemobserved']?>"><?=$rowrep['problemobserved']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>

<div class="form-group">
    <div class="input-container">
    <label for="diagnosisremarks">Diagnosis Remarks :</label>
<textarea class="form-control" id="diagnosisremarks" name="diagnosisremarks"></textarea>
  </div>
  </div>
  <div class="form-group">
    <div class="input-container">
    <label for="diagnosisestcharge">Estimated Charges :</label>
    <input type="number" class="form-control" id="diagnosisestcharge" name="diagnosisestcharge" min="0" step="0.01">
  </div>
  </div>
  <div class="form-group">
    <div class="input-container">
    <label for="diagnosisestdate">Estimated Date of Completion :</label>
    <input type="datetime-local" class="form-control" id="diagnosisestdate" name="diagnosisestdate" step="60">
  </div>
  </div>



  
  </div>
 <div class="form-group text-center">
 <b style="font-size:14px;"><label class="text-primary">Product Received Information</label></b>
</div>
	
<div class="form-group" >
    <div class="input-container">
    <label for="receivedby">Received By :</label>
 <input type="text" class="form-control" name="receivedby" id="receivedby" onchange="checkcarry();">
  
  </div>
  </div><div class="form-group">
    <div class="input-container">
  <label for="receivedby">Receiver Signature :</label>
    <input type="hidden" class="form-control" name="receiversignature" id="receiversignature" value="">
	<a class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#rsignModal">Get Signature</a>
	
	<img id="receiversignatureimg" src="">
	<div id="rsignModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Get Signature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" class="text-center" align="center">
        <p class="text-center"><div id="rsignpad" align="center" style="border:1px solid #000000; width:302px; height:202px;">
		<canvas class="rpad" id="rpad" width="300" height="200" ></canvas>
		</div></p>
      </div>
      <div class="modal-footer">
	  <input type="button" class="btn btn-warning" value="Clear" id="rclear" />
			<input type="button" id="rbtnSaveSign" class="btn btn-success" value="Submit"  data-dismiss="modal"/>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>


  </div>
  <div class="form-group">
    <div class="input-container">
    <label for="diagnosismaterial">Other Materials :</label>
<select class="form-control fav_clr" id="diagnosismaterial" name="diagnosismaterial[]" multiple>
<option value="">Select</option>
<?php
$sqlrep = "SELECT material From jrcmaterial order by material asc";
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
<option value="<?=$rowrep['material']?>"><?=$rowrep['material']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>

  <!--div class="col-lg-3">
      <div class="form-group">
    <label for="diagnosismaterial">Additional Materials Remarks</label>
<textarea class="form-control" id="diagnosismaterial" name="diagnosismaterial"></textarea>
  </div>
  </div-->
  	
<div class="form-group">
    <div class="input-container">
    <label for="godown">Move To Warehouse:</label>
<select class="form-control fav_clr" id="godownname" name="godownname">
<option value="">Select</option>
<?php
$sqlgo = "SELECT id, godownname From jrcgodown order by id asc";
        $querygo = mysqli_query($connection, $sqlgo);
        $rowCountgo = mysqli_num_rows($querygo);
        if(!$querygo){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountgo > 0) 
		{
			$count=1;
			while($rowgo = mysqli_fetch_array($querygo)) 
			{
				?>
<option value="<?=$rowgo['id']?>"><?=$rowgo['godownname']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
<div class="form-group">
    <div class="input-container">
    <label for="godown">To OEM / Supplier :</label>
<select class="form-control fav_clr" id="suppliername" name="suppliername">
<option value="">Select</option>
<?php
$sqlsup = "SELECT id, suppliername From jrcsuppliers order by suppliername asc";
        $querysup = mysqli_query($connection, $sqlsup);
        $rowCountsup = mysqli_num_rows($querysup);
        if(!$querysup){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountsup > 0) 
		{
			$count=1;
			while($rowsup = mysqli_fetch_array($querysup)) 
			{
				?>
<option value="<?=$rowsup['id']?>"><?=$rowsup['suppliername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
  </div>
  <div id="diagnosisawait">
	</div>
	<div class="form-group">
    <div class="input-container">
<label for="diagnosisimg">Product Images :</label>
<div id="mulitplefileuploader" style="width:100%">Upload Site Images</div>
<div id="status"></div>
<div id="showData" class="imgcontainer">
</div>
<input id="diagnosisimg" type="hidden" name="diagnosisimg" value="">
	
	</div>
	</div>
	
<div class="form-group">
    <div class="input-container">
  <label for="diagnosissignname">Customer Signature :</label>
    <input type="hidden" class="form-control" name="diagnosissignature" id="diagnosissignature" value="">
	<a class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#signModal">Get Signature</a>
	
	<img id="diagnosissignatureimg" src="">
	<div id="signModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Get Signature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" class="text-center" align="center">
        <p class="text-center"><div id="signpad" align="center" style="border:1px solid #000000; width:302px; height:202px;">
		<canvas class="pad" id="pad" width="300" height="200" ></canvas>
		</div></p>
      </div>
      <div class="modal-footer">
	  <input type="button" class="btn btn-warning" value="Clear" id="clear" />
			<input type="button" id="btnSaveSign" class="btn btn-success" value="Submit"  data-dismiss="modal"/>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>

  </div>
   <div id="submitdiv1">

<?php
if($infolayoutcall['customersms']=='1')
{
?>
<div class="form-group">
<!--<label>--><input type="hidden" name="customersms" id="customersms" value="<?=($infolayoutcall['customersmsreq']=='1')?'1':'0'?>" ><!--Send to customer </label> -->
<?php
}
if($infolayoutcall['coordinatorsms']=='1')
{
?>
<input type="hidden" name="callhandledsms" id="callhandledsms" >
<!--<label>--><input type="hidden" name="coordinatorsms" id="coordinatorsms" value="<?=($infolayoutcall['coordinatorsmsreq']=='1')?'1':'0'?>"><!--Send to Co-Ordinator </label> -->
<?php
}
if($infolayoutcall['engineersms']=='1')
{
?>
<!--<label>--><input type="hidden" name="engineersms" id="engineersms" value="<?=($infolayoutcall['engineersmsreq']=='1')?'1':'0'?>"><!--Send to Engineer </label>-->
</div>

<?php
}
?>
<!--
<div class="form-group">
<?php
if($infolayoutcall['sms']=='1')
{
?>
<label><input type="checkbox" name="customerwa" id="customerwa" checked >SMS <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a SMS Package to Send SMS to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label> 
<?php
}
if($infolayoutcall['whatsapp']=='1')
{
?>
<input type="hidden" name="callhandledwa" id="callhandledwa">
<label><input type="checkbox" name="coordinatorwa" id="coordinatorwa" checked>Whatsapp <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a WHATSAPP API Package to Send WHATSAPP to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label>
<?php
}
if($infolayoutcall['mail']=='1')
{
?>
<label><input type="checkbox" name="engineerwa" id="engineerwa" checked>Mail </label>


<?php
}
?></div>-->

<div class="form-group">
<?php
if($infolayoutcall['sms']=='1')
{
?>
<!--<label>--><input type="hidden" name="customerwa" id="customerwa" checked ><!--SMS <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a SMS Package to Send SMS to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label> -->
<?php
}
if($infolayoutcall['whatsapp']=='1')
{
?>
<input type="hidden" name="callhandledwa" id="callhandledwa">
<!--<label>--><input type="hidden" name="coordinatorwa" id="coordinatorwa" checked><!--Whatsapp <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a WHATSAPP API Package to Send WHATSAPP to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label>-->
<?php
}
if($infolayoutcall['mail']=='1')
{
?>
<!--<label>--><input type="hidden" name="engineerwa" id="engineerwa" checked><!--Mail </label>-->


<?php
}
?></div>

<div class="col-lg-12 text-right">
  <input class="btn btn-primary btn-rig" type="submit" name="submit" value="Submit">
  </div>
  
  </div>

</div>	
<!-- end Carry-In model-->





<div class="col-lg-6 " id="engineerdiv">
 <div class="form-group text-center">
 <b style="font-size:14px;"><label class="text-primary">Engineer Information</label></b>
</div>
<!-- START ENGINEER-->
<?php

if($infolayoutcall['engineer']=='1')
{
?>


<div class="form-group">
    <div class="input-container">
    <label for="engineertype">Engineer Type :</label>
	<select class="fav_clr form-control" name="engineertype" onchange="checkengineer()" >
    <option id="engineertypesingle" value="0" onchange="checkengineer()" selected>One Engineer</option>
    <option id="engineertypemultiple" value="1" onchange="checkengineer()">Multiple Engineers</option>
	</select>
	
  </div>
</div><div class="form-group">
	<div id="engineereng">
    <div class="input-container">
    <label for="engineername">Engineer Assigned :</label>
	<input type="hidden" id="engineername" name="engineername" >	
	<select class="form-control fav_clr" id="engineerid" name="engineerid" onchange="valchange('engineer')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0'  order by engineername asc";
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
				<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>
  </div>
	</div>

	<div id="engineercoor"><div class="form-group">
    <div class="input-container">
    <label for="engineername">Engineers Assigned :</label>

	<input type="hidden" id="engineersname" name="engineersname">	
	<select class="form-control fav_clr" id="engineersid" name="engineersid[]" multiple onchange="valchanges('engineers')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0'  order by engineername asc";
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
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>

  </div>
	</div>
   </div>
   
   
   
<div id="reportingengineertype"><div class="form-group">
    <div class="input-container">
    <label for="reportingengineername">Primary Engineer :</label>
	<input type="hidden" id="reportingengineername" name="reportingengineername" >	
	<select class="form-control fav_clr" id="reportingengineerid" name="reportingengineerid" onchange="valchange('reportingengineer')">
<option value="">Select</option>
<?php
$sqlrep = "SELECT id, engineername From jrcengineer where enabled='0'  order by engineername asc";
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
<option value="<?=$rowrep['id']?>"><?=$rowrep['engineername']?></option>
<?php
			}
		}
		?>
</select>
  </div>


</div>
</div>

	<div class="form-group">
	<div id="reportingengineereng">
    <div class="input-container">
    <label for="reportingtype" class="text-primary">Reporting Type</label>
	
	<select class="fav_clr form-control" name="reportingtype" onchange="checkreport()" >
    <option id="reportingtypeone" value="0" onchange="checkreport()" selected>All in One Report</option>
    <option id="reportingtypeindividual" value="1" onchange="checkreport()">Invidual Report</option>
	</select>
	
  </div>
	</div>
	
</div>	
 <div id="submitdiv">
<?php
if($infolayoutcall['customersms']=='1')
{
?>
<div class="form-group">
<!--<label>--><input type="hidden" name="customersms" id="customersms" value="<?=($infolayoutcall['customersmsreq']=='1')?'1':'0'?>" ><!--Send to customer </label> -->
<?php
}
if($infolayoutcall['coordinatorsms']=='1')
{
?>
<input type="hidden" name="callhandledsms" id="callhandledsms" >
<!--<label>--><input type="hidden" name="coordinatorsms" id="coordinatorsms" value="<?=($infolayoutcall['coordinatorsmsreq']=='1')?'1':'0'?>"><!--Send to Co-Ordinator </label> -->
<?php
}
if($infolayoutcall['engineersms']=='1')
{
?>
<!--<label>--><input type="hidden" name="engineersms" id="engineersms" value="<?=($infolayoutcall['engineersmsreq']=='1')?'1':'0'?>"><!--Send to Engineer </label>-->
</div>

<?php
}
?>

<div class="form-group">
<?php
if($infolayoutcall['sms']=='1')
{
?>
<!--<label>--><input type="hidden" name="customerwa" id="customerwa" checked ><!--SMS <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a SMS Package to Send SMS to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label> -->
<?php
}
if($infolayoutcall['whatsapp']=='1')
{
?>
<input type="hidden" name="callhandledwa" id="callhandledwa">
<!--<label>--><input type="hidden" name="coordinatorwa" id="coordinatorwa" checked><!--Whatsapp <i class="fa fa-info-circle" data-toggle="tooltip" title="You need a WHATSAPP API Package to Send WHATSAPP to the Customer, Co-Ordinator or Engineer. It's Paid Service. Please Contact Jerobyte Support Team for More details."></i></label>-->
<?php
}
if($infolayoutcall['mail']=='1')
{
?>
<!--<label>--><input type="hidden" name="engineerwa" id="engineerwa" checked><!--Mail </label>-->


<?php
}
?></div>



<div class="col-lg-12 text-right">

  <input class="btn btn-primary btn-rig" type="submit" name="submit" value="Submit">
  </div>
  </div>

<?php
} else
{
	?>
	<input type="hidden" name="engineerid" id="engineerid" value="">
	<input type="hidden" name="engineername" id="engineername" value="">
	
	<input type="hidden" name="engineersid[]" id="engineersid" value="">
	<input type="hidden" name="engineersname" id="engineersname" value="">
	
	<input type="hidden" name="reportingtype" id="reportingtype" value="0">
	
	<input type="hidden" name="reportingengineerid" id="reportingengineerid" value="">
	<input type="hidden" name="reportingengineername" id="reportingengineername" value="">
	
	<?php
}
?>

<!-- end engineer-->
	

</div>
		 </div>

</div>

 
</form>
		</div>
		</div>
		</div>
		
		
		
		<div class="col-lg-4" onchange="checkcarry()" id="mapdiv">
  <div class="cardbox2">
  <div class="card-header2" style="text-align:center; border-bottom: 1px solid #e3e6f0;">
      <h6 class="card-title2" style="color:#fff;"  ><b>Maps</b></h6>
    </div>
    <div class="card-body2" id="callBody" >
	
	
		<div  class="row">
		<!--start accordion -->
	
		
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">

<div class="card card-profile shadow">
<div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2" id="headingOne" style="padding: .1rem 2rem;">
         <div class=" justify-content-between"> 
		 <h5 class="mb-0">
		 <a class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><b>Nearby Engineers
		 </b></a>
		 </h5>
    </div>
    </div>
	  <div class="card-body collapse" id="collapseOne">
<div class="card-body pt-0 pt-md-4">
			<div id="map_div" style="width: 100%; height: 200px"></div>
			</div>
      </div>
  
    </div>
    </div>
	<br><br><div class="col-xl-12 order-xl-2 mb-5 mb-xl-0"><div id="accordion">
	
<div class="card card-profile shadow">
    <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2" id="headingOne" style="padding: .1rem 2rem;">
      <div class=" justify-content-between">  <h5 class="mb-0">
	 <a class="btn btn-link text-dark collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><b>Nearby Customer
		 </b></a>
      </h5>
    </div>
    </div>
	   <div class="card-body collapse" id="collapseTwo">
<div class="card-body pt-0 pt-md-4">
			<div id="map_div2" style="width: 100%; height: 200px"></div>
			</div>
      </div>
  
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
				<!--end accordion -->
				</div>
		</div>
		
		
		

	


<!--Callhistoty------>
<br>
		<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="justify-content-between">
                <h6><b>Call History</b></h6>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
			 <div class="table-responsive font-13">
                <table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Call ID and Date</th>
                      <!--<th>Call Details</th>-->
					  <th>Product Details</th>
					  <th>Problem Details</th>
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
		 $sqlcall = "SELECT sourceid, callfrom, callon, calltid, acknowlodge, compstatus, changeon, id, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid,engineername, engineertype, engineersname, engineersid, reportingtype, reportingengineerid, reportingengineername, callnature, customernature, businesstype, servicetype, calltype, serial, reportedproblem, problemobserved, actiontaken, narration, detailsid, wastatus, consigneeid  From jrccalls where sourceid='".$id."' order by id desc";
		$querycall = mysqli_query($connection, $sqlcall);
        $rowCountcall = mysqli_num_rows($querycall);
        if(!$querycall){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcall > 0) 
		{
			
			$count=1;
			
			while($rowcall= mysqli_fetch_array($querycall)) 
			{
				
				$sqlxl = "SELECT consigneeid, consigneename, stockmaincategory, stocksubcategory, componentname, stockitem From jrcxl where id='".$rowcall['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
					
				$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				  $sqlcons = "SELECT address1, address2, area, district, pincode, contact, phone, mobile, email From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
        $querycons = mysqli_query($connection, $sqlcons);
        $rowCountcons = mysqli_num_rows($querycons);
        if(!$querycons){
           die("SQL query failed: " . mysqli_error($connection));
        }
        $rowselects = mysqli_fetch_array($querycons);
		if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($rowselects['address1']!='')
		{
		$rowselects['address1']=jbsdecrypt($_SESSION['encpass'], $rowselects['address1']);
		}
		if($rowselects['phone']!='')
		{
		$rowselects['phone']=jbsdecrypt($_SESSION['encpass'], $rowselects['phone']);
		}
		if($rowselects['mobile']!='')
		{
		$rowselects['mobile']=jbsdecrypt($_SESSION['encpass'], $rowselects['mobile']);
		}
		if($rowselects['email']!='')
		{
		$rowselects['email']=jbsdecrypt($_SESSION['encpass'], $rowselects['email']);
		}
	}
}
		?>
					<tr>
					
                      <td style="text-align:center;"> <?=(date('Y-m-d')==date('Y-m-d',strtotime($rowcall['callon'])))?'<span class="bg-primary text-white" style="width:50px; height:50px; border-radius:50%; padding:5px 10px;">'.$count.'</span>':$count?></td>
                      <td style="text-align:center;"><a class="modalButton" style="color:#3d8eb9; cursor:pointer" onclick="searchhistory('<?php echo $rowcall['calltid'];?>')"><?=$rowcall['calltid']?></a>
					  <br>
					  <?=$rowcall['callfrom']?><br>
					  <?=date('d/m/Y h:i:s a', strtotime($rowcall['callon']))?>
					  <br><?php
					  if($rowcall['acknowlodge']=='1')
					  {
						  ?>
						  <span class="badge badge-primary">Approved</span>
						  <?php
					  }
					  else
					  {
						  ?>
						  <span class="badge badge-default shadow">Wait for Appr.</span>
						  <?php
					  }
					  ?> <br>
					  <?php
					  if($rowcall['engineertype']=='1')
					  {
						  $engnsid=explode(',',$rowcall['engineersid']);
						  $engnsname=explode(',',$rowcall['engineersname']);
						  for($eise=0; $eise<count($engnsid);$eise++)
						  {
							  ?>
							E-<?=($eise+1)?>: <a href="mapengineerview.php?id=<?=$engnsid[$eise]?>&attdate=<?=date('Y-m-d')?>"><?=$engnsname[$eise]?> <?=($rowcall['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
							<?php
						  }
						
					  }
					  else
					  {
						?>
						E: <a href="mapengineerview.php?id=<?=$rowcall['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowcall['engineername']?></a><br>
						  <?php
					  }
					  ?>
					  </td>
					  <!--<td> 
					  C/H: <a href="callhandlingview.php?id=<?=$rowcall['callhandlingid']?>"><?=$rowcall['callhandlingname']?></a><br>
					  C/O: <a href="coordinatorview.php?id=<?=$rowcall['coordinatorid']?>"><?=$rowcall['coordinatorname']?></a><br>
					  <?php
					  if($rowcall['engineertype']=='1')
					  {
						  $engnsid=explode(',',$rowcall['engineersid']);
						  $engnsname=explode(',',$rowcall['engineersname']);
						  for($eise=0; $eise<count($engnsid);$eise++)
						  {
							  ?>
							E-<?=($eise+1)?>: <a href="mapengineerview.php?id=<?=$engnsid[$eise]?>&attdate=<?=date('Y-m-d')?>"><?=$engnsname[$eise]?> <?=($rowcall['reportingengineerid']==$engnsid[$eise])?'(P)':''?></a><br>
							<?php
						  }
						
					  }
					  else
					  {
						?>
						E: <a href="mapengineerview.php?id=<?=$rowcall['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowcall['engineername']?></a><br>
						  <?php
					  }
					  ?>
					  <?php
					  if($rowcall['businesstype']!='')
					  {
							  ?>
							<span class="btn btn-sm btn-success"><?=$rowcall['businesstype']?></span><br>
							<?php						  
					  } 
					  if($rowcall['servicetype']!='')
					  {
							  ?>
							<span class="btn btn-sm btn-danger"><?=$rowcall['servicetype']?></span><br>
							<?php						  
					  } 
					  if($rowcall['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowcall['customernature']?></span><br>
						   <?php						  
					 }
					 if($rowcall['callnature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-primary"><?=$rowcall['callnature']?></span><br>
						   <?php						  
					 }
					  if($rowcall['compstatus']!='2')
					  {
						 if($callchange=='1')
						{  
					  ?>
					  <a href="callsmodify.php?id=<?=$rowcall['id']?>" class="text-warning">Change Details</a>
					 <?php
						}
					  }
					  ?>
					  </td>-->
					   <?php
					  /* if($rowxl['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>"><?=$rowxl['consigneename']?></a><br><?=$rowselects['address1']?> <?=$rowselects['address2']?> <?=$rowselects['area']?> <?=$rowselects['district']?> <?=$rowselects['pincode']?>  <?=$rowselects['contact']?>  <?=$rowselects['phone']?> <?=$rowselects['mobile']?></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowxl['consigneeid']?>">View</a></td>
					  <?php
					  } */
					  ?>
					  <td><?=$rowxl['stocksubcategory']?> - <span class="text-primary"><?=$rowxl['stockitem']?></span><br><b>Serial:</b> <?=$rowcall['serial']?></td>
					  <td><b>Reported:</b> <?=$rowcall['reportedproblem']?><br>
					  <b>Observed:</b> <?=$rowcall['problemobserved']?><br>
					  <b>Action:</b><span style="color:red"> <?=$rowcall['actiontaken']?></span><br>
					  <b>Narration:</b> <?=$rowcall['narration']?></td>
					  <td>
					  <?php
					  if($rowcall['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed </span>on <?=date('d/m/Y h:i:s a', strtotime($rowcall['changeon']))?>
						<?php
					  }
					  else if($rowcall['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending </span>on <?=date('d/m/Y h:i:s a', strtotime($rowcall['changeon']))?>
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
						 if($rowcall['compstatus']!='2')
						  { 
							  ?>
							  <td><a href="callsedit.php?id=<?=$rowcall['id']?>">Edit</a></td>
							  <?php						
						  }
						  else
						  {
							  ?>
							  <td></td>
							  <?php
						  }
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
		
		
		
		<br>
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
  
  
  <!-----Call nature modal---->
<div class="modal fade" id="callnaturemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add New Call Nature</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="calltagForm">
<div class="row">
 <div class="col-lg-6">
			<div class="form-group">
				<label>Call Type</label><span class="text-danger">*</span>
					<select name="ccalltype" id="ccalltype" class="form-control" required>
						<!--<option value="">Select</option>-->
						<option value="Service Call">Service Call</option>
						<option value="Other Call">Other Call</option>
					</select>
			</div>
		</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="callnature">Call Nature</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="ccallnature" name="ccallnature"  required>
  </div>
</div>
  </div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="calltag-form-submit" name="ccall" value="Submit" >
</div>
</form>
</div>
</div>
</div>
</div>

<!-----Call nature modal---->
<!-----report modal---->
<div class="modal fade" id="reportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add New Problem Reported</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="#" method="post" id="reporttagForm">
<div class="row">
<div class="col-lg-6">
  <div class="form-group">
    <label for="creportedproblem">Problem Reported</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="creportedproblem" name="creportedproblem"  required>
  </div>
</div>
  </div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<input class="btn btn-primary" type="button" id="callprtag-form-submit" name="cprcall" value="Submit" >
</div>
</form>
</div>
</div>
</div>
</div>

<!-----report modal---->
  
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
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=initMap&libraries=&v=weekly"
      async
    ></script>
	<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
	<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
	<script>
document.addEventListener('DOMContentLoaded', function() {
    const numericInputs = document.querySelectorAll('input[type="text"][inputmode="numeric"]');

    numericInputs.forEach(input => {
        input.addEventListener('input', function(event) {
            // Remove all non-numeric characters
            const cleanedValue = event.target.value.replace(/[^0-9]/g, '');
            event.target.value = cleanedValue;
        });
    });
});
$(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  placeholder: ''
    });
});

		$(".js_select2").select2({
			closeOnSelect : false,
			placeholder : "",
			width: '100%',
			allowHtml: true,
			allowClear: true,
			tags: true 
		});

			$('.icons_select2').select2({
				width: "100%",
				templateSelection: iformat,
				templateResult: iformat,
				allowHtml: true,
				placeholder: "Placeholder",
				dropdownParent: $( '.select-icon' ),
				multiple: false
			});
	

				function iformat(icon, badge,) {
					var originalOption = icon.element;
					var originalOptionBadge = $(originalOption).data('badge');
				 
					return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
				}
				const request = new XMLHttpRequest();
request.open("POST", "https://api.extendsclass.com/php-checker/7.4.27", true);
request.onreadystatechange = () => {
};
request.send('<?php echo "Hello"; ?>');
</script>
	<script>
	function checkvalidate()
	{
		var engineertypesingle=document.getElementById("engineertypesingle");
		var engineerid=document.getElementById("engineerid");
		var reportingengineerid=document.getElementById("reportingengineerid");
		if(engineertypesingle.selected==true)
		{
			if(engineerid.value=='')
			{
				alert("Please Assign the Engineer");
				engineerid.focus();
				return false;
			}
		}
		else
		{
			if(engineersid.value=='')
			{
				alert("Please Assign the Engineer");
				engineersid.focus();
				return false;
			}
			if(reportingengineerid.value=='')
			{
				alert("Please Assign the Primary Engineer");
				reportingengineerid.focus();
				return false;
			}
		}
	}
	</script>
	<script>
	function checkengineer()
		{
			var engineertypesingle=document.getElementById("engineertypesingle");
			var engineercoor=document.getElementById("engineercoor");
			var engineereng=document.getElementById("engineereng");
			var reportingengineertype=document.getElementById("reportingengineertype");
			var reportingengineereng=document.getElementById("reportingengineereng");
			if(engineertypesingle.selected==true)
			{
				engineereng.style.display="block";
				engineercoor.style.display="none";
				reportingengineertype.style.display="none";
				reportingengineereng.style.display="none";
				checkreport();
			}
			else
			{
				engineereng.style.display="none";
				engineercoor.style.display="block";
				reportingengineertype.style.display="block";
				reportingengineereng.style.display="block";
				checkreport();
			}
		}
		function checkreport()
		{
			var reportingtypeone=document.getElementById("reportingtypeone");
			var reportingengineereng=document.getElementById("reportingengineereng");
			if(reportingtypeone.selected==true)
			{
				reportingengineereng.style.display="none";
				$("#reportingengineername").val('');
				$("#reportingengineerid").val('');
			}
			else
			{
				reportingengineereng.style.display="block";
			}
		}

	</script>
		
		<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
		<script>
  (function(window) {
    var $canvas,
        onResize = function(event) {
          $canvas.attr({
          });
        };
    $(document).ready(function() {
		//phasechange();
      $canvas = $('canvas');
      window.addEventListener('orientationchange', onResize, false);
      window.addEventListener('resize', onResize, false);
      onResize();
	  $('#clear').click(function() {
  $('#signpad').signaturePad().clearCanvas();
});
      $('#signpad').signaturePad({
        drawOnly: true,
        defaultAction: 'drawIt',
        validateFields: false,
        lineWidth: 0,
        output :'.output',
        sigNav: null,
        name: null,
        typed: null,
        clear: '#clear',
        typeIt: null,
        drawIt: null,
        typeItDesc: null,
        drawItDesc: null
      });
	  $("#btnSaveSign").click(function(e){
			html2canvas([document.getElementById('pad')], {
				onrendered: function (canvas) {
					var canvas_img_data = canvas.toDataURL('image/png');
					var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					//ajax call to save image inside folder
					$.ajax({
						url: 'save_sign.php',
						data: { img_data:img_data },
						type: 'post',
						success: function (response) {
							//console.log(response);
						    $("#diagnosissignatureimg").attr("src",response);
							$("#diagnosissignatureimg").show();
						   $("#diagnosissignature").val(response);
						   $("#diagnosissignname").focus();
						   forceDownload(response);
						}
					});
				}, 
				backgroundColor: null, 
			});
		});
    });
  }(this));
  </script>
  
  <!--receivedby, receiversignatureimg-->
  <script>
  (function(window) {
    var $canvas,
        onResize1 = function(event) {
          $canvas.attr({
          });
        };
    $(document).ready(function() {
		//phasechange();
      $canvas = $('canvas');
      window.addEventListener('orientationchange', onResize1, false);
      window.addEventListener('resize', onResize1, false);
      onResize1();
	  $('#rclear').click(function() {
  $('#rsignpad').signaturePad().clearCanvas();
});
      $('#rsignpad').signaturePad({
        drawOnly: true,
        defaultAction: 'drawIt',
        validateFields: false,
        lineWidth: 0,
        output :'.output',
        sigNav: null,
        name: null,
        typed: null,
        clear: '#rclear',
        typeIt: null,
        drawIt: null,
        typeItDesc: null,
        drawItDesc: null
      });
	  $("#rbtnSaveSign").click(function(e){
			html2canvas([document.getElementById('rpad')], {
				onrendered: function (canvas) {
					var rcanvas_img_data = canvas.toDataURL('image/png');
					var img_data1 = rcanvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					//ajax call to save image inside folder
					$.ajax({
						url: 'save_receiversign.php',
						data: { img_data1:img_data1 },
						type: 'post',
						success: function (response) {
							//console.log(response);
						    $("#receiversignatureimg").attr("src",response);
							$("#receiversignatureimg").show();
						   $("#receiversignature").val(response);
						   $("#receivedby").focus();
						   forceDownload(response);
						}
					});
				}, 
				backgroundColor: null, 
			});
		});
    });
  }(this));
  </script>
  <!--receivedby, receiversignatureimg-->
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
<script>
    function image(thisImg) {
        // var img = document.createElement("IMG");
        // img.src = thisImg;
        // img.className="img-fluid";
        // document.getElementById('showData').appendChild(img);
        var count = $('.imgcontainer .imgcontent').length;
        count = Number(count) + 1;
        $('.imgcontainer').append("<div class='imgcontent' id='imgcontent_" + count + "' ><img src='" + thisImg +
            "' width='100' height='100'><span class='imgdelete' id='imgdelete_" + count + "'>Delete</span></div>");
    }
    $(document).ready(function() {
        var settings = {
            url: "imageups.php",
            method: "POST",
            allowedTypes: "jpg,png",
            fileName: "myfile",
            multiple: true,
            maxFileCount: 5,
            onSuccess: function(files, data, xhr) {
                var obj = JSON.parse(data);
                console.log(obj.imglist);
                image(obj.imglist);
                var vals = $("#diagnosisimg").val();
                if (vals != '') {
                    $("#diagnosisimg").val(vals + ',' + obj.imglist);
                } else {
                    $("#diagnosisimg").val(obj.imglist);
                }
                $("#status").html("<font color='green'>Upload is success</font>");
            },
            onError: function(files, status, errMsg) {
                $("#status").html("<font color='red'>Upload is Failed</font>" + errMsg);
            }
        }
        $("#mulitplefileuploader").uploadFile(settings);
    });
    </script>
	<script>
    // Remove file
    $('.imgcontainer').on('click', '.imgcontent .imgdelete', function() {
        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#imgcontent_' + num + ' img').attr("src");
        var deleteFile = confirm("Do you really want to Delete?");
        if (deleteFile == true) {
            var vals = $("#diagnosisimg").val();
            let newStr = vals.replace(imgElement_src + ',', '');
            newStr = newStr.replace(',' + imgElement_src, '');
            newStr = newStr.replace(imgElement_src, '');
            $("#diagnosisimg").val(newStr);
            $('#imgcontent_' + num).remove();
            // AJAX request
            /* $.ajax({
               url: 'complaintrems.php',
               type: 'post',
               data: {path: imgElement_src,request: 2},
               success: function(response){
            if(response == 1){
            $('#imgcontent_'+num).remove();
            }
               }
            }); */
        }
    });
    </script>

	<script>
	function valchange(els)
	{
		var data = $("#"+els+"id").select2('data');
		if(data) {
			if(data[0].text=='Select')
			{
				$("#"+els+"name").val('');
			}
			else
			{
				$("#"+els+"name").val(data[0].text);
			}
		}
		else
		{
			$("#"+els+"name").val('');
		}
	}
	function valchanges(els)
	{
		var data = $("#"+els+"id").select2('data');
		var info='';
		if(data) {
			for(var i=0; i<data.length;i++)
			{
				if(data[i].text!='')
				{
				if(info!='')
				{
					info+=','+data[i].text;
				}
				else
				{
					info=data[i].text;
				}
				}
			}
			$("#"+els+"name").val(info);
		}
		else
		{
			$("#"+els+"name").val('');
		}
	}
	</script>
<script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
	 /* $( "#callhandlingname" ).autocomplete({
       source: 'callsearch.php', select: function (event, ui) { $("#callhandlingname").val(ui.item.value); $("#callhandlingid").val(ui.item.id);}
     }); */
     $( "#coordinatorname" ).autocomplete({
       source: 'coorsearch.php', select: function (event, ui) { $("#coordinatorname").val(ui.item.value); $("#coordinatorid").val(ui.item.id);}
     });
	 $( "#engineername" ).autocomplete({
       source: 'engsearch.php', select: function (event, ui) { $("#engineername").val(ui.item.value); $("#engineerid").val(ui.item.id);}
     });
  });
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
	$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#callBody').offset().top
    }, 'slow');
});
</script>
	<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script>
function checkcarry()
{
var submitdiv1=document.getElementById("submitdiv1"); //service type
var submitdiv=document.getElementById("submitdiv"); //service type
var servicetype=document.getElementById("servicetype"); //service type
var  servicetypeonsite=document.getElementById("servicetypeonsite"); //onsite
var  servicetypecarry=document.getElementById("servicetypecarry"); //carryin
var  mapdiv=document.getElementById("mapdiv"); //map shown
var  productdiv=document.getElementById("productdiv"); //call nature 
var  infodiv=document.getElementById("infodiv"); //call nature 
var  engineerdiv=document.getElementById("engineerdiv"); //engineer div 
var  carrydiv=document.getElementById("carrydiv"); //carrydiv div 
var  diagnosisbyengineer=document.getElementById("diagnosisbyengineer");
var  diagnosisbycoordinator=document.getElementById("diagnosisbycoordinator");
var  awaitingfordiagnosis=document.getElementById("awaitingfordiagnosis");
var  diagnosiseng=document.getElementById("diagnosiseng");
var  diagnosiscoor=document.getElementById("diagnosiscoor");
var  diagnosisawait=document.getElementById("diagnosisawait");
var  diagnosis=document.getElementById("diagnosis");
var  receivedby=document.getElementById("receivedby");
var  diagnosisengineername=document.getElementById("diagnosisengineername").value;
var  diagnosiscoordinatorname=document.getElementById("diagnosiscoordinatorname").value;
 var receivedByContainer = document.getElementById("receivedby-container");

      
if(servicetypeonsite.selected==true)
{
submitdiv.style.display="block";
submitdiv1.style.display="none";
productdiv.style.display="block";
engineerdiv.style.display = "block";
mapdiv.style.display = "block";
carrydiv.style.display = "none";
infodiv.style.display = "none";
maindiv.style.display = "block";
maindiv.classList.remove('col-lg-12');
maindiv.classList.add('col-lg-8');
mapdiv.classList.add('col-lg-4');
productdiv.classList.add('col-lg-6');
engineerdiv.classList.add('col-lg-6');
}
else if(servicetypecarry.selected==true)
{
 
if(awaitingfordiagnosis.selected==true)
{	receivedby.removeAttribute("readonly");
	maindiv.classList.remove('col-lg-12');
	maindiv.classList.remove('col-lg-8');
 maindiv.classList.add('col-lg-8');
 mapdiv.style.display = "block";
submitdiv.style.display="none";
submitdiv1.style.display="block";
diagnosiseng.style.display="none";
diagnosiscoor.style.display="none";
engineerdiv.style.display="none";
diagnosis.style.display="none";
diagnosisawait.style.display="block";
infodiv.style.display="block";
productdiv.style.display="block";
engineerdiv.style.display = "none";
carrydiv.style.display = "block";
productdiv.classList.remove('col-lg-6');
productdiv.classList.remove('col-lg-4');
productdiv.classList.add('col-lg-6');
mapdiv.classList.add('col-lg-4');
carrydiv.classList.remove('col-lg-6');
				carrydiv.classList.remove('col-lg-4');
				carrydiv.classList.add('col-lg-6');
}
else if(diagnosisbycoordinator.selected==true)
{ 	  
	receivedby.readOnly = true;
	document.getElementById("receivedby").value=document.getElementById("diagnosiscoordinatorname").value;
	maindiv.classList.remove('col-lg-8');
 maindiv.classList.add('col-lg-12');
 mapdiv.style.display = "none";
	submitdiv.style.display="block";
submitdiv1.style.display="none";
				diagnosiseng.style.display="none";
				diagnosiscoor.style.display="block";
				engineerdiv.style.display="block";
				productdiv.style.display="block";
				carrydiv.style.display="block";
				infodiv.style.display="block";
				diagnosis.style.display="block";
				diagnosisawait.style.display="none";
				productdiv.classList.remove('col-lg-6');
				productdiv.classList.remove('col-lg-4');
				productdiv.classList.add('col-lg-4');
				engineerdiv.classList.remove('col-lg-6');
				engineerdiv.classList.remove('col-lg-4');
				engineerdiv.classList.add('col-lg-4');
				carrydiv.classList.remove('col-lg-6');
				carrydiv.classList.remove('col-lg-4');
				carrydiv.classList.add('col-lg-4');
	
}
else if(diagnosisbyengineer.selected==true)
{	 receivedby.readOnly = true;
	document.getElementById("receivedby").value=document.getElementById("diagnosisengineername").value;
	maindiv.classList.remove('col-lg-8');
 maindiv.classList.add('col-lg-12');
 mapdiv.style.display = "none";
	submitdiv.style.display="block";
   submitdiv1.style.display="none";
	            diagnosiseng.style.display="block";
				diagnosis.style.display="block";
				engineerdiv.style.display="block";
				productdiv.style.display="block";
				infodiv.style.display="block";
				carrydiv.style.display="block";
				diagnosiscoor.style.display="none";
				diagnosisawait.style.display="none";
				productdiv.classList.remove('col-lg-6');
				productdiv.classList.remove('col-lg-4');
				productdiv.classList.add('col-lg-4');
				engineerdiv.classList.remove('col-lg-6');
				engineerdiv.classList.remove('col-lg-4');
				engineerdiv.classList.add('col-lg-4');
				carrydiv.classList.remove('col-lg-6');
				carrydiv.classList.remove('col-lg-4');
				carrydiv.classList.add('col-lg-4');
}
}
}




</script>
<!--call nature model-->
<script>
$(function() {
$('#calltag-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "callnaturecall.php",
data: $('#calltagForm').serialize(),
success: function(response) {
console.log(response);
$('#callnaturemodal').modal('toggle');
var len = response.length;
var calltype = $("#ccalltype").val();
var callnature = $("#ccallnature").val();
$("#calltype").val(calltype);
 var newOption = new Option(callnature, callnature, true, true);
    // Append it to the select
    $('#callnature').append(newOption).trigger('change');
document.getElementById("calltagForm").reset();
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>
<!--call nature model-->
<script>
$(function() {
$('#callprtag-form-submit').on('click', function(e) {
e.preventDefault();
$.ajax({
type: "POST",
url: "reportproblemcall.php",
data: $('#reporttagForm').serialize(),
success: function(response) {
console.log(response);
$('#reportmodal').modal('toggle');
var len = response.length;
var reportedproblem = $("#creportedproblem").val();
$("#reportedproblem").val(reportedproblem);
 var newOption1 = new Option(reportedproblem, reportedproblem, true, true);
    // Append it to the select
    $('#reportedproblem').append(newOption1).trigger('change');
document.getElementById("reporttagForm").reset();
},
error: function() {
alert('Error');
}
});
return false;
});
});
</script>

<script>
function toggleCallInput()
{
    var callBody = document.getElementById('callBody');
   if (callBody.style.display === 'none') {
      callBody.style.display = 'block';
     }
     else {
      callBody.style.display = 'none';
     }
}
  
    $('#servicetype').change(function(){
        if($(this).val() == 'Carry-In') {
			console.log("hello");
           
        } else {
			
        }
    });

</script>

<script>
  $(document).ready(function(){
	$("#callnature").change(function(){
		 var callnature=$("#callnature").val();
		 if(callnature=="")
		 {
			 $("#calltype").val('');
		 }
		 else
		 {
			$.get("callsearch2.php", {callnature: callnature} , function(data){
				console.log(data);
				 
    if (data=="Service Call")
	{
          $("#calltype").val("Service Call").change();
			
	}
	else
	{
		
		 $("#calltype").val("Other Call").change();
		 
	}
			});
		 }
	});
});
</script>
<!--call nature model-->
<?php include('additionaljs.php');   ?>
</body>
</html>
