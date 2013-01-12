<?php
/**
 * Elgg WI Quotes vGPL Plugin
 * @package WI Job/Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

function wiquote_get_page_content_edit($page, $guid = 0, $revision = NULL) {


	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'wiquote-post-edit';
	$vars['name'] = 'wiquote_post';
	$vars['class'] = 'elgg-form-alt';

	if ($page == 'edit') {
		$wiquote = get_entity((int)$guid);
                
                $wijob = get_wijob_from_wiquote($guid);

		$title = elgg_echo("wiquote:edit");

		if (elgg_instanceof($wijob, 'object', 'wijob') && $wiquote->canEdit()) {

			if($wiquote->owner_guid == elgg_get_logged_in_user_guid()){		
				elgg_push_breadcrumb(elgg_echo('wiquotes:title:my_quotes'), "quote/owner/". elgg_get_logged_in_user_entity()->username ."/active");
				elgg_push_breadcrumb(elgg_echo('wiquote:edit'));
			}
			elseif(elgg_is_admin_logged_in()){
					if($view_type == "all"){
						elgg_push_breadcrumb(elgg_echo('wiquotes:all'), "quote/all/active");			
					}
					else{
						elgg_push_breadcrumb(elgg_echo('wiquotes:title:my_quotes'), "quote/owner/". elgg_get_logged_in_user_entity()->username ."/active");			
					}
				elgg_push_breadcrumb(elgg_echo('wiquote:quote'));		
			}
		$body_vars['wiquote_entity'] = $wiquote;	
		$body_vars['guid'] = $wijob->getGUID();
		$body_vars['view_type'] = "full";
			$vars['enctype'] =  'multipart/form-data';

			$content = elgg_view_form('wiquote/add', $vars, $body_vars);
		
		} else {
			$content = elgg_echo('wiquote:error:cannot_edit_post');
		}
	} 

        
	$return['title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;	
}



function wiquote_get_page_content_read($guid = NULL, $view_type = "owner") {
    
    load_wi_framework('relationship');

	$return = array();
	$wiquote = get_entity($guid);

	// no header or tabs for viewing an individual blog
	$return['filter'] = '';
	$return['header'] = '';

	if (!elgg_instanceof($wiquote, 'object', 'wiquote')) {
                register_error(elgg_echo("generic_wiquote:notfound"));
		forward();
	}
        
        $wijob = get_wijob_from_wiquote($wiquote->getGUID());
 
        if(!$wijob){    
                register_error(elgg_echo("generic_wiquote:notfound"));
		forward();
        }
        
        if(!elgg_is_admin_logged_in()){
            if($wiquote->getOwnerGUID()!=elgg_get_logged_in_user_guid() && $wijob->getOwnerGUID()!=  elgg_get_logged_in_user_guid()){
                                register_error(elgg_echo('wijob:nopermission'));
                                forward();         
            }
        }
        
	$return['title'] = elgg_echo("wiquote:quote");
	
	if($wiquote->getOwnerGUID() == elgg_get_logged_in_user_guid()){	
		elgg_push_breadcrumb(elgg_echo('wiquotes:title:my_quotes'), "quote/owner/". elgg_get_logged_in_user_entity()->username ."/active");
		elgg_push_breadcrumb(elgg_echo('wiquote:quote'));
	}
    else{
		elgg_push_breadcrumb(elgg_echo('wijob'), $wijob->getURL());
		elgg_push_breadcrumb(elgg_echo('wiquote:quote'));	
        }
        
	$relationship = get_wijob_from_wiquote($wiquote->getGUID(), true);
          
	$return['content'] = elgg_view_entity($wiquote, array('view_type' => 'fullview', 'relationship' => $relationship));
	//check to see if comment are on
	
	return $return;
}

function wiquotes_get_page_content_confirm($wijob_id, $edit_type){

	$return = array();

	$return['title'] = "Quote ".ucfirst($edit_type);
	
	elgg_push_breadcrumb("Quote ".ucfirst($edit_type));

	$vars['wijob_id'] = $wijob_id;
	$vars['edit_type'] = $edit_type;
	
	$return['content'] = elgg_view("wiquote/confirm", $vars);
        $return['filter_override'] = "";
                
	return $return;
}


