<?php

	class Model
	{
	
		protected static $db;
				
		function __construct()
		{
			
			$this->db = Database::get_instance();
		
		}
		
	}
		
?>