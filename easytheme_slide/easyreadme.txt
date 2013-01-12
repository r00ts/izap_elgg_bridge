EasyTheme_Slide
****************


This theme is intended as a starting point, I don't expect you to use the design as it is.  Read on to see how you can change each section of the template to match an existing website design, or to create a new one.  I'm presuming you know something about css.

Open the file mod/easytheme_slide/views/default/easytheme_slide/css.php

The page background choices start at page 18. 

-> Choose between a background colour or image.

-> If you want a background image, put your image in the 'easytheme_slide/img' folder, and link to it from here.

-----------------------------------

Next, the logo bar, across the top of the page.  This starts at line 30. "#banner".  Here you can change the height, background colour, background image, and border options.

-----------------------------------

The css for the logo itself is starts on line 24.  "#easylogo". Change the size and position here.

-> Put your logo in the 'easytheme_slide/img' folder.
-----------------------------------

The section where the content slider is, starts on line 40. "#mmtop"  Change background colour and image here. 

! Change the 'height' property here (line 45), *and* change it again near the end of the file (line 141).

-----------------------------------

Note: The blue bar behind the menu is part of the header image.

-----------------------------------

The Centre panel starts at line 52. 

"#page_container" -> change whole panel width here.
! You also need to change the width settings in 'mod/easytheme_slide/views/default/css/elements/layout.css', on lines 20, 23, 29 and 34.
------------------------------------

To change colour of main content section and sidebar
-> Sidebar css starts at line 77.
-> Main white content area starts at line 83.

-------------------------------------

Page Footer starts at line 92. Change the colour here.

------------------------------------

To change button background and text colours, etc... 

-> mod/easytheme_slide/views/default/css/elements/navigation.php
-> mod/easytheme_slide/views/default/css/elements/buttons.php
-> mod/easytheme_slide/views/default/css/elements/typography.php
Read the notes at the top of these files.

------------------------------------

And that's pretty much it!

*************************************

If you find this useful, and especially if you use it for a commercial project, please consider a donation.
Go to: http://www.jubo.co.uk/blog/2011/10/elgg-1-8-theme2-easy-theme-slide/

**************************************


