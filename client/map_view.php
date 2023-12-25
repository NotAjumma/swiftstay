<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 90%;
        align:center;
        width:90%;
        margin-left: auto;
        margin-right: auto;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
<?php 
$hotel_name = $_GET['hotel_name'];
?>
<input type="hidden" id="hotel_name" value="<?php echo $hotel_name ?>" />
  </body>
</html>
<script type="text/javascript">

  var hotel_name = document.getElementById("hotel_name").value;
  console.log(hotel_name);
      var map;
      function getData() {
        $.ajax({
        url: "../api/map_geocode_api.php",
        method: "POST",
         data: { hotel_name: hotel_name },
        async: true,
        dataType: 'json',
        success: function (data) {
          console.log(data);
          //load map
          init_map(data);
        }
      });  
      }
      
      function init_map(data) {
            var map_options = {
                zoom: 10,
                center: new google.maps.LatLng(data['latitude'], data['longitude'])
              }
            map = new google.maps.Map(document.getElementById("map"), map_options);
           marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(data['latitude'], data['longitude'])
            });
            infowindow = new google.maps.InfoWindow({
                content: data['formatted_address']
            });
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);
        }
      
      </script>

     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB28bbR0I2DsOa4gUeD8kT2azQe-xUJvrA&callback=getData" >
    </script>
