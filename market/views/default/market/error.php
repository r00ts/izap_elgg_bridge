<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

	// Display an error
?>
<div class="contentWrapper">
  <p>
  <?php echo elgg_echo('market:tomany:text'); ?>
  </p>
  <p>
  <a href="<?php echo $CONFIG->root; ?>terms.php" rel="facebox"><?php echo elgg_echo('market:terms:title'); ?></a>
  </p>
</div>
