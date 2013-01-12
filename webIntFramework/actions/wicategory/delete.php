<?php
/**
 * Web Intelligence Framwork
 * @package framework
 * @author Mark Kelly
 * @copyright Web intelligence 2012 - 2013
 * @link www.webintelligence.ie
 * @version 1.1 
 */

$category_guid = get_input('guid');
$category = get_entity($category_guid);

if (elgg_instanceof($category, 'object', 'wiauctioncategory') || elgg_instanceof($category, 'object', 'wijobskillcategory')) {
	if ($category->delete()) {
                                
		system_message(elgg_echo('wi:message:deletecat'));

		
	} else {
		register_error(elgg_echo('wi:message:deletefalied'));
	}
} else {
	register_error(elgg_echo('wi:message:deletefalied'));
}

