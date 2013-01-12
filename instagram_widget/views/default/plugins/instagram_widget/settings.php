<div>
	<?php
	echo'<p>Enter Access Token</p>';
	$content = elgg_get_plugin_setting('access_token', 'instagram_widget');
	echo elgg_view('input/text', array(
	'name' => 'params[access_token]',
	'value' => $content
));

	?>	
</div>