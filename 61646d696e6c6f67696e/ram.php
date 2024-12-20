<?php
include('lcheck.php');
if(isset($_POST["noofconsignee"]))
{
$reftime = mysqli_real_escape_string($connection, $_POST["reftime"]);
$createdon=date('Y-m-d h:i:s a');
$createdby=$email;
$dname=date('Y-m-d-h-i-s-a');
$noofconsignee = mysqli_real_escape_string($connection, $_POST["noofconsignee"]);
$maxproduct = mysqli_real_escape_string($connection, $_POST["maxproduct"]);
$sqls=mysqli_query($connection,"select invoiceno from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['invoiceno']+1;
$invoicenoto=(float)$infos['invoiceno']+(float)$noofconsignee;
$invoicetype=mysqli_real_escape_string($connection,$_POST['invoicetype']);
$sotype=mysqli_real_escape_string($connection,$_POST['sotype']);
$orderreceived=mysqli_real_escape_string($connection,$_POST['orderreceived']);
$invoicedate=mysqli_real_escape_string($connection,$_POST['invoicedate']);
$maincategory=mysqli_real_escape_string($connection,$_POST['maincategory']);
$tender=mysqli_real_escape_string($connection,$_POST['tender']);
$subcategory=mysqli_real_escape_string($connection,$_POST['subcategory']);
$department=mysqli_real_escape_string($connection,$_POST['department']);
$otherreference=mysqli_real_escape_string($connection,$_POST['otherreference']);
$pono=mysqli_real_escape_string($connection,$_POST['pono']);
$podate=mysqli_real_escape_string($connection,$_POST['podate']);
if (!file_exists('../padhivetram/pofile/')) {
        mkdir('../padhivetram/pofile/', 0777, true);
    }
if(file_exists($_FILES["attachments"]['tmp_name'])) {
	
			$target_dir = "../padhivetram/pofile/";
				$target_file = $target_dir .time(). basename($_FILES["attachments"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				  if (move_uploaded_file($_FILES["attachments"]["tmp_name"], $target_file)) 
				  {
					$attachments=$target_file;
				  } else 
				  {
					$attachments="";
				  }
				  } else 
				  {
					$attachments="";
				  }
$custreference=mysqli_real_escape_string($connection,$_POST['custreference']);
$duedays=mysqli_real_escape_string($connection,$_POST['duedays']);
$buyerid=mysqli_real_escape_string($connection,$_POST['buyerid']);
$orgbuyername=explode(',', $_POST['buyername']);
$buyername=mysqli_real_escape_string($connection,$orgbuyername);
$buyeraddress1=mysqli_real_escape_string($connection,$_POST['buyeraddress1']);
$buyeraddress2=mysqli_real_escape_string($connection,$_POST['buyeraddress2']);
$buyeraddress3=mysqli_real_escape_string($connection,$_POST['buyeraddress3']);
$buyertaluk=mysqli_real_escape_string($connection,$_POST['buyertaluk']);
$buyerdistrict=mysqli_real_escape_string($connection,$_POST['buyerdistrict']);
$buyerpincode=mysqli_real_escape_string($connection,$_POST['buyerpincode']);
$buyerstate=mysqli_real_escape_string($connection,$_POST['buyerstate']);
$buyermobile=mysqli_real_escape_string($connection,$_POST['buyermobile']);
$buyerphone=mysqli_real_escape_string($connection,$_POST['buyerphone']);
$buyercontact=mysqli_real_escape_string($connection,$_POST['buyercontact']);
$buyermail=mysqli_real_escape_string($connection,$_POST['buyermail']);
$rtype=mysqli_real_escape_string($connection,$_POST['rtype']);
$bgst=mysqli_real_escape_string($connection,$_POST['bgst']);
$subtotalamount=mysqli_real_escape_string($connection,$_POST['subtotalamount']);
$totalgstamount=mysqli_real_escape_string($connection,$_POST['totalgstamount']);
$netamount=mysqli_real_escape_string($connection,$_POST['netamount']);
$discount=mysqli_real_escape_string($connection,$_POST['discount']);
$discountmode=mysqli_real_escape_string($connection,$_POST['discountmode']);
$discountamount=mysqli_real_escape_string($connection,$_POST['discountamount']);
$addamount=mysqli_real_escape_string($connection,$_POST['addamount']);
$lessamount=mysqli_real_escape_string($connection,$_POST['lessamount']);
$buyback=mysqli_real_escape_string($connection,$_POST['buyback']);
$buyremark=mysqli_real_escape_string($connection,$_POST['buyremark']);
$grandtotal=mysqli_real_escape_string($connection,$_POST['grandtotal']);
if($reftime!='')
{
$sql=mysqli_query($connection, "delete from jrctallydraft where reftime='$reftime'");
}
for($i=0;$i<count($_POST['consigneeno']);$i++)
{
$consigneeno=mysqli_real_escape_string($connection,$_POST['consigneeno'][$i]);
$sono='SO / REG / '.(date('my')).' /'.(str_pad((float)$infos['invoiceno']+($consigneeno), 4, '0', STR_PAD_LEFT));
$consigneeid=mysqli_real_escape_string($connection,$_POST['consigneeid'][$i]);
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename'][$i]);
$conmaincategory=mysqli_real_escape_string($connection,$_POST['conmaincategory'][$i]);
$consubcategory=mysqli_real_escape_string($connection,$_POST['consubcategory'][$i]);
$condepartment=mysqli_real_escape_string($connection,$_POST['condepartment'][$i]);
$conaddress1=mysqli_real_escape_string($connection,$_POST['conaddress1'][$i]);
$conaddress2=mysqli_real_escape_string($connection,$_POST['conaddress2'][$i]);
$conaddress3=mysqli_real_escape_string($connection,$_POST['conaddress3'][$i]);
$contaluk=mysqli_real_escape_string($connection,$_POST['contaluk'][$i]);
$condistrict=mysqli_real_escape_string($connection,$_POST['condistrict'][$i]);
$conpincode=mysqli_real_escape_string($connection,$_POST['conpincode'][$i]);
$concontact=mysqli_real_escape_string($connection,$_POST['concontact'][$i]);
$conphone=mysqli_real_escape_string($connection,$_POST['conphone'][$i]);
$conmobile=mysqli_real_escape_string($connection,$_POST['conmobile'][$i]);
$conemail=mysqli_real_escape_string($connection,$_POST['conemail'][$i]);
$constatecode=mysqli_real_escape_string($connection,$_POST['constatecode'][$i]);
$congstno=mysqli_real_escape_string($connection,$_POST['congstno'][$i]);
$conprogroup=mysqli_real_escape_string($connection,$_POST['conprogroup'][$i]);
$conmultiple=mysqli_real_escape_string($connection,$_POST['conmultiple'][$i]);
$promaincategory=mysqli_real_escape_string($connection,$_POST['promaincategory'][$i]);
$prosubcategory=mysqli_real_escape_string($connection,$_POST['prosubcategory'][$i]);
$conproductid=mysqli_real_escape_string($connection,$_POST['conproductid'][$i]);
$conproduct=mysqli_real_escape_string($connection,$_POST['conproduct'][$i]);
$componentname=mysqli_real_escape_string($connection,$_POST['componentname'][$i]);
$componenttype=mysqli_real_escape_string($connection,$_POST['componenttype'][$i]);
$conproductcode=mysqli_real_escape_string($connection,$_POST['conproductcode'][$i]);
$conmarketname=mysqli_real_escape_string($connection,$_POST['conmarketname'][$i]);
$conmake=mysqli_real_escape_string($connection,$_POST['conmake'][$i]);
$concapacity=mysqli_real_escape_string($connection,$_POST['concapacity'][$i]);
$conpromodel=mysqli_real_escape_string($connection,$_POST['conpromodel'][$i]);
$conhsncode=mysqli_real_escape_string($connection,$_POST['conhsncode'][$i]);
$conper=mysqli_real_escape_string($connection,$_POST['conper'][$i]);
$conserialno=mysqli_real_escape_string($connection,$_POST['conserialno'][$i]);
$condepartmentname=mysqli_real_escape_string($connection,$_POST['condepartmentname'][$i]);
$conqty=mysqli_real_escape_string($connection,$_POST['conqty'][$i]);
$conunit=mysqli_real_escape_string($connection,$_POST['conunit'][$i]);
$conigst=mysqli_real_escape_string($connection,$_POST['conigst'][$i]);
$consgst=mysqli_real_escape_string($connection,$_POST['consgst'][$i]);
$concgst=mysqli_real_escape_string($connection,$_POST['concgst'][$i]);
$conigstamount=mysqli_real_escape_string($connection,$_POST['conigstamount'][$i]);
$consgstamount=mysqli_real_escape_string($connection,$_POST['consgstamount'][$i]);
$concgstamount=mysqli_real_escape_string($connection,$_POST['concgstamount'][$i]);
$contotal=mysqli_real_escape_string($connection,$_POST['contotal'][$i]);
$conwarranty=mysqli_real_escape_string($connection,$_POST['conwarranty'][$i]);
//insert post
echo $sql = "INSERT INTO jrctallydraft(reftime,createdon,createdby, dname,noofconsignee, maxproduct, invoicenofrom, invoicenoto, invoicetype,sotype,orderreceived,invoicedate, maincategory, tender, subcategory, department,otherreference ,pono,podate ,pofile ,custreference, duedays, buyerid,buyername, buyeraddress1, buyeraddress2,buyeraddress3,buyertaluk,buyerdistrict,buyerpincode,buyerstate,buyermobile,buyerphone,buyercontact,buyermail,rtype,bgst,subtotalamount,totalgstamount,netamount,discount,discountmode,discountamount,addamount,lessamount,buyback,buyremark,grandtotal,consigneeno, consigneeid,consigneename,condepartment,conmaincategory, consubcategory, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, concontact, conphone, conmobile, conemail,constatecode,congstno, conprogroup, conmultiple, promaincategory,prosubcategory,conproductid,conproduct,componentname,componenttype, conproductcode, conmarketname,conmake,concapacity,conpromodel,conper,conhsncode,conserialno,condepartmentname, conqty, conunit, conigst, consgst, concgst, conigstamount, consgstamount, concgstamount, contotal, conwarranty) VALUES ('".$reftime."','".$createdon."','".$createdby."', '".$dname."','".$noofconsignee."', '".$maxproduct."', '".$invoicenofrom."','".$invoicenoto."','".$invoicetype."','".$sotype."','".$orderreceived."','".$invoicedate."','".$maincategory."','".$tender."','".$subcategory."','".$department."','".$otherreference."','".$pono."','".$podate."','".$attachments."','".$custreference."','".$duedays."','".$buyerid."','".$buyername."','".$buyeraddress1."','".$buyeraddress2."','".$buyeraddress3."','".$buyertaluk."','".$buyerdistrict."','".$buyerpincode."','".$buyerstate."','".$buyermobile."','".$buyerphone."','".$buyercontact."','".$buyermail."','".$rtype."','".$bgst."','".$subtotalamount."','".$totalgstamount."','".$netamount."','".$discount."','".$discountmode."','".$discountamount."','".$addamount."','".$lessamount."','".$buyback."','".$buyremark."','".$grandtotal."','".$consigneeno."','".$consigneeid."','".$consigneename."','".$condepartment."','".$conmaincategory."','".$consubcategory."','".$conaddress1."','".$conaddress2."','".$conaddress3."','".$contaluk."','".$condistrict."','".$conpincode."','".$concontact."','".$conphone."','".$conmobile."','".$conemail."','".$constatecode."','".$congstno."','".$conprogroup."','".$conmultiple."','".$promaincategory."','".$prosubcategory."','".$conproductid."','".$conproduct."','".$componentname."','".$componenttype."','".$conproductcode."','".$conmarketname."','".$conmake."','".$concapacity."','".$concapacity."','".$conper."','".$conhsncode."','".$conserialno."','".$condepartmentname."','".$conqty."','".$conunit."','".$conigst."','".$consgst."','".$concgst."','".$conpromodel."','".$consgstamount."','".$concgstamount."','".$contotal."','".$conwarranty."')";
mysqli_query($connection, $sql);
echo mysqli_insert_id($connection);
}
}
?>