<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

$wijob = $vars['entity'];


$title_link = elgg_extract('title', $vars, '');


if ($title_link === '') {
	if (isset($wijob->title)) {
		$text = $wijob->title;
	} else {
		$text = $wijob->name;
	}
	$params = array(
		'text' => $text,
		'href' => $wijob->getURL(),
		'is_trusted' => true,
	);
	$title_link = elgg_view('output/url', $params);
}

$metadata = elgg_extract('metadata', $vars, '');
$subtitle = elgg_extract('subtitle', $vars, '');
$details = elgg_extract("details", $vars, "");
$content = elgg_extract('content', $vars, '');
$winner_html = elgg_extract('winner_html', $vars, '');
$rate_html = elgg_extract('rate_html', $vars, '');



$tags = elgg_extract('tags', $vars, '');
if ($tags !== false) {
	$tags = elgg_view('output/tags', array('tags' => $wijob->tags));
}

if ($metadata) {
	echo $metadata;
}
if ($title_link) {
	echo "<h3>$title_link</h3>";
}
echo "<div class=\"elgg-wijob-subtext-1\">$subtitle</div>";


echo "<div class=\"elgg-wijob-excerpt\">$details</div>";
//if wijob is closed, print the rate button

if($winner_html){
	echo "<div class=\"elgg-wijob-winner\">";
	echo "<div id='win-text'>Winner:</div>";	
	echo $winner_html;
            if($rate_html){
                    //echo "<div class=\"elgg-wijob-rate\">";
                    echo $rate_html;
                    //echo "</div>";		
            }        
	echo "</div>";		
}





if (!elgg_in_context('widgets')) {
    echo $tags;
}

echo elgg_view('object/summary/extend', $vars);

if ($content) {
	echo "<div class=\"elgg-content\">$content</div>";
}
