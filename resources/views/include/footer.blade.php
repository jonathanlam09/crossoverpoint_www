<style>
    :root {
        --footer-bg: #000000;
        --footer-text: #ffffff;
        --footer-text-muted: #999999;
        --input-bg: #1a1a1a;
        --input-border: #333333;
        --input-focus: #ffffff;
    }

    footer {
        background-color: var(--footer-bg);
        color: var(--footer-text);
    }

    .footer-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 100px 40px 60px;
    }

    .footer-section {
        margin-bottom: 60px;
    }

    .footer-title {
        font-size: 0.9rem;
        font-weight: 400;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 30px;
        color: var(--footer-text);
    }

    .footer-info p,
    .footer-info a {
        color: var(--footer-text-muted);
        font-size: 0.9rem;
        line-height: 1.8;
        margin-bottom: 12px;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-info a:hover {
        color: var(--footer-text);
    }

    .social-links {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .social-links a {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--input-border);
        color: var(--footer-text-muted);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-links a:hover {
        border-color: var(--footer-text);
        color: var(--footer-text);
        transform: translateY(-3px);
    }

    .enquiry-form {
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 400;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--footer-text-muted);
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        padding: 12px 0;
        background: transparent;
        border: none;
        border-bottom: 1px solid var(--input-border);
        color: var(--footer-text);
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .form-control:focus {
        outline: none;
        border-bottom-color: var(--input-focus);
        background: transparent;
    }

    .form-control::placeholder {
        color: var(--footer-text-muted);
        opacity: 0.5;
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999999' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0 center;
        padding-right: 20px;
    }

    select.form-control option {
        background: var(--footer-bg);
        color: var(--footer-text);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
        padding: 12px 0;
    }

    .error-message {
        background-color: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.3);
        color: #ff6b6b;
        padding: 12px 20px;
        font-size: 0.85rem;
        margin-bottom: 25px;
        border-radius: 0;
    }

    .submit-btn {
        background: var(--footer-text);
        color: var(--footer-bg);
        border: none;
        padding: 14px 50px;
        font-size: 0.8rem;
        font-weight: 400;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 0;
        margin-top: 20px;
    }

    .submit-btn:hover {
        background: var(--footer-text-muted);
        transform: translateY(-2px);
    }

    .footer-bottom {
        border-top: 1px solid var(--input-border);
        padding-top: 40px;
        margin-top: 60px;
        text-align: center;
        color: var(--footer-text-muted);
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    @media (max-width: 991px) {
        .footer-container {
            padding: 80px 30px 40px;
        }

        .footer-section {
            margin-bottom: 50px;
        }

        .social-links {
            justify-content: flex-start;
        }
    }

    @media (max-width: 767px) {
        .footer-container {
            padding: 60px 20px 30px;
        }

        .form-group.half-width {
            width: 100%;
            margin-bottom: 25px;
        }

        .submit-btn {
            width: 100%;
        }
    }
</style>

<footer id="contact_us">
    <div class="footer-container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-5 col-12 footer-section">
                <h6 class="footer-title"><?php echo $channel == 'ENG' ? 'Crossover Point' : '跨越教会'?></h6>
                <div class="footer-info">
                    <p>32A, Jalan Aman Tiara 8<br>Telok Panglima Garang<br>Selangor 42500</p>
                    <a href="mailto:crossoverpointchurch@gmail.com" style="display: block;">crossoverpointchurch@gmail.com</a>
                    
                    <div class="social-links">
                        <a href="https://www.facebook.com/crossoverpointchurch" target="_blank" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/crossoverpoint/" target="_blank" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/601154265548?text=I%20would%20like%20to%20ask%20about%20Crossover%20Point" target="_blank" aria-label="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="mailto:crossoverpointchurch@gmail.com" aria-label="Email">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Enquiry Form -->
            <div class="col-lg-7 col-12 footer-section">
                <h6 class="footer-title"><?php echo $channel == 'ENG' ? 'Enquiries' : '詢問'?></h6>
                
                <form id="enquiry_form" class="enquiry-form" onsubmit="submit_enquiry(event)">
                    <div class="alert error-message d-none"></div>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo $channel == 'ENG' ? 'First Name' : '名'?></label>
                                <input name="first_name" id="first_name" type="text" class="form-control validation-required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo $channel == 'ENG' ? 'Last Name' : '姓'?></label>
                                <input name="last_name" id="last_name" type="text" class="form-control validation-required">
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo $channel == 'ENG' ? 'Contact' : '联系号码'?></label>
                                <input name="contact" id="contact" type="text" class="form-control validation-required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><?php echo $channel == 'ENG' ? 'Email' : '电邮地址'?></label>
                                <input name="email" id="email" type="email" class="form-control validation-required">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo $channel == 'ENG' ? 'Type of Enquiries' : '查询类型'?></label>
                        <select name="type_of_enquiry" class="form-control validation-required" id="type_of_enquiry">
                            <option value=""><?php echo $channel == 'ENG' ? 'Select your enquiries' : '选择您的询问'?></option>
                            <option value="Prayer request"><?php echo $channel == 'ENG' ? 'Prayer Request' : '祈祷请求'?></option>
                            <option value="Shelter"><?php echo $channel == 'ENG' ? 'Shelter' : '庇护'?></option>
                            <option value="Serving"><?php echo $channel == 'ENG' ? 'Serving' : '服侍'?></option>
                            <option value="Ministry"><?php echo $channel == 'ENG' ? 'Ministry' : '事工'?></option>
                            <option value="Discipleship"><?php echo $channel == 'ENG' ? 'Discipleship' : '门徒训练'?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php echo $channel == 'ENG' ? 'Remarks' : '备注'?></label>
                        <textarea class="form-control validation-required" id="remarks" name="remarks"></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="submit-btn">
                            <?php echo $channel == 'ENG' ? 'SUBMIT' : '提交'?>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Crossover Point. <?php echo $channel == 'ENG' ? 'All rights reserved.' : '版权所有。'?></p>
        </div>
    </div>
</footer>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
<script src="{{ url('assets/js/validation.js?ver=' . time()) }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
crossorigin="anonymous"></script>
<script>
    const address = `${window.location.origin}/`;
    const portal_address = `https://admin.crossoverpoint.org.my/`;
    const dev_portal_address = 'http://localhost:8000/';
    const apiHeader = { headers: { 'Content-Type': 'multipart/form-data'} };
    const url_path = `${location.protocol}//${location.host}${location.pathname}`;
    var channel = `<?php echo $channel;?>`;
    const validation_msg = (channel == 'ENG') ? 'Please complete all required fields!' : '请填写所有必填字段！'
    const type_functions = {
        event: function (reload = false) {
            get_events(reload)
        },
        service: function (reload = false) {
            get_services(reload)
        }
    };
    var timeout;
    
    $(document).ready(()=>{
        $('#dt_search').on('input', (e) => {
            search_table(e.target.value)
        })

        $('#dt_length').on('change', (e) => {
            change_length(e.target.value);
        })

        $('#dt_type').on('change', (e) => {
            change_type(e.target.value);
        })
    })

    function dt_setup(params = null) {
        const url = new URL(url_path);
        var searchParams = new URLSearchParams(window.location.search);
        const page = searchParams.get('page');
        const length = searchParams.get('length');
        const search = searchParams.get('search');
        var type = searchParams.get('type');
        if(params) {
            if(!params.types.includes(type)) {
                type = params.default;
            }
            searchParams.set('type', type);
            $('#dt_type').val(type);
        }
        searchParams.set('page', (page ? page : 1));
        searchParams.set('length', (length ? length : 10));
        if(search) {
            searchParams.set('search', search);
        }
        window.history.pushState({}, '', `${url.href}?${searchParams.toString()}`);
        $('#dt_length').val((length ? length : 10));
        $('#dt_search').val(search);
        type_functions[$('#type').val().toLowerCase()](true);
    }

    function change_type(dt_type) {
        const type = $('#type').val();
        const url = new URL(url_path);
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set('page', 1);
        searchParams.set('type', (dt_type));
        window.history.pushState({}, '', `${url.href}?${searchParams.toString()}`);
        type_functions[type.toLowerCase()](true);
    }

    function search_table(search) {
        const type = $('#type').val();
        const url = new URL(url_path);
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set('search', search);
        searchParams.set('page', 1);
        window.history.pushState({}, '', `${url.href}?${searchParams.toString()}`);
        timeout = setTimeout(() => {
            type_functions[type.toLowerCase()](true);
        }, 500);
    }   

    function change_length(length) {
        const type = $('#type').val();
        const url = new URL(url_path);
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set('page', 1);
        searchParams.set('length', length);
        window.history.pushState({}, '', `${url.href}?${searchParams.toString()}`);
        type_functions[type.toLowerCase()](true);
    }

    const submit_enquiry = async (e) => {
        e.preventDefault();
        const target = e.currentTarget;

        try {
            const response = Helper.validate('#enquiry_form');
            if(!response.status) {
                throw new Error(channel == 'ENG' ? 'Please complete all required fields.' : '请填写所有必填字段。');
            }

            var formdata = new FormData(target);
            const res = await axios.post(address + 'api/index/enquiry', formdata, apiHeader);
            if(!res.data.status) {
                throw new Error(res.data.message);
            }

            const success_msg = (channel == 'ENG' ? 'Your enquiry has been submitted! We will connect with you soon.' : '您的询问已提交！我们将尽快与您联系。');
            success_response(success_msg)
            .then((response) => {
                window.location.reload();
            });
        } catch (err) {
            const err_message = $(`#${target.id} .error-message`);
            err_message.removeClass('d-none');
            err_message.text(err.message);
            
            // Scroll to error
            $('html, body').animate({
                scrollTop: err_message.offset().top - 100
            }, 300);
        }
    }

    function setup(total){
        const query = new URLSearchParams(window.location.search);
        var index = query.get('page');
        var length = query.get('length');
        total = Math.ceil(total/length);

        if(total > 5){
            for(var i=1;i<=total;i++){
                if(i == 2){
                    var page = `<div class="more_page" id="more_page_1" style="display:none;">...</div>`;
                    $(`#page_${i}`).before(page);
                    $(`.pagination`).append(page);
                }else if(i == total){
                    var page = `<div class="more_page" id="more_page_2">...</div>`;
                    $(`#page_${i}`).before(page);
                    $(`.pagination`).append(page);
                }
                
                if(i > 3 && i < total){
                    var page = `<div class="page" onclick="paginate(${i}, ${total})" id="page_${i}" style="display:none;">${i}</div>`;
                    $(`.pagination`).append(page);
                }else{
                    if(i == 1){
                        var page = `<div class="page" onclick="paginate(${i}, ${total})" id="page_${i}">${i}</div>`;
                        $(`.pagination`).append(page);
                    }else{
                        var page = `<div class='page' onclick='paginate(${i}, ${total})" id="page_${i}">${i}</div>`;
                        $(`.pagination`).append(page);
                    }
                }
            }
        }else{
            for(var i=1;i<=total;i++){
                if(i == 1){
                    var page = `<div class="page" onclick="paginate(${i}, ${total})" id="page_${i}">${i}</div>`;
                    $('.pagination').append(page)
                }else{
                    var page = `<div class="page" onclick="paginate(${i}, ${total})" id="page_${i}">${i}</div>`;
                    $('.pagination').append(page)
                }
            }
        }
        
        $('#page_' + index).addClass('active-page');
    }

    function paginate(index, total_pages){
        var count = $('#dt_length').val();
        var type = $('#type').val();
        $('html, body').animate({scrollTop : 500}, 500);

        if(total_pages > 5){
            if(index < 4){
                for(var i=1;i<=total_pages;i++){
                    if(i < 4 || i == total_pages){
                        $('#page_' + i).css('display', '')
                    }else{
                        $('#page_' + i).css('display', 'none')
                    }

                    if(index == 3){
                        $('#page_' + 4).css('display', '')
                    }
                }
                $('#more_page_1').css('display', 'none')
                $('#more_page_2').css('display', '')
            }else if(index >= 4 && index < total_pages-2){
                for(var i=1;i<=total_pages;i++){
                    if(i == 1 || i == total_pages || i == index || i == index+1 || i == index-1){
                        $('#page_' + i).css('display', '')
                    }else{
                        $('#page_' + i).css('display', 'none')
                    }
                }
                $('#more_page_1').css('display', '')
                $('#more_page_2').css('display', '')
            }
            else if(index >= total_pages-2){
                for(var i=1;i<=total_pages;i++){
                    if(i == 1 || i > total_pages-3){
                        $('#page_' + i).css('display', '')
                    }else{
                        $('#page_' + i).css('display', 'none')
                    }
                }
                if(index == total_pages-2){
                    $('#page_' + (total_pages-3)).css('display', '')
                }
                $('#more_page_2').css('display', 'none')
                $('#more_page_1').css('display', '')
            }
        }

        for(var i=1;i<=total_pages;i++){
            if(i != index){
                $('#page_' + i).removeClass('active-page')
            }
            $('#page_' + index).addClass('active-page')
        }

        const url = new URL(url_path);
        var searchParams = new URLSearchParams(window.location.search);
        searchParams.set('page', index);
        window.history.pushState({}, '', `${url.href}?${searchParams.toString()}`);
        type_functions[type.toLowerCase()]();
    }

    async function success_response(data) {
        return await Swal.fire({
            title: 'Success!',
            icon: 'success',
            text: data,
            confirmButtonText: 'OK',
            confirmButtonColor: '#000000',
        });
    }

    function warning_response(data, redirect = false, redirect_page) {
        if (redirect) {
            if (data != 'checking') {
                Swal.fire({
                    title: 'Warning!',
                    icon: 'warning',
                    text: data,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#000000',
                }).then((result) => {
                    window.location.href = address + redirect_page;
                })
            }
        } else {
            if (data != 'warning') {
                Swal.fire({
                    title: 'Warning!',
                    icon: 'warning',
                    text: data,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#000000',
                })
            }
        }
    }

    async function async_warning_response(data) {
        return await Swal.fire({
            title: 'Warning!',
            icon: 'warning',
            text: data,
            confirmButtonText: 'OK',
            confirmButtonColor: '#000000',
        })
    }

    function error_response() {
        Swal.fire({
            title: 'Error!',
            icon: 'error',
            text: 'Something Error !',
            confirmButtonText: 'OK',
            confirmButtonColor: '#000000',
        })
    }
</script>