<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

function wijob_get_page_content_edit($page, $guid = 0) {
                  
        load_wi_framework();
        load_wi_framework('relationship');

	elgg_load_js('elgg.wijob');

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'wijob-post-edit';
	$vars['name'] = 'wijob_post';
	$vars['class'] = 'elgg-form-alt';

	if ($page == 'edit') {
		$wijob = get_entity((int)$guid);
		//echo '<script type="text/javascript">alert("'.$wijob->guid.'");</script>';
		//check if its status of active or pending
		

		$title = elgg_echo('wijob:edit');

		if (elgg_instanceof($wijob, 'object', 'wijob') && $wijob->canEdit()) {
                   
			//$vars['entity'] = $wijob;

			$title .= ": \"$wijob->title\"";

			$body_vars = wijob_prepare_form_vars($wijob);

			elgg_push_breadcrumb($wijob->title, $wijob->getURL());
			elgg_push_breadcrumb(elgg_echo('edit'));
			
			elgg_load_js('elgg.wijob');
			
			$body_vars['view_type'] = "edit";
			$vars['enctype'] =  'multipart/form-data';

			$content = elgg_view_form('wijob/save', $vars, $body_vars);
		
		} else {
			$content = elgg_echo('wijob:error:cannot_edit_post');
		}
	} else {
		if (!$guid) {
			$container = elgg_get_logged_in_user_entity();
		} else {
			$container = get_entity($guid);
		}

		elgg_push_breadcrumb(elgg_echo('wijob:add'));
		$body_vars = wijob_prepare_form_vars($wijob);

		$title = elgg_echo('wijob:add');
		$body_vars['view_type'] = "add";
		$vars['enctype'] =  'multipart/form-data';
		
		$content = elgg_view_form('wijob/save', $vars, $body_vars);
		
	//	$wijob_js = elgg_get_simplecache_url('js', 'wijob/save_draft');
		//elgg_register_js('elgg.wijob', $wijob_js);
	}


	$return['title'] = $title;
        $return['page_title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;	
}



function wijob_prepare_form_vars($post = NULL) {


	// input names => defaults
	$values = array(
		'title' => NULL,
		'description' => NULL,
		'access_id' => ACCESS_PUBLIC,
		'tags' => NULL,
		'container_guid' => NULL,
		'guid' => NULL,
		'wijobcategory' => '',
                'budget' => '',
	);
	

	if ($post) {
		foreach (array_keys($values) as $field) {
                    
                        switch ($field) {
                                    case 'wijobcategory':
                                        $values[$field] = wi_get_entity_category_array($post->getSubtype(), $post->getGUID());
                                    break;                       
                            
                            default:
                            	if (isset($post->$field)) {
                                    $values[$field] = $post->$field;
                                }
                            break;
                        }
		}
	}

	if (elgg_is_sticky_form('wijob')) {
		$sticky_values = elgg_get_sticky_values('wijob');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('wijob');

	if (!$post) {
		return $values;
	}
	return $values;
}


/*
 * Owner function
 */
function wijob_get_page_content_list($container_guid = NULL, $cat_desc = "all", $category = "all") {
     
        load_wi_framework();
        load_wi_framework('relationship');
            
        if (elgg_get_plugin_setting('wijob_adminonly', 'wiJobGPL') == 'yes') {
            if(elgg_is_admin_logged_in()){
                elgg_register_title_button();
            }    
        }
        else{
           elgg_register_title_button(); 
        }        

	
	$return = array();
        	
	$options = array(
			'type' => 'object',
			'subtype' => 'wijob',
			'full_view' => FALSE
		);


	//NOTE CONTAINER GUID IS THE OWNER GUID

	if ($container_guid) {
                elgg_load_js("elgg.jquery_min_lib");
                elgg_load_js("elgg.helper");

		$options['container_guid'] = $container_guid;
		$wijob_owner = get_entity($container_guid);
                
                $options['container_guid'] = $container_guid;

		if($container_guid==elgg_get_logged_in_user_guid()){
		$return['title'] = elgg_echo('wijob:title:my_job');
                $return['page_title'] = elgg_echo('wijob:title:my_job');
		}
		else{
			$return['title'] = elgg_echo('wijob:title:users_job', array($wijob_owner->name."'s"));
                        $return['page_title'] = elgg_echo('wijob:title:users_job', array($wijob_owner->name."'s"));
		}
                
		$crumbs_title = $wijob_owner->name;
		elgg_push_breadcrumb($crumbs_title);    
                
                $return['filter_context'] = 'mine';
		
		//$crumbs_title = "$container->name";

	} else {

		elgg_pop_breadcrumb();
		elgg_push_breadcrumb(elgg_echo('wijob:wijob'));
                
		$return['filter_context'] = 'all';
		$return['title'] = elgg_echo('wijob:wijob');
                $return['page_title'] = elgg_echo('wijob:wijob');
 
                
                $sidebar .= elgg_view('webIntFramework/category_sidebar', array(
                                                                        'subtype' => 'wijob',
                                                                        'show_expiry' => "no",
                                                                        'selected_cat' => $category    
                                                                        ));
                
    
	}
        
        
	
        $options['joins'] = $joins;
        $options['wheres'] = $wheres;
	
     if($category!="all"){
	//list all wijob in that category
		$rel_options = array(	
			'relationship_guid' => $category,
			'relationship' => 'wijob_wijobcategory',
                        'inverse_relationship' => true,
			'full_view' => FALSE,
		);
		$options = array_merge($options, $rel_options);		
 
                $return['title'] = elgg_echo('wijob:title:catjob', array($cat_desc));
                $return['page_title'] = elgg_echo('wijob:title:catjob', array($cat_desc));                
	}
        

       $list = elgg_list_entities_from_relationship($options);  
      
	
	if (!$list) {
		$return['content'] = elgg_echo('wijob:none', array($status));
	} else {
		$return['content'] = $list;
	}
        

	
	$return['sidebar'] = $sidebar;

	return $return;
}



function  wijob_get_page_content_friends($user_guid) {

        load_wi_framework();
        load_wi_framework('relationship');

	
	$return = array();
        $return['filter_context'] = 'friends';
        
	$options = array(
			'type' => 'object',
			'subtype' => 'wijob',
			'full_view' => FALSE,
                        'debug' => 'on'
		);

       if (!$friends = get_user_friends($user_guid, ELGG_ENTITIES_ANY_VALUE, 0)) {
		$return['content'] .= elgg_echo('friends:none:you');
		return $return;
	} else {
            foreach ($friends as $friend) {
                    $options['container_guids'][] = $friend->getGUID();
            }
        }
                         

        elgg_load_js("elgg.jquery_min_lib");
        elgg_load_js("elgg.helper");

        $wijob_owner = get_entity($container_guid);

        $return['title'] = elgg_echo('wijob:title:my_job');
        $return['page_title'] = elgg_echo('wijob:title:my_job');
  

        $crumbs_title = $wijob_owner->name;
	elgg_push_breadcrumb($crumbs_title, "job/owner/{$wijob_owner->username}");
	elgg_push_breadcrumb(elgg_echo('friends'));
      
	
        $options['joins'] = $joins;
        $options['wheres'] = $wheres;
        

       $list = elgg_list_entities_from_relationship($options);  
      
	
	if (!$list) {
		$return['content'] = elgg_echo('wijob:none', array($status));
	} else {
		$return['content'] = $list;
	}
        

	
	$return['sidebar'] = $sidebar;

	return $return;
}


function wijob_get_page_content_read($guid = NULL) {
    
        load_wi_framework();
        load_wi_framework('relationship');
        
        elgg_load_js('elgg.wiquote.showhide');

	$return = array();

	$wijob = get_entity($guid);

	// no header or tabs for viewing an individual wijob
	$return['filter'] = '';
	$return['header'] = '';

	if (!elgg_instanceof($wijob, 'object', 'wijob')) {
		$return['content'] = elgg_echo('wijob:error:post_not_found');
		return $return;
	}

	$return['title'] = htmlspecialchars($wijob->title);
        $return['page_title'] = $wijob->title;
        


	elgg_push_breadcrumb($wijob->title);
	
	$return['content'] = elgg_view_entity($wijob, array('full_view' => true));


	return $return;
}

function elgg_register_top_button($handler = null, $name = 'add') {
	if (elgg_is_logged_in()) {

		if (!$handler) {
			$handler = elgg_get_context();
		}

		$owner = elgg_get_page_owner_entity();
		if (!$owner) {
			// no owns the page so this is probably an all site list page
			$owner = elgg_get_logged_in_user_entity();
		}
		if ($owner && $owner->canWriteToContainer()) {
			$guid = $owner->getGUID();
			elgg_register_menu_item('title', array(
				'name' => $name,
				'href' => "$handler/$name/$guid",
				'text' => elgg_echo("$handler:$name"),
				'link_class' => '',
			));
		}
	}
}

function wijob_get_page_content_confirm($wijob_id, $edit_type){
	
	elgg_push_breadcrumb(elgg_echo('wijob:title:my_job'), "job/owner/".elgg_get_logged_in_user_entity()->username."/active");    
	
        $return = array();

	$return['title'] = "Job ".ucfirst($edit_type);
        $return['page_title'] = "Job ".ucfirst($edit_type);
	
	elgg_push_breadcrumb("Job ".ucfirst($edit_type));

	$vars['wijob_id'] = $wijob_id;
	$vars['edit_type'] = $edit_type;
	
	$return['content'] = elgg_view("wijob/confirm", $vars);
        $return['filter_override'] = "";

	return $return;
}

