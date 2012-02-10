<?php
include dirname(__FILE__)."/../classes/Movie.class.php";
$api_key = $_GET["api_key"];
$movies = json_decode(file_get_contents(dirname(__FILE__)."/../database/json/movies.json"));


?>
<html>
	<head>
		<title>  </title>
		<script src="libs/jquery.min.js"></script>
		<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<script src="libs/bootstrap/js/bootstrap.min.js"></script>
		
		<link href="libs/library.css" rel="stylesheet"/>
		<script src="libs/library.js"></script>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<div class="container">
			<div class="span4">
			
			</div>
			<div class="span7 well showDescription">  </div>
		</div>
	</body>
</html>