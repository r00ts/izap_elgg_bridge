<div id="content_area_user_title"><h2><?php echo elgg_echo('item:object:IzapOfferArticle');?></h2></div>
<?php
echo elgg_view(func_get_template_path_byizap(array('type'=>'pages', 'plugin'=>"izap-offer-article"))."list",array('entities'=>$vars['results']['entities']));
