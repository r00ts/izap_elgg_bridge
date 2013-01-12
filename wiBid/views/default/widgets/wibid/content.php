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

//the page owner
$owner = get_user($vars['entity']->owner_guid);

//the number of files to display
$num = (int) $vars['entity']->num_display;
if (!$num) {
	$num = 4;
}		
		
$posts = elgg_get_entities(array('type'=>'object','subtype'=>'bids', 'owner_guid' => $owner->guid, 'limit'=>$num));

echo '<ul class="elgg-list">';		
// display the posts, if there are any
if (is_array($posts) && sizeof($posts) > 0) {

	if (!$size || $size == 1){
		foreach($posts as $post) {
			echo "<li class=\"pvs\">";
			$category = "<b>" . elgg_echo('bids:category') . ":</b> " . elgg_echo($post->bidscategory);
			$comments_count = $post->countComments();
			$text = elgg_echo("comments") . " ($comments_count)";
			$comments_link = elgg_view('output/url', array(
						'href' => $post->getURL() . '#bids-comments',
						'text' => $text,
						));
			$bids_img = elgg_view('output/url', array(
						'href' => "bids/view/{$post->guid}/" . elgg_get_friendly_title($post->title),
						'text' => elgg_view('bids/thumbnail', array('bidsguid' => $post->guid, 'size' => 'small')),
						));

			$subtitle = "{$category}<br><b>" . elgg_echo('bids:price') . ":</b> {$post->price}";
			$subtitle .= "<br>{$author_text} {$date} {$comments_link}";
			$params = array(
				'entity' => $post,
				'metadata' => $metadata,
				'subtitle' => $subtitle,
				'tags' => $tags,
				'content' => $excerpt,
			);
			$params = $params + $vars;
			$list_body = elgg_view('object/elements/summary', $params);
			echo elgg_view_image_block($bids_img, $list_body);
			echo "</li>";
		}
			
	}
	echo "</ul>";
	echo "<div class=\"contentWrapper\"><a href=\"" . $CONFIG->wwwroot . "pg/bids/" . $owner->username . "\">" . elgg_echo("bids:widget:viewall") . "</a></div>";

}

