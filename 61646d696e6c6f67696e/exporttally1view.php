<?php
include('lcheck.php');
?>
<div id="wrapper">
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<div class="container-fluid">
<!-- Page Heading -->
<!--div class="d-sm-flex align-items-center justify-content-between mb-1">
<h1 class="h4 mb-2 mt-2 text-gray-800">Sales Order View</h1>
</div-->

<?php 
if(isset($_POST['reftime']))
{
$reftime=mysqli_real_escape_string($connection,$_POST['reftime']);
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename']);
$sqlselect = "SELECT * From jrctallydraft where reftime='".$reftime."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowselect1 = mysqli_fetch_array($queryselect);
$rowselect1['discount'];
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">

<div class="card-body">

<div class="card-header py-1">
<h6 class=" font-weight-bold text-primary text-center">Sales Order Information</h6>
</div><br>

<table style="font-family: Arial, sans-serif;">
    <tr>
        <td style="width: 200px;">Registration Type</td>
        <td><?=$rowselect1['invoicetype']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">SO Number</td>
        <td><?=$rowselect1['invoicenofrom']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Other Reference</td>
        <td><?=$rowselect1['otherreference']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">P.O. No</td>
        <td><?=$rowselect1['pono']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">P.O. Date</td>
        <td><?=$rowselect1['podate']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Due Days</td>
        <td><?=$rowselect1['duedays']?></td>
    </tr>
</table>


<br>
<div class="card-header py-1">
<h6 class=" font-weight-bold text-primary text-center">Buyer Information</h6>
</div>
<br>
<div class="row">
<div class="col-6">
<table style="font-family: Arial, sans-serif;">
    <tr>
        <td style="width: 200px;">Buyer Name</td>
        <td><?=$rowselect1['buyername']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Main Category</td>
        <td><?=$rowselect1['maincategory']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Tender</td>
        <td><?=$rowselect1['tender']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Sub Category</td>
        <td><?=$rowselect1['subcategory']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Department Name</td>
        <td><?=$rowselect1['department']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Address 1</td>
        <td><?=$rowselect1['buyeraddress1']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Address 2</td>
        <td><?=$rowselect1['buyeraddress2']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Address 3</td>
        <td><?=$rowselect1['buyeraddress3']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Taluk</td>
        <td><?=$rowselect1['buyertaluk']?></td>
    </tr>
</table>
</div>
<div class="col-6">
<table style="font-family: Arial, sans-serif;">
	<tr>
        <td style="width: 200px;">District</td>
        <td><?=$rowselect1['buyerdistrict']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Pincode</td>
        <td><?=$rowselect1['buyerpincode']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">State Code & State</td>
        <td><?=$rowselect1['buyerstate']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Mobile Number</td>
        <td><?=$rowselect1['buyermobile']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Phone Number</td>
        <td><?=$rowselect1['buyerphone']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Contact Person</td>
        <td><?=$rowselect1['buyercontact']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">E-mail</td>
        <td><?=$rowselect1['buyermail']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">GSTIN No</td>
        <td><?=$rowselect1['bgst']?></td>
    </tr>
</table>
</div>
</div>


<br>

<div class="card-header py-1">
<h6 class="font-weight-bold text-primary text-center">Customer Information</h6>
</div>
<br>
<?php
$sqlselect2 = "SELECT * From jrctallydraft where reftime='".$reftime."' and consigneename='".$consigneename."'";
$queryselect2 = mysqli_query($connection, $sqlselect2);
$rowselect2 = mysqli_fetch_array($queryselect2);
?>
<table style="font-family: Arial, sans-serif;">
   
    <tr>
        <td style="width: 200px;">CONSIGNEE NAME</td>
        <td><?=$rowselect2['consigneename']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">DEPARTMENT</td>
        <td><?=$rowselect2['condepartment']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">ADDRESS 1</td>
        <td><?=$rowselect2['conaddress1']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">ADDRESS 2</td>
        <td><?=$rowselect2['conaddress2']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">ADDRESS 3</td>
        <td><?=$rowselect2['conaddress3']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">TALUK</td>
        <td><?=$rowselect2['contaluk']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">DISTRICT</td>
        <td><?=$rowselect2['condistrict']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">PIN CODE</td>
        <td><?=$rowselect2['conpincode']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">STATE CODE & STATE</td>
        <td><?=$rowselect2['constatecode']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">GST.NO.</td>
        <td><?=$rowselect2['congstno']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Contact Person</td>
        <td><?=$rowselect2['concontact']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">PHONE NO.</td>
        <td><?=$rowselect2['conphone']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">MOBILE.NO.</td>
        <td><?=$rowselect2['conmobile']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">MAIL ID</td>
        <td><?=$rowselect2['conemail']?></td>
    </tr>
</table>
<br>
<div class="card-header py-1">
<h6 class=" font-weight-bold text-primary text-center">Price Information</h6>
</div>
<br>
<div class="table-responsive">
<table class="table table-bordered font-13" id="dataTable" width="100%" cellspacing="0">
<thead>
<th>PRODUCT CODE</th>
<th>PRODUCT</th>
<th>HSN/SAC</th>
<th>QTY</th>
<th>SERIAL</th>
<th>Unit Price</th>
<th>IGST</th>
<th>SGST</th>
<th>CGST</th>
<th>IGST AMOUNT</th>
<th>SGST AMOUNT</th>
<th>CGST AMOUNT</th>
<th>TOTAL AMOUNT</th>
<th>warranty months</th>
</thead>
<tbody id="tabletobdy">
<?php
$sqlselect = "SELECT * From jrctallydraft where reftime='".$reftime."' and consigneename='".$consigneename."'";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
die("SQL query failed: " . mysqli_error($connection));
}
if($rowCountselect > 0)
{
$i=1;
$cons='';
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<tr>
<td><?=$rowselect['conproductcode']?></td>
<td><?=$rowselect['conproduct']?></td>
<td><?=$rowselect['conhsncode']?></td>
<td><?=$rowselect['conqty']?></td>
<td><?=$rowselect['conserialno']?></td>
<td><?=$rowselect['conunit']?></td>
<td><?=$rowselect['conigst']?></td>
<td><?=$rowselect['consgst']?></td>
<td><?=$rowselect['concgst']?></td>
<td><?=$rowselect['conigstamount']?></td>
<td><?=$rowselect['consgstamount']?></td>
<td><?=$rowselect['concgstamount']?></td>
<td><?=$rowselect['contotal']?></td>
<td><?=$rowselect['conwarranty']?></td>
</tr>
<?php
$i++;
$cons=$rowselect['consigneeno'];
}
}
?>
</tbody>
</table>
</div>
<br>
<div class="card-header py-1">
<h6 class=" font-weight-bold text-primary text-center">Total Price Information</h6>
</div>
<br>
<table style="font-family: Arial, sans-serif;">
    <tr>
        <td style="width: 200px;">Sub Total Amount</td>
        <td><?=$rowselect1['subtotalamount']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Total GST Amount</td>
        <td><?=$rowselect1['totalgstamount']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Net Amount</td>
        <td><?=$rowselect1['netamount']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Discount</td>
        <td><?=$rowselect1['discount']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Add Charges</td>
        <td><?=$rowselect1['addamount']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">Less Charges</td>
        <td><?=$rowselect1['lessamount']?></td>
    </tr>
    <tr>
        <td style="width: 200px;">BuyBack Charges</td>
        <td><?=$rowselect1['buyback']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">BuyBack Remarks</td>
        <td><?=$rowselect1['buyremark']?></td>
    </tr>
	<tr>
        <td style="width: 200px;">Grand Total (₹)</td>
        <td><?=$rowselect1['grandtotal']?></td>
    </tr>
	
</table>


</div>
</div>
<?php
}
?>
</div>
</div>

</div>
</div>
