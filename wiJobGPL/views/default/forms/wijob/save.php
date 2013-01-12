<?php
/**
 * Elgg WI Job vGPL Plugin
 * @package WI Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

$wijob = get_entity($vars['guid']);
$vars['entity'] = $wijob;


$action_buttons = '';
$cancel_link = '';



if ($vars['guid']) {

        
        $files = elgg_get_entities_from_relationship(array(
                'relationship' => "wijob_file",
                'relationship_guid' => $vars['guid'],
                'limit' => 1
            ));
				
				//there should only be one
			foreach($files as $file){
	
					$file_url .= elgg_view('output/url', array(
							'href' => 'mod/file/download.php?file_guid='.$file->getGUID(),
							'text' => $file->originalfilename,
						))."<br/>";	

			$file_label = elgg_echo("wiquotes:file");
			
			$uploads .= "<div id='wijob-file'>";
			$uploads .= elgg_echo("wijob:current_files");
			$uploads .= "</div><p>";
			$uploads .= $file_url;
			$uploads .= elgg_view('input/hidden', array('name' => 'del_guid', 'value' => $file->getGUID()));
			$uploads .= "</p>";				
			}
}

//var_dump($vars['view_type']);

if($vars['view_type']=="edit"){
	$button_txt = "wijob:edit";	
}
else{
	$button_txt = "wijob:add";	
}


$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo($button_txt),
	'name' => 'save',
));

$action_buttons = $save_button . $cancel_link;


$title_label = elgg_echo('title')."*";
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'wijob_title',
	'required' => TRUE,        
	'value' => $vars['title']
));


$body_label = elgg_echo('wijob:body')."*";
$body_input = elgg_view('input/longtext', array(
	'name' => 'description',
	'id' => 'wijob_description',    
	'value' => $vars['description']
));

$budget_label = elgg_echo('wijob:budget');
$currency = get_job_quote_currency("wiJobGPL");
$budget_input = $currency.elgg_view('input/text', array(
	'name' => 'budget',
	'id' => 'wijob_budget',	
	'value' => $vars['budget']
));



$tags_label = elgg_echo('tags');
$tags_input = elgg_view('input/tags', array(
	'name' => 'tags',
	'id' => 'wijob_tags',
	'value' => $vars['tags']
));


$categories_label = "<label>".elgg_echo('categories')."*</label><br />";
$categories_input = elgg_view('input/checkboxes', array(
	'name' => 'category',
        'options' => wi_get_category_option_vals('wijobskill'),
	'value' => $vars['wijobcategory'],
));


$access_label = elgg_echo('access');
$access_input = elgg_view('input/access', array(
	'name' => 'access_id',
	'id' => 'blog_access_id',
	'value' => $vars['access_id']
));



// hidden inputs
$container_guid_input = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => elgg_get_page_owner_guid()));
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));
$status = elgg_view('input/hidden', array('name' => 'status', 'value' => $vars['status']));

$file_label = elgg_echo("wijob:file");
$file_upload = elgg_view('input/file', array('name' => 'upload'));

echo <<<___HTML


<div>
	<label for="wijob_title">$title_label</label>
	$title_input
</div>


<label for="wijob_description">$body_label</label>
$body_input
<br />

<div>
	<label for="wijob_categories">$categories_label</label>
	$categories_input
</div>




        <label for="wijob_budget">$budget_label</label>
        $budget_input

<br />
<br />


<div>
$uploads

<p>
<label>$file_label</label><br />
$file_upload		 		
</p>
</div>
<br/>
<div>
	<label for="wijob_tags">$tags_label</label>
	$tags_input
</div>

<div>
	<label for="blog_access_id">$access_label</label>
	$access_input
</div>


<div class="elgg-foot">

	$guid_input
	$container_guid_input
	$status

	$action_buttons
</div>


___HTML;

