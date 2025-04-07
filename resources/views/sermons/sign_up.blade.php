@include("include/header")
<?php
    $image = isset($sermon->image) ? IMAGE_PATH . "sermon/" . $sermon->image : IMAGE_PATH . "banner.png";
?>
<style>
    .error-message{
        width:150px;
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3><?php echo $channel == "ENG" ? "SERMONS" : "讲道"?></h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <div style="max-width:760px;box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius:2vh;">
                <div style="display:flex;justify-content:center;position:relative;">
                    <img src="<?php echo $image?>" style="border-top-left-radius:2vh;border-top-right-radius:2vh;">
                    <div style="box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;position:absolute;bottom:-15px;background-color:#f8f9fa;padding:5px 20px;border-radius:2vh;">
                        <span><?php echo date("jS F Y H:i:s A", strtotime($sermon->start_date))?></span>
                    </div>
                </div>
                <div style="padding:15px;text-align:center;">
                    <h6 class="mt-4" style="text-transform:uppercase;font-weight:700;"><?php echo $sermon->name;?></h6>
                    <p class="mt-3"><?php echo $sermon->description?></p>
                </div>
            </div>
        </div>
        <div class="col-1" style="display: flex;justify-content:center;">
            <div style=" border-left:1px dotted lightgrey;">
            </div>
        </div> 
        <hr class="d-block d-md-none mt-3">
            <div class="col-md-5 d-flex align-items-center">
                <form id="sermon_sign_up_form" onsubmit="submit_handler(sermon)">
                    <div style="max-width:760px;box-shadow:rgba(149, 157, 165, 0.2) 0px 8px 24px;border-radius:2vh;padding:15px">
                        <div class="d-flex justify-content-center mt-3">
                            <img src="<?php echo url("assets/img/logo.png")?>" style="width:80px;">
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-6 col-12 mt-3">
                                <label for="">First name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="first_name" id="first_name" placeholder="eg. John" style="border:none;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mt-3">
                                <label for="">Last name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="last_name" id="last_name" placeholder="eg. Doe" style="border:none;">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="email" id="email" placeholder="eg. johndoe@example.com" style="border:none;">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="">Contact</label>
                                <div class="input-group">
                                    <input type="text" class="form-control validation-required" name="contact" id="contact" placeholder="eg. 0123456789" style="border:none;">
                                </div>
                            </div>
                            <input type="text" value="<?php echo $sermon_id?>" name="sermon_id" hidden>
                            <div class="d-flex justify-content-center mt-5">
                                <?php
                                    $fee = isset($sermon->fee) ? $sermon->fee : 0;
                                    if($fee == 0){
                                        ?>
                                        <button type="submit" class="btn" style="background-color:cornflowerblue;color:white;border-radius:2vh;">SIGN UP</button>
                                        <?php
                                    }else{
                                        ?>
                                        <div>
                                            <h6 class="text-center" style="font-weight:700;"><?php echo "$" . number_format($fee ,2)?></h6>
                                            <a href="" class="btn" style="background-color:cornflowerblue;color:white;border-radius:2vh;">Proceed to payment</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
@include("include/footer")
<script>
    const sermon_id = "<?php echo $sermon_id?>";
    const submit_handler = async (e) => {
        e.preventDefault();

        try {
            const target = e.currentTarget;
            const validation = await Helper.validate(`#${target.id}`);
            if(!validation.status){
                warning_response(validation.message);
            }

            var formdata = new FormData(target);
            const response = await axios.post(`${address}api/sermons/sign-up?id=${sermon_id}`, formdata, apiHeader);
            if(!response.data.status) {
                throw new Error(response.data.message);
            }
            const success_msg = channel == 'ENG' ? 'You have successfully signed up!' : '已注册成功！';
            success_response(success_msg)
            .then((response) => {
                window.location.href = `${address}sermons/${sermon_id}`;
            });
        } catch (err) {
            warning_response(err.message);
        }
    }
</script>
