<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

$wijob_guid = get_input('guid');
$wijob = get_entity($wijob_guid);

if (elgg_instanceof($wijob, 'object', 'wijob') && $wijob->canEdit()) {

                

                                        //now check and delete files associated with wijob
                $files = elgg_get_entities_from_relationship(array(
                                'relationship' => "wijob_file",
                                'relationship_guid' => $wijob_guid,
                                'limit' => 999
                            ));

               foreach($files as $file){
                        if (!$file->delete()) {
                                $error = elgg_echo('wijob:error:cannot_delete_post');	
                            }
                        }
       
                
                        $wiquotes_active = elgg_get_entities_from_relationship(array(
				'relationship' => 'wijob_wiquote',
				'relationship_guid' => $wijob_guid,
				'limit' => 999
			));
                        
                        $wiquotes_win = elgg_get_entities_from_relationship(array(
				'relationship' => 'wijob_wiquote_win',
				'relationship_guid' => $wijob_guid,
				'limit' => 999
			));     
                        
                        $wiquotes_lose = elgg_get_entities_from_relationship(array(
				'relationship' => 'wijob_wiquote_lose',
				'relationship_guid' => $wijob_guid,
				'limit' => 999
			));       
                        
                        $all_wiquotes = array_merge($wiquotes_active, $wiquotes_win, $wiquotes_lose);
			
				foreach($all_wiquotes as $wiquote){
                                    $wiquote_guid = $wiquote->getGUID();
                                    $wiquote_owner = $wiquote->getOwnerGUID();
                                        
                                    //now check and delete files associated with wiquotes
                                    $files = elgg_get_entities_from_relationship(array(
                                            'relationship' => "wiquote_file",
                                            'relationship_guid' => $wiquote_guid,
                                            'limit' => 999
                                        ));

                                        foreach($files as $file){

                                                        if (!$file->delete()) {
                                                            $error = elgg_echo('wijob:error:cannot_delete_post');
                                                        }
                                        }
                                        
					if(!$wiquote->delete()){
                                            $error = elgg_echo('wijob:error:cannot_delete_post');					
					}
										
					//notify the wiquoteder
					$site = elgg_get_site_entity();
			        notify_user($wiquote_owner,
			            $site->getGUID(),
			            elgg_echo('wiquote:email:delete:subject'),
			            elgg_echo('wiquote:email:delete:body', array(
			            $wijob->title))
			        );					
				}
                                
    

			if (!$wijob->delete()) {
                                        $error = elgg_echo('wijob:error:cannot_delete_post');		
				}
				
		} else {
                   $error = elgg_echo('wijob:error:cannot_delete_post');
		}
                
                if($error){
                    register_error($error);
                    forward(REFERER);
                }

                system_message(elgg_echo('wijob:message:delete_post'));
                forward(REFERER);