<?php


function wiauctions_get_page_content_edit($page, $guid = 0, $revision = NULL) {
    
        load_wi_framework('relationship');

	elgg_load_js('elgg.wiauction');
        
        elgg_load_js('wiauction.google_map');  
        elgg_load_js('wiauction.jquery_min');
        elgg_load_js('wiauction.jquery_custom');         
        elgg_load_js('wiauction.geo_suggests');  

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'wiauctions-post-edit';
	$vars['name'] = 'wiauctions_post';
	$vars['class'] = 'elgg-form-alt';

	if ($page == 'edit') {
		$wiauction = get_entity((int)$guid);
		//echo '<script type="text/javascript">alert("'.$wiauction->guid.'");</script>';
		//check if its status of active or pending
		

		$title = elgg_echo('wiauctions:edit');

		if (elgg_instanceof($wiauction, 'object', 'wiauction') && $wiauction->canEdit()) {
			//$vars['entity'] = $wiauction;

			$title .= ": \"$wiauction->title\"";

			$body_vars = wiauctions_prepare_form_vars($wiauction);

			elgg_push_breadcrumb($wiauction->title, $wiauction->getURL());
			elgg_push_breadcrumb(elgg_echo('edit'));
			
			elgg_load_js('elgg.wiauction');
			
			$body_vars['view_type'] = "edit";
			$vars['enctype'] =  'multipart/form-data';

			$content = elgg_view_form('wiauction/save', $vars, $body_vars);
			
		} else {
			$content = elgg_echo('wiauctions:error:cannot_edit_post');
		}
	} else {
		if (!$guid) {
			$container = elgg_get_logged_in_user_entity();
		} else {
			$container = get_entity($guid);
		}

		elgg_push_breadcrumb(elgg_echo('wiauctions:add'));
		$body_vars = wiauctions_prepare_form_vars($wiauction);

		$title = elgg_echo('wiauctions:add');
		$body_vars['view_type'] = "add";
		$vars['enctype'] =  'multipart/form-data';
		
		$content = elgg_view_form('wiauction/save', $vars, $body_vars);
		
	//	$wiauction_js = elgg_get_simplecache_url('js', 'wiauctions/save_draft');
		//elgg_register_js('elgg.wiauctions', $wiauction_js);
	}


	$return['title'] = $title;
        $return['page_title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;	
}



function wiauctions_prepare_form_vars($post = NULL, $view = NULL) {

        load_wi_framework();
    
	// input names => defaults
	$values = array(
		'title' => NULL,
		'description' => NULL,
		'access_id' => ACCESS_PUBLIC,
		'tags' => NULL,
		'container_guid' => NULL,
		'guide' => NULL,
                'guid' => NULL,
                'location' => "",
		'wiauctioncategory' => '',
		'expiry_date' => date('Y-m-d'),
	);
	

	if ($post) {
		foreach (array_keys($values) as $field) {
                    
                        switch ($field) {
                            case 'wiauctioncategory':
                                $values[$field] = wi_get_entity_categories($post->getSubtype(), $post->getGUID());
                            break;                      
                            
                            default:
                            	if (isset($post->$field)) {
                                    $values[$field] = $post->$field;
                                }
                            break;
                        }
		}
	}

	if (elgg_is_sticky_form('wiauction')) {
		$sticky_values = elgg_get_sticky_values('wiauction');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('wiauction');

	if (!$post) {
		return $values;
	}
	return $values;
}

/*
 * All wiauctions
 */
function wiauctions_get_page_content_list($container_guid = NULL, $status = "active", $cat_desc = "all", $category = "all", $sort="expiry", $view="all") {


        load_wi_framework('entity');
        load_wi_framework('relationship');        
        //expire some wiauctions
        wi_check_entity_expiry("wiauction");

        $vars['selected_cat'] = $category;

	if ($container_guid) {
                elgg_load_js("elgg.jquery_min_lib");
                elgg_load_js("elgg.helper");
		$vars['view_type'] = "owner";
		$perspective = "owner";

		$wiauction_owner = get_entity($container_guid);

		if($container_guid==elgg_get_logged_in_user_guid()){
		$return['title'] = elgg_echo('wiauctions:title:my_wiauctions');
                $return['page_title'] = elgg_echo('wiauctions:title:my_wiauctions');
		}
		else{
                    //must be in "by" view

                    elgg_push_breadcrumb(elgg_echo('wiauctions:everyone:title'), "auction/all/active");	
                    elgg_push_breadcrumb(elgg_echo('wiauctions:title:users_wiauctions', array($wiauction_owner->name."'s")));	

                    $return['title'] = elgg_echo('wiauctions:title:users_wiauctions', array($wiauction_owner->name."'s"));
                    $return['page_title'] = elgg_echo('wiauctions:title:users_wiauctions', array($wiauction_owner->name."'s"));                            
		}
		


	} else {

            $perspective = "all";
                          
		$vars['view_type'] = "all";

		$return['filter_context'] = 'all';
  
                    $return['title'] = elgg_echo('wiauctions:everyone:title');//elgg_echo('wiauctions:title:all_wiauctions', array(ucfirst($county_val), ucfirst($cat_desc)));
                    $return['page_title'] = elgg_echo('wiauctions:everyone:title');
                    elgg_pop_breadcrumb();
                    elgg_push_breadcrumb(elgg_echo('wiauctions:everyone:title'));
                
                $sidebar .= elgg_view('webIntFramework/category_sidebar', 
                        array('subtype' => 'wiauction',                                                                 
                              'selected_cat' => $cat_guid, 
                              'sort_options' => $sort_options,
                              'sort_val' => $sort  
                            ));
                
                $vars['filter_override'] = "";
        
    }
      if(strlen($category)>0 && $category!="all"){	
            $title = elgg_echo('wiauctions:title:catauction', array($cat_desc));
            $return['title'] = $title;
            $return['page_title'] = $title;            
      }

    
    	if (((elgg_is_admin_logged_in() && $view!="by") || $container_guid == elgg_get_logged_in_user_guid())) {
		$vars['filter_context'] = $status;
                $vars['perspective'] = $perspective;
		$vars['filter_override'] = elgg_view("page/layouts/content/wiauctionfilter", $vars);
	}

        
        if (elgg_get_plugin_setting('wiauction_adminonly', 'wiauction') == 'yes') {
            if(elgg_is_admin_logged_in()){
                elgg_register_title_button("auction","add");
            }    
        }
        else{
           elgg_register_title_button("auction","add"); 
        }

         
        $options = array();
  
        $options = wi_get_entity_options('list', "wiauction", $container_guid, $status, $cat_desc, $category, $sort);
        

       $list = elgg_list_entities_from_relationship($options);  
	
	if (!$list) {
		$return['content'] = elgg_echo('wiauctions:none', array($status));
	} else {
		$return['content'] = $list;
	}
	
	$return['sidebar'] = $sidebar;
	$return['filter_override'] = $vars['filter_override'];

	return $return;
}




function wiauctions_get_page_content_read($guid = NULL) {

        load_wi_framework('relationship');
        load_wi_framework();
        
       
    
	$return = array();

	$wiauction = get_entity($guid);

	// no header or tabs for viewing an individual wiauctions
	$return['filter'] = '';
	$return['header'] = '';

	if (!elgg_instanceof($wiauction, 'object', 'wiauction')) {
		$return['content'] = elgg_echo('wiauctions:error:post_not_found');
		return $return;
	}
        
        // Load fancybox
	elgg_load_js('lightbox');
	elgg_load_css('lightbox');

	$return['title'] = htmlspecialchars($wiauction->title);
        $return['page_title'] = $wiauction->title;
        
	//$container = $wiauction->getContainerEntity();
	//$crumbs_title = $container->name;

	elgg_push_breadcrumb($wiauction->title);
	
	$return['content'] = elgg_view_entity($wiauction, array('full_view' => true));


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

function wiauctions_get_page_content_confirm($wiauction_id, $edit_type){
	
        load_wi_framework();
    
	$return = array();

	$return['title'] = elgg_echo('wiauction')." ".ucfirst($edit_type);
        $return['page_title'] = elgg_echo('wiauction')." ".ucfirst($edit_type);
        
	elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'), "auction/owner/".elgg_get_logged_in_user_entity()->username."/active");        
	
	elgg_push_breadcrumb(elgg_echo('wiauction')." ".ucfirst($edit_type));

	$vars['wiauction_id'] = $wiauction_id;
	$vars['edit_type'] = $edit_type;
	
	$return['content'] = elgg_view("wiauction/confirm", $vars);
        $return['filter_override'] = "";

	return $return;
}


function wiauctions_get_page_content_cancel(){
    
    load_wi_framework();
	
	$return = array();

	$return['title'] = elgg_echo("wiauction:cancelled");
        $return['page_title'] = elgg_echo("wiauction:cancelled");
        
        elgg_push_breadcrumb(elgg_echo('wiauctions:title:my_wiauctions'), "auction/owner/".elgg_get_logged_in_user_entity()->username."/active");
	
	elgg_push_breadcrumb(elgg_echo("wiauction:cancelled"));

	$vars['wiauction_id'] = $wiauction_id;
	$vars['edit_type'] = $edit_type;
	
	$return['content'] = elgg_view("wiauction/cancel");
        $return['filter_override'] = "";

	return $return;
}