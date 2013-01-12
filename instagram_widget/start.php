<?php

elgg_register_event_handler('init', 'system', 'instagram_widget_init');
 
    function instagram_widget_init()
    {
		if (elgg_get_plugin_setting('access_token', 'instagram_widget') == "") {
			
		}
		else {
			elgg_register_widget_type('instagram_widget', elgg_echo('Instagram Feed'), elgg_echo('Show your Instagram feed.'));
		}
    }
	
