@include('include.header')
@php
    $image = isset($event->image) ? IMAGE_PATH . 'event/' . $event->image : IMAGE_PATH . 'banner.png';
    $fee = isset($event->fee) ? $event->fee : 0;
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

    .signup-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .form-wrapper {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .form-wrapper.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .event-card {
        border: 1px solid #f0f0f0;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 3rem;
    }

    .event-image {
        width: 100%;
        height: auto;
    }

    .event-details {
        padding: 2rem;
        text-align: center;
    }

    .event-date-badge {
        background: #f8f9fa;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        display: inline-block;
        margin-top: -2rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: #666;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .event-title {
        font-weight: 500;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        color: #333;
        text-transform: uppercase;
    }

    .event-info {
        color: #666;
        line-height: 1.8;
        margin-bottom: 0.5rem;
    }

    .alert {
        margin-bottom: 2rem;
        padding: 1rem;
        border-radius: 4px;
        border-left: 3px solid #dc3545;
        background: #f8d7da;
        color: #721c24;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #666;
        font-size: 0.9rem;
    }

    .form-label .required {
        color: #dc3545;
        margin-left: 0.25rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 0;
        border: 0;
        border-bottom: 1px solid #e0e0e0;
        background: transparent;
        font-size: 1rem;
        color: #333;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-bottom-color: #999;
    }

    .form-input.validation-failed {
        border-bottom-color: #dc3545;
    }

    .participant-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .participant-number {
        min-width: 30px;
        color: #999;
    }

    .participant-inputs {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-button {
        background: none;
        border: 1px solid #e0e0e0;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .action-button:hover {
        border-color: #999;
    }

    .action-button.danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .action-button.danger:hover {
        background: #dc3545;
        color: white;
    }

    .room-option {
        display: flex;
        gap: 1.5rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid #f0f0f0;
        align-items: center;
    }

    .room-option:last-child {
        border-bottom: none;
    }

    .room-counter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .room-counter button {
        background: none;
        border: 1px solid #e0e0e0;
        width: 32px;
        height: 32px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .room-counter button:hover:not(:disabled) {
        border-color: #999;
    }

    .room-counter button:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .room-counter input {
        width: 50px;
        text-align: center;
        border: none;
    }

    .room-info {
        flex: 1;
    }

    .room-image {
        max-width: 200px;
        width: 100%;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    .room-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .room-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        white-space: pre-wrap;
    }

    .room-price {
        font-weight: 500;
        color: #333;
    }

    .payment-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .payment-option {
        display: flex;
        gap: 1rem;
        align-items: center;
        padding: 1rem;
        border: 1px solid #f0f0f0;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-option:hover {
        border-color: #999;
    }

    .payment-option input[type="radio"] {
        margin: 0;
    }

    .payment-image {
        width: 100%;
        border-radius: 4px;
        margin-bottom: 0.5rem;
    }

    .submit-button {
        background: #333;
        color: white;
        border: none;
        padding: 0.75rem 3rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .submit-button:hover {
        background: #000;
    }

    .button-wrapper {
        text-align: center;
        margin-top: 3rem;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .signup-container {
            padding: 2rem 1rem;
        }

        .participant-inputs {
            grid-template-columns: 1fr;
        }

        .room-option {
            flex-direction: column;
            align-items: flex-start;
        }

        .payment-options {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center">{{ $channel == 'ENG' ? 'EVENTS' : '活动' }}</h1>
    </div>
</div>

<div class="signup-container">
    <div class="form-wrapper">
        <form id="event_sign_up_form" onsubmit="submit_handler(event)">
            <div class="event-card">
                <img src="{{ $image }}" alt="Event" class="event-image">
                <div class="event-date-badge">
                    {{ date('jS F Y H:i:s A', strtotime($event->start_date)) }}
                </div>
                <div class="event-details">
                    <h2 class="event-title">{{ $channel === 'ENG' ? $event->name : $event->ch_name }}</h2>
                    <p class="event-info">{{ $channel === 'ENG' ? $event->description : $event->ch_description }}</p>
                    <p class="event-info">{{ $event->venue }}</p>
                    @if ($event->fee)
                        <p class="event-info"><strong>{{ 'RM' . $event->fee }}</strong></p>
                    @endif
                </div>
            </div>

            <div class="alert alert-message d-none">test</div>

            @if ($event->type !== 4)
                <div class="form-section">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <label class="form-label">{{ $channel == 'ENG' ? 'First Name' : '名' }}</label>
                            <input type="text" class="form-input validation-required" name="first_name" id="first_name" placeholder="eg. John">
                        </div>
                        <div>
                            <label class="form-label">{{ $channel == 'ENG' ? 'Last Name' : '姓' }}</label>
                            <input type="text" class="form-input validation-required" name="last_name" id="last_name" placeholder="eg. Doe">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <label class="form-label">{{ $channel == 'ENG' ? 'Email' : '电邮地址' }}</label>
                    <input type="text" class="form-input validation-required" name="email" id="email" placeholder="eg. johndoe@example.com">
                </div>

                <div class="form-section">
                    <label class="form-label">{{ $channel == 'ENG' ? 'Contact' : '联系号码' }}</label>
                    <input type="text" class="form-input validation-required" name="contact" id="contact" placeholder="eg. 0123456789">
                </div>

                <input type="hidden" name="event_id" value="{{ $event_id }}">
                
                <div class="button-wrapper">
                    @if($fee == 0)
                        <button type="submit" class="submit-button">
                            {{ $channel == 'ENG' ? 'Sign Up' : '报名' }}
                        </button>
                    @else
                        <div>
                            <p style="font-weight: 500; margin-bottom: 1rem;">{{ 'RM' . number_format($fee, 2) }}</p>
                            <a href="" class="submit-button" style="display: inline-block; text-decoration: none;">
                                {{ $channel == 'ENG' ? 'Proceed to Payment' : '付款' }}
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <div class="form-section">
                    <label class="form-label">
                        {{ $channel == 'ENG' ? 'Full name of every individual (As per IC) & IC Number' : '每个人的全名 (如身份证上的) & 身份证号码' }}
                        <span class="required">*</span>
                    </label>
                    <div class="participant-section">
                        <div class="participant-row">
                            <div class="participant-number">1.</div>
                            <div class="participant-inputs">
                                <input type="text" class="form-input validation-required" placeholder="{{ $channel == 'ENG' ? 'Name' : '全名' }}" name="name[]">
                                <input type="text" class="form-input validation-required" placeholder="{{ $channel == 'ENG' ? 'Contact' : '号码' }}" name="contact[]">
                                <input type="text" class="form-input validation-required" placeholder="{{ $channel == 'ENG' ? 'IC No.' : '身份证号码' }}" name="ic[]">
                            </div>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: 1rem;">
                        <button class="action-button" onclick="add_participant(event)">
                            {{ $channel == 'ENG' ? 'Add' : '添加' }} <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="form-section">
                    <label class="form-label">{{ $channel == 'ENG' ? 'Email' : '电邮地址' }}<span class="required">*</span></label>
                    <input type="text" class="form-input validation-required" name="email" id="email">
                </div>

                <div class="form-section">
                    <label class="form-label">{{ $channel == 'ENG' ? 'Emergency contact (Full name & contact number)' : '紧急联系人 (全名＆联系号码）' }}<span class="required">*</span></label>
                    <input type="text" class="form-input validation-required" name="emergency_contact" id="emergency_contact">
                </div>

                @if ($event->rooms && $event->rooms->count() > 0)
                    <div class="form-section">
                        <label class="form-label">{{ $channel == 'ENG' ? 'Choice of room' : '房间选择' }}<span class="required">*</span></label>
                        <p style="white-space: pre-line; color: #666; margin-bottom: 1.5rem;">{{ $channel == 'ENG' ? $event->room_description : $event->room_ch_description }}</p>
                        
                        @foreach ($event->rooms as $room)
                            <div class="room-option" style="{{ $room->disabled ? 'opacity: 0.5;' : '' }}">
                                <div class="room-counter">
                                    @if ($room->disabled)
                                        <button type="button" disabled><i class="fa fa-minus"></i></button>
                                        <input type="text" class="form-input text-center room-count" value="0" name="room[{{ $room->id }}]" readonly disabled>
                                        <button type="button" disabled><i class="fa fa-plus"></i></button>
                                    @else
                                        <button type="button" onclick="minus_room_count(event)"><i class="fa fa-minus"></i></button>
                                        <input type="text" class="form-input text-center room-count" value="0" name="room[{{ $room->id }}]" readonly>
                                        <button type="button" onclick="add_room_count(event)"><i class="fa fa-plus"></i></button>
                                    @endif
                                </div>
                                <div class="room-info">
                                    <img class="room-image" src="{{ (isset($room->attachments) && count($room->attachments) > 0) ? ADMIN_PORTAL . $room->attachments[0]->path : url('assets/img/banner.png') }}" alt="{{ $channel === 'ENG' ? $room->label : $room->ch_label }}">
                                    <div class="room-label">{{ $channel === 'ENG' ? $room->label : $room->ch_label }}</div>
                                    <div class="room-description">{{ $channel === 'ENG' ? $room->description : $room->ch_description }}</div>
                                    <div class="room-price">RM{{ $room->price }}</div>
                                    @if ($room->disabled)
                                        <p style="color: #dc3545; margin-top: 0.5rem;">0 left.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        
                        <div style="margin-top: 1.5rem;">
                            <label class="form-label">{{ $channel == 'ENG' ? 'Additional Remarks' : '附加备注' }}</label>
                            <input type="text" class="form-input" name="additional_remarks">
                        </div>
                    </div>
                @endif

                <div class="form-section">
                    <label class="form-label">{{ $channel == 'ENG' ? 'Payment method' : '付款方式' }}<span class="required">*</span></label>
                    
                    @if ($channel == 'ENG' && $event->payment_remarks)
                        <p style="white-space: pre-line; color: #666; margin-bottom: 1rem;">{{ $event->payment_remarks }}</p>
                    @elseif ($event->payment_remarks_ch)
                        <p style="white-space: pre-line; color: #666; margin-bottom: 1rem;">{{ $event->payment_remarks_ch }}</p>
                    @endif

                    <p style="color: #666; margin-bottom: 1.5rem;">{{ $channel == 'ENG' ? 'The receipt for online transfer and ewallet payment is required to send or pass it to the PIC once you\'ve made the payment.' : '对于线上转账和电子钱包的支付，请在完成转账后将收据发送给负责人。' }}</p>

                    <div class="payment-options">
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="1">
                            <div style="flex: 1;">
                                <img src="{{ url('assets/img/online_transfer.png') }}" alt="Online Transfer" class="payment-image">
                                <div>{{ $channel === 'ENG' ? 'Online transfer' : '线上转账' }}</div>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="2">
                            <div style="flex: 1;">
                                <img src="{{ url('assets/img/cash.png') }}" alt="Cash" class="payment-image">
                                <div>{{ $channel === 'ENG' ? 'Cash' : '现金' }}</div>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="3">
                            <div style="flex: 1;">
                                <img src="{{ url('assets/img/cheque.png') }}" alt="Cheque" class="payment-image">
                                <div>{{ $channel === 'ENG' ? 'Cheque' : '支票' }}</div>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="4">
                            <div style="flex: 1;">
                                <img src="{{ url('assets/img/qrcode.png') }}" alt="E-wallet" class="payment-image">
                                <div>{{ $channel === 'ENG' ? 'E-wallet' : '电子钱包' }}</div>
                            </div>
                        </label>
                    </div>
                </div>

                <input type="hidden" name="event_id" value="{{ $event_id }}">
                
                <div class="button-wrapper">
                    <button type="submit" class="submit-button">
                        {{ $channel == 'ENG' ? 'Sign Up' : '报名' }}
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>

@include('include.footer')

<script>
    const event_id = '{{ $event_id }}';
    
    $(document).ready(() => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        const formWrapper = document.querySelector('.form-wrapper');
        if(formWrapper) observer.observe(formWrapper);
    });

    const submit_handler = async (e) => {
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
            const success_msg = `{{ $channel == 'ENG' ? 'You have successfully signed up! You will receive a confirmation slip in your email.' : '您已注册成功！你将会在你的电子邮件中收到确认单。' }}`;
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
            input.val(parseInt(input.val()) + 1);
        }
    }

    const minus_room_count = (e) => {
        e.preventDefault();
        const target = $(e.currentTarget);
        const input = target.siblings('.room-count');
        if(input && input.val() > 0) {
            input.val(parseInt(input.val()) - 1);
        }
    }

    const add_participant = (e) => {
        e.preventDefault();
        const section = $('.participant-section');
        const count = section.children().length;
        const html = `
            <div class="participant-row">
                <div class="participant-number">${count + 1}.</div>
                <div class="participant-inputs">
                    <input type="text" class="form-input validation-required" placeholder="{{ $channel == 'ENG' ? 'Name' : '全名' }}" name="name[]">
                    <input type="text" class="form-input validation-required" placeholder="{{ $channel == 'ENG' ? 'Contact' : '号码' }}" name="contact[]">
                    <input type="text" class="form-input validation-required" placeholder="{{ $channel == 'ENG' ? 'IC No.' : '身份证号码' }}" name="ic[]">
                </div>
                <button class="action-button danger" onclick="delete_participant(event)">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        `;
        section.append(html);
    }

    const delete_participant = (e) => {
        e.preventDefault();
        const target = $(e.currentTarget);
        target.closest('.participant-row').remove();
        const numbers = $('.participant-number');
        numbers.each((i, el) => {
            $(el).text(`${i + 1}.`);
        });
    }
</script>