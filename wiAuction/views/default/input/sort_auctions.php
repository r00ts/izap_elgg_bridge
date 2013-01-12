<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



elgg_load_js("elgg.sortwiauctions");

$options_values['expiry'] = "Expiry Date";
$options_values['latest'] = "Latest";

$options = array("options_values" => $options_values,
                 "name" => "sort_wiauctions",
                 "id" => "sort_wiauctions",
                 "value" => $vars['sort_val']
                    );

echo elgg_view('input/dropdown', $options);
