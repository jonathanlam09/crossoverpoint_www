@include('include/header')
<style>
    .fade-up {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

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
        min-height: 100px;
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
    <section class="timeline-section mt-3 fade-up" style="width:100%;">
        <h3 class="text-center">{{ $channel == 'ENG' ? 'Crossover Point' : '跨越教会' }}</h3>
        <div class="d-flex justify-content-center">
            <div class="circle"></div>
            <div class="circle-connector"></div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-3 content-item">
                <div class="d-flex justify-content-center">
                    <img class="content-image" src="{{ url('assets/img/background.jpg') }}">
                </div>
                @if ($channel == 'ENG')
                    <p class="text-center mt-5">
                        Crossover Point AG (formerly known as Kota Kemuning AG) relocated to Tropicana Aman in 2022. The name "Crossover" holds deep spiritual significance, symbolizing the journey of faith and the fulfillment of God's promises. It reflects the biblical account of the Israelites crossing the Jordan River to enter the Promised Land, as declared in Deuteronomy 31:3:
                        "The LORD your God himself will cross over ahead of you…and you will take possession of land...as the LORD said."
                        It also echoes the powerful words of Jesus in John 5:24:
                        "Very truly I tell you, whoever hears my word and believes him who sent me has eternal life and will not be judged but has crossed over from death to life."
                        At Crossover Point AG, we embrace these foundational truths:
                        a. God goes before us, preparing the way and enabling us to step into His promises.
                        b. Through faith in Jesus, we have crossed over from death to life to have the eternal life.
                        Crossover Point AG is committed to living out this calling—stepping forward in faith, embracing transformation, and leading others into the abundant life found in Christ.
                    </p>
                @else
                    <p class="text-center mt-5">
                        跨越神召会（前称哥打甘文宁神召会）于 2022 年迁至 Tropicana Aman。“跨越” 一词具有深远的属灵意义，象征着信心的旅程以及神应许的成就。

                        这一迁移呼应了圣经中以色列人跨越约旦河进入应许之地的记载，正如申命记 31:3 所宣告的：
                        “耶和华你们的　神必在你前面越过去…你们就得地为业…正如耶和华所说的。

                        它也与耶稣在约翰福音 5:24 中的应许相呼应：
                        “我实实在在地告诉你们：那听我话又信差我来者的，就有永生，不至于定罪，是已经出死入生了。”

                        跨越教会坚守以下基要真理：
                        a. 神行在我们前面，为我们预备道路，使我们能够进入祂的应许。
                        b. 因信耶稣，我们已经出死入生，并承受永生的应许。

                        跨越教会坚定地回应这呼召——凭信心迈步向前，推动生命的改变，并带领人进入基督里丰盛的生命。
                    </p>
                @endif
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        <div class="circle-connector"></div>
    </div>
    {{-- <hr class="container mt-5 mb-5"> --}}
    <section class="details-section fade-up">
        <h3 class="text-center">{{ $channel == 'ENG' ? 'Our Pastors' : '我们的牧师' }}</h3>
        <div class="mt-5 row">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <img src="{{ url('assets/img/pastor-ian.jpeg') }}" style="max-width:300px;border-radius:2vh;">
                    <h4 class="mt-1">{{ $channel == 'ENG' ? 'Pastor Ian Wong' : '黄剑勤牧师' }}</h4>
                @if ($channel == 'ENG')
                    <p class="text-center container">Pastor Ian (Bachelor of Theology, Master of Education, Doctor of Education) is the main pastor of Crossover Point AG. His passion is personal evangelism, Christian education and special education. He is married and blessed with 3 children, He is also the administrator of Enabling Learning Centre, a learning center for special needs children.</p>
                @else
                    <p class="text-center container">黄剑勤牧师（教育博士，教育硕士，神学学士）是跨越教会的主领牧师。他热爱个人布道、基督徒教育事工以及特殊教育。他已婚，育有三名儿女。他也是一间特儿学习中心的负责人。</p>
                @endif
            </div>
            <div class="col-md-6 d-flex  flex-column align-items-center">
                <img src="{{ url('assets/img/background.jpg') }}" style="max-width:300px;border-radius:2vh;">
            </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll(".fade-up");

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        elements.forEach(el => observer.observe(el));
    });
</script>
@include('include/footer')
