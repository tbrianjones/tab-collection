<?php

	class Genres_model extends Model
	{
	
		private $genres;
		
		function __construct()
		{
		
			parent::__construct();
		
		}
		
		
		
		
		
		
	// --- GETTERS --- //
		
		public function get_genres()
		{
		
			if( is_null( $this->genres ) )
				$this->load_genres();
				
			return $this->genres;
		
		}

		
		
		
		
	// --- LOADERS --- //
	
		private function load_genres()
		{
		
			$sql = "SELECT id, name
					FROM genres
					ORDER BY name ASC";
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
	
	
	
	
	
	} // end Genres_model()

?>