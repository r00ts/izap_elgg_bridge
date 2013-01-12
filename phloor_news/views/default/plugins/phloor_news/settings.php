<?php
/*****************************************************************************
 * Phloor News                                                               *
 *                                                                           *
 * Copyright (C) 2011, 2012 Alois Leitner                                    *
 *                                                                           *
 * This program is free software: you can redistribute it and/or modify      *
 * it under the terms of the GNU General Public License as published by      *
 * the Free Software Foundation, either version 2 of the License, or         *
 * (at your option) any later version.                                       *
 *                                                                           *
 * This program is distributed in the hope that it will be useful,           *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 * GNU General Public License for more details.                              *
 *                                                                           *
 * You should have received a copy of the GNU General Public License         *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 *                                                                           *
 * "When code and comments disagree both are probably wrong." (Norm Schryer) *
 *****************************************************************************/
?>
<?php

$enable_list_layout = $vars['entity']->enable_list_layout;
$element_limit      = $vars['entity']->element_limit;

if (strcmp('true', $enable_list_layout) != 0) {
    $enable_list_layout = 'false';
}

if (!is_numeric($element_limit) || $element_limit < 3) {
    $element_limit = 15;
}
?>
<?php
echo elgg_view_title(elgg_echo('phloor_news:settings:layout:title'));
?>
<div>
<?php echo elgg_echo('phloor_news:settings:layout:enable_list_layout:label'); ?>

<?php
echo elgg_view('phloor/input/enable', array(
	'name' => 'params[enable_list_layout]',
	'value' => $enable_list_layout,
));
?>
<?php echo elgg_echo('phloor_news:settings:layout:enable_list_layout:description'); ?>
</div>

<div>
<?php echo elgg_echo('phloor_news:settings:layout:element_limit:label'); ?>

<?php
echo elgg_view('input/dropdown', array(
	'name' => 'params[element_limit]',
	'value' => $element_limit,
	'options_values' => array(
		 3 => 3,
	 	 6 => 6,
		 9 => 9,
		12 => 12,
		15 => 15,
		18 => 18,
		21 => 21,
		24 => 24,
		27 => 27,
		30 => 30,
	),
));
?>
<?php echo elgg_echo('phloor_news:settings:layout:element_limit:description'); ?>
</div>

<?php 
