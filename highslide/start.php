<?php
	/**
	 * Highslide integration for TidyPics 1.8.0rc1 and Elgg 1.8
	 *
	 * Package original by Team Webgalli, modified to provide compaibility with latest versions of software
	 * 
	 */

	function highslide_init() 
	{
		global $CONFIG;

		// Extend CSS
		elgg_extend_view('css', 'highslide/css');
		
		// Highslide hook
		elgg_extend_view('metatags','highslide/metatags');
	}

	// Make sure highslide_init is called on initialisation
	register_elgg_event_handler('init','system','highslide_init');
?>