<?php
/**
 * Elgg file plugin language pack
 *
 * @package ElggFile
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	'wibid:wibid' => "Bid",
        'wibid:wibid' => "Bids",
	'wibid' => "Make Bid",
	'wibid:all' => "All Bids",
        'item:object:wibid' => "Bids",
	'wibid:latest' => "Bids on your auction:",
   	'wibid:winner' => "Auction winner:",
	'wibid:other' => "All other bids..",
	'wibid:place' => "Bid details..",
	'wibid:edit' => "Edit your bid..",
	'wibid:text' => "Enter a bid comment",
	'wibid:amount' => "Enter a bid amount(numeric only)",
	'wibid:acceptbid' => "Accept Bid",	
        'wibid:made' => "Bids I have made",
        'wibid:received' => "Bids on my auctions",    
	'wibid:your:title' => "Your Bids",
	'wibid:title:my_wibid' => "My Bids",
	'wibid:title:recieved_bids' => "Received Bids",
    'wibid:more-detail' => "View the bid",
	'wibid:delete' => "Delete",
	'wibid:message:deleted' => 'Bid successfully deleted',
	'wibid:error:cannot_delete' => 'Cannot delete the bid',
	'wibid:error:wibid_not_found' => "Cannot find the bid",
	'wibid:file' => 'File (for a more comprehensive bid, you may include a file detailing proposal)',
	'wibid:file:failure' => "Could not save the file. Please try again",
	'wibid:current_files' => 'Current submitted files:',
	'wibid:error:no_permissions' => "You must be an administrator to delete a bid",
        'wibid:successful:owner' => 'Successful Bids',
        'wibid:successful:received' => 'Accepted Bids',
        'wibid:unsuccessful:owner' => 'Unsuccessful Bids',
        'wibid:unsuccessful:received' => 'Rejected Bids',    
	'wibid:active' => 'Current Bids',
	'wibid:expired' => 'Bids on expired Auctions',
	'wiauctions:expiry' => 'Auction Expires',
        'wiauction:goto' => "Go To Auction",
	'wibid:by' => "By",
	'wibid:edit:wibid' => "Edit my bid",
	'wibid:start:wibid' => "Make a Bid",
        'wibid:location' => "Your Location",
	'wibid:placed' => "Placed On Auction",
	'wibid:wiauction:closed' => "Cannot place a bid as the auction has been closed",
	'wibid:edit' => "Edit Bid",
        'wibid:error:cannot_edit_post' => 'You do not have permission to edit this bid',
        'generic_wibid:notfound' => "Bid not found. Please contact the system administrator",
        'wibid:title:recieved_wibid' => 'Received Bids',
        'wibid:title:received_wibid' => 'Received Bids',
        'wibid:login:wibid' => "Login to Bid",
        'wibid:lowest' => 'Lowest bid',
        'wibid:highest' => 'Highest bid',
        'wibid:average' => 'Average bid',
        'wibid:nolocation' => 'You must enter your general location',
        'wibid:active:default' => 'All Active Bids',
        'wibid:successful:default' => 'All Successful Bids',
        'wibid:unsuccessful:default' => 'All Successful Bids', 
        'wibid:active:owner' => "Active Bids",
        'wibid:active:received' => "Active Bids",
    
        /**
         * Help 
         */
    
         'wibid:help:owner:acitve' => "Bids you have placed on auctions. No winner of the auction has been chosen yet. You may edit the bid by clicking 'edit'",
         'wibid:help:owner:successful' => "Your winning bids. You can request to be rated each time you win a auction. Click 'request rating' to  notify the auction owner that you would like to be rated (the more positive ratings you receive, the more prominent your profile becomes)",
         'wibid:help:owner:unsuccessful' => "Bids which have not been successful. Dont worry, keep trying!",
         
         'wibid:help:received:acitve' => "Bids which you have received on auctions you have posted. You may accept a bid by clicking on 'Go To Bid' and hitting accept",
         'wibid:help:received:successful' => "Bids which you have accepted as the winning bids on auctions you have posted. Once the auction has been completed, you should rate the user. In My Account, click on 'Rate my auction winner' and then the thumbs up/thumbs down to do so",
         'wibid:help:received:unsuccessful' => "Any other bids which you do not accept are moved here",
    
	/**
	 * Notifications
	 **/
	'wibid:email:edit:subject' => '%s has edited their bid!',
	'wibid:email:edit:body' => "%s has edited their bid on your item %s. The bid amount is %s.
	<br />
	To view or accept the bid, click below:
	
	%s
	
	You cannot reply to this message.",

	'wibid:email:subject' => 'You have a new bid!',
	'wibid:email:body' => "You have a new bid on your item %s from %s. The bid amount is %s.
	<br />
	To view or accept the bid, click below:
	
	%s
	
	You cannot reply to this message.",
    
	'wibid:posted' => 'Your bid has been posted and the user has been notified.',


	/**
	 * Status messages
	 */

	// bids widget
	'wibid:widget' => "My Bids",
	'wibid:widget:description' => "Showcase your bid posts",
	'wibid:widget:viewall' => "View all my bid posts",
	'wibid:num_display' => "Number of posts to display",
	'wibid:icon_size' => "Icon size",
	'wibid:small' => "small",
	'wibid:tiny' => "tiny",

	/**
	 * Emails
	 */
	'wibid:email:accept:body' => "Congratulations, your bid has been accepted. The auction can be viewed here:

	%s
	
	You can contact the auction owner to arrange <b>payment and delivery</b> via messages. Their profile is here:

	%s
	
	You cannot reply to this message.",
	'wibid:email:accept:subject' => "Bid accepted",
	'wibid:email:wiauction:closed:body' => "Unfortuneately, you're bid has not been accepted and the auction has been closed.",
	'wibid:email:wiauction:closed:subject' => "Auction closed",
	'wibid:email:cancelled:subject' => "Auction cancelled",
	'wibid:email:cancelled:body' => "Unfortuneately, a auction you bid on has been cancelled. The auction title was
	%s
	The profile of the user who uploaded the auction can be viewed by clicking below
	%s
	",
	'wibid:email:delete:subject' => "Auction deleted",
	'wibid:email:delete:body' => "Unfortuneately, a auction you bid on has been deleted by the System Administrator. The auction title was
	%s",
    
        'wibid:accept' => "You have successfully accepted the bid. Your auction has been moved to %s	
        <br />
        You can view and contact the auction winner to arrange <b>payment and delivery details</b> via messages. Their profile is here: 
        <br />
        %s
        <br />
        To view the auction again click on the link below	
        <br />
        %s",
    
        'wibid:resubmitted' => "You have successfully resubmitted your bid.	
        The auction owner has been notified. 
        To view the auction again click on the link %s	
        <br />
        To view all you active bids go to %s
        <br />
        To view all active auctions on the site go to %s",
    
        'wibid:submitted' => "You have successfully submitted a bid.	
        The auction owner has been notified. 
        To view the auction again click on the link %s	
        <br />
        To view all you active bids go to %s
        <br />
        To view all active auctions on the site go to %s",    
    
	/**
	 * Error messages
	 */
	'wibid:invalid' => 'You do not have the correct permissions',
	'wibid:blank' => 'Bid must be filled',
	'wibid:notnum' => 'Bid amount must be a number',
	'wibid:error' => 'There was a problem confirming the bid. Please getting in contact with the System Administrator',
	'wibid:notfound' => "Sorry, we could not find the specified item.",
	'wibid:failure' => "An unexpected error occurred when adding your comment. Please try again.",	
	'wibid:none:found' => "You have no active bids",
);

add_translation("en", $english);

