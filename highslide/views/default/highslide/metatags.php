<?php
	$slidestyle = get_plugin_setting('slidestyle', 'highslide');
	$slidetime = get_plugin_setting('slidetime', 'highslide');
	$slidecredit = get_plugin_setting('slidecredit', 'highslide');
	$slidecreditsTitle = get_plugin_setting('slidecreditsTitle', 'highslide');
	$slidecreditsLink = get_plugin_setting('slidecreditsLink', 'highslide');
?>

<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/highslide.js"></script>
<script type="text/javascript">
    // override Highslide settings here
    hs.graphicsDir = '<?php echo $vars['url']; ?>mod/highslide/vendors/highslide/graphics/';
    hs.outlineType = '<?php echo $slidestyle; ?>';// set null to disable outlines
	hs.transitions = ['expand', 'crossfade'];
	hs.fadeInOut = true;
	hs.numberPosition = 'caption';
	hs.dimmingOpacity = 0.75;
	hs.zIndexCounter = 10000; // adjust to other absolutely positioned elements
	hs.creditsHref = '<?php echo $slidecreditsLink; ?>';
	//Override languages
	hs.lang = {
		cssDirection: 	'<?php echo elgg_echo('highslide:cssDirection'); ?>',
		loadingText : 	'<?php echo elgg_echo('highslide:loadingText'); ?>',
		loadingTitle: 	'<?php echo elgg_echo('highslide:loadingTitle'); ?>',
		focusTitle 	: 	'<?php echo elgg_echo('highslide:focusTitle'); ?>',
		fullExpandTitle :'<?php echo elgg_echo('highslide:fullExpandTitle'); ?>',
		creditsText	: 	'<?php echo $slidecredit; ?>',
		creditsTitle: 	'<?php echo $slidecreditsTitle; ?>',
		previousText: 	'<?php echo elgg_echo('highslide:previousText'); ?>',
		nextText	: 	'<?php echo elgg_echo('highslide:nextText'); ?>', 
		moveText	: 	'<?php echo elgg_echo('highslide:moveText'); ?>',
		closeText	: 	'<?php echo elgg_echo('highslide:closeText'); ?>', 
		closeTitle	:	'<?php echo elgg_echo('highslide:closeTitle'); ?>', 
		resizeTitle	:	'<?php echo elgg_echo('highslide:resizeTitle'); ?>',
		playText	: 	'<?php echo elgg_echo('highslide:playText'); ?>',
		playTitle	: 	'<?php echo elgg_echo('highslide:playTitle'); ?>',
		pauseText	: 	'<?php echo elgg_echo('highslide:pauseText'); ?>',
		pauseTitle	: 	'<?php echo elgg_echo('highslide:pauseTitle'); ?>',
		previousTitle	:'<?php echo elgg_echo('highslide:previousTitle'); ?>',
		nextTitle 	: 	'<?php echo elgg_echo('highslide:nextTitle'); ?>',
		moveTitle	: 	'<?php echo elgg_echo('highslide:moveTitle'); ?>',
		fullExpandText 	:'<?php echo elgg_echo('highslide:fullExpandText'); ?>',
		number		: 	'<?php echo elgg_echo('highslide:number'); ?>',
		restoreTitle: 	'<?php echo elgg_echo('highslide:restoreTitle'); ?>'
		};
	
	
	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: <?php echo $slidetime; ?>,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .75,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
	
</script>
