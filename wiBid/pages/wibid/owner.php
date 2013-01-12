<?php
/**
 * Elgg Bids Plugin
 * @package Auctions
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Mark Kelly/Web Intelligence
 * @copyright Web Intelligence
 * @link www.webintelligence.ie
 * @version 1.8
 */

		
// Get input
$offset = get_input('offset', 0);
$active = get_input('active');

$page_owner = elgg_get_page_owner_entity();

//set wibid title
if ($page_owner->getGUID() == elgg_get_logged_in_user_guid()) {
	$title = elgg_echo('wibid:your:title');
} else {
	$title = sprintf(elgg_echo('wibid:user'),$page_owner->name);
}

$vars['filter_override'] = elgg_view("page/layouts/content/activefilter", $vars);
	
$metadata =  array('active' => $active);
		
// Get a list of wibid posts
$content = elgg_list_entities_from_metadata(array(
    'type' => 'object', 
    'subtype' => 'wibid', 
    'container_guid' => page_owner(), 
    'limit' => 5, 
    'offset' => $offset, 
    'full_view' => FALSE, 
    'view_type_toggle' => FALSE, 
    'metadata' => $metadata));

if (empty($content)) {
    
        echo <<<HTML
    <script language="javascript">confirm("here")</script>
HTML;
	$content = elgg_echo('wibid:none:found');
}

// Get categories, if they're installed
$sidebar = elgg_view_module('featured',  elgg_echo("wibid:categories"), elgg_view('wibid/categorylist'));
		
//set a view to display a tag cloud
$sidebar .= elgg_view("wibid/sidebarTagcloud");	

$params = array(
		'filter_context' => 'mine',
		'content' => $content,
		'title' => $title,
		'sidebar' => $sidebar,
		'filter_override' => $vars['filter_override'],
		);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
