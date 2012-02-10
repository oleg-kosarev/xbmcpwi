<?php
/**
 * Représente une série
 * @author ryo_sensei
 * Les images sont stockés dans les dossiers /thumbnails et /fanarts avec le nom de la série $title.tbn
 */
class TVShow {
	
	public $id;			// id
	public $year;		// année
	public $title;		// titre
	public $episodes;	// nombre d'épisodes
	public $seasons;	// liste des saisons et des épisodes
	public $genre;		// genres
	public $resume;		// résumé
	
	public function feedFromXMBC($feed){
		$this->id = $feed->tvshowid;
		$this->year = $feed->year;
		$this->title = $feed->showtitle;
		$this->episodes = $feed->episode;
		$this->genre = $feed->genre;
		$this->resume = $feed->plot;
		
		foreach($feed->seasons as $saison_num => $episodes){
			foreach($episodes as $episode){
				$this->seasons[$saison_num][$episode->episode] = array(
					"duration" => round((($episode->duration)/60)),
					"first_aired" => $episode->firstaired,
					"title" => $episode->title,
					"resume" => $episode->plot,
					"episode_id" => $episode->episode,
					"image" => $episode->thumbnail
				);
			}
		}
		ksort($this->seasons[$saison_num]);
	}
	
	
}