<?php
include('lcheck.php'); 

if(isset($_POST['submit']))
{
	
	//for expense
	if(isset($_POST['expense']))
	{
    foreach($_POST['expense'] as $updateid)
	{
	 $id=mysqli_real_escape_string($connection, $_POST['id'.$updateid]);
	$expensedoc=mysqli_real_escape_string($connection, $_POST['expensedoc'.$updateid]);
	unlink($expensedoc);
	$sqlis=mysqli_query($connection, "select id from jrciexpense where id='$id'");
	if(mysqli_num_rows($sqlis)>0)
	{
		
		$sqlise=mysqli_query($connection,"UPDATE jrciexpense SET expensedoc = '' WHERE expensedoc='".$expensedoc."' ");
		if($sqlise)
		{

			//header("Location: filemanager.php?remarks=Deleted Successfully");
		}
	
		else
		{
			header("Location: filemanager.php?error=".mysqli_error($connection));
		}
	}
	}
	}
	//for  calls
	if(isset($_POST['calls']))
	{
    foreach($_POST['calls'] as $callsid)
	{
	$id=mysqli_real_escape_string($connection, $_POST['id'.$callsid]);
	$diagnosisimg=mysqli_real_escape_string($connection, $_POST['diagnosisimg'.$callsid]);
	unlink($expensedoc);
	$sqlis=mysqli_query($connection, "SELECT diagnosisimg From jrccalls  where id='".$id."'");
	if(mysqli_num_rows($sqlis)>0)
	{
		
		$sqlise=mysqli_query($connection,"UPDATE jrccalls SET diagnosisimg = '' WHERE diagnosisimg='".$diagnosisimg."'");
		if($sqlise)
		{

			header("Location: filemanager.php?remarks=The Bulk Calls Images Deleted Successfully");
		}
	
		else
		{
			header("Location: filemanager.php?error=".mysqli_error($connection));
		}
	}
	}
	}
	//for calls1
	if(isset($_POST['calls1']))
	{
    foreach($_POST['calls1'] as $callsid1)
	{
	$id=mysqli_real_escape_string($connection, $_POST['i1'.$callsid1]);
	$diagnosissignature=mysqli_real_escape_string($connection, $_POST['diagnosissignature'.$callsid1]);
	unlink($diagnosissignature);
	$sqlis=mysqli_query($connection, "SELECT diagnosissignature From jrccalls  where id='".$id."'");
	if(mysqli_num_rows($sqlis)>0)
	{
		
		$sqlise=mysqli_query($connection,"UPDATE jrccalls SET diagnosissignature = '' WHERE diagnosissignature='".$diagnosissignature."'");
		if($sqlise)
		{

			header("Location: filemanager.php?remarks=The Bulk Calls Images Deleted Successfully");
		}
	
		else
		{
			header("Location: filemanager.php?error=".mysqli_error($connection));
		}
	}
	}
	}
	
	//for  attendance
	if(isset($_POST['attendance']))
	{
    foreach($_POST['attendance'] as $attendanceid)
	{
	 $id=mysqli_real_escape_string($connection, $_POST['id'.$attendanceid]);
	$tickets=mysqli_real_escape_string($connection, $_POST['tickets'.$attendanceid]);
	unlink($tickets);
	 $sqlis=mysqli_query($connection, "SELECT tickets From jrcengroute  where id='".$id."'");
	if(mysqli_num_rows($sqlis)>0)
	{
		
		$sqlise=mysqli_query($connection,"UPDATE jrcengroute SET tickets = '' WHERE tickets='".$tickets."'");
		if($sqlise)
		{

			header("Location: filemanager.php?remarks=The Bulk Attendance Images are Deleted Successfully");
		}
	
		
	}
	}
	}
	
	//for complaint
	if(isset($_POST['complaint']))
	{
    foreach($_POST['complaint'] as $complaintid)
	{
	$id=mysqli_real_escape_string($connection, $_POST['id'.$complaintid]);
	$imguploads=mysqli_real_escape_string($connection, $_POST['imguploads'.$complaintid]);
	unlink($imguploads);
	$sqlis=mysqli_query($connection, "SELECT imguploads From jrccalldetails  where id='".$id."'");
	if(mysqli_num_rows($sqlis)>0)
	{
		
		$sqlise=mysqli_query($connection,"UPDATE jrccalldetails SET imguploads = '' WHERE imguploads='".$imguploads."'");
		if($sqlise)
		{

			header("Location: filemanager.php?remarks=Deleted Successfully");
		}
	
		else
		{
			header("Location: filemanager.php?error=".mysqli_error($connection));
		}
	}
	}
	}
	
	//for complanit1
	if(isset($_POST['complaint1']))
	{
    foreach($_POST['complaint1'] as $complaint1)
	{
	$id=mysqli_real_escape_string($connection, $_POST['id'.$complaint1]);
	$imgbefuploads=mysqli_real_escape_string($connection, $_POST['imgbefuploads'.$complaint1]);
	unlink($imgbefuploads);
	$sqlis=mysqli_query($connection, "SELECT imgbefuploads From jrccalldetails  where id='".$id."'");
	if(mysqli_num_rows($sqlis)>0)
	{
		
		$sqlise=mysqli_query($connection,"UPDATE jrccalldetails SET imgbefuploads = '' WHERE imgbefuploads='".$imgbefuploads."' ");
		if($sqlise)
		{

			header("Location: filemanager.php?remarks=Deleted Successfully");
		}
	
		else
		{
			header("Location: filemanager.php?error=".mysqli_error($connection));
		}
	}
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - File Manager</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   

   <style>
#hierarchy
{
    font-family: FontAwesome;
    width: 300px;
}
.foldercontainer, .file, .noitems
{
    display: block;
    padding: 5px 5px 5px 50px;
}
.folder
{
    color: black;
}
.file
{
    color: black;
}
.folder, .file
{
    cursor: pointer;
}
.noitems
{
    display: none;
    pointer-events: none;
}

.folder:before, .file:before
{
    padding-right: 10px;
}
   </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('officialnavbar.php');?>

        
        <div class="container-fluid">

          <!-- Page Heading -->
<?php
if((isset($_GET['t']))&&(($_GET['t']=='Expense')))
{
?>
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Expense Image</h1>
          </div>
		  <?php
}
if((isset($_GET['t']))&&(($_GET['t']=='Calls')))
{
?>
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Calls Image</h1>
          </div>
		  <?php
}
if((isset($_GET['t']))&&(($_GET['t']=='attendance')))
{
?>
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Attendance Image</h1>
          </div>
		  <?php
}
if((isset($_GET['t']))&&(($_GET['t']=='complaint')))
{
?>
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Complaint Image</h1>
          </div>
		  <?php
}
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
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Additional Material</h6>
            </div>-->
<div class="card-body">
<div id="image-container">
<?php
$y=$_GET['y'];
$m=$_GET['m'];
	  if (isset($_GET['t']) && $_GET['t'] == 'Expense' && $_GET['y'] == $y && $_GET['m'] == $m) 
  {
	    $sqlselect = "SELECT DATE_FORMAT(edate, '%d') AS day FROM jrciexpense WHERE MONTH(edate)='".$m."' and expensedoc!='' ORDER BY day asc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{ 
	          $rowselect=array();
			while($row = mysqli_fetch_array($queryselect)) 
			{
				$rowselect[]=$row;		
				}
				}
				else
		{
			$rowselect=array();
		}
				?>
				<a href="filesm.php?t=Expense&y=<?=$y?>&m=<?=$m?>" class="btn btn-primary">Back</a>
				<div class="row">
                <?php
			   $uniqueArray = array_map('unserialize', array_unique(array_map('serialize', $rowselect)));
                $uniqueArray = array_values($uniqueArray);

	            foreach($uniqueArray as $row)
	             {
		   if($row['day']!='')
		   {
		   ?>
		   <div class="col-lg-1 text-center">
		   <img src="img/Folder.jpg" style="width:100px;height:100px;"></img>
		  <a href="files.php?t=Expense&y=<?=$y?>&m=<?=$m?>&d=<?=$row['day']?>"><?=$y?>/<?=$m?>/<?=$row['day']?></a>
		  </div>
		   <?php
	   }
	   }
	   ?>
	    </div>
	   <?php
	}
	
$y=$_GET['y'];
$m=$_GET['m'];
	  if (isset($_GET['t']) && $_GET['t'] == 'Calls' && $_GET['y'] == $y && $_GET['m'] == $m) 
  {	
	  $sqlselect1 = "SELECT  DATE_FORMAT(callon, '%d') AS day From jrccalls WHERE MONTH(callon)='".$m."' and diagnosisimg!='' or diagnosissignature!='' order by day asc";
        $queryselect1 = mysqli_query($connection, $sqlselect1);
        $rowCountselect1 = mysqli_num_rows($queryselect1);
         
        if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect1 > 0) 
		{
			  $rowcalls=array();
			while($row = mysqli_fetch_array($queryselect1)) 
			{
				$rowcalls[]=$row;
            }				
            }
			else
		{
			$rowcalls=array();
		}
				?>
				<a href="filesm.php?t=Calls&y=<?=$y?>&m=<?=$m?>" class="btn btn-primary">Back</a>
				<div class="row">
                <?php
			   $uniqueArray = array_map('unserialize', array_unique(array_map('serialize', $rowcalls)));
              
                $uniqueArray = array_values($uniqueArray);

	            foreach($uniqueArray as $row)
	             {
		   if($row['day']!='')
		   { 
	      
		   ?>
		    <div class="col-lg-1 text-center">
		   <img src="img/Folder.jpg" style="width:100px;height:100px;"></img>
		   <a href="files.php?t=Calls&y=<?=$y?>&m=<?=$m?>&d=<?=$row['day']?>"><?=$y?>/<?=$m?>/<?=$row['day']?></a>
		   </div>
		   <?php
	   
	   }
	   }
	  ?>
  </div>
	    <?php
      }
	  
$y=$_GET['y'];
$m=$_GET['m'];
	  if (isset($_GET['t']) && $_GET['t'] == 'attendance' && $_GET['y'] == $y && $_GET['m'] == $m) 
  {		  
	   $sqlselect5 = "SELECT DATE_FORMAT(attdate, '%d') AS day From jrcengroute WHERE MONTH(attdate)='".$m."' and tickets!='' order by day asc";
	   $queryselect5 = mysqli_query($connection, $sqlselect5);
        $rowCountselect5 = mysqli_num_rows($queryselect5);
         
        if(!$queryselect5){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect5 > 0) 
		{ 
	         $roweng=array();
			while($row = mysqli_fetch_array($queryselect5)) 
		{
			$roweng[]=$row;
			
		}
		} 
		else
		{
			$roweng=array();
		}
	   $uniqueArray = array_map('unserialize', array_unique(array_map('serialize', $roweng)));
              
                $uniqueArray = array_values($uniqueArray);
           	?>
			<a href="filesm.php?t=attendance&y=<?=$y?>&m=<?=$m?>" class="btn btn-primary">Back</a>
				<div class="row">
                <?php
	            foreach($uniqueArray as $row)
	             {
		   if($row['day']!='')
		   { 
	      
		   ?>
		   <div class="col-lg-1 text-center">
		    <img src="img/Folder.jpg" style="width:100px;height:100px;"></img>
			<a href="files.php?t=attendance&y=<?=$y?>&m=<?=$m?>&d=<?=$row['day']?>"><?=$y?>/<?=$m?>/<?=$row['day']?></a>
		    </div>
		   <?php
	   
	   }
	   }
	   ?>
  </div>
	    <?php
    }

$y=$_GET['y'];
$m=$_GET['m'];
	  if (isset($_GET['t']) && $_GET['t'] == 'complaint' && $_GET['y'] == $y && $_GET['m'] == $m) 
  {	
      $sqlselect8 = "SELECT DATE_FORMAT(addedon, '%d') AS day  From jrccalldetails WHERE MONTH(addedon)='".$m."' and imguploads!='' or imgbefuploads!='' order by day asc";   
        $queryselect8 = mysqli_query($connection, $sqlselect8);
        $rowCountselect8 = mysqli_num_rows($queryselect8);
         
        if(!$queryselect8){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect8 > 0) 
		{ 
	        $rowdetails=array();
			while($rowselect8 = mysqli_fetch_array($queryselect8)) 
			{	
          $rowdetails[]=$rowselect8;
		}
		}	
		else
		{
			$rowdetails=array();
		}
	      $uniqueArray = array_map('unserialize', array_unique(array_map('serialize', $rowdetails)));
              
                $uniqueArray = array_values($uniqueArray);
                  ?>
				  <a href="filesm.php?t=complaint&y=<?=$y?>&m=<?=$m?>" class="btn btn-primary">Back</a>
				<div class="row">
                <?php
	            foreach($uniqueArray as $row)
	             {
		   if($row['day']!='')
		   { 
	      
		   ?>
		   <div class="col-lg-1 text-center">
		   <img src="img/Folder.jpg" style="width:100px;height:100px;"></img>
		   <a href="files.php?t=complaint&y=<?=$y?>&m=<?=$m?>&d=<?=$row['day']?>"><?=$y?>/<?=$m?>/<?=$row['day']?></a>
		   </div>
		   <?php
	   
	   }
	   }
	   ?>
  </div>
	    <?php
									}
									?>
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
  <script src="../../1637028036/js/datatables.js"></script>
  <script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>

 <script>
function checkconfirm()
{
	 var a=confirm("Are You Sure! You Need To Delete This Image?");
	if(a==true)
	{
	 return true;
	}
	else
	{
	 return false;
	} 
}
</script>
	 <!-- Start Script for bulk select -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="expense[]"]').prop('checked',true);
    }else{
      $('input[name="expense[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="expense[]"]').click(function(){
    var total_checkboxes = $('input[name="expense[]"]').length;
    var total_checkboxes_checked = $('input[name="expense[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="calls[]"]').prop('checked',true);
    }else{
      $('input[name="calls[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="calls[]"]').click(function(){
    var total_checkboxes = $('input[name="calls[]"]').length;
    var total_checkboxes_checked = $('input[name="calls[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="attendance[]"]').prop('checked',true);
    }else{
      $('input[name="attendance[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="attendance[]"]').click(function(){
    var total_checkboxes = $('input[name="attendance[]"]').length;
    var total_checkboxes_checked = $('input[name="attendance[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="complaint[]"]').prop('checked',true);
    }else{
      $('input[name="complaint[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="complaint[]"]').click(function(){
    var total_checkboxes = $('input[name="complaint[]"]').length;
    var total_checkboxes_checked = $('input[name="complaint[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="complaint1[]"]').prop('checked',true);
    }else{
      $('input[name="complaint1[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="complaint[]"]').click(function(){
    var total_checkboxes = $('input[name="complaint1[]"]').length;
    var total_checkboxes_checked = $('input[name="complaint[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>
<!--  End Script for bulk select --> 
<?php include('additionaljs.php');   ?>
</body>

</html>