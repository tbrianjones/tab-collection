<?php

	class Database
	{
	
		// mysqli connection
		private static $db;
		
		// construct
		//
		private function __construct()
		{
		} 
		
		// returns database connection instance
		//
		public static function get_instance() 
		{ 
		
			if( ! self::$db )
				self::$db = new mysqli( 'localhost', 'jones', 'Faster9109', 'tab' );
		
			return self::$db;
			
		} 
		
	}
		
?>