<?php
/**
 * Elgg wiauction Plugin
 * @package wiauction
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

// Get engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Get file GUID
$wiauctionguid = (int) get_input('wiauctionguid', 0);

$wiauctionpost = get_entity($wiauctionguid);
if (!$wiauctionpost || $wiauctionpost->getSubtype() != "wiauction") {
	exit;
}

// Get owner
$owner = $wiauctionpost->getOwnerEntity();

// Get the size
$size = strtolower(get_input('size'));
if (!in_array($size,array('large','medium','small','tiny','master'))) {
	$size = "medium";
}

// Use master if we need the full size
if ($size == "master") {
	$size = "";
}



// Try and get the icon
$filehandler = new ElggFile();
$filehandler->owner_guid = $owner->guid;
$filehandler->setFilename("wiauction/" . $wiauctionpost->guid . $size . ".jpg");
		
$success = false;
if ($filehandler->open("read")) {
	if ($contents = $filehandler->read($filehandler->size())) {
		$success = true;
	} 
}

if (!$success) {
	$path = elgg_get_site_url() . "mod/wiAuction/graphics/noimage{$size}.png";
	header("Location: $path");
	exit;
}

header("Content-type: image/jpeg");
header('Expires: ' . date('r',time() + 864000));
header("Pragma: public");
header("Cache-Control: public");
header("Content-Length: " . strlen($contents));

$splitString = str_split($contents, 1024);

foreach($splitString as $chunk) {
	echo $chunk;
}

