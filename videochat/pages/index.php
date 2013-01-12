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

	// title
	$title_text = elgg_echo("videochat:index:title");
	$content = elgg_view_title($title_text);
	
	
	if(elgg_get_plugin_setting("tokbox_method", "videochat") != "embed"){
	
		$rooms_options = array(
				"type" => "object",
				"subtype" => "videochat_room",
				"limit" => false
			);
			
		$rooms = elgg_list_entities($rooms_options);
		if(empty($rooms)){
			$body = elgg_echo("videochat:rooms:no_rooms");
			if(isloggedin()){
				$body .= " " . sprintf(elgg_echo("videochat:rooms:start_one"), "<a href='" . $CONFIG->wwwroot ."pg/videochat/create'>", "</a>");
			} else {
				$body .= " " . elgg_echo("videochat:rooms:login_to_start_one");
			}
			
			$rooms = elgg_view("page_elements/contentwrapper", array("body" => $body));
		}
		
		$content .= $rooms;
		
	    //select the correct canvas area
		$body = elgg_view_layout('two_column_left_sidebar', array(
    'content' => $content,
    'title' => $title,
    'sidebar' => $sidebar,
));

	} else {
		$title = elgg_view_title($title_text);

		$embed_url = elgg_get_plugin_setting("tokbox_embed_url", "videochat");
		$embed= '<iframe id="basicEmbed" src="' . $embed_url . '" width="350" height="265" style="border:none"></iframe>';


		$body = elgg_view_layout('one_column', array(
    'content' => $embed,
    'title' => $title,
));
	}
	
	// Display page
	echo elgg_view_page($title_text,$body);
?>
