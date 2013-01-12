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
	
// Get input
$offset = get_input('offset', 0);

// Get the current page's owner
$page_owner = page_owner_entity();
if ($page_owner == false || is_null($page_owner)) {
	$page_owner = $_SESSION['user'];
	set_page_owner($_SESSION['guid']);
}
$area2 = elgg_view_title(elgg_echo('market:everyone:title'));

// Get a list of market posts
$area2 .= "<div id='blogs'>" . elgg_list_entities(array('type' => 'object', 'subtype' => 'market', 'limit' => 5, 'offset' => $offset, 'full_view' => FALSE)) . "<div class='clearfloat'></div></div>";

// Get categories, if they're installed
global $CONFIG;
$area3 = elgg_view('market/categorylist',array('baseurl' => $CONFIG->wwwroot . 'search/?subtype=market&tagtype=universal_marketcategories&tag=','subtype' => 'market', '0'));
		
//set a view to display a tag cloud
$area3 .= elgg_view("market/sidebarTagcloud");	

// Display them in the page
$body = elgg_view_layout("two_column_left_sidebar", '', $area1 . $area2, $area3);
		
// Display page
page_draw(elgg_echo('market:everyone'),$body);
		
?>
