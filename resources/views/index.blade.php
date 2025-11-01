@include('include/header')
<style>
    :root {
        --primary-color: #000000;
        --secondary-color: #1a1a1a;
        --text-color: #333333;
        --text-light: #666666;
        --bg-light: #fafafa;
        --border-color: #e0e0e0;
        --transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        scroll-behavior: smooth;
    }

    ::-webkit-scrollbar {
        width: 6px;
        background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: var(--primary-color);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        color: var(--text-color);
        overflow-x: hidden;
        background: white;
    }

    /* Highlight Section */
    .highlight-section {
        position: relative;
        height: 85vh;
        min-height: 600px;
        overflow: hidden;
    }

    .media-container {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: var(--transition);
        position: relative;
        filter: grayscale(20%);
    }

    .media-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.5));
    }

    .highlight-controls {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        gap: 10px;
    }

    .highlight-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .highlight-dot:hover {
        background: rgba(255,255,255,0.6);
        transform: scale(1.3);
    }

    .highlight-dot.active {
        background: white;
        width: 32px;
        border-radius: 4px;
    }

    /* Section Styling */
    .section-container {
        padding: 75px 0;
        opacity: 0;
        transform: translateY(30px);
        transition: var(--transition);
    }

    .section-container.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 300;
        letter-spacing: -0.5px;
        margin-bottom: 80px;
        text-align: center;
        position: relative;
        display: inline-block;
        width: 100%;
        color: var(--primary-color);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 1px;
        background: var(--primary-color);
    }

    /* Creed Section */
    .creed-section {
        background: var(--bg-light);
    }

    .creed-text {
        max-width: 900px;
        margin: 0 auto;
        font-size: 1.05rem;
        line-height: 2.2;
        text-align: center;
        color: var(--text-light);
    }

    .creed-text h3 {
        font-size: 1.8rem;
        font-weight: 400;
        margin-bottom: 50px;
        color: var(--primary-color);
        letter-spacing: 1px;
    }

    .creed-line {
        opacity: 0;
        transform: translateY(15px);
        transition: var(--transition);
    }

    .creed-line.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Service & Event Cards */
    .content-card {
        background: white;
        border-radius: 0;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: var(--transition);
        opacity: 0;
        transform: translateY(30px);
        border: 1px solid var(--border-color);
    }

    .content-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .content-card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        transform: translateY(-5px);
    }

    .content-card img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        transition: transform 0.8s ease;
        filter: grayscale(10%);
    }

    .content-card:hover img {
        transform: scale(1.02);
    }

    .content-card-body {
        padding: 40px;
    }

    .content-card-date {
        color: var(--text-light);
        font-weight: 400;
        font-size: 0.85rem;
        margin-bottom: 15px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .content-card-title {
        font-size: 1.6rem;
        font-weight: 400;
        margin-bottom: 20px;
        color: var(--primary-color);
        line-height: 1.4;
    }

    .content-card-description {
        color: var(--text-light);
        line-height: 1.8;
        font-size: 0.95rem;
    }

    /* Side Cards */
    .side-card {
        margin-bottom: 25px;
        border-radius: 0;
        overflow: hidden;
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: var(--transition);
        opacity: 0;
        transform: translateX(30px);
        border: 1px solid var(--border-color);
    }

    .side-card.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .side-card:hover {
        transform: translateX(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .side-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        filter: grayscale(10%);
    }

    .side-card-body {
        padding: 20px;
        text-align: center;
    }

    .side-card-date {
        font-size: 0.75rem;
        color: var(--text-light);
        font-weight: 400;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .side-card-title {
        font-size: 0.95rem;
        color: var(--primary-color);
        margin-top: 8px;
        font-weight: 400;
    }

    /* Gallery Cards */
    .gallery-card {
        position: relative;
        height: 350px;
        overflow: hidden;
        border-radius: 0;
        opacity: 0;
        transform: translateY(30px);
        transition: var(--transition);
        border: 1px solid var(--border-color);
        background-size: cover;
        background-position: center center;
    }

    .gallery-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.8) 100%);
        z-index: 1;
        transition: var(--transition);
    }

    .gallery-card:hover::before {
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.6) 100%);
    }

    .gallery-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
        filter: grayscale(20%);
    }

    .gallery-card:hover img {
        transform: scale(1.05);
        filter: grayscale(0%);
    }

    .gallery-card-title {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px;
        color: white;
        font-size: 1.2rem;
        font-weight: 300;
        z-index: 2;
        transform: translateY(0);
        transition: var(--transition);
        letter-spacing: 0.5px;
    }

    .gallery-card:hover .gallery-card-title {
        transform: translateY(-10px);
    }

    /* View More Link */
    .view-more {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 400;
        transition: var(--transition);
        margin-top: 50px;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .view-more:hover {
        color: var(--text-light);
        gap: 15px;
    }

    .view-more i {
        font-size: 0.8rem;
    }

    /* Divider */
    .section-divider {
        max-width: 60px;
        margin: 100px auto;
        border: 0;
        height: 1px;
        background: var(--border-color);
    }

    /* Initial Loader */
    .initial-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: white;
        z-index: 9999;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .initial-loader.hide {
        transform: translateY(-100%);
    }

    .loader-logo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: white;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 40px;
        animation: fadeIn 1s ease;
    }

    .loader-logo img {
        width: 70px;
        height: auto;
    }

    .loader-tagline {
        display: flex;
        gap: 25px;
        color: var(--text-color);
        font-size: 0.85rem;
        animation: fadeIn 1.5s ease;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    .loader-tagline span {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .loader-tagline i {
        font-size: 4px;
        color: var(--primary-color);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-title {
            font-size: 1.8rem;
        }

        .section-container {
            padding: 80px 0;
        }

        .content-card img {
            height: 280px;
        }

        .content-card-body {
            padding: 30px 20px;
        }

        .loader-tagline {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .gallery-card {
            height: 280px;
        }

        .highlight-section {
            height: 60vh;
            min-height: 400px;
        }
    }
</style>

<!-- Initial Loader -->
<div class="initial-loader d-flex flex-column justify-content-center align-items-center">
    <div class="loader-logo">
        <img src="<?php echo url("assets/img/logo.png")?>" alt="Logo">
    </div>
    <div class="loader-tagline">
        <span><i class="fa-solid fa-circle"></i> Know Christ</span>
        <span><i class="fa-solid fa-circle"></i> Make Christ Known</span>
        <span><i class="fa-solid fa-circle"></i> Known By Christ</span>
    </div>
</div>

<!-- Highlight Section -->
<section >
    <div class="media-container" id="media_container"></div>
    <div class="highlight-controls" id="highlight_controls"></div>
</section>

<!-- Creed Section -->
<section class="creed-section section-container d-none" id="creed_section">
    <div class="container">
        <div class="creed-text" id="creed_content"></div>
    </div>
</section>

<hr class="section-divider">

<!-- Service Section -->
<section class="section-container d-none" id="service_section">
    <div class="container">
        <h2 class="section-title">{{ $channel == 'ENG' ? 'UPCOMING SERVICES' : '来临的道' }}</h2>
        
        @if(!$service)
            <div class="text-center" style="color: var(--text-light);">
                {{ $channel == "ENG" ? "Stay tuned for more upcoming services." : "请继续关注即将到来的更多讲道。" }}
            </div>
        @else
            @php
                $main_service_image = isset($service->image) ? IMAGE_PATH . 'service/' . $service->image : url('assets/img/banner.png');
            @endphp
            
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="content-card">
                        <a href="{{ url('services/' . $service->encrypted_id) }}">
                            <img src="{{ $main_service_image }}" alt="Service">
                        </a>
                        <div class="content-card-body">
                            <div class="content-card-date">{{ date("jS F Y • 10:00 AM", strtotime($service->date)) }}</div>
                            <h3 class="content-card-title">{{ $channel == "ENG" ? $service->title : $service->ch_title }}</h3>
                            <p class="content-card-description">{{ $channel == "ENG" ? $service->description : $service->ch_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="text-center">
            <a href="{{ url("services/upcoming") }}" class="view-more">
                {{ $channel == 'ENG' ? 'View all services' : '查看更多' }}
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- Event Section -->
<section class="section-container d-none" id="event_section">
    <div class="container">
        <h2 class="section-title">{{ $channel == 'ENG' ? 'UPCOMING EVENTS' : '来临的活动' }}</h2>
        
        @if(count($events) == 0)
            <div class="text-center" style="color: var(--text-light);">
                {{ $channel == "ENG" ? "Stay tuned for more upcoming events." : "请继续关注更多即将举行的活动。" }}
            </div>
        @else
            @php
                $totalEventCount = count($events);
                $mainEvent = $events[0];
                $remainingEvents = array_slice($events, 1);
                $mainEventImage = isset($mainEvent['image']) ? ADMIN_PORTAL . 'assets/img/event/' . $mainEvent['image'] : asset('assets/img/banner.png');
            @endphp

            <div class="row">
                <div class="col-lg-{{ ($totalEventCount > 1) ? '8' : '12' }}">
                    <div class="content-card">
                        <a href="{{ url('events/' . $mainEvent['encrypted_id']) }}">
                            <img src="{{ $mainEventImage }}" alt="Event">
                        </a>
                        <div class="content-card-body">
                            <div class="content-card-date">
                                {{ date('jS F Y', strtotime($mainEvent['start_date'])) }} • {{ date('h:i A', strtotime($mainEvent['start_date'])) }}
                            </div>
                            <h3 class="content-card-title">{{ $channel == "ENG" ? $mainEvent['name'] : $mainEvent['ch_name'] }}</h3>
                            <p class="content-card-description">{{ $channel == "ENG" ? $mainEvent['description'] : $mainEvent['ch_description'] }}</p>
                        </div>
                    </div>
                </div>
                
                @if($totalEventCount > 1)
                    <div class="col-lg-4">
                        @foreach($remainingEvents as $index => $row)
                            @php
                                $image = isset($row['image']) ? ADMIN_PORTAL . 'assets/img/event/' . $row['image'] : asset('assets/img/banner.png');
                            @endphp
                            <a href="{{ url('events/' . $row['encrypted_id']) }}" class="text-decoration-none">
                                <div class="side-card" style="transition-delay: {{ $index * 0.1 }}s;">
                                    <img src="{{ $image }}" alt="Event">
                                    <div class="side-card-body">
                                        <div class="side-card-date">{{ date('jS F Y', strtotime($row['start_date'])) }}</div>
                                        <div class="side-card-title">{{ $channel == "ENG" ? $row['name'] : $row['ch_name'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
        
        @if (count($events) > 0)
            <div class="text-center">
                <a href="{{ url("events?page=1&length=10&type=upcoming") }}" class="view-more">
                    {{ $channel == 'ENG' ? 'View all events' : '查看更多' }}
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<hr class="section-divider">

<!-- Gallery Section -->
@if (isset($topics))
<section class="section-container d-none" id="gallery_section">
    <div class="container">
        <h2 class="section-title">{{ $channel == "ENG" ? "MORE ABOUT US" : "关于我们更多" }}</h2>
        
        <div class="row g-4">
            @foreach ($topics as $key => $row)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ url('gallery/' . $row->encrypted_id) }}" class="text-decoration-none">
                        <div class="gallery-card" style="background-image: url({{ ADMIN_PORTAL . $row->path }}); transition-delay: {{ $key * 0.1 }}s;">
                            <img src="{{ ADMIN_PORTAL . $row->path }}" alt="{{ $row->name }}" style="opacity: 0;">
                            <h4 class="gallery-card-title">{{ $row->name }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
    const highlights = JSON.parse(`<?php echo $highlights?>`);
    const channel = '{{ $channel }}';
    const dportal_address = `<?php echo ADMIN_PORTAL?>`;
    let currentHighlight = 0;
    let highlightInterval;

    // Creed text content
    const creedContent = {
        ENG: {
            title: 'CREED OF FAITH',
            lines: [
                'I know the only true God.',
                'I know Jesus Christ, the one God sent to earth.',
                'I have the eternal life (John 17:3).',
                'I confess with my mouth that Jesus is Lord.',
                'I believe in my heart that Jesus rose from the dead (Romans 10:9).',
                'I want to know Christ (Phil 3:10).',
                'I will make Christ known to others (Col 1:28).',
                'On that day of His return, I am known by Him as His own (John 10:14).'
            ]
        },
        CHN: {
            title: '信仰信条',
            lines: [
                '我认识独一的真神。我认识神所差来的耶稣基督。',
                '我得着永生 (17:3)。',
                '我口里认耶稣为主。我心里信 神叫祂从死里复活 (罗马 10:9)。',
                '我要认识基督 (腓 3:10)。',
                '我要传扬基督 (歌 1:28)。',
                '基督再来时，祂认识我，因我属于祂 (约 10: 14)，且遵行祂的旨意 (约6:40)。'
            ]
        }
    };

    $(document).ready(() => {
        const session = window.sessionStorage.getItem("session");
        
        if(session) {
            // Not first time - remove loader immediately
            $(".initial-loader").remove();
            showContent();
        } else {
            // First time - show loader animation
            $("body, html").css("overflow-y", "hidden");
            setTimeout(() => {
                $("body, html").css("overflow-y", "auto");
                $(".initial-loader").addClass("hide");
                setTimeout(() => {
                    $(".initial-loader").remove();
                    showContent();
                }, 800);
                sessionStorage.setItem("session", true);
            }, 3000);
        }

        // Initialize highlights
        initHighlights();
        
        // Initialize creed
        renderCreed();
        
        // Setup intersection observers
        setupObservers();
        
        // Handle errors
        const error = "<?php echo session()->get('error')?>";
        if(error != "") {
            warning_response(error);
        }
    });

    function showContent() {
        $("#creed_section").removeClass("d-none");
        $("#service_section").removeClass("d-none");
        $("#event_section").removeClass("d-none");
        $("#gallery_section").removeClass("d-none");
    }

    function initHighlights() {
        // Render highlight dots
        const controlsContainer = document.getElementById('highlight_controls');
        highlights.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.className = 'highlight-dot' + (index === 0 ? ' active' : '');
            dot.onclick = () => changeHighlight(index);
            controlsContainer.appendChild(dot);
        });

        // Start slideshow
        changeHighlight(0);
        highlightInterval = setInterval(() => {
            currentHighlight = (currentHighlight + 1) % highlights.length;
            changeHighlight(currentHighlight);
        }, 5000);
    }

    function changeHighlight(index) {
        currentHighlight = index;
        
        // Update dots
        document.querySelectorAll('.highlight-dot').forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        
        // Update image
        document.getElementById('media_container').style.backgroundImage = 
            `url(${dportal_address + highlights[index]?.path})`;
    }

    function renderCreed() {
        const content = channel === 'ENG' ? creedContent.ENG : creedContent.CHN;
        const container = document.getElementById('creed_content');
        
        container.innerHTML = `<h3>${content.title}</h3>`;
        content.lines.forEach((line, index) => {
            const p = document.createElement('p');
            p.className = 'creed-line';
            p.textContent = line;
            p.style.transitionDelay = `${index * 0.1}s`;
            container.appendChild(p);
        });
    }

    function setupObservers() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('section-container')) {
                        entry.target.classList.add('visible');
                        
                        // Animate children
                        const cards = entry.target.querySelectorAll('.content-card, .side-card, .gallery-card, .creed-line');
                        cards.forEach(card => card.classList.add('visible'));
                    }
                }
            });
        }, observerOptions);

        // Observe all sections
        document.querySelectorAll('.section-container').forEach(section => {
            observer.observe(section);
        });
    }
</script>

@include("include/footer")