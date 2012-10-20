<?php

	class Instruments_model extends Model
	{
	
		private $instruments;		
		
		function __construct()
		{
		
			parent::__construct();
						
		}
		
		
		
		
		
		
	// --- GETTERS --- //
		
		public function get_instruments()
		{
		
			if( is_null( $this->instruments ) )
				$this->load_instruments();
				
			return $this->instruments;
		
		}

		
		
		
		
	// --- LOADERS --- //
	
		private function load_instruments()
		{
			
			// query mysql
			$sql = "SELECT id, name
					FROM instruments
					ORDER BY name ASC";
			$query = $this->db->query( $sql );
			
			echo $this->db->error;
			
			// save data
			if( $query->num_rows > 0 )
			{
			
				$i = 0;
				while( $row = $query->fetch_object() )
				{
					
					$this->instruments[ $i ]['id']		= $row->id;
					$this->instruments[ $i ]['name']	= $row->name;
					$i++;
				
				}
			
			}
			
		}



	
	
	} // end Instruments_model()

?>