<?php
/**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'webIntFramework_init');

function webIntFramework_init() {
 

    elgg_register_event_handler('pagesetup', 'system', 'wi_admin_page_setup');

    $action_path = elgg_get_plugins_path() . 'webIntFramework/actions/wicategory';
    elgg_register_action('wicategory/save', "$action_path/save.php");
    elgg_register_action('wicategory/delete', "$action_path/delete.php");    

    //put files in lib before uploading 
    elgg_register_library('wi:framework:entity', elgg_get_plugins_path() . 'webIntFramework/lib/webIntFramework/wi_entity.php');
    elgg_register_library('wi:framework:shared', elgg_get_plugins_path() . 'webIntFramework/lib/webIntFramework/wi_shared.php');
    elgg_register_library('wi:framework:relationship', elgg_get_plugins_path() . 'webIntFramework/lib/webIntFramework/wi_relationship.php');

    	elgg_register_plugin_hook_handler('permissions_check', 'object', 'category_can_edit');
        
	// Extend the main CSS file
	elgg_extend_view('css/elgg', 'webIntFramework/css');
        elgg_extend_view('css/admin', 'webIntFramework/css');
        
	$wi_js = elgg_get_simplecache_url('js', 'webIntFramework/add');
	elgg_register_simplecache_view('js/webIntFramework/add');
	elgg_register_js('wi.category', $wi_js);   
        
        elgg_register_simplecache_view('sortentities/sort_js');
        $sort_js = elgg_get_simplecache_url('js', 'sortentities/sort_js');
        elgg_register_js('elgg.sortentities', $sort_js);          
        
	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('wicategory', 'wi_category_page_handler');        


}

function load_wi_framework($lib){
    
    if($lib){
       elgg_load_library("wi:framework:$lib");        
    }
    else{
       elgg_load_library("wi:framework:shared");        
    }

    
}


function wi_category_page_handler($page) {
 
    
    	if (!isset($page[0])) {
		$page[0] = 'all';
	}



	$page_type = $page[0];
        
	switch ($page_type) {

                case "forms":
                        $form = $page[1];
                        if(!empty($form) && elgg_is_logged_in()){

                                set_input("cat_type", $page[2]);
                                set_input("guid", $page[3]);
                                
                                include(dirname(__FILE__) . "/pages/forms/" . $form . ".php");
                                return true;	
                        }
                        break;                    
                    
		default:
			return false;
	}
	return true;
}



function wi_admin_page_setup() {
	if (elgg_get_context() == 'admin' && elgg_is_admin_logged_in()) {
	    elgg_register_admin_menu_item('configure', 'wicategories', 'settings');
	}
}



/**
 * Override the canEdit function to return true for messages within a particular context.
 *
 */
function category_can_edit($hook_name, $entity_type, $return_value, $parameters) {

		$entity = $parameters['entity'];
		if ($entity->getSubtype() == "category") {
			return true;
		}
	return $return_value;
}
