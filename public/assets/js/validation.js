$(document).on("blur", ".validation-required", (e) => {
    var proceed = true;
    if($(e.currentTarget).get(0).tagName == "INPUT" && ($(e.currentTarget).attr("type") == "checkbox" || $(e.currentTarget).attr("type") == "radio")){
        var ref = $(e.currentTarget).attr("name");
        if(ref == undefined){
            warning_response("Element does not have name attribute!");
            return false;
        }
        if($("input[name='" + ref + "']:checked").length == 0){
            proceed = false;
        }
    }else{
        var ref = $(e.currentTarget).attr("id");
        if(ref == undefined){
            warning_response("Element does not have id attribute!");
            return false;
        }
        if($(e.currentTarget).val() == ""){
            proceed = false;
        }
    }

    ref = ref.replaceAll("_", " ");
    if(!proceed){
        var message = ref.charAt(0).toUpperCase() + ref.slice(1) + " is required.";
        var asterisk = "<span class='star-required'>*</span>"
        var el = "<div class='text-white error-message'>" + message + "</div>";
        if(!$(e.currentTarget).hasClass("validation-failed")){
            $(e.currentTarget).after(el);
            $(e.currentTarget).addClass("validation-failed");
            $(e.currentTarget).css("border", "1px solid #dc3545");
            $(e.currentTarget).parent().parent().children(".form-label").after(asterisk);
        }
    }else{
        $(e.currentTarget).css("border", "");
        $(e.currentTarget).removeClass("validation-failed");
        $(e.currentTarget).siblings(".error-message").remove();
        $(e.currentTarget).parent().parent().children(".star-required").remove();
        if(ref == "email"){
            let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
            var format = regex.test($(e.currentTarget).val());
            if(!format){
                var message = "Email format is invalid.";
                var asterisk = "<span class='star-required'>*</span>"
                var el = "<div class='text-white error-message'>" + message + "</div>";
                $(e.currentTarget).after(el);
                $(e.currentTarget).addClass("validation-failed");
                $(e.currentTarget).css("border", "1px solid #dc3545");
                $(e.currentTarget).parent().parent().children(".form-label").after(asterisk);
            }
        }
    }
});
"use strict";
class Helper{
    static async validate(form){
        var ret = {
            status: true
        };

        var fields = $(`${form} .validation-required`);
        var checked_fields = [];
        for(var i=0;i<fields.length;i++){
            if($(fields[i]).get(0).tagName == "INPUT" && 
            ($(fields[i]).attr("type") == "radio" || $(fields[i]).attr("type") == "checkbox")){
                if($("input[name='" + $(fields[i]).attr("name") + "']:checked").length == 0){
                    ret.status = false;
                    var ref = $(fields[i]).attr("name").replaceAll("[]", "");
                    if(ref == undefined){
                        warning_response("Element does not have id attribute!");
                        return false;
                    }
                    if(checked_fields.includes(ref)){
                        continue;
                    }
                    ref = ref.replaceAll("_", " ");
                    var message = ref.charAt(0).toUpperCase() + ref.slice(1) + " is required.";
                    var el = "<div class='text-white error-message' style='bottom:-20px!important;'>" + message + "</div>";
                    var asterisk = "<span class='star-required'>*</span>"
                    if(!$(fields[i]).hasClass("validation-failed")){
                        $(fields[i]).after(el);
                        $(fields[i]).addClass("validation-failed");
                        $(fields[i]).css("border", "1px solid #dc3545");
                        $(fields[i]).parent().parent().children(".form-label").after(asterisk);
                    }
                    checked_fields.push(ref);
                }
            }else{
                if($(fields[i]).val() == ""){
                    ret.status = false;
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
        }
        return ret;
    }
};