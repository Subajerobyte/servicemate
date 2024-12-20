<?php
include('lcheck.php');
if(isset($_POST['sono'])) {
  
    $sono = mysqli_real_escape_string($connection,$_POST['sono']);
}
?>
			<?php
		    $sqlselect = "SELECT dispatchdocno, disthrough, sotype From jrctally where sono='".$sono."' group by sono";
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
			        <form id="invForm" action="salesorderinvadds.php" method="POST">
                    <input type="hidden" name="id" id="ewaySono" value="<?=$sono?>">
                    <input type="hidden" name="sotype" id="sotype" value="<?=$sotype?>">
                    <input type="hidden" name="invoice" id="invoice" value="generate">
                  <div class="form-group">
				<label for="dispatchdocno">Dispatch Document No:</label>
				<input type="text" class="form-control" name="dispatchdocno" id="dispatchdocno"  value="<?=$rowselect['dispatchdocno']?>">
			</div>
			
				<div class="form-group">
				<label for="disthrough">Dispatched through</label>
				<input type="text" class="form-control" name="disthrough" id="disthrough" maxlength="100" value="<?=$rowselect['disthrough']?>">
			</div>
                    <button type="submit" class="btn btn-danger">Confirm Dispatch Details</button>
                </form>
          <?php
		  }
		    }
			?>
      