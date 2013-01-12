<?php
// get the form inputs
$title = get_input('title');
$body = get_input('body');
$tags = string_to_tag_array(get_input('tags'));
 
// create a new my_blog object
$blog = new ElggObject();
$blog->subtype = "my_blog";
$blog->title = $title;
$blog->description = $body;
 
// for now make all my_blog posts public
$blog->access_id = ACCESS_PUBLIC;
 
// owner is logged in user
$blog->owner_guid = elgg_get_logged_in_user_guid();
 
// save tags as metadata
$blog->tags = $tags;
 
// save to database and get id of the new my_blog
$blog_guid = $blog->save();
 
// if the my_blog was saved, we want to display the new post
// otherwise, we want to register an error and forward back to the form
if ($blog_guid) {
   system_message("Your blog post was saved");
   forward($blog->getURL());
} else {
   register_error("The blog post could not be saved");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}
?>
