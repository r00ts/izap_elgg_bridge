<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* @version
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
*/
?>
/* layout style */
.layout-offer-article-lef-col-byizap { float: left; width:65%;}
.layout-offer-article-right-col-byizap{ float:right; width:35%; }
/* end layout style */

.header-tools-entities-byizap {margin:0 15px 5px 0;font-size:11px;color:#999;float:right;cursor:pointer;}

.list-entities-byizap{margin:0;}
.row-entity-byizap{font-size:12px;}

.entity-row-even-byizap{background-color:#F8FAEC; border-top:#DFE3C8 1px solid; border-bottom:#DFE3C8 1px solid;}

.entity-info-byizap{float:left; width:75%; margin-right:10px;}
.entity-col2-byizap{float:left; margin-left:10px;}

.entity-description-expand-byizap{color:#BDC88A;margin:10px 0 5px 0;font-weight:bold;cursor:pointer;}
.entity-rate-byizap{margin:5px 0 10px 0;}
.entity-tool-icon-byizap{margin-right:5px;float:left;width:13%;}

.entity-detail-byizap{}
.entity-img-byizap{width:110px; float:left;}
.entity-title-byizap{color:#FBAC4A; font-size:14px; font-weight:bold;}
.entity-title-byizap span a{color:#4690D6; font-weight:normal; font-size:12px;}
.entity-title-byizap span a:hover{ text-decoration:underline;}
.entity-description-short-byizap, .entity-description-full-byizap{margin-top:10px;}
.entity-description-full-byizap{display:none;}
.entity-desc-footer-box-byizap {background-color: #FBF2D8; border: 1px solid #F5DA8B; margin:0 0 10px 0;}
.entity-desc-footer-box-byizap label { font-size: 12px; color: #666666;}
.entity-expire-date-byizap{margin-bottom:5px;}
.entity-award-amt-byizap{color:#FBAC4A; font-weight:bold;}
.entity-awards-byizap{margin-top:5px;}

.pagination-byizap{float:right; margin-bottom:0;padding-bottom:0;}

.listing-tools-byizap{background-color:#E6EEC2; border-top:#DFE3C8 1px solid; border-bottom:#DFE3C8 1px solid;padding:5px;margin:10px;}
.listing-sort-byizap{width:40%;float:left;padding-left:10px;}


/* user profiles box */
.user-profiles-box-byizap{border:#eee 1px solid; margin:0 0 10px 10px;}
.profile-box-title-byizap{background-color:#EEE ;color:#666; font-size:16px; font-weight:bold;padding:10px;margin:0;}
.profile-box-contents-byizap{background-color:#F7F5F2;margin:0;padding:0;}
.profile-entity-byizap{padding:10px;font-size:12px;}
.profile-icon-byizap{ float:left; width:33%;}
.profile-userinfo-byizap{ float:left; width:60%; margin-left:10px;}
.profile-user-title-byizap{color:#FBAC4A; font-weight:bold; margin-bottom:5px;}
.profile-user-desc-byizap{margin:5px 0 5px 0;}
.profile-user-link-byizap a{color:#CAD599;text-decoration:underline;font-weight:bold;font-size:11px;}

/* end user profiles box */

.view-entity-detail-byizap{font-size:13px;color:#666;margin:0;padding:0;}
.entity-desc-byizap {font-size:13px; color:#333; float:left; margin:2px; padding: 2px 0 2px 0;}
.entity-desc-byizap img { float:left; margin:0 5px 5px 0; padding: 0 5px 5px 0;}
.entity-reviews-byizap{}
#groups_info_column_left {padding-left: 10px;}

.list-offer-article-reviews-sidebar-byizap{padding:15px 10px 5px 10px;font-size:11px;}
.review-title-byizap{font-size:13px;font-weight:bold;}
.review-desc-byizap{}

.izap-offer-article-terms{height:400px; width: 625px; overflow:auto; }
.odd {
  background-color: #C8D992;
}

.river_object_IzapOfferArticle_created{
background: url("<?php echo func_get_www_path_byizap(array('plugin' => 'izap-offer-article', 'type' => 'images')); ?>river_post.png") no-repeat scroll left -1px transparent;
}

.river_object_IzapOfferArticle_updated{
background: url("<?php echo func_get_www_path_byizap(array('plugin' => 'izap-offer-article', 'type' => 'images')); ?>river_post.png") no-repeat scroll left -1px transparent;
}

.input-short{ width: 50px;}

/* success/warning/error messages */
div.flash-error, div.flash-notice, div.flash-success
{
	padding:.8em;
	margin-bottom:1em;
	border:2px solid #ddd;
}

div.flash-error
{
	background:#FBE3E4;
	color:#8a1f11;
	border-color:#FBC2C4;
}

div.flash-notice
{
	background:#FFF6BF;
	color:#514721;
	border-color:#FFD324;
}

div.flash-success
{
	background:#E6EFC2;
	color:#264409;
	border-color:#C6D880;
}

div.flash-error a
{
	color:#8a1f11;
}

div.flash-notice a
{
	color:#514721;
}

div.flash-success a
{
	color:#264409;
}
