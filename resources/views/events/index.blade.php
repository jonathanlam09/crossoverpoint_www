@include('include/header')
<style>
    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .events-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .filters-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        /* color: #333; */
        /* background: white; */
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #999;
    }

    .search-wrapper {
        position: relative;
        min-width: 200px;
    }

    .search-wrapper input {
        padding-left: 2.5rem;
    }

    .search-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .event-item {
        padding: 2rem 0;
        border-bottom: 1px solid #f0f0f0;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .event-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .event-item:last-child {
        border-bottom: none;
    }

    .event-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .event-link:hover .event-title {
        color: #555;
    }

    .event-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 4px;
        flex-shrink: 0;
    }

    .event-content {
        flex: 1;
    }

    .event-title {
        font-weight: 400;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: #333;
        transition: color 0.3s ease;
    }

    .event-description {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .event-date {
        color: #999;
        font-size: 0.9rem;
    }

    .no-events {
        text-align: center;
        color: #999;
        padding: 3rem 0;
        font-size: 1rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .filters-wrapper {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group {
            width: 100%;
        }

        .search-wrapper {
            width: 100%;
            min-width: unset;
        }

        .form-control {
            width: 100%;
        }

        .event-link {
            flex-direction: column;
            align-items: flex-start;
        }

        .event-image {
            width: 100%;
            height: 200px;
        }

        .events-container {
            padding: 2rem 1rem;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center"><?php echo $channel == 'ENG' ? 'EVENTS' : '活动'?></h1>
    </div>
</div>

<div class="events-container">
    <div class="filters-wrapper">
        <div class="filter-group">
            <select class="form-control" name="dt_type" id="dt_type" style="color:black;width:auto;">
                <option value="upcoming" selected>{{ $channel == 'ENG' ? 'Upcoming' : '即将到来'}}</option>
                <option value="past">{{ $channel == 'ENG' ? 'Past' : '过去'}}</option>
            </select>
            <select class="form-control" name="count" id="count" style="color:black;">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="search-wrapper">
            <input id="dt_search" class="form-control" type="text" placeholder="<?php echo $channel == 'ENG' ? 'Search' : '搜索'?>">
            <i class="fa fa-search"></i>
        </div>
    </div>

    <div id="event_row"></div>

    <div class="pagination"></div>
    
    <input type="text" value="event" id="type" hidden>
</div>

@include('include/footer')

<script>
    var channel = '<?php echo $channel?>';
    let opt = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1,
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
                    for(var i=0; i<events.length; i++){
                        var event_name = events[i].type == 1 
                            ? (channel == 'ENG' ? 'Prayer Meeting' : '祷告会') 
                            : (events[i].name 
                                ? (channel == 'ENG' ? events[i].name : events[i].ch_name) 
                                : '-');
                        
                        var event_desc = events[i].type == 1 
                            ? '' 
                            : (events[i].description 
                                ? (channel == 'ENG' ? events[i].description : events[i].ch_description) 
                                : '');
                        
                        var imageUrl = events[i].image 
                            ? `${portal_address}assets/img/event/${events[i].image}` 
                            : `${portal_address}assets/img/banner.png`;
                        
                        var eventHtml = `
                            <div class="event-item">
                                <a href="${address}events/${events[i].event_id}" class="event-link">
                                    <img src="${imageUrl}" alt="${event_name}" class="event-image">
                                    <div class="event-content">
                                        <h3 class="event-title">${event_name}</h3>
                                        ${event_desc ? `<div class="event-description">${event_desc}</div>` : ''}
                                        <div class="event-date">${events[i].start_date}</div>
                                    </div>
                                </a>
                            </div>
                        `;
                        
                        $('#event_row').append(eventHtml);
                    }
                    
                    // Observe all event items
                    setTimeout(() => {
                        var items = $('.event-item');
                        for(var i=0; i<items.length; i++){
                            observer.observe(items[i]);
                        }
                    }, 100);
                } else {
                    var noEventsText = channel == 'ENG' ? 'No events found.' : '没有活动。';
                    $('#event_row').append(`<div class="no-events">${noEventsText}</div>`);
                }
            } else {
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            warning_response(err);
        })
    }

    function show_items(entries){
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }
</script>