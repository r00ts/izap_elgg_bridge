<?php
/**
 * Elgg Bids Plugin
 * @package wiauctions
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Mark Kelly/Web Intelligence
 * @copyright Web Intelligence
 * @link www.webintelligence.ie
 * @version 1.8
 */

$currency = elgg_get_plugin_setting('wiauction_currency', 'wiauction');

$wibid = $vars['entity'];
                  
$wiauction = get_entity($wibid->getContainerGUID());
if(!$wiauction){		
	register_error(elgg_echo("wiauction:notfound"));
        forward();
}

//introducing 3rd value affect if statements
$full = elgg_extract('full_view', $vars, true);



$owner = $wibid->getOwnerEntity();

//get the days left
$expiry_date = $wiauction->expiry_date;


	
	if ((elgg_get_logged_in_user_guid()==$wibid->owner_guid)||elgg_is_admin_logged_in()) {
		if(wi_get_entity_status($wiauction->getGUID())=="active" || wi_get_entity_status($wiauction->getGUID())=="expired"){
			$metadata = elgg_view_menu('wibid', array(
				'entity' => $vars['entity'],
				'handler' => 'bid',
				'sort_by' => 'priority',
				'class' => 'elgg-menu-hz',
			));	
		}
	}


        
    $amount = $wibid->amount;
    


if(!$full){
    
	
    $date = elgg_view_friendly_time($wibid->time_created);
    $owner = $wibid->getOwnerEntity();
    $owner_link = elgg_view('output/url', array(
            'href' => "profile/$owner->username",
            'text' => $owner->name,
            'class' => 'wibid-owner-title',
    ));
    $owner_icon = elgg_view_entity_icon($owner, 'small');

    
    if(elgg_get_page_owner_guid()==$vars['user']->guid){
          if(wi_get_entity_status($wiauction->getGUID())=="active" || wi_get_entity_status($wiauction->getGUID())=="expired"){
            $wibidbutton = elgg_view("output/url", array(
                    "href" => "action/wibid/accept?wibid_id=".$wibid->getGUID()."&wiauction_id=".$wiauction->getGUID(),
                    "text" => elgg_echo("wibid:acceptbid"),
                    "is_action" => true
                ));
          }
    }
    


//-------------------------------------------------------------------------------------------    
    echo '<div class="wibidlist">';
    echo '<div style="width:40px; float:left">'.$owner_icon.'</div>';
    echo '<div class="wibid-owner-name-container">'.$owner_link."<br/>".$date.'</div>';
    echo '<div class="wibidlist-location">'."<font style=\"font-size: 0.8em\"> </font>".$wibid->location.'</div>';
    echo '<div class="wibidlist-price"><font style=\"font-size: 0.8em\">'.$currency.' </font>'.$wibid->amount.'</div>';
    if($wiauction->owner_guid==elgg_get_logged_in_user_guid() || elgg_is_admin_logged_in() || $wibid->owner_guid==elgg_get_logged_in_user_guid()){
    echo '<div class="wibidlist-detail-button make-it-button">'.$wibidbutton.'</div>';
    }
    echo '<div style="clear: both"></div>';
    echo '</div>';

//-------------------------------------------------------------------------------------------    


   	
}else{
	
    //views of wibid under my bid

    $date = elgg_view_friendly_time($wibid->time_created);
    $owner_icon = elgg_view_entity_icon(get_entity($owner->guid), 'small');
    //no need for following
    $owner_link = elgg_view('output/url', array(
        'href' => "auction/owner/$owner->username",
        'text' => $owner->name,
    ));


            $wiauction_title = elgg_view('output/url', array(
                    'href' => $wiauction->getURL()."/bid",
                    'text' => $wiauction->title,
                    'class' => 'wibid-owner-title',
            ));
            
            $wibid_details = elgg_view('output/url', array(
                    'href' =>  $wiauction->getURL(),
                    'text' => elgg_echo('wiauction:goto'),
            ));

            
    //-------------------------------------------------------------------------------------------    
    $list_body .= '<div class="wibidlist">';

    $list_body .=  '<div class="wibid-details"><b>'.elgg_echo("wibid:placed").':</b><br />'.$wiauction_title.'</div>';
    
    $list_body .=  '<div class="wibid-details">'.$date.'</div>';  
    
    $list_body .=  '<div class="wibid-details">'.$wibid_details.'</div>';    

   if(wi_get_entity_status($wiauction->getGUID())=="expired"){
    $list_body .=  '<div class="wibid-details"><b>'.elgg_echo("wiauctions:expiry").':</b> Expired</div>';   	
   }
   elseif(wi_get_entity_status($wiauction->getGUID())=="closed"){
    $list_body .=  '<div class="wibid-details"><b>'.elgg_echo("wiauctions:expiry").':</b> Closed</div>';   	   	
   }
   elseif(wi_check_if_today($expiry_date)){
   	$list_body .=  '<div class="wibid-details"><b>'.elgg_echo("wiauctions:expiry").':</b> Today</div>';   	
   }
   else{
   	$list_body .=  '<div class="wibid-details"><b>'.elgg_echo("wiauctions:expiry").':</b> '.$expiry_date.'</div>';   	   	
   }


 
    $list_body .=  "<div class='wibid-details'>{$currency}".$amount."</div>";    
	
	$list_body .=  '<div class="wibid-details">'.$metadata.'</div>';    
    
    $list_body .=  '<div style="clear: both"></div>';	  
    $list_body .=  '</div>';
    


    echo $list_body;
    


	}	

	

