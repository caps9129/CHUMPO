<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Datbase</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body style="padding-left: 30px;padding-right: 30px;">

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					電動車資訊管理 <br><small> 新增資料</small>
				</h1>
			</div>
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="#">電動車資訊管理</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="index.php">首頁</a>
						</li>
						<li>
							<a href="indexmap.php">位置顯示</a>
						</li>
						<li>
							<a href="indexanalysis.php">資料分析</a>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">庫存管理<strong class class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<li class="active">
										<a href="insertdata.php">新增</a>
								</li>

								<li class="divider">
								</li>

								<li>
									<a href="indexremove.php">刪除</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
			</nav>
		</div>
	</div>
</div>


<form method="post" role="form" class="form-group">
	<table class="table">

		<tr>
		 <td style="font-weight:bold;" >
		 Car_ID
		 </td>
		 <td>
				<input type="text" name="Car_ID">
		 	</td>
		</tr>
		<tr>
	     <td style="font-weight:bold;" >
	     Voltage
	     </td>
		 <td>
		 		<input type="text" name="Voltage">
			</td>
		</tr>
		<tr>
	     <td style="font-weight:bold;" >
	     Current
	     </td>
		 <td>
		 		<input type="text" name="Current">
			</td>
		</tr>
		<tr>
	     <td style="font-weight:bold;" >
	     Temperature
	     </td>
		 <td>
		 		<input type="text" name="Temperature">
			</td>
		</tr>
		<tr>
	     <td style="font-weight:bold;" >
	     Longitude
	     </td>
		 <td>
		 		<input type="text" name="Longitude">
			</td>
		</tr>
		<tr>
		 <td style="font-weight:bold;" >
		Latitude
	     </td>
		 <td>
		 		<input type="text" name="Latitude">
			</td>
		</tr>
		<tr>
		 <td colspan="2" align="center">
		  <input type="submit" value="Add">
		 </td>
		</tr> 
</table>
</form>
<?php include 'insert.php' ?>	

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>