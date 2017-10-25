<?php
  $db = mysqli_connect("127.0.0.1", "D0382128", "xhO2qcjl9HCgsLwS");
    mysqli_select_db($db, "storage_system") or die(mysqli_error($db));
    mysqli_query($db, 'SET NAMES utf8');
  
  $lon = "SELECT `Longitude` FROM `car_information` WHERE `Car_ID` LIKE'B'";
  $lat = "SELECT `Latitude` FROM `car_information` WHERE `Car_ID` LIKE 'B'";
  $Longitude = mysqli_query($db, $lon)or die("Error: ".mysqli_error($db));
  $Latitude = mysqli_query($db, $lat)or die("Error: ".mysqli_error($db));
 
?>
