<?php
	
	// load song ( if one is specified )
	if( isset( $uri_parameters[2] ) ) {		
		require_once( $config['root'] . 'models/song_model.php' );		
		$Song = new Song_model( $uri_parameters[2] );
	} else {
		die( "ERROR: You must specify a song id in the url." );
	}

	// define page title
	$title = 'Song: ' . $Song->get_name();

?>

<!-- page title -->
<div data-role="header">
	<h1><?php echo $title; ?></h1>
</div>

<!-- content -->
<div data-role="content">
	
	<!-- spotify player -->
	<?php echo $Song->get_spotify_embed_html(); ?>
	
	<!-- tab button -->
	<a href="<?php echo $Song->get_url(); ?>" data-role="button">Tablature</a>
	
	<!-- meta data -->
	<ul data-role="listview" data-inset="true" style="margin-top: 25px;">
		
		<!-- instruments -->
		<li data-role="list-divider">Instruments</li>
		<?php
			$instruments = $Song->get_instruments();
			foreach( $instruments as $instrument ) {
				echo '<li>' . $instrument['name'] . '</li>';
			}
		?>
		
		<!-- genres -->
		<li data-role="list-divider">Genres</li>
		<?php
			$genres = $Song->get_genres();
			foreach( $genres as $genre ) {
				echo '<li>' . $genre['name'] . '</li>';
			}
		?>
		
	</ul> <!-- end meta data ul -->
	
	<!-- edit button -->
	<a href="<?php echo $config['webroot']; ?>index.php/songs/edit/1/" data-role="button">Edit This Song</a>
	<!-- edit button -->
	<a href="<?php echo $config['webroot']; ?>index.php/songs/edit_tab/1/" data-role="button">Edit This Tab</a>
	
</div> <!-- end content div -->