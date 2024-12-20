<!DOCTYPE html>
<html>
<head>
    <title>Google Map</title>
</head>
<style type="text/css">
    #map{
        height: 80%;
    }
    html , body {
        height: 100%;
    }
</style>
<body onload="myfunction();">
<div id="map">
</div>
<script type="text/javascript">
    function myfunction(){
        var map;
        var start = new google.maps.LatLng(7.434876909631617,80.4424951234613);
        var end = new google.maps.LatLng(7.3178281209262686,80.8735878891028);
        var option ={
            zoom : 10,
            center : start 
        };
        map = new google.maps.Map(document.getElementById('map'),option);
        var display = new google.maps.DirectionsRenderer();
        var services = new google.maps.DirectionsService();
        display.setMap(map);
            var request ={
                origin : start,
                destination:end,
                travelMode: 'DRIVING'
            };
            services.route(request,function(result,status){
                if(status =='OK'){
                    display.setDirections(result);
                }
            });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADrEUFitIjcVlPbcDdbuW7Ul7a15n0TUg&libraries=places"></script>

</body>
</html>