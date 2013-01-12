<?php
?>
<script type="text/javascript">
$(document).ready(function(){	
	$(function() {
		if($('.phloor-list-news .elgg-item').length > 2) {
    		$('.phloor-list-news .elgg-item').css('width', '220px');
    		$('.phloor-list-news .elgg-item').css('margin', '10px');
    		$('.phloor-list-news .elgg-item').css('float', 'left');
    		$(".phloor-list-news").masonry({
    		    // options
    		    itemSelector : '.elgg-item',
    		    columnWidth : 240
    		});
    	}
	});
});	
</script>
<?php
