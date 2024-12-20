<?php
include('lcheck.php'); 
 if(isset($_GET['id']))
 {
$printid=mysqli_real_escape_string($connection, $_GET['id']);
		$sqlselect = "SELECT * From jrcinvoicesubmission where id='".$printid."' order by id desc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if($rowCountselect > 0) 
		{
			
			$rowselect=array();
			while($row = mysqli_fetch_array($queryselect)) 
			{
				$rowselect[]=$row;
			}



?>
										
										
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Letter Printing</title>
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php  include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/jquery-upload/jquery-file-upload.css" rel="stylesheet">
  <style>
  /* Styles go here */

.page-header, .page-header-space {
height:80px;
}

.page-footer, .page-footer-space {

height:133.5px;
}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
}

.page-header {
  position: fixed;
  top: 0mm;
  width: 100%;
}

.page {
  page-break-after: auto;
}

}
@page {
  margin: 20mm
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;}
   .footer21 {page-break-after: auto;}
}
body
{
	font-size:130%;
}
.table td, .table th
{
	padding: 0.5rem 0.5rem;
	
	
}

  </style>
</head>

<body onLoad="window.print()">

  <div class="page-header" style="text-align: center">
    <img src="<?=$_SESSION['companyheaderimage']?>" style="width:100%; height:auto">
  </div>

  <div class="page-footer">
    <img src="<?=$_SESSION['companyfooterimage']?>" style="width:100%; height:auto">
  </div>

  <table>

    <thead>
      <tr>
        <td>
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <div class="page">
		 
<?Php

			   	$sqlselect1 = "SELECT * From jrcxl where claimsubon='".$rowselect[0]['claimsubon']."' and title='".$rowselect[0]['title']."' group by claimsubon,id order by id asc";
        $queryselect1 = mysqli_query($connection, $sqlselect1);
		$rowCountselect1 = mysqli_num_rows($queryselect1);
        if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
		
	$data=array();
while($rowxl = mysqli_fetch_assoc($queryselect1))
{
	$data[]=$rowxl;
}
$x=1;


$totalrows=count($data);
$fullval=floor($totalrows/5);
$remain=$totalrows%5;
$tdata=array();
$kr=1;
for($k=0;$k<$fullval;$k++)
{
	$tdata[]=5;
	$kr++;
}
if($remain!=0)
{
if($remain>1)
{
	$tdata[]=$remain;
}
else
	{
		$tdata[$kr-1]=$remain;
	}
}
$term=array();
for($r=1;$r<=12;$r++)
{
//if(($rowselect[0]['column'.$r]!='')&&($rowselect[0]['value'.$r]!=''))
if(($rowselect[0]['column'.$r]!='')&&($rowselect[0]['value'.$r]!='NULL'))
{
	$term[$rowselect[0]['column'.$r]]=$rowselect[0]['value'.$r];
}
}

$vstart=0;
$vend=0;
for($j=0;$j<count($tdata);$j++)
{
	$vend+=$tdata[$j];
	$message1=$rowselect[0]['message'];
	$message1=str_replace('<Invoice_Submitted_On>',$data[$j]['claimsubon'],$message1);
	$message1=str_replace('&lt;Invoice_Submitted_On&gt;',$data[$j]['claimsubon'],$message1);
	$message1=str_replace('<Invoice_Amount>',$data[$j]['invoiceamt'],$message1);
	$message1=str_replace('&lt;Invoice_Amount&gt;',$data[$j]['invoiceamt'],$message1);
	$message1=str_replace('<Claim_Percentage>',$data[$j]['claimper'],$message1);
	$message1=str_replace('&lt;Claim_Percentage&gt;',$data[$j]['claimper'],$message1);
	$message1=str_replace('<Claim_Amount>',$data[$j]['claimamt'],$message1);
	$message1=str_replace('&lt;Claim_Amount&gt;',$data[$j]['claimamt'],$message1);
	$message1=str_replace('<Installation_Ref_No>',$data[$j]['installrefno'],$message1);
	$message1=str_replace('&lt;Installation_Ref_No&gt;',$data[$j]['installrefno'],$message1);
	$message1=str_replace('<Supplier_Invoice_Ref_No>',$data[$j]['suprefno'],$message1);
	$message1=str_replace('&lt;Supplier_Invoice_Ref_No&gt;',$data[$j]['suprefno'],$message1);
	$message1=str_replace('<PO_No>',$data[$j]['pono'],$message1);
	$message1=str_replace('&lt;PO_No&gt;',$data[$j]['pono'],$message1);
	$message1=str_replace('<Quantity>',$data[$j]['invoicedqty'],$message1);
	$message1=str_replace('&lt;Quantity&gt;',$data[$j]['invoicedqty'],$message1);
	$message1=str_replace('<Invoice_Number>',$data[$j]['invoiceno'],$message1);
	$message1=str_replace('&lt;Invoice_Number&gt;',$data[$j]['invoiceno'],$message1);
	$message1=str_replace('<Invoice_Date>',$data[$j]['invoicedate'],$message1);
	$message1=str_replace('&lt;Invoice_Date&gt;',$data[$j]['invoicedate'],$message1);
	

$message2='<table border="1" width="100%"><tr>';
$colsp=0;
foreach($term as $key => $value) 
{
	$message2.='<th>'.$key.'</th>';
	$colsp++;
}
$message2.='</tr>';
$totalamount=0;
for($m=$vstart;$m<$vend;$m++)
{
	$message2.='<tr>';
	foreach($term as $key => $value) 
	{
		if($value=='<Invoice_Submitted_On>')
		{
			$message2.='<td style="text-align: center;">'.$data[$m]['claimsubon'].'</td>';
		}
		if($value=='<Invoice_Amount>')
		{
			$message2.='<td style="text-align: center;">'.$data[$m]['invoiceamt'].'</td>';
		}
		if($value=='<Claim_Percentage>')
		{
			$message2.='<td>'.$data[$m]['claimper'].'</td>';
		}
		if($value=='<Claim_Amount>')
		{
			$message2.='<td>'.$data[$m]['claimamt'].'</td>';
			$totalamount+=(float)$data[$m]['claimamt'];
		}
		if($value=='<Installation_Ref_No>')
		{
			$message2.='<td>'.$data[$m]['installrefno'].'</td>';
		}
		if($value=='<Supplier_Invoice_Ref_No>')
		{
			$message2.='<td>'.$data[$m]['suprefno'].'</td>';
		}
		if($value=='<PO_No>')
		{
			$message2.='<td>'.$data[$m]['pono'].'</td>';
		}
		if($value=='<Quantity>')
		{
			$message2.='<td>'.$data[$m]['invoicedqty'].'</td>';
		}
		if($value=='<Invoice_Number>')
		{
			$message2.='<td>'.$data[$m]['invoiceno'].'</td>';
		}
		if($value=='<Invoice_Date>')
		{
			$message2.='<td>'.$data[$m]['invoicedate'].'</td>';
		}
		if($value==' ')
		{
			$message2.='<td> </td>';
		}
	}

	$message2.='</tr>';
}
if($totalamount!=0)
{
	$message2.='<tr><th colspan="'.($colsp-1).'">Total</th><th>'.$totalamount.'</th></tr>';
}
$message2.='</table>';



$message1=str_replace('<Insert_Table>',$message2,$message1);
	$message1=str_replace('&lt;Insert_Table&gt;',$message2,$message1);
	echo $message1;

if($j<(count($tdata)-1))
{
	echo '<p style="page-break-after: always">&nbsp;</p>';
}
$vstart=$m;
}






/* 


//for heading
 while($rowselect[0]['column'.$x]!='')
 {
	 echo $rowselect[0]['column'.$x];
	$x++;
 }
 $y=1;
 //for data
 while($rowselect[0]['value'.$y]!='')
 {
	
 foreach($rowselect as $row)
{
$inserttable=$row['value'.$y];

foreach($data as $rowxl)
{
	$inserttable=str_replace('<Invoice_Number>',$rowxl['claimsubon'],$inserttable);
	$inserttable=str_replace('&lt;Invoice_Number&gt;',$rowxl['claimsubon'],$inserttable);
	$inserttable=str_replace('<Invoice_Amount>',$rowxl['invoiceamt'],$inserttable);
	$inserttable=str_replace('&lt;Invoice_Amount&gt;',$rowxl['invoiceamt'],$inserttable);
	$inserttable=str_replace('<Claim_Percentage>',$rowxl['claimper'],$inserttable);
	$inserttable=str_replace('&lt;Claim_Percentage&gt;',$rowxl['claimper'],$inserttable);
	$inserttable=str_replace('<Claim_Amount>',$rowxl['claimamt'],$inserttable);
	$inserttable=str_replace('&lt;Claim_Amount&gt;',$rowxl['claimamt'],$inserttable);
	$inserttable=str_replace('<Installation_Ref_No>',$rowxl['installrefno'],$inserttable);
	$inserttable=str_replace('&lt;Installation_Ref_No&gt;',$rowxl['installrefno'],$inserttable);
	$inserttable=str_replace('<Supplier_Invoice_Ref_No>',$rowxl['suprefno'],$inserttable);
	$inserttable=str_replace('&lt;Supplier_Invoice_Ref_No&gt;',$rowxl['suprefno'],$inserttable);
	$inserttable=str_replace('<PO_No>',$rowxl['pono'],$inserttable);
	$inserttable=str_replace('&lt;PO_No&gt;',$rowxl['pono'],$inserttable);
	$inserttable=str_replace('<Quantity>',$rowxl['invoicedqty'],$inserttable);
	$inserttable=str_replace('&lt;Quantity&gt;',$rowxl['invoicedqty'],$inserttable);
	$inserttable=str_replace('<Invoice_Number>',$rowxl['invoiceno'],$inserttable);
	$inserttable=str_replace('&lt;Invoice_Number&gt;',$rowxl['invoiceno'],$inserttable);
	$inserttable=str_replace('<Invoice_Date>',$rowxl['invoicedate'],$inserttable);
	$inserttable=str_replace('&lt;Invoice_Date&gt;',$rowxl['invoicedate'],$inserttable);
	$inserttable=str_replace('<Insert_table>',$rowxl['invoicedate'],$inserttable);
	$inserttable=str_replace('&lt;Insert_table&gt;',$rowxl['invoicedate'],$inserttable);
	print_r($inserttable);
	
}
	
	
} 
 $y++;
	
 }
 //for data

	$message1=$rowselect[0]['message'];
	$message1=str_replace('<Invoice_Submitted_On>',$data[0]['claimsubon'],$message1);
	$message1=str_replace('&lt;Invoice_Submitted_On&gt;',$data[0]['claimsubon'],$message1);
	$message1=str_replace('<Invoice_Amount>',$data[0]['invoiceamt'],$message1);
	$message1=str_replace('&lt;Invoice_Amount&gt;',$data[0]['invoiceamt'],$message1);
	$message1=str_replace('<Claim_Percentage>',$data[0]['claimper'],$message1);
	$message1=str_replace('&lt;Claim_Percentage&gt;',$data[0]['claimper'],$message1);
	$message1=str_replace('<Claim_Amount>',$data[0]['claimamt'],$message1);
	$message1=str_replace('&lt;Claim_Amount&gt;',$data[0]['claimamt'],$message1);
	$message1=str_replace('<Installation_Ref_No>',$data[0]['installrefno'],$message1);
	$message1=str_replace('&lt;Installation_Ref_No&gt;',$data[0]['installrefno'],$message1);
	$message1=str_replace('<Supplier_Invoice_Ref_No>',$data[0]['suprefno'],$message1);
	$message1=str_replace('&lt;Supplier_Invoice_Ref_No&gt;',$data[0]['suprefno'],$message1);
	$message1=str_replace('<PO_No>',$data[0]['pono'],$message1);
	$message1=str_replace('&lt;PO_No&gt;',$data[0]['pono'],$message1);
	$message1=str_replace('<Quantity>',$data[0]['invoicedqty'],$message1);
	$message1=str_replace('&lt;Quantity&gt;',$data[0]['invoicedqty'],$message1);
	$message1=str_replace('<Invoice_Number>',$data[0]['invoiceno'],$message1);
	$message1=str_replace('&lt;Invoice_Number&gt;',$data[0]['invoiceno'],$message1);
	$message1=str_replace('<Invoice_Date>',$data[0]['invoicedate'],$message1);
	$message1=str_replace('&lt;Invoice_Date&gt;',$data[0]['invoicedate'],$message1);
	$message1=str_replace('<Insert_table>',$data[0]['invoicedate'],$message1);
	$message1=str_replace('&lt;Insert_table&gt;',$data[0]['invoicedate'],$message1);
	$message1=str_replace('<Insert_Table>',$inserttable,$message1);
	$message1=str_replace('&lt;<Insert_Table>&gt;',$inserttable,$message1);
	 */
	?>
	
	
		 
          </div>
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>
<?php
					
			}
		
			?>
 <?php
 }
?>