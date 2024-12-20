<?php
include('lcheck.php');
if(isset($_POST["noofconsignee"]))
{
$reftime = mysqli_real_escape_string($connection, $_POST["reftime"]);
$createdon=date('Y-m-d h:i:s a');
$dname=date('Y-m-d-h-i-s-a');
$noofconsignee = mysqli_real_escape_string($connection, $_POST["noofconsignee"]);
$sqls=mysqli_query($connection,"select invoiceno from jrcinvoice");
$infos=mysqli_fetch_array($sqls);
$invoicenofrom=(float)$infos['invoiceno']+1;
$invoicenoto=(float)$infos['invoiceno']+(float)$noofconsignee;
$invoicedate=mysqli_real_escape_string($connection,$_POST['invoicedate']);
$maincategory=mysqli_real_escape_string($connection,$_POST['maincategory']);
$tender=mysqli_real_escape_string($connection,$_POST['tender']);
$subcategory=mysqli_real_escape_string($connection,$_POST['subcategory']);
$department=mysqli_real_escape_string($connection,$_POST['department']);
$otherreference=mysqli_real_escape_string($connection,$_POST['otherreference']);
$pono=mysqli_real_escape_string($connection,$_POST['pono']);
$podate=mysqli_real_escape_string($connection,$_POST['podate']);
$custreference=mysqli_real_escape_string($connection,$_POST['custreference']);
$duedays=mysqli_real_escape_string($connection,$_POST['duedays']);
$buyername=mysqli_real_escape_string($connection,$_POST['buyername']);
$buyeraddress1=mysqli_real_escape_string($connection,$_POST['buyeraddress1']);
$buyeraddress2=mysqli_real_escape_string($connection,$_POST['buyeraddress2']);
$buyeraddress3=mysqli_real_escape_string($connection,$_POST['buyeraddress3']);
$buyerstate=mysqli_real_escape_string($connection,$_POST['buyerstate']);
$rtype=mysqli_real_escape_string($connection,$_POST['rtype']);
$bgst=mysqli_real_escape_string($connection,$_POST['bgst']);
if($reftime!='')
{
$sql=mysqli_query($connection, "delete from jrctallydrafts where reftime='$reftime'");
}
for($i=0;$i<count($_POST['consigneeno']);$i++)
{
$consigneeno=mysqli_real_escape_string($connection,$_POST['consigneeno'][$i]);
$sono='SO / SER / '.(date('my')).' /'.(str_pad((float)$infos['invoiceno']+($consigneeno), 4, '0', STR_PAD_LEFT));
$consigneename=mysqli_real_escape_string($connection,$_POST['consigneename'][$i]);
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
$conprogroup=mysqli_real_escape_string($connection,$_POST['conprogroup'][$i]);
$conmultiple=mysqli_real_escape_string($connection,$_POST['conmultiple'][$i]);
$conproduct=mysqli_real_escape_string($connection,$_POST['conproduct'][$i]);
$conproductcode=mysqli_real_escape_string($connection,$_POST['conproductcode'][$i]);
$conmarketname=mysqli_real_escape_string($connection,$_POST['conmarketname'][$i]);
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
$sql = "INSERT INTO jrctallydrafts(reftime,createdon, dname,noofconsignee, invoicenofrom, invoicenoto, invoicedate, maincategory, tender, subcategory, department,otherreference ,pono,podate ,custreference, duedays, buyername, buyeraddress1, buyeraddress2 ,buyeraddress3,buyerstate,rtype ,bgst,consigneeno, consigneename, conaddress1, conaddress2, conaddress3, contaluk, condistrict, conpincode, concontact, conphone, conmobile, conemail, conprogroup, conmultiple, conproduct, conproductcode, conmarketname, conqty, conunit, conigst, consgst, concgst, conigstamount, consgstamount, concgstamount, contotal, conwarranty) VALUES ('".$reftime."','".$createdon."', '".$dname."','".$noofconsignee."', '".$invoicenofrom."','".$invoicenoto."','".$invoicedate."','".$maincategory."','".$tender."','".$subcategory."','".$department."','".$otherreference."','".$pono."','".$podate."','".$custreference."','".$duedays."','".$buyername."','".$buyeraddress1."','".$buyeraddress2."','".$buyeraddress3."','".$buyerstate."','".$rtype."','".$bgst."','".$consigneeno."','".$consigneename."','".$conaddress1."','".$conaddress2."','".$conaddress3."','".$contaluk."','".$condistrict."','".$conpincode."','".$concontact."','".$conphone."','".$conmobile."','".$conemail."','".$conprogroup."','".$conmultiple."','".$conproduct."','".$conproductcode."','".$conmarketname."','".$conqty."','".$conunit."','".$conigst."','".$consgst."','".$concgst."','".$conigstamount."','".$consgstamount."','".$concgstamount."','".$contotal."','".$conwarranty."')";
mysqli_query($connection, $sql);
echo mysqli_insert_id($connection);
}
}
?>