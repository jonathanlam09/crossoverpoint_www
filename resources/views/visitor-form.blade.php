@include('include/header')
<style>
    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .visitor-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .form-section {
        margin-bottom: 4rem;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .form-section.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .form-question {
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 1.5rem;
        font-weight: 400;
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

    .form-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        background: transparent;
        font-size: 1rem;
        color: #333;
        min-height: 120px;
        transition: border-color 0.3s ease;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #999;
    }

    .input-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .radio-group,
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .radio-group.horizontal {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .radio-option,
    .checkbox-option {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .radio-option input[type="radio"],
    .checkbox-option input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .radio-option label,
    .checkbox-option label {
        cursor: pointer;
        color: #555;
        margin: 0;
    }

    .button-wrapper {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 4rem;
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

    .submit-button {
        background: #333;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .submit-button:hover {
        background: #000;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .visitor-container {
            padding: 2rem 1rem;
        }

        .input-row {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .radio-group.horizontal {
            flex-direction: column;
        }

        .button-wrapper {
            flex-direction: column;
        }

        .back-button,
        .submit-button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center"><?php echo $channel == 'ENG' ? 'VISITORS' : '访客'?></h1>
    </div>
</div>

<div class="visitor-container">
    <form id="visitor_form" onsubmit="submit_handler(event)">
        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your name?' : '您的姓名？'?></div>
            <div class="input-row">
                <input type="text" class="form-input validation-required" name="first_name" placeholder="<?php echo $channel == 'ENG' ? 'First name' : '名'?>">
                <input type="text" class="form-input validation-required" name="last_name" placeholder="<?php echo $channel == 'ENG' ? 'Last name' : '姓'?>">
            </div>
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your email?' : '您的电邮地址？'?></div>
            <input type="email" class="form-input" name="email" placeholder="johndoe@example.com">
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your contact?' : '您的联系号码？'?></div>
            <input type="text" class="form-input validation-required" name="contact" placeholder="0123456789">
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your address?' : '您的地址？'?></div>
            <textarea name="address" class="form-textarea validation-required"></textarea>
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your age?' : '您的年龄？'?></div>
            <input type="number" class="form-input validation-required" name="age" placeholder="<?php echo $channel == 'ENG' ? 'E.g. 24' : '例如：24'?>">
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your occupation?' : '您的职业？'?></div>
            <input type="text" class="form-input validation-required" name="occupation" placeholder="<?php echo $channel == 'ENG' ? 'E.g. Software engineer' : '例如：软件工程师'?>">
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your sex?' : '您的性别？'?></div>
            <div class="radio-group horizontal">
                <div class="radio-option">
                    <input class="validation-required" type="radio" name="sex" value="1" id="male">
                    <label for="male"><?php echo $channel == 'ENG' ? 'Male' : '男'?></label>
                </div>
                <div class="radio-option">
                    <input class="validation-required" type="radio" name="sex" value="0" id="female">
                    <label for="female"><?php echo $channel == 'ENG' ? 'Female' : '女'?></label>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your marital status?' : '您的婚姻状况？'?></div>
            <div class="radio-group horizontal">
                <div class="radio-option">
                    <input type="radio" name="marital_status" value="1" id="married">
                    <label for="married"><?php echo $channel == 'ENG' ? 'Married' : '已婚'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="marital_status" value="2" id="single" checked>
                    <label for="single"><?php echo $channel == 'ENG' ? 'Single' : '单身'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="marital_status" value="3" id="divorced">
                    <label for="divorced"><?php echo $channel == 'ENG' ? 'Divorced' : '已离婚'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="marital_status" value="4" id="widowed">
                    <label for="widowed"><?php echo $channel == 'ENG' ? 'Widowed' : '寡'?></label>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'What is your religion?' : '您的信仰？'?></div>
            <div class="radio-group">
                <div class="radio-option">
                    <input type="radio" name="religion" value="1" id="christian" checked>
                    <label for="christian"><?php echo $channel == 'ENG' ? 'Christian' : '基督教'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="religion" value="2" id="buddhist">
                    <label for="buddhist"><?php echo $channel == 'ENG' ? 'Buddhist' : '佛教'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="religion" value="3" id="hindu">
                    <label for="hindu"><?php echo $channel == 'ENG' ? 'Hindu' : '印度教'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="religion" value="4" id="islam">
                    <label for="islam"><?php echo $channel == 'ENG' ? 'Islam' : '伊斯兰教'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="religion" value="5" id="atheist">
                    <label for="atheist"><?php echo $channel == 'ENG' ? 'Atheist' : '无神论者'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="religion" value="6" id="agnostic">
                    <label for="agnostic"><?php echo $channel == 'ENG' ? 'Agnostic' : '不可知论者'?></label>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'Are you currently attending any church?' : '您目前正在参加任何教堂吗？'?></div>
            <div class="radio-group horizontal">
                <div class="radio-option">
                    <input class="validation-required" type="radio" name="is_attend_church" value="1" id="attend_yes" checked onclick="attend_church(1)">
                    <label for="attend_yes"><?php echo $channel == 'ENG' ? 'Yes' : '是'?></label>
                </div>
                <div class="radio-option">
                    <input type="radio" name="is_attend_church" value="0" id="attend_no" onclick="attend_church(0)">
                    <label for="attend_no"><?php echo $channel == 'ENG' ? 'No' : '否'?></label>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'Which church are you currently attending?' : '您目前参加哪个教会？'?></div>
            <input type="text" class="form-input validation-required" name="church_name" id="church_name" placeholder="<?php echo $channel == 'ENG' ? 'E.g. Crossover Point' : '例如：跨越教会'?>">
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'How did you come to know of this service?' : '您是如何得知有关此聚会？'?></div>
            <div class="checkbox-group">
                <div class="checkbox-option">
                    <input type="checkbox" name="media[]" value="1" id="media1">
                    <label for="media1"><?php echo $channel == 'ENG' ? 'Social Media (E.g. Facebook, Instagram)' : '社交媒体 (Facebook、Instagram)'?></label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" name="media[]" value="2" id="media2">
                    <label for="media2"><?php echo $channel == 'ENG' ? 'Website' : '网站'?></label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" name="media[]" value="3" id="media3">
                    <label for="media3"><?php echo $channel == 'ENG' ? 'Word of mouth' : '口碑'?></label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" name="media[]" value="4" id="media4">
                    <label for="media4"><?php echo $channel == 'ENG' ? 'Referral' : '转介'?></label>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-question"><?php echo $channel == 'ENG' ? 'I would like to...' : '我想要...'?></div>
            <div class="checkbox-group">
                <div class="checkbox-option">
                    <input type="checkbox" name="purpose[]" value="1" id="purpose1">
                    <label for="purpose1"><?php echo $channel == 'ENG' ? 'I want to receive Christ' : '我想接受基督为救主'?></label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" name="purpose[]" value="2" id="purpose2">
                    <label for="purpose2"><?php echo $channel == 'ENG' ? 'I need healing' : '我需要治疗'?></label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" name="purpose[]" value="3" id="purpose3">
                    <label for="purpose3"><?php echo $channel == 'ENG' ? 'I want to know more about Christ' : '我想要知道更多有关基督教信仰'?></label>
                </div>
                <div class="checkbox-option">
                    <input type="checkbox" name="purpose[]" value="4" id="purpose4">
                    <label for="purpose4"><?php echo $channel == 'ENG' ? 'I need spiritual counselling' : '我需要精神上的辅导'?></label>
                </div>
            </div>
        </div>

        <div class="button-wrapper">
            <a class="back-button" href="javascript:history.go(-1)">
                <?php echo $channel == 'ENG' ? 'Back' : '回去'?>
            </a>
            <button type="submit" class="submit-button">
                <?php echo $channel == 'ENG' ? 'Submit' : '提交'?>
            </button>
        </div>
    </form>
</div>

@include('include/footer')

<script>
    $(document).ready(() => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        const sections = document.querySelectorAll('.form-section');
        sections.forEach((section, index) => {
            section.style.transitionDelay = `${index * 0.05}s`;
            observer.observe(section);
        });
    });

    async function submit_handler(e) {
        e.preventDefault();
        const fields = $('#visitor_form .validation-required');
        const validation = await Helper.validate(fields);
        
        if (!validation.status) {
            async_warning_response(validation.message ? validation.message : validation_msg)
            .then((response) => {
                var error_field = $('#visitor_form .validation-required.validation-failed').first().closest('.form-section');
                $('html, body').animate({
                    scrollTop: error_field.offset().top - 100
                }, 500);
            });
            return false;
        }

        const form = $('#visitor_form').get(0);
        var formdata = new FormData(form);
        
        axios.post(address + 'api/visitors', formdata, apiHeader)
        .then((response) => {
            if (response.data.status) {
                const success_msg = (channel == 'ENG' ? 'Successfully registered!' : '注册成功！');
                success_response(success_msg)
                .then((response) => {
                    window.location.reload();
                });
            } else {
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            error_response(err);
        });
    }

    function attend_church(val) {
        if (val == 1) {
            $('#church_name').attr('disabled', false);
            $('#church_name').addClass('validation-required');
        } else {
            $('#church_name').attr('disabled', true);
            $('#church_name').removeClass('validation-required');
        }
    }
</script>