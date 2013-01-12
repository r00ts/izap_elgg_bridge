<?php
 /**
  * Elgg chat plugin
  *
  * @license GNU Public License version 3
  * @author imoni
  * @see http://www.phpfreechat.net/
  */

/**
 * Initialisation. Register page handler and extend some views.
 */
function chat_init() {
  global $CONFIG;
  
  $item = new ElggMenuItem('pfchat', elgg_echo('Чат'), '/pfchat');
	elgg_register_menu_item('site', $item);
  
  // Add link for users not logged in to access the chat
  if (!get_plugin_setting('strict_access', 'pfchat') && !isloggedin()) {
    if (get_plugin_setting('use_popup', 'pfchat')) {
      add_menu(elgg_echo('chat'), "javascript:chat_open('" . $CONFIG->wwwroot . "pg/pfchat')");
    } 
  }
  // Add styles
  elgg_extend_view('css', 'pfchat/css');
  // Add javascript stuff
  elgg_extend_view('metatags','pfchat/metatags');
  // Register page handler and translations
  register_page_handler('pfchat', 'chat_page_handler');
  register_translations($CONFIG->pluginspath . "pfchat/languages/");
}

/**
 * Sole pagehandler, which handles embbeded *and* popuped pages.
 */
function chat_page_handler($page) {
  @include(dirname(__FILE__) . "/pfc/index.php");
}

/**
 * Returns if there is a actual query for the current user
 */
function chat_is_query() {
  return isset($_COOKIE['chat_elgg_notify_status']) &&
    $_COOKIE['chat_elgg_notify_status'] == 'notify';
}

/**
 * Print a string containing the html code of a selectbox with names of
 * subdirectories in the specified directory.
 */
function chat_print_dir_selectbox($name, $dir, $act) {
  echo '<select name="' . $name . '">';
  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      while (FALSE !== ($subdir = readdir($dh))) {
        if ($subdir == '.' || $subdir == '..' || !is_dir($dir . $subdir)) {
          continue;
        }
        echo '<option value="' . $subdir .   
          ($subdir == $act ? '" selected="selected' : '') .'">' . $subdir . "</option>\n";
      }
      closedir($dh);
    }
  }
  echo '</select>';
}


register_elgg_event_handler('init', 'system', 'chat_init');

?>
