<?php
/**
 * Elgg Auctions Plugin
 * @package Auctions
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Mark Kelly/Web Intelligence
 * @copyright Web Intelligence
 * @link www.webintelligence.ie
 * @version 1.8
 */

$wiauctionguid = $vars['wiauctionguid'];
$size =  $vars['size'];



echo "<img src='" . elgg_get_site_url() . "mod/wiAuction/thumbnail.php?wiauctionguid={$wiauctionguid}&size={$size}' class='elgg-photo'>";

