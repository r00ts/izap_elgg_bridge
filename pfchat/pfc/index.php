<?php
/**
  * Elgg chat plugin
  *
  * @license GNU Public License version 3
  * @author Felix Stahlberg <fstahlberg@gmail.com>
  * @link http://www.xilef-software.de/en/projects/scripts/elggchat
  * @see http://www.phpfreechat.net/
  */
 
// Start Elgg Engine
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

if (get_plugin_setting('strict_access', 'pfchat')) {
  gatekeeper();
}

/*
 * PhpFreeChat Parameters
 */
global $CONFIG;
require_once dirname(__FILE__)."/src/phpfreechat.class.php";
$params = array();
$params['title'] = elgg_echo('CHAT');
$params['nick'] = $_SESSION['user']->username;  // setup the intitial nickname
$params['isadmin'] = isadminloggedin();
$params['serverid'] = 'phpfreechat'; // calculate a unique id for this chat
$params['debug'] = false;
if (get_plugin_setting('container_type', 'pfchat') == 'Mysql') {
  $params['container_type'] = 'Mysql';
  $params['container_cfg_mysql_host'] = $CONFIG->dbhost;
  $params['container_cfg_mysql_port'] = 3306;
  $params['container_cfg_mysql_database'] = $CONFIG->dbname;
  $params['container_cfg_mysql_table'] = $CONFIG->dbprefix . "phpfreechat";
  $params['container_cfg_mysql_username'] = $CONFIG->dbuser;
  $params['container_cfg_mysql_password'] = $CONFIG->dbpass;
}
if (get_plugin_setting('theme', 'pfchat')) {
  $params['theme'] = get_plugin_setting('theme', 'pfchat');
}
if (get_plugin_setting('language', 'pfchat')) {
  $params['language'] = get_plugin_setting('language', 'pfchat');
}
$params['frozen_nick'] = (get_plugin_setting('strict_access', 'pfchat') == 1);
$params['channels'] = explode(',', get_plugin_setting('channels', 'pfchat'));

$pfchat = new phpFreeChat($params);

if (get_plugin_setting('use_popup', 'pfchat')) {
  include dirname(dirname(__FILE__)) . '/popup.inc.php';
} else {
  // Format Page
  $body = elgg_view_layout('one_column', $pfchat->printChat(true));

  // Draw it
  echo  elgg_view_page(elgg_echo('CHAT'), $body);
}

?>
