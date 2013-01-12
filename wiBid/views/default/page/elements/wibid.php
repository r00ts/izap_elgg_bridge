<?php
/**
 * List wibids with optional add form
 *
 * @uses $vars['entity']        ElggEntity
 * @uses $vars['show_add_form'] Display add form or not
 * @uses $vars['id']            Optional id for the div
 * @uses $vars['class']         Optional additional class for the div
 */


$form_vars = array('name' => 'acceptForm');
$show_add_form = elgg_extract('show_add_form', $vars, true);

$id = '';
if (isset($vars['id'])) {
	$id = "id =\"{$vars['id']}\"";
}

$class = 'elgg-wibid';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// work around for deprecation code in elgg_view()
unset($vars['internalid']);
echo "<div $id class=\"$class\">";

    
    $wiauction = $vars['entity'];
    $currency = elgg_get_plugin_setting('wiauction_currency', 'wiauction');

    $status = wi_get_entity_status($wiauction->getGUID());

    if($status=="closed"){

        $wibidlist_title = elgg_echo('wibid:winner');
        
        $options = array(
                                    'relationship' => 'wiauction_wibid_win',
                                    'relationship_guid' => $wiauction->getGUID(),
                                    'limit' => 1
                            );
        $options = array_merge($options, $vars);

        $html = elgg_list_entities_from_relationship($options);
        
        
        //get all the other wibids	        
        
        $other_title = elgg_echo('wibid:other');
        
        $options = array(
                                    'relationship' => 'wiauction_wibid_lose',
                                    'relationship_guid' => $wiauction->getGUID(),
                                    'limit' => 99
                            );
        $options = array_merge($options, $vars);        
          
        $other_wibids = elgg_list_entities_from_relationship($options);
        
    } else{
        
        $options = array(
                                    'relationship' => 'wiauction_wibid',
                                    'relationship_guid' => $wiauction->getGUID(),
                                    'limit' => 99
                            );
        $options = array_merge($options, $vars);              

        $html = elgg_list_entities_from_relationship($options);
        
        $wibidlist_title = elgg_echo('wibid:latest');
    }
    
   
    //display average, highest and lowest wibids
    $wibid_summary = wi_get_av_high_low_child_amount($wiauction->getGUID(), "wibid");
    if($wibid_summary['average'] > 0){
        $average = $wibid_summary['average'];
        $lowest = $wibid_summary['lowest'];
        $highest = $wibid_summary['highest'];
    }
    else{
        $average = 0;
        $lowest = 0;
        $highest = 0;          
    }
    
    echo '<div class="clearfix"></div>';
    echo "<div id='wibid-average'>";
    echo '<span class="wibid-lowest wibid-sum-info">'."<b>".elgg_echo("wibid:lowest").": $currency</b><span>".$lowest.'</span></span>';
    echo '<span class="wibid-highest wibid-sum-info">'."<b>".elgg_echo("wibid:highest").": $currency</b><span>".$highest.'</span></span>';
    echo '<span class="wibid-average wibid-sum-info">'."<b>".elgg_echo("wibid:average").": $currency</b><span>".$average.'</span></span>';  
    echo '<div class="clearfix"></div>';
    echo "</div>";
    
    //display only to owner of the wiauctionpost
if(elgg_get_logged_in_user_guid()==$vars['entity']->getOwnerGUID() || elgg_is_admin_logged_in()){    
	   // $options = array_merge($options, $vars);
    //$html = elgg_list_entities_from_metadata($options);
    
	    if ($html) {
	            echo '<div id="wibid-winner-title">' . $wibidlist_title . '</div>';
	            echo $html;
	            
	            if($status=="closed" || $status=="completed"){
		            echo '<div id="wibid-winner-title">' . $other_title . '</div>';
		            echo $other_wibids;  	            	
	            }
         
	    }
	}else{
            if(wi_get_entity_status($wiauction->getGUID())=='closed'){
                $relationship = 'wiauction_wibid_win';
            }
            else{
                $relationship = 'wiauction_wibid';
            }
		//show the wibid of logged in user
            $options = array(
                                    'owner_guid' => elgg_get_logged_in_user_guid(),
                                    'relationship' => $relationship,
                                    'relationship_guid' => $wiauction->getGUID(),
                                    'limit' => 1
                            );
            $options = array_merge($options, $vars);     
            
            $html = elgg_list_entities_from_relationship($options);
	    
	    if ($html) {
	            echo '<div id="wibid-winner-title">Your bid</div>';
	            echo $html;
	    }	
	}

if ($show_add_form) {
	//check if the wiauction is pending. if it is, then only allow people who have wibid to change their wibid	
	$vars['guid'] = $wiauction->getGUID();
	$form_vars = array('name' => 'elgg_add_wibid', 'enctype' => 'multipart/form-data');
	echo elgg_view_form('wibid/add', $form_vars, $vars);
}

echo '</div>';
