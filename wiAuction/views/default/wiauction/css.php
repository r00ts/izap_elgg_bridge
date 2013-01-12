<?php
/**
 * Elgg wiauctions Plugin
 * @author Web Intelligence 
 */

global $CONFIG;
?>

#win-text{
font-weight:bold;
}

#wiauction-file{
margin: 5px;
font-weight:bold;
}

.wiauction-attr{
margin:20px;
float:left;
}

.mandatory{
background-image: url('<?php echo $CONFIG->url?>mod/wiAuction/graphics/red_asterisk.gif');
background-repeat: no-repeat;
background-attachment:fixed;
background-position: 30% 20%; 
}

.wiauctions_pricetag {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:#00a700;
	border: 1px solid #00a700;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	height: 12px;
	padding: 2px 10px 2px 10px;
	margin:10px 0 10px 0;
}

.wibid-owner-title{
    font-size: 1.0em;
}

.wibidlist{
    margin: 5px 0 5px 0;
}

.wibid-owner-name-container{
    width:160px; 
    float: left; 
    height: 35px; 
    padding:2px 10px 2px 10px; 
    overflow:hidden;
}
.wibidlist-price {
    padding:10px 10px 7px 10px;
    text-align:right;
    float: left; 
    height:20px;
    font-size: 1.5em;
    color: #666;
    width:80px;
}

.wibidlist-location {
    padding:10px 10px 7px 10px;
    text-align:right;
    float: left; 
    height:20px;
    font-size: 1.0em;
    color: #666;
}

.right{
    float: right;
}
.wibidlist-rating {
    padding:7px 10px 7px 10px;
    width:130px; 
    float: left; 
    height:20px;
    font-size: 1.2em;
    color: #666;
}
.wibidlist-detail{
    float: right;
    padding: 10px;
    text-decoration: none;
    //background: #EEE;
}
.wibidlist-detail:hover{
    text-decoration: none;
}

.wibidlist-detail-button{
    //background: #;
    height: 40px;
    float: right;
    font-size:1.2em;
    
    border-radius:0;
    border: 0;
    color:white;
    padding-left: 20px;
    padding-right: 20px;
}



.wibid-for-wiauction-button{
    float: right;
    height: 50px;
    width: 150px;
    margin:0;
}
.wibid-for-wiauction-button:hover{
    background: #CEFF16;
}

.wibidlist-status{
    padding:5px 10px 5px 10px;
    width:80px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}

.wibid-details{
    padding:5px 10px 5px 10px;
    width:120px; 
    float: left; 
    //height:20px;
    font-size: 1.1em;
    color: #666;
}

.wibidlist-owner{
    padding:5px 10px 5px 10px;
    width:65px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}
.wibidlist-daysleft{
    padding:5px 10px 5px 10px;
    width:80px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}

.wibidlist-meta{
    padding:5px 10px 5px 10px;
    width:80px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}

.wibid-back-link{
    background: #DDD;
    color: white;
    width: 100px;
    height: 16px;
    padding: 4px;
    text-align: center;
    margin-bottom: 10px;
    //border: 1px solid #00a700;
    border-radius: 4px;
    -webkit-border-radius: 4px; 
    -moz-border-radius: 4px;    
}
.wibid-back-link:hover{
    background: #CCC;
}

.wibid-back-link a{
    color: white;
    font-size: 1.2em;
}
.wibid-back-link a:hover{
    text-decoration: none;
}

.wibid-warning {
    background: #FFDDDD;
    padding: 10px;
    border-radius: 4px;
    -webkit-border-radius: 4px; 
    -moz-border-radius: 4px;    
    margin-bottom: 10px;
}
.wibid-warning-title{
    font-weight: bold;
    color: #666;
}

.wibid-detail{
    width:518px; 
    min-height: 100%; 
    float:left; 
    margin: 0 0 10px 10px; 
    //background: #EEE;
}


#wibid-winner-title{
    margin-top: 10px;
    font-size:1.5em;
    font-weight: bold;
    color:#555;
    padding:5px;
    border-top: 4px solid #DDD;
}


.elgg-wiauctions-subtext-1{
    color: #777;
    width:200px;
    float:left;
}

.elgg-wiauctions-subtext-2{
    color: #777;
    width:170px;
    float:left;
}

.elgg-wiauctions-county{
    color: #777;
    width:470px;
    float:left;
}

.elgg-wiauctions-excerpt{
    color:#777;
    width:220px;
    float:left;
}

.elgg-wiauctions-rate{
width:150px;
float:left;
}

.elgg-wiauctions-winner{
float:left;
margin:0 30px 0 30px;
}

#wiauction-status{
color: #FA5858;
margin:10px;
font-size:1.2em;
clear:both;
}

