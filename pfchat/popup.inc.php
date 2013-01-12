<?php
// Poor container for popup version of pfchat
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<title><?php elgg_echo("pfchat") ?></title>   
</head> 
 
<body> 
 
 
<div id="page_container"> 
<div id="page_wrapper"> 
<div id="layout_canvas"> 
  <?php $pfchat->printChat(); ?>
</div><!-- /#layout_canvas --> 
</div><!-- /#page_wrapper --> 
</div><!-- /#page_container -->  
</body> 
</html>