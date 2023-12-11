@include("include/header")
<div class="container p-5">
    <h1><?php echo $channel == "ENG" ? "Woops!" : "哎呀!"?></h1>
    <h2><?php echo $channel == "ENG" ? "Page not found." : "找不到网页"?></h2>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5">
        <img src="<?php echo url("assets/img/error404.png")?>" style="width:800px;">
    </div>
</div>
@include("include/footer")