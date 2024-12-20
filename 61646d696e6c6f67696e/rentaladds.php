<?php
include('lcheck.php');
if($settings=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
 $createdon=date('Y-m-d H:i:s');
 $createdby=$_SESSION['email'];
$rentaldate=mysqli_real_escape_string($connection, $_POST['rentaldate']);
$consigneename=mysqli_real_escape_string($connection, $_POST['consigneename']);
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

if (!file_exists('img/rental'))
		{
    mkdir('img/rental', 0777, true);
        }

$target_path = "img/rental/"; 
						$countfiles = count($_FILES['beforeimage']['name']);
						$beforeimages=array();
						for($i=0;$i<$countfiles;$i++)
						 {							 
							$target_file = $target_path .time(). basename($_FILES["beforeimage"]["name"][$i]);
							$pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
							if(move_uploaded_file($_FILES['beforeimage']['tmp_name'][$i],$target_file))				 
							  {
								$beforeimages[]=$target_file;
							  } else 
							  {
								
							  }
						 }
						 
			$beforeimage=implode("|",$beforeimages);

$target_path = "img/rental/"; 
						$countfiles = count($_FILES['afterimage']['name']);
						$afterimages=array();
						for($i=0;$i<$countfiles;$i++)
						 {							 
							$target_file = $target_path .time(). basename($_FILES["afterimage"]["name"][$i]);
							$pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
							if(move_uploaded_file($_FILES['afterimage']['tmp_name'][$i],$target_file))				 
							  {
								$afterimages[]=$target_file;
							  } else 
							  {
								
							  }
						 }
			$afterimage=implode("|",$afterimages);

$subtotalamount=mysqli_real_escape_string($connection, $_POST['subtotalamount']);
$totalgstamount=mysqli_real_escape_string($connection, $_POST['totalgstamount']);
$netamount=mysqli_real_escape_string($connection, $_POST['netamount']);
$shippingamount=mysqli_real_escape_string($connection, $_POST['shippingamount']);
$grandtotal=mysqli_real_escape_string($connection, $_POST['grandtotal']);
$terms=mysqli_real_escape_string($connection, $_POST['terms']);
$advanceamount=mysqli_real_escape_string($connection, $_POST['advanceamount']);

		
	if(($rono!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcrental where rono='{$rono}'";
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
$penaltyperday=mysqli_real_escape_string($connection, $_POST['penaltyperday'][$i]);
$productamount=mysqli_real_escape_string($connection, $_POST['productamount'][$i]);
$discount=mysqli_real_escape_string($connection, $_POST['discount'][$i]);
$discountmode=mysqli_real_escape_string($connection, $_POST['discountmode'][$i]);
$discountamount=mysqli_real_escape_string($connection, $_POST['discountamount'][$i]);
$pretotalamount=mysqli_real_escape_string($connection, $_POST['pretotalamount'][$i]);
$gstper=mysqli_real_escape_string($connection, $_POST['gstper'][$i]);

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
$rentper=mysqli_real_escape_string($connection, $_POST['rentper'][$i]);
$rentperamount=mysqli_real_escape_string($connection, $_POST['rentperamount'][$i]);


  $sqlup = "INSERT INTO jrcrental( rentaldate,consigneename, consigneeid, rono,datefrom, dateto, shipment, deliverymethod, deliveryremarks, stockitem, qty, rate, penaltyperday,productamount,discount,discountmode,discountamount,pretotalamount,gstper,gstamount,totalamount,totalitems,totalqty,notes,agentname,lrno,vechileno,beforeimage,afterimage,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,terms,productmainid,productid,stockmaincategory,stocksubcategory,typeofproduct,stockname,componenttype,componentname,make,capacity,warranty,productdescription,gst,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,igstpercentage,godownname ,serialnumber,department,advanceamount,paymentmode, rentalagreeid,rentper, rentperamount ) VALUES ( '$rentaldate', '$consigneename', '$consigneeid', '$rono', '$datefrom', '$dateto', '$shipment', '$deliverymethod', '$deliveryremarks', '$stockitem', '$qty', '$rate', '$penaltyperday', '$productamount', '$discount', '$discountmode', '$discountamount', '$pretotalamount', '$gstper',  '$gstamount', '$totalamount', '$totalitems', '$totalqty', '$notes', '$agentname', '$lrno', '$vechileno', '$beforeimage', '$afterimage', '$subtotalamount', '$totalgstamount', '$netamount', '$shippingamount', '$grandtotal', '$terms', '$productmainid', '$productid', '$stockmaincategory', '$stocksubcategory', '$typeofproduct', '$stockname', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$description', '$gst', '$currentstock', '$type', '$sku', '$unit', '$hsncode', '$taxpreference', '$gstpercentage', '$igstpercentage','$godownname','$serialnumber','$department','$advanceamount','$paymentmode', '1','$rentper', '$rentperamount')";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				$tid=mysqli_insert_id($connection);
				//for history update
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Insert A Rental', '{$tid}', 'jrcrental')");
				//for added in jrcxl table
				mysqli_query($connection, "INSERT INTO jrcxl(xltype,shipment,consigneeid,stockitem,serialnumber,departments,rono,rentaldate,qty,rate,penaltyperday,productamount,discount,discountamount,pretotalamount,gstper,gstamount,totalamount,productid,stocksubcategory,stockmaincategory,typeofproduct,componentname,make,capacity,warranty,description,rentper,rentperamount,currentstock,type,sku,unit,hsncode,taxpreference,gstpercentage,godownname,datefrom,dateto,subtotalamount,totalgstamount,netamount,shippingamount,grandtotal,paymentmode,advanceamount,terms,notes,discountmode) VALUES('Rental','{$shipment}','{$consigneename}','{$stockname}','{$serialnumber}','{$department}','{$rono}','{$rentaldate}','{$qty}','{$rate}','{$penaltyperday}','{$productamount}','{$discount}','{$discountamount}','{$pretotalamount}','{$gstper}','{$gstamount}','{$totalamount}','{$productid}','{$stocksubcategory}','{$stockmaincategory}','{$typeofproduct}','{$componentname}','{$make}','{$capacity}','{$warranty}','{$description}','{$gst}','{$rentperamount}','{$currentstock}','{$type}','{$sku}','{$unit}','{$hsncode}','{$taxpreference}','{$gstpercentage}','{$godownname}','{$datefrom}','{$dateto}','{$subtotalamount}','{$totalgstamount}','{$netamount}','{$shippingamount}','{$grandtotal}','{$paymentmode}','{$advanceamount}','{$terms}','{$notes}','{$discountmode}')");
				
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
				else{
					$nowcurrentstockgo=0-$qty;
					mysqli_query($connection, "insert into  jrcproductstock set availablestock='$nowcurrentstockgo' , productid='$stockitem' , godownid='$godownname'");
				}
				
			}
}
//End for loop

                //for invoice increment
				 $sqlinvoice = "SELECT rono from jrcrono";
				$queryinvoice = mysqli_query($connection, $sqlinvoice);
				$rowCountinvoice = mysqli_num_rows($queryinvoice);
				if(!$queryinvoice){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountinvoice > 0)
				{
				$rowinvoice = mysqli_fetch_array($queryinvoice);
				$total=$rowinvoice['rono']+1;
				}
			    mysqli_query($connection, "update jrcrono set rono='$total' ");
		
				
				//for consignee amount increment
				$sqlcon = "SELECT id, totalbilledamount,totalpaidamount,totalbalanceamount From jrcconsignee where id='$consigneeid'";
				$querycon = mysqli_query($connection, $sqlcon);
				$rowCountcon = mysqli_num_rows($querycon);
				$billedamount1=0;
				$oldpaidamount=0;
				if(!$querycon){
				die("SQL query failed: " . mysqli_error($connection));
				}
				if($rowCountcon > 0)
				{
					
				$rowcon = mysqli_fetch_array($querycon);
				$billedamount1=$rowcon['totalbilledamount']+$grandtotal;
				
				if($advanceamount!='')
				{
					$oldpaidamount=$rowcon['totalpaidamount']+$advanceamount;
				}
				else{
					$oldpaidamount=$rowcon['totalpaidamount'];
				}
				
				$pendingamount=$billedamount1-$oldpaidamount;
				
				}
				
                mysqli_query($connection, "update jrcconsignee set totalbilledamount='$billedamount1', totalpaidamount='$oldpaidamount', totalbalanceamount='$pendingamount' where id='$consigneeid'");
				
				//for stored in jrcxl
			
				//for advanceamount 
				
				if($advanceamount!="")
				{
					$balanceamount=$grandtotal-$advanceamount;
				mysqli_query($connection, "INSERT INTO jrcpayment (createdon,createdby,paymentdate,paymentmode, consigneename, advance,totalamount,balanceamount,ptype,remarks) VALUES ('{$rentaldate}','{$createdby}','{$datefrom}','{$paymentmode}','{$consigneename}','{$advanceamount}','{$grandtotal}', '{$balanceamount}', 'Rental','{$rono}')");
				
				}
				header("Location: rentallist.php?remarks=Added Successfully");
	    }
		else
			{
			header("Location: rentallist.php?error=This record is Already Found! Kindly check in All Rental List");
			}
	}
	else
			{
				header("Location: rentallist.php?error=Error Data");
			}
}
else
			{
				header("Location: rentallist.php");
			}
?>
