<?php
/**
 * phloor_news sidebar
 *
 * @package phloor_news
 */

// fetch & display latest comments
if ($vars['page'] == 'all') {
	echo elgg_view('page/elements/comments_block', array(
		'subtypes' => 'phloor_news',
	));
} elseif ($vars['page'] == 'owner') {
	echo elgg_view('page/elements/comments_block', array(
		'subtypes' => 'phloor_news',
		'owner_guid' => elgg_get_page_owner_guid(),
	));
}

// only users can have archives at present
if (elgg_instanceof(elgg_get_page_owner_entity(), 'user')) {
	echo elgg_view('phloor_news/sidebar/archives', $vars);
}

if ($vars['page'] != 'friends') {
	echo elgg_view('page/elements/tagcloud_block', array(
		'subtypes' => 'phloor_news',
		'owner_guid' => elgg_get_page_owner_guid(),
	));
}
