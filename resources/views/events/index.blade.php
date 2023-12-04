@include("include/header")
<style>
    @media screen and (max-width: 767px){
        .text-desc{
            margin-top: 1rem;
        }
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>EVENT</h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="mt-3" style="display:flex; justify-content: space-between;">
        <div style="display:flex;">
            <select class="form-control" name="count" id="count" style="border-radius:3vh;text-align:center;" onchange="get_events()">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div style="position:relative;">
            <input id="dt_search" class="form-control" type="text" placeholder="Search here" style="border-radius: 3vh;padding-left:30px;">
            <i class="fa fa-search" style="position:absolute;top:50%;transform:translateY(-50%);left:10px;color:grey;"></i>
        </div>
    </div>
    <div class="mt-5 mb-5" id="event_row">
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagination"></div>
        <?php
        if($period == "upcoming"){
            ?>
            <a href="<?php echo url("events/past")?>" class="btn btn-primary">Past events</a>
            <?php
        }else{
            ?>
            <a href="<?php echo url("events/upcoming")?>" class="btn btn-primary">Upcoming events</a>
            <?php
        }
        ?>
    </div>
    <input type="text" value="event" id="type" hidden>
    <input type="text" id="period" value="<?php echo $period?>" hidden>
</div>
@include("include/footer")
<script>
    let opt = {
        root: document.getElementById("#event_row"),
        rootMargin: "0px",
        threshold: 0,
    };
    var observer = new IntersectionObserver(show_items, opt);
    $(document).ready(() => {
        get_events()
   })

   function get_events(){
        var start = $(".active-page").text();
        if($(".active-page").length == 0){
            start = 1;
        }
        var length = $("#count").val();
        var search = $("#dt_search").val();
        var period = $("#period").val();

        var formdata = new FormData();
        formdata.append("start", (start * length) - length);
        formdata.append("length", length);
        formdata.append("search", search);
        formdata.append("period", period);

        axios.post(address + "api/event/get", formdata, apiHeader)
        .then((response) => {
            if(response.data.status){
                $("#event_row").empty()
                var total = response.data.data.total;
                var events = response.data.data.data;
                if(start == 1){
                    $(".pagination").empty()
                    setup(total)
                }
                if(events.length > 0){
                    for(var i=0;i<events.length;i++){
                        var image = "<div class='col-md-3 col-12 d-flex justify-content-center'><a href='" + address + "events/" + events[i].event_id + "'>" + 
                            "<img style='max-height:150px;' src='" + portal_address + "assets/img/event_img/" + events[i].image + "'/>" + 
                            "</a></div>";
                        var title = "<h5><a style='color:black;text-decoration:none;' href='" + address + "events/" + events[i].event_id + "'>" + events[i].name + "</a></h5>";
                        var desc = "<span>" + events[i].description + "</span>";
                        var text = "<div class='col-md-9 col-12 text-desc'>" + title + desc + "</div>";
                        if(i == 0){
                            var row = "<div class='event-rows' style='opacity:.2;transform:translateY(50%);transition: .5s ease;'><hr><div class='row'>" + image + text + "</div><hr></div>";
                        }else{
                            var row = "<div class='event-rows' style='opacity:.2;transform:translateY(50%);transition: .5s ease;'><div class='row'>" + image + text + "</div><hr></div>";
                        }
                        $("#event_row").append(row);
                    }
                }else{
                    var row = "<div class='col-12'>No events.</div>";
                    $("#event_row").append(row);
                }
            }else{
                warning_response(response.data.message)
            }
        })
        .catch((err) => {
            warning_response(err)
        })
        
        setTimeout(() => {
            var rows = $(".event-rows");
            for(var i=0; i<rows.length;i++){
                observer.observe(rows[i]);
            }
        }, 500);
    }

    function show_items(entries){
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
