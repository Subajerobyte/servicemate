
<style>
/*
.bg-gradient-primary {
background-color: #00c292 !important;
background-image: linear-gradient(180deg,#00c292 10%,#02ad83 100%) !important;
background-size: cover;
}
.btn-primary, .bg-primary {
color: #fff !important;
background-color: #00c292 !important;
border-color: #00c292 !important;
}
.text-primary
{
color: #00c292 !important;
}
.btn-primary:hover {
color: #fff;
background-color: #02ad83 !important;
border-color: #02ad83 !important;
}
.sidebar-dark .nav-item.active .nav-link, .sidebar-dark .nav-item.active .nav-link i
{
color: #00c292 !important;
}
*/
sidebar-dark .nav-item.active .nav-link i {
color: #3d8eb9!important;
}
</style>
<style>
.sidebar-dark .nav-item .nav-link:active,.sidebar-dark .nav-item .nav-link:focus,.sidebar-dark .nav-item .nav-link:hover {
color: #3d8eb9!important;
}
.sidebar-dark .nav-item .nav-link:active i,.sidebar-dark .nav-item .nav-link:focus i,.sidebar-dark .nav-item .nav-link:hover i {
color: #3d8eb9!important;
}
.sidebar .nav-item .collapse .collapse-inner .collapse-item, .sidebar .nav-item .collapsing .collapse-inner .collapse-item
{
color:#ffffff !important;
}
.sidebar .nav-item .collapse .collapse-inner .collapse-item:hover, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:hover
{
color:#3a3b45 !important;
}
.sidebar-dark .nav-item .nav-link,.sidebar-dark .nav-item .nav-link i
{
color: <?=$_SESSION['bgcolor']?>!important;
}
.sidebar-dark .nav-item.active .nav-link, .sidebar-dark .nav-item.active .nav-link i
{
color: <?=$_SESSION['textcolor']?>!important;
}
.bg-navb, .sidebar-brand {
background-color:  <?=$_SESSION['bgcolor']?> !important;
}
</style>
<?php
$current_file_name = basename($_SERVER['PHP_SELF']);
$current_file_name1 = basename($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
?>
<?php
$sqlsidebar=mysqli_query($connection,"SELECT * FROM `jrcitemorder`");
$rowsidebar=mysqli_num_rows($sqlsidebar);
$sidebars=array();
if($rowsidebar>0)
{
$infosidebar=mysqli_fetch_array($sqlsidebar);
$sidebars=explode(' | ',$infosidebar['itemname']);
}
else{
$isidebar='Dashboard | Alerts | Calls | Engineers | Carry_In | Customers | Sales | Rental | Quotations | Accounts | Reports | Product | Data | Users | Master | Updates | Official | Help_Desk | User_Manual | Software_Updates';
$sidebars=explode(' | ',$isidebar);
}

$Dashboard='<li class="nav-item '.(($current_file_name=='dashboard.php')?'active':'').'">
<a class="nav-link" href="dashboard.php">
<i class=" far fa-regular fa-compass" style="width: 17px; height: 17px;"></i> Dashboard</a>
</li>';
if($liveplan=='DIAMOND')
{
$Alerts='<li class="nav-item '.((($current_file_name=='calendar.php')||($current_file_name=='alertpreventive.php')||($current_file_name=='alertwarrantyexpire.php')||($current_file_name=='alertamcmaintenance.php')||($current_file_name=='alertamcexpire.php')||($current_file_name=='alertlifetime.php'))?'active':'').'">
<a class="nav-link" href="calendar.php">
<i class="far fa-comment-alt" style="width: 17px; height: 17px;"></i> Alerts</a>
</li>';
$Accounts='<li class="nav-item '.((($current_file_name=='iexpense.php')||($current_file_name=='iexpenseadd.php')||($current_file_name=='servicecharges.php')||($current_file_name=='servicechargese.php')||($current_file_name=='amccharges.php')||($current_file_name=='iexpenseedit.php')||($current_file_name=='estimatecharges.php'))?'active':'').'">
<a class="nav-link" href="iexpense.php">
<i class="fas fa-hand-holding-usd" style="width: 17px; height: 17px;"></i> Accounts</a>
</li>';
$Rental='<li class="nav-item '.((($current_file_name=='rentallist.php')||($current_file_name=='rentaladd.php')||($current_file_name=='rentaledit.php')||($current_file_name=='payments.php')||($current_file_name=='paymentadd.php'))?'active':'').'">
<a class="nav-link" href="rentallist.php">
<i class="fas fa-donate" style="width: 17px; height: 17px;"></i> Rental</a>
</li>';
$Official='<li class="nav-item '.((($current_file_name=='letterprintings.php')||($current_file_name=='letterprintingadd.php')||($current_file_name=='letterprintingedit.php')||($current_file_name=='bulkemail.php')||($current_file_name=='invoicesubmission.php')||($current_file_name=='invoicesubmissionad.php')||($current_file_name=='invoicesubmissionads.php')||($current_file_name=='filemanager.php')||($current_file_name=='files.php'))?'active':'').'">
<a class="nav-link" href="letterprintings.php">
<i class="fas fa-fw fa-briefcase" style="width: 17px; height: 17px;"></i> Official</a>
</li>';
}
else
{
$Alerts='';
$Accounts='';
$Rental='';
$Official='';
}
$Help_Desk='<li class="nav-item '.((($current_file_name=='helpdesk.php')||($current_file_name=='helpdeskadd.php')||($current_file_name=='helpdeskedit.php'))?'active':'').'">
<a class="nav-link" href="helpdesk.php">
<i class="fas fa-comments" style="width: 17px; height: 17px;"></i> Help Desk</a>
</li>';
$User_Manual='<li class="nav-item '.(($current_file_name=='usermanual.php')?'active':'').'">
<a class="nav-link" href="usermanual.php">
<i class="fas fa-fw fa-file-pdf" style="width: 17px; height: 17px;"></i> User Manual</a>
</li>';
$Software_Updates='<li class="nav-item '.(($current_file_name=='swupdates.php')?'active':'').'">
<a class="nav-link" href="swupdates.php">
<i class="far fa-regular fa-clock" style="width: 17px; height: 17px;"></i> Software Updates</a>
</li>';
if($callview=='1')
{
$Calls='
<li class="nav-item '.((($current_file_name=='callnew.php')||($current_file_name=='consignee.php')|| ($current_file_name=='calls.php')||($current_file_name=='scrdetails.php')||($current_file_name=='callstatus.php')||($current_file_name=='complaint.php')||($current_file_name=='callsedit.php')||($current_file_name=='callsmodify.php')||($current_file_name=='serialnumberedit.php'))?'active':'').'">
<a class="nav-link" href="calls.php">
<i class="fas fa-fw fa-phone" style="width: 17px; height: 17px;"></i> Calls</a>
</li>';
}
else{
$Calls='';
}
if(($livelocation=='1')&&($engineerperformance=='1'))
{
$Engineers='<li class="nav-item '.((($current_file_name=='mapengineer.php')||($current_file_name=='mapengineerda1.php')||($current_file_name=='mapengineerview.php')||($current_file_name=='mapengineerda.php'))?'active':'').'">
<a class="nav-link" href="mapengineer.php">
<i class="fas fa-fw fa-user-cog style="width: 17px; height: 17px;""></i> Engineers</a>
</li>';
}
else
{
$Engineers='';
}
if(($liveplan=='GOLD')||($liveplan=='DIAMOND'))
{
if($callview=='1')
{
$Carry_In='<li class="nav-item '.((($current_file_name=='inhousedashboard.php')||($current_file_name=='deliverynotes.php')||($current_file_name=='callnew.php')||($current_file_name=='inhousecalls.php')||($current_file_name=='oemdetails.php')||($current_file_name=='oemlisting.php')||($current_file_name=='oemedetails.php')||($current_file_name=='oemreport.php')||($current_file_name=='godown.php')||($current_file_name=='oemcdetails.php')||($current_file_name=='oemprocess.php'))?'active':'').'">
<a class="nav-link" href="inhousedashboard.php">
<i class="far fa-building" style="width: 17px; height: 17px;"></i> Carry-In</a>
</li>';
}
else
{
$Carry_In='';
}
}
else
{
$Carry_In='';
}  
if($addconsignee=='1')
{
$Customers='<li class="nav-item '.((($current_file_name=='consigneesearch1.php')||($current_file_name=='consignee.php')||($current_file_name=='consigneeview.php')||($current_file_name=='consigneeadd.php')||($current_file_name=='consigneeedit.php')||($current_file_name=='warrantycustomersall.php')||($current_file_name=='warrantycustomers.php')||($current_file_name=='warrantycustomersexpired.php')||($current_file_name=='amccustomers.php')||($current_file_name=='amcgoingtoexpirecustomers.php')||($current_file_name=='amcexpiredcustomers.php')||($current_file_name=='consigneemerge.php')||($current_file_name=='consigneeunique.php')||($current_file_name=='mapcustomers.php')||($current_file_name=='enquiryadd.php')||($current_file_name=='enquiryedit.php'))?'active':'').'">
<a class="nav-link" href="consignee.php">
<i class="far fa-regular fa-user" style="width: 17px; height: 17px;"></i> Customers</a>
</li>';
}
else
{
$Customers='';
}
if(($addinvoice=='1')&&($servicecharges=='1')&&($salesorder=='1')&&($sellprice=='1'))
{
$Sales='
<li class="nav-item '.((($current_file_name=='invoice.php')||($current_file_name=='invoiceadd.php')||($current_file_name=='invoiceedit.php')||($current_file_name=='exporttallys.php')||($current_file_name=='exporttally.php')||($current_file_name=='salesperson.php')||($current_file_name=='salesorderlist.php')||($current_file_name=='salesordernew.php')||($current_file_name=='salesorderedit.php')||($current_file_name=='salesorderdc.php')||($current_file_name=='salesorderdn.php')||($current_file_name=='draftlisting.php')||($current_file_name=='sdraftlisting.php'))?'active':'').'">
<a class="nav-link" href="exporttallysearch.php">
<i class="far fa-money-bill-alt" style="width: 17px; height: 17px;"></i> Sales Order</a>
</li>';
if(($liveplan=='DIAMOND'))
{
$Quotations='<li class="nav-item '.((($current_file_name=='quotations.php')||($current_file_name=='newquotationadd.php')||($current_file_name=='quotationgenedit.php')||($current_file_name=='quotationgenview.php')||($current_file_name=='amcquotations.php')||($current_file_name=='followupadd.php')||($current_file_name=='amcquotationgenview.php')||($current_file_name=='amcfollowupadd.php')||($current_file_name=='amcquotationgenedit.php')||($current_file_name=='amcedit.php')||($current_file_name=='newamcquotationadd.php')||($current_file_name=='amcrenew.php')||($current_file_name=='amcrenewal.php'))?'active':'').'">
<a class="nav-link" href="quotations.php">
<i class="fas fa-fw fa-check" style="width: 17px; height: 17px;"></i> Quotations</a>
</li>';
}
else
{
$Sales='';
$Quotations='';
}
}
else
{
$Sales='';
$Quotations='';
}
if(($liveplan=='DIAMOND'))
{
if($exportreport=='1')
{
$Reports='<li class="nav-item '.((($current_file_name=='report.php'))?'active':'').'">
<a class="nav-link" href="report.php">
<i class="fas fa-fw fa-chart-bar" style="width: 17px; height: 17px;"></i> Reports</a>
</li>';
}
else
{
$Reports='';
}
}
else
{
$Reports='';
}
/*if($uploaddata=='1')
{
$Product='<li class="nav-item '.((($current_file_name=='product.php')||($current_file_name=='productadd.php')||($current_file_name=='productedit.php')||($current_file_name=='mark.php')||($current_file_name=='markadd.php')||($current_file_name=='markedit.php')||($current_file_name=='productmerge.php')||($current_file_name=='saleproduct.php')||($current_file_name=='saleproductedit.php'))?'active':'').'">
<a class="nav-link" href="product.php">
<i class="fas fa-solid fa-database" style="width: 17px; height: 17px;"></i> Product</a>
</li>';
}
else
{
$Product='';
}*/
if($uploaddata=='1')
{
$Data='<li class="nav-item '.((($current_file_name=='importtally.php')||($current_file_name=='upload.php')||($current_file_name=='uploadhistory.php')||($current_file_name=='uploadxml.php')||($current_file_name=='uploadtally.php')||($current_file_name=='warrantymissing.php'))?'active':'').'">
<a class="nav-link" href="upload.php">
<i class="fas fa-fw fa-file-excel" style="width: 17px; height: 17px;"></i> Data</a>
</li>';
}
else
{
$Data='';
}
if($usercreation=='1')
{
$Users='<li class="nav-item '.((($current_file_name=='users.php')||($current_file_name=='usersd.php')||($current_file_name=='adminuser.php')||($current_file_name=='adminuseradd.php')||($current_file_name=='adminuseredit.php')||($current_file_name=='engineer.php')||($current_file_name=='engineeradd.php')||($current_file_name=='engineeredit.php')||($current_file_name=='useraccess.php')||($current_file_name=='salesrep.php')||($current_file_name=='salesrepadd.php')||($current_file_name=='salesrepedit.php'))?'active':'').'">
<a class="nav-link" href="users.php">
<i class="fas fa-fw fa-users" style="width: 17px; height: 17px;"></i> Users</a>
</li>';
}
else
{
$Users='';
}
if($settings=='1')
{
$Master='<li class="nav-item '.((($current_file_name=='masters.php')||($current_file_name=='pointsystem.php')||($current_file_name=='callhandling.php')||($current_file_name=='coordinator.php')||($current_file_name=='ctype.php')||($current_file_name=='reportedproblem.php')||($current_file_name=='problemobserved.php')||($current_file_name=='problemobservedadd.php')||($current_file_name=='problemobservededit.php')||($current_file_name=='actiontaken.php')||($current_file_name=='reportedproblemadd.php')||($current_file_name=='reportedproblemedit.php')||($current_file_name=='actiontakenadd.php')||($current_file_name=='actiontakenedit.php')||($current_file_name=='callnature.php')||($current_file_name=='callnatureadd.php')||($current_file_name=='callnatureedit.php')||($current_file_name=='assest.php')||($current_file_name=='custcategory.php')||($current_file_name=='regtype.php')||($current_file_name=='regtypeadd.php')||($current_file_name=='regtypeedit.php')||($current_file_name=='tender.php')||($current_file_name=='district.php')||($current_file_name=='masters.php')||($current_file_name=='godowns.php')||($current_file_name=='worktype.php')||($current_file_name=='worktypeadd.php')||($current_file_name=='acknowledgementsettings.php')||($current_file_name=='worktypeedit.php')||($current_file_name=='quotationsettings.php')||($current_file_name=='holiday.php')||($current_file_name=='spare.php')||($current_file_name=='suppliers.php')||($current_file_name=='material.php')||($current_file_name=='tenderno.php')||($current_file_name=='tendernoadd.php')||($current_file_name=='tendernoedit.php')||($current_file_name=='formsettings.php')||($current_file_name=='formsettingedit.php')||($current_file_name=='alertsettings.php')||($current_file_name=='branches.php')||($current_file_name=='branchesadd.php')||($current_file_name=='gstsettings.php')||($current_file_name=='branchesedit.php')||($current_file_name=='expense.php')||($current_file_name=='expenseadd.php')||($current_file_name=='expenseedit.php')||($current_file_name=='gstpercentage.php')||($current_file_name=='gstpercentageadd.php')||($current_file_name=='gstpercentageedit.php')||($current_file_name=='places.php')||($current_file_name=='placeadd.php')||($current_file_name=='placeedit.php')||($current_file_name=='quotationtype.php')||($current_file_name=='quotationtypeadd.php')||($current_file_name=='quotationtypeedit.php')||($current_file_name=='quotationatype.php')||($current_file_name=='quotationatypeadd.php')||($current_file_name=='quotationatypeedit.php')||($current_file_name=='subcompany.php')||($current_file_name=='subcompanyadd.php')||($current_file_name=='subcompanyedit.php')||($current_file_name=='custcategoryadd.php')||($current_file_name=='custcategoryedit.php')||($current_file_name=='assestadd.php')||($current_file_name=='assestedit.php')||($current_file_name=='tenderadd.php')||($current_file_name=='tenderedit.php')||($current_file_name=='materialadd.php')||($current_file_name=='materialedit.php')||($current_file_name=='godownadd.php')||($current_file_name=='godownedit.php')||($current_file_name=='spareadd.php')||($current_file_name=='spareedit.php')||($current_file_name=='supplieradd.php')||($current_file_name=='supplieredit.php')||($current_file_name=='districtedit.php')||($current_file_name=='districtadd.php')||($current_file_name=='holidayadd.php')||($current_file_name=='holidayedit.php')||($current_file_name=='sidebarorder.php')||($current_file_name=='termconditionservice.php')||($current_file_name=='themecolor.php'))?'active':'').'">
<a class="nav-link" href="masters.php">
<i class="far fa-regular fa-sun" style="width: 17px; height: 17px;"></i> Master</a>
</li>';
}
else
{
$Master='';
}
if(($liveplan=='DIAMOND'))
{
if($updates=='1')
{
$Updates='<li class="nav-item '.((($current_file_name=='updates.php')||($current_file_name=='updatesadd.php')||($current_file_name=='updatesedit.php'))?'active':'').'">
<a class="nav-link" href="updates.php">
<i class="fas fa-fw fa-bullhorn" style="width: 17px; height: 17px;"></i> Updates</a>
</li>';
}
else
{
$Updates='';
}
}
else
{
$Updates='';
}
?>
<ul class="navbar-nav sidebar sidebar-dark bg-navb text-white accordion toggled" id="accordionSidebar">

<a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color:#3d8eb9" href="dashboard.php">
<div class="sidebar-brand-icon rotate-n-15"></div>
<div class="sidebar-brand-text mx-3"></div>
</a>
<?php
foreach($sidebars as $sb)
{
echo $$sb;
}
?>
<!-- Divider -->
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>