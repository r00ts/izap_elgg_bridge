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

	admin_gatekeeper();
	
	$result = false;
	
	if($guid = get_input("guid")){
		if($room = get_entity($guid)){
			if($room instanceof ElggObject && $room->getSubtype() == "videochat_room"){
				if($room->delete()){
					system_message(elgg_echo("videochat:actions:delete:succes"));
					$result = true;
				}			
			}
		}
	}
	
	if(!$result){
		register_error(elgg_echo("videochat:actions:delete:error"));
	}

	forward(REFERER);	
?>