<?php
/**
 * Object summary
 *
 * Sample output
 * <ul class="elgg-menu elgg-menu-entity"><li>Public</li><li>Like this</li></ul>
 * <h3><a href="">Title</a></h3>
 * <p class="elgg-subtext">Posted 3 hours ago by George</p>
 * <p class="elgg-tags"><a href="">one</a>, <a href="">two</a></p>
 * <div class="elgg-content">Excerpt text</div>
 *
 * @uses $vars['entity']    ElggEntity
 * @uses $vars['title']     Title link (optional) false = no title, '' = default
 * @uses $vars['metadata']  HTML for entity menu and metadata (optional)
 * @uses $vars['subtitle']  HTML for the subtitle (optional)
 * @uses $vars['tags']      HTML for the tags (optional)
 * @uses $vars['content']   HTML for the entity content (optional)
 */



$wiauction = $vars['entity'];
//$quote_id = $vars['quote_id'];
//$wiauction_status = $vars['wiauction_status'];

$title_link = elgg_extract('title', $vars, '');


if ($title_link === '') {
	if (isset($wiauction->title)) {
		$text = $wiauction->title;
	} else {
		$text = $wiauction->name;
	}
	$params = array(
		'text' => $text,
		'href' => $wiauction->getURL(),
		'is_trusted' => true,
	);
	$title_link = elgg_view('output/url', $params);
}

$metadata = elgg_extract('metadata', $vars, '');
$subtitle1 = elgg_extract('subtitle1', $vars, '');
$subtitle2 = elgg_extract('subtitle2', $vars, '');
$excerpt = elgg_extract("excerpt", $vars, "");
$content = elgg_extract('content', $vars, '');
$winner_html = elgg_extract('winner_html', $vars, '');
$rate_html = elgg_extract('rate_html', $vars, '');

$tags = elgg_extract('tags', $vars, '');
if ($tags !== false) {
	$tags = elgg_view('output/tags', array('tags' => $wiauction->tags));
}

if ($metadata) {
	echo $metadata;
}
if ($title_link) {
	echo "<h3>$title_link</h3>";
}
echo "<div class=\"elgg-wiauctions-subtext-1\">$subtitle1</div>";
echo "<div class=\"elgg-wiauctions-subtext-2\">$subtitle2</div>";

echo "<div class=\"elgg-wiauctions-excerpt\">$excerpt</div>";
//if wiauction is closed, print the rate button

if($winner_html){
	echo "<div class=\"elgg-wiauctions-winner\">";
	echo "<div id='win-text'>Winner:</div>";	
	echo $winner_html;
	echo "</div>";		
}

if($rate_html){
	echo "<div class=\"elgg-wiauctions-rate\">";
	echo $rate_html;
	echo "</div>";		
}



if (!elgg_in_context('widgets')) {
    echo $tags;
}

echo elgg_view('object/summary/extend', $vars);

if ($content) {
	echo "<div class=\"elgg-content\">$content</div>";
}
