<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

echo elgg_view_title(elgg_echo('market:categories:settings'));

?>

<div class="contentWrapper">

<?php

echo elgg_view(
		'input/form',
		array(
			'action' => $vars['url'] . 'action/market/save',
			'method' => 'post',
			'body' => elgg_view('market/forms/settingsform',$vars)
			)
		);

?>

</div>
