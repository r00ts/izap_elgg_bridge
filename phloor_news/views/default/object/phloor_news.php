<?php
/**
 * View for phloor_news objects
 *
 * @package phloor_news
 */

$full = elgg_extract('full_view', $vars, FALSE);
$news = elgg_extract('entity', $vars, FALSE);

if (!$news) {
    return TRUE;
}

$owner = $news->getOwnerEntity();
$container = $news->getContainerEntity();
$categories = elgg_view('output/categories', $vars);
$excerpt = $news->excerpt;

$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$owner_link = elgg_view('output/url', array(
	'href' => "phloor_news/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$tags = elgg_view('output/tags', array('tags' => $news->tags));
$date = elgg_view_friendly_time($news->time_created);

// The "on" status changes for comments, so best to check for !Off
if ($news->comments_on != 'Off') {
    $comments_count = $news->countComments();
    //only display if there are commments
    if ($comments_count != 0) {
        $text = elgg_echo("comments") . " ($comments_count)";
        $comments_link = elgg_view('output/url', array(
			'href' => $news->getURL() . '#phloor_news-comments',
			'text' => $text,
			'is_trusted' => true,
        ));
    } else {
        $comments_link = '';
    }
} else {
    $comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'phloor_news',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
    $metadata = '';
}

if ($full) {

    $body = elgg_view('output/longtext', array(
		'value' => $news->description,
		'class' => 'phloor_news-post',
    ));

    // append image if existing
    if($news->hasImage()) {        
        $download_url = $news->getImageDownloadURL();

        $image = elgg_view('output/img', array(
 			'title' => $news->title,
	        'alt'   => "image:{$news->title}",
	        'class' => 'elgg-photo',
	        'src'   => $news->getThumbnailURL('medium'),
        ));

        $image_view = <<<HTML
		<div class="phloor-news-image">
			<a href="$download_url">$image</a>
		</div>
HTML;

        $body .= $image_view;
    }

    $params = array(
		'entity' => $news,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
    );
    $params = $params + $vars;
    $summary = elgg_view('object/elements/summary', $params);

    echo elgg_view('object/elements/full', array(
		'summary' => $summary,
		'icon' => $owner_icon,
		'body' => $body,
    ));

} else {
    // brief view
    if($news->hasImage()) {
        $icon = elgg_view_entity_icon($news, 'thumb');
    }
    else {
        $icon = $owner_icon;
    }

    $params = array(
		'entity' => $news,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
		'content' => $excerpt,
    );
    $params = $params + $vars;
    $list_body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($icon, $list_body);
}
