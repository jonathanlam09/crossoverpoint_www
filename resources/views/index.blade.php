@include('include/header')
<style>
    ::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 5px;
        background-color: rgba(0,0,0,.2);
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 4px;
        background-color: white;
        /* background-color: rgba(0, 0, 0, .5); */
        box-shadow: 0 0 1px rgba(255, 255, 255, .5);
    }
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
<script>
    function toggleMute(e) {
        e.currentTarget.muted = !e.currentTarget.muted;
    }
</script>
<section class="paragraph-section d-none">
    <div class="container mt-5 mb-5" style="text-align:center;white-space:pre-line;" id="paragraph_div">
        @if ($channel === 'ENG')
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
        @else 
            <p id="paragraph" style="display:none;">信仰信条
                我认识独一的真神。我认识神所差来的耶稣基督。
                我得着永生 (17:3)。
                我口里认耶稣为主。我心里信 神叫祂从死里复活 (罗马 10:9)。
                我要认识基督 (腓 3:10)。
                我要传扬基督 (歌 1:28)。
                基督再来时，祂认识我，因我属于祂 (约 10: 14)，且遵行祂的旨意 (约6:40)。
            </p>
        @endif
    </div>
</section>
<hr class="container">
<section class="service-section d-none" style="padding: 75px 0;">
    <div class="container" id="service_container">
        <h3 class="text-center text-uppercase" style="opacity:.2;transform:translateY(-100%);transition:.5s ease;">
            {{ $channel == 'ENG' ? 'Upcoming services' : '来临的道' }}
        </h3>
        @if(!$service)
            <div class="mt-5 text-center" style="opacity:.2;transform:translateY(-100%);transition:.5s ease;">
                {{ $channel == "ENG" ? "Stay tuned for more upcoming services." : "请继续关注即将到来的更多讲道。" }}
            </div>
        @else
            @php
                $main_service_image = isset($service->image) ? IMAGE_PATH . 'service/' . $service->image : url('assets/img/banner.png');
            @endphp
        
            <div class="row mb-2 mt-5" id="service_div">
                <div class="col-12" style="opacity:.2;transition:.5s ease;transform:translateY(10%);">
                    <div class="img d-flex justify-content-center" style="position:relative;">
                        <a href="{{ url('services/' . $service->encrypted_id) }}">
                            <img src="{{ $main_service_image }}" style="max-width:800px;width:100%;">
                        </a>
                    </div>
                    <div class="text-center">
                        <h6 class="mt-3 mb-3">{{ date("jS F Y 10:00:00 A", strtotime($service->date)) }}</h6>
                        <h6 class="mb-3">{{ $channel == "ENG" ? $service->title : $service->ch_title }}</h6>
                        <p>{{ $channel == "ENG" ? $service->description : $service->ch_description }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<div class="d-flex justify-content-center">
    <a href="{{ url("services/upcoming") }}" style="color:black;text-decoration:none;">
        {{ $channel == 'ENG' ? 'View more' : '查看更多' }}
    </a>
</div>
<hr class="container">
<section class="event-section d-none" style="padding: 75px 0;">
    <div class="container" id="event_container">
        <h3 
        class="text-center text-uppercase" 
        style="opacity:.2;transform:translateY(10%);transition:.5s ease;">
            {{ $channel == 'ENG' ? 'Upcoming Events' : '来临的活动' }}
        </h3>
        @if(count($events) == 0)
            <div class="mt-5 text-center" style="opacity:.2;transform:translateY(10%);transition:.5s ease;">
                {{ $channel == "ENG" ? "Stay tuned for more upcoming events." : "请继续关注更多即将举行的活动。" }}
            </div>
        @else
            @php
                $totalEventCount = count($events);
                $mainEvent = $events[0];
                $remainingEvents = array_slice($events, 1);
                $mainEventImage = isset($mainEvent['image']) ? asset('images/event/' . $mainEvent['image']) : asset('assets/img/banner.png');
            @endphp

            <div class="row mt-5" id="event_div">
                <div class="col-12 {{ ($totalEventCount > 1) ? 'col-lg-9' : '' }}" id="event_main_div" style="opacity:.2;transform:translateY(10%);transition:.5s ease;">
                    <div class="img">
                        <a class="{{ ($totalEventCount == 1) ? 'd-flex justify-content-center' : 'test' }}" href="{{ url('events/' . $mainEvent['encrypted_id']) }}">
                            <img src="{{ $mainEventImage }}" style="max-width:800px;width:100%;">
                        </a>
                    </div>
                    <div class="text-center">
                        <div>
                            <span>{{ date('jS F Y', strtotime($mainEvent['start_date'])) }}</span> . <span>{{ date('h:i A', strtotime($mainEvent['start_date'])) }}</span>
                            <h6>{{ $channel == "ENG" ? $mainEvent['name'] : $mainEvent['ch_name'] }}</h6>
                            <p>{{ $channel == "ENG" ? $mainEvent['description'] : $mainEvent['ch_description'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 {{ ($totalEventCount > 1) ? 'col-lg-3' : 'd-none' }}" id="event_subdiv">
                    @if(count($remainingEvents) > 0)
                        @foreach($remainingEvents as $row)
                            @php
                                $image = isset($row['image']) ? ADMIN_PORTAL . 'assets/img/event/' . $row['image'] : asset('assets/img/banner.png');
                            @endphp
                            <div class="row" style="opacity:.2;transform:translateY(10%);transition:.5s ease;">
                                <a href="{{ url('events/' . $row['encrypted_id']) }}">
                                    <img class="img-fluid" src="{{ $image }}">
                                </a>
                                <div class="d-flex flex-column align-items-center">
                                    <a style="color:black;">{{ date('jS F Y', strtotime($row['start_date'])) }}</a>
                                    <a style="color:black;">{{ $row['name'] }}</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>
@if (count($events) > 0)
<div class="d-flex justify-content-center mb-5">
    <a href="<?php echo url("events/upcoming")?>" style="color:black;text-decoration:none;">{{ $channel == 'ENG' ? 'View more' : '查看更多' }}</a>
</div>
@endif
<hr class="container">
<?php
    if(isset($topics)) {
        ?>
        <section class="more-section d-none" style="padding: 75px 0;">
            <div class="container" id="more_container">
                <h3 class="text-center text-uppercase" 
                style="opacity:.2;transform:translateY(10%);transition:.5s ease;"><?php echo $channel == "ENG" ? "More about us" : "关于我们更多"?></h3>
                <div class="memory-row row mt-5 pt-5">
                    <?php
                        if(count($topics) > 0) {
                            foreach ($topics as $key => $row) {
                                ?>
                                <div class="col-md-3 col-sm-6 col-12 p-0" style="opacity:.2;transform:translateY(10%);transition:.5s ease;">
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
<div class="initial-loader d-flex flex-column justify-content-center align-items-center" style="transition:1s ease;background-color:black;height:100vh;width:100%;position:fixed;top:0;left:0;z-index:99;">
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
    let service_opt = {
        root: document.getElementById("#service_container"),
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
    var service_observer = new IntersectionObserver(show_service, service_opt);
    var event_observer = new IntersectionObserver(show_event, event_opt);
    var more_observer = new IntersectionObserver(show_more, more_opt);
    var highlight_observer = new IntersectionObserver(show_highlight, highlight_opt);

    $(document).ready(() => {
        const session = window.sessionStorage.getItem("session");
        if(session){
            $(".initial-loader").addClass("d-none");
            $(".paragraph-section").removeClass("d-none");
            $(".service-section").removeClass("d-none");
            $(".event-section").removeClass("d-none");
            $(".more-section").removeClass("d-none");
            $(".highlight-section").removeClass("d-none");
        }else{
            $("body, html").css("overflow-y", "hidden");
            setTimeout(() => {
                $("body, html").css("overflow-y", "auto");
                $(".initial-loader").css("top", "-150%");
                $(".paragraph-section").removeClass("d-none");
                $(".service-section").removeClass("d-none");
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

        var service = $("#service_container").children();
        if(service.length > 0){
            for(var i=0;i<service.length;i++){
                service_observer.observe(service[i]);
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

    function show_service(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    if(entries[i].target.id == "service_div"){
                        var child = $(entries[i].target).children();
                        for(var j=0;j<child.length;j++){
                            if(child[j].id == "service_sub_div"){
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