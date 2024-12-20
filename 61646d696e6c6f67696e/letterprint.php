<?php
include('lcheck.php'); 
 if(isset($_GET['id']))
 {
$printid=mysqli_real_escape_string($connection, $_GET['id']);
		$sqlselect = "SELECT message,numberofcommon,fieldname1,fieldname2,fieldname3,fieldname4,fieldname5,fieldname6,    fieldname7,fieldname8,fieldname9,fieldname10,fieldvalue1,fieldvalue2,fieldvalue3,fieldvalue4,fieldvalue5,fieldvalue6,    fieldvalue7,fieldvalue8,fieldvalue9,fieldvalue10 From jrcletter where id='".$printid."' order by id desc";
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
	padding: 0.2rem 0.5rem;
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
							  
	$message1=$rowselect['message'];	
	$numberofcommon=$rowselect['numberofcommon'];	
	for($i=1;$i<=$numberofcommon;$i++)
	{
	 		 
	 ${'fieldvaluearray'.$i}=explode("\r\n",$rowselect['fieldvalue'.$i]);
	// ${'fieldnamearray'.$i}=explode("\r\n",$rowselect['fieldname'.$i]);
		
	}
	$j=0;
	foreach( $fieldvaluearray1 as $fv)
	{
	$message2=str_replace("\r\n",'',$message1);
	if($rowselect['fieldname1']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname1'].'>',$fieldvaluearray1[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname1'].'&gt;',$fieldvaluearray1[$j],$message2);
	}
	if($rowselect['fieldname2']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname2'].'>',$fieldvaluearray2[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname2'].'&gt;',$fieldvaluearray2[$j],$message2);
	}
	if($rowselect['fieldname3']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname3'].'>',$fieldvaluearray3[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname3'].'&gt;',$fieldvaluearray3[$j],$message2);
	}
	if($rowselect['fieldname4']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname4'].'>',$fieldvaluearray4[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname4'].'&gt;',$fieldvaluearray4[$j],$message2);
	}
	if($rowselect['fieldname5']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname5'].'>',$fieldvaluearray5[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname5'].'&gt;',$fieldvaluearray5[$j],$message2);
	}
	if($rowselect['fieldname6']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname6'].'>',$fieldvaluearray6[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname6'].'&gt;',$fieldvaluearray6[$j],$message2);
	}
	if($rowselect['fieldname7']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname7'].'>',$fieldvaluearray7[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname7'].'&gt;',$fieldvaluearray7[$j],$message2);
	}
	if($rowselect['fieldname8']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname8'].'>',$fieldvaluearray8[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname8'].'&gt;',$fieldvaluearray8[$j],$message2);
	}
	if($rowselect['fieldname9']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname9'].'>',$fieldvaluearray9[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname9'].'&gt;',$fieldvaluearray9[$j],$message2);
	}
	if($rowselect['fieldname10']!="")
	{
	$message2=str_replace('<'.$rowselect['fieldname10'].'>',$fieldvaluearray10[$j],$message2);
	$message2=str_replace('&lt;'.$rowselect['fieldname10'].'&gt;',$fieldvaluearray10[$j],$message2);
	}
	/*echo '\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ '.$fieldvaluearray1[$j];*/
echo '<p style="margin-top: 100px; margin-bottom: 100px; margin-right: 150px;  margin-left: 80px;">
	';
	echo $message2;
	echo '
	</p> <p style="page-break-after: always;">&nbsp;</p>';
	
	
	
	
	
	
	
	
	$j++;	
	}
	/*$message1=str_replace("\r\n",'',$message1);
	$message1=str_replace('<fieldname1>',$fieldvalue1,$message1);
	$message1=str_replace('&lt;fieldname1&gt;',$fieldvalue1,$message1);
	$message1=str_replace('<fieldname2>',$fieldvalue2,$message1);
	$message1=str_replace('&lt;fieldname2&gt;',$fieldvalue2,$message1);
	$message1=str_replace('<fieldname3>',$fieldname3,$message1);
	$message1=str_replace('&lt;fieldname3&gt;',$fieldname3,$message1);
	$message1=str_replace('<fieldname4>',$fieldname4,$message1);
	$message1=str_replace('&lt;fieldname4&gt;',$fieldname4,$message1);
	$message1=str_replace('<fieldname5>',$fieldname5,$message1);
	
	$message1=str_replace('&lt;fieldname5&gt;',$fieldname5,$message1);
	$message1=str_replace('<fieldname6>',$fieldname6,$message1);
	$message1=str_replace('&lt;fieldname6&gt;',$fieldname6,$message1);
	$message1=str_replace('<fieldname7>',$fieldname7,$message1);
	$message1=str_replace('&lt;fieldname7&gt;',$fieldname7,$message1);
	$message1=str_replace('<fieldname8>',$fieldname8,$message1);
	$message1=str_replace('&lt;fieldname8&gt;',$fieldname8,$message1);
	$message1=str_replace('<fieldname9>',$fieldname9,$message1);
	$message1=str_replace('&lt;fieldname9&gt;',$fieldname9,$message1);
	$message1=str_replace('<fieldname10>',$fieldname10,$message1);
	$message1=str_replace('&lt;fieldname10&gt;',$fieldname10,$message1);*/
	
	
	//$message1=str_replace('upload/',$siteurl.'rotary/l/upload/',$message1);
	/* <tr>
	<td><img src="../img/letterpadtop.jpg" width="100%"></td>
	</tr>
<tr>
	<td><br><br><img style="padding-top:10px;" src="../img/letterpadbottom.jpg" width="100%"></td>
	</tr>
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
					$count++;
			}
			}
		
			?>
 <?php
 }
?>