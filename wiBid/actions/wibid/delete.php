<?php
/**
 * Delete wibid entity
 *
 * @package wibid
 */

if(elgg_is_admin_logged_in()){
	
	$wibid_guid = get_input('guid');
	$wibid = get_entity($wibid_guid);
	
	if (elgg_instanceof($wibid, 'object', 'wibid') && $wibid->canEdit()) {
		if ($wibid->delete()) {
			
			system_message(elgg_echo('wibid:message:deleted'));
			forward(REFERER);
			
		} else {
			register_error(elgg_echo('wibid:error:cannot_delete'));
		}
	} else {
		register_error(elgg_echo('wibid:error:wibid_not_found'));
	}
	
	forward(REFERER);

}
else{
		register_error(elgg_echo('wibid:error:no_permissions'));
		forward(REFERER);
}