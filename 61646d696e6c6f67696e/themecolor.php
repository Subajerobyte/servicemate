<?php 
include('lcheck.php');   
?>

<?php
if(isset($_POST['reset']))
{
	$bgcolor="#3d8eb9";
	$textcolor="#ffffff";
	$sqlcon = "SELECT id From jrccompany";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountcon > 0) 
		{
 $sqlup = "update jrccompany set bgcolor='".$bgcolor."', textcolor='".$textcolor."'";
			$queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Default Color Changed', '{$tid}', 'jrccompany')");
				header("Location: themecolor.php?remarks=Default Color Changed Successfully");
		}
}
else
			{
			//header("Location: themecolor.php?error=This record is Already Found!");
			}
}
if(isset($_POST['submit']))
{
$bgcolor=mysqli_real_escape_string($connection, $_POST['bgcolor']);
$textcolor=mysqli_real_escape_string($connection, $_POST['textcolor']);
	$sqlcon = "SELECT id From jrccompany";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{
 $sqlup = "update jrccompany set bgcolor='".$bgcolor."', textcolor='".$textcolor."'";
			$queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				//for history update
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Theme Color Changed', '{$tid}', 'jrccompany')");
				
				
				header("Location: themecolor.php?remarks=Theme Color Changed Successfully");
		}
}
else
			{
			//header("Location: themecolor.php?error=This record is Already Found!");
			}
}
else
{
	//header("Location: themecolor.php");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Theme Settings</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <!--- <style>
  ul{
	  list-style-type: none;
  }
  </style> --->
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php  include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php  include('navbar.php');?>
          <?php  include('mastersnavbar.php');?>
        
        <div class="container-fluid">

     <!---drag and drop--->  

<!--<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Theme Settings</h1>
</div>-->

<div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center" ><b>Theme Settings</b></h1>
  </div>
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

				  $sqlselect = "SELECT * From jrccompany  order by id asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$rowselect = mysqli_fetch_array($queryselect);
			
			?>
        <div class="card shadow mb-4">
<div class="card-body">
<form action="" method="post" enctype="multipart/form-data">

<input type="hidden" name="id" id="id" value="<?=$id?>">
 	 <div class="row">
	 <div class="col-6">
	 <label for="bgcolor">Background Color:</label>
		<input type="color" id="bgcolor" name="bgcolor" value="<?=$rowselect['bgcolor']?>"><br><br>
	 </div>
	 <div class="col-6">
	 <label for="textcolor">Text Color:</label>
		<input type="color" id="textcolor" name="textcolor" value="<?=$rowselect['textcolor']?>"><br><br>
	 </div>
	 
	<div class="col-1">
	<div class="form-group">
	<div class="text-left">
	<input type="submit" name="submit" id="submit" value="Change" class="btn btn-success">
	</div>
	</div>
	</div>
	<div class="col-1">
	<div class="form-group">
	<div class="text-left">
	<input type="submit" name="reset" id="reset" value="Default" class="btn btn-info">
	</div>
	</div>
	</div>
    
	</div>
 </form>
 
 
 </div>
</div>
<?php
}

?>
     <!---drag and drop--->     
 
      </div>
      </div>
      <?php  include('footer.php'); ?>
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
$("#topsearch").autocomplete({
  source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
});
$( "#topsearch1" ).autocomplete({
  source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
});
});
$('#dataTable').dataTable({
    paging: false
});
</script>
<!---drag and drop--->
 
<script>
  $( function() {
    $( "#sortable" ).sortable({
      revert: true
    });
    $( "#draggable" ).draggable({
      connectToSortable: "#sortable",
      helper: "clone",
      revert: "invalid"
    });
    $( "ul, li" ).disableSelection();
  } );
  </script>
  
<!---drag and drop--->

<?php
include('additionaljs.php'); ?>
</body>

</html>
