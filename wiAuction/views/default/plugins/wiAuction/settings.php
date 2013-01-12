<?php
/**
 * Elgg wiauction Plugin
 * @package wiauction
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Mark (Web Intelligence)
 * @copyright Web intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

$yes = elgg_echo('option:yes');
$no = elgg_echo('option:no');

echo elgg_echo("wiauction:settings:currency");
echo elgg_view('input/text', array(
			'name' => 'params[wiauction_currency]',
			'class' => 'wiauction-admin-input',
			'value' => $vars['entity']->wiauction_currency,
			));

echo "<br />";
echo "<br />";

echo elgg_echo('wiauction:adminonly');


echo elgg_view('input/dropdown', array(
			'name' => 'params[wiauction_adminonly]',
			'value' => $vars['entity']->wiauction_adminonly,
			'options_values' => array(
						'no' => $no,
						'yes' => $yes
						)
			));


