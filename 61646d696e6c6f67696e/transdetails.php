<?php
include('lcheck.php');
function getCoordinates($address) {
    // Google Maps API URL
    $api_url = 'https://maps.googleapis.com/maps/api/geocode/json';

    // API key (optional but recommended)
    $api_key = 'AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg'; // Replace with your actual Google Maps API key

    // Prepare request URL
    $url = $api_url . '?address=' . urlencode($address) . '&key=' . $api_key;

    // Make request to Google Maps API
    $response = file_get_contents($url);

    // Parse JSON response
    $data = json_decode($response, true);

    // Check if API returned results
    if ($data['status'] == 'OK') {
        $latitude = $data['results'][0]['geometry']['location']['lat'];
        $longitude = $data['results'][0]['geometry']['location']['lng'];

        return array(
            'latitude' => $latitude,
            'longitude' => $longitude
        );
    } else {
        return false; // No coordinates found or API error
    }
}

function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; // in kilometers

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;

    return $distance;
}

if(isset($_POST['sono'])) {
  
    $sono = mysqli_real_escape_string($connection,$_POST['sono']);
}
?>
			<?php
		    $sqlselect = "SELECT deliverymethod, edistance, etransportid, agentname, edocumentno, shipment, vechileno, vechiletype, lrno, deliveryremarks, invoicetype, buyeraddress1, buyeraddress2, buyeraddress3, buyertaluk, buyerdistrict, buyerpincode, dcno, dcdate, invoiceno, invoicedate1, irn From jrctally where sono='".$sono."' group by sono";
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
				$address = $rowselect['buyeraddress1'] . ' ' . $rowselect['buyeraddress2'] . ' ' . $rowselect['buyeraddress3'] . ' ' . $rowselect['buyertaluk'] . ' ' . $rowselect['buyerdistrict'] . ' ' . $rowselect['buyerpincode']; // Example address
				$result = getCoordinates($address);

				if ($result) {
					
			    // Example usage
				$latlong1 = $_SESSION['companylatlong']; // LatLong 1
				$latlong2 = $result['latitude'] . "," . $result['longitude']; // LatLong 2 from API result

				// Split the latitude and longitude values
				$latlon1 = explode(',', $latlong1);
				$latlon2 = explode(',', $latlong2);

				// Extract latitude and longitude values
				$lat1 = $latlon1[0];
				$lon1 = $latlon1[1];
				$lat2 = $latlon2[0];
				$lon2 = $latlon2[1];

				// Calculate the distance
				$distance = calculateDistance($lat1, $lon1, $lat2, $lon2);
				$rounded_distance = round($distance);
				//echo "Distance between LatLong 1 and LatLong 2 is: $rounded_distance kilometers";

				} else {
					//echo "No coordinates found or API error.";
				}
				
				if($rowselect['invoicetype']=='B2B')
				{
					if($rowselect['irn']!='')
					{
					?>
					 <form id="ewayForm" action="mewaybillIRN.php" method="POST">
					<?php
					}
					else
					{
						?>
					 <form id="ewayForm" action="mewaybillgstnon.php" method="POST">
					<?php
					}
				}
					else
					{
						?>
						 <form id="ewayForm" action="mewaybillnonirn.php" method="POST">
						<?php
					}
			?>
                    <input type="hidden" name="sono" id="ewaySono" value="<?=$sono?>">
                    <div class="form-group">
                        <label for="reason">Transport Mode:</label>
                        <select class="form-control" name="deliverymethod" id="deliverymethod"  onchange="showAdditionalFields()">
                            <option value="">Select a Mode</option>
							<option value="1" <?php if($rowselect['deliverymethod']=="1") { echo "selected";} ?>>Road</option>
							<option value="2" <?php if($rowselect['deliverymethod']=="2") { echo "selected";} ?>>Rail</option>
							<option value="3" <?php if($rowselect['deliverymethod']=="3") { echo "selected";} ?>>Air</option>
							<option value="4" <?php if($rowselect['deliverymethod']=="4") { echo "selected";} ?>>Ship</option>
							<option value="5" <?php if($rowselect['deliverymethod']=="5") { echo "selected";} ?>>Courier</option>
                          </select>
                    </div>
					<div class="form-group">
					<label for="edistance">Distance:</label>
					<input type="number" class="form-control" name="edistance" id="edistance" min="0" max="4000" value="<?=$rounded_distance?>" required>
					</div>
					<div class="form-group">
				<label for="agentname">Transport Name:</label>
				<input type="text" class="form-control" name="agentname" id="agentname" maxlength="100" value="<?=$rowselect['agentname']?>" >
			      </div>
					<div class="form-group">
					<label for="etransportid">Transport ID:</label>
					<input type="text" class="form-control" name="etransportid" id="etransportid" placeholder="Transporter GSTIN or CEN (Common Enrollment Number)" value="<?=$rowselect['etransportid']?>">
				</div>
			<div id="additionalFields" style="display: none;">
			<div class="form-group">
				<label for="edocumentno">Transport Document No:</label>
				<input type="text" class="form-control" name="edocumentno" id="edocumentno" maxlength="15" value="<?php if($rowselect['edocumentno']!=''){ echo str_replace(' ', '', $rowselect['edocumentno']); } else { if($rowselect['dcno']!=''){ echo str_replace(' ', '', $rowselect['dcno']); }else if($rowselect['invoiceno']!='') {echo str_replace(' ', '', $rowselect['invoiceno']); } }?>">
			</div>
			<div class="form-group">
			<label for="shipment">Transport Document Date:</label>
			<input type="date" class="form-control" name="shipment" id="shipment" value="<?php if($rowselect['shipment']!=''){ echo $rowselect['shipment']; } else { if($rowselect['dcdate']!=''){ echo $rowselect['dcdate']; }else if($rowselect['invoicedate1']!='') {echo $rowselect['invoicedate1']; } }?>">
		</div>
		<div class="form-group">
				<label for="vechileno">Vehicle No:</label>
				<input type="text" class="form-control" name="vechileno" id="vechileno" maxlength="10" value="<?=$rowselect['vechileno']?>">
			</div>
			<div class="form-group">
                        <label for="vechiletype">Vehicle Type:</label>
                        <select class="form-control" name="vechiletype" id="vechiletype" required>
                            <option value="">Select a Vehicle Type</option>
                            <option value="R" selected>REGULAR</option>
                            <option value="O">ODC</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
				<label for="lrno">BILL OF LADING/LR-RR NO:</label>
				<input type="text" class="form-control" name="lrno" id="lrno" value="<?=$rowselect['lrno']?>">
			</div>
                    <div class="form-group">
                        <label for="deliveryremarks">Delivery Remarks:</label>
                        <textarea class="form-control" name="deliveryremarks" id="deliveryremarks"><?=$rowselect['deliveryremarks']?></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Confirm Transport Details</button>
                </form>
          <?php
		  }
		    }
			?>

<script>
$( "#etransportid" ).autocomplete({
source: 'tallysearch.php?type=transportid&table=jrctransport',
});

$(document).ready(function(){
    $('#agentname').on('input', function() {
        var transport = $(this).val();
        if(transport === '') {
            $('#etransportid').val('');
        } else {
            $.ajax({
                url: 'transearch.php', 
                method: 'POST',
                data: { stateCode: transport },
                success: function(response) {
                    $('#etransportid').val(response); 
                }
            });
        }
    });
});
</script>
