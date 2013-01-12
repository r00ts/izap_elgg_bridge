<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

  $show_expiry = elgg_extract('show_expiry', $vars, "yes");  
  $subtype = $vars['subtype'];
 
 $selected_cat = $vars['selected_cat'];

  
  if($show_expiry=="yes"){
  
    
  echo elgg_view_module('featured',  
                        elgg_echo("sort{$subtype}:title"), 
                        elgg_view('input/sort_entities', array('sort_val' => $vars['sort_val'])));
  }
 
 if($subtype=="wijob"){
     $cat_prefix = "wijobskill";
 }
 else{
     $cat_prefix = "wiauction";     
 }
 
 if(is_numeric($selected_cat)){
    echo elgg_view_module('featured',  
                                            elgg_echo("wi:category:{$subtype}"), 
                                            wi_get_entity_category_list($cat_prefix, $subtype, $selected_cat)
                            );
 }
 else{
    echo elgg_view_module('featured',  
                                            elgg_echo("wi:category:{$subtype}"), 
                                            wi_get_entity_category_list($cat_prefix, $subtype)
                            );
     
 }