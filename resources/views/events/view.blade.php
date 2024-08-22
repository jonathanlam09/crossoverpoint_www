@include('include/header')
<?php
    $name = isset($event->name) ? $event->name : '-';
    $description = isset($event->description) ? $event->description : '-';
    $start_date = date('jS F Y H:i:s A', strtotime($event->start_date));
    $end_date = date('jS F Y H:i:s A', strtotime($event->end_date));
    $fee = isset($event->fee) ? $event->fee : '0';
    if($fee == 0){
        $fee = 'FOC';
    }else {
        $fee = '$' . number_format($fee, 2);
    }
    $image = isset($event->image) ? IMAGE_PATH . 'event/' . $event->image : IMAGE_PATH . 'banner.png';
?>
<style>
    @media screen and (min-width:992px){
        .img-fluid{
            max-width: 800px;
        }
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3><?php echo $channel == 'ENG' ? 'EVENTS' : '活动'?></h3>
    </div>
</div>

<div class="container mt-5 mb-5" id="event_container">
    @if(Session::has("error"))
    <div class="row">
        <div class="col-12 mt-5 d-flex justify-content-center alert alert-danger">
            <div class="text-center" style="max-width: 800px;">
                {!! Session::get("error") !!}
            </div>
        </div>
    </div>
    @endif
    <div class="row" style="transform:translateY(50%);opacity:.2;transition:.5s ease;">
        <div class="col-12 mt-5 d-flex justify-content-center">
            <img class="img-fluid" src="<?php echo $image;?>">
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-5" style="transform:translateY(50%);opacity:.2;transition:1s ease;">
        <div class="row" style="width: 800px">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Name' : '名字'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $name;?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transform:translateY(50%);opacity:.2;transition:1s ease;">
        <div class="row" style="width: 800px">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Description' : '描写'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $description;?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transform:translateY(50%);opacity:.2;transition:1s ease;">
        <div class="row" style="width: 800px">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Start date' : '开始日期'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $start_date;?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transform:translateY(50%);opacity:.2;transition:1s ease;">
        <div class="row" style="width: 800px">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'End date' : '结束日期'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $end_date;?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transform:translateY(50%);opacity:.2;transition:1s ease;">
        <div class="row" style="width: 800px">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'PIC' : '负责人'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $event->pic ? $event->pic->getFullname() : '-';?></span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-3" style="transform:translateY(50%);opacity:.2;transition:1s ease;">
        <div class="row" style="width: 800px">
            <div class="col-md-6 col-12">
                <span style="font-weight:700;"><?php echo $channel == 'ENG' ? 'Fee' : '费用'?></span>
            </div>
            <div class="col-md-6 col-12">
                <span><?php echo $fee;?></span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-5">
        <a onclick="history.back()" class="btn btn-secondary">BACK</a>
        <?php
        if(time() >= strtotime($event->registration_open_date) && 
        time() <= strtotime($event->registration_close_date)){
            ?>
                <a class="btn" href="<?php echo url('events/sign-up/' . $event_id)?>" style="margin-left:5px;background-color:cornflowerblue;color:white;"><?php echo $channel == 'ENG' ? 'SIGN UP' : '报名'?></a>
            <?php
        }
    ?>
    </div>
</div>
@include('include/footer')
<script>
    const opt = {
        root: document.getElementById('#event_container'),
        rootMargin: '0px',
        threshold: 0,
    };
    var observer = new IntersectionObserver(show_event, opt);
    $(document).ready(() => {
        var event = $('#event_container').children();
        if(event.length > 0){
            for(var i=0;i<event.length;i++){
                observer.observe(event[i]);
            }
        }
    })

    function show_event(entries){
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
