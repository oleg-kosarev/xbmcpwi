<?php
$config = parse_ini_file(dirname(__FILE__)."/xbmc.ini",true);

// met à jour les path du config
$config["webservice"]["path_to_thumbs"] = dirname(__FILE__)."/..".$config["webservice"]["path_to_thumbs"];
if(!file_exists($config["webservice"]["path_to_thumbs"])){
	exit("path_do_thumbs n'existe pas : ".$config["webservice"]["path_to_thumbs"]);
}
$config["webservice"]["path_to_fanart"] = dirname(__FILE__)."/..".$config["webservice"]["path_to_fanart"];
if(!file_exists($config["webservice"]["path_to_fanart"])){
	exit("path_to_fanart n'existe pas : ".$config["webservice"]["path_to_fanart"]);
}
include "xbmc.functions.php";

$check = checkXBMCAlive($config);
if(!$check){
	exit("XBMC n'est pas ouvert");
}

/***********************************************************************************
 * Films
 ***********************************************************************************/
$movies = getMovies($config);
$tabTitle = array();
foreach($movies as $i=>$movie){
	
	if(!isset($movie->originaltitle) && !isset($movie->title)){
		unset($movies[$i]);
		continue;
	}
	$title = str_replace("?","",$movie->originaltitle);
	if(isset($tabTitle[$title])){
		unset($movies[$i]);
		continue;
	}
	$tabTitle[$title] = true;
	
	if(isset($movie->thumbnail) && !file_exists($config["webservice"]["path_to_thumbs"].$title.".tbn")){
		$img = file_get_contents($config["xbmc"]["url"].$config["xbmc"]["thumbs"].$movie->thumbnail);
		file_put_contents($config["webservice"]["path_to_thumbs"].$title.".tbn",$img);
	}
	if(isset($movie->fanart) && !file_exists($config["webservice"]["path_to_fanart"].$title.".tbn")){
		$fanart = file_get_contents($config["xbmc"]["url"].$config["xbmc"]["thumbs"].$movie->fanart);
		file_put_contents($config["webservice"]["path_to_fanart"].$title.".tbn",$fanart);
	}
}
/***********************************************************************************
 * Séries
 ***********************************************************************************/
$tvshows = getTVShow($config);
foreach($tvshows as $i=>$show){
	// récupère l'image et la met sur le serveur
	if(!isset($show->title)){
		unset($tvshows[$i]);
		continue;
	}
	if(isset($show->thumbnail) && !file_exists($config["webservice"]["path_to_thumbs"].$show->title.".tbn")){
		$img = file_get_contents($config["xbmc"]["url"].$config["xbmc"]["thumbs"].$show->thumbnail);
		file_put_contents($config["webservice"]["path_to_thumbs"].$show->title.".tbn",$img);
	}
	if(isset($show->fanart) && !file_exists($config["webservice"]["path_to_fanart"].$show->title.".tbn")){
		$fanart = file_get_contents($config["xbmc"]["url"].$config["xbmc"]["thumbs"].$show->fanart);
		file_put_contents($config["webservice"]["path_to_fanart"].$show->title.".tbn",$fanart);
	}
	if($show->label == "") {
		unset($tvshows[$i]);
		continue;	
	}
	$seasons = getSeasons($config,$show->tvshowid);
	foreach($seasons as $season){
		$episodes[$season->season] = getEpisodes($config,$show->tvshowid,$season->season);
	}
	$tvshows[$i]->seasons = $episodes;
	$tvshows[$i]->nb_seasons = count($seasons);
	unset($episodes);	
}

/***********************************************************************************
 * Envoi au Webservice
 ***********************************************************************************/
$postFields = array("data"=>json_encode(array("movies"=>$movies,"tvshows"=>$tvshows)));
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $config["webservice"]["url"]."?api_key=".$config["webservice"]["api_key"]);  
curl_setopt($curl, CURLOPT_POST, true); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
$return = curl_exec($curl);
echo $return;

