<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */





function wi_get_entity_options($function, $subtype, $container_guid = NULL, $status = "active", $cat_desc = "all", $category = "all", $sort="expiry"){
    
    //var_dump($status);
    
    global $CONFIG;
    
    switch ($function){
        
        
        case 'list':
           
        $options = array(
                'type' => 'object',
                'subtype' => "{$subtype}",
                'full_view' => FALSE,
        );
            
            
        $relationship = $status."_wiauction";    
        $joins[] = "join ".$CONFIG->dbprefix."entity_relationships rs on rs.guid_two = e.guid  ";
        $wheres[] = "  (rs.relationship = '$relationship')";    
        
        if($container_guid){
            $options['container_guid'] = $container_guid;
        }
        else{
            if($sort!="Latest"){ 
                $order_by_metadata[] = 	array('name' => "expiry_date", 'direction' => "ASC");
                $options['order_by_metadata'] = $order_by_metadata;
            }
        }
            
        if($category!="all"){
            //list all wiauctions in that category
                    $rel_options = array(	
                            'relationship_guid' => $category,
                            'relationship' => "{$subtype}_{$subtype}category",
                            'inverse_relationship' => true,
                            'full_view' => FALSE,
                    );
                    $options = array_merge($options, $rel_options);		

            }        
        
        $options['joins'] = $joins;
        $options['wheres'] = $wheres;        
        
        break;
    
        default:
            break;    
        
        
    }
    
    return $options;
    
}



function wi_set_entities_expired($entity){
    
    $subtype = $entity->getSubtype();
    
    $entity_owner_id = $entity->getOwnerGUID();
    $error = false;
    
    //change active_wiauction relationship to closed_wiauction
    if(!remove_entity_relationship($entity_owner_id, "active_{$subtype}", $entity->getGUID())){
        $error = true;
   
    }
    else{
        if(!add_entity_relationship($entity_owner_id, "expired_{$subtype}", $entity->getGUID())){
            $error = true;  
        }        
    }    
	
	if(!$error){
		
		//send notification to wiauction owner
		$site = elgg_get_site_entity();
                
                $entity_owner = $entity->getOwnerEntity();
		
		$subject = elgg_echo("{$subtype}s:expired:subject");
		$body = elgg_echo("{$subject}s:expired:body", array(wi_get_user_entities_link($subtype, $entity_owner->username, "expired"), wi_get_entity_link($entity)));	
		
			notify_user($entity->getOwnerGUID(),
				$site->guid,
				$subject,
				$body
				);
                        
						
			return true;
	}
	else{
		return false;
	}
}




function wi_check_entity_expiry($subtype){
    
    load_wi_framework();
    
    $options = array(
                'type' => 'object',
                'subtype' => "$subtype",
                'relationship' => "active_{$subtype}",
                'limit' => '999'
    );
    
    $entities = elgg_get_entities_from_relationship($options);
    
    foreach($entities as $entity){
        
        
        $expiry_date = $entity->expiry_date;
        
        if(!wi_check_date_not_past($expiry_date)){
            if(wi_set_entities_expired($entity)){
                    elgg_trigger_event('changed to expired', "$subtype", $entity);	
            }
            else{
                    elgg_trigger_event('couldnt change to expired', "$subtype", $entity);                
            }
	}

    }
   
}