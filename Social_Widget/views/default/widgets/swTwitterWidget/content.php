<?php

$twitter_username = $vars['entity']->social_username;

// Is there a username? Well show the widget!

if ($twitter_username != null) {

?>

<div align="center">

<!--Twitter Search Feeds HTML code start -->

<link href="http://twitterwidget.net/twitter_class/style.css" rel="stylesheet" type="text/css" />

<div class="feed_container" style="background-color:#0C86C9;width:auto;height:430px" align="left">

<script src="http://twitterwidget.net/twitter_class/index.php?ors=<?php echo $twitter_username; ?>&phrase=&height=430px&title=@<?php echo $twitter_username; ?>"></script>

    <div class="widget-url">

    <div class="line1">if you see only a blue box then refresh page</div>

    <div class="line2">Developed by the <a href="http://twitterwidget.net">SWOT Analysis</a> Expert</div>

      </div>

</div><!--Twitter Search Feeds HTML code end -->

</div>

<?php

}

else

elgg_echo("social_Widget:none");

?>