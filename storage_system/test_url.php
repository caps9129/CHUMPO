<?php 
$start= !empty($_GET['start']) ? urlencode($_GET['start']) : null;
$end = !empty($_GET['end']) ? urlencode($_GET['end']) : null;
$urlApi = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=24.180547,120.653836&destinations=24.181076,120.631971|24.161451,120.618195&avoid=highways&key=AIzaSyAQhNukU-sEshEijjJClTz6o-53RFLvSsM";
$result = file_get_contents($urlApi);
$data = json_decode($result, true);
for($i = 0 ; $i < 2 ; $i++){
	$destination_addresses[$i] = $data['destination_addresses'][$i];
	$millas[$i] =  $data['rows'][0]['elements'][$i]['distance']['text'];
	$millasKm[$i] = round(($millas[$i] * 1.60934),2);
	$duration[$i] = $data['rows'][0]['elements'][$i]['duration']['text'];
	echo $destination_addresses[$i];
	echo $millasKm[$i]." Km";
	echo $duration[$i];
	echo '<br>';  
}

?>
