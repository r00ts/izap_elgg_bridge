<?php 
/*****************************************************************************
 * Phloor                                                                    *
 *                                                                           *
 * Copyright (C) 2011 Alois Leitner                                          *
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
/**
 * get the current phloor version
 */
function phloor_get_version($humanreadable = false) {
	static $phloor_version, $phloor_release;

	$elgg_version = get_version();
	if($elgg_version === false) {
		return false;
	}
	
	$path = elgg_get_plugins_path() . 'phloor/';
	if (!isset($phloor_version) || !isset($phloor_release)) {
		if (!include($path . "version.php")) {
			return false;
		}
	}
	return (!$humanreadable) ? $phloor_version : $phloor_release;
}


function phloor_elgg_image_instanceof($entity) {
    return ($entity instanceof AbstractPhloorElggImage);
}
function phloor_elgg_thumbnails_instanceof($entity) {
    return ($entity instanceof AbstractPhloorElggThumbnails);
}

function phloor_str_starts_with($haystack, $needle){
    return strpos($haystack, $needle) === 0;
}

function phloor_str_ends_with($haystack, $needle){
    return strrpos($haystack, $needle) === strlen($haystack) - strlen($needle);
}

function phloor_get_current_page_url() {
	$url = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$url .= "s";
	}
	$url .= "://";
	
	if ($_SERVER["SERVER_PORT"] != "80") {
		$url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	
	return $url;
}