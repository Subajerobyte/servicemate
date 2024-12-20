<nav class="navbar navbar-expand-md navbar-color  bg-color mb-2 topnavbar shadow">
<button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars text-white"></i>
</button>
<div class="collapse navbar-collapse" id="navbarNavDropdown">
<ul class="navbar-nav">
<li class="nav-item dropdown active p-1">
<a class="nav-link1 <?=(($current_file_name=='ctype.php')||($current_file_name=='ctypeadd.php')||($current_file_name=='ctypeedit.php') || ($current_file_name=='formsettings.php') || ($current_file_name=='alertsettings.php') || ($current_file_name=='branches.php')||($current_file_name=='branchesadd.php')||($current_file_name=='branchesedit.php') )?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

<div class="cardnav <?=(($current_file_name=='ctype.php')||($current_file_name=='ctypeadd.php')||($current_file_name=='ctypeedit.php') || ($current_file_name=='formsettings.php') || ($current_file_name=='alertsettings.php') || ($current_file_name=='branches.php')||($current_file_name=='branchesadd.php')||($current_file_name=='branchesedit.php') )?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-cog"></i> &nbsp; 
     <span class="dropdown-toggle ">General </span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='ctype.php')||($current_file_name=='ctypeadd.php')||($current_file_name=='ctypeedit.php'))?'active':''?>" href="ctype.php"><i class="fas fa-fw fa-cog"></i>&nbsp;Customer Settings</a>
<a class="dropdown-item <?=(($current_file_name=='formsettings.php'))?'active':''?>" href="formsettings.php"><i class="fas fa-fw fa-cog"></i>&nbsp;Default Form Settings</a>
<?php
if(($liveplan=='DIAMOND'))
{
?>
<a class="dropdown-item <?=(($current_file_name=='alertsettings.php'))?'active':''?>" href="alertsettings.php"><i class="fas fa-fw fa-cog"></i>&nbsp;Alert Settings</a>
<?php
}
?>
<?php
if(($branch=='1'))
{
?>
<a class="dropdown-item <?=(($current_file_name=='branches.php')||($current_file_name=='branchesadd.php')||($current_file_name=='branchesedit.php'))?'active':''?>" href="branches.php"><i class="fas fa-fw fa-cog"></i>&nbsp;Branch Settings</a>
<?php
}
?>
<a class="dropdown-item <?=($current_file_name=='gstsettings.php')?'active':''?>" href="gstsettings.php"><i class="fas fa-fw fa-cog"></i>&nbsp;GST Settings</a>
</div>
</li>
<?php
if(($liveplan=='DIAMOND'))
{
?>
<li class="nav-item dropdown p-1">
<a class="nav-link1 <?=(($current_file_name=='expense.php')||($current_file_name=='expenseadd.php')||($current_file_name=='expenseedit.php') || ($current_file_name=='gstpercentage.php')||($current_file_name=='gstpercentageadd.php')||($current_file_name=='gstpercentageedit.php') || ($current_file_name=='regtype.php')||($current_file_name=='regtypeadd.php')||($current_file_name=='regtypeedit.php') || ($current_file_name=='places.php')||($current_file_name=='placeadd.php')||($current_file_name=='placeedit.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='expense.php')||($current_file_name=='expenseadd.php')||($current_file_name=='expenseedit.php') || ($current_file_name=='gstpercentage.php')||($current_file_name=='gstpercentageadd.php')||($current_file_name=='gstpercentageedit.php') || ($current_file_name=='regtype.php')||($current_file_name=='regtypeadd.php')||($current_file_name=='regtypeedit.php') || ($current_file_name=='places.php')||($current_file_name=='placeadd.php')||($current_file_name=='placeedit.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-money-bill-wave"></i> &nbsp; 
     <span class="dropdown-toggle ">Accounts</span>
    </div>
  </div>

</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='expense.php')||($current_file_name=='expenseadd.php')||($current_file_name=='expenseedit.php'))?'active':''?>" href="expense.php"><i class="fas fa-money-bill-wave"></i>&nbsp;Expense Category</a>
<a class="dropdown-item <?=(($current_file_name=='gstpercentage.php')||($current_file_name=='gstpercentageadd.php')||($current_file_name=='gstpercentageedit.php'))?'active':''?>" href="gstpercentage.php">  <i class="fas fa-money-bill-wave"></i>&nbsp;GST Rates</a>
<a class="dropdown-item <?=(($current_file_name=='regtype.php')||($current_file_name=='regtypeadd.php')||($current_file_name=='regtypeedit.php'))?'active':''?>" href="regtype.php">  <i class="fas fa-fw fa-comments-dollar"></i>&nbsp;GST Registration Type</a>
<a class="dropdown-item <?=(($current_file_name=='places.php')||($current_file_name=='placeadd.php')||($current_file_name=='placeedit.php'))?'active':''?>" href="places.php"><i class="fa fa-map-marker"></i>&nbsp;State Code</a>
</div>
</li>
<?php
}

?>
<li class="nav-item dropdown p-1">
<a class="nav-link1 <?=(($current_file_name=='actiontaken.php')||($current_file_name=='actiontakenadd.php')||($current_file_name=='actiontakenedit.php') || ($current_file_name=='callnature.php')||($current_file_name=='callnatureadd.php')||($current_file_name=='callnatureedit.php') || ($current_file_name=='problemobserved.php')||($current_file_name=='problemobservedadd.php')||($current_file_name=='problemobservededit.php') || ($current_file_name=='reportedproblem.php')||($current_file_name=='reportedproblemadd.php')||($current_file_name=='reportedproblemedit.php') || ($current_file_name=='worktype.php')||($current_file_name=='worktypeadd.php')||($current_file_name=='worktypeedit.php') || ($current_file_name=='acknowledgementsettings.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

<div class="cardnav <?=(($current_file_name=='actiontaken.php')||($current_file_name=='actiontakenadd.php')||($current_file_name=='actiontakenedit.php') || ($current_file_name=='callnature.php')||($current_file_name=='callnatureadd.php')||($current_file_name=='callnatureedit.php') || ($current_file_name=='problemobserved.php')||($current_file_name=='problemobservedadd.php')||($current_file_name=='problemobservededit.php') || ($current_file_name=='reportedproblem.php')||($current_file_name=='reportedproblemadd.php')||($current_file_name=='reportedproblemedit.php') || ($current_file_name=='worktype.php')||($current_file_name=='worktypeadd.php')||($current_file_name=='worktypeedit.php') || ($current_file_name=='acknowledgementsettings.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-phone"></i> &nbsp; 
     <span class="dropdown-toggle ">Call</span>
    </div>
  </div>

</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='actiontaken.php')||($current_file_name=='actiontakenadd.php')||($current_file_name=='actiontakenedit.php'))?'active':''?>" href="actiontaken.php"><i class="fas fa-fw fa-phone"></i>&nbsp;Action Taken</a>
<a class="dropdown-item <?=(($current_file_name=='callnature.php')||($current_file_name=='callnatureadd.php')||($current_file_name=='callnatureedit.php'))?'active':''?>" href="callnature.php"><i class="fas fa-fw fa-phone"></i>&nbsp;Call Nature</a>
<a class="dropdown-item <?=(($current_file_name=='problemobserved.php')||($current_file_name=='problemobservedadd.php')||($current_file_name=='problemobservededit.php'))?'active':''?>" href="problemobserved.php"><i class="fas fa-fw fa-phone"></i>&nbsp;Problem Observed</a>
<a class="dropdown-item <?=(($current_file_name=='reportedproblem.php')||($current_file_name=='reportedproblemadd.php')||($current_file_name=='reportedproblemedit.php'))?'active':''?>" href="reportedproblem.php"><i class="fas fa-fw fa-phone"></i>&nbsp;Reported Problem</a>
<a class="dropdown-item <?=(($current_file_name=='worktype.php')||($current_file_name=='worktypeadd.php')||($current_file_name=='worktypeedit.php'))?'active':''?>" href="worktype.php"><i class="fas fa-fw fa-phone"></i>&nbsp;Work Type</a>
<a class="dropdown-item <?=($current_file_name=='acknowledgementsettings.php')?'active':''?>" href="acknowledgementsettings.php"><i class="fas fa-fw fa-phone"></i>&nbsp;Acknowledgement Receipt Settings</a>
</div>
</li>
<?php
if(($liveplan=='DIAMOND'))
{
?>
<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='quotationsettings.php') || ($current_file_name=='quotationtype.php')||($current_file_name=='quotationtypeadd.php')||($current_file_name=='quotationtypeedit.php') || ($current_file_name=='quotationatype.php')||($current_file_name=='quotationatypeadd.php')||($current_file_name=='quotationatypeedit.php') || ($current_file_name=='subcompany.php')||($current_file_name=='subcompanyadd.php')||($current_file_name=='subcompanyedit.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='quotationsettings.php') || ($current_file_name=='quotationtype.php')||($current_file_name=='quotationtypeadd.php')||($current_file_name=='quotationtypeedit.php') || ($current_file_name=='quotationatype.php')||($current_file_name=='quotationatypeadd.php')||($current_file_name=='quotationatypeedit.php') || ($current_file_name=='subcompany.php')||($current_file_name=='subcompanyadd.php')||($current_file_name=='subcompanyedit.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-file-alt"></i> &nbsp; 
     <span class="dropdown-toggle ">Quotation</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='quotationsettings.php'))?'active':''?>" href="quotationsettings.php"><i class="fas fa-fw fa-file-alt"></i>&nbsp;General Settings</a>
<a class="dropdown-item <?=(($current_file_name=='quotationtype.php')||($current_file_name=='quotationtypeadd.php')||($current_file_name=='quotationtypeedit.php'))?'active':''?>" href="quotationtype.php"><i class="fas fa-fw fa-file-alt"></i>&nbsp;Quotation Type</a>
<a class="dropdown-item <?=(($current_file_name=='quotationatype.php')||($current_file_name=='quotationatypeadd.php')||($current_file_name=='quotationatypeedit.php'))?'active':''?>" href="quotationatype.php"><i class="fas fa-fw fa-file-alt"></i>&nbsp;AMC Quotation Type</a>
<?php
if($settings=='1')
{
?>
<a class="dropdown-item <?=(($current_file_name=='subcompany.php')||($current_file_name=='subcompanyadd.php')||($current_file_name=='subcompanyedit.php'))?'active':''?>" href="subcompany.php"><i class="fas fa-fw fa-file-alt"></i>&nbsp;Sub Companies</a>
<?php
}
?>
</div>
</li>
<?php
}
?>
<?php
if(($liveplan=='DIAMOND'))
{
?>
<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='custcategory.php')||($current_file_name=='custcategoryadd.php')||($current_file_name=='custcategoryedit.php') || ($current_file_name=='assest.php')||($current_file_name=='assestadd.php')||($current_file_name=='assestedit.php') || ($current_file_name=='tenderno.php')||($current_file_name=='tendernoadd.php')||($current_file_name=='tendernoedit.php') ||($current_file_name=='tenderadd.php')||($current_file_name=='tenderedit.php')|| ($current_file_name=='tender.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='custcategory.php')||($current_file_name=='custcategoryadd.php')||($current_file_name=='custcategoryedit.php') || ($current_file_name=='assest.php')||($current_file_name=='assestadd.php')||($current_file_name=='assestedit.php') || ($current_file_name=='tenderno.php')||($current_file_name=='tendernoadd.php')||($current_file_name=='tendernoedit.php') ||($current_file_name=='tenderadd.php')||($current_file_name=='tenderedit.php')|| ($current_file_name=='tender.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-comments-dollar"></i> &nbsp; 
     <span class="dropdown-toggle">Sales</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='custcategory.php')||($current_file_name=='custcategoryadd.php')||($current_file_name=='custcategoryedit.php') )?'active':''?>" href="custcategory.php">  <i class="fas fa-fw fa-comments-dollar"></i>&nbsp;Customer Main Category</a>
<a class="dropdown-item <?=(($current_file_name=='assest.php')||($current_file_name=='assestadd.php')||($current_file_name=='assestedit.php'))?'active':''?>" href="assest.php">  <i class="fas fa-fw fa-comments-dollar"></i>&nbsp;Other Reference</a>
<a class="dropdown-item <?=(($current_file_name=='tender.php')||($current_file_name=='tenderadd.php')||($current_file_name=='tenderedit.php'))?'active':''?>" href="tender.php">  <i class="fas fa-fw fa-comments-dollar"></i>&nbsp;Tender Type</a>
<a class="dropdown-item <?=(($current_file_name=='tenderno.php')||($current_file_name=='tendernoadd.php')||($current_file_name=='tendernoedit.php'))?'active':''?>" href="tenderno.php">  <i class="fas fa-fw fa-comments-dollar"></i>&nbsp;Tender Number</a>
</div>
</li>
<?php
}

?>
<li class="nav-item dropdown p-1">
<a class="nav-link1 <?=(($current_file_name=='material.php')||($current_file_name=='materialadd.php')||($current_file_name=='materialedit.php') || ($current_file_name=='godowns.php')||($current_file_name=='godownadd.php')||($current_file_name=='godownedit.php') || ($current_file_name=='suppliers.php')||($current_file_name=='supplieradd.php')||($current_file_name=='supplieredit.php') || ($current_file_name=='spare.php')||($current_file_name=='spareadd.php')||($current_file_name=='spareedit.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='material.php')||($current_file_name=='materialadd.php')||($current_file_name=='materialedit.php') || ($current_file_name=='godowns.php')||($current_file_name=='godownadd.php')||($current_file_name=='godownedit.php') || ($current_file_name=='suppliers.php')||($current_file_name=='supplieradd.php')||($current_file_name=='supplieredit.php') || ($current_file_name=='spare.php')||($current_file_name=='spareadd.php')||($current_file_name=='spareedit.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-plug"></i> &nbsp; 
     <span class="dropdown-toggle ">Product</span>
    </div>
  </div>


</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='material.php')||($current_file_name=='materialadd.php')||($current_file_name=='materialedit.php'))?'active':''?>" href="material.php"><i class="fas fa-fw fa-plug"></i>&nbsp;Additional Materials</a>
<?php
if(($liveplan=='DIAMOND'))
{
?>
<a class="dropdown-item <?=(($current_file_name=='godowns.php')||($current_file_name=='godownadd.php')||($current_file_name=='godownedit.php'))?'active':''?>" href="godowns.php"><i class="fas fa-fw fa-plug"></i>&nbsp;Warehouses</a>
<a class="dropdown-item <?=(($current_file_name=='suppliers.php')||($current_file_name=='supplieradd.php')||($current_file_name=='supplieredit.php'))?'active':''?>" href="suppliers.php"><i class="fas fa-fw fa-plug"></i>&nbsp;Suppliers</a>
<?php
}

?>
<a class="dropdown-item <?=(($current_file_name=='spare.php')||($current_file_name=='spareadd.php')||($current_file_name=='spareedit.php'))?'active':''?>" href="spare.php"><i class="fas fa-fw fa-plug"></i>&nbsp;Spares</a>
</div>
</li>
<?php
if(($liveplan=='DIAMOND'))
{
?>
<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='rentalagreeedit.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='rentalagreeedit.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-download"></i> &nbsp; 
     <span class="dropdown-toggle ">Installation</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='rentalagreeedit.php'))?'active':''?>" href="rentalagreeedit.php"><i class="fas fa-fw fa-plus"></i>&nbsp;Rental Agreement</a>
<!-- <a class="dropdown-item <?//=(($current_file_name=='salesinstall.php'))?'active':''?>" href="salesinstall.php"><i class="fas fa-fw fa-plus"></i>&nbsp;Sales Installation Certificate</a> -->
</div>
</li>
<?php
}
?>
<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='district.php')||($current_file_name=='districtedit.php')||($current_file_name=='districtadd.php') || ($current_file_name=='holiday.php')||($current_file_name=='holidayadd.php')||($current_file_name=='holidayedit.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='district.php')||($current_file_name=='districtedit.php')||($current_file_name=='districtadd.php') || ($current_file_name=='holiday.php')||($current_file_name=='holidayadd.php')||($current_file_name=='holidayedit.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-plus"></i> &nbsp; 
     <span class="dropdown-toggle ">Other</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='district.php')||($current_file_name=='districtedit.php')||($current_file_name=='districtadd.php'))?'active':''?>" href="district.php"><i class="fas fa-fw fa-plus"></i>&nbsp;Districts</a>
<a class="dropdown-item <?=(($current_file_name=='holiday.php')||($current_file_name=='holidayadd.php')||($current_file_name=='holidayedit.php'))?'active':''?>" href="holiday.php"><i class="fas fa-fw fa-plus"></i>&nbsp;Holidays</a>
</div>
</li>
<?php
if(($liveplan=='DIAMOND'))
{
?>
<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='sidebarorder.php') || ($current_file_name=='themecolor.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='sidebarorder.php') || ($current_file_name=='themecolor.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-stream"></i> &nbsp; 
     <span class="dropdown-toggle ">Site</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='sidebarorder.php'))?'active':''?>" href="sidebarorder.php"><i class="fas fa-fw fa-stream"></i>&nbsp;Sidebar</a>
<a class="dropdown-item <?=(($current_file_name=='themecolor.php'))?'active':''?>" href="themecolor.php"><i class="fas fa-fw fa-stream"></i>&nbsp;Theme</a>
</div>
</li>
<?php
}
?>
<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='acknowledgementsettings.php') || ($current_file_name=='termconditionservice.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='acknowledgementsettings.php') || ($current_file_name=='termconditionservice.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-handshake"></i> &nbsp; 
     <span class="dropdown-toggle ">Service Report</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='acknowledgementsettings.php'))?'active':''?>" href="acknowledgementsettings.php"><i class="fas fa-fw fa-handshake"></i>&nbsp;Acknowledgement Receipt Settings</a>
<a class="dropdown-item <?=(($current_file_name=='termconditionservice.php'))?'active':''?>" href="termconditionservice.php"><i class="fas fa-handshake"></i>&nbsp;Service Terms & Conditions</a>
</div>
</li>



<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=(($current_file_name=='productadd.php') || ($current_file_name=='product.php') || ($current_file_name=='productmerge.php') || ($current_file_name=='warrantycycle.php') || ($current_file_name=='productlifetime.php') || ($current_file_name=='saleproduct.php'))?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=(($current_file_name=='productadd.php') || ($current_file_name=='product.php') || ($current_file_name=='productmerge.php') || ($current_file_name=='warrantycycle.php') || ($current_file_name=='productlifetime.php') || ($current_file_name=='saleproduct.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-fw fa-asterisk"></i> &nbsp; 
     <span class="dropdown-toggle ">Product Details</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=(($current_file_name=='productadd.php'))?'active':''?>" href="productadd.php"><i class="fas fa-fw fa-asterisk"></i>&nbsp;Add New Product</a>
<a class="dropdown-item <?=(($current_file_name=='product.php'))?'active':''?>" href="product.php"><i class="fas fa-asterisk"></i>&nbsp;Product Details</a>
<a class="dropdown-item <?=(($current_file_name=='productmerge.php'))?'active':''?>" href="productmerge.php"><i class="fas fa-asterisk"></i>&nbsp;Merge Product Details</a>
<a class="dropdown-item <?=(($current_file_name=='warrantycycle.php'))?'active':''?>" href="warrantycycle.php"><i class="fas fa-asterisk"></i>&nbsp;Warranty Cycle Missing Products</a>
<a class="dropdown-item <?=(($current_file_name=='productlifetime.php'))?'active':''?>" href="productlifetime.php"><i class="fas fa-asterisk"></i>&nbsp;Lifetime Missing Products</a>
<a class="dropdown-item <?=(($current_file_name=='saleproduct.php'))?'active':''?>" href="saleproduct.php"><i class="fas fa-asterisk"></i>&nbsp;Price Details</a>
</div>
</li>
</ul>
</div>
</nav>