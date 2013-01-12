<?php

/*
 * Web intelligence Library of code related to relationships between entities
 */


/*
 * get 1 entity from relationship and another entity guid
 */
function wi_get_entity_from_relationship($guid, $relationship, $inverse){
    
        $options = array(
            'relationship_guid' => $guid,
            'relationship' => "$relationship",
            'inverse_relationship' => $inverse
    );
    
    $ents = elgg_get_entities_from_relationship($options);

    if($ents){
        return $ents[0];
    }
    else{
        return false;
    }
    
}

/*
 * Check for relationship and add if not found
 */

function wi_add_entities_relationship($relationship, $ent1, $ent2){
    
           if(!check_entity_relationship($ent1->guid, "$relationship", $ent2->guid)){
                if(!add_entity_relationship($ent1->guid, "$relationship", $ent2->guid)){
                    return false;
                }
            } 
            
            return true;
    
}    



/*
 * Check for relationship and remove found
 */

function wi_remove_entities_relationship($relationship, $ent1, $ent2){
    
           if(check_entity_relationship($ent1->guid, "$relationship", $ent2->guid)){
                if(!remove_entity_relationship($ent1->guid, "$relationship", $ent2->guid)){
                    return false;
                }
            } 
            
            return true;
    
} 


/*
 * Change relationship between 2 entities
 */

    function wi_change_entities_relationship($old, $new, $ent1, $ent2){
               
            //delete old relationship between entities
            if(!remove_entity_relationship($ent1->guid, "$old", $ent2->guid)){
                return false;
            }

            if(!add_entity_relationship($ent1->guid, "$new", $ent2->guid)){
                return false;       
            }
            
        return true;
    }
    
    


    function wi_get_entity_category_array($subtype, $guid){
        $cats = elgg_get_entities_from_relationship(array(
                                                'relationship_guid' => $guid,
                                                'relationship' => "{$subtype}_{$subtype}category",
        ));

    $cat_guids = array();

        foreach($cats as $cat){
        $cat_guids[] = $cat->guid; 
        }

        if($cat_guids){
            return $cat_guids;
        }
        else{
            return false;
        }    
    }



function wi_get_entity_categories_links($entity){
    
    
    $options = array(
            'relationship_guid' => $entity->guid,
            'relationship' => "{$entity->getSubtype()}_{$entity->getSubtype()}category",          
    );
            
            
            
    $cats = elgg_get_entities_from_relationship($options);

    $handler = substr($entity->getSubtype(), 2);
    
    foreach($cats as $cat){
        $link .= elgg_view('output/url', array('href' => $handler."/{$cat->guid}/".$cat->title, 'text' => $cat->title))." | ";
    }

    return $link;
}


function wi_get_entity_category_list($cat_prefix, $subtype, $selected_cat){
    

        $options = array(
            'type' => "object",
            'subtype' => "{$cat_prefix}category",   
            'limit' => 999
    );
        
        $cats = elgg_get_entities($options);
    
            
    $cats = elgg_get_entities($options);
    $link = elgg_get_site_url() . substr($subtype, 2); 
    if(!$selected_cat){
        $linkstr .= '<ul><li id="selected-cat"><a href="'.$link.'">All</a></li>';                   
    }
    else{ 
        $linkstr .= '<ul><li><a href="'.$link.'">All</a></li>'; 
    }


    
    foreach($cats as $cat){
        //count active wijobs
        $num = wi_count_entities_in_category($cat->guid, $subtype);
        if($num>0){
        $link = elgg_view('output/url', array('href' => substr($subtype, 2)."/{$cat->guid}/".urlencode($cat->title), 'text' => $cat->title."($num)"));            
        }
        else{
        $link = elgg_view('output/url', array('href' => substr($subtype, 2)."/{$cat->guid}/".urlencode($cat->title), 'text' => $cat->title));            
        }
        

        if($selected_cat==$cat->guid){
            $linkstr .= "<li id='selected-cat'>$link</li>";           
        }
        else{
           $linkstr .= "<li>$link</li>";            
        }


    }

    return $linkstr."</ul>";
}





function wi_count_entities_in_category($cat_guid, $subtype){
    
                global $CONFIG;
    
                $options = array(
                                'relationship_guid' => $cat_guid,
                                'relationship' => $subtype."_{$subtype}category",
                                'inverse_relationship' =>true,
                                'count' => true    
                );

            
                $options['joins'] = "join {$CONFIG->dbprefix}entity_relationships rr on rr.guid_two = e.guid ";
                $options['wheres'] = " rr.relationship = 'active_{$subtype}'";
                

            return elgg_get_entities_from_relationship($options);
            
}


function wi_check_site_user_relationship($guid, $relationship){
    
     $site = elgg_get_site_entity();
       
     if(check_entity_relationship($site->getGUID(), "$relationship", $guid)){
         return true;
     }
     else{
        return false; 
     }
}



function wi_get_entity_status($entity_id){
    
    $relationships = get_entity_relationships($entity_id, true);
    
    //should just return one relationship
    foreach($relationships as $relationship){
    
            if (strpos($relationship->relationship, 'active')!==false) {
                return 'active';
            }
            if (strpos($relationship->relationship, 'closed')!==false) {
                return 'closed';
            }  
            if (strpos($relationship->relationship, 'expired')!==false) {
                return 'expired';
            }  
            if (strpos($relationship->relationship, 'completed')!==false) {
                return 'completed';
            }    
            if (strpos($relationship->relationship, 'cancelled')!==false) {
                return 'cancelled';
            }               
    }
}



function wi_get_entity_categories($subtype, $guid){
    
    
    $cats = elgg_get_entities_from_relationship(array(
                        'relationship_guid' => $guid,
                        'relationship' => "{$subtype}_{$subtype}category",
    ));
    
    $cat_guids = array();
    foreach($cats as $cat){
        return $cat->getGUID();
    }

    if($cat_guids){
        return $cat_guids;
    }
    else{
        return false;
    }
        
}



function wi_count_user_entities($subtype, $user_id, $status = NULL, $perspective = "all"){
            
                $options = array();
                
                $options['count'] = true;
		
		if(!elgg_is_admin_logged_in()){
			$options['relationship_guid'] = $user_id;
		}
                else{
                    if($perspective=="owner"){
                       $options['relationship_guid'] = $user_id; 
                    }
                }
		
		if(isset($status)){
                $options['relationship'] = $status."_{$subtype}";
		}
               
		
		$entities = elgg_get_entities_from_relationship_count($options);		
	
		return $entities;
}





function wi_check_user_wibid_entity($subtype, $guid){
                       
            $wibidlist = elgg_get_entities_from_relationship(array(
                                                'owner_guid' => elgg_get_logged_in_user_guid(),
                                                'relationship' => "{$subtype}_wibid",
                                                'relationship_guid' => $guid,
                                                'limit' => 1
                                        ));

            $wibid = $wibidlist[0];    
            if($wibid){
                return $wibid;
            }
            else{
                return false;
            }
}





function wi_get_num_wibids($subtype, $guid, $status="active"){

    if($status=="active" || $status=="expired"){
    	$options = array(
		"relationship" => "{$subtype}_wibid",
		'relationship_guid' => $guid,
                'count' => true
	);
        
            $count = elgg_get_entities_from_relationship($options);
            return $count;
    }
    elseif($status=="closed"){
    	$options = array(
		"relationship" => "{$subtype}_wibid_lose",
		'relationship_guid' => $guid,
                'count' => true
	);  
        
        $count = elgg_get_entities_from_relationship($options);
        return $count + 1;
    }
    else{
    	$options = array(
		"relationship" => "{$subtype}_wibid_lose",
		'relationship_guid' => $guid,
                'count' => true
	);  
        
        $count = elgg_get_entities_from_relationship($options);
        return $count;        
    }
       
}






function wi_get_entity_from_wibid($subtype, $guid, $relationship){
    
    $entities = elgg_get_entities_from_relationship(array(
                                                'relationship_guid' => $guid,
                                                'relationship' => "{$subtype}_wibid",  
                                                'limit' => 1,
                                                'inverse_relationship' => true
        
    ));
    
    if($entities){
        if($relationship){
            return "{$subtype}_wibid";
        }
        else{
            return $entities[0];
        }
    }
    else{
            $entities = elgg_get_entities_from_relationship(array(
                                                'relationship_guid' => $guid,
                                                'relationship' => "{$subtype}_wibid_win",  
                                                'limit' => 1,
                                                'inverse_relationship' => true
                ));
            
            if($entities){
                    if($relationship){
                        return "{$subtype}_wibid_win";
                    }
                    else{
                        return $entities[0];
                    }
            }
            else{
                                $entities = elgg_get_entities_from_relationship(array(
                                                'relationship_guid' => $guid,
                                                'relationship' => "{$subtype}_wibid_lose",  
                                                'limit' => 1,
                                                'inverse_relationship' => true
                                ));
                                
                                     if($entities){
                                            if($relationship){
                                                return "{$subtype}_wibid_lose";
                                            }
                                            else{
                                                return $entities[0];
                                            }
                                      }
                
                return false;
            }
            
        return false;
    }
    
}




function wi_count_user_entity_wibidwiquotes($subtype, $bidquote, $user_id = NULL, $status = NULL, $viewtype){
  
                $options = array();
                
      if(elgg_is_admin_logged_in()){
                    
               if($viewtype == "owner"){
                    //so count for the owners wibids
                  $options["owner_guid"] = $user_id;      
                    if(isset($status)){		
                        if($status=="active"){
                            $options["relationship"] = "{$subtype}_{$bidquote}"; 
                        }
                        elseif($status=="successful"){
                            $options["relationship"] = "{$subtype}_{$bidquote}_win";                         
                        }
                        else{
                            //global $CONFIG;
                              //  $options["joins"] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid ";
                                //$options["wheres"] = "(r.relationship = "{$subtype}_wibid_lose"";
                                $options["relationship"] = "{$subtype}_{$bidquote}_lose";                             
                            }
                    }
                }
                elseif($viewtype == "received"){
                    $entity_subtype = get_subtype_id("object", "{$subtype}");    
                    global $CONFIG;
                    //count the received wibids
                  if(isset($status)){		
                    if($status=="active"){
                        $options["relationship"] = "{$subtype}_{$bidquote}"; 
                        $options["wheres"] = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$entity_subtype." AND ee.owner_guid=".$user_id.")";
                    }
                    elseif($status=="successful"){
                        $options["relationship"] = "{$subtype}_{$bidquote}_win";    
                        $options["wheres"] = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$entity_subtype." AND ee.owner_guid=".$user_id.")";
                    }
                    else{
                        global $CONFIG;
                            $options["joins"] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid ";
                            $where = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$entity_subtype." AND ee.owner_guid=".$user_id.")";
                            $where .= " AND (r.relationship = '".$subtype."_{$bidquote}_lose') ";
                            $options["wheres"] = $where;
                        }
                    }
                }  
                else{
                     //admin is in the all so count all wibids
 
                    if(isset($status)){		
                        if($status=="active"){
                            $options["relationship"] = "{$subtype}_{$bidquote}"; 
                        }
                        elseif($status=="successful"){
                            $options["relationship"] = "{$subtype}_{$bidquote}_win";                         
                        }
                        else{
                            //global $CONFIG;
                              //  $options["joins"] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid ";
                                //$options["wheres"] = "(r.relationship = "{$subtype}_wibid_lose"";
                                $options["relationship"] = "{$subtype}_{$bidquote}_lose";                             
                            }
                    }                   
                }
       }
         else{       
                if($viewtype == "owner"){
                    //so count for the owners wibids
                  $options["owner_guid"] = $user_id;      
                    if(isset($status)){		
                        if($status=="active"){
                            $options["relationship"] = "{$subtype}_{$bidquote}"; 
                        }
                        elseif($status=="successful"){
                            $options["relationship"] = "{$subtype}_{$bidquote}_win";                         
                        }
                        else{
                            //global $CONFIG;
                              //  $options["joins"] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid ";
                                //$options["wheres"] = "(r.relationship = "{$subtype}_wibid_lose"";
                                $options["relationship"] = "{$subtype}_{$bidquote}_lose";                             
                            }
                    }
                }
                else{
                    $entity_subtype = get_subtype_id("object", "{$subtype}");    
                    global $CONFIG;
                    //count the received wibids
                  if(isset($status)){		
                    if($status=="active"){
                        $options["relationship"] = "{$subtype}_{$bidquote}"; 
                        $options["wheres"] = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$entity_subtype." AND ee.owner_guid=".$user_id.")";
                    }
                    elseif($status=="successful"){
                        $options["relationship"] = "{$subtype}_{$bidquote}_win";    
                        $options["wheres"] = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$entity_subtype." AND ee.owner_guid=".$user_id.")";
                    }
                    else{
                        global $CONFIG;
                            $options["joins"] = "JOIN {$CONFIG->dbprefix}entity_relationships r on r.guid_two = e.guid ";
                            $where = "r.guid_one IN (select ee.guid from ".$CONFIG->dbprefix."entities ee where ee.subtype=".$entity_subtype." AND ee.owner_guid=".$user_id.")";
                            $where .= " AND (r.relationship = '".$subtype."_{$bidquote}_lose') ";
                            $options["wheres"] = $where;
                        }
                    }
                }
         }     
      
              $options["count"] = true;
              
		return elgg_get_entities_from_relationship($options);		
}






function wi_save_entity_category($subtype, $guid, $cat_guids){
    
        //get the old ones and if not in new array of cats, remove        
$old_cats = elgg_get_entities_from_relationship(array(
                        'relationship' => "{$subtype}_{$subtype}category",
                        'relationship_guid' => $guid,
));

        foreach($old_cats as $old_cat){
                if(!in_array($old_cat->getGUID(), $cat_guids)){
                        //delete relationship
                        if(!remove_entity_relationship($wijob_id, "{$subtype}_{$subtype}category", $old_cat->getGUID())){
                            $error = "error";
                        }	
                }			
        }


        foreach($cat_guids as $cat_guid){
            if(!check_entity_relationship($guid, "{$subtype}_{$subtype}category", $cat_guid)){
                if(!add_entity_relationship($guid, "{$subtype}_{$subtype}category", $cat_guid)){
                        $error = "error";                                               
                }   
            }
        }

        if($error){
            return false;
        }
        else{
            return true;
        }
}


function wi_get_child_status($quote){
    
    $subtype2 = $quote->getSubtype();
    $wijob_id = $quote->getContainerGUID();
    $entity = get_entity($wijob_id);
    
    if($entity instanceof ElggObject){
        $subtype1 = $entity->getSubtype();
        if(check_entity_relationship($wijob_id, "{$subtype1}_{$subtype2}_win", $quote->getGUID())){
            return 'successful';
        }

        if(check_entity_relationship($wijob_id, "{$subtype1}_{$subtype2}_lose", $quote->getGUID())){
            return 'unsuccessful';
        }    

        if(check_entity_relationship($wijob_id, "{$subtype1}_{$subtype2}", $quote->getGUID())){
            return 'active';
        } 
    }
    
    return false;
    
}




function wi_get_av_high_low_child_amount($guid, $subtype, $contract = true){
    
    $options = array(
                  'type' => 'object',
                  'subtype' => $subtype,
                  'relationship_guid' => $guid,
                  'container_guid' => $guid
    );
    
    $entities = elgg_get_entities_from_relationship($options);
        
        $hour_total = 0;
        $contract_total = 0;
        $hour_lowest = 0;
        $contract_lowest = 0;
        $hour_highest = 0;
        $contract_highest = 0;
        
        $num_hour_entities = 0;
        $num_contract_entities = 0;
	foreach($entities as $entity){
                if($entity->amount_type=="hour"){
                    
                    $hour_total += $entity->amount; 
                    	if($num_hour_entities==0){
                            $hour_lowest = $entity->amount;
                        }  
                        if($hour_lowest > $entity->amount){
                            $hour_lowest = $entity->amount;
                        }
                        if($hour_highest < $entity->amount){
                                $hour_highest = $entity->amount;
                        }                  
                   $num_hour_entities++;     
                }
                else{

                    $contract_total = $contract_total + $entity->amount;                    
                        if($num_contract_entities==0){
                            $contract_lowest = $entity->amount;
                        }
                        if($contract_lowest > $entity->amount){
                            $contract_lowest = $entity->amount;
                        }
                        if($contract_highest < $entity->amount){
                                $contract_highest = $entity->amount;
                        }   
                      $num_contract_entities++;
                }
			
	}
	
     if($subtype=="wiquote" && $contract){   
	$return['hour_average']= round($hour_total/count($num_hour_entities), 2);
	$return['hour_lowest'] = $hour_lowest;
	$return['hour_highest'] = $hour_highest;
        $return['contract_average']= round($contract_total/count($num_contract_entities), 2);
	$return['contract_lowest'] = $contract_lowest;
	$return['contract_highest'] = $contract_highest;
     }
     else{
        $return['average']= round($contract_total/$num_contract_entities, 2);
	$return['lowest'] = $contract_lowest;
	$return['highest'] = $contract_highest;         
     }
	return $return;
}

function wi_get_num_wiquotes($wijob_id){

    $wheres = "r.relationship LIKE 'wijob_wiquote%'";
    	$options = array(
		"wheres" => $wheres,
		'relationship_guid' => $wijob_id,
                'count' => true
	);
        
    return elgg_get_entities_from_relationship($options);
    
}