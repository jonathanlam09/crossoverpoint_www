@include("include/header")
<?php
    $channel = session()->get("channel");
    if(!isset($channel)){
        $channel = "ENG";
    }
?>
<style>
    @media screen and (max-width: 767px){
        .title-desc{
            margin-top: 1rem;
        }
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5" id="sermon">
        <h3><?php echo $channel == "ENG" ? "SERMONS" : "讲道"?></h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="mt-3" style="display:flex; justify-content: space-between;">
        <div style="display:flex;">
            <select class="form-control" name="count" id="count" style="border-radius:3vh;text-align:center;" onchange="get_sermons()">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div style="position:relative;">
            <input id="dt_search" class="form-control" type="text" placeholder="Search here" style="border-radius: 3vh;padding-left:30px;" onchange="get_sermons()">
            <i class="fa fa-search" style="position:absolute;top:50%;transform:translateY(-50%);left:10px;color:grey;"></i>
        </div>
    </div>
    <div class="mt-5 mb-5" id="sermon_row">
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagination"></div>
        <?php
        if($period == "upcoming"){
            ?>
            <a href="<?php echo url("sermons/past")?>" class="btn btn-primary"><?php echo $channel == "ENG" ? "Past sermons" : "过去的讲道"?></a>
            <?php
        }else{
            ?>
            <a href="<?php echo url("sermons/upcoming")?>" class="btn btn-primary"><?php echo $channel == "ENG" ? "Upcoming sermons" : "来临的讲道"?></a>
            <?php
        } 
        ?>
    </div>
    <input type="text" id="period" value="<?php echo $period?>" hidden>
    <input type="text" value="sermon" id="type" hidden>
</div>
@include("include/footer")
<script>
    var channel = "<?php echo $channel?>";

    let opt = {
        root: document.getElementById("#sermon_row"),
        rootMargin: "0px",
        threshold: 0,
    };
    var observer = new IntersectionObserver(show_sermons, opt);
    $(document).ready(() => {
        get_sermons();
    })

    function get_sermons(){
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

        axios.post(address + "api/sermons/get", formdata, apiHeader)
        .then((response) => {
            if(response.data.status){
                $("#sermon_row").empty();
                var sermons = response.data.data.sermons;
                var total = response.data.data.total;
                if(start == 1){
                    $(".pagination").empty();
                    setup(total);
                }
                if(sermons.length > 0){
                    for(var i=0;i<sermons.length;i++){
                        if(sermons[i].image == null){
                            var image =  "<div class='col-md-3 col-12 d-flex justify-content-center'><a href='" + address + "sermons/" + sermons[i].sermon_id + "'><img style='max-height:150px;' src='" + address + "assets/img/banner.png' /></a></div>";
                        }else{
                            var image = "<div class='col-md-3 col-12 d-flex justify-content-center'><a href='" + address + "sermons/" + sermons[i].sermon_id + "'><img style='max-height:150px;' src='" + portal_address + "assets/img/sermon/" + sermons[i].image + "'/></a></div>";
                        }
                        var title = "<h5><a style='color:black;text-decoration:none;cursor:pointer;' href='" + address + "sermons/" + sermons[i].sermon_id + "'>" + sermons[i].title + "</a></h5>";
                        var desc = "<h6>" + (sermons[i].description || "-") + "</h6>";
                        var date = "<div><h6>" + sermons[i].date + "</h6></div>";
                        var text = "<div class='title-desc'>" + title + desc + "</div>";
                        var div = "<div class='d-flex flex-column justify-content-between col-md-9 col-12'>" + text + date + "</div>";
                        if(i == 0){
                            var row = "<div class='sermon-rows' style='opacity:.2;transform:translateY(50%);transition:.5s ease;'><hr><div class='row'>" + image + div + "</div><hr></div>";
                        }else{
                            var row = "<div class='sermon-rows' style='opacity:.2;transform:translateY(50%);transition:.5s ease;'><div class='row p-2'>" + image + div + "</div><hr></div>";
                        }
                        $("#sermon_row").append(row);
                    }
                }else{
                    if($("#period").val() == "past"){
                        var div = "<div class='col-12'>" + (channel == "ENG" ? "No past sermons." : "没有过去的讲道。") + "</div>";
                    }else{
                        var div = "<div class='col-12'>" + (channel == "ENG" ? "No upcoming sermons." : "没有即将举行的讲道。") + "</div>";
                    }
                    $("#sermon_row").append(div);
                }
            }else{
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            warning_response(err);
        })

        setTimeout(() => {
            var rows = $(".sermon-rows");
            for(var i=0; i<rows.length;i++){
                observer.observe(rows[i]);
            }
        }, 500);
    }

    function show_sermons(entries){
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
