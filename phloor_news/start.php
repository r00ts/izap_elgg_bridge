<?php

elgg_register_event_handler('init', 'system', 'phloor_news_init');

function phloor_news_init() {

    elgg_register_library('phloor-news', elgg_get_plugins_path() . 'phloor_news/lib/phloor_news.lib.php');
    elgg_load_library('phloor-news');

    // add a site navigation item
    $item = new ElggMenuItem('phloor_news', elgg_echo('phloor_news:phloor_newss'), 'phloor_news/all');
    elgg_register_menu_item('site', $item);

    // add to the main css
    elgg_extend_view('css/elgg', 'phloor_news/css');

    // register the phloor_news's JavaScript
    $phloor_news_js = elgg_get_simplecache_url('js', 'phloor_news/save_draft');
    elgg_register_simplecache_view('js/phloor_news/save_draft');
    elgg_register_js('elgg.phloor_news', $phloor_news_js);

    // routing of urls
    elgg_register_page_handler('phloor_news', 'phloor_news_page_handler');

    // override the default url to view a phloor_news object
    elgg_register_entity_url_handler('object', 'phloor_news', 'phloor_news_url_handler');

    // notifications
    register_notification_object('object', 'phloor_news', elgg_echo('phloor_news:newpost'));
    elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'phloor_news_notify_message');

    // add phloor_news link to
    elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'phloor_news_owner_block_menu');

    // pingbacks
    //elgg_register_event_handler('create', 'object', 'phloor_news_incoming_ping');
    //elgg_register_plugin_hook_handler('pingback:object:subtypes', 'object', 'phloor_news_pingback_subtypes');

    // Register for search.
    elgg_register_entity_type('object', 'phloor_news');

    // Add group option
    add_group_tool_option('phloor_news', elgg_echo('phloor_news:enablephloor_news'), true);
    elgg_extend_view('groups/tool_latest', 'phloor_news/group_module');

    // add a phloor_news widget
    elgg_register_widget_type('phloor_news', elgg_echo('phloor_news'), elgg_echo('phloor_news:widget:description'), 'profile');

    // register actions
    $action_path = elgg_get_plugins_path() . 'phloor_news/actions/phloor_news';
    elgg_register_action('phloor_news/save', "$action_path/save.php");
    elgg_register_action('phloor_news/auto_save_revision', "$action_path/auto_save_revision.php");
    elgg_register_action('phloor_news/delete', "$action_path/delete.php");

    // entity menu
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'phloor_news_entity_menu_setup');

    // ecml
    elgg_register_plugin_hook_handler('get_views', 'ecml', 'phloor_news_ecml_views_hook');

    elgg_set_config('phloor_news', array(
	    'title'            => 'input/text',
		'excerpt'          => 'input/text',
	    'description'      => 'input/longtext',
		'delete_image'     => 'phloor/input/enable',
	    'image'            => 'input/file',
	    'tags'             => 'input/tags',
	    'comments_on'      => 'input/dropdown',
		'access_id'        => 'input/access',
    	'status'           => 'phloor_news/input/statuspicker',
    ));
}

/**
 * Dispatches phloor_news pages.
 * URLs take the form of
 *  All phloor_newss:       phloor_news/all
 *  User's phloor_newss:    phloor_news/owner/<username>
 *  Friends' phloor_news:   phloor_news/friends/<username>
 *  User's archives: phloor_news/archives/<username>/<time_start>/<time_stop>
 *  phloor_news post:       phloor_news/view/<guid>/<title>
 *  New post:        phloor_news/add/<guid>
 *  Edit post:       phloor_news/edit/<guid>/<revision>
 *  Preview post:    phloor_news/preview/<guid>
 *  Group phloor_news:      phloor_news/group/<guid>/all
 *
 * Title is ignored
 *
 * @todo no archives for all phloor_newss or friends
 *
 * @param array $page
 * @return bool
 */
function phloor_news_page_handler($page) {
    // push all news breadcrumb
    elgg_push_breadcrumb(elgg_echo('phloor_news:phloor_newss'), "phloor_news/all");
    
    // check settings to load needed javascript 
    $enable_list_layout = elgg_get_plugin_setting('enable_list_layout', 'phloor_news');
    $load_js = strcmp('true', $enable_list_layout) != 0;
    if($load_js) {
        elgg_load_js('jquery-masonry');
        elgg_extend_view('page/elements/foot', 'phloor_news/js/mansonry');
    }

    if (!isset($page[0])) {
        $page[0] = 'all';
    }

    $page_type = $page[0];
    switch ($page_type) {
        case 'owner':
            $user = get_user_by_username($page[1]);
            $params = phloor_news_get_page_content_list($user->guid);
            break;
        case 'friends':
            $user = get_user_by_username($page[1]);
            $params = phloor_news_get_page_content_friends($user->guid);
            break;
        case 'archive':
            $user = get_user_by_username($page[1]);
            $params = phloor_news_get_page_content_archive($user->guid, $page[2], $page[3]);
            break;
        case 'view':
            $params = phloor_news_get_page_content_read($page[1]);
            break;
        case 'add':
            gatekeeper();
            $params = phloor_news_get_page_content_edit($page_type, $page[1]);
            break;
        case 'edit':
            gatekeeper();
            $params = phloor_news_get_page_content_edit($page_type, $page[1], $page[2]);
            break;
        case 'group':
            $params = phloor_news_get_page_content_list($page[1]);
            break;
        case 'all':
            $params = phloor_news_get_page_content_list();
            break;
        default:
            return false;
    }

    if (!isset($params['sidebar'])) {
        $params['sidebar'] = '';
    }

    $params['sidebar'] .= elgg_view('phloor_news/sidebar', array('page' => $page_type));

    $body = elgg_view_layout('content', $params);

    echo elgg_view_page($params['title'], $body);

    return true;
}

/**
 * Format and return the URL for phloor_newss.
 *
 * @param ElggObject $entity phloor_news object
 * @return string URL of phloor_news.
 */
function phloor_news_url_handler($entity) {
    if (!$entity->getOwnerEntity()) {
        // default to a standard view if no owner.
        return FALSE;
    }

    $friendly_title = elgg_get_friendly_title($entity->title);

    return "phloor_news/view/{$entity->guid}/$friendly_title";
}

/**
 * Add a menu item to an ownerblock
 */
function phloor_news_owner_block_menu($hook, $type, $return, $params) {
    if (elgg_instanceof($params['entity'], 'user')) {
        $url = "phloor_news/owner/{$params['entity']->username}";
        $item = new ElggMenuItem('phloor_news', elgg_echo('phloor_news'), $url);
        $return[] = $item;
    } else {
        if ($params['entity']->phloor_news_enable != "no") {
            $url = "phloor_news/group/{$params['entity']->guid}/all";
            $item = new ElggMenuItem('phloor_news', elgg_echo('phloor_news:group'), $url);
            $return[] = $item;
        }
    }

    return $return;
}

/**
 * Add particular phloor_news links/info to entity menu
 */
function phloor_news_entity_menu_setup($hook, $type, $return, $params) {
    if (elgg_in_context('widgets')) {
        return $return;
    }

    $entity = $params['entity'];
    $handler = elgg_extract('handler', $params, false);
    if ($handler != 'phloor_news') {
        return $return;
    }

    if ($entity->canEdit() && $entity->status != 'published') {
        $status_text = elgg_echo("phloor_news:status:{$entity->status}");
        $options = array(
			'name' => 'published_status',
			'text' => "<span>$status_text</span>",
			'href' => false,
			'priority' => 150,
        );
        $return[] = ElggMenuItem::factory($options);
    }

    return $return;
}

/**
 * Register phloor_newss with ECML.
 */
function phloor_news_ecml_views_hook($hook, $entity_type, $return_value, $params) {
    $return_value['object/phloor_news'] = elgg_echo('phloor_news:phloor_newss');

    return $return_value;
}

