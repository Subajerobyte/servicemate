<?php
include('lcheck.php');
if(isset($_POST['sono'])) {
  


    // Retrieve the value from the POST data
    $sonovalue = mysqli_real_escape_string($connection,$_POST['sono']);
?>
<form action="serialnumberupdate1.php" method="post">

<table class="table" >

<thead><tr><th>S.no</th><th>Product Name</th><th>Qty.</th><th>Serialnumber</th></tr></thead>
<tbody>
<input type="hidden" name="sono" id="sono" value="<?=$sonovalue?>">
<input type="hidden" name="hiddenInput" id="hiddenInput" >

<?php

$sql = "SELECT * FROM jrctally WHERE sono = '".$sonovalue."'";
   $queryselect = mysqli_query($connection, $sql);
$rowCountselect = mysqli_num_rows($queryselect);

    // Process the query result as needed
  
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				?><tr>
				<th><?=$count?></th><th><?=$rowselect['conproduct']?></th>
				<th>
				
				<input type="hidden" name="count" id="count" value="<?=$count?>">
				<input type="hidden" name="id[]" id="id<?=$count?>" value="<?=$rowselect['id']?>">
				<input type="hidden" name="conqty[]" id="conqty<?=$count?>" value="<?=$rowselect['conqty']?>">
				<input type="hidden" name="conunitqty[]" id="conunitqty<?=$count?>" value="<?=$rowselect['conunitqty']?>">
				<?=$rowselect['conqty']?></th>
				<th><span href="#" data-toggle="modal" data-target="#serialchangemodal" onclick=" serialnumbers(<?=$count?>)" class="text-danger text-right" >Update Serial</span>
<input type="hidden" name="conserialno[]" id="conserialno<?=$count?>" value="<?=$rowselect['conserialno']?>">
<input type="hidden" name="condepartmentname[]" id="condepartmentname<?=$count?>" value="<?=$rowselect['condepartmentname']?>"></th></tr>
<?php
					$count++;
			}
		}
			?></tbody>
</table>
 
   <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        </div>
  
  </form>
  

<script>
    function openModal(sono) {
		//alert(sono);
        // Send an AJAX request to your PHP script
        $.ajax({
            type: 'POST',
            url: 'your_php_script.php',
            data: { sono: sono },
            success: function (response) {
                // Handle the response from the server
                $('#modalContent').html(response);

                // After the form submission, show the modal
                $('#serialmodal').modal('show');
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
</script>	
<?php
  
    
} else {
    // Handle the case when sono is not provided in the POST data
    echo "sono parameter not provided.";
}
?>
