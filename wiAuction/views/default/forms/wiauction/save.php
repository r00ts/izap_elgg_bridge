<?php
/**
 * Elgg Auctions Plugin
 * @package wiauctions
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */



$vars['county_view'] = "form";

$draft_warning = $vars['draft_warning'];
if ($draft_warning) {
	$draft_warning = '<span class="message warning">' . $draft_warning . '</span>';
}

$action_buttons = '';
$cancel_link = '';



if ($vars['guid']) {
	// add a delete button if editing
	$cancel_url = "action/auction/cancel?guid={$vars['guid']}";
	$cancel_link = elgg_view('output/confirmlink', array(
		'href' => $cancel_url,
		'text' => elgg_echo('wiauctions:cancel'),
		'class' => 'elgg-button elgg-button-delete elgg-state-disabled float-alt'
	));

}

//var_dump($vars['view_type']);

if($vars['view_type']=="edit"){
	$button_txt = "wiauction:edit";	
}
else{
	$button_txt = "wiauction:add";	
}


$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo($button_txt),
	'name' => 'save',
));

$action_buttons = $save_button . $cancel_link;


$title_label = elgg_echo('title')."*";
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'wiauctions_title',
	'required' => TRUE,        
	'value' => $vars['title']
));





$body_label = elgg_echo('wiauctions:body')."*";
$body_input = elgg_view('input/longtext', array(
	'name' => 'description',
	'id' => 'wiauctions_description',    
	'value' => $vars['description']
));

$image_text = elgg_echo("wiauctions:image");

$guide_label = elgg_echo('wiauctions:guide')."*";
$currency = "(".elgg_get_plugin_setting('wiauction_currency', 'wiauction').")";
$guide_input = $currency.elgg_view('input/text', array(
	'name' => 'guide',
	'id' => 'wiauctions_guide',	
	'value' => $vars['guide']
));


$location_label = elgg_echo("wiauctions:location")."*";
$location_input = elgg_view('input/text', array(
	'name' => 'location',
	'id' => 'location',	
	'value' => $vars['location']
));


$tags_label = elgg_echo('tags');
$tags_input = elgg_view('input/tags', array(
	'name' => 'tags',
	'id' => 'wiauctions_tags',
	'value' => $vars['tags']
));


$calender_label = elgg_echo('wiauctions:expiry_date')."*";
$calender_input = elgg_view('input/date', array(
	'name' => "expiry_date",	
	'id' => 'wiauctions_expiry',
	'required' => TRUE,    
	'value' => $vars['expiry_date']
));


$wiauctioncategories_label = "<label>".elgg_echo('wiauctions:wiauctioncategory')."*</label><br />";
$wiauctioncategories_input = elgg_view('input/checkboxes', array(
	'name' => 'wiauctioncategory',
        'options' => wi_get_category_option_vals('wiauction'),
	'value' => $vars['wiauctioncategory'],
));



$image_label = elgg_echo("wiauctions:uploadimages") . "<br /><small><small>" . elgg_echo("wiauctions:imagelimitation") . "</small></small><br />";
$image_input = elgg_view("input/file",array('name' => 'upload'));


$access_label = elgg_echo('access') . "&nbsp;<small><small>" . elgg_echo("wiauction:access:help") . "</small></small><br />";
$access_input = elgg_view('input/access', array('name' => 'access_id','value' => $vars['access_id']));


if($vars['guid']){
    $image = elgg_view('wiauction/thumbnail', array('wiauctionguid' => $vars['guid'], 'size' => 'large', 'tu' => $tu));
}

// hidden inputs
$container_guid_input = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => elgg_get_page_owner_guid()));
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));
$status = elgg_view('input/hidden', array('name' => 'status', 'value' => $vars['status']));


echo <<<___HTML


<div>
	<label for="wiauctions_title">$title_label</label>
	$title_input
</div>




<table border='0' cellpadding='40' width='100%'><tr>
<td><p><label>$body_label</label><br>
$body_input
</p></td>

<td width='220px'>
<p><label>$image_text<br /><center>
$image
</center><br /></label></p>
</td><tr></table>
<br />

<div>
	<label for="wiauctions_wiauctioncategories">$wiauctioncategories_label</label>
	$wiauctioncategories_input
</div>


<div>
<label for="wiauctions_guide">$guide_label</label>
$guide_input
<div />
<br />

<div>
<label for="wiauctions_guide">$location_label</label>
$location_input
<div />
<br />


<div>
<label for="wiauctions_guide">$calender_label</label>
$calender_input
<div />
<br />


<div>
	<label for="wiauctions_tags">$tags_label</label>
	$tags_input
</div>
<br />

<div><label>$image_label</label>
    $image_input
</div>
<br />

<div><label>$access_label</label>
    $access_input
</div>
<br />

<div class="elgg-foot">

	$guid_input
	$container_guid_input
	$status

	$action_buttons
</div>


___HTML;

