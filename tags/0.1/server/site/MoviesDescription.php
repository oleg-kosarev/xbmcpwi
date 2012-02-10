<?
include dirname(__FILE__)."/../classes/Movie.class.php";
$api_key = $_GET["api_key"];
$movies = json_decode(file_get_contents(dirname(__FILE__)."/../database/json/movies.json"));
$movie = $movies->$_GET["id"];
?>

<div class="modal">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3><?=$movie->title?></h3>
	</div>
	<div class="modal-body">
		<div class="span2">
			<ul class="thumbnails">
				<li class="span2"> <img src="thumbnails/<?=str_replace("?","",$movie->title)?>.tbn"/> </li>
			</ul>
		</div>
		<div class="span6">
			<p><?=$movie->resume?></p>
			<p>
				<?$genres = explode("/",$movie->genre);
				if(count($genres) > 0){
					foreach($genres as $genre){?>
						<span class="label label-info"> <?=$genre?> </span> &nbsp;
					<?}
				}?>
			</p>
			<p>
				<span class="label label-info"> <?=round($movie->duration/60)?> min </span>  &nbsp;
			</p>
		</div>
		<div style="clear:both"></div>
	</div>
	<div class="modal-footer">
		<a href="javascript:closeDescription();" class="btn">Fermer</a>
	</div>
</div>