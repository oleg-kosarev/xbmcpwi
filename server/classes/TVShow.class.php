<?php
class TVShow {
	
	public $id;
	public $year;
	public $title;
	public $episodes;
	public $seasons;
	public $genre;
	public $resume;
	public $image;
	
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