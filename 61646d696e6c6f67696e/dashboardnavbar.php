<nav class="navbar navbar-expand-md navbar-color bg-color mb-2 topnavbar shadow">
  <button class="navbar-toggler btn btn-white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars"></i>
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="scrdetails.php">
            <div class="cardnav <?=($current_file_name=='scrdetails.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-phone"></i> Service Call Reports
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="report.php">
            <div class="cardnav <?=($current_file_name=='report.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fa fa-line-chart"></i> Analytical Reports
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="newquotationadd.php?noofproduts=1&noofscraps=1&submit=">
            <div class="cardnav <?=($current_file_name=='newquotationadd.php?noofproduts=1&noofscraps=1&submit=') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-plus"></i> &nbsp; New Quotation
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="quotationpage.php">
            <div class="cardnav <?=($current_file_name=='quotationpage.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-eye"></i> View Quotations
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="quotationtoso.php">
            <div class="cardnav <?=($current_file_name=='quotationtoso.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-exchange"></i> Convert Quote to SO
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="singleexporttallyadd.php?noofconsignee=1&maxproduct=1&getsubmit=Submit">
            <div class="cardnav <?=($current_file_name=='singleexporttallyadd.php?noofconsignee=1&maxproduct=1&getsubmit=Submit') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-file"></i> Single Sales Order Entry
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="draftlisting.php">
            <div class="cardnav <?=($current_file_name=='draftlisting.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-bell"></i> Sales Order Draft
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="exporttally.php">
            <div class="cardnav <?=($current_file_name=='exporttally.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-box-open"></i> Pending Sales Orders
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="exporttallyadd.php">
            <div class="cardnav <?=($current_file_name=='exporttallyadd.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-clone"></i> Multiple Sales Orders Entry
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="exporttallysearch.php">
            <div class="cardnav <?=($current_file_name=='exporttallysearch.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-search"></i> Search Sales Orders
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="compexporttally.php">
            <div class="cardnav <?=($current_file_name=='compexporttally.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-shopping-cart"></i> Completed Sales Orders
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="exporttallylisting.php?type=dc">
            <div class="cardnav <?=($current_file_name=='exporttallylisting.php?type=dc') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-shipping-fast"></i> Delivery Challan
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="exporttallylisting.php?type=inv">
            <div class="cardnav <?=($current_file_name=='exporttallylisting.php?type=inv') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-file-alt"></i> Invoice / E-Invoice
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="exporttally.php">
            <div class="cardnav <?=($current_file_name=='exporttally.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-shuttle-van"></i> E-Way Bill
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="salespayadd.php">
            <div class="cardnav <?=($current_file_name=='salespayadd.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-life-ring"></i> Payment Entry
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="outsalespay.php">
            <div class="cardnav <?=($current_file_name=='outsalespay.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-credit-card"></i> Outstanding Payments
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-2 p-1">
          <a class="nav-link1" href="resalespay.php">
            <div class="cardnav <?=($current_file_name=='resalespay.php') ? 'active' : ''?>">
              <div class="cardnav-body text-center">
                <i class="fas fa-thumbs-up"></i> Received Payments
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
