<?php
$con = include('DBConnect.php');
$test = new DatabaseConnect;
$con  = $test->connect();


/*$con = mysqli_connect("140.134.26.143", "ican", "cani");
mysqli_select_db($con, "i_can_db") or die(mysqli_error($con));
mysqli_query($con, 'SET NAMES utf8');*/


$sql =  "SELECT * FROM car_information where Car_ID = 'test'";  
$sth_0 = mysqli_query($con , $sql);
$num_0 = mysqli_num_rows($sth_0); 

$sql =  "SELECT * FROM car_battery where id = 'test'";  
$sth_1 = mysqli_query($con , $sql);
$num_0 = mysqli_num_rows($sth_1); 

	
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
						Remain_Time
					</th>	
					<th>
						Log_Time
					</th>	
				</tr>	
			</thead>
			<tbody>';
	
	if ($num_0 > 0){
		for($i = 0 ; $i < $num_0; $i++){//
			//取得資料數	

			$row_0 = mysqli_fetch_row($sth_0);
			$row_1 = mysqli_fetch_row($sth_1);

			echo '<tr bgcolor =  #ffe6e6>';
			echo"<td>" . $row_0[0] . "</td>"; 
			echo"<td>" . $row_0[1] . "</td>"; 
			echo"<td>" . $row_0[2] . "</td>"; 
			echo"<td>" . $row_1[1] . "</td>";
			echo"<td>" . $row_0[3] . "</td>"; 
			echo"<td>" . $row_0[4] . "</td>"; 
			echo"<td>" . $row_0[5] . "</td>"; 
			echo"<td>" . $row_1[2] . "</td>";
			echo"<td>" . $row_0[6] . "</td>";
			echo"</tr>";
		}
	}
	
	echo '</tbody></table>';
	$test->close($con);


?>