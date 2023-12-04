@include("include/header")
<?php
    $title = isset($sermon->title) ? $sermon->title : "-";
    $description = isset($sermon->description) ? $sermon->description : "-";
    $date = date("jS F Y", strtotime($sermon->date));
    $image = isset($sermon->image) ? IMAGE_PATH . "assets/img/sermon/" . $sermon->image : url("assets/img/banner.png");
?>
<style>
    @media screen and (max-width: 766px){
        .broadcast-div{
            height: 300px!important;
        }
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>SERMON</h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5" style="max-width: 800px;">
            <img src="<?php echo $image;?>" alt="">
        </div>
    </div>
    
    <div class="row d-flex justify-content-center mt-3">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;">Title</span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $title?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;">Description</span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $description?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;">Date</span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $date?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;">Speaker</span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php
                        if($sermon->is_guest == 1){
                            echo $sermon->speaker_name ? $sermon->speaker_name : "-";
                        }else{
                            echo $sermon->speaker ? $sermon->speaker : "-";
                        }
                    ?></span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <div class="broadcast-div" style="width:800px;height:500px;">
            <?php
                if(isset($sermon->broadcast_live)){
                    ?>
                        <iframe src="https://www.facebook.com/plugins/video.php?href=<?php echo urlencode($sermon->broadcast_live)?>" 
                            frameborder="0" 
                            style="width:100%;height:100%;"
                            allow="fullscreen"></iframe>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
@include("include/footer")
<script>
    $(document).ready(() => {
    })
</script>
