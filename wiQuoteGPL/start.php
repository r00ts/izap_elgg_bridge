<?php

elgg_register_event_handler('init', 'system', 'wiquotes_init');



function wiquotes_init() {	
		
         
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'wiquote_can_edit');
	
	elgg_register_library('elgg:wiquote', elgg_get_plugins_path() . 'wiQuoteGPL/lib/wiquote.php');
	

	// Register actions
	$action_url = elgg_get_plugins_path() . "wiQuoteGPL/actions/wiquote/";
	elgg_register_action("wiquote/add", "{$action_url}add.php");
	elgg_register_action("wiquote/accept", "{$action_url}accept.php");
	elgg_register_action("wiquote/delete", "{$action_url}delete.php");
	
    elgg_register_plugin_hook_handler('action', 'wiquote/accept', 'wiquotes_load_wi_action_hook');  
    elgg_register_plugin_hook_handler('action', 'wiquote/add', 'wiquotes_load_wi_action_hook');  
	
	if(elgg_is_admin_logged_in()){
		$item = new ElggMenuItem('quote', elgg_echo('wiquotes:all'), 'quote/all/active');
		elgg_register_menu_item('site', $item);		
	}
	
	
	elgg_register_entity_url_handler('object', 'wiquote', 'wiquotes_url_handler');
	
		// Extend system CSS with our own styles
	elgg_extend_view('css/elgg','wiquote/css');
	
		// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('quote','wiquotes_page_handler');
	
	// Register a notification handler for site messages
	register_notification_handler("site", "wiquotes_site_notify_handler");

		// entity menu
	elgg_register_plugin_hook_handler('register', 'menu:wiquotes', 'wiquotes_menu_setup');	
	

			
}


/**
 * Override the canEdit function to return true for messages within a particular context.
 *
 */
function wiquote_can_edit($hook_name, $entity_type, $return_value, $parameters) {
    
		$entity = $parameters['entity'];
                $user = $parameters['user'];
                if($user){

                    if ($entity->getSubtype() == "wiquote") {
                        // || $user->getGUID()==$entity->wijob_owner_id
                        if($user->getGUID()==$entity->getOwnerGUID()){
                            if(wi_get_entity_status($entity->getContainerGUID())=='active' || wi_get_entity_status($entity->getContainerGUID())=='expired'){
                               return true;   
                            }
                            else{
                                return false;
                            }                     
                        }
                        else{
                            return false;
                        }
                    }
                }

	return $return_value;
}


function wiquotes_page_handler($page) {
	elgg_load_library('elgg:wiquote');
	//$pages = dirname(__FILE__) . '/pages/wiquotes';
        
	$page_type = $page[0];
	if (!isset($page[0])) {
		$page[0] = 'all';
	}
        $page_type = $page[0];

        	$user = get_user_by_username($page[1]);
	
	switch ($page_type) {						
                case 'view':
                        gatekeeper();
                        $params = wiquote_get_page_content_read($page[1], $page[2]);
                    break;

		case 'edit':
			gatekeeper();
			$params = wiquote_get_page_content_edit($page_type, $page[1], $page[2]);
			break;	            
            
		case 'confirm':
			gatekeeper();				
			$params = wiquotes_get_page_content_confirm($page[1], $page[2]);
			break;	            

	}
	
	$params['sidebar'] .= elgg_view('wijob/sidebar', array('page' => $page_type));


	//if($page_type=="owner" || $page_type=="received" || $page_type=="all"){
	//	$body = elgg_view_layout('one_column', $params);
	//}
	//else{
		$body = elgg_view_layout('content', $params);	
	//}

	echo elgg_view_page($params['title'], $body);	

}


// Populates the ->getURL() method for wijob objects
function wiquotes_url_handler($entity) {

	if (!$entity->getOwnerEntity()) {
		// default to a standard view if no owner.
		return FALSE;
	}

	return "quote/view/{$entity->guid}";

}


function wiquotes_site_notify_handler(ElggEntity $from, ElggUser $to, $subject, $message, array $params = NULL) {

	if (!$from) {
		throw new NotificationException(elgg_echo('NotificationException:MissingParameter', array('from')));
	}

	if (!$to) {
		throw new NotificationException(elgg_echo('NotificationException:MissingParameter', array('to')));
	}

	global $messages_pm;
	if (!$messages_pm) {
		return messages_send($subject, $message, $to->guid, $from->guid, 0, false, false);
	}

	return true;
}




function get_my_wiquotes_link($status){
		return elgg_view('output/url', array(
			'href' => 'quote/owner/'.elgg_get_logged_in_user_entity()->username.'/'.$status,
			'text' => ucfirst($status) . ' Quotes',
		));	
}




function get_wijob_from_wiquote($wiquote_guid, $relationship){
    
    $wijob = elgg_get_entities_from_relationship(array(
                                                'relationship_guid' => $wiquote_guid,
                                                'wheres' => "r.relationship like 'wijob_wiquote%'",  
                                                'limit' => 1,
                                                'inverse_relationship' => true
        
    ));
    
    if($wijob){
        if($relationship){
            $return = get_relationship($wijob[0]['id']);
            return $return->relationship;
        }
        else{
            return $wijob[0];
        }
    }
 
    
}




//load the wi framework
function wiquotes_load_wi_action_hook(){
    load_wi_framework();
    load_wi_framework('relationship');
}