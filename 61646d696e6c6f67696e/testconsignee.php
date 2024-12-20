<?php
include ('lcheck.php');
if($addinvoice=='0')
{
	header("Location: dashboard.php");
}
if((isset($_GET['start']))&&(isset($_GET['limit'])))
{
$start = mysqli_real_escape_string($connection, $_GET['start']);
        $limit = mysqli_real_escape_string($connection, $_GET['limit']);
        $fileName = "From Invoice Edit";
        $upload_time = date("Y-m-d H:i:s");
        $uploadby = $_SESSION['email'];
                    
                  $sqlup = "select * from jrcxl order by id asc limit $start, $limit";
                    $queryup = mysqli_query($connection, $sqlup);
                    
                    while($infoup=mysqli_fetch_array($queryup))
					{
						$id = mysqli_real_escape_string($connection, $infoup['id']);
        $mainid = $id;
        $invoiceno = mysqli_real_escape_string($connection, $infoup['invoiceno']);
        $invoicedate = mysqli_real_escape_string($connection, $infoup['invoicedate']);
        $tenderno = mysqli_real_escape_string($connection, $infoup['tenderno']);
        $pono = mysqli_real_escape_string($connection, $infoup['pono']);
        $podate = mysqli_real_escape_string($connection, $infoup['podate']);
        $dcno = mysqli_real_escape_string($connection, $infoup['dcno']);
        $dcdate = mysqli_real_escape_string($connection, $infoup['dcdate']);
        $installedon = mysqli_real_escape_string($connection, $infoup['installedon']);
        $installedby = mysqli_real_escape_string($connection, $infoup['installedby']);
        $consigneeid = mysqli_real_escape_string($connection, $infoup['consigneeid']);
        $maincategory = mysqli_real_escape_string($connection, $infoup['maincategory']);
        $subcategory = mysqli_real_escape_string($connection, $infoup['subcategory']);
        $consigneename = mysqli_real_escape_string($connection, $infoup['consigneename']);
        $department = mysqli_real_escape_string($connection, $infoup['department']);
        $address1 = mysqli_real_escape_string($connection, $infoup['address1']);
        $address2 = mysqli_real_escape_string($connection, $infoup['address2']);
        $area = mysqli_real_escape_string($connection, $infoup['area']);
        $district = mysqli_real_escape_string($connection, $infoup['district']);
        $pincode = mysqli_real_escape_string($connection, $infoup['pincode']);
        $contact = mysqli_real_escape_string($connection, $infoup['contact']);
        $phone = mysqli_real_escape_string($connection, $infoup['phone']);
        $mobile = mysqli_real_escape_string($connection, $infoup['mobile']);
        $email = mysqli_real_escape_string($connection, $infoup['email']);
		
		
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

        $invoicedqty = mysqli_real_escape_string($connection, $infoup['invoicedqty']);
        $overallwarranty = mysqli_real_escape_string($connection, $infoup['overallwarranty']);
           $productid = mysqli_real_escape_string($connection, $infoup['productid']);
                $stockmaincategory = mysqli_real_escape_string($connection, $infoup['stockmaincategory']);
                $stocksubcategory = mysqli_real_escape_string($connection, $infoup['stocksubcategory']);
                $stockitem = mysqli_real_escape_string($connection, $infoup['stockitem']);
                $typeofproduct = mysqli_real_escape_string($connection, $infoup['typeofproduct']);
                $componenttype = mysqli_real_escape_string($connection, $infoup['componenttype']);
                $componentname = mysqli_real_escape_string($connection, $infoup['componentname']);
                $make = mysqli_real_escape_string($connection, $infoup['make']);
                $capacity = mysqli_real_escape_string($connection, $infoup['capacity']);
                $warranty = mysqli_real_escape_string($connection, $infoup['warranty']);
                $qty = mysqli_real_escape_string($connection, $infoup['qty']);
                $serialnumber = mysqli_real_escape_string($connection, $infoup['serialnumber']);
                        $sourceid = $id;
                         
                        echo $sqlcon = "SELECT id From jrcconsignee WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}'";
                        $querycon = mysqli_query($connection, $sqlcon);
                        $rowCountcon = mysqli_num_rows($querycon);
                        
                        if (!$querycon) {
                            die("SQL query failed: " . mysqli_error($connection));
                        }
                         
                        if ($rowCountcon == 0) {
                             
                           echo  $sqlupconsignee = "INSERT INTO jrcconsignee(encstatus, maincategory, subcategory, consigneename, department, address1, address2, area, district, pincode, contact, phone, mobile, email) VALUES ( '$encstatus', '$maincategory', '$subcategory', '$consigneename', '$department', '$address1', '$address2', '$area', '$district', '$pincode', '$contact', '$phone', '$mobile', '$email')";
                            $queryupconsignee = mysqli_query($connection, $sqlupconsignee);
                            
                            if (!$queryupconsignee) {
                                die("SQL query failed: " . mysqli_error($connection));
                            } else {
                                $consigneeid = mysqli_insert_id($connection);
                               echo  $sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
                                $queryup1 = mysqli_query($connection, $sqlup1);
                                
                                if (!$queryup1) {
                                    die("SQL query failed: " . mysqli_error($connection));
                                }
                            }
                        } else {
                            $rowco = mysqli_fetch_array($querycon);
                            $consigneeid = $rowco['id'];
                           echo  $sqlup1 = "update jrcxl set consigneeid='{$consigneeid}' WHERE maincategory = '{$maincategory}' and subcategory = '{$subcategory}' and consigneename = '{$consigneename}' and department = '{$department}' and district = '{$district}' and pincode = '{$pincode}'  and mobile = '{$mobile}'  and phone = '{$phone}' ";
                            $queryup1 = mysqli_query($connection, $sqlup1);
                            
                            if (!$queryup1) {
                                die("SQL query failed: " . mysqli_error($connection));
                            }
                        }
                        /////////////////////
                         
                       echo  $sqlconpro = "SELECT id From jrcproduct WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
                        $queryconpro = mysqli_query($connection, $sqlconpro);
                        $rowCountconpro = mysqli_num_rows($queryconpro);
                        
                        if (!$queryconpro) {
                            die("SQL query failed: " . mysqli_error($connection));
                        }
                         
                        if ($rowCountconpro == 0) {
                             
                          echo   $sqluppro = "INSERT INTO jrcproduct( stockmaincategory, stocksubcategory, stockitem, componenttype, componentname, typeofproduct, make, capacity) VALUES ('$stockmaincategory', '$stocksubcategory', '$stockitem', '$componenttype', '$componentname', '$typeofproduct', '$make', '$capacity')";
                            $queryuppro = mysqli_query($connection, $sqluppro);
                            
                            if (!$queryuppro) {
                                die("SQL query failed: " . mysqli_error($connection));
                            } else {
                                $productid = mysqli_insert_id($connection);
                               echo  $sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
                                $queryup1pro = mysqli_query($connection, $sqlup1pro);
                                
                                if (!$queryup1pro) {
                                    die("SQL query failed: " . mysqli_error($connection));
                                }
                            }
                        } else {
                            $rowcopro = mysqli_fetch_array($queryconpro);
                            $productid = $rowcopro['id'];
                          echo   $sqlup1pro = "update jrcxl set productid='{$productid}'  WHERE stockmaincategory = '{$stockmaincategory}' and stocksubcategory = '{$stocksubcategory}' and stockitem = '{$stockitem}' and componenttype = '{$componenttype}' and componentname = '{$componentname}' and typeofproduct = '{$typeofproduct}' and make = '{$make}' and capacity = '{$capacity}' ";
                            $queryup1pro = mysqli_query($connection, $sqlup1pro);
                            
                            if (!$queryup1pro) {
                                die("SQL query failed: " . mysqli_error($connection));
                            }
                        }
						echo $id."<br><br>";
                    } 
}
?>