<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

//the page owner
$owner = get_user($vars['entity']->owner_guid);

//the number of files to display
$num = (int) $vars['entity']->num_display;
if (!$num) {
	$num = 4;
}
		
//get the correct size
$size = (int) $vars['entity']->icon_size;
		
// Get the users friends
$posts = get_user_objects($vars['entity']->owner_guid, "market", $num, 0);
		
// display the posts, if there are any
if (is_array($posts) && sizeof($posts) > 0) {

	echo "<div id=\"contentWrapper\">";
		
	if (!$size || $size == 1){
		foreach($posts as $post) {
			$postguid = $post->guid;
			$posttype = elgg_echo($post->marketcategory);
			$postcreated = elgg_echo("market:strapline") . " : " . date("j/m-Y",$post->time_created);
       			$num_comments = elgg_count_comments($post);
       			$comments = elgg_echo("market:replies") . " : " . $num_comments;
			$by = elgg_echo('by');
			$owner = $post->getOwnerEntity();
			$icon = "<p><a href=\"{$post->getURL()}\"><img src=\"".$CONFIG->wwwroot."mod/market/icon.php?marketguid=".$postguid."&size=small\" heigth=\"40\" width=\"40\" /></a></p>";
			$info = "<p><small>{$posttype} : <a href=\"{$post->getURL()}\">{$post->title}</a></small></p>";
			$info .= "<p class=\"owner_timestamp\"><small>{$comments}</a></small></p>";
			$info .= "<p class=\"owner_timestamp\"><small>{$postcreated}</small></p>";
			echo elgg_view_listing($icon,$info);				
		}
			
	}
	echo "<div class=\"contentWrapper\"><a href=\"{$CONFIG->wwwroot}pg/market/owner/{$owner->username}\">" . elgg_echo("market:widget:viewall") . "</a></div>";

	echo "<div class=\"clearfloat\"></div>";
					
	echo "</div>";
			
}
	
?>
