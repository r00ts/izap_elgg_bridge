<?php
/**
 * Elgg WI Quotes vGPL Plugin
 * @package WI Job/Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */



$wiquote = $vars['entity'];
                  
$wijob = get_entity($wiquote->getContainerGUID());
if(!$wijob){		
	register_error(elgg_echo("wijob:notfound"));
        forward();
}

//introducing 3rd value affect if statements
$full = elgg_extract('full_view', $vars, true);
$viewtype = elgg_extract('view_type', $vars);


$owner = $wiquote->getOwnerEntity();


//find out if a wiquote has been rated
if($owner->getGUID()==elgg_get_logged_in_user_guid()){
	

	
	if(wi_get_child_status($wiquote)=="successful" && wi_get_entity_status($wijob->getGUID())!="completed"){
			$rating_link = '<span class="make-it-button rating-link">';	
			$rating_link .= elgg_view('output/url', array(
			            'href' => "action/ratings/request?wiquote_id=".$wiquote->getGUID(),
			            'text' => "Request Rating",
			            'class' => 'make-it-button',
						'is_action' => true
			    ));	
			$rating_link .= "</span>";    
	}
	
}


	
	if ((elgg_get_logged_in_user_guid()==$wiquote->owner_guid)||elgg_is_admin_logged_in()) {
		if(wi_get_entity_status($wijob->getGUID())=="active" || wi_get_entity_status($wijob->getGUID())=="expired"){
			$metadata = elgg_view_menu('wiquotes', array(
				'entity' => $vars['entity'],
				'handler' => 'quote',
				'sort_by' => 'priority',
				'class' => 'elgg-menu-hz',
			));	
		}
	}


        
    if($wiquote->amount_type=="contract"){
        $amount = $wiquote->amount." per the contract";        
    }
    else{
        $amount = $wiquote->amount." per hour";
    }

//if fulview called from details url otherwise call else
if($viewtype=='fullview'){
    

   $date = elgg_view_friendly_time($wiquote->time_created);
    $owner_link = elgg_view('output/url', array(
            'href' => "profile/$owner->username",
            'text' => $owner->name,
            'class' => 'wiquote-owner-title',
    ));
    
    $back_link = elgg_view('output/url', array(
            'href' => $wijob->getURL(),
            'text' => "back to job",
            'class' => 'wiquote-owner-title',
    ));

    $form_vars['wiquote_guid'] = $wiquote->getGUID();
    $form_vars['wijob_guid'] = $wijob->getGUID();
    
    if(wi_get_entity_status($wijob->getGUID())=="active" || wi_get_entity_status($wijob->getGUID())=="expired"){
        $display_button = elgg_view_form('wiquote/accept',array(), $form_vars);
    } else {
        $display_button =elgg_view('output/url', array(
        'href' => $wijob->getURL(),
        'text' => "Back to Job",
        'class' => 'wiquote-owner-title',
    ));
    }
    $description = $wiquote->description;

    $owner_icon = elgg_view_entity_icon(get_entity($owner->guid), 'large');

    echo "<div class=\"wiquote-back-link\">$back_link</div>";
    echo '<div id="all-wrapper">'; 
        echo '<div id="wiquote-left-wrapper">';
            echo '<div id="wiquote-owner-icon">'.$owner_icon.'</div>';
            //show the file
  
        echo '</div>'; //end left wrapper
        echo '<div id="wiquote-detail-wrapper">';
            echo '<div class="full-wiquote-details full-wiquote-details-title" >'.$owner_link.'</div>';
            echo '<div id="wiquote-metadata">'.$metadata.'</div>';
            echo "<div id='clear'></div>";
            echo '<div>'.$description.'</div>';
            echo elgg_view('output/titletext', array(
                    'text' => 'Price: &euro;'.$amount,
                    'id' => 'wiquote-detail-price',
            ));
            echo "<div id='wiquote-detail-price'>On Job: ";
            echo elgg_view('output/url', array(
			        'href' => $wijob->getURL(),
			        'text' => $wijob->title,
            		'id' => "wiquote-wijob-title"
			    )); 
			echo "</div>";          
            //echo '<div class="wiquote-amount">Amount: &euro;'.$amount.'</div>';
        echo '</div>'; //close detail wrapper
        
        //echo '<div style="clear: both"></div>';
    echo '</div>'; //close all-wrapper
    echo '<div style="clear: both"></div>';
    
    if($wijob->getOwnerGUID() == elgg_get_logged_in_user_guid() && (wi_get_entity_status($wijob->getGUID())=="active" || wi_get_entity_status($wijob->getGUID())=="expired")){
    	
	    //--------warning
	    echo '<div class="wiquote-warning">';
	        echo '<div class="wiquote-warning-title">'."Warning:".'</div>';
	        echo '<div class="wiquote-warning-message">'.'<p>After accepting this quote the quote provider will be marked as winner and your job will be closed. You will not be able to undo this.</p>'.'</div>';
	    echo '</div>';
	    //--------end-warning
	    echo '<div>'.$display_button.'</div>';
    } 

    

} else {

if(!$full){
	
    $date = elgg_view_friendly_time($wiquote->time_created);
    $owner = $wiquote->getOwnerEntity();
    $owner_link = elgg_view('output/url', array(
            'href' => "profile/$owner->username",
            'text' => $owner->name,
            'class' => 'wiquote-owner-title',
    ));
    $owner_icon = elgg_view_entity_icon($owner, 'small');


//-------------------------------------------------------------------------------------------    
    echo '<div class="wiquotelist">';
    echo '<div style="width:40px; float:left">'.$owner_icon.'</div>';
    echo '<div class="wiquote-owner-name-container">'.$owner_link."<br/>".$date.'</div>';

    echo '<div class="wiquotelist-price"><font style=\"font-size: 0.8em\">'.  get_job_quote_currency('wiJobGPL').' </font>'.$wiquote->amount.'</div>';

    echo '<div style="clear: both"></div>';
    echo '</div>';

    
//-------------------------------------------------------------------------------------------    


   	
}else{


    $date = elgg_view_friendly_time($wiquote->time_created);
    $owner_icon = elgg_view_entity_icon(get_entity($owner->guid), 'small');
    //no need for following
    $owner_link = elgg_view('output/url', array(
        'href' => "wijob/owner/$owner->username",
        'text' => $owner->name,
    ));


            $wijob_title = elgg_view('output/url', array(
                    'href' => $wijob->getURL()."/wiquote",
                    'text' => $wijob->title,
                    'class' => 'wiquote-owner-title',
            ));
            
            $wiquote_details = elgg_view('output/url', array(
                    'href' =>  $wiquote->getURL(),
                    'text' => 'Go To quote',
            ));

    //-------------------------------------------------------------------------------------------    
    $list_body .= '<div class="wiquotelist">';

    $list_body .=  '<div class="wiquote-wijob-title"><b>'.elgg_echo("wiquotes:placed").':</b><br />'.$wijob_title.'</div>';
    
    $list_body .=  '<div class="wiquote-details">'.$date.'</div>';  
    
    $list_body .=  '<div class="wiquote-details">'.$wiquote_details.'</div>';    



 
    $list_body .=  '<div class="wiquote-details">&euro;'.$amount.'</div>';
	$list_body .=  '<div class="wiquote-details">'.$rating_link.'</div>';        
	
	$list_body .=  '<div class="wiquote-details">'.$metadata.'</div>';    
    
    $list_body .=  '<div style="clear: both"></div>';	  
    $list_body .=  '</div>';
    
    
   echo elgg_view_image_block($owner_icon, $list_body);


	}	
}
	

