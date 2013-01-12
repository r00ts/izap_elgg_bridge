<?php



$wijob_id = $vars['wijob_id'];
$edit_type = $vars['edit_type'];

$wijob = get_entity($wijob_id);



if($edit_type=="edited"){
echo "You have successfully resubmitted your quote. ";	
}
else{
	echo "You have successfully added a quote. ";
}
echo "The job owner has been notified. ";
echo "To view the job again click on the link ".get_wijob_link($wijob);	



echo "<br />";
echo "To view all active jobs on the site go to " . get_all_wijob();