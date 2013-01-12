<br />
<h3>Highslide Gallery addon for Tidypics pluggin, Elgg.</h3>
<p></p>
<p>Read the <a href="http://www.highslide.com/#licence" title="http://www.highslide.com/#licence" target="_blank" style="color:#F00">licence here</a>, before using it on a production site. Other important links for Highslideshow are <a href="http://www.highslide.com/ref" title="http://www.highslide.com/ref" target="_blank">Reference</a>, <a href="http://www.highslide.com/tutorial" title="http://www.highslide.com/tutorial" target="_blank">Tutorials</a>, <a href="http://www.highslide.com/support" title="http://www.highslide.com/support" target="_blank">Support</a>, <a href="http://www.highslide.com/forum/viewtopic.php?t=2119" title="Lanuage packs" target="_blank">Translations</a>. Highslide integration done by <a href="http://m4medicine.com/community/pg/profile/sanupmoideen">Dr. Sanu P Moideen</a> @ <a href="http://webgalli.com" target="_blank">Team Webgalli</a>.</p>
<p>
  Set your settings for slidehshow here: 
</p>

<?php
	$plugin = find_plugin_settings('highslide');

	// borderstyle
	$slidestyle = $plugin->slidestyle;
	
		if (!get_plugin_setting('slidestyle', 'highslide')) {
		set_plugin_setting('slidestyle', beveled, 'highslide');
		}
		
	$form_body .= '<p class="admin_debug">'. elgg_echo('highslide:settings:slideshowstyle') .
					elgg_view('input/pulldown', array(
					'internalname' => 'params[slidestyle]',
					'options_values' => array(
						'beveled' 		=> elgg_echo('beveled'),
						'drop-shadow' 	=> elgg_echo('drop-shadow'),
						'glossy-dark' 	=> elgg_echo('glossy-dark'),
						'outer-glow' 	=> elgg_echo('outer-glow'),
						'rounded-black' => elgg_echo('rounded-black'),
						'rounded-white' => elgg_echo('rounded-white'),
						),
					'value' => $slidestyle
					))
					. "</p>";
					
	// slideshow timing
	$slidetime = $plugin->slidetime;
	
		if (!get_plugin_setting('slidetime', 'highslide')) {
		set_plugin_setting('slidetime', 4000, 'highslide');
		}
		
	$form_body .= '<p class="admin_debug">'. elgg_echo('highslide:slide:slidetime') .
					elgg_view('input/text', 
							  array('internalname' => "params[slidetime]",
							'value' => $slidetime
							)) 
					. "</p>";
					
	// slideshow credit text
	$slidecredit = $plugin->slidecredit;
	
		if (!get_plugin_setting('slidecredit', 'highslide')) {
		set_plugin_setting('slidecredit', elgg_echo('highslide:creditsText') , 'highslide');
		}
		
	$form_body .= '<p class="admin_debug">'. elgg_echo('highslide:slide:credit') .
					elgg_view('input/text', 
							array('internalname' => "params[slidecredit]",
							'value' => $slidecredit
							)) 
					. "</p>";

	// slideshow creditsTitle
	$slidecreditsTitle = $plugin->slidecreditsTitle;
	
		if (!get_plugin_setting('slidecreditsTitle', 'highslide')) {
		set_plugin_setting('slidecreditsTitle', elgg_echo('highslide:creditsTitle') , 'highslide');
		}
		
	$form_body .= '<p class="admin_debug">'. elgg_echo('highslide:slide:creditsTitle') .
					elgg_view('input/text', 
							array('internalname' => "params[slidecreditsTitle]",
							'value' => $slidecreditsTitle
							)) 
					. "</p>";
					
	// slideshow creditsLink
	$slidecreditsLink = $plugin->slidecreditsLink;
	
		if (!get_plugin_setting('slidecreditsLink', 'highslide')) {
		set_plugin_setting('slidecreditsLink', elgg_echo('highslide:creditsLink') , 'highslide');
		}
		
	$form_body .= '<p class="admin_debug">'. elgg_echo('highslide:slide:creditsLink') .
					elgg_view('input/url', 
							array('internalname' => "params[slidecreditsLink]",
							'value' => $slidecreditsLink
							)) 
					. "</p>";

	//Finish the settings and print the form
	
	
	echo $form_body ;
?>


