<?php
/**
 * Elgg WI Quotes vGPL Plugin
 * @package WI Job/Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */



// we want css classes to use dashes
$vars['name'] = preg_replace('/[^a-z0-9\-]/i', '-', $vars['name']);
$headers = elgg_extract('show_section_headers', $vars, false);
$item_class = elgg_extract('item_class', $vars, '');

$class = "elgg-menu elgg-menu-entity";
if (isset($vars['class'])) {
	$class .= " {$vars['class']}";
}


foreach ($vars['menu'] as $section => $menu_items) {
	echo elgg_view('navigation/menu/elements/section', array(
		'items' => $menu_items,
		'class' => "$class elgg-menu-entity-$section",
		'section' => $section,
		'name' => $vars['name'],
		'show_section_headers' => $headers,
		'item_class' => $item_class,
	));
}
