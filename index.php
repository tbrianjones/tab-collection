<?php

	// include configuration
	require_once( 'config.php' );
		
	// set uri parameters
	$uri= $_SERVER['REQUEST_URI'];
	$uri_parameters	= trim( substr( $uri, strpos( $uri, 'index.php' ) + 9 ), '/ ' );
		
	if( $uri_parameters != '' )
		$uri_parameters	= explode( '/', $uri_parameters );
	else
		unset( $uri_parameters );
	
?>

<?php
	
	// load header
	include( 'header.php' );
		
	// load content
	//
	//	- include views as wanted for each page
	//
	//	FUTURE UPGRADES
	//	- this can be improved by requring the other uri_parameters for each view
	//		- for now this allows us to debug the app better though .. i think
	//		- and .. these requirements will change a lot during development
	//
	if( isset( $uri_parameters ) && isset( $uri_parameters[0] ) && isset( $uri_parameters[1] ) ) {
		
		// songs/list
		if( $uri_parameters[0] == 'songs' && $uri_parameters[1] == 'list' )
			include( 'views/songs/list.php' );
		
		// songs/profile
		if( $uri_parameters[0] == 'songs' && $uri_parameters[1] == 'profile' )
			include( 'views/songs/profile.php' );
		
		// songs/edit
		if( $uri_parameters[0] == 'songs' && $uri_parameters[1] == 'edit' )
			include( 'views/songs/edit.php' );

		// songs/edit_tab
		if( $uri_parameters[0] == 'songs' && $uri_parameters[1] == 'edit_tab' )
			include( 'views/songs/edit_tab.php' );
			
	} else {
		
		// no uri parameters were supplied so load main page
		include( 'views/categories.php' );
		
	}
		
	// load footer
	include( 'footer.php' );

?>