<?php
include dirname(__FILE__)."/../classes/TVShow.class.php";

$api_key = $_GET["api_key"];
$tvshows = json_decode(file_get_contents(dirname(__FILE__)."/../database/json/tvshows.json"));
$show = $tvshows->$_GET["id"];
?>

<div class="alert alert-success"> <h3><?=$show->title?></h3></div>
<? if(file_exists(dirname(__FILE__)."/thumbnails/".$show->title.".tbn")) {?>
	<p>
		<img src="thumbnails/<?=$show->title?>.tbn"/>
	</p>
<?}?>
<p> <?=$show->resume?> </p>

<div class="span5" style="margin-bottom: 25px;">
	<?
	$genres = explode("/",$show->genre);
	foreach($genres as $genre){
		?><span class="label label-info"> <?=$genre?> </span> &nbsp;<? 
	}?><br/>
	<span class="label label-info"> <?=$show->year?> </span>  &nbsp;
	<span class="label label-info"> <?=$show->episodes?> épisodes </span> 
</div>

<div style="clear:both"></div>

<div class="tabbable">
	<ul class="nav nav-tabs">
		<? foreach($show->seasons as $n=>$season){
			if($n < 10) $n = "0".$n;
			?><li class=""><a href="#season_<?=$n?>" data-toggle="tab">Saison <?=$n?></a></li><?
		}?>
	</ul>
	<div class="tab-content">
		<? foreach($show->seasons as $n=>$episodes){
			if($n < 10) $n = "0".$n;?>
		<div class="tab-pane prettyprint" id="season_<?=$n?>">
			<? foreach($episodes as $k=>$episode){
				if($episode->episode_id < 10) $episode->episode_id = "0".$episode->episode_id;
				$episode_id = "S".$n."E".$episode->episode_id; 
				?>
				<b> <?=$episode->title?> </b>
				<p>
					<?=$episode->resume?>
				</p>
				<p>
					<span class="label label-success"><?=$episode_id?> </span> &nbsp;
					<span class="label label-success"> <?=$episode->duration?> min. </span> &nbsp;
				</p>
			<?}?>
		</div>
		<?}?>
	</div>
</div>