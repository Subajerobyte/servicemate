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

  <title>Jerobyte - Call Details</title>

  
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
            <h1 class="h4 mb-2 mt-2 text-gray-800">Call Details</h1>
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
 <div class="row" id="myItems">
 
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
						$bgtext="Open";
					  }
					  ?>
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
											
										
											<form action="" method="GET">
											<input type="hidden" name="id" value="<?=$_GET['id']?>">
											<div class="row">
 											<div class="col-lg-12">
											<div class="form-group">
											<label>No of Products</label>
											<input type = "number" class="form-control" id="noofproducts" name = "noofproducts" min="1" required/>
											</div>
											</div>
											</div>
											
											<div class="row">
											<div class="col-lg-12">
											<div><input type="submit" class="btn btn-primary" onclick="showHide()"value="Submit"></div>
											</div>
											</div>
											</form>
									

											
										<?php
										if(isset($_GET['noofproducts']))
										{
											
										
											
										?><br/><br/>
											<form action="quotationadd.php" method="POST">
											<input type="hidden" name="engineerid" value="<?=$engineerid?>">
											<input type="hidden" name="noofproducts" value="<?=$_GET['noofproducts']?>">
											<input type="hidden" name="consigneeid" value="<?=$rowselect['consigneeid']?>">
											<input type="hidden" name="sourceid" value="<?=$rowselect['sourceid']?>">
											<input type="hidden" name="calltid" value="<?=$rowselect['calltid']?>">
											
											
											<div class="row">
											<div class="col-lg-12">
											 <div class="form-group">
    <label for="quotationtype">Quotation Type</label>
    <select class="form-control" name="quotationtype" id="quotationtype" onchange="qtypechange()" required>
	<option value="">Select</option>
	<?php
				  $sqlselect = "SELECT quotationtype From jrcquotationtype order by quotationtype asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowprotype = mysqli_fetch_array($queryselect)) 
			{
			?>
			
			<option value="<?=$rowprotype['quotationtype']?>"><?=$rowprotype['quotationtype']?></option>
			<?php
					$count++;
			}
		}
			?>
	</select>
  </div>
  </div>
  </div>
				<br/><br/>							
											
											
											<?php
											for($i=1;$i<=(float)$_GET['noofproducts'];$i++){
											?>
											
										<h5 class="mb-2">Product <?=$i?></h5>	
										
											
  
  
  <div class="row">
  <div class="col-lg-12">
  <div class="form-group">
    <label for="protype">Product Type</label>
    <select class="fav_clr form-control" id="protype<?=$i?>" name="protype<?=$i?>"  onchange="prolistchange<?=$i?>()" required >

	 <?php
		$sqlprotype = "SELECT distinct protype From jrcsaleproduct where tdelete='0' order by protype asc";
				  
        $queryprotype = mysqli_query($connection, $sqlprotype);
        $rowCountprotype = mysqli_num_rows($queryprotype);
         
        if(!$queryprotype){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountprotype > 0) 
		{
			$count=1;
			while($rowprotype = mysqli_fetch_array($queryprotype)) 
			{
			?>
			<option value="<?=$rowprotype['protype']?>"><?=$rowprotype['protype']?></option>
			<?php
			$count++;
			}
			
		}
			?>
	</select>
  </div>
</div>
</div>



<div class="row">
<div class="col-lg-12">
  <div class="form-group">
    <label for="productname">Product Name</label>
    <select class="fav_clr form-control" id="productname<?=$i?>" name="productname<?=$i?>" onchange="productchange<?=$i?>()" required>

	 <?php
		$sqlprotype = "SELECT distinct productname From jrcsaleproduct where tdelete='0' order by productname asc";
				  
        $queryprotype = mysqli_query($connection, $sqlprotype);
        $rowCountprotype = mysqli_num_rows($queryprotype);
         
        if(!$queryprotype){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountprotype > 0) 
		{
			$count=1;
			while($rowprotype = mysqli_fetch_array($queryprotype)) 
			{
			?>
			<option value="<?=$rowprotype['productname']?>"><?=$rowprotype['productname']?></option>
			<?php
			$count++;
			}
			
		}
			?>
	</select>
  </div>
</div>
</div>


<div class="row">
<div class="col-lg-12">
<div class="form-group">
<div id="response<?=$i?>">
</div>
</div>
</div>
</div>


		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>No of Quantity</label>
		<input type = "number" class="form-control" id="noofqtyval<?=$i?>" name = "noofqtyval<?=$i?>" onchange="getresult<?=$i?>()" min="0" required />
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Total Value</label>
		<input type = "number" class="form-control" id="totalvalue<?=$i?>" name = "totalvalue<?=$i?>" min="0" readonly required />
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>GST Value</label>
		<input type = "number" class="form-control" id="gstvalue<?=$i?>" name = "gstvalue<?=$i?>" min="0" readonly required/>
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Net Value</label>
		<input type = "number" class="form-control" id="netvalue<?=$i?>" name = "netvalue<?=$i?>" min="0" readonly required/>
		</div>
		</div>
		</div>
		
		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Total Installation Value</label>
		<input type = "number" class="form-control" id="insttotalvalue<?=$i?>" name = "insttotalvalue<?=$i?>" min="0" readonly required/>
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Installation GST Value</label>
		<input type = "number" class="form-control" id="instgstvalue<?=$i?>" name = "instgstvalue<?=$i?>" min="0" readonly required/>
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Installation Net Value</label>
		<input type = "number" class="form-control" id="instnetvalue<?=$i?>" name = "instnetvalue<?=$i?>" min="0" readonly required/>
		</div>
		</div>
		</div>
		
<div class="row">
<div class="col-lg-12">
  <div class="form-group">
    <label for="scrapproductname">Scrap Product Name</label>
    <select class="fav_clr form-control" id="scrapproductname<?=$i?>" name="scrapproductname<?=$i?>" onchange="scrapproductchange<?=$i?>()" required >

	 <?php
		$sqlprotype = "SELECT distinct productname From jrcsaleproduct where tdelete='0' order by productname asc";
				  
        $queryprotype = mysqli_query($connection, $sqlprotype);
        $rowCountprotype = mysqli_num_rows($queryprotype);
         
        if(!$queryprotype){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountprotype > 0) 
		{
			$count=1;
			while($rowprotype = mysqli_fetch_array($queryprotype)) 
			{
			?>
			<option value="<?=$rowprotype['productname']?>"><?=$rowprotype['productname']?></option>
			<?php
			$count++;
			}
			
		}
			?>
	</select>
  </div>
</div>
</div>


<div class="row">
<div class="col-lg-12">
<div class="form-group">
<div id="responseg<?=$i?>"></div>
</div>
</div>
</div>

		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>No of Scrap Quantity</label>
		<input type = "number" class="form-control" id="noofscrapqty<?=$i?>" name ="noofscrapqty<?=$i?>" onchange="getscrapresult<?=$i?>()" required />
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Total Scrap Value</label>
		<input type = "number" class="form-control" id="totalscrapvalue<?=$i?>" name = "totalscrapvalue<?=$i?>" readonly required/>
		</div>
		</div>
		</div>

		
		<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Grand Total</label>
		<input type = "number" class="form-control" id="grandtotal<?=$i?>" name = "grandtotal<?=$i?>" readonly required/>
		</div>
		</div>
		</div>



  
  

<?php
}
?>


<div class="row">
		<div class="col-lg-12">
		<div class="form-group">
		<label>Total Quotation Value</label>
		<input type = "number" class="form-control" id="totalquotationvalue" name ="totalquotationvalue" readonly required/>
		</div>
		</div>
		</div>

<div class="row">
  <div class="col-lg-12">
  <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
  </div>
  </div>
</form>
										
										<?php
										}
										?>
											
                                        </div>
                                    </div>
                                </div>		
					<?php
					$count++;
			}
		}
 }		
					?>
			
			
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
  <script type='text/javascript' src="../../1637028036/vendor/sign/html2canvas.js"></script>
  <script src="../../1637028036/vendor/sign/jquery.signaturepad.js"></script>
  
  <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
 
  <script src="../../1637028036/vendor/jquery-upload/jquery-file-upload.js"></script>
  
  
  <script>
    function qtypechange()
  {
	  var selectedquotationtype = $("#quotationtype option:selected").val();
	  <?php
		for($i=1;$i<=(float)$_GET['noofproducts'];$i++)
		{
			?>
            $.ajax({
                type: "POST",
                url: "quotation_process.php",
                data: {  quotationtype : selectedquotationtype } 
            }).done(function(data){
                $("#protype<?=$i?>").html(data);
				//alert(data);
            });
				 <?php
				}
				?>
  }
 
    $(document).ready(function(){
        $("select.quotationtype").change(function(){
            
        });

		
    });
  
  </script>
  
  
  
  
  <?php
				if(isset($_GET['noofproducts']))
										{
											
											for($i=1;$i<=(float)$_GET['noofproducts'];$i++){
											?>
<script>

        function getresult<?=$i?>()
        {
            var price = parseFloat(document.getElementById("price<?=$i?>").value);
            var quantityval = parseFloat(document.getElementById("noofqtyval<?=$i?>").value);
			var totalvalue= price * quantityval;
            document.getElementById("totalvalue<?=$i?>").value =totalvalue;
			
			
			var gst = parseFloat(document.getElementById("gst<?=$i?>").value);
			var gstvalue= (totalvalue * gst)/100;
			document.getElementById("gstvalue<?=$i?>").value =gstvalue;
			
			var netvalue = totalvalue + gstvalue;
			document.getElementById("netvalue<?=$i?>").value =netvalue;
		
			var installation_charges = parseFloat(document.getElementById("installation_charges<?=$i?>").value);
            var quantityval = 1;
			var insttotalvalue= installation_charges * quantityval;
            document.getElementById("insttotalvalue<?=$i?>").value =insttotalvalue;
			
			
			var installation_gst = parseFloat(document.getElementById("installation_gst<?=$i?>").value);
			var instgstvalue= (insttotalvalue * installation_gst)/100;
			document.getElementById("instgstvalue<?=$i?>").value =instgstvalue;
			
			
			var instnetvalue = insttotalvalue + instgstvalue;
			document.getElementById("instnetvalue<?=$i?>").value =instnetvalue;
			getscrapresult<?=$i?>();
        }

		
		
		function getscrapresult<?=$i?>()
        {
            var noofscrapqty = parseFloat(document.getElementById("noofscrapqty<?=$i?>").value);
            var scrapvalue = parseFloat(document.getElementById("scrapvalue<?=$i?>").value);
			var totalscrapvalue= noofscrapqty * scrapvalue;
            document.getElementById("totalscrapvalue<?=$i?>").value =totalscrapvalue;
			
			
			var netvalue = parseFloat(document.getElementById("netvalue<?=$i?>").value);
			var instnetvalue = parseFloat(document.getElementById("instnetvalue<?=$i?>").value);
			var grandtotal = (netvalue+instnetvalue) - totalscrapvalue;
			document.getElementById("grandtotal<?=$i?>").value =grandtotal;
			//alert(grandtotal);
			allgrandtotal();
			
			

        }

    </script>


  <script type="text/javascript">



	function prolistchange<?=$i?>()
	{
	  var selectedprotype = $("#protype<?=$i?> option:selected").val();
	
            $.ajax({
                type: "POST",
                url: "quotation_process1.php",
                data: { i:<?=$i?>,protype : selectedprotype } 
            }).done(function(data){
                $("#productname<?=$i?>").html(data);
            });
  }
    $(document).ready(function(){
        $("select.protype<?=$i?>").change(function(){
            
        });
    });
	
	
	function productchange<?=$i?>()
	{
	  var selectedproductname = $("#productname<?=$i?> option:selected").val();
	
            $.ajax({
                type: "POST",
                url: "quotation_process2.php",
                data: { i:<?=$i?>, productname : selectedproductname } 
            }).done(function(data){
                $("#response<?=$i?>").html(data);
            });
  }
    $(document).ready(function(){
        $("select.productname<?=$i?>").change(function(){
            
        });
    });
	
	
	
	
	function scrapproductchange<?=$i?>()
	{
	  var selectedproductname = $("#scrapproductname<?=$i?> option:selected").val();
	
            $.ajax({
                type: "POST",
                url: "quotation_process3.php",
                data: {i:<?=$i?>, productname : selectedproductname } 
            }).done(function(data){
                $("#responseg<?=$i?>").html(data);
				//alert(data);
            });
  }
    $(document).ready(function(){
        $("select.scrapproductname<?=$i?>").change(function(){
            
        });
    });
	
	
</script>
  
    <?php
											}
										}
											?>
  
  <script>
  function allgrandtotal(){
	  
	  var grandtotal = 0;
	    <?php
				if(isset($_GET['noofproducts']))
										{
											
											for($i=1;$i<=(float)$_GET['noofproducts'];$i++){
											?>
											var cgt = document.getElementById("grandtotal<?=$i?>").value;
											grandtotal = grandtotal + parseFloat(cgt);
											    <?php
											}
										}
											?>
										document.getElementById("totalquotationvalue").value =grandtotal;	
  }
  
  </script>
  
 <script>
 function modechange()
 {
	 var schargeno=$("#schargeno").val();
	 var oldincgst=$("#oldincgst").val();
	 if(schargeno!='')
	 {
		 if((oldincgst=='0')||(oldincgst=='1'))
		 {
			 alert("Sorry!!!!! \n\nThis Service Charge is Already generated as GST Invoice \n\nYou can't Change it");
		 }
		 else
		 {
			 alert("Sorry!!!!! \n\nThis Service Charge is Already generated as Estimate Invoice \n\nYou can't Change it");
		 }
		 return false;
	 }
	 else
	 {
		 totalcalc();
	 }	 
 }
  function totalcalc()
  {
	  
	    
	  var schargematerial=$("#schargematerial").val();
	  
	  
	  var schargematerial=$("#schargematerial").val();
	  var schargescharge=$("#schargescharge").val();
	  var schargepre=$("#schargepre").val();
	  var schargegst=$("#schargegst").val();
	  var schargegstvalue=$("#schargegstvalue").val();
	  var scharge=$("#scharge").val();
	  if(document.getElementById('excgst').checked==true)
	  {		 
		  document.getElementById('schargescharge').removeAttribute('readonly');
		  document.getElementById('scharge').setAttribute('readonly','readonly');
		  if((schargematerial!='')&&(schargescharge!=''))
		  {
			  var schargepreval=parseFloat(schargematerial)+parseFloat(schargescharge);
			  $("#schargepre").val(schargepreval.toFixed(2));
			  var schargegstvalueval=(parseFloat(schargepreval)*parseFloat(schargegst))/100;
			  $("#schargegstvalue").val(schargegstvalueval.toFixed(2));
			  var iNetPrice = parseFloat(schargepreval)+parseFloat(schargegstvalueval);
		      $("#scharge").val(iNetPrice.toFixed(2));	
		  }
	  }
	  if(document.getElementById('incgst').checked==true)
	  {		  
		  document.getElementById('scharge').removeAttribute('readonly');
		  document.getElementById('schargescharge').setAttribute('readonly','readonly');
		  var original=$("#scharge").val();
		  var ipreamoutv=parseFloat(original);
		var igstperv=parseFloat(schargegst);
		var iGSTAmount =ipreamoutv-(ipreamoutv*(100/(100+igstperv)));
		var iNetPrice = ipreamoutv-iGSTAmount;
		$("#schargegstvalue").val(iGSTAmount.toFixed(2));
		  $("#schargepre").val(iNetPrice.toFixed(2));
		$("#schargescharge").val(iNetPrice.toFixed(2));	  
		  
	  }
	  if(document.getElementById('nogst').checked==true)
	  {		  
		document.getElementById('scharge').removeAttribute('readonly');
		document.getElementById('schargescharge').setAttribute('readonly','readonly');
		var original=$("#scharge").val();
		var ipreamoutv=parseFloat(original);
		var igstperv=parseFloat(0);
		var iGSTAmount =ipreamoutv-(ipreamoutv*(100/(100+igstperv)));
		var iNetPrice = ipreamoutv-iGSTAmount;
		$("#schargegstvalue").val(iGSTAmount.toFixed(2));
		  $("#schargepre").val(iNetPrice.toFixed(2));
		$("#schargescharge").val(iNetPrice.toFixed(2));	  
		  
	  }
	  
  }
  </script>
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
const demo = document.getElementById('demo');
    function error(err) {
        demo.innerHTML = `Failed to locate. Error: ${err.message}`;
    }

    function success(pos) {
        demo.innerHTML = 'Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`;
		showPosition(pos);
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
var callid = "";

    function error1(err) {
        alert(`Failed to locate. Error: ${err.message}`);
    }

    function success1(pos) {
        alert('Located: '+`${pos.coords.latitude}, ${pos.coords.longitude}`);
		startposition(pos);
    }

    function startmylocation(id) {
		callid=id;
        if (navigator.geolocation) {
            demo.innerHTML = 'Locating…';
            navigator.geolocation.getCurrentPosition(success1, error1);
        } else { 
            alert('Geolocation is not supported by this browser.');
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

  <script>
  function phasechange()
  {
	  var phasetype=document.getElementById("phasetype").value;
	  
	  if(phasetype=='31')
	  {
		 
		  document.getElementById('i1').style.display="none";
		  document.getElementById('i3').style.display="block";
		  document.getElementById('o1').style.display="block";
		  document.getElementById('o3').style.display="none";
	  }
	  if(phasetype=='33')
	  {
		  document.getElementById('i1').style.display="none";
		  document.getElementById('i3').style.display="block";
		  document.getElementById('o1').style.display="none";
		  document.getElementById('o3').style.display="block";
	  }
	  if(phasetype=='11')
	  {
		  document.getElementById('i1').style.display="block";
		  document.getElementById('i3').style.display="none";
		  document.getElementById('o1').style.display="block";
		  document.getElementById('o3').style.display="none";
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
function forceDownload(href) {
	var anchor = document.createElement('a');
	anchor.href = href;
	anchor.download = '<?=$_SESSION["calltid"]?>';
	document.body.appendChild(anchor);
	anchor.click();
}
</script>	
<script>
function checkvalidate()
{
	return confirm('Do you really want to submit the Service Report? \nOnce you submit you unable to change the details. \n\nAre you sure?');
	var customernature=$("#customernature").val();
	var callnature=$("#callnature").val();
	var scharge=$("#scharge").val();
	var callstatus=$("#callstatus").val();
	if((document.getElementById('incgst').checked==true)||(document.getElementById('excgst').checked==true))
	{
		/* if(((customernature=='Out of Warranty')||(customernature=='Other Make'))&&(callstatus=='Completed')&&(callnature!='Maintanence'))
		{
			if((scharge=='')||(scharge=='0')||(scharge=='0.00'))
			{
				alert("This is an "+customernature+" Call. You must Collect Service Charge");
				return false;
			}
		} */
	}
	else
	{
		
	}
}
</script>			
</body>

</html>
