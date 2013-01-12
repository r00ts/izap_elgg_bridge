<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//$vars['title'] = elgg_echo('wi:category:add');
                
	if($cat_type = get_input("cat_type")){

            $vars["cat_type"] = $cat_type;
            
            if($guid = get_input("guid")){
    
                if($entity = get_entity($guid)){
				$vars["entity"] = $entity;
		}           
                
            }
		
	}
        

	
	echo elgg_view_form("wicategory/save", "", $vars);
