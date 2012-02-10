<?php
include dirname(__FILE__)."/../classes/TVShow.class.php";
$api_key = $_GET["api_key"];
$tvshows = json_decode(file_get_contents(dirname(__FILE__)."/../database/json/tvshows.json"));


?>
<html>
	<head>
		<title>  </title>
		<script src="libs/jquery.min.js"></script>
		<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<script src="libs/bootstrap/js/bootstrap.min.js"></script>
		
		<link href="libs/library.css" rel="stylesheet"/>
		<script src="libs/library.js"></script>
		<script>
			var api_key = "<?=$_GET["api_key"]?>";
		</script>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<div class="container">
			<div class="span11 well listTop">
			<?foreach($tvshows as $i=>$tvshow){?>
			<a href="javascript:goto('<?=$i?>');"><?=$tvshow->title?></a> | 
			<?}?>
			</div>
			<div class="span4">
			<?
			foreach($tvshows as $i=>$tvshow){
				?>
				<div class="span3 well blocShow" id="<?=$i?>" name="<?=$tvshow->title?>">
					<h3> <?=$tvshow->title?> </h3>
					<? if(filesize(dirname(__FILE__)."/fanart/".$tvshow->title.".tbn") > 0) {?>
							<img src="fanart/<?=$tvshow->title?>.tbn" name="fanart_<?=$i?>"/>
					<?}?>
					Année : <?=$tvshow->year?> <br/>
					Nbr épisodes : <?=$tvshow->episodes?> <br/>
					Nbr saisons : <?=count((array)$tvshow->seasons)?>
				</div>
				<?
			}
			?>
			</div>
			<div class="span7 well showDescription">  </div>
		</div>
	</body>
</html>