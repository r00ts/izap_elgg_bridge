<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

// Load Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
gatekeeper();
		
// Get the current page's owner
$page_owner = page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	$page_owner = $_SESSION['user'];
	set_page_owner($_SESSION['guid']);
}
		
// Get the post, if it exists
$marketpost = (int) get_input('marketpost');
if ($post = get_entity($marketpost)) {
			
	if ($post->canEdit()) {
				
		$area2 = elgg_view_title(elgg_echo('market:editpost'));
		$area2 .= elgg_view("market/forms/edit", array('entity' => $post));
		$body = elgg_view_layout("two_column_left_sidebar", $area1, $area2);
				
	}
			
}
		
// Display page
page_draw(sprintf(elgg_echo('market:editpost'),$post->title),$body);
		
?>
