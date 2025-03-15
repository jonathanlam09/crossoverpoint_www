@include("include/header")
<style>
    .testimony-children {
        height: 350px;
        border-radius: 2vh;
        overflow: hidden;
    }

    .testimony-children img {
        border-radius: 2vh;
        object-fit: cover;
        object-position: center;
    }
</style>
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3>{{ $channel == 'ENG' ? 'TESTIMONY' : '見證' }}</h3>
    </div>
</div>
<div class="container mt-5 mb-5" id="testimony_div" style="overflow: hidden">
    <div class="row p-5 mt-5 mb-5 testimony-row {{ $channel == 'ENG' ? '' : 'd-none' }}" id="row_1" style="transform: translateX(-100%);transition-duration: 1.5s;">
        <div class="col-md-4 col-12">
            <div class="testimony-children">
                <img src="{{ url('assets/img/mdmgan.jpeg') }}">
            </div>
        </div>
        <div class="col-md-8 col-12">
            <h5>- Madam Gan</h5>
            <p style="white-space: pre-line">“The Lord is my Shepherd, I shall not want.”
                I received Jesus as my Saviour in my teens, and all these years He has not failed me, though I have. Nevertheless, I have believed and trusted in Him alone. 
                “He makes me lie down in green pastures, He leads me beside still waters.”
                In my life, there have always been experiences of “still waters”, a feeling that God seems so distant. Experiences of mishaps, misfortunes, and discontent always flooded around. Despite the experiences of still waters, our Lord has never been distant. He took me to green pastures and mishaps turned into blessings. 
                “He restores my soul,”
                No matter how overwhelming situations turned out to be, His rod and staff have always protected me and been my comfort. 
                “Though I walk through the valley of the shadows of death, I will fear no evil, For thou art with me.”
                Having had a near-death experience resulting from a snatch theft, I realized that God’s angels were with me. He had me under His wings. I came out of it with just a broken arm, instead of a serious head injury!
                “The Lord prepareth a table for me in the presence of my enemies. He anointed my head with oil, my cup runneth over.” 
                I do declare,  “God is so good. He’s so good to me. I am blessed, I am called, I am healed, I am whole, I am saved in Jesus’ name.”
                On eagles’ wings, I will soar, though life may still bring sufferings, but I pray that I will remember what Calvary has bought for me.
            </p>
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row {{ $channel == 'ENG' ? '' : 'd-none'  }}" id="row_2" style="transform: translateX(100%);transition-duration: 1.5s;">
        <div class="col-md-8 col-12">
            <h5>- Ruth</h5>
            <p style="white-space: pre-line">I was born into a family who believed in Taoism. We worship different gods in the temple and have them at our house. We also believe in honoring our ancestors. I came to Christ shortly after meeting my then boyfriend (now my husband). Before we got together, my very first experience with Christianity was through an invitation from my husband to his youth and young adult event. Fast forward, I started attending church together with him because I wanted to spend more time with him. However, I felt extremely awkward at first. I had a lot of thoughts coming into my mind thinking that my family would disapprove of my relationship due to differences in religion. So I kept this in my heart as I wanted to continue this relationship. But as months passed by, I went to services, and life group every single Friday and Sunday. 

                As I continued to attend and be more and more involved with church activities, I started to feel more comfortable. People there were very welcoming and loving. They showed care for me that I never had experienced. Somehow, I could understand the sermons even though I did not know much about the bible or Christianity. It sparks curiosity in me towards Christianity. Then, I started to question, wanting to know more about Christianity. One day, my pastor approached me and asked me if I wanted to accept Christ. I was shocked at first. Thoughts went through my head. If I accepted this invitation, I would be betraying my family. However, the love and forgiveness I felt from my church and God were enough to grant me the courage to say yes. I want to believe that my God is a loving God, and He forgives all our sins, and I want to dedicate my life to Him. It’s been about 2 years now since I accepted Christ, and my life has been fully transformed. He is my Lord and Saviour, my pillar of strength.</p>
        </div>
        <div class="col-md-4 col-12">
            <div class="testimony-children">
                <img src="{{ url('assets/img/ruth.jpeg') }}">
            </div>
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row {{ $channel == 'ENG' ? 'd-none' : ''  }}" id="row_3" style="transform: translateX(-100%);transition-duration: 1.5s;">
        <div class="col-md-4 col-12">
            <div class="testimony-children">
                <img src="{{ url('assets/img/bebe.jpeg') }}">
            </div>
        </div>
        <div class="col-md-8 col-12">
            <h5>- Bebe</h5>
            <p style="white-space: pre-line">从小接触关于基督教的信仰都是因着父母的关系，因为他们相信，我也就顺其自然的去接受。我记得小时候信主的好处是去了教堂就可以不用做家务和工作，所以一直都很期待每个星期的聚会，年纪稍长就想着要去参与更多教会的活动，类似圣诞节或者是孝亲节上台表演的节目。总之，就是只想要展现自己个人的价值。之后，因着教会一些内部问题，我们离开了原生教会。在那个时候我问上帝为什么会这样？但我并没有得到我想要的答案。

                几年后，我们开始成立新的教会，再后来，我也和一个非信徒结婚了。那个时候一直觉得自己可以带领他信主，最后我失败了。但我自始自终都坚守自己信仰，我会竭尽所能带着我的孩子们参加每个星期日的聚会。在2000年，我遇到我人生中最难受的事，我的第三个孩子在5个月大的时候突然意外去世。那个时候我开始埋怨上帝，觉得祂没有眷顾我的孩子，也不爱我了。也在那个时候我不再去教会，也不再参与任何教会的活动。记得当时牧师和我说说：“无论自己做了任何选择，上帝祂永远都会等待着你回到祂身边的，因为祂是不曾对我们转过身的（当时，我并不是很理解这个道理）。直到最后我的婚姻出现了问题，才明白了上帝祂所做的一切都是在为我铺路，让我不至于在这样的困境中迷失方向，就如箴言 20:24记着说： “人的脚步为耶和华所定，人岂能明白自己的路呢？”一切都是上帝在带领着我，让我的生命不断成长，坚定对神的敬畏之心。
                我是一个很注重别人对自己的看法和评价的人。总是觉得一定要做到面面俱到，这样才会被重视，被认同。直到后来我的前夫背叛了婚姻契约，我选择放弃了婚姻，因为那个时候感觉最后得到的只是伤害和失望，也问自己到底是为了什么才努力的生活着。这个时候我对上帝没有任何怨言。我心中只有平静和平安的感觉，我知道是上帝给了我力量与安慰。(约伯记 22:21) “你要认识神，就得平安，福气也必临到你。” 我没有因为婚姻的不幸而自暴自弃，我自己也觉得诧异？原来我之前所有的打击是要成就现在的自己，自已可以以过去的经历重新开始出发新的旅程。
                我深知所经历的一切都是神在指引与开路，让我往后余生的生命更丰盛、更充实。</p>
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row {{ $channel == 'ENG' ? 'd-none' : '' }}" id="row_4" style="transform: translateX(100%);transition-duration: 1.5s;">
        <div class="col-md-8 col-12"> 
            <h5>- Yin Yin</h5>
            <p style="white-space: pre-line">某个星期一早上
                是我人生中第一次看到一只猫在我面前断气身亡
                带着极其灰的心情到公司上班时
                被老板以语音信息的方式通知我让我带薪裸辞
                那一刻我怀疑上帝是不是在造我的时候
                把我的心脏整得特别大度
                特别能够消化双倍的冲击
                不然为什么会允许这样的事情发生
                
                事情发生后的一个星期
                为了离开负面情绪
                我搭上了好友的三胞胎姐妹东京旅
                在抵达东京的第一天
                从好友口中得知她那嫁去台湾了的三胞胎姐姐也是跟我同一天被辞退 
                当下感慨
                这么让人痛心的事情
                上帝怎么可能舍得让它发生在两个祂深爱着的女儿身上，还是同一天
                然后还把两个同病相怜的人一起带来东京疗伤
                
                在旅程的第三天，我收到了应征邀约
                而在同样一天，大姐收到了录取通知
                今时今日，我们双双都着陆了新的工作
                只能说神的奇妙没有形容词
                
                走过来了才发现
                神把剧本都拟好了
                只等我走到那一天去经历祂所安排的一切
                而祂允许别人夺走我手上的小娃娃
                原来只是为了祝福我一个更大的娃娃
                生而为人，我不能参透的事太多
                但我庆幸的是， 事情发生时
                我仍然相信神
                
                “神造万物，各按其时成为美好，又将永生安置在世人心里。然而神从始至终的作为，人不能参透。”传道书3:11</p>
        </div>
        <div class="col-md-4 col-12">
            <div class="testimony-children">
                <img src="{{ url("assets/img/yinyin.jpeg") }}" >
            </div>
        </div>
    </div>
</div>
<script>
    let options = {
        root: document.getElementById("#testimony_div"),
        rootMargin: "0px",
        threshold: 0,
    };

    var observer = new IntersectionObserver(show_item, options);

    $(document).ready(() => {
        var testimonies = document.getElementsByClassName("testimony-row");
        if(testimonies.length > 0){
            for(var i=0; i<testimonies.length;i++){
                observer.observe(testimonies[i]);
            }
        }
    })

    function show_item(entries){
        if(entries.length > 0){
            for(var i=0;i<entries.length;i++){
                if(entries[i].isIntersecting){
                    $(entries[i].target).css("transform", "translateX(0%)")
                }
            }
        }
    }
</script>
@include("include/footer")
