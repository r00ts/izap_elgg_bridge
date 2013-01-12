<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

elgg_load_js("elgg.sortentities");

$options_values[0] = "Expiry Date";
$options_values[1] = "Latest";

if($vars['sort_val']=="Latest"){
    $val = 1;
}
else{
    $val = 0;
}

$options = array("options_values" => $options_values,
                 "name" => "sort_wientity",
                 "id" => "sort_wientity",
                 "value" => $val
                    );

echo elgg_view('input/dropdown', $options);
