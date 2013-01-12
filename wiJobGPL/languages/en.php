<?php

/*
 * english language file
 * 
 */
$english = array(
    
    //menu
        
    'wijob' => "Job",
    'wijob:wijob' => 'All Jobs',
    'wijob' => "Job", 
    'wijob:nopermission' => 'You do not have permission to view this account',
    //submenu
    'wijob:submenu-browse' => "Quote for a job",
    'wijob:submenu-post-new' => "Post a Job",
    'wijob:submenu-my_job' => "Manage My Jobs",
    'wijob:file_too_big' => "The file you are uploading is too large, please try a smaller one",
    'wijob:file_unk_error' => "An unknown error occurred with the file, please contact the system administrator",
    'wijob:not_correct' => "The file type is not correct, please choose a file from the permitted list",
    
    //edit form
    'wijob:notfound' => 'Could not find job associated with quote. Please contact system administrator.',    
    'wijob:edit' => 'Edit Job',
    'wijob:error:cannot_edit_post' => 'You do not have permission to edit this job', 
    'wijob:title' => "Job Title",	
    'wijob:location' => "Location",
    'wijob:expires' => "Expires",	
    'wijob:tags' => "Tags",
	'wijob:edit' => "Save Job",
	'wijob:add' => "Add Job",
        'job:add' => "Add Job",
	'wijob:tags:help' => "(Separate with commas)",
    'wijob:budget' => "Budget",
	'wijob:wiquotes' => "Quotes",
    'wijob:text' => "Give a brief description of the job",
    'wijob:title:help' => "(1-3 words)",
    'wijob:addpost:title' => "Create a new job",
    'wijob:add' => "Upload Job",
    'wijob:everyone:title' => "All Job Tenders",
    'wijob:body' => 'Job Description',
    'wijob:status' => 'Status',
    'wijob:status:draft' => 'Draft',
    'wijob:status:published' => 'Published',
    'wijob:save_status' => 'save status:',
    'wijob:never' => 'Never',
    'wijob:excerpt' => 'Snippet',
    'wijob:categories' => 'Category choice',
	'wijob:none:found' => 'No job found',
	'wijob:blank' => "Sorry; you need to fill in both the mandatory fields before you can add job.",
    'wijob:error' => "There was an error saving the job. Please contact the systems administrator.",
	'wijob:accept:terms' => "I have read and accepted the %s of use.",
	'wijob:text:help' => "(No HTML and max. 250 characters)",   
	'wijob:active' => "Active",
	'wijob:active:help' => "(When active, job will appear under Jobs)", 
        
	'wijob:message:cancelled_post' => 'The job has been cancelled',
	'wijob:error:cannot_cancelled_post' => 'There was an error cancelling the job. Please contact the systems administrator.',
	'wijob:error:cannot_delete_post' => 'There was an error deleting the job.',	
	'wijob:message:delete_post' => "The job has been deleted",
	'wijob:error:post_not_found' => 'Job not found. Please contact the systems administrator.',
	'wijob:none' => "No %s job",
	'wijob:title:my_job' => 'My Jobs',
	'wijob:title:users_job' => '%s Jobs',
        'wijob:title:catjob' => '%s Jobs',
	'wijob:message:wiquote:accept' => 'Quote has been successfully accepted',
	'wijob:message:wiquote:error' => 'There was an error accepting the quote',
	'wijob:error:missing:title' => 'Please enter a title',
	'wijob:error:missing:description' => "Please enter a description",
	'wijob:error:missing:expiry_date' => 'Please select an expiry date',
	'wijob:error:missing:category' => 'Please select at least one category',
	'wijob:days' => 'Days job will stay active',
	'wijob:message:saved' => "Your job has been added",
	'wijob:expired:subject' => "Your job has expired",
	'wijob:expired:body' => "Your job with Skillterest has expired and has been moved to %s. Currently, users cannot quote for this job. You can edit the job and renew the expiry date, or you can accept one of the quotes (if there are any). To view the job click below
	%s
	",
	'wijob:error:cannot_save:title' => "",
	'wijob:error:expiry_date_early' => "The expiry date is in the past, please choose one in the future",
	'wijob:error:budget_num' => "The budget value must be numeric",
        'wijob:error:subcategories' => "You must selct at least one sub-category",
	'wijob:file' => "For a more comprehensive job description, include a file/picture (.jpg, .gif, .png, .doc, .pdf, .ppt only)",
	'wijob:current_files' => "Current File (if another is uploaded, this file will be over-written)",
	'wijob:said' => "said",
	'wijob:active' => "Active Jobs",
	'wijob:expired' => "Expired Jobs",
	'wijob:closed' => 'Closed but awaiting ratings',
	'wijob:rated' => 'Finished',
	'wijob:cancelled' => 'Cancelled',
   
    
	// Menu items and titles	
	'wijob:expiry_date' => "Pick the expiry date for this job",	
	'wijob' => "Jobs",
        'wijob:title:cancelled' => 'Job Cancelled',
        'wijob:title:confirm' => 'Job Added',
        'wijob:title:confirm' => 'Job Confirm',    
	'wijob:posts' => "Jobs Posts",
	'wijob:title' => "The Jobs",
	'wijob:user' => "%s's posts on The Jobs",
	'wijob:user:link' => "%s's Jobs",
	'wijob:user:friends' => "%s's friends' posts on The Jobs",
	'wijob:your' => "Your Jobs Posts",
	'wijob:your:title' => "Your Jobs",
	'wijob:posttitle' => "%s's Jobs item: %s",
	'wijob:friends' => "Friends' Jobs Posts",
	'wijob:yourfriends' => "Your friends' posts on The Jobs",
	'wijob:everyone:title' => "All Jobs",
	'wijob:everyone' => "All Jobs Posts",
	'wijob:read' => "View post",
	'wijob:add' => "Create New Job",
	'wijob:addpost:title' => "Create a new post on The Jobs",
	'wijob:editpost' => "Edit post",
	'wijob:imagelimitation' => "Must be JPG, GIF or PNG.",
	'wijob:text' => "Give a brief description about the item",
	'wijob:uploadimages' => "Would you like to upload an image for your item?",
	'wijob:image' => "Item image",
	'wijob:imagelater' => "",
	'wijob:strapline' => "Created",
	'item:object:job' => 'Jobs',
	'wijob:none:found' => 'No job post found',
	'wijob:pmbuttontext' => "Send Private Message",
	'wijob:budget:help' => "(ex. 200EUR)",
	'wijob:text:help' => "(No HTML and max. 250 characters)",
	'wijob:title:help' => "(1-3 words)",
	'wijob:tags' => "Tags",
	'wijob:tags:help' => "(Separate with commas)",
	'wijob:access:help' => "(Who can see this job post)",
	'wijob:replies' => "Replies",
	'wijob:created:gallery' => "Created by %s <br>at %s",
	'wijob:created:listing' => "Created by %s at %s",
	'wijob:showbig' => "Show larger picture",
	'wijob:type' => "Type",
	'wijob:charleft' => "characters left",
	'wijob:accept:terms' => "I have read and accepted the %s of use.",
	'wijob:terms' => "terms",
	'wijob:terms:title' => "Terms of use",
	'wijob:terms' => "<li class='elgg-divide-bottom'>The Jobs is for buying or selling used itemts among members.</li>
			<li class='elgg-divide-bottom'>No more than %s Jobs posts are allowed pr. user at the same time.</li>
			<li class='elgg-divide-bottom'>Only one Jobs post is allowed pr. item.</li>

			<li class='elgg-divide-bottom'>A Jobs post may only contain one item, unless it's part of a matching set.</li>
			<li class='elgg-divide-bottom'>The Jobs is for used/home made items only.</li>
			<li class='elgg-divide-bottom'>The Jobs post must be deleted when it's no longer relevant.</li>
			<li class='elgg-divide-bottom'>Commercial advertising is limited to those who have signed a promotional agreement with us.</li>
			<li class='elgg-divide-bottom'>We reserve the right to delete any Jobs posts violating our terms of use.</li>
			<li class='elgg-divide-bottom'>Terms are subject to change over time.</li>
			",


	// job widget
	'wijob:widget' => "My Jobs",
	'wijob:widget:description' => "Showcase your Jobs posts",
	'wijob:widget:viewall' => "View all %s Jobs",
	'wijob:num_display' => "Number of posts to display",
	'wijob:icon_size' => "Icon size",
	'wijob:small' => "small",
	'wijob:tiny' => "tiny",

	//job help
	'wijob:active:help' => "Jobs which are active and open for quotes",
	'wijob:closed:help' => "Jobs which are closed due to a winner being picked. Rate your job winners to move the job to Finished Jobs",
	'wijob:cancelled:help' => "Jobs you have cancelled",
	'wijob:expired:help' => "Jobs which have gone past their expiry date. To renew, edit the job and set a new expiry date in the future. When you have done this, the job will become active again and users may quote on it",
	'wijob:rated:help' => "Jobs which are finished and the job winner has been rated",
		
	// job river
	'river:create:object:wijob' => '%s posted a new job %s',
	'river:update:object:wijob' => '%s updated the job %s',
	'river:comment:object:wijob' => '%s commented on the Jobs ad %s',

	// Status messages
	'wijob:posted' => "Your Jobs post was successfully posted.",
	'wijob:deleted' => "Your Jobs post was successfully deleted.",
	'wijob:uploaded' => "Your image was succesfully added.",

	// Error messages	
	'wijob:save:failure' => "Your Jobs post could not be saved. Please try again.",
	'wijob:tobig' => "Sorry; your file is bigger then 1MB, please upload a smaller file.",
	'wijob:notjpg' => "Please make sure the picture inculed is a .jpg, .png or .gif file.",
	'wijob:notuploaded' => "Sorry; your file doesn't apear to be uploaded.",
	'wijob:notfound' => "Sorry; we could not find the specified Jobs post.",
	'wijob:notdeleted' => "Sorry; we could not delete this Jobs post.",
	'wijob:tomany' => "Error: Too many Jobs posts",
	'wijob:tomany:text' => "You have reached the maximum number of Jobs posts pr. user. Please delete some first!",
	'wijob:accept:terms:error' => "You must accept the terms of use!",

	// Settings
	'wijob:max:posts' => "Max. number of job posts pr. user:",
	'wijob:unlimited' => "Unlimited",
	'wijob:allowhtml' => "Allow HTML in job posts:",
	'wijob:numchars' => "Max. number of characters in job post (only valid without HTML):",
	'wijob:pmbutton' => "Enable private message button:",
	'wijob:adminonly' => "Only admin can create job posts:",
	'wijob:comments' => "Allow comments:",

	// job categories
	'wijob:categories' => 'Job Categories',
	'wijob:categories:choose' => 'Choose type',
	'wijob:categories:settings' => 'Jobs Categories:',	
	'wijob:categories:explanation' => 'Set some predefined categories for posting to the job.<br>Categories could be "job:clothes, job:footwear or job:buy,job:sell etc...", seperate each category with commas - remember to put them in your language files',	
	'wijob:categories:save:success' => 'Site job categories were successfully saved.',
	'wijob:categories:settings:categories' => 'Jobs Categories',
	'wijob:all:categories' => "All Categories",
	'wijob:category' => "Category",

	// Categories
	'wijob:buy' => "Buying",
	'wijob:sell' => "Selling",
	'wijob:swap' => "Swap",
	'wijob:free' => "Free",

	// Custom select
	'wijob:custom:select' => "Item condition",
	'wijob:custom:text' => "Condition",
	'wijob:custom:activate' => "Enable Custom Select:",
	'wijob:custom:settings' => "Custom Select Choices:",
	'wijob:custom:choices' => "Set some predefined choices for the custom select dropdown box.<br>Choices could be \"job:new,job:used...etc\", seperate each choice with commas - remember to put them in your language files",

	// Custom choises
	 'wijob:na' => "No information",
	 'wijob:new' => "New",
	 'wijob:unused' => "Unused",
	 'wijob:used' => "Used",
	 'wijob:good' => "Good",
	 'wijob:fair' => "Fair",
	 'wijob:poor' => "Poor",

	//for public, edit cancel menu
	'cancelconfirm' => "Are you sure you want to cancel this item?",
	'cancel:this' => "Cancel this",
        'wijob:cron:expiry' => "Job expiry checked",
        'wijob:cancel' => "Cancel Job",
        'wijob:settings:currency' => 'Currency',
        'wijob:adminonly' => 'Only admins can add job',
        'wijob:cancel:problem' => "There was aproblem cancelling the job, please contact the Systems Administrator",
    
);
					
add_translation("en",$english);
