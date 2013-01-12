<?php
/**
 * Elgg wijob Plugin
 * @author slyhne
 */

global $CONFIG;
?>

#win-text{
font-weight:bold;
}

#wijob-file{
margin: 5px;
font-weight:bold;
}

.wijob-attr{
float:left;
}

.mandatory{
background-image: url('<?php echo $CONFIG->url?>mod/wijob/graphics/red_asterisk.gif');
background-repeat: no-repeat;
background-attachment:fixed;
background-position: 30% 20%; 
}

.wijob_pricetag {
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

.wiquote-owner-title{
    font-size: 1.0em;
}

.wiquotelist{
    margin: 5px 0 5px 0;
}

.wiquote-owner-name-container{
    width:160px; 
    float: left; 
    height: 35px; 
    padding:2px 10px 2px 10px; 
    overflow:hidden;
}
.wiquotelist-price {
    padding:10px 10px 7px 10px;
    width:80px; 
    text-align:right;
    float: left; 
    height:20px;
    font-size: 1.5em;
    color: #666;
}


.right{
    float: right;
}
.wiquotelist-rating {
    padding:7px 10px 7px 10px;
    width:130px; 
    float: left; 
    height:20px;
    font-size: 1.2em;
    color: #666;
}
.wiquotelist-detail{
    float: right;
    padding: 10px;
    text-decoration: none;
    color:white;
}
.wiquotelist-detail:hover{
    text-decoration: none;
}

.wiquotelist-detail-button{
    //background: #;
    height: 40px;
    float: right;
    font-size:1.2em;
    
    border-radius:0;
    border: 0;
    color:white;
    padding-left: 20px;
    padding-right: 20px;
    background:#83CAFF;
    border-radius: 5px;
}

.wiquotelist-detail-button:hover{
    background: #EEE;
    
}

.wiquote-for-wijob-button{
    float: right;
    height: 50px;
    width: 150px;
    margin:0;
}
.wiquote-for-wijob-button:hover{
    background: #CEFF16;
}

.wiquotelist-status{
    padding:5px 10px 5px 10px;
    width:80px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}

.wiquote-details{
    padding:3px;
    width:105px; 
    float: left; 
    //height:20px;
    font-size: 1.1em;
    color: #666;
}

.wiquotelist-owner{
    padding:5px 10px 5px 10px;
    width:65px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}
.wiquotelist-daysleft{
    padding:5px 10px 5px 10px;
    width:80px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}

.wiquotelist-meta{
    padding:5px 10px 5px 10px;
    width:80px; 
    float: left; 
    height:20px;
    font-size: 0.9em;
    color: #666;
}

.wiquote-back-link{
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
.wiquote-back-link:hover{
    background: #CCC;
}

.wiquote-back-link a{
    color: white;
    font-size: 1.2em;
}
.wiquote-back-link a:hover{
    text-decoration: none;
}

.wiquote-warning {
    background: #FFDDDD;
    padding: 10px;
    border-radius: 4px;
    -webkit-border-radius: 4px; 
    -moz-border-radius: 4px;    
    margin-bottom: 10px;
}
.wiquote-warning-title{
    font-weight: bold;
    color: #666;
}

.wiquote-detail{
    width:518px; 
    min-height: 100%; 
    float:left; 
    margin: 0 0 10px 10px; 
    //background: #EEE;
}


#wiquotes-winner-title{
    margin-top: 10px;
    font-size:1.5em;
    font-weight: bold;
    color:#555;
    padding:5px;
    border-top: 4px solid #DDD;
}


.elgg-wijob-subtext-1{
    color: #777;
    width:200px;
    float:left;
}

.elgg-wijob-subtext-2{
    color: #777;
    width:170px;
    float:left;
}


.elgg-wijob-excerpt{
    color:#777;
    width:275px;
    float:left;
}

.elgg-wijob-rate{
width:150px;
float:left;
}

.elgg-wijob-winner{
float:left;
margin:0 30px 0 30px;
}

#wijob-status{
color: #FA5858;
margin:10px;
font-size:1.2em;
clear:both;
}



.make-it-button a{
	font-family: Arial, Helvetica, sans-serif;
	background-color: #83CAFF;
	color: #FFF;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;


	display: block;
	float:left;
	padding:5px 10px 5px 10px;
    text-decoration: none;
}

.make-it-button a:hover{
    background-color: #AEDF06;
}