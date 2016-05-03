$(document).ready(function(){
    $("button.quiz-activate").click(function(e){
      e.preventDefault();
      
      var url = $(this).attr("url");
      $.ajax({
                    url : url,
                    type : "get",
                    dataType:"text",
                    context: this,
                    data : {
                    },
                    success : function (result){
                        var obj = jQuery.parseJSON(result);
                        if(obj.error == false){
                          alert("Success");

                          if(obj.activated == true){
                            $(this).removeClass("btn-warning");
                            $(this).addClass("btn-success");
                            $(this).html("activated");
                          }else{
                            $(this).removeClass("btn-success");
                            $(this).addClass("btn-warning");
                            $(this).html("activate");
                          }
                        }else{
                          alert("Error");
                        }
                        
                    }
                });
    });
});