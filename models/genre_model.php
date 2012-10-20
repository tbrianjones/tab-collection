<?php

	class Genre_model extends Model
	{
	
		private $id;
		private $name;
		
		function __construct( $id = NULL )
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

		
		
		
		
	// --- LOADERS --- //
	
		public function load( $id )
		{
			
			// query for data
			$sql = 'SELECT id, name
					FROM genres
					WHERE id = ' . $id;
								
			$query = $this->db->query( $sql );
			
			// save data to class variables
			if( $query->num_rows > 0 ) {
				$row = $query->fetch_object();
				$this->id = $row->id;
				$this->name = $row->name;
			}
			
		}
	
	
	
	
	
	} // end Artist_model()

?>