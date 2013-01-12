<?php 
        /**
         * @package OpenTok VideoChat
         * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
         * @author Roger Curry, Grid Research Centre [curry@cpsc.ucalgary.ca]
         * @link http://grc.ucalgary.ca/
	 * @author Jeroen Dalsem, ColdTrick IT Solutions [jdalsem@coldtrick.com]
         * @link http://coldtrick.com/
	 * @remark Please see CREDITS
         */

	$container = $vars["room_container"]; // id of element that will be removed after popout
	$popout_url = $vars["popout_url"];
	
	if(get_plugin_setting("enable_popout", "videochat") != "no" && $popout_url){
?>
        <input type="button" value="Pop out" id ="popoutLink" onClick="javascript:window.location='#';videochat_popout();" />
	<div class="clearfloat"></div>	
</div>
<div id="videochat_popout">
	<span><?php echo elgg_echo("videochat:popout:info")?></span>
	<div class="clearfloat"></div>
</div>
</div>


<script type="text/javascript">
	function videochat_popout(){
		 hide('popoutLink');

		 popedout=true;
		 disconnect();
		<?php if($container){?>
			$("#<?php echo $container;?>").hide();		
		<?php } ?>

		popoutchild= window.open("<?php echo $popout_url;?>" + '&name=' + document.getElementById("username").value,'videochat','toolbar=0,location=0,directories=0,status=0,menubar=0,resizable=1,top=0,left=0');
		show('popinLink');
		$("#videochat_popout span").show();
	}
</script>
<?php
} else {
  echo '</div>';
}
?>