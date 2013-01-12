<p style="font-weight:bold">Note: After changing the settings you have to type <em>/rehash</em> in the pfchat so that the new configuration is loaded.</p>
<h4>Container Type</h4>
<p>
  <select name="params[container_type]">
    <option value="File" <?php if ($vars['entity']->container_type == 'File') echo " selected=\"selected\" "; ?>>File</option>
    <option value="Mysql" <?php if ($vars['entity']->container_type == 'Mysql') echo " selected=\"selected\" "; ?>>MySQL</option>
  </select>
</p>
<p>
  Whether the pfchat stores its data in flat files or in the MySQL database.
</p>
<h4>Access</h4>
<p>
  <select name="params[strict_access]">
    <option value="0" <?php if (!$vars['entity']->strict_access) echo " selected=\"selected\" "; ?>>Lazy access</option>
    <option value="1" <?php if ($vars['entity']->strict_access) echo " selected=\"selected\" "; ?>>Only logged in user</option>
  </select>
<p>
  If you choose <em>Lazy access</em> users not logged in can access the pfchat. This means that everybody can choose his nick even in one session.
</p>
<h4>Behavior</h4>
<p>
  <select name="params[use_popup]">
    <option value="1" <?php if ($vars['entity']->use_popup) echo " selected=\"selected\" "; ?>>Open PopUp</option>
    <option value="0" <?php if (!$vars['entity']->use_popup) echo " selected=\"selected\" "; ?>>Embedded</option>
  </select>
</p>
<p>Set <em>Open PopUp</em> to open the pfchat in a new window so that the user are not supposed to stay on the same page. Use <em>Embbeded</em> to embed the pfchat in one specific page. </p> 
<h4>Theme</h4>
<p>
<?php
chat_print_dir_selectbox('params[theme]', 
  dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/pfc/themes/', 
  $vars['entity']->theme ? $vars['entity']->theme : 'default');
?>
</p>
<p>
  You can use all available PhpFreeChat themes. If you download a new theme, place it in mod/pfchat/pfc/themes and activate it here afterwards.
</p>
<h4>Language</h4>
<p>
<?php
chat_print_dir_selectbox('params[language]', 
  dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/pfc/i18n/', 
  $vars['entity']->language ? $vars['entity']->language : 'en_US');
?>
</p>
<p>
  PhpFreeChat comes with a wide varity of available languages. You find them in mod/pfchat/pfc/i18n.
</p>
<h4>Default Chatrooms</h4>
<p>
    <input type="text" name="params[channels]" value="<?php echo $vars['entity']->channels ?>" />
</p>
<p>
  Define the default chatrooms. You can comma-seperate futher chatrooms if you like.
</p>
