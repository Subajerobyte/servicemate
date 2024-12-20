<?php
include('lcheck.php');
if($addconsignee=='0')
{
	header("Location: dashboard.php");
}
	if((isset($_POST['chconsigneeid']))||(isset($_POST['byconsigneeid'])))
	{
		if(isset($_POST['chconsigneeid'])) 
		{
		$data = array();
	$id=mysqli_real_escape_string($connection, $_POST['chconsigneeid']);
	$consigneeid=mysqli_real_escape_string($connection, $_POST['chconsigneeid']);
	$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['chmaincategory']);
	$subcategoryvalue=mysqli_real_escape_string($connection, $_POST['chsubcategory']);
		$consigneenamevalue=mysqli_real_escape_string($connection, $_POST['chconsigneename']);
		$departmentvalue=mysqli_real_escape_string($connection, $_POST['chdepartment']);
		$address1value=mysqli_real_escape_string($connection, $_POST['chaddress1']);
		$address2value=mysqli_real_escape_string($connection, $_POST['chaddress2']);
		$areavalue=mysqli_real_escape_string($connection, $_POST['charea']);
		$districtvalue=mysqli_real_escape_string($connection, $_POST['chdistrict']);
		$pincodevalue=mysqli_real_escape_string($connection, $_POST['chpincode']);
		$contactvalue=mysqli_real_escape_string($connection, $_POST['chcontact']);
		$phonevalue=mysqli_real_escape_string($connection, $_POST['chphone']);
		$mobilevalue=mysqli_real_escape_string($connection, $_POST['chmobile']);
		$emailvalue=mysqli_real_escape_string($connection, $_POST['chemail']);
		$latlong=mysqli_real_escape_string($connection, $_POST['chlatlong']);
		$gstno=mysqli_real_escape_string($connection, $_POST['chgstno']);
		$gsttype=mysqli_real_escape_string($connection, $_POST['chgsttype']);
		$statecode=mysqli_real_escape_string($connection, $_POST['chstatecode']);
		$ctype=mysqli_real_escape_string($connection, $_POST['chctype']);
		}
		else
		{
			$data = array();
	$id=mysqli_real_escape_string($connection, $_POST['byconsigneeid']);
	$consigneeid=mysqli_real_escape_string($connection, $_POST['byconsigneeid']);
	$maincategoryvalue=mysqli_real_escape_string($connection, $_POST['bymaincategory']);
	$subcategoryvalue=mysqli_real_escape_string($connection, $_POST['bysubcategory']);
		$consigneenamevalue=mysqli_real_escape_string($connection, $_POST['byconsigneename']);
		$departmentvalue=mysqli_real_escape_string($connection, $_POST['bydepartment']);
		$address1value=mysqli_real_escape_string($connection, $_POST['byaddress1']);
		$address2value=mysqli_real_escape_string($connection, $_POST['byaddress2']);
		$areavalue=mysqli_real_escape_string($connection, $_POST['byarea']);
		$districtvalue=mysqli_real_escape_string($connection, $_POST['bydistrict']);
		$pincodevalue=mysqli_real_escape_string($connection, $_POST['bypincode']);
		$contactvalue=mysqli_real_escape_string($connection, $_POST['bycontact']);
		$phonevalue=mysqli_real_escape_string($connection, $_POST['byphone']);
		$mobilevalue=mysqli_real_escape_string($connection, $_POST['bymobile']);
		$emailvalue=mysqli_real_escape_string($connection, $_POST['byemail']);
		$latlong=mysqli_real_escape_string($connection, $_POST['bylatlong']);
		$gsttype=mysqli_real_escape_string($connection, $_POST['bygsttype']);
		$gstno=mysqli_real_escape_string($connection, $_POST['bygstno']);
		$statecode=mysqli_real_escape_string($connection, $_POST['bystatecode']);
		$ctype=mysqli_real_escape_string($connection, $_POST['byctype']);
		}
		
		if(($infocompany1['encsystem']=='1')||($infocompany1['encsystem']=='2'))
{
	if((isset($_SESSION['encpass']))&&($_SESSION['encpass']!=""))
	{
		
		
		$address1=jbsencrypt($_SESSION['encpass'], $address1);
		
		
		$phone=jbsencrypt($_SESSION['encpass'], $phone);
		$mobile=jbsencrypt($_SESSION['encpass'], $mobile);
		$email=jbsencrypt($_SESSION['encpass'], $email);
	}
}
		
	if(($maincategoryvalue!="")||($subcategoryvalue!="")||($consigneenamevalue!=""))
	{		
		 
        $sqlcon = "SELECT id From jrcconsignee WHERE id = '{$id}'";
        $querycon = mysqli_query($connection, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountcon > 0) 
		{	
			 
			$sqlup = "update jrcconsignee set maincategory='$maincategoryvalue', subcategory='$subcategoryvalue', consigneename='$consigneenamevalue', department='$departmentvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', latlong='$latlong', gsttype='$gsttype', gstno='$gstno', statecode='$statecode', ctype='$ctype' where id='$id'";
			$queryup = mysqli_query($connection, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Updated Customer Details', '{$id}', 'jrcconsignee')");
				 
				$sqlup1 = "update jrcxl set maincategory='$maincategoryvalue', subcategory='$subcategoryvalue', consigneename='$consigneenamevalue', department='$departmentvalue', address1='$address1value', address2='$address2value', area='$areavalue', district='$districtvalue', pincode='$pincodevalue', contact='$contactvalue', phone='$phonevalue', mobile='$mobilevalue', email='$emailvalue', gstno='$gstno', statecode='$statecode', gsttype='$gsttype' where consigneeid='$id'";
				$queryup1 = mysqli_query($connection, $sqlup1);
				 
				if(!$queryup1){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				else
				{
					 $data[] = array("id"=>$id, "text"=>$consigneenamevalue, "ctype" => $ctype, "consigneeid" => $consigneeid, "consigneename" => $consigneenamevalue, "department" => $departmentvalue, "address1" => $address1, "address2" => $address2, "area" => $area, "district" => $district, "pincode" => $pincode, "contact" => $contact, "phone" => $phone, "mobile" => $mobile, "email" => $email, "gstno" => $gstno, "statecode" => $statecode, "gsttype" => $gsttype);
				}
			} 
	    }
		else
			{
				//header("Location: consignee.php?error=This record is Not Found! Kindly check in All Customer List");
			}
	}
	else
			{
				//header("Location: consignee.php?error=Error Data");
			}
			}
	else
			{
				//header("Location: consignee.php?error=Error Data");
			}
echo json_encode($data);
?>