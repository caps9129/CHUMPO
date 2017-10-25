<?php
	//require_once 'DBConnect.php';

  	$db = mysqli_connect("140.134.26.143", "ican", "cani");
  	mysqli_select_db($db, "i_can_db") or die(mysqli_error($db));
  	mysqli_query($db, 'SET NAMES utf8');
	//mysqli_query($db,"SELECT * FROM products");
	//mysqli_query("SET character_set_results=utf8");
	$sql  = 'SELECT * FROM car_show_information';
	$result = mysqli_query($db, $sql)or die("Error: ".mysqli_error($db));
	$num = mysqli_num_rows($result);
	//soc
	
	$sql = "SELECT Current FROM car_information where Car_ID = 'test'";
	$rows = mysqli_query($db , $sql);
	$nums = mysqli_num_rows($rows); 
	if($nums > 0){
	  $sql = "SELECT Log from car_information order by Log asc limit 1";
	  $start_datetime = mysqli_query($db , $sql);
	  $start = mysqli_fetch_row($start_datetime);
	  
	  $sql = "SELECT Log from car_information order by Log desc limit 1";
	  $end_datetime = mysqli_query($db , $sql);
	  $end = mysqli_fetch_row($end_datetime);
	  
	  
	  $difference_in_seconds = strtotime($end[0]) - strtotime($start[0]);
	  $per_sec = $difference_in_seconds / $nums;
	}
	  // time
	  $sql = "SELECT Current from car_information order by Log desc limit 1";
	  $nowv = mysqli_query($db , $sql);
	  $now_current = mysqli_fetch_row($nowv);
	  if($now_current[0] <= 1)
      	$now_current[0] = 1;


	  $cur_sum = 0;
	  for($i = 0 ; $i < $nums ; $i++){
	    $Current = mysqli_fetch_row($rows);
	    $cur_sum = $cur_sum + $Current[0] * $per_sec;
	  }
	  $battery = 1 - ($cur_sum / 55913.074659616);
	  /*$remain_time = (55914.074659616 - $cur_sum) / $now_current[0];*/
	  $remain_time = (55914.074659616 - $cur_sum) / 1.5;
  	  $Remain_Time = round($remain_time, 3);
  	  $hour = $Remain_Time / 3600;
  	  $hour = floor($hour);
  	 
  	  $minute = ($Remain_Time - ($hour * 3600)) / 60;
  	  $minute = floor($minute);
  	 
  	  $second = ($Remain_Time - ($hour * 3600)) % 60;
  	  
	  if($battery < 0)
	    $battery = - $battery;  
	  $battery = $battery * 100;
  	//soc
	echo '<table class=';
	echo 'table>';
	echo '
			<thead>						
				<tr style="background:#A500CC; color:white; font-weight:bold">
					<th>                
						Car_ID
					</th>
					<th>
						Voltage
					</th>
					<th>
						Current
					</th>
					<th>
						Battery
					</th>
					<th>
						Temperature
					</th>
					<th>
						Longitude
					</th>
					<th>
						Latitude
					</th>
					<th>
						Log_Time
					</th>	
					<th>
						Remain_Time
					</th>	
				</tr>	
			</thead>
			<tbody>';
	
	if ($num > 0){
		for($i = 0 ; $i < $num ; $i++){//
			//取得資料數	
			$row = mysqli_fetch_row($result);
			echo '<tr bgcolor =  #ffe6e6>';
			echo "<td><a href='indexgetmap.php?Longitude=$row[4]&Latitude=$row[5]'  target='_blank'>{$row[0]}</a></td>";
			echo"<td>" . $row[1] . "</td>"; 
			echo"<td>" . $row[2] . "</td>"; 
			echo"<td>" . round($battery ,3) . "%" . "</td>";
			echo"<td>" . $row[3] . "</td>"; 
			echo"<td>" . $row[4] . "</td>"; 
			echo"<td>" . $row[5] . "</td>"; 
			echo"<td>" . $row[6] . "</td>";
			echo"<td>" . $hour . "&nbsp;Hour&nbsp;" . $minute . "&nbsp;Minute&nbsp;" . $second . "&nbsp;Second" . "</td>";
			echo"</tr>";
		}
	}
	mysqli_free_result($result);
	
	echo '</tbody></table>';
	
?>	
					