<?php
 /**
  * Elgg pfchat plugin
  *
  * @license GNU Public License version 3
  * @author Felix Stahlberg <fstahlberg@gmail.com>
  * @link http://www.xilef-software.de/en/projects/scripts/elggchat
  * @see http://www.phpfreechat.net/
  */
	 
if (get_plugin_setting('strict_access', 'pfchat')) {
  gatekeeper();
}

// a bit ugly.. nevermind, there is nothing difficult/important here..
if (get_plugin_setting('use_popup', 'pfchat')) {
  echo '<a href="#" onclick="' .
    "chat_open('" . $vars['url'] . 'pg/pfchat\')"';
} else {
  echo '<a href="' . $vars['url'] . 'pg/pfchat"';
}

echo ' id="chat_open_chat_link" class="chat_open' . (chat_is_query() ? '_query' : '') . 
  ' usersettings" title="' . elgg_echo('pfchat:open') . '">' . elgg_echo('pfchat') . '</a>';
?>
