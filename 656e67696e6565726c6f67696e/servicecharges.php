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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Service Charges</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
<style>
.imgcontainer, .imgcontainer2, .imgsealcontainer{
	height:auto;
 text-align:center;
}
.imgcontent, .imgsealcontent{
 width: 110px;
 float: left;
 margin-right: 5px;
 border: 1px solid gray;
 border-radius: 3px;
 padding: 5px;
}

/* Delete */
.imgcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgcontent span:hover{
 cursor: pointer;
}
.imgsealcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgsealcontent span:hover{
 cursor: pointer;
}
.ajax-upload-dragdrop, .ajax-file-upload-statusbar, .ajax-file-upload-filename
{
	width: 100% !important;
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
            <h1 class="h4 mb-2 mt-2 text-gray-800">Service Charges</h1>
          </div>

          
          <div class="row">
 <div class="col-lg-12">
 <?php
 if(isset($_GET['remarks']))
 {
	 ?>
	 <div class="alert alert-success"><?=$_GET['remarks']?></div>
	
	 <?php
 }
?> 
      <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Service Charges Details</h6>
            </div>
            <div class="card-body">
 
 <div class="table-responsive">
 <table class="table table-bordered">
 <tr>
 <th>DETAILS</th>
 <th>SERVICE CHARGE</th>
 <th>STATUS</th>
 </tr>
 <?php
 $count=1;
 $pendingbalance=0;
 $sqli=mysqli_query($connection, "select t1.calltid, t1.srno, t1.addedon, t1.schargeno, t1.scharge, t1.schargedate, t1.cashstatus, t1.schargereceivedmode, t1.schargereceivedon, t2.consigneeid from jrccalldetails t1, jrccalls t2 where t1.calltid=t2.calltid and (t2.engineerid='".$engineerid."' or t2.reportingengineerid='".$engineerid."') and t1.scharge!='0.00' and t1.scharge!='0' and t1.scharge!='' and t1.scharge is not null order by DATE(t1.schargedate) desc, t1.cashstatus asc");
 while($infoi=mysqli_fetch_array($sqli))
 {
	 $consigneeid=mysqli_real_escape_string($connection,$infoi['consigneeid']);
	$sqlcons = "SELECT * From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
	$querycons = mysqli_query($connection, $sqlcons);
    $infocon=mysqli_fetch_array($querycons);
	if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($infocon['address1']!='')
		{
		$infocon['address1']=jbsdecrypt($encpass, $infocon['address1']);
		}
		if($infocon['phone']!='')
		{
		$infocon['phone']=jbsdecrypt($encpass, $infocon['phone']);
		}
		if($infocon['mobile']!='')
		{
		$infocon['mobile']=jbsdecrypt($encpass, $infocon['mobile']);
		}
		if($infocon['email']!='')
		{
		$infocon['email']=jbsdecrypt($encpass, $infocon['email']);
		}
	}
}
	 ?>
	 <tr>
	 <td><?=$infoi['calltid']?><br><b><?=$infocon['consigneename']?></b><br><?=$infoi['schargeno']?><br><?=date('d/m/Y',strtotime($infoi['schargedate']))?></td>
	 <td class="text-right"><?=$infoi['scharge']?></td>
	 <?php
	 if($infoi['cashstatus']=='0')
	 {
		 $pendingbalance+=(float)$infoi['scharge'];
		 ?>
		 <td class="text-danger">Pending</td>
		 <?php
	 }
	 else
	{
		 ?>
		 <td class="text-success">Paid on <?=date('d/m/Y',strtotime($infoi['schargereceivedon']))?> through <?=$infoi['schargereceivedmode']?></td>
		 <?php
	 }	 
	 ?>
	 </tr>
	
	 <?php
	 $count++;
 }
 
 ?>
 <tr>
 <td>Total Pending Amount</td>
 <td class="text-right"><?=number_format($pendingbalance,2,'.',',')?></td>
 <td></td>
 </tr>
 </table>
 </div>
			
</div>
			
 </div>
			
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
</body>

</html>
