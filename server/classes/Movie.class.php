<?php
class Movie {
	
	public $id;
	public $title;
	public $director;
	public $genre;
	public $resume;
	public $duration;
	public $filename;
	public $rate;
	
	public function feedFromXMBC($feed){
		$this->id = $feed->movieid;
		if(isset($feed->originaltitle))
			$this->title = $feed->originaltitle;
		elseif(isset($feed->title))
			$this->title = $feed->title;
		$this->director = $feed->director;
		$this->genre = $feed->genre;
		$this->resume = $feed->plot;
		$this->duration = $feed->duration;
		$this->filename = $feed->file;
		$this->rating = $feed->rating;
	}
	
}