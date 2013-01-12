<?php


$wiauction_id = $vars['wiauction_id'];
$edit_type = $vars['edit_type'];

$wiauction = get_entity($wiauction_id);



if($edit_type=="edited"){
    echo elgg_echo("wibid:resubmitted", array(
                            wi_get_entity_link($wiauction),
                            wi_get_my_wibids_link("active"),
                            wi_get_all_entities_link('wiauction')
    ));
}
else{
    echo elgg_echo("wibid:submitted", array(
                            wi_get_entity_link($wiauction),
                            wi_get_my_wibids_link("active"),
                            wi_get_all_entities_link('wiauction')
    ));
}
