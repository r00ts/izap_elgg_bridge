<?php
// make sure only logged in users can see this page 
gatekeeper();
 
// set the title
// for distributed plugins, be sure to use elgg_echo() for internationalization
$title = "Create a new my_blog post";
 
// start building the main column of the page
$content = elgg_view_title($title);
 
// add the form to this section
$content .= elgg_view_form("my_blog/save");
 
// optionally, add the content for the sidebar
$sidebar = "";
 
// layout the page
$body = elgg_view_layout('one_sidebar', array(
   'content' => $content,
   'sidebar' => $sidebar
));
 
// draw the page
echo elgg_view_page($title, $body);
?>


