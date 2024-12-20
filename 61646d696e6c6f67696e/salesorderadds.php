<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
$consigneename=mysqli_real_escape_string($connection, $_POST['consigneename']);
$buyermainid=mysqli_real_escape_string($connection, $_POST['buyermainid']);
$consigneemainid=mysqli_real_escape_string($connection, $_POST['consigneemainid']);
$sono=mysqli_real_escape_string($connection, $_POST['sono']);
$dnno=mysqli_real_escape_string($connection, $_POST['dnno']);
$sodate=mysqli_real_escape_string($connection, $_POST['sodate']);
$pono=mysqli_real_escape_string($connection, $_POST['pono']);
$podate=mysqli_real_escape_string($connection, $_POST['podate']);
$otherreference=mysqli_real_escape_string($connection, $_POST['otherreference']);
$custreference=mysqli_real_escape_string($connection, $_POST['custreference']);
$tender=mysqli_real_escape_string($connection, $_POST['tender']);
$duedays=mysqli_real_escape_string($connection, $_POST['duedays']);
$salesperson=mysqli_real_escape_string($connection, $_POST['salesperson']);
$shipment=mysqli_real_escape_string($connection, $_POST['shipment']);
$deliverymethod=mysqli_real_escape_string($connection, $_POST['deliverymethod']);
$deliveryremarks=mysqli_real_escape_string($connection, $_POST['deliveryremarks']);
$pricemark=mysqli_real_escape_string($connection, $_POST['pricemark']);
$totalitems=mysqli_real_escape_string($connection, $_POST['totalitems']);
$totalqty=mysqli_real_escape_string($connection, $_POST['totalqty']);
$notes=mysqli_real_escape_string($connection, $_POST['notes']);
$agentname=mysqli_real_escape_string($connection, $_POST['agentname']);
$lrno=mysqli_real_escape_string($connection, $_POST['lrno']);
$vechileno=mysqli_real_escape_string($connection, $_POST['vechileno']);
$dispatch=mysqli_real_escape_string($connection, $_POST['dispatch']);
$destination=mysqli_real_escape_string($connection, $_POST['destination']);
 
 
if(file_exists($_FILES["attachments"]['tmp_name'])) {
			$target_dir = "../padhivetram/prof/";
				$target_file = $target_dir .time(). basename($_FILES["attachments"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				  if (move_uploaded_file($_FILES["attachments"]["tmp_name"], $target_file)) 
				  {
					$attachments=$target_file;
				  } else 
				  {
					$attachments="";
				  }
				  } else 
				  {
					$attachments="";
				  }

$subtotalamount=mysqli_real_escape_string($connection, $_POST['subtotalamount']);
$totalgstamount=mysqli_real_escape_string($connection, $_POST['totalgstamount']);
$netamount=mysqli_real_escape_string($connection, $_POST['netamount']);
$shippingamount=mysqli_real_escape_string($connection, $_POST['shippingamount']);
$grandtotal=mysqli_real_escape_string($connection, $_POST['grandtotal']);
$terms=mysqli_real_escape_string($connection, $_POST['terms']);
		
	if(($sono!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcsaleorder WHERE sono ='{$sono}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon == 0) 
		{	
		//start for loop	 
	for($i=0;$i<count($_POST['stockitem']);$i++)
	{ 
 $j=$i+1;
			
			
		
			
$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
$qty=mysqli_real_escape_string($connection, $_POST['qty'][$i]);
$rate=mysqli_real_escape_string($connection, $_POST['rate'][$i]);
$productamount=mysqli_real_escape_string($connection, $_POST['productamount'][$i]);
$discount=mysqli_real_escape_string($connection, $_POST['discount'][$i]);
$discountmode=mysqli_real_escape_string($connection, $_POST['discountmode'][$i]);
$discountamount=mysqli_real_escape_string($connection, $_POST['discountamount'][$i]);
$pretotalamount=mysqli_real_escape_string($connection, $_POST['pretotalamount'][$i]);
$gstper=mysqli_real_escape_string($connection, $_POST['gstper'][$i]);
$igstper=mysqli_real_escape_string($connection, $_POST['igstper'][$i]);
$cgstper=mysqli_real_escape_string($connection, $_POST['cgstper'][$i]);
$sgstper=mysqli_real_escape_string($connection, $_POST['sgstper'][$i]);
$igstamount=mysqli_real_escape_string($connection, $_POST['igstamount'][$i]);
$cgstamount=mysqli_real_escape_string($connection, $_POST['cgstamount'][$i]);
$sgstamount=mysqli_real_escape_string($connection, $_POST['sgstamount'][$i]);
$gstamount=mysqli_real_escape_string($connection, $_POST['gstamount'][$i]);
$totalamount=mysqli_real_escape_string($connection, $_POST['totalamount'][$i]);

$productmainid=mysqli_real_escape_string($connection, $_POST['productmainid'][$i]);
$productid=mysqli_real_escape_string($connection, $_POST['productid'][$i]);
$stockmaincategory=mysqli_real_escape_string($connection, $_POST['stockmaincategory'][$i]);
$stocksubcategory=mysqli_real_escape_string($connection, $_POST['stocksubcategory'][$i]);
$typeofproduct=mysqli_real_escape_string($connection, $_POST['typeofproduct'][$i]);
$stockname=mysqli_real_escape_string($connection, $_POST['stockname'][$i]);
$componenttype=mysqli_real_escape_string($connection, $_POST['componenttype'][$i]);
$componentname=mysqli_real_escape_string($connection, $_POST['componentname'][$i]);
$make=mysqli_real_escape_string($connection, $_POST['make'][$i]);
$capacity=mysqli_real_escape_string($connection, $_POST['capacity'][$i]);
$warranty=mysqli_real_escape_string($connection, $_POST['warranty'][$i]);
$description=mysqli_real_escape_string($connection, $_POST['description'][$i]);
$gst=mysqli_real_escape_string($connection, $_POST['gst'][$i]);
$currentstock=mysqli_real_escape_string($connection, $_POST['currentstock'][$i]);
$type=mysqli_real_escape_string($connection, $_POST['type'][$i]);
$sku=mysqli_real_escape_string($connection, $_POST['sku'][$i]);
$unit=mysqli_real_escape_string($connection, $_POST['unit'][$i]);
$hsncode=mysqli_real_escape_string($connection, $_POST['hsncode'][$i]);
$taxpreference=mysqli_real_escape_string($connection, $_POST['taxpreference'][$i]);
$gstpercentage=mysqli_real_escape_string($connection, $_POST['gstpercentage'][$i]);
$igstpercentage=mysqli_real_escape_string($connection, $_POST['igstpercentage'][$i]);
$godownname=mysqli_real_escape_string($connection, $_POST['godownname'.$j]);
$serialnumber=mysqli_real_escape_string($connection, $_POST['serialnumber'][$i]);
$department=mysqli_real_escape_string($connection, $_POST['department'][$i]);


 $sqlup = "INSERT INTO jrcsaleorder( consigneename, buyermainid, consigneemainid, dnno,sono, sodate, pono, podate, otherreference, custreference, tender, duedays, salesperson, shipment, deliverymethod, deliveryremarks, pricemark, stockitem, qty, rate, productamount, discount, discountmode, discountamount, pretotalamount, gstper, igstper, cgstper, sgstper, igstamount, cgstamount,sgstamount,gstamount,totalamount,totalitems,totalqty,notes,agentname,lrno,vechileno,dispatch,destination,attachments,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,terms,productmainid,productid,stockmaincategory,stocksubcategory,typeofproduct,stockname,componenttype,componentname,make,capacity,warranty,description,gst,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,igstpercentage,godownname,serialnumber,department ) VALUES ( '$consigneename', '$buyermainid', '$consigneemainid', '$dnno','$sono', '$sodate', '$pono', '$podate', '$otherreference', '$custreference', '$tender', '$duedays', '$salesperson', '$shipment', '$deliverymethod', '$deliveryremarks', '$pricemark', '$stockitem', '$qty', '$rate', '$productamount', '$discount', '$discountmode', '$discountamount', '$pretotalamount', '$gstper', '$igstper', '$cgstper', '$sgstper', '$igstamount', '$cgstamount', '$sgstamount', '$gstamount', '$totalamount', '$totalitems', '$totalqty', '$notes', '$agentname', '$lrno', '$vechileno','$dispatch','$destination', '$attachments', '$subtotalamount', '$totalgstamount', '$netamount', '$shippingamount', '$grandtotal', '$terms', '$productmainid', '$productid', '$stockmaincategory', '$stocksubcategory', '$typeofproduct', '$stockname', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$description', '$gst', '$currentstock', '$type', '$sku', '$unit', '$hsncode', '$taxpreference', '$gstpercentage', '$igstpercentage','$godownname','$serialnumber','$department')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				//for history update
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Sales Order', '{$tid}', 'jrcsaleorder')");
				//for product stock decrement
				$sqlstock = "SELECT id,currentstock From jrcproduct where id='$stockitem'";
				$querystock = mysqli_query($connection, $sqlstock);
				$rowCountstock = mysqli_num_rows($querystock);
				if(!$querystock){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountstock > 0)
				{
				$rowstock = mysqli_fetch_array($querystock);
				$nowcurrentstock=$rowstock['currentstock']-$qty;
				 mysqli_query($connection, "update jrcproduct set currentstock='$nowcurrentstock' where id='$stockitem'");
				}
				//for product godownwise decreament
				
	 	$sqlstockgo = "SELECT id,availablestock From jrcproductstock where  productid='$stockitem' and godownid='$godownname'";
				$querystockgo = mysqli_query($connection, $sqlstockgo);
				$rowCountstockgo = mysqli_num_rows($querystockgo);
				if(!$querystockgo){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountstockgo > 0)
				{
				$rowstockgo = mysqli_fetch_array($querystockgo);
				$nowcurrentstockgo=$rowstockgo['availablestock']-$qty;
				 mysqli_query($connection, "update jrcproductstock set availablestock='$nowcurrentstockgo' where productid='$stockitem' and godownid='$godownname'");
				}
				else
				{
					$nowcurrentstockgo=0-$qty;
					mysqli_query($connection, "insert into  jrcproductstock set availablestock='$nowcurrentstockgo' , productid='$stockitem' , godownid='$godownname'");
			
				}
			}
}
//End for loop

                //for invoice increment
				 $sqlinvoice = "SELECT invoiceno from jrcinvoice";
				$queryinvoice = mysqli_query($connection, $sqlinvoice);
				$rowCountinvoice = mysqli_num_rows($queryinvoice);
				if(!$queryinvoice){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountinvoice > 0)
				{
				$rowinvoice = mysqli_fetch_array($queryinvoice);
				$total=$rowinvoice['invoiceno']+1;
				}
			    mysqli_query($connection, "update jrcinvoice set invoiceno='$total' ");
				
				//for DNNO  increment
				 $sqldn = "SELECT dnno from jrcsrno";
				$querydn = mysqli_query($connection, $sqldn);
				$rowCountdn = mysqli_num_rows($querydn);
				if(!$querydn){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountdn > 0)
				{
				$rowdn = mysqli_fetch_array($querydn);
				$total1=$rowdn['dnno']+1;
				}
			    mysqli_query($connection, "update jrcsrno set dnno='$total1' ");
				
				 //for salesperson amount increment
				 $billedamount='';
				$sqlperson = "SELECT id, totalbilledamount,totalbalanceamount From jrcsalesperson where email='$salesperson'";
				$queryperson = mysqli_query($connection, $sqlperson);
				$rowCountperson = mysqli_num_rows($queryperson);
				if(!$queryperson){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountperson > 0)
				{
				$rowperson = mysqli_fetch_array($queryperson);
				$billedamount=$rowperson['totalbilledamount']+$grandtotal;
				$balanceamount=$rowperson['totalbalanceamount']+$grandtotal;
				}
			    mysqli_query($connection, "update jrcsalesperson set totalbilledamount='$billedamount', totalbalanceamount='$balanceamount' where email='$salesperson'");
				
				//for consignee amount increment
				$sqlcon = "SELECT id, totalbilledamount,totalbalanceamount From jrcconsignee where id='$consigneemainid'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
				$rowcon = mysqli_fetch_array($querycon);
				$billedamount1=$rowcon['totalbilledamount']+$grandtotal;
				$balanceamount1=$rowcon['totalbalanceamount']+$grandtotal;
				}
				
                mysqli_query($connection, "update jrcconsignee set totalbilledamount='$billedamount1',totalbalanceamount='$balanceamount1' where id='$consigneemainid'");
				header("Location: salesorderlist.php?remarks=Added Successfully");
				
	    }
		else
			{
			header("Location: salesorderlist.php?error=This record is Already Found! Kindly check in All Sales Order List");
			}
	}
	else
			{
				header("Location: salesorderlist.php?error=Error Data");
			}
}
else
			{
				header("Location: salesorderlist.php");
			}
?>