@include('include.header')
@php
    $image = isset($event->image) ? IMAGE_PATH . 'event/' . $event->image : IMAGE_PATH . 'banner.png';
    $fee = isset($event->fee) ? $event->fee : 0;
@endphp
<style>
    .form-input {
        border-radius: 0!important;
        border: 0;
        border-bottom: 1px solid #d3d3d3;
        background: transparent;
    }

    .form-input:focus {
        box-shadow: none;
        outline: none;
    }
</style>

@if ($event->type == 4)
<style>
    #event_sign_up_form .error-message {
        display: none;
    }

    #event_sign_up_form .validation-failed {
        border: 0!important;
        border-bottom: 1px solid rgb(220, 53, 69)!important;
    }
</style>
@endif


<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>{{ $channel == 'ENG' ? 'EVENTS' : '活动' }}</h3>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row container-row">
        <div class="col-12 d-flex justify-content-center align-items-center" style="transition:1s ease;transform:translateY(10%);opacity:.2;">
            <form id="event_sign_up_form" onsubmit="submit_handler(event)">
                <div style="max-width:760px;box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius:2vh;padding:15px">
                    <div class="col-12 d-flex justify-content-center align-items-start">
                        <div style="max-width:760px;box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius:2vh;">
                            <div style="display:flex;justify-content:center;position:relative;">
                                <img src="{{ $image }}" style="border-top-left-radius:2vh;border-top-right-radius:2vh;">
                                <div style="box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;position:absolute;bottom:-15px;background-color:#f8f9fa;padding:5px 20px;border-radius:2vh;">
                                    <span>{{ date('jS F Y H:i:s A', strtotime($event->start_date)) }}</span>
                                </div>
                            </div>
                            <div style="padding:15px;text-align:center;">
                                <h6 class="mt-4" style="text-transform:uppercase;font-weight:700;">{{ $channel === 'ENG' ? $event->name : $event->ch_name }}</h6>
                                <p class="mt-3">{{ $channel === 'ENG' ? $event->description : $event->ch_description }}</p>
                                <p class="mt-3">{{ $event->venue }}</p>
                                <p class="mt-3">{{ $event->fee ? 'RM' . $event->fee : 'FOC' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-danger alert-message mt-3 d-none">test</div>
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
                                    <button type="submit" class="btn text-white" style="background-color:cornflowerblue;">
                                        {{ $channel == 'ENG' ? 'SIGN UP' : '报名' }}
                                    </button>
                                @else
                                    <div>
                                        <h6 class="text-center" style="font-weight:700;">{{ '$' . number_format($fee ,2) }}</h6>
                                        <a href="" class="btn text-white" style="background-color:cornflowerblue;">
                                            {{ $channel == 'ENG' ? 'PROCEED TO PAYMENT' : '付款' }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="row mt-5">
                            <div class="col-12 mt-3 section">
                                <label>{{ $channel == 'ENG' ? 'Full name of every individual (As per IC) & IC Number ' : '每个人的全名 (如身份证上的) & 身份证号码' }}<i class="fa fa-asterisk text-danger fa-2xs" style='margin-left:5px;'></i></label>
                                <div class="participant-section">
                                    <div class="row input-group mt-2">
                                        <div class="col-1 mt-1 count-index">1. </div>
                                        <div class="col-md-3 col-11 mt-1 position-relative">
                                            <input type="text" class="form-input validation-required w-100" id="name" placeholder="{{ $channel == 'ENG' ? 'Name' : '全名' }}" name="name[]">
                                        </div>
                                        <div class="d-md-none d-block col-1"></div>
                                        <div class="col-md-3 col-11 mt-1 position-relative">
                                            <input type="text" class="form-input validation-required w-100" id="contact" placeholder="{{ $channel == 'ENG' ? 'Contact' : '号码' }}" name="contact[]">
                                        </div>
                                        <div class="d-md-none d-block col-1"></div>
                                        <div class="col-md-3 col-11 mt-1 position-relative">
                                            <input type="text" class="form-input validation-required w-100" id="identity_number" placeholder="{{ $channel == 'ENG' ? 'IC No.' : '身份证号码' }}" name="ic[]">
                                        </div>
                                        <div class="d-md-none d-block mb-3"></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn bg-dark text-white text-uppercase btn-sm" onclick="add_participant(event)">Add <i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="col-12 mt-5 section">
                                <label>{{ $channel == 'ENG' ? 'Email' : '电邮地址' }}<i class="fa fa-asterisk text-danger fa-2xs" style='margin-left:5px;'></i></label>
                                <div class="input-group">
                                    <input type="text" class="form-input validation-required w-100 validation-required" name="email" id="email">
                                </div>
                            </div>

                            <div class="col-12 mt-5 section">
                                <label>{{ $channel == 'ENG' ? 'Emergency contact (Full name & contact number)' : '紧急联系人 (全名＆联系号码）' }}<i class="fa fa-asterisk text-danger fa-2xs" style='margin-left:5px;'></i></label>
                                <div class="input-group">
                                    <input type="text" class="form-input validation-required w-100 validation-required" name="emergency_contact" id="emergency_contact">
                                </div>
                            </div>
                            @if ($event->rooms && $event->rooms->count() > 0)
                                <div class="col-12 mt-5 section">
                                    <label>{{ $channel == 'ENG' ? 'Choice of room' : '房间选择' }}<i class="fa fa-asterisk text-danger fa-2xs" style='margin-left:5px;'></i></label>
                                    <p>{{ $channel == 'ENG' ? $event->room_description : $event->room_ch_description }}</p>
                                    @foreach ($event->rooms as $room)
                                        <div class="row d-flex align-items-center mb-3">
                                            <div class="col-3 d-flex justify-content-center">
                                                <button class="btn" onclick="minus_room_count(event)">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-input validation-required text-center room-count" value="0" style="width:30px" name="room[{{ $room->id }}]" readonly>
                                                <button class="btn" onclick="add_room_count(event)">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="col-9">
                                                <div>
                                                    <img 
                                                    class="w-100" 
                                                    src="{{ $room->attachments ? ADMIN_PORTAL . $room->attachments[0]->path : url('assets/img/banner.png') }}"
                                                    style="max-width:300px;border-radius:2vh;"/>
                                                </div>  
                                                <label for="">{{ $channel === 'ENG' ? $room->label : $room->ch_label }}</label>
                                                <p class="m-0">{{ $channel === 'ENG' ? $room->description : $room->ch_description }}</p>
                                                <strong>RM{{ $room->price }}</strong>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="col-12 mt-5 section">
                                <label>{{ $channel == 'ENG' ? 'Payment method' : '付款方式' }}<i class="fa fa-asterisk text-danger fa-2xs" style='margin-left:5px;'></i></label>
                                <p>{{ $channel == 'ENG' ? `The receipt for online transfer and ewallet payment is required to send or pass it to the PIC once you've made the payment. ` : '对于线上转账和电子钱包的支付，请在完成转账后将收据发送给负责人。' }}</p>
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="row col-md-6 col-12 mb-3">
                                        <div class="col-1">
                                            <input type="radio" name="payment_method" value="1">
                                        </div>
                                        <div class="col-11">
                                            <div style="border-radius:2vh;overflow:hidden;">
                                                <img src="{{ url('assets/img/online_transfer.png') }}" alt="">
                                            </div>
                                            <label for="">{{ $channel === 'ENG' ? 'Online transfer' : '线上转账' }}</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-6 col-12 mb-3">
                                        <div class="col-1">
                                            <input type="radio" name="payment_method" value="2">
                                        </div>
                                        <div class="col-11">
                                            <div style="border-radius:2vh;overflow:hidden;">
                                                <img src="{{ url('assets/img/cash.png') }}" alt="">
                                            </div>
                                            <label for="">{{ $channel === 'ENG' ? 'Cash' : '现金' }}</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-6 col-12 mb-3">
                                        <div class="col-1">
                                            <input type="radio" name="payment_method" value="3">
                                        </div>
                                        <div class="col-11">
                                            <div style="border-radius:2vh;overflow:hidden;">
                                                <img src="{{ url('assets/img/cheque.png') }}" alt="">
                                            </div>
                                            <label for="">{{ $channel === 'ENG' ? 'Cheque' : '支票' }}</label>
                                        </div>
                                    </div>
                                    <div class="row col-md-6 col-12 mb-3">
                                        <div class="col-1">
                                            <input type="radio" name="payment_method" value="4">
                                        </div>
                                        <div class="col-11">
                                            <div style="border-radius:2vh;overflow:hidden;">
                                                <img src="{{ url('assets/img/qrcode.png') }}" alt="">
                                            </div>
                                            <label for="">{{ $channel === 'ENG' ? 'E-wallet' : '电子钱包' }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="event_id" value="{{ $event_id }}">
                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="btn text-white" style="background-color:cornflowerblue;">
                                    {{ $channel == 'ENG' ? 'SIGN UP' : '报名' }}
                                </button>
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
    const event_id = '{{ $event_id }}';
    $(document).ready(() => {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                console.log(entry.isIntersecting)
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.container-row > *').forEach((element) => {
            observer.observe(element);
        });
    })

    const submit_handler = async (e) =>{
        e.preventDefault();
        const form = e.currentTarget;

        try {
            const validation = await Helper.validate('#event_sign_up_form');

            if (!validation.status) {
                throw new Error(`{{ $channel == 'ENG' ? 'Please complete all required fields.' : '请填写所有必填字段。' }}`);
            }

            const formData = new FormData(form);
            const response = await axios.post(`${address}api/events/${event_id}/sign-up`, formData, apiHeader);
            if(!response.data.status) {
                throw new Error(response.data.message);
            }
            const success_msg = `{{ $channel == 'ENG' ? 'You have successfully signed up!' : '您已注册成功！' }}`;
            success_response(success_msg).then(() => {
                window.location.href = `{{ url('events') }}/${event_id}`;
            });
        } catch (err) {
            const err_message = $(`#${form.id} .alert-message`);
            err_message.removeClass('d-none');
            err_message.text(err.message);
            $('html, body').animate({
                scrollTop: err_message.offset().top
            }, 100);
        }
    }

    const add_room_count = (e) => {
        e.preventDefault();
        const target = $(e.currentTarget);
        const input = target.siblings('.room-count');
        if(input) {
            input.val(parseInt(input.val()) + 1)
        }
    }

    const minus_room_count = (e) => {
        e.preventDefault();
        const target = $(e.currentTarget);
        const input = target.siblings('.room-count');
        if(input) {
            if(input.val() > 0) {
                input.val(parseInt(input.val()) - 1)
            }
        }
    }

    const add_participant = (e) => {
        e.preventDefault();
        const section = $('.participant-section');
        const count = section.children().length;
        const html = `
            <div class="row input-group mt-2">
                <div class="col-1 mt-1 count-index">${count + 1}. </div>
                <div class="col-md-3 col-11 mt-1 position-relative">
                    <input type="text" class="form-input validation-required w-100" id="name" placeholder="{{ $channel == 'ENG' ? 'Name' : '全名' }}" name="name[]">
                </div>
                <div class="d-md-none d-block col-1"></div>
                <div class="col-md-3 col-11 mt-1 position-relative">
                    <input type="text" class="form-input validation-required w-100" id="contact" placeholder="{{ $channel == 'ENG' ? 'Contact' : '号码' }}" name="contact[]">
                </div>
                <div class="d-md-none d-block col-1"></div>
                <div class="col-md-3 col-11 mt-1 position-relative">
                    <input type="text" class="form-input validation-required w-100" id="identity_number" placeholder="{{ $channel == 'ENG' ? 'IC No.' : '身份证号码' }}" name="ic[]">
                </div>
                <div class="col-md-2 col-12 mt-1 d-flex justify-content-end">
                    <button class="btn btn-sm text-white bg-danger" onclick="delete_participant(event)">
                        DELETE <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        section.append(html);
    }

    const delete_participant = (e) => {
        e.preventDefault();
        const target = $(e.currentTarget);
        target.closest('.row').remove();
        const index_count = $('.count-index');
        if(index_count.length > 0) {
            for(var i=0;i<index_count.length;i++) {
                $(index_count[i]).text(`${i + 1}.`)
            }
        }
    }
</script>
