<?php
/**
 * Elgg wijob Plugin
 * @package wijob
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author slyhne
 * @copyright slyhne 2010-2011
 * @link www.zurf.dk/elgg
 * @version 1.8
 */

$wijobguid = $vars['wijobguid'];
$size =  $vars['size'];

echo "<img src='" . elgg_get_site_url() . "mod/wiJob/thumbnail.php?wijobguid={$wijobguid}&size={$size}' class='elgg-photo'>";

