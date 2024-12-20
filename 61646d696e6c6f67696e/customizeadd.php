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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Add New Customization</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
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
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800">Add New Customization</h1>
            <a href="customize.php" class="m-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> View All Customization Details</a>
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
            <!--<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add New Additional Material</h6>
            </div>-->
<div class="card-body">
<form action="customizeadds.php"  method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-6">
  <div class="form-group">
    <label for="filename">File Name</label>
    <input type="text" class="form-control" id="filename" name="filename" required>
  </div>
</div> 
<div class="col-lg-6">
  <div class="form-group">
    <label for="description">Description</label>
	 <textarea class="form-control" id="description" name="description"></textarea>
  </div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label for="customizeupload">Upload Documents</label>
<input type="file" style="padding: 70px;" id="customizeupload" name="customizeupload" accept="image/*" class="form-control" >
					</div>
				</div>
  </div>
  <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>
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

 <script type="text/javascript">
  $(function() {
     $( "#topsearch" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch").val(ui.item.value); $("#topsearchid").val(ui.item.id);}, minLength: 3
     });
$( "#topsearch1" ).autocomplete({
       source: 'topsearch.php', select: function (event, ui) { $("#topsearch1").val(ui.item.value); $("#topsearchid1").val(ui.item.id);}, minLength: 3
     });
     $( "#material" ).autocomplete({
       source: 'materialsearch.php?type=material',
     });
	 $( "#designation" ).autocomplete({
       source: 'materialsearch.php?type=designation',
     });
	 $( "#material" ).autocomplete({
       source: 'Additional Materialsearch.php?type=material',
     });
  });
</script>
 <script src="../../1637028036/vendor/sign/assets/json2.min.js"></script>
<script>
    function image(thisImg) {
        // var img = document.createElement("IMG");
        // img.src = thisImg;
        // img.className="img-fluid";
        // document.getElementById('showData').appendChild(img);
        var count = $('.imgcontainer .imgcontent').length;
        count = Number(count) + 1;
        $('.imgcontainer').append("<div class='imgcontent' id='imgcontent_" + count + "' ><img src='" + thisImg +
            "' width='100' height='100'><span class='imgdelete' id='imgdelete_" + count + "'>Delete</span></div>");
    }
    $(document).ready(function() {
        var settings = {
            url: "imageups.php",
            method: "POST",
            allowedTypes: "jpg,png",
            fileName: "myfile",
            multiple: true,
            maxFileCount: 5,
            onSuccess: function(files, data, xhr) {
                var obj = JSON.parse(data);
                console.log(obj.imglist);
                image(obj.imglist);
                var vals = $("#diagnosisimg").val();
                if (vals != '') {
                    $("#diagnosisimg").val(vals + ',' + obj.imglist);
                } else {
                    $("#diagnosisimg").val(obj.imglist);
                }
                $("#status").html("<font color='green'>Upload is success</font>");
            },
            onError: function(files, status, errMsg) {
                $("#status").html("<font color='red'>Upload is Failed</font>" + errMsg);
            }
        }
        $("#mulitplefileuploader").uploadFile(settings);
    });
    </script>
<script>
    // Remove file
    $('.imgcontainer').on('click', '.imgcontent .imgdelete', function() {
        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#imgcontent_' + num + ' img').attr("src");
        var deleteFile = confirm("Do you really want to Delete?");
        if (deleteFile == true) {
            var vals = $("#diagnosisimg").val();
            let newStr = vals.replace(imgElement_src + ',', '');
            newStr = newStr.replace(',' + imgElement_src, '');
            newStr = newStr.replace(imgElement_src, '');
            $("#diagnosisimg").val(newStr);
            $('#imgcontent_' + num).remove();
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
    <?php include('additionaljs.php');   ?>
</body>

</html>
