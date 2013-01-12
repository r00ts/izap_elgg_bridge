<?php


/**
 * Default attributes
 *
 * @return array with default values
 */
function phloor_news_default_vars() {
    $defaults = array(
    	'title' => '',
    	'description' => '',
    	'status' => 'draft',
    	'access_id' => ACCESS_DEFAULT,
    	'comments_on' => 'On',
    	'excerpt' => '',
    	'tags' => '',
    	'container_guid' => (int)get_input('container_guid'),
		'delete_image' => 'false',
	    'image' => '',
    );

    return $defaults;
}


/**
 * Get page components to view a phloor_news post.
 *
 * @param int $guid GUID of a phloor_news entity.
 * @return array
 */
function phloor_news_get_page_content_read($guid = NULL) {

    $return = array();

    $phloor_news = get_entity($guid);

    // no header or tabs for viewing an individual phloor_news
    $return['filter'] = '';

    if (!elgg_instanceof($phloor_news, 'object', 'phloor_news')) {
        $return['content'] = elgg_echo('phloor_news:error:post_not_found');
        return $return;
    }

    $return['title'] = htmlspecialchars($phloor_news->title);

    $container = $phloor_news->getContainerEntity();
    $crumbs_title = $container->name;
    if (elgg_instanceof($container, 'group')) {
        elgg_push_breadcrumb($crumbs_title, "phloor_news/group/$container->guid/all");
    } else {
        elgg_push_breadcrumb($crumbs_title, "phloor_news/owner/$container->username");
    }

    elgg_push_breadcrumb($phloor_news->title);
    $return['content'] = elgg_view_entity($phloor_news, array('full_view' => true));
    //check to see if comment are on
    if ($phloor_news->comments_on != 'Off') {
        $return['content'] .= elgg_view_comments($phloor_news);
    }

    return $return;
}

/**
 * Get page components to list a user's or all phloor_news objects.
 *
 * @param int $owner_guid The GUID of the page owner or NULL for all phloor_news objects
 * @return array
 */
function phloor_news_get_page_content_list($container_guid = NULL) {
    $element_limit = elgg_get_plugin_setting('element_limit', 'phloor_news');
    if (!is_numeric($element_limit) || $element_limit < 3) {
        $element_limit = 15;
    }
    
    $return = array();

    $return['filter_context'] = $container_guid ? 'mine' : 'all';

    $options = array(
		'type' => 'object',
		'subtype' => 'phloor_news',
		'full_view' => FALSE,
        'limit' => get_input('limit', $element_limit),
		'list_class' => 'elgg-list-entity phloor-list-news',
    );

    $loggedin_userid = elgg_get_logged_in_user_guid();
    if ($container_guid) {
        // access check for closed groups
        group_gatekeeper();

        $options['container_guid'] = $container_guid;
        $container = get_entity($container_guid);
        if (!$container) {
            return false;
        }
        $return['title'] = elgg_echo('phloor_news:title:user_phloor_newss', array($container->name));

        $crumbs_title = $container->name;
        elgg_push_breadcrumb($crumbs_title);

        if ($container_guid == $loggedin_userid) {
            $return['filter_context'] = 'mine';
        } else if (elgg_instanceof($container, 'group')) {
            $return['filter'] = false;
        } else {
            // do not show button or select a tab when viewing someone else's posts
            $return['filter_context'] = 'none';
        }
    } else {
        $return['filter_context'] = 'all';
        $return['title'] = elgg_echo('phloor_news:title:all_phloor_newss');
        elgg_pop_breadcrumb();
        elgg_push_breadcrumb(elgg_echo('phloor_news:phloor_newss'));
    }

    elgg_register_title_button();

    // show only published posts for other users.
    if (!(elgg_is_admin_logged_in() || (elgg_is_logged_in() && $container_guid == $loggedin_userid))) {
        $options['metadata_name_value_pairs'] = array(
            array('name' => 'status', 'value' => 'published'),
        );
    }

    $list = elgg_list_entities_from_metadata($options);
    if (!$list) {
        $return['content'] = elgg_echo('phloor_news:none');
    } else {
        $return['content'] = $list;
    }

    return $return;
}

/**
 * Get page components to list of the user's friends' posts.
 *
 * @param int $user_guid
 * @return array
 */
function phloor_news_get_page_content_friends($user_guid) {

    $user = get_user($user_guid);
    if (!$user) {
        forward('phloor_news/all');
    }

    $return = array();

    $return['filter_context'] = 'friends';
    $return['title'] = elgg_echo('phloor_news:title:friends');

    $crumbs_title = $user->name;
    elgg_push_breadcrumb($crumbs_title, "phloor_news/owner/{$user->username}");
    elgg_push_breadcrumb(elgg_echo('friends'));

    elgg_register_title_button();

    if (!$friends = get_user_friends($user_guid, ELGG_ENTITIES_ANY_VALUE, 0)) {
        $return['content'] .= elgg_echo('friends:none:you');
        return $return;
    } else {
        $options = array(
			'type' => 'object',
			'subtype' => 'phloor_news',
			'full_view' => FALSE,
        );

        foreach ($friends as $friend) {
            $options['container_guids'][] = $friend->getGUID();
        }

        // admin / owners can see any posts
        // everyone else can only see published posts
        if (!(elgg_is_admin_logged_in() || (elgg_is_logged_in() && $owner_guid == elgg_get_logged_in_user_guid()))) {
            if ($upper > $now) {
                $upper = $now;
            }

            $options['metadata_name_value_pairs'][] = array(
            array('name' => 'status', 'value' => 'published')
            );
        }

        $list = elgg_list_entities_from_metadata($options);
        if (!$list) {
            $return['content'] = elgg_echo('phloor_news:none');
        } else {
            $return['content'] = $list;
        }
    }

    return $return;
}

/**
 * Get page components to show phloor_newss with publish dates between $lower and $upper
 *
 * @param int $owner_guid The GUID of the owner of this page
 * @param int $lower      Unix timestamp
 * @param int $upper      Unix timestamp
 * @return array
 */
function phloor_news_get_page_content_archive($owner_guid, $lower = 0, $upper = 0) {

    $now = time();

    $user = get_user($owner_guid);
    elgg_set_page_owner_guid($owner_guid);

    $crumbs_title = $user->name;
    elgg_push_breadcrumb($crumbs_title, "phloor_news/owner/{$user->username}");
    elgg_push_breadcrumb(elgg_echo('phloor_news:archives'));

    if ($lower) {
        $lower = (int)$lower;
    }

    if ($upper) {
        $upper = (int)$upper;
    }

    $options = array(
		'type' => 'object',
		'subtype' => 'phloor_news',
		'full_view' => FALSE,
    );

    if ($owner_guid) {
        $options['owner_guid'] = $owner_guid;
    }

    // admin / owners can see any posts
    // everyone else can only see published posts
    if (!(elgg_is_admin_logged_in() || (elgg_is_logged_in() && $owner_guid == elgg_get_logged_in_user_guid()))) {
        if ($upper > $now) {
            $upper = $now;
        }

        $options['metadata_name_value_pairs'] = array(
        array('name' => 'status', 'value' => 'published')
        );
    }

    if ($lower) {
        $options['created_time_lower'] = $lower;
    }

    if ($upper) {
        $options['created_time_upper'] = $upper;
    }

    $list = elgg_list_entities_from_metadata($options);
    if (!$list) {
        $content .= elgg_echo('phloor_news:none');
    } else {
        $content .= $list;
    }

    $title = elgg_echo('date:month:' . date('m', $lower), array(date('Y', $lower)));

    return array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
    );
}

/**
 * Get page components to edit/create a phloor_news post.
 *
 * @param string  $page     'edit' or 'new'
 * @param int     $guid     GUID of phloor_news post or container
 * @param int     $revision Annotation id for revision to edit (optional)
 * @return array
 */
function phloor_news_get_page_content_edit($page, $guid = 0, $revision = NULL) {

    elgg_load_js('elgg.phloor_news');

    $return = array(
		'filter' => '',
    );

    $vars = array();
    $vars['id'] = 'phloor_news-post-edit';
    $vars['name'] = 'phloor_news_post';
    $vars['class'] = 'elgg-form-alt';

    $vars['enctype'] = 'multipart/form-data';
    if ($page == 'edit') {
        $phloor_news = get_entity((int)$guid);

        $title = elgg_echo('phloor_news:edit');

        if (elgg_instanceof($phloor_news, 'object', 'phloor_news') && $phloor_news->canEdit()) {
            $vars['entity'] = $phloor_news;

            $title .= ": \"$phloor_news->title\"";

            if ($revision) {
                $revision = elgg_get_annotation_from_id((int)$revision);
                $vars['revision'] = $revision;
                $title .= ' ' . elgg_echo('phloor_news:edit_revision_notice');

                if (!$revision || !($revision->entity_guid == $guid)) {
                    $content = elgg_echo('phloor_news:error:revision_not_found');
                    $return['content'] = $content;
                    $return['title'] = $title;
                    return $return;
                }
            }

            $body_vars = phloor_news_prepare_form_vars($phloor_news, $revision);

            elgg_push_breadcrumb($phloor_news->title, $phloor_news->getURL());
            elgg_push_breadcrumb(elgg_echo('edit'));
            	
            elgg_load_js('elgg.phloor_news');

            $content = elgg_view_form('phloor_news/save', $vars, $body_vars);
            $sidebar = elgg_view('phloor_news/sidebar/revisions', $vars);
        } else {
            $content = elgg_echo('phloor_news:error:cannot_edit_post');
        }
    } else {
        if (!$guid) {
            $container = elgg_get_logged_in_user_entity();
        } else {
            $container = get_entity($guid);
        }

        elgg_push_breadcrumb(elgg_echo('phloor_news:add'));
        $body_vars = phloor_news_prepare_form_vars($phloor_news);

        $title = elgg_echo('phloor_news:add');
        $content = elgg_view_form('phloor_news/save', $vars, $body_vars);
    }
    unset($vars['enctype']);

    $return['title'] = $title;
    $return['content'] = $content;
    $return['sidebar'] = $sidebar;
    return $return;
}

/**
 * Pull together phloor_news variables for the save form
 *
 * @param PhloorNews       $post
 * @param ElggAnnotation $revision
 * @return array
 */
function phloor_news_prepare_form_vars($post = NULL, $revision = NULL) {

    // input names => defaults
    $values = array(
		'title' => NULL,
		'description' => NULL,
		'status' => 'published',
		'access_id' => ACCESS_DEFAULT,
		'comments_on' => 'On',
		'excerpt' => NULL,
		'tags' => NULL,
		'container_guid' => NULL,
		'guid' => NULL,
		'draft_warning' => '',
    );

    if ($post) {
        foreach (array_keys($values) as $field) {
            if (isset($post->$field)) {
                $values[$field] = $post->$field;
            }
        }
    }

    if (elgg_is_sticky_form('phloor_news')) {
        $sticky_values = elgg_get_sticky_values('phloor_news');
        foreach ($sticky_values as $key => $value) {
            $values[$key] = $value;
        }
    }

    elgg_clear_sticky_form('phloor_news');

    if (!$post) {
        return $values;
    }

    // load the revision annotation if requested
    if ($revision instanceof ElggAnnotation && $revision->entity_guid == $post->getGUID()) {
        $values['revision'] = $revision;
        $values['description'] = $revision->value;
    }

    // display a notice if there's an autosaved annotation
    // and we're not editing it.
    if ($auto_save_annotations = $post->getAnnotations('phloor_news_auto_save', 1)) {
        $auto_save = $auto_save_annotations[0];
    } else {
        $auto_save == FALSE;
    }

    if ($auto_save && $auto_save->id != $revision->id) {
        $values['draft_warning'] = elgg_echo('phloor_news:messages:warning:draft');
    }

    return $values;
}

/**
 * Forward to the new style of URLs
 *
 * @param string $page
 */
function phloor_news_url_forwarder($page) {
    global $CONFIG;

    // group usernames
    if (substr_count($page[0], 'group:')) {
        preg_match('/group\:([0-9]+)/i', $page[0], $matches);
        $guid = $matches[1];
        $entity = get_entity($guid);
        if ($entity) {
            $url = "{$CONFIG->wwwroot}phloor_news/group/$guid/all";
            register_error(elgg_echo("changebookmark"));
            forward($url);
        }
    }

    // user usernames
    $user = get_user_by_username($page[0]);
    if (!$user) {
        return;
    }

    if (!isset($page[1])) {
        $page[1] = 'owner';
    }

    switch ($page[1]) {
        case "read":
            $url = "{$CONFIG->wwwroot}phloor_news/view/{$page[2]}/{$page[3]}";
            break;
        case "archive":
            $url = "{$CONFIG->wwwroot}phloor_news/archive/{$page[0]}/{$page[2]}/{$page[3]}";
            break;
        case "friends":
            $url = "{$CONFIG->wwwroot}phloor_news/friends/{$page[0]}";
            break;
        case "new":
            $url = "{$CONFIG->wwwroot}phloor_news/add/$user->guid";
            break;
        case "owner":
            $url = "{$CONFIG->wwwroot}phloor_news/owner/{$page[0]}";
            break;
    }

    register_error(elgg_echo("changebookmark"));
    forward($url);
}


function phloor_news_instanceof($news) {
    return elgg_instanceof($news, 'object', 'phloor_news', 'PhloorNews');
}

/**
 * Load vars from given site into and returns them as array
 *
 * @return array with stored values
 */
function phloor_news_save_vars(PhloorNews $news, $params) {
    if(!phloor_news_instanceof($news)) {
        return false;
    }

    // get default params
    $defaults = phloor_news_default_vars();

    // merge with given params
    $vars = array_merge($defaults, $params);

    // delete image if checkbox was set
    if($vars['delete_image'] == 'true' &&
    $news->hasImage()) {
        //system_message(elgg_echo('phloor_news:message:delete_image:success'));
        $news->deleteImage();
    }
     
    // check variables
    if(!phloor_news_check_vars($news, $vars)) {
        return false;
    }

    // reset the delete_image var
    unset($vars['delete_image']);

    // adopt variables
    foreach($vars as $key => $value) {
        $news->$key = $value;
    }

    // save and return status
    return $news->save();
}

function phloor_news_check_vars(PhloorNews $news, &$params) {
    if(!phloor_news_instanceof($news)) {
        return false;
    }

    // see if an image has been set.. if not.. explicitly reassign the current one!
    if (!isset($params['image']) || empty($params['image']) || $params['image']['error'] == 4) {
        $params['image'] = $news->hasImage() ? $news->image : '';
    } else {
        $mime = array(
			'image/gif' => 'gif',
			'image/jpg' => 'jpeg',
			'image/jpeg' => 'jpeg',
			'image/pjpeg' => 'jpeg',
			'image/png' => 'png',
        );

        if (!array_key_exists($params['image']['type'], $mime)) {
            register_error(elgg_echo('phloor_news:image_mime_type_not_supported', array(
            $params['image']['type'],
            )));
            return false;
        }
        if ($params['image']['error'] != 0) {
            register_error(elgg_echo('phloor_news:upload_error', array(
            $params['image']['error'],
            )));
            return false;
        }

        $tmp_filename = $params['image']['tmp_name'];
        $params['mime'] = $params['image']['type'];

        // determine filename (clean title)
        $clean_title = ereg_replace("[^A-Za-z0-9]", "", $params['title']); // just numbers and letters
        $filename = $clean_title . '.' . time() . '.' . $mime[$params['mime']];
        $prefix = "phloor_news/images/";

        $image = new ElggFile();
        $image->setMimeType($params['mime']);
        $image->setFilename($prefix . $filename);
        $image->open("write");
        $image->close();

        // move the file to the data directory
        $move = move_uploaded_file($_FILES['image']['tmp_name'], $image->getFilenameOnFilestore());
        // report errors if that did not succeed
        if(!$move) {
            register_error(elgg_echo('phloor_news:could_not_move_uploaded_file'));
            return false;
        }

        $params['image'] = $image->getFilenameOnFilestore();
    }

    // fail if a required entity isn't set
    $required = array('title', 'description');

    // load from news and do sanity and access checking
    foreach ($required as $name) {
        if (!isset($params[$name]) || empty($params[$name])) {
            register_error(elgg_echo("phloor_news:error:missing:$name"));
            return false;
        }
    }

    return true;
}

/**
 * Load vars from post or get requests and returns them as array
 *
 * @return array with values from the request
 */
function phloor_news_get_input_vars() {
    $values['container_guid'] = '';
    // set defaults and required values
    $values = phloor_news_default_vars();
    $values['container_guid'] = (int) get_input('container_guid', $values['container_guid']);

    $user = elgg_get_logged_in_user_entity();
    foreach ($values as $name => $default) {
        $value = get_input($name, $default);
        switch ($name) {
            // get the image from $_FILES array
            case 'image':
                $values['image'] = $_FILES['image'];
                break;
            case 'tags':
                if ($value) {
                    $values['tags'] = string_to_tag_array($value);
                } else {
                    unset ($values['tags']);
                }
                break;
            case 'excerpt':
                if ($value) {
                    $value = elgg_get_excerpt($value);
                } else {
                    $value = elgg_get_excerpt($values['description']);
                }
                $values['excerpt'] = $value;
                break;
            case 'container_guid':
                // this can't be empty or saving the base entity fails
                if (!empty($value)) {
                    if (can_write_to_container($user->getGUID(), $value)) {
                        $values['container_guid'] = $value;
                    } else {
                        $error = elgg_echo("phloor_news:error:cannot_write_to_container");
                    }
                } else {
                    unset($values['container_guid']);
                }
                break;
                // don't try to set the guid
            case 'guid':
                unset($values['guid']);
                break;
            default:
                $values[$name] = $value;
                break;
        }
    }

    return $values;
}
