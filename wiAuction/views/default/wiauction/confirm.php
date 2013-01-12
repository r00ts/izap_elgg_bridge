<?php


$wiauction_id = $vars['wiauction_id'];
$edit_type = $vars['edit_type'];

$wiauction = get_entity($wiauction_id);


echo elgg_echo("wiauction:confirm", array(
        $edit_type,
        wi_get_entity_link($wiauction),
        wi_get_my_entities_link("wiauction" ,"active"),
        wi_get_all_entities_link("wiauction")
));

