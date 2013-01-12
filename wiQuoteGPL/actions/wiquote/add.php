<?php
/**
 * Elgg WI Quotes vGPL Plugin
 * @package WI Job/Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

elgg_set_context("adding_wiquote");
$wijob_guid = (int) get_input('wijob_guid');

$exist_wiquote = (int) get_input('exist_wiquote_guid');

$wiquote = get_input('wiquote');

if (!is_numeric($wiquote)){		
	register_error(elgg_echo("wiquote:notnum"));
	forward(REFERER);
}

$currency = get_job_quote_currency('wiJobGPL');

// Let's see if we can get an entity with the specified GUID
$wijob = get_entity($wijob_guid);
if (!$wijob) {		
	register_error(elgg_echo("generic_wiquote:notfound"));
	forward(REFERER);
}

if(wi_get_entity_status($wijob_guid)!="active" && wi_get_entity_status($wijob_guid)!="expired"){
	register_error(elgg_echo("wiquote:wijob:closed"));
	forward(REFERER);
}

$user = elgg_get_logged_in_user_entity();

if($exist_wiquote){
    $wiquote_obj = get_entity($exist_wiquote);
    if (!$wiquote_obj) {
		
            register_error(elgg_echo("generic_wiquote:notfound"));
            forward(REFERER);
    }    
}else{

	$wiquote_obj = new ElggObject();
        $wiquote_obj->subtype = 'wiquote';
}

	$wiquote_obj->amount = $wiquote;
	$wiquote_obj->owner_guid = $user->guid;
        if(!can_write_to_container($user->guid, $wijob_guid)){
		register_error(elgg_echo('wiquote:failure'));
		forward(REFERER);
        }
        $wiquote_obj->container_guid = $wijob_guid;
	$wiquote_obj->access_id = ACCESS_PUBLIC;
        
	//wiquote can only ever have one wijob so set wijob id as the conatainer giud
	$wiquote_guid = $wiquote_obj->save();
	
	if(!$wiquote_guid){
		register_error(elgg_echo('wiquote:failure'));
		forward(REFERER);
	}
	else{
            //create the relationship
            
            if(!wi_add_entities_relationship("wijob_wiquote", $wijob, $wiquote_obj)){
                    register_error(elgg_echo('wiquote:failure'));
                    forward(REFERER);                
            }
  

        // notify if poster wasn't owner
        if ($wijob->owner_guid != $user->guid) {

                $site = elgg_get_site_entity();

                if($exist_wiquote){
                        $subject = elgg_echo('wiquote:email:edit:subject', array($user->name));
                        $body = elgg_echo('wiquote:email:edit:body', array(
                                                $user->name,
                                                $wijob->title,
                                                $currency.$wiquote,
                                                $wijob->getURL(),
                                                $user->name,
                                                $user->getURL()
                                        ));		
                }
                else{
                        $subject = elgg_echo('wiquote:email:subject');
                        $body = elgg_echo('wiquote:email:body', array(
                                                $user->name,
                                                $wijob->title,
                                                $currency.$wiquote,
                                                $wijob->getURL(),
                                                $user->name,
                                                $user->getURL()
                                        ));
                }

                notify_user($wijob->owner_guid,
                                        $site->guid,
                                        $subject,
                                        $body
                                        );

		
        }


                       

			if($exist_wiquote){
				$forward = "edited";
			}
			else{
				$forward = "added";
			}
			forward("quote/confirm/".$wijob_guid."/".$forward);
}