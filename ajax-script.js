$(document).on('click','#showData',function(e){
      $.ajax({    
        type: "GET",
        url: "top10.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#table-container").html(data); 
           
        }
    });
});