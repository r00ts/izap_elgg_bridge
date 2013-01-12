<?php
/**
 * Community Twitter Widget
 * Elgg 1.8
 *
 */
function social_widget()
{
    elgg_register_widget_type('swTwitterWidget', elgg_echo('social_Widget:Widget'), elgg_echo('social_Widget:WidgetDescription'));
}

// registering the plugin
elgg_register_event_handler('init', 'system', 'social_widget');
