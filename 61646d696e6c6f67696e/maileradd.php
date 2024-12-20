<?php
include('lcheck.php'); 

if(isset($_POST['submit']))
{
	$mailer=mysqli_real_escape_string($connection, $_POST['mailer']);
	$mailname=mysqli_real_escape_string($connection, $_POST['mailname']);
	$apppassword=mysqli_real_escape_string($connection, $_POST['apppassword']);
	
$sqlcon = "SELECT id, companyid From jrccompany";
$querycon = mysqli_query($connection, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
 
if(!$querycon){
die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
	    }
		else
		{
		$infos=mysqli_fetch_array($querycon);
		$sqlup = "update jrccompany set mailer='$mailer', mailname='$mailname', apppassword='$apppassword'";
		$queryup = mysqli_query($connection, $sqlup);
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Modify mailer Information', '{$tid}')");
				header("Location: maileradd.php?remarks=Updated Successfully");
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

  <title><?=$_SESSION['companyname']?> - Jerobyte - Mail Settings</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
 
</head>

<body id="page-top" onload="checkmailer()">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
        

        
        <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-1">
            <h1 class="h4 mb-2 mt-2 text-gray-800  mt-2">Mail Settings</h1>
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
              <h6 class="m-0 font-weight-bold text-primary">Mail Settings</h6>
            </div>-->
<div class="card-body">
<?php
$sqlselect = "SELECT mailname, apppassword From jrccompany order by id asc";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		$rowselect = mysqli_fetch_array($queryselect);
			?>
<form action="" method="post">
<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
		            <label for="mailer">Mail Format</label>	<br>	
				  <label><input type="radio" id="mailer" name="mailer" value="0" <?=($_SESSION['mailer']=='0')?'checked':''?> onchange="checkmailer()"> Common Jerobyte Mail
				   </label>
				   <label><input type="radio" id="mailer" name="mailer" value="1" <?=($_SESSION['mailer']=='1')?'checked':''?> onchange="checkmailer()"> Personal Gmail
				   </label>
				</div>
				</div>
  
	<div class="col-lg-6">
	  <div class="form-group" id="mailname">
		<label for="mailname">Gmail User Name</label>
		<input type="text" class="form-control" id="mailname" name="mailname"  value="<?=$rowselect['mailname']?>" onchange="checkmailer()">
	  </div>
	</div>
	<div class="col-lg-6">
	  <div class="form-group" id="apppassword">
		<label for="apppassword">App Password</label>
		<input type="password" class="form-control" id="apppassword" name="apppassword" value="<?=$rowselect['apppassword']?>"  onchange="checkmailer()">
	  </div>
	</div>
	 </div>
	<input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

     </div>	 
     </div>	 
			 <div class="card shadow mb-4">
			 <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Follow guidelines given below</h6>
            </div>
<div class="card-body">	
			
		
	<p>Here is the stepwise guide for creating an app password so that you can successfully integrate it with PHPMailer to send and receive emails on your server.</p>
	<b>Step 1. Login to Google Account</b>
    <p>Go to <a href="https://myaccount.google.com" target="_blank">myaccount.google.com</a>(if not signed in, you will be asked to sign-in to your account).</p>
	<div class="text-left">
	<img src="img/googleaccount.png"  width="800" height="400">
	</div>
	<br>
	<b>Step 2. Enable 2-Step Verification</b>
    <p>First, you have to enable the 2-Step Verification on your account before you set up the app password.</p>
    <p>Click on the Security tab on the left-hand side to go to the Security page and within the section Signing in to Google click on 2-Step Verification.</p>
	<div class="text-left">
	<img src="img/enable.png"  width="800" height="400">
	</div>
	<br>
	<p>Click on Get Started and on the next page enter your password to verify your account and hit Next.</p>
	<div class="text-left">
	<img src="img/getstarted.png"  width="800" height="400">
	</div>
	<br>
	<p>Now you have to set up your phone. Enter the phone number you want to use for verification and then select the method to receive your code. It may be a Text message or a Phone Call. I will keep it a Text message and hit Next.</p>
    <div class="text-left">
	<img src="img/message.png"  width="800" height="400">
	</div>
	<br>
	<p>Google will send you a text message with a verification code. Enter the verification code & hit Next.</p>
    <div class="text-left">
	<img src="img/next.png"  width="800" height="400">
	</div>
	<br>
	<P>On the next page, Google will confirm that the 2-Step Verification is ON. Now click the back arrow next to the heading to go back to the Security page.</P>
	<div class="text-left">
	<img src="img/verification.png"  width="800" height="400">
	</div>
	<br>
	<b>Step 3. Setup Application password</b>
    <p>Within the section Signing in to Google, you will notice a new option that says App passwords.</p>
	<div class="text-left">
	<img src="img/apppasswords.png"  width="800" height="400">
	</div>
	<br>
	<p>Click on App passwords and verify your account. After verification, you will be able to create the app password for any app and device.</p>
	<div class="text-left">
	<img src="img/anyapp.png"  width="800" height="400">
	</div>
	<br>
	<p>Now, select Mail from Select app and Other (custom name) from Select device and provide it a name. You can name it anything you like, I will name it PHPMailer and hit Generate.</p>
	<div class="text-left">
	<img src="img/generate.png"  width="800" height="400">
	</div>
	<br>
	<p>Now you have successfully generated your app password. Copy this code and paste it somewhere safe, until you haven’t added it to the PHP script.</p>
    <p>Remember,<b> don’t share it with anyone.</b></p>
    <p>App passwords are a security risk, so you should keep them safe and revoke application-specific passwords you no longer use. Be careful with them, and treat them like the master passwords to your account that they are.
    - Important</p>
	<div class="text-left">
	<img src="img/done.png"  width="800" height="400">
	</div>
	<br>
	<p>You have successfully generated the app password now.</p>
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
<script type="text/javascript"></script>
<script>
function checkmailer()
		{
			var mailer=document.getElementById("mailer");
			var mailname=document.getElementById("mailname");
			var mailname=document.getElementById("mailname");
			var apppassword=document.getElementById("apppassword");
			if(mailer.checked==true)
			{
				mailname.style.display="none";
				apppassword.style.display="none";
			}
			else
			{
				mailname.style.display="block";
				apppassword.style.display="block";
			}
		}
		</script>
		<?php include('additionaljs.php');   ?>
</body>
</html>

