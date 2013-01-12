<?php

elgg_register_event_handler('init', 'system', 'wiauction_init');


function wiauction_init() {
    
    
 	$plugin = 'webIntFramework';

	if (!elgg_is_active_plugin('webIntFramework')) {
		register_error(elgg_echo('wi:framework:disabled'));
                $wiauction = new ElggPlugin($plugin);
		$wiauction->deactivate();
	}
        
        elgg_register_plugin_hook_handler('cron', 'daily', 'check_wiauction_expiry_cron');
        elgg_register_plugin_hook_handler('register', 'menu:page', 'wiauction_page_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'wiauction_owner_block_menu');        
    
	// Register entity type
	elgg_register_entity_type('object','wiauction');
        
	
	elgg_register_library('elgg:wiauctions', elgg_get_plugins_path() . 'wiAuction/lib/wiauction.php');
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'wiauctions_can_edit');
		
	elgg_register_page_handler('auction', 'wiauctions_page_handler');
        
        //elgg_register_plugin_hook_handler('container_permissions_check', 'object', 'wiauctions_container_permission_check');
	
	$action_base = elgg_get_plugins_path() . 'wiAuction/actions/wiauction';
	elgg_register_action('wiauction/save', "$action_base/save.php");
        elgg_register_action('auction/delete', "$action_base/delete.php");
	elgg_register_action('auction/cancel', "$action_base/cancel.php");
        
	elgg_register_plugin_hook_handler('action', 'wiauction/save', 'load_wiauction_wiframework_action_hook');        
	elgg_register_plugin_hook_handler('action', 'auction/delete', 'load_wiauction_wiframework_action_hook'); 
        elgg_register_plugin_hook_handler('action', 'auction/cancel', 'load_wiauction_wiframework_action_hook'); 

	$item = new ElggMenuItem('auction', elgg_echo('wiauctions:auctions'), 'auction/all/active');
	elgg_register_menu_item('site', $item);
	           
        
    	// Extend owner block menu
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'wiauctions_owner_block_menu');    
	
		// entity menu
	elgg_register_plugin_hook_handler('register', 'menu:wiauction', 'wiauctions_menu_setup');
	
		// Override the default url to view a wiauctions post
	elgg_register_entity_url_handler('object', 'wiauction', 'wiauctions_url_handler');
	
	//register cron to set status of wiauctions
	//elgg_register_plugin_hook_handler('cron', 'hourly', 'wiauctions_status_cron');
	
	//extend css
	elgg_extend_view('css/elgg', 'wiauction/css');
        
        //register the show hide js for the full view of a wiauction
        elgg_register_simplecache_view('wibid/showhide');
        
        
        elgg_register_js('elgg.jquery_lib', "http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js");
              
	
		// Add a new widget
	elgg_register_widget_type(
			'wiauction',
			elgg_echo('wiauctions:widget'),
			elgg_echo('wiauctions:widget:description')
			);
        
        elgg_extend_view('css/elgg', 'location_complete/css');
        
        elgg_register_js('wiauction.jquery_min', "http://code.jquery.com/jquery-1.4.2.min.js");
        
        elgg_register_js('wiauction.google_map', "http://maps.google.com/maps/api/js?sensor=false");
        
        $custom_js = elgg_get_simplecache_url('js', 'location_complete/jquery_custom');
	elgg_register_js('wiauction.jquery_custom', $custom_js);      
        
        $suggests_js = elgg_get_simplecache_url('js', 'location_complete/geo_suggests');
	elgg_register_js('wiauction.geo_suggests', $suggests_js);  
        
			
}



/**
 * Trigger the log rotation.
 */
function wiauctions_status_cron($hook, $entity_type, $returnvalue, $params)
{
    load_wi_framework('entity');
    
    wi_check_wiauctions_expiry();
}


function wiauctions_menu_setup($hook, $type, $return, $params) {
	
	if (elgg_in_context('widgets')) {
		return $return;
	}
	
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);



		// edit link
	
	if(wi_get_entity_status($entity->getGUID())=="active" || wi_get_entity_status($entity->getGUID())=="expired"){
		$options = array(
			'name' => 'edit',
			'text' => elgg_echo('edit'),
			'title' => elgg_echo('edit:this'),
			'href' => "$handler/edit/{$entity->getGUID()}",
			'priority' => 200,
		);
		$return[] = ElggMenuItem::factory($options);

		// cancel link if wiauction is active or expired
		
			$options = array(
				'name' => 'cancel',
				'text' => elgg_echo('cancel'),
				'title' => elgg_echo('cancel:this'),
				'href' => "action/$handler/cancel?guid={$entity->getGUID()}",
				'confirm' => elgg_echo('cancelconfirm'),
				'priority' => 300,
			);
		
			$return[] = ElggMenuItem::factory($options);
		}
		if(elgg_is_admin_logged_in()){
			$options = array(
				'name' => 'delete',
				'text' => elgg_view_icon('delete'),
				'title' => elgg_echo('delete:this'),
				'href' => "action/$handler/delete?guid={$entity->getGUID()}",
				'confirm' => elgg_echo('deleteconfirm'),
				'priority' => 300,
			);
		
			$return[] = ElggMenuItem::factory($options);			
		}
	

	return $return;
	
}
 
function wiauctions_page_handler($page) {
	
	elgg_set_context('wiauction');
	
	elgg_load_library('elgg:wiauctions');
        
        $sort = get_input("sort");
	
       
	
	$page_type = $page[0];	
	switch ($page[0]) {
		case 'add':
		gatekeeper();
                if (elgg_get_plugin_setting('wiauction_adminonly', 'wiauction') == 'yes') {
                    admin_gatekeeper();
                }
                if($page[1]!=  elgg_get_logged_in_user_guid()){
                    register_error(elgg_echo('wiauctions:nopermission'));
                    forward(); 
                }    
						
		elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'), "auction/owner/".elgg_get_logged_in_user_entity()->username."/active");
		$params = wiauctions_get_page_content_edit($page_type, $page[1]);
		break;
		
		case 'edit':
		gatekeeper();							
		elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'), "auction/owner/".elgg_get_logged_in_user_entity()->username."/active");
		$params = wiauctions_get_page_content_edit($page_type, $page[1], $page[2]);
		break;		
		
		case 'owner':	
                        gatekeeper();
                       $user = get_user_by_username($page[1]); 
                       if($user->getGUID() !=  elgg_get_logged_in_user_guid()){
                            register_error(elgg_echo('wiauctions:nopermission'));
                            forward(); 
                        }       			
			
                        if(elgg_get_logged_in_user_guid()==$user->getGUID()){
				elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'));
			}
			else{
				elgg_push_breadcrumb(elgg_echo('wiauctions:title:users_wiauctions', array($user->name."'s")));
			}
			if(empty($page[2])){
                            $status = "active";
                        }
                        else{
                            $status = $page[2];                            
                        }
			$params = wiauctions_get_page_content_list($user->guid, $status);
                        
			break;
			
		case 'by':
                        $user = get_user_by_username($page[1]);
                        elgg_set_page_owner_guid($user->getGUID());
			$params = wiauctions_get_page_content_list($user->guid, "active", "", "", "", "by");
			break;			
					
		case 'view':
                        if(get_entity($page[1])->owner_guid==elgg_get_logged_in_user_guid()){				
                                if($page[3]=="wibid"){
                                elgg_push_breadcrumb(elgg_echo('wibid:title:my_wibid'), "bid/owner/".elgg_get_logged_in_user_entity()->username."/active");				
                                }else{
                                elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'), "auction/owner/".elgg_get_logged_in_user_entity()->username."/active");
                                }				
                        }			
                        else{
                                //show all wiauctions breadcrumbs
                                elgg_push_breadcrumb(elgg_echo('wiauctions:wiauctions'), "auction/all/active");
                        }

                        $params = wiauctions_get_page_content_read($page[1]);
                        break;	
			
		case 'confirm':
                        gatekeeper();
                        $params = wiauctions_get_page_content_confirm($page[1], $page[2]);
                        break;	

		case 'cancel':
                        gatekeeper();							
                        $params = wiauctions_get_page_content_cancel();
                        break;		

		case 'all':
                        if(empty($page[1])){
                          $status = "active";  
                        }
                        else{
                          $status = $page[1];
                        }
			$params = wiauctions_get_page_content_list("", $status, $cat_desc, $cat, $sort);                      
			break;
                        
                case 'friends':
                       $user = get_user_by_username($page[1]); 
                       if($user->getGUID() !=  elgg_get_logged_in_user_guid()){
                            register_error(elgg_echo('wiauctions:nopermission'));
                            forward(); 
                        }       			
			
                        if(elgg_get_logged_in_user_guid()==$user->getGUID()){
				elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'));
			}
			else{
				elgg_push_breadcrumb(elgg_echo('wiauctions:title:users_wiauctions', array($user->name."'s")));
			}
                        $params = wiauctions_get_friends_content_list($user->guid); 
                    
		default:	
                     
                        $status = "active";  
                        $cat_guid = $page[0];
                        $cat_desc = $page[1];
                        
			$params = wiauctions_get_page_content_list("", $status, $cat_desc, $cat_guid, $sort);
			break;
	}
        


        $body .= elgg_view_layout('content', $params);	

	
	echo elgg_view_page($params['page_title'], $body);
	

}




// Populates the ->getURL() method for wiauctions objects
function wiauctions_url_handler($entity) {

	if (!$entity->getOwnerEntity()) {
		// default to a standard view if no owner.
		return FALSE;
	}

	$friendly_title = elgg_get_friendly_title($entity->title);

	return "auction/view/{$entity->guid}/$friendly_title";

}

function view_wiauction_wibid($entity) {

    
	if (!($entity instanceof ElggEntity)) {
		return false;
	}

	if($entity->getOwnerGUID()!=elgg_get_logged_in_user_guid() && (wi_get_entity_status($entity->getGUID())=="active" || wi_get_entity_status($entity->getGUID())=="expired")){
		
            $wibid = wi_check_user_wibid_entity("wiauction", $entity->getGUID());
                        
            if(wi_get_entity_status($entity->getGUID())=="expired"){
                        if($wibid){
                            //the wiauction is expired but they have already wibid so allow them to alter wibid
                            $vars['show_add_form'] = true;
                            $vars['wibid_entity'] = $wibid;
                        }
                        else{
                            //wiauction is expired and they havent wibid on it so dont allow them to add a wibid
                             $vars['show_add_form'] = false;
                        }
            }
            else{

                if($wibid){
                
                    //they have a wibid so pass it to the add wibid form
                    $vars['wibid_entity'] = $wibid;
                }
                 $vars['show_add_form'] = true;  
            }
	}
	else{
		$vars['show_add_form'] = false;
	}
 
	
	$vars['entity'] = $entity;
	$vars['class'] = "wiauctions-wibid";
	$vars['inline'] = true;
	$vars['full_view'] = false;

		return elgg_view('page/elements/wibid', $vars);
	
}



     
     /**
 * Override the canEdit function to return true for messages within a particular context.
 *
 */
function wiauctions_can_edit($hook_name, $entity_type, $return_value, $parameters) {
                load_wi_framework('relationship');
                
                $context = elgg_get_context();
		$entity = $parameters['entity'];
                $user = $parameters['user'];
                if($user){		
                    if ($entity->getSubtype() == "wiauction") {
                          if(wi_get_entity_status($entity->getGUID())=="active" || wi_get_entity_status($entity->getGUID())=="expired"){
                                if($user->getGUID()==$entity->getOwnerGUID()){
                                    return true;   
                                }
                                elseif($context=="adding_wibid"){
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

		



// Add to the user block menu
function wiauctions_owner_block_menu($hook, $type, $return, $params) {
    
	if (elgg_instanceof($params['entity'], 'user')) {

			$url = "auction/by/{$params['entity']->username}";
			$item = new ElggMenuItem('wiauction', elgg_echo('wiauctions'), $url);
			$return[] = $item;
		
	}

	return $return;

}





function check_wiauction_expiry_cron($hook, $entity_type, $returnvalue, $params) {

        load_wi_framework('entity');
    
        wi_check_wiauctions_expiry();

	return $returnvalue;
}





function wiauction_page_menu($hook, $type, $return, $params) {
        
	if (elgg_is_logged_in()) {
		// only show buttons in wiauction pages
        
		if (elgg_in_context('wiauction')) {
			$user = elgg_get_logged_in_user_entity();
			$page_owner = elgg_get_page_owner_entity();
			if (!$page_owner) {
				$page_owner = elgg_get_logged_in_user_entity();
			}

			$return[] = new ElggMenuItem('1all', elgg_echo('wiauction:everyone'), 'auction');
			//$return[] = new ElggMenuItem('4friends', elgg_echo('wiauction:friends'), 'wiauction/friends/' . $user->username);
			$return[] = new ElggMenuItem('3mine', elgg_echo('wiauction:mine'), 'auction/owner/' . $user->username);
                        
                        $return[] = new ElggMenuItem('5wibidsent', elgg_echo('wibid:made'), 'bid/owner/' . $user->username ."/active");
                        $return[] = new ElggMenuItem('6wibid:received', elgg_echo('wibid:received'), 'bid/received/' . $user->username ."/active");
                        //quotes/owner/admin/active
			
		}
	}

	return $return;
}


function wiauction_owner_block_menu($hook, $type, $return, $params) {

	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "auction/by/{$params['entity']->username}/active";
		$item = new ElggMenuItem('wiauction', elgg_echo('wiauctions:wiauctions'), $url);
		$return[] = $item;
	}

	return $return;

}


function wiauction_edit_menu($hook, $type, $return, $params) {

    	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'wiauction') {
		return $return;
	}
        else{
            $menus = $params['menu'];
            
            foreach($menus['default'] as $menu){
             
               if($menu->getName()=="delete"){
                       // var_dump($menu->getContent());
                        $menu->setHref("action/$handler/cancel?guid=207");
                        $menu->setText(elgg_echo('cancel'));
                        $menu->setConfirmText(elgg_echo('cancelconfirm'));
                        $menu->setTooltip(elgg_echo('cancel:this'));
                        $menu->setName('cancel');
               }
            }
            return $menus;
        }

}





//load the wi framework
function load_wiauction_wiframework_action_hook(){
    load_wi_framework();
    load_wi_framework('relationship');
}

