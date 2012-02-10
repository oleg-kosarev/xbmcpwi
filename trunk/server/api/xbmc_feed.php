<?php
include dirname(__FILE__)."/../classes/TVShow.class.php";

$data = json_decode($_POST["data"]);

foreach($data->tvshows as $show){
	$tvshow = new TVShow();
	$tvshow->feedFromXMBC($show);
	$tabTVShows[$tvshow->id] = $tvshow;
}
$movies = json_encode($data->movies);
$tvshows = json_encode($tabTVShows);
$movies = str_replace("},","},\n",$movies);
$tvshows = str_replace("},","},\n",$tvshows);

$db_path = dirname(__FILE__)."/../database/json/";
if(!file_exists($db_path)) if(!mkdir($db_path)) die("Failed to create directory \n");
file_put_contents($db_path."/movies.json", $movies);
file_put_contents($db_path."/tvshows.json", $tvshows);

echo json_encode(array("response_code"=>"ok"));