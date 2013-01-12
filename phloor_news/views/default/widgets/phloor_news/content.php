<?php
/**
 * User phloor_news widget display view
 */

$num = $vars['entity']->num_display;

$options = array(
	'type' => 'object',
	'subtype' => 'phloor_news',
	'container_guid' => $vars['entity']->owner_guid,
	'limit' => $num,
	'full_view' => FALSE,
	'pagination' => FALSE,
);
$content = elgg_list_entities($options);

echo $content;

if ($content) {
	$phloor_news_url = "phloor_news/owner/" . elgg_get_page_owner_entity()->username;
	$more_link = elgg_view('output/url', array(
		'href' => $phloor_news_url,
		'text' => elgg_echo('phloor_news:morephloor_newss'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('phloor_news:nophloor_newss');
}
