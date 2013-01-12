<?php


	
        $wibid = get_entity($vars['guid']);
        
//        echo <<<HTML
//    <script language="javascript">confirm("$wibid->wijob_id")</script>
//HTML;

    echo elgg_view('input/hidden', array('name' => 'wibid_id', 'value' => $wibid->guid));
    echo elgg_view('input/submit', array('value' => elgg_echo("wibid:delete"), 'class' => 'delete-wibid-button'));        	
        
        
