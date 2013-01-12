<?php 


$context = elgg_extract('context', $vars, elgg_get_context());

$perspective = elgg_extract('perspective', $vars, "all");

if (elgg_is_logged_in() && $context) {
	$username = elgg_get_logged_in_user_entity()->username;
	$filter_context = elgg_extract('filter_context', $vars, 'all');
	
	if($vars['view_type']=="all"){
		$link = "auction/all";		
	}
	else{
		$link = "auction/owner/".$username;		
	}
	
  
	$active = wi_count_user_entities("wiauction", elgg_get_logged_in_user_guid(), "active", $perspective);
	if(!$active){
		$active = "0";	
	}
	
	$expired = wi_count_user_entities("wiauction", elgg_get_logged_in_user_guid(), "expired", $perspective);
	if(!$expired){
		$expired = "0";	
	}	
	
	$closed = wi_count_user_entities("wiauction", elgg_get_logged_in_user_guid(), "closed", $perspective);
	if(!$closed){
		$closed = "0";	
	}		
	
	$cancelled = wi_count_user_entities("wiauction", elgg_get_logged_in_user_guid(), "cancelled", $perspective);
	if(!$cancelled){
		$cancelled = "0";	
	}			

        
			

	// generate a list of default tabs
	$tabs = array(
		'active' => array(
			'text' => elgg_echo('wiauctions:active')."($active)",
			'href' => (isset($vars['active_link'])) ? $vars['active_link'] : "$link/active",
			'selected' => ($filter_context == 'active'),
			'priority' => 100,
			'help' => elgg_view("helper/help", array('help_text' => elgg_echo('wiauctions:active:help')))		
		),
		
		'closed' => array(
			'text' => elgg_echo('wiauctions:closed')."($closed)",
			'href' => (isset($vars['closed_link'])) ? $vars['closed_link'] : "$link/closed",
			'selected' => ($filter_context == 'closed'),
			'priority' => 400,
			'help' => elgg_view("helper/help", array('help_text' => elgg_echo('wiauctions:closed:help')))			
		),		
		
		'expired' => array(
			'text' => elgg_echo('wiauctions:expired')."($expired)",
			'href' => (isset($vars['expired_link'])) ? $vars['expired_link'] : "$link/expired",
			'selected' => ($filter_context == 'expired'),
			'priority' => 200,
			'help' => elgg_view("helper/help", array('help_text' => elgg_echo('wiauctions:expired:help')))	
		),
		
		
		'cancelled' => array(
			'text' => elgg_echo('wiauctions:cancelled')."($cancelled)",
			'href' => (isset($vars['cancelled_link'])) ? $vars['cancelled_link'] : "$link/cancelled",
			'selected' => ($filter_context == 'cancelled'),
			'priority' => 300,
			'help' => elgg_view("helper/help", array('help_text' => elgg_echo('wiauctions:cancelled:help')))	
		),				
	);
	
	
	
	foreach ($tabs as $name => $tab) {
		$tab['name'] = $name;
		
		elgg_register_menu_item('filter', $tab);
	}

	echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
}
