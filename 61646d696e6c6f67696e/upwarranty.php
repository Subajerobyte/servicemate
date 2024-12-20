<?php
include('lcheck.php');
$sqlselect = "SELECT * From jrcxl";
				  
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			$stockitem="";
			$invoiceno="";
			$invoicedate="";
			
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				$id=$rowselect['id'];
				if($rowselect['warranty']!='')
				{
				  if($rowselect['installedon']!='')
				  {
					  $overdate=$rowselect['installedon'];
				  }
				  else
				  {
					  $overdate=$rowselect['invoicedate'];
				  }
				  $off=(float)$rowselect['warranty'];
				  $overdate = str_replace('/', '-', $overdate);
				  $overdate=date('Y-m-d', strtotime($overdate));
				 $warrantydate = date('Y-m-d', strtotime("+$off months", strtotime($overdate)));
				
				$sql=mysqli_query($connection,"update jrcxl set warrantydate='$warrantydate' where id='$id'");
				if($sql)
				{
					echo $id.'-'.$warrantydate.'<br>';
				}
				}
			}
		}
		
?>