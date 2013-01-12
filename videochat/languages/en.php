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

	$english = array(
	
		/**
		 * Menu items and titles
		 */
	
		'videochat:menu:tools' => "Videochat",
		'videochat:menu:rooms' => "All videochatrooms",
		'videochat:menu:create' => "Create a new videochatroom",
		'videochat:menu:group' => "Group videochat",
		'videochat:index:title' => "Videochat",
	
		// settings
		'videochat:settings:enable_popout' => "Enable pop-out",
		
		'videochat:settings:tokbox' => "Tokbox settings",
		'videochat:settings:tokbox:info' => "Please select how you wish to use Tokbox.<br /> When using embed you only have one chatroom for the entire site.<br /> If you wish to have multiple or group chatrooms you have to use API keys.",
		
		'videochat:settings:tokbox:method' => "Tokbox method",
		'videochat:settings:tokbox:method:embed' => "Use embed URL (one chatroom for the entire site)",
		'videochat:settings:tokbox:method:api' => "Use API keys",
		
		'videochat:settings:tokbox:embed' => "Tokbox embed settings",
		'videochat:settings:tokbox:embed:info' => "To get the Embed URL go to <a href=\"http://www.tokbox.com/opentok/plugnplay/basicembed\" target=\"_blank\"/>http://www.tokbox.com/opentok/plugnplay/basicembed</a>, enter your email and click on 'Get code'. Then copy the URL from the iframe with the id 'basicEmbed'",
		'videochat:settings:tokbox:embed_url' => "Embed URL",
		
		'videochat:settings:tokbox:api' => "Tokbox API settings",
		'videochat:settings:tokbox:api:info' => "In order to get API an key you have to go to <a href=\"http://www.tokbox.com/opentok/api/documentation/gettingstarted#getAPIKeyhttp\" target=\"_blank\"/>http://www.tokbox.com/opentok/api/documentation/gettingstarted#getAPIKeyhttp</a>",
		
		'videochat:settings:tokbox:partner_key' => "API key",
		'videochat:settings:tokbox:partner_secret' => "API secret",
		'videochat:settings:tokbox:api_server' => "API Server",
		'videochat:settings:tokbox:api_server:sandbox' => "Sandbox",
		'videochat:settings:tokbox:api_server:production' => "Production",
	
		// Rooms
		'videochat:rooms:no_rooms' => "There are currently no active videochat rooms.",
		'videochat:rooms:start_one' => "Start one %shere%s!",
		'videochat:rooms:login_to_start_one' => "Login or register to start one.",
		'videochat:rooms:missing_call_url' => "Could not start a videochatroom. Room url is missing. Please configure the videochat plugin!",
		
		// popout
		'videochat:popout' => "Open chatroom in separate window/tab",
		'videochat:popout:info' => "This chatroom is opened in a separate window/tab",
		
		// object
		'videochat:room:created_by' => "created by",
		'videochat:room:join' => "Join",
		'videochat:room:group' => "Group: %s",
	
		// create
		'videochat:forms:create' => "Create a new videochatroom",
		'videochat:forms:create:title' => "Name of the chatroom",
		'videochat:forms:create:access' => "Who can see this chatroom in the list?",
		
		// join
		'videochat:join:no_room' => "There is no room available with the provided id.",
		'videochat:join:no_callid' => "There is no room available with the provided id.",
	
		// actions
		'videochat:actions:create:no_title' => "Please enter a title for this chatroom",
		'videochat:actions:create:error_save' => "An error occured while saving the chatroom",
	
		'videochat:actions:delete:succes' => "Delete success",
		'videochat:actions:delete:error' => "Delete failed",
	
	);
					
	add_translation("en",$english);

?>