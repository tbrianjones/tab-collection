<?php
	
	// --- CONFIGURATION --- //
		
	// global variables
	$config['domain']		= 'http://www.tbrianjones.com';
	$config['root']			= '/data/www/html/sites/tab/';
	$config['webroot']		= '/sites/tab/';
	
	// environment
	//
	//	1) types: development, production
	//
	$config['environment']	= 'development';
	if( $config['environment'] == 'development' ) {
		ini_set( 'display_errors', 1 ); 
		error_reporting( E_ALL );
	} else if( $config['environment'] == 'production' ) {
		// production settings
	}
	
	
	// --- INCLUDE FILES --- //
	
	require_once( $config['root'] . 'database/database_class.php' );
	require_once( $config['root'] . 'models/model.php' );
	
?>