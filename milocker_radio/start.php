<?php
		
	 /**
	 * Milocker Radio Widget
	 * Based upon Elgg 1.8 widgets. 
	 * @package Elgg
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */
	 
	 // Get more stuffs @ www.swsocialweb.com/shop
		function radio_init() 
		{
		global $CONFIG;
		
		}
		
	register_elgg_event_handler('init','system','radio_init');
	// Shares widget
		add_widget_type('radio',elgg_echo("Radio"),elgg_echo("This is a Music widget that will find any song for you."));

?>