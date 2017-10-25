<?php	
class DatabaseConnect {


	// constructor to database
	
	function __construct() {
		// connecting to database
		define('DB_USER', "ican");
		define('DB_PASSWORD', "cani");
		define('DB_DATABASE', "i_can_db");
		define('DB_SERVER', "140.134.26.143");
		$con = $this->connect();
		$this->close($con);
	}

	function connect(){

		// import database connection variables
		
		// Connecting to mysql database
		$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error($con));
		mysqli_select_db($con, DB_DATABASE) or die(mysqli_error($con)) or die(mysqli_error($con));
		mysqli_query($con, 'SET NAMES utf8');
		

		// returning connecting cursor
		mysqli_query($con, 'SET NAMES utf8');
		return $con;
	}

	function close($con){
		mysqli_close($con);
		
	}	
}
/*$test = new DatabaseConnect;
$con  = $test->connect();
$test->close($con);*/
?>
	