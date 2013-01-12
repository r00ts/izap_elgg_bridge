<?php 
        /**
         * @package OpenTok VideoChat
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
	 * @author Jeroen Dalsem, ColdTrick IT Solutions [jdalsem@coldtrick.com]
         * @link http://coldtrick.com/
	 * @remark Please see CREDITS
         */

	global $CONFIG;

	require_once($CONFIG->pluginspath . "videochat/vendors/opentok-php-sdk.2011-08-26/OpenTokSDK.php");
	
	$title = get_input("title");
	$access = get_input("access", ACCESS_PRIVATE);
	
	if(!empty($title)){
		    $api = new OpenTokSDK(API_Config::API_KEY,API_Config::API_SECRET);
try {
	$session_id= $api->create_session('127.0.0.1')->getSessionId();
}catch(OpenTokException $e) {
	print $e->getMessage();
}

	if(!empty($session_id)){
			
		$room =  new ElggObject();
		$room->subtype = "videochat_room";
		$room->title = $title;
		$room->access_id = $access;		
				
		if($room->save()){
			$room->session_id = $session_id;
			$forward = $CONFIG->wwwroot . "pg/videochat/join/" . $room->getGUID();
		} else {
			register_error(elgg_echo("videochat:actions:create:error_save"));
			$forward = REFERER;
		}	
	} else {
			register_error(elgg_echo("videochat:actions:create:no_call_id"));
			$forward = REFERER;
		}
			
	} else {
		register_error(elgg_echo("videochat:actions:create:no_title"));
		$forward = REFERER;
	}

	forward($forward);
?>