<?php
/**
 * Web Intelligence Framwork
 * @package framework
 * @author Mark Kelly
 * @copyright Web intelligence 2012 - 2013
 * @link www.webintelligence.ie
 * @version 1.1
 */


// start a new sticky form session in case of failure
elgg_make_sticky_form('categories');

// store errors to pass along
$error = FALSE;

//$user = elgg_get_logged_in_user_entity();

// edit or create a new entity
$guid = get_input('guid');
$cat_type = get_input('cat_type');

if ($guid) {
	$category = get_entity($guid);
        
        if (elgg_instanceof($category, 'object', "{$cat_type}") && $category->canEdit()) {
		//proceed
	} else {
		register_error(elgg_echo('category:error:post_not_found'));
		forward(get_input('forward', REFERER));
	}


} else {
	$category = new ElggObject();
	$category->subtype = "{$cat_type}category";
}


// set defaults and required values.
$values = array(
	'title' => '',
	'access_id' => ACCESS_PUBLIC,
	'container_guid' => elgg_get_logged_in_user_guid(),
);


// fail if a required entity isn't set
$required = array('title');


// load from POST and do sanity and access checking
foreach ($values as $name => $default) {
	$value = get_input($name, $default);

	if (in_array($name, $required) && empty($value)) {
		$error = elgg_echo("category:error:missing:$name");
	}

	$values[$name] = $value;
}

// assign values to the entity, stopping on error.
if (!$error) {
	foreach ($values as $name => $value) {
		if (FALSE === ($category->$name = $value)) {
			$error = elgg_echo('categories:error:cannot_save' . "$name=$value");
			break;
		}
	}
}


if (!$error) {
    
    if ($category->save()) {
        // remove sticky form entries
        elgg_clear_sticky_form('categories');
        
        system_message(elgg_echo('category:message:saved'));

       // forward("category/all");

    } else {
        register_error(elgg_echo('categories:error:cannot_save'));
      //  forward($error_forward_url);
    }
} else {
    register_error($error);
    //forward($error_forward_url);
}

