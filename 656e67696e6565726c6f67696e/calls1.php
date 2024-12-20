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
  <title><?=$_SESSION['companyname']?> - Jerobyte - Complaints</title>
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
          <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h4 mb-0 text-gray-800">Complaints</h1>
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
 if(isset($_GET['status']))
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
					 
					  ?>
		<div class="col-lg-6 mb-4 items">
                                    <div class="card shadow">
						
                                        <div class="card-body">
                                           <?php
					  if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
						   <?php						  
					 }
					 ?>

					  <?php
					  if($bgtext!='Completed')
					  {
						if(($bgtext=='Pending')||($bgtext=='Open'))
						{
						  if($rowselect['acknowlodge']=='1')
						  {
							if($rowselect['startip']!='')
							{
							$opencallstatus++;	
							?>
							<a class="btn btn-sm btn-success text-white mb-1"><i class="fas fa-check"></i> Started from my Location (<?=$rowselect['startip']?>)</a><br>
							<?php
							}
							else
							{
							?>
							<a onclick="endlocation('<?=$rowselect['startip']?>', <?=$rowselect['calltid']?>)" class="btn btn-sm btn-primary text-white mb-1">Reached to Customer Location</a><br>
							<?php
							}
							}
							else
							{
							?>
							<a onclick="startmylocation()" class="btn btn-sm btn-primary text-white mb-1">Start from my Location</a><br>
							<?php							
							}
							}
							else
							{
							?>
							<a href="callackn.php?id=<?=$rowselect['id']?>&status=<?=$_GET['status']?>" class="btn btn-sm btn-danger text-white mb-1">Click Here to Acknowledge</a><br>
							<?php							
							}
						}
					  
					  else
					  {
							if($rowselect['detailsid']!='')
							{
							if($rowselect['detailsapprove']=='1')
							{
							$sqlcon4 = "SELECT callstatus From jrccalldetails WHERE calltid = '{$rowselect['calltid']}' and reassign='0'";
							$querycon4 = mysqli_query($connection, $sqlcon4);
							$rowcon4=mysqli_fetch_array($querycon4);
							if($rowcon4['callstatus']!='')
							{
							?>
							<a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-primary text-white mb-1"> <i class="fas fa-print"></i></a> <?php if($rowcons['email']!=''){?> <a href="sendEmails.php?calltid=<?=$rowselect['calltid']?>&email=<?=$rowcons['email']?>" onclick="return confirm('Are you sure want to send this Service Call Report to the customer via Email?')" class="btn btn-sm btn-success text-white mb-1"> <i class="fas fa-at"></i></a> <?php } ?>
							<!--<a href="complaintpdf.php?id=<?=$rowselect['calltid']?>" class="btn btn-sm btn-danger text-white mb-1"> <i class="fas fa-file-pdf"></i></a>-->
							
							<br>
							<?php
							}
							}
							}
					  }
					  ?>
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

    function error1(err) {
        alert(`Failed to locate. Error: ${err.message}`);
    }
    function success1(pos) {
        alert('Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`);
		startposition(pos);
    }
    function startmylocation() {
		
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