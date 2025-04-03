@include('include.header')

@php
    $image = isset($event->image) ? IMAGE_PATH . 'event/' . $event->image : IMAGE_PATH . 'banner.png';
    $fee = isset($event->fee) ? $event->fee : 0;
@endphp

<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>{{ $channel == 'ENG' ? 'EVENTS' : '活动' }}</h3>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row container-row">
        <div class="col-md-6 d-flex align-items-start" style="transition:1s ease;transform:translateY(100%);opacity:.2;">
            <div style="max-width:760px;box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius:2vh;">
                <div style="display:flex;justify-content:center;position:relative;">
                    <img src="{{ $image }}" style="border-top-left-radius:2vh;border-top-right-radius:2vh;">
                    <div style="box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;position:absolute;bottom:-15px;background-color:#f8f9fa;padding:5px 20px;border-radius:2vh;">
                        <span>{{ date("jS F Y H:i:s A", strtotime($event->start_date)) }}</span>
                    </div>
                </div>
                <div style="padding:15px;text-align:center;">
                    <h6 class="mt-4" style="text-transform:uppercase;font-weight:700;">{{ $channel === 'ENG' ? $event->name : $event->ch_name }}</h6>
                    <p class="mt-3">{{ $channel === 'ENG' ? $event->description : $event->ch_description }}</p>
                </div>
            </div>
        </div>

        <div class="col-1 d-flex justify-content-center" style="transition:1s ease;transform:translateY(100%);opacity:.2;">
            <div style="border-left:1px dotted lightgrey;"></div>
        </div> 

        <div class="col-md-5 d-flex align-items-center" style="transition:1s ease;transform:translateY(100%);opacity:.2;">
            <form id="event_sign_up_form">
                <div style="max-width:760px;box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius:2vh;padding:15px">
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{ url('assets/img/logo.png') }}" style="width:80px;">
                    </div>

                    @if ($event->type !== 4)
                        <div class="row mt-5">
                            <div class="col-lg-6 col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'First Name' : '名' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="first_name" id="first_name" placeholder="eg. John" style="border:none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Last Name' : '姓' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="last_name" id="last_name" placeholder="eg. Doe" style="border:none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Email' : '电邮地址' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="email" id="email" placeholder="eg. johndoe@example.com" style="border:none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Contact' : '联系号码' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="contact" id="contact" placeholder="eg. 0123456789" style="border:none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                </div>
                            </div>

                            <input type="hidden" name="event_id" value="{{ $event_id }}">

                            <div class="d-flex justify-content-center mt-5">
                                @if($fee == 0)
                                    <button type="submit" class="btn" style="background-color:cornflowerblue;color:white;border-radius:2vh;">
                                        {{ $channel == 'ENG' ? 'SIGN UP' : '报名' }}
                                    </button>
                                @else
                                    <div>
                                        <h6 class="text-center" style="font-weight:700;">{{ '$' . number_format($fee ,2) }}</h6>
                                        <a href="" class="btn" style="background-color:cornflowerblue;color:white;border-radius:2vh;">
                                            {{ $channel == 'ENG' ? 'PROCEED TO PAYMENT' : '付款' }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="row mt-5">
                            <div class="col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Number of pax & full name of every individual (As per IC) & IC Number ' : '人数 & 每个人的全名 (如身份证上的) & 身份证号码' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="names" id="names" placeholder="{{ $channel === 'ENG' ? 'eg. 2 pax - Jewel Wong (012345-13-6789), Jorryn Wong (098765-13-4321)' : '2位 - Jewel Wong (012345-13-6789), Jorryn Wong (098765-13-4321)' }}" style="border:none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Contact number' : '联系号码' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="contact" id="contact" style="border:none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Emergency contact (Full name & contact number)' : '紧急联系人 (全名＆联系号码）' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="emergency_contact" id="emergency_contact" style="border:none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Choice of room' : '房间选择' }}</label>
                                <p>{{ $channel == 'ENG' ? $event->room_description : $event->room_ch_description }}</p>
                                @if ($event->rooms)
                                    @foreach ($event->rooms as $room)
                                        <div class="row d-flex align-items-center">
                                            <div class="col-1">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-11">
                                                <label for="">{{ $channel === 'ENG' ? $room->label : $room->ch_label }}</label>
                                                <p class="m-0">{{ $channel === 'ENG' ? $room->description : $room->ch_description }}</p>
                                                <strong>RM{{ $room->price }}</strong>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-12 mt-3">
                                <label>{{ $channel == 'ENG' ? 'Payment method' : '付款方式' }}</label>
                                <p>{{ $channel == 'ENG' ? `The receipt for online transfer and ewallet payment is required to send or pass it to the PIC once you've made the payment. ` : '对于线上转账和电子钱包的支付，请在完成转账后将收据发送给负责人。' }}</p>
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col-1">
                                        <input type="radio" name="payment_method">
                                    </div>
                                    <div class="col-11">
                                        <div style="border-radius:2vh;overflow:hidden;width:70%;">
                                            <img src="{{ url('assets/img/online_transfer.png') }}" alt="">
                                        </div>
                                        <label for="">{{ $channel === 'ENG' ? 'Online transfer' : '线上转账' }}</label>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col-1">
                                        <input type="radio" name="payment_method">
                                    </div>
                                    <div class="col-11">
                                        <div style="border-radius:2vh;overflow:hidden;width:70%;">
                                            <img src="{{ url('assets/img/cash.png') }}" alt="">
                                        </div>
                                        <label for="">{{ $channel === 'ENG' ? 'Cash' : '现金' }}</label>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col-1">
                                        <input type="radio" name="payment_method">
                                    </div>
                                    <div class="col-11">
                                        <div style="border-radius:2vh;overflow:hidden;width:70%;">
                                            <img src="{{ url('assets/img/cheque.png') }}" alt="">
                                        </div>
                                        <label for="">{{ $channel === 'ENG' ? 'Cheque' : '支票' }}</label>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <div class="col-1">
                                        <input type="radio" name="payment_method">
                                    </div>
                                    <div class="col-11">
                                        <div style="border-radius:2vh;overflow:hidden;width:70%;">
                                            <img src="{{ url('assets/img/qrcode.png') }}" alt="">
                                        </div>
                                        <label for="">{{ $channel === 'ENG' ? 'E-wallet' : '电子钱包' }}</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="event_id" value="{{ $event_id }}">
                            <div class="d-flex justify-content-center mt-5">
                                @if($fee == 0)
                                    <button type="submit" class="btn" style="background-color:cornflowerblue;color:white;border-radius:2vh;">
                                        {{ $channel == 'ENG' ? 'SIGN UP' : '报名' }}
                                    </button>
                                @else
                                    <div>
                                        <a href="" class="btn" style="background-color:cornflowerblue;color:white;border-radius:2vh;">
                                            {{ $channel == 'ENG' ? 'SUBMIT' : '提交' }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@include('include.footer')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const event_id = "{{ $event_id }}";
        const observerOptions = {
            root: document.querySelector(".container-row"),
            rootMargin: "0px",
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        }, observerOptions);

        document.querySelectorAll(".container-row > *").forEach((element) => {
            observer.observe(element);
        });

        document.getElementById("event_sign_up_form").addEventListener("submit", async function (e) {
            e.preventDefault();

            const validation = await Helper.validate();
            if (!validation.status) {
                warning_response(validation.message);
                return;
            }

            const formData = new FormData(this);

            axios.post(`{{ url('api/events') }}/${event_id}/sign-up`, formData, apiHeader)
                .then((response) => {
                    if (response.data.status) {
                        const success_msg = "{{ $channel == 'ENG' ? 'You have successfully signed up!' : '您已注册成功！' }}";
                        success_response(success_msg).then(() => {
                            window.location.href = `{{ url('events') }}/${event_id}`;
                        });
                    } else {
                        warning_response(response.data.message);
                    }
                })
                .catch((err) => {
                    error_response(err);
                });
        });
    });
</script>
