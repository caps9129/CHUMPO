<form method="post" action="">
    <p>Car_ID
    <input type="text" name="Car_ID" id="Car_ID"/></p>
    <input type="submit" name="send" value="查詢"/>
    <input type="reset" name="send" value="重設"/>
</form><hr/>
<?php
  $Car_ID = '';
  if(isset($_POST["send"])){
    $Car_ID = $_POST["Car_ID"];
  }
  $db = mysqli_connect("140.134.26.143", "ican", "cani");
    mysqli_select_db($db, "i_can_db") or die(mysqli_error($db));
    mysqli_query($db, 'SET NAMES utf8');
  
  $lon = "SELECT `Longitude` FROM `car_show_information` WHERE `Car_ID` LIKE'$Car_ID'";
  $lat = "SELECT `Latitude` FROM `car_show_information` WHERE `Car_ID` LIKE '$Car_ID'";
  $Longitude = mysqli_query($db, $lon)or die("Error: ".mysqli_error($db));
  $Latitude = mysqli_query($db, $lat)or die("Error: ".mysqli_error($db));
  $Longitude = mysqli_fetch_row($Longitude);
  $Latitude = mysqli_fetch_row($Latitude);
  if($Car_ID != ''){
    $urlApi = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$Latitude[0].",".$Longitude[0]."&destinations=24.181076,120.631971|24.161451,120.618195|24.180547,120.653836&avoid=highways&key=AIzaSyAQhNukU-sEshEijjJClTz6o-53RFLvSsM";
    $result = file_get_contents($urlApi);
    $data = json_decode($result, true);
    for($i = 0 ; $i < 3 ; $i++){
      $destination_addresses[$i] = $data['destination_addresses'][$i];
      $millas[$i] =  $data['rows'][0]['elements'][$i]['distance']['text'];
      $millasKm[$i] = round(($millas[$i] * 1.60934),2);
      $duration[$i] = $data['rows'][0]['elements'][$i]['duration']['text'];
      $compare[$i] = $data['rows'][0]['elements'][$i]['duration']['value'];
    }
    /* bubble sort*/
    for($i = 0 ; $i < 2 ; $i++)
    {
      for($j = 0 ; $j < 2 - $i ; $j++)
      {
        if($compare[$j] > $compare[$j + 1])
        {
          $temp = $duration[$j + 1];
          $duration[$j + 1] = $duration[$j];
          $duration[$j] = $temp;
          $temp = $millasKm[$j + 1];
          $millasKm[$j + 1] = $millasKm[$j];
          $millasKm[$j] = $temp;
          $temp = $destination_addresses[$j + 1];
          $destination_addresses[$j + 1] = $destination_addresses[$j];
          $destination_addresses[$j] = $temp;
          $temp = $compare[$j + 1];
          $compare[$j + 1] = $compare[$j];
          $compare[$j] = $temp;
        } 
      }
    }
    /**/
    echo '<table class=';
    echo 'table>';
    echo '
        <thead>           
          <tr style="background:#A500CC; color:white; font-weight:bold">
            <th>                
              Charging Station
            </th>
            <th>
              Distance
            </th>
            <th>
              Spend
            </th>
          </tr> 
        </thead>
        <tbody>';
    
    
    for($i = 0 ; $i < 3 ; $i++){//
      //取得資料數 
      echo '<tr bgcolor =  #ffe6e6>';
      echo"<td>" . $destination_addresses[$i] . "</td>"; 
      echo"<td>" . $millasKm[$i] . "km" . "</td>"; 
      echo"<td>" . $duration[$i] . "</td>"; 
      echo"</tr>";
    }
    echo '</tbody></table>';
  }
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Custom Markers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: new google.maps.LatLng(<?php echo $Latitude[0]; ?>,<?php echo $Longitude[0]; ?>),
          /*var myLatlng = new google.maps.LatLng(<?php echo $Latitude[0]; ?>,<?php echo $Longitude[0]; ?>);*/
          /*center: new google.maps.LatLng(24.179568 , 120.644438),*/
          mapTypeId: 'roadmap'
        });

      
        var icons = {
          charge: {
            icon: 'images/car.png'
          },
          info: {
            /*icon: dot_center + 'red-dot.png'*/
            icon: 'images/motorbike.png'
          }
        };

        var features = [
          {
            position: new google.maps.LatLng(<?php echo $Latitude[0]; ?>,<?php echo $Longitude[0]; ?>),
            type: 'info'
          },
          {
            position: new google.maps.LatLng(24.180547, 120.653836),
            type: 'charge'
          }, 
          {
            position: new google.maps.LatLng(24.181076, 120.631971),
            type: 'charge'
          }, 
          {
            position: new google.maps.LatLng(24.161451, 120.618195),
            type: 'charge'
          },
        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });
      }
 
    
    
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQhNukU-sEshEijjJClTz6o-53RFLvSsM&callback=initMap">
    </script>
  </body>
</html>
