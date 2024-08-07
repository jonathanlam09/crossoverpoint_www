@include("include/header")
<section class="paragraph-section d-none">
    <div class="container mt-5 mb-5" style="text-align:center;white-space:pre-line;" id="paragraph_div">
        <?php
            if($channel == "ENG"){
            ?>
                <p id="paragraph" style="display:none;">Creed of Faith
                    I know the only true God. 
                    I know Jesus Christ, the one God sent to earth. 
                    I have the eternal life (John 17:3).  
                    I confess with my mouth that Jesus is Lord. 
                    I believe in my heart that Jesus rose from the dead (Romans 10:9). 
                    I want to know Christ (Phil 3:10). 
                    I will make Christ known to others (Col 1:28). 
                    On that day of His return, I am known by Him as His own (John 10:14).
                </p>
            <?php
            }else{
                ?>
                <p id="paragraph" style="display:none;">信仰信条
                    我认识独一的真神。我认识神所差来的耶稣基督。
                    我得着永生 （17:3）。
                    我口里认耶稣为主。我心里信 神叫祂从死里复活（罗马 10:9）。
                    我要认识基督 （腓 3:10）。
                    我要传扬基督（歌 1:28）。
                    基督再来时，祂认识我，因我属于祂 (约 10: 14)，且遵行祂的旨意（约6:40）。
                </p>
                <?php
            }
            ?>
    </div>
</section>
<hr class="container">
<section class="sermon-section d-none" style="padding: 75px 0;">
    <div class="container" id="sermon_container">
        <h3 class="text-center text-uppercase" style="opacity:.2;transform:translateY(-100%);transition:.5s ease;"><?php echo $channel == "ENG" ? "Upcoming Sermons" : "来临的道"?></h3>
        <?php
            if(!$sermon){
                ?>
                <div class="mt-5 text-center" style="opacity:.2;transform:translateY(-100%);transition:.5s ease;"><?php echo $channel == "ENG" ? "Stay tuned for more upcoming sermons." : "请继续关注即将到来的更多讲道。"?></div>
                <?php
            }else{
                $main_sermon_image = isset($sermon->image) ? IMAGE_PATH . "sermon/" . $sermon->image : url("assets/img/banner.png");
                ?>
                    <div class="row mb-2 mt-5" id="sermon_div">
                        <div class="col-12" style="opacity:.2;transition:.5s ease;transform:translateY(100%);">
                            <div class="img d-flex justify-content-center" style="position:relative;">
                                <a href="<?php echo url("sermons/" . $sermon->encrypted_id)?>"><img src="<?php echo $main_sermon_image?>" style="max-width:800px;width:100%;"></a>
                            </div>
                            <div class="text-center">
                                <h6 class="mt-3 mb-3"><?php echo date("jS F Y 10:00:00 A", strtotime($sermon->date))?></h6>
                                <h6 class="mb-3"><?php echo $channel == "ENG" ? $sermon->title : $sermon->ch_title?></h6>
                                <p><?php echo $channel == "ENG" ? $sermon->description : $sermon->ch_description?></p>
                            </div>
                        </div>    
                    </div>
                <?php
            }
        ?>
    </div>
</section>
<div class="d-flex justify-content-center">
    <a href="<?php echo url("sermons/upcoming")?>" style="color:black;text-decoration:none;"><?php echo $channel == "ENG" ? "View more" : "查看更多"?></a>
</div>
<hr class="container">
<section class="event-section d-none" style="padding: 75px 0;">
    <div class="container" id="event_container">
        <h3 class="text-center text-uppercase" 
        style="opacity:.2;transform:translateY(100%);transition:.5s ease;"><?php echo $channel == "ENG" ? "Upcoming Events" : "来临的活动"?></h3>
        <?php
        if(count($events) == 0){
            ?>
            <div class="mt-5 text-center"
            style="opacity:.2;transform:translateY(100%);transition:.5s ease;"><?php echo $channel == "ENG" ? "Stay tuned for more upcoming events." : "请继续关注更多即将举行的活动。"?></div>
            <?php
        }else{
            $total_event_count = count($events);
            $main_event = $events[0];
            array_splice($events, 0, 1);
            $main_event_image = isset($main_event["image"]) ? $main_event["image"] : "banner.png";
            ?>
            <div class="row mt-5" id="event_div">
                <div class="col-12 <?php echo ($total_event_count > 1) ? 'col-lg-9 ' : ''?>" id="event_main_div" style="opacity:.2;transform:translateY(100%);transition:.5s ease;">
                    <div class="img">
                        <a class="<?php echo ($total_event_count == 1) ? 'd-flex justify-content-center' : 'test'?>" href="<?php echo url("events/" . $main_event["encrypted_id"])?>"><img src="<?php echo IMAGE_PATH . "event/" . $main_event_image?>" style="max-width:800px;width:100%;"></a>
                    </div>
                    <div class="text-center">
                        <div>
                            <span><?php echo date("jS F Y", strtotime($main_event["start_date"]))?></span> . <span><?php echo date("h:i A", strtotime($main_event["start_date"]))?></span>
                            <h6><?php echo $channel == "ENG" ? $main_event["name"] : $main_event["ch_name"];?></h6>
                            <p><?php echo $channel == "ENG" ? $main_event["description"] : $main_event["ch_description"];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 <?php echo ($total_event_count > 1) ? 'col-lg-3' : 'd-none'?>" id="event_subdiv">
                    <?php
                        if(count($events) > 0){
                            foreach($events as $row){
                                $image = isset($row["image"]) ? $row["image"] : "banner.png";
                        ?>
                    <div class="row" style="opacity:.2;transform:translateY(100%);transition:.5s ease;">
                        <a href="<?php echo url("events/" . $row["encrypted_id"])?>">
                            <img class="img-fluid" src="<?php echo IMAGE_PATH . "event/" . $image?>" alt="">
                        </a>
                        <div class="d-flex flex-column align-items-center">
                            <a style="color:black;"><?php echo date("jS F Y", strtotime($row["start_date"]))?></a>
                            <a style="color:black;"><?php echo $row["name"]?></a>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
<div class="initial-loader d-flex flex-column justify-content-center align-items-center" style="transition:1s ease;background-color:black;height:100vh;width:100%;position:fixed;top:0;left:0">
    <div class="initial-loader-logo d-flex justify-content-center bg-white mb-5" style="border-radius:50%;height:150px;width:150px;">
        <img class="img-fluid" src="<?php echo url("assets/img/logo.png")?>">
    </div>
    <div class="crossoverpoint d-flex align-items-center text-white">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-circle" style="font-size:8px;margin-right:5px;"></i>
            <span>Know Christ</span>
        </div>
        <div class="d-flex align-items-center" style="margin-left:15px;margin-right:15px;">
            <i class="fa-solid fa-circle" style="font-size:8px;margin-right:5px;"></i>
            <span>Make Christ Known</span>
        </div>
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-circle" style="font-size:8px;margin-right:5px;"></i>
            <span>Known By Christ</span>
        </div>
    </div>
</div>
<style>
    .crossoverpoint, .initial-loader-logo{
        animation: glow 5s;
    }

    @keyframes glow{
        0% {
            opacity: 0;
        }

        100%{
            opacity: 1;
        }
    }
</style>
    <?php
    if(count($events) > 0){
    ?>
    <div class="d-flex justify-content-center mb-5">
        <a href="<?php echo url("events/upcoming")?>" style="color:black;text-decoration:none;"><?php echo $channel == "ENG" ? "View more" : "查看更多"?></a>
    </div>
    <?php
    }
    ?>
<script>
    var error = "<?php echo session()->get('error')?>";
    let para_opt = {
        root: document.getElementById("#paragraph_div"),
        rootMargin: "0px",
        threshold: 0,
    };
    let sermon_opt = {
        root: document.getElementById("#sermon_container"),
        rootMargin: "0px",
        threshold: 0,
    };
    let event_opt = {
        root: document.getElementById("#event_container"),
        rootMargin: "0px",
        threshold: 0,
    };

    var paragraph_observer = new IntersectionObserver(show_paragraph, para_opt);
    var sermon_observer = new IntersectionObserver(show_sermon, sermon_opt);
    var event_observer = new IntersectionObserver(show_event, event_opt);

    $(document).ready(() => {
        const session = window.sessionStorage.getItem("session");
        if(session){
            $(".initial-loader").addClass("d-none");
            $(".paragraph-section").removeClass("d-none");
            $(".sermon-section").removeClass("d-none");
            $(".event-section").removeClass("d-none");
        }else{
            $("body, html").css("overflow-y", "hidden");
            setTimeout(() => {
                $("body, html").css("overflow-y", "auto");
                $(".initial-loader").css("top", "-150%");
                $(".paragraph-section").removeClass("d-none");
                $(".sermon-section").removeClass("d-none");
                $(".event-section").removeClass("d-none");
                // sessionStorage.setItem("session", true);
            }, 3000);
        }

        if(error != ""){
            warning_response(error)
        }
        var p = $("#paragraph").text();
        var p_array = p.split("\n");
        for(var i=0;i<p_array.length;i++){
            if(i == 0){
                var el = "<h3 class='paragraph text-uppercase' style='opacity:0.2;line-height:200px;transition:.5s ease-out;'>" + p_array[i] + "</h3>" + "\n";
            }else{
                var el = "<span class='paragraph' style='opacity:0.2;line-height:200px;transition:.5s ease-out;'>" + p_array[i] + "</span>" + "\n";
            }
            $("#paragraph_div").append(el);
        }
        
        var p_span = $(".paragraph");
        if(p_span.length > 0){
            for(var i=0;i<p_span.length;i++){
                paragraph_observer.observe(p_span[i]);
            }
        }

        var sermon = $("#sermon_container").children();
        if(sermon.length > 0){
            for(var i=0;i<sermon.length;i++){
                sermon_observer.observe(sermon[i]);
            }
        }

        var event = $("#event_container").children();
        if(event.length > 0){
            for(var i=0;i<event.length;i++){
                event_observer.observe(event[i]);
            }
        }
    })

    function show_paragraph(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    $(entries[i].target).css("opacity", "1");
                    $(entries[i].target).css("line-height", "25px");
                }
            }
        }
    }

    function show_sermon(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    if(entries[i].target.id == "sermon_div"){
                        var child = $(entries[i].target).children();
                        for(var j=0;j<child.length;j++){
                            if(child[j].id == "sermon_sub_div"){
                                var sub_div = $(child[j]).children();
                                for(var k=0;k<sub_div.length;k++){
                                    $(sub_div[k]).css("opacity", "1");
                                    $(sub_div[k]).css("transform", "translateY(0%)");
                                }
                            }else{
                                $(child[j]).css("opacity", "1");
                                $(child[j]).css("transform", "translateY(0%)");
                            }
                        }
                    }else{
                       $(entries[i].target).css("opacity", "1");
                       $(entries[i].target).css("transform", "translateY(0%)");
                    }
                }
            }
        }
    }

    function show_event(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    if(entries[i].target.id == "event_div"){
                        var children = $(entries[i].target).children();
                        for(var j=0;j<children.length;j++){
                            if(children[j].id == "event_main_div"){
                                $(children[j]).css("opacity", "1");
                                $(children[j]).css("transform", "translateY(0%)");
                            }else if(children[j].id == "event_subdiv"){
                                var child = $(children[j]).children();
                                for(var k=0;k<child.length;k++){
                                    $(child[k]).css("opacity", "1");
                                    $(child[k]).css("transform", "translateY(0%)");
                                }
                            }
                        }
                    }else{
                        $(entries[i].target).css("opacity", "1");
                        $(entries[i].target).css("transform", "translateY(0%)");
                    }
                }
            }
        }
    }
</script>
@include("include/footer")