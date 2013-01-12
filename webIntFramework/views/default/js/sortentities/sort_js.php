
$(function(){
  $("#sort_wientity").change(function(){
  

		var str = document.URL;
                
                if(str.indexOf("?sort") != -1){
                    str = str.substring(0, str.indexOf("?sort"));
                }

                var sort;
		if(this.value=="0"){
			sort = "?sort=Expiry";
		}
		else{
			sort = "?sort=Latest";
		}	
		window.location = str + sort;
	  
  });
});
