<?php

$db = mysqli_connect("140.134.26.143", "ican", "cani" , "i_can_db");
if(!$db){
    die("無法對資料庫連線");
} 
$sql =  "SELECT * FROM car_information where Car_ID = 'test'";  
$sth = mysqli_query($db , $sql);

        $data = array (
      'cols' => array( 
        array('id' => 'date', 'label' => 'date', 'type' => 'datetime'), 
        array('id' => 'volt', 'label' => 'volt', 'type' => 'number'), 
        array('id' => 'curr', 'label' => 'curr', 'type' => 'number'), 
        array('id' => 'temp', 'label' => 'temp', 'type' => 'number'),

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

?>
<html>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable(<?php echo json_encode($data); ?>);
      data.addColumn('number', 'Date');
      data.addColumn('number', 'Voltage');
      data.addColumn('number', 'Current');
      data.addColumn('number', 'Temperature');

      var options = {
        chart: {
          title: 'Box Office Earnings in First Two Weeks of Opening',
          subtitle: 'in millions of dollars (USD)'
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
  <div id="line_top_x"></div>
</body>
</html>