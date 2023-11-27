$(document).on("blur", ".validation-required", (e)=>{
    var id = $(e.target).attr("id");
    if(id == undefined){
        warning_response("Element does not have id attribute!");
        return false;
    }
    id = id.replaceAll("_", " ");
    if($(e.target).val() == ""){
        var message = id.charAt(0).toUpperCase() + id.slice(1) + " is required.";
        var asterisk = "<span class='star-required'>*</span>"
        var el = "<div class='text-white error-message'>" + message + "</div>";
        if(!$(e.target).hasClass("validation-failed")){
            $(e.target).after(el);
            $(e.target).addClass("validation-failed");
            $(e.target).css("border", "1px solid #dc3545");
            $(e.target).parent().parent().children(".form-label").after(asterisk);
        }
    }else{
        $(e.target).css("border", "");
        $(e.target).removeClass("validation-failed");
        $(e.target).siblings(".error-message").remove();
        $(e.target).parent().parent().children(".star-required").remove();
        if(id == "email"){
            let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
            var format = regex.test($(e.target).val());
            if(!format){
                var message = "Email format is invalid.";
                var asterisk = "<span class='star-required'>*</span>"
                var el = "<div class='text-white error-message'>" + message + "</div>";
                $(e.target).after(el);
                $(e.target).addClass("validation-failed");
                $(e.target).css("border", "1px solid #dc3545");
                $(e.target).parent().parent().children(".form-label").after(asterisk);
            }
        }
    }
})

class helper{
    static submit(param){
        $(param["id"]).submit(function(e){
            e.preventDefault();
            var fields = $(param["id"] + " .validation-required");
            var proceed = true;
            for(var i=0;i<fields.length;i++){
                if($(fields[i]).val() == ""){
                    proceed = false;
                    var id = $(fields[i]).attr("id");
                    if(id == undefined){
                        warning_response("Element does not have id attribute!");
                        return false;
                    }
                    id = id.replaceAll("_", " ");
                    var message = id.charAt(0).toUpperCase() + id.slice(1) + " is required.";
                    var el = "<div class='text-white error-message'>" + message + "</div>";
                    var asterisk = "<span class='star-required'>*</span>"
                    if(!$(fields[i]).hasClass("validation-failed")){
                        $(fields[i]).after(el);
                        $(fields[i]).addClass("validation-failed");
                        $(fields[i]).css("border", "1px solid #dc3545");
                        $(fields[i]).parent().parent().children(".form-label").after(asterisk);
                    }
                }
            }
            if(proceed){
                axios.post(param["url"], param["formdata"](), apiHeader)
                .then((response)=>{
                    if(response.data.status){
                        param["callback"]();
                    }else{
                        warning_response(response.data.message);
                    }
                })
                .catch((err) => {
                    error_response(err);
                })
            }else{
                warning_response("Please complete all required fields.");
            }
        })
    }
}



