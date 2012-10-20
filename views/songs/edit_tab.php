<?php
	
	// load song ( if one is specified )
	if( isset( $uri_parameters[2] ) ) {		
		require_once( $config['root'] . 'models/song_model.php' );		
		$Song = new Song_model( $uri_parameters[2] );
	} else {
		die( "ERROR: You must specify a song id in the url." );
	}

	// define page title
	$title = 'Edit Tab for: ' . $Song->get_name();

?>


<!-- page title -->
<div data-role="header">
	<h1><?php echo $title; ?></h1>
</div>

<!-- content -->
<div data-role="content">

	<!-- first line -->
	<select name="select-choice-min" id="select-choice-min" data-mini="true" data-theme="b">
	   <option value="">New Song Section?</option>
	   <option value="instrumental">Instrumental ( intro / solo / finish )</option>
	   <option value="verse">Verse</option>
	   <option value="chorus">Chorus</option>
	   <option value="bridge">Bridge</option>
	</select>
	<input class="tab" type="text" name="name" id="basic" value="" placeholder="chords" />
	<input class="lyrics" type="text" name="name" id="basic" value="" placeholder="lyrics" />

	<!-- second line -->
	<select name="select-choice-min" id="select-choice-min" data-mini="true" data-theme="b">
	   <option value="">New Song Section?</option>
	   <option value="instrumental">Instrumental ( intro / solo / finish )</option>
	   <option value="verse">Verse</option>
	   <option value="chorus">Chorus</option>
	   <option value="bridge">Bridge</option>
	</select>
	<input class="tab" type="text" name="name" id="basic" value="" placeholder="chords" />
	<input class="lyrics" type="text" name="name" id="basic" value="" placeholder="lyrics" />
	
</div> <!-- end content div -->