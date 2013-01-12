<?php
/**
 * Delete wiauctions entity
 *
 * @package wiauctions
 */

$wiauction_guid = get_input('guid');
$wiauction = get_entity($wiauction_guid);

if (elgg_instanceof($wiauction, 'object', 'wiauction') && $wiauction->canEdit()) {
       
                
                        $wiquotes_active = elgg_get_entities_from_relationship(array(
				'relationship' => 'wiauction_wiquote',
				'relationship_guid' => $wiauction_guid,
				'limit' => 999
			));
                        
                        $wiquotes_win = elgg_get_entities_from_relationship(array(
				'relationship' => 'wiauction_wiquote_win',
				'relationship_guid' => $wiauction_guid,
				'limit' => 999
			));     
                        
                        $wiquotes_lose = elgg_get_entities_from_relationship(array(
				'relationship' => 'wiauction_wiquote_lose',
				'relationship_guid' => $wiauction_guid,
				'limit' => 999
			));       
                        
                        $all_wiquotes = array_merge($wiquotes_active, $wiquotes_win, $wiquotes_lose);
			
				foreach($all_wiquotes as $wiquote){
                                    $wiquote_guid = $wiquote->getGUID();
                                    $wiquote_owner = $wiquote->getOwnerGUID();
                                        
                                        
					if(!$wiquote->delete()){
					register_error(elgg_echo('wiauctions:error:cannot_delete_post'));							
					}
										
					//notify the wiquoteder
					$site = elgg_get_site_entity();
			        notify_user($wiquote_owner,
			            $site->getGUID(),
			            elgg_echo('wiquote:email:delete:subject'),
			            elgg_echo('wiquote:email:delete:body', array(
			            $wiauction->title))
			        );					
				}
                                
    

			if (!$wiauction->delete()) {						
					register_error(elgg_echo('wiauctions:error:cannot_delete_post'));
				}
				
		} else {				
			register_error(elgg_echo('wiauctions:error:post_not_found'));
		}

                system_message(elgg_echo('wiauctions:message:delete_post'));
                forward(REFERER);