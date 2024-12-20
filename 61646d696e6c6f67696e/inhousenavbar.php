<nav class="navbar navbar-expand-md navbar-color  bg-color mb-2 topnavbar shadow">
<button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNavDropdown">
<ul class="navbar-nav">
<li class="nav-item p-1">
<a class="nav-link1 <?=(($current_file_name=='inhousedashboard.php')||($current_file_name=='oemlisting.php')) ?'active':''?>"  href="inhousedashboard.php">
<div class="cardnav <?=(($current_file_name=='inhousedashboard.php')||($current_file_name=='oemlisting.php')) ?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-business-time"></i> &nbsp; 
     <span>Dashboard</span>
    </div>
  </div>
</a></li>
<li class="nav-item p-1">
<a class="nav-link1 <?=($current_file_name=='callnew.php')?'active':''?>"  href="callnew.php?at=in">
<div class="cardnav <?=($current_file_name=='callnew.php')?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-phone-square"></i> &nbsp; 
     <span>Add Complaint</span>
    </div>
  </div>
</a></li>
<!--li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-phone-square"></i> &nbsp; Add New Call
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=($current_file_name=='callnew.php?at=in')?'active':''?>"  href="callnew.php?at=in"><i class="fas fa-phone-square"></i> &nbsp;Add New Call (New Customer)</a>
<a class="dropdown-item <?=($current_file_name=='consignee.php?at=in&remarks=Search and Verify Customer then Proceed to Take Call')?'active':''?>"  href="consignee.php?at=in&remarks=Search and Verify Customer then Proceed to Take Call"><i class="fas fa-phone-square"></i> &nbsp;Add New Call (Existing Customer)</a>
</div>
</li-->
<li class="nav-item dropdown p-1">
<a class="nav-link1  <?=($current_file_name1=='inhousecalls.php?status=0')||($current_file_name1=='inhousecalls.php?status=1')||($current_file_name1=='inhousecalls.php?status=2')||($current_file_name1=='inhousecalls.php?status=3')||($current_file_name=='inhousecalls.php')?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=($current_file_name1=='inhousecalls.php?status=0')||($current_file_name1=='inhousecalls.php?status=1')||($current_file_name1=='inhousecalls.php?status=2')||($current_file_name1=='inhousecalls.php?status=3')||($current_file_name=='inhousecalls.php')?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-phone"></i> &nbsp; 
     <span class="dropdown-toggle ">Complaint Status</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=($current_file_name1=='inhousecalls.php?status=0')?'active':''?>"  href="inhousecalls.php?status=0"><i class="fas fa-phone"></i> &nbsp;Open Calls</a>
<a class="dropdown-item <?=($current_file_name1=='inhousecalls.php?status=1')?'active':''?>"  href="inhousecalls.php?status=1"><i class="fas fa-phone"></i> &nbsp;Pending Calls</a>
<a class="dropdown-item <?=($current_file_name1=='inhousecalls.php?status=2')?'active':''?>"  href="inhousecalls.php?status=2"><i class="fas fa-phone"></i> &nbsp;Completed Calls</a>
<a class="dropdown-item <?=($current_file_name1=='inhousecalls.php?status=3')?'active':''?>"  href="inhousecalls.php?status=3"><i class="fas fa-phone"></i> &nbsp;Cancelled Calls</a>
<a class="dropdown-item <?=($current_file_name=='inhousecalls.php')?'active':''?>"  href="inhousecalls.php"><i class="fas fa-phone"></i> &nbsp;Overall Call History</a></div>
</li>
<li class="nav-item dropdown p-1">
<a class="nav-link1 <?=($current_file_name1=='oemlisting.php?dtype=To be Sent')||($current_file_name1=='oemlisting.php?dtype=Sent')||($current_file_name1=='oemlisting.php?dtype=To be Received')||($current_file_name1=='oemlisting.php?dtype=Received')?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=($current_file_name1=='oemlisting.php?dtype=To be Sent')||($current_file_name1=='oemlisting.php?dtype=Sent')||($current_file_name1=='oemlisting.php?dtype=To be Received')||($current_file_name1=='oemlisting.php?dtype=Received')?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-share"></i> &nbsp; 
     <span class="dropdown-toggle ">OEM Claims</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<!--a class="dropdown-item <?//=($current_file_name=='oemlisting.php?dtype=Received through Courier')?'active':''?>"  href=	"oemlisting.php?dtype=Received through Courier"><i class="fas fa-share"></i> &nbsp;OEM - Received through Courier</a-->
<a class="dropdown-item <?=($current_file_name1=='oemlisting.php?dtype=To be Sent')?'active':''?>"  href="oemlisting.php?dtype=To be Sent"><i class="fas fa-share"></i> &nbsp;OEM - To be Sent</a>
<a class="dropdown-item <?=($current_file_name1=='oemlisting.php?dtype=Sent')?'active':''?>"  href="oemlisting.php?dtype=Sent"><i class="fas fa-share"></i> &nbsp;OEM - Sent</a>
<a class="dropdown-item <?=($current_file_name1=='oemlisting.php?dtype=To be Received')?'active':''?>"  href="oemlisting.php?dtype=To be Received"><i class="fas fa-share"></i> &nbsp;OEM - To be Received</a>
<a class="dropdown-item <?=($current_file_name1=='oemlisting.php?dtype=Received')?'active':''?>"  href="oemlisting.php?dtype=Received"><i class="fas fa-share"></i> &nbsp;OEM - Received</a></div>
<!--a class="dropdown-item <?//=($current_file_name=='oemlisting.php?dtype=Sent through Courier')?'active':''?>"  href="oemlisting.php?dtype=Sent through Courier"><i class="fas fa-share"></i> &nbsp;OEM - Sent through Courier</a-->
</li>
<li class="nav-item dropdown p-1">
<a class="nav-link1 <?=($current_file_name1=='oemlisting.php?dtype=Delivery')||($current_file_name1=='oemlisting.php?dtype=Delivered')?'active':''?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div class="cardnav <?=($current_file_name1=='oemlisting.php?dtype=Delivery')||($current_file_name1=='oemlisting.php?dtype=Delivered')?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-box-open"></i> &nbsp; 
     <span class="dropdown-toggle ">Serviced Products</span>
    </div>
  </div>
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item <?=($current_file_name1=='oemlisting.php?dtype=Delivery')?'active':''?>"  href="oemlisting.php?dtype=Delivery"><i class="fas fa-box-open"></i> &nbsp;Ready to Delivery</a>
<a class="dropdown-item <?=($current_file_name1=='oemlisting.php?dtype=Delivered')?'active':''?>"  href="oemlisting.php?dtype=Delivered"><i class="fas fa-box-open"></i> &nbsp;Delivered</a>
</li>
<li class="nav-item p-1">
<a class="nav-link1 <?=($current_file_name=='oemreport.php')?'active':''?>"  href="oemreport.php">
<div class="cardnav <?=($current_file_name=='oemreport.php')?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-file-alt"></i> &nbsp; 
     <span class="dropdown-toggle ">Report</span>
    </div>
  </div>

</a></li>
<!--li class="nav-item">
<a class="nav-link <?//=($current_file_name=='godown.php')?'active':''?>"  href="godown.php"><i class="fas fa-warehouse"></i> &nbsp;Godown</a></li-->
<li class="nav-item p-1">
<a class="nav-link1 <?=(($current_file_name=='deliverynotes.php') || ($current_file_name=='oembulkdcsent.php'))?'active':''?>"  href="deliverynotes.php">
<div class="cardnav <?=(($current_file_name=='deliverynotes.php') || ($current_file_name=='oembulkdcsent.php'))?'active':''?>" >
    <div class="cardnav-body text-center">
<i class="fas fa-paper-plane"></i> &nbsp; 
     <span class="dropdown-toggle ">Delivery Note</span>
    </div>
  </div>

</a></li>
</ul>
</div>
</nav>