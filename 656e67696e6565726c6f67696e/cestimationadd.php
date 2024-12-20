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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Site Camera Survey Estimation Report Generation</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
    <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
<style>
.imgcontainer, .imgcontainer2, .imgsealcontainer, .imgmanualcontainer{
	height:auto;
 text-align:center;
}
.imgcontent, .imgsealcontent, .imgmanualcontent{
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
.imgmanualcontent span{
 border: 2px solid red;
 display: inline-block;
 width: 100%; 
 text-align: center;
 color: red;
}
.imgsealcontent, .imgmanualcontent span:hover{
 cursor: pointer;
}
.ajax-upload-dragdrop, .ajax-file-upload-statusbar, .ajax-file-upload-filename
{
	width: 100% !important;
}
</style>
<style>
      .hr1 {
        font-family: sans-serif;
        margin: 5px auto;
        color: #228B22;
        text-align: center;
        font-size: 20px;       
        position: relative;
      }
      .hr1:before {
        content: "";
        display: block;
        width: 45%;
        height: 2px;
        background: #191970;
        left: 0;
        top: 50%;
        position: absolute;
      }
      .hr1:after {
        content: "";
        display: block;
        width: 45%;
        height: 2px;
        background: #191970;
        right: 0;
        top: 50%;
        position: absolute;
      }
	  .card-title
	  {
		  margin-bottom:0;
		  text-align:center;
	  }
	  .card.text-white.bg-success
	  {
		  height:92px;
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
         
           <h1 class="h4 mb-0 text-black-800 text-center p-2">Camera Estimation Generation</h1>
      

          
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
 
  <?php 
if(isset($_GET['id']))
 {
	 $Q='';
	 if($_GET['id']!='')
	 {
		 $Q='and id="'.mysqli_real_escape_string($connection,$_GET['id']).'"';
	 }
?>	 
 <div class="row">
    <div class="col-sm-12 mb-3">
      <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Search..">
	  <span class="text-black-50 small">Hints: Pending, Pending, Date, Mobile, Name, Address</span>
    </div>
  </div>
 <div class="row" id="myItems">
 <?php
$qs=""; 
if($ltype=='CONTRACTOR')
				  {
				 $sqlselect = "SELECT * From csurveyorderlist where contractorid='".$engineerid."' ".$Q." order by id desc";
				  }
				  else
				  {
				$sqlselect = "SELECT * From csurveyorderlist where subcontractorid='".$engineerid."' ".$Q." order by id desc";	  
				  }
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
				$wsurveyid=mysqli_real_escape_string($connection, $rowselect['wsurveyid']);
			$wsurveylistid=mysqli_real_escape_string($connection, $rowselect['id']);
					
?>
	
		<?php
					 if($rowselect['compstatus']=='2')
					  {
						$bg="bg-success";
						$bgtext="Completed";
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						$bg="bg-warning";
						$bgtext="Pending";
					  }
					  else
					 {
						 $bg="bg-danger";
						$bgtext="Pending";
					  }
					  ?>
		<div class="col-lg-6 mb-4 items">
                                    <div class="card shadow">
									<div class="card-header <?=$bg?> text-white ">
									<?=$rowselect['id']?> - <?=$bgtext?>
									</div>
                                        <div class="card-body">
                                            <h5>Order Details:</h5> 
											<p><?=date('d/m/Y h:i:s a', strtotime($rowselect['createdon']))?><br>
											<?=$rowselect['contactperson']?>
											Contact No: <a href="tel:<?=$rowselect['contact']?>"><?=$rowselect['contact']?></a><br>
											<?=$rowselect['additionalinfo']?><br><?=$rowselect['subadditionalinfo']?>
			
											<hr>
											<h5>Site Details:</h5>
											<p><?=$rowselect['department']?><br><?=$rowselect['officename']?><br><?=$rowselect['address']?> <?=$rowselect['area']?> <?=$rowselect['district']?> - <?=$rowselect['district']?>
											</p>
											<hr>
											<?php
											if($rowselect['westimateno']!='')
											{
												?>
											<h5 style="line-height:1.5">Camera Estimation No: <span  class="text-success"><?=$rowselect['westimateno']?></span><br>
											Camera Estimation Date: <span  class="text-success"><?=date('d/m/Y', strtotime($rowselect['westimatedate']))?></span></h5>
											<?php
											}
											?>
											<h5 class="text-danger">Due Date: <?=date('d/m/Y', strtotime($rowselect['subduedate']))?></h5>
											<hr>
											<?php
											
			if($rowselect['westimateno']=='')
					  {
		?>
		<!-- Button to open Add Location modal -->
        <!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLocationModal">
            Add Location
        </button-->

        <!-- Modal for Add Location -->
        <!--div class="modal fade" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="addLocationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLocationModalLabel">Add Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        < Add Location Form>
                        <form id="addLocationForm">
                            <Hidden input fields for wsurveylistid and wsurveyid >
                            <input type="hidden" name="wsurveylistid" value="<?=$wsurveylistid?>">
                            <input type="hidden" name="wsurveyid" value="<?=$wsurveyid?>">

                            <div class="form-group">
                                <label for="location">Location Name:</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Location</button>
                        </form>
                    </div>
                </div>
            </div>
        </div-->

        <hr>

        <!-- Display locations -->
        <div id="locationsList">
            <!-- Locations will be populated dynamically with AJAX -->
        </div>
		
		<?php
		if(isset($_GET['locationno']))
		{
			$locationno=mysqli_real_escape_string($connection, $_GET['locationno']);
	// Replace with your database connection
    require_once "lcheck.php";

    // Fetch location details based on locationno
    $query = "SELECT * FROM clocation_table WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $locationno);
    $stmt->execute();
    $location = $stmt->get_result()->fetch_assoc();

    if ($location) {
		echo "<hr>";
        echo "<h4 class='text-primary'>Location Details: {$location['location_name']}</h4>";
        echo "<p>Complete Status: {$location['complete_status']}</p>";
        echo "<p>Completed On: {$location['completed_on']}</p>";
        // Display other location details as needed
    } else {
        echo "Location not found.";
    }

    $stmt->close();
		?>
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <input type="hidden" name="wsurveyid" value="<?=$wsurveyid?>">
                    <input type="hidden" name="wsurveylistid" value="<?=$wsurveylistid?>">
                    <input type="hidden" name="locationno" value="<?=$locationno?>">
                    <label for="itemcategory">Select Item Category:</label>
                    <select id="itemcategory" class="form-control">
                        <option value="">Select Item Category</option>
                    </select>
					<div class="form-group">
					<label class="form-label">No of Quatity in this Item Category</label>
					<input type="number" name="itemcategoryqty" id="itemcategoryqty" class="form-control" min="1" required>
					</div>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody">
                            <!-- Item names and quantity inputs will be dynamically loaded here -->
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addProductBtn">Add Product</button>
            </div>
        </div>
    </div>
</div>

<p class="text-right"><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#addProductModal'>Add Product</button><br></p>
<!-- ... Your existing code ... -->
<div class="accordion" id="productAccordion">
<?php
// Fetch and display products based on item category
$query = "SELECT DISTINCT itemcategory, itemcategoryqty FROM cestimatesloc WHERE wsurveyid = ? AND wsurveylistid = ? AND locationno = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("iii", $wsurveyid, $wsurveylistid, $locationno);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $itemcategory = $row['itemcategory'];
    $itemcategoryqty = $row['itemcategoryqty'];
    $sanitizedItemCategory = preg_replace("/[^a-zA-Z0-9]+/", "_", $itemcategory); // Sanitize for use in IDs

    // Fetch the number of rows for the current item category
    $rowCountQuery = "SELECT COUNT(*) AS num_rows FROM cestimatesloc WHERE wsurveyid = ? AND wsurveylistid = ? AND locationno = ? AND itemcategory = ?";
    $rowCountStmt = $connection->prepare($rowCountQuery);
    $rowCountStmt->bind_param("iiis", $wsurveyid, $wsurveylistid, $locationno, $itemcategory);
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->get_result();
    $rowCountRow = $rowCountResult->fetch_assoc();
    $numRows = $rowCountRow['num_rows'];

    echo '<div class="card">';
    echo '<div class="card-header" id="heading' . $sanitizedItemCategory . '">';
    echo '<h5 class="mb-0">';
    echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' . $sanitizedItemCategory . '" aria-expanded="true" aria-controls="collapse' . $sanitizedItemCategory . '">';
    echo $itemcategory . ' (' . $itemcategoryqty . ') <span class="badge badge-secondary">' . $numRows . '</span>'; // Add badge with itemcategoryqty and number of rows
    echo '</button>';
    echo '</h5>';
    echo '</div>';

    echo '<div id="collapse' . $sanitizedItemCategory . '" class="collapse" aria-labelledby="heading' . $sanitizedItemCategory . '" data-parent="#productAccordion">';
    echo '<div class="card-body">';

    // Fetch and display product details for the current item category with non-zero quantity
    $productQuery = "SELECT wp.itemcode, wp.itemname, wsl.quantity FROM cestimatesloc wsl
                    JOIN wproducts wp ON wsl.itemid = wp.id
                    WHERE wsl.wsurveyid = ? AND wsl.wsurveylistid = ? AND wsl.locationno = ? AND wsl.itemcategory = ? AND wsl.quantity > 0";
    $productStmt = $connection->prepare($productQuery);
    $productStmt->bind_param("iiis", $wsurveyid, $wsurveylistid, $locationno, $itemcategory);
    $productStmt->execute();
    $productResult = $productStmt->get_result();

    if ($productResult->num_rows > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>Item Code</th><th>Item Name</th><th>Quantity</th></tr></thead>';
        echo '<tbody>';
        while ($productRow = $productResult->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $productRow['itemcode'] . '</td>';
            echo '<td>' . $productRow['itemname'] . '</td>';
            echo '<td>' . $productRow['quantity'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
		// Close the product statement
$productStmt->close();
    } else {
        echo 'No products found.';
    }

    echo '</div>';
    echo '</div>';
    echo '</div>';
	// Close the main statement

}




?>

</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <input type="hidden" name="wsurveyid" value="<?=$wsurveyid?>">
                    <input type="hidden" name="wsurveylistid" value="<?=$wsurveylistid?>">
                    <input type="hidden" name="locationno" value="<?=$locationno?>">

                    <label for="itemcategory">Select Item Category:</label>
                    <select id="itemcategory" class="form-control">
                        <option value="">Select Item Category</option>
                    </select>
					<div class="form-group">
					<label class="form-label">No of Quatity in this Item Category</label>
					<input type="number" name="itemcategoryqty" id="itemcategoryqty" class="form-control" min="1" required>
					</div>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody">
                            <!-- Item names and quantity inputs will be dynamically loaded here -->
                        </tbody>
                    </table>
	
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editProductBtn" onclick="updatepro()">Edit Product</button>
            </div>
        </div>
    </div>
</div>



	<?php		
		}
		?>
		<br>
<h5>Consolidated Quantity</h5>
<br>
<!-- ... Your existing code ... -->

		<form method="post" action="cestimationadds.php">
		<input type="hidden" name="wsurveyid" value="<?=$rowselect['wsurveyid']?>">
		<input type="hidden" name="wsurveylistid" value="<?=$rowselect['id']?>">
		<input type="hidden" name="locationno" value="<?=$locationno?>">
		<input type="hidden" name="westimateno" value="<?=$rowselect['westimateno']?>">
		<input type="hidden" name="westimatedate" value="<?=$rowselect['westimatedate']?>">



	
	<div class="accordion" id="accordionExample">
 
  <div class="card">
    <div class="card-header" id="headingTotal">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTotal" aria-expanded="true" aria-controls="collapseTotal">
          Total
        </button>
      </h2>
    </div>

    <div id="collapseTotal" class="collapse" aria-labelledby="headingTotal" data-parent="#accordionExample">
      <div class="card-body">
       

	   <div class="table-responsive">
	<table class="table">
	<tr>
	<th>S.No</th>
	<th>Item Name</th>
	<th style="width:160px;">Qty</th>
	</tr>
	<?php	
$cou=1;	
$itcat='';
$sqlselect1 = "SELECT * From cproducts order by cast(itemcategory as unsigned) asc, cast(orderno as unsigned) asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
while($rowselect1 = mysqli_fetch_array($queryselect1))
{
	$sqlselect2 = "SELECT * From cestimates where wproductid='".$rowselect1['id']."' and wsurveylistid='".$rowselect['id']."' order by id desc";
$queryselect2 = mysqli_query($connection, $sqlselect2);
$rowselect2 = mysqli_fetch_array($queryselect2);
if($itcat!=$rowselect1['itemcategory'])
	{
		?>
		<tr>
		<th colspan="3" style="text-align:center"><?=strtoupper($rowselect1['itemcategory'])?></th>
		</tr>
		<?php
	}
	?>
	<input type="hidden" name="wproductid[]" value="<?=$rowselect1['id']?>">
	<tr>
	<td><?=$cou?></td>
	<td><?=$rowselect1['itemname']?><br><span style="font-style:italic">(<?=$rowselect1['itemcode']?> <?php if($rowselect1['make']!=''){ ?>| Make: <?=$rowselect1['make']?><?php } ?> <?php if($rowselect1['make']!=''){ ?>| Model: <?=$rowselect1['model']?><?php } ?>)</span></td>
	<td>
	<div class="input-group">
  <input type="number" name="qty[]" class="form-control" value="<?=$rowselect2['qty']?>" >
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2"><?=$rowselect1['unit']?></span>
  </div>
</div>
	
	
	</td>
	</tr>
	<?php
	$itcat=$rowselect1['itemcategory'];
	$cou++;
}
		
?>
	</table>
	</div>
	  </div>
	  
    </div>
  </div>
</div>
		<br>
	
	<input type="submit" name="submit" class="btn btn-success" value="Submit">
	</form>
	<?php
					  }
					  else
					  {
						  if($rowselect['compapprove']=='1')
					  {
		?>
		
	<div class="table-responsive">
	<table class="table">
	<tr>
	<th>S.No</th>
	<th>Item Name</th>
	<th>Qty</th>
	<th>Unit</th>
	</tr>
	<?php	
$cou=1;	
$itcat='';
$sqlselect1 = "SELECT * From cproducts order by cast(itemcategory as unsigned) asc, cast(orderno as unsigned) asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
while($rowselect1 = mysqli_fetch_array($queryselect1))
{
	$sqlselect2 = "SELECT * From cestimates1 where wproductid='".$rowselect1['id']."' and wsurveylistid='".$rowselect['id']."' order by id desc";
$queryselect2 = mysqli_query($connection, $sqlselect2);
$rowselect2 = mysqli_fetch_array($queryselect2);
if($itcat!=$rowselect1['itemcategory'])
	{
		?>
		<tr>
		<th colspan="4" style="text-align:center"><?=strtoupper($rowselect1['itemcategory'])?></th>
		</tr>
		<?php
	}

	?>
	<input type="hidden" name="wproductid[]" value="<?=$rowselect1['id']?>">
	<tr>
	<td><?=$cou?></td>
	<td><?=$rowselect1['itemname']?><br><span style="font-style:italic">(<?=$rowselect1['itemcode']?> <?php if($rowselect1['make']!=''){ ?>| Make: <?=$rowselect1['make']?><?php } ?> <?php if($rowselect1['make']!=''){ ?>| Model: <?=$rowselect1['model']?><?php } ?>)</span></td>
	<td><?=$rowselect2['qty']?></td>
	<td><?=$rowselect1['unit']?></td>
	</tr>
	<?php
	$itcat=$rowselect1['itemcategory'];
	$cou++;
}
		
?>
	</table>
	</div>
	
<form action="cestimateupload.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$rowselect['id']?>">



<div style="background-color:#deeafc; padding:20px;">


  <div class="form-group">
    <h5 class="mb-2"><label for="signname">Signatory's Name <span class="text-danger"> *</span></label></h5>
    <input type="text" class="form-control" name="signname" id="signname" value="<?=$rowselect['signname']?>">
  </div>
  <hr>
  <div class="form-group">
    <h5 class="mb-2"><label for="signature">Signature</label></h5>
    <input type="hidden" class="form-control" name="signature" id="signature" value="<?=$rowselect['signature']?>">
	<img id="signatureimg" style="<?=($rowselect['signature']!='')?'display:block':'display:none'?>" src="<?=$rowselect['signature']?>">
	<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#signModal">Get Signature</a>
	<div id="signModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Get Signature</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" class="text-center" align="center">
        <p class="text-center"><div id="signpad" align="center" style="border:1px solid #000000; width:302px; height:202px;">
		<canvas class="pad" id="pad" width="300" height="200" ></canvas>
		</div></p>
      </div>
      <div class="modal-footer">
	  <input type="button" class="btn btn-warning" value="Clear" id="clear" />
			<input type="button" id="btnSaveSign" class="btn btn-success" value="Submit"  data-dismiss="modal"/>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>


    <div class="row mb-1">
     <div class="col-12">
	 <h5 class="mb-2"><label for="customerfeedback">Customer Seal</label></h5>
  <div id="mulitplefileuploaderseal">Capture Seal</div>
<div id="statusseal"></div>
<div id="showDataseal" class="imgsealcontainer"><?php if($rowselect['imgseal']!=''){$as=explode(',',$rowselect['imgseal']);$c=1;foreach($as as $a){echo "<div class='imgsealcontent' id='imgsealcontent_".$c."' ><img src='".$a."' width='100' height='100'><span class='imgsealdelete' id='imgsealdelete_".$c."'>Delete</span></div>";$c++;}}?></div>
<input id="imgseal" type="hidden" name="imgseal" value="<?=$rowselect['imgseal']?>"><br>
</div>
</div>

</div>

<div class="hr1">or</div>
<div style="background-color:#daf7e2; padding:20px;">

<a href="cestimationprint.php?id=<?=$rowselect['id']?>" class="btn btn-primary">Print Unsigned Camera Estimation</a>
<hr>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<?php
if($rowselect['signeddoc']!='')
{
	?>
	<h3 class="text-success">Document Submitted</h3>
	<a href="<?=$rowselect['signeddoc']?>" class="btn btn-primary">Click Here to View Signed Document</a><br>
	<?php
}
?>

<label class="control-label">(or) Re-Upload Signed Document</label>
<input type="hidden" name="signeddoc" value="<?=$rowselect['signeddoc']?>">
<input type="file" name="uploadedfile" id="uploadedfile" accept=".pdf" class="form-control" style="padding:10px; height:auto" />

</div>
</div>
</div>
</div>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</form>

	<?php		
					  }
						else if($rowselect['contapprove']=='1')
					  {
		?>
		
	<div class="table-responsive">
	<table class="table">
	<tr>
	<th>S.No</th>
	<th>Item Name</th>
	<th>Qty</th>
	<th>Unit</th>
	</tr>
	<?php	
$cou=1;	
$itcat='';
$sqlselect1 = "SELECT * From cproducts order by cast(itemcategory as unsigned) asc, cast(orderno as unsigned) asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
while($rowselect1 = mysqli_fetch_array($queryselect1))
{
	$sqlselect2 = "SELECT * From cestimates where wproductid='".$rowselect1['id']."' and wsurveylistid='".$rowselect['id']."' order by id desc";
$queryselect2 = mysqli_query($connection, $sqlselect2);
$rowselect2 = mysqli_fetch_array($queryselect2);
if($itcat!=$rowselect1['itemcategory'])
	{
		?>
		<tr>
		<th colspan="4" style="text-align:center"><?=strtoupper($rowselect1['itemcategory'])?></th>
		</tr>
		<?php
	}
	?>
	<input type="hidden" name="wproductid[]" value="<?=$rowselect1['id']?>">
	<tr>
	<td><?=$cou?></td>
	<td><?=$rowselect1['itemname']?><br><span style="font-style:italic">(<?=$rowselect1['itemcode']?> <?php if($rowselect1['make']!=''){ ?>| Make: <?=$rowselect1['make']?><?php } ?> <?php if($rowselect1['make']!=''){ ?>| Model: <?=$rowselect1['model']?><?php } ?>)</span></td>
	<td><?=$rowselect2['qty']?></td>
	<td><?=$rowselect1['unit']?></td>
	</tr>
	<?php
	$itcat=$rowselect1['itemcategory'];
	$cou++;
}
		
?>
	</table>
	</div>
	<a href="cestimationprint1.php?id=<?=$rowselect['id']?>" class="btn btn-primary">Click here to Print</a>
	<?php		
					  }
					  else
					  {
		?>
		<!-- Button to open Add Location modal -->
        <!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLocationModal">
            Add Location
        </button-->

        <!-- Modal for Add Location -->
        <div class="modal fade" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="addLocationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLocationModalLabel">Add Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add Location Form -->
                        <form id="addLocationForm">
                            <!-- Hidden input fields for wsurveylistid and wsurveyid -->
                            <input type="hidden" name="wsurveylistid" value="<?=$wsurveylistid?>">
                            <input type="hidden" name="wsurveyid" value="<?=$wsurveyid?>">

                            <div class="form-group">
                                <label for="location">Location Name:</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Location</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Display locations -->
        <div id="locationsList">
            <!-- Locations will be populated dynamically with AJAX -->
        </div>
		
		<?php
		if(isset($_GET['locationno']))
		{
			$locationno=mysqli_real_escape_string($connection, $_GET['locationno']);
	// Replace with your database connection
    require_once "lcheck.php";

    // Fetch location details based on locationno
    $query = "SELECT * FROM clocation_table WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $locationno);
    $stmt->execute();
    $location = $stmt->get_result()->fetch_assoc();

    if ($location) {
		echo "<hr>";
        echo "<h4 class='text-primary'>Location Details: {$location['location_name']}</h4>";
        echo "<p>Complete Status: {$location['complete_status']}</p>";
        echo "<p>Completed On: {$location['completed_on']}</p>";
        // Display other location details as needed
    } else {
        echo "Location not found.";
    }

    $stmt->close();
		?>
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <input type="hidden" name="wsurveyid" value="<?=$wsurveyid?>">
                    <input type="hidden" name="wsurveylistid" value="<?=$wsurveylistid?>">
                    <input type="hidden" name="locationno" value="<?=$locationno?>">
                    <label for="itemcategory">Select Item Category:</label>
                    <select id="itemcategory" class="form-control">
                        <option value="">Select Item Category</option>
                    </select>
					<div class="form-group">
					<label class="form-label">No of Quatity in this Item Category</label>
					<input type="number" name="itemcategoryqty" id="itemcategoryqty" class="form-control" min="1" required>
					</div>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody">
                            <!-- Item names and quantity inputs will be dynamically loaded here -->
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addProductBtn">Add Product</button>
            </div>
        </div>
    </div>
</div>

<p class="text-right"><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#addProductModal'>Add Product</button><br></p>
<!-- ... Your existing code ... -->
<div class="accordion" id="productAccordion">
<?php
// Fetch and display products based on item category
$query = "SELECT DISTINCT itemcategory, itemcategoryqty FROM cestimatesloc WHERE wsurveyid = ? AND wsurveylistid = ? AND locationno = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("iii", $wsurveyid, $wsurveylistid, $locationno);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $itemcategory = $row['itemcategory'];
    $itemcategoryqty = $row['itemcategoryqty'];
    $sanitizedItemCategory = preg_replace("/[^a-zA-Z0-9]+/", "_", $itemcategory); // Sanitize for use in IDs

    // Fetch the number of rows for the current item category
    $rowCountQuery = "SELECT COUNT(*) AS num_rows FROM cestimatesloc WHERE wsurveyid = ? AND wsurveylistid = ? AND locationno = ? AND itemcategory = ?";
    $rowCountStmt = $connection->prepare($rowCountQuery);
    $rowCountStmt->bind_param("iiis", $wsurveyid, $wsurveylistid, $locationno, $itemcategory);
    $rowCountStmt->execute();
    $rowCountResult = $rowCountStmt->get_result();
    $rowCountRow = $rowCountResult->fetch_assoc();
    $numRows = $rowCountRow['num_rows'];

    echo '<div class="card">';
    echo '<div class="card-header" id="heading' . $sanitizedItemCategory . '">';
    echo '<h5 class="mb-0">';
    echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' . $sanitizedItemCategory . '" aria-expanded="true" aria-controls="collapse' . $sanitizedItemCategory . '">';
    echo $itemcategory . ' (' . $itemcategoryqty . ') <span class="badge badge-secondary">' . $numRows . '</span>'; // Add badge with itemcategoryqty and number of rows
    echo '</button>';
    echo '</h5>';
    echo '</div>';

    echo '<div id="collapse' . $sanitizedItemCategory . '" class="collapse" aria-labelledby="heading' . $sanitizedItemCategory . '" data-parent="#productAccordion">';
    echo '<div class="card-body">';

    // Fetch and display product details for the current item category with non-zero quantity
    $productQuery = "SELECT wp.itemcode, wp.itemname, wsl.quantity FROM cestimatesloc wsl
                    JOIN cproducts wp ON wsl.itemid = wp.id
                    WHERE wsl.wsurveyid = ? AND wsl.wsurveylistid = ? AND wsl.locationno = ? AND wsl.itemcategory = ? AND wsl.quantity > 0";
    $productStmt = $connection->prepare($productQuery);
    $productStmt->bind_param("iiis", $wsurveyid, $wsurveylistid, $locationno, $itemcategory);
    $productStmt->execute();
    $productResult = $productStmt->get_result();

    if ($productResult->num_rows > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>Item Code</th><th>Item Name</th><th>Quantity</th></tr></thead>';
        echo '<tbody>';
        while ($productRow = $productResult->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $productRow['itemcode'] . '</td>';
            echo '<td>' . $productRow['itemname'] . '</td>';
            echo '<td>' . $productRow['quantity'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
		// Close the product statement
$productStmt->close();
    } else {
        echo 'No products found.';
    }

    echo '</div>';
    echo '</div>';
    echo '</div>';
	// Close the main statement

}




?>

</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <input type="hidden" name="wsurveyid" value="<?=$wsurveyid?>">
                    <input type="hidden" name="wsurveylistid" value="<?=$wsurveylistid?>">
                    <input type="hidden" name="locationno" value="<?=$locationno?>">

                    <label for="itemcategory">Select Item Category:</label>
                    <select id="itemcategory" class="form-control">
                        <option value="">Select Item Category</option>
                    </select>
					<div class="form-group">
					<label class="form-label">No of Quatity in this Item Category</label>
					<input type="number" name="itemcategoryqty" id="itemcategoryqty" class="form-control" min="1" required>
					</div>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody">
                            <!-- Item names and quantity inputs will be dynamically loaded here -->
                        </tbody>
                    </table>
	
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editProductBtn" onclick="updatepro()">Edit Product</button>
            </div>
        </div>
    </div>
</div>



	<?php		
		}
		?>
		<br>
<h5>Consolidated Quantity</h5>
<br>
<!-- ... Your existing code ... -->

		<form method="post" action="cestimationadds.php">
		<input type="hidden" name="wsurveyid" value="<?=$rowselect['wsurveyid']?>">
		<input type="hidden" name="wsurveylistid" value="<?=$rowselect['id']?>">
		<input type="hidden" name="locationno" value="<?=$locationno?>">
		<input type="hidden" name="westimateno" value="<?=$rowselect['westimateno']?>">
		<input type="hidden" name="westimatedate" value="<?=$rowselect['westimatedate']?>">



	
	<div class="accordion" id="accordionExample">
 
  <div class="card">
    <div class="card-header" id="headingTotal">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTotal" aria-expanded="true" aria-controls="collapseTotal">
          Total
        </button>
      </h2>
    </div>

    <div id="collapseTotal" class="collapse" aria-labelledby="headingTotal" data-parent="#accordionExample">
      <div class="card-body">
       

	   <div class="table-responsive">
	<table class="table">
	<tr>
	<th>S.No</th>
	<th>Item Name</th>
	<th style="width:160px;">Qty</th>
	</tr>
	<?php	
$cou=1;	
$itcat='';
$sqlselect1 = "SELECT * From cproducts order by cast(itemcategory as unsigned) asc, cast(orderno as unsigned) asc";
$queryselect1 = mysqli_query($connection, $sqlselect1);
while($rowselect1 = mysqli_fetch_array($queryselect1))
{
	$sqlselect2 = "SELECT * From cestimates where wproductid='".$rowselect1['id']."' and wsurveylistid='".$rowselect['id']."' order by id desc";
$queryselect2 = mysqli_query($connection, $sqlselect2);
$rowselect2 = mysqli_fetch_array($queryselect2);
if($itcat!=$rowselect1['itemcategory'])
	{
		?>
		<tr>
		<th colspan="3" style="text-align:center"><?=strtoupper($rowselect1['itemcategory'])?></th>
		</tr>
		<?php
	}
	?>
	<input type="hidden" name="wproductid[]" value="<?=$rowselect1['id']?>">
	<tr>
	<td><?=$cou?></td>
	<td><?=$rowselect1['itemname']?><br><span style="font-style:italic">(<?=$rowselect1['itemcode']?> <?php if($rowselect1['make']!=''){ ?>| Make: <?=$rowselect1['make']?><?php } ?> <?php if($rowselect1['make']!=''){ ?>| Model: <?=$rowselect1['model']?><?php } ?>)</span></td>
	<td>
	<div class="input-group">
  <input type="number" name="qty[]" class="form-control" value="<?=$rowselect2['qty']?>" >
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2"><?=$rowselect1['unit']?></span>
  </div>
</div>
	
	
	</td>
	</tr>
	<?php
	$itcat=$rowselect1['itemcategory'];
	$cou++;
}
		
?>
	</table>
	</div>
	  </div>
	  
    </div>
  </div>
</div>
		<br>
	
	<input type="submit" name="submit" class="btn btn-success" value="Submit">
	</form>
	<?php
					  }				 
					 } ?>
											</div>
                                    </div>
                                </div>
					<?php
					$count++;
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
  <script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
  <script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
  <script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>
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
 // Remove file
                $('.imgcontainer').on('click','.imgcontent .imgdelete',function(){
                    
                    var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];

                     // Get image source
                    var imgElement_src = $( '#imgcontent_'+num+' img' ).attr("src");
                     
                    var deleteFile = confirm("Do you really want to Delete?");
                    if (deleteFile == true) {
						var vals=$("#imgbefuploads").val();
						let newStr = vals.replace(imgElement_src+',', '');
						newStr = newStr.replace(','+imgElement_src, '');
						newStr = newStr.replace(imgElement_src, '');
						$("#imgbefuploads").val(newStr);	
						$('#imgcontent_'+num).remove();
                        // AJAX request
                        /* $.ajax({
                           url: 'complaintrems.php',
                           type: 'post',
                           data: {path: imgElement_src,request: 2},
                           success: function(response){
                                if(response == 1){
                                    $('#imgcontent_'+num).remove();
                                }

                           }
                        }); */
                    }
                });
				</script>
	<script>
	
	$(document).on('change','#serialnumber',function(){

var rr = $('#serialnumber :selected').length;
$('#quantity').val(rr);
     console.log(rr);
});

</script>
<script>
function valuefun()
{
	var priceperyear = document.getElementById("priceperyear").value;
	var noofmonths = document.getElementById("noofmonths").value;
	if(priceperyear!="" && noofmonths!="")
	{
	document.getElementById("resultvalue").value =((parseFloat(priceperyear)/12)*parseFloat(noofmonths));
	}
	else
	{
		document.getElementById("resultvalue").value =(parseFloat(priceperyear));
	}
	
	qtyfun();
}
 </script>	
<script>
function gstfun()
{
	var resultvalue = document.getElementById("resultvalue").value;
	var amcgst = document.getElementById("amcgst").value;
	document.getElementById("amcgstvalue").value =((parseFloat(resultvalue)/100)*parseFloat(amcgst));
	netfun();
}
</script>
<script>
function qtyfun()
{
	var quantity = document.getElementById("quantity").value;
	var resultvalue = document.getElementById("resultvalue").value;
	document.getElementById("resultvalue").value =(parseFloat(quantity)*parseFloat(resultvalue));
	gstfun();
}
</script>
<script>
function netfun()
{
	var amcgstvalue = document.getElementById("amcgstvalue").value;
	var resultvalue = document.getElementById("resultvalue").value;
	document.getElementById("totalvalue").value =(parseFloat(resultvalue)+parseFloat(amcgstvalue));
	
}
</script>
	
<script>
  $(document).ready(function() {
    $('.fav_clr').select2({
width: '100%',
  allowClear: true,
  placeholder: ''
    });
});
  $('.fav_clr').on("select2:select", function (e) { 
           var data = e.params.data.text;
           if(data=='all'){
            $(".fav_clr > option").prop("selected","selected");
            $(".fav_clr").trigger("change");
           }
      });
</script>	
<script>
function add_months(dt, n) 
 {
   return new Date(dt.setMonth(dt.getMonth() + n));      
 }
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
} 
 function monthupdate()
 {
	 var noofmonths=document.getElementById("noofmonths");
	 var datefrom=document.getElementById("datefrom");
	 var dateto=document.getElementById("dateto");
	 if((noofmonths.value!="")&&(datefrom.value!=""))
	 {
		 var str=datefrom.value;
		 console.log(str);
		 var res = str.split("-");
		 var dt = new Date(res[0],res[1],res[2]);
		 dt=add_months(dt, parseInt(noofmonths.value)-1);
		 dt.setDate(dt.getDate() - 1);		 
		 dateto.value=formatDate(dt.toString());
	 }
	 
 }
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
  (function(window) {
    var $canvas,
        onResize = function(event) {
          $canvas.attr({
          });
        };
    $(document).ready(function() {
		//phasechange();
      $canvas = $('canvas');
      window.addEventListener('orientationchange', onResize, false);
      window.addEventListener('resize', onResize, false);
      onResize();
	  $('#clear').click(function() {
  $('#signpad').signaturePad().clearCanvas();
});
      $('#signpad').signaturePad({
        drawOnly: true,
        defaultAction: 'drawIt',
        validateFields: false,
        lineWidth: 0,
        output :'.output',
        sigNav: null,
        name: null,
        typed: null,
        clear: '#clear',
        typeIt: null,
        drawIt: null,
        typeItDesc: null,
        drawItDesc: null
      });
	  $("#btnSaveSign").click(function(e){
			html2canvas([document.getElementById('pad')], {
				onrendered: function (canvas) {
					var canvas_img_data = canvas.toDataURL('image/png');
					var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					//ajax call to save image inside folder
					$.ajax({
						url: 'save_sign.php',
						data: { img_data:img_data },
						type: 'post',
						success: function (response) {
							//console.log(response);
						    $("#signatureimg").attr("src",response);
							$("#signatureimg").show();
						   $("#signature").val(response);
						   $("#signname").focus();
						   forceDownload(response);
						}
					});
				}, 
				backgroundColor: null, 
			});
		});
    });
  }(this));
  </script>
<script>
function image(thisImg) {
    // var img = document.createElement("IMG");
    // img.src = thisImg;
	// img.className="img-fluid";
    // document.getElementById('showData').appendChild(img);
	var count = $('.imgcontainer .imgcontent').length;
	count = Number(count) + 1;
	$('.imgcontainer').append("<div class='imgcontent' id='imgcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgdelete' id='imgdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
    url: "complaintups.php",
    method: "POST",
    allowedTypes:"jpg,png,jpeg",
    fileName: "myfile",
    multiple: true,
	maxFileCount:5,
    onSuccess:function(files,data,xhr)
    {
		var obj = JSON.parse(data);
		console.log(obj.imglist);
		image(obj.imglist);
		var vals=$("#imguploads").val();
		if(vals!='')
		{
		$("#imguploads").val(vals+','+obj.imglist);
		}
		else
		{
		$("#imguploads").val(obj.imglist);	
		}
		$("#status").html("<font color='green'>Upload is success</font>");
    },
    onError: function(files,status,errMsg)
    {       
        $("#status").html("<font color='red'>Upload is Failed</font>"+errMsg);
    }
}
$("#mulitplefileuploader").uploadFile(settings);
});
</script>
<script>
function imageseal(thisImg) {
    // var img = document.createElement("IMG");
    // img.src = thisImg;
	// img.className="img-fluid";
    // document.getElementById('showData').appendChild(img);
	var count = $('.imgsealcontainer .imgsealcontent').length;
	count = Number(count) + 1;
	$('.imgsealcontainer').append("<div class='imgsealcontent' id='imgsealcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgsealdelete' id='imgsealdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
    url: "complaintups.php",
    method: "POST",
    allowedTypes:"jpg,png,jpeg",
    fileName: "myfile",
    multiple: true,
	maxFileCount:1,
    onSuccess:function(files,data,xhr)
    {
		var obj = JSON.parse(data);
		console.log(obj.imglist);
		imageseal(obj.imglist);
		var vals=$("#imgseal").val();
		if(vals!='')
		{
		$("#imgseal").val(vals+','+obj.imglist);
		}
		else
		{
		$("#imgseal").val(obj.imglist);	
		}
		$("#statusseal").html("<font color='green'>Upload is success</font>");
    },
    onError: function(files,statusseal,errMsg)
    {       
        $("#statusseal").html("<font color='red'>Upload is Failed</font>"+errMsg);
    }
}
$("#mulitplefileuploaderseal").uploadFile(settings);
});
</script>
<script>
function imagemanual(thisImg) {
    // var img = document.createElement("IMG");
    // img.src = thisImg;
	// img.className="img-fluid";
    // document.getElementById('showData').appendChild(img);
	var count = $('.imgmanualcontainer .imgmanualcontent').length;
	count = Number(count) + 1;
	$('.imgmanualcontainer').append("<div class='imgmanualcontent' id='imgmanualcontent_"+count+"' ><img src='"+thisImg+"' width='100' height='100'><span class='imgmanualdelete' id='imgmanualdelete_"+count+"'>Delete</span></div>");
}
$(document).ready(function()
{
var settings = {
    url: "complaintups.php",
    method: "POST",
    allowedTypes:"jpg,png,jpeg",
    fileName: "myfile",
    multiple: true,
	maxFileCount:1,
    onSuccess:function(files,data,xhr)
    {
		var obj = JSON.parse(data);
		console.log(obj.imglist);
		imagemanual(obj.imglist);
		var vals=$("#imgmanual").val();
		if(vals!='')
		{
		$("#imgmanual").val(vals+','+obj.imglist);
		}
		else
		{
		$("#imgmanual").val(obj.imglist);	
		}
		$("#statusmanual").html("<font color='green'>Upload is success</font>");
    },
    onError: function(files,statusmanual,errMsg)
    {       
        $("#statusmanual").html("<font color='red'>Upload is Failed</font>"+errMsg);
    }
}
$("#mulitplefileuploadermanual").uploadFile(settings);
});
</script>

<script>
 // Remove file
                $('.imgcontainer').on('click','.imgcontent .imgdelete',function(){
                    var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];
                     // Get image source
                    var imgElement_src = $( '#imgcontent_'+num+' img' ).attr("src");
                    var deleteFile = confirm("Do you really want to Delete?");
                    if (deleteFile == true) {
						var vals=$("#imguploads").val();
						let newStr = vals.replace(imgElement_src+',', '');
						newStr = newStr.replace(','+imgElement_src, '');
						newStr = newStr.replace(imgElement_src, '');
						$("#imguploads").val(newStr);	
						$('#imgcontent_'+num).remove();
                        // AJAX request
                        /* $.ajax({
                           url: 'complaintrems.php',
                           type: 'post',
                           data: {path: imgElement_src,request: 2},
                           success: function(response){
                                if(response == 1){
                                    $('#imgcontent_'+num).remove();
                                }
                           }
                        }); */
                    }
                });
				</script>
<script>
 // Remove file
                $('.imgsealcontainer').on('click','.imgsealcontent .imgsealdelete',function(){
                    var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];
                     // Get image source
                    var imgElement_src = $( '#imgsealcontent_'+num+' img' ).attr("src");
                    var deleteFile = confirm("Do you really want to Delete?");
                    if (deleteFile == true) {
						var vals=$("#imgseal").val();
						let newStr = vals.replace(imgElement_src+',', '');
						newStr = newStr.replace(','+imgElement_src, '');
						newStr = newStr.replace(imgElement_src, '');
						$("#imgseal").val(newStr);	
						$('#imgsealcontent_'+num).remove();
                        // AJAX request
                        /* $.ajax({
                           url: 'complaintrems.php',
                           type: 'post',
                           data: {path: imgElement_src,request: 2},
                           success: function(response){
                                if(response == 1){
                                    $('#imgcontent_'+num).remove();
                                }
                           }
                        }); */
                    }
                });
				</script>
				<script>
 // Remove file
                $('.imgmanualcontainer').on('click','.imgmanualcontent .imgmanualdelete',function(){
                    var id = this.id;
                    var split_id = id.split('_');
                    var num = split_id[1];
                     // Get image source
                    var imgElement_src = $( '#imgmanualcontent_'+num+' img' ).attr("src");
                    var deleteFile = confirm("Do you really want to Delete?");
                    if (deleteFile == true) {
						var vals=$("#imgmanual").val();
						let newStr = vals.replace(imgElement_src+',', '');
						newStr = newStr.replace(','+imgElement_src, '');
						newStr = newStr.replace(imgElement_src, '');
						$("#imgmanual").val(newStr);	
						$('#imgmanualcontent_'+num).remove();
                        // AJAX request
                        /* $.ajax({
                           url: 'complaintrems.php',
                           type: 'post',
                           data: {path: imgElement_src,request: 2},
                           success: function(response){
                                if(response == 1){
                                    $('#imgcontent_'+num).remove();
                                }
                           }
                        }); */
                    }
                });
				</script>

<script>
        $(document).ready(function() {
            // Load locations initially
            loadLocations();

            // Load locations when a new location is added
            $("#addLocationForm").submit(function(e) {
                e.preventDefault(); // Prevent form submission

                // Use AJAX to submit the form
                $.ajax({
                    url: "cprocess_location_ajax.php",
                    type: "POST",
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        // Clear form fields
                        $("#location").val("");
                        // Reload locations
                        loadLocations();
                        // Close the modal
                        $("#addLocationModal").modal("hide");
                    }
                });
            });

            // Function to load locations
			function loadLocations() {
				var surveylistid = '<?=$wsurveylistid?>'; // Get surveylistid from somewhere
				var surveyid = '<?=$wsurveyid?>';     // Get surveyid from somewhere
				
				$.get("cget_locations.php", { surveylistid: surveylistid, surveyid: surveyid }, function(data) {
					$("#locationsList").html(data);
				});
			}
        });
    </script>
	<script>
	$(document).ready(function() {
   $('#addProductModal').on('show.bs.modal', function () {
        loadItemCategories();
    });
	
	function loadItemCategories() {
        $.get("cget_item_categories.php", function(data) {
            var itemCategorySelect = $("#itemcategory");
            itemCategorySelect.empty();
            itemCategorySelect.append($("<option>").attr("value", "").text("Select Item Category"));
            
            // Parse the JSON response
            try {
                var categories = JSON.parse(data);
                $.each(categories, function(index, category) {
                    itemCategorySelect.append($("<option>").attr("value", category).text(category));
                });
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        });
    }

   // Load item names based on selected item category in modal
   $("#itemcategory").change(function() {
    var selectedCategory = $(this).val();

    $.get("cget_item_names.php", { itemcategory: selectedCategory }, function(data) {
        var itemTableBody = $("#itemTableBody");
        itemTableBody.empty();

        // Parse the JSON response
        try {
            var items = JSON.parse(data);

            if (Array.isArray(items)) {
                $.each(items, function(index, item) {
                    var newRow = $("<tr>");
                    var itemInfo = item.itemname + "<br><b>(" + item.itemcode + ")</b>";
                    newRow.append($("<td>").html(itemInfo)); // Use .html() to include HTML formatting
                    newRow.append($("<td>").append($("<input>").attr({
                        type: "number",
                        name: "itemid_quantity[" + item.itemid + "]",
                        placeholder: "Quantity",
                        required: true
                    }))); // Use itemid_quantity
                    itemTableBody.append(newRow);
                });
            } else {
                console.error("Invalid JSON response:", items);
            }
        } catch (error) {
            console.error("Error parsing JSON:", error);
        }
    });
});



    // ... Existing code ...
	
	
	// Submit form via AJAX
    $("#addProductBtn").click(function() {
        var wsurveyid = $("input[name='wsurveyid']").val();
        var wsurveylistid = $("input[name='wsurveylistid']").val();
        var locationno = $("input[name='locationno']").val();
		var itemcategory = $("#itemcategory").val();
		var itemcategoryqty = $("#itemcategoryqty").val();
		if(itemcategoryqty!='')
		{

        var formData = $("#productForm").serializeArray();
        formData.push({ name: "wsurveyid", value: wsurveyid });
        formData.push({ name: "wsurveylistid", value: wsurveylistid });
        formData.push({ name: "itemcategory", value: itemcategory });
        formData.push({ name: "itemcategoryqty", value: itemcategoryqty });

        $.ajax({
            url: "cprocess_product_modal.php",
            type: "POST",
            data: formData,
            success: function(response) {
				console.log(response);
                // Handle success response
                // You can display a message or refresh the page as needed
				loadAccordionContent();
				location.reload();
            }
        });

        // Close the modal
        $("#addProductModal").modal("hide");
		}
		else
		{
			alert('Please Enter the Quantity');
			$("#itemcategoryqty").focus();
		}
    });
	
	// Function to load accordion content
    function loadAccordionContent() {
        var accordion = $("#productAccordion");
        var wsurveyid = $("input[name='wsurveyid']").val();
        var wsurveylistid = $("input[name='wsurveylistid']").val();
        var locationno = $("input[name='locationno']").val();

        $.get("cget_accordion_content.php", { wsurveyid: wsurveyid, wsurveylistid: wsurveylistid, locationno: locationno }, function(data) {
            accordion.html(data);
			
        });
    }

    // Load initial accordion content
    loadAccordionContent();
	
	
	
});
function geteditinfo(elem)
	{
        var itemcategory = $(elem).data("id");
        var wsurveyid = $("input[name='wsurveyid']").val();
        var wsurveylistid = $("input[name='wsurveylistid']").val();
        var locationno = $("input[name='locationno']").val();
        // Fetch the item's data using AJAX
        $.ajax({
            url: "edit_cestimatesloc.php",
            type: "GET",
            data: { itemcategory: itemcategory, wsurveyid:wsurveyid, wsurveylistid:wsurveylistid, locationno:locationno },
            success: function(response) {
                // Populate the modal with the retrieved data
                $("#editProductModal .modal-body").html(response);
				$('#editProductModal').modal('show'); 
            }
        });
		
		
	}
	
   // Load item names based on selected item category in modal
function getedititemcategory(elem)
{
    var selectedCategory = $(elem).val();

    $.get("cget_item_names.php", { itemcategory: selectedCategory }, function(data) {
        var itemTableBody = $("#edititemTableBody");
        itemTableBody.empty();

        // Parse the JSON response
        try {
            var items = JSON.parse(data);

            if (Array.isArray(items)) {
                $.each(items, function(index, item) {
                    var newRow = $("<tr>");
                    var itemInfo = item.itemname + "<br><b>(" + item.itemcode + ")</b>";
                    newRow.append($("<td>").html(itemInfo)); // Use .html() to include HTML formatting
                    newRow.append($("<td>").append($("<input>").attr({
                        type: "number",
                        name: "edititemid_quantity[" + item.itemid + "]",
                        placeholder: "Quantity",
                        required: true
                    }))); // Use itemid_quantity
                    itemTableBody.append(newRow);
                });
            } else {
                console.error("Invalid JSON response:", items);
            }
        } catch (error) {
            console.error("Error parsing JSON:", error);
        }
    });
}
function updatepro()
{
	var formData = $("#editProductForm").serialize();
	    $.ajax({
            type: "POST",
            url: "cupdate_edited_quantities.php", // Replace with the actual PHP script to update quantities
            data: formData,
            success: function (response) {
                // Handle success, e.g., show a success message or refresh the page
				alert("Quantities updated successfully!");
                location.reload(); // Refresh the page after successful update */
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., display an error message
                alert("Error updating quantities: " + error);
            }
        }); 
}
</script>
</body>

</html>
