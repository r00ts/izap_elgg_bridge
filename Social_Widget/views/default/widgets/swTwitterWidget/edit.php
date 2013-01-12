<?php

    /**
	 * Social Widget edit page
	 *
	 * 
	 */

?>
<p>
		<?php echo elgg_echo("social_Widget:user"); ?>
		<input type="text" name="params[social_username]" value="<?php echo htmlentities($vars['entity']->social_username); ?>" />	
		<br />
	
	</p>