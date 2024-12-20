<?php
include('lcheck.php'); 

if($servicecharges=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['id']))
{
	$id=mysqli_real_escape_string($connection, $_POST['id']);
	$schargereceivedmode=mysqli_real_escape_string($connection, $_POST['schargereceivedmode']);
	$schargereceivedon=mysqli_real_escape_string($connection, $_POST['schargereceivedon']);
	$schargeremarks=mysqli_real_escape_string($connection, $_POST['schargeremarks']);
	$cashstatus=mysqli_real_escape_string($connection, $_POST['cashstatus']);

	$sqli=mysqli_query($connection, "update jrccalldetails set cashstatus='$cashstatus', schargereceivedmode='$schargereceivedmode', schargereceivedon='$schargereceivedon', schargeremarks='$schargeremarks' where id='$id'");
	if($sqli)
	{
		header("Location: servicecharges.php?remarks=Changed Successfully!");
	}
	else
	{
		header("Location: servicecharges.php?error=".mysqli_error($connection));
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
          <?php include('accountnavbar.php');?>
        

        
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
	 <div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
	
	 <?php
 }
?> 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
        
          <!--    <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Service Charges Details</h6>
            </div>-->
            <div class="card-body">
 <?php
 if(isset($_GET['id']))
 {
	 $id=mysqli_real_escape_string($connection,$_GET['id']);
?>	 
<form action="" method="post">
<input type="hidden" name="id" id="id" value="<?=$id?>">
 <div class="table-responsive">
 <table class="table table-bordered">
 <tr>
 <th rowspan="2" class="text-center">S.NO</th>
 <th rowspan="2" class="text-center">CALL ID</th>
 <th rowspan="2" class="text-center">ENGINEER NAME</th>
 <th rowspan="2" class="text-center">CUSTOMER</th>
 <th colspan="8" class="text-center">SERVICE CHARGES</th>
 </tr>
 <tr>
 <th>SC NO</th>
 <th>DATE</th>
 <th>MATERIAL CHARGES</th>
 <th>SERVICE CHARGES</th>
 <th>TOTAL</th>
 <th>GST</th>
 <th>GST VALUE</th>
 <th>GRAND TOTAL</th>
 </tr>
 <?php
 $count=1;
 $pendingbalance=0;
 $sqli=mysqli_query($connection, "select t1.id, t1.calltid, t1.srno, t1.addedon, t1.schargeno, t1.schargematerial, t1.schargescharge, t1.schargepre, t1.schargegst, t1.schargegstvalue, t1.scharge, t1.schargedate, t1.cashstatus, t2.engineername, t2.engineerid, t1.tallystatus, t2.consigneeid, t1.schargereceivedmode, t1.schargereceivedon, t1.schargeremarks from jrccalldetails t1, jrccalls t2 where t1.calltid=t2.calltid and t1.scharge!='0.00' and t1.id='$id'");
 while($infoi=mysqli_fetch_array($sqli))
 {
	$consigneeid=mysqli_real_escape_string($connection,$infoi['consigneeid']);
	$sqlcons = "SELECT address1, phone, mobile, email, consigneename, address1, address2, area, pincode, contact, phone, mobile From jrcconsignee where id='".$consigneeid."' order by consigneename asc";
	$querycons = mysqli_query($connection, $sqlcons);
    $infocon=mysqli_fetch_array($querycons);
	if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{		
		if($infocon['address1']!='')
		{
		$infocon['address1']=jbsdecrypt($_SESSION['encpass'], $infocon['address1']);
		}
		if($infocon['phone']!='')
		{
		$infocon['phone']=jbsdecrypt($_SESSION['encpass'], $infocon['phone']);
		}
		if($infocon['mobile']!='')
		{
		$infocon['mobile']=jbsdecrypt($_SESSION['encpass'], $infocon['mobile']);
		}
		if($infocon['email']!='')
		{
		$infocon['email']=jbsdecrypt($_SESSION['encpass'], $infocon['email']);
		}
	}
}
	?>
	 <tr>
	 <td><?=$count?></td>
	 
	 <td><?=$infoi['calltid']?></td>
	 <td><?=$infoi['engineername']?></td>
	 <td><p><strong><?=$infocon['consigneename']?></strong><br><?=$infocon['address1']?> <?=$infocon['address2']?> <?=$infocon['area']?> <?=$infocon['pincode']?><br><?=$infocon['contact']?>  <?=$infocon['phone']?> <?=$infocon['mobile']?></p></td>
	 <td><?=$infoi['schargeno']?></td>
	 <td><?=date('d/m/Y',strtotime($infoi['schargedate']))?></td>
	 <td class="text-right"><?=$infoi['schargematerial']?></td>
	 <td class="text-right"><?=$infoi['schargescharge']?></td>
	 <td class="text-right"><?=$infoi['schargepre']?></td>
	 <td class="text-right"><?=$infoi['schargegst']?></td>
	 <td class="text-right"><?=$infoi['schargegstvalue']?></td>
	 <td class="text-right"><?=$infoi['scharge']?></td>
	 
	 </tr>
	 <?php
	 $count++;
 
 
 ?>
 <tr>
 <td colspan="5" class="text-right">Received Mode</td>
 <td colspan="7" class="text-left">
 <select name="schargereceivedmode" id="schargereceivedmode" class="form-control" required>
 <option value="">Select</option>
 
 <option value="CASH" <?=($infoi['schargereceivedmode']=='CASH')?'selected':''?>>CASH</option>
 <option value="CHEQUE" <?=($infoi['schargereceivedmode']=='CHEQUE')?'selected':''?>>CHEQUE</option>
 <option value="A/C TRANSFER" <?=($infoi['schargereceivedmode']=='A/C TRANSFER')?'selected':''?>>A/C TRANSFER</option>
 <option value="G-PAY" <?=($infoi['schargereceivedmode']=='G-PAY')?'selected':''?>>G-PAY</option>
 <option value="CASH" <?=($infoi['schargereceivedmode']=='NOT PAID')?'selected':''?>>NOT PAID</option>
 </select>
 </td>
 </tr>
 <tr>
 <td colspan="5" class="text-right">Remarks</td>
 <td colspan="7" class="text-left">
<textarea class="form-control" name="schargeremarks" id="schargeremarks" required><?=$infoi['schargeremarks']?></textarea>

 </td>
 </tr>
  <tr>
 <td colspan="5" class="text-right">Received on</td>
 <td colspan="7" class="text-left">
 <input type="date" name="schargereceivedon" id="schargereceivedon" class="form-control" required value="<?=$infoi['schargereceivedon']?>">
 </td>
 </tr>
  <tr>
 <td colspan="5" class="text-right">Status</td>
 <td colspan="7" class="text-left">
 <select name="cashstatus" id="cashstatus" class="form-control" required>
 <option value="">Select</option>
 <option value="0" <?=($infoi['cashstatus']=='0')?'selected':''?>>PENDING</option>
 <option value="1" <?=($infoi['cashstatus']=='1')?'selected':''?>>RECEIVED</option>
 <option value="2" <?=($infoi['cashstatus']=='2')?'selected':''?>>CANCELLED</option>
 </select>
 </td>
 </tr>
 <tr>
 <td colspan="12" class="text-center"><input type="submit" name="submit" value="Submit" class="btn btn-primary"></td>
 </tr>
 <?php
 }
 ?>
 
 </table>
 </div>
 </form>
 <?php
 }
 ?>
			
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
<?php include('additionaljs.php');   ?>	
</body>

</html>
