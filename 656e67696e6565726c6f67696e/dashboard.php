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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Dashboard</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
<style>
.text-small
{
	font-size:11px;
}
</style>
</head>

<body id="page-top" onload="getGeolocation()">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Dashboard</h1>
            <!--<a href="#" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          
          <div class="row">
 <div class="col-lg-12">
 Welcome <?=$_SESSION['engineername']?>!<br>
 <br>
 <?php
 if($updates=='0')
 {
	 ?>	 
 <a href="updates.php" style="text-decoration:none;"><div class="alert bg-danger text-white">1 Message Received. <br>Please check UPDATES / NEWS menu.</div></a>
 <?php
 }
 ?>
 <div class="row">
    <div class="col-6 mb-3">
    <a href="updates.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-tasks"></i>
</span><BR><span class="text-small">UPDATES / NEWS</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="attendance.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-clipboard-list"></i>
</span><BR><span class="text-small">ATTENDANCE</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="calls.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-hand-holding-heart"></i>
</span><BR><span class="text-small">COMPLAINTS</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="quotations.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-check"></i>
</span><BR><span class="text-small">QUOTATIONS</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="amcquotations.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-file"></i>
</span><BR><span class="text-small">AMC QUOTATIONS</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="allowance.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-money-bill"></i>
</span><BR><span class="text-small">ALLOWANCE</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="qr.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-qrcode"></i>
</span><BR><span class="text-small">COMPANY QR CODE</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="customers.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-map-marker-alt"></i>
</span><BR><span class="text-small">NEARBY CUSTOMERS</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="nearbycalls.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fas fa-location-arrow"></i>
</span><BR><span class="text-small">NEARBY CALLS</span></a> 
    </div>
	<?php
	if($_SESSION['eligiblecalls']=='1')
	{
		?>
	<div class="col-6 mb-3">
    <a href="addcall.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-phone"></i>
</span><BR><span class="text-small">ADD CALLS</span></a> 
    </div>
	<?php
	}
	?>
	<?php
	if($celigiblecalls=='1')
	{
		?>
	<div class="col-6 mb-3">
    <a href="newcalls.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-plus"></i>
</span><BR><span class="text-small">NEW CALL(NEW CUSTOMER)</span></a> 
    </div>
	<?php
	}
	?>
	<div class="col-6 mb-3">
    <a href="tel:+919442150005" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fas fa-user-tie"></i>
</span><BR><span class="text-small">CALL SUPPORT TEAM</span></a> 
    </div>	
	<div class="col-6 mb-3">
    <a href="profile.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-user"></i>
</span><BR><span class="text-small">PROFILE</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="servicecharges.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-money-bill"></i>
</span><BR><span class="text-small">SERVICE CHARGES</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="saleproduct.php" class="btn btn-primary" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-list"></i>
</span><BR><span class="text-small">PRICE LIST</span></a> 
    </div>
	<div class="col-6 mb-3">
    <a href="#" class="btn btn-warning" style="width:100%"><span style="font-size: 3em;"><i class="fa fa-exclamation-triangle"></i>
</span><BR><span class="text-small">COMPLAINT CELL</span></a> 
    </div>
  </div>
 
			
			</div>
			

            
          </div>
		  
          

       
        </div>
         

      </div>
       

       
      <?php include('footer.php') ?>
       

    </div>
     

  </div>
   

   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a>
   
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
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&callback=locate&libraries=&v=weekly" async></script>
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
var options = {
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 0
};
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
            navigator.geolocation.getCurrentPosition(success, error, options);
			setInterval(function(){
			  navigator.geolocation.getCurrentPosition(success, error, options);
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

</body>

</html>
