@include("include/header")
<style>
    .page-header {
        padding: 4rem 0 2rem;
    }

    .page-title {
        font-weight: 300;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .testimony-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .testimony-item {
        margin-bottom: 5rem;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .testimony-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .testimony-image-wrapper {
        width: 150px;
        height: 150px;
        margin: 0 auto 2rem;
    }

    .testimony-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        object-position: center;
    }

    .testimony-name {
        font-weight: 400;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .testimony-text {
        white-space: pre-line;
        line-height: 1.8;
        color: #555;
        font-size: 1rem;
        position: relative;
        overflow: hidden;
        transition: max-height 0.4s ease;
    }

    .testimony-text.collapsed {
        max-height: 200px;
    }

    .testimony-text.collapsed::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px;
        background: linear-gradient(to bottom, transparent, white);
    }

    .read-more-btn {
        background: none;
        color: #333;
        border: none;
        padding: 0.5rem 0;
        cursor: pointer;
        margin-top: 1rem;
        font-size: 0.9rem;
        text-decoration: underline;
        transition: color 0.3s ease;
    }

    .read-more-btn:hover {
        color: #000;
    }

    .divider {
        width: 60px;
        height: 1px;
        background-color: #ddd;
        margin: 4rem auto;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .testimony-container {
            padding: 2rem 1rem;
        }

        .testimony-item {
            margin-bottom: 3rem;
        }
    }
</style>

<script>
    // TESTIMONIES CONFIGURATION - Update here to add/modify testimonies
    const testimonies = [
        {
            id: 'testimony_1',
            name: 'Madam Gan',
            image: 'assets/img/mdmgan.jpeg',
            text: `"The Lord is my Shepherd, I shall not want."
I received Jesus as my Saviour in my teens, and all these years He has not failed me, though I have. Nevertheless, I have believed and trusted in Him alone. 
"He makes me lie down in green pastures, He leads me beside still waters."
In my life, there have always been experiences of "still waters", a feeling that God seems so distant. Experiences of mishaps, misfortunes, and discontent always flooded around. Despite the experiences of still waters, our Lord has never been distant. He took me to green pastures and mishaps turned into blessings. 
"He restores my soul,"
No matter how overwhelming situations turned out to be, His rod and staff have always protected me and been my comfort. 
"Though I walk through the valley of the shadows of death, I will fear no evil, For thou art with me."
Having had a near-death experience resulting from a snatch theft, I realized that God's angels were with me. He had me under His wings. I came out of it with just a broken arm, instead of a serious head injury!
"The Lord prepareth a table for me in the presence of my enemies. He anointed my head with oil, my cup runneth over." 
I do declare,  "God is so good. He's so good to me. I am blessed, I am called, I am healed, I am whole, I am saved in Jesus' name."
On eagles' wings, I will soar, though life may still bring sufferings, but I pray that I will remember what Calvary has bought for me.`,
            channel: 'ENG'
        },
        {
            id: 'testimony_2',
            name: 'Ruth',
            image: 'assets/img/ruth.jpeg',
            text: `I was born into a family who believed in Taoism. We worship different gods in the temple and have them at our house. We also believe in honoring our ancestors. I came to Christ shortly after meeting my then boyfriend (now my husband). Before we got together, my very first experience with Christianity was through an invitation from my husband to his youth and young adult event. Fast forward, I started attending church together with him because I wanted to spend more time with him. However, I felt extremely awkward at first. I had a lot of thoughts coming into my mind thinking that my family would disapprove of my relationship due to differences in religion. So I kept this in my heart as I wanted to continue this relationship. But as months passed by, I went to services, and life group every single Friday and Sunday. 

As I continued to attend and be more and more involved with church activities, I started to feel more comfortable. People there were very welcoming and loving. They showed care for me that I never had experienced. Somehow, I could understand the sermons even though I did not know much about the bible or Christianity. It sparks curiosity in me towards Christianity. Then, I started to question, wanting to know more about Christianity. One day, my pastor approached me and asked me if I wanted to accept Christ. I was shocked at first. Thoughts went through my head. If I accepted this invitation, I would be betraying my family. However, the love and forgiveness I felt from my church and God were enough to grant me the courage to say yes. I want to believe that my God is a loving God, and He forgives all our sins, and I want to dedicate my life to Him. It's been about 2 years now since I accepted Christ, and my life has been fully transformed. He is my Lord and Saviour, my pillar of strength.`,
            channel: 'ENG'
        },
        {
            id: 'testimony_3',
            name: 'Bebe',
            image: 'assets/img/bebe.jpeg',
            text: `从小接触关于基督教的信仰都是因着父母的关系，因为他们相信，我也就顺其自然的去接受。我记得小时候信主的好处是去了教堂就可以不用做家务和工作，所以一直都很期待每个星期的聚会，年纪稍长就想着要去参与更多教会的活动，类似圣诞节或者是孝亲节上台表演的节目。总之，就是只想要展现自己个人的价值。之后，因着教会一些内部问题，我们离开了原生教会。在那个时候我问上帝为什么会这样？但我并没有得到我想要的答案。

                几年后，我们开始成立新的教会，再后来，我也和一个非信徒结婚了。那个时候一直觉得自己可以带领他信主，最后我失败了。但我自始自终都坚守自己信仰，我会竭尽所能带着我的孩子们参加每个星期日的聚会。在2000年，我遇到我人生中最难受的事，我的第三个孩子在5个月大的时候突然意外去世。那个时候我开始埋怨上帝，觉得祂没有眷顾我的孩子，也不爱我了。也在那个时候我不再去教会，也不再参与任何教会的活动。记得当时牧师和我说说："无论自己做了任何选择，上帝祂永远都会等待着你回到祂身边的，因为祂是不曾对我们转过身的（当时，我并不是很理解这个道理）。直到最后我的婚姻出现了问题，才明白了上帝祂所做的一切都是在为我铺路，让我不至于在这样的困境中迷失方向，就如箴言 20:24记着说： "人的脚步为耶和华所定，人岂能明白自己的路呢？"一切都是上帝在带领着我，让我的生命不断成长，坚定对神的敬畏之心。
                我是一个很注重别人对自己的看法和评价的人。总是觉得一定要做到面面俱到，这样才会被重视，被认同。直到后来我的前夫背叛了婚姻契约，我选择放弃了婚姻，因为那个时候感觉最后得到的只是伤害和失望，也问自己到底是为了什么才努力的生活着。这个时候我对上帝没有任何怨言。我心中只有平静和平安的感觉，我知道是上帝给了我力量与安慰。(约伯记 22:21) "你要认识神，就得平安，福气也必临到你。" 我没有因为婚姻的不幸而自暴自弃，我自己也觉得诧异？原来我之前所有的打击是要成就现在的自己，自已可以以过去的经历重新开始出发新的旅程。
                我深知所经历的一切都是神在指引与开路，让我往后余生的生命更丰盛、更充实。`,
            channel: 'CHN'
        },
        {
            id: 'testimony_4',
            name: 'Yin Yin',
            image: 'assets/img/yinyin.jpeg',
            text: `某个星期一早上
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

                "神造万物，各按其时成为美好，又将永生安置在世人心里。然而神从始至终的作为，人不能参透。"传道书3:11`,
            channel: 'CHN'
        },
        {
            id: 'testimony_5',
            name: 'Elayne',
            image: '/assets/img/logo.png',
            text: `Before this trip, I lived in faith as a Catholic, but I was not practicing or reading the Word of the Lord as I should. While I did pray and talk with God, I had lost much of my knowledge and understanding of the Bible, often relying on what others told me rather than reading it myself.

            So when I first heard about this camp, I felt anxious. From past experiences, kindness often felt rare, and I believed I had to constantly prove myself to be welcomed, even within my own family. I was therefore worried I wouldn’t fit in, since I only knew Javin. But what helped me take the step anyway was prayer. I told God about my worries and entrusted them to Him, believing that maybe this was the moment He wanted me to grow, to learn more of His Word, and to meet others who walk with Him as well.

            And from the very first day, even while waiting for the bus, everyone’s kindness and warmth eased my initial worries. I felt welcomed right away, which reflected how Jesus welcomes all with open arms.

            Through all the activities and services, I learned more about Jesus’ love and how growing in His Word can be joyful and not like a strict test. I realized that no one here was testing me, but instead sharing with me and learning together. For example, when someone asked if I knew the story of Zacchaeus, I felt shy and anxious because I had forgotten. But instead of judging me, the group I was with read the passage with me and reminded me of the story. That moment showed me how safe it feels to learn about God together and not alone.

            Other moments that touched me greatly were the times when we all prayed together. It felt so intimate and refreshing, making me even more grateful for this trip and my trust in God. I was reminded that kindness and love still exist in this world, and that they reflect God’s heart. Just like in the stories of Zacchaeus and the adulterous woman we roleplayed, God and Jesus welcome us all with both compassion and grace.

            What I want to carry with me from this trip is how kindness surpasses so much, and how love and warmth can touch someone’s life so deeply. I am now motivated to read my Bible more closely and seek understanding for myself, instead of depending on others who might even mislead me.

            And I believe that if everyone had a community as loving and kind as this one, they would be able to prosper so much in life. Growing up, I didn’t always experience that kind of support, and at times it made me doubtful about whether kindness and love truly exist. But God has shown me through this camp and this community that they do. 
            Even if I didn’t have it as a child, He has given it to me now, and for that I am deeply grateful. I pray that God continues to bless this church and its people, so that the same love, warmth, and kindness I have experienced here can touch many more lives.`,
            channel: 'ENG'
        },
        {
            id: 'testimony_6',
            name: 'Deborah',
            image: '/assets/img/logo.png',
            text: `My life has always been dictated by fears, doubts, and anxiety. Whatever I do, I always think things will not work out well. But as a pastor's kid, I was taught to put my faith in God whether things worked out or not—and I did. However, I did not put 100% of my faith in Him, because as a human, I would often think, “Is it even possible for God to do this kind of miracle in my life?”

            I have attended many revivals, church camps, youth camps, and young adult ministries, but I was never truly filled by the Holy Spirit in the way I longed for—probably because of the many doubts in my heart. I went to this church camp expecting the same, but indeed, God works in unexpected ways.

            I cried out to God to wash away my fears and doubts, and I wasn’t doing this alone—someone prayed for me, laid hands on me, and for the first time in my life, I was finally able to be filled by the Holy Spirit. It was such a liberating and refreshing experience that I opened my mouth and spoke in tongues for the very first time.

            I thank God for giving me the opportunity to come, even though there were many obstacles that almost prevented me from going. I also thank the church for sponsoring half of the costs.`,
            channel: 'ENG'
        },
        {
            id: 'testimony_7',
            name: 'Jorryn',
            image: '/assets/img/logo.png',
            channel: 'ENG',
            text: `
            Before I came to this family camp, I was going through a very hard time. After my SPM exam, I felt overwhelmed. There were so many things I wanted to do, but I didn’t even know when, where, or how to start. I worried a lot about my studies because I felt no interest in any course. I prayed to God about my decisions, but my heart was filled with worries, doubts, anxiety, and insecurity. I couldn’t quiet down and listen to what my Heavenly Father wanted to say to me. I felt like I was hiding my true self and not being honest about my feelings.

            After the Young Adult camp, I slowly began to find my way back. But when I thought everything was getting better, something sudden and unexpected happened to my family. It was the worst day of my life. I suffered deeply seeing my family hurt, and voices kept condemning me:
            “You are the cause of everything.”
            “If not for you, your family would be fine.”
            “You are weak; you can’t do anything.”
            “Why didn’t you see this coming?”
            “You could have stopped it, but you let it slip away.”

            These voices kept repeating in my mind, and I felt like I had fallen into a deep black hole. I felt so far away from God, with my heart torn apart. I was angry at myself because I always seemed to fail whenever I faced difficulties, and I felt like I never grew spiritually.

            But God did not leave me there. He showed Himself to me. He spoke to me in many ways and began to open my heart. Yet I still struggled to truly let go of the past. I pretended to move on, but inside, I was still stuck.

            Then, in this camp, God used Pastor Dean’s words to enlighten me. If not for God’s grace, I might still be trapped in darkness. I realized that He has always been with me in my hardships. I should not search for answers in this world, but in His Word. He is enough for me. I should stop caring about what people think and instead listen to what my Heavenly Father says about me. I should put all my focus on the Lord—the One who loved me even while I was still a sinner.

            After this camp, I want to learn how to fully surrender my life to the Lord. I want to live out the likeness of Christ. I want to spend more time with Him and become a faithful steward.

            As Job 5:19–21 reminds us:
            “From six calamities He will rescue you; in seven no harm will touch you. In famine He will deliver you from death, and in battle from the stroke of the sword. You will be protected from the lash of the tongue, and need not fear when destruction comes.”

            This is my hope—that no matter how many troubles I face, my God will always rescue me and keep me safe in Him.
            `
        }
    ];
</script>

<div class="page-header">
    <div class="container">
        <h1 class="page-title text-center">{{ $channel == 'ENG' ? 'TESTIMONY' : '見證' }}</h1>
    </div>
</div>

<div class="testimony-container">
    <!-- Testimonies will be rendered here by JavaScript -->
    <div id="testimony_content"></div>
</div>

<script>
    const channel = '{{ $channel }}';
    const readMoreText = channel === 'ENG' ? 'Read more' : '閱讀更多';
    const readLessText = channel === 'ENG' ? 'Read less' : '收起';

    // Render testimonies
    function renderTestimonies() {
        const container = document.getElementById('testimony_content');
        
        testimonies.forEach((testimony, index) => {
            // Check if testimony should be shown based on channel
            const shouldShow = (channel === 'ENG' && testimony.channel === 'ENG') || 
                             (channel !== 'ENG' && testimony.channel === 'CHN');
            
            if (!shouldShow) return;

            const testimonyDiv = document.createElement('div');
            testimonyDiv.className = 'testimony-item';
            testimonyDiv.id = testimony.id;
            
            testimonyDiv.innerHTML = `
                <div class="text-center">
                    <div class="testimony-image-wrapper">
                        <img src="{{ url('') }}/${testimony.image}" alt="${testimony.name}" class="testimony-image">
                    </div>
                    <h3 class="testimony-name">${testimony.name}</h3>
                    <div class="testimony-text collapsed" id="text_${testimony.id}">${testimony.text}</div>
                    <button class="read-more-btn" onclick="toggleReadMore('${testimony.id}')">
                        ${readMoreText}
                    </button>
                </div>
                ${index < testimonies.filter(t => (channel === 'ENG' && t.channel === 'ENG') || (channel !== 'ENG' && t.channel === 'CHN')).length - 1 ? '<div class="divider"></div>' : ''}
            `;
            
            container.appendChild(testimonyDiv);
        });
    }

    // Toggle read more/less
    function toggleReadMore(id) {
        const textElement = document.getElementById('text_' + id);
        const button = event.currentTarget;
        
        if (textElement.classList.contains('collapsed')) {
            textElement.classList.remove('collapsed');
            textElement.style.maxHeight = textElement.scrollHeight + 'px';
            button.textContent = readLessText;
        } else {
            textElement.classList.add('collapsed');
            textElement.style.maxHeight = '200px';
            button.textContent = readMoreText;
            
            // Scroll to testimony
            document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Intersection Observer for fade-in effect
    document.addEventListener('DOMContentLoaded', function() {
        renderTestimonies();
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        const testimonyItems = document.querySelectorAll('.testimony-item');
        testimonyItems.forEach(item => observer.observe(item));
    });
</script>

@include("include/footer")