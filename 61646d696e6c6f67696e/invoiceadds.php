<?php
include('lcheck.php');
if($addinvoice=='0')
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	if(isset($_POST['submit']))
	{
	$fileName = "From Invoice Add";
  
	$upload_time=date("Y-m-d H:i:s");
	$uploadby=$_SESSION['email'];
	
	$invoiceno=mysqli_real_escape_string($connection, $_POST['invoiceno']);
	$invoicedate=mysqli_real_escape_string($connection, $_POST['invoicedate']);
	$tenderno=mysqli_real_escape_string($connection, $_POST['tenderno']);
    $claimsubon=mysqli_real_escape_string($connection, $_POST['claimsubon']);
	$claimper=mysqli_real_escape_string($connection, $_POST['claimper']);
	$claimamt=mysqli_real_escape_string($connection, $_POST['claimamt']);
	$invoiceamt=mysqli_real_escape_string($connection, $_POST['invoiceamt']);
	$installrefno=mysqli_real_escape_string($connection, $_POST['installrefno']);
	$suprefno=mysqli_real_escape_string($connection, $_POST['suprefno']);	
	$pono=mysqli_real_escape_string($connection, $_POST['pono']);
	$podate=mysqli_real_escape_string($connection, $_POST['podate']);
	$dcno=mysqli_real_escape_string($connection, $_POST['dcno']);
	$dcdate=mysqli_real_escape_string($connection, $_POST['dcdate']);
	$installedon=mysqli_real_escape_string($connection, $_POST['installedon']);
	$installedby=mysqli_real_escape_string($connection, $_POST['installedby']);
	$consigneeid=mysqli_real_escape_string($connection, $_POST['consigneeid']);
	$maincategory=mysqli_real_escape_string($connection, $_POST['maincategory']);
	$subcategory=mysqli_real_escape_string($connection, $_POST['subcategory']);
		$consigneename=mysqli_real_escape_string($connection, $_POST['consigneename']);
		$department=mysqli_real_escape_string($connection, $_POST['department']);
		$address1=mysqli_real_escape_string($connection, $_POST['address1']);
		$address2=mysqli_real_escape_string($connection, $_POST['address2']);
		$area=mysqli_real_escape_string($connection, $_POST['area']);
		$district=mysqli_real_escape_string($connection, $_POST['district']);
		$pincode=mysqli_real_escape_string($connection, $_POST['pincode']);
		$contact=mysqli_real_escape_string($connection, $_POST['contact']);
		$phone=mysqli_real_escape_string($connection, $_POST['phone']);
		$mobile=mysqli_real_escape_string($connection, $_POST['mobile']);
		$email=mysqli_real_escape_string($connection, $_POST['email']);
		
$encstatus=0;		
if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{
		$encstatus=1;
		
		
		$address1=jbsencrypt($_SESSION['encpass'], $address1);
		
		
		$phone=jbsencrypt($_SESSION['encpass'], $phone);
		$mobile=jbsencrypt($_SESSION['encpass'], $mobile);
		$email=jbsencrypt($_SESSION['encpass'], $email);
	}
}
		
		$invoicedqty=mysqli_real_escape_string($connection, $_POST['invoicedqty']);
		$overallwarranty=mysqli_real_escape_string($connection, $_POST['overallwarranty']);
		
		
		
	if((isset($_POST['oldxlid']))&&is_array($_POST['oldxlid']))
	{
	for($i=0;$i<count($_POST['oldxlid']);$i++)
	{
	$oldxlidvalue=mysqli_real_escape_string($connection, $_POST['oldxlid'][$i]);
	$productid=mysqli_real_escape_string($connection, $_POST['productid'][$i]);	
	$stockmaincategory=mysqli_real_escape_string($connection, $_POST['stockmaincategory'][$i]);
	$stocksubcategory=mysqli_real_escape_string($connection, $_POST['stocksubcategory'][$i]);
	$stockitem=mysqli_real_escape_string($connection, $_POST['stockitem'][$i]);
	$typeofproduct=mysqli_real_escape_string($connection, $_POST['typeofproduct'][$i]);
	$componenttype=mysqli_real_escape_string($connection, $_POST['componenttype'][$i]);
	$componentname=mysqli_real_escape_string($connection, $_POST['componentname'][$i]);
	$make=mysqli_real_escape_string($connection, $_POST['make'][$i]);
	$capacity=mysqli_real_escape_string($connection, $_POST['capacity'][$i]);
	$warranty=mysqli_real_escape_string($connection, $_POST['warranty'][$i]);
if($installedon!='')
{
$overdate=$installedon;
}
else
{
$overdate= $invoicedate;
}
if($warranty!='')
{
$off=(float)$warranty;
$overdate = str_replace('/', '-', $overdate);
$overdate=date('Y-m-d', strtotime($overdate));
$warrantydate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
}
else
{
	$warrantydate='';
}
	
	if($oldxlidvalue=='')
	{	
				 
				$sqlup = "INSERT INTO jrcxl(encstatus, file_name, upload_time, invoiceno, invoicedate, tenderno,claimsubon,claimper,claimamt,invoiceamt,installrefno,suprefno, pono, podate, dcno, dcdate, installedon, installedby, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email, stockmaincategory, stocksubcategory, stockitem, invoicedqty, overallwarranty, typeofproduct, componenttype, componentname, make, capacity, warranty,warrantydate, qty, serialnumber) VALUES ('$encstatus', '$fileName', '$upload_time', '$invoiceno', '$invoicedate', '$tenderno','$claimsubon','$claimper','$claimamt','$invoiceamt','$installrefno','$suprefno' ,'$pono', '$podate', '$dcno', '$dcdate', '$installedon', '$installedby', '$maincategory', '$subcategory', '$consigneename', '$department', '$address1', '$address2', '$area', '$district', '$pincode', '$contact', '$phone', '$mobile', '$email', '$stockmaincategory', '$stocksubcategory', '$stockitem', '$invoicedqty', '$overallwarranty', '$typeofproduct', '$componenttype', '$componentname', '$make', '$capacity', '$warranty', '$warrantydate', '$qty', '$serialnumber')";
				$queryup = mysqli_query($connection, $sqlup);
				 
				if(!$queryup){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					$sourceid=mysqli_insert_id($connection);
					if($consigneeid!="")
					{
					$sqlcon = "SELECT id From jrcconsignee WHERE id = '{$consigneeid}'";
					}
					else
					{
					$sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
					}
					
					$querycon = mysqli_query($connection, $sqlcon);
					$rowCountcon = mysqli_num_rows($querycon);
					 
					if(!$querycon){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					 
					if($rowCountcon == 0) 
					{	
						 
						$sqlupconsignee = "INSERT INTO jrcconsignee(encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email) VALUES ( '$encstatus','$maincategory', '$subcategory', '$consigneename', '$department', '$address1', '$address2', '$area', '$district', '$pincode', '$contact', '$phone', '$mobile', '$email')";
						$queryupconsignee = mysqli_query($connection, $sqlupconsignee);
						 
						if(!$queryupconsignee){
						   die("SQL query failed: " . mysqli_error($connection));
						}
						else
						{
							$consigneeid=mysqli_insert_id($connection);
							$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
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
						$sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
						$queryup1 = mysqli_query($connection, $sqlup1);
						 
						if(!$queryup1){
						   die("SQL query failed: " . mysqli_error($connection));
						}
					}
					/////////////////////
					 
					$sqlconpro = "SELECT id,warrantycycle,productlifetime From jrcproduct WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
					$queryconpro = mysqli_query($connection, $sqlconpro);
					$rowCountconpro = mysqli_num_rows($queryconpro);
					 
					if(!$queryconpro){
					   die("SQL query failed: " . mysqli_error($connection));
					}
					 
					if($rowCountconpro == 0) 
					{	
						 
						$sqluppro = "INSERT INTO jrcproduct( stockmaincategory, stocksubcategory, stockitem, componenttype, componentname, typeofproduct, make, capacity) VALUES ('$stockmaincategory', '$stocksubcategory', '$stockitem', '$componenttype', '$componentname', '$typeofproduct', '$make', '$capacity')";
						$queryuppro = mysqli_query($connection, $sqluppro);
						 
						if(!$queryuppro){
						   die("SQL query failed: " . mysqli_error($connection));
						}
						else
						{
							$productid=mysqli_insert_id($connection);
							$sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
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
						$sqlup1pro = "update jrcxl set productid='{$productid}',warrantycycle='{$warrantycycle}',productlifetime='{$productlifetime}',lifetimedate='{$lifetimedate}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
						$queryup1pro = mysqli_query($connection, $sqlup1pro);
						 
						if(!$queryup1pro){
						   die("SQL query failed: " . mysqli_error($connection));
						}
					}
				}
			}
	


		
	
	
	}		
	}
$sqlselect = "SELECT id, consigneeid, productid, serialnumber, departments, qty From jrcxl where tdelete='0' and  invoiceno='".$invoiceno."' and invoicedate='".$invoicedate."' order by id asc";
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
		//echo $sourceid.'-'.$consigneeid.'-'.$productid.'<br>';
			$sstatus=0;
			$serials=explode("| ",$serialnumber);
			$departs=explode("| ",$departments);
			 
			$sqlcon = "delete From jrcserials WHERE sourceid = '{$sourceid}' and consigneeid = '{$consigneeid}' and productid = '{$productid}'";
			$querycon = mysqli_query($connection, $sqlcon);
			 
			if(!$querycon){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{	
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
}	
mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'New Invoice Added', '{$sourceid}' , 'jrcxl')");	
header("Location: consigneeview.php?id={$consigneeid}&remarks=Added Successfully");
			}
	else
			{
				header("Location: consignee.php?error=Error Data");
			}
}
else
			{
				header("Location: consignee.php");
			}






?>