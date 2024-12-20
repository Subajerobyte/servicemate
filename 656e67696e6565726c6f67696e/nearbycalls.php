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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Nearby Calls</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
	
</head>

<body id="page-top">
<input type="hidden" name="myloc" id="myloc" value="10.826625682767068,78.68206400238414">
  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Nearby Calls</h1>
            
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
		
			<div id="map_div" style="width: 100%; height: 480px;"></div>
			

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

  <!-- Page level plugins -->
  <script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>


  <!-- Page level plugins -->
  <script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../1637028036/js/datatables.js"></script>
  
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
<?php

function distance($lat1, $lon1, $lat2, $lon2, $unit) 
{
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

?>
<script>
      let map;
	  function locate(){
        navigator.geolocation.getCurrentPosition(initialize,fail);
	}
	  function initialize(position) {
		  
		map = new google.maps.Map(document.getElementById("map_div"), {
          center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
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
		const contentString ='My Location';
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
		{
            position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
			type: "parking",
			title: 'My Location',
          },
		<?php
		
		$sqlselect = "SELECT latlong, consigneename,id From jrcconsignee where latlong!='' order by consigneename asc";
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
		$sqlselect1 = "SELECT compstatus,consigneeid,sourceid,calltid From jrccalls where consigneeid='".$rowselect['id']."' and compstatus='0'";
        $queryselect1 = mysqli_query($connection, $sqlselect1);
        $rowCountselect1 = mysqli_num_rows($queryselect1);
         
        if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect1 > 0) 
		{
			while($rowselect1 = mysqli_fetch_array($queryselect1)) 
			{
		$sqlselectxl = "SELECT stockitem,id From jrcxl where id='".$rowselect1['sourceid']."'";
        $queryselectxl = mysqli_query($connection, $sqlselectxl);
		$rowselectxl = mysqli_fetch_array($queryselectxl);
		
				$sqlselect2 = "SELECT consigneeid, startip,calltid,engineerid From jrccallstravel where calltid='".$rowselect1['calltid']."' and (startip IS NULL or startip='')";
				$queryselect2 = mysqli_query($connection, $sqlselect2);
				$rowCountselect2 = mysqli_num_rows($queryselect2);
				
				if(!$queryselect2){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountselect2 > 0) 
				{
					while($rowselect2 = mysqli_fetch_array($queryselect2)) 
					{
						$calltid=$rowselect2['calltid'];
				$clatlong=explode(',',$rowselect['latlong']);
if(distance($_SESSION['mylat'], $_SESSION['mylong'], $clatlong[0], $clatlong[1], "K") < 100)
{
  			?>
          {
            position: new google.maps.LatLng(<?=$rowselect['latlong']?>),
            type: "info",
			title: '<?=mysqli_real_escape_string($connection,$rowselect["consigneename"])?> <br><a target="_blank" href="calltransfer.php?status=0&calltid=<?=$rowselect2["calltid"]?>"><?=($rowselect2['engineerid']!=$_SESSION['engineerid'])?"view <br>":''?></a>',
			
			},
		  <?php
}
		}
		}
		}
		}
		}
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
	  
	  function fail(){
         alert('Please Turn On Location');
     }
    </script>
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=locate&libraries=&v=weekly"
      async
    ></script>
</body>
</html>