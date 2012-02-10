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
		
		<link href="libs/movies.css" rel="stylesheet"/>
		<script src="libs/movies.js"></script>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<div class="container">
			<div class="span10 well">
				<ul class="thumbnails">
				<?foreach($movies as $movie){
					$movie->title = str_replace("?","",$movie->title);?>
	    			<li class="span2 affiche">
	    				<h5> <?=$movie->title?></h5>
	    				<?if(filesize("thumbnails/".$movie->title.".tbn") > 0){?>
	    					<a href="javascript:showMovie('<?=$movie->id?>','<?=addslashes($movie->title)?>');" class="thumbnail">
	    						<img src="thumbnails/<?=$movie->title.".tbn"?>"/>
	    					</a>	
	    				<?}?>
	    			</li>
	    		<?}?>
	    		</ul>			
	    	</div>
		</div>
		<div id="description" class="span10"></div>
		
	</body>
</html>