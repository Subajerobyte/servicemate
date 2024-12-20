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
if(isset($_POST['submit']))
{
	$id=mysqli_real_escape_string($connection,$_POST['id']); 
	$invoiceno=mysqli_real_escape_string($connection,$_POST['invoiceno']);
	$consigneeid=mysqli_real_escape_string($connection,$_POST['consigneeid']);
	$olddocdc=mysqli_real_escape_string($connection,$_POST['olddocdc']);
	$olddocic=mysqli_real_escape_string($connection,$_POST['olddocic']);
	$olddocinvoice=mysqli_real_escape_string($connection,$_POST['olddocinvoice']);
	if(isset($_POST['submit']))
	{
			if (!file_exists('../padhivetram/doc/dc'))
			{
			mkdir('../padhivetram/doc/dc', 0777, true);
			}
         $target_dir = "../padhivetram/doc/dc/";
		 $target_file = $target_dir .time(). basename($_FILES["docdc"]["name"]);
		 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		 if (move_uploaded_file($_FILES["docdc"]["tmp_name"], $target_file)) 
	     {
		 $docdc=$target_file;
		 } else 
		 {
		 $docdc=$olddocdc;
		 }
	}
	if(isset($_POST['submit']))
	{
	if (!file_exists('../padhivetram/doc/ic'))
			{
			mkdir('../padhivetram/doc/ic', 0777, true);
			}
         $target_dir = "../padhivetram/doc/ic/";
		 $target_file = $target_dir .time(). basename($_FILES["docic"]["name"]);
		 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		 if (move_uploaded_file($_FILES["docic"]["tmp_name"], $target_file)) 
	     {
		 $docic=$target_file;
		 } else 
		 {
		 $docic=$olddocic;
		 }
	}
	if(isset($_POST['submit']))
	{
		 if (!file_exists('../padhivetram/doc/invoice'))
			{
			mkdir('../padhivetram/doc/invoice', 0777, true);
			}
         $target_dir = "../padhivetram/doc/invoice/";
		 $target_file = $target_dir .time(). basename($_FILES["docinvoice"]["name"]);
		 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		 if (move_uploaded_file($_FILES["docinvoice"]["tmp_name"], $target_file)) 
	     {
		 $docinvoice=$target_file;
		 } else 
		 {
		 $docinvoice=$olddocinvoice;
		 }
	}
	
	
	
	
	
    if(($invoiceno!="")&&($consigneeid!=""))
	{		
		 
     $sqlcon = "SELECT id From jrcxl WHERE invoiceno = '{$invoiceno}' and consigneeid = '{$consigneeid}'  ";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			 $sqlup = "update jrcxl set docdc='".$docdc."',docic='".$docic."',docinvoice='".$docinvoice."' where consigneeid='".$consigneeid."' and invoiceno='".$invoiceno."'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Action Taken Information', '{$id}', 'jrcactiontaken')");
				header("Location: documentupload.php?id='".$id."'&remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: documentupload.php?error=This record is Not Found! Kindly check in All Action Taken List");
			}
	}
}
$latlong="";
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$sqlselect = "SELECT consigneeid From jrcxl where tdelete='0' and  id='".$id."' order by consigneename asc";
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
  <title><?=$_SESSION['companyname']?> - Jerobyte - Upload a Document</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
   <style>
   .custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
   </style>
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
	<style>
		.ajax-upload-dragdrop, .ajax-file-upload-statusbar
		{
			width: 100% !important;
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
</head>
<body id="page-top" >
  <div id="wrapper">
    <?php include('sidebar.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
          <?php include('navbar.php');?>
          <?php // include('consigneenavbar.php');?>
        <div class="container-fluid">
          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Upload a Document</h1>
            <a href="calls.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Complaint Call</a>
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
$sqlselect = "SELECT consigneename, address1, address2, area, district, pincode, mobile, contact, phone, email, maincategory, subcategory, department, consigneeid,id,invoiceno From jrcxl where tdelete='0' and  id='".$id."' order by consigneename asc";
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
		

		<br>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<!--invoice information-->
<div class="main-body">
	<div class="card">
                <div class="card-body" style="padding:0.5rem">
	 <div class="row gutters-sm">
		<div class="col-md-2">
		<img src="../img/avatar.png" alt="Admin" class="rounded-circle" width="108">
		</div>	 
		<div class="<?=($rowselect1['latlong']!='')?"col-md-6":"col-md-10"?>" >
		<h4 class="text-center text-primary mb-1"><?=$conname=$rowselect1['consigneename']?> <a href="consigneeedit.php?id=<?=$rowselect1['id']?>" ><i class="fa fa-edit"></i></a></h4>
		<p class="text-secondary text-center mb-1"><?php
						if($rowselect1['ctype']!='')
			{
				if($rowselect1['ctype']=='BLOCK')
				{
				?>
				<span class="badge badge-danger font-13"><?=$rowselect1['ctype']?></span>
				<?php
				}
				else
				{
				?>
				<span class="badge badge-success font-13"><?=$rowselect1['ctype']?></span>
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
					  <span><i class="fa fa-address-book text-primary"></i> <?=$rowselect1['address1']?> <?=$rowselect1['address2']?> <?=$rowselect1['area']?> <?=$rowselect1['district']?> <?=$rowselect1['pincode']?></span><br>
					  <?php
}
if(($infolayoutcustomers['contact']=='1')||($infolayoutcustomers['phone']=='1')||($infolayoutcustomers['mobile']=='1')||($infolayoutcustomers['email']=='1'))
{
?>
					  <span><?=$rowselect1['contact']?> <i class="fa fa-phone-alt text-primary"></i>  <?=$rowselect1['phone']?> <?=$rowselect1['mobile']?> <i class="fa fa-envelope text-primary"></i> <?=$rowselect1['email']?></span> <!-- Button trigger modal -->

<br>
					  <?php

?>
<?php
if((($infolayoutcustomers['contact']=='1')&&($rowselect1['contact']=='')) || (($infolayoutcustomers['phone']=='1')&&($rowselect1['phone']=='')) || (($infolayoutcustomers['mobile']=='1')&&($rowselect1['phone']=='')) || (($infolayoutcustomers['email']=='1')&&($rowselect1['email']=='')))
{
	?>
<?php
}
}
?>
<span>
				<?php
if($infolayoutcustomers['maincategory']=='1')
{
?>
                      <?=$rowselect1['maincategory']?> -
					  <?php
}
if($infolayoutcustomers['subcategory']=='1')
{
?>
					  <?=$rowselect1['subcategory']?> - 
					  <?php
}
if($infolayoutcustomers['department']=='1')
{
?>
					  <?=$rowselect1['department']?>
					  <?php
}

?>
</span>
			</p>
			
		</div>
		<?php 
												  if($rowselect1['latlong']!='')
												  {
													  $ll=explode(',',$rowselect1['latlong']);
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

	 <br>
		
		
		
		
		<?php
		$consigneeid=$rowselect['consigneeid'];
			$sqlselect1 = "SELECT id,ctype,latlong, consigneename From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
			$queryselect1 = mysqli_query($connection, $sqlselect1);
			$rowCountselect1 = mysqli_num_rows($queryselect1);
			if(!$queryselect1){
			   die("SQL query failed: " . mysqli_error($connection));
			}
		while($rowselect1 = mysqli_fetch_array($queryselect1))
		{
		?>
          <div class="row gutters-sm">
            <div class="col-md-12">
              <div class="card mb-3" style="border:none">
                <div class="card-body" style="padding:0">
				
				


      <!-- List group-->
      <ul class="list-group">


 <?php
 if(isset($_GET['type']))
 {
	
	  $sqlselect = "SELECT rono, rentaldate, consigneeid, id  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and  id='".$rowselect['id']."' group by rono, rentaldate order by rentaldate desc";
   $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			$stockitem="";
			$rono="";
			$rentaldate="";
			
			while($rowselect2 = mysqli_fetch_array($queryselect)) 
			{
			?>
			
        <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-1">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold" style="font-size:1.1rem"><?=$rowselect2['rono']?> - <?=($rowselect2['rentaldate']!='')?(date('d/m/Y',strtotime($rowselect2['rentaldate']))):''?> <a href="rentaledit.php?id=<?=$rowselect2['rono']?>"><i class="fa fa-edit"></i></a> </h5>
               <?php
			   
			   $stockitem="";
			$rono="";
			$rentaldate="";
			   $coset=1;
			   $sqlselect2 = mysqli_query($connection, "SELECT stockmaincategory, stocksubcategory, overallwarranty, tdelete, typeofproduct, componenttype, componentname, make, capacity, qty, serialnumber, departments, installedon, warranty, id, stockitem, rono, rentaldate,datefrom,dateto  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and id='".$rowselect2['id']."' order by rono desc");
			   while($infoselect2=mysqli_fetch_array($sqlselect2))
			   {
				    $sqlrent=mysqli_query($connection,"SELECT id,datefrom,dateto from jrcrental where id='".$_GET['type']."'");
			   $rent=mysqli_fetch_array($sqlrent);
				   ?>
				   <?php
			if(($rono!=$infoselect2['rono'])||($rentaldate!=$infoselect2['rentaldate'])||($stockitem!=$infoselect2['stockitem']))
			{
				?>
				   <h6 class="text-primary font-weight-bold pt-2" style="border-bottom: 1px solid #cccccc"><?=$infoselect2['stockitem']?> </h6>
			<?php
			if(($infolayoutproducts['stockmaincategory']=='1')||($infolayoutproducts['stockmaincategory']=='1'))
{
if($infoselect2['stockmaincategory']!="")
{	
?>	
<b>Main Category: </b><?=$infoselect2['stockmaincategory']?> &nbsp; &nbsp;
<?php
}
if($infoselect2['stocksubcategory']!="")
{	
?>	
<b>Sub Category: </b> <?=$infoselect2['stocksubcategory']?> &nbsp; &nbsp;
<?php
}
?>

<?php
}

?>
<b>From Date: </b><?=date('d/m/Y h:i a',strtotime($rent['datefrom']))?> &nbsp; &nbsp;	<b>To Date: </b><?=date('d/m/Y h:i a',strtotime($rent['dateto']))?> 
<?php
			if($infoselect2['overallwarranty']!='')
			{
				
				
				$overdate=$rent['datefrom'];
				$off=(float)$infoselect2['overallwarranty'];
				$overdate = str_ireplace('/', '-', $overdate);
				$overdate=date('Y-m-d', strtotime($overdate));
				$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
				$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
				$date = new DateTime($effectiveDate);
				$now = new DateTime();
				if($date < $now) 
				{
					echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
				else
				{
					echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
			}
	

}
?>

			
			<div class="row" style="background-color:#f1f1f1">
			<div class="col-lg-10 p-2">
			<table width="100%" class="mytabl">
			<tr>
			<th rowspan="4" style="width:40px; background-color:#8d8d8d!important; color:#ffffff; text-align:center"><?=$coset?>
			<?php
					  if($deleteproduct=='1')
					  {
						  ?>
					  <a href="invoicedelete.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>&tdelete=<?=$infoselect2['tdelete']?>" onclick="return confirm('Are you sure want to Delete this Product')" class="button8"><i class="fa fa-trash"></i></a>
					  <?php
					  }
					  ?>
			
			</th>
			<?php 
			  
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{	
?>
<th>Type of Product</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{		
?>
<th>Component Type</th>
<?php
}
}
?>	
<?php 
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{	
?>
<th>Component Name</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{	
?>
<th>Make</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{	
?>
<th>Capacity</th>
<?php
}
}
if($infolayoutinvoice['qty']=='1')
{
		?>
<th>Qty</th>
		<?php
}
if($infolayoutinvoice['warranty']=='1')
{
		?>
<th>Warranty</th>
		<?php
}
?>
			</tr>
			<tr>
			
			<?php 
			$colsp=0;  
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{	
?>
<td><?=$infoselect2['typeofproduct']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{		
?>
<td><?=$infoselect2['componenttype']?></td>
<?php
$colsp++;
}
}
?>	
<?php 
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{	
?>
<td><?=$infoselect2['componentname']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{	
?>
<td><?=$infoselect2['make']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{	
?>
<td><?=$infoselect2['capacity']?></td>
<?php
$colsp++;
}
}
if($infolayoutinvoice['qty']=='1')
{
		?>
<td><?=$infoselect2['qty']?></td>
		<?php
		$colsp++;
}
if($infolayoutinvoice['warranty']=='1')
{
		?>
<td><?=$infoselect2['warranty']?> Months</td>
		<?php
		$colsp++;
}
?>
			</tr>
		
<?php
if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
	?>
	<tr>
	<th colspan="<?=$colsp?>">Serial Number</th>
	</tr>
	<tr>
	<td colspan="<?=$colsp?>">
	<?php
					  $srls=explode("| ",$infoselect2['serialnumber']);
					  $dpts=explode("| ",$infoselect2['departments']);
					  for($sr=0;$sr<count($srls);$sr++)
					  {
						  if(isset($srls[$sr]))
						  {
							  echo ' '.$srls[$sr];
						  }
						  if(isset($dpts[$sr]))
						  {
							  echo '-'.$dpts[$sr].', &nbsp; ';
						  }
						  
					  }
					  ?>
					  </td>
					  </tr>
					  <?php
}
?>		
	
			</table>
	
	</div>
	<div class="col-lg-2 p-2" style="line-height:1.6">
	
	
<?php
$sqlamc = "SELECT dateto From jrcrental where rono='".$infoselect2['rono']."' and id='".$_GET['type']."'";
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
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
	
	echo '<span class="bg-danger text-white">Lasped Rental <strong>('.date('d/m/Y h:i a',strtotime($rowamc['dateto'])).')</strong></span><br>';
    /* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
    $t=3;
	echo '<span class="bg-success text-white">Rental Active <strong>('.date('d/m/Y h:i a',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		?>
	
	
	<?php


			if($infoselect2['overallwarranty']!='')
			{
				
				
				$overdate=$infoselect2['datefrom'];
				$off=(float)$infoselect2['overallwarranty'];
				$overdate = str_ireplace('/', '-', $overdate);
				$overdate=date('Y-m-d', strtotime($overdate));
				$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
				$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
				$date = new DateTime($effectiveDate);
				$now = new DateTime();
				if($date < $now) 
				{
					$t=4;
					echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
				else
				{ $t=4;
					echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
			}
?>		  
	
	</div>
	
	
	</div>
				   <?php
				   
				   $stockitem=$infoselect2['stockitem'];
				$rono=$infoselect2['rono'];
				$rentaldate=$infoselect2['rentaldate'];
				   $coset++;
			   }
			   
				  
				  ?>
					
			</div>
          </div>
          <!-- End -->
        </li>
        <!-- End -->
					<?php
				
				$count++;
					
			}
			
		}
	


 }
 else
 {
				 $sqlselect = "SELECT invoiceno, invoicedate, consigneeid, id  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and  invoiceno='".$rowselect['invoiceno']."' ";
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
			
			while($rowselect2 = mysqli_fetch_array($queryselect)) 
			{
			?>
			
        <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-1">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold" style="font-size:1.1rem"><?=$rowselect2['invoiceno']?> - <?=($rowselect2['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect2['invoicedate']))):''?></h5>
               <?php
			   
			   $stockitem="";
			$invoiceno="";
			$invoicedate="";
			   $coset=1;
			   $sqlselect2 = mysqli_query($connection, "SELECT stockmaincategory, stocksubcategory, overallwarranty, tdelete, typeofproduct, componenttype, componentname, make, capacity, qty, serialnumber, departments, installedon, warranty, id, stockitem, invoiceno, invoicedate  From jrcxl where tdelete='0' and  consigneeid='".$rowselect1['id']."' and id='".$rowselect2['id']."' order by invoicedate desc");
			   while($infoselect2=mysqli_fetch_array($sqlselect2))
			   {
				   ?>
				   <?php
			if(($invoiceno!=$infoselect2['invoiceno'])||($invoicedate!=$infoselect2['invoicedate'])||($stockitem!=$infoselect2['stockitem']))
			{
				?>
				   <h6 class="text-primary font-weight-bold pt-2" style="border-bottom: 1px solid #cccccc"><?=$infoselect2['stockitem']?> </h6>
			<?php
			if(($infolayoutproducts['stockmaincategory']=='1')||($infolayoutproducts['stockmaincategory']=='1'))
{
if($infoselect2['stockmaincategory']!="")
{	
?>	
<b>Main Category: </b><?=$infoselect2['stockmaincategory']?> &nbsp; &nbsp;
<?php
}
if($infoselect2['stocksubcategory']!="")
{	
?>	
<b>Sub Category: </b> <?=$infoselect2['stocksubcategory']?> &nbsp; &nbsp;
<?php
}
?>

<?php
}
if($infolayoutinvoice['overallwarranty']=='1')
{
?>
			<b>Overall Warranty: </b><?=$infoselect2['overallwarranty']?>
			<?php
			if($infoselect2['overallwarranty']!='')
			{
				if($infoselect2['installedon']!='')
				{
				$overdate=$infoselect2['installedon'];
				}
				else
				{
				$overdate=$infoselect2['invoicedate'];
				}
				$off=(float)$infoselect2['overallwarranty'];
				$overdate = str_ireplace('/', '-', $overdate);
				$overdate=date('Y-m-d', strtotime($overdate));
				$effectiveDate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
				$effectiveDate1=date('d/m/Y', strtotime($effectiveDate));
				$date = new DateTime($effectiveDate);
				$now = new DateTime();
				if($date < $now) 
				{
					echo '<span class="text-danger"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
				else
				{
					echo '<span class="text-success"><strong>('.$effectiveDate1.')</strong></span><br>';
					?>
					<?php
				}
			}
}
?>
<?php	
			}
			?>
			
			<div class="row" style="background-color:#f1f1f1">
			<div class="col-lg-10 p-2">
			<table width="100%" class="mytabl">
			<tr>
			<th rowspan="4" style="width:40px; background-color:#8d8d8d!important; color:#ffffff; text-align:center"><?=$coset?>
			<?php
					  if($deleteproduct=='1')
					  {
						  ?>
					  <a href="invoicedelete.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>&tdelete=<?=$infoselect2['tdelete']?>" onclick="return confirm('Are you sure want to Delete this Product')" class="button8"><i class="fa fa-trash"></i></a>
					  <?php
					  }
					  ?>
			
			</th>
			<?php 
			  
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{	
?>
<th>Type of Product</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{		
?>
<th>Component Type</th>
<?php
}
}
?>	
<?php 
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{	
?>
<th>Component Name</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{	
?>
<th>Make</th>
<?php
}
}
?>
<?php 
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{	
?>
<th>Capacity</th>
<?php
}
}
if($infolayoutinvoice['qty']=='1')
{
		?>
<th>Qty</th>
		<?php
}
if($infolayoutinvoice['warranty']=='1')
{
		?>
<th>Warranty</th>
		<?php
}
?>
			</tr>
			<tr>
			
			<?php 
			$colsp=0;  
if($infolayoutproducts['typeofproduct']=='1')
{
if($infoselect2['typeofproduct']!="")
{	
?>
<td><?=$infoselect2['typeofproduct']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['componenttype']=='1')
{
if($infoselect2['componenttype']!="")
{		
?>
<td><?=$infoselect2['componenttype']?></td>
<?php
$colsp++;
}
}
?>	
<?php 
if($infolayoutproducts['componentname']=='1')
{
if($infoselect2['componentname']!="")
{	
?>
<td><?=$infoselect2['componentname']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['make']=='1')
{
if($infoselect2['make']!="")
{	
?>
<td><?=$infoselect2['make']?></td>
<?php
$colsp++;
}
}
?>
<?php 
if($infolayoutproducts['capacity']=='1')
{
if($infoselect2['capacity']!="")
{	
?>
<td><?=$infoselect2['capacity']?></td>
<?php
$colsp++;
}
}
if($infolayoutinvoice['qty']=='1')
{
		?>
<td><?=$infoselect2['qty']?></td>
		<?php
		$colsp++;
}
if($infolayoutinvoice['warranty']=='1')
{
		?>
<td><?=$infoselect2['warranty']?> Months</td>
		<?php
		$colsp++;
}
?>
			</tr>
		
<?php
if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
	?>
	<tr>
	<th colspan="<?=$colsp?>">Serial Number</th>
	</tr>
	<tr>
	<td colspan="<?=$colsp?>">
	<?php
					  $srls=explode("| ",$infoselect2['serialnumber']);
					  $dpts=explode("| ",$infoselect2['departments']);
					  for($sr=0;$sr<count($srls);$sr++)
					  {
						  if(isset($srls[$sr]))
						  {
							  echo ' '.$srls[$sr];
						  }
						  if(isset($dpts[$sr]))
						  {
							  echo '-'.$dpts[$sr].', &nbsp; ';
						  }
						  
					  }
					  ?>
					  </td>
					  </tr>
					  <?php
}
?>		
	
			</table>
	
	</div>
	<div class="col-lg-2 p-2" style="line-height:1.6">
	
	
<?php
$sqlamc = "SELECT dateto From jrcamc where sourceid='".$infoselect2['id']."'";
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
		$date = new DateTime($rowamc['dateto']);
$now = new DateTime();
if($date < $now) {
	
	echo '<span class="bg-danger text-white">AMC Expired <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
    /* echo '<span class="text-danger"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
}
else
{
    $t=2;
	echo '<span class="bg-success text-white">AMC Active <strong>('.date('d/m/Y',strtotime($rowamc['dateto'])).')</strong></span><br>';
	/* echo '<span class="text-success"><strong>('.date('d/m/Y',strtotime($rowamc['datefrom'])).' - '.date('d/m/Y',strtotime($rowamc['dateto'])).' '.$rowamc['amcduration'].' Mon - '.$rowamc['amctype'].' Maint)</strong></span><br>'; */
	?>
	<script>
	document.getElementById("amccustomer").style.display="inline-block";
	</script>
	<?php
	
}
		}
		?>
	
	
	<?php
if($infolayoutinvoice['warranty']=='1')
{
if($infoselect2['warranty']!='')
{	
?>
<?php
			
			if($infoselect2['installedon']!='')
			{
			$overdate=$infoselect2['installedon'];
			}
			else
			{
			$overdate=$infoselect2['invoicedate'];
			}
			$off=(float)$infoselect2['warranty'];
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
				echo '<span class="bg-danger text-white">Warranty Expired <strong>('.$effectiveDate1.')</strong></span><br>';
				?>
					<?php
			}
			else
			{
				if(!isset($t))
				{
			    $t=0;
				}
				echo '<span class="bg-success text-white">Warranty Active <strong>('.$effectiveDate1.')</strong></span><br>';
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
					  if(($infolayoutinvoice['serialnumber']=='1')||($infolayoutinvoice['departments']=='1'))
{
	    $sqlcons = "SELECT id From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
        $querycons = mysqli_query($connection, $sqlcons);
        $rowCountcons = mysqli_num_rows($querycons);
        if(!$querycons){
           die("SQL query failed: " . mysqli_error($connection));
        }
        $rowcon = mysqli_fetch_array($querycons);
	?>
					  <a href="serialnumberedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" class="button8">Edit Serials</a>
					  <?php
}
?>
					  <a href="amcedit.php?consigneeid=<?=$rowcon['id']?>&xlid=<?=$infoselect2['id']?>" class="button8">Add to AMC</a> 
					  
	
	</div>
	
	
	</div>
				   <?php
				   
				   $stockitem=$infoselect2['stockitem'];
				$invoiceno=$infoselect2['invoiceno'];
				$invoicedate=$infoselect2['invoicedate'];
				   $coset++;
			   }
			   
				  
				  ?>
					
			</div>
          </div>
          <!-- End -->
        </li>
        <!-- End -->
					<?php
				
				$count++;
					
			}
			
		}
		}
			?>
      </ul>
      <!-- End -->
				
                </div>
              </div>

              </div>
          </div>  
		  <?php
		}
		
?>		
		  </div-->
		  <!--invoice information-->
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<br>
		<!--file upload details-->
		<div class="row">
		<div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header text-center border-0 pt-8 pt-md-2 pb-0 pb-md-2">
              <div class="d-flex justify-content-between">
                <h5>Upload File Here</h5>
              </div>
            </div>
			<div class="card-body">
			<?php
	 $sqlselectdoc = "SELECT invoiceno, invoicedate, consigneeid, id,docdc,docic,docinvoice  From jrcxl where tdelete='0' and  invoiceno='".$rowselect['invoiceno']."' and consigneeid='".$rowselect['consigneeid']."' group by invoiceno";
   $queryselectdoc = mysqli_query($connection, $sqlselectdoc);
        $rowCountselectdoc = mysqli_num_rows($queryselectdoc);
         
        if(!$queryselectdoc){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselectdoc > 0) 
		{
			$count=1;
			$stockitem="";
			$invoiceno="";
			$invoicedate="";
			
			while($rowselectdoc = mysqli_fetch_array($queryselectdoc)) 
			{
				?>
<form action="" method="POST" enctype="multipart/form-data" id="myForm" onsubmit="return validateForm()"> 
<input type="hidden"  id="invoiceno" name="invoiceno" value="<?=$rowselectdoc['invoiceno']?>">
<input type="hidden"  id="consigneeid" name="consigneeid" value="<?=$rowselectdoc['consigneeid']?>">
<input type="hidden"  id="id" name="id" value="<?=$rowselectdoc['id']?>">
 <div class="row">
<div class="col-md-4">
    <div class="form-group">
	<label class="control-label">Upload IC</label>
							 <input type="hidden" name="olddocic" value="<?php echo $rowselectdoc['docic']?>">
							<input type="file" id="docic" name="docic" accept="application/pdf" class="form-control">
							<p id="output" class="text-info"></p>
							<?php 
							if($rowselectdoc['docic']!="")
							{
								?>
							 <button id="previewButton"  class="btn-info float-right" onclick="openNewWindow('<?php echo $rowselectdoc['docic']?>');" data-toggle="tooltip" title="Just Click Here to Preview your pdf">Preview</button>
								
								<?php
							}
							
							?>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label>Upload DC</label>
        <input type="hidden" name="olddocdc" value="<?php echo $rowselectdoc['docdc']?>">
							<input type="file" id="docdc" name="docdc" accept="application/pdf" class="form-control">
							<p id="output1" class="text-info"></p>	
							<?php 
							if($rowselectdoc['docdc']!="")
							{
								?>
								 <button id="previewButton" class="btn-info float-right" onclick="openNewWindow('<?php echo $rowselectdoc['docdc']?>');" data-toggle="tooltip" title="Just Click Here to Preview your pdf ">Preview</button>
								
								<?php
							}
							
							?>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label>Upload Invoice</label>
		<input type="hidden" name="olddocinvoice" value="<?php echo $rowselectdoc['docic']?>" >
		<input type="file" id="docinvoice" name="docinvoice" accept="application/pdf" class="form-control" >
		<p id="output2" class="text-info"></p>
							<?php 
							if($rowselectdoc['docinvoice']!="")
							{
								?>
                                <button id="previewButton" class="btn-info float-right" onclick="openNewWindow('<?php echo $rowselectdoc['docinvoice']?>');" data-toggle="tooltip" title="Just Click Here to Preview your pdf ">Preview</button>
								<?php
							}
							
							?>
							
    </div>
</div>

</div>
<input class="btn btn-primary" type="submit" name="submit" value="Submit">
  </form>
  <?php
			}
		}
  ?>
  </div>
            </div>
        </div>
      </div>
	  	<!--file upload details-->
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
  	<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <img src="" class="imagepreview" style="width: 100%;" >
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
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=initMap&libraries=&v=weekly"
      async
    ></script>
	<script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
	<script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
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
	$(function() {
		$('.pop').on('click', function() {
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			$('#imagemodal').modal('show');   
		});		
});
</script>
<script>
$('#docic').on('change',function()
{
	const size = (this.files[0].size/1024/1024).toFixed(2);
	if( size >=2)
	{
		alert("The File Size Must be below 2 MB");
	}
	else
		{
			$("#output").html('<b>'+'This file size is  '+ size + "MB" + '</b>');
		}
		}

);
$('#docdc').on('change',function()
{
	const size = (this.files[0].size/1024/1024).toFixed(2);
	if( size >=2)
	{
		alert("The File Size Must be below 2 MB");
	}
	else
		{
			$("#output1").html('<b>'+'This file size is  '+ size + "MB" + '</b>');
		}
		}

);
$('#docinvoice').on('change',function()
{
	const size = (this.files[0].size/1024/1024).toFixed(2);
	if( size >=2)
	{
		alert("The File Size Must be below 2 MB");
		return false;
	}
	else
		{
			$("#output2").html('<b>'+'This file size is  '+ size + "MB" + '</b>');
		}
		}

);


</script>
<script>
function openNewWindow(docURL) {
    // Open the document in a new window or tab
    window.open(docURL, '_blank');
}
</script>
<script>
function validateForm() {
    const docic = document.getElementById("docic");
    const docdc = document.getElementById("docdc");
    const docinvoice = document.getElementById("docinvoice");
    const maxSize = 5 * 1024 * 1024; // 5MB in bytes

    // Check the file sizes
    if (docic.files[0] && docic.files[0].size > maxSize) {
        alert("File size for Upload IC must be less than 2MB.");
        return false; // Prevent form submission
    }

    if (docdc.files[0] && docdc.files[0].size > maxSize) {
        alert("File size for Upload DC must be less than 2MB.");
        return false; // Prevent form submission
    }

    if (docinvoice.files[0] && docinvoice.files[0].size > maxSize) {
        alert("File size for Upload Invoice must be less than 2MB.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission if all file sizes are within the limit
}

$('#docdc').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#docdc')[0].files[0].name;
  $(this).prev('label').text(file);
});
</script>

<?php include('additionaljs.php');   ?>
</body>
</html>
