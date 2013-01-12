
$(function(){
  $("#sort_wiauctions").change(function(){
  

		var str = document.URL;
                
                if(str.indexOf("?sort") != -1){
                    str = str.substring(0, str.indexOf("?sort"));
                }

                var sort;
		if(this.value=="0"){
			sort = "?sort=expiry";
		}
		else{
			sort = "?sort=latest";
		}	
		window.location = str + sort;
	  
  });
});
