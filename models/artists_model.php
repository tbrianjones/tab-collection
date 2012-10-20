<?php

	class Artists_model extends Model
	{
	
		private $artists;
		
		function __construct()
		{
		
			parent::__construct();
		
		}
		
		
		
		
		
		
	// --- GETTERS --- //
		
		public function get_artists()
		{
		
			if( is_null( $this->artists ) )
				$this->load_artists();
				
			return $this->artists;
		
		}

		
		
		
		
	// --- LOADERS --- //
	
		private function load_artists()
		{
		
			$sql = "SELECT id, name
					FROM artists
					ORDER BY name ASC";
			$query = $this->db->query( $sql );
			if( $query->num_rows > 0 ) {
			
				$i = 0;
				while( $row = $query->fetch_object() )
				{
				
					$this->artists[ $i ]['id']		= $row->id;
					$this->artists[ $i ]['name']	= $row->name;
					$i++;
				
				}
			
			}
			
		}
	
	
	
	
	
	} // end Artists_model()

?>