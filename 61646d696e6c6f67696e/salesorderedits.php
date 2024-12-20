<?php
include('lcheck.php');
if($uploaddata=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['id']))
	{
		
$consigneename=mysqli_real_escape_string($connection, $_POST['consigneename']);
$buyermainid=mysqli_real_escape_string($connection, $_POST['buyermainid']);
$consigneemainid=mysqli_real_escape_string($connection, $_POST['consigneemainid']);
$oconsigneemainid=mysqli_real_escape_string($connection, $_POST['oconsigneemainid']);
$sono=mysqli_real_escape_string($connection, $_POST['sono']);
$sodate=mysqli_real_escape_string($connection, $_POST['sodate']);
$pono=mysqli_real_escape_string($connection, $_POST['pono']);
$podate=mysqli_real_escape_string($connection, $_POST['podate']);
$otherreference=mysqli_real_escape_string($connection, $_POST['otherreference']);
$custreference=mysqli_real_escape_string($connection, $_POST['custreference']);
$tender=mysqli_real_escape_string($connection, $_POST['tender']);
$duedays=mysqli_real_escape_string($connection, $_POST['duedays']);
$salesperson=mysqli_real_escape_string($connection, $_POST['salesperson']);
$osalesperson=mysqli_real_escape_string($connection, $_POST['osalesperson']);
$shipment=mysqli_real_escape_string($connection, $_POST['shipment']);
$deliverymethod=mysqli_real_escape_string($connection, $_POST['deliverymethod']);
$deliveryremarks=mysqli_real_escape_string($connection, $_POST['deliveryremarks']);
$dispatch=mysqli_real_escape_string($connection, $_POST['dispatch']);
$destination=mysqli_real_escape_string($connection, $_POST['destination']);
$pricemark=mysqli_real_escape_string($connection, $_POST['pricemark']);
$totalitems=mysqli_real_escape_string($connection, $_POST['totalitems']);
$totalqty=mysqli_real_escape_string($connection, $_POST['totalqty']);
$notes=mysqli_real_escape_string($connection, $_POST['notes']);
$agentname=mysqli_real_escape_string($connection, $_POST['agentname']);
$lrno=mysqli_real_escape_string($connection, $_POST['lrno']);
$vechileno=mysqli_real_escape_string($connection, $_POST['vechileno']);
$oldattachments=mysqli_real_escape_string($connection, $_POST['oldattachments']);

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
				  } 
				  else 
				  {
					$attachments=$oldattachments;
				  }
$subtotalamount=mysqli_real_escape_string($connection, $_POST['subtotalamount']);
$totalgstamount=mysqli_real_escape_string($connection, $_POST['totalgstamount']);
$netamount=mysqli_real_escape_string($connection, $_POST['netamount']);
$shippingamount=mysqli_real_escape_string($connection, $_POST['shippingamount']);
$grandtotal=mysqli_real_escape_string($connection, $_POST['grandtotal']);
$oldgrandtotal=mysqli_real_escape_string($connection, $_POST['oldgrandtotal']);
$terms=mysqli_real_escape_string($connection, $_POST['terms']);
		
	if(($sono!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcsaleorder WHERE sono = '{$sono}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			
        for($i=0;$i<count($_POST['stockitem']);$i++)
	{	
$j=$i+1;
$id=mysqli_real_escape_string($connection, $_POST['id'][$i]); 
$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
$qty=mysqli_real_escape_string($connection, $_POST['qty'][$i]);
$oldqty=mysqli_real_escape_string($connection, $_POST['oldqty'][$i]);
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
			 
if($id!="")		
{	
$sqlcon1 = "SELECT id From jrcsaleorder  WHERE sono = '{$sono}' and id='$id'";
$querycon1 = mysqli_query($connection, $sqlcon1);
$rowCountcon1 = mysqli_num_rows($querycon1);
if(!$querycon1){
die("SQL query failed: " . mysqli_error($connection));
} 
if($rowCountcon1 > 0)
{
	
			 
		 $sqlup = "update jrcsaleorder set consigneename='$consigneename', buyermainid='$buyermainid', consigneemainid='$consigneemainid', sono='$sono', sodate='$sodate', pono='$pono', podate='$podate', otherreference='$otherreference', custreference='$custreference',tender='$tender', duedays='$duedays', salesperson='$salesperson', shipment='$shipment', deliverymethod='$deliverymethod', deliveryremarks='$deliveryremarks', dispatch='$dispatch', destination='$destination', pricemark='$pricemark', stockitem='$stockitem', qty='$qty', rate='$rate', productamount='$productamount', discount='$discount', discountmode='$discountmode', discountamount='$discountamount', pretotalamount='$pretotalamount', gstper='$gstper', igstper='$igstper', cgstper='$cgstper', sgstper='$sgstper', igstamount='$igstamount', cgstamount='$cgstamount', sgstamount='$sgstamount', gstamount='$gstamount', totalamount='$totalamount', totalitems='$totalitems', totalqty='$totalqty', notes='$notes', attachments='$attachments', subtotalamount='$subtotalamount', totalgstamount='$totalgstamount', netamount='$netamount', shippingamount='$shippingamount', grandtotal='$grandtotal', terms='$terms', productmainid='$productmainid', productid='$productid', stockmaincategory='$stockmaincategory', stocksubcategory='$stocksubcategory', typeofproduct='$typeofproduct', stockname='$stockname', componenttype='$componenttype', componentname='$componentname', make='$make', capacity='$capacity', warranty='$warranty', description='$description', gst='$gst', currentstock='$currentstock', type='$type', sku='$sku', unit='$unit', hsncode='$hsncode', taxpreference='$taxpreference', gstpercentage='$gstpercentage', igstpercentage='$igstpercentage', godownname='$godownname', agentname='agentname', lrno='lrno', vechileno='vechileno', serialnumber='$serialnumber', department='$department' where id='$id'";
		$queryup = mysqli_query($connection, $sqlup);
}
else
{
	 $sqlup1 = "INSERT INTO jrcsaleorder( consigneename, buyermainid, consigneemainid, sono, sodate, pono, podate, otherreference, custreference, tender, duedays, salesperson, shipment, deliverymethod, deliveryremarks, dispatch, destination, pricemark, stockitem, qty, rate, productamount, discount, discountmode, discountamount, pretotalamount, gstper, igstper, cgstper, sgstper, igstamount,cgstamount,sgstamount,gstamount,totalamount,totalitems,totalqty,notes,agentname,lrno,vechileno,attachments,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,terms,productmainid,productid,stockmaincategory,stocksubcategory,typeofproduct,stockname,componenttype,componentname,make,capacity,warranty,description,gst,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,igstpercentage,godownname, serialnumber, department) VALUES ( '$consigneename', '$buyermainid', '$consigneemainid', '$sono', '$sodate', '$pono', '$podate', '$otherreference', '$custreference', '$tender', '$duedays', '$salesperson', '$shipment', '$deliverymethod', '$deliveryremarks', '$dispatch', '$destination', '$pricemark', '$stockitem', '$qty', '$rate', '$productamount', '$discount', '$discountmode', '$discountamount', '$pretotalamount', '$gstper', '$igstper', '$cgstper', '$sgstper', '$igstamount', '$cgstamount', '$sgstamount', '$gstamount', '$totalamount', '$totalitems', '$totalqty', '$notes', '$agentname', '$lrno', '$vechileno', '$attachments', '$subtotalamount', '$totalgstamount', '$netamount', '$shippingamount', '$grandtotal', '$terms', '$productmainid', '$productid', '$stockmaincategory', '$stocksubcategory', '$typeofproduct', '$stockname', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$description', '$gst', '$currentstock', '$type', '$sku', '$unit', '$hsncode', '$taxpreference', '$gstpercentage', '$igstpercentage','$godownname', '$serialnumber', '$department')";
			    $queryup1 = mysqli_query($connection, $sqlup1);
}		
}
else
{
	 $sqlup1 = "INSERT INTO jrcsaleorder( consigneename, buyermainid, consigneemainid, sono, sodate, pono, podate, otherreference, custreference, tender, duedays, salesperson, shipment, deliverymethod, deliveryremarks, dispatch, destination, pricemark, stockitem, qty, rate, productamount, discount, discountmode, discountamount, pretotalamount, gstper, igstper, cgstper, sgstper, igstamount,cgstamount,sgstamount,gstamount,totalamount,totalitems,totalqty,notes,agentname,lrno,vechileno,attachments,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,terms,productmainid,productid,stockmaincategory,stocksubcategory,typeofproduct,stockname,componenttype,componentname,make,capacity,warranty,description,gst,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,igstpercentage,godownname, serialnumber, department) VALUES ( '$consigneename', '$buyermainid', '$consigneemainid', '$sono', '$sodate', '$pono', '$podate', '$otherreference', '$custreference', '$tender', '$duedays', '$salesperson', '$shipment', '$deliverymethod', '$deliveryremarks', '$dispatch', '$destination', '$pricemark', '$stockitem', '$qty', '$rate', '$productamount', '$discount', '$discountmode', '$discountamount', '$pretotalamount', '$gstper', '$igstper', '$cgstper', '$sgstper', '$igstamount', '$cgstamount', '$sgstamount', '$gstamount', '$totalamount', '$totalitems', '$totalqty', '$notes', '$agentname', '$lrno', '$vechileno', '$attachments', '$subtotalamount', '$totalgstamount', '$netamount', '$shippingamount', '$grandtotal', '$terms', '$productmainid', '$productid', '$stockmaincategory', '$stocksubcategory', '$typeofproduct', '$stockname', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$description', '$gst', '$currentstock', '$type', '$sku', '$unit', '$hsncode', '$taxpreference', '$gstpercentage', '$igstpercentage','$godownname','$serialnumber','$department')";
			    $queryup1 = mysqli_query($connection, $sqlup1);
}	
//for product stock decrement
				$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
				$qty=mysqli_real_escape_string($connection, $_POST['qty'][$i]);
				$sqlstock = "SELECT id,currentstock From jrcproduct where id='$stockitem'";
				$querystock = mysqli_query($connection, $sqlstock);
				$rowCountstock = mysqli_num_rows($querystock);
				if(!$querystock){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountstock > 0)
				{
				$rowstock = mysqli_fetch_array($querystock);
				$oldcurrentstock=$rowstock['currentstock'];
				$newcurrentstock=$oldqty;
				if($newcurrentstock>$qty)
				{
				$current=$newcurrentstock-$qty; 
				$stock=$current+$oldcurrentstock;
				}
				else
				{
				$current=$oldcurrentstock-$qty;
				$stock=$current+$newcurrentstock;
				}
				mysqli_query($connection, "update jrcproduct set currentstock='$stock' where id='$stockitem'");
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
				$oldcurrentstockgo=$rowstockgo['availablestock'];
				$newcurrentstockgo=$oldqty;
				if($newcurrentstock>$qty)
				{
				$current=$newcurrentstockgo-$qty;
				$stockgo=$current+$oldcurrentstockgo;
				}
				else
				{
				$current=$oldcurrentstockgo-$qty;
				$stockgo=$current+$newcurrentstockgo;
				}
			    mysqli_query($connection, "update jrcproductstock set availablestock='$stockgo' where productid='$stockitem' and godownid='$godownname'");
				}
}//End for loop			
		 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
				{
				$tid=mysqli_insert_id($connection);
				
				//for history update
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Update Sales Order', '{$tid}', 'jrcsaleorder')");
			    }

				//for salesperson amount increament and decreament
				 if($salesperson!=$osalesperson)
				{
					
				$sqlcon2 = "SELECT id, totalbilledamount,totalbalanceamount From jrcsalesperson where email='$salesperson'";
				$querycon2 = mysqli_query($connection, $sqlcon2);
				$rowCountcon2 = mysqli_num_rows($querycon2);
				if(!$querycon2){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon2 > 0)
				{
				$rowcon2 = mysqli_fetch_array($querycon2);
				
				$sqlcon3 = "SELECT id, totalbilledamount,totalbalanceamount From jrcsalesperson where email='$osalesperson'";
				$querycon3 = mysqli_query($connection, $sqlcon3);
				$rowCountcon3 = mysqli_num_rows($querycon3);
				$rowcon3 = mysqli_fetch_array($querycon3);
				if($rowcon3['totalbilledamount']>=$oldgrandtotal)
				{
				$minus=$rowcon3['totalbilledamount']-$oldgrandtotal;				
				$minus1=$rowcon3['totalbalanceamount']-$oldgrandtotal;				
				}
				else
				{
					$minus=$oldgrandtotal-$rowcon3['totalbilledamount'];
					$minus1=$oldgrandtotal-$rowcon3['totalbalanceamount'];
				}	
				
				$newbilledamount1=$rowcon2['totalbilledamount'];
				$newbalanceamount1=$rowcon2['totalbalanceamount'];
			 	
			    $billedamount1=$newbilledamount1+$grandtotal;	
			    $balanceamount1=$newbalanceamount1+$grandtotal;	
				}
				 mysqli_query($connection, "update jrcsalesperson set totalbilledamount='$minus',totalbalanceamount='$minus1' where email='$osalesperson'");
				mysqli_query($connection, "update jrcsalesperson set totalbilledamount='$billedamount1',totalbalanceamount='$balanceamount1' where email='$salesperson'");			
				}
				else
				{
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
				$oldbilledamount=$rowperson['totalbilledamount'];
				$oldbalanceamount=$rowperson['totalbalanceamount'];
			 	$newbilledamount=$oldgrandtotal;
                $amount=$oldbilledamount-$newbilledamount;
                $amount1=$oldbalanceamount-$newbilledamount;
			    $billedamount=$amount+$grandtotal;
			    $balanceamount1=$amount1+$grandtotal;
				}
			     mysqli_query($connection, "update jrcsalesperson set totalbilledamount='$billedamount',totalbilledamount='$balanceamount1' where email='$salesperson'");
				}
				
				//for consignee amount increment
				if($consigneemainid!=$oconsigneemainid)
				{
		$sqlcon = "SELECT id, totalbilledamount,totalbalanceamount From jrcconsignee where id='$consigneemainid'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
				$rowcon = mysqli_fetch_array($querycon);
				
				$sqlcon1 = "SELECT id, totalbilledamount,totalbalanceamount From jrcconsignee where id='$oconsigneemainid'";
				$querycon1 = mysqli_query($connection, $sqlcon1);
				$rowCountcon1 = mysqli_num_rows($querycon1);
				$rowcon1 = mysqli_fetch_array($querycon1);
				if($rowcon1['totalbilledamount']>=$oldgrandtotal)
				{
				$minus=$rowcon1['totalbilledamount']-$oldgrandtotal;				
				$minus1=$rowcon1['totalbalanceamount']-$oldgrandtotal;				
				}
				else
				{
					$minus=$oldgrandtotal-$rowcon1['totalbilledamount'];
					$minus1=$oldgrandtotal-$rowcon1['totalbalanceamount'];
				}	
				
				$newbilledamount1=$rowcon['totalbilledamount'];
				$newbalanceamount1=$rowcon['totalbalanceamount'];
			 	
			    $billedamount1=$newbilledamount1+$grandtotal;	
			    $balanceamount1=$newbalanceamount1+$grandtotal;	
				}
				mysqli_query($connection, "update jrcconsignee set totalbilledamount='$minus',totalbalanceamount='$minus1' where id='$oconsigneemainid'");
				mysqli_query($connection, "update jrcconsignee set totalbilledamount='$billedamount1',totalbalanceamount='$balanceamount1' where id='$consigneemainid'");			
				}
				else
				{		
				$sqlcon = "SELECT id, totalbilledamount,totalbalanceamount From jrcconsignee where id='$consigneemainid'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
				$rowcon = mysqli_fetch_array($querycon);
				$oldbilledamount1=$rowcon['totalbilledamount'];
				$oldbilledamount2=$rowcon['totalbalanceamount'];
			 	$newbilledamount1=$oldgrandtotal;
                $amount1=$oldbilledamount1-$newbilledamount1;
                $amount2=$oldbilledamount2-$newbilledamount1;
			    $billedamount1=$amount1+$grandtotal;
			    $balanceamount1=$amount2+$grandtotal;
				}
                mysqli_query($connection, "update jrcconsignee set totalbilledamount='$billedamount1',totalbalanceamount='$balanceamount1' where id='$consigneemainid'");
				
				}
			//for consignee amount increament and decreament
				header("Location: salesorderlist.php?remarks=Updated Successfully");
			
	    }
		else
			{
				header("Location: salesorderlist.php?error=This record is Not Found! Kindly check in All Sales Order List");
			}
	}
	else
			{
				header("Location: salesorderlist.php?error=Error Data");
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