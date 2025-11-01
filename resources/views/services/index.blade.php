@include('include/header')

@php
    $channel = session()->get('channel');
    if(!isset($channel)){
        $channel = 'ENG';
    }
@endphp

<style>
    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .services-container {
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

    .service-item {
        padding: 2rem 0;
        border-bottom: 1px solid #f0f0f0;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .service-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .service-item:last-child {
        border-bottom: none;
    }

    .service-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .service-link:hover .service-title {
        color: #555;
    }

    .service-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 4px;
        flex-shrink: 0;
    }

    .service-content {
        flex: 1;
    }

    .service-title {
        font-weight: 400;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: #333;
        transition: color 0.3s ease;
    }

    .service-description {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .service-date {
        color: #999;
        font-size: 0.9rem;
    }

    .no-services {
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

        .service-link {
            flex-direction: column;
            align-items: flex-start;
        }

        .service-image {
            width: 100%;
            height: 200px;
        }

        .services-container {
            padding: 2rem 1rem;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center">{{ $channel == 'ENG' ? 'SERVICES' : '讲道' }}</h1>
    </div>
</div>

<div class="services-container">
    <div class="filters-wrapper">
        <div class="filter-group">
            <select class="form-control" name="dt_type" id="dt_type" style="color:black;width:auto;">
                <option value="upcoming" selected>{{ $channel == 'ENG' ? 'Upcoming' : '即将到来'}}</option>
                <option value="past">{{ $channel == 'ENG' ? 'Past' : '过去'}}</option>
            </select>
            <select class="form-control" name="dt_length" id="dt_length" style="color:black;">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="search-wrapper">
            <input id="dt_search" class="form-control" type="text" placeholder="{{ $channel == 'ENG' ? 'Search' : '搜索' }}">
            <i class="fa fa-search"></i>
        </div>
    </div>

    <div id="service_row"></div>

    <div class="pagination"></div>
    
    <input type="text" value="service" id="type" hidden>
</div>

@include('include/footer')

<script>
    var channel = '{{ $channel }}';
    let opt = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1,
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
                    for(var i=0; i<services.length; i++){
                        var service_title = channel == 'ENG' ? services[i].title : services[i].ch_title;
                        var service_desc = channel == 'ENG' ? services[i].description : services[i].ch_description;
                        
                        var imageUrl = services[i].image 
                            ? `${portal_address}assets/img/service/${services[i].image}` 
                            : `${address}assets/img/banner.png`;
                        
                        var serviceHtml = `
                            <div class="service-item">
                                <a href="${address}services/${services[i].service_id}" class="service-link">
                                    <img src="${imageUrl}" alt="${service_title}" class="service-image">
                                    <div class="service-content">
                                        <h3 class="service-title">${service_title || '-'}</h3>
                                        ${service_desc ? `<div class="service-description">${service_desc}</div>` : ''}
                                        <div class="service-date">${services[i].date}</div>
                                    </div>
                                </a>
                            </div>
                        `;
                        
                        $('#service_row').append(serviceHtml);
                    }
                    
                    // Observe all service items
                    setTimeout(() => {
                        var items = $('.service-item');
                        for(var i=0; i<items.length; i++){
                            observer.observe(items[i]);
                        }
                    }, 100);
                } else {
                    var noServicesText = type == 'past'
                        ? (channel == 'ENG' ? 'No past services.' : '没有过去的讲道。')
                        : (channel == 'ENG' ? 'No upcoming services.' : '没有即将举行的讲道。');
                    $('#service_row').append(`<div class="no-services">${noServicesText}</div>`);
                }
            } else {
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            warning_response(err);
        })
    }

    function show_services(entries){
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }
</script>