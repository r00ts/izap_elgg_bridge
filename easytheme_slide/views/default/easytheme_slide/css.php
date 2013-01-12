<?php
/**
 * EasyTheme
 *
 * Contains CSS for EasyTheme
 *
 *  *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/******************/
/*EasyTheme*/
/******************/

/***** This is where you choose the main background of the page ~ here it is a repeated background image */
body{
	background:url('<?php echo $vars['url']; ?>mod/easytheme_slide/img/bkgr.gif');
	/*background:#cccccc;*/
	
}

/**** EasyTheme_slide -> Logo ******/
#easylogo {
	width:221px;
	height:90px;
	margin-left:6px;
}
/**** EasyTheme_slide -> top section behind logo ********/ 
#banner {
	padding-top:6px;
	height: 100px; 
	width:100%;
	background:#fff;
	background:url('<?php echo $vars['url']; ?>mod/easytheme_slide/img/bannerbk.gif');
	border-bottom:1px solid #181a2f;
}

/***** EasyTheme -> This is where you change the header image ~ headimg.jpg ****  EasyTheme_slide -> this is where the content slider is*/
#mmtop{
	top:100px;	
	padding-top:10px;
	padding:0px;
	height:330px;
        background:#fff;
	background:url('<?php echo $vars['url']; ?>mod/easytheme_slide/img/headimg.jpg');
}



/***** Main centre panel */	
#page_container {
	width:990px; 
	margin:0px auto; 
          
/***** Should it have a border, a coloured background, or an image? */  
       
        /*border-right:5px solid #fff;*/ 
        /*border-left:4px solid #fff;*/
	  background:#fff;
        /*background:url('<?php echo $vars['url']; ?>mod/easytheme_slide/img/bkgr.gif');*/


/***** This is where you make the centre panel 100% high ~ might need extra code to work in IE */

        min-height: 100%;

/***** This is the shadow on the centre panel */       

        -moz-box-shadow: 0 0 10px #888;
        -webkit-box-shadow: 0 0 10px#888;
        box-shadow: 0 0 10px #181a2f;
        }
    
      
/****** Change colour of sidebar here */
 .elgg-layout-one-sidebar{	
	background:#cccccc; 
	} 


/****** Change colour of main white content area here */
.elgg-main	{	
	background:#fff;
        min-height:500px;
        height:100%;
	}
	
        
        
 /***** PAGE FOOTER ******/
.elgg-page-footer {                  
         height:100px;
}

/***** Change footer background colour here */
.elgg-page-footer {
	color: #999;
        background:#181a2f;  
      }
      
.elgg-page-footer a:hover {
	color: #666;
}


/**** just a few further tweaks */

/**** changed positioning */
#login-dropdown {
	position: absolute;
	top:110px;
	right:0;
	z-index: 100;  
	margin-right:10px;          
}

#wrapper_header {
}

.elgg-menu-item-report-this{
   margin-left:10px;
	margin-top:5px;
}
.mts {
	margin-right:10px; 	
}

/*********    Change tab hover here ~ 'Members'   ********/
.elgg-tabs a:hover{
	color:#000;
	}

.elgg-river-comments-tab{
color:#cd9928;
}

.elgg-page-default .elgg-page-header > .elgg-inner {

	height: 437px;  /********Change the height here, to match the height of the image*****/
}
