<?php

$db = mysqli_connect("140.134.26.143", "ican", "cani" , "i_can_db");
if(!$db){
    die("無法對資料庫連線");
} 
$sql =  "SELECT * FROM car_information where Car_ID = 'test'";  
$sth = mysqli_query($db , $sql);

        $data = array (
      'cols' => array( 
        array('id' => 'Date', 'label' => 'Date', 'type' => 'datetime'), 
        array('id' => 'Voltage', 'label' => 'Voltage', 'type' => 'number'), 
        array('id' => 'Current', 'label' => 'Current', 'type' => 'number'), 
        array('id' => 'Temperature', 'label' => 'Temperature', 'type' => 'number'),

    ),
    'rows' => array()
);

while ($res = mysqli_fetch_assoc($sth)) {
     // assumes dates are patterned 'yyyy-MM-dd hh:mm:ss'
    preg_match('/(\d{4})-(\d{2})-(\d{2})\s(\d{2}):(\d{2}):(\d{2})/', $res['Log'], $match);
    $year = (int) $match[0];
    $month = (int) $match[1] - 1; // convert to zero-index to match javascript's dates
    $day = (int) $match[2];
    $hours = (int) $match[3];
    $minutes = (int) $match[4];
    $seconds = (int) $match[5];
    array_push($data['rows'], array('c' => array(
        array('v' => 'Date(' . date('Y,n,d,H,i,s', strtotime ( '-1 month' , strtotime ($res['Log']) ) ).')'),
        array('v' => floatval($res['Voltage'])), 
        array('v' => floatval($res['Current'])),
        array('v' => floatval($res['Temperature'])),
    )));   
    // array nesting is complex owing to to google charts api
}
// battery soc
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

  // time
  $sql = "SELECT Current from car_information order by Log desc limit 1";
  $nowv = mysqli_query($db , $sql);
  $now_current = mysqli_fetch_row($nowv);
  if($now_current[0] <= 1)
    $now_current[0] = 1;
  //soc
  $cur_sum = 0;
  for($i = 0 ; $i < $nums ; $i++){
    $Current = mysqli_fetch_row($rows);
    $cur_sum = $cur_sum + $Current[0] * $per_sec;
  }
  $battery = 1 - ($cur_sum / 55913.074659616);
  $remain_time = (55914.074659616 - $cur_sum) / $now_current[0];
  /*echo round($remain_time, 3);*/
  echo '<br>';  
  if($battery < 0)
    $battery = - $battery;  
  /*echo round($battery, 3);*/

 } 

?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable(<?php echo json_encode($data); ?>);

      var options = {
        chart: {
          title: 'Battery Information Analysis',
          subtitle: 'Voltage , Current , Temperature'
        },
        vAxis: {
          format: '0.000' // show axis values to 3 decimal places
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
 </head>
        <body>
                <div id="line_top_x" style="width: 900px; height: 500px; padding-left: 30%"></div>
        </body>
</html>