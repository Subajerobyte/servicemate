<?php
include('lcheck.php');



if(isset($_POST['sono'])) {	
// Retrieve the value from the POST data
$sonovalue = mysqli_real_escape_string($connection,$_POST['sono']);
$sql = "SELECT installedon,sono,warranty,stockmaincategory,stocksubcategory,stockitem,componenttype,componentname,typeofproduct,make,capacity,productid,id,count(id) as idcount FROM jrcxl WHERE sono = '".$sonovalue."' group by sono";
   $queryselect = mysqli_query($connection, $sql);
$rowCountselect = mysqli_num_rows($queryselect);
$i=1;
while($rowselect = mysqli_fetch_array($queryselect))
{
?>
<form action="serialnumberupdate1.php" method="post">
<input type="hidden" name="sono" id="sono" value="<?=$sonovalue?>">
<input type="hidden" name="idcount" id="idcount" value="<?=$rowselect['idcount']?>">
<input type="hidden" name="id[]" id="id<?=$i?>" value="<?=$rowselect['id']?>">
<input type="hidden" name="warranty[]" id="warranty<?=$i?>" value="<?=$rowselect['warranty']?>">
<input type="hidden" name="stockmaincategory[]" id="stockmaincategory<?=$i?>" value="<?=$rowselect['stockmaincategory']?>">
<input type="hidden" name="stocksubcategory[]" id="stocksubcategory<?=$i?>" value="<?=$rowselect['stocksubcategory']?>">
<input type="hidden" name="stockitem[]" id="stockitem<?=$i?>" value="<?=$rowselect['stockitem']?>">
<input type="hidden" name="componenttype[]" id="componenttype<?=$i?>" value="<?=$rowselect['componenttype']?>">
<input type="hidden" name="componentname[]" id="componentname<?=$i?>" value="<?=$rowselect['componentname']?>">
<input type="hidden" name="typeofproduct[]" id="typeofproduct<?=$i?>" value="<?=$rowselect['typeofproduct']?>">
<input type="hidden" name="make[]" id="make<?=$i?>" value="<?=$rowselect['make']?>">
<input type="hidden" name="capacity[]" id="capacity<?=$i?>" value="<?=$rowselect['capacity']?>">
<input type="hidden" name="productid[]" id="productid<?=$i?>" value="<?=$rowselect['productid']?>">
		<div class="row">
		<div class="col-12">
		 <div class="form-group">
    <label for="installedon">Installation Date</label><span class="text-danger">*</span>
    <input type="date" class="form-control form-control-sm" id="installedon" name="installedon"   value="<?=$rowselect['installedon']?>" required>	
  </div>
		</div>
		</div>
		<div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input class="btn btn-primary" type="submit" name="submitic" value="Submit">
        </div>
		</form>
<?php
$i++;
}
    
} 
?>
