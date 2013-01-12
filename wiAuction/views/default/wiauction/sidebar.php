<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



echo elgg_view_module('featured',  
                        elgg_echo("wiauction:sort:title"), 
                        elgg_view('input/sort_wiauctions', $vars) 

                                );

        
  echo elgg_view('webIntFramework/category_sidebar', array('subtype' => 'wiauction', 'selected_cat' => $vars['selected_cat']));
               