<?php
include('lcheck.php');
if(isset($_POST['id']))
 {
if(isset($_POST['invoice']))
	 {
		 $dispatchdocno = mysqli_real_escape_string($connection, $_POST['dispatchdocno']);
		 $disthrough = mysqli_real_escape_string($connection, $_POST['disthrough']);
		
		if($_POST['sotype']=='Regular')
		{
		  mysqli_query($connection, "update jrcsrno set invoiceno = LPAD(invoiceno + 1, 4, '0')");
		}
		else
		{
		 mysqli_query($connection, "update jrcsrno set invoiceser = LPAD(invoiceser + 1, 4, '0')");
		}
	    $sqlselect11 = "SELECT * From jrcsrno";
        $queryselect11 = mysqli_query($connection, $sqlselect11);
        $rowCountselect11 = mysqli_num_rows($queryselect11);
        if(!$queryselect11){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect11 > 0) 
		{
			$row11 = mysqli_fetch_assoc($queryselect11);
			$date=date('Y-m-d');
			$currentMonthYear = date('my');
		if($_POST['sotype']=='Regular')
		{
		$query = "UPDATE jrctally SET invoiceno='SJ / JRC / ".$currentMonthYear."/" . $row11['invoiceno'] . "' , invoicedate1='".$date."', dispatchdocno='".$dispatchdocno."', disthrough='".$disthrough."' WHERE sono='" . $_POST['id'] . "'";
		}
		else
		{
		 $query = "UPDATE jrctally SET invoiceno='SJ / SER / ".$currentMonthYear."/" . $row11['invoiceser'] . "' , invoicedate1='".$date."', dispatchdocno='".$dispatchdocno."', disthrough='".$disthrough."' WHERE sono='" . $_POST['id'] . "'";
		}
		$result = mysqli_query($connection, $query);
		
		if($_POST['sotype']=='Regular')
		{
		$query1 = "UPDATE jrcxl SET invoiceno='SJ / JRC / ".$currentMonthYear."/" . $row11['invoiceno'] . "' , invoicedate='".$date."' WHERE sono='" . $_POST['id'] . "' and dcno ='". $_POST['dcno'] ."'";
		}
		else
		{
		$query1 = "UPDATE jrcxl SET invoiceno='SJ / SER / ".$currentMonthYear."/" . $row11['invoiceser'] . "' , invoicedate='".$date."' WHERE sono='" . $_POST['id'] . "' and dcno ='". $_POST['dcno'] ."'";	
		}
		$result1 = mysqli_query($connection, $query1);
		
	 
	 $sqlselect = "SELECT * From jrctally WHERE sono='".$_POST['id']."'";
     $queryselect = mysqli_query($connection, $sqlselect);
     $rowCountselect = mysqli_num_rows($queryselect);   
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }				
			if($rowCountselect > 0) 
		{
			$count=1;
			while($rowdc = mysqli_fetch_array($queryselect))
			{	 
		    $createdon=date('Y-m-d H:i:s');
		    $createdby=$email;
		    $dname=mysqli_real_escape_string($connection1, $rowdc['dname']);
			$noofconsignee=mysqli_real_escape_string($connection1, $rowdc['noofconsignee']);
			$maxproduct=mysqli_real_escape_string($connection1, $rowdc['maxproduct']);
			$invoiceno=mysqli_real_escape_string($connection1, $rowdc['invoiceno']);
			$sodate=mysqli_real_escape_string($connection1, $rowdc['invoicedate']);
			$invoicedate=mysqli_real_escape_string($connection1, $rowdc['invoicedate1']);
			$qno=mysqli_real_escape_string($connection1, $rowdc['qno']);
			$qdate=mysqli_real_escape_string($connection1, $rowdc['qdate']);
			$sono=mysqli_real_escape_string($connection1, $rowdc['sono']);
			$maincategory=mysqli_real_escape_string($connection1, $rowdc['maincategory']);
			$tender=mysqli_real_escape_string($connection1, $rowdc['tender']);
			$subcategory=mysqli_real_escape_string($connection1, $rowdc['subcategory']);
			$department=mysqli_real_escape_string($connection1, $rowdc['department']);
			$otherreference=mysqli_real_escape_string($connection1, $rowdc['otherreference']);
			$pono=mysqli_real_escape_string($connection1, $rowdc['pono']);
			$podate=mysqli_real_escape_string($connection1, $rowdc['podate']);
			$custreference=mysqli_real_escape_string($connection1, $rowdc['custreference']);
			$duedays=mysqli_real_escape_string($connection1, $rowdc['duedays']);
			$buyername=mysqli_real_escape_string($connection1, $rowdc['buyername']);
			$buyeraddress1=mysqli_real_escape_string($connection1, $rowdc['buyeraddress1']);
			$buyeraddress2=mysqli_real_escape_string($connection1, $rowdc['buyeraddress2']);
			$buyeraddress3=mysqli_real_escape_string($connection1, $rowdc['buyeraddress3']);
			$buyertaluk=mysqli_real_escape_string($connection1, $rowdc['buyertaluk']);
			$buyerdistrict=mysqli_real_escape_string($connection1, $rowdc['buyerdistrict']);
			$buyerpincode=mysqli_real_escape_string($connection1, $rowdc['buyerpincode']);
			$buyermail=mysqli_real_escape_string($connection1, $rowdc['buyermail']);
			$buyermobile=mysqli_real_escape_string($connection1, $rowdc['buyermobile']);
			$buyerstate=mysqli_real_escape_string($connection1, $rowdc['buyerstate']);
			$rtype=mysqli_real_escape_string($connection1, $rowdc['rtype']);
			$bgst=mysqli_real_escape_string($connection1, $rowdc['bgst']);
			$consigneeno=mysqli_real_escape_string($connection1, $rowdc['consigneeno']);
			$consigneeid=mysqli_real_escape_string($connection1, $rowdc['consigneeid']);
			$conproductid =mysqli_real_escape_string($connection1, $rowdc['conproductid']);
			$consigneename=mysqli_real_escape_string($connection1, $rowdc['consigneename']);
			$conaddress1=mysqli_real_escape_string($connection1, $rowdc['conaddress1']);
			$conaddress2=mysqli_real_escape_string($connection1, $rowdc['conaddress2']);
			$conaddress3=mysqli_real_escape_string($connection1, $rowdc['conaddress3']);
			$contaluk=mysqli_real_escape_string($connection1, $rowdc['contaluk']);
			$condistrict=mysqli_real_escape_string($connection1, $rowdc['condistrict']);
			$conpincode=mysqli_real_escape_string($connection1, $rowdc['conpincode']);
			$concontact=mysqli_real_escape_string($connection1, $rowdc['concontact']);
			$conphone=mysqli_real_escape_string($connection1, $rowdc['conphone']);
			$conmobile=mysqli_real_escape_string($connection1, $rowdc['conmobile']);
			$conemail=mysqli_real_escape_string($connection1, $rowdc['conemail']);
			$conprogroup=mysqli_real_escape_string($connection1, $rowdc['conprogroup']);
			$conmultiple=mysqli_real_escape_string($connection1, $rowdc['conmultiple']);
			$conproduct=mysqli_real_escape_string($connection1, $rowdc['conproduct']);
			$conproductcode=mysqli_real_escape_string($connection1, $rowdc['conproductcode']);
			$conserialno=mysqli_real_escape_string($connection1, $rowdc['conserialno']);
			$conhsncode=mysqli_real_escape_string($connection1, $rowdc['conhsncode']);
			$conper=mysqli_real_escape_string($connection1, $rowdc['conper']);
			$conmarketname=mysqli_real_escape_string($connection1, $rowdc['conmarketname']);
			$concapacity=mysqli_real_escape_string($connection1, $rowdc['concapacity']);
			$conmake=mysqli_real_escape_string($connection1, $rowdc['conmake']);
			$conqty=mysqli_real_escape_string($connection1, $rowdc['conqty']);
			$conunit=mysqli_real_escape_string($connection1, $rowdc['conunit']);
			$conigst=mysqli_real_escape_string($connection1, $rowdc['conigst']);
			$consgst=mysqli_real_escape_string($connection1, $rowdc['consgst']);
			$concgst=mysqli_real_escape_string($connection1, $rowdc['concgst']);
			$conigstamount=mysqli_real_escape_string($connection1, $rowdc['conigstamount']);
			$consgstamount=mysqli_real_escape_string($connection1, $rowdc['consgstamount']);
			$concgstamount=mysqli_real_escape_string($connection1, $rowdc['concgstamount']);
			$contotal=mysqli_real_escape_string($connection1, $rowdc['contotal']);
			$conwarranty=mysqli_real_escape_string($connection1, $rowdc['conwarranty']);
			$subtotalamount=mysqli_real_escape_string($connection1, $rowdc['subtotalamount']);
			$totalgstamount=mysqli_real_escape_string($connection1, $rowdc['totalgstamount']);
			$netamount=mysqli_real_escape_string($connection1, $rowdc['netamount']);
			$discount=mysqli_real_escape_string($connection1, $rowdc['discount']);
			$discountmode=mysqli_real_escape_string($connection1, $rowdc['discountmode']);
			$discountamount=mysqli_real_escape_string($connection1, $rowdc['discountamount']);
			$addamount=mysqli_real_escape_string($connection1, $rowdc['addamount']);
			$lessamount=mysqli_real_escape_string($connection1, $rowdc['lessamount']);
			$grandtotal=mysqli_real_escape_string($connection1, $rowdc['grandtotal']);
			$exp=mysqli_real_escape_string($connection1, $rowdc['exp']);
			$tdelete=mysqli_real_escape_string($connection1, $rowdc['tdelete']);
			$dcno=mysqli_real_escape_string($connection1, $rowdc['dcno']);
			$dcdate=mysqli_real_escape_string($connection1, $rowdc['dcdate']);
			$paymentmode=mysqli_real_escape_string($connection1, $rowdc['paymentmode']);
			$referenceno=mysqli_real_escape_string($connection1, $rowdc['referenceno']);
			$shipment=mysqli_real_escape_string($connection1, $rowdc['shipment']);
			$deliverymethod=mysqli_real_escape_string($connection1, $rowdc['deliverymethod']);
			$agentname=mysqli_real_escape_string($connection1, $rowdc['agentname']);
			$lrno=mysqli_real_escape_string($connection1, $rowdc['lrno']);
			$vechileno=mysqli_real_escape_string($connection1, $rowdc['vechileno']);
			$deliveryremarks=mysqli_real_escape_string($connection1, $rowdc['deliveryremarks']);
			$terms=mysqli_real_escape_string($connection1, $rowdc['terms']);
			$notes=mysqli_real_escape_string($connection1, $rowdc['notes']);
			$congstno=mysqli_real_escape_string($connection1, $rowdc['congstno']);
			$constatecode=mysqli_real_escape_string($connection1, $rowdc['constatecode']);
			$componentname=mysqli_real_escape_string($connection1, $rowdc['componentname']);
			$conmaincategory=mysqli_real_escape_string($connection1, $rowdc['conmaincategory']);
			$consubcategory=mysqli_real_escape_string($connection1, $rowdc['consubcategory']);
			$componenttype=mysqli_real_escape_string($connection1, $rowdc['componenttype']);
			$condepartment=mysqli_real_escape_string($connection1, $rowdc['condepartment']);
			$promaincategory=mysqli_real_escape_string($connection1, $rowdc['promaincategory']);
			$prosubcategory=mysqli_real_escape_string($connection1, $rowdc['prosubcategory']);
			$invoiceqty=mysqli_real_escape_string($connection1, $rowdc['invoiceqty']);
			$dateandtime = date('Y-m-d H:i:s');
			$overdate= $invoicedate;
			$off=(float)$conwarranty;
			$overdate = str_replace('/', '-', $overdate);
			$overdate=date('Y-m-d', strtotime($overdate));
			$warrantydate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
			
		$sqlselect1 = "SELECT id From jrcxl WHERE tdelete='{$tdelete}' and dcno = '{$dcno}' and dcdate = '{$dcdate}' and maincategory = '{$conmaincategory}' and subcategory = '{$consubcategory}' and stockmaincategory = '{$promaincategory}' and stocksubcategory = '{$prosubcategory}' and stockitem = '{$conproduct}' and typeofproduct = '{$conprogroup}' and componenttype = '{$componenttype}' and serialnumber = '{$conserialno}' and invoiceno = '{$invoiceno}' and invoicedate = '{$invoicedate}'";
		$queryselect1 = mysqli_query($connection, $sqlselect1);
        
        if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
		else
		{
			$rowCountselect1 = mysqli_num_rows($queryselect1);	
			 
		if($rowCountselect1 == 0) 
		{		
	      if($conigst!='')
		  {
			 $gstper=$conigst;
		  }
	      else
		  {
			 $gstper =$consgst + $concgst;
		  }
	    
	     $sqlup = "INSERT INTO jrcxl(createdon, createdby, encstatus, file_name, upload_time, invoiceno, invoicedate, tenderno, pono, podate, dcno, dcdate, installedon, installedby, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, gstno, stockmaincategory, stocksubcategory, stockitem, invoicedqty, rate, gstper, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, warranty, warrantydate, qty, serialnumber, sono, sodate, buyername, buyeraddress1, buyeraddress2, buyerarea, buyerdistrict, buyerstate, buyerpincode, buyercontact, buyerphone, buyermobile, buyeremail, buyergstno, buyergsttype) VALUES ('$createdon', '$createdby', '0', 'From Sales Order', '$dateandtime', '$invoiceno', '$invoicedate', '$tender', '$pono', '$podate', '$dcno', '$dcdate', '', '', '$conmaincategory', '$consubcategory', '$consigneename', '$condepartment', '$conaddress1', '$conaddress2', '$conaddress3', '$condistrict', '$conpincode', '$concontact', '$conphone', '$conmobile', '$conemail', '$congstno', '$promaincategory', '$prosubcategory', '$conproduct', '$invoiceqty', '$conunit', '$gstper', '$conwarranty', '$conprogroup', '$componenttype', '$componentname', '$conmake', '$concapacity', '$conwarranty', '$warrantydate', '$conqty', '$conserialno', '$sono', '$sodate', '$buyername', '$buyeraddress1', '$buyeraddress2', 'buyeraddress3', '$buyerdistrict', '$buyerstate', '$buyerpincode', '$buyercontact', '$buyerphone', '$buyermobile', '$buyermail', '$bgst', '$rtype' )";
		 $queryup = mysqli_query($connection, $sqlup);
				 
		if(!$queryup){
	    die("SQL query failed: " . mysqli_error($connection));
		 }
				else
				{
					$sourceid=mysqli_insert_id($connection);
					 
				 $sqlcon = "SELECT id From jrcconsignee WHERE id = '{$consigneeid}'";
					$querycon = mysqli_query($connection, $sqlcon);
					$rowCountcon = mysqli_num_rows($querycon);
					 
					if(!$querycon){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					if($rowCountcon == 0) 
					{	
						 
						$sqlupconsignee = "INSERT INTO jrcconsignee(createdon, createdby, encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, gstno) VALUES ( '$createdon', '$createdby',  '0', '$conmaincategory', '$consubcategory', '$consigneename', '$condepartment', '$conaddress1', '$conaddress2', '$conaddress3', '$condistrict', '$conpincode', '$concontact', '$conphone', '$conmobile', '$conemail', '$congstno')";
						$queryupconsignee = mysqli_query($connection, $sqlupconsignee);
						 
						if(!$queryupconsignee){
						   die("SQL query failed: " . mysqli_error($connection));
						}
						else
						{
							$consigneeid=mysqli_insert_id($connection);
							$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$conmaincategory}' and subcategory = '{$consubcategory}' and consigneename = '{$consigneename}' and department = '{$condepartment}' and district = '{$condistrict}' and pincode = '{$conpincode}'  and mobile = '{$conmobile}'  and phone = '{$conphone}' ";
							$queryup1 = mysqli_query($connection, $sqlup1);
							 
							if(!$queryup1){
							   die("SQL query failed: " . mysqli_error($connection));
							}
						}
					}
					else
					{
						$rowco = mysqli_fetch_array($querycon);	
						$consigneeid=$rowco['id'];	
						$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$conmaincategory}' and subcategory = '{$consubcategory}' and consigneename = '{$consigneename}' and department = '{$condepartment}' and district = '{$condistrict}' and pincode = '{$conpincode}'  and mobile = '{$conmobile}'  and phone = '{$conphone}' ";
						$queryup1 = mysqli_query($connection, $sqlup1);
						 
						if(!$queryup1){
						   die("SQL query failed: " . mysqli_error($connection));
						}
					}
					
					/////////////////////
					 
					$sqlconpro = "SELECT id,warrantycycle,productlifetime From jrcproduct WHERE id = '{$conproductid}'";
					$queryconpro = mysqli_query($connection, $sqlconpro);
					$rowCountconpro = mysqli_num_rows($queryconpro);
					 
					if(!$queryconpro){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					 
					if($rowCountconpro == 0) 
					{	
						 
						 $sqluppro = "INSERT INTO jrcproduct( createdon, createdby, stockmaincategory, stocksubcategory, stockitem, componenttype, componentname, typeofproduct, make, capacity, marketname, hsncode, price ) VALUES ( '$createdon', '$createdby', '$promaincategory', '$prosubcategory', '$conproduct', '$componenttype', '$componentname', '$conprogroup', '$conmake', '$concapacity', '$conmarketname', '$conhsncode', '$conunit')";
						$queryuppro = mysqli_query($connection, $sqluppro);
						 
						if(!$queryuppro){
						   die("SQL query failed: " . mysqli_error($connection));
						}
						else
						{
							$productid=mysqli_insert_id($connection);
							$sqlup1pro = "update jrcxl set productid='{$productid}' WHERE stockmaincategory = '{$promaincategory}' and stocksubcategory = '{$prosubcategory}' and stockitem = '{$conproduct}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$conprogroup}' and make = '{$conmake}' and capacity = '{$concapacity}'";
							$queryup1pro = mysqli_query($connection, $sqlup1pro);
							 
							if(!$queryup1pro){
							   die("SQL query failed: " . mysqli_error($connection));
							}
						}
					}
					else
					{
						$rowcopro = mysqli_fetch_array($queryconpro);
						if($rowcopro['productlifetime']!='' && $rowcopro['productlifetime']!='NULL')
						{
						$off1=(float)$rowcopro['productlifetime'];
						$overdate1 = str_replace('/', '-', $overdate);
						$overdate1=date('Y-m-d', strtotime($overdate1));
						$lifetimedate = date('Y-m-d', strtotime("+$off1 years", strtotime($overdate1)));
						$productlifetime=$rowcopro['productlifetime'];	
						}
						else
						{
							$lifetimedate='';
							$productlifetime='';
						}
						
						
						$productid=$rowcopro['id'];	
						$warrantycycle=$rowcopro['warrantycycle'];	
						
						$sqlup1pro = "update jrcxl set productid='{$productid}',warrantycycle='{$conwarranty}',productlifetime='{$productlifetime}' ,lifetimedate='{$lifetimedate}'  WHERE stockmaincategory = '{$promaincategory}' and stocksubcategory = '{$prosubcategory}' and stockitem = '{$conproduct}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$conprogroup}' and make = '{$conmake}' and capacity = '{$concapacity}'";
						$queryup1pro = mysqli_query($connection, $sqlup1pro);
						 
						if(!$queryup1pro){
						   die("SQL query failed: " . mysqli_error($connection));
						}
					}
				}
	}

	}
	$count++;
	}
			
		
 $sqlselect = "SELECT id, consigneeid, productid, serialnumber, departments, qty From jrcxl where invoiceno='" . $_POST['id'] . "' order by id asc";
$queryselect = mysqli_query($connection, $sqlselect);
$rowCountselect = mysqli_num_rows($queryselect);
if(!$queryselect){
    die("SQL query failed: " . mysqli_error($connection));
}
 
if($rowCountselect > 0) 
{
	$count=1;
	while($rowselect = mysqli_fetch_array($queryselect)) 
	{
		$sourceid=$rowselect['id'];
		$consigneeid=$rowselect['consigneeid'];
		$productid=$rowselect['productid'];
		$serialnumber=$rowselect['serialnumber'];
		$departments=$rowselect['departments'];
		$qty=$rowselect['qty'];
		 $sourceid.'-'.$consigneeid.'-'.$productid.'<br>';
			$sstatus=0;
			$serials=explode("| ",$serialnumber);
			$departs=explode("| ",$departments);
			 	
				for($sr=0;$sr<$qty;$sr++)
				{
					$serialqty=$sr+1;	//////
					$serial="";
					$depart="";
					if(isset($serials[$sr]))
					{		
						$serial=$serials[$sr];	
						$serial=str_replace("\\r","",$serial);
						$serial=str_replace("\\n","",$serial);
					}
					if(isset($departs[$sr]))
					{
						$depart=$departs[$sr];	
						$depart=str_replace("\\r","",$depart);
						$depart=str_replace("\\n","",$depart);
					}
					 
					$sqlup = "INSERT INTO jrcserials(sourceid, consigneeid, productid, serialnumber, serialqty, sstatus) VALUES ( '$sourceid', '$consigneeid', '$productid', '$serial', '$serialqty', '$sstatus')";
					$queryup = mysqli_query($connection, $sqlup);
					 
					if(!$queryup){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					else
					{
						
					}
				}
			
	}
}
	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Uploaded from Sales Order', '', 'jrcxl')");
	 header("Location:exporttally.php?remarks=Invoice Generate Successfully"); 	
		}
	 }
	 else
	 {
	 header("Location:exporttally.php?error=Invoice Not Generate"); 	
	 }
	 }
	 }
?>