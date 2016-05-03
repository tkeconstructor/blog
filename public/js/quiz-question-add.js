$(document).ready(function(){
    $("button.quiz-add-question").click(function(e){
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

                          if(obj.added == true){
                            $(this).removeClass("btn-warning");
                            $(this).addClass("btn-success");
                            $(this).html("added");
                          }else{
                            $(this).removeClass("btn-success");
                            $(this).addClass("btn-warning");
                            $(this).html("add");
                          }
                        }else{
                          alert("Error");
                        }
                        
                    }
                });
    });
});