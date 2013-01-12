<?php

elgg_register_event_handler('init', 'system', 'wibid_init');



function wibid_init() {	
		
        $wibid_js = elgg_get_simplecache_url('js', 'wibid/showhide');
	elgg_register_js('elgg.wibid.showhide', $wibid_js);
        
        elgg_register_plugin_hook_handler('register', 'menu:page', 'wibid_page_menu');        
        
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'wibid_can_edit');
	
	elgg_register_library('elgg:wibid', elgg_get_plugins_path() . 'wiBid/lib/wibid.php');

	// Register actions
	$action_url = elgg_get_plugins_path() . "wiBid/actions/wibid/";
        

	elgg_register_action("wibid/add", "{$action_url}add.php");
	elgg_register_action("wibid/accept", "{$action_url}accept.php");
	elgg_register_action("wibid/delete", "{$action_url}delete.php");

	elgg_register_plugin_hook_handler('action', 'wibid/add', 'load_wibid_wiframework_action_hook');           
	elgg_register_plugin_hook_handler('action', 'wibid/accept', 'load_wibid_wiframework_action_hook');  
	//if(elgg_is_admin_logged_in()){
	//	$item = new ElggMenuItem('wibid', elgg_echo('wibid:all'), 'wibid/all/active');
	//	elgg_register_menu_item('site', $item);		
	//}
        
	
	elgg_register_entity_url_handler('object', 'wibid', 'wibid_url_handler');
	
		// Extend system CSS with our own styles
	elgg_extend_view('css/elgg','wibid/css');
	
		// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('bid','wibid_page_handler');
	
	// Register a notification handler for site messages
	register_notification_handler("site", "wibid_site_notify_handler");

		// entity menu
	elgg_register_plugin_hook_handler('register', 'menu:wibid', 'wibid_menu_setup');	
	

}

/**
 * Override the canEdit function to return true for messages within a particular context.
 *
 */
function wibid_can_edit($hook_name, $entity_type, $return_value, $parameters) {
    
		$entity = $parameters['entity'];
                $user = $parameters['user'];
                if($user){

                    if ($entity->getSubtype() == "wibid") {
                        // || $user->getGUID()==$entity->wiauction_owner_id
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


function wibid_page_handler($page) {
	elgg_load_library('elgg:wibid');
	//$pages = dirname(__FILE__) . '/pages/wibid';
        
	$page_type = $page[0];
	if (!isset($page[0])) {
		$page[0] = 'all';
	}
        $page_type = $page[0];
//echo <<<HTML
//    <script language="javascript">confirm("$page_type")</script>
//HTML;
        	$user = get_user_by_username($page[1]);
	
	switch ($page_type) {
		case 'owner':
			gatekeeper();
                        if($user->getGUID() !=  elgg_get_logged_in_user_guid()){
                            register_error(elgg_echo('wiauctions:nopermission'));
                            forward(); 
                        }                    
					
			elgg_push_breadcrumb(elgg_echo('wibid:title:my_wibid'));
			$user = get_user_by_username($page[1]);
			$params = wibid_get_page_content_list($user->guid, $page[2], "owner");
			break;
			
		case 'received':
			gatekeeper();
                       if($user->getGUID() !=  elgg_get_logged_in_user_guid()){
                            register_error(elgg_echo('wiauctions:nopermission'));
                            forward(); 
                        } 
					
			elgg_push_breadcrumb(elgg_echo('wibid:title:recieved_wibid'));
			$user = get_user_by_username($page[1]);
			$params = wibid_get_page_content_received($user->guid, $page[2], "received");
			break;
						
                case 'view':
                        gatekeeper();
                        $params = wibid_get_page_content_read($page[1], $page[2]);
                    break;
            
		case 'edit':
			gatekeeper();
			$params = wibid_get_page_content_edit($page_type, $page[1], $page[2]);
			break;	            
            
		case 'confirm':
			gatekeeper();					
			elgg_push_breadcrumb(elgg_echo('wibid:title:my_wibid'), "bid/owner/".elgg_get_logged_in_user_entity()->username."/active");
			$params = wibid_get_page_content_confirm($page[1], $page[2]);
			break;	            
			
		case 'accept':
			gatekeeper();				
			elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'), "auction/owner/".elgg_get_logged_in_user_entity()->username."/active");
			$params = wibid_get_page_content_accept($page[1]);
			break;	            			
            
		case 'all':
			admin_gatekeeper();
			elgg_push_breadcrumb(elgg_echo('wibid:all'));
			$params = wibid_get_page_content_list(NULL, $page[1], "all");

	}
	
	//$params['sidebar'] .= elgg_view('wiauction/sidebar', array('page' => $page_type));

	$body = elgg_view_layout('content', $params);	

	echo elgg_view_page($params['title'], $body);	

}


// Populates the ->getURL() method for wiauctions objects
function wibid_url_handler($entity) {

	if (!$entity->getOwnerEntity()) {
		// default to a standard view if no owner.
		return FALSE;
	}

	return "wibid/view/{$entity->guid}";

}


function wibid_site_notify_handler(ElggEntity $from, ElggUser $to, $subject, $message, array $params = NULL) {

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

/*
function get_wiauctions_wibid($wiauction_id, $type){
	
	if($type=='win'){
		$options = array(
			'relationship_guid' => $wiauction_id,
                        'relationship' => 'wiauction_wibid_win'
		);
		
		return elgg_get_entities_from_relationship($options);            
        }
        elseif($type=='lose'){
            $relationship = "wiauction_wibid_lose";            
        }
	elseif($type=="active"){
            $relationship = "wiauction_wibid";            
        }
        else{
            
        }
		
}
*/




function wibid_menu_setup($hook, $type, $return, $params) {
	
	if (elgg_in_context('widgets')) {
		return $return;
	}
	
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);

		$options = array(
			'name' => 'edit',
			'text' => elgg_echo('edit'),
			'title' => elgg_echo('edit:this'),
			'href' => "$handler/edit/{$entity->getGUID()}",
			'priority' => 200,
		);
		$return[] = ElggMenuItem::factory($options);

	return $return;
	
}


function wibid_page_menu($hook, $type, $return, $params) {
        
	if (elgg_is_logged_in()) {
		// only show buttons in wiauction pages

		if (elgg_in_context('bid')) {
			$user = elgg_get_logged_in_user_entity();
			$page_owner = elgg_get_page_owner_entity();
			if (!$page_owner) {
				$page_owner = elgg_get_logged_in_user_entity();
			}
                              
                        $return[] = new ElggMenuItem('5wibidsent', elgg_echo('wibid:made'), 'bid/owner/' . $user->username ."/active");
                        $return[] = new ElggMenuItem('6wibid:received', elgg_echo('wibid:received'), 'bid/received/' . $user->username ."/active");
                        //quotes/owner/admin/active
			$return[] = new ElggMenuItem('1all', elgg_echo('wiauction:everyone'), 'auction');
			$return[] = new ElggMenuItem('3mine', elgg_echo('wiauction:mine'), 'auction/owner/' . $user->username);
			
		}
	}

	return $return;
}

function load_wibid_wiframework_action_hook(){
    load_wi_framework('relationship');
}

