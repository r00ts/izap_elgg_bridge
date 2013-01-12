<?php
/**
 * Delete wiauctions entity
 *
 * @package wiauctions
 */

$wiauction_guid = get_input('guid');
$wiauction = get_entity($wiauction_guid);

if (elgg_instanceof($wiauction, 'object', 'wiauction') && $wiauction->canEdit()) {
	

                    $options = array(
                            'relationship' => 'wiauction_wibid',
                            'relationship_guid' => $wiauction_guid,
                            'limit' => 999
                    );                    
                    $wibids = elgg_get_entities_from_relationship($options);
                    
                    
                   
		foreach($wibids as $wibid){
					                    
                    remove_entity_relationship($wiauction_guid, 'wiauction_wibid', $wibid->getGUID());
                    
                    add_entity_relationship($wiauction_guid, 'wiauction_wibid_lose', $wibid->getGUID());

                            //notify the wibidder
                            $site = elgg_get_site_entity();
                                notify_user($wibid->owner_guid,
                                    $site->guid,
                                    elgg_echo('wibid:email:cancelled:subject'),
                                    elgg_echo('wibid:email:cancelled:body', array(
                                        $wiauction->title,
                                        elgg_get_logged_in_user_entity()->getURL()))
                    );	

			        
		}
			
                  //chane active_wiauction or closed_wiauction to rated_wiauction	
                if(check_entity_relationship($wiauction->getOwnerGUID(), 'active_wiauction', $wiauction_guid)){
                    if(!remove_entity_relationship($wiauction->getOwnerGUID(), 'active_wiauction', $wiauction_guid)){
                        $error = true;
                    }
                }
                  //chane active_wiauction or closed_wiauction to rated_wiauction	
                if(check_entity_relationship($wiauction->getOwnerGUID(), 'expired_wiauction', $wiauction_guid)){
                    if(!remove_entity_relationship($wiauction->getOwnerGUID(), 'expired_wiauction', $wiauction_guid)){
                        $error = true;
                    }
                }
                if(!add_entity_relationship($wiauction->getOwnerGUID(), 'cancelled_wiauction', $wiauction_guid)){
                    $error = true;   
                }        
                	
		
                    forward("auction/cancel");
						
		
				
		} else {					
			register_error(elgg_echo('wiauctions:error:post_not_found'));
		}

forward(REFERER);