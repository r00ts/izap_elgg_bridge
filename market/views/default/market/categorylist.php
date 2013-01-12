<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

$list = elgg_view('market/list',$vars);
if (!empty($list)) {
?>

	<div class="blog_categories">
	<?php echo $list; ?>
	</div>

<?php
}
?>
