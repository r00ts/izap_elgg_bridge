<?php
elgg_register_action("my_blog/save", elgg_get_plugins_path() . "my_blog/actions/my_blog/save.php");
elgg_register_page_handler('my_blog', 'my_blog_page_handler');
 
function my_blog_page_handler($segments) {
    if ($segments[0] == 'add') {
        include elgg_get_plugins_path() . 'my_blog/pages/my_blog/add.php';
        return true;
    }
    return false;
}
?>
