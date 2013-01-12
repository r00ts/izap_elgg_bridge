<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

if (is_plugin_enabled('tag_cumulus')){
?>

<div class="sidebarBox">

<h3 style="color:#333333;"><?php echo elgg_echo('tags') ?></h3>

        <!-- display cumulus photos -->

<?php

	echo display_tag_cumulus(0,50,'tags','object','market','','');
?>

<div class="clearfloat"></div>
</div>
<?php

}

?>
