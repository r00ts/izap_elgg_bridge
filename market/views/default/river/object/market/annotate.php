<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

	$statement = $vars['statement'];
	$performed_by = $statement->getSubject();
	$object = $statement->getObject();
	
	$url = "<a href=\"{$performed_by->getURL()}\">{$performed_by->name}</a>";
	$string = sprintf(elgg_echo("market:river:posted"),$url) . " ";
	$string .= elgg_echo("market:river:annotate:create") . " <a href=\"" . $object->getURL() . "\">" . $object->title . "</a>";

?>

<?php echo $string; ?>
