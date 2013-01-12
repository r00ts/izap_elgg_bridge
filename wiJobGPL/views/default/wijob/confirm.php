<?php


$wijob_id = $vars['wijob_id'];
$edit_type = $vars['edit_type'];

$wijob = get_entity($wijob_id);


echo "You have successfully ".$edit_type." the job. To view the job click on the link ".get_wijob_link($wijob);	
echo "<br />";
echo "To view all you active jobs go to " . get_my_wijob_link("active");
echo "<br />";
echo "To view all active jobs on the site go to " . get_all_wijob();