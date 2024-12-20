<?php 
include('lcheck.php');
function string_sanitize($s) {
    $result = preg_replace("/[^a-zA-Z0-9]\s+/", " ", html_entity_decode($s, ENT_QUOTES));
	$result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result);
    return $result;
}
function clean($string) {
   $result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
   return $result;
}
  if(!empty($_FILES)){  
      $uploadDir = "../padhivetram/";
      $fileName = time().'-'.$_FILES['file']['name'];
	 // $fileName="test.csv";
      $uploadedFile = $uploadDir.$fileName;    
	  $upload_time=date("Y-m-d H:i:s");
	  $uploadby=$_SESSION['email'];
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadedFile)) 
	  { 
		
$data=array();
$arrnoofconsignee=array();
$arrinvoicenofrom=array();
$arrinvoicenoto=array();
$arrinvoicedate=array();
$arrsono=array();
$arrmaincategory=array();
$arrtender=array();
$arrsubcategory=array();
$arrdepartment=array();
$arrotherreference=array();
$arrpono=array();
$arrpodate=array();
$arrcustreference=array();
$arrduedays=array();
$arrbuyername=array();
$arrbuyeraddress1=array();
$arrbuyeraddress2=array();
$arrbuyeraddress3=array();
$arrbuyerstate=array();
$arrrtype=array();
$arrbgst=array();
$arrconsigneeno=array();
$arrconsigneename=array();
$arrconaddress1=array();
$arrconaddress2=array();
$arrconaddress3=array();
$arrcontaluk=array();
$arrcondistrict=array();
$arrconpincode=array();
$arrconcontact=array();
$arrconphone=array();
$arrconmobile=array();
$arrconemail=array();
$arrconprogroup=array();
$arrconmultiple=array();
$arrconproduct=array();
$arrconqty=array();
$arrconunit=array();
$arrconigst=array();
$arrconsgst=array();
$arrconcgst=array();
$arrconigstamount=array();
$arrconsgstamount=array();
$arrconcgstamount=array();
$arrcontotal=array();
$arrconwarranty=array();

	$noofconsignee="";
	$invoicenofrom="";
	$invoicenoto="";
	$invoicedate="";
	$sono="";
	$maincategory="";
	$tender="";
	$subcategory="";
	$department="";
	$otherreference="";
	$pono="";
	$podate="";
	$custreference="";
	$duedays="";
	$buyername="";
	$buyeraddress1="";
	$buyeraddress2="";
	$buyeraddress3="";
	$buyerstate="";
	$rtype="";
	$bgst="";
	$consigneeno="";
	$consigneename="";
	$conaddress1="";
	$conaddress2="";
	$conaddress3="";
	$contaluk="";
	$condistrict="";
	$conpincode="";
	$concontact="";
	$conphone="";
	$conmobile="";
	$conemail="";
	$conprogroup="";
	$conmultiple="";
	$conproduct="";
	$conqty="";
	$conunit="";
	$conigst="";
	$consgst="";
	$concgst="";
	$conigstamount="";
	$consgstamount="";
	$concgstamount="";
	$contotal="";
	$conwarranty="";
	
 $handle = fopen($uploadedFile, "r");
 //print_r(fgetcsv($handle));
          $c = 0;
          while(($filesop = fgetcsv($handle, 5000, ",")) !== false)
                    {
						for($s=0;$s<46;$s++)
						{
						$data[$c][$s]=$filesop[$s];
						}
						$c++;
						
					}
$totaldatas=count($data)-1;
$mysqlInsert = "INSERT INTO jrcimporttally (uploadby, file_name, upload_time, uploaded)VALUES('".$uploadby."','".$fileName."','".$upload_time."','".$totaldatas."')";
mysqli_query($connection, $mysqlInsert);

for ($i = 0; $i < count($data); $i++) {
	$te=0;
	for ($j = 0; $j < 46; $j++) {
		$data[$i][$j]=str_replace("  "," ",$data[$i][$j]);
		$data[$i][$j]=str_replace(" ,",",",$data[$i][$j]);
		$data[$i][$j]=str_replace(",,",",",$data[$i][$j]);
		$data[$i][$j]=clean($data[$i][$j]);
		if($j==0)
		{
			$arrnoofconsignee[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$noofconsignee=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==1)
		{
			$arrinvoicenofrom[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$invoicenofrom=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==2)
		{
			$arrinvoicenoto[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$invoicenoto=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==3)
		{
			if(trim($data[$i][$j])!=="")
			{
			$indate=date('Y-m-d',strtotime(strtr(mysqli_real_escape_string($connection,trim($data[$i][$j])), '/', '-')));
			}
			else
			{
			$indate="";	
			}
			$arrinvoicedate[]=$indate;
			$invoicedate=$indate;
			
		}
		if($j==4)
		{
			$arrsono[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$sono=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==5)
		{
			$arrmaincategory[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$maincategory=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==6)
		{
			$arrtender[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$tender=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==7)
		{
			$arrsubcategory[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$subcategory=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==8)
		{
			$arrdepartment[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$department=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==9)
		{
			$arrotherreference[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$otherreference=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==10)
		{
			$arrpono[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$pono=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==11)
		{
			if(trim($data[$i][$j])!=="")
			{
			$pdate=date('Y-m-d',strtotime(strtr(mysqli_real_escape_string($connection,trim($data[$i][$j])), '/', '-')));
			}
			else
			{
			$pdate="";	
			}
			$arrpodate[]=$pdate;
			$podate=$pdate;
		}
		
		if($j==12)
		{
			$arrcustreference[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$custreference=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==13)
		{
			$arrduedays[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$duedays=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==14)
		{
			$arrbuyername[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$buyername=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==15)
		{
			$arrbuyeraddress1[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$buyeraddress1=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==16)
		{
			$arrbuyeraddress2[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$buyeraddress2=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==17)
		{
			$arrbuyeraddress2[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$buyeraddress2=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==18)
		{
			$arrbuyerstate[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$buyerstate=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==19)
		{
			$arrrtype[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$rtype=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==20)
		{
			$arrbgst[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$bgst=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		/////
		if($j==21)
		{
			$arrconsigneeno[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$consigneeno=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==22)
		{
			$arrconsigneename[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$consigneename=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==23)
		{
			$arrconaddress1[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conaddress1=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==24)
		{
			$arrconaddress2[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conaddress2=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==25)
		{
			$arrconaddress3[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conaddress3=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==26)
		{
			$arrcontaluk[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$contaluk=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==27)
		{
			$arrcondistricte[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$condistrict=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==28)
		{
			$arrconpincode[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conpincode=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==29)
		{
			$arrconcontacte[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$concontact=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==30)
		{
			$phono = preg_replace("/[^0-9]/", "", mysqli_real_escape_string($connection,trim($data[$i][$j])) );
			$arrconphone[]=$phono;
			$conphone=$phono;
		}
		if($j==31)
		{
			$arrconmobile[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conmobile=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		/////
		if($j==32)
		{
			$arrconemail[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conemail=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		//////
		if($j==33)
		{
			$arrconprogroup[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conprogroup=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==34)
		{
			$arrconmultiple[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conmultiple=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==35)
		{
			$arrconproduct[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conproduct=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==36)
		{
			$arrconqty[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conqty=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		/////
		if($j==37)
		{
			$arrconunit[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conunit=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==38)
		{
			$arrconigst[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conigst=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		/////		
		if($j==39)
		{
			$arrconsgst[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$consgst=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==40)
		{
			$arrconcgst[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$concgst=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==41)
		{
			$arrconigstamount[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conigstamount=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==42)
		{
			$arrconsgstamount[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$consgstamount=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==43)
		{
			$arrconcgstamount[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$concgstamount=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==44)
		{
			$arrcontotal[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$contotal=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		if($j==45)
		{
			$arrconwarranty[]=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
			$conwarranty=mysqli_real_escape_string($connection,trim($data[$i][$j]));;
		}
		
	}

	if($i>0)
	{
		echo $sono."-";
		if($te==0)
		{

        $sqlselect = "SELECT id From jrctally WHERE tdelete='0' and invoicenofrom = '{$invoicenofrom}' and invoicenoto = '{$invoicenoto}' and sono = '{$sono}' and conproduct = '{$conproduct}' and conqty = '{$conqty}'";

        $queryselect = mysqli_query($connection, $sqlselect);
        
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
		else
		{
			$rowCountselect = mysqli_num_rows($queryselect);	
			 
			if($rowCountselect == 0) 
			{	
				 
				echo $sqlup = "INSERT INTO jrctally(file_name,noofconsignee,invoicenofrom,invoicenoto,invoicedate,sono,maincategory,tender,subcategory,department,otherreference,pono,podate,custreference,duedays,buyername,buyeraddress1,buyeraddress2,buyeraddress3,buyerstate,rtype,bgst,consigneeno,consigneename,conaddress1,conaddress2,conaddress3,contaluk,condistrict,conpincode,concontact,conphone,conmobile,conemail,conprogroup,conmultiple,conproduct,conqty,conunit,conigst,consgst,concgst,conigstamount,consgstamount,concgstamount,contotal,conwarranty)VALUES('".$fileName."','".$noofconsignee."','".$invoicenofrom."','".$invoicenoto."','".$invoicedate."','".$sono."','".$maincategory."','".$tender."','".$subcategory."','".$department."','".$otherreference."','".$pono."','".$podate."','".$custreference."','".$duedays."','".$buyername."','".$buyeraddress1."','".$buyeraddress2."','".$buyeraddress3."','".$buyerstate."','".$rtype."','".$bgst."','".$consigneeno."','".$consigneename."','".$conaddress1."','".$conaddress2."','".$conaddress3."','".$contaluk."','".$condistrict."','".$conpincode."','".$concontact."','".$conphone."','".$conmobile."','".$conemail."','".$conprogroup."','".$conmultiple."','".$conproduct."','".$conqty."','".$conunit."','".$conigst."','".$consgst."','".$concgst."','".$conigstamount."','".$consgstamount."','".$concgstamount."','".$contotal."','".$conwarranty."')";
				 $queryp = mysqli_query($connection, $sqlup);
				}
			}
			echo $sono.'-<br>';
			
		
		 }
	
	else
	{
		
	}

	}
}

	mysqli_query($connection, "INSERT INTO jrchistory (user, ipaddress, times, remarks, tid, tablename) VALUES ('{$useremail}', '{$ip}', '{$times}', 'Uploaded a CSV', '{$uploadedFile}', 'jrcimporttally')");
	header("Location:importtallyhistory.php"); 
     }   
 }
?>
