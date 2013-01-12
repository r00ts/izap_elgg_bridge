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

// Get engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Get the specified wiauction post
$wiauctionguid = (int) get_input('wiauctionguid');

$wiauctionpost = get_entity($wiauctionguid);
if (!$wiauctionpost || $wiauctionpost->getSubtype() != "wiauction") {
	exit;
}

$wiauction_img = elgg_view('output/url', array(
			'href' => "wiauction/view/{$wiauctionpost->guid}/" . elgg_get_friendly_title($wiauctionpost->title),
			'text' => elgg_view('wiauction/thumbnail', array(
								'wiauctionguid' => $wiauctionpost->guid,
								'size' => 'master',
								'class' => 'wiauction-image-popup',
								)),
			));
			
echo "<p style='width: 600px;'>";
echo "<h3>{$wiauctionpost->title}</h3>";
echo $wiauction_img;
echo "</p><br>";

