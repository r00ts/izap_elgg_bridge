<?php
elgg_register_event_handler('init', 'system', 'easy_theme_slide_init');

function easy_theme_slide_init() {
        elgg_extend_view('css/elgg', 'easytheme_slide/css');
	elgg_unregister_menu_item('topbar', 'elgg_logo');

}

?>
