<?php

function wibid_get_page_content_edit($page, $guid = 0, $revision = NULL) {

        load_wi_framework('relationship');

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'wibid-post-edit';
	$vars['name'] = 'wibid_post';
	$vars['class'] = 'elgg-form-alt';

	if ($page == 'edit') {
		$wibid = get_entity((int)$guid);
                
                $wiauction = wi_get_entity_from_wibid("wiauction", $guid);

		$title = elgg_echo("wibid:edit");

		if (elgg_instanceof($wiauction, 'object', 'wiauction') && $wibid->canEdit()) {

			if($wibid->owner_guid == elgg_get_logged_in_user_guid()){	
				elgg_push_breadcrumb(elgg_echo('wibid:title:my_wibid'), "wibid/owner/". elgg_get_logged_in_user_entity()->username ."/active");
				elgg_push_breadcrumb(elgg_echo('wibid:edit'));
			}
			elseif(elgg_is_admin_logged_in()){
					if($view_type == "all"){
						elgg_push_breadcrumb(elgg_echo('wibid:all'), "wibid/all/active");			
					}
					else{
						elgg_push_breadcrumb(elgg_echo('wibid:title:my_wibid'), "wibid/owner/". elgg_get_logged_in_user_entity()->username ."/active");			
					}
				elgg_push_breadcrumb(elgg_echo('wibid:wibid'));		
			}
		$body_vars['wibid_entity'] = $wibid;	
		$body_vars['guid'] = $wiauction->getGUID();
		$body_vars['view_type'] = "full";
			$vars['enctype'] =  'multipart/form-data';

			$content = elgg_view_form('wibid/add', $vars, $body_vars);
			$sidebar = elgg_view('wibid/sidebar/revisions', $vars);
		} else {
			$content = elgg_echo('wibid:error:cannot_edit_post');
		}
	} 


	$return['title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;	
}


function wibid_get_page_content_list($user_guid = NULL, $status = "active", $view_type = "owner") {
    
        load_wi_framework();
        load_wi_framework('relationship');
    
	$return = array();
   
	$options = array(
                'owner_guid' => $user_guid,
                'limit' => 999
	);
        
        
        if($status=='active'){
            $relationship = "wiauction_wibid";
        }
        elseif($status=='successful'){
            $relationship = "wiauction_wibid_win";
        }
        else{
            global $CONFIG;
           // $relationship = "";
           // $options['joins'] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid ";
          //  $options['wheres'] = "(r.relationship = 'wiauction_wibid_lose')";
            $relationship = "wiauction_wibid_lose";
        }        
        
        $options['relationship'] = $relationship;
	

	if ($user_guid) {
                //elgg_load_js("elgg.jquery_min_lib");
                elgg_load_js("elgg.helper");
		$return['title'] = elgg_echo('wibid:title:my_wibid');			

	} else {
		//$return['filter_context'] = 'active';
		$return['title'] = elgg_echo('wibid:all');
		elgg_pop_breadcrumb();
		elgg_push_breadcrumb(elgg_echo('wibid:all'));
	}

	// show all posts for admin or users looking at their own wibids
	// show only published posts for other users.
	if ((elgg_is_admin_logged_in() || (elgg_is_logged_in() && $user_guid == elgg_get_logged_in_user_guid()))) {
		
		//var_dump($return['filter_context']);
		
		$vars['view_type'] = $view_type;            
		$vars['filter_override'] = elgg_view("page/layouts/content/wibidfilter", $vars);
	}
	

	$list = elgg_list_entities_from_relationship($options);

	if (!$list) {
		$return['content'] = elgg_echo('wibid:none:found', array($status));
	} else {
		$return['content'] = $list;
	}
	
	$return['sidebar'] = $sidebar;
	$return['filter_override'] = $vars['filter_override'];

	return $return;
}


function wibid_get_page_content_received($wiauction_owner_id = NULL, $status = "active", $view_type = "owner") {
              
        load_wi_framework();
        load_wi_framework('relationship');
        
        elgg_load_js("elgg.helper");

	$return = array();
        
        $return['title'] = elgg_echo('wibid:title:received_wibid');
        
	$options = array(
                'limit' => 999
	);        

        $wiauction_subtype = get_subtype_id('object', 'wiauction'); 
        if($wiauction_subtype){        
        global $CONFIG;
        
        if($status=='active'){
            $relationship = "wiauction_wibid";
            $options['wheres'] = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$wiauction_subtype." AND ee.owner_guid=".$wiauction_owner_id.")";            
        }
        elseif($status=='successful'){
            $relationship = "wiauction_wibid_win";
            $options['wheres'] = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$wiauction_subtype." AND ee.owner_guid=".$wiauction_owner_id.")";            
        }
        else{
            global $CONFIG;
            $relationship = null;
            $options['joins'] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid ";
            $where = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$wiauction_subtype." AND ee.owner_guid=".$wiauction_owner_id.")";            
            $where .= " AND (r.relationship = 'wiauction_wibid_lose')";
            $options['wheres'] = $where;
  
        }        
        
        if($relationship){
            $options['relationship'] = $relationship;     
        }	

	//$return['filter_context'] = 'active';
	//$sidebar = elgg_view_module('featured',  elgg_echo("wibid:categories"), elgg_view('output/categories', array('subtype' => 'wibid', 'display_type' => 'list')));
 

               

	// show all posts for admin or users looking at their own wibids
	// show only published posts for other users.
	if ((elgg_is_admin_logged_in() || (elgg_is_logged_in() && $wiauction_owner_id == elgg_get_logged_in_user_guid()))) {
		$vars['view_type'] = "received";
                $vars['wiauction_owner'] = $wiauction_owner_id;
              //  $vars['wheres'] = $where;
                $vars['filter_override'] = elgg_view("page/layouts/content/wibidfilter", $vars);
	}

        //$options['wheres'] = $where;
    
	$list = elgg_list_entities_from_relationship($options);

	if (!$list) {
		$return['content'] = elgg_echo('wibid:none:found', array($status));
	} else {
		$return['content'] = $list;
	}
        
        }else{
                    $return['content'] = elgg_echo('wibid:none:found', array($status));            
        }	
	$return['sidebar'] = $sidebar;
	$return['filter_override'] = $vars['filter_override'];

	return $return;
}

function wibid_get_page_content_read($guid = NULL, $view_type = "owner") {

	$return = array();
	$wibid = get_entity($guid);

	// no header or tabs for viewing an individual blog
	$return['filter'] = '';
	$return['header'] = '';

	if (!elgg_instanceof($wibid, 'object', 'wibid')) {	 
                register_error(elgg_echo("generic_wibid:notfound"));
		forward();
	}
        
        $wiauction = wi_get_entity_from_wibid("wiauction", $wibid->getGUID());
 
        if(!$wiauction){
                register_error(elgg_echo("generic_wibid:notfound"));
		forward();
        }
        
        if(!elgg_is_admin_logged_in()){
            if($wibid->getOwnerGUID()!=elgg_get_logged_in_user_guid() && $wiauction->getOwnerGUID()!=  elgg_get_logged_in_user_guid()){
                                register_error(elgg_echo('wiauctions:nopermission'));
                                forward();         
            }
        }
        
	$return['title'] = elgg_echo("wibid:wibid");
	
	if($wibid->getOwnerGUID() == elgg_get_logged_in_user_guid()){	
		elgg_push_breadcrumb(elgg_echo('wibid:title:my_wibid'), "wibid/owner/". elgg_get_logged_in_user_entity()->username ."/active");
		elgg_push_breadcrumb(elgg_echo('wibid:wibid'));
	}
	elseif(elgg_is_admin_logged_in()){
			if($view_type == "all"){
				elgg_push_breadcrumb(elgg_echo('wibid:all'), "wibid/all/active");			
			}
			else{
				elgg_push_breadcrumb(elgg_echo('wibid:title:my_wibid'), "wibid/owner/". elgg_get_logged_in_user_entity()->username ."/active");			
			}
		elgg_push_breadcrumb(elgg_echo('wibid:wibid'));		
	}
        
	$relationship = wi_get_entity_from_wibid("wiauction", $wibid->getGUID(), true);
          
	$return['content'] = elgg_view_entity($wibid, array('view_type' => 'fullview', 'relationship' => $relationship));
	//check to see if comment are on
	
	return $return;
}

function wibid_get_page_content_confirm($wiauction_id, $edit_type){
    
        load_wi_framework();
	
	$return = array();

	$return['title'] = "Bid ".ucfirst($edit_type);
	
	elgg_push_breadcrumb("Bid ".ucfirst($edit_type));

	$vars['wiauction_id'] = $wiauction_id;
	$vars['edit_type'] = $edit_type;
	
	$return['content'] = elgg_view("wibid/confirm", $vars);
        $return['filter_override'] = "";
        
	return $return;
}



function wibid_get_page_content_accept($wibid_id){
	
        load_wi_framework();
        load_wi_framework('relationship');
        
	$return = array();

	$return['title'] = "Bid Accepted";
	
	elgg_push_breadcrumb("Bid Accepted");

	$vars['wibid_id'] = $wibid_id;
	
	$return['content'] = elgg_view("wibid/accept", $vars);
        $return['filter_override'] = "";

	return $return;
}