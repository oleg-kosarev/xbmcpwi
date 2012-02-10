<?php

function getMovies($config){
	$params = array(
		"jsonrpc" => "2.0",
		"method" => "VideoLibrary.GetMovies",
		"params" => array(
			"fields"=> array(
				"genre", "director", "trailer", "tagline", "plot", "plotoutline", "title", "originaltitle", "lastplayed", "showtitle", "firstaired", "duration", "season", "episode", "runtime", "year", "playcount", "rating"
			)
		),
		"id" => 0
	);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $config["xbmc"]["url"]."/jsonrpc");  
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	$return = curl_exec($curl);
	$videos = json_decode($return);
	$movies = $videos->result->movies;
	return $movies;
}
function getTVShow($config){
	$params = array(
		"jsonrpc" => "2.0",
		"method" => "VideoLibrary.GetTVShows",
		"params" => array(
			"fields"=> array(
				"genre", "director", "trailer", "tagline", "plot", "plotoutline", "title", "originaltitle", "lastplayed", "showtitle", "firstaired", "duration", "season", "episode", "runtime", "year", "playcount", "rating"
			)
		),
		"id" => 0
	);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $config["xbmc"]["url"]."/jsonrpc");  
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	$return = curl_exec($curl);
	$videos = json_decode($return);
	$tvshows = $videos->result->tvshows;
	return $tvshows;
}
function getSeasons($config,$tvshowid){
	$params = array(
		"jsonrpc" => "2.0",
		"method" => "VideoLibrary.GetSeasons",
		"params" => array(
			"fields"=> array(
				"seasonid","title", "originaltitle", "lastplayed", "showtitle", "firstaired", "duration", "season", "episode", "runtime", "year", "playcount", "rating"
			),
			"tvshowid" => $tvshowid
		),
		"id" => 0
	);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $config["xbmc"]["url"]."/jsonrpc");  
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	$return = json_decode(curl_exec($curl));
	$seasons = $return->result->seasons;
	return $seasons;
}
function getEpisodes($config,$tvshowid,$seasonid){
	$params = array(
		"jsonrpc" => "2.0",
		"method" => "VideoLibrary.GetEpisodes",
		"params" => array(
			"fields"=> array(
				"genre", "director", "trailer", "tagline", "plot", "plotoutline", "title", "originaltitle", "lastplayed", "showtitle", "firstaired", "duration", "season", "episode", "runtime", "year", "playcount", "rating"
			),
			"tvshowid" => $tvshowid,
			"season"=>$seasonid
		),
		"id" => 0
	);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $config["xbmc"]["url"]."/jsonrpc");  
	curl_setopt($curl, CURLOPT_POST, true); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	$return = json_decode(curl_exec($curl));
	$episodes = $return->result->episodes;
	return $episodes;
}