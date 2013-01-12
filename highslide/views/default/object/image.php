<?php
	/**
	 *
	 * Tidypics image object views
	 */

	global $CONFIG;
	include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/lib/exif.php";

	$image = $vars['entity'];
	$image_guid = $image->getGUID();
	$tags = $image->tags;
	$title = $image->title;
	$desc = $image->description;
	$owner = $image->getOwnerEntity();
	$friendlytime = friendly_time($image->time_created);

/********************************************************************
 *
 * search view of an image
 *
 ********************************************************************/
	if (get_context() == "search") { 

		// gallery view is a matrix view showing just the image - size: small
		if (get_input('search_viewtype') == "gallery") {
			?>
			<div class="tidypics_album_images">
				<a href="<?php echo $image_guid;?>"><img src="<?php echo $vars['url'].'photos/thumbnail/'.$image_guid;?>" alt="$desc"/></a>
			</div>
			<?php
		}
		else{
			// list view displays a thumbnail icon of the image, its title, and the number of comments
			$info = '<p><a href="'.$vars['url'].'photos/thumbnail/'.$image_guid.'">'.$title.'</a></p>';
			$info .= "<p class=\"owner_timestamp\"><a href=\"{$vars['url']}pg/profile/{$owner->username}\">{$owner->name}</a> {$friendlytime}";
			$numcomments = elgg_count_comments($image);
			if ($numcomments)
				$info .= ", <a href=\"{$image->getURL()}\">" . sprintf(elgg_echo("comments")) . " (" . $numcomments . ")</a>";
			$info .= "</p>";
			$icon = "<a href=\"{$image->getURL()}\">" . '<img src="'.$vars['url'].'photos/thumbnail/'.$image_guid.'" /></a>';
			
			echo elgg_view_listing($icon, $info);
		}

/***************************************************************
 *
 * front page view 
 *
 ****************************************************************/
	} else if (get_context() == "front") {
		// the front page view is a clikcable thumbnail of the image
?>
<a href="<?php echo $image->getURL(); ?>">
<img src="<?php echo $vars['url'];?>photos/thumbnail/<?php echo $image_guid;?>" class="tidypics_album_cover" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
</a>
<?php
	} else {

/********************************************************************
 *
 *  listing of photos in an album
 *
 *********************************************************************/
		if (!$vars['full']) {
			
?>
<?php 
	// plugins can override the image link to add lightbox code here
	$image_html = false;
	$image_html = trigger_plugin_hook('tp_thumbnail_link', 'album', array('image' => $image), $image_html);
	
	if ($image_html) {
		echo $image_html;
	} else {
		// default link to image if no one overrides
		
		//trim the image title to get it fited inside the slide
		$title2 = $image->title;
		$title2 = substr($image->title,0,25);
		if (strlen($title2) > 24) $title2 .= "...";
?>
	<div class="tidypics_album_images">

	<!-- HIGHSLIDE ADDON BY TEAM WEBGALLI-->
	<div class="highslide-gallery" style="margin-bottom:10px">
		<div>
		<a href="<?php echo $image->getURL();?>" class="highslide" onclick="return hs.expand(this, {src: '<?php echo $vars['url'].'photos/thumbnail/'.$image_guid.'/large';?>',align: 'center'})">
		<img src="<?php echo $vars['url'].'photos/thumbnail/'.$image_guid ?>" class="elgg-photo" alt="<?php echo $desc ?>"
		title="<?php if(!empty($desc)){ echo strip_tags($desc) . "\n";} echo elgg_echo('tidypics:clicktoenlarge');?>"  />
		</a>
		<div style="text-align:center"><a href="<?php echo $image->getURL(); ?>" title="<?php echo $title ?>"><?php echo $title2 ?></a></div>
        
	<div class="highslide-caption">
   	 <?php	echo $title2; ?>
    <a href="<?php echo $image->getURL(); ?>"><?php echo elgg_echo('tidypics:leavecomment');?> </a>
	</div>
	</div>
 <!-- /HIGHSLIDE--> 
	</div>
<?php 	
	}
?>
<?php
		} else {

/********************************************************************
 *
 *  listing individual image
 *
 *********************************************************************/

		
			$image = $photo = $vars['entity'];
			$album = $photo->getContainerEntity();
			$next_photo = $album->getNextImage($photo->getGUID());
			
			$img = elgg_view_entity_icon($image, 'large', array(
				'href' => $next_photo->getURL(),
				'img_class' => 'tidypics-photo',
				'link_class' => 'tidypics-lightbox',
			));
			
			$owner_link = elgg_view('output/url', array(
				'href' => "photos/owner/" . $photo->getOwnerEntity()->username,
				'text' => $photo->getOwnerEntity()->name,
			));
			$author_text = elgg_echo('byline', array($owner_link));
			
			$owner_icon = elgg_view_entity_icon($photo->getOwnerEntity(), 'tiny');
			
			$metadata = elgg_view_menu('entity', array(
				'entity' => $vars['entity'],
				'handler' => 'photos',
				'sort_by' => 'priority',
				'class' => 'elgg-menu-hz',
			));
			
			$subtitle = "$author_text $date $categories $comments_link";
			
			$params = array(
				'entity' => $photo,
				'title' => false,
				'metadata' => $metadata,
				'subtitle' => $subtitle,
				'tags' => $tags,
			);
			$list_body = elgg_view('object/elements/summary', $params);
			
			$params = array('class' => 'mbl');
			$summary = elgg_view_image_block($owner_icon, $list_body, $params);
			
			echo $summary;
			
			echo '<div class="tidypics-photo-wrapper center">';
			echo elgg_view('photos/tagging/help', $vars);
			echo elgg_view('photos/tagging/select', $vars);
			echo $img;
			echo elgg_view('photos/tagging/tags', $vars);
			echo '</div>';
			
			if ($photo->description) {
				echo elgg_view('output/plaintext', array(
					'value' => $photo->description,
					'class' => 'description',
				));
			}
			
			echo elgg_view('object/image/navigation', $vars);
			
			echo elgg_view_comments($photo,true);

		} // end of individual image display
	}
?>