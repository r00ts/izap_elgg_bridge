<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

elgg_register_event_handler('init', 'system', 'wijob_init');


function wijob_init() {
       
	// Register entity type
	elgg_register_entity_type('object','wijob');
	
	elgg_register_library('elgg:wijobgpl', elgg_get_plugins_path() . 'wiJobGPL/lib/wijob.php');
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'wijob_can_edit');
		
	elgg_register_page_handler('job', 'wijob_page_handler');
        
        elgg_register_plugin_hook_handler('register', 'menu:page', 'wijob_page_menu');        
        
      
	$action_base = elgg_get_plugins_path() . 'wiJobGPL/actions';
	elgg_register_action('wijob/save', "$action_base/save.php");
        elgg_register_action('wijob/delete', "$action_base/delete.php");
	elgg_register_action('wijob/cancel', "$action_base/cancel.php");
       
	elgg_register_plugin_hook_handler('action', 'wijob/save', 'wijob_load_wi_action_hook');    
	elgg_register_plugin_hook_handler('action', 'wijob/cancel', 'wijob_load_wi_action_hook');            
	
        if(elgg_is_admin_logged_in()){
            $item = new ElggMenuItem('job', elgg_echo('wijob:wijob'), 'job/all/active');
        }
        else{
            $item = new ElggMenuItem('job', elgg_echo('wijob:wijob'), 'job');            
        }
	elgg_register_menu_item('site', $item);  
        
	
	// Override the default url to view a wijob post
	elgg_register_entity_url_handler('object', 'wijob', 'wijob_url_handler');
        
	elgg_register_plugin_hook_handler('prepare', 'menu:entity', 'prepare_wijob_menu_setup');
        
	//extend css
	elgg_extend_view('css/elgg', 'wijob/css');
        
        //register the show hide js for the full view of a wijob
        elgg_register_simplecache_view('wiquote/showhide');
        
        $wiquotes_js = elgg_get_simplecache_url('js', 'wiquote/showhide');
	elgg_register_js('elgg.wiquote.showhide', $wiquotes_js);
        
        elgg_register_js('elgg.jquery_lib', "http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js");
	
    		
}


 
function wijob_page_handler($page) {
	
	elgg_load_library('elgg:wijobgpl');       
	
	$page_type = $page[0];	
	switch ($page[0]) {
		case 'add':
                if (elgg_get_plugin_setting('wiauction_adminonly', 'wiauction') == 'yes') {
                    admin_gatekeeper();
                }
               else{
                    gatekeeper();
               }
                if($page[1]!=  elgg_get_logged_in_user_guid()){
                    register_error(elgg_echo('wijob:nopermission'));
                    forward(); 
                }    							

		$params = wijob_get_page_content_edit($page_type, $page[1]);
		break;
		
		case 'edit':
		gatekeeper();							
		$params = wijob_get_page_content_edit($page_type, $page[1], $page[2]);
		break;		
		
		case 'owner':	 
                        $user = get_user_by_username($page[1]);
			$params = wijob_get_page_content_list($user->guid);
			break;
					
					
		case 'view':
			$params = wijob_get_page_content_read($page[1]);
			break;	
			
		case 'confirm':
                        gatekeeper();							
                        $params = wijob_get_page_content_confirm($page[1], $page[2]);
        		break;		

		case 'friends':
			$user = get_user_by_username($page[1]);
			$params = wijob_get_page_content_friends($user->guid);
			break;
                    
		case 'all':
			$params = wijob_get_page_content_list("", $cat);
			break;
		default:	
	
                        if(elgg_is_admin_logged_in()){
                            elgg_push_breadcrumb(elgg_echo('wijob:wijob'), "wijob/all/active");
                        }
                        else{
                            elgg_push_breadcrumb(elgg_echo('wijob:wijob'), "job");                            
                        }
                        
                        $cat_guid = $page[0];
                        $cat = $page[1];
                        
			$params = wijob_get_page_content_list("", $cat, $cat_guid);
                        
			break;
	}
	
	//$params['sidebar'] .= elgg_view('wijob/sidebar', array('page' => $page_type));
	

	$body .= elgg_view_layout('content', $params);	
	

	
	echo elgg_view_page($params['page_title'], $body);
	

}



// Populates the ->getURL() method for wijob objects
function wijob_url_handler($entity) {

	if (!$entity->getOwnerEntity()) {
		// default to a standard view if no owner.
		return FALSE;
	}

	$friendly_title = elgg_get_friendly_title($entity->title);

	return "job/view/{$entity->guid}/$friendly_title";

}

function view_wijob_wiquotes($entity) {

	if (!($entity instanceof ElggEntity)) {
		return false;
	}

	if($entity->getOwnerGUID()!=elgg_get_logged_in_user_guid() && (wi_get_entity_status($entity->getGUID())=="active" || wi_get_entity_status($entity->getGUID())=="expired")){
		
            $wiquote = check_if_user_wiquote_on_wijob($entity->getGUID());
                        
            if(wi_get_entity_status($entity->getGUID())=="expired"){
                        if($wiquote){
                            //the wijob is expired but they have already wiquote so allow them to alter wiquote
                            $vars['show_add_form'] = true;
                            $vars['wiquote_entity'] = $wiquote;
                        }
                        else{
                            //wijob is expired and they havent wiquote on it so dont allow them to add a wiquote
                             $vars['show_add_form'] = false;
                        }
            }
            else{
                if($wiquote){
                    //they have a wiquote so pass it to the add wiquote form
                    $vars['wiquote_entity'] = $wiquote;
                }
                 $vars['show_add_form'] = true;  
            }
	}
	else{
		$vars['show_add_form'] = false;
	}
 
	
	$vars['entity'] = $entity;
	$vars['class'] = "wijob-wiquotes";
	$vars['inline'] = true;
	$vars['full_view'] = false;

		return elgg_view('page/elements/wiquote', $vars);
	
}

function check_if_user_wiquote_on_wijob($wijob_guid){
                      
            $wiquotelist = elgg_get_entities_from_relationship(array(
                                                'owner_guid' => elgg_get_logged_in_user_guid(),
                                                'relationship' => 'wijob_wiquote',
                                                'relationship_guid' => $wijob_guid,
                                                'limit' => 1
                                        ));

            $wiquote = $wiquotelist[0];    
            if($wiquote){
                return $wiquote;
            }
            else{
                return false;
            }
}

     
     /**
 * Override the canEdit function to return true for messages within a particular context.
 *
 */
function wijob_can_edit($hook_name, $entity_type, $return_value, $parameters) {

                $context = elgg_get_context();
		$entity = $parameters['entity'];
                $user = $parameters['user'];
                if($user){		
                    if ($entity->getSubtype() == "wijob") {
                            
                        load_wi_framework('relationship');
                  
                          if(wi_get_entity_status($entity->getGUID())=="active" || wi_get_entity_status($entity->getGUID())=="expired"){
                                if($user->getGUID()==$entity->getOwnerGUID()){
                                    return true;   
                                }
                                elseif($context=="adding_wiquote"){
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

		
function get_my_wijob_link($status){
		return elgg_view('output/url', array(
			'href' => 'job/owner/'.elgg_get_logged_in_user_entity()->username.'/'.$status,
			'text' => ucfirst($status) . ' job',
		));	
}


function get_user_wijob_link($username, $status){
		return elgg_view('output/url', array(
			'href' => 'job/owner/'.$username.'/'.$status,
			'text' => ucfirst($status) . ' job',
		));	
}

function get_wijob_link($wijob, $by_title){

	if($by_title=="title"){
		return elgg_view('output/url', array(
			'href' => $wijob->getURL(),
			'text' => $wijob->title,
		));	
	}
	else{
		return elgg_view('output/url', array(
			'href' => $wijob->getURL(),
			'text' => $wijob->getURL(),
		));			
	}

}	

function get_all_wijob(){
	return elgg_view('output/url', array(
	'href' => 'job',
	'text' => 'All job',
	));
}




//load the wi framework
function wijob_load_wi_action_hook(){
    load_wi_framework();
    load_wi_framework('relationship');
}



function get_job_quote_currency($plugin){
    return elgg_get_plugin_setting('wijob_currency', "$plugin");
}



function prepare_wijob_menu_setup($hook, $type, $return, $params) {
	
	if (elgg_in_context('widgets')) {
		return $return;
	}
        
	
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);

        if($handler=="wijob"){
  
  
              $menus = $params['menu'];
              $ent = $params['entity'];
            
            foreach($menus['default'] as $menu){
             
               if($menu->getName()=="edit"){
                       // var_dump($menu->getContent());
                        $menu->setHref("job/edit/".$ent->guid);
               }
            }
            return $menus;
        }
        return $return;
}