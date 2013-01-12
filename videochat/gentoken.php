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

	// Load Elgg engine
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	require_once($CONFIG->pluginspath . "videochat/vendors/opentok-php-sdk.2011-08-26/OpenTokSDK.php");	

	if($user = get_loggedin_user()){
		 $display_name= $user->name;
	} elseif($name = get_input("name", false)){
		 $display_name= $name;
	}

$roomguid = get_input('guid');

	if($roomguid = get_input('guid')){
		if ($room=get_entity($roomguid)) {
		$api = new OpenTokSDK(API_Config::API_KEY,API_Config::API_SECRET);
		     try {
		     	 $title= ''; //$vars['room']->title;
		    	 $metadata= '{"username": "' . $display_name . '"}';
		    	 echo $api->generate_token($title, RoleConstants::PUBLISHER, NULL, $metadata);
		     } catch(OpenTokException $e) {
		       	 print $e->getMessage();
		     }

	        }
	}
?>
