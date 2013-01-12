<?php
/**
 * Elgg WI Quotes vGPL Plugin
 * @package WI Job/Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

$form_vars = array('name' => 'acceptForm');
$show_add_form = elgg_extract('show_add_form', $vars, true);
$currency = get_job_quote_currency('wiJobGPL');

$id = '';
if (isset($vars['id'])) {
	$id = "id =\"{$vars['id']}\"";
}

$class = 'elgg-wiquotes';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// work around for deprecation code in elgg_view()
unset($vars['internalid']);
echo "<div $id class=\"$class\">";

    
    $wijob = $vars['entity'];
    $status = wi_get_entity_status($wijob->getGUID());

    if($status=="closed" || $status=="completed"){

        $wiquotelist_title = elgg_echo('wiquotes:winner');
        
        $options = array(
                                    'relationship' => 'wijob_wiquote_win',
                                    'relationship_guid' => $wijob->getGUID(),
                                    'limit' => 1
                            );
        $options = array_merge($options, $vars);

        $html = elgg_list_entities_from_relationship($options);
        
        
        //get all the other wiquotes	        
        
        $other_title = elgg_echo('wiquotes:other');
        
        $options = array(
                                    'relationship' => 'wijob_wiquote_lose',
                                    'relationship_guid' => $wijob->getGUID(),
                                    'limit' => 99
                            );
        $options = array_merge($options, $vars);        
          
        $other_wiquotes = elgg_list_entities_from_relationship($options);
        
    } else{
        
        $options = array(
                                    'relationship' => 'wijob_wiquote',
                                    'relationship_guid' => $wijob->getGUID(),
                                    'limit' => 99
                            );
        $options = array_merge($options, $vars);              

        $html = elgg_list_entities_from_relationship($options);
        
        $wiquotelist_title = elgg_echo('wiquotes:latest');
    }
    
   
    //display average, highest and lowest wiquotes
    $wiquote_summary = wi_get_av_high_low_child_amount($wijob->getGUID(), "wiquote", false);
    if($wiquote_summary['hour_average'] > 0 && $wiquote_summary['contract_average'] > 0){
        $average = $wiquote_summary['hour_average']." per hour, ".$wiquote_summary['contract_average']." per the contract";
        $lowest = $wiquote_summary['hour_lowest']." per hour, ".$wiquote_summary['contract_lowest']." per the contract";
        $highest = $wiquote_summary['hour_highest']." per hour, ".$wiquote_summary['contract_highest']." per the contract";
    }
    elseif($wiquote_summary['hour_average'] > 0){
        //must mean hour only one with a wiquote
        $average = $wiquote_summary['hour_average']." per hour";
        $lowest = $wiquote_summary['hour_lowest']." per hour";
        $highest = $wiquote_summary['hour_highest']." per hour";        
    }
    elseif($wiquote_summary['contract_average'] > 0){
        $average = $wiquote_summary['contract_average']." per the contract";
        $lowest = $wiquote_summary['contract_lowest']." per the contract";
        $highest = $wiquote_summary['contract_highest']." per the contract";          
    }
    else{
        $average = 0;
        $lowest = 0;
        $highest = 0;          
    }
    
    
    
    echo '<div class="clearfix"></div>';
    echo "<div id='wiquote-average'>";
    echo '<span class="wiquote-lowest wiquote-sum-info">'."<b>Lowest quote: </b><span>".$currency.$lowest.'</span></span>';
    echo '<span class="wiquote-highest wiquote-sum-info">'."<b>Highest quote: </b><span>".$currency.$highest.'</span></span>';
    echo '<span class="wiquote-average wiquote-sum-info">'."<b>Average quote: </b><span>".$currency.$average.'</span></span>';  
    echo '<div class="clearfix"></div>';
    echo "</div>";
    
    //display only to owner of the wijobpost
if(elgg_get_logged_in_user_guid()==$vars['entity']->getOwnerGUID() || elgg_is_admin_logged_in()){    
	   // $options = array_merge($options, $vars);
    //$html = elgg_list_entities_from_metadata($options);
    
	    if ($html) {
	            echo '<div id="wiquotes-winner-title">' . $wiquotelist_title . '</div>';
	            echo $html;
	            
	            if($status=="closed" || $status=="completed"){
		            echo '<div id="wiquotes-winner-title">' . $other_title . '</div>';
		            echo $other_wiquotes;  	            	
	            }
         
	    }
	}else{
            if(wi_get_entity_status($wijob->getGUID())=='closed' || wi_get_entity_status($wijob->getGUID())=='rated'){
                $relationship = 'wijob_wiquote_win';
            }
            else{
                $relationship = 'wijob_wiquote';
            }
		//show the wiquote of logged in user
            $options = array(
                                    'owner_guid' => elgg_get_logged_in_user_guid(),
                                    'relationship' => $relationship,
                                    'relationship_guid' => $wijob->getGUID(),
                                    'limit' => 1
                            );
            $options = array_merge($options, $vars);     
            
            $html = elgg_list_entities_from_relationship($options);
	    
	    if ($html) {
	            echo '<div id="wiquotes-winner-title">Your wiquote</div>';
	            echo $html;
	    }	
	}

if ($show_add_form) {
	//check if the wijob is pending. if it is, then only allow people who have wiquote to change their wiquote	
	$vars['guid'] = $wijob->getGUID();
	$form_vars = array('name' => 'elgg_add_wiquote', 'enctype' => 'multipart/form-data');
	echo elgg_view_form('wiquote/add', $form_vars, $vars);
}

echo '</div>';
