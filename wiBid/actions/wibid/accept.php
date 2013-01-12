<?php
/**
 * Elgg add wibid action
 *
 * @package Elgg.Core
 * @subpackage Comments
 */


$wibid_id = get_input('wibid_id');
$wibid = get_entity($wibid_id);
if (!$wibid) {	
	register_error(elgg_echo("generic_wibid:notfound"));
	forward(REFERER);
}
$wiauction_id = get_input('wiauction_id');

$wiauction = get_entity($wiauction_id);

if (!$wiauction) {
	register_error(elgg_echo("generic_wibid:notfound"));
	forward(REFERER);
}


$user = elgg_get_logged_in_user_entity();

if($user->getGUID()!=$wiauction->getOwnerGUID()){ 	
    register_error(elgg_echo("wibid:invalid"));
    forward(REFERER);		
}
	

//all this is not related	
$other_wibids = elgg_get_entities_from_relationship(array(
                                                'relationship' => 'wiauction_wibid',
                                                'relationship_guid' => $wiauction_id,
                                                'limit' => 999
                                        ));
        
        $site = elgg_get_site_entity();
		
foreach($other_wibids as $other_wibid){
    if($wibid_id == $other_wibid->getGUID()){
    	//success so notidy wibidder
        notify_user($wibid->getOwnerGUID(),
            $site->getGUID(),
            elgg_echo('wibid:email:accept:subject'),
            elgg_echo('wibid:email:accept:body', array(
                                            $wiauction->getURL(), 	
                                            elgg_view("output/url", array(
                                            'href' => $user->getURL(),
                                            'text' => $user->getURL()))))
        );
        
        
    }
    else{
        
        //change relationship status
            //delete old relationship (wibid_tender) and changed to wiauction_wibid_winner
            if(!remove_entity_relationship($wiauction_id, "wiauction_wibid", $other_wibid->getGUID())){
                register_error(elgg_echo('wiauctions:message:wibid:error'));
                forward(REFERER);
            }

            if(!add_entity_relationship($wiauction_id, "wiauction_wibid_lose", $other_wibid->getGUID())){
                register_error(elgg_echo('wiauctions:message:wibid:error'));
                forward(REFERER);        
            }
    	//notify all others they were not successful
        notify_user($other_wibid->getOwnerGUID(),
            $site->getGUID(),
            elgg_echo('wibid:email:wiauction:closed:subject'),
            elgg_echo('wibid:email:wiauction:closed:body')
        );
        
	    //set the topbar notification
		$wibid_loser = get_user($other_wibid->getOwnerGUID());
		      
        
    }
}
    //change active_wiauction relationship to closed_wiauction
    if(!remove_entity_relationship($user->getGUID(), 'active_wiauction', $wiauction_id)){
    	register_error(elgg_echo('wiauctions:message:wibid:error'));
     	forward(REFERER);
    }
    else{
        if(!add_entity_relationship($user->getGUID(), "closed_wiauction", $wiauction_id)){
            register_error(elgg_echo('wiauctions:message:wibid:error'));
            forward(REFERER);        
        }        
    }



    //delete old relationship (wibid_tender) and changed to wiauction_wibid_winner
    if(!remove_entity_relationship($wiauction_id, "wiauction_wibid", $wibid_id)){
    	register_error(elgg_echo('wiauctions:message:wibid:error'));
     	forward(REFERER);
    }
    
    if(!add_entity_relationship($wiauction_id, "wiauction_wibid_win", $wibid_id)){
    	register_error(elgg_echo('wiauctions:message:wibid:error'));
     	forward(REFERER);        
    }
          	
	forward("bid/accept/".$wibid_id);
