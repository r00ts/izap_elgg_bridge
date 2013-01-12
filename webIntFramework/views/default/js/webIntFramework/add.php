<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

//<script>
$(document).ready(function(){

	// add buttons
	$(".categories-popup").fancybox();
});


function removeFileType(guid){
	if(confirm(elgg.echo("wi:actions:delete:confirm"))){
		$.post(elgg.security.addToken('<?php echo $vars['url']; ?>action/wi/category/delete?guid=' + guid), function(data){
			if(data == 'true'){
				$('#agent_file_types_' + guid).hide('slow').parent().remove();
				reorderCustomFields();
			} else {
				alert(elgg.echo("profile_manager:actions:delete:error:unknown"));
			}
		});
	}	
}
