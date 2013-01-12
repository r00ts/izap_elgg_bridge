
$(document).ready(function(){
 
        $(".slidingDiv").hide();
        $(".show_hide").show();
 
    $('.show_hide').click(function(e){
    	e.preventDefault(); 
    $(".slidingDiv").slideToggle();
    });
 
});
 
