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

	$form_body .= "<div><label>" . elgg_echo("videochat:forms:create:title") . "</label>";
	$form_body .= elgg_view("input/text", array("internalname" => "title"));
	$form_body .= "</div><div><label>" . elgg_echo("videochat:forms:create:access") . "</label></div><div>";
	$form_body .= elgg_view("input/access", array("internalname" => "access"));
	$form_body .= "</div>";
	$form_body .= elgg_view("input/submit", array("value" => elgg_echo("save")));
	
	$form = elgg_view("input/form", array("body" => $form_body, "action" => $CONFIG->wwwroot . "action/videochat/create"));
	

?>
<div class="contentWrapper">

	<?php echo $form; ?>

</div>