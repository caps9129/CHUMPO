<form method="post" action="">
    <p>Car_ID
    <input type="text" name="Car_ID" id="Car_ID"/></p>
    <input type="submit" name="send" value="刪除"/>
    <input type="reset" name="send" value="重設"/>
</form><hr/>
<?php
  $Car_ID = '';
  $sql = '';
  if(isset($_POST["send"])){
    $Car_ID = $_POST["Car_ID"];
  }
  $db = mysqli_connect("140.134.26.143", "ican", "cani");
    mysqli_select_db($db, "i_can_db") or die(mysqli_error($db));
    mysqli_query($db, 'SET NAMES utf8');
  
  
  if($Car_ID != ''){
    $sql = "DELETE FROM `car_show_information` WHERE `Car_ID` LIKE '$Car_ID'";
    $result = mysqli_query($db, $sql)or die("Error: ".mysqli_error($db));
    if($sql)
      echo "Delete Successful!!";
    else
      echo "Delete Fail!!";
    
  }
  

?>


