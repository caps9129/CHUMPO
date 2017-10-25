<?php
	if(isset($_POST["Car_ID"])){

		if($_POST["Car_ID"] == null){
			echo "Car_ID must be filled.";
		}
		else{
			$db = mysqli_connect("140.134.26.143", "ican", "cani");
  			mysqli_select_db($db, "i_can_db") or die(mysqli_error($db));
  			
  			$Car_ID = $_POST["Car_ID"];
  			$Voltage = $_POST["Voltage"];
  			$Current = $_POST["Current"];
  			$Temperature = $_POST["Temperature"];
  			$Longitude = $_POST["Longitude"];
  			$Latitude = $_POST["Latitude"];

  			$sql = "INSERT INTO `car_show_information` (Car_ID, Voltage, Current, Temperature, Longitude, Latitude)
  			VALUES ('$Car_ID', '$Voltage', '$Current', '$Temperature', '$Longitude', '$Latitude')";
  			//$queryStr = "INSERT INTO table (aa,bb,cc,dd,ee,ff) VALUES ('$a','$b','$c','$d','$e','$f')";
			

  			$result = mysqli_query($db, $sql)or die("Error: ".mysqli_error($db));
  			echo "Data insert into database";

		}
	}
?>