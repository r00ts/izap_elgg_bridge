<?php 


	$username = elgg_get_logged_in_user_entity()->username;
	$filter_context = elgg_extract('filter_context', $vars, 'all');
	
	if($vars['view_type']=="all"){
		$link = "bid/all";		
	}
	elseif($vars['view_type']=="received"){
		$link = "bid/received/".$username;
                $help = "received";
                $viewtype = "received";
	}
	else{
                $help = "owner";
		$link = "bid/owner/".$username;
                $viewtype = "owner";
	}

        
        $user = elgg_get_logged_in_user_guid();
                
	
	$active = wi_count_user_entity_wibidwiquotes("wiauction", "wibid", $user, "active", $viewtype);
	if(!$active){
		$active = "0";	
	}	
	
	$successful = wi_count_user_entity_wibidwiquotes("wiauction", "wibid", $user, "successful", $viewtype);
	if(!$successful){
		$successful = "0";	
	}		
	
	$unsuccessful = wi_count_user_entity_wibidwiquotes("wiauction", "wibid", $user, "unsuccessful", $viewtype);
	if(!$unsuccessful){
		$unsuccessful = "0";	
	}			

	// generate a list of default tabs
	$tabs = array(
		'active' => array(
			'text' => elgg_echo("wibid:active:$viewtype")."($active)",
			'href' => (isset($vars['active_link'])) ? $vars['active_link'] : "$link/active",
			'selected' => ($filter_context == 'active'),
			'priority' => 100,
                        'help' => elgg_view("helper/help", array('help_text' => elgg_echo("wibids:help:$help:acitve")))
		),
		
		'successful' => array(
			'text' => elgg_echo("wibid:successful:$viewtype")."($successful)",
			'href' => (isset($vars['successful_link'])) ? $vars['successful_link'] : "$link/successful",
			'selected' => ($filter_context == 'successful'),
			'priority' => 200,
                        'help' => elgg_view("helper/help", array('help_text' => elgg_echo("wibids:help:$help:successful")))
		),			
		
		'unsuccessful' => array(
			'text' => elgg_echo("wibid:unsuccessful:$viewtype")."($unsuccessful)",
			'href' => (isset($vars['unsuccessful_link'])) ? $vars['unsuccessful_link'] : "$link/unsuccessful",
			'selected' => ($filter_context == 'unsuccessful'),
			'priority' => 400,
                        'help' => elgg_view("helper/help", array('help_text' => elgg_echo("wibids:help:$help:unsuccessful")))
		),		
//		'cancelled' => array(
//			'text' => elgg_echo('bp_theme:cancelled'),
//			'href' => (isset($vars['cancelled_link'])) ? $vars['cancelled_link'] : "$context/owner/$username/cancelled",
//			'selected' => ($filter_context == 'cancelled'),
//			'priority' => 300,
//		),				
	);
	
	
	
	foreach ($tabs as $name => $tab) {
		$tab['name'] = $name;
		
		elgg_register_menu_item('filter', $tab);
	}

	echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
//}
