@include('include/header')
<style>
    .content-item {
        border-radius: 2vh;
        max-width: 800px;
        width: fit-content;
    }

    .content-image {
        cursor: pointer;
        transition-duration: .5s;
        max-width: 400px;
        border-radius: 2vh;
    }

    .content-image:hover {
        transform: scale(1.1);
    }

    .circle {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: black;
        animation: 1s blink linear infinite;
        position: absolute;
    }

    .circle:hover {
        animation: 1s blink linear infinite;
    }

    .circle-connector {
        min-height: 300px;
        border: 1px solid lightgrey;
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
        <h3>{{ $channel == 'ENG' ? 'ABOUT US' : '关于我们' }}</h3>
    </div>
</div>
<div class="container mt-5 mb-5">
    {{-- <p class="text-center">Coming soon.</p> --}}
    <section class="d-flex justify-content-center">
        <div style="max-width: 800px;">
            @if ($channel == 'ENG')
                <p class="text-center">
                    Crossover Point AG, is a Christ-centered faith community empowered by the Holy Spirit to live out the truth of God. We strive to cultivate a vibrant, Spirit-filled Christian life, guided by unwavering adherence to biblical principles. With a mission-minded focus, we are dedicated to sharing the Gospel and making disciples. Our heart is to build up the body of Christ through teaching, fellowship, and service, fostering an environment where believers are encouraged, equipped, and empowered to grow in their faith and fulfill their God-given purpose.
                </p>
            @else
                <p class="text-center">
                    跨越教会是一个以基督为中心的信仰群体，靠圣灵的力量活出神的真理。我们致力于培育充满活力、被圣灵充满的基督徒生命并坚持以圣经真理为唯一准则。秉持宣教使命，我们以广传福音为使命，并培育门徒。通过圣经教导、团契和服事，建立基督的身体，激励并装备信徒在信仰中茁壮成长，成就神所托付的使命和呼召。
                </p>
            @endif
        </div>
    </section>
    <section class="timeline-section mt-3" style="width:100%;">
        <div class="d-flex justify-content-center">
            <div class="circle"></div>
            <div class="circle-connector"></div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-3 content-item">
                <div class="d-flex justify-content-center">
                    <img class="content-image" src="{{ url('assets/img/background.jpg') }}">
                </div>
                <p class="text-center mt-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis libero voluptatum unde nam facilis pariatur ab quaerat illum voluptas, non, dolorem veritatis, numquam placeat sit excepturi porro obcaecati aspernatur ea!</p>
            </div>
        </div>
        {{-- <div class="row">
            
            <div class="col-2 d-flex justify-content-center">
                <div class="circle-connector"></div>
            </div>
            <div class="col-5"></div>
        </div> --}}
        {{-- <div class="row">
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
                <img src="{{ url('assets/img/background.jpg') }}" style="max-width: 200px;">
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
                <img src="{{ url('assets/img/background.jpg') }}" style="max-width: 200px;">
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
                    <img src="{{ url('assets/img/background.jpg') }}" style="max-width: 200px;">
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
        </div> --}}
    </section>
    <hr class="container mt-5 mb-5">
    <section class="details-section">
        <h3>Our Pastors</h3>
        <div class="mt-5 row">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <img src="{{ url('assets/img/background.jpg') }}" style="max-width: 300px;">
                <p>test</p>
            </div>
            <div class="col-md-6 d-flex  flex-column align-items-center">
                <img src="{{ url('assets/img/background.jpg') }}" style="max-width: 300px;">
            </div>
        </div>
    </section>
</div>
<script>
</script>
@include('include/footer')
