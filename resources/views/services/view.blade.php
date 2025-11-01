@include('include/header')

@php
    $title = isset($service->title) ? $service->title : 'To be announced.';
    $description = isset($service->description) ? $service->description : 'To be announced.';
    $date = date('jS F Y', strtotime($service->date)) . ' 10:00:00 AM';
    $image = isset($service->image) ? IMAGE_PATH . 'service/' . $service->image : url('assets/img/banner.png');
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

    .service-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .service-image-wrapper {
        margin-bottom: 3rem;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .service-image-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .service-image {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .service-info {
        margin-bottom: 3rem;
    }

    .info-row {
        display: flex;
        padding: 1.5rem 0;
        border-bottom: 1px solid #f0f0f0;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .info-row.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 400;
        color: #666;
        min-width: 200px;
        flex-shrink: 0;
    }

    .info-value {
        color: #333;
        line-height: 1.6;
        word-break: break-word;
    }

    .info-value a {
        color: #333;
        text-decoration: underline;
        transition: color 0.3s ease;
    }

    .info-value a:hover {
        color: #000;
    }

    .button-wrapper {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .button-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .back-button {
        background: none;
        border: 1px solid #e0e0e0;
        color: #333;
        padding: 0.75rem 2rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .back-button:hover {
        border-color: #999;
        color: #000;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .service-detail-container {
            padding: 2rem 1rem;
        }

        .info-row {
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-label {
            min-width: unset;
        }

        .button-wrapper {
            justify-content: stretch;
        }

        .back-button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center">{{ $channel == 'ENG' ? 'SERVICES' : '讲道' }}</h1>
    </div>
</div>

<div class="service-detail-container">
    <div class="service-image-wrapper">
        <img src="{{ $image }}" alt="{{ $title }}" class="service-image">
    </div>

    <div class="service-info">
        @php
            $labels = [
                'Title' => ['eng' => 'Title', 'chn' => '标题'],
                'Description' => ['eng' => 'Description', 'chn' => '描述'],
                'Date' => ['eng' => 'Date', 'chn' => '日期'],
                'Speaker' => ['eng' => 'Speaker', 'chn' => '讲员'],
                'Broadcast link' => ['eng' => 'Broadcast link', 'chn' => '广播网址']
            ];

            $speakerName = '';
            if($service->is_guest == 1){
                $speakerName = $service->speaker_name 
                    ? $service->speaker_name . ($channel == 'ENG' ? ' (Guest)' : ' (宾)') 
                    : 'To be announced.';
            } else {
                $speakerName = $service->speaker 
                    ? $service->speaker->getFullname() 
                    : 'To be announced.';
            }

            $serviceData = [
                'Title' => $title,
                'Description' => $description,
                'Date' => $date,
                'Speaker' => $speakerName,
                'Broadcast link' => isset($service->broadcast_live) ? $service->broadcast_live : null
            ];
        @endphp

        @foreach ($serviceData as $key => $value)
            @if ($value !== null)
                <div class="info-row">
                    <div class="info-label">
                        {{ $channel == 'ENG' ? $labels[$key]['eng'] : $labels[$key]['chn'] }}
                    </div>
                    <div class="info-value">
                        @if ($key === 'Broadcast link')
                            <a href="{{ $value }}" target="_blank">{{ $value }}</a>
                        @else
                            {{ $value }}
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="button-wrapper">
        <a onclick="history.back()" class="back-button">
            {{ $channel == 'ENG' ? 'BACK' : '返回' }}
        </a>
    </div>
</div>

@include('include/footer')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        // Observe image
        const imageWrapper = document.querySelector('.service-image-wrapper');
        if(imageWrapper) observer.observe(imageWrapper);

        // Observe info rows with stagger
        const infoRows = document.querySelectorAll('.info-row');
        infoRows.forEach((row, index) => {
            row.style.transitionDelay = `${index * 0.1}s`;
            observer.observe(row);
        });

        // Observe buttons
        const buttonWrapper = document.querySelector('.button-wrapper');
        if(buttonWrapper) {
            buttonWrapper.style.transitionDelay = `${infoRows.length * 0.1}s`;
            observer.observe(buttonWrapper);
        }
    });
</script>