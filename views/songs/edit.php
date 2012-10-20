<?php
	
	// get post data from form submission
	if( isset( $_POST['submit'] ) )
	{
	
		// *** process form submission
	
	}
	
	// load song ( if one is specified )
	if( isset( $uri_parameters[2] ) ) {		
		require_once( $config['root'] . 'models/song_model.php' );		
		$Song = new Song_model( $uri_parameters[2] );
	} else {
		die( "ERROR: You must specify a song id in the url." );
	}
	
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
	
	// set page title
	$title = 'Edit Song: ' . $Song->get_name();

?>

<!-- page title -->
<div data-role="header">
	<h1><?php echo $title; ?></h1>
</div>

<!-- content -->
<div data-role="content">
	
	<form action="" method="post">
		
		<!-- name -->
		<div data-role="fieldcontain">
			<label for="name">Name:</label>
			<input type="text" name="name" id="name" value="<?php echo $Song->get_name(); ?>" />
		</div>
		
		<!-- url -->
		<div data-role="fieldcontain">
			<label for="url">URL:</label>
			<input type="text" name="url" id="url" value="<?php echo $Song->get_url(); ?>" />
		</div>
		
		<!-- instruments -->
		<div data-role="fieldcontain">
			<fieldset data-role="controlgroup">
				<legend>Genres:</legend>
				<?php
				
					$selected_genres = $Song->get_genres( TRUE );					
					foreach( $genres as $genre ) {
					
						if( in_array( $genre['name'], $selected_genres ) )
							$selected = 'checked="checked"';
						else
							$selected = '';
					
						echo '<input type="checkbox" ' . $selected . ' name="' . $genre['name'] . '" id="' . $genre['name'] . '" class="custom" />';
						echo '<label for="' . $genre['name'] . '">' . $genre['name'] . '</label>';
					}
					
				?>
			</fieldset>
		</div>
		
		<button type="submit" name="submit" value="submit" data-theme="b">Save Edits</button>
		
	</form>
	
	<a href="<?php echo $config['webroot']; ?>index.php/songs/profile/<?php echo $Song->get_id(); ?>/" data-role="button">Cancel - Back to Song Profile</a>
	
</div>