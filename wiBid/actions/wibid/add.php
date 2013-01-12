<?php
/**
 * Elgg add wibid action
 *
 * @package Elgg.Core
 * @subpackage Comments
 */


elgg_set_context("adding_wibid");
$wiauction_guid = (int) get_input('wiauction_guid');

$exist_wibid = (int) get_input('exist_wibid_guid');

$amount = get_input('amount');
$wibid_location = get_input('location');

if (empty($wibid_location)){		
	register_error(elgg_echo("wibid:nolocation"));
	forward(REFERER);
}

if (!is_numeric($amount)){		
	register_error(elgg_echo("wibid:notnum"));
	forward(REFERER);
}

// Let's see if we can get an entity with the specified GUID
$wiauction = get_entity($wiauction_guid);
if (!$wiauction) {	
	register_error(elgg_echo("generic_wibid:notfound"));
	forward(REFERER);
}

if(wi_get_entity_status($wiauction_guid)!="active" && wi_get_entity_status($wiauction_guid)!="expired"){
	register_error(elgg_echo("wibid:wiauction:closed"));
	forward(REFERER);
}

$user = elgg_get_logged_in_user_entity();

if($exist_wibid){
    $wibid_obj = get_entity($exist_wibid);
    if (!$wibid_obj) {	
            register_error(elgg_echo("generic_wibid:notfound"));
            forward(REFERER);
    }    
}else{

	$wibid_obj = new ElggObject();
        $wibid_obj->subtype = 'wibid';
}

	
	//$wibid_obj->file_guid = $file_guid;
	$wibid_obj->amount = $amount;
        $wibid_obj->location = $wibid_location;
	$wibid_obj->owner_guid = $user->guid;
        
        if(!can_write_to_container($user->guid, $wiauction_guid)){
		register_error(elgg_echo('wibid:failure'));
		forward(REFERER);
        }
       
        //wibid can only ever have one wiauction so set wiauction id as the conatainer giud
        $wibid_obj->container_guid = $wiauction_guid;
	$wibid_obj->access_id = ACCESS_PUBLIC;


	$wibid_guid = $wibid_obj->save();
	
	if(!$wibid_guid){
		register_error(elgg_echo('wibid:failure'));
		forward(REFERER);
	}
	else{
            //create the relationship            
            if(!wi_add_entities_relationship("wiauction_wibid", $wiauction, $wibid_obj)){
                   register_error(elgg_echo('wibid:failure'));
                    forward(REFERER);                  
            }

            

        // notify if poster wasn't owner
        if ($wiauction->owner_guid != $user->guid) {

                $site = elgg_get_site_entity();

                if($exist_wibid){
                        $subject = elgg_echo('wibid:email:edit:subject', array($user->name));
                        $body = elgg_echo('wibid:email:edit:body', array(
                                                $user->name,
                                                $wiauction->title,
                                                $amount,
                                                $wiauction->getURL(),
                                        ));		
                }
                else{

                    
                        $subject = elgg_echo('wibid:email:subject');
                        $body = elgg_echo('wibid:email:body', array(
                                                $wiauction->title,
                                                $user->name,
                                                $amount,
                                                $wiauction->getURL()
                                        ));
                }

                notify_user($wiauction->owner_guid,
                                        $site->guid,
                                        $subject,
                                        $body
                                        );
			
        }
                        

			if($exist_wibid){
				$forward = "edited";
			}
			else{
				$forward = "added";
			}
			forward("bid/confirm/".$wiauction_guid."/".$forward);
}