<?php
include('lcheck.php'); 

if($settings=='0')
{
	header("Location: dashboard.php");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Point System</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
  table th
  {
  vertical-align:middle;
  text-align:center;
  text-transform:uppercase;
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

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Point System</h1>
			<button type="button" name="add" id="addPoints" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Points</button>
          </div>
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
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Point System</h6>
            </div>
            <div class="card-body">
	          <div class="table-responsive">
             <table id="PointsList" class="table table-bordered table-striped" style="font-size:13px;">
			 <thead class="bg-primary text-white">
                  <tr>
      <th rowspan="2">S.NO</th>
      <th rowspan="2">PRODUCT</th>
      <th colspan="3" >DELI &amp; INSTA</th>
      <th colspan="4" >PRODUCTION WORK</th>
      <th colspan="2" >ONSITE SERVICE</th>
      <th colspan="4">INHOUSE SERVICE</th>
      <th colspan="5" >PREVENTIVE MAINTANCE</th>
      <th colspan="3" >DISMANTLING OF UPS - SMF</th>
      <th colspan="3" >DISMANTLING OF UPS - TUBULAR</th>
      <th colspan="3" >Target working formula</th>
	   <th rowspan="2">DC SIGN WORK</th>
	  <th rowspan="2">EDIT</th>
	  <th rowspan="2">DELETE</th>
    </tr>
    <tr >
      <th >DELI &amp; INSTA</th>
      <th >DELIVERY ALONE</th>
      <th >INSTALLATION ALONE</th>
      <th >Lug Work</th>
	  <th >PCB Coating</th>
      <th >Testing</th>
      <th >Packing</th>
      <th >External Rectfi</th>
      <th >PCB / Power Components</th>
      <th >Cntrl PCB</th>
      <th >Charger PCB</th>
      <th >Inverter PCB</th>
      <th >others</th>
      <th >HUPS WITH TUBULAR BATTERY</th>
      <th >ONLINE UPS WITH SMF BATTERY</th>
      <th >ONLINE UPS WITH TUBULAR BATTERY</th>
      <th >OFFGRID SOLAR PCU</th>
      <th >ONGRID SOLAR PCU</th>
      <th >UPS ALONE</th>
      <th >BATTERY ALONE</th>
      <th >UPS &amp; BATTERY</th>
      <th >UPS ALONE</th>
      <th >BATTERY ALONE</th>
      <th >UPS &amp; BATTERY</th>
      <th >PRODUTIVITY/DAY</th>
      <th >POINTS/DAY</th>
      <th >POINTS/PRODUCT</th>
	  
    </tr>
               </thead>
              </table>
			
<div id="PointsModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="PointsForm">
			<div class="modal-content">
				<div class="modal-header">					
					<h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="control-label">Product Name</label>
						<input type="text" class="form-control" id="PNAME" name="PNAME">			
					</div>
					<h6 class="text-center text-primary">Delivery & Installation</h6>
					<div class="row">
					<div class="form-group col-4">
						<label for="age" class="control-label">Both</label>							
						<input type="number" class="form-control" id="DELI_INSTA" name="DELI_INSTA" min="0" step="0.01">							
					</div>	   	
					<div class="form-group col-4">
						<label for="lastname" class="control-label">Delivery Only</label>							
						<input type="number" class="form-control"  id="DELIVERY_ALONE" name="DELIVERY_ALONE" min="0" step="0.01">							
					</div>	 
					<div class="form-group col-4">
						<label for="INSTALLATION_ALONE" class="control-label">Installation Only</label>
						<input type="number" class="form-control"  id="INSTALLATION_ALONE" name="INSTALLATION_ALONE" min="0" step="0.01">		
					</div>
					</div>
					<h6 class="text-center text-primary">Production Work</h6>
					<div class="row">
					<div class="form-group col-4">
						<label for="age" class="control-label">Lug Work</label>							
						<input type="number" class="form-control" id="Lug_Work" name="Lug_Work"  min="0" step="0.01">						
					</div>	  
					<div class="form-group col-4">
						<label for="age" class="control-label">PCB Coating</label>							
						<input type="number" class="form-control" id="PCB_Coating" name="PCB_Coating"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-4">
						<label for="lastname" class="control-label">Testing</label>							
						<input type="number" class="form-control"  id="Testing" name="Testing" min="0" step="0.01">							
					</div>	 
					<div class="form-group col-4">
						<label for="INSTALLATION_ALONE" class="control-label">Packing</label>
						<input type="number" class="form-control"  id="Packing" name="Packing" min="0" step="0.01">		
					</div>
					</div>
					<h6 class="text-center text-primary">On-Site Service</h6>
					<div class="row">
					<div class="form-group col-6">
						<label for="age" class="control-label">External Rectification</label>							
						<input type="number" class="form-control" id="External_Rectfi" name="External_Rectfi"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-6">
						<label for="lastname" class="control-label">PCB / Power Components</label>							
						<input type="number" class="form-control"  id="PCB_Power_Components" name="PCB_Power_Components" min="0" step="0.01">							
					</div>	 
					</div>
					<h6 class="text-center text-primary">In House Service</h6>
					<div class="row">
					<div class="form-group col-3">
						<label for="age" class="control-label">Cntrl PCB</label>							
						<input type="number" class="form-control" id="Cntrl_PCB" name="Cntrl_PCB"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-3">
						<label for="lastname" class="control-label">Charger PCB</label>							
						<input type="number" class="form-control"  id="Charger_PCB" name="Charger_PCB" min="0" step="0.01">							
					</div>	
					<div class="form-group col-3">
						<label for="age" class="control-label">Inverter PCB</label>							
						<input type="number" class="form-control" id="Inverter_PCB" name="Inverter_PCB"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-3">
						<label for="lastname" class="control-label">others</label>							
						<input type="number" class="form-control"  id="others" name="others" min="0" step="0.01">							
					</div>	 
					</div>
					
					<h6 class="text-center text-primary">Preventive Maintenance</h6>
					<div class="row">
					<div class="form-group col-4">
						<label for="age" class="control-label">HUPS with Tubular Battery</label>							
						<input type="number" class="form-control" id="HUPS_WITH_TUBULAR_BATTERY" name="HUPS_WITH_TUBULAR_BATTERY"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-4">
						<label for="lastname" class="control-label">ONLINE UPS WITH SMF BATTERY</label>							
						<input type="number" class="form-control"  id="ONLINE_UPS_WITH_SMF_BATTERY" name="ONLINE_UPS_WITH_SMF_BATTERY" min="0" step="0.01">							
					</div>	
					<div class="form-group col-4">
						<label for="age" class="control-label">ONLINE UPS WITH TUBULAR BATTERY</label>							
						<input type="number" class="form-control" id="ONLINE_UPS_WITH_TUBULAR_BATTERY" name="ONLINE_UPS_WITH_TUBULAR_BATTERY"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-6">
						<label for="lastname" class="control-label">OFFGRID SOLAR PCU</label>							
						<input type="number" class="form-control"  id="OFFGRID_SOLAR_PCU" name="OFFGRID_SOLAR_PCU" min="0" step="0.01">							
					</div>	
					<div class="form-group col-6">
						<label for="lastname" class="control-label">ONGRID SOLAR PCU</label>							
						<input type="number" class="form-control"  id="ONGRID_SOLAR_PCU" name="ONGRID_SOLAR_PCU" min="0" step="0.01">							
					</div>	 
					</div>
					<h6 class="text-center text-primary">Dismantling of UPS - SMF</h6>
					<div class="row">
					<div class="form-group col-4">
						<label for="age" class="control-label">UPS ALONE</label>							
						<input type="number" class="form-control" id="UPS_ALONE_SMF" name="UPS_ALONE_SMF"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-4">
						<label for="lastname" class="control-label">BATTERY ALONE</label>							
						<input type="number" class="form-control"  id="BATTERY_ALONE_SMF" name="BATTERY_ALONE_SMF" min="0" step="0.01">							
					</div>	 
					<div class="form-group col-4">
						<label for="INSTALLATION_ALONE" class="control-label">UPS & BATTERY</label>
						<input type="number" class="form-control"  id="UPS_BATTERY_SMF" name="UPS_BATTERY_SMF" min="0" step="0.01">		
					</div>
					</div>
					
					<h6 class="text-center text-primary">Dismantling of UPS - TUBULAR</h6>
					<div class="row">
					<div class="form-group col-4">
						<label for="age" class="control-label">UPS ALONE</label>							
						<input type="number" class="form-control" id="UPS_ALONE_TUBE" name="UPS_ALONE_TUBE"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-4">
						<label for="lastname" class="control-label">BATTERY ALONE</label>							
						<input type="number" class="form-control"  id="BATTERY_ALONE_TUBE" name="BATTERY_ALONE_TUBE" min="0" step="0.01">							
					</div>	 
					<div class="form-group col-4">
						<label for="INSTALLATION_ALONE" class="control-label">UPS & BATTERY</label>
						<input type="number" class="form-control"  id="UPS_BATTERY_TUBE" name="UPS_BATTERY_TUBE" min="0" step="0.01">		
					</div>
					</div>
					<h6 class="text-center text-primary">Target working formula</h6>
					<div class="row">
					<div class="form-group col-4">
						<label for="age" class="control-label">"PRODUTIVITY/DAY</label>							
						<input type="number" class="form-control" id="PRODUTIVITY_DAY" name="PRODUTIVITY_DAY"  min="0" step="0.01">						
					</div>	   	
					<div class="form-group col-4">
						<label for="lastname" class="control-label">POINTS/DAY</label>							
						<input type="number" class="form-control"  id="POINTS_DAY" name="POINTS_DAY" min="0" step="0.01">							
					</div>	 
					<div class="form-group col-4">
						<label for="INSTALLATION_ALONE" class="control-label">POINTS/PRODUCT</label>
						<input type="number" class="form-control"  id="POINTS_PRODUCT" name="POINTS_PRODUCT" min="0" step="0.01">		
					</div>
					</div>
					
					<div class="form-group">
						<label for="DC_SIGN_WORK" class="control-label">DC SIGN WORK</label>
						<input type="number" min="0" step="0.01" class="form-control" id="DC_SIGN_WORK" name="DC_SIGN_WORK">			
					</div>
					
									
				</div>
				<div class="modal-footer">
					<input type="hidden" name="empId" id="empId" />
					<input type="hidden" name="action" id="action" value="" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
              </div>
            </div>
          </div>

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
<script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/js/pointsdata.js"></script>
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
<?php include('additionaljs.php');   ?>
</body>

</html>
