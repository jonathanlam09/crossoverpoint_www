@include("include/header")
<div style="background-color:lightgrey;">
    <div class="container p-5">
        <h3><?php echo $channel == "ENG" ? "TESTIMONY" : "证言"?></h3>
    </div>
</div>
<div class="container mt-5 mb-5" id="testimony_div" style="overflow: hidden">
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_1" style="transform: translateX(-100%);transition-duration: 1.5s;">
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div>
        <div class="col-md-8 col-12">
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
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_2" style="transform: translateX(100%);transition-duration: 1.5s;">
        <div class="col-md-8 col-12">
            <p>is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_3" style="transform: translateX(-100%);transition-duration: 1.5s;">
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
        </div>
        <div class="col-md-8 col-12">
            <p>is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
    </div>
    <div class="row p-5 mt-5 mb-5 testimony-row" id="row_4" style="transform: translateX(100%);transition-duration: 1.5s;">
        <div class="col-md-8 col-12"> 
            <p style="white-space: pre-line">I was born into a family who believed in Taoism. We worship different gods in the temple and have them at our house. We also believe in honoring our ancestors. I came to Christ shortly after meeting my then boyfriend (now my husband). Before we got together, my very first experience with Christianity was through an invitation from my husband to his youth and young adult event. Fast forward, I started attending church together with him because I wanted to spend more time with him. However, I felt extremely awkward at first. I had a lot of thoughts coming into my mind thinking that my family would disapprove of my relationship due to differences in religion. So I kept this in my heart as I wanted to continue this relationship. But as months passed by, I went to services, and life group every single Friday and Sunday. 

                As I continued to attend and be more and more involved with church activities, I started to feel more comfortable. People there were very welcoming and loving. They showed care for me that I never had experienced. Somehow, I could understand the sermons even though I did not know much about the bible or Christianity. It sparks curiosity in me towards Christianity. Then, I started to question, wanting to know more about Christianity. One day, my pastor approached me and asked me if I wanted to accept Christ. I was shocked at first. Thoughts went through my head. If I accepted this invitation, I would be betraying my family. However, the love and forgiveness I felt from my church and God were enough to grant me the courage to say yes. I want to believe that my God is a loving God, and He forgives all our sins, and I want to dedicate my life to Him. It’s been about 2 years now since I accepted Christ, and my life has been fully transformed. He is my Lord and Saviour, my pillar of strength.</p>
        </div>
        <div class="col-md-4 col-12">
            <img src="<?php echo url("assets/img/banner.png")?>" alt="">
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
