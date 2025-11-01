@include('include/header')
<style>
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .section-title {
        font-weight: 300;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        letter-spacing: 1px;
    }

    .content-wrapper {
        max-width: 800px;
        margin: 0 auto;
    }

    .church-image {
        width: 100%;
        max-width: 600px;
        height: auto;
        margin: 2rem 0;
        border-radius: 4px;
    }

    .description-text {
        line-height: 1.8;
        color: #333;
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    .pastor-card {
        margin: 3rem 0;
    }

    .pastor-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        margin: 0 auto 1.5rem;
    }

    .pastor-name {
        font-weight: 400;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .pastor-bio {
        line-height: 1.8;
        color: #555;
        max-width: 700px;
        margin: 0 auto;
    }

    .divider {
        width: 60px;
        height: 1px;
        background-color: #ddd;
        margin: 4rem auto;
    }

    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center">{{ $channel == 'ENG' ? 'ABOUT US' : '关于我们' }}</h1>
    </div>
</div>

<div class="container py-5">
    <section class="fade-up">
        <h2 class="section-title text-center">{{ $channel == 'ENG' ? 'Crossover Point' : '跨越教会' }}</h2>
        
        <div class="content-wrapper">
            <div class="text-center">
                <img class="church-image" src="{{ url('assets/img/background.jpg') }}" alt="Church">
            </div>
            
            @if ($channel == 'ENG')
                <p class="description-text">
                    Crossover Point AG (formerly known as Kota Kemuning AG) relocated to Tropicana Aman in 2022. The name "Crossover" holds deep spiritual significance, symbolizing the journey of faith and the fulfillment of God's promises.
                </p>
                <p class="description-text">
                    It reflects the biblical account of the Israelites crossing the Jordan River to enter the Promised Land, as declared in Deuteronomy 31:3: <em>"The LORD your God himself will cross over ahead of you…and you will take possession of land...as the LORD said."</em>
                </p>
                <p class="description-text">
                    It also echoes the powerful words of Jesus in John 5:24: <em>"Very truly I tell you, whoever hears my word and believes him who sent me has eternal life and will not be judged but has crossed over from death to life."</em>
                </p>
                <p class="description-text">
                    At Crossover Point AG, we embrace these foundational truths: God goes before us, preparing the way and enabling us to step into His promises. Through faith in Jesus, we have crossed over from death to life to have eternal life.
                </p>
                <p class="description-text">
                    Crossover Point AG is committed to living out this calling—stepping forward in faith, embracing transformation, and leading others into the abundant life found in Christ.
                </p>
            @else
                <p class="description-text">
                    跨越神召会（前称哥打甘文宁神召会）于 2022 年迁至 Tropicana Aman。"跨越" 一词具有深远的属灵意义，象征着信心的旅程以及神应许的成就。
                </p>
                <p class="description-text">
                    这一迁移呼应了圣经中以色列人跨越约旦河进入应许之地的记载，正如申命记 31:3 所宣告的：<em>"耶和华你们的　神必在你前面越过去…你们就得地为业…正如耶和华所说的。"</em>
                </p>
                <p class="description-text">
                    它也与耶稣在约翰福音 5:24 中的应许相呼应：<em>"我实实在在地告诉你们：那听我话又信差我来者的，就有永生，不至于定罪，是已经出死入生了。"</em>
                </p>
                <p class="description-text">
                    跨越教会坚守以下基要真理：神行在我们前面，为我们预备道路，使我们能够进入祂的应许。因信耶稣，我们已经出死入生，并承受永生的应许。
                </p>
                <p class="description-text">
                    跨越教会坚定地回应这呼召——凭信心迈步向前，推动生命的改变，并带领人进入基督里丰盛的生命。
                </p>
            @endif
        </div>
    </section>

    <div class="divider"></div>

    <section class="fade-up">
        <h2 class="section-title text-center">{{ $channel == 'ENG' ? 'Our Pastors' : '我们的牧师' }}</h2>
        
        <div class="pastor-card">
            <div class="pastor-image" style="background-image: url('{{ asset('assets/img/pastor-ian.jpeg') }}');"></div>
            <h3 class="pastor-name text-center">{{ $channel == 'ENG' ? 'Pastor Ian Wong' : '黄剑勤牧师' }}</h3>
            @if ($channel == 'ENG')
                <p class="pastor-bio text-center">
                    Pastor Ian (Bachelor of Theology, Master of Education, Doctor of Education) is the main pastor of Crossover Point AG. His passion is personal evangelism, Christian education and special education. He is married and blessed with 3 children. He is also the administrator of Enabling Learning Centre, a learning center for special needs children.
                </p>
            @else
                <p class="pastor-bio text-center">
                    黄剑勤牧师（教育博士，教育硕士，神学学士）是跨越教会的主领牧师。他热爱个人布道、基督徒教育事工以及特殊教育。他已婚，育有三名儿女。他也是一间特儿学习中心的负责人。
                </p>
            @endif
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
        }, { threshold: 0.2 });

        elements.forEach(el => observer.observe(el));
    });
</script>

@include('include/footer')