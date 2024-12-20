<style>
.text-primary {
color: <?=$_SESSION['bgcolor']?> !important;
}
.btn-navb {
display: inline-block;
font-weight: 400;
color: <?=$_SESSION['textcolor']?>;
}
.btn-primary
{
background-image:none !important;
background-color: <?=$_SESSION['bgcolor']?> !important;
border-color: <?=$_SESSION['bgcolor']?> !important;
color: <?=$_SESSION['textcolor']?> !important;
}
.btn-success
{
background-image:none !important;
background-color: #1cc88a !important;
border-color: #1cc88a !important;
color: <?=$_SESSION['textcolor']?> !important;
}
.navbar-color , .bg-color
{
padding:.3rem 0.25rem;
background-color: <?=$_SESSION['lightbgcolor1']?> !important;
}
.navbar-color a {
color: <?=$_SESSION['darkcolor']?> !important;
}
.page-item.active .page-link {
z-index: 3;
color: #fff;
background-color:<?=$_SESSION['bgcolor']?> !important;
border-color: <?=$_SESSION['bgcolor']?> !important;
}
.page-item.active a
{
color: <?=$_SESSION['textcolor']?> !important;
}
.go-corner {
background-color: <?=$_SESSION['bgcolor']?> !important;
}
.topnavbar .nav-link:hover{
background-color:<?=$_SESSION['bgcolor']?> !important;
color:<?=$_SESSION['textcolor']?> !important;
}
.topnavbar .nav-link
{
padding: 0.75rem 1rem;
font-weight: bold;
font-size: 15px;
mx-auto
}
.bg-navb  a  {
color: <?=$_SESSION['textcolor']?> !important;
text-decoration: none;
background-color: transparent;
}
.dropdown-menu a {
color: <?=$_SESSION['bgcolor']?> !important;
text-decoration: none;
background-color: transparent;
}
nav .bg-color a {
color: <?=$_SESSION['textcolor']?> !important;
text-decoration: none;
background-color: transparent;
}
nav .bg-color a:hover{
color:<?=$_SESSION['darkcolor']?> !important;
}
a {
color: <?=$_SESSION['bgcolor']?> !important;
text-decoration: none;
background-color: transparent;
}
a.btn-primary {
background-image:none !important;
background-color: <?=$_SESSION['bgcolor']?> !important;
border-color: <?=$_SESSION['bgcolor']?> !important;
color: <?=$_SESSION['textcolor']?> !important;
}
a.btn-primary:hover{
background-image:none !important;
background-color: <?=$_SESSION['darkcolor']?> !important;
border-color: <?=$_SESSION['darkcolor']?> !important;
color: <?=$_SESSION['textcolor']?> !important;
}
.list-group-item.active {
z-index: 2;
color: <?=$_SESSION['textcolor']?> !important;
background-color: <?=$_SESSION['bgcolor']?> !important;
border-color: <?=$_SESSION['bgcolor']?> !important;
}
.custom-control-input:checked~.custom-control-label::before {
color: <?=$_SESSION['textcolor']?> !important;
border-color: <?=$_SESSION['bgcolor']?> !important;
background-color: <?=$_SESSION['bgcolor']?> !important;
}
.card1 {
display: block;
position: relative;
background-color: <?=$_SESSION['bgcolor']?> !important;
text-decoration: none;
z-index: 0;
overflow: hidden;
}
.card1:hover {
display: block;
position: relative;
background-color: <?=$_SESSION['textcolor']?> !important;
text-decoration: none;
z-index: 0;
overflow: hidden;
color: <?=$_SESSION['bgcolor']?> !important;
}
.card1:hover i {
color: <?=$_SESSION['bgcolor']?> !important;
}
.card1:hover h5 {
color: <?=$_SESSION['bgcolor']?> !important;
}
.card1:hover span {
color: <?=$_SESSION['bgcolor']?> !important;
}
.bg-bgcolor {
background-color: <?=$_SESSION['bgcolor']?> !important;
}
.nav-tabs .nav-item.show .nav-item.active .nav-link, .nav-tabs .nav-link.active {
color: <?=$_SESSION['textcolor']?> !important;
background-color: <?=$_SESSION['bgcolor']?> !important;
border-color:<?=$_SESSION['bgcolor']?> !important;
}
.dropdown-item.active, .dropdown-item:active {
color: #fff;
text-decoration: none;
background-color: <?=$_SESSION['lightbgcolor1']?> !important;
}
.nav-link.dropdown-toggle.active
{
color: <?=$_SESSION['textcolor']?> !important;
background-color: <?=$_SESSION['bgcolor']?> !important;
}
.nav-link.active
{
color: <?=$_SESSION['textcolor']?> !important;
background-color: <?=$_SESSION['bgcolor']?> !important;
}
th
{
	text-align:center !important;
	vertical-align: middle !important;
	background-color:<?=$_SESSION['bgcolor']?> !important;
	color:<?=$_SESSION['textcolor']?> !important;
	
}
.specific-th {
           
            background-color: #f1f1f1 !important;
            color: #000000 !important;
            text-align: left !important;
            
	vertical-align: middle !important;
	
        }
		.specific-td {
           
            background-color: #ffffff !important;
            color: #000000 !important;
            text-align: left !important;
            
	vertical-align: middle !important;
	
        }
</style>
 <style>

.cardnav {
	 color: <?=$_SESSION['textcolor']?> !important;
    background-color: <?=$_SESSION['bgcolor']?> !important;
    width: auto;
    height: 50px;
    border: 2px solid <?=$_SESSION['bgcolor']?>;
    border-radius: 5px;
    padding: 5px;
	font-size:14px;
	font-weight:bold;
}
.cardnav:hover {
	 color: <?=$_SESSION['bgcolor']?> !important;
    background-color: #fff !important;
    width: auto;
    height: 50px;
    border: 2px solid <?=$_SESSION['bgcolor']?>;
    border-radius: 5px;
    padding: 5px;
	font-size:14px;
	font-weight:bold;
}
.cardnav.active
{
	color: <?=$_SESSION['bgcolor']?> !important;
    background-color: #fff !important;
    font-size:14px;
	font-weight:bold;
}
.cardnav-body {
    padding: 5px; /* Adjust padding as needed */
    height: 100%; /* Ensure the card body fills the entire height */
    display: flex; /* Use flexbox to center content */
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically */
	font-size:14px;
	font-weight:bold;
}
</style>
<style>
.input-container {
  display: grid;
  grid-template-columns: 35% auto; /* Label takes 30%, input/select takes the remaining space */
  grid-column-gap: 5px; /* Adjust gap between columns */
}

.input-container input[type="text"],
.input-container select {
  width: 100%; /* Ensure the input and select fill their respective columns */
}

.input-container input[type="text"] {
  grid-column: 2; /* Place input in the second column */
}
.input-container input[type="checkbox"] {
  grid-column: 1; /* Place input in the second column */
}
.input-container input[type="radio"] {
  grid-column: 2; /* Place input in the second column */
}


.input-container label {
  grid-column: 1; /* Place label in the first column */
  text-align: right;
}


.input-container select {
  grid-column: 2; /* Place select in the second column */
  background-color: #eaecf4; /* Set background color for the select element */
}
.input-container textarea {
  grid-column: 2; /* Place select in the second column */
 }
 .input-container p {
  grid-column: 2; /* Place label in the first column */
  text-align: left;
}
 .card-header2 {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: <?=$_SESSION['bgcolor']?>;
    border-bottom: 1px solid #3d8cb7;
}
.cardbox2 {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #f1f8fb;
    background-clip: border-box;
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
}
.card-title2 {
  margin-bottom: 0rem; 
}
.card-body2 {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 0.5rem;
}
</style>
<style>
.card-header {
    padding: .75rem 1.25rem !important;
    margin-bottom: 0 !important;
    background-color: <?=$_SESSION['lightbgcolor2']?> !important;
    border-bottom: 1px solid <?=$_SESSION['bgcolor']?> !important;
}
</style>
<style>

.sidebar-dark .nav-item.active .nav-link {
    color: <?=$_SESSION['textcolor']?> !important;
    text-align: left !important;
    /* padding: .5rem .6rem; */
    width: 9rem;
    width: 150px;
    height: 35px;
     background-color: <?=$_SESSION['darkcolor']?> !important;
        border: 1px solid <?=$_SESSION['textcolor']?>!important;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: white;
    /* font-size: small; */
    text-align: center;
    line-height: 20px;
}
 
.sidebar.toggled .nav-item .nav-link {
        text-align: left;
        padding: .5rem .6rem;
        width: 9rem;
        position: relative;
        text-align: left !important;
        /* padding: .5rem .6rem; */
        width: 9rem;
        width: 150px;
        height: 35px;
        background-color: <?=$_SESSION['textcolor']?>;
        border: 2px solid <?=$_SESSION['bgcolor']?>;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: white;
        /* font-size: small; */
        text-align: center;
        line-height: 20px;
    }
}


</style>
<nav class="navbar navbar-expand navbar-light bg-navb topbar static-top shadow">
<button id="sidebarToggleTop" class="btn btn-navb rounded-circle">
<i class="fa fa-bars"></i>
</button>
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
<div class="sidebar-brand-icon">
<img src="../../1637028036/img/jero_logo.png" width="120">
</div>
</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- Topbar Search -->
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="consigneeview.php" method="get">
<div class="input-group">
<input type="hidden" name="id" id="topsearchid">
<!--<label class='text-white'>Complaint Call</label> 
&nbsp;
&nbsp;-->
<input type="text" id="topsearch" name="topsearch" class="form-control bg-light border-0 small" placeholder="Search for Customer Name, Area, Mobile, etc..." aria-label="Search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn btn-navb" type="submit">
<i class="fas fa-search fa-sm"></i>
</button>
</div>
</div>
</form>
&nbsp;
&nbsp;
<?php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page === 'dashboard.php') {
    ?>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
            <div class="input-group">
                        <input type="text" id="reportrange" name="reportrange" class="form-control"/>
                    <div class="input-group-append">
<button class="btn btn-navb" type="submit" name="submit">
<i class="fa-solid fa-calendar-days fa-sm"></i>
</button>
<button class="btn btn-navb" type="submit">
<a href="dashboard.php"><i class="fas fa-undo fa-sm"></i></a>
</button>
</div>
            </div>	
        </form>
    <?php
}
?>
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-search fa-fw"></i>
</a>
<!-- Dropdown - Messages -->
<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
<form class="form-inline mr-auto w-100 navbar-search" action="consigneeview.php" method="get">
<div class="input-group">
<input type="hidden" name="id" id="topsearchid1">
<input type="text" id="topsearch1" name="topsearch" class="form-control bg-light border-0 small" placeholder="Search for Customer Name, Area, Mobile, etc..." aria-label="Search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn btn-primary" type="submit">
<i class="fas fa-search fa-sm"></i>
</button>
</div>
</div>
</form>
</div>
  
</li>
<?php
/*
<!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-bell fa-fw"></i>
<!-- Counter - Alerts -->
<span class="badge badge-danger badge-counter">3+</span>
</a>
<!-- Dropdown - Alerts -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
<h6 class="dropdown-header">
Alerts Center
</h6>
<a class="dropdown-item d-flex align-items-center" href="#">
<div class="mr-3">
<div class="icon-circle bg-primary">
<i class="fas fa-file-alt text-white"></i>
</div>
</div>
<div>
<div class="small text-gray-500">December 12, 2019</div>
<span class="font-weight-bold">A new monthly report is ready to download!</span>
</div>
</a>
<a class="dropdown-item d-flex align-items-center" href="#">
<div class="mr-3">
<div class="icon-circle bg-success">
<i class="fas fa-donate text-white"></i>
</div>
</div>
<div>
<div class="small text-gray-500">December 7, 2019</div>
$290.29 has been deposited into your account!
</div>
</a>
<a class="dropdown-item d-flex align-items-center" href="#">
<div class="mr-3">
<div class="icon-circle bg-warning">
<i class="fas fa-exclamation-triangle text-white"></i>
</div>
</div>
<div>
<div class="small text-gray-500">December 2, 2019</div>
Spending Alert: We've noticed unusually high spending for your account.
</div>
</a>
<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
</div>
</li>
<!-- Nav Item - Messages -->
*/?>
<li class="nav-item dropdown no-arrow mx-1">
<?php
$sqlselect = "SELECT enabled, remindertype, sourceid, reminder, enddate, id From jrcreminder where CAST(enddate AS DATE)='".date('Y-m-d')."' order by reminder asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect)
{
die("SQL query failed: " . mysqli_error($connection));
}
?>
<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-clock fa-fw"></i>
<!-- Counter - Messages -->
<span class="badge badge-danger badge-counter" id="badgecounter"><?=$rowCountselect?></span>
</a>
<!-- Dropdown - Messages -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
<h6 class="dropdown-header">
Reminders
</h6>
<?php
$count=0;
if($rowCountselect > 0)
{
while($rowselect = mysqli_fetch_array($queryselect))
{
preg_match_all("<a href=\x22(.+?)\x22>", $rowselect['reminder'], $matches); // save all links \x22 = "
$matches = str_replace("a href=", "", $matches); // remove a href=
$matches = str_replace("\"", "", $matches); // remove "
if($rowselect['enabled']=='0')
{
if($count<=4)
{
if($rowselect['remindertype']=='Quotation Followup')
{
?>
<a class="dropdown-item d-flex align-items-center" href="quotationgenview.php?id=<?=$rowselect['sourceid']?>">
<div class="dropdown-list-image mr-2">
<i class="fas fa-exclamation-triangle fa-fw text-danger"></i>
</div>
<div class="font-weight-bold">
<div class=""><?=strip_tags($rowselect['reminder'])?></div>
<div class="small text-gray-500"><?=date('d/m/Y h:i:s a',strtotime($rowselect['enddate']))?></div>
</div>
</a>
<?php
}
else{
?>
<a class="dropdown-item d-flex align-items-center" href="reminderedit.php?id=<?=$rowselect['id']?>">
<div class="dropdown-list-image mr-2">
<i class="fas fa-exclamation-triangle fa-fw text-danger"></i>
</div>
<div class="font-weight-bold">
<div class=""><?=strip_tags($rowselect['reminder'])?></div>
<div class="small text-gray-500"><?=date('d/m/Y h:i:s a',strtotime($rowselect['enddate']))?></div>
</div>
</a>
<?php
}
}
$count++;
}
}
}
?>
<script>document.getElementById("badgecounter").innerHTML="<?=$count?>";</script>
<a class="dropdown-item text-center small text-gray-500" href="reminder.php?dashfromdate=<?=date('Y-m-d')?>&dashtodate=<?=date('Y-m-d')?>&submit=">Read More Messages</a>
</div>
</li>
<!-- Nav Item - User Information -->
<?php
/*
<?php
$sqlwo = "SELECT count(id) as count From jrccalls where (actiontaken='OBSERVATION' or actiontaken='WAITING FOR APPROVAL')";
$querywo = mysqli_query($connection, $sqlwo);
$rowCountwo = mysqli_fetch_array($querywo);
$wocount=(float)$rowCountwo['count'];
?>
<li class="nav-item dropdown no-arrow">
<a class="nav-link dropdown-toggle" href="#" id="mapDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-fw fa-exclamation-triangle"></i>
<span class="badge badge-danger badge-counter" id="badgecounter"><?=$wocount?></span>
</a>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="mapDropdown">
<a class="dropdown-item" href="wcalls.php">
<i class="fas fa-fw fa-pause-circle"></i>
Waiting for Approval Calls</a>
<a class="dropdown-item" href="ocalls.php">
<i class="fas fa-fw fa-stopwatch-20"></i>
Observation Calls</a>
</div>
</li>
<?php
*/
?>
<div class="topbar-divider d-none d-sm-block"></div>
<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="mr-2 d-none d-lg-inline"><?=$adminusername?></span>
<?php
$sqladminuser=mysqli_query($connection, "select avatar from jrcadminuser where username='".$email."'");
$infoadminuser=mysqli_fetch_array($sqladminuser);
if($infoadminuser['avatar']!='')
{
?>
<img class="img-profile rounded-circle" src="<?=$infoadminuser['avatar']?>">
<?php
}
else
{
?>
<img class="img-profile rounded-circle" src="../img/smiley.png">
<?php
}
?>
</a>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
<a class="dropdown-item text-center" href="#" >
<span class="text-primary" style="font-weight:bold;"><?=$_SESSION['companyname']?></span><br>
<?=$_SESSION['companyarea']?> <?=$_SESSION['companydistrict']?>
</a>
<a class="dropdown-item" href="profile.php">
<i class="fas fa-user fa-sm fa-fw mr-2 "></i>
Profile
</a>
<?php
if($settings=="1")
{
?>
<a class="dropdown-item" href="companysettings.php">
<i class="fas fa-cogs fa-sm fa-fw mr-2 "></i>
Settings
</a>
<?php
}
?>
<a class="dropdown-item" href="maileradd.php">
<i class="fa fa-envelope fa-sm fa-fw mr-2 "></i>
Mailer Settings
</a>
<!--a class="dropdown-item" href="activitylog.php">
<i class="fas fa-list fa-sm fa-fw mr-2 "></i>
Activity Log
</a-->
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
Logout
</a>
</div>
</li>
</ul>
</nav>
<div class="container-fluid" style="font-size:100%">
<div class="row">
<div class="col-lg-12">
<?php
if($valintervaldays<0)
{
if($valintervaldays<-7)
{
?>
<div class="alert bg-danger text-white text-center font-weight-bold">
<marquee>Dear Customer! Your Subscription Validity was expired on <?=date('d/m/Y', strtotime($valexp))?>. Already a Month has been over. Kindly Renew your Subscription. Your login will be disabled within <?=(14+$valintervaldays)?> days.</marquee>
</div>
<?php
}
else
{
?>
<div class="alert bg-danger text-white text-center font-weight-bold">
<marquee>Dear Customer! Your Subscription Validity was expired on <?=date('d/m/Y', strtotime($valexp))?>. Kindly Renew your Subscription.</marquee>
</div>
<?php
}
}
else if($valintervaldays<7)
{
?>
<div class="alert bg-danger text-white text-center font-weight-bold">
<marquee>Dear Customer! Your Subscription Validity will be expired on <?=date('d/m/Y', strtotime($valexp))?>. Kindly Renew your Subscription. </marquee>
</div>
<?php
}
else
{
}
?>
</div>
</div>
</div>