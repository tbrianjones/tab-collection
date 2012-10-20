<?php

	// check for url parameters
	if( isset( $uri_parameters[2] ) && isset( $uri_parameters[3] ) ) {

		// get catgegory data from uri
		$category = $uri_parameters[2];
		$category_id = $uri_parameters[3];

	} else {
	
		// set to null so all songs are loaded
		$category		= NULL;
		$category_id	= NULL;
	
	}
	
	// load songs
	require_once( $config['root'] . 'models/songs_model.php' );
	$Songs_model = new Songs_model;
	$songs = $Songs_model->get_songs( $category, $category_id );
	
	// set page title
	if( is_null( $category ) ) {
	
		$title = 'All Songs';
	
	} else if( $category == 'artists' ) {
		
		require_once( $config['root'] . 'models/artist_model.php' );
		$Artist = new Artist_model( $category_id );
		$title = ucwords( $Artist->get_name() ) . ' Songs';
	
	} else if( $category == 'genres' ) {
		
		require_once( $config['root'] . 'models/genre_model.php' );
		$Genre = new Genre_model( $category_id );
		$title = ucwords( $Genre->get_name() ) . ' Songs';
	
	} else if( $category == 'instruments' ) {
		
		require_once( $config['root'] . 'models/instrument_model.php' );
		$Instrument = new Instrument_model( $category_id );
		$title = ucwords( $Instrument->get_name() ) . ' Songs';
	
	} else {
	
		$title = 'still setting this up';
	
	}
	
?>
		
<!-- page title -->
<div data-role="header">
	<h1><?php echo $title; ?></h1>
</div>

<!-- content -->
<div data-role="content">
	
	<!-- songs list -->
	<ul data-role="listview" data-inset="true" data-filter="true">
	
		<?php
			foreach( $songs as $id => $song )
				echo '<li><a href="' . $config['webroot'] . 'index.php/songs/profile/' . $song['id'] . '/">' . $song['name'] . '</a></li>';
		?>
				
	</ul>
	
</div>