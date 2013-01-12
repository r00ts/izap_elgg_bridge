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
	 
	 // Load Elgg engine
	 	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	 
	 // Get the current page's owner
		$page_owner = page_owner_entity();
		if ($page_owner === false || is_null($page_owner)) {
			$page_owner = $_SESSION['user'];
			set_page_owner($_SESSION['guid']);
		}
	
	// Display table
	
	
?>