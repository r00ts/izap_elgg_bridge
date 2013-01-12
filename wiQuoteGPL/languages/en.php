<?php
/**
 * Elgg WI Quotes vGPL Plugin
 * @package WI Job/Freelancer Plugin bundle
 * @author Web Intelligence
 * @copyright Web Intelligence 2012
 * @link www.webintelligence.ie
 * @version 1.8
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	'wiquote:quote' => "Quote",
	'wiquote' => "Send Quote",
        'wiquotes:sent' => 'Quotes I have sent',
	'wiquotes:all' => "All Quotes",
	'wiquotes:latest' => "Quotes on your job",
   	'wiquotes:winner' => "Job winner:",
	'wiquotes:other' => "All other quotes..",
	'wiquotes:place' => "Quote details..",
	'wiquotes:edit' => "Edit your quote..",
	'wiquote:text' => "Enter a quote comment",
	'wiquote:amount' => "Enter a quote amount",
	'wiquotes:accept' => "Accept Quote",	
	'wiquotes:your:title' => "Your Quotes",
	'wiquotes:title:my_quotes' => "My Quotes",
	'wiquotes:title:recieved_quotes' => "Received Quotes",
    'wiquotes:more-detail' => "View the quote",
	'wiquotes:delete' => "Delete",
	'wiquotes:message:deleted' => 'Quote successfully deleted',
	'wiquotes:error:cannot_delete' => 'Cannot delete the quote',
	'wiquotes:error:quote_not_found' => "Cannot find the quote",
	'wiquotes:file' => 'File (for a more comprehensive quote, you may include a file detailing proposal - .jpg, .gif, .png, .doc, .pdf, .ppt only)',
	'wiquote:file:failure' => "Could not save the file. Please try again",
	'wiquote:current_files' => 'Current submitted files:',
	'wiquotes:error:no_permissions' => "You must be an administrator to delete a quote",
        'wiquotes:successful:owner' => 'Successful Quotes',
        'wiquotes:successful:received' => 'Accepted Quotes',
        'wiquotes:unsuccessful:owner' => 'Unsuccessful Quotes',
        'wiquotes:unsuccessful:received' => 'Rejected Quotes',  
        'wiquotes:unsuccessful:default' => 'Successful Quotes',
        'wiquotes:successful:default' => 'Unsuccessful Quotes',
	'wiquotes:active' => 'Current Quotes',
	'wiquotes:expired' => 'Quotes on expired Jobs',
	'wijob:expiry' => 'Job Expiry Date',
	'wiquotes:by' => "By",
	'wiquotes:edit:quote' => "Edit my quote",
	'wiquotes:start:quote' => "Provide a Quote",
	'wiquotes:placed' => "Placed On Job",
	'wiquote:job:closed' => "Cannot place a quote as the job has been closed",
	'wiquote:edit' => "Edit Quote",
        'wiquote:error:cannot_edit_post' => 'You do not have permission to edit this quote',
        'generic_quote:notfound' => "Quote not found. Please contact the system administrator",
        'wiquotes:title:received_quotes' => 'Received Quotes',
        'wiquotes:login:quote' => "Login to Quote",
        'wiquotes:accepted' => "Quote Accepted",
    
        /**
         * Help 
         */
    
         'wiquotes:help:owner:acitve' => "Quotes you have placed on jobs. No winner of the job has been chosen yet. You may edit the quote by clicking 'edit'",
         'wiquotes:help:owner:successful' => "Your winning quotes. You can request to be rated each time you win a job. Click 'request rating' to  notify the job owner that you would like to be rated (the more positive ratings you receive, the more prominent your profile becomes)",
         'wiquotes:help:owner:unsuccessful' => "Quotes which have not been successful. Dont worry, keep trying!",
         
         'wiquotes:help:received:acitve' => "Quotes which you have received on jobs you have posted. You may accept a quote by clicking on 'Go To Quote' and hitting accept",
         'wiquotes:help:received:successful' => "Quotes which you have accepted as the winning quotes on jobs you have posted. Once the job has been completed, you should rate the user. In My Account, click on 'Rate my job winner' and then the thumbs up/thumbs down to do so",
         'wiquotes:help:received:unsuccessful' => "Any other quotes which you do not accept are moved here",
    
	/**
	 * Notifications
	 **/
	'wiquote:email:edit:subject' => '%s has edited their quote!',
	'wiquote:email:edit:body' => "%s has edited their quote on your item \"%s\". The quote is for %s.
	<br />
	To view or accept the job, click below:
	
	%s
	
	To view %s's profile or send them a message, click below:
	
	%s
	
	You cannot reply to this message.",

	'wiquote:email:subject' => 'You have a new quote!',
	'wiquote:email:body' => "You have a new quote on your item \"%s\" from %s. The quote is for %s.
	<br />
	To view the job, click below:
	
	%s
	
	To view %s's profile or send them a message, click here:
	
	%s
	
	You cannot reply to this message.",
	'wiquote:posted' => 'Your quote has been posted and the user has been notified.',


	/**
	 * Status messages
	 */

	// quotes widget
	'wiquotes:widget' => "My Quotes",
	'wiquotes:widget:description' => "Showcase your quote posts",
	'wiquotes:widget:viewall' => "View all my quote posts",
	'wiquotes:num_display' => "Number of posts to display",
	'wiquotes:icon_size' => "Icon size",
	'wiquotes:small' => "small",
	'wiquotes:tiny' => "tiny",

	/**
	 * Emails
	 */
	'wiquote:email:accept:body' => "Congratulations, your quote has been accepted. The Job can be viewed here:

	%s
	
	You can contact the job owner via messages. Their profile is here:

	%s
	
	You cannot reply to this message.",
	'wiquote:email:accept:subject' => "Quote accepted",
	'wiquote:email:job:closed:body' => "Unfortuneately, you're quote has not been accepted and the job has been closed.",
	'wiquote:email:job:closed:subject' => "Job closed",
	'wiquote:email:cancelled:subject' => "Job cancelled",
	'wiquote:email:cancelled:body' => "Unfortuneately, a job you quoted on has been cancelled. The job title was
	%s
	The profile of the user who uploaded the job can be viewed by clicking below
	%s
	",
	'wiquote:email:delete:subject' => "Job deleted",
	'wiquote:email:delete:body' => "Unfortuneately, a job you quote on has been deleted by the System Administrator. The job title was
	%s",

	/**
	 * Error messages
	 */
	'wiquote:invalid' => 'You do not have the correct permissions',
	'wiquote:blank' => 'Quote must be filled',
	'wiquote:notnum' => 'Quote amount must be a number',
	'wiquote:error' => 'There was a problem confirming the quote. Please getting in contact with the System Administrator',
	'wiquote:notfound' => "Sorry, we could not find the specified item.",
	'wiquote:failure' => "An unexpected error occurred when adding your comment. Please try again.",	
	'wiquotes:none:found' => "You have no active quotes",
);

add_translation("en", $english);

