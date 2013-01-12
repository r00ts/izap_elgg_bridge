<?php
/**
 * Elgg wiauctions Plugin
 * @package wiauctions
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Mark Kelly/Web Intelligence
 * @copyright Web Intelligence
 * @link www.webintelligence.ie
 * @version 1.8
 */

$full = elgg_extract('full_view', $vars, FALSE);
$wiauctionpost = $vars['entity'];


$currency = elgg_get_plugin_setting('wiauction_currency', 'wiauction');


if (!$wiauctionpost) {
	return TRUE;
}

$header = elgg_view_title($wiauctionpost->title);
$owner = $wiauctionpost->getOwnerEntity();

$vars['subtype'] = 'wiauction';

$categories = wi_get_entity_categories_links($wiauctionpost);
if(!$categories){$categories = 'na';} 
$categories = "<b>" . elgg_echo('category') . ":</b> " . $categories;

$excerpt = elgg_get_excerpt($wiauctionpost->description);

$owner_link = elgg_view('output/url', array(
	'href' => $owner->getURL(),
	'text' => $owner->name,
));
$author_text = elgg_echo('byline', array($owner_link));

//$counties = get_skill_counties($wiauctionpost->getGUID());
$location = $wiauctionpost->location;

$tags = elgg_view('output/tags', array('tags' => $wiauctionpost->tags));
$date = elgg_view_friendly_time($wiauctionpost->time_created);

//if(isset($wiauctionpost->custom) && elgg_get_plugin_setting('wiauctions_custom', 'wiauctions') == 'yes'){
	//$custom = "<br><b>" . elgg_echo('wiauctions:custom:text') . " : </b>" . elgg_echo($wiauctionpost->custom);
//}

$status = wi_get_entity_status($wiauctionpost->getGUID());

 $num_wibids = wi_get_num_wibids($wiauctionpost->getSubtype(), $wiauctionpost->getGUID(), $status);
 
 if($num_wibids>0){
     if(elgg_get_logged_in_user_guid()==$wiauctionpost->getOwnerGUID()){
 	$num_wibids = elgg_view("output/url", array(
                                                'text' => $num_wibids,
                                                'href' => $wiauctionpost->getURL()
 	));
 }	
}

$expiry_date = $wiauctionpost->expiry_date;

$expires = wi_get_expiry_diff($expiry_date);

if($expires['days']>0){
 $expires_label = $expires['days']." days ";   
}
if($expires['hours']>0){
 $expires_label .= $expires['hours']." hours";       
}




if((wi_get_entity_status($wiauctionpost->getGUID())=="closed") && $wiauctionpost->getOwnerGUID()==elgg_get_logged_in_user_guid())
{
	//get the winner
	$options = array(
		"relationship" => "wiauction_wibid_win",
		'relationship_guid' => $wiauctionpost->getGUID(),
	);
	
	$wibid = elgg_get_entities_from_relationship($options);

	$wibid_guid = $wibid[0]->getGUID();
	$wibid = get_entity($wibid_guid);
	$winner = get_entity($wibid->getOwnerGUID());
	
	$winner_html = elgg_view_entity_icon($winner, 'small');
	

	
}



	if ((elgg_get_logged_in_user_guid()==$wiauctionpost->owner_guid)||elgg_is_admin_logged_in()) {
		$metadata = elgg_view_menu('wiauction', array(
			'entity' => $vars['entity'],
			'handler' => 'auction',
			'sort_by' => 'priority',
			'class' => 'elgg-menu-hz',
		));
	}

//$subtitle = "<p>$author_text $date $comments_link</p>";
//$subtitle .= $wiauctioncategories;

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if(elgg_in_context("front")){
    
	
	$subtitle1 = "{$categories}<br>";	
	$subtitle1 .= "<b>".elgg_echo("wiauctions:expires").": </b>".$expires_label."<br />";
        $subtitle1 .= "$date";

	$subtitle2 = "<b>".elgg_echo("wiauction:location").":</b> $location<br/>";
	$subtitle2 .= "<b>" . elgg_echo('wiauctions:wibid') . ":</b>(".$num_wibids.")</br>";
        
	
	$params = array(
		'entity' => $wiauctionpost,
		'header' => $header,
		'subtitle1' => $subtitle1,
		'subtitle2' => $subtitle2,
		'tags' => $tags,
	);
        
	$params = $params + $vars;
	
	$list_body = elgg_view('object/elements/wiauctionsummary', $params);

	echo elgg_view_image_block($wiauction_img, $list_body);
	
}elseif ($full && !elgg_in_context('gallery')) {


    $body = "<table border='0' width='100%'><tr>";
    $body .= "<td width='220px'><center>";
    $body .= elgg_view('output/url', array(
            'href' => elgg_get_site_url() . "mod/wiAuction/viewimage.php?wiauctionguid={$wiauctionpost->guid}",
            'text' => elgg_view('wiauction/thumbnail', array('wiauctionguid' => $wiauctionpost->guid, 'size' => 'large', 'tu' => $tu)),
            'class' => "elgg-lightbox",
            ));
    $body .= "</center></td><td>";
    $body .= elgg_view('output/longtext', array('value' => $wiauctionpost->description));
    $body .= "<br /><br />";
    $body .= "<strong>".elgg_echo('wiauction:location').":</strong> ".$wiauctionpost->location;
    $body .= "</td></tr><tr>";
    $body .= "<td><center>";
    $body .= "<span class='wiauction_pricetag'><b>" . elgg_echo('wiauctions:guide') . "</b> {$currency}{$wiauctionpost->guide}</span>";
    $body .= "</center></td></tr></table>";
		
    
    $body .= "<div id='clear'></div>";
    if(wi_get_entity_status($wiauctionpost->getGUID())=="closed"){
    	$body .= "<div id='wiauction-status'>bids closed as auction has been closed</div>";
    }
    elseif (wi_get_entity_status($wiauctionpost->getGUID())=="expired"){
        if(wi_check_user_wibid_entity($wiauctionpost->getGUID())){
    	$body .= "<div id='wiauction-status'>Although this auction has past its expiry date, you may edit your bid</div>";            
        }
        else{
    	$body .= "<div id='wiauction-status'>Currently, bids are closed as wiauction has past its expiry date. Bids will be allowed when auction is renewed</div>";
        }
    }
    elseif(wi_get_entity_status($wiauctionpost->getGUID())=="cancelled"){
    	$body .= "<div id='wiauction-status'>Bids closed as auction has been cancelled</div>";
    }
	
	//get the file
	
	$subtitle = "{$categories}<br>{$author_text} {$date}";


	$params = array(
		'entity' => $wiauctionpost,
		'header' => $header,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
	);
	//$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);
	
        $owner_icon = elgg_view_entity_icon($owner, 'small');
	$wiauctions_info = elgg_view_image_block($owner_icon, $list_body);

	$wibids = view_wiauction_wibid($wiauctionpost);


	echo <<<HTML
$wiauctions_info
$body
$wibids
HTML;

}  else {


	$wiauction_img = elgg_view('output/url', array(
			'href' => "auction/view/{$wiauctionpost->guid}/" . elgg_get_friendly_title($wiauctionpost->title),
			'text' => elgg_view('wiauction/thumbnail', array('wiauctionguid' => $wiauctionpost->guid, 'size' => 'small', 'tu' => $tu)),
			));
	
	
	$subtitle1 = "{$categories}<br>";	
	$subtitle1 .= "<b>".elgg_echo("wiauctions:expires").": </b>".$expires_label."<br />";
	$subtitle1 .= "<b>" . elgg_echo('wibid:wibid') . ":</b>(".$num_wibids.")</br>";
        $subtitle1 .= $author_text;
	
	$subtitle2 = "<b>".elgg_echo("wiauction:location").":</b> $location<br/>";
	$subtitle2 .= "<b>".elgg_echo("wiauctions:guide")."</b> ".$currency.$wiauctionpost->guide;
	$excerpt = $date;
	
	$params = array(
		'entity' => $wiauctionpost,
		'header' => $header,
		'metadata' => $metadata,
		'subtitle1' => $subtitle1,
		'subtitle2' => $subtitle2,
		'excerpt' => $excerpt,
		'tags' => $tags,
		'winner_html' => $winner_html,
		//'rate_html' => $rate_html,
	);
        
	$params = $params + $vars;
	
	
	$list_body = elgg_view('object/elements/wiauctionsummary', $params);
	
	echo elgg_view_image_block($wiauction_img, $list_body);


}

