@include("include/header")
<style>
    .media-row * {
        transition-duration: .5s;
    }

    .topic-media {
        cursor: pointer;
    }

    .topic-media:hover {
        transform: scale(1.1) translateY(-15%);
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3><?php echo $channel == "ENG" ? "GALLERY" : "讲道"?></h3>
    </div>
</div>
<div class="container p-5">
    <section id="gallery_container">
        <h3><?php echo $topic->name ?></h3>
        <?php
            if(isset($topic->media) && count($topic->media) > 0) {
                $currDate = null;
                ?>
                <div class="media-row row">
                    <?php
                        foreach($topic->media as $key=>$row) {
                            $date = date("F Y", strtotime($row->date));
                            if($date != $currDate) {
                                $currDate = $date;
                                ?>
                                <h4 class="mt-5" style="opacity:.2;transform:translateY(50%);"><?php echo $date?></h4>
                                <?php
                            }
                            ?>
                            <div class="col-lg-2 col-md-3 col-sm-6 col-12 d-flex justify-content-center align-items-center"
                            style="opacity:.2;transform:translateY(50%);">
                                <div class="image-container m-2">
                                    <img class="topic-media" src="<?php echo ADMIN_PORTAL . $row->path?>" class="w-100 h-100" onclick="show_image(`<?php echo $row->path?>`)"/>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                </div>
                <?php
            } else {
                ?>
                <p class="mt-5 text-center">No gallery at the moment.</p>
                <?php
            }
            ?>
    </section>
</div>
<div class="expand-image-div d-flex d-none align-items-center justify-content-center position-fixed top-0 left-0" style="background-color:rgba(0,0,0,0.8);width:100vw;height:100vh;">
    <div class="position-fixed" style="top:0;right:0;cursor:pointer;" onclick="close_image()">
        <i class="fas fa-times text-white" style="font-size: 24px;"></i>
    </div>
    <img id="display_image" class="img-fluid p-5" style="object-fit:contain;width:100%;height:100%;">
</div>
<script>
    let gallery_opt = {
        root: document.getElementById("#gallery_container"),
        rootMargin: "0px",
        threshold: 0,
    };

    var gallery_observer = new IntersectionObserver(show_gallery, gallery_opt);

    function show_gallery(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    (function(i) {
                        var timeToStartNote = (i*50);
                        setTimeout(function() {
                            $(entries[i].target).css("opacity", "1");
                            $(entries[i].target).css("transform", "translateY(0%)");
                        }, timeToStartNote);
                    })(i);
                }
            }
        }
    }

    $(document).ready(() => {
        const el = document.querySelector(".banner");
        $("html, body").animate({
            scrollTop: $(".banner").offset().top
        }, 500);

        var gallery = $(".media-row").children();
        if(gallery.length > 0){
            for(var i=0;i<gallery.length;i++){
                gallery_observer.observe(gallery[i]);
            }
        }
    })

    function show_image (path) {
        $(".expand-image-div").removeClass("d-none");
        $("#display_image").attr("src", "http://localhost:8000/" + path);
    }

    function close_image(){
        $(".expand-image-div").addClass("d-none");
        $("#display_image").attr("src", "");
    }
</script>
@include("include/footer")