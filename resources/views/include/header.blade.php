<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crossover Point</title>
    <link rel="icon" href="<?php echo url("assets/img/logo.png")?>" type="image/icon type">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
</head>
<body>
<style>
    html, body{
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f8f9fa;
        font-size: 14px;
        height: 100vh;
    }

    .page{
        padding: 0 10px;
        border-radius: 2vh;
        cursor: pointer;
    }
    
    .active-page{
        background-color: grey;
        font-weight: 700;
    }

    .form-control{
        border-radius: 3vh!important;
    }

    .banner{
        height: 560px;
        background-image: url("<?php echo url('assets/img/background.jpg')?>");
        transition: 5s ease;
        background-size: 120%;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .error-message{
        background-color: #dc3545;
        position: absolute;
        bottom: -10px;
        font-size: 10px;
        padding: 2px 10px;
        width: 250px;
        max-width: 250px;
        border-radius: 3vh!important;
        margin-left: 10px!important;
        z-index: 99;
    }

    .star-required{
        color: #dc3545;
        margin-left: 5px;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    .menu-list li {
        display: flex; 
        align-items: center;
        padding: 15px 30px;
        cursor: pointer;
    }

    .menu-div .menu-list li:not(:last-child):hover{
        font-weight: bold;
        transform: scale(1.05);
    }

    #mobile-menu .menu-list li:hover{
        font-weight: bold;
        transform: scale(1.05);
    }

    .ch-btn:hover, .eng-btn:hover{
        font-weight: bold;
        transform: scale(1.05);
    }

    .active-ch{
        padding: 2px;
        background-color: white;
        color: black;
        border-radius: 2px;
    }

    @media only screen and (max-width: 991px){
        .banner{
            height: 250px!important;
        }
    }

    .memory-card:hover {
        filter:brightness(80%);
    }

    .memory-card {
        height:300px;
        transition-duration: 1s;
        filter: brightness(50%);
        cursor: pointer;
        background-size:cover;
    }
</style>
<section style="padding:0;width:100%;" class="banner-section">
    <div class="banner">
        <div style="background-image: linear-gradient(to bottom, black, transparent)">
            <div class="container-fluid" style="padding:0;margin:0;display:flex;justify-content:space-between;align-items:center;">
                <div class="logo-div bg-white d-flex justify-content-center align-items-center" style="padding:10px;border-radius:50%;margin:15px;height:100px;width:100px;">
                    <a href="/"><img src="<?php echo url("assets/img/logo.png")?>" 
                        style="cursor:pointer;"></a>
                </div>
                <div class="menu-div d-none d-lg-flex" style="display:flex;justify-content:flex-end;align-items:center;margin-top:20px;">
                    <ul class="menu-list text-uppercase" style="display:flex;color:white;list-style-type:none;margin:0;padding:0">
                        <li><a class="nav-home" href="<?php echo url("/")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "HOME" : "主页"?></a></li>
                        <li><a class="nav-about-us" href="<?php echo url("/about-us")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "About us" : "关于我们"?></a></li>
                        <li><a class="nav-testimony" href="<?php echo url("testimony")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Testimonies" : "見證"?></a></li>
                        <li><a class="nav-sermons" href="<?php echo url("sermons/upcoming")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Sermons" : "聚會"?></a></li>
                        <li><a class="nav-events" href="<?php echo url("events/upcoming")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Events" : "活动"?></a></li>
                        <li><a class="nav-contact-us" onclick="smooth_scroll('#contact_us')" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Contact us" : "联系我们"?></a></li>
                        <li class="d-flex align-items-center">
                            <span class="ch-btn <?php if($channel == "CH"){echo "active-ch";}?>" onclick="change_channel('CH')"><?php echo $channel == "ENG" ? "CH" : "华"?></span>
                            <div style="height:100%;border-right: 1px solid white;padding:5px"></div>
                            <div style="height:100%;border-left: 1px solid white;padding:5px"></div>
                            <span class="eng-btn <?php if($channel == "ENG"){echo "active-ch";}?>" onclick="change_channel('ENG')"><?php echo $channel == "ENG" ? "ENG" : "英"?></span>
                        </li>
                        {{-- <li><i class="fa fa-search"></i></li> --}}
                    </ul>
                </div>
                <div class="d-flex d-lg-none" style="color:white;justify-content:flex-end;align-items:center;font-size:18px;margin-top:20px;">
                    <div class="d-flex justify-content-center align-items-center" style="margin-right:20px;font-size:12px;">
                        <span class="ch-btn <?php if($channel == "CH"){echo "active-ch";}?>" style="cursor:pointer;" onclick="change_channel('CH')"><?php echo $channel == "ENG" ? "CH" : "华"?></span>
                        <div style="border-right: 1px solid white;padding:5px"></div>
                        <div style="border-left: 1px solid white;padding:5px"></div>
                        <span class="eng-btn <?php if($channel == "ENG"){echo "active-ch";}?>" style="cursor:pointer;" onclick="change_channel('ENG')"><?php echo $channel == "ENG" ? "ENG" : "英"?></span>
                    </div>
                    <i id="mobile-menu-icon" onclick="dropdown_menu()" style="margin-right:10px;font-size:18px;cursor:pointer;" class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
            <div id="mobile-menu" style="z-index:99;height:100vh;width:100%;background-color:black;position:fixed;top:0%;left:0%;display:none;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo-div" style="padding: 10px;">
                        <a href="#"><img src="<?php echo url("assets/img/logo.png")?>" 
                            style="cursor:pointer;height:80px;"></a>
                    </div>
                    <div>
                        <i class="fa fa-close" style="color:white;padding:10px;cursor:pointer;" onclick="dropdown_menu()"></i>
                    </div>
                </div>
                
                <ul class="menu-list text-uppercase text-center" style="color:white;list-style-type:none;margin:0;padding:20px;">
                    <li><a class="nav-home" href="<?php echo url("/")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "HOME" : "主页"?></a></li>
                    <li><a class="nav-about-use" href="<?php echo url("/about-us")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "About us" : "关于我们"?></a></li>
                    <li><a class="nav-testimony" href="<?php echo url("testimony")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Testimonies" : "見證"?></a></li>
                    <li><a class="nav-sermons" href="<?php echo url("sermons/upcoming")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Sermons" : "聚會"?></a></li>
                    <li><a class="nav-events" href="<?php echo url("events/upcoming")?>" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Events" : "活动"?></a></li>
                    <li><a class="nav-contact-us" onclick="smooth_scroll('#contact_us')" style="color:white;text-decoration:none;"><?php echo $channel == "ENG" ? "Contact us" : "联系我们"?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(()=>{
        $(".banner").css("background-size", "100%")
    })

    function dropdown_menu(){
        $("#mobile-menu").slideToggle();
    }

    function change_channel(val){
        axios.get(address + "api/index/language?ch=" + val)
        .then((response) => {
            if(response.data.status){
                location.reload();
            }else{
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            error_response(err);
        })
    }

    function smooth_scroll(val){
        if($("#mobile-menu").css("display") != "none"){
            $("#mobile-menu").slideToggle();
        }
        $(val).get(0).scrollIntoView({
            behavior: "smooth"
        });
    }
</script>
