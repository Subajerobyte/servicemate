<?php
include('lcheck.php');
?>
<!DOCTYPE html>
<html>
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
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  </head>
  <body>
  <?php
 if(isset($_GET['id']))
 {
	$calltid=mysqli_real_escape_string($connection,$_GET['id']);
	$_SESSION['calltid']=$calltid;
	$sqlselect = "SELECT * From jrccalls where (engineerid='".$id."' or find_in_set('".$id."', engineersid)) and calltid='".$calltid."' order by id desc";
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
				$sqlxl = "SELECT * From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
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
		$rowxl['address1']=jbsdecrypt($encpass, $rowxl['address1']);
		}
		if($rowxl['phone']!='')
		{
		$rowxl['phone']=jbsdecrypt($encpass, $rowxl['phone']);
		}
		if($rowxl['mobile']!='')
		{
		$rowxl['mobile']=jbsdecrypt($encpass, $rowxl['mobile']);
		}
		if($rowxl['email']!='')
		{
		$rowxl['email']=jbsdecrypt($encpass, $rowxl['email']);
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
		$rowcons['address1']=jbsdecrypt($encpass, $rowcons['address1']);
		}
		if($rowcons['phone']!='')
		{
		$rowcons['phone']=jbsdecrypt($encpass, $rowcons['phone']);
		}
		if($rowcons['mobile']!='')
		{
		$rowcons['mobile']=jbsdecrypt($encpass, $rowcons['mobile']);
		}
		if($rowcons['email']!='')
		{
		$rowcons['email']=jbsdecrypt($encpass, $rowcons['email']);
		}
	}
}
		?>
<div class="row">

<div class="col-lg-6 mb-4 items">
                                    <div class="card shadow">
									<div class="card-header <?=$bg?> text-white ">
									<?=$rowselect['calltid']?> - <?=$bgtext?>
									</div>
                                        <div class="card-body">
                                            <h5>Call Details:</h5> 
											<p><?=date('d/m/Y h:i:s a', strtotime($rowselect['callon']))?><br>
											C/H: <?=$rowselect['callhandlingname']?><br>
											C/O: <?=$rowselect['coordinatorname']?><br>
											Call From: <a href="tel:<?=$rowselect['callfrom']?>"><?=$rowselect['callfrom']?></a><br>
											Customer Nature: <?php
					  if($rowselect['customernature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-info"><?=$rowselect['customernature']?></span><br>
						   <?php						  
					 }
					 ?>
Business Type: <?php
if($rowselect['businesstype']!='')
{
		?>
	  <span class="btn btn-sm btn-success"><?=$rowselect['businesstype']?></span><br>
	  <?php						  
} 
?>
Service Type: <?php
if($rowselect['servicetype']!='')
{
		?>
	  <span class="btn btn-sm btn-danger"><?=$rowselect['servicetype']?></span><br>
	  <?php						  
} 
?>


					 Call Nature: <?php
					 if($rowselect['callnature']!='')
					 {
							 ?>
						   <span class="btn btn-sm btn-primary"><?=$rowselect['callnature']?></span><br>
						   <?php						  
					 }
					  ?>
											</p>
											<hr>
											<h5>Customer Details:</h5>
											<p><?=$rowxl['consigneename']?><br><?=$rowcons['address1']?> <?=$rowcons['address2']?> <?=$rowcons['area']?> <?=$rowcons['district']?> <?=$rowcons['pincode']?>  <?=$rowcons['contact']?>  <?=$rowcons['phone']?> <?=$rowcons['mobile']?><?php
											if($rowcons['latlong']!='')
											{
											?>	
											<br>
											<a class="text-primary" style="cursor:pointer" onClick="mapsSelector(<?=$rowcons['latlong']?>)">View Loction on Google Map</a>
											<?php
											}
											?>
											</p>
											<hr>
											<h5>Product Details:</h5>
											<p><?php
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
												?><br><b><?=$rowselect['serial']?></b></p>
											<hr>
											<h5>Problem Details:</h5>
											<p>Reported: <?=$rowselect['reportedproblem']?> <?=($rowselect['otherremarks']!='')?'('.$rowselect['otherremarks'].')':''?><br>
					  Observed: <?=$rowselect['problemobserved']?><br>
					  Action Taken: <?=$rowselect['actiontaken']?></p>
					  <hr>
      </div>

                      </div>
                      </div>
                      </div>
    <div class="row">
    <div class="col-lg-12 text-center">
    <video id="preview" width="200"></video>
</div>
</div>
Total Serial Numbers: <span id="totalserials"></span>
<form action="serialadds.php">
<div class="row">
    <div class="col-lg-12">
    <div id="content">
    </div>
    </div>
</div>
</form>

<?php
					$count++;
			}
		}
 }		
			?>

    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
      scanner.addListener('scan', function (content) {
        console.log(content);
        var as=0;
        var totals=0;
        if(document.getElementsByName("serials[]"))
        {
        var serials=document.getElementsByName("serials[]");
        for(var i=0;i<serials.length;i++)
        {
          if(serials[i].value==content)
          {
            as++;
          }      
          totals++;    
        }
        }
        if(as==0)
        {
          document.getElementById('content').innerHTML += '<br><input type="text" name="serials[]" class="form-control" value="'+content+'">';
          totals++;
        }
        else
        {
          alert('Sorry! This QR is Already Exists');
        }
        document.getElementById("totalserials").innerHTML=totals;
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
  </body>
</html>