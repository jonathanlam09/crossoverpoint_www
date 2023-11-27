@include("include/header")

<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>TESTIMONY</h3>
    </div>
</div>
<div class="container mt-5 mb-5" id="testimony_div">
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_1" style="transform: translateX(-100%);transition-duration: 1.5s;">
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div>
        <div class="col-md-8 col-12">
            <p>is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_2" style="transform: translateX(100%);transition-duration: 1.5s;">
        <div class="col-md-8 col-12">
            <p>is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_3" style="transform: translateX(-100%);transition-duration: 1.5s;">
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div>
        <div class="col-md-8 col-12">
            <p>is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_4" style="transform: translateX(100%);transition-duration: 1.5s;">
        <div class="col-md-8 col-12"> 
            <p>is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div>
    </div>
</div>
<script>
    let options = {
        root: document.getElementById("#testimony_div"),
        rootMargin: "0px",
        threshold: 0,
    };

    var observer = new IntersectionObserver(show_item, options);

    $(document).ready(() => {
        var testimonies = document.getElementsByClassName("testimony-row");
        if(testimonies.length > 0){
            for(var i=0; i<testimonies.length;i++){
                observer.observe(testimonies[i]);
            }
        }
    })

    function show_item(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    $(entries[i].target).css("transform", "translateX(0%)")
                }
            }
        }
    }
</script>
@include("include/footer")
