@include("include/header")
<style>
    .circle {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: black;
        animation: 1s blink linear;
    }

    .circle:hover {
        animation: 1s blink linear infinite;
    }

    .circle-connector {
        min-height: 300px;
        border: 1px solid black;
    }

    @keyframes blink{
        0% {
            width: 10px;
            height: 10px;
            background-color: black;
        }

        50% {
            width: 12px;
            height: 12px;
            background-color: lightgrey;
            transform: scale(1.05);
        }

        100% {
            width: 15px;
            height: 15px;
            background-color: white;
            transform: scale(1.1);
        }
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3><?php echo $channel == "ENG" ? "ABOUT US" : "关于我们"?></h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    <section class="timeline-section" style="width:100%;">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle"></div>
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5">
                <img src="<?php echo url('assets/img/background.jpg')?>" style="max-width: 200px;">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis libero voluptatum unde nam facilis pariatur ab quaerat illum voluptas, non, dolorem veritatis, numquam placeat sit excepturi porro obcaecati aspernatur ea!</p>
            </div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle-connector"></div>
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle"></div>
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle-connector"></div>
            </div>
            <div class="col-5">
                <img src="<?php echo url('assets/img/background.jpg')?>" style="max-width: 200px;">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis libero voluptatum unde nam facilis pariatur ab quaerat illum voluptas, non, dolorem veritatis, numquam placeat sit excepturi porro obcaecati aspernatur ea!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle"></div>
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5">
                <div class>

                </div>
                <img src="<?php echo url('assets/img/background.jpg')?>" style="max-width: 200px;">
                <p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis libero voluptatum unde nam facilis pariatur ab quaerat illum voluptas, non, dolorem veritatis, numquam placeat sit excepturi porro obcaecati aspernatur ea!</p>
            </div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle-connector"></div>
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle"></div>
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle-connector"></div>
            </div>
            <div class="col-5">
                <div class="d-flex justify-content-center mb-3">
                    <img src="<?php echo url('assets/img/background.jpg')?>" style="max-width: 200px;">
                </div>
                <p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis libero voluptatum unde nam facilis pariatur ab quaerat illum voluptas, non, dolorem veritatis, numquam placeat sit excepturi porro obcaecati aspernatur ea!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2 d-flex justify-content-center">
                <div class="circle"></div>
            </div>
            <div class="col-5"></div>
        </div>
    </section>
    <hr class="container mt-5 mb-5">
    <section class="details-section">
        <h3>Our Pastors</h3>
        <div class="mt-5 row">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <img src="<?php echo url('assets/img/background.jpg')?>" style="max-width: 300px;">
                <p>test</p>
            </div>
            <div class="col-md-6 d-flex  flex-column align-items-center">
                <img src="<?php echo url('assets/img/background.jpg')?>" style="max-width: 300px;">
            </div>
        </div>
    </section>
</div>
<script>
</script>
@include("include/footer")
