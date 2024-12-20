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
$oconsigneeid=mysqli_real_escape_string($connection, $_POST['oconsigneeid']);
$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
$rono=mysqli_real_escape_string($connection, $_POST['rono']);
$shipment=mysqli_real_escape_string($connection, $_POST['shipment']);
$deliverymethod=mysqli_real_escape_string($connection, $_POST['deliverymethod']);
$deliveryremarks=mysqli_real_escape_string($connection, $_POST['deliveryremarks']);
$totalitems=mysqli_real_escape_string($connection, $_POST['totalitems']);
$totalqty=mysqli_real_escape_string($connection, $_POST['totalqty']);
$notes=mysqli_real_escape_string($connection, $_POST['notes']);
$agentname=mysqli_real_escape_string($connection, $_POST['agentname']);
$lrno=mysqli_real_escape_string($connection, $_POST['lrno']);
$vechileno=mysqli_real_escape_string($connection, $_POST['vechileno']);
$paymentmode=mysqli_real_escape_string($connection, $_POST['paymentmode']);
$rentaldate=mysqli_real_escape_string($connection, $_POST['rentaldate']);



			if (!file_exists('img/rental'))
		{
    mkdir('img/rental', 0777, true);
        }	
$oldbeforeimage=mysqli_real_escape_string($connection, $_POST['oldbeforeimage']);
$target_path = "img/rental/"; 
							 $countfiles = count($_FILES['beforeimage']['name']);
							 $beforeimages=array();
						 // Looping all files
						 for($i=0;$i<$countfiles;$i++)
						 {
						 	$target_file = $target_path.time(). basename($_FILES["beforeimage"]["name"][$i]);
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						  // Upload file
						  if(move_uploaded_file($_FILES['beforeimage']['tmp_name'][$i],$target_file))
							  {
								$beforeimages[]=$target_file;
							  } else 
							  {
								
							  }
						 }
						 if(empty($beforeimages))
						 {
							 $beforeimage=$oldbeforeimage;
						 }
						 else
						 {
							 $beforeimage=implode("|",$beforeimages);
						 }




$oldafterimage=mysqli_real_escape_string($connection, $_POST['oldafterimage']);
			$target_path = "img/rental/"; 
							 $countfiles = count($_FILES['afterimage']['name']);
							 $afterimages=array();
						 // Looping all files
						 for($i=0;$i<$countfiles;$i++)
						 {
						 	$target_file = $target_path.time(). basename($_FILES["afterimage"]["name"][$i]);
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						  // Upload file
						  if(move_uploaded_file($_FILES['afterimage']['tmp_name'][$i],$target_file))
							  {
								$afterimages[]=$target_file;
							  } else 
							  {
								
							  }
						 }
						 if(empty($afterimages))
						 {
							 $afterimage=$oldafterimage;
						 }
						 else
						 {
							 $afterimage=implode("|",$afterimages);
						 }

$subtotalamount=mysqli_real_escape_string($connection, $_POST['subtotalamount']);
$totalgstamount=mysqli_real_escape_string($connection, $_POST['totalgstamount']);
$netamount=mysqli_real_escape_string($connection, $_POST['netamount']);
$shippingamount=mysqli_real_escape_string($connection, $_POST['shippingamount']);
$grandtotal=mysqli_real_escape_string($connection, $_POST['grandtotal']);
$oldgrandtotal=mysqli_real_escape_string($connection, $_POST['oldgrandtotal']);
$terms=mysqli_real_escape_string($connection, $_POST['terms']);
$advanceamount=mysqli_real_escape_string($connection, $_POST['advanceamount']);
		
	if(($rono!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcrental WHERE rono = '{$rono}'";
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
$penaltyperday=mysqli_real_escape_string($connection, $_POST['penaltyperday'][$i]);
$productamount=mysqli_real_escape_string($connection, $_POST['productamount'][$i]);
$discount=mysqli_real_escape_string($connection, $_POST['discount'][$i]);
$discountmode=mysqli_real_escape_string($connection, $_POST['discountmode'][$i]);
$discountamount=mysqli_real_escape_string($connection, $_POST['discountamount'][$i]);
$pretotalamount=mysqli_real_escape_string($connection, $_POST['pretotalamount'][$i]);
$gstper=mysqli_real_escape_string($connection, $_POST['gstper'][$i]);
$rentper=mysqli_real_escape_string($connection, $_POST['rentper'][$i]);
$rentperamount=mysqli_real_escape_string($connection, $_POST['rentperamount'][$i]);
$gstamount=mysqli_real_escape_string($connection, $_POST['gstamount'][$i]);
$totalamount=mysqli_real_escape_string($connection, $_POST['totalamount'][$i]);
;

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
$description=mysqli_real_escape_string($connection, $_POST['productdescription'][$i]);
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
$datefrom=mysqli_real_escape_string($connection, $_POST['datefrom'][$i]);
$dateto=mysqli_real_escape_string($connection, $_POST['dateto'][$i]);		
			 
if($id!="")		
{	
$sqlcon1 = "SELECT id From jrcrental WHERE rono = '{$rono}' and id='$id'";
$querycon1 = mysqli_query($connection, $sqlcon1);
$rowCountcon1 = mysqli_num_rows($querycon1);
if(!$querycon1){
die("SQL query failed: " . mysqli_error($connection));
} 
if($rowCountcon1 > 0)
{
	
			 
		$sqlup = "update jrcrental set consigneename='$consigneename',  consigneeid='$consigneeid', rono='$rono',rentaldate='$rentaldate', datefrom='$datefrom', dateto='$dateto', shipment='$shipment', deliverymethod='$deliverymethod', deliveryremarks='$deliveryremarks', stockitem='$stockitem', qty='$qty', rate='$rate', penaltyperday='$penaltyperday', productamount='$productamount', discount='$discount', discountmode='$discountmode', discountamount='$discountamount', pretotalamount='$pretotalamount', gstper='$gstper',  gstamount='$gstamount',rentper='$rentper',  rentperamount='$rentperamount', totalamount='$totalamount', totalitems='$totalitems', totalqty='$totalqty', notes='$notes', beforeimage='$beforeimage' , afterimage='$afterimage', subtotalamount='$subtotalamount', totalgstamount='$totalgstamount', netamount='$netamount', shippingamount='$shippingamount', grandtotal='$grandtotal', terms='$terms', productmainid='$productmainid', productid='$productid', stockmaincategory='$stockmaincategory', stocksubcategory='$stocksubcategory', typeofproduct='$typeofproduct', stockname='$stockname', componenttype='$componenttype', componentname='$componentname', make='$make', capacity='$capacity', warranty='$warranty', description='$description', gst='$gst', currentstock='$currentstock', type='$type', sku='$sku', unit='$unit', hsncode='$hsncode', taxpreference='$taxpreference', gstpercentage='$gstpercentage', igstpercentage='$igstpercentage', godownname='$godownname', agentname='agentname', lrno='lrno', vechileno='vechileno', serialnumber='$serialnumber', department='$department', paymentmode='$paymentmode' where id='$id'";
		$queryup = mysqli_query($connection, $sqlup);
		mysqli_query($connection,  "update jrcxl set xltype='Rental',shipment='{$shipment}',stockname='{$stockname}',serialnumber='{$stockmaincategory}',serialnumber='{$serialnumber}',departments= '{$department}',rentaldate='{$rentaldate}',penaltyperday='{$penaltyperday}', productamount='{$productamount}', discount='{$discount}', discountamount='{$discountamount}', pretotalamount='{$pretotalamount}', gstper='{$gstper}', gstamount='{$gstamount}', totalamount='{$totalamount}', productid='{$pretotalamount}', productid='{$productid}', stocksubcategory='{$stocksubcategory}', stockmaincategory='{$stockmaincategory}', typeofproduct='{$typeofproduct}',  componentname='{$componentname}', make='{$make}', capacity='{$capacity}', warranty='{$warranty}', description='{$description}', rentper='{$rentper}', rentperamount='{$rentperamount}', currentstock='{$currentstock}', type='{$type}', sku='{$sku}',unit='{$unit}', hsncode='{$hsncode}',taxpreference='{$taxpreference}', gstpercentage='{$gstpercentage}',godownname='{$godownname}', datefrom='{$datefrom}',dateto='{$dateto}', subtotalamount='{$subtotalamount}',totalgstamount='{$totalgstamount}', netamount='{$netamount}',shippingamount='{$shippingamount}', grandtotal='{$grandtotal}', paymentmode='{$paymentmode}',advanceamount='{$advanceamount}', terms='{$terms}',notes='{$notes}',  consigneeid='{$consigneename}', rate='$rate'  where rono='$rono' and productid='$productid'");
	
}
else
{
	$sqlup1 = "INSERT INTO jrcrental( consigneename, consigneeid, rono,rentaldate,datefrom, dateto, shipment, deliverymethod, deliveryremarks, stockitem,qty,rate,penaltyperday,productamount,discount,discountmode,discountamount,pretotalamount,gstper,gstamount,totalamount,totalitems,totalqty,notes,agentname,lrno,vechileno,beforeimage,afterimage,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,terms,productmainid,productid,stockmaincategory,stocksubcategory,typeofproduct,stockname,componenttype,componentname,make,capacity,warranty,productdescription,gst,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,igstpercentage,godownname ,serialnumber,department,advanceamount,paymentmode, rentalagreeid,rentper, rentperamount ) VALUES ( '$consigneename', '$consigneeid', '$rono','$rentaldate', '$datefrom', '$dateto', '$shipment', '$deliverymethod', '$deliveryremarks', '$stockitem', '$qty', '$rate', '$penaltyperday', '$productamount', '$discount', '$discountmode', '$discountamount', '$pretotalamount', '$gstper',  '$gstamount', '$totalamount', '$totalitems', '$totalqty', '$notes', '$agentname', '$lrno', '$vechileno', '$beforeimage', '$afterimage', '$subtotalamount', '$totalgstamount', '$netamount', '$shippingamount', '$grandtotal', '$terms', '$productmainid', '$productid', '$stockmaincategory', '$stocksubcategory', '$typeofproduct', '$stockname', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$description', '$gst', '$currentstock', '$type', '$sku', '$unit', '$hsncode', '$taxpreference', '$gstpercentage', '$igstpercentage','$godownname','$serialnumber','$department','$advanceamount','$paymentmode', '1','$rentper', '$rentperamount')";
			    $queryup1 = mysqli_query($connection, $sqlup1);
				mysqli_query($connection, "INSERT INTO jrcxl(xltype,shipment,consigneeid,stockitem,serialnumber,departments,rono,rentaldate,qty,rate,penaltyperday,productamount,discount,discountamount,pretotalamount,gstper,gstamount,totalamount,productid,stocksubcategory,stockmaincategory,typeofproduct,componentname,make,capacity,warranty,description,rentper,rentperamount,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,godownname,datefrom,dateto,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,paymentmode,advanceamount,terms,notes,discountmode) VALUES('Rental','{$shipment}','{$consigneename}','{$stockname}','{$serialnumber}','{$department}','{$rono}','{$rentaldate}','{$qty}','{$rate}','{$penaltyperday}','{$productamount}','{$discount}','{$discountamount}','{$pretotalamount}','{$gstper}','{$gstamount}','{$totalamount}','{$productid}','{$stocksubcategory}','{$stockmaincategory}','{$typeofproduct}','{$componentname}','{$make}','{$capacity}','{$warranty}','{$description}','{$gst}','{$rentperamount}','{$currentstock}','{$type}','{$sku}','{$unit}','{$hsncode}','{$taxpreference}','{$gstpercentage}','{$godownname}','{$datefrom}','{$dateto}','{$subtotalamount}','{$totalgstamount}','{$netamount}','{$shippingamount}','{$grandtotal}','{$paymentmode}','{$advanceamount}','{$terms}','{$notes}','{$discountmode}')");
}		
}
else
{
	$sqlup1 = "INSERT INTO jrcrental( consigneename, consigneeid, rono,rentaldate,datefrom, dateto, shipment, deliverymethod, deliveryremarks, stockitem, qty, rate, penaltyperday,productamount,discount,discountmode,discountamount,pretotalamount,gstper,gstamount,totalamount,totalitems,totalqty,notes,agentname,lrno,vechileno,beforeimage,afterimage,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,terms,productmainid,productid,stockmaincategory,stocksubcategory,typeofproduct,stockname,componenttype,componentname,make,capacity,warranty,productdescription,gst,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,igstpercentage,godownname ,serialnumber,department,advanceamount,paymentmode, rentalagreeid,rentper, rentperamount ) VALUES ( '$consigneename', '$consigneeid', '$rono', '$rentaldate','$datefrom', '$dateto', '$shipment', '$deliverymethod', '$deliveryremarks', '$stockitem', '$qty', '$rate', '$penaltyperday', '$productamount', '$discount', '$discountmode', '$discountamount', '$pretotalamount', '$gstper',  '$gstamount', '$totalamount', '$totalitems', '$totalqty', '$notes', '$agentname', '$lrno', '$vechileno', '$beforeimage', '$afterimage', '$subtotalamount', '$totalgstamount', '$netamount', '$shippingamount', '$grandtotal', '$terms', '$productmainid', '$productid', '$stockmaincategory', '$stocksubcategory', '$typeofproduct', '$stockname', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$description', '$gst', '$currentstock', '$type', '$sku', '$unit', '$hsncode', '$taxpreference', '$gstpercentage', '$igstpercentage','$godownname','$serialnumber','$department','$advanceamount','$paymentmode', '1','$rentper', '$rentperamount')";
			    $queryup1 = mysqli_query($connection, $sqlup1);
				mysqli_query($connection, "INSERT INTO jrcxl(xltype,shipment,consigneeid,stockitem,serialnumber,departments,rono,rentaldate,qty,rate,penaltyperday,productamount,discount,discountamount,pretotalamount,gstper,gstamount,totalamount,productid,stocksubcategory,stockmaincategory,typeofproduct,componentname,make,capacity,warranty,description,rentper,rentperamount,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,godownname,datefrom,dateto,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,paymentmode,advanceamount,terms,notes,discountmode) VALUES('Rental','{$shipment}','{$consigneename}','{$stockname}','{$serialnumber}','{$department}','{$rono}','{$rentaldate}','{$qty}','{$rate}','{$penaltyperday}','{$productamount}','{$discount}','{$discountamount}','{$pretotalamount}','{$gstper}','{$gstamount}','{$totalamount}','{$productid}','{$stocksubcategory}','{$stockmaincategory}','{$typeofproduct}','{$componentname}','{$make}','{$capacity}','{$warranty}','{$description}','{$gst}','{$rentperamount}','{$currentstock}','{$type}','{$sku}','{$unit}','{$hsncode}','{$taxpreference}','{$gstpercentage}','{$godownname}','{$datefrom}','{$dateto}','{$subtotalamount}','{$totalgstamount}','{$netamount}','{$shippingamount}','{$grandtotal}','{$paymentmode}','{$advanceamount}','{$terms}','{$notes}','{$discountmode}')");
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
				$stock=0;
				if($rowCountstock > 0)
				{
				$rowstock = mysqli_fetch_array($querystock);
				
				$oldcurrentstock=$rowstock['currentstock'];
				$newcurrentstock=$oldqty;
				if(($newcurrentstock)>($qty))
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
				$stockgo=0;
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
				else{
					$nowcurrentstockgo=0-$qty;
					mysqli_query($connection, "insert into  jrcproductstock set availablestock='$nowcurrentstockgo' , productid='$stockitem' , godownid='$godownname'");
				}
				
}//End for loop			
		 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
				{
				$tid=mysqli_insert_id($connection);
				
				//for history update
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Update Rental Details', '{$tid}', 'jrcrental')");
			    }
				//for consignee amount increment
				if($consigneeid!=$oconsigneeid)
				{
				$sqlcon = "SELECT id, totalbilledamount,totalpaidamount,totalbalanceamount From jrcconsignee where id='$consigneeid'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
				$rowcon = mysqli_fetch_array($querycon);
				$minus=0;
				$sqlcon1 = "SELECT id, totalbilledamount,totalpaidamount,totalbalanceamount From jrcconsignee where id='$oconsigneeid'";
				$querycon1 = mysqli_query($connection, $sqlcon1);
				$rowCountcon1 = mysqli_num_rows($querycon1);
				$rowcon1 = mysqli_fetch_array($querycon1);
				if($rowcon1['totalbilledamount']>=$oldgrandtotal)
				{
				$minus=$rowcon1['totalbilledamount']-$oldgrandtotal;				
				}
				else
				{
					$minus=$oldgrandtotal-$rowcon1['totalbilledamount'];
				}	
				$oldconpaid=$rowcon1['totalpaidamount']-$advanceamount;
				$oldconpending=$minus-$oldconpaid;
				
				
				$newbilledamount1=$rowcon['totalbilledamount'];
			    $billedamount1=$newbilledamount1+$grandtotal;
				$newpaid=$rowcon['totalpaidamount']+$advanceamount;
				$newpending=$billedamount1-$newpaid;
			 		
				}
				mysqli_query($connection, "update jrcconsignee set totalbilledamount='$minus',totalpaidamount='$oldconpaid',totalbalanceamount='$oldconpending' where id='$oconsigneeid'");
				mysqli_query($connection, "update jrcconsignee set totalbilledamount='$billedamount1',totalpaidamount='$newpaid',totalbalanceamount='$newpending' where id='$consigneeid'");			
				}
				else if($grandtotal!=$oldgrandtotal)
				{
					
				echo	$sqlcon1 = "SELECT id, totalbilledamount,totalpaidamount,totalbalanceamount From jrcconsignee where id='$consigneeid'";
				$querycon1 = mysqli_query($connection, $sqlcon1);
				$rowCountcon1 = mysqli_num_rows($querycon1);
				
				if(!$querycon1){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon1 > 0)
				{
				$rowcon1 = mysqli_fetch_array($querycon1);
				
				
				
					if($grandtotal > $oldgrandtotal)
					{
					 	$diff=$grandtotal-$oldgrandtotal;
						$rowcon1['totalbilledamount'];
						$totalbill=$rowcon1['totalbilledamount']+$diff;
					}
					else
					{
						$diff2=$oldgrandtotal-$grandtotal;
						$totalbill=$rowcon1['totalbilledamount']-$diff2;
					}
					$totalbal=$totalbill-$rowcon1['totalpaidamount'];
			
					
				
				}
					
					mysqli_query($connection, "update jrcconsignee set totalbilledamount='$totalbill',totalbalanceamount='$totalbal' where id='$consigneeid'");
				
				}
			//for consignee amount increament and decreament
				header("Location: rentallist.php?remarks=Updated Successfully");
				
	    }
		else
			{
				header("Location: rentallist.php?error=This record is Not Found! Kindly check in All Rental List");
			}
	}
	else
			{
				header("Location: rentallist.php?error=Error Data");
			}
			}
	else
			{
				header("Location: rentallist.php?error=Error Data1");
			}
}
else
			{
				header("Location: rentallist.php");
			}
?>