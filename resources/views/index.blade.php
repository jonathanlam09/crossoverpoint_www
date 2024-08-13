@include("include/header")
<style>
    .highlight-dot.active{
        color: cornflowerblue!important;
    }

    .highlight-dot {
        color: lightgrey!important;
        cursor: pointer;
    }

    .announcement-section::-webkit-scrollbar {
        display: none;
    }

    .highlights-img::-webkit-scrollbar {
        display: none;
    }

    .media-container {
        max-height: 560px;
        aspect-ratio: 16/9;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        transition-duration: 1s;
    }

    @media screen and (max-width: 767px) {
        .announcements-banner {
            min-width: 150px;
            margin: 0 1rem;
        }
    }

    @media screen and (min-width: 768px) and (max-width: 991px) {
        .announcements-banner {
            min-width: 200px;
            margin: 0 3rem;
        }
    }

    @media screen and (min-width: 992px) {
        .announcements-banner {
            min-width: 250px;
            margin: 0 5rem
        }
    }
</style>
<?php
    if(isset($highlights)) {
        ?>
        <section class="highlight-section d-none">
            <div class="container mt-5 mb-5" style="text-align:center;white-space:pre-line;" id="highlight_container">
                <div class="row m-2">
                    <div class="col-12 d-flex align-items-start p-0" style="opacity:.2;transform:translateY(100%);transition:.5s ease;">
                        <div class="media-container d-flex align-items-center position-relative w-100 h-100">
                            {{-- <video autoplay muted 
                            id="highlight_vid" 
                            style="object-fit:contain;width:100%;height:100%;" 
                            onclick="toggleMute(event)"
                            onended="prompt()">
                                <source src="<?php echo url("assets/vid/familycamp.mp4")?>" type="video/mp4">
                                    Your browser does not support the video tag.
                            </video> --}}
                            <div class="d-flex position-absolute" style="bottom:0;left:50%;transform:translate(-50%, -10px)">
                                <?php
                                    if(count($highlights) > 0) {
                                        foreach ($highlights as $key=>$row) {
                                            if($key == 0) {
                                                ?>
                                                <i class="fas fa-circle p-1 highlight-dot" id="highlight_dot_<?php echo $key?>" onclick="reset_highlights(<?php echo $key?>)"></i>
                                                <?php
                                            } else {
                                                ?>
                                                <i class="fas fa-circle p-1 highlight-dot" id="highlight_dot_<?php echo $key?>" onclick="reset_highlights(<?php echo $key?>)"></i>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                    <style>
                        .announcement-section:hover .announcement-slider {
                            animation-play-state: paused;
                        }

                        .announcement-section {
                            white-space: nowrap;
                            overflow: scroll;
                            cursor: pointer;
                        }

                        .announcement-slider::-webkit-scrollbar {
                            display: none;
                        }

                        .announcement-slider {
                            display: inline-block;
                            width: max-content;
                            animation: 10s scroll linear infinite;
                        }

                        .announcement-slider img {
                            width: 200px;
                            padding: 0 30px;
                        }

                        @keyframes scroll {
                            0% {
                                transform: translateX(0);
                            }
                            100% {
                                transform: translateX(-100%);
                            }
                        }
                    </style>
                    <?php
                    if(count($events) > 0) {
                        ?>
                        <div class="col-12" style="opacity:.2;transform:translateY(100%);transition:.5s ease;">
                            <h6 class="text-success fw-bold text-uppercase" style="white-space: nowrap">
                                <i class="fas fa-bullhorn"></i>
                                <i class="fas fa-bullhorn"></i>
                                <i class="fas fa-bullhorn"></i>
                            </h6>
                            <a href="<?php echo url("/events/upcoming")?>">
                                <div class="announcement-section" >
                                    <div class="announcement-slider">
                                        <?php
                                            foreach ($events as $key=>$row) {
                                                ?>
                                                    <img src="<?php echo IMAGE_PATH . "event/" . $row["image"]?>">
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="announcement-slider">
                                        <?php
                                            foreach ($events as $key=>$row) {
                                                ?>
                                                    <img src="<?php echo IMAGE_PATH . "event/" . $row["image"]?>">
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>    
        </section>
        <?php
    }
?>

<hr class="container">
<script>
    function toggleMute(e) {
        e.currentTarget.muted = !e.currentTarget.muted;
    }

</script>
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
                            <img class="img-fluid" src="<?php echo IMAGE_PATH . "event/" . $image?>">
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
<hr class="container">
<?php
    if(isset($topics)) {
        ?>
        <section class="more-section d-none" style="padding: 75px 0;">
            <div class="container" id="more_container">
                <h3 class="text-center text-uppercase" 
                style="opacity:.2;transform:translateY(100%);transition:.5s ease;"><?php echo $channel == "ENG" ? "More about us" : "关于我们更多"?></h3>
                <div class="memory-row row mt-5 pt-5">
                    <?php
                        if(count($topics) > 0) {
                            foreach ($topics as $key => $row) {
                                ?>
                                <div class="col-md-3 col-sm-6 col-12 p-0" style="opacity:.2;transform:translateY(100%);transition:.5s ease;">
                                    <a class="text-decoration-none text-white" href="<?php echo url('gallery/' . $row->encrypted_id)?>">
                                        <div class="bg-dark memory-card text-white d-flex justify-content-center align-items-center" 
                                        style="background-image:url(<?php echo ADMIN_PORTAL . $row->path?>);">
                                            <h4><?php echo $row->name ?></h4>
                                        </div>
                                    </a>    
                                </div>
                                <?php
                            }
                        }
                        ?>
                </div>
            </div>
        </section>
        <?php
    }
?>
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
    const highlights = JSON.parse(`<?php echo $highlights?>`);
    var count_highlight = 0;
    var highlight_interval;
    var dportal_address = `<?php echo ADMIN_PORTAL?>`;

    $(document).ready(() => {
        const el = document.querySelector(".banner");
        initiate_highlights(count_highlight);
        highlight_interval = setInterval(() => {
            initiate_highlights(count_highlight)
        }, 
        5000);

        $("html, body").animate({
            scrollTop: $(".banner").offset().top
        }, 500);
    })
   
    
    function initiate_highlights (num) {
        count_highlight = num;
        $(".highlight-dot").removeClass("active");
        $("#highlight_dot_" + num).addClass("active");
        $(".media-container").css("background-image", `url(${dportal_address + highlights[num]?.path})`);
        if(count_highlight == highlights.length-1){
            count_highlight = 0;
        }else {
            count_highlight++;
        }
    }

    function reset_highlights (num) {
        count_highlight = num;
        clearInterval(highlight_interval);
        initiate_highlights(count_highlight);
        highlight_interval = setInterval(() => {
            initiate_highlights(count_highlight)
        }, 
        5000);
    }

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
    let more_opt = {
        root: document.getElementById("#more_container"),
        rootMargin: "0px",
        threshold: 0,
    };
    let highlight_opt = {
        root: document.getElementById("#highlight_container"),
        rootMargin: "0px",
        threshold: 0,
    };

    var paragraph_observer = new IntersectionObserver(show_paragraph, para_opt);
    var sermon_observer = new IntersectionObserver(show_sermon, sermon_opt);
    var event_observer = new IntersectionObserver(show_event, event_opt);
    var more_observer = new IntersectionObserver(show_more, more_opt);
    var highlight_observer = new IntersectionObserver(show_highlight, highlight_opt);

    $(document).ready(() => {
        const session = window.sessionStorage.getItem("session");
        if(session){
            $(".initial-loader").addClass("d-none");
            $(".paragraph-section").removeClass("d-none");
            $(".sermon-section").removeClass("d-none");
            $(".event-section").removeClass("d-none");
            $(".more-section").removeClass("d-none");
            $(".highlight-section").removeClass("d-none");
        }else{
            $("body, html").css("overflow-y", "hidden");
            setTimeout(() => {
                $("body, html").css("overflow-y", "auto");
                $(".initial-loader").css("top", "-150%");
                $(".paragraph-section").removeClass("d-none");
                $(".sermon-section").removeClass("d-none");
                $(".event-section").removeClass("d-none");
                $(".more-section").removeClass("d-none");
                $(".highlight-section").removeClass("d-none");
                sessionStorage.setItem("session", true);
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

        var more = $("#more_container").children();
        if(more.length > 0){
            for(var i=0;i<more.length;i++){
                more_observer.observe(more[i]);
            }
        }

        var highlight = $($("#highlight_container").children()[0]).children();
        if(highlight.length > 0){
            for(var i=0;i<highlight.length;i++){
                highlight_observer.observe(highlight[i]);
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

    function show_more(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    if($(entries[i].target).hasClass("memory-row")) {
                        const children = $(entries[i].target).children();
                        if(children.length > 0) {
                            for(var j=0;j<children.length;j++) {
                                (function(j) {
                                    var timeToStartNote = (j*100);
                                    setTimeout(function() {
                                        $(children[j]).css("opacity", "1");
                                        $(children[j]).css("transform", "translateY(0%)");
                                    }, timeToStartNote);
                                })(j);
                            }
                        }
                    } else {
                        $(entries[i].target).css("opacity", "1");
                        $(entries[i].target).css("transform", "translateY(0%)");
                    }
                }
            }
        }
    }

    function show_highlight (entries) {
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    $(entries[i].target).css("opacity", "1");
                    $(entries[i].target).css("transform", "translateY(0%)");
                }
            }
        }
    }
</script>
<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
@include("include/footer")