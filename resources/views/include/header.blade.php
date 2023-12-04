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
</head>
<body>
<style>
    html, body{
        font-family: Arial, Helvetica, sans-serif;
        overflow-x: hidden;
        background-color: #f8f9fa;
        font-size: 14px;
        height: 100vh;
        width: 100vw;
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
        background-repeat: none;
        background-size: cover;
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
        padding: 10px 30px;
        cursor: pointer;
    }

    .menu-list li:hover{
        font-weight: bold;
        transform: scale(1.05);
    }

    @media only screen and (max-width: 991px){
        .banner{
            height: 250px!important;
        }
    }

</style>

<section style="padding:0;width:100%;" class="banner-section">
    <div class="banner">
        <div style="background-image: linear-gradient(to bottom, black, transparent)">
            <div class="container-fluid" style="padding:0;margin:0;display:flex;justify-content:space-between;align-items:center;">
                <div class="logo-div" style="padding: 10px;">
                    <a href="/"><img src="<?php echo url("assets/img/logo.png")?>" 
                        style="cursor:pointer;height:80px;"></a>
                </div>
                <div class="menu-div d-none d-lg-flex" style="display:flex;justify-content:flex-end;align-items:center;margin-top:20px;">
                    <ul class="menu-list text-uppercase" style="display:flex;color:white;list-style-type:none;margin:0;padding:0">
                        <li><a href="<?php echo url("/")?>" style="color:white;text-decoration:none;">Home</a></li>
                        <li><a href="<?php echo url("/about-us")?>" style="color:white;text-decoration:none;">About Us</a></li>
                        <li><a href="<?php echo url("testimony")?>" style="color:white;text-decoration:none;">Testimonies</a></li>
                        <li><a href="<?php echo url("sermons/upcoming")?>" style="color:white;text-decoration:none;">Sermons</a></li>
                        <li><a href="<?php echo url("events/upcoming")?>" style="color:white;text-decoration:none;">Events</a></li>
                        <li><i class="fa fa-search"></i></li>
                    </ul>
                </div>
                <div class="d-flex d-lg-none" style="color:white;justify-content:flex-end;align-items:center;font-size:18px;margin-top:20px;">
                    {{-- <i class="fa fa-search" style="margin-right:20px;"></i> --}}
                    <i id="mobile-menu-icon" onclick="dropdown_menu()" style="margin-right:10px;font-size:18px;cursor:pointer;" class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
            <div id="mobile-menu" style="width:100vw;background-color:black;position:absolute;top:0%;left:0%;display:none;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo-div" style="padding: 10px;">
                        <a href="#"><img src="<?php echo url("assets/img/logo.png")?>" 
                            style="cursor:pointer;height:80px;"></a>
                    </div>
                    <div>
                        <i class="fa fa-close" style="color:white;font-size:20px;padding:10px;margin-top:20px;cursor:pointer;" onclick="dropdown_menu()"></i>
                    </div>
                </div>
                <ul class="menu-list text-uppercase text-center" style="color:white;list-style-type:none;margin:0;padding:20px;">
                    <li><a href="<?php echo url("/")?>" style="color:white;text-decoration:none;">Home</a></li>
                    <li><a href="<?php echo url("/about-us")?>" style="color:white;text-decoration:none;">About Us</a></li>
                    <li><a href="<?php echo url("testimony")?>" style="color:white;text-decoration:none;">Testimonies</a></li>
                    <li><a href="<?php echo url("sermon/upcoming")?>" style="color:white;text-decoration:none;">Sermons</a></li>
                    <li><a href="<?php echo url("event/upcoming")?>" style="color:white;text-decoration:none;">Events</a></li>
                    <li><a href="#contact_us" style="color:white;text-decoration:none;">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(()=>{
    })

    function dropdown_menu(){
        $("#mobile-menu").slideToggle()
    }
</script>
