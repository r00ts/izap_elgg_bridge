<?php
/**
 * Elgg wibid add form
 *
 * @package Elgg
 *
 * @uses ElggEntity $vars['entity'] The entity to wibid on
 * @uses bool       $vars['inline'] Show a single line version of the form?
 */


        elgg_load_js('elgg.wibid.showhide');
            
        elgg_load_js('wiauction.google_map');  
        elgg_load_js('wiauction.jquery_min');
        elgg_load_js('wiauction.jquery_custom');         
        elgg_load_js('wiauction.geo_suggests'); 


if (isset($vars['guid'])) {


            
        $wibid = $vars['wibid_entity'];

        
        if($wibid){
        	
        $wibid_click = '<div class="make-it-button wibidding-dimensions show_hide" style="margin-top: 15px;">';								
		$wibid_click .= elgg_view('output/url', array(
							'href' => "#",
							'text' => elgg_echo('wibid:edit:wibid'),
							));		
		$wibid_click .= '</div>';
                $wibid_click .= '<div class="clearfix"></div>';
        	
        	$wibid_title = '<div id="wibid-winner-title">' . elgg_echo('wibid:edit') . '</div>';
            $button_text = elgg_echo('Resubmit my bid');

        
        	
	
			
        } else {
            

            
            if(elgg_is_logged_in()){
                $wibid_click = '<div class="make-it-button wibidding-dimensions show_hide">';								
                            $wibid_click .= elgg_view('output/url', array(
                                                            'href' => "#",
                                                            'text' => elgg_echo('wibid:start:wibid'),
                                                            ));		
                            $wibid_click .= '</div>';
                            $wibid_click .= '<div class="clearfix"></div>';

                    $wibid_title = '<div id="wibid-winner-title">' . elgg_echo('wibid:place') . '</div>';
                $button_text = elgg_echo('wibid');    
            }
            else{
                $url = $_SERVER['REQUEST_URI'];
                $pos = strpos($url, "wiauction");
                $url = substr($url, $pos);
                $wibid_click = '<div class="make-it-button wibidding-dimensions">';								
                            $wibid_click .= elgg_view('output/url', array(
                                                            'href' => "/login?ref=".$url,
                                                            'text' => elgg_echo('wibid:login:wibid'),
                                                            ));		
                            $wibid_click .= '</div>';
                            $wibid_click .= '<div class="clearfix"></div>';

        
            }
        }
        

	echo $wibid_click;

	echo "<div id='clearfix'></div>";
	
	
		echo '<div class="slidingDiv">';	
	
		echo $wibid_title;

                
                echo "<br />";

		
		echo "<p><label>".elgg_echo('wibid:amount')."*</label><br />";
		echo elgg_view('input/text', array(
                    'name' => 'amount', 
                    'class' => "wibid-num",
                    'value' => $wibid->amount,
                    ));	

                echo "<br />";
                
               echo "<p><label>".elgg_echo('wibid:location')."*</label>"; 
               echo elgg_view('input/text', array(
                    'name' => 'location', 
                    'class' => "wibid-location",
                    'id' => 'location',
                    'value' => $wibid->location
                    ));	
               

                echo "<br />";  
                                
		echo "</p>";
		
		
		echo elgg_view('input/submit', array(
                    'value' => $button_text,
                    'class' => 'wibid-for-wiauction-button',
                    ));



   		echo "</div>";   
	   

   	echo elgg_view('input/hidden', array(
		'name' => 'wiauction_guid',
		'value' => $vars['guid']
	));
        
        if($wibid){
            echo elgg_view('input/hidden', array(
                'name' => 'exist_wibid_guid',
                'value' => $wibid->getGUID()
            ));
        }
   
	}


	
	//else {
		
		/*
		echo "in the inline else";

	<div>
		<label><?php echo elgg_echo("generic_wibid:add"); </label>
		<?php echo elgg_view('input/longtext', array('name' => 'generic_wibid'));
	</div>

<!--	<div class="elgg-foot">

//		echo elgg_view('input/submit', array(
//                    'value' => elgg_echo("generic_wibid:post"),
//                    'class' => 'wibid-for-wiauction-button',
//                    ));

	</div>-->

	}
	
	echo elgg_view('input/hidden', array(
		'name' => 'wiauction_guid',
		'value' => $vars['entity']->getGUID()
	));
        
        echo elgg_view('input/hidden', array(
            'name' => 'exist_wibid_guid',
            'value' => $wibid->guid
        ));
        
}
*/