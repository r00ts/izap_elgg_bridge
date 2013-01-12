<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */


$full = elgg_extract('full_view', $vars, FALSE);
$wijobpost = $vars['entity'];

$currency = get_job_quote_currency('wiJobGPL');

$budget = $wijobpost->budget;


if($budget==""){
	$budget = "<b>Budget:</b> Not specified";
}
else{
	$budget = $currency.$budget;
}

    $files = elgg_get_entities_from_relationship(array(
	'relationship_guid' => $wijobpost->getGUID(),
        'relationship' => 'wijob_file'
	));
	
	//there should only be one
	foreach($files as $file){

		$has_files = true;
		$vars['guid'] = $file->guid;
		$vars['size'] = "small";
		$vars['href'] = 'mod/file/download.php?file_guid='.$file->getGUID();
				
		$file_icon = elgg_view("icon/file", $vars);		

		$file_url = elgg_view('output/url', array(
			'href' => 'mod/file/download.php?file_guid='.$file->getGUID(),
			'text' => elgg_echo('file:download'),
			'class' => 'elgg-button-action'
		));	
			
		$uploaded .= "<b>Extra Downloads:</b>";
		$uploaded .= "<div id='file-container'>";
	    $uploaded .= "<div id='file-image'>";
	    	$uploaded .= $file_icon;
	    	$uploaded .="</div>";
	    	$uploaded .= "<div id='file-url'>";
	    	$uploaded .= $file_url;
	    $uploaded .= "</div>";
	    $uploaded .= "</div>";
	    $uploaded .= "<div id='clear'></div>";
		
	}

if (!$wijobpost) {
	return TRUE;
}

$owner = $wijobpost->getOwnerEntity();

$vars['subtype'] = 'wijob';

$categories = wi_get_entity_categories_links($wijobpost);

if(!$categories){$categories = 'na';} 
$categories = "<b>" . elgg_echo('category') . ":</b> " . $categories;


$owner_icon = elgg_view_entity_icon($owner, 'tiny');


$tags = elgg_view('output/tags', array('tags' => $wijobpost->tags));
$date = elgg_view_friendly_time($wijobpost->time_created);


 $num_wiquotes = wi_get_num_wiquotes($wijobpost->getGUID());
 
 if($num_wiquotes>0){
     if(elgg_get_logged_in_user_guid()==$wijobpost->getOwnerGUID()){
 	$num_wiquotes = elgg_view("output/url", array(
                                                'text' => $num_wiquotes,
                                                'href' => $wijobpost->getURL()
 	));
 }	
}



if((wi_get_entity_status($wijobpost->getGUID())=="closed" || wi_get_entity_status($wijobpost->getGUID())=="completed") && $wijobpost->getOwnerGUID()==elgg_get_logged_in_user_guid())
{
	//get the winner
	$options = array(
		"relationship" => "wijob_wiquote_win",
		'relationship_guid' => $wijobpost->getGUID(),
	);
	
	$wiquote = elgg_get_entities_from_relationship($options);

	$wiquote_guid = $wiquote[0]->getGUID();
	$wiquote = get_entity($wiquote_guid);
	$winner = get_entity($wiquote->getOwnerGUID());
	
	$winner_html = elgg_view_entity_icon($winner, 'small');
	

	if(wi_get_entity_status($wijobpost->getGUID())=="closed"){
		$link = elgg_get_site_url()."mod/wiRating/graphics/rating_w.png";
			$rate_html = elgg_view('output/url', array(
										'href' => "ratings/add/$wiquote_guid",
										'title' => "Rate the winner!",
										'text' => '<img src="'.$link.'">',  
											));	  
	}	
}
$test = 10;
	if ((elgg_get_logged_in_user_guid()==$wijobpost->owner_guid)||elgg_is_admin_logged_in()) {
		$metadata = elgg_view_menu('entity', array(
			'entity' => $vars['entity'],
			'handler' => 'wijob',
			'sort_by' => 'priority',
			'class' => 'elgg-menu-hz',
		));
                
	}


// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if(elgg_in_context("front")){
    
	
	$subtitle = "{$categories}<br>";	
        $subtitle .= "$date";
	$subtitle .= "<b>" . elgg_echo('wijob:wiquotes') . ":</b>(".$num_wiquotes.")</br>";
        
	
	$params = array(
		'entity' => $wijobpost,
		'header' => $header,
		'subtitle' => $subtitle,
		'tags' => $tags,
	);
        
	$params = $params + $vars;
	
	$list_body = elgg_view('object/elements/wijobummary', $params);
	$owner_icon = elgg_view_entity_icon(get_entity($wijobpost->getOwnerGUID()), 'small');
	echo elgg_view_image_block($owner_icon, $list_body);
	
}elseif ($full && !elgg_in_context('gallery')) {

	$header = elgg_view_title($wijobpost->title);
	
	$body .= "<div class='wijob-attr'><b>Budget:</b> ".$budget." $budget_type</div>";
	$body .= "<div class='clearfix'></div>";
	$body .= elgg_view('output/longtext', array(
		'value' => $wijobpost->description,
		'class' => 'wijob-post',
	));
	
	if($has_files){	
		$body .= $uploaded;
    }	
    
    $body .= "<div id='clear'></div>";

	 $posted = "<b>Posted:</b> ".$date;
	//get the file
	
	$subtitle = $categories."<br />".$posted;


	$params = array(
		'entity' => $wijobpost,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);
	
	$wijob_info = elgg_view_image_block($owner_icon, $list_body);


	$wiquotes = view_wijob_wiquotes($wijobpost);

        
       

	echo <<<HTML
$header
$wijob_info
$body
$wiquotes
HTML;

}  else {
    


	$subtitle .= "{$categories}<br>";	
	$subtitle .= "<b>" . elgg_echo('wijob:wiquotes') . ":</b>(".$num_wiquotes.")</br>";
	$subtitle .= $date;
        
        $details = $budget."<br />";
	$details .= "<b>Snippet: </b>".elgg_get_excerpt($wijobpost->description, 80)."..";
	
	$params = array(
		'entity' => $wijobpost,
		'header' => $header,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'details' => $details,
		'tags' => $tags,
		'winner_html' => $winner_html,
		'rate_html' => $rate_html,
	);
        
	$params = $params + $vars;
	
	
	$list_body = elgg_view('object/elements/wijobsummary', $params);
	$owner_icon = elgg_view_entity_icon(get_entity($wijobpost->owner_guid), 'small');
	echo elgg_view_image_block($owner_icon, $list_body);


}

