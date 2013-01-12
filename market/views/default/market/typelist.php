<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */


//get the buy, sell,swap, free as links to a search
	if (!empty($list)) {
?>

	<div class="blog_categories">
		<?php echo $list; ?>
	</div>

<?php

	} else {
?>
	<div class="blog_categories">
	<div class="blog_marketcategories">
	<h3><?php echo elgg_echo('Annoncetype'); ?></h3>
		<ul>
		<li><a href="#">K&oslash;bes</a></li>
		<li><a href="#">S&aelig;lges</a></li>
		<li><a href="#">Byttes</a></li>
		<li><a href="#">Bortgives</a></li>
		</ul>
	</div>
	</div>
<?php	
	}
?>
