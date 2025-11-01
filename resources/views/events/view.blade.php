@include('include.header')

@php
    $name = $event->name ?? '-';
    $description = $event->description ?? '-';
    $start_date = date('jS F Y H:i:s A', strtotime($event->start_date));
    $end_date = date('jS F Y H:i:s A', strtotime($event->end_date));
    $fee = $event->fee ?? '0';
    $fee = $fee == 0 ? 0 : 'RM' . number_format($fee, 2);
    $venue = $event->venue ? $event->venue : '-';
    $image = $event->image ? IMAGE_PATH . 'event/' . $event->image : IMAGE_PATH . 'banner.png';
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

    .event-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .event-image-wrapper {
        margin-bottom: 3rem;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .event-image-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .event-image {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .alert {
        margin-bottom: 2rem;
        padding: 1rem;
        border-radius: 4px;
        border-left: 3px solid #dc3545;
        background: #f8d7da;
        color: #721c24;
    }

    .event-info {
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
    }

    .back-button:hover {
        border-color: #999;
        color: #000;
        text-decoration: none;
    }

    .signup-button {
        background: #333;
        border: 1px solid #333;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .signup-button:hover {
        background: #000;
        border-color: #000;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .event-detail-container {
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
            flex-direction: column;
        }

        .back-button,
        .signup-button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center">{{ $channel == 'ENG' ? 'EVENTS' : '活动' }}</h1>
    </div>
</div>

<div class="event-detail-container">
    @if(Session::has("error"))
        <div class="alert">
            {!! Session::get("error") !!}
        </div>
    @endif

    <div class="event-image-wrapper">
        <img src="{{ $image }}" alt="{{ $name }}" class="event-image">
    </div>

    <div class="event-info">
        @php
            $labels = [
                'Name' => ['eng' => 'Name', 'chn' => '名字'],
                'Description' => ['eng' => 'Description', 'chn' => '描写'],
                'Venue' => ['eng' => 'Venue', 'chn' => '地点'],
                'Start date' => ['eng' => 'Start date', 'chn' => '开始日期'],
                'End date' => ['eng' => 'End date', 'chn' => '结束日期'],
                'Registration open date' => ['eng' => 'Registration open date', 'chn' => '报名开放日期'],
                'Registration closing date' => ['eng' => 'Registration closing date', 'chn' => '报名截止日期'],
                'PIC' => ['eng' => 'PIC', 'chn' => '负责人'],
                'Fee' => ['eng' => 'Fee', 'chn' => '费用']
            ];

            $eventData = [
                'Name' => $channel == 'ENG' ? $name : $event->ch_name,
                'Description' => $channel == 'ENG' ? $description : $event->ch_description,
                'Venue' => $venue,
                'Start date' => $start_date,
                'End date' => $end_date,
                'Registration open date' => $event->registration_open_date ? date('jS F Y H:i:s A', strtotime($event->registration_open_date)) : '-',
                'Registration closing date' => $event->registration_close_date ? date('jS F Y 23:59:59 A', strtotime($event->registration_close_date)) : '-',
                'PIC' => $event->pic ? $event->pic->getFullname() : '-',
                'Fee' => $fee
            ];
        @endphp

        @foreach ($eventData as $key => $value)
            @if ($key === 'Fee' && $value == 0)
                @continue
            @endif
            <div class="info-row">
                <div class="info-label">
                    {{ $channel == 'ENG' ? $labels[$key]['eng'] : $labels[$key]['chn'] }}
                </div>
                <div class="info-value">{{ $value }}</div>
            </div>
        @endforeach
    </div>

    <div class="button-wrapper">
        <a onclick="history.back()" class="back-button">
            {{ $channel == 'ENG' ? 'Back' : '返回' }}
        </a>
        @if(time() >= strtotime($event->registration_open_date) && now()->timestamp <= strtotime($event->registration_close_date))
            <a class="signup-button" href="{{ url('events/sign-up/' . $event_id) }}">
                {{ $channel == 'ENG' ? 'Sign Up' : '报名' }}
            </a>
        @endif
    </div>
</div>

@include('include.footer')

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
        const imageWrapper = document.querySelector('.event-image-wrapper');
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