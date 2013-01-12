<?php
/**
 * Elgg Auctions Plugin
 * @package Auctions
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Mark Kelly/Web Intelligence
 * @copyright Web Intelligence
 * @link www.webintelligence.ie
 * @version 1.8
 */

load_wi_framework();
load_wi_framework('relationship');
//the page owner
$owner = get_user($vars['entity']->owner_guid);

//the number of files to display
$num = (int) $vars['entity']->num_display;
if (!$num) {
	$num = 4;
}		
	
	$options = array(
		'relationship' => 'active_wiauction',
		'relationship_guid' => $owner->guid,
                'limit' => $num,
	);	
$wiauctionsposts = elgg_get_entities_from_relationship($options);

echo '<ul class="elgg-list">';		
// display the wiauctionsposts, if there are any
if (is_array($wiauctionsposts) && sizeof($wiauctionsposts) > 0) {

	if (!$size || $size == 1){
		foreach($wiauctionsposts as $wiauction) {
			//get expiry date
			$expiry_date = $wiauction->expiry_date;
			if(wi_check_if_today($expiry_date)){
				$expiry_date = "today";
			}	
			
			//get number of wibids
			 $num_wibids = wi_get_num_wibids($wiauction->getSubtype(), $wiauction->guid);		
				
			$vars['entity'] = $wiauction;
                        $vars['subtype']="wiauction";
                        
			$categories = wi_get_entity_categories_links($wiauction);
			if(!$categories){$categories = 'na';} 
			$category = "<b>" . elgg_echo('wiauctions:category') . ":</b> " . $categories;
			
			echo "<li class=\"pvs\">";
			$subtitle1 = "{$category}<br>";	
			$subtitle1 .= "<b>".elgg_echo("wiauctions:expires").": </b>".$expiry_date."<br />";
			$subtitle1 .= "<b>" . elgg_echo('wiauctions:wibid') . ":</b>(".$num_wibids.")</br>";
		
			
			$params = array(
				'entity' => $wiauction,
				'subtitle' => $subtitle1,
				'tags' => $tags,
			);
		        
			$params = $params + $vars;
			
			
			$list_body = elgg_view('object/elements/summary', $params);
			$owner_icon = elgg_view_entity_icon(get_entity($wiauction->owner_guid), 'small');
			echo elgg_view_image_block($owner_icon, $list_body);
			echo "</li>";
		}
			
	}
	echo "</ul>";
        
        	if(elgg_is_logged_in()){
			if(elgg_get_page_owner_guid()==elgg_get_logged_in_user_guid()){
			$link = elgg_view("output/url", array(
										'text' => elgg_echo('wiauctions:widget:viewall', array(elgg_get_page_owner_entity()->name."'s")),
										'href' => "auction/owner/".elgg_get_page_owner_entity()->username."/active"	
									));	
		}
		else{
			$link = elgg_view("output/url", array(
										'text' => elgg_echo('wiauctions:widget:viewall', array(elgg_get_page_owner_entity()->name."'s")),
										'href' => 'auction/by/'.elgg_get_page_owner_entity()->username	
									));				
		}		
	}
	else{
		$link = elgg_view("output/url", array(
									'text' => elgg_echo('wiauctions:widget:viewall', array(elgg_get_page_owner_entity()->name."'s")),
									'href' => 'auction/by/'.elgg_get_page_owner_entity()->username
								));				
	}
				
	echo "<div class=\"contentWrapper\">$link</div>";
        

}

