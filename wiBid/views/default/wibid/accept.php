<?php


$wibid_id = $vars['wibid_id'];
$wibid = get_entity($wibid_id);
if(!$wibid){
                register_error(elgg_echo("generic_wibid:notfound"));
		forward();
}
$winner = $wibid->getOwnerEntity();

        $wiauction = wi_get_entity_from_wibid("wiauction", $wibid->getGUID());

        if(!$wiauction){
        
                register_error(elgg_echo("generic_wibid:notfound"));
		forward();
        }



$winner_link = elgg_view('output/url', array(
	'href' => $winner->getURL(),
	'text' => $winner->getURL(),
));


echo elgg_echo("wibid:accept", array(
                            wi_get_my_entities_link("wiauction", "closed"),
                            $winner_link,
                            wi_get_entity_link($wiauction)
));


