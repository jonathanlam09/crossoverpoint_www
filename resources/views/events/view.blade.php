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
    @media screen and (min-width:992px){
        .img-fluid{
            max-width: 800px;
        }
    }
</style>

<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>{{ $channel == 'ENG' ? 'EVENTS' : '活动' }}</h3>
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

    <div class="row event-item" style="transform:translateY(50%);opacity:.2;transition:.5s ease;">
        <div class="col-12 mt-5 d-flex justify-content-center">
            <img class="img-fluid" src="{{ $image }}">
        </div>
    </div>

    @foreach ([
        'Name' => $channel == 'ENG' ? $name : $event->ch_name,
        'Description' => $channel == 'ENG' ? $description : $event->ch_description,
        'Venue' => $venue,
        'Start date' => $start_date,
        'End date' => $end_date,
        'Registration open date' => $event->registration_open_date ? date('jS F Y H:i:s A', strtotime($event->registration_open_date)) : '-',
        'Registration closing date' => $event->registration_close_date ? date('jS F Y 23:59:59 A', strtotime($event->registration_close_date)) : '-',
        'PIC' => $event->pic ? $event->pic->getFullname() : '-',
        'Fee' => $fee
    ] as $label => $value)
        @if ($label === 'Fee' && $value == 0)
            @continue
        @endif
        <div class="row d-flex justify-content-center mt-3 event-item">
            <div class="row" style="width: 800px">
                <div class="col-md-6 col-12">
                    <span style="font-weight:700;">
                        @if ($channel == 'ENG')
                            {{ $label }}
                        @else
                            @if ($label == 'Registration open date')
                                报名开放日期
                            @elseif ($label == 'Registration closing date')
                                报名截止日期
                            @elseif($label == 'Venue')
                                地点
                            @elseif($label == 'PIC')
                                负责人
                            @elseif($label == 'Name')
                                名字
                            @elseif($label == 'Description')
                                描写
                            @elseif($label == 'Start date')
                                开始日期
                            @elseif($label == 'End date')
                                结束日期
                            @endif
                        @endif
                    </span>
                </div>
                <div class="col-md-6 col-12">
                    <span>{{ $value }}</span>
                </div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-end mt-5">
        <a onclick="history.back()" class="btn btn-secondary">{{ $channel == 'ENG' ? 'BACK' : '返回' }}</a>
        @if(time() >= strtotime($event->registration_open_date) && now()->timestamp <= strtotime($event->registration_close_date))
            <a class="btn" href="{{ url('events/sign-up/' . $event_id) }}" style="margin-left:5px;background-color:cornflowerblue;color:white;">
                {{ $channel == 'ENG' ? 'SIGN UP' : '报名' }}
            </a>
        @endif
    </div>
</div>

@include('include.footer')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let observerOptions = {
            root: null,
            rootMargin: "0px",
            threshold: 0.2,
        };

        let observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    console.log(entry.target)
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0px)";
                }
            });
        }, observerOptions);

        document.querySelectorAll(".event-item").forEach((item) => {
            observer.observe(item);
        });
    });
</script>
