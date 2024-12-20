<?php
include 'lcheck.php'; 

if((!isset($_POST['searchTerm']))&&(!isset($_POST['consigneename']))){
	$fetchData = mysqli_query($connection,"select * from jrcconsignee where consigneename!='' order by consigneename limit 200");
}else if(isset($_POST['consigneename'])){
	$search = mysqli_real_escape_string($connection,$_POST['consigneename']); 
	$fetchData = mysqli_query($connection,"select * from jrcconsignee where id='".$search."' order by consigneename limit 200");
}else{
	$search = mysqli_real_escape_string($connection,$_POST['searchTerm']); 
	$fetchData = mysqli_query($connection,"select * from jrcconsignee where consigneename like '%".$search."%' limit 200");
}
	 
$data = array();

while ($row = mysqli_fetch_array($fetchData)) {
	 $consigneeid = $row['id'];
	 if($row['consigneename']!='')
	 {
      $consigneename = $row['consigneename'];
	 }
	 else
	 {
		 $consigneename ="";
	 }
	 if($row['department']!='')
	 {
      $department = $row['department'];
}
	 else
	 {
		 $department ="";
	 }
	 if($row['address1']!='')
	 {     
	 $address1 = $row['address1'];
      }
	 else
	 {
		 $address1 ="";
	 }
	 if($row['address2']!='')
	 {
	  $address2 = $row['address2'];
      }
	 else
	 {
		 $address2 ="";
	 }
	 if($row['area']!='')
	 {
	  $area = $row['area'];
      }
	 else
	 {
		 $area ="";
	 }
	 if($row['district']!='')
	 {
	  $district = $row['district'];
      }
	 else
	 {
		 $district ="";
	 }
	 if($row['pincode']!='')
	 {
	  $pincode = $row['pincode'];
      }
	 else
	 {
		 $pincode ="";
	 }
	 if($row['contact']!='')
	 {
	  $contact = $row['contact'];
      }
	 else
	 {
		 $contact ="";
	 }
	 if($row['phone']!='')
	 {
	  $phone = $row['phone'];
      }
	 else
	 {
		 $phone ="";
	 }
	 if($row['mobile']!='')
	 {
	  $mobile = $row['mobile']; 
      }
	 else
	 {
		 $mobile ="";
	 }
	 if($row['email']!='')
	 {
	  $email = $row['email'];
      }
	 else
	 {
		 $email ="";
	 }
	 if($row['gsttype']!='')
	 {
	  $gsttype = $row['gsttype'];
      }
	 else
	 {
		 $gsttype ="";
	 }
	 if($row['gstno']!='')
	 {
	  $gstno = $row['gstno'];
      }
	 else
	 {
		 $gstno ="";
	 }
	 if($row['statecode']!='')
	 {
	  $statecode = $row['statecode'];
      }
	 else
	 {
		 $statecode ="";
	 }
	 if($row['ctype']!='')
	 {
	  $ctype = $row['ctype'];
	  }
	 else
	 {
		 $ctype ="";
	 }

    $data[] = array("id"=>$row['id'], "text"=>$row['consigneename'], "ctype" => $ctype, "consigneeid" => $consigneeid, "consigneename" => $consigneename, "department" => $department, "address1" => $address1, "address2" => $address2, "area" => $area, "district" => $district, "pincode" => $pincode, "contact" => $contact, "phone" => $phone, "mobile" => $mobile, "email" => $email, "gstno" => $gstno, "gsttype" => $gsttype, "statecode" => $statecode);
}

echo json_encode($data);