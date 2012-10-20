<?php
	
	// load instruments
	require_once( $config['root'] . 'models/instruments_model.php' );
	$Instruments_model = new Instruments_model;
	$instruments = $Instruments_model->get_instruments();
	
	// load artists
	require_once( $config['root'] . 'models/artists_model.php' );
	$Artists_model = new Artists_model;
	$artists = $Artists_model->get_artists();

	// load genres
	require_once( $config['root'] . 'models/genres_model.php' );
	$Genres_model = new Genres_model;
	$genres = $Genres_model->get_genres();
	
	// load songs
	require_once( $config['root'] . 'models/songs_model.php' );
	$Songs_model = new Songs_model;
	$songs = $Songs_model->get_songs();
	
?>

<!-- page title -->
<div data-role="header">
	<h1>TBJ's Jams</h1>
</div>

<!-- content -->
<div data-role="content">
	
	<!-- lists -->
	<ul data-role="listview" data-inset="true">
		
		<!-- artist list -->
		<li>Songs by Artist
			<ul data-role="listview" data-inset="true" data-filter="true">
			<?php
				foreach( $artists as $artist )
					echo '<li><a href="' . $config['webroot'] . 'index.php/songs/list/artists/' . $artist['id'] . '/">' . $artist['name'] . '</a></li>';
			?>
			</ul>
		</li>
		
		<!-- genre list -->
		<li>Songs by Genre
			<ul data-role="listview" data-inset="true" data-filter="true">
			<?php
				foreach( $genres as $genre )
					echo '<li><a href="' . $config['webroot'] . 'index.php/songs/list/genres/' . $genre['id'] . '/">' . $genre['name'] . '</a></li>';
			?>
			</ul>
		</li>
	
		
		<!-- instrument list -->
		<li>Songs by Instrument
			<ul data-role="listview" data-inset="true" data-filter="true">
			<?php
				foreach( $instruments as $instrument )
					echo '<li><a href="' . $config['webroot'] . 'index.php/songs/list/instruments/' . $instrument['id'] . '/">' . $instrument['name'] . '</a></li>';
			?>
			</ul>
		</li>
		
		<!-- song list -->
		<li><a href="<?php echo $config['webroot']; ?>index.php/songs/list/">All Songs</li>
		
	</ul>
	
</div>