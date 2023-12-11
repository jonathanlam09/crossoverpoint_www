@include("include/header")
<style>
    .visitor-form > *{
        transform: translateY(50%);
        opacity: .2;
        transition: .5s ease;
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3><?php echo $channel == "ENG" ? "VISITORS" : "访客"?></h3>
    </div>
</div>
<div class="container mt-5 mb-5" id="visitor_div">
    <form class="visitor-form" id="visitor_form" onsubmit="submit_handler(event)">
        <div style="font-size:16px;"><?php echo $channel == "ENG" ? "What is your name?" : "您的姓名？"?></div>
        <div class="row">
            <div class="col-sm-6 mt-5 position-relative">
                <input type="text" class="form-control validation-required" id="first_name" name="first_name" placeholder="First name..." style="border: none;background-color:transparent;border-bottom:1px solid;border-radius:0!important;">
            </div>
            <div class="col-sm-6 mt-5 position-relative">
                <input type="text" class="form-control validation-required" id="last_name" name="last_name" placeholder="Last name..." style="border: none;background-color:transparent;border-bottom:1px solid;border-radius:0!important;">
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your email?" : "您的电邮地址？"?></div>
        <div class="row">
            <div class="col-sm-6 mt-5 position-relative">
                <input type="text" class="form-control validation-required" id="email" name="email" placeholder="johndoe@example.com..." style="border: none;background-color:transparent;border-bottom:1px solid;border-radius:0!important;">
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your contact?" : "您的联系号码？"?></div>
        <div class="row">
            <div class="col-sm-6 mt-5 position-relative">
                <input type="text" class="form-control validation-required" id="contact" name="contact" placeholder="0123456789" style="border:none;background-color:transparent;border-bottom:1px solid;border-radius:0!important;">
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your address?" : "您的地址？"?></div>
        <div class="row">
            <div class="col-12 mt-5 position-relative">
                <textarea name="address" class="form-control validation-required" id="address" style="background-color:transparent;border:1px solid;border-radius:0!important;"></textarea>
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your age?" : "您的年龄？"?></div>
        <div class="row">
            <div class="col-sm-6 mt-5 position-relative">
                <input type="number" class="form-control validation-required" id="contact" name="contact" placeholder="Eg. 24" style="border:none;background-color:transparent;border-bottom:1px solid;border-radius:0!important;">
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your occupation?" : "您的职业？"?></div>
        <div class="row">
            <div class="col-sm-6 mt-5 position-relative">
                <input type="text" class="form-control validation-required" id="occupation" name="occupation" placeholder="Eg. Software engineer" style="border:none;background-color:transparent;border-bottom:1px solid;border-radius:0!important;">
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your sex?" : "您的性别？"?></div>
        <div class="d-flex mt-5 position-relative">
            <div>
                <input class="validation-required" id="sex" type="radio" name="sex" value="1">
                <label for=""><?php $channel == "ENG" ? "Male" : "男"?></label>
            </div>
            <div style="margin-left:20px;">
                <input type="radio" name="sex" value="0">
                <label for=""><?php $channel == "ENG" ? "Female" : "女"?></label>
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your marital status?" : "您的婚姻状况？"?></div>
        <div class="d-flex mt-5">
            <div>
                <input type="radio" name="marital_status" value="1">
                <label for=""><?php echo $channel == "ENG" ? "Married" : "已婚"?></label>
            </div>
            <div style="margin-left:20px;">
                <input type="radio" name="marital_status" value="2" checked>
                <label for=""><?php echo $channel == "ENG" ? "Single" : "单身"?></label>
            </div> 
            <div style="margin-left:20px;">
                <input type="radio" name="marital_status" value="3">
                <label for=""><?php echo $channel == "ENG" ? "Divorced" : "已离婚"?></label>
            </div>
            <div style="margin-left:20px;">
                <input type="radio" name="marital_status" value="4">
                <label for=""><?php echo $channel == "ENG" ? "Widowed" : "寡"?></label>
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "What is your religion?" : "您的信仰？"?></div>
        <div class="mt-5 d-flex flex-column">
            <div>
                <input type="radio" name="religion" id="christian" value="1" style="margin-right:10px;" checked>
                <label for="christian"><?php echo $channel == "ENG" ? "Christian" : "基督教"?></label>
            </div>
            <div>
                <input type="radio" name="religion" id="buddhist" value="2" style="margin-right:10px;">
                <label for="buddhist"><?php echo $channel == "ENG" ? "Buddhist" : "佛教"?></label>
            </div>
            <div>
                <input type="radio" name="religion" id="hindhu" value="3" style="margin-right:10px;">
                <label for="hindhu"><?php echo $channel == "ENG" ? "Hindhu" : "印度教"?></label>
            </div>
            <div>
                <input type="radio" name="religion" id="islam" value="4" style="margin-right:10px;">
                <label for="islam"><?php echo $channel == "ENG" ? "Islam" : "伊斯兰教"?></label>
            </div>
            <div>
                <input type="radio" name="religion" id="atheist" value="5" style="margin-right:10px;">
                <label for="atheist"><?php echo $channel == "ENG" ? "Atheist" : "无神论者"?></label>
            </div>
            <div>
                <input type="radio" name="religion" id="agnostic" value="6" style="margin-right:10px;">
                <label for="agnostic"><?php echo $channel == "ENG" ? "Agnostic" : "不可知论者"?></label>
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "Are you currently attending any church?" : "您目前正在参加任何教堂吗？"?></div>
        <div class="mt-5 d-flex align-items-center">
            <div>
                <input class="validation-required" type="radio" name="is_attend_church" id="is_attend_church" value="1" checked onclick="attend_church(1)">
                <label>Yes</label>
            </div>
            <div style="margin-left:20px;">
                <input type="radio" name="is_attend_church" value="0" onclick="attend_church(0)">
                <label>No</label>
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "Which church are you currently attending?" : "您目前参加哪个教会？"?></div>
        <div class="mt-5 row">
            <div class="col-md-6 position-relative">
                <input type="text" placeholder="Eg. Crossover Point" id="church_name" class="form-control validation-required" name="church_name" style="border:none;background-color:transparent;border-bottom:1px solid;border-radius:0!important;">
            </div>
        </div>
        <div style="font-size:16px;margin-top:5rem;"><?php echo $channel == "ENG" ? "How did you come to know of this service?" : "您是如何得知有关此聚会？"?></div>
        <div class="mt-5 position-relative">
            <div>
                <input class="validation-required" type="checkbox" name="purpose[]" value="1">
                <label><?php echo $channel == "ENG" ? "I want to receive Christ" : "我想接受基督为救主"?></label>
            </div>
            <div>
                <input class="validation-required" type="checkbox" name="purpose[]" value="2">
                <label><?php echo $channel == "ENG" ? "I need healing" : "我需要治疗"?></label>
            </div>
            <div>
                <input class="validation-required" type="checkbox" name="purpose[]" value="3">
                <label><?php echo $channel == "ENG" ? "I want to know more about Christ" : "我想要知道更多有关基督教信仰"?></label>
            </div>
            <div>
                <input class="validation-required" type="checkbox" name="purpose[]" value="4">
                <label><?php echo $channel == "ENG" ? "I need spiritual counselling" : "我需要精神上的辅导"?></label>
            </div>
        </div>
        <div class="d-flex justify-content-end" style="margin-top:5rem;">
            <a class="btn" href="javascript:history.go(-1)" style="background-color:lightgrey;color:white;margin-right:10px;"><?php echo $channel == "ENG" ? "BACK" : "回去"?></a>
            <button type="submit" class="btn btn-primary"><?php echo $channel == "ENG" ? "SUBMIT" : "提交"?></button>
        </div>
    </form>
</div>
<script>
    const options = {
        root: document.getElementById("#visitor_form"),
        rootMargin: "0px",
        threshold: 0,
    };

    var observer = new IntersectionObserver(show_item, options);

    $(document).ready(() => {
        const fields = $(".visitor-form").children();
        if(fields.length > 0){
            for(var i=0; i<fields.length;i++){
                observer.observe(fields[i]);
            }
        }
    })

    async function submit_handler(e){
        e.preventDefault();
        const fields = $(".visitor-form .validation-required");
        const validation = await Helper.validate(fields);
        if(!validation.status){
            warning_response(validation.message ? validation.message : validation_msg);
            return false;
        }

        const form = $(".visitor-form").get(0);
        var formdata = new FormData(form);
        axios.post(address + "api/visitors/create", formdata, apiHeader)
        .then((response) => {
            if(response.data.status){
                success_response("Successfully registered!", true, "");
            }else{
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            error_response(err);
        })
    }

    function attend_church(val){
        if(val == 1){
            $("#church_name").attr("disabled", false);
            $("#church_name").addClass("validation-required");
        }else{
            $("#church_name").attr("disabled", true);
            $("#church_name").removeClass("validation-required");
        }
    }

    function show_item(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                console.log(entries[i].target, entries[i].isIntersecting)
                if(entries[i].isIntersecting){
                    $(entries[i].target).css("transform", "translateX(0%)");
                    $(entries[i].target).css("opacity", "1");
                }
            }
        }
    }
</script>
@include("include/footer")
