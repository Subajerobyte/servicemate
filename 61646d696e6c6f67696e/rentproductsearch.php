
<?php
include 'lcheck.php'; 

if((!isset($_POST['searchTerm']))&&(!isset($_POST['stockitem']))){
	$fetchData = mysqli_query($connection,"select * from jrcproduct where  stockitem!='' order by stockitem limit 200");
}else if(isset($_POST['stockitem'])){
	$search = mysqli_real_escape_string($connection,$_POST['stockitem']); 
	$fetchData = mysqli_query($connection,"select * from jrcproduct where  id='".$search."' order by stockitem limit 200");
}else{
	$search = mysqli_real_escape_string($connection,$_POST['searchTerm']); 
	$fetchData = mysqli_query($connection,"select * from jrcproduct where  stockitem like '%".$search."%' limit 200"); 
}
	 
$data = array();

while ($row = mysqli_fetch_array($fetchData)) {
	 $productid = $row['id'];
	 
	if($row['stockmaincategory']!='')
	 {
     $stockmaincategory = $row['stockmaincategory'];
	 }
	 else
	 {
		 $stockmaincategory = "";
	 }
	if($row['stocksubcategory']!='')
	 {
      $stocksubcategory = $row['stocksubcategory'];
	  }
	 else
	 {
		 $stocksubcategory = "";
	 }
	if($row['stockitem']!='')
	 {
      $stockitem = $row['stockitem'];
	  }
	 else
	 {
		 $stockitem = "";
	 }
	if($row['typeofproduct']!='')
	 {
      $typeofproduct = $row['typeofproduct'];
	  }
	 else
	 {
		 $typeofproduct = "";
	 }
	if($row['componenttype']!='')
	 {
      $componenttype = $row['componenttype'];
	  }
	 else
	 {
		 $componenttype = "";
	 }
	if($row['componentname']!='')
	 {
      $componentname = $row['componentname'];
	  }
	 else
	 {
		 $componentname = "";
	 }
	if($row['make']!='')
	 {
      $make = $row['make'];
	  }
	 else
	 {
		 $make = "";
	 }
	if($row['capacity']!='')
	 {
      $capacity = $row['capacity'];
	  }
	 else
	 {
		 $capacity = "";
	 }
	if($row['warranty']!='')
	 {
      $warranty = $row['warranty']; 
	  }
	 else
	 {
		 $warranty = "";
	 }
	if($row['description']!='')
	 {
      $description = $row['description'];
	  }
	 else
	 {
		 $description = "";
	 }
	if($row['rentalvalue']!='')
	 {
      $rentalvalue = $row['rentalvalue'];
	  }
	 else
	 {
		 $rentalvalue = "";
	 }
	if($row['rentalminvalue']!='')
	 {
      $rentalminvalue = $row['rentalminvalue'];
	  }
	 else
	 {
		 $rentalminvalue = "";
	 }
	if($row['rentalgst']!='')
	 {
      $rentalgst = $row['rentalgst']; 
	  }
	 else
	 {
		 $rentalgst = "";
	 }
	if($row['currentstock']!='')
	 {
      $currentstock = $row['currentstock']; 
	  }
	 else
	 {
		 $currentstock = "";
	 }
	if($row['type']!='')
	 {
      $type = $row['type']; 
	  }
	 else
	 {
		 $type = "";
	 }
	if($row['sku']!='')
	 {
      $sku = $row['sku']; 
	  }
	 else
	 {
		 $sku = "";
	 }
	if($row['unit']!='')
	 {
      $unit = $row['unit']; 
	  }
	 else
	 {
		 $unit = "";
	 }
	if($row['hsncode']!='')
	 {
      $hsncode = $row['hsncode']; 
	  }
	 else
	 {
		 $hsncode = "";
	 }
	if($row['taxpreference']!='')
	 {
      $taxpreference = $row['taxpreference']; 
	  }
	 else
	 {
		 $taxpreference = "";
	 }
	if($row['gstpercentage']!='')
	 {
      $gstpercentage = $row['gstpercentage']; 
	  }
	 else
	 {
		 $gstpercentage = "";
	 }
	if($row['igstpercentage']!='')
	 {
      $igstpercentage = $row['igstpercentage']; 
	  }
	 else
	 {
		 $igstpercentage = "";
	 }
	 if($row['rentalgst']!='')
	 {
      $gst = $row['rentalgst']; 
	  }
	 else
	 {
		 $gst = "";
	 }
$curr=array();
$sqlist=mysqli_query($connection, "select id, godownname from jrcgodown where godowntype='Rental' or godowntype='Sales'");
while($infost=mysqli_fetch_array($sqlist))
{
	$sqlist1=mysqli_query($connection, "select availablestock from jrcproductstock where godownid='".$infost['id']."' and productid='".$row['id']."'");
	if(mysqli_num_rows($sqlist1)>0)
	{		
	$infost1=mysqli_fetch_array($sqlist1);
	$av=(float)$infost1['availablestock'];
	}
	else
	{
		$av=0;
	}
	
	$curr[] = array("id"=>$infost['id'], "godownname"=>$infost['godownname'], "availablestock"=>$av);
}


  $data[] = array("id"=>$row['id'], "text"=>$row['stockitem'],"gst" => $gst, "rentalgst" => $rentalgst, "productid" => $productid, "stockitem" => $stockitem, "stockmaincategory" => $stockmaincategory, "stocksubcategory" => $stocksubcategory, "stockitem" => $stockitem, "typeofproduct" => $typeofproduct, "componenttype" => $componenttype, "componentname" => $componentname, "make" => $make, "capacity" => $capacity, "warranty" => $warranty, "description" => $description, "rentalminvalue" => $rentalminvalue, "rentalvalue" => $rentalvalue, "currentstock" => $currentstock, "type" => $type, "sku" => $sku, "unit" => $unit, "hsncode" => $hsncode, "taxpreference" => $taxpreference, "gstpercentage" => $gstpercentage, "igstpercentage" => $igstpercentage, "availablestock" => $curr);
}

echo json_encode($data);