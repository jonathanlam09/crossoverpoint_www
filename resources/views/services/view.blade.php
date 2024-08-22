@include('include/header')
<?php
    $title = isset($service->title) ? $service->title : '-';
    $description = isset($service->description) ? $service->description : '-';
    $date = date('jS F Y', strtotime($service->date)) . ' 10:00:00 AM';
    $image = isset($service->image) ? IMAGE_PATH . 'service/' . $service->image : url('assets/img/banner.png');
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
        <h3><?php echo $channel == 'ENG' ? 'serviceS' : '讲道'?></h3>
    </div>
</div>
<div class="container service-container mt-5 mb-5">
    <div class="row d-flex justify-content-center" style="transition:1s ease;opacity:.2;transform:translateY(50%);">
        <div class="col-12 mt-5" style="max-width:800px;">
            <img src="<?php echo $image;?>" alt="">
        </div>
    </div>
    
    <div class="row d-flex justify-content-center mt-3" style="transition:1s ease;opacity:.2;transform:translateY(50%);">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Title' : '标题'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $title?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transition:1s ease;opacity:.2;transform:translateY(50%);">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Description' : '描述'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $description?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transition:1s ease;opacity:.2;transform:translateY(50%);">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Date' : '日期'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $date?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transition:1s ease;opacity:.2;transform:translateY(50%);">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Speaker' : '讲员'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php
                        if($service->is_guest == 1){
                            echo $service->speaker_name ? $service->speaker_name . ($channel ? ' (Guest)' : ' (宾)') : '-';
                        }else{
                            echo $service->speaker ? $service->speaker->getFullname() : '-';
                        }
                    ?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transition:1s ease;opacity:.2;transform:translateY(50%);">
        <div class="row" style="max-width: 800px;">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Broadcast link' : '广播网址'?></span>
            </div>
            <div class="col-md-6 col-12">
                <?php
                    if(isset($service->broadcast_live)){
                        ?>
                        <a href="<?php echo $service->broadcast_live?>" target="_blank"><?php echo $service->broadcast_live?></a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-5">
        <a onclick="history.back()" class="btn btn-secondary">BACK</a>
    </div>
</div>
@include('include/footer')
<script>
    const opt = {
        root: $('.service-container').get(0),
        rootMargin: '0px',
        threshold: 0,
    };
    var observer = new IntersectionObserver(show_service, opt);
    $(document).ready(() => {
        var service = $('.service-container').children();
        if(service.length > 0){
            for(var i=0;i<service.length;i++){
                observer.observe(service[i]);
            }
        }
    })

    function show_service(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    $(entries[i].target).css('opacity', '1');
                    $(entries[i].target).css('transform', 'translateY(0)');
                }
            }
        }
    }
</script>
