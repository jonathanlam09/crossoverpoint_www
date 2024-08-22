@include('include/header')
<style>
    @media screen and (max-width: 767px){
        .text-desc{
            margin-top: 1rem;
        }
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3><?php echo $channel == 'ENG' ? 'EVENTS' : '活动'?></h3>
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
    <div class="mt-3" style="display:flex; justify-content: space-between;">
        <div style="display:flex;">
            <select class="form-control" name="count" id="count" style="border-radius:3vh;text-align:center;">
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
    </div>
    <input type="text" value="event" id="type" hidden>
</div>
@include('include/footer')
<script>
    var channel = '<?php echo $channel?>';
    let opt = {
        root: document.getElementById('#event_row'),
        rootMargin: '0px',
        threshold: 0,
    };
    var observer = new IntersectionObserver(show_items, opt);
    $(document).ready(() => {
        const params = {
            types: ['upcoming', 'past'],
            default: 'upcoming'
        };
        dt_setup(params);
    })

   function get_events(isFirstLoad){
        const query = new URLSearchParams(window.location.search);
        const page = query.get('page');
        const length = query.get('length');
        const search = query.get('search');
        const type = query.get('type');

        axios.get(`${address}api/events?page=${page}&length=${length}&type=${type}${search ? '&search=' + search : ''}`)
        .then((response) => {
            if(response.data.status){
                $('#event_row').empty()
                var total = response.data.data.total;
                var events = response.data.data.data;

                if(isFirstLoad){
                    $('.pagination').empty()
                    setup(total)
                }

                if(events.length > 0){
                    for(var i=0;i<events.length;i++){
                        var image = `<div class="col-md-3 col-12 d-flex justify-content-center">
                                        <a href="${address}events/${events[i].event_id}">
                                            <img style="max-height:150px;" src="${portal_address}assets/img/event/${events[i].image}"/>
                                        </a>
                                    </div>`;
                        var title = `<h5>
                                        <a style="color:black;text-decoration:none;" href="${address}events/${events[i].event_id}">
                                        ${events[i].name}
                                        </a>
                                    </h5>`;
                        var desc = `<div class="mt-1"><span>${events[i].description}</span></div>`;
                        var date = `<div class="mt-1"><span>${events[i].start_date}</span></div>`;
                        var text = `<div class="col-md-9 col-12 text-desc">${title}${desc}${date}</div>`;
                        if(i == 0){
                            var row = `<div class="event-rows" style="opacity:.2;transform:translateY(50%);transition:.5s ease;"><hr><div class="row">${image}${text}</div><hr></div>`;
                        }else{
                            var row = `<div class="event-rows" style="opacity:.2;transform:translateY(50%);transition:.5s ease;"><div class="row">${image}${text}</div><hr></div>`;
                        }
                        $('#event_row').append(row);
                    }
                }else{
                    var row = `<div class="col-12">${(channel == 'ENG' ? 'No events.' : '没有活动。')}</div>`;
                    $('#event_row').append(row);
                }
            }else{
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            warning_response(err);
        })
        
        setTimeout(() => {
            var rows = $('.event-rows');
            for(var i=0; i<rows.length;i++){
                observer.observe(rows[i]);
            }
        }, 500);
    }

    function show_items(entries){
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
