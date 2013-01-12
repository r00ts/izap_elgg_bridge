<?php 
/*****************************************************************************
 * Phloor                                                                    *
 *                                                                           *
 * Copyright (C) 2012, 2011 Alois Leitner                                    *
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
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

$guid = get_input("guid");

$entity = get_entity($guid);
if (!$entity || !file_exists($entity->image)) {
	register_error(elgg_echo("phloor:downloadfailed"));
	forward();
}

$file = new ElggFile();
$file->setFilename($entity->image);

$mime = ElggFile::detectMimeType($file, "application/octet-stream");

//$filename = $file->originalfilename;
$filename = time() . file_get_general_file_type($mime);

// fix for IE https issue
header("Pragma: public");

header("Content-type: $mime");
if (strpos($mime, "image/") !== false) {
	header("Content-Disposition: inline; filename=\"$filename\"");
} else {
	header("Content-Disposition: attachment; filename=\"$filename\"");
}

ob_clean();
flush();
//readfile($file->getFilenameOnFilestore());
readfile($entity->image);
exit;
