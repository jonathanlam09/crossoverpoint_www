@include('include/header')
<?php
    $channel = session()->get('channel');
    if(!isset($channel)){
        $channel = 'ENG';
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
    <div class="container p-5" id="service">
        <h3><?php echo $channel == 'ENG' ? 'SERVICES' : '讲道'?></h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="mt-3 d-flex">
        <div>
            <select class="form-control" name="dt_type" id="dt_type" style="border-radius:3vh;text-align:center;">
                <option value="upcoming" selected>Upcoming</option>
                <option value="past" selected>Past</option>
            </select>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-between">
        <div style="display:flex;">
            <select class="form-control" name="dt_length" id="dt_length" style="border-radius:3vh;text-align:center;">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div style="position:relative;">
            <input id="dt_search" class="form-control" type="text" placeholder="Search here" style="border-radius:3vh;padding-left:30px;">
            <i class="fas fa-search" style="position:absolute;top:50%;transform:translateY(-50%);left:10px;color:grey;"></i>
        </div>
    </div>
    <div class="mt-5 mb-5" id="service_row">
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagination"></div>
    </div>
    <input type="text" value="service" id="type" hidden>
</div>
@include('include/footer')
<script>
    var channel = '<?php echo $channel?>';
    let opt = {
        root: document.getElementById('#service_row'),
        rootMargin: '0px',
        threshold: 0,
    };
    var observer = new IntersectionObserver(show_services, opt);

    $(document).ready(() => {
        const params = {
            types: ['upcoming', 'past'],
            default: 'upcoming'
        };
        dt_setup(params);
    })

    function get_services(isFirstLoad = false){
        const query = new URLSearchParams(window.location.search);
        const page = query.get('page');
        const length = query.get('length');
        const search = query.get('search');
        const type = query.get('type');

        axios.get(`${address}api/services?page=${page}&length=${length}&type=${type}${search ? '&search=' + search : ''}`)
        .then((response) => {
            if(response.data.status){
                $('#service_row').empty();
                var services = response.data.data.services;
                var total = response.data.data.total;
                if(isFirstLoad){
                    $('.pagination').empty();
                    setup(total);
                }

                if(services.length > 0){
                    for(var i=0;i<services.length;i++){
                        if(services[i].image == null){
                            var image =  `<div class="col-md-3 col-12 d-flex justify-content-center">
                                            <a href="${address}services/${services[i].service_id}">
                                                <img style="max-height:150px;" src="${address}assets/img/banner.png"/>
                                            </a>
                                        </div>`;
                        }else{
                            var image = `<div class="col-md-3 col-12 d-flex justify-content-center">
                                            <a href="${address}services/${services[i].service_id}">
                                                <img style="max-height:150px;" src="${portal_address}assets/img/service/${services[i].image}"/>
                                            </a>
                                        </div>`;
                        }
                        var title = `<h5>
                                        <a style="color:black;text-decoration:none;cursor:pointer;" href="${address}services/${services[i].service_id}">${(channel == 'ENG' ? services[i].title : services[i].ch_title)}
                                        </a>
                                    </h5>`;
                        var desc = `<h6>${((channel == 'ENG' ? services[i].description : services[i].ch_description) || '-')}</h6>`;
                        var date = `<div><h6>${services[i].date}</h6></div>`;
                        var text = `<div class="title-desc">${title}${desc}</div>`;
                        var div = `<div class="d-flex flex-column justify-content-between col-md-9 col-12">${text}${date}</div>`;
                        if(i == 0){
                            var row = `<div class="service-rows" style="opacity:.2;transform:translateY(50%);transition:.5s ease;">
                                        <hr>
                                        <div class="row">
                                            ${image}
                                            ${div}
                                        </div>
                                        <hr>
                                    </div>`;
                        }else{
                            var row = `<div class="service-rows" style="opacity:.2;transform:translateY(50%);transition:.5s ease;">
                                        <div class="row p-2">
                                            ${image}
                                            ${div}
                                        </div>
                                        <hr>
                                    </div>`;
                        }
                        $('#service_row').append(row);
                    }
                }else{
                    if($('#period').val() == 'past'){
                        var div = `<div class="col-12">${(channel == 'ENG' ? 'No past services.' : '没有过去的讲道。')}</div>`;
                    }else{
                        var div = `<div class="col-12">${(channel == 'ENG' ? 'No upcoming services.' : '没有即将举行的讲道。')}</div>`;
                    }
                    $('#service_row').append(div);
                }
            }else{
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            warning_response(err);
        })

        setTimeout(() => {
            var rows = $('.service-rows');
            for(var i=0; i<rows.length;i++){
                observer.observe(rows[i]);
            }
        }, 500);
    }

    function show_services(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    $(entries[i].target).css('opacity', '1');
                    $(entries[i].target).css('transform', 'translateY(0%)');
                }
            }
        }
    }
</script>
