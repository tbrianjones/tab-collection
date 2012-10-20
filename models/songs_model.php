<?php
	
	// accessing data about more than one song at a time
	//
	class Songs_model extends Model
	{
	
	
		// class variables
		private $songs;
	
	
		
		// construct
		//
		function __construct()
		{
		
			parent::__construct();
		
		}
		
		
		
		
	// --- GETTERS --- //
		
		// gets all songs based
		//
		//	1) see load_songs() method for passed variable definitions
		//
		public function get_songs( $category = NULL, $category_id = NULL )
		{
		
			if( is_null( $this->songs ) )
				$this->load_songs( $category, $category_id );
				
			return $this->songs;
		
		}

		
		
		
		
	// --- LOADERS --- //
		
		// loads songs into the class variable $songs
		//
		//	1) if no category or category id are specified, all songs will be loaded
		//
		//	2) if a category and category_id are given, only songs matching that category id will be loaded
		//		
		//		- available categories
		//			- artists
		//			- genres
		//			- instruments
		//
		private function load_songs( $category = NULL, $category_id = NULL )
		{
			
			if( ! is_null( $category ) && ! is_null( $category_id ) )
			{
				
				// retrieve songs for the specified category
				$sql = "SELECT songs.id, songs.name, songs.url, songs.tab, songs.lyrics
						FROM songs, songs_to_" . $category . "
						WHERE
							songs.id = songs_to_" . $category . ".song_id
							AND songs_to_" . $category . "." . substr( $category, 0, -1 ) . "_id = " . $category_id . "
						ORDER BY name ASC";
			
			} else {
			
				// retrieve all songs
				$sql = "SELECT id, name, url, tab, lyrics
						FROM songs
						ORDER BY name ASC";
			
			}
			
			$query = $this->db->query( $sql );
			if( $query->num_rows > 0 )
			{
			
				$i = 0;
				while( $row = $query->fetch_object() )
				{
				
					$this->songs[ $i ]['id']		= $row->id;
					$this->songs[ $i ]['name']		= $row->name;
					$this->songs[ $i ]['url']		= $row->url;
					$this->songs[ $i ]['tab']		= $row->tab;
					$this->songs[ $i ]['lyrics']	= $row->lyrics;
					$i++;
				
				}
			
			}
			
		}
	
	
	
	
		
	
	} // end Songs_model()

?>