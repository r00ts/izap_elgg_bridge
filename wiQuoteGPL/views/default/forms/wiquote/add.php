<?php
/**
 * Elgg WI Quotes vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */


$currency = get_job_quote_currency("wiJobGPL");

if (isset($vars['guid'])) {

        $wiquote = $vars['wiquote_entity'];
        
        
        if($wiquote){
        	
        $wiquote_click = '<div class="make-it-button wiquoteding-dimensions show_hide">';								
		$wiquote_click .= elgg_view('output/url', array(
							'href' => "#",
							'text' => elgg_echo('wiquotes:edit:quote'),
							));		
		$wiquote_click .= '</div>';
                $wiquote_click .= '<div class="clearfix"></div>';
        	
        	$wiquote_title = '<div id="wiquotes-winner-title">' . elgg_echo('wiquotes:edit') . '</div>';
            $button_text = elgg_echo('Resubmit my quote');
            
             
			
        } else {
            
            if(elgg_is_logged_in()){
                $wiquote_click = '<div class="make-it-button wiquoteding-dimensions show_hide">';								
                            $wiquote_click .= elgg_view('output/url', array(
                                                            'href' => "#",
                                                            'text' => elgg_echo('wiquotes:start:quote'),
                                                            ));		
                            $wiquote_click .= '</div>';
                            $wiquote_click .= '<div class="clearfix"></div>';

                    $wiquote_title = '<div id="wiquotes-winner-title">' . elgg_echo('wiquotes:place') . '</div>';
                $button_text = elgg_echo('wiquote');    
            }
            else{
                $url = $_SERVER['REQUEST_URI'];
                $pos = strpos($url, "wijob");
                $url = substr($url, $pos);
                $wiquote_click = '<div class="make-it-button wiquoteding-dimensions">';								
                            $wiquote_click .= elgg_view('output/url', array(
                                                            'href' => "/login?ref=".$url,
                                                            'text' => elgg_echo('wiquotes:login:quote'),
                                                            ));		
                            $wiquote_click .= '</div>';
                            $wiquote_click .= '<div class="clearfix"></div>';
                  
            }
        }
        

	echo $wiquote_click;

	echo "<div id='clearfix'></div>";
	
	
		echo '<div class="slidingDiv">';	
	
		echo $wiquote_title;
		
		echo "<p><label>".elgg_echo('wiquote:amount')."*</label><br />";
		echo $currency.elgg_view('input/text', array(
                    'name' => 'wiquote', 
                    'class' => "wiquote-num",
                    'value' => $wiquote->amount,
                    ));	
                
                                
		echo "</p>";
		
		
		echo elgg_view('input/submit', array(
                    'value' => $button_text,
                    'class' => 'wiquote-for-wijob-button',
                    ));



   		echo "</div>";   
	   

   	echo elgg_view('input/hidden', array(
		'name' => 'wijob_guid',
		'value' => $vars['guid']
	));
        
        if($wiquote){
            echo elgg_view('input/hidden', array(
                'name' => 'exist_wiquote_guid',
                'value' => $wiquote->getGUID()
            ));
        }
   
	}


