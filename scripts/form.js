$( document ).ready(function(){
    $("#main_form").submit(function( event ) {
        var result = true;
        if($("#name").val().length == 0){
            $("#error_name").css({'visibility': 'visible'});
            $("#name").addClass("red_border");
            result = false;
        }
        if($("#second_name").val().length == 0){
            $("#error_sec_name").css({'visibility': 'visible'});
            $("#second_name").addClass("red_border");
            result = false;
        }
        if($("#patronimic").val().length == 0){
            $("#error_patronimic").css({'visibility': 'visible'});
            $("#patronimic").addClass("red_border");
            result = false;
        }

        if($("input[name='free_time_preferences[]']:checked").length > 3){
            $("#error_checkboxes").css({'visibility': 'visible'});
            result = false;
        }

        if(result){
            setInterval(function(){
                window.location.href="index.php";
            }, 20);
        }

        return result;
    });

    $(":checkbox").change(function(event) {
        if($("input[name='free_time_preferences[]']:checked").length <= 3) {
            $("#error_checkboxes").css({'visibility': 'hidden'});
        }
    });
    
    $(":text").keypress(function(event) {
       var id = $(event.target).attr("id");
	   $("#" + id).removeClass("red_border");
        var errorMsgId;
        if(id == "name") {
            errorMsgId = "error_name";
        } else if (id == "second_name") {
            errorMsgId = "error_sec_name";
        } else {
            errorMsgId = "error_patronimic";
        }
        
	   $("#" + errorMsgId).css({'visibility': 'hidden'});
    });
});