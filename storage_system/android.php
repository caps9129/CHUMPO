<?php
$db = mysqli_connect("140.134.26.143", "ican", "cani");

mysqli_query($db,"SET CHARACTER SET 'UTF8'");
mysqli_query($db,'SET NAMES UTF8');
mysqli_query($db,'SET CHARACTER_SET_CLIENT=UTF8');
mysqli_query($db,'SET CHARACTER_SET_RESULTS=UTF8');
mysqli_select_db($db, "i_can_db") or die(mysqli_error($db));

$sql = $_POST['query_string'];
//$sql  = 'SELECT * FROM car_information';
//$sql = stripslashes($sql);
$res = mysqli_query($db,$sql);
while($r = mysqli_fetch_assoc($res))
    $output[] = $r;

//print(json_encode($output));
echo(json_encode($output));
mysqli_close($db);

?>