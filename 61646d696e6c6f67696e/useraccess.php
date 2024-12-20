<?php
include('lcheck.php'); 

if(isset($_POST['submit']))
{
  $userid=mysqli_real_escape_string($connection, $_POST['userid']);
  $type=mysqli_real_escape_string($connection, $_POST['type']);

  $calladd=mysqli_real_escape_string($connection, ((isset($_POST['calladd']))?$_POST['calladd']:'0'));
  $calledit=mysqli_real_escape_string($connection, ((isset($_POST['calledit']))?$_POST['calledit']:'0'));
  $callview=mysqli_real_escape_string($connection, ((isset($_POST['callview']))?$_POST['callview']:'0'));
  $callchange=mysqli_real_escape_string($connection, ((isset($_POST['callchange']))?$_POST['callchange']:'0'));
  $callreport=mysqli_real_escape_string($connection, ((isset($_POST['callreport']))?$_POST['callreport']:'0'));
  $servicereport=mysqli_real_escape_string($connection, ((isset($_POST['servicereport']))?$_POST['servicereport']:'0'));
  $ticket=mysqli_real_escape_string($connection, ((isset($_POST['ticket']))?$_POST['ticket']:'0'));
  $engineerta=mysqli_real_escape_string($connection, ((isset($_POST['engineerta']))?$_POST['engineerta']:'0'));
  $addconsignee=mysqli_real_escape_string($connection, ((isset($_POST['addconsignee']))?$_POST['addconsignee']:'0'));
  $addamc=mysqli_real_escape_string($connection, ((isset($_POST['addamc']))?$_POST['addamc']:'0'));
  $exportreport=mysqli_real_escape_string($connection, ((isset($_POST['exportreport']))?$_POST['exportreport']:'0'));
  $addinvoice=mysqli_real_escape_string($connection, ((isset($_POST['addinvoice']))?$_POST['addinvoice']:'0'));
  $deleteproduct=mysqli_real_escape_string($connection, ((isset($_POST['deleteproduct']))?$_POST['deleteproduct']:'0'));
  $warrantymanagement=mysqli_real_escape_string($connection, ((isset($_POST['warrantymanagement']))?$_POST['warrantymanagement']:'0'));
  $amcmanagement=mysqli_real_escape_string($connection, ((isset($_POST['amcmanagement']))?$_POST['amcmanagement']:'0'));
  
  $livelocation=mysqli_real_escape_string($connection, ((isset($_POST['livelocation']))?$_POST['livelocation']:'0'));
  $engineerperformance=mysqli_real_escape_string($connection, ((isset($_POST['engineerperformance']))?$_POST['engineerperformance']:'0'));
  
  $sellprice=mysqli_real_escape_string($connection, ((isset($_POST['sellprice']))?$_POST['sellprice']:'0'));

  
  
  $servicecharges=mysqli_real_escape_string($connection, ((isset($_POST['servicecharges']))?$_POST['servicecharges']:'0'));
  $salesorder=mysqli_real_escape_string($connection, ((isset($_POST['salesorder']))?$_POST['salesorder']:'0'));
  $exportconsignee=mysqli_real_escape_string($connection, ((isset($_POST['exportconsignee']))?$_POST['exportconsignee']:'0'));
  $exportinvoice=mysqli_real_escape_string($connection, ((isset($_POST['exportinvoice']))?$_POST['exportinvoice']:'0'));
  $uploaddata=mysqli_real_escape_string($connection, ((isset($_POST['uploaddata']))?$_POST['uploaddata']:'0'));
  $usercreation=mysqli_real_escape_string($connection, ((isset($_POST['usercreation']))?$_POST['usercreation']:'0'));
  $settings=mysqli_real_escape_string($connection, ((isset($_POST['settings']))?$_POST['settings']:'0'));
  
   $updates=mysqli_real_escape_string($connection, ((isset($_POST['updates']))?$_POST['updates']:'0'));

if(($userid!='')&&($type!=''))
{
  $sqli=mysqli_query($connection, "select id from jrcuseraccess where userid='$userid' and type='$type'");
  mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Changed Permission Status', '{$userid}', 'jrcuseraccess')");
				
  if(mysqli_num_rows($sqli)>0)
  {
    $sqli1=mysqli_query($connection, "update jrcuseraccess set calladd='$calladd', calledit='$calledit', callview='$callview', callchange='$callchange', callreport='$callreport', servicereport='$servicereport', ticket='$ticket', engineerta='$engineerta', addconsignee='$addconsignee', addamc='$addamc', exportreport='$exportreport', addinvoice='$addinvoice', deleteproduct='$deleteproduct', servicecharges='$servicecharges', salesorder='$salesorder', exportconsignee='$exportconsignee', exportinvoice='$exportinvoice', uploaddata='$uploaddata', usercreation='$usercreation', amcmanagement='$amcmanagement', warrantymanagement='$warrantymanagement', settings='$settings', livelocation='$livelocation', engineerperformance='$engineerperformance', sellprice='$sellprice', updates='$updates' where userid='$userid' and type='$type' ");
  }
  else
  {
    $sqli1=mysqli_query($connection, "insert into jrcuseraccess set userid='$userid', type='$type', calladd='$calladd', calledit='$calledit', callview='$callview', callchange='$callchange', callreport='$callreport', servicereport='$servicereport', ticket='$ticket', engineerta='$engineerta', addconsignee='$addconsignee', addamc='$addamc', exportreport='$exportreport', addinvoice='$addinvoice', deleteproduct='$deleteproduct', servicecharges='$servicecharges', salesorder='$salesorder', exportconsignee='$exportconsignee', exportinvoice='$exportinvoice', uploaddata='$uploaddata', usercreation='$usercreation', amcmanagement='$amcmanagement', warrantymanagement='$warrantymanagement', settings='$settings', livelocation='$livelocation', engineerperformance='$engineerperformance', sellprice='$sellprice', updates='$updates'");
  }
  if($sqli1)
  {
    header("location: users.php?remarks=Added Successfully");
  }
}
else
{
  header("location: users.php?error=No Data Found");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Edit User Permission Details</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <style>
#profileDisplay { display: block; height: 100px; width: 100px; margin: 0px auto; border-radius:5%; }
.img-placeholder {
  width: 100px;
  color: white;
  height: 100px;
  background: black;
  opacity: .7;
  height: 125px;
  border-radius: 5%;
  z-index: 2;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder h4 {
  margin-top: 40%;
  color: white;
}
.img-div:hover .img-placeholder {
  display: block;
  cursor: pointer;
}
hr {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}
   </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('usersnavbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Edit User Permission Details</h1>
            <a href="users.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All User Permission Details</a>
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
           <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit User Permission Details</h6>
            </div>-->
<div class="card-body">
<?php
if((isset($_GET['id']))&&(isset($_GET['type'])))
{
$id=mysqli_real_escape_string($connection,$_GET['id']);
$type=mysqli_real_escape_string($connection,$_GET['type']);
$table='';
if(($id!='')&&($type!=''))
{
  if($type=='adminuser')
  {
    $table='adminuser';
  }
  if($type=='accountsuser')
  {
    $table='accountsuser';
  }
  if($type=='callhandling')
  {
    $table='callhandling';
  }
  if($type=='coordinator')
  {
    $table='coordinator';
  }
  if($type=='servicemanager')
  {
    $table='servicemanager';
  }
  if($table!='')
  {

				  $sqlselect = "SELECT * From jrc".$table." where id='".$id."' order by username asc";
				  
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
        $sqli=mysqli_query($connection, "select * from jrcuseraccess where userid='$id' and type='$type'");
        $info=mysqli_fetch_array($sqli);
			?>
      <div class="alert alert-info"><b>Name:</b> <?=$rowselect[$table.'name']?><br>
      <b>Designation:</b> <?=$rowselect['designation']?><br>
      <b>Username:</b> <?=$rowselect['username']?>
    </div>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="type" id="type" value="<?=$type?>">
<input type="hidden" name="userid" id="userid" value="<?=$id?>">

<div class="row">
<div class="col-lg-12">
<h5><label><input type="checkbox" id="checkchAll"> Call Handling Provisions</label></h5>
<hr />
<label><input type="checkbox" class="checkchItem" name="calladd" id="calladd" value="1" <?=($info['calladd']=='1')?'checked':''?> > Add Calls </label><br>
<label><input type="checkbox" class="checkchItem" name="calledit" id="calledit" value="1" <?=($info['calledit']=='1')?'checked':''?> > Edit Calls </label><br>
<label><input type="checkbox" class="checkchItem" name="callview" id="callview" value="1" <?=($info['callview']=='1')?'checked':''?>> View Calls </label><br>
<br>

<h5><label><input type="checkbox" id="checkcoAll"> Call Co-Ordinator Provisions</label></h5>
<hr />
<label><input type="checkbox" class="checkcoItem" name="callchange" id="callchange" value="1" <?=($info['callchange']=='1')?'checked':''?>> Change Call Information </label><br>
<label><input type="checkbox" class="checkcoItem" name="callreport" id="callreport" value="1" <?=($info['callreport']=='1')?'checked':''?>> View Call Reports </label><br>
<label><input type="checkbox" class="checkcoItem" name="servicereport" id="servicereport" value="1" <?=($info['servicereport']=='1')?'checked':''?>> Modify Engineer's Service Call Reports </label><br>

<label><input type="checkbox" class="checkcoItem" name="livelocation" id="livelocation" value="1" <?=($info['livelocation']=='1')?'checked':''?>> Engineers Live Location </label><br>

<label><input type="checkbox" class="checkcoItem" name="engineerperformance" id="engineerperformance" value="1" <?=($info['engineerperformance']=='1')?'checked':''?>> Engineers Performance </label><br>

<label><input type="checkbox" class="checkcoItem" name="ticket" id="ticket" value="1" <?=($info['ticket']=='1')?'checked':''?>> Engineers Ticket Verification / Approval </label><br>
<label><input type="checkbox" class="checkcoItem" name="engineerta" id="engineerta" value="1" <?=($info['engineerta']=='1')?'checked':''?>> Engineer's DA / TA Export </label><br>
<br>

<h5><label><input type="checkbox" id="checkscAll"> Service Call Manager Provisions</label></h5>
<hr />
<label><input type="checkbox" class="checkscItem" name="addconsignee" id="addconsignee" value="1" <?=($info['addconsignee']=='1')?'checked':''?>> Add / Edit Customer </label><br>

<label><input type="checkbox" class="checkscItem" name="exportreport" id="exportreport" value="1" <?=($info['exportreport']=='1')?'checked':''?>> Export Call Reports </label><br>
<br>

<h5><label><input type="checkbox" id="checkwaAll"> Warranty / AMC Management</label></h5>
<hr />
<label><input type="checkbox" class="checkwaItem" name="warrantymanagement" id="warrantymanagement" value="1" <?=($info['warrantymanagement']=='1')?'checked':''?>> View Warranty Details </label><br>

<label><input type="checkbox" class="checkwaItem" name="addamc" id="addamc" value="1" <?=($info['addamc']=='1')?'checked':''?>> Add / Edit AMC Details </label><br>

<label><input type="checkbox" class="checkwaItem" name="amcmanagement" id="amcmanagement" value="1" <?=($info['amcmanagement']=='1')?'checked':''?>> View AMC Details </label><br>
<br>


<h5><label><input type="checkbox" id="checkacAll"> Accounts Provisions</label></h5>
<hr />
<label><input type="checkbox" class="checkacItem" name="addinvoice" id="addinvoice" value="1" <?=($info['addinvoice']=='1')?'checked':''?>> Add / Edit Invoice </label><br>
<label><input type="checkbox" class="checkacItem" name="servicecharges" id="servicecharges" value="1" <?=($info['servicecharges']=='1')?'checked':''?>> Handling Service Charges </label><br>

<label><input type="checkbox" class="checkacItem" name="salesorder" id="salesorder" value="1" <?=($info['salesorder']=='1')?'checked':''?>> Add / Export Sales Order </label><br>

<label><input type="checkbox" class="checkacItem" name="sellprice" id="sellprice" value="1" <?=($info['sellprice']=='1')?'checked':''?>> Sales Product and Selling Price </label><br>

<br>


<h5><label><input type="checkbox" id="checkadAll"> Admin Provisions</label></h5>
<hr />
<label><input type="checkbox" class="checkadItem" name="updates" id="updates" value="1" <?=($info['updates']=='1')?'checked':''?>> Updates and Announcements </label><br>

<label><input type="checkbox" class="checkadItem" name="exportconsignee" id="exportconsignee" value="1" <?=($info['exportconsignee']=='1')?'checked':''?>> Export Customer Details </label><br>
<label><input type="checkbox" class="checkadItem" name="exportinvoice" id="exportinvoice" value="1" <?=($info['exportinvoice']=='1')?'checked':''?>> Export Invoice Details </label><br>

<label><input type="checkbox" class="checkadItem" name="uploaddata" id="uploaddata" value="1" <?=($info['uploaddata']=='1')?'checked':''?>> Upload Datas </label><br>
<label><input type="checkbox" class="checkadItem" name="deleteproduct" id="deleteproduct" value="1" <?=($info['deleteproduct']=='1')?'checked':''?>> Delete Uploaded Datas </label><br>
<label><input type="checkbox" class="checkadItem" name="usercreation" id="usercreation" value="1" <?=($info['usercreation']=='1')?'checked':''?>> User Management </label><br>
<label><input type="checkbox" class="checkadItem" name="settings" id="settings" value="1" <?=($info['settings']=='1')?'checked':''?>> Settings </label><br>


<br>



  </div>
</div>
  
  
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
<?php
					$count++;
			}
		}
  }
}
}
			?>
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
     $( "#adminusername" ).autocomplete({
       source: 'adminusersearch.php?type=adminusername',
     });
	 $( "#designation" ).autocomplete({
       source: 'adminusersearch.php?type=designation',
     });
	 $( "#username" ).autocomplete({
       source: 'adminusersearch.php?type=username',
     });
  });
</script>
<script>
   $("#checkchAll").click(function () {
     $('.checkchItem').not(this).prop('checked', this.checked);
 });
 $("#checkcoAll").click(function () {
     $('.checkcoItem').not(this).prop('checked', this.checked);
 });
 $("#checkacAll").click(function () {
     $('.checkacItem').not(this).prop('checked', this.checked);
 });
 $("#checkadAll").click(function () {
     $('.checkadItem').not(this).prop('checked', this.checked);
 });
 $("#checkscAll").click(function () {
     $('.checkscItem').not(this).prop('checked', this.checked);
 }); 
  $("#checkwaAll").click(function () {
     $('.checkwaItem').not(this).prop('checked', this.checked);
 }); 
  $("#checkengAll").click(function () {
     $('.checkengItem').not(this).prop('checked', this.checked);
 }); 
 
 </script>
 <?php include('additionaljs.php');   ?>
</body>

</html>
