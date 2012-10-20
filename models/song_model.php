<?php

	class Song_model extends Model
	{
		
		// varaibles of song data
		private $id;
		private $name;
		private $url;
		private $tab;
		private $artist_id;
		private $artist_name;
		
		// arrays of meta data
		private $genres;
		private $instruments;
		private $artists;

		// construct
		//
		function __construct( $id )
		{
		
			parent::__construct();
		
			// load data if instantiated with an id
			if( ! is_null( $id ) )
				$this->load( $id );
		
		}
		
		
		
		
		
	// --- GETTERS --- //
		
		public function get_id()
		{	
			return $this->id;
		}

		public function get_name()
		{	
			return $this->name;
		}
		
		public function get_url()
		{	
			return $this->url;
		}
		
		public function get_tab()
		{	
			return $this->tab;
		}
		
		public function get_artist_id()
		{	
			return $this->artist_id;
		}
		
		public function get_artist_name()
		{	
			return $this->artist_name;
		}
		
		// get genres
		//
		public function get_genres(
			$names_only = FALSE	// TRUE returns an array where the key is the id, and the value is the genre name
		) {
		
			if( is_null( $this->genres ) )
				$this->load_genres();
			
			if( $names_only == TRUE ) {
				foreach( $this->genres as $genre )
					$genres[ $genre['id'] ] = $genre['name'];
				return $genres;
			} else {
				return $this->genres;
			}
		
		}
		
		public function get_instruments()
		{
		
			if( is_null( $this->instruments ) )
				$this->load_instruments();
				
			return $this->instruments;
		
		}

		public function get_spotify_embed_html()
		{
		
			// get song href from spotify
			$query = urlencode( htmlentities( strtolower( $this->name . ' ' . $this->artist_name ) ) ); // add the artist's name
			$url = 'http://ws.spotify.com/search/1/track.json?q=' . $query;
			$ch = curl_init( $url );
			$options = array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
			);
			curl_setopt_array( $ch, $options );
			$result =  curl_exec( $ch ); // Getting jSON result string
			$song_data = json_decode( $result );
			$song_href = $song_data->tracks['0']->href;
		
			// generate and return embed html
			$html = '<iframe src="https://embed.spotify.com/?uri=' . $song_href . '" width="290" height="80" frameborder="0" allowtransparency="true"></iframe>';
			return $html;
			
		}
		
		
		
		
	// --- LOADERS --- //
	
		private function load( $id )
		{
		
			$sql = 'SELECT id, artist_id, name, url, tab, lyrics
					FROM songs
					WHERE id = ' . $id;
			$query = $this->db->query( $sql );
			if( $query->num_rows > 0 ) {

				$row = $query->fetch_object();

				$this->id			= $row->id;
				$this->artist_id	= $row->artist_id;
				$this->name			= $row->name;
				$this->url			= $row->url;
				$this->tab			= $row->tab;
				$this->lyrics		= $row->lyrics;

			}
			
			$this->load_artist();
			
		}
		
		private function load_artist()
		{
		
			$sql = 'SELECT name
					FROM artists
					WHERE id = ' . $this->artist_id;				
			$query = $this->db->query( $sql );
			if( $query->num_rows > 0 ) {
				$row = $query->fetch_object();
				$this->artist_name = $row->name;
			}
		
		}
		
		private function load_genres()
		{
		
			$sql = "SELECT genres.id, genres.name
					FROM genres, songs_to_genres
					WHERE
						genres.id = songs_to_genres.genre_id
						AND songs_to_genres.song_id = " . $this->id . "
					ORDER BY genres.name ASC";
			$query = $this->db->query( $sql );
			if( $query->num_rows > 0 ) {
			
				$i = 0;
				while( $row = $query->fetch_object() )
				{
				
					$this->genres[ $i ]['id']		= $row->id;
					$this->genres[ $i ]['name']		= $row->name;
					$i++;
				
				}
			
			}
		
		}
		
		private function load_instruments()
		{
		
			$sql = "SELECT instruments.id, instruments.name
					FROM instruments, songs_to_instruments
					WHERE
						instruments.id = songs_to_instruments.instrument_id
						AND songs_to_instruments.song_id = " . $this->id . "
					ORDER BY instruments.name ASC";
					
			
			$query = $this->db->query( $sql );
			if( $query->num_rows > 0 ) {
			
				$i = 0;
				while( $row = $query->fetch_object() )
				{
				
					$this->instruments[ $i ]['id']		= $row->id;
					$this->instruments[ $i ]['name']	= $row->name;
					$i++;
				
				}
			
			}
		
		}

	
	
	
	} // end Song_model()

?>