@include("include/header")
<?php
    $channel = session()->get("channel");
    if(!isset($channel)){
        $channel = "ENG";
    }
?>
<style>
    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .sermons-container {
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
        color: #333;
        background: white;
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

    .sermon-item {
        padding: 2rem 0;
        border-bottom: 1px solid #f0f0f0;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .sermon-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .sermon-item:last-child {
        border-bottom: none;
    }

    .sermon-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .sermon-link:hover .sermon-title {
        color: #555;
    }

    .sermon-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 4px;
        flex-shrink: 0;
    }

    .sermon-content {
        flex: 1;
    }

    .sermon-title {
        font-weight: 400;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: #333;
        transition: color 0.3s ease;
    }

    .sermon-description {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .sermon-date {
        color: #999;
        font-size: 0.9rem;
    }

    .no-sermons {
        text-align: center;
        color: #999;
        padding: 3rem 0;
        font-size: 1rem;
    }

    .footer-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        flex: 1;
    }

    .toggle-btn {
        background: none;
        border: 1px solid #e0e0e0;
        color: #333;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .toggle-btn:hover {
        border-color: #999;
        color: #000;
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

        .sermon-link {
            flex-direction: column;
            align-items: flex-start;
        }

        .sermon-image {
            width: 100%;
            height: 200px;
        }

        .sermons-container {
            padding: 2rem 1rem;
        }

        .footer-controls {
            flex-direction: column;
        }

        .pagination {
            order: 2;
        }

        .toggle-btn {
            order: 1;
            width: 100%;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center"><?php echo $channel == "ENG" ? "SERMONS" : "讲道"?></h1>
    </div>
</div>

<div class="sermons-container">
    <div class="filters-wrapper">
        <div class="filter-group">
            <select class="form-control" name="count" id="count" onchange="get_sermons()">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="search-wrapper">
            <input id="dt_search" class="form-control" type="text" placeholder="<?php echo $channel == 'ENG' ? 'Search' : '搜索'?>" onchange="get_sermons()">
            <i class="fa fa-search"></i>
        </div>
    </div>

    <div id="sermon_row"></div>

    <div class="footer-controls">
        <div class="pagination"></div>
        <?php if($period == "upcoming"){ ?>
            <a href="<?php echo url("sermons/past")?>" class="toggle-btn">
                <?php echo $channel == "ENG" ? "Past sermons" : "过去的讲道"?>
            </a>
        <?php } else { ?>
            <a href="<?php echo url("sermons/upcoming")?>" class="toggle-btn">
                <?php echo $channel == "ENG" ? "Upcoming sermons" : "来临的讲道"?>
            </a>
        <?php } ?>
    </div>
    
    <input type="text" id="period" value="<?php echo $period?>" hidden>
    <input type="text" value="sermon" id="type" hidden>
</div>

@include("include/footer")

<script>
    var channel = "<?php echo $channel?>";

    let opt = {
        root: null,
        rootMargin: "0px",
        threshold: 0.1,
    };
    var observer = new IntersectionObserver(show_sermons, opt);
    
    $(document).ready(() => {
        get_sermons();
    })

    function get_sermons(){
        var start = $(".active-page").text();
        if($(".active-page").length == 0){
            start = 1;
        }
        var length = $("#count").val();
        var search = $("#dt_search").val();
        var period = $("#period").val();
        var formdata = new FormData();
        formdata.append("start", (start * length) - length);
        formdata.append("length", length);
        formdata.append("search", search);
        formdata.append("period", period);

        axios.post(address + "api/sermons/get", formdata, apiHeader)
        .then((response) => {
            if(response.data.status){
                $("#sermon_row").empty();
                var sermons = response.data.data.sermons;
                var total = response.data.data.total;
                
                if(start == 1){
                    $(".pagination").empty();
                    setup(total);
                }
                
                if(sermons.length > 0){
                    for(var i=0; i<sermons.length; i++){
                        var imageUrl = sermons[i].image 
                            ? portal_address + "assets/img/sermon/" + sermons[i].image
                            : address + "assets/img/banner.png";
                        
                        var title = channel == "ENG" ? sermons[i].title : sermons[i].ch_title;
                        var description = (channel == "ENG" ? sermons[i].description : sermons[i].ch_description) || "";
                        
                        var sermonHtml = `
                            <div class="sermon-item">
                                <a href="${address}sermons/${sermons[i].sermon_id}" class="sermon-link">
                                    <img src="${imageUrl}" alt="${title}" class="sermon-image">
                                    <div class="sermon-content">
                                        <h3 class="sermon-title">${title}</h3>
                                        ${description ? `<div class="sermon-description">${description}</div>` : ''}
                                        <div class="sermon-date">${sermons[i].date}</div>
                                    </div>
                                </a>
                            </div>
                        `;
                        
                        $("#sermon_row").append(sermonHtml);
                    }
                    
                    // Observe all sermon items
                    setTimeout(() => {
                        var items = $(".sermon-item");
                        for(var i=0; i<items.length; i++){
                            observer.observe(items[i]);
                        }
                    }, 100);
                } else {
                    var noSermonsText = period == "past"
                        ? (channel == "ENG" ? "No past sermons." : "没有过去的讲道。")
                        : (channel == "ENG" ? "No upcoming sermons." : "没有即将举行的讲道。");
                    $("#sermon_row").append(`<div class="no-sermons">${noSermonsText}</div>`);
                }
            } else {
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            warning_response(err);
        })
    }

    function show_sermons(entries){
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }
</script>