<?php
include('lcheck.php');
if(isset($_POST['sono'])) {
  
    $sono = mysqli_real_escape_string($connection,$_POST['sono']);
}
?>
			<?php
			 $sqlselect = "SELECT installrefno, suprefno, claimper, pono From jrcxl where sono='".$sono."' group by sono";
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
				<form action="coverings.php" method="POST">
			    <input type="hidden" name="salesorderno" value="<?=$sono?>">
			    <input type="hidden" name="pono" value="<?=$rowselect['pono']?>">
                   <div class="form-group">
					<label for="installrefno">Installation Ref.No</label>
					<input type="text" class="form-control" id="installrefno" name="installrefno" value="<?=$rowselect['installrefno']?>">
				  </div>
					 <div class="form-group">
					<label for="suprefno">Supplier Invoice / Ref.No</label>
					<input type="text" class="form-control" id="suprefno" name="suprefno" value="<?=$rowselect['suprefno']?>">
				  </div>
					<div class="form-group">
					<label for="claimper">Claim %</label>
					<input type="number" class="form-control" id="claimper" name="claimper" value="<?=$rowselect['claimper']?>" max="100" min="0">
				  </div>
			
                    <button type="submit" class="btn btn-danger">Confirm Details</button>
                </form>
          <?php
		  }
		    }
			?>
      