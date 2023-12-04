@include("include/header")
<section class="paragraph-section d-none">
    <div class="container mt-5 mb-5" style="text-align:center;white-space:pre-line;" id="paragraph_div">
        <p id="paragraph" style="display:none;">
        What is Lorem Ipsum?
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
        It has survived not only five centuries, but also the leap into electronic typesetting, 
        remaining essentially unchanged. It was popularised in the 1960s with the release-out of Letraset sheets containing Lorem Ipsum passages, 
        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

        Why do we use it?
        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
        The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, 
        as opposed to using 'Content here, content here', making it look like readable English. 
        Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, 
        and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, 
        sometimes by accident, sometimes on purpose (injected humour and the like).
        </p>
    </div>
</section>
<hr class="container">
<section class="sermon-section d-none" style="padding: 75px 0;">
    <div class="container" id="sermon_container">
        <h3 class="text-center text-uppercase" style="opacity:.2;transform:translateY(-100%);transition:.5s ease;">Upcoming Sermons</h3>
        <?php
            if(count($sermons) == 0){
                ?>
                <div class="mt-5 text-center" style="opacity:.2;transform:translateY(-100%);transition:.5s ease;">Stay tuned for more upcoming sermons.</div>
                <?php
            }else{
                $main_sermon = $sermons[0];
                $main_sermon_image = isset($main_sermon["image"]) ? IMAGE_PATH . "sermon/" . $main_sermon["image"] : url("assets/img/banner.png");
                array_splice($sermons, 0, 1);
                ?>
                    <div class="row mb-2 mt-5" id="sermon_div">
                        <div class="col-12 col-lg-9" style="opacity:.2;transition:.5s ease;transform:translateY(100%);">
                            <div class="img d-flex justify-content-center" style="position:relative;">
                                <a href="<?php echo url("sermons/" . $main_sermon["encrypted_id"])?>"><img src="<?php echo $main_sermon_image?>"></a>
                            </div>
                            <div class="text-center">
                                <span><?php echo date("d F Y", strtotime($main_sermon["date"]))?></span> . <span><?php echo date("h:i A")?></span>
                                <h6><?php echo $main_sermon["title"]?></h6>
                                <p><?php echo $main_sermon["description"]?></p>
                            </div>
                        </div>    
                        <div class="col-12 col-lg-3 mb-3" id="sermon_sub_div">
                                <?php
                                if(count($sermons) > 0){
                                    foreach($sermons as $key=>$row){
                                        $image = isset($row["image"]) ? IMAGE_PATH . "sermon/" . $row["image"] : url("assets/img/banner.png");
                                    ?>
                                    <div class="row mb-3" style="opacity:.2;transition:.5s ease;transform:translateY(100%);">
                                        <a href="<?php echo url("sermons/" . $row["encrypted_id"])?>">
                                            <img src="<?php echo $image?>" alt="">
                                        </a>
                                        <div class="d-flex flex-column" style="text-align: center">
                                            <a style="color:black;"><?php echo date("jS F Y", strtotime($row["date"]))?></a>
                                            <a style="color:black;"><?php echo $row["title"]?></a>
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
    <?php
    if(count($sermons) > 0){
        ?>
        <div class="d-flex justify-content-center">
            <a href="<?php echo url("sermons/upcoming")?>" style="color:black;text-decoration:none;">View more</a>
        </div>
        <?php
    }
    ?>
<hr class="container">
<section class="event-section d-none" style="padding: 75px 0;">
    <div class="container" id="event_container">
        <h3 class="text-center text-uppercase" 
        style="opacity:.2;transform:translateY(100%);transition:.5s ease;">Upcoming Events</h3>
        <?php
        if(count($events) == 0){
            ?>
            <div class="mt-5 text-center" 
            style="opacity:.2;transform:translateY(100%);transition:.5s ease;">Stay tuned for more upcoming events.</div>
            <?php
        }else{
            $main_event = $events[0];
            array_splice($events, 0, 1);
            $main_event_image = isset($main_event["image"]) ? $main_event["image"] : "banner.png";
            ?>
            <div class="row mt-5" id="event_div">
                <div class="col-12 col-lg-9" id="event_main_div" style="opacity:.2;transform:translateY(100%);transition:.5s ease;">
                    <div class="img">
                        <a href="<?php echo url("events/" . $main_event["encrypted_id"])?>"><img src="<?php echo IMAGE_PATH . "event_img/" . $main_event_image?>" alt=""></a>
                    </div>
                    <div class="text-center">
                        <div class="content padding-5-half-rem-all lg-padding-4-half-rem-all xs-padding-20px-lr xs-padding-40px-tb position-relative mx-auto w-90 lg-w-100">
                            <span><?php echo date("d F Y", strtotime($main_event["start_date"]))?></span> . <span><?php echo date("h:i A", strtotime($main_event["start_date"]))?></span>
                            <h6><?php echo $main_event["name"]?></h6>
                            <p><?php echo $main_event["description"]?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3" id="event_subdiv">
                    <?php
                        if(count($events) > 0){
                            foreach($events as $row){
                                $image = isset($row["image"]) ? $row["image"] : "banner.png";
                        ?>
                    <div class="row" style="opacity:.2;transform:translateY(100%);transition:.5s ease;">
                        <a href="<?php echo url("events/" . $row["encrypted_id"])?>">
                            <img class="img-fluid" src="<?php echo IMAGE_PATH . "event_img/" . $image?>" alt="">
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
<div class="test d-flex flex-column justify-content-center align-items-center" style="transition:1s ease;background-color:black;height:100vh;width:100vw;position:absolute;top:0;left:0">
    <h3 class="crossoverpoint text-white" style="text-shadow: white 0px 0px 20px, white 0px 0px 20px">CROSSOVER POINT</h3>
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
    .crossoverpoint{
        animation: glow 3s;
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
        <a href="<?php echo url("events/upcoming")?>" style="color:black;text-decoration:none;">View more</a>
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
            $(".test").addClass("d-none");
            $(".paragraph-section").removeClass("d-none");
            $(".sermon-section").removeClass("d-none");
            $(".event-section").removeClass("d-none");
        }else{
            setTimeout(() => {
                $(".test").css("top", "-150%");
                $(".paragraph-section").removeClass("d-none");
                $(".sermon-section").removeClass("d-none");
                $(".event-section").removeClass("d-none");
                sessionStorage.setItem("session", true);
            }, 3000);
        }

        if(error != ""){
            warning_response(error)
        }
        var p = $("#paragraph").text();
        var p_array = p.split("\n");
        for(var i=0;i<p_array.length;i++){
            var span = "<span class='paragraph' style='opacity:0.2;line-height:200px;transition:.5s ease-out;'>" + p_array[i] + "</span>" + "\n";
            $("#paragraph_div").append(span);
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