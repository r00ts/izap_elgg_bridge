<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

$yes = elgg_echo('option:yes');
$no = elgg_echo('option:no');

echo elgg_echo("wijob:settings:currency");
echo elgg_view('input/text', array(
			'name' => 'params[wijob_currency]',
			'class' => 'wijob-admin-input',
			'value' => $vars['entity']->wijob_currency,
			));

echo "<br />";
echo "<br />";

echo elgg_echo('wijob:adminonly');


echo elgg_view('input/dropdown', array(
			'name' => 'params[wijob_adminonly]',
			'value' => $vars['entity']->wijob_adminonly,
			'options_values' => array(
						'no' => $no,
						'yes' => $yes
						)
			));


